<?php

namespace App\Controllers;

use App\Helpers\LabelHelper;
use App\Models\CavityModel;
use App\Models\CentralDataModel;
use App\Models\LineModel;
use App\Models\MoldModel;
use App\Models\PrintLabelItemModel;
use App\Models\PrintLabelModel;
use App\Models\ShiftModel;
use CodeIgniter\Controller;

class PrintForm extends Controller
{
    /**
     * Halaman utama: Form Print QR Code Label
     */
    public function index()
    {
        $shiftModel  = new ShiftModel();
        $lineModel   = new LineModel();
        $moldModel   = new MoldModel();
        $cavityModel = new CavityModel();

        $data = [
            'shifts'   => $shiftModel->orderBy('shift_name', 'ASC')->findAll(),
            'lines'    => $lineModel->orderBy('id', 'ASC')->findAll(),
            'molds'    => $moldModel->orderBy('mold_name', 'ASC')->findAll(),
            'cavities' => $cavityModel->orderBy('cavity_name', 'ASC')->findAll(),
        ];

        return view('print_form/index', $data);
    }

    /**
     * AJAX: cari data by Doc Number ke database server PUSAT (read-only).
     * Endpoint ini TIDAK PERNAH menulis ke server pusat, hanya SELECT.
     */
    public function searchDoc()
    {
        $docNumber = trim((string) $this->request->getPost('doc_number'));

        if ($docNumber === '') {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Doc Number wajib diisi.',
            ]);
        }

        $centralModel = new CentralDataModel();
        $rows         = $centralModel->getByDocNumber($docNumber);

        if (empty($rows)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Doc Number tidak ditemukan di database pusat.',
            ]);
        }

        // Customer diambil dari baris pertama (asumsi 1 doc number = 1 customer)
        $customer = $rows[0]['customer'] ?? '';

        return $this->response->setJSON([
            'success'  => true,
            'customer' => $customer,
            'items'    => $rows,
        ]);
    }

    /**
     * Simpan hasil input form (header + grid item) ke database LOKAL.
     * Setiap item di-expand menjadi N baris lot (N = floor(qty / standard_pack)).
     * Setiap baris lot mendapat ref_no unik dan lot_no_combined.
     */
    public function store()
    {
        $request = $this->request;

        $headerData = [
            'doc_number'      => $request->getPost('doc_number'),
            'customer'        => $request->getPost('customer'),
            'product_name'    => $request->getPost('product_name'),
            'date_mode'       => $request->getPost('date_mode'),
            'production_date' => $request->getPost('production_date') ?: null,
            'job_order'       => $request->getPost('job_order') ?: null,
            'shift_id'        => $request->getPost('shift_id') ?: null,
            'line_mode'       => $request->getPost('line_mode'),
            'line_id'         => $request->getPost('line_id') ?: null,
            'mold_id'         => $request->getPost('mold_id') ?: null,
            'cavity_id'       => $request->getPost('cavity_id') ?: null,
            'from_series'     => strtoupper((string) $request->getPost('from_series')),
            'remark'          => $request->getPost('remark'),
            'user_initial'    => strtoupper((string) $request->getPost('user_initial')),
            'lot_guarantee'   => $request->getPost('lot_guarantee') ? 1 : 0,
            'lot_sa'          => $request->getPost('lot_sa') ? 1 : 0,
            'flag_4m'         => $request->getPost('flag_4m') ? 1 : 0,
            'size_mode'       => $request->getPost('size_mode'),
        ];

        $items = $request->getPost('items');
        if (is_string($items)) {
            $items = json_decode($items, true) ?: [];
        }
        $items = $items ?: [];

        $headerModel = new PrintLabelModel();

        if (! $headerModel->validate($headerData)) {
            return $this->response->setJSON([
                'success' => false,
                'errors'  => $headerModel->errors(),
            ]);
        }

        // Beralih menggunakan Session (Stateless Print), tidak disimpan ke DB
        $tempId = uniqid('pdf_');
        $itemRows = [];

        if (! empty($items)) {
            $itemRows = $this->buildLotRows($tempId, $items, $headerData);
        }

        session()->set($tempId, [
            'header' => $headerData,
            'lots'   => $itemRows,
        ]);

        return $this->response->setJSON([
            'success'   => true,
            'header_id' => $tempId,
        ]);
    }

    /**
     * Preview label: generate PDF inline (tampil di browser, bisa Ctrl+P).
     * Mengambil data dari database lokal berdasarkan header ID.
     */
    public function preview($headerId = null)
    {
        return $this->generatePdf((string) $headerId, inline: true);
    }

    /**
     * Print label: generate PDF inline untuk dicetak user.
     * Sama seperti preview, alias ke metode yang sama.
     */
    public function printLabel($headerId = null)
    {
        return $this->generatePdf((string) $headerId, inline: true);
    }

    /**
     * Download label: force download PDF ke komputer user.
     */
    public function download($headerId = null)
    {
        return $this->generatePdf((string) $headerId, inline: false);
    }

    // -------------------------------------------------------------------------
    // Private helpers
    // -------------------------------------------------------------------------

    /**
     * Expand item-item grid menjadi baris lot individual.
     * Tiap item menghasilkan N = floor(qty / standard_pack) lot.
     * Setiap lot mendapat ref_no unik (16 char random) dan lot_no_combined.
     *
     * @param  string $headerId
     * @param  array  $items       Array asli dari grid (1 baris per item)
     * @param  array  $headerData  Data header (untuk generate lot_no_combined)
     * @return array  Array baris siap di-insertBatch
     */
    private function buildLotRows(string $headerId, array $items, array $headerData): array
    {
        $rows = [];

        foreach ($items as $item) {
            $qty          = (int) ($item['quantity']      ?? 0);
            $standardPack = (int) ($item['standard_pack'] ?? 0);

            // Jika standard_pack kosong / 0, cetak sebagai 1 lot dengan qty penuh
            if ($standardPack <= 0) {
                $standardPack = $qty ?: 1;
            }

            $totalLots = $qty > 0 ? (int) floor($qty / $standardPack) : 1;
            if ($totalLots < 1) {
                $totalLots = 1;
            }

            for ($seq = 1; $seq <= $totalLots; $seq++) {
                // Qty lot terakhir bisa berupa sisa (qty - (totalLots-1)*standardPack)
                $lotQty = ($seq === $totalLots)
                    ? ($qty - ($totalLots - 1) * $standardPack)
                    : $standardPack;

                // Kalau lotQty <= 0 (qty habis terbagi pas), tetap standardPack
                if ($lotQty <= 0) {
                    $lotQty = $standardPack;
                }

                $rows[] = [
                    'header_id'       => $headerId,
                    'item_code'       => $item['item_code']     ?? null,
                    'description'     => $item['description']   ?? null,
                    'quantity'        => $qty,
                    'lotno'           => $item['lotno']         ?? null,
                    'warehouse'       => $item['warehouse']     ?? null,
                    'back_no'         => $item['back_no']       ?? null,
                    'standard_pack'   => $standardPack,
                    'operator'        => $item['operator']      ?? null,
                    'ref_no'          => LabelHelper::generateRefNo(),
                    'lot_no_combined' => LabelHelper::generateLotNo(
                        dateStr:    $headerData['production_date'] ?? '',
                        dateMode:   $headerData['date_mode'] ?? 'production_date',
                        shiftId:    $headerData['shift_id'] ?? '',
                        lineMode:   $headerData['line_mode'] ?? 'line',
                        lineId:     $headerData['line_id'] ?? null,
                        moldId:     $headerData['mold_id'] ?? null,
                        cavityId:   $headerData['cavity_id'] ?? null,
                        fromSeries: $headerData['from_series'] ?? ''
                    ),
                    'lot_sequence'    => $seq,
                    'lot_qty'         => $lotQty,
                ];
            }
        }

        return $rows;
    }

    /**
     * Generate PDF menggunakan mPDF dan streaming ke browser.
     *
     * @param  string  $headerId  ID sesi / penanda unik PDF
     * @param  bool $inline    true = tampil inline di browser, false = force download
     */
    private function generatePdf(string $headerId, bool $inline = true): \CodeIgniter\HTTP\Response
    {
        if (empty($headerId)) {
            return $this->response->setStatusCode(400)->setBody('Sesi ID tidak valid.');
        }

        // -- Ambil data dari Session (Stateless) --
        $data = session()->get($headerId);

        if (! $data) {
            return $this->response->setStatusCode(404)->setBody('Data label tidak ditemukan atau sesi telah kedaluwarsa.');
        }

        $header = $data['header'];
        $lots   = $data['lots'];

        if (empty($lots)) {
            return $this->response->setStatusCode(404)->setBody('Tidak ada data item/lot untuk dicetak.');
        }

        // -- Ambil nama shift (untuk display) --
        $shiftModel = new ShiftModel();
        $shift      = $header['shift_id'] ? $shiftModel->find($header['shift_id']) : null;
        $shiftName  = $shift['shift_name'] ?? '';

        // -- Konfigurasi grid sesuai size mode --
        $grid = LabelHelper::getGridConfig($header['size_mode'] ?? 'medium');

        // -- Render HTML template --
        $html = view('print_form/label_pdf', [
            'header'    => $header,
            'lots'      => $lots,
            'shiftName' => $shiftName,
            'grid'      => $grid,
        ]);

        // -- Generate PDF dengan mPDF --
        try {
            $mpdf = new \Mpdf\Mpdf([
                'mode'              => 'utf-8',
                'format'            => 'A4',
                'orientation'       => 'P',          // Portrait
                'margin_top'        => 5,
                'margin_bottom'     => 5,
                'margin_left'       => 5,
                'margin_right'      => 5,
                'default_font_size' => $grid['font_size_pt'],
                'default_font'      => 'dejavusans',
            ]);
            $mpdf->SetAutoPageBreak(true, 5);

            // DEBUG: jika ada ?debug=1 di URL, tampilkan HTML mentah tanpa mPDF
            if ($this->request->getGet('debug') === '1') {
                return $this->response->setHeader('Content-Type', 'text/html')->setBody($html);
            }

            $mpdf->WriteHTML($html);

            $filename   = 'label_' . $headerId . '_' . date('Ymd_His') . '.pdf';
            $outputMode = $inline ? 'I' : 'D'; // I = inline, D = download

            $pdfContent = $mpdf->Output('', 'S'); // S = return as string

            return $this->response
                ->setHeader('Content-Type', 'application/pdf')
                ->setHeader('Content-Disposition', ($inline ? 'inline' : 'attachment') . '; filename="' . $filename . '"')
                ->setBody($pdfContent);
        } catch (\Throwable $e) {
            log_message('error', '[PrintForm::generatePdf] ' . $e->getMessage() . ' in ' . $e->getFile() . ' line ' . $e->getLine());
            log_message('error', '[PrintForm::generatePdf] Trace: ' . $e->getTraceAsString());
            return $this->response->setStatusCode(500)->setBody('Gagal generate PDF: ' . esc($e->getMessage()) . ' di file ' . esc(basename($e->getFile())) . ' baris ' . $e->getLine());
        }
    }
}

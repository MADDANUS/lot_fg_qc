<?php

namespace App\Controllers;

use App\Helpers\LabelHelper;
use App\Models\CavityModel;
use App\Models\CentralDataModel;
use App\Models\LineModel;
use App\Models\MoldModel;
use App\Models\OmronInnerModel;
use App\Models\OmronOuterModel;
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
     * AJAX: ambil semua customer (CardCode + CardName + ItemCode) dari SAP B1.
     * Dipanggil saat halaman load untuk mengisi dropdown Customer
     * dan menyimpan lookup map ItemCode → Customer di JavaScript.
     */
    public function getCustomers()
    {
        $centralModel = new CentralDataModel();

        // Kembalikan dummy jika ada param ?dummy=1 (untuk testing tanpa koneksi SAP)
        if ($this->request->getGet('dummy') === '1') {
            return $this->response->setJSON([
                'success' => true,
                'data'    => $centralModel->getByDocNumber('DUMMY_CUSTOMERS'),  // trigger dummy
            ]);
        }

        $rows = $centralModel->getCustomers();

        return $this->response->setJSON([
            'success' => true,
            'data'    => $rows,   // [ {CardCode, CardName, ItemCode}, ... ]
        ]);
    }

    /**
     * AJAX: cari data by Doc Number ke database server PUSAT (read-only).
     * Mengembalikan daftar item (dengan DocDate) dari tabel OIGN SAP B1.
     * ItemCode di setiap item dipakai JS untuk memfilter dropdown Customer.
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

        // Ambil ItemCode unik dari semua baris hasil query
        $itemCodes = array_unique(array_column($rows, 'ItemCode'));

        // DocDate dari baris pertama (semua baris satu doc punya tanggal sama)
        $docDate = $rows[0]['DocDate'] ?? null;
        if ($docDate instanceof \DateTime) {
            $docDate = $docDate->format('Y-m-d');
        } elseif (is_string($docDate)) {
            // SQL Server bisa kembalikan format berbeda, normalkan ke Y-m-d
            $ts = strtotime($docDate);
            $docDate = $ts ? date('Y-m-d', $ts) : $docDate;
        }

        return $this->response->setJSON([
            'success'    => true,
            'doc_date'   => $docDate,     // untuk auto-fill production_date
            'item_codes' => $itemCodes,   // untuk filter dropdown customer di JS
            'items'      => $rows,        // baris lengkap untuk grid
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

        $extractId = function($val) {
            if (!$val) return null;
            $parts = explode(' - ', $val);
            return trim($parts[0]);
        };

        $headerData = [
            'doc_number'      => $request->getPost('doc_number'),
            'customer'        => $request->getPost('customer'),
            'doc_date'        => $request->getPost('doc_date') ?: null,   // DocDate SAP → untuk label DATE
            'product_name'    => $request->getPost('product_name'),
            'date_mode'       => $request->getPost('date_mode'),
            'production_date' => $request->getPost('production_date') ?: null,
            'job_order'       => $request->getPost('job_order') ?: null,
            'shift_id'        => $extractId($request->getPost('shift_id')),
            'line_mode'       => $request->getPost('line_mode'),
            'line_id'         => $extractId($request->getPost('line_id')),
            'mold_id'         => $extractId($request->getPost('mold_id')),
            'cavity_id'       => $extractId($request->getPost('cavity_id')),
            'from_series'     => strtoupper((string) $request->getPost('from_series')),
            'remark'          => $request->getPost('remark'),
            'user_initial'    => strtoupper((string) $request->getPost('user_initial')),
            'lot_guarantee'   => $request->getPost('lot_guarantee') ? 1 : 0,
            'lot_sa'          => $request->getPost('lot_sa') ? 1 : 0,
            'flag_4m'         => $request->getPost('flag_4m') ? 1 : 0,
            'size_mode'       => $request->getPost('size_mode'),
            'omron_label_type'=> $request->getPost('omron_label_type'),
            'machine'         => $request->getPost('machine'),
            'notification'    => $request->getPost('notification'),
            'omron_cavity'    => $request->getPost('omron_cavity'),
            'omron_shift'     => $request->getPost('omron_shift'),
            'omron_die_no'    => $request->getPost('omron_die_no'),
            'omron_dwg_no'    => $request->getPost('omron_dwg_no'),
        ];

        $items = $request->getPost('items');
        if (is_string($items)) {
            $items = json_decode($items, true) ?: [];
        }
        $items = $items ?: [];

        $headerModel = new PrintLabelModel();

        // Validasi Dinamis: Jika Customer = EPSON, maka field lain wajib diisi
        $isEpson = stripos($headerData['customer'], 'EPSON') !== false;
        $rules = $headerModel->getValidationRules();
        if ($isEpson) {
            $rules['product_name'] = 'required|in_list[IJP,BS]';
            $rules['date_mode']    = 'required|in_list[production_date,job_order]';
            $rules['line_mode']    = 'required|in_list[line,mold_cavity]';
            $rules['from_series']  = 'required|max_length[4]';
        }
        
        // Custom Omron rules
        $isOmron = stripos($headerData['customer'], 'OMRON') !== false;
        if ($isOmron) {
            $labelType = $headerData['omron_label_type'] ?? 'inner';
            if ($labelType === 'outer') {
                unset($rules['user_initial']);
                $rules['production_date'] = 'required';
                $rules['machine']         = 'required';
                $rules['notification']    = 'required';
            } else {
                // Inner
                $rules['machine']      = 'required';
                $rules['user_initial'] = 'required|max_length[10]';
            }
        }

        // Custom Mitsuba rules
        if (stripos($headerData['customer'], 'MITSUBA') !== false) {
            unset($rules['user_initial']);
        }

        $headerModel->setValidationRules($rules);

        $messages = [
            'doc_number' => [
                'required' => 'Kolom "Doc Number" wajib diisi.',
                'max_length' => 'Kolom "Doc Number" maksimal 50 karakter.',
            ],
            'product_name' => [
                'required' => 'Kolom "Product Name" wajib dipilih.',
                'in_list' => 'Pilihan "Product Name" tidak valid.',
            ],
            'date_mode' => [
                'required' => 'Mode tanggal wajib dipilih.',
            ],
            'line_mode' => [
                'required' => 'Mode line wajib dipilih.',
            ],
            'from_series' => [
                'required' => 'Kolom "From Series" wajib diisi.',
            ],
            'production_date' => [
                'required' => 'Kolom "Production Date" wajib diisi.',
            ],
            'machine' => [
                'required' => 'Kolom "Machine" wajib diisi.',
            ],
            'notification' => [
                'required' => 'Kolom "Notification" wajib dipilih.',
            ],
            'user_initial' => [
                'required' => 'Kolom "User Initial Name" wajib diisi.',
                'max_length' => 'Kolom "User Initial Name" terlalu panjang.',
            ],
        ];
        $headerModel->setValidationMessages($messages);

        if (! $headerModel->validate($headerData)) {
            return $this->response->setJSON([
                'success' => false,
                'errors'  => $headerModel->errors(),
            ]);
        }

        // ── Omron & Mitsuba: simpan ke database permanen (KECUALI direct print) ────────────────
        $isOmron = stripos($headerData['customer'] ?? '', 'OMRON') !== false;
        $isMitsuba = stripos($headerData['customer'] ?? '', 'MITSUBA') !== false;
        $isPreview = !empty($this->request->getPost('is_preview'));

        if ($isOmron && !$isPreview) {
            $labelType = $headerData['omron_label_type'] ?? 'inner';
            $model     = $labelType === 'outer' ? new OmronOuterModel() : new OmronInnerModel();

            $docDate = null;
            if (! empty($headerData['doc_date'])) {
                $ts = strtotime($headerData['doc_date']);
                $docDate = $ts ? date('Y-m-d', $ts) : null;
            }

            $productionDate = null;
            if (! empty($headerData['production_date'])) {
                $ts = strtotime($headerData['production_date']);
                $productionDate = $ts ? date('Y-m-d', $ts) : null;
            }

            $savedRows = [];
            foreach ($items as $item) {
                $savedRows[] = [
                    'doc_number'      => $headerData['doc_number']   ?? '',
                    'doc_date'        => $docDate,
                    'item_code'       => $item['item_code']           ?? '',
                    'description'     => $item['description']         ?? ($item['Dscription'] ?? ''),
                    'quantity'        => (int) ($item['quantity']     ?? 0),
                    'standard_pack'   => (int) ($item['standard_pack'] ?? 0),
                    'lotno'           => $item['lotno']               ?? ($item['U_MIS_LotNo'] ?? ''),
                    'whs_code'        => $item['warehouse']           ?? ($item['WhsCode']      ?? ''),
                    'back_no'         => $item['back_no']             ?? ($item['U_MIS_BackNo'] ?? ''),
                    'operator'        => $item['operator']            ?? ($item['U_MIS_Operator'] ?? ''),
                    'production_date' => $productionDate,
                    'machine'         => $headerData['machine']       ?? '',
                    'notification'    => $headerData['notification']  ?? '',
                    'user_initial'    => $headerData['user_initial']  ?? '',
                    'job_order'       => $headerData['job_order']     ?? null,
                    'shift_id'        => $headerData['shift_id']      ?? null,
                    'cavity'          => $headerData['omron_cavity']  ?? null,
                    'shift'           => $headerData['omron_shift']   ?? null,
                    'remark'          => $headerData['remark']        ?? null,
                    'die_no'          => $headerData['omron_die_no']  ?? null,
                    'dwg_no'          => $headerData['omron_dwg_no']  ?? null,
                    'is_printed'      => 0,
                ];
            }

            if (! empty($savedRows)) {
                $model->insertBatch($savedRows);
            }

            return $this->response->setJSON([
                'success'      => true,
                'omron_saved'  => true,
                'label_type'   => $labelType,
                'saved_count'  => count($savedRows),
            ]);
        }

        if ($isMitsuba && !$isPreview) {
            $model = new \App\Models\MitsubaLabelModel();
            
            $savedRows = [];
            foreach ($items as $item) {
                $savedRows[] = [
                    'doc_number'      => $headerData['doc_number']   ?? '',
                    'item_code'       => $item['item_code']           ?? '',
                    'description'     => $item['description']         ?? ($item['Dscription'] ?? ''),
                    'quantity'        => (int) ($item['quantity']     ?? 0),
                    'lotno'           => $item['lotno']               ?? ($item['U_MIS_LotNo'] ?? ''),
                    'machine'         => $headerData['machine']       ?? '',
                    'operator'        => $item['operator']            ?? ($item['U_MIS_Operator'] ?? ''),
                    'is_printed'      => 0,
                ];
            }

            if (! empty($savedRows)) {
                $model->insertBatch($savedRows);
            }

            return $this->response->setJSON([
                'success'        => true,
                'mitsuba_saved'  => true,
                'saved_count'    => count($savedRows),
            ]);
        }

        // ── Non-Omron/Mitsuba: simpan ke Session (Stateless Print) ──────────────────
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

            $totalLots = $qty > 0 ? (int) ceil($qty / $standardPack) : 1;
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

        // -- Tentukan template sesuai size_mode --
        $sizeMode = strtolower(str_replace(['/', ' ', '-'], '', $header['size_mode'] ?? 'medium'));
        $isMitsuba = stripos($header['customer'] ?? '', 'MITSUBA') !== false;

        if ($isMitsuba) {
            $tplView = 'print_form/mitsuba/label_pdf';
            $perPage = 10;
        } elseif ($sizeMode === 'mediumepson') {
            // Template lama: label kiri + kanan berdampingan
            $tplView    = 'print_form/epson/label_pdf';
            $perPage    = 3;  // 3 pasang per halaman
        } elseif ($sizeMode === 'omron') {
            // Template Omron: label kiri + kanan berdampingan
            $tplView    = 'print_form/omron/label_pdf';
            $perPage    = 3;
        } else {
            // Template baru: hanya label kanan
            $tplView = match($sizeMode) {
                'small'  => 'print_form/default/small/label_pdf',
                'large'  => 'print_form/default/large/label_pdf',
                'yamaha' => 'print_form/yamaha/label_pdf',
                default  => 'print_form/default/medium/label_pdf',
            };
            $perPage = match($sizeMode) {
                'large' => 2,   // 1 kolom × 2 baris = 2 per halaman
                default => 6,   // small: 3×2, medium/yamaha: 2×3 = 6 per halaman
            };
        }

        // DEBUG: jika ada ?debug=1 di URL, tampilkan HTML mentah tanpa mPDF
        if ($this->request->getGet('debug') === '1') {
            $debugHtml = view($tplView, [
                'header'    => $header,
                'lots'      => $lots,
                'shiftName' => $shiftName,
                'grid'      => $grid,
            ]);
            return $this->response->setHeader('Content-Type', 'text/html')->setBody($debugHtml);
        }

        // -- Generate PDF dengan mPDF --
        try {
            $mpdf = new \Mpdf\Mpdf([
                'mode'              => 'utf-8',
                'format'            => 'A4',
                'orientation'       => 'P',
                'margin_top'        => 5,
                'margin_bottom'     => 5,
                'margin_left'       => 5,
                'margin_right'      => 5,
                'default_font_size' => $grid['font_size_pt'],
                'default_font'      => 'dejavusans',
            ]);
            $mpdf->SetAutoPageBreak(false);
            $mpdf->shrink_tables_to_fit = 0;

            // Bagi lots menjadi grup sesuai perPage
            $groups = array_chunk($lots, $perPage);

            foreach ($groups as $gi => $group) {
                if ($gi > 0) {
                    $mpdf->AddPage();
                }

                // Render HTML untuk grup ini menggunakan template yang sudah dipilih
                $groupHtml = view($tplView, [
                    'header'    => $header,
                    'lots'      => $group,
                    'shiftName' => $shiftName,
                    'grid'      => $grid,
                ]);

                $mpdf->WriteHTML($groupHtml, \Mpdf\HTMLParserMode::DEFAULT_MODE, $gi === 0, false);
            }

            $filename   = 'label_' . $headerId . '_' . date('Ymd_His') . '.pdf';
            $pdfContent = $mpdf->Output('', 'S');

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


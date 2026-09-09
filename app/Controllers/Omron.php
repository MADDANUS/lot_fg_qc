<?php

namespace App\Controllers;

use App\Models\OmronInnerModel;
use App\Models\OmronOuterModel;
use CodeIgniter\Controller;
use Mpdf\Mpdf;
use Mpdf\Config\ConfigVariables;
use Mpdf\Config\FontVariables;

class Omron extends Controller
{
    /**
     * Halaman utama: Saved Labels (2 Tab: Inner & Outer)
     */
    public function index()
    {
        return view('omron/index');
    }

    /**
     * DataTables AJAX: Inner
     */
    public function dataInner()
    {
        $model = new OmronInnerModel();
        $rows  = $model->orderBy('created_at', 'DESC')->findAll();
        return $this->response->setJSON(['data' => $rows]);
    }

    /**
     * DataTables AJAX: Outer
     */
    public function dataOuter()
    {
        $model = new OmronOuterModel();
        $rows  = $model->orderBy('created_at', 'DESC')->findAll();
        return $this->response->setJSON(['data' => $rows]);
    }

    /**
     * Delete selected rows
     */
    public function deleteRows()
    {
        $request = $this->request;
        $type    = $request->getPost('type');  // 'inner' atau 'outer'
        $ids     = $request->getPost('ids');   // array of IDs

        if (empty($ids) || !is_array($ids)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Tidak ada data yang dipilih.']);
        }

        $model = $type === 'outer' ? new OmronOuterModel() : new OmronInnerModel();
        $model->whereIn('id', $ids)->delete();

        return $this->response->setJSON(['success' => true]);
    }

    /**
     * Batch Print: generate PDF dari sekumpulan ID yang dipilih
     */
    public function batchPrint()
    {
        $request = $this->request;
        $type    = $request->getPost('type');   // 'inner' atau 'outer'
        $ids     = $request->getPost('ids');    // array of IDs

        if (empty($ids) || !is_array($ids)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Tidak ada data yang dipilih.']);
        }

        $model = $type === 'outer' ? new OmronOuterModel() : new OmronInnerModel();
        $rows  = $model->whereIn('id', $ids)->orderBy('id', 'ASC')->findAll();

        if (empty($rows)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Data tidak ditemukan.']);
        }

        // Simpan ke session, generate PDF
        $sessionKey = 'omron_batch_' . uniqid();
        session()->set($sessionKey, [
            'type' => $type,
            'rows' => $rows,
        ]);

        // Update is_printed = 1
        $model->whereIn('id', $ids)->set(['is_printed' => 1])->update();

        return $this->response->setJSON([
            'success'     => true,
            'session_key' => $sessionKey,
        ]);
    }

    /**
     * Render PDF dari session key
     */
    public function renderPdf(string $sessionKey)
    {
        $data = session()->get($sessionKey);

        if (empty($data)) {
            return $this->response->setBody('Session expired atau data tidak ditemukan.');
        }

        $type = $data['type'];
        $rows = $data['rows'];

        // Expand rows: pecah qty berdasarkan standard_pack
        $lots = [];
        foreach ($rows as $row) {
            $qty          = (int) ($row['quantity']     ?? 0);
            $standardPack = (int) ($row['standard_pack'] ?? 0);
            if ($standardPack <= 0) $standardPack = $qty ?: 1;

            $totalLots = $qty > 0 ? (int) ceil($qty / $standardPack) : 1;
            if ($totalLots < 1) $totalLots = 1;

            for ($seq = 1; $seq <= $totalLots; $seq++) {
                $lotQty = ($seq === $totalLots)
                    ? ($qty - ($totalLots - 1) * $standardPack)
                    : $standardPack;
                if ($lotQty <= 0) $lotQty = $standardPack;

                $lots[] = array_merge($row, [
                    'lot_qty'       => $lotQty,
                    'lot_sequence'  => $seq,
                    'omron_label_type' => $type,
                ]);
            }
        }

        // Render view
        $html = view('print_form/omron/batch_pdf', [
            'type' => $type,
            'lots' => $lots,
        ]);

        // Generate mPDF
        $defaultConfig = (new ConfigVariables())->getDefaults();
        $fontDirs      = $defaultConfig['fontDir'];
        $defaultFontConfig = (new FontVariables())->getDefaults();
        $fontData      = $defaultFontConfig['fontdata'];

        $mpdf = new Mpdf([
            'mode'          => 'utf-8',
            'format'        => 'A4',
            'margin_top'    => 10,
            'margin_bottom' => 10,
            'margin_left'   => 10,
            'margin_right'  => 10,
            'fontDir'       => array_merge($fontDirs, [FCPATH . '../app/Fonts/']),
            'fontdata'      => array_merge($fontData, [
                'calibri' => ['R' => 'calibri.ttf', 'B' => 'calibrib.ttf'],
            ]),
            'default_font'  => 'calibri',
        ]);

        $mpdf->SetTitle('Omron Label - ' . strtoupper($type));
        $mpdf->WriteHTML($html);
        $mpdf->Output('omron_' . $type . '_labels.pdf', 'I');
        exit;
    }
}

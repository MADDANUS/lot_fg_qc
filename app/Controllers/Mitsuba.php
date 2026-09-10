<?php

namespace App\Controllers;

use App\Models\MitsubaLabelModel;
use CodeIgniter\Controller;
use Mpdf\Mpdf;

class Mitsuba extends Controller
{
    /**
     * Halaman utama: Mitsuba Saved Labels
     */
    public function index()
    {
        return view('mitsuba/index');
    }

    /**
     * DataTables AJAX
     */
    public function data()
    {
        $model = new MitsubaLabelModel();
        $rows  = $model->orderBy('created_at', 'DESC')->findAll();
        return $this->response->setJSON(['data' => $rows]);
    }

    /**
     * Delete selected rows
     */
    public function deleteRows()
    {
        $request = $this->request;
        $ids     = $request->getPost('ids');

        if (empty($ids) || !is_array($ids)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Tidak ada data yang dipilih.']);
        }

        $model = new MitsubaLabelModel();
        $model->whereIn('id', $ids)->delete();

        return $this->response->setJSON(['success' => true]);
    }

    /**
     * Batch Print: generate PDF
     */
    public function batchPrint()
    {
        $request = $this->request;
        $ids     = $request->getPost('ids');

        if (empty($ids) || !is_array($ids)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Tidak ada data yang dipilih.']);
        }

        $model = new MitsubaLabelModel();
        $rows  = $model->whereIn('id', $ids)->orderBy('id', 'ASC')->findAll();

        if (empty($rows)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Data tidak ditemukan.']);
        }

        $sessionKey = 'mitsuba_batch_' . uniqid();
        session()->set($sessionKey, [
            'rows' => $rows,
        ]);

        $model->whereIn('id', $ids)->set(['is_printed' => 1])->update();

        return $this->response->setJSON([
            'success'     => true,
            'session_key' => $sessionKey,
        ]);
    }

    /**
     * Render PDF
     */
    public function renderPdf(string $sessionKey)
    {
        $data = session()->get($sessionKey);

        if (empty($data)) {
            return $this->response->setBody('Session expired atau data tidak ditemukan.');
        }

        $rows = $data['rows'];
        $lots = [];

        foreach ($rows as $row) {
            $qty = (int) ($row['quantity'] ?? 0);
            // Default 1 label per baris untuk mitsuba
            $lots[] = array_merge($row, [
                'lot_qty' => $qty,
            ]);
        }

        $html = view('print_form/mitsuba/label_pdf', [
            'lots' => $lots,
        ]);

        $mpdf = new Mpdf([
            'mode'          => 'utf-8',
            'format'        => 'A4',
            'margin_top'    => 5,
            'margin_bottom' => 5,
            'margin_left'   => 5,
            'margin_right'  => 5,
            'default_font'  => 'dejavusans',
        ]);

        $mpdf->SetAutoPageBreak(false);
        $mpdf->SetTitle('Mitsuba Labels');
        $mpdf->WriteHTML($html);
        $mpdf->Output('mitsuba_labels.pdf', 'I');
        exit;
    }
}

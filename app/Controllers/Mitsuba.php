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
        $request = $this->request;
        $start   = (int) ($request->getVar('start') ?? 0);
        $length  = (int) ($request->getVar('length') ?? 25);
        $search  = $request->getVar('search');
        $searchVal = (is_array($search) && isset($search['value'])) ? $search['value'] : '';
        $order   = $request->getVar('order') ?? [];
        $columns = $request->getVar('columns') ?? [];
        $draw    = (int) ($request->getVar('draw') ?? 1);

        $model   = new MitsubaLabelModel();
        $builder = $model->builder();

        // 1. Total records before filter
        $recordsTotal = $builder->countAllResults(false);

        // 2. Apply Search
        if (!empty($searchVal)) {
            $searchable = ['doc_number', 'item_code', 'description', 'lotno'];
            $builder->groupStart();
            foreach ($searchable as $col) {
                $builder->orLike($col, $searchVal);
            }
            $builder->groupEnd();
        }

        // 3. Total records after filter
        $recordsFiltered = $builder->countAllResults(false);

        // 4. Apply Order
        if (!empty($order)) {
            $orderColIdx = $order[0]['column'];
            $orderDir    = $order[0]['dir'];
            if (isset($columns[$orderColIdx]['data'])) {
                $orderColName = $columns[$orderColIdx]['data'];
                $allowedSort  = ['id', 'doc_number', 'item_code', 'description', 'quantity', 'lotno', 'created_at'];
                if (in_array($orderColName, $allowedSort)) {
                    $builder->orderBy($orderColName, $orderDir);
                }
            }
        } else {
            $builder->orderBy('created_at', 'DESC');
        }

        // 5. Apply Limit
        if ($length != -1) {
            $builder->limit($length, $start);
        }

        $data = $builder->get()->getResultArray();

        return $this->response->setJSON([
            'draw'            => $draw,
            'recordsTotal'    => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data'            => $data
        ]);
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

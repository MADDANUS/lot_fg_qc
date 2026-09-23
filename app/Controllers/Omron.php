<?php

namespace App\Controllers;

use App\Models\OmronInnerModel;
use App\Models\OmronOuterModel;
use App\Models\OmronItemModel;
use App\Models\ShiftModel;
use App\Models\LineModel;
use App\Models\CavityModel;
use CodeIgniter\Controller;
use Mpdf\Mpdf;

class Omron extends Controller
{
    /**
     * Halaman utama: Saved Labels (2 Tab: Inner & Outer)
     */
    public function index()
    {
        $itemModel   = new OmronItemModel();
        $shiftModel  = new ShiftModel();
        $lineModel   = new LineModel();
        $cavityModel = new CavityModel();

        $data = [
            'omron_items' => $itemModel->orderBy('item_code', 'ASC')->findAll(),
            'shifts'      => $shiftModel->orderBy('shift_name', 'ASC')->findAll(),
            'lines'       => $lineModel->orderBy('id', 'ASC')->findAll(),
            'cavities'    => $cavityModel->orderBy('cavity_name', 'ASC')->findAll(),
        ];

        return view('omron/index', $data);
    }

    public function dataInner()
    {
        $request = $this->request;
        $start   = (int) ($request->getVar('start') ?? 0);
        $length  = (int) ($request->getVar('length') ?? 25);
        $search  = $request->getVar('search');
        $searchVal = (is_array($search) && isset($search['value'])) ? $search['value'] : '';
        $order   = $request->getVar('order') ?? [];
        $columns = $request->getVar('columns') ?? [];
        $draw    = (int) ($request->getVar('draw') ?? 1);

        $model   = new OmronInnerModel();
        $builder = $model->builder();

        $recordsTotal = $builder->countAllResults(false);

        if (!empty($searchVal)) {
            $searchable = ['doc_number', 'item_code', 'description', 'lotno', 'doc_date'];
            $builder->groupStart();
            foreach ($searchable as $col) {
                $builder->orLike($col, $searchVal);
            }
            $builder->groupEnd();
        }

        $recordsFiltered = $builder->countAllResults(false);

        if (!empty($order)) {
            $orderColIdx = $order[0]['column'];
            $orderDir    = $order[0]['dir'];
            if (isset($columns[$orderColIdx]['data'])) {
                $orderColName = $columns[$orderColIdx]['data'];
                $allowedSort  = ['id', 'doc_number', 'doc_date', 'item_code', 'description', 'quantity', 'standard_pack', 'lotno', 'created_at'];
                if (in_array($orderColName, $allowedSort)) {
                    $builder->orderBy($orderColName, $orderDir);
                }
            }
        } else {
            $builder->orderBy('created_at', 'DESC');
        }

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
     * DataTables AJAX: Outer
     */
    public function dataOuter()
    {
        $request = $this->request;
        $start   = (int) ($request->getVar('start') ?? 0);
        $length  = (int) ($request->getVar('length') ?? 25);
        $search  = $request->getVar('search');
        $searchVal = (is_array($search) && isset($search['value'])) ? $search['value'] : '';
        $order   = $request->getVar('order') ?? [];
        $columns = $request->getVar('columns') ?? [];
        $draw    = (int) ($request->getVar('draw') ?? 1);

        $model   = new OmronOuterModel();
        $builder = $model->builder();

        $recordsTotal = $builder->countAllResults(false);

        if (!empty($searchVal)) {
            $searchable = ['doc_number', 'item_code', 'description', 'lotno', 'production_date', 'machine'];
            $builder->groupStart();
            foreach ($searchable as $col) {
                $builder->orLike($col, $searchVal);
            }
            $builder->groupEnd();
        }

        $recordsFiltered = $builder->countAllResults(false);

        if (!empty($order)) {
            $orderColIdx = $order[0]['column'];
            $orderDir    = $order[0]['dir'];
            if (isset($columns[$orderColIdx]['data'])) {
                $orderColName = $columns[$orderColIdx]['data'];
                $allowedSort  = ['id', 'doc_number', 'production_date', 'item_code', 'description', 'quantity', 'lotno', 'machine', 'created_at'];
                if (in_array($orderColName, $allowedSort)) {
                    $builder->orderBy($orderColName, $orderDir);
                }
            }
        } else {
            $builder->orderBy('created_at', 'DESC');
        }

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
        $type    = $request->getPost('type');  // 'inner' atau 'outer'
        $ids     = $request->getPost('ids');   // array of IDs

        if (empty($ids) || !is_array($ids)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Tidak ada data yang dipilih.']);
        }

        $model = $type === 'outer' ? new OmronOuterModel() : new OmronInnerModel();
        $model->delete($ids);

        return $this->response->setJSON(['success' => true]);
    }

    /**
     * Save new Outer Label from manual input form
     */
    public function saveOuter()
    {
        $request = $this->request;
        $model = new OmronOuterModel();

        $data = [
            'doc_number'      => 'MANUAL',
            'doc_date'        => date('Y-m-d'),
            'item_code'       => $request->getPost('item_code'),
            'description'     => $request->getPost('description'),
            'production_date' => $request->getPost('production_date'),
            'quantity'        => $request->getPost('quantity'),
            'lotno'           => $request->getPost('lotno'),
            'cavity'          => $request->getPost('cavity'),
            'shift'           => $request->getPost('shift'),
            'machine'         => $request->getPost('machine'),
            'remark'          => $request->getPost('remark'),
            'die_no'          => $request->getPost('die_no'),
            'dwg_no'          => $request->getPost('dwg_no'),
            'notification'    => $request->getPost('notification'),
            'is_printed'      => 0,
        ];

        // Ensure empty dates become null for DB
        if (empty($data['production_date'])) {
            $data['production_date'] = null;
        }

        try {
            $model->insert($data);
            return $this->response->setJSON(['success' => true]);
        } catch (\Exception $e) {
            return $this->response->setJSON(['success' => false, 'message' => $e->getMessage()]);
        }
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
                    'ref_no'        => 'IT1' . \App\Helpers\LabelHelper::generateHexRefNo(13),
                ]);
            }
        }

        // Render view
        $html = view('print_form/omron/batch_pdf', [
            'type' => $type,
            'lots' => $lots,
        ]);

        // Tingkatkan backtrack_limit untuk mencegah error pada HTML berukuran besar (multi print)
        ini_set('pcre.backtrack_limit', '10000000');

        // Generate mPDF
        $mpdf = new Mpdf([
            'mode'          => 'utf-8',
            'format'        => 'A4',
            'margin_top'    => 5,
            'margin_bottom' => 5,
            'margin_left'   => 5,
            'margin_right'  => 5,
            'default_font'  => 'dejavusans',
        ]);
        $mpdf->shrink_tables_to_fit = 0;

        $mpdf->SetAutoPageBreak(false);
        $mpdf->SetTitle('Omron Label - ' . strtoupper($type));
        $mpdf->WriteHTML($html);
        $mpdf->Output('omron_' . $type . '_labels.pdf', 'I');
        exit;
    }
}

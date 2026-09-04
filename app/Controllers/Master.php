<?php

namespace App\Controllers;

use App\Models\CavityModel;
use App\Models\LineModel;
use App\Models\MoldModel;
use App\Models\ShiftModel;
use CodeIgniter\Controller;

class Master extends Controller
{
    /**
     * Mapping nama tab -> [model class, kolom nama, apakah id manual/bukan auto-increment]
     */
    private array $map = [
        'shift'  => ['model' => ShiftModel::class,  'nameField' => 'shift_name',  'manualId' => false],
        'line'   => ['model' => LineModel::class,   'nameField' => 'line_name',   'manualId' => true],
        'mold'   => ['model' => MoldModel::class,   'nameField' => 'mold_name',   'manualId' => false],
        'cavity' => ['model' => CavityModel::class, 'nameField' => 'cavity_name', 'manualId' => false],
    ];

    /**
     * Halaman Master Data (4 tab: Shift, Line, Mold, Cavity)
     */
    public function index()
    {
        return view('master/index');
    }

    private function resolve(string $type)
    {
        if (! isset($this->map[$type])) {
            return null;
        }
        $config       = $this->map[$type];
        $modelClass   = $config['model'];
        $config['obj'] = new $modelClass();

        return $config;
    }

    /**
     * AJAX: ambil semua baris untuk 1 tab (type = shift|line|mold|cavity)
     */
    public function list(string $type)
    {
        $config = $this->resolve($type);
        if (! $config) {
            return $this->response->setJSON(['success' => false, 'message' => 'Tipe master tidak dikenal.']);
        }

        $rows = $config['obj']->orderBy('id', 'ASC')->findAll();

        return $this->response->setJSON(['success' => true, 'data' => $rows]);
    }

    /**
     * AJAX: simpan (insert baru atau update kalau id dikirim & sudah ada)
     */
    public function save(string $type)
    {
        $config = $this->resolve($type);
        if (! $config) {
            return $this->response->setJSON(['success' => false, 'message' => 'Tipe master tidak dikenal.']);
        }

        $model     = $config['obj'];
        $nameField = $config['nameField'];
        $id        = $this->request->getPost('id');
        $name      = trim((string) $this->request->getPost($nameField));

        if ($name === '') {
            return $this->response->setJSON(['success' => false, 'message' => 'Nama wajib diisi.']);
        }

        $payload = [$nameField => $name];

        if ($config['manualId']) {
            // Untuk Line: id diinput manual (kode huruf), wajib ada & unik
            $newId = trim((string) $this->request->getPost('id'));
            if ($newId === '') {
                return $this->response->setJSON(['success' => false, 'message' => 'ID wajib diisi.']);
            }
            $payload['id'] = strtoupper($newId);

            $existing = $model->find($payload['id']);
            if ($existing && (empty($id) || $id !== $payload['id'])) {
                // insert baru dengan id yang sudah dipakai -> tolak
                if (empty($id)) {
                    return $this->response->setJSON(['success' => false, 'message' => 'ID sudah dipakai.']);
                }
            }
            $model->save($payload);
        } else {
            if (! empty($id)) {
                $model->update($id, $payload);
            } else {
                $model->insert($payload);
            }
        }

        if ($model->errors()) {
            return $this->response->setJSON(['success' => false, 'errors' => $model->errors()]);
        }

        return $this->response->setJSON(['success' => true]);
    }

    /**
     * AJAX: hapus 1 baris
     */
    public function delete(string $type, $id = null)
    {
        $config = $this->resolve($type);
        if (! $config || $id === null) {
            return $this->response->setJSON(['success' => false, 'message' => 'Data tidak valid.']);
        }

        $config['obj']->delete($id);

        return $this->response->setJSON(['success' => true]);
    }
}

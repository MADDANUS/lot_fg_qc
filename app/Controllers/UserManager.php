<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class UserManager extends Controller
{
    private UserModel $model;

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        $this->model = new UserModel();
    }

    /**
     * List semua user
     */
    public function index()
    {
        $users = $this->model->orderBy('id', 'ASC')->findAll();

        return view('user_manager/index', [
            'title' => 'Manajemen User — Lot FG Label System',
            'users' => $users,
        ]);
    }

    /**
     * AJAX: Tambah user baru
     */
    public function create()
    {
        $username  = trim($this->request->getPost('username') ?? '');
        $fullName  = trim($this->request->getPost('full_name') ?? '');
        $password  = $this->request->getPost('password') ?? '';
        $role      = $this->request->getPost('role') ?? 'user';
        $isActive  = (int) ($this->request->getPost('is_active') ?? 1);

        if ($username === '' || $fullName === '' || $password === '') {
            return $this->response->setJSON(['success' => false, 'message' => 'Username, nama, dan password wajib diisi.']);
        }

        if (strlen($username) < 2) {
            return $this->response->setJSON(['success' => false, 'message' => 'Username minimal 2 karakter.']);
        }

        if (strlen($password) < 3) {
            return $this->response->setJSON(['success' => false, 'message' => 'Password minimal 3 karakter.']);
        }

        // Cek unique username
        $existing = $this->model->where('username', $username)->first();
        if ($existing) {
            return $this->response->setJSON(['success' => false, 'message' => 'Username sudah digunakan.']);
        }

        try {
            $this->model->skipValidation(true)->insert([
                'username'  => $username,
                'password'  => password_hash($password, PASSWORD_BCRYPT),
                'full_name' => $fullName,
                'role'      => $role,
                'is_active' => $isActive,
            ]);
            return $this->response->setJSON(['success' => true, 'message' => 'User berhasil ditambahkan.']);
        } catch (\Throwable $e) {
            return $this->response->setJSON(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    /**
     * AJAX: Update user
     */
    public function update()
    {
        $id       = (int) $this->request->getPost('id');
        $fullName = trim($this->request->getPost('full_name') ?? '');
        $role     = $this->request->getPost('role') ?? 'user';
        $isActive = (int) ($this->request->getPost('is_active') ?? 1);
        $password = $this->request->getPost('password') ?? '';

        if ($id <= 0 || $fullName === '') {
            return $this->response->setJSON(['success' => false, 'message' => 'Data tidak valid.']);
        }

        $data = [
            'full_name' => $fullName,
            'role'      => $role,
            'is_active' => $isActive,
        ];

        // Update password hanya jika diisi
        if ($password !== '') {
            if (strlen($password) < 3) {
                return $this->response->setJSON(['success' => false, 'message' => 'Password minimal 3 karakter.']);
            }
            $data['password'] = password_hash($password, PASSWORD_BCRYPT);
        }

        $this->model->skipValidation(true)->update($id, $data);

        return $this->response->setJSON(['success' => true, 'message' => 'User berhasil diperbarui.']);
    }

    /**
     * AJAX: Hapus user
     */
    public function delete()
    {
        $id = (int) $this->request->getPost('id');

        if ($id <= 0) {
            return $this->response->setJSON(['success' => false, 'message' => 'ID tidak valid.']);
        }

        // Jangan hapus diri sendiri
        if ($id === (int) session()->get('user_id')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Tidak bisa menghapus akun sendiri.']);
        }

        $this->model->delete($id);

        return $this->response->setJSON(['success' => true, 'message' => 'User berhasil dihapus.']);
    }
}

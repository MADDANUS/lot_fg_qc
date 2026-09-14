<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    public function login()
    {
        // Jika sudah login, redirect ke halaman utama
        if (session()->get('logged_in')) {
            return redirect()->to(base_url('print-form'));
        }

        return view('auth/login', [
            'title' => 'Login — Lot FG Label System',
        ]);
    }

    public function doLogin()
    {
        $username = trim($this->request->getPost('username') ?? '');
        $password = $this->request->getPost('password') ?? '';

        if ($username === '' || $password === '') {
            return redirect()->back()
                ->with('error', 'Username dan password wajib diisi.')
                ->withInput();
        }

        $userModel = new UserModel();
        $user      = $userModel->verifyLogin($username, $password);

        if (! $user) {
            return redirect()->back()
                ->with('error', 'Username atau password salah, atau akun tidak aktif.')
                ->withInput();
        }

        // Simpan ke session
        session()->set([
            'logged_in' => true,
            'user_id'   => $user['id'],
            'username'  => $user['username'],
            'full_name' => $user['full_name'],
            'role'      => $user['role'],
        ]);

        return redirect()->to(base_url('print-form'));
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'))
            ->with('success', 'Anda berhasil logout.');
    }
}

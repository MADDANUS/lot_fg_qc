<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        if (! $session->get('logged_in')) {
            if ($request->isAJAX()) {
                return \Config\Services::response()
                    ->setStatusCode(401)
                    ->setJSON(['success' => false, 'message' => 'Sesi Anda telah habis. Silakan muat ulang halaman dan login kembali.']);
            }
            return redirect()->to(base_url('login'));
        }

        if ($session->get('role') !== 'admin') {
            if ($request->isAJAX()) {
                return \Config\Services::response()
                    ->setStatusCode(403)
                    ->setJSON(['success' => false, 'message' => 'Akses ditolak. Halaman ini hanya untuk admin.']);
            }
            return redirect()->to(base_url('print-form'))
                ->with('error', 'Akses ditolak. Halaman ini hanya untuk admin.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // nothing
    }
}

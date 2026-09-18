<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (! session()->get('logged_in')) {
            if ($request->isAJAX()) {
                return \Config\Services::response()
                    ->setStatusCode(401)
                    ->setJSON(['success' => false, 'message' => 'Sesi Anda telah habis. Silakan muat ulang halaman dan login kembali.']);
            }
            return redirect()->to(base_url('login'))->with('error', 'Silakan login terlebih dahulu.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // nothing
    }
}

<?php

namespace App\Models;

use Config\Database;

/**
 * Model ini KHUSUS untuk tarik data dari database server pusat berdasarkan Doc Number.
 * Sengaja TIDAK extends CodeIgniter\Model dan TIDAK menyediakan method insert/update/delete
 * sama sekali — supaya secara struktur kode pun tidak mungkin dipakai untuk menulis ke
 * server pusat, hanya query SELECT lewat query builder read-only.
 *
 * -----------------------------------------------------------------------------------
 * !! WAJIB DISESUAIKAN !!
 * $table dan nama-nama kolom di bawah masih ASUMSI karena struktur tabel/view yang
 * sebenarnya di server pusat belum diketahui. Sesuaikan dengan skema aslinya.
 * -----------------------------------------------------------------------------------
 */
class CentralDataModel
{
    protected $db;

    /**
     * TODO: ganti dengan nama tabel/view asli di server pusat yang menyimpan
     * data per Doc Number (customer, item code, qty, lot, dst).
     */
    protected string $table = 'doc_number_data';

    public function __construct()
    {
        // Koneksi sengaja TIDAK dipanggil di sini agar tidak timeout saat pakai data dummy
    }

    /**
     * Ambil data (bisa lebih dari satu baris/item) berdasarkan Doc Number.
     * Hanya SELECT, tidak ada write.
     *
     * @return array Daftar baris item untuk doc number tsb (bisa kosong kalau tidak ketemu)
     */
    public function getByDocNumber(string $docNumber): array
    {
        // ---------------------------------------------------------------------
        // DATA DUMMY UNTUK TRIAL
        // ---------------------------------------------------------------------
        if (stripos($docNumber, 'DUMMY') !== false) {
            return [
                [
                    'customer'      => 'PT. BENGKEL MAJU',
                    'item_code'     => 'ITEM-001-XYZ',
                    'description'   => 'Plastik Cover Mesin Kanan',
                    'quantity'      => '1500',
                    'lotno'         => 'LOT-24-001',
                    'warehouse'     => 'WH-A1',
                    'back_no'       => 'BN-99',
                    'standard_pack' => '500',
                    'operator'      => 'Budi',
                ],
                [
                    'customer'      => 'PT. BENGKEL MAJU',
                    'item_code'     => 'ITEM-002-XYZ',
                    'description'   => 'Plastik Cover Mesin Kiri',
                    'quantity'      => '750',
                    'lotno'         => 'LOT-24-002',
                    'warehouse'     => 'WH-A2',
                    'back_no'       => 'BN-98',
                    'standard_pack' => '500',
                    'operator'      => 'Budi',
                ],
            ];
        }
        // ---------------------------------------------------------------------

        try {
            // Koneksi ke database pusat HANYA JIKA bukan dummy
            $this->db = Database::connect('central');
            $builder = $this->db->table($this->table);

            $builder->select('
                customer,
                item_code,
                description,
                quantity,
                lotno,
                warehouse,
                back_no,
                standard_pack,
                operator
            ');
            $builder->where('doc_number', $docNumber);

            $query = $builder->get();

            return $query ? $query->getResultArray() : [];
        } catch (\Throwable $e) {
            // Jika koneksi server pusat belum disetting/gagal, kembalikan kosong
            log_message('error', 'Gagal tarik data pusat: ' . $e->getMessage());
            return [];
        }
    }
}

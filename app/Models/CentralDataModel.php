<?php

namespace App\Models;

use Config\Database;

/**
 * Model ini KHUSUS untuk tarik data dari database server pusat SAP B1.
 * Sengaja TIDAK extends CodeIgniter\Model dan TIDAK menyediakan method
 * insert/update/delete — hanya query SELECT read-only ke SQLSRV.
 *
 * Koneksi ke 'sqlsvr' (10.1.70.250 / SBO_NSI_USD_LIVE) baru dibuka
 * saat diperlukan, agar tidak timeout ketika pakai data DUMMY.
 */
class CentralDataModel
{
    protected $db = null;

    /** Buka koneksi ke SQL Server pusat (lazy-load). */
    private function connect(): void
    {
        if ($this->db === null) {
            $this->db = Database::connect('sqlsvr');
        }
    }

    // =========================================================================
    // DATA DUMMY — dipakai saat DocNum / keyword mengandung kata "DUMMY"
    // =========================================================================
    private function isDummy(string $value): bool
    {
        return stripos($value, 'DUMMY') !== false;
    }

    private function dummyCustomers(): array
    {
        return [
            ['CardCode' => 'C001', 'CardName' => 'PT. BENGKEL MAJU',          'ItemCode' => 'ITEM-001-XYZ'],
            ['CardCode' => 'C001', 'CardName' => 'PT. BENGKEL MAJU',          'ItemCode' => 'ITEM-002-XYZ'],
            ['CardCode' => 'C002', 'CardName' => 'PT. AISAN NASMOCO INDUSTRI', 'ItemCode' => 'ITEM-003-XYZ'],
        ];
    }

    private function dummyItems(string $docNumber): array
    {
        return [
            [
                'DocNum'          => $docNumber,
                'DocDate'         => date('Y-m-d'),
                'ItemCode'        => 'ITEM-001-XYZ',
                'Dscription'      => 'Plastik Cover Mesin Kanan',
                'Quantity'        => '1500',
                'U_MIS_LotNo'     => 'LOT-24-001',
                'WhsCode'         => 'WH-A1',
                'U_MIS_BackNo'    => 'BN-99',
                'U_MIS_StdPacking'=> '500',
                'U_MIS_Operator'  => '890',
            ],
            [
                'DocNum'          => $docNumber,
                'DocDate'         => date('Y-m-d'),
                'ItemCode'        => 'ITEM-002-XYZ',
                'Dscription'      => 'Plastik Cover Mesin Kiri',
                'Quantity'        => '750',
                'U_MIS_LotNo'     => 'LOT-24-002',
                'WhsCode'         => 'WH-A2',
                'U_MIS_BackNo'    => 'BN-98',
                'U_MIS_StdPacking'=> '500',
                'U_MIS_Operator'  => '890',
            ],
        ];
    }
    // =========================================================================

    /**
     * Ambil semua customer (CardCode + CardName) beserta ItemCode-nya
     * dari tabel ODLN/DLN1/OCRD di SAP B1.
     *
     * Dipakai untuk:
     *  1. Mengisi dropdown Customer saat halaman load.
     *  2. Menjadi lookup map: ItemCode → [CardCode, CardName] di JavaScript.
     *
     * Query asli dari pusat (tidak diubah logikanya, hanya pakai raw SQL):
     *   SELECT T0.ItemCode, T1.CardCode, T2.CardName
     *   FROM DLN1 T0
     *   INNER JOIN ODLN T1 ON T0.DocEntry = T1.DocEntry
     *   INNER JOIN OCRD T2 ON T0.BaseCard = T2.CardCode
     *   WHERE T2.ValidFor = 'Y'
     *   GROUP BY T1.CardCode, T2.CardName, T0.ItemCode
     *   ORDER BY T0.ItemCode
     *
     * @return array  [ ['CardCode'=>..., 'CardName'=>..., 'ItemCode'=>...], ... ]
     */
    public function getCustomers(): array
    {
        try {
            $this->connect();

            $sql = "
                SELECT T0.[ItemCode], T1.[CardCode], T2.[CardName]
                FROM DLN1 T0
                INNER JOIN ODLN T1 ON T0.[DocEntry] = T1.[DocEntry]
                INNER JOIN OCRD T2 ON T0.[BaseCard]  = T2.[CardCode]
                WHERE T2.[ValidFor] = 'Y'
                GROUP BY T1.[CardCode], T2.[CardName], T0.[ItemCode]
                ORDER BY T0.[ItemCode]
            ";

            $query = $this->db->query($sql);
            return $query ? $query->getResultArray() : [];

        } catch (\Throwable $e) {
            log_message('error', '[CentralDataModel::getCustomers] ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Ambil semua item berdasarkan Doc Number (OIGN) dari SAP B1.
     * Juga menyertakan DocDate untuk auto-fill tanggal produksi.
     *
     * Query asli dari pusat + tambahan T0.DocDate:
     *   SELECT T0.DocNum, T0.DocDate, T1.ItemCode, T1.Dscription,
     *          T1.Quantity, T1.U_MIS_LotNo, T1.WhsCode,
     *          T2.U_MIS_BackNo, T2.U_MIS_StdPacking, T0.U_MIS_Operator
     *   FROM OIGN T0
     *   INNER JOIN IGN1 T1 ON T0.DocEntry = T1.DocEntry
     *   INNER JOIN OITM T2 ON T1.ItemCode = T2.ItemCode
     *   WHERE T0.DocNum = ?
     *
     * @return array  [ ['DocNum'=>..., 'DocDate'=>..., 'ItemCode'=>..., ...], ... ]
     */
    public function getByDocNumber(string $docNumber): array
    {
        // Gunakan data dummy jika input mengandung kata "DUMMY"
        if ($this->isDummy($docNumber)) {
            return $this->dummyItems($docNumber);
        }

        try {
            $this->connect();

            $sql = "
                SELECT
                    T0.[DocNum],
                    T0.[DocDate],
                    T1.[ItemCode],
                    T1.[Dscription],
                    T1.[Quantity],
                    T1.[U_MIS_LotNo],
                    T1.[WhsCode],
                    T2.[U_MIS_BackNo],
                    T2.[U_MIS_StdPacking],
                    T0.[U_MIS_Operator]
                FROM OIGN T0
                INNER JOIN IGN1 T1 ON T0.[DocEntry] = T1.[DocEntry]
                INNER JOIN OITM T2 ON T1.[ItemCode]  = T2.[ItemCode]
                WHERE T0.[DocNum] = ?
            ";

            $query = $this->db->query($sql, [(int) $docNumber]);
            return $query ? $query->getResultArray() : [];

        } catch (\Throwable $e) {
            log_message('error', '[CentralDataModel::getByDocNumber] ' . $e->getMessage());
            return [];
        }
    }
}

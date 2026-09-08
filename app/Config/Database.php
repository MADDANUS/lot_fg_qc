<?php

namespace Config;

use CodeIgniter\Database\Config;

/**
 * Database Configuration
 *
 * Ada 2 grup koneksi:
 * - "default" : database aplikasi lokal (tempat simpan hasil input form print QR)
 * - "central" : database server pusat, HANYA dipakai untuk SELECT (tarik data by Doc Number).
 *               Jangan pernah panggil insert/update/delete lewat koneksi ini.
 */
class Database extends Config
{
    /**
     * Direktori yang berisi folder Migrations dan Seeds.
     * Wajib ada di CI4 v4.6+ — dipakai oleh Seeder dan Migration runner.
     */
    public string $filesPath = APPPATH . 'Database' . DIRECTORY_SEPARATOR;

    public string $defaultGroup = 'default';

    /**
     * Database aplikasi (lokal)
     */
    public array $default = [
        'DSN'          => '',
        'hostname'     => 'localhost',
        'username'     => 'root',
        'password'     => '',
        'database'     => 'qrcode_label',
        'DBDriver'     => 'MySQLi',
        'DBPrefix'     => '',
        'pConnect'     => false,
        'DBDebug'      => true,
        'charset'      => 'utf8mb4',
        'DBCollat'     => 'utf8mb4_general_ci',
        'swapPre'      => '',
        'encrypt'      => false,
        'compress'     => false,
        'strictOn'     => false,
        'failover'     => [],
        'port'         => 3306,
        'numberNative' => false,
    ];

    /**
     * Database server pusat SAP Business One — READ ONLY.
     * Koneksi ke 10.1.70.250 hanya untuk SELECT (tarik data by Doc Number & Customer).
     * JANGAN PERNAH panggil insert/update/delete lewat koneksi ini.
     */
    public array $sqlsvr = [
        'DSN'          => '',
        'hostname'     => '10.1.70.250',
        'username'     => 'sa',
        'password'     => '',
        'database'     => 'SBO_NSI_USD_LIVE',
        'DBDriver'     => 'SQLSRV',
        'DBPrefix'     => '',
        'pConnect'     => false,
        'DBDebug'      => false,   // false agar error koneksi tidak crash app
        'charset'      => 'utf8',
        'DBCollat'     => '',
        'swapPre'      => '',
        'encrypt'      => false,
        'compress'     => false,
        'strictOn'     => false,
        'failover'     => [],
        'port'         => 1433,
        'numberNative' => false,
    ];

    public array $tests = [
        'DSN'         => '',
        'hostname'    => '127.0.0.1',
        'username'    => '',
        'password'    => '',
        'database'    => ':memory:',
        'DBDriver'    => 'SQLite3',
        'DBPrefix'    => 'db_',
        'pConnect'    => false,
        'DBDebug'     => true,
        'charset'     => 'utf8',
        'DBCollat'    => '',
        'swapPre'     => '',
        'encrypt'     => false,
        'compress'    => false,
        'strictOn'    => false,
        'failover'    => [],
        'port'        => 3306,
        'foreignKeys' => true,
        'busyTimeout' => 1000,
    ];

    public function __construct()
    {
        parent::__construct();

        // Konfigurasi otomatis override dari .env lewat parent::__construct(),
        // jadi cukup isi env(database.central.*) di file .env — lihat .env.example
    }
}

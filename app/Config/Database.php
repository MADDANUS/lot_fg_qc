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
     * Database server pusat — READ ONLY.
     * Idealnya user MySQL di sini memang cuma dikasih hak akses SELECT di sisi server-nya,
     * ini lapisan pertahanan tambahan di kode, bukan pengganti pembatasan hak akses di DB.
     */
    public array $central = [
        'DSN'          => '',
        'hostname'     => 'localhost',
        'username'     => 'user_readonly',
        'password'     => '',
        'database'     => 'nama_db_pusat',
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

<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MasterShiftSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['shift_name' => 'Shift 1'],
            ['shift_name' => 'Shift 2'],
        ];

        $this->db->table('master_shift')->insertBatch($data);
    }
}

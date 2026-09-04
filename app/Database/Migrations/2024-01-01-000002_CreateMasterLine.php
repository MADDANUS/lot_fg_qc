<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMasterLine extends Migration
{
    public function up()
    {
        // ID Line di rancangan aslinya berupa kode huruf (CG, CH, EQ, dst) yang diinput manual,
        // bukan angka auto-increment — makanya dibuat VARCHAR dan jadi primary key.
        $this->forge->addField([
            'id' => [
                'type'       => 'VARCHAR',
                'constraint' => 5,
            ],
            'line_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('master_line');
    }

    public function down()
    {
        $this->forge->dropTable('master_line');
    }
}

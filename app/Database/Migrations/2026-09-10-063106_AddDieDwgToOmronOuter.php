<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDieDwgToOmronOuter extends Migration
{
    public function up()
    {
        $this->forge->addColumn('omron_outer_labels', [
            'die_no' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'dwg_no' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('omron_outer_labels', ['die_no', 'dwg_no']);
    }
}


<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMitsubaLabelsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'doc_number'      => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'item_code'       => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'description'     => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'quantity'        => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
            'lotno'           => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'machine'         => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'operator'        => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'is_printed'      => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
            'created_at'      => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('mitsuba_labels', true);
    }

    public function down()
    {
        $this->forge->dropTable('mitsuba_labels', true);
    }
}

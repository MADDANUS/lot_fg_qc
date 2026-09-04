<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePrintLabelHeader extends Migration
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
            'doc_number' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'customer' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'product_name' => [
                'type'       => 'ENUM',
                'constraint' => ['IJP', 'BS'],
            ],

            // salah satu dari dua field ini yang dipakai, tergantung date_mode
            'date_mode' => [
                'type'       => 'ENUM',
                'constraint' => ['production_date', 'job_order'],
            ],
            'production_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'job_order' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
            ],

            'shift_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],

            // salah satu dari dua kombinasi ini yang dipakai, tergantung line_mode
            'line_mode' => [
                'type'       => 'ENUM',
                'constraint' => ['line', 'mold_cavity'],
            ],
            'line_id' => [
                'type'       => 'VARCHAR',
                'constraint' => 5,
                'null'       => true,
            ],
            'mold_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'cavity_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],

            'from_series' => [
                'type'       => 'VARCHAR',
                'constraint' => 4,
            ],
            'remark' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'user_initial' => [
                'type'       => 'VARCHAR',
                'constraint' => 3,
            ],

            'lot_guarantee' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 0,
            ],
            'lot_sa' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 0,
            ],
            'flag_4m' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 0,
            ],

            'size_mode' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
            ],

            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('doc_number');
        $this->forge->createTable('print_label_header');
    }

    public function down()
    {
        $this->forge->dropTable('print_label_header');
    }
}

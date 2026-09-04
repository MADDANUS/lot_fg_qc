<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Tambah kolom ref_no (kode unik 16 char per lot) dan lot_no (kombinasi) ke tabel print_label_items.
 * Satu item di grid bisa menghasilkan beberapa baris (1 baris = 1 lot = 1 pasang label).
 */
class AddRefNoToPrintLabelItems extends Migration
{
    public function up()
    {
        $fields = [
            // Kode unik 16 karakter UPPERCASE random, di-generate saat print — 1 per lot
            'ref_no' => [
                'type'       => 'VARCHAR',
                'constraint' => 16,
                'null'       => true,
                'after'      => 'operator',
            ],
            // Lot No kombinasi: 015 + YYMD/YYMDD + ShiftID + LineID/MoldCavityID + FromSeries
            'lot_no_combined' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
                'null'       => true,
                'after'      => 'ref_no',
            ],
            // Nomor lot ke-berapa dari item ini (1, 2, 3, dst)
            'lot_sequence' => [
                'type'       => 'TINYINT',
                'constraint' => 3,
                'unsigned'   => true,
                'default'    => 1,
                'after'      => 'lot_no_combined',
            ],
            // Qty per lot (= standard_pack, kecuali lot terakhir jika ada sisa)
            'lot_qty' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
                'after'      => 'lot_sequence',
            ],
        ];

        $this->forge->addColumn('print_label_items', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('print_label_items', ['ref_no', 'lot_no_combined', 'lot_sequence', 'lot_qty']);
    }
}

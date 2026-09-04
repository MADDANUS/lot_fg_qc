<?php

namespace App\Models;

use CodeIgniter\Model;

class PrintLabelItemModel extends Model
{
    protected $table            = 'print_label_items';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $allowedFields = [
        'header_id',
        'item_code',
        'description',
        'quantity',
        'lotno',
        'warehouse',
        'back_no',
        'standard_pack',
        'operator',
        // Kolom lot (ditambah via migration 000007)
        'ref_no',           // 16 char random UPPERCASE per lot
        'lot_no_combined',  // kombinasi: 015+YYMD+ShiftID+LineID+FromSeries
        'lot_sequence',     // nomor urut lot (1, 2, 3, ...)
        'lot_qty',          // qty per lot (= standard_pack, kecuali lot terakhir)
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}

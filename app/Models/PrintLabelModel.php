<?php

namespace App\Models;

use CodeIgniter\Model;

class PrintLabelModel extends Model
{
    protected $table            = 'print_label_header';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $allowedFields = [
        'doc_number',
        'customer',
        'product_name',
        'date_mode',
        'production_date',
        'job_order',
        'shift_id',
        'line_mode',
        'line_id',
        'mold_id',
        'cavity_id',
        'from_series',
        'remark',
        'user_initial',
        'lot_guarantee',
        'lot_sa',
        'flag_4m',
        'size_mode',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'doc_number'   => 'required|max_length[50]',
        'product_name' => 'required|in_list[IJP,BS]',
        'date_mode'    => 'required|in_list[production_date,job_order]',
        'line_mode'    => 'required|in_list[line,mold_cavity]',
        'from_series'  => 'required|max_length[4]',
        'user_initial' => 'required|max_length[3]',
    ];
}

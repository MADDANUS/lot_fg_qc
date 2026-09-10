<?php

namespace App\Models;

use CodeIgniter\Model;

class OmronInnerModel extends Model
{
    protected $table            = 'omron_inner_labels';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $allowedFields = [
        'doc_number',
        'doc_date',
        'item_code',
        'description',
        'quantity',
        'standard_pack',
        'lotno',
        'whs_code',
        'back_no',
        'operator',
        'production_date',
        'cavity',
        'shift',
        'machine',
        'notification',
        'user_initial',
        'job_order',
        'shift_id',
        'remark',
        'is_printed',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = '';

    protected $validationRules = [
        'doc_number'   => 'required|max_length[50]',
        'item_code'    => 'required|max_length[50]',
        'user_initial' => 'required|max_length[10]',
    ];
}

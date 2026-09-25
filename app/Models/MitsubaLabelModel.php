<?php

namespace App\Models;

use CodeIgniter\Model;

class MitsubaLabelModel extends Model
{
    protected $table            = 'mitsuba_labels';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    
    protected $allowedFields    = [
        'doc_number',
        'doc_date',
        'ref_no',
        'item_code',
        'description',
        'quantity',
        'standard_pack',
        'lotno',
        'whs_code',
        'back_no',
        'machine',
        'operator',
        'production_date',
        'notification',
        'weight',
        'user_initial',
        'job_order',
        'shift_id',
        'cavity',
        'shift',
        'remark',
        'customer',
        'lot_no_combined',
        'flag_4m',
        'is_printed',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = '';
    protected $deletedField  = '';
}

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
        'item_code',
        'description',
        'quantity',
        'lotno',
        'machine',
        'operator',
        'is_printed',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = '';
    protected $deletedField  = '';
}

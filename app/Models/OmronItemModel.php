<?php

namespace App\Models;

use CodeIgniter\Model;

class OmronItemModel extends Model
{
    protected $table            = 'omron_items';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $allowedFields = [
        'item_code',
        'description',
    ];
}

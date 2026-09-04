<?php

namespace App\Models;

use CodeIgniter\Model;

class CavityModel extends Model
{
    protected $table            = 'master_cavity';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['cavity_name'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'cavity_name' => 'required|max_length[50]',
    ];
}

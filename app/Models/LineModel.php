<?php

namespace App\Models;

use CodeIgniter\Model;

class LineModel extends Model
{
    protected $table            = 'master_line';
    protected $primaryKey       = 'id';
    // ID Line diinput manual (kode huruf, misal "CG"), bukan angka auto-increment
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $allowedFields    = ['id', 'line_name'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'id'        => 'required|max_length[5]',
        'line_name' => 'required|max_length[50]',
    ];
}

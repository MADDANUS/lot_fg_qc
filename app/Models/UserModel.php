<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'username', 'password', 'full_name', 'role', 'is_active',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'username'  => 'required|min_length[2]|max_length[50]|is_unique[users.username,id,{id}]',
        'full_name' => 'required|max_length[100]',
        'role'      => 'required|in_list[admin,user]',
    ];

    protected $validationMessages = [
        'username' => [
            'is_unique' => 'Username sudah digunakan.',
        ],
    ];

    /**
     * Verify login credentials
     */
    public function verifyLogin(string $username, string $password): array|false
    {
        $user = $this->where('username', $username)
                     ->where('is_active', 1)
                     ->first();

        if (! $user) {
            return false;
        }

        if (! password_verify($password, $user['password'])) {
            return false;
        }

        return $user;
    }
}

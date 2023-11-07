<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    // Nama Tabel
    protected $table        = 'user';
    protected $primaryKey   = 'user_id';
    protected $allowedFields = ['firstname', 'lastname', 'email', 'username', 'password'];

    // public function getUsers()
    // {
    //    $this->table('user')
    //    ->join('role','user.role_id = role.role_id');
    //    return $this->get()->getResultArray()
    // }
}

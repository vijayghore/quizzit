<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'email', 'password', 'google_id', 'github_id', 'picture'];

    // protected $validationMessages = [];
    // protected $skipValidation     = false;
}

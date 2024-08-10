<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentModel extends Model
{
    protected $table = 'student';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'email', 'password', 'google_id', 'github_id', 'picture'];

    // protected $validationMessages = [];
    // protected $skipValidation     = false;
}

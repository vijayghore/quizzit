<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentModel extends Model
{
    protected $table = 'student';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'email', 'password', 'google_id', 'picture'];

    protected $validationRules    = [
        'name' => 'required|max_length[100]',
        'email' => 'required|valid_email|is_unique[student.email]',
        'password' => 'required|min_length[8]',
    ];
    
    protected $validationMessages = [
        'name' => [
            'required' => 'Name is required.',
            'max_length' => 'Name must be less than 100 characters.',
        ],
        'email' => [
            'is_unique' => 'This email is already registered.',
            'valid_email' => 'Please enter a valid email address.',
            'required' => 'Email is required.',
        ],
        'password' => [
            'required' => 'Password is required.',
            'min_length' => 'Password must be at least 8 characters.',
        ],
       
       
    ];



    // protected $validationMessages = [];
    // protected $skipValidation     = false;
}

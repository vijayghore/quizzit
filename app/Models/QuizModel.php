<?php

namespace App\Models;

use CodeIgniter\Model;

class QuizModel extends Model
{
    protected $table = 'quiz';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'unique_id',
        'name',
        'subject_id',
        'total_questions',
        'marks_per_question',
        'created_by',
        'created_at',
        'status',
    ];

    // If you want to automatically manage created_at and updated_at timestamps:
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField = '';

    // Optional: Define validation rules
    protected $validationRules = [
        'unique_id'  => 'required|max_length[255]',
        'name'       => 'max_length[255]',
        'subject_id' => 'required|integer',
        'created_by' => 'required|integer',
        'status'     => 'in_list[active,inactive]',
    ];

    // Optional: Define validation messages
    protected $validationMessages = [
        'subject_id' => [
            'required' => 'Subject ID is required',
            'integer'  => 'Subject ID must be an integer',
        ],
        'created_by' => [
            'required' => 'Created By is required',
            'integer'  => 'Created By must be an integer',
        ],
        'status'     => [
            'in_list' => 'Status must be one of the following: active, inactive',
        ],
    ];

    // Optional: Define the data format for timestamps
    protected $dateFormat = 'datetime'; // Use 'datetime' or 'int' (for UNIX timestamps)
}

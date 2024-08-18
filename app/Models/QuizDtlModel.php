<?php

namespace App\Models;

use CodeIgniter\Model;

class QuizDtlModel extends Model
{
    protected $table = 'quiz_dtl';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'quiz_id',
        'question_id',
    ];

    // Optional: Automatically handle created_at and updated_at timestamps
    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Optional: Define validation rules
    protected $validationRules = [
        'quiz_id'      => 'required|integer',
        'question_id'  => 'required|integer',
    ];

    // Optional: Define validation messages
    protected $validationMessages = [
        'quiz_id' => [
            'required' => 'Quiz ID is required',
            'integer'  => 'Quiz ID must be an integer',
        ],
        'question_id' => [
            'required' => 'Question ID is required',
            'integer'  => 'Question ID must be an integer',
        ],
    ];

    // Optional: Define the data format for timestamps
    protected $dateFormat = 'datetime'; // Use 'datetime' or 'int' (for UNIX timestamps)
}

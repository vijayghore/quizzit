<?php

namespace App\Models;

use CodeIgniter\Model;

class QuestionsModel extends Model
{
    protected $table            = 'questions';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'subject_id',
        'description',
        'option_1',
        'option_2',
        'option_3',
        'option_4',
        'correct_answer',
        'created_at',
        'created_by',
        'status',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'subject_id' => 'required|integer',
        'description' => 'required',
        'option_1' => 'required|max_length[100]',
        'option_2' => 'required|max_length[100]',
        'option_3' => 'required|max_length[100]',
        'option_4' => 'required|max_length[100]',
        'correct_answer' => 'required|integer',
        'created_by' => 'required|integer',
        'status' => 'required|in_list[inactive,active]',
    ];
    protected $validationMessages = [
        'subject_id' => [
            'required' => 'Subject ID is required',
            'integer' => 'Subject ID must be an integer',
        ],
        'description' => [
            'required' => 'Description is required',
        ],
        'option_1' => [
            'required' => 'Option 1 is required',
            'max_length' => 'Option 1 must be less than 100 characters',
        ],
        'option_2' => [
            'required' => 'Option 2 is required',
            'max_length' => 'Option 2 must be less than 100 characters',
        ],
        'option_3' => [
            'required' => 'Option 3 is required',
            'max_length' => 'Option 3 must be less than 100 characters',
        ],
        'option_4' => [
            'required' => 'Option 4 is required',
            'max_length' => 'Option 4 must be less than 100 characters',
        ],
        'correct_answer' => [
            'required' => 'Correct answer is required',
            'integer' => 'Correct answer must be an integer',
        ],
        'created_by' => [
            'required' => 'Created by is required',
            'integer' => 'Created by must be an integer',
        ],
        'status' => [
            'required' => 'Status is required',
            'in_list' => 'Status must be either inactive or active',
        ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}

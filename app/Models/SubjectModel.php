<?php

namespace App\Models;

use CodeIgniter\Model;

class SubjectModel extends Model
{
    protected $table = 'subjects';
    protected $primaryKey = 'id';
    protected $allowedFields = ['description', 'created_by', 'created_at', 'status'];
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $skipValidation     = false;

    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = '';
    protected $deletedField  = '';

    // Validation rules
    protected $validationRules = [
        'description' => 'required|is_unique[subjects.description]',
        'created_by' => 'permit_empty|integer',
        'status' => 'in_list[active,inactive]'
    ];

    protected $validationMessages = [];

    // Callbacks
    protected $beforeInsert = ['setCreatedAt'];

    protected function setCreatedAt(array $data)
    {
        if (!isset($data['data']['created_at'])) {
            $data['data']['created_at'] = date('Y-m-d H:i:s');
        }

        return $data;
    }
}

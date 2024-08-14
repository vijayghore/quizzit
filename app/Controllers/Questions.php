<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SubjectModel;
use App\Models\QuestionsModel;

class Questions extends BaseController
{
    public function index()
    {
        //
    }

    public function addQuestion()
    {
        $data['title'] = 'Quizzit | Add New Question';

        // get all active subjects
        $subjects = new SubjectModel();
        $subjects->where('status', 'active');
        $subjects->orderBy('description', 'asc');
        $data['subjects'] = $subjects->findAll();

        return view('questions/addQuestion', $data);
    }

    public function saveQuestion()
    {
        $model = new QuestionsModel();

        $data = [
            'subject_id'    => $this->request->getPost('subject_id'),
            'description'   => $this->request->getPost('description'),
            'option_1'      => $this->request->getPost('option_1'),
            'option_2'      => $this->request->getPost('option_2'),
            'option_3'      => $this->request->getPost('option_3'),
            'option_4'      => $this->request->getPost('option_4'),
            'correct_answer' => $this->request->getPost('correct_answer'),
            'created_by'    => session()->get('id'),
            'created_at'    => date('Y-m-d H:i:s'),
            'status'    => 'inactive',
        ];

        if ($model->save($data)) {
            return redirect()->to('/add-question')->with('success', 'Your question has been added successfully');
        } else {
            return redirect()->back()->with('error', $model->errors());
        }
    }
}

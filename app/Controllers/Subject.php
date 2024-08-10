<?php

namespace App\Controllers;

use App\Models\SubjectModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Subject extends BaseController
{
    public function index()
    {
        //
    }

    public function addSubject(){
        return view('subjects/addSubject');
    }

    public function saveSubject()
    {
        $subjectModel = new SubjectModel();

        $data = [
            'description' => $this->request->getPost('description'),
            'created_by' => $this->request->getPost('created_by'),
            'status' => 'inactive',
        ];


        // check if the subject exists in the database
        $subject = $subjectModel->where('description', $data['description'])->first();

        // if the subject exists, return an error message
        if ($subject) {
            return redirect()->back()->with('errors', 'Subject already exists');
        }

        // save the subject
        if ($subjectModel->save($data)) {
            return redirect()->to('/dashboard');
        } else {
            return redirect()->back()->with('errors', $subjectModel->errors());
        }
    }


}

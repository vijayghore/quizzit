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

    public function addSubject()
    {
        $data['title'] = 'Quizzit | Add Subject';

        // get all the subjects from the database where status is active
        $subjectModel = new SubjectModel();
        $subjectModel->where('status', 'active');
        $subjectModel->orderBy('description', 'asc');
        $data['subjects'] = $subjectModel->findAll();

        // pass the subjects to the view
        return view('subjects/addSubject', $data);
    }

    public function saveSubject()
    {
        $subjectModel = new SubjectModel();

        // id variable from the session
        $session = session();
        $id = $session->get('id');

        $data = [
            'description' => $this->request->getPost('description'),
            'created_by' => $id,
            'status' => 'inactive',
        ];

        // check if the subject exists in the database
        $subject = $subjectModel->where('description', $data['description'])->first();

        // if the subject exists, return an error message
        if ($subject) {
            return redirect()->back()->with('error', 'Subject already exists');
        }

        // save the subject
        if ($subjectModel->save($data)) {
            return redirect()->to('/add-subject')->with('success', 'Your subject has been added successfully');
        } else {
            return redirect()->back()->with('error', $subjectModel->errors());
        }
    }
}

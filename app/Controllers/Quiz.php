<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\QuestionsModel;
use App\Models\QuizDtlModel;
use App\Models\QuizModel;
use App\Models\SubjectModel;
use \Exception;

class Quiz extends BaseController
{
    public function index()
    {
        //
    }

    public function createQuiz()
    {
        $data['title'] = 'Quizzit | Create New Quiz';

        // get all active subjects
        $subjects = new SubjectModel();
        $subjects->where('status', 'active');
        $subjects->orderBy('description', 'asc');
        $data['subjects'] = $subjects->findAll();

        return view('quiz/createQuiz', $data);
    }

    public function saveQuiz()
    {
        // Get all the form inputs
        $data = [
            'unique_id' => uniqid(rand(1000, 9999)),
            'name' => $this->request->getPost('name'),
            'subject_id' => $this->request->getPost('subject_id'),
            'total_questions' => $this->request->getPost('total_questions'),
            'marks_per_question' => $this->request->getPost('marks_per_question'),
            'created_by' => session()->get('id'),
            'status' => 'active',
        ];

        // Validate the form inputs
        $validation = \Config\Services::validation();
        $validation->setRules([
            'unique_id' => 'is_unique[quiz.unique_id]',
            'subject_id' => 'required|integer',
            'total_questions' => 'required|integer',
            'marks_per_question' => 'required|integer',
        ]);

        if ($validation->withRequest($this->request)->run() === false) {
            // Validation failed
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Start the transaction
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            // Save the quiz record
            $model = new QuizModel();
            if (!$model->save($data)) {
                // print last query
                throw new Exception('Failed to create quiz');
            }

            // Get the last inserted quiz ID
            $quizID = $model->getInsertID();

            // Get random records from the questions table with the subject_id
            $questionsModel = new QuestionsModel();
            $questions = $questionsModel
                ->where('subject_id', $data['subject_id'])
                ->where('status', 'active')
                ->orderBy('RAND()')
                ->findAll($data['total_questions']); // Get the number of questions specified by the user

            if (empty($questions)) {
                throw new Exception('No questions found for the selected subject');
            }

            // Save the questions to the quiz_dtl table with random sequences
            $quizDtlModel = new QuizDtlModel();
            foreach ($questions as $i => $question) {
                $quizDtlData = [
                    'quiz_id' => $quizID,
                    'question_id' => $question['id'],
                ];

                if (!$quizDtlModel->save($quizDtlData)) {
                    throw new Exception('Failed to create quiz details');
                }
            }

            // Commit the transaction if everything is successful
            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new Exception('Transaction failed');
            }

            return redirect()->to('/create-quiz')->with('success', 'Your quiz has been created successfully');
        } catch (Exception $e) {
            // Rollback the transaction in case of any error
            $db->transRollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}

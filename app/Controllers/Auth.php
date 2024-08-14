<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Controllers\Email;
use Google_Client;
use Google_Service_Oauth2;

class Auth extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }

    public function register()
    {
        $session = session();
        if ($session->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }

        return view('auth/register');
    }

    public function store()
    {
        $usersModel = new UsersModel();

        // Validate input
        $validation = \Config\Services::validation();
        $validation->setRules($usersModel->validationRules);

        if ($validation->withRequest($this->request)->run() === false) {
            return view('auth/register', ['validation' => $validation]);
        }

        // Save student
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ];

        $session = session();
        if ($usersModel->save($data)) {
            $session->setFlashdata('success', 'Successful Registration');

            $mailObj = [
                'recipient' => $data['email'],
                'subject' => 'Welcome to Quizzit App',
                'message' => "Dear {$data['name']},<br>
                Welcome to Quizzit, the ultimate quiz platform! We're thrilled to have you on board.<br>
                Get ready to challenge your knowledge, explore new topics, and have fun along the way.<br>
                To get started, simply log in to your account and start exploring our vast library of quizzes.<br>
                Happy quizzing!<br>
                Best regards,<br>
                The Quizzit Team<br>"
            ];

            // Send email
            $emailController = new Email();
            $emailController->sendEmail($mailObj);

            return redirect()->to('/login');
        } else {
            // Handle failure
            $errors = $usersModel->errors();
            $session->setFlashdata('error', $errors);
            return redirect()->back()->withInput();
        }

        return redirect()->to('/login');
    }

    public function login()
    {
        $session = session();
        if ($session->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }
        return view('auth/login', ['title' => 'Login | Quizzit']);
    }

    public function authenticate()
    {
        $usersModel = new UsersModel();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $student = $usersModel->where('email', $email)->first();

        if ($student && password_verify($password, $student['password'])) {
            // Set session data
            session()->set([
                'id' => $student['id'],
                'name' => $student['name'],
                'email' => $student['email'],
                'isLoggedIn' => true
            ]);
            return redirect()->to('/dashboard')->with('success', 'Signed in successfully');
        } else {
            return redirect()->to('/login')->with('error', 'Invalid login credentials');
        }
    }

    public function logout()
    {
        // Clear session data
        
        // Also, clear any OAuth tokens or stored credentials if applicable
        // For example:
        // $client = new \Google_Client();
        // $client->revokeToken(); // This method revokes the token if the token is still valid
        
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Logged out successfully');
    }


    public function dashboard()
    {
        return view('dashboard/dashboard');
    }
}

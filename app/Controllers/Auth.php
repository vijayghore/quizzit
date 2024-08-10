<?php

namespace App\Controllers;

use App\Models\StudentModel;
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
        $studentModel = new StudentModel();

        // Validate input
        $validation = \Config\Services::validation();
        $validation->setRules($studentModel->validationRules);

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
        if ($studentModel->save($data)) {
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
            $errors = $studentModel->errors();
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
        $studentModel = new StudentModel();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $student = $studentModel->where('email', $email)->first();

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

    //function used for the auth2 google login
    public function google()
    {
        $client = new \Google_Client();
        $client->setClientId(env('googleClientID'));
        $client->setClientSecret(env('googleClientSecret'));
        $client->setRedirectUri(env('googleRedirectURI'));
        $client->addScope('email');
        $client->addScope('profile');
        // $client->setAccessType('offline'); // Request offline access
        // $client->setPrompt('consent'); // Force consent screen

        $authUrl = $client->createAuthUrl();
        return redirect()->to($authUrl);
    }

    // auth2 callback funtion
    public function googleCallback()
    {
        $client = new Google_Client();
        $client->setClientId(env('googleClientID'));
        $client->setClientSecret(env('googleClientSecret'));
        $client->setRedirectUri(env('googleRedirectURI'));

        $code = $this->request->getVar('code');
        if (!$code) {
            return redirect()->to($client->createAuthUrl());
        }

        try {
            $token = $client->fetchAccessTokenWithAuthCode($code);

            $client->setAccessToken($token['access_token']);
            
          
            $googleService = new Google_Service_Oauth2($client);
            $googleAccountInfo = $googleService->userinfo->get();



            $email = $googleAccountInfo->email;
            $name = $googleAccountInfo->name;
            $googleId = $googleAccountInfo->id;
            $picture = $googleAccountInfo->picture;

            $studentModel = new StudentModel();
            $student = $studentModel->where('email', $email)->orWhere('google_id', $googleId)->first();

            if (!$student) {

                $saved = $studentModel->save([
                    'name' => $name,
                    'email' => $email,
                    'google_id' => $googleId, 
                    'picture' => $picture,
                ]);
                
                if (!$saved) {
                    // If save fails, handle the error
                    // You can log the error or return an error message
                    log_message('error', 'Failed to save student record: ' . json_encode($studentModel->errors()));
                    return redirect()->back()->with('error', 'Failed to save user information. Please try again.');
                }

                $student = $studentModel->where('email', $email)->first();

                $mailObj = [
                    'recipient' => $student['email'],
                    'subject' => 'Welcome to Quizzit App',
                    'message' => "Dear {$student['name']},<br><br>
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
            }

            session()->set([
                'id' => $student['id'],
                'name' => $student['name'],
                'email' => $student['email'],
                'isLoggedIn' => true
            ]);

            return redirect()->to('/dashboard')->with('success', 'Signed in successfully');
        } catch (\Exception $e) {
            // Log the error or handle it appropriately
            return redirect()->to('/login')->with('error', 'Google authentication failed');
        }
    }
}

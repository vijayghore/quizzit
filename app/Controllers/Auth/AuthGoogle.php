<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\StudentModel;
use App\Controllers\Email;
use Google_Client;
use Google_Service_Oauth2;

class AuthGoogle extends BaseController
{
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

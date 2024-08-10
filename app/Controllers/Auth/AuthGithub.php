<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\StudentModel;
use App\Controllers\Email;
use League\OAuth2\Client\Provider\Github;

class AuthGithub extends BaseController
{
    public function github()
    {
        // Initialize the GitHub provider with the necessary credentials
        $provider = new Github([
            'clientId'     => env('githubClientID'),
            'clientSecret' => env('githubClientSecret'),
            'redirectUri'  => env('githubRedirectURI'),
        ]);

        // Define the scopes you need (e.g., email)
        $scopes = ['user:email'];

        // Get the authorization URL with scopes and prompt parameter
        $authorizationUrl = $provider->getAuthorizationUrl([
            'scope' => $scopes,
        ]);
        session()->set('oauth2state', $provider->getState());

        return redirect()->to($authorizationUrl);
    }

    public function githubCallback()
    {
        // Initialize the GitHub provider
        $provider = new Github([
            'clientId'     => env('githubClientID'),
            'clientSecret' => env('githubClientSecret'),
            'redirectUri'  => env('githubRedirectURI'),
        ]);

        // Validate the OAuth2 state
        $state = $this->request->getVar('state');
        if (empty($state) || ($state !== session()->get('oauth2state'))) {
            session()->remove('oauth2state');
            return redirect()->to('/login')->with('error', 'Invalid state. Please try again.');
        }

        try {
            // Get an access token using the authorization code grant
            $token = $provider->getAccessToken('authorization_code', [
                'code' => $this->request->getVar('code')
            ]);

            // Get the user details from GitHub
            $user = $provider->getResourceOwner($token);
            $userData = $user->toArray();

            // Check if user data was returned
            if (empty($userData)) {
                log_message('error', 'GitHub OAuth error: No user data returned.');
                return redirect()->to('/login')->with('error', 'GitHub authentication failed. No user data returned.');
            }

            // Extract user information, handling potential null values
            $githubId = $userData['id'] ?? null;
            $name = $userData['name'] ?? $userData['login'] ?? 'Unknown User';
            $email = $userData['email'] ?? null;
            $avatar = $userData['avatar_url'] ?? null;

            if (is_null($githubId)) {
                log_message('error', 'GitHub OAuth error: Missing GitHub ID.');
                return redirect()->to('/login')->with('error', 'GitHub authentication failed. Missing GitHub ID.');
            }

            // Check if the user already exists in the database
            $studentModel = new StudentModel();
            $student = $studentModel->where('email', $email)->orWhere('github_id', $githubId)->first();

            if (!$student) {
                // Save the new user to the database
                $saveData = [
                    'name' => $name,
                    'email' => $email,
                    'github_id' => $githubId,
                    'picture' => $avatar,
                ];

                if (!$studentModel->save($saveData)) {
                    // Log errors if save failed
                    log_message('error', 'Failed to save student record: ' . json_encode($studentModel->errors()));
                    return redirect()->to('/login')->with('error', 'Failed to save user information. Please try again.');
                }

                // Retrieve the newly created user
                $student = $studentModel->where('email', $email)->first();

                // Prepare the welcome email
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

                // Send the welcome email
                $emailController = new Email();
                $emailController->sendEmail($mailObj);
            }

            // Set the session variables
            session()->set([
                'id' => $student['id'],
                'name' => $student['name'],
                'email' => $student['email'],
                'isLoggedIn' => true
            ]);

            // Redirect to the dashboard with a success message
            return redirect()->to('/dashboard')->with('success', 'Signed in successfully');
        } catch (\Exception $e) {
            log_message('error', 'GitHub OAuth error: ' . $e->getMessage());
            return redirect()->to('/login')->with('error', 'GitHub authentication failed');
        }
    }
}

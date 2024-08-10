<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\EmailLogModel;

class Email extends BaseController
{
    public function index()
    {
        //
    }

    public function sendEmail($mailObj)
    {
        $email = \Config\Services::email();
        $emailLogModel = new EmailLogModel();

        $email->setTo($mailObj['recipient']);
        $email->setSubject($mailObj['subject']);
        $email->setMessage($mailObj['message']);

         $logData = [
            'recipient' => $mailObj['recipient'],
            'subject' => $mailObj['subject'],
            'message' => $mailObj['message'],
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        if ($email->send()) {
            $logData['status'] = 'Sent';
            $logData['error_message'] = null;
        } else {
            $logData['status'] = 'Failed';
            $logData['error_message'] = $email->printDebugger(['headers']);
        }

        $emailLogModel->insert($logData);

        return;
    }
}

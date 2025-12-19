<?php

namespace App\Jobs;

use App\Models\Queue\EmailQueueModel;

class SendMailJobs
{
    public function execute(string $jobId)
    {
        $emailModel = new EmailQueueModel();
        $job = $emailModel->where('id', $jobId)->first();

        if (!$job) {
            logFile(
                'error',
                'No pending job available',
                [
                    'message' => "No pending job available"
                ],
                'SendEmailJob::execute'
            );
            return false;
        }

        $email = \Config\Services::email();

        $email->initialize([
            'mailType' => 'html',
            'charset'  => 'utf-8',
            'protocol' => 'smtp'
        ]);

        $email->setFrom('no-reply@schlemmer.co.id', 'Schlemmer Employee Management System Application');
        $email->setTo($job->to_email);
        $email->setSubject($job->subject);
        $email->setMessage($job->body);

        if ($email->send()) {
            $emailModel->updateJobStatus($jobId, 'sent');
            return true;
        } else {
            $emailModel->updateJobStatus($jobId, 'failed');
            $emailModel->update($jobId, ['reason' => $email->printDebugger()]);
            log_message('error', 'Gagal mengirim email: ' . $email->printDebugger());
        }
    }
}

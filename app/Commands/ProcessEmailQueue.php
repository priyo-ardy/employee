<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use App\Models\Queue\EmailQueueModel;
use App\Jobs\SendEmailJob;
use App\Jobs\SendMailJobs;
use CodeIgniter\CLI\CLI;
use Config\Email;



class ProcessEmailQueue extends BaseCommand
{
    protected $group = 'queue';
    protected $name = "queue:email";
    protected $description = "Processing queue pending email";

    public function run(array $params)
    {
        $emailModel = new EmailQueueModel();
        $pendingJobs = $emailModel->getPendingJobs();

        foreach ($pendingJobs as $job) {
            $sendEmailJob = new SendMailJobs();

            if ($sendEmailJob->execute($job->id)) {
                log_message('info', "Success Memproses job ID: {$job->id}");
                CLI::write("Memproses job ID: {$job->id}\n");
            }

            log_message('error', "Memproses job ID: {$job->id}");
            CLI::write("Failed Memproses job ID: {$job->id}\n");
        }

        log_message('info', "Proses email queue selesai dengan total " . count($pendingJobs) . " data.");
        CLI::write("Proses email queue selesai dengan total " . count($pendingJobs) . " data.\n");
    }
}

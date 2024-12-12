<?php

namespace YunusAsuroglu\BulkEmailler\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use YunusAsuroglu\BulkEmailler\Mail\BulkMailer;

class SendBulkEmail extends Command
{
    protected $signature = 'bulk-email:send
                             {emails : Comma separated email addresses}
                             {subject : Subject of the email}
                             {data : Content of the email}';
    public function handle()
{
    $emails = explode(',', $this->argument('emails'));
    $subject = $this->argument('subject');
    $data = $this->argument('data');
    
    $sentEmails = [];
    $failedEmails = [];
    
    foreach ($emails as $email) {
        try {
            Mail::to(trim($email))->send(new BulkMailer($subject, $data));
            $sentEmails[] = $email; // Başarıyla gönderilen e-posta
        } catch (\Exception $e) {
            $failedEmails[] = ['email' => $email, 'error' => $e->getMessage()]; // Error Message
        }
    }
    
    if (count($sentEmails) > 0) {
        $this->info('Successfully sent email addresses:');
        foreach ($sentEmails as $sentEmail) {
            $this->info($sentEmail);
        }
    }
    
    if (count($failedEmails) > 0) {
        $this->error('Email addresses that are not sent:');
        foreach ($failedEmails as $failedEmail) {
            $this->error($failedEmail['email'] . ' - Hata: ' . $failedEmail['error']);
        }
    } else {
        $this->info("All emails sent successfully!");
    }
}
}


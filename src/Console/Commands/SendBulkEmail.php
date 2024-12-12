<?php

namespace YunusAsuroglu\BulkEmailler\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use yunusasuroglu\BulkEmailer\Mail\BulkMailer;

class SendBulkEmail extends Command
{
    protected $signature = 'bulk-email:send 
                            {email : Alıcı e-posta adresi} 
                            {subject : E-posta konusu} 
                            {message : E-posta içeriği}';

    protected $description = 'Belirli bir e-posta adresine toplu e-posta gönderir.';

    public function handle()
    {
        $email = $this->argument('email');
        $subject = $this->argument('subject');
        $message = $this->argument('message');

        Mail::to($email)->send(new BulkMailer($subject, $message));

        $this->info("E-posta {$email} adresine başarıyla gönderildi!");
    }
}


<?php

namespace YunusAsuroglu\BulkEmailler;

use Illuminate\Support\Facades\Mail;
use YunusAsuroglu\BulkEmailler\Mail\BulkMailer;

class BulkEmailer
{
    public static function sendBulkMail($emails, $subject, $view, $data)
    {
        foreach ($emails as $email) {
            Mail::to($email)->send(new BulkMailer($subject, $data, $view));
        }
    }
}

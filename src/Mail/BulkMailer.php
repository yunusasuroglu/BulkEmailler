<?php

namespace yunusasuroglu\BulkEmailler\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BulkMailer extends Mailable
{
    use Queueable, SerializesModels;

    public $subjectLine;
    public $messageBody;

    public function __construct($subject, $body)
    {
        $this->subjectLine = $subject;
        $this->messageBody = $body;
    }

    public function build()
    {
        return $this->subject($this->subjectLine)->view('bulk-emailer::emails.bulkmailer');
    }
}

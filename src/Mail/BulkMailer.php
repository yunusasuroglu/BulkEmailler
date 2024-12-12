<?php

namespace YunusAsuroglu\BulkEmailler\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BulkMailer extends Mailable
{
    use Queueable, SerializesModels;
    
    public $subjectLine;
    public $data;
    public $view;
    
    // Yapıcı fonksiyonu, view parametresi ile birlikte alacak
    public function __construct($subject, $data, $view = 'emails.bulkmailer')
    {
        $this->subjectLine = $subject;
        $this->data = $data;
        $this->view = $view;
    }
    
    public function build()
    {
        return $this->subject($this->data['subject'])->view($this->view)->with('data', $this->data);
    }
}

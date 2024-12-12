<?php

use Illuminate\Support\Facades\Route;
use yunusasuroglu\BulkEmailler\Mail\BulkMailer;
use Illuminate\Support\Facades\Mail;

Route::get('/send-test-email', function () {
    Mail::to('test@example.com')->send(new BulkMailer('Test Konu', 'Bu bir test e-postasıdır.'));
    return 'Test e-postası gönderildi!';
});

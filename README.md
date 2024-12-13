# Bulk Emailler

Bulk Emails is a package developed for Laravel that makes sending bulk emails easy. With this package, you can send emails to multiple recipients quickly and securely. The package is customizable and easily integrated with a simple structure.

### Version: 1.0

This first version offers basic bulk email sending functionality.

## Package Installation

Run the following Composer command to include your package in the project:

```bash
composer require yunusasuroglu/bulk-emailler
```
## View Create

Create a blade for Email Template, you can also do this manually:

```bash
mkdir -p resources/views/emails
touch resources/views/emails/bulk-email.blade.php
```

## Controller Create

This part is given as an example, you can shape it according to your own project:

```bash
php artisan make:controller BulkEmailController
```

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use YunusAsuroglu\BulkEmailler\Facades\BulkEmailer;

class BulkEmailController extends Controller
{
    public function BulkMail()
    {
        return view('email-form');
    }
    public function sendBulkMail(Request $request)
    {        
        $testEmails = "example@example.com, test@test.com";
        $testSubject = "Test Mailler";
        $testMessage = "content";
        $testItem = "item";
        $testItem2 = "item2";
        // You can add as much as you want here, it's up to you. 
        $emails = collect(explode(',', $testEmails))->map(fn($email) => trim($email))->filter(fn($email) => filter_var($email, FILTER_VALIDATE_EMAIL))->unique()->values()->all();

        if (empty($emails)) {
            return response()->json(['error' => 'Invalid email format.'], 400);
        }
        $subject = $testSubject;
        $view = 'emails.bulkmailer';
        $data = [
            'message' => $testMessage,
            'testItem' => $testItem,
            'subject' => $testSubject,
            'testItem2' => $testItem2,
        ];
    
        try {
            BulkEmailer::sendBulkMail($emails, $subject, $view, $data);
            return response()->json(['message' => 'Emails sent successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500); // Error Message View
        }
    }
}
```

## web.php

Add Routes :

```php
Route::get('/bulk-email', [BulkEmailController::class, 'BulkMail'])->name('bulk.email');
Route::post('/send-bulk-email', [BulkEmailController::class, 'sendBulkMail'])->name('send.bulk.email');
```

## Example Form View

This place is completely yours, you can customize it as you wish:

```php
<form method="POST" action="{{ route('send.bulk.email') }}">
    @csrf
    <div class="form-group">
        <label class="form-label text-primary">Emails</label>
        <input type="text" name="emails" class="form-control">
    </div>
    <div class="form-group">
        <label class="form-label text-primary">Mail Subject</label>
        <input type="text" name="subject" class="form-control">
    </div>
    <div class="form-group mt-3">
        <label class="form-label text-primary" for="exampleFormControlTextarea1">Mail Content</label>
        <textarea name="content" class="form-control" rows="5"></textarea>
    </div>
    <button id="submitButton" type="submit" class="btn mt-3 btn-primary">Send</button>
</form>
```

## Example Mail View

This place is completely yours, you can customize it as you wish:

```php
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject ?? 'Mail Subject' }}</title>
</head>
<body>

<div class="email-container">
    <p>{{ $data['message'] ?? 'Mail Subject' }}</p>
</div>

</body>
</html>
```
## Requirements

- PHP 8.0 or above
- Composer

## Contribute

1. Fork this project.
2. Create a new feature branch (`feature/feature-adi`).
3. Commit your changes (`git commit -m 'New feature added'`).
4. Push the branch to master (`git push origin feature/feature-adi`).
5. Open a Pull Request.

## Licence
This project is licensed under the [MIT License](LICENSE).

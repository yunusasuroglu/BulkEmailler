# Bulk Emailler

Bulk Emailler, Laravel için geliştirilmiş bir paket olup toplu e-posta gönderimini kolaylaştırır. Bu paket ile birden fazla alıcıya hızlı ve güvenli bir şekilde e-posta gönderebilirsiniz. Paket, basit bir yapı ile özelleştirilebilir ve kolayca entegre edilebilir.

### Sürüm: 1.0

Bu ilk sürüm, temel toplu e-posta gönderim işlevselliğini sunar.

## Paket Yükleme

Paketinizi projeye dahil etmek için aşağıdaki Composer komutunu çalıştırın:

```bash
composer require yunusasuroglu/bulk-emailler
```
## View Oluşturma

E Posta Şablonu için bir blade oluşturun bu işlemi manuel de yapabilirsiniz:

```bash
mkdir -p resources/views/emails
touch resources/views/emails/bulk-email.blade.php
```

## Controller oluşturma

Bu kısım örnek olarak verilmiştir kendi projenize göre şekillendirebilirsiniz :

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
    
    public function sendBulkMail(Request $request)
    {        
        $testEmails = "example@example.com, test@test.com";
        $testSubject = "Test Mailler";
        $testMessage = "content";
        $testItem = "item";
        $emails = collect(explode(',', $testEmails))->map(fn($email) => trim($email))->filter(fn($email) => filter_var($email, FILTER_VALIDATE_EMAIL))->unique()->values()->all();

        if (empty($emails)) {
            return response()->json(['error' => 'Geçersiz e-posta formatı.'], 400);
        }
        $subject = $testSubject;
        $view = 'emails.bulkmailer';
        $data = [
            'message' => $testMessage,
            'testItem' => $testItem,
            'subject' => $testSubject,
        ];
    
        try {
            BulkEmailer::sendBulkMail($emails, $subject, $view, $data);
            return response()->json(['message' => 'E-postalar başarıyla gönderildi!']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500); // Hata mesajını göster
        }
    }
}
```

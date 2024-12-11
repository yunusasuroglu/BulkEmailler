@component('mail::message')
# {{ $subjectLine }}

{!! nl2br(e($messageBody)) !!}

Teşekkürler,  
{{ config('app.name') }}
@endcomponent

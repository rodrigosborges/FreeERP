@component('mail::message')
Solicitação de recuperação de senha

@component('mail::button', ['url' => 'url?token='.$token])
Resetar
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
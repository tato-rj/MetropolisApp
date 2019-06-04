@component('mail::message')

Olá {{$request['name']}}, a sua mensagem foi recebida e entraremos em contato o mais rápido possível.

Até breve,<br>
Equipe {{ config('app.name') }}
@endcomponent

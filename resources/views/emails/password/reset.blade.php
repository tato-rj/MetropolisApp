@component('mail::message')
# Olá

Você está recebendo este email porque nós recebemos um pedido para mudar o password do seu cadastro.

@component('mail::button', ['url' => $link])
Quero mudar o meu password
@endcomponent

Até breve,<br>
Equipe {{ config('app.name') }}
@endcomponent

@component('mail::message')
# Olá {{$user->first_name}}

<p>Você realizou com sucesso a assinatura do <span class="text-uppercase text-{{$user->membership->plan->color}}"><strong>{{$user->membership->plan->displayName}}</strong></span>. O seu plano se renovará automaticamente ao final de cada ciclo. Você pode cancelar essa renovação a qualquer momento, basta acessar o seu Painel de Controle/Pagamentos.</p>
<p>O seu plano oferece <strong>
	{{$user->membership->plan->bonus_limit}} 
	{{trans_choice('words.horas', $user->membership->plan->bonus_limit)}} 
	{{trans_choice('words.gratuitas', $user->membership->plan->bonus_limit)}}</strong> por 
	{{$user->membership->plan->cycle()}} na 
	{{$user->membership->plan->bonusSpacesText()}}, aproveite!</p>

@component('mail::button', ['url' => route('client.events.index')])
Clique aqui para ver a sua agenda
@endcomponent

Até breve,<br>
Equipe {{ config('app.name') }}
@endcomponent

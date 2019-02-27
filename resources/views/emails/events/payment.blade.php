@component('mail::message')
# Olá {{$event->creator->first_name}}

A sua reserva foi iniciada com sucesso. Para completar o pedido basta clicar no botão abaixo para efetuar o pagamento.

<div style="margin: 40px 0;">
	@component('mail::button', ['url' => $url])
	Pagar agora
	@endcomponent
</div>

<p>Se encontrar problemas com o botão acima, pode usar este link <a href="{{$url}}">{{$url}}</a></p>

@component('mail::panel')
<ul>
	<li><strong>Espaço:</strong> {{$event->space->name}}</li>
	<li><strong>Data:</strong> {{toFormattedDateStringPt($event->starts_at)}}</li>
	<li><strong>Hora da chegada:</strong> {{$event->starts_at->hour}}:00</li>
	<li><strong>Hora da saída:</strong> {{$event->ends_at->hour}}:00</li>
	<li><strong>Número de participantes:</strong> {{$event->participants}}</li>
</ul>
@endcomponent

Até breve,<br>
Equipe {{ config('app.name') }}
@endcomponent

@component('mail::message')
# Olá {{$event->creator->first_name}}

O seu pedido foi realizado com sucesso. A reserva será confirmada assim que o pagamento estiver completo. Aqui vão os detalhes do evento:
@component('mail::panel')
<ul>
	<li><strong>Espaço:</strong> {{$event->space->name}}</li>
	<li><strong>Data:</strong> {{toFormattedDateStringPt($event->starts_at)}}</li>
	<li><strong>Hora da chegada:</strong> {{$event->starts_at->hour}}:00</li>
	<li><strong>Hora da saída:</strong> {{$event->ends_at->hour}}:00</li>
	<li><strong>Número de participantes:</strong> {{$event->participants}}</li>
</ul>
@endcomponent

<div style="margin: 40px 0;">
	<p style="text-align: center;">Gostaria de obter mais informações?</p>

	@component('mail::button', ['url' => route('client.events.index')])
	Clique aqui para ver mais detalhes
	@endcomponent
</div>

Até breve,<br>
Equipe {{ config('app.name') }}
@endcomponent

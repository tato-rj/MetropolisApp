@component('mail::message')
# Olá

Este é um convite de {{$event->creator->name}} para o seguinte evento:

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
	<p style="text-align: center;">Gostaria de conhecer melhor o espaço Metropolis?</p>

	@component('mail::button', ['url' => route('welcome')])
	Visite o nosso site
	@endcomponent
</div>

Até breve,<br>
Equipe {{ config('app.name') }}
@endcomponent

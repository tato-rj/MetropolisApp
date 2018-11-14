@component('mail::message')
# Olá

Este é um convite de {{$event->creator->name}} para o seguinte evento:

@component('mail::panel')
<ul>
	<li><strong>Espaço:</strong> {{$event->space->name}}</li>
	<li><strong>Data:</strong> {{$event->starts_at->toFormattedDateString()}}</li>
	<li><strong>Hora da chegada:</strong> {{$event->starts_at->hour}}:00</li>
	<li><strong>Hora da saída:</strong> {{$event->ends_at->hour}}:00</li>
	<li><strong>Número de participantes:</strong> {{$event->participants}}</li>
</ul>
@endcomponent

<div style="margin: 60px 0;">
	<p style="text-align: center;">Gostaria de conhecer melhor o espaço Metropolis?</p>

	@component('mail::button', ['url' => route('welcome')])
	Visite o nosso site
	@endcomponent
</div>

<p>O escritório fica localizado na <strong>{{$event->space->address}}</strong>. Veja abaixo no mapa:</p>
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1064.5986453240255!2d-43.17783590713117!3d-22.905353196891383!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x997f5e338b0669%3A0x1c3cffd7e7138096!2sAv.+Rio+Branco%2C+151+-+Centro%2C+Rio+de+Janeiro+-+RJ%2C+20040-006%2C+Brazil!5e0!3m2!1sen!2sus!4v1540815899031" style="width: 100%; height: 50vh; margin-bottom: 40px" frameborder="0" style="border:0" allowfullscreen></iframe>

<p>Recebeu esse email por engano? <a href="/">Clique aqui</a></p>

Até breve,<br>
Equipe {{ config('app.name') }}
@endcomponent

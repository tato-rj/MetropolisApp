<ul class="list-flat px-3 py-2">
	<li class="mb-2">
		<span class="text-teal mr-1"><strong>Espaço</strong></span>
		<span>{{$event->space->name}}</span>
	</li>

	<li class="mb-2">
		<span class="text-teal mr-1"><strong>Começa</strong></span>
		<span>dia {{$event->starts_at->day}} às {{$event->starts_at->hour}}:00 horas</span>
	</li>

	<li class="mb-2">
		<span class="text-teal mr-1"><strong>Termina</strong></span>
		<span>dia {{$event->ends_at->day}} às {{$event->ends_at->hour}}:00 horas</span>
	</li>

	<li class="mb-2">
		<span class="text-teal mr-1"><strong>Duração</strong></span>
		<span class="mr-1">{{$event->duration}}</span>
		<span class="text-muted text-italic"><small>(o escritório fecha às <u>{{durationToString(office()->day_ends_at)}}</u>)</small></span>
	</li>

	<li class="mb-2">
		<span class="text-teal mr-1"><strong>Status</strong></span>
		<span class="text-green">Ativo</span> <small class="text-muted">(se renovará no final do dia {{auth()->user()->membership->next_payment_at->format('d/m')}})</small>
	</li>
</ul>
<div class="mt-2">
	<p class="m-0 text-muted"><small>Esta reserva faz parte da sua assinatura do</small></p>
	<div class="d-flex align-items-center justify-content-between">
		<div>
			<p class="m-0 text-uppercase"><strong><span class="text-{{$event->plan->color}}">{{$event->plan->displayName}}</span></strong>
			</p>
		</div>
		<div>
			<a href="/" class="btn btn-xs btn-{{$event->plan->color}}"><strong>MAIS DETALHES</strong></a>
		</div>
	</div>
</div>
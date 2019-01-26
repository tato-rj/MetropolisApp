<ul class="list-flat px-3 py-2">
	<li class="mb-2">
		<span class="text-teal mr-1"><strong>Espaço</strong></span>
		<span>{{$event->space->name}}</span>
	</li>

	<li class="mb-2">
		<span class="text-teal mr-1"><strong>Começa</strong></span>
		<span>dia {{$event->starts_at->format('d/m')}} às {{$event->starts_at->hour}}:00 horas</span>
	</li>

	<li class="mb-2">
		<span class="text-teal mr-1"><strong>Termina</strong></span>
		<span>dia {{$event->ends_at->format('d/m')}} às {{$event->ends_at->hour}}:00 horas</span>
	</li>

	<li class="mb-2">
		<span class="text-teal mr-1"><strong>Duração</strong></span>
		<span class="mr-1">{{$event->duration}}</span>
		<span class="text-muted text-italic"><small>(o escritório fecha às <u>{{durationToString(office()->day_ends_at)}}</u>)</small></span>
	</li>

	<li class="mb-2">
		<span class="text-teal mr-1"><strong>Status</strong></span>
		<span class="status-label text-{{$event->statusColor}}">{{$event->statusForUser}}</span>
		
		<small class="text-muted verified-at">
			@if($event->verified_at)
				({{'atualizado no dia ' . $event->verified_at->format('d/m') . ' às ' . $event->verified_at->format('H:i')}})
			@endif
		</small>
	</li>

</ul>

<div class="bg-light py-2 px-3 mb-2">
	<p class="text-muted m-0"><small>Para alterar esse evento, envie um email para <a href="mailto:contato@metropolis.com" class="link-red">contato@metropolis.com</a></small></p>
	<p class="text-muted m-0"><small>O código da reserva é <strong>{{$event->reference}}</strong></small></p>
</div>

<div>
	<p class="m-0 text-muted"><small>Esta reserva faz parte da sua assinatura do</small></p>
	<div class="d-flex align-items-center justify-content-between">
		<div>
			<p class="m-0 text-uppercase"><strong><span class="text-{{$event->plan->color}}">{{$event->plan->displayName}}</span></strong>
			</p>
		</div>
		<div>
			<a href="/planos" class="btn btn-xs btn-{{$event->plan->color}}"><strong>MAIS DETALHES</strong></a>
		</div>
	</div>
</div>

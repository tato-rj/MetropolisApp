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

<div class="mb-3 px-3">
	<p class="m-0 text-muted"><small>Esta reserva faz parte da sua assinatura do</small></p>
	<div class="d-apart align-items-end">
		<div>
			<a class="text-uppercase" href="/planos">
				<strong><span class="text-{{$event->plan->color}}">{{$event->plan->displayName}}</span></strong>
			</a>
		</div>
		<div>
			@if(auth()->user()->membership->isActive())
			<div class="alert-green px-2 py-1"><strong>Ativo</strong></div>
			@elseif(auth()->user()->membership->status == 'Aguardando confirmação')
			<div class="alert-warning px-2 py-1 "><strong>Pendente</strong></div>
			@else
			<div class="alert-danger px-2 py-1"><strong>Cancelado</strong></div>
			@endif
		</div>
	</div>
</div>

<div class="border-top pt-2 text-center">
	@if(auth()->user()->membership->isActive())
		<div class="text-success">
			<small><i class="far fa-calendar-check mr-2"></i><strong>A sua assinatura se renovará ano dia {{auth()->user()->membership->next_payment_at->format('d/m')}}</strong></small>
		</div>
	@elseif(auth()->user()->membership->status == 'Aguardando confirmação')
		<div class="text-warning">
			<small><i class="fas fa-exclamation-circle mr-2"></i><strong>Estamos aguardando a confirmação do seu pedido</strong></small>
		</div>
	@else
		<div class="text-danger">
			<small><i class="far fa-calendar-times mr-2"></i><strong>A sua assinatura foi cancelada e não se renovará</strong></small>
		</div>
	@endif
</div>
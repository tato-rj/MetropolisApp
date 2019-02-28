<ul class="list-flat px-3 py-2">

	<div class="mb-3">
		<p class="m-0 text-muted"><small>Esta reserva faz parte da sua assinatura do</small></p>
		<div>
			<a class="text-uppercase" href="/planos">
				<strong><span class="text-{{$event->plan->color}}">{{$event->plan->displayName}}</span></strong>
			</a>
		</div>
	</div>

	@admin($user_type)
	<li class="mb-2">
		<span class="text-teal mr-1"><strong>Assinante</strong></span>
		<span>{{$event->creator->name}}</span>
	</li>
	<li class="mb-2">
		<span class="text-teal mr-1"><strong>Email</strong></span>
		<span>{{$event->creator->email}}</span>
	</li>
	<li class="mb-2">
		<span class="text-teal mr-1"><strong>Telefone</strong></span>
		<span>{{$event->creator->phone}}</span>
	</li>
	@endadmin

	<li class="mb-2">
		<span class="text-teal mr-1"><strong>Reserva #</strong></span>
		<span>{{$event->reference}}</span>
	</li>

	<li class="mb-2">
		<span class="text-teal mr-1"><strong>Espaço</strong></span>
		<span>{{$event->space->name}}</span>
	</li>

	<li class="mb-2">
		<span class="text-teal mr-1"><strong>Começa</strong></span>
		<span>dia {{$event->starts_at->format('d/m')}} às {{$event->starts_at->format('H:i')}}</span>
	</li>

	<li class="mb-2">
		<span class="text-teal mr-1"><strong>Termina</strong></span>
		<span>dia {{$event->ends_at->format('d/m')}} às {{$event->ends_at->format('H:i')}}</span>
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

	<li class="mb-2">
		<span class="text-teal mr-1"><strong>Renovação automática</strong></span>
		<div class="btn-group">
			<a href="" class="btn-green btn btn-sm">Ligada</a>
			<a href="" class="btn-light text-grey btn btn-sm">Desligada</a>
		</div>
	</li>
</ul>

@user($user_type)
<div class="bg-light py-2 px-3 mb-2">
	<p class="text-muted m-0"><small>Para alterar esse evento, envie um email para <a href="mailto:contato@metropolis.com" class="link-red">contato@metropolis.com</a></small></p>
</div>
@enduser

@if($event->statusForUser != 'Cancelada')

<div class="border-top pt-3 mt-3">
	<div id="request-cancel">
		<div class="d-apart align-items-center">
			@if($event->canBeReturned())
			<p class="text-green mb-0 mr-2"><small>Esta transação está finalizada.</small></p>
			@else
			<p class="mb-0 mr-2"><small>Esta transação ainda não foi finalizada</small></p>
			@endif
			<button class="btn btn-red btn-sm toggle-content" data-parent="#request-cancel">Cancelar assinatura</button>
		</div>
	</div>
	<div id="confirm-cancel" style="display: none;">
		@if($event->canBeCancelled())
		<p class="text-muted mb-2"><small>O pagamento para esse evento <u>não será mais cobrado</u> e a assinatura cancelada.</small></p>
		@elseif($event->canBeReturned())
		<p class="text-muted mb-2"><small>O pagamento para esse evento será <u>estornado</u> e a assinatura cancelada.</small></p>
		@else
		<p class="text-muted mb-2"><small>A assinatura será cancelada, mas o pagamento não pode mais ser estornado. (<a href="#" class="link-red">veja aqui porque</a>)</small></p>
		@endif
		<div class="d-apart align-items-center">
			<p class="text-red mb-0 mr-2"><small><i class="fas fa-exclamation-triangle mr-2"></i>Tem certeza de que deseja continuar?</small></p>
			<div class="d-flex align-items-center">
				<button class="btn btn-secondary btn-sm mr-2 toggle-content" data-parent="#confirm-cancel">Não</button>
				<form method="POST" action="{{route('events.cancel', $event->id)}}">
					@csrf
					<button class="btn btn-red btn-sm show-overlay">Sim</button>
				</form>
			</div>
		</div>
	</div>
</div>

@endif

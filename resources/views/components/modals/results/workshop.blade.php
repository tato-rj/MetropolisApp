<ul class="list-flat px-3 py-2">
	@admin($user_type)
	<li class="mb-2">
		<span class="text-teal mr-1"><strong>Cliente</strong></span>
		<span>{{$reservation->user->name}}</span>
	</li>
	<li class="mb-2">
		<span class="text-teal mr-1"><strong>Email</strong></span>
		<span>{{$reservation->user->email}}</span>
	</li>
	<li class="mb-2">
		<span class="text-teal mr-1"><strong>Telefone</strong></span>
		<span>{{$reservation->user->phone}}</span>
	</li>
	@endadmin

	@if($reservation->reference)
	<li class="mb-2">
		<span class="text-teal mr-1"><strong>Reserva #</strong></span>
		<span>{{$reservation->reference}}</span>
	</li>

	<hr class="my-3">
	@endif

	<li class="mb-2">
		<span class="text-teal mr-1"><strong>Workshop</strong></span>
		<span>{{$reservation->workshop->name}}</span>
	</li>

	<li class="mb-2">
		<span class="text-teal mr-1"><strong>Data</strong></span>
		<span class="date" data-date="{{$reservation->workshop->starts_at->format('Y-m-d')}}"></span>
	</li>

	<li class="mb-2">
		<span class="text-teal mr-1"><strong>Começa às</strong></span>
		<span>{{$reservation->workshop->starts_at->format('H:i')}} horas</span>
	</li>

	<li class="mb-2">
		<span class="text-teal mr-1"><strong>Termina às</strong></span>
		<span>{{$reservation->workshop->ends_at->format('H:i')}} horas</span>
	</li>

	<li>
		<span class="text-teal mr-1"><strong>Status</strong></span>
		
		<span class="status-label text-{{$reservation->statusColor}}">{{$reservation->status}}</span>
		
		<small class="text-muted verified-at">
			@if($reservation->verified_at)
				({{'atualizado no dia ' . $reservation->verified_at->format('d/m') . ' às ' . $reservation->verified_at->format('H:i')}})
			@endif
		</small>
	</li>
</ul>

@if($reservation->statusForUser != 'Cancelada')

<div class="border-top pt-3 mt-3">
	<div id="request-cancel">
		<div class="d-apart align-items-center">
			@if($reservation->canBeReturned())
			<p class="text-green mb-0 mr-2"><small>Esta transação está finalizada.</small></p>
			@else
			<p class="mb-0 mr-2"><small>Esta transação ainda não foi finalizada</small></p>
			@endif
			<button class="btn btn-red btn-sm toggle-content" data-parent="#request-cancel">Cancelar esta reserva</button>
		</div>
	</div>
	<div id="confirm-cancel" style="display: none;">
		@if($reservation->canBeCancelled())
		<p class="text-muted mb-2"><small>O pagamento para essa reserva <u>não será mais cobrado</u>.</small></p>
		@elseif($reservation->canBeReturned())
			@if($reservation->workshop->fee && $reservation->reference != 'GRATUITA')
			<p class="text-muted mb-2"><small>O pagamento para essa reserva será <u>estornado</u>.</small></p>
			@endif
		@else
		<p class="text-muted mb-2"><small>A reserva será cancelada, mas o pagamento não pode mais ser estornado. (<a href="#" class="link-red">veja aqui porque</a>)</small></p>
		@endif
		<div class="d-apart align-items-center">
			<p class="text-red mb-0 mr-2"><small><i class="fas fa-exclamation-triangle mr-2"></i>Tem certeza de que deseja continuar?</small></p>
			<div class="d-flex align-items-center">
				<button class="btn btn-secondary btn-sm mr-2 toggle-content" data-parent="#confirm-cancel">Não</button>
				<form method="POST" action="{{route('workshops.cancel', ['workshop' => $reservation->workshop->slug, 'reservation_id' => $reservation->id])}}">
					@csrf
					<button class="btn btn-red btn-sm show-overlay">Sim</button>
				</form>
			</div>
		</div>
	</div>
</div>

@endif

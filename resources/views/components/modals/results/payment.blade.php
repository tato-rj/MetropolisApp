<ul class="list-flat px-3 py-2">

	<li class="mb-2">
		<span class="text-teal mr-1"><strong>Nome</strong></span>
		<span>{{$payment->user->name}}</span>
	</li>

	<li class="mb-2">
		<span class="text-teal mr-1"><strong>Email</strong></span>
		<span>{{$payment->user->email}}</span>
	</li>

	<li class="mb-2">
		<span class="text-teal mr-1"><strong>Data</strong></span>
		<span class="date" data-date="{{$payment->created_at->format('Y-m-d')}}"></span>
	</li>

	<li class="mb-2">
		<span class="text-teal mr-1"><strong>Pagamento #</strong></span>
		<span>{{$payment->reservation->reference}}</span>
	</li>

	<li class="mb-2">
		<span class="text-teal mr-1"><strong>Valor</strong></span>
		<span>{{feeToString($payment->reservation->fee)}}</span>
	</li>

	<li class="mb-2">
		<span class="text-teal mr-1"><strong>Status</strong></span>
		<span class="status-label text-{{$payment->reservation->statusColor}}">{{$payment->reservation->status}}</span>
		
		<small class="text-muted verified-at">
			@if($payment->reservation->verified_at)
				({{'atualizado no dia ' . $payment->reservation->verified_at->format('d/m') . ' às ' . $payment->reservation->verified_at->format('H:i')}})
			@endif
		</small>
	</li>
</ul>

@admin(auth()->guard('admin')->check())
@if($payment->reservation->canBeCancelled())
	<div class="border-top pt-3 mt-3">
		<div id="confirm-cancel" style="display: none;">
			<div class="d-apart align-items-center">
				<p class="text-red mb-0 mr-2"><small><i class="fas fa-exclamation-triangle mr-2"></i>Tem certeza de que deseja cancelar esta transação?</small></p>
				<div class="d-flex align-items-center">
					<button class="btn btn-secondary btn-sm mr-2 toggle-content" data-parent="#confirm-cancel">Não</button>
					<form method="POST" action="{{route('admin.payments.cancel', ['transaction_code' => $payment->reservation->transaction_code])}}">
						@csrf
						<button class="btn btn-red btn-sm show-overlay">Sim</button>
					</form>
				</div>
			</div>
		</div>
		<div id="request-cancel">
			<div class="d-apart align-items-center">
				<p class="text-muted mb-0 mr-2"><small>Esta transação ainda não foi confirmada.</small></p>
				<button class="btn btn-red btn-sm toggle-content" data-parent="#request-cancel">Cancelar pagamento</button>
			</div>
		</div>
	</div>
@elseif($payment->reservation->canBeReturned())
	<div class="border-top pt-3 mt-3">
		<div id="confirm-cancel" style="display: none;">
			<div class="d-apart align-items-center">
				<p class="text-red mb-0 mr-2"><small><i class="fas fa-exclamation-triangle mr-2"></i>Tem certeza de que deseja estornar este pagamento?</small></p>
				<div class="d-flex align-items-center">
					<button class="btn btn-secondary btn-sm mr-2 toggle-content" data-parent="#confirm-cancel">Não</button>
					<form method="POST" action="{{route('admin.payments.refund', ['transaction_code' => $payment->reservation->transaction_code])}}">
						@csrf
						<button type="submit" class="btn btn-red btn-sm show-overlay">Sim</button>
					</form>
				</div>
			</div>
		</div>
		<div id="request-cancel">
			<div class="d-apart align-items-center">
				<p class="text-muted mb-0 mr-2"><small>Esta transação já foi finalizada.</small></p>
				<button class="btn btn-red btn-sm toggle-content" data-parent="#request-cancel">Estornar o pagamento</button>
			</div>
		</div>
	</div>
@endif
@endadmin

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
		<span class="status-label text-{{$payment->reservation->statusColor}}">{{$payment->reservation->statusForUser}}</span>
		
		<small class="text-muted verified-at">
			@if($payment->reservation->verified_at)
				({{'atualizado no dia ' . $payment->reservation->verified_at->format('d/m') . ' às ' . $payment->reservation->verified_at->format('H:i')}})
			@endif
		</small>
	</li>
</ul>

@admin(auth()->guard('admin')->check())
@if($payment->reservation->canBeCancelled())
	<div class="border-top pt-3 mt-3 d-apart align-items-center">
		<p class="text-muted mb-0 mr-2"><small>Este pagamento ainda não foi confirmado, você pode cancelar a cobrança a qualquer momento.</small></p>
		<form method="POST" action="{{route('admin.payments.cancel', ['transaction_code' => $payment->reservation->transaction_code])}}">
			@csrf
			<button type="submit" class="btn btn-red btn-sm">Cancelar pagamento</button>
		</form>
	</div>
@elseif($payment->reservation->canBeReturned())
	<div class="border-top pt-3 mt-3 d-apart align-items-center">
		<p class="text-muted mb-0 mr-2"><small>Esta transação já foi finalizada. Deseja estornar o pagamento?</small></p>
		<button class="btn btn-red btn-sm">Estornar o pagamento</button>
	</div>
@endif
@endadmin

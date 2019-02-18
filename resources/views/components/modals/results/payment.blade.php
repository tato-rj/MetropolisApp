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

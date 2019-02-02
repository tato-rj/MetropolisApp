@subscribed
<div class="alert alert-{{auth()->user()->membership->plan->color}} border-0 text-center">
	@if(auth()->user()->membership->isActive())
		<i class="fas fa-check-circle mr-2"></i>
		<strong>{{auth()->user()->membership->plan->displayName}}</strong> | Próxima cobrança será no dia {{toFormattedDateStringPt(auth()->user()->membership->next_payment_at)}}
	@elseif(auth()->user()->membership->status == 'Aguardando confirmação')
		<i class="fas fa-check-circle mr-2"></i>
		<strong>{{auth()->user()->membership->plan->displayName}}</strong> | Aguardando confirmação
	@else
	<i class="fas fa-exclamation-triangle"></i>
		<strong>{{auth()->user()->membership->plan->displayName}}</strong> | Esse plano foi cancelado e <u>não se renovará</u>
	@endif
</div>
@endsubscribed
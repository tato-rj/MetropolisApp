<div class="d-flex flex-wrap mb-3">
	<div class="flex-grow">
		<div class="d-flex">
			<div class="p-2">
				<h5 class="text-teal mb-3">Nome</h5>
				<h5 class="text-teal mb-3">Email</h5>
				<h5 class="text-teal mb-3">Cartão</h5>
				<h5 class="text-teal mb-3">Plano</h5>
			</div>
			<div class="p-2">
				<h5 class="mb-3">{{$user->name}}</h5>

				<h5 class="mb-3">{{$user->email}} <small class="text-green">(verificado no dia {{$user->email_verified_at->format('d/m/Y')}})</small></h5>

				@if($user->hasCard)
				@include('components.form.payment.card-preview', ['user' => auth()->user()])
				@else
				<h5 class="text-muted mb-3"><small><i>Nenhum cartão salvo</i></small></h5>
				@endif

				@if($user->hasPlan)
				<h5 class="text-{{$user->membership->plan->color}} mb-3">{{$user->membership->plan->displayName}} <small class="text-green">(próxima cobrança será no dia {{toFormattedDateStringPt($user->membership->next_payment_at)}})</small></h5>
				@else
				<h5 class="text-muted mb-3"><i>Nenhum plano assinado</i></h5>
				@endif
			</div>
		</div>
	</div>
	<div class="text-right">
		<div class="text-muted">
			Cadastro criado no dia <strong>{{$user->created_at->format('d/m/Y')}}</strong>
		</div>
	</div>
</div>
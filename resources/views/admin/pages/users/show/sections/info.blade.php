<div class="d-flex flex-wrap mb-3">
	<div class="flex-grow">
		<div class="d-flex">
			<div class="p-2">
				<p class="text-teal mb-3">Nome</p>
				<p class="text-teal mb-3">Email</p>
				<p class="text-teal mb-3">Telephone</p>
				<p class="text-teal mb-3">Cartão</p>
				<p class="text-teal mb-3">Plano</p>
			</div>
			<div class="p-2">
				<p class="mb-3">{{$user->name}}</p>

				<p class="mb-3">{{$user->email}} <small class="text-green">(verificado no dia {{$user->email_verified_at->format('d/m/Y')}})</small></p>

				<p class="mb-3">{{$user->phone}}</p>

				@if($user->hasCard)
				<div class="mb-3">
					@include('components.form.payment.card-preview', ['user' => $user])
				</div>
				@else
				<p class="text-muted mb-3"><i>Nenhum cartão salvo</i></p>
				@endif

				@if($user->hasPlan)
				<p class="text-{{$user->membership->plan->color}} mb-3">{{$user->membership->plan->displayName}} <small class="text-green">(próxima cobrança será no dia {{toFormattedDateStringPt($user->membership->next_payment_at)}})</small></p>
				@else
				<p class="text-muted mb-3"><i>Nenhum plano assinado</i></p>
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
<div class="mb-4">
	<div class="bg-light border-top border-teal-light border-1x mb-2">
		<ul class="list-flat p-4" id="review">
			<li class="mb-2">
				<span class="text-teal mr-1"><strong>Espaço</strong></span>
				<span>{{$selectedSpace->name}}</span>
			</li>
			<li class="mb-2">
				<span class="text-teal mr-1"><strong>Data</strong></span>
				<span id="date" data-date="{{request()->date}}"></span>
			</li>
			<li class="mb-2">
				<span class="text-teal mr-1"><strong>Hora de chegada</strong></span>
				<span>{{request()->time}}:00 horas</span>
			</li>
			<li class="mb-2">
				<span class="text-teal mr-1"><strong>Duração</strong></span>
				<span class="mr-1">{{request()->duration == office()->day_length ? 'Dia inteiro' : request()->duration.'h'}}</span>
				<span class="text-muted text-italic"><small>(o escritório fecha às <u>{{durationToString(office()->day_ends_at)}}</u>)</small></span>
			</li>
			<li>
				<span class="text-teal mr-1"><strong>Número de participantes</strong></span>
				<span>{{request()->participants}} {{trans_choice('words.pessoas', request()->participants)}}</span>
			</li>

			@bonus($selectedSpace)
			<li class="mt-2">
				<span class="text-red mr-1">Você tem <strong>{{auth()->user()->bonusesLeft($selectedSpace)}} {{trans_choice('horas', auth()->user()->bonusesLeft($selectedSpace))}}</strong> de bônus para usar nessa reserva!</span>
			</li>
			@endbonus
		</ul>
		<div class="bg-teal text-white d-flex flex-wrap">
			<div class="p-3 flex-grow"><strong>INVESTIMENTO TOTAL</strong></div>
			<div class="d-flex xs-w-100">
				<div class="p-3 bg-teal-dark flex-grow"><strong>
					@bonus($selectedSpace)
					<span class="opacity-6 mr-2" style="text-decoration: line-through;">
						{{feeToString(fromCents($selectedSpace->priceFor(request()->participants, request()->duration, $discount = 0)))}}
					</span>
					{{feeToString(fromCents($selectedSpace->priceFor(request()->participants, request()->duration, $discount = auth()->user()->bonusesLeft($selectedSpace))))}}
					@else
					{{feeToString(fromCents($selectedSpace->priceFor(request()->participants, request()->duration)))}}
					@endbonus
				</strong></div>
			</div>
			<button id="submit" data-target="#form-credit" class="p-3 btn btn-red btn-block font-weight-bold">CONFIRMAR RESERVA</button>
		</div>
	</div>
	<div class="px-2">
		<small>Ao finalizar o pagamento, você concorda com os <a class="link-default" href="#">Termos de uso</a>. Política de Privacidade © Metropolis Rio. Todos os direitos reservados.</small>
	</div>
</div>
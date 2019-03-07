<div class="mb-4">
	<div class="bg-light border-top border-teal-light border-1x mb-2">
		<ul class="list-flat p-4" id="review">
			<li class="mb-2">
				<span class="text-teal mr-1"><strong>Espaço</strong></span>
				<span>{{$form->space->name}}</span>
			</li>
			<li class="mb-2">
				<span class="text-teal mr-1"><strong>Data</strong></span>
				<span class="date-pt" data-date="{{$form->date}}"></span>
			</li>
			<li class="mb-2">
				<span class="text-teal mr-1"><strong>Hora de chegada</strong></span>
				<span>{{$form->time}}</span>
			</li>
			<li class="mb-2">
				<span class="text-teal mr-1"><strong>Duração</strong></span>
				<span class="mr-1">{{$form->duration == office()->day_length ? 'Dia inteiro' : $form->duration.'h'}}</span>
				<span class="text-muted text-italic"><small>(o escritório fecha às <u>{{durationToString(office()->day_ends_at)}}</u>)</small></span>
			</li>
			<li>
				<span class="text-teal mr-1"><strong>Número de participantes</strong></span>
				<span>{{$form->participants}} {{trans_choice('words.pessoas', $form->participants)}}</span>
			</li>

			@bonus($form->space)
			<li class="mt-2">
				<span class="text-red mr-1">Você tem <strong>{{auth()->user()->bonusesLeft($form->space)}} {{trans_choice('horas', auth()->user()->bonusesLeft($form->space))}}</strong> de bônus para usar nessa reserva!</span>
			</li>
			@endbonus
		</ul>

		@include('components.form.payment.agree')

		<div class="bg-teal text-white d-flex flex-wrap">
			<div class="p-3 flex-grow"><strong>INVESTIMENTO TOTAL</strong></div>
			<div class="d-flex xs-w-100">
				<div class="p-3 bg-teal-dark flex-grow"><strong>
					@bonus($form->space)
					<span class="opacity-6 mr-2" style="text-decoration: line-through;">
						{{feeToString($form->space->priceFor($form->participants, $form->duration, $discount = 0))}}
					</span>
					{{feeToString($form->space->priceFor($form->participants, $form->duration, $discount = auth()->user()->bonusesLeft($form->space)))}}
					@else
					{{feeToString($form->space->priceFor($form->participants, $form->duration))}}
					@endbonus
				</strong></div>
			</div>
			<button id="submit" data-target="#form-credit" class="p-3 btn btn-red btn-block font-weight-bold">CONFIRMAR RESERVA</button>
		</div>
	</div>
</div>
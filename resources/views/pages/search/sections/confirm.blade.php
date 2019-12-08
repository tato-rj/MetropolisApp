<div class="mb-5 mt-2">
	<h5 class="text-green text-center">O espaço que você solicitou está disponível!</h5>
	@include('components.animations.success-icon')
</div>
<form id="confirm-purchase" method="GET" action="{{route('client.events.payment')}}">
	<input type="hidden" name="type" value="{{$form->type}}">
	<input type="hidden" name="date" value="{{$form->date}}">
	<input type="hidden" name="time" value="{{$form->time}}">
	<input type="hidden" name="duration" value="{{$form->duration}}">
	<input type="hidden" name="participants" value="{{$form->participants}}">
	<input type="hidden" name="emails">

	<div class="bg-light border-top border-teal-light border-1x mb-4">
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
			@if($form->participants > 1)
			<div class="mt-3 border-top pt-3">
				<p class="mb-2">Quer que enviemos um email de confirmação para os participantes do seu evento?</p>
				<div class="custom-control custom-radio">
				  <input required type="radio" value="true" id="yes" name="send_emails" class="custom-control-input">
				  <label class="custom-control-label" for="yes">Sim</label>
				</div>
				<div class="custom-control custom-radio">
				  <input required type="radio" value="false" id="no" name="send_emails" class="custom-control-input">
				  <label class="custom-control-label" for="no">Não</label>
				</div>
			</div>
			<li class="mt-3" id="emails" style="display: none;">
				<div>
					<div class="icon-input position-relative mb-2">
					<input type="text" placeholder="O seu email será enviado automaticamente" disabled 
						class="form-control border-grey bg-transparent" style="border: none; border-bottom: 1px solid">
						<i class="text-green fas fa-check"></i>
					</div>
					@for($i=2; $i<=$form->participants; $i++)
					<div class="icon-input position-relative mb-2">
					<input type="email" name="emails[]" placeholder="Email do participante {{$i}}" 
						class="form-control border-grey bg-transparent" style="border: none; border-bottom: 1px solid">
						<i class="text-grey opacity-8 fas fa-envelope"></i>
					</div>
					@endfor
				</div>
			</li>
			@endif

			@bonus($form->space)
			<li class="mt-2">
				<span class="text-red mr-1">Você tem <strong>{{auth()->user()->bonusesLeft($form->space)}} {{trans_choice('horas', auth()->user()->bonusesLeft($form->space))}}</strong> de bônus para usar nessa reserva!</span>
			</li>
			@endbonus
			<div class="alert alert-warning mt-3 shadow-sm">
				<i class="fas fa-gift mr-2"></i><strong><u>Promoção de Natal</u></strong> Até o dia 20 de Dezembro, aproveite a nossa promoção e venha conheçer o mais novo espaço de co-working do Centro do Rio. Insira abaixo o coupon <strong>PROMO_NATAL</strong> e marque a sua reserva de forma 100% gratuita!
			</div>
			<li class="mt-2">
				@include('components.form.payment.coupon')
			</li>
		</ul>
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
				<button type="submit" class="btn btn-red h-100 px-4" title="Clique aqui para continuar"><i class="fas fa-lg fa-angle-right"></i></button>
			</div>
		</div>
	</div>
</form>

<div class="">
	<p>Após efetuar o pagamento você receberá um email confirmando a reserva. Nós garantimos o reembolso somente para cancelamentos realizados até 48h antes do horário agendado.</p>
	<p class="mb-5">Se tiver qualquer dúvida <a href="/contato" class="link-blue">fale conosco</a>.</p>
	<p class="m-0 lead text-center">Gostaria de garantir a sua reserva permanente?<br>Veja abaixo os nosso planos de fidelidade.</p>
</div>
@if(auth()->check())
{{-- PAY --}}
@else
{{-- LOGIN --}}
@endif
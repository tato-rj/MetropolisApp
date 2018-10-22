<div class="mb-5 mt-2">
	<h5 class="text-green text-center">O espaço que você solicitou está disponível!</h5>
	<div class="check_mark">
		<div class="sa-icon sa-success animate">
			<span class="sa-line sa-tip animateSuccessTip"></span>
			<span class="sa-line sa-long animateSuccessLong"></span>
			<div class="sa-placeholder"></div>
			<div class="sa-fix"></div>
		</div>
	</div>
</div>
<form method="POST" action="/reservar">
	@csrf
	<div class="bg-light border-top border-teal-light border-1x mb-4">
		<ul class="list-flat p-4" id="review">
			<li class="mb-2">
				<span class="text-teal"><strong>Data</strong></span>
				<span id="date" data-date="{{request()->date}}"></span>
				<input type="hidden" name="date" value="{{request()->date}}">
			</li>
			<li class="mb-2">
				<span class="text-teal"><strong>Espaço</strong></span>
				<span>{{pt(request()->space)}}</span>
				<input type="hidden" name="space" value="{{request()->space}}">
			</li>
			<li class="mb-2">
				<span class="text-teal"><strong>Duração</strong></span>
				<span>{{request()->duration == config('office.day_length') ? 'Dia inteiro' : request()->duration.'h'}}</span>
				<input type="hidden" name="duration" value="{{request()->duration}}">
			</li>
			<li class="mb-2">
				<span class="text-teal"><strong>Hora de chegada</strong></span>
				<span>{{request()->time}}:00 horas</span>
				<input type="hidden" name="time" value="{{request()->time}}">
			</li>
			<li>
				<span class="text-teal"><strong>Número de participantes</strong></span>
				<span>{{request()->participants}} {{trans_choice('words.pessoas', request()->participants)}}</span>
				<input type="hidden" name="participants" value="{{request()->participants}}">
			</li>
			@if(request()->participants > 1)
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
					<input type="text" placeholder="Você receberá um email automaticamente" disabled 
						class="form-control rounded-0 border-grey bg-transparent" style="border: none; border-bottom: 1px solid">
						<i class="text-grey opacity-8 fas fa-envelope"></i>
					</div>
					@for($i=2; $i<=request()->participants; $i++)
					<div class="icon-input position-relative mb-2">
					<input type="email" name="emails[]" placeholder="Participante {{$i}}" 
						class="form-control rounded-0 border-grey bg-transparent" style="border: none; border-bottom: 1px solid">
						<i class="text-grey opacity-8 fas fa-envelope"></i>
					</div>
					@endfor
				</div>
			</li>
			@endif
		</ul>
		<div class="bg-teal text-white d-flex">
			<div class="p-3 flex-grow"><strong>INVESTIMENTO TOTAL</strong></div>
			<div class="p-3 bg-teal-dark"><strong>{{feeTostring(totalCost(request()->space, request()->duration, request()->participants))}}</strong></div>
			<div><button type="submit" class="btn btn-red rounded-0 h-100 px-4" title="Clique aqui para continuar"><i class="fas fa-lg fa-angle-right"></i></button></div>
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
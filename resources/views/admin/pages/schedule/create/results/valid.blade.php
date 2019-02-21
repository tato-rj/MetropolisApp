<div class="row">
	<div class="col-default">
		@if($results->status)
		<div class="mb-5">
			<div class="mb-4">
				@include('components.animations.success-icon')
			</div>
			<h5 class="text-teal text-center">Não há conflitos para reservar esse espaço nesse horário!</h5>
		</div>
		@else
		<div class="mb-4">
			@if($form->space->is_shared)
				@if($results->participantsExceeded)
				<div class="alert alert-red">
					<i class="fas fa-exclamation-triangle mr-2"></i><strong>Atenção!</strong> Este horário já ultrapassou o limite de reservas. 
				</div>
				<div class="pl-4">
					<p class="text-red">Número de reservas excendendo o limite: <strong>{{$results->participantsExceeded}}</strong></p>
					<p>Nós recomendamos resolver os conflitos antes de prosseguir com essa reserva.</p>
				</div>
				@else
				<div class="alert alert-yellow">
					<i class="fas fa-exclamation-triangle mr-2"></i><strong>Atenção!</strong> Esta reserva vai criar um conflito no calendário desse dia. 
				</div>
				<div class="pl-4">
					<p class="text-red">Número de reservas disponíveis nesse horário: <strong>{{$results->participantsLeft}}</strong></p>
					<p>Após criar o evento, lembre-se de verificar a agenda do dia para resolver os conflitos.</p>
				</div>
				@endif
			@else
				<div class="alert alert-yellow">
					<i class="fas fa-exclamation-triangle mr-2"></i><strong>Atenção!</strong> A {{$form->space->name}} está sendo usada nesse intervalo. 
				</div>
				<div class="pl-4">
					<p class="text-red">Você pode confirmar essa reserva mas será responsável por solucionar o problema.</p>
					<p>Após criar o evento, lembre-se de verificar a agenda do dia para resolver os conflitos.</p>
				</div>	
			@endif
		</div>
		@endif
	</div>
	
	<div class="col-default">
	<form method="POST" action="{{route('admin.schedule.store')}}">
		@csrf
		
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
					</li>
					<li>
						<span class="text-teal mr-1"><strong>Número de participantes</strong></span>
						<span>{{$form->participants}} {{trans_choice('words.pessoas', $form->participants)}}</span>
					</li>
					<div class="mt-3 border-top pt-3">
						<p class="mb-2">Quer que enviemos um email de convite para os participantes desse evento?</p>
						<div class="custom-control custom-radio mb-2">
						  <input required data-target="#emails" type="radio" value="true" id="yes_send" name="send_emails" class="custom-control-input">
						  <label class="custom-control-label" for="yes_send">Sim</label>
						</div>
						<div class="custom-control custom-radio mb-2">
						  <input required data-target="#emails" type="radio" value="false" id="no_send" name="send_emails" class="custom-control-input">
						  <label class="custom-control-label" for="no_send">Não</label>
						</div>
					</div>
					<li class="my-3" id="emails" style="display: none;">
						<div>
							@for($i=1; $i<=$form->participants; $i++)
							<div class="icon-input position-relative mb-2">
							<input type="email" name="emails[]" placeholder="Email do participante {{$i}}" 
								class="form-control border-grey bg-transparent" style="border: none; border-bottom: 1px solid">
								<i class="text-grey opacity-8 fas fa-envelope"></i>
							</div>
							@endfor
						</div>
					</li>

					<div class="mt-4">
						<p class="mb-2">Quer enviar a cobrança desse evento para algum usuário?</p>
						<div class="custom-control custom-radio mb-2">
						  <input required data-target="#search-user" type="radio" value="true" id="yes_bill" name="bill_user" class="custom-control-input">
						  <label class="custom-control-label" for="yes_bill">Sim, vou enviar por email a cobrança de <strong>{{feeToString($price)}}</strong></label>
						</div>
						<div class="custom-control custom-radio mb-2">
						  <input required data-target="#search-user" type="radio" value="false" id="no_bill" name="bill_user" class="custom-control-input">
						  <label class="custom-control-label" for="no_bill">Não, estou fazendo essa reserva para o escritório</label>
						</div>
					</div>
					<li class="my-3" id="search-user" style="display: none;">
						<div class="form-group">
							<select class="form-control" name="user_id">
								<option value="" selected>Escolha o usuário</option>
								@foreach($users as $user)
								<option value="{{$user->id}}">{{$user->name}}</option>
								@endforeach
							</select>
						</div>
						<div><small>Nós enviaremos um email para o usuário selecionado com instruções para pagar por essa reserva. Esta só será confirmada <u>após a confirmação do pagamento</u> dessa cobrança.</small></div>
					</li>
				</ul>
				<div class="bg-teal text-white d-flex flex-wrap">
					<div class="p-3 flex-grow"><strong>CONFIRMAR RESERVA</strong></div>
					<div>
						<input type="hidden" name="space_id" value="{{$form->space_id}}">
						<input type="hidden" name="participants" value="{{$form->participants}}">
						<input type="hidden" name="starts_at" value="{{$form->starts_at}}">
						<input type="hidden" name="ends_at" value="{{$form->ends_at}}">
						<button type="submit" class="btn btn-red h-100 px-4 show-overlay" title="Clique aqui para continuar"><i class="fas fa-lg fa-angle-right"></i></button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
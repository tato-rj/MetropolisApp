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
			<div class="alert alert-yellow">
				<i class="fas fa-exclamation-triangle mr-2"></i><strong>Atenção!</strong> Esta reserva vai criar um conflito no calendário desse dia. 
			</div>
			<div class="pl-4">
				<p class="text-red">Número de reservas disponíveis nesse horário: <strong>{{$results->participantsLeft}}</strong></p>
				<p>Após criar o evento, lembre-se de verificar a agenda do dia para resolver os conflitos.</p>
			</div>
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
						<span>{{$space->name}}</span>
					</li>
					<li class="mb-2">
						<span class="text-teal mr-1"><strong>Data</strong></span>
						<span class="date-pt" data-date="{{$request->date}}"></span>
					</li>
					<li class="mb-2">
						<span class="text-teal mr-1"><strong>Hora de chegada</strong></span>
						<span>{{$request->time}}:00 horas</span>
					</li>
					<li class="mb-2">
						<span class="text-teal mr-1"><strong>Duração</strong></span>
						<span class="mr-1">{{$request->duration == office()->day_length ? 'Dia inteiro' : $request->duration.'h'}}</span>
					</li>
					<li>
						<span class="text-teal mr-1"><strong>Número de participantes</strong></span>
						<span>{{$request->participants}} {{trans_choice('words.pessoas', $request->participants)}}</span>
					</li>
					<div class="mt-3 border-top pt-3">
						<p class="mb-2">Quer que enviemos um email de confirmação para os participantes desse evento?</p>
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
							@for($i=1; $i<=$request->participants; $i++)
							<div class="icon-input position-relative mb-2">
							<input type="email" name="emails[]" placeholder="Email do participante {{$i}}" 
								class="form-control border-grey bg-transparent" style="border: none; border-bottom: 1px solid">
								<i class="text-grey opacity-8 fas fa-envelope"></i>
							</div>
							@endfor
						</div>
					</li>
				</ul>
				<div class="bg-teal text-white d-flex flex-wrap">
					<div class="p-3 flex-grow"><strong>CONFIRMAR RESERVA</strong></div>
					<div>
						<input type="hidden" name="space_id" value="{{$request->space_id}}">
						<input type="hidden" name="date" value="{{$request->date}}">
						<input type="hidden" name="duration" value="{{$request->duration}}">
						<input type="hidden" name="participants" value="{{$request->participants}}">
						<input type="hidden" name="time" value="{{$request->time}}">
						<button type="submit" class="btn btn-red h-100 px-4" title="Clique aqui para continuar"><i class="fas fa-lg fa-angle-right"></i></button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
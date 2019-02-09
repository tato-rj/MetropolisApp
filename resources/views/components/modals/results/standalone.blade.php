<ul class="list-flat px-3 py-2">
	@if($event->bonus()->exists())
	<div class="alert alert-green border-0 text-center p-2" role="alert">
		Nós aplicamos <strong>{{$event->bonus->duration}} {{trans_choice('words.horas', $event->bonus->duration)}}</strong> de bônus nessa reserva!
	</div>
	@endif

	<li class="mb-2">
		<span class="text-teal mr-1"><strong>Espaço</strong></span>
		<span>{{$event->space->name}}</span>
	</li>

	<li class="mb-2">
		<span class="text-teal mr-1"><strong>Data</strong></span>
		<span class="date" data-date="{{$event->starts_at->format('Y-m-d')}}"></span>
	</li>

	<li class="mb-2">
		<span class="text-teal mr-1"><strong>Hora de chegada</strong></span>
		<span>{{$event->starts_at->hour}}:00 horas</span>
	</li>

	<li class="mb-2">
		<span class="text-teal mr-1"><strong>Hora da saída</strong></span>
		<span>{{$event->ends_at->hour}}:00 horas</span>
	</li>

	<li class="mb-2">
		<span class="text-teal mr-1"><strong>Duração</strong></span>
		<span class="mr-1">{{$event->duration}}</span>
		<span class="text-muted text-italic"><small>(o escritório fecha às <u>{{durationToString(office()->day_ends_at)}}</u>)</small></span>
	</li>

	<li class="mb-2">
		<span class="text-teal mr-1"><strong>Status</strong></span>
		
		<span class="status-label text-{{$event->statusColor}}">{{$event->statusForUser}}</span>
		
		<small class="text-muted verified-at">
			@if($event->verified_at)
				({{'atualizado no dia ' . $event->verified_at->format('d/m') . ' às ' . $event->verified_at->format('H:i')}})
			@endif
		</small>
	</li>
	
	<li class="mb-3">
		<span class="text-teal mr-1"><strong>Número de participantes</strong></span>
		<span 
			class="cursor-pointer"
			id="participants" 
			data-participants="{{$event->participants}}"
			data-toggle="collapse" href="#emails">
			{{$event->participants}} {{trans_choice('words.pessoas', $event->participants)}} 
			<small class="text-teal"><i class="fas fa-caret-down"></i></small>
		</span>
		<div class="collapse mt-2" id="emails">
			<div class="bg-light px-4 py-3">
				<ul class="list-flat">
					<li><span class="text-muted"><small><i class="fas fa-user mr-2"></i>{{$event->creator->email}}</small></span></li>
					@if($event->emails)
						<div class="mt-3 pt-2 border-top"> 
							@foreach($event->emails as $email)
							<li class="d-flex justify-content-between align-items-baseline">
								<span class="text-muted mr-3"><small>{{$loop->iteration}}</small></span>
								<input class="form-control-plaintext form-control-sm event-email m-0" 
									autocomplete="new-password"
									readonly 
									placeholder="Insira o email aqui..." 
									type="email" 
									value="{{$email}}">
								<span class="ml-3 text-teal edit font-weight-bold cursor-pointer">editar</span>
								<span class="ml-3 text-warning save font-weight-bold cursor-pointer" data-url="{{route('client.events.update.emails', $event->id)}}" style="display: none;">salvar</span>
								<span class="text-teal ml-3 saved" style="display: none;"><i class="fas fa-check-circle"></i></span>
							</li>
							@endforeach
						</div>
					@endif
				</ul>
			</div>
		</div>
	</li>
</ul>

<div class="bg-light py-2 px-3">
	<p class="text-muted m-0"><small>Para alterar esse evento, envie um email para <a href="mailto:contato@metropolis.com" class="link-red">contato@metropolis.com</a></small></p>
	@if($event->reference)
	<p class="text-muted m-0"><small>O código da reserva é <strong>{{$event->reference}}</strong></small></p>
	@endif
</div>

<div class="text-right mt-3">
	<button class="btn btn-red btn-sm">Cancelar esta reserva</button>
</div>

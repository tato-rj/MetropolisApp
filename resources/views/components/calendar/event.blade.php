		<ul class="list-flat px-3 py-2">
			<li class="mb-2">
				<span class="text-teal mr-1"><strong>Espaço</strong></span>
				<span>{{$event->space->name}}</span>
			</li>
			<li class="mb-2">
				<span class="text-teal mr-1"><strong>Data</strong></span>
				<span id="date" data-date="{{$event->starts_at->format('Y-m-d')}}"></span>
			</li>
			<li class="mb-2">
				<span class="text-teal mr-1"><strong>Hora de chegada</strong></span>
				<span>{{$event->starts_at->hour}}:00 horas</span>
			</li>
			<li class="mb-2">
				<span class="text-teal mr-1"><strong>Duração</strong></span>
				<span class="mr-1">{{$event->duration}} {{trans_choice('words.horas', $event->duration)}}</span>
				<span class="text-muted text-italic"><small>(o escritório fecha às <u>{{durationToString(office()->day_ends_at)}}</u>)</small></span>
			</li>
			<li class="mb-2">
				<span class="text-teal mr-1"><strong>Status</strong></span>
				<span class="">Confirmado</span>
			</li>
			<li>
				<span class="text-teal mr-1"><strong>Número de participantes</strong></span>
				<span 
					class="cursor-pointer"
					data-toggle="collapse" href="#emails">
					{{$event->participants}} {{trans_choice('words.pessoas', $event->participants)}} 
					<small class="text-teal"><i class="fas fa-caret-down"></i></small></span>
					<div class="collapse mt-2" id="emails">
						<div class="bg-light px-4 py-3">
							<ul class="list-flat">
								<li class="mb-2"><span class="text-muted"><small><i class="fas fa-user mr-2"></i>{{auth()->user()->email}}</small></span></li>
								@foreach($event->emails as $email)
								<li class="d-flex justify-content-between align-items-baseline">
									<input class="form-control-plaintext form-control-sm event-email m-0" 
										readonly 
										placeholder="Insira o email aqui..." 
										type="email" 
										value="{{$email}}">
									<span class="ml-2 text-warning edit cursor-pointer"><strong>editar</strong></span>
									<span class="ml-2 text-success save cursor-pointer" data-url="{{route('client.events.update.emails', $event->id)}}" style="display: none;"><strong>salvar</strong></span>
								</li>
								@endforeach
							</ul>
						</div>
					</div>
			</li>
		</ul>
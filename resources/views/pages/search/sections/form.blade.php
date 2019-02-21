<div class="mb-4 pb-2 bg-light p-4">
	<form id="search" method="GET" action="{{route('events.search')}}">
		<div class="form-group">
			<label><small><strong>Qual tipo de espaço está procurando?</strong></small></label>
			<select class=" form-control px-1" name="type">
				<option value="workstation" data-target="workstation" {{$form->type == 'workstation' ? 'selected' : null}}>Co-working</option>
				<option value="toquio" data-target="toquio" {{$form->type == 'toquio' ? 'selected' : null}}>Sala de reunião "Tóquio"</option>
				<option value="vale-do-silicio" data-target="vale-do-silicio" {{$form->type == 'vale-do-silicio' ? 'selected' : null}}>Sala de reunião "Vale do Silício"</option>
			</select>
		</div>

		<div class="form-group">
			<label for="space"><small><strong>Para quando gostaria de fazer a reserva?</strong></small></label>
			@include('components.calendar.input')
		</div>
		
		@if($form->duration !== 'day')
		<div class="form-group">
			<label><small><strong>Qual horário deseja marcar?</strong></small></label>
			<select class=" form-control px-1" name="time">
				@for($i = office()->day_starts_at; $i < office()->day_ends_at; $i++)
				<option value="{{$i}}:00" {{$form->time == sprintf('%02d', $i) . ':00' ? 'selected' : null}}>{{$i}}:00h</option>
				@unless($i == office()->day_ends_at -1)
				<option value="{{$i}}:30" {{$form->time == sprintf('%02d', $i) . ':30' ? 'selected' : null}}>{{$i}}:30h</option>
				@endunless
				@endfor
			</select>
		</div>
		@endif
		<div class="form-group">
			<label><small><strong>Por quanto tempo precisará desse espaço?</strong></small></label>
			<select class=" form-control px-1" name="duration">
				<option value="1" {{$form->duration == 1 ? 'selected' : null}}>1 hora</option>
				<option value="2" {{$form->duration == 2 ? 'selected' : null}}>2 horas</option>
				<option value="4" {{$form->duration == 4 ? 'selected' : null}}>4 horas</option>
				<option value="6" {{$form->duration == 6 ? 'selected' : null}}>6 horas</option>
				<option value="{{office()->day_length}}" {{$form->duration == office()->day_length ? 'selected' : null}}>Dia inteiro</option>
			</select>
		</div>
		<div class="form-group">
			<label><small><strong>Essa reserva é para quantas pessoas?</strong></small></label>
			@foreach($spaces as $space)
			<select 
				name="{{$form->space->id == $space->id ? 'participants' : null}}" 
				id="select-participants-{{$space->nicknameSlug}}" 
				class="participants form-control px-1 "
				style="{{$form->space->id != $space->id ? 'display: none' : null}}">
				@for($i = 1; $i <= $space->capacity; $i++)
				<option value="{{$i}}" {{$form->participants == $i ? 'selected' : null}}>{{$i .' '. trans_choice('words.pessoas', $i)}}</option>
				@endfor
			</select>
			@endforeach

		</div>
	</form>
</div>
<div>
	<button class="btn btn-block btn-red" name="search"><strong>Pesquisar</strong></button>
</div>

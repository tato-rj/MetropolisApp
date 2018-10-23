<div class="mb-4 pb-2 bg-light p-4">
	<form id="search" method="GET" action="/agendar">
		<input type="hidden" name="date" value="{{request()->date ?? now()->format('Y-m-d')}}">
		<div class="form-group">
			<label for="space"><small><strong>Para quando gostaria de fazer a reserva?</strong></small></label>
			@include('components.calendar.input')
		</div>

		<div class="form-group">
			<label><small><strong>Qual tipo de espaço está procurando?</strong></small></label>
			<select class="cursor-pointer form-control px-1" name="space">
				<option value="co-working" data-target="co-working" {{request()->space == 'co-working' ? 'selected' : null}}>Co-working</option>
				<option value="conference" data-target="conference" {{request()->space == 'conference' ? 'selected' : null}}>Sala de reunião</option>
			</select>
		</div>

		<div class="form-group">
			<label><small><strong>Essa reserva é para quantas pessoas?</strong></small></label>
			<select class="cursor-pointer form-control px-1 participants" 
				@if(! request()->has('space') || request()->space == 'co-working') name="participants" @else style="display: none;" @endif
				id="select-participants-co-working">
				@for($i=1; $i<=12; $i++)
				<option value="{{$i}}" {{request()->space == 'co-working' && request()->participants == $i ? 'selected' : null}}>{{$i .' '. trans_choice('words.pessoas', $i)}}</option>
				@endfor
			</select>

			<select class="cursor-pointer form-control px-1 participants" 
				@if(request()->space == 'conference') name="participants" @else style="display: none;" @endif
				id="select-participants-conference">
				@for($i=1; $i<=6; $i++)
				<option value="{{$i}}" {{request()->space == 'conference' && request()->participants == $i ? 'selected' : null}}>{{$i .' '. trans_choice('words.pessoas', $i)}}</option>
				@endfor
			</select>
		</div>

		<div class="form-group">
			<label><small><strong>Por quanto tempo precisará desse espaço?</strong></small></label>
			<select class="cursor-pointer form-control px-1" name="duration">
				<option value="1" {{request()->duration == '1' ? 'selected' : null}}>1 hora</option>
				<option value="2" {{request()->duration == '2' ? 'selected' : null}}>2 horas</option>
				<option value="4" {{request()->duration == '4' ? 'selected' : null}}>4 horas</option>
				<option value="{{config('office.day_length')}}" {{request()->duration == config('office.day_length') ? 'selected' : null}}>Dia inteiro</option>
			</select>
		</div>
		@if(request()->duration !== 'day')
		<div class="form-group">
			<label><small><strong>Qual horário deseja marcar?</strong></small></label>
			<select class="cursor-pointer form-control px-1" name="time">
				@for($i=8; $i<=18; $i++)
				<option value="{{$i}}" {{request()->time == $i ? 'selected' : null}}>{{$i}}:00h</option>
				@endfor
			</select>
		</div>
		@endif
	</form>
</div>
<div>
	<button class="btn btn-block btn-red" name="search"><strong>Pesquisar</strong></button>
</div>

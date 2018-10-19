<div>
	<div class="mb-4 pb-2">
		<form id="search" method="GET" action="/procurar">
			<input type="hidden" name="date" value="{{request()->date}}">
			<div class="form-group {{request()->has('date') ? 'hover-grayscale-out' : null}}">
				<label for="space"><small><strong>Para quando gostaria de fazer a reserva?</strong></small></label>
				@include('components.calendar.input')
			</div>

			<div class="form-group {{request()->has('space') ? 'hover-grayscale-out' : null}}">
				<label><small><strong>Qual tipo de espaço está procurando?</strong></small></label>
				<select class="cursor-pointer form-control rounded-0 px-1" name="space">
					<option value="co-working" data-target="co-working" {{request()->space == 'co-working' ? 'selected' : null}}>Co-working</option>
					<option value="conference" data-target="conference" {{request()->space == 'conference' ? 'selected' : null}}>Sala de reunião</option>
				</select>
			</div>

			<div class="form-group {{request()->has('participants') ? 'hover-grayscale-out' : null}}">
				<label><small><strong>Essa reserva é para quantas pessoas?</strong></small></label>
				<select class="cursor-pointer form-control rounded-0 px-1 participants" 
					@if(request()->space == 'co-working') name="participants" @else style="display: none;" @endif
					id="select-participants-co-working">
					<option value="1" {{request()->space == 'co-working' && request()->participants == '1' ? 'selected' : null}}>1 pessoa</option>
					@for($i=2; $i<=12; $i++)
					<option value="{{$i}}" {{request()->space == 'co-working' && request()->participants == $i ? 'selected' : null}}>{{$i}} pessoas</option>
					@endfor
				</select>

				<select class="cursor-pointer form-control rounded-0 px-1 participants" 
					@if(request()->space == 'conference') name="participants" @else style="display: none;" @endif
					id="select-participants-conference">
					<option value="1" {{request()->space == 'conference' && request()->participants == '1' ? 'selected' : null}}>1 pessoa</option>
					@for($i=2; $i<=6; $i++)
					<option value="{{$i}}" {{request()->space == 'conference' && request()->participants == $i ? 'selected' : null}}>{{$i}} pessoas</option>
					@endfor
				</select>
			</div>

			<div class="form-group {{request()->has('duration') ? 'hover-grayscale-out' : null}}">
				<label><small><strong>Por quanto tempo precisará desse espaço?</strong></small></label>
				<select class="cursor-pointer form-control rounded-0 px-1" name="duration">
					<option value="1" {{request()->duration == '1' ? 'selected' : null}}>1 hora</option>
					<option value="2" {{request()->duration == '2' ? 'selected' : null}}>2 horas</option>
					<option value="4" {{request()->duration == '4' ? 'selected' : null}}>4 horas</option>
					<option value="day" {{request()->duration == 'day' ? 'selected' : null}}>Dia inteiro</option>
				</select>
			</div>
			@if(request()->duration !== 'day')
			<div class="form-group {{request()->has('time') ? 'hover-grayscale-out' : null}}">
				<label><small><strong>Qual horário deseja marcar?</strong></small></label>
				<select class="cursor-pointer form-control rounded-0 px-1" name="time">
					@for($i=8; $i<=18; $i++)
					<option>{{$i}}:00h</option>
					@endfor
				</select>
			</div>
			@endif
		</form>
	</div>
	<div>
		<button class="btn btn-block btn-blue rounded-0" style="display: none;" name="refresh"><strong>Pesquisar novamente</strong></button>
		<button class="btn btn-block btn-red rounded-0" name="continue"><strong>Continuar<i class="fas fa-long-arrow-alt-right ml-2 align-middle"></i></strong></button>
	</div>
</div>
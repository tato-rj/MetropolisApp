<div class="row">
	<div class="col-10 mx-auto">
		<div class="d-flex flex-wrap">
			@foreach($spaces as $space)
			<button 
				class="toggle-finder btn {{$loop->first ? 'btn-light' : 'btn-dark opacity-6'}} btn-wide py-2 text-uppercase" 
				data-target="{{$space->slug}}" 
				data-background="url({{asset("images/covers/{$space->slug}.jpg")}})">
				<i class="text-teal fas fa-{{$space->icon}} mr-2"></i>{{$space->name}}
			</button>
			@endforeach
		</div>
		<div class="px-4 py-3 bg-light">
			<form method="GET" action="{{route('events.search')}}">
				<input type="hidden" name="type" value="{{$spaces->first()->slug}}">
				<div class="row w-100 mx-auto">
					
					<div class="col-lg-4 col-12 p-0">
						@include('components.calendar.input')
					</div>

					<select name="time" class="col-lg-2 col-6 form-control border-left-0">
						@for($i = office()->day_starts_at; $i <= office()->day_ends_at; $i++)
						<option value="{{$i}}">{{$i}}:00h</option>
						@endfor
					</select>
					
					<select name="duration" class="col-lg-2 col-6 form-control border-left-0">
						<option value="1">1 hora</option>
						<option value="2">2 horas</option>
						<option value="4">4 horas</option>
						<option value="6">6 horas</option>
						<option value="{{office()->day_length}}">Dia inteiro</option>
					</select>

					@foreach($spaces as $space)
					<select 
						name="{{$loop->first ? 'participants' : null}}" 
						id="select-participants-{{$space->slug}}" 
						class="participants col-lg-2 col-6 form-control border-left-0 border-right-0"
						style="{{! $loop->first ? 'display: none' : null}}">
						@for($i = 1; $i <= $space->capacity; $i++)
						<option value="{{$i}}">{{$i .' '. trans_choice('words.pessoas', $i)}}</option>
						@endfor
					</select>
					@endforeach

					<button type="submit" class="col-lg-2 col-6 btn btn-teal"><strong>Procurar</strong></button>
				</div>
			</form>
		</div>
		@auth
		<div class="bg-light text-muted border-top px-4 pt-1 pb-2">
			<small>{!! auth()->user()->bonusNotice() !!}</small>
		</div>
		@endauth
	</div>
</div>
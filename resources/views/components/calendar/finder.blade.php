<div class="row">
	<div class="col-10 mx-auto">
		<div class="d-flex flex-wrap">
			<button class="toggle-finder btn btn-light btn-wide py-2" data-target="co-working" data-background="url({{asset('images/co-working.jpg')}})">
				<i class="text-teal fas fa-laptop mr-2"></i>CO-WORKING</button>
			<button class="toggle-finder btn btn-dark opacity-6 btn-wide py-2" data-target="conference" data-background="url({{asset('images/conference.jpg')}})">
				<i class="fas fa-users mr-2"></i>SALA DE REUNIÃO</button>
		</div>
		<div class="px-4 py-3 bg-light">
			<form method="GET" action="/agendar">
				<input type="hidden" name="space" value="co-working">
				<input type="hidden" name="date" value="{{now()->format('Y-m-d')}}">
				<div class="row w-100 mx-auto">
					
					<div class="col-lg-4 col-12 p-0">
						@include('components.calendar.input')
					</div>

					<select name="time" class="col-lg-2 col-6 form-control border-left-0">
						@for($i=8; $i<=18; $i++)
						<option value="{{$i}}">{{$i}}:00h</option>
						@endfor
					</select>
					
					<select name="duration" class="col-lg-2 col-6 form-control border-left-0">
						<option value="1">1 hora</option>
						<option value="2">2 horas</option>
						<option value="4">4 horas</option>
						<option value="{{config('office.day_length')}}">Dia inteiro</option>
					</select>

					<select id="select-participants-co-working" name="participants" class="participants col-lg-2 col-6 form-control border-left-0 border-right-0">
						@for($i=1; $i<=12; $i++)
						<option value="{{$i}}">{{$i .' '. trans_choice('words.pessoas', $i)}}</option>
						@endfor
					</select>

					<select style="display: none;" id="select-participants-conference" class="participants col-lg-2 col-6 form-control border-0 border-y">
						@for($i=1; $i<=6; $i++)
						<option value="{{$i}}">{{$i .' '. trans_choice('words.pessoas', $i)}}</option>
						@endfor
					</select>
					<button type="submit" class="col-lg-2 col-6 btn btn-teal"><strong>Procurar</strong></button>
				</div>
			</form>
		</div>
	</div>
</div>
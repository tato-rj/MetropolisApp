<div class="row">
	<div class="col-10 mx-auto">
		<div class="d-flex flex-wrap">
			<button class="toggle-finder btn btn-light rounded-0 btn-wide py-2" data-target="co-working" data-background="url({{asset('images/co-working.jpg')}})">
				<i class="text-teal fas fa-laptop mr-2"></i>CO-WORKING</button>
			<button class="toggle-finder btn btn-dark opacity-6 rounded-0 btn-wide py-2" data-target="conference" data-background="url({{asset('images/conference.jpg')}})">
				<i class="fas fa-users mr-2"></i>SALA DE REUNIÃO</button>
		</div>
		<div class="px-4 py-3 bg-light">
			<form method="GET" action="/procurar">
				<input type="hidden" name="space" value="co-working">
				<input type="hidden" name="date" value="{{now()->format('Y-m-d')}}">
				<div class="row w-100 mx-auto">
					
					<div class="col-lg-6 col-12 p-0">
						@include('components.calendar.input')
					</div>
					
					<select name="duration" class="col-lg-2 col-4 form-control rounded-0 border-0 border-y">
						<option value="1">1 horas</option>
						<option value="2">2 horas</option>
						<option value="4">4 horas</option>
						<option value="day">Dia inteiro</option>
					</select>

					<select id="select-participants-co-working" name="participants" class="participants col-lg-2 col-4 form-control rounded-0 border">
						<option value="1">1 pessoa</option>
						@for($i=2; $i<=12; $i++)
						<option value="{{$i}}">{{$i}} pessoas</option>
						@endfor
					</select>

					<select style="display: none;" id="select-participants-conference" class="participants col-lg-2 col-4 form-control rounded-0 border">
						<option value="1">1 pessoa</option>
						@for($i=2; $i<=6; $i++)
						<option value="{{$i}}">{{$i}} pessoas</option>
						@endfor
					</select>
					<button type="submit" class="col-lg-2 col-4 btn btn-teal rounded-0"><strong>Procurar</strong></button>
				</div>
			</form>
		</div>
	</div>
</div>
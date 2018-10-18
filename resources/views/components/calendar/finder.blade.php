<div class="row">
	<div class="col-10 mx-auto">
		<div class="d-flex flex-wrap">
			<button class="toggle-finder btn btn-light rounded-0 btn-wide py-2" data-target="co-working" data-background="url({{asset('images/co-working.jpg')}})">
				<i class="text-teal fas fa-laptop mr-2"></i>CO-WORKING</button>
			<button class="toggle-finder btn btn-dark opacity-6 rounded-0 btn-wide py-2" data-target="conference" data-background="url({{asset('images/conference.jpg')}})">
				<i class="fas fa-users mr-2"></i>SALA DE REUNIÃO</button>
		</div>
		<div class="px-4 py-3 bg-light">
			<form method="POST" action="/buscar">
				@csrf
				<input type="hidden" name="space" value="co-working">
				<input type="hidden" name="date" value="{{now()}}">
				<div class="row w-100 mx-auto">
					<div class="date-input position-relative col-lg-6 col-12 p-0">
						<input class="form-control rounded-0 border cursor-pointer" type="text" id="datepicker" data-now="{{now()}}">
						<i class="text-teal fas fa-calendar-alt"></i>
					</div>
					<select name="time" class="col-lg-2 col-4 form-control rounded-0 border-0 border-y">
						<option value="all_day">Dia inteiro</option>
						<option value="morning">Manhã</option>
						<option value="afternoon">Tarde</option>
						<option value="evening">Noite</option>
					</select>
					<select id="select-co-working" name="participants" class="capacity col-lg-2 col-4 form-control rounded-0 border">
						<option value="1">1 pessoa</option>
						@for($i=2; $i<=12; $i++)
						<option value="{{$i}}">{{$i}} pessoas</option>
						@endfor
					</select>
					<select style="display: none;" name="participants" id="select-conference" class="capacity col-lg-2 col-4 form-control rounded-0 border">
						<option value="1">1 pessoa</option>
						@for($i=2; $i<=6; $i++)
						<option value="{{$i}}">{{$i}} pessoas</option>
						@endfor
					</select>
					<button type="submit" class="col-lg-2 col-4 btn btn-teal rounded-0"><strong>Buscar</strong></button>
				</div>
			</form>
		</div>
	</div>
</div>
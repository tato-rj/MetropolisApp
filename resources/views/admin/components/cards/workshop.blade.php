<div class="card border-0 shadow-sm">
	@if(! empty($note))
	<div class="absolute-top-right bg-white py-1 px-2 text-uppercase text-teal"><small><strong>{{$note}}</strong></small></div>
	@endif
	<img class="card-img-top rounded-0" src="{{asset($workshop->cover_image)}}" alt="">
	<div class="card-body">
		<h5 class="card-title mb-1">{{$workshop->name}}</h5>
		<p><small>{{$workshop->starts_at->format('d/m/Y')}} às {{$workshop->starts_at->format('H')}} horas</small></p>

		<p>{{$workshop->headline}}</p>
		<a href="#" class="btn btn-red">Mais detalhes</a>
	</div>
</div>
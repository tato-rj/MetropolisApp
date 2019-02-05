<div class="card border-0 shadow-sm">
	<img class="card-img-top rounded-0" src="{{asset($upcoming->cover_image)}}" alt="">
	<div class="card-body">
		<p class="mb-1 text-muted"><small>PRÓXIMO WORKSHOP</small></p>
		<h5 class="card-title mb-1">{{$upcoming->name}}</h5>
		<p><small>{{$upcoming->starts_at->format('d/m/Y')}} às {{$upcoming->starts_at->format('H')}} horas</small></p>

		<p>{{$upcoming->headline}}</p>
		<a href="#" class="btn btn-red">Mais detalhes</a>
	</div>
</div>
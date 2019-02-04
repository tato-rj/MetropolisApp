<div class="card">
	<img class="card-img-top" src="{{asset($upcoming->cover_image)}}" alt="">
	<div class="card-body">
		<p class="mb-1 text-muted"><small>PRÓXIMO WORKSHOP</small></p>
		<h4 class="card-title">{{$upcoming->name}}</h4>
		<h6 class="card-subtitle">{{$upcoming->starts_at->format('d/m/Y')}} às {{$upcoming->starts_at->format('H')}} horas</h6>

		<p>{{$upcoming->headline}}</p>
		<a href="" class="view-more text-left">Mais detalhes</a>
	</div>
</div>
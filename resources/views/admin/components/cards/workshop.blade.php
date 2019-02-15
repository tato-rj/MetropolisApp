<div class="card border-0 shadow-sm {{$height ?? 'h-100'}}">
	@if(! empty($note))
	<div class="absolute-top-right bg-white py-1 px-2 text-uppercase text-teal"><small><strong>{{$note}}</strong></small></div>
	@endif
	<img class="card-img-top rounded-0" src="{{asset($workshop->cover_image_path)}}" alt="">
	<div class="card-body flex-column d-flex justify-content-between">
		<div class="mb-2">
			<h5 class="card-title mb-1">{{$workshop->name}}</h5>
			<p class="mb-1"><small>{{$workshop->starts_at->format('d/m/Y')}} às {{$workshop->starts_at->format('H')}} horas</small></p>
			<p>{{$workshop->headline}}</p>
			@include('components.workshops.files-count')
		</div>
		<div class="d-flex">
			<a href="{{route('admin.workshops.edit', $workshop->slug)}}" class="btn btn-red">Editar</a>
		</div>
	</div>
</div>
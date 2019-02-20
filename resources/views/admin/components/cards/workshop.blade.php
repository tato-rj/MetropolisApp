<div class="card border-0 shadow-sm {{$height ?? 'h-100'}}">
	@if(! empty($note))
	<div class="absolute-top-right bg-white py-1 px-2 text-uppercase text-teal"><small><strong>{{$note}}</strong></small></div>
	@endif
	<a href="{{route('workshops.show', $workshop->slug)}}" class="link-none">
		<img class="card-img-top rounded-0" src="{{asset($workshop->cover_image_path)}}" alt="">
	</a>
	<div class="card-body flex-column d-flex justify-content-between">
		<div>
			<a href="{{route('workshops.show', $workshop->slug)}}" class="link-none">
				<h5 class="card-title mb-1">{{$workshop->name}}</h5>
			</a>
			<p class="mb-1"><small>{{$workshop->starts_at->format('d/m/Y')}} às {{$workshop->starts_at->format('H')}} horas</small></p>
			<p>{{$workshop->headline}}</p>
		</div>
		@if($editable)
		@include('components.workshops.files-count')
		@include('components.workshops.attendees-count')
		<div class="d-flex">
			<a href="{{route('admin.workshops.details', $workshop->slug)}}" class="btn btn-teal mr-2">Ver detalhes</a>
			<a href="{{route('admin.workshops.edit', $workshop->slug)}}" class="btn btn-red">Editar</a>
		</div>
		@endif
	</div>
</div>
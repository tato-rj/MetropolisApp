<div class="col-lg-4 col-md-6 col-sm-10 col-12 mb-6">
	<div class="mb-3 px-5">
		<img src="{{asset('images/team/' . $image . '.jpg')}}" class="rounded-circle w-100">
	</div>
	<div class="text-center mb-3">
		<p class="mb-0"><strong>{{$name}}</strong></p>
		<p class="text-muted mb-2 text-uppercase"><small>{{$position}}</small></p>
		<div class="text-teal">
			{{$icons}}
		</div>
	</div>
	<div class="d-flex flex-wrap">
		@foreach($fields as $field)
			<div class="bg-teal text-white px-2 py-1 m-1"><small><strong>{{$field}}</strong></small></div>
		@endforeach
	</div>
</div>
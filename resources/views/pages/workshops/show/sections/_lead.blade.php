@component('layouts.header.partial', ['background' => $workshop->cover_image, 'size' => 16])
	<div class="container text-white">
		<div class="row">
			<div class="col-default">
				<h1 class="display-4">{{$workshop->name}}</h1>
				<p class="lead">{{$workshop->headline}}</p>
			</div>
		</div>
	</div>
@endcomponent
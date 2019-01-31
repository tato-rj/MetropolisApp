<section class="container mb-6">
	<div class="row mt-6">
		<div class="col-default">
			@foreach($workshops as $workshop)
			@include('pages.workshops.sections.event')
			@endforeach
		</div>
	</div>
</section>
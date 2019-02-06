<div class="card-columns">
	@foreach($workshops as $workshop)
	<div class="mb-3">
		@include('admin.components.cards.workshop')
	</div>
	@endforeach
</div>
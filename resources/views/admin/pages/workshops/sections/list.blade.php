<div class="mb-4 border-y border-left pl-3">
	@include('pages.workshops.sections.filters', ['bg' => 'light'])
</div>

<div class="row mb-4">
	@foreach($workshops as $workshop)
	<div class="col-4 mb-4">
		@include('admin.components.cards.workshop')
	</div>
	@endforeach
</div>

<div class="d-flex justify-content-center">
	{{ $workshops->links() }}
</div>
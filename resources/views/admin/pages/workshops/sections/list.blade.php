<div class="mb-4 border-y border-left pl-3">
	@include('pages.workshops.sections.filters', ['bg' => 'light'])
</div>

<div class="row mb-4">
	@forelse($workshops as $workshop)
	<div class="col-4 mb-4">
		@include('admin.components.cards.workshop', ['note' => $loop->first ? 'PRÓXIMO WORKSHOP' : null])
	</div>
	@empty
    <div class="col-12 d-flex flex-center" style="height: 400px">
        <p class="text-grey"><i>Nenhum workshop foi criado</i></p>
    </div>
	@endforelse
</div>

<div class="d-flex justify-content-center">
	{{ $workshops->links() }}
</div>
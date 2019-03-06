<section class="container mb-6">
	<div class="row">
		<div class="col-default mb-5 p-0 border-bottom">
			@include('pages.workshops.sections.filters')
		</div>
	</div>
	<div class="row">
		<div class="col-default mb-4">
			@forelse($workshops as $workshop)
			@include('pages.workshops.sections.event', ['showReservation' => false])
			@empty
			<div class="text-center text-muted py-6"><i>Não encontramos nenhum workshop no período escolhido</i></div>
			@endforelse
		</div>
		<div class="col-default d-flex justify-content-center">
			{{ $workshops->links() }}
		</div>
	</div>
</section>
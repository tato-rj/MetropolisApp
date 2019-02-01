<section class="container mb-6">
	<div class="row">
		<div class="col-default mb-5 border-bottom py-2 px-3">
			<div class="d-apart align-items-center">
				@include('pages.workshops.show.sections.share')
				<div class="text-muted">
					<small>Atualizado no dia {{$workshop->updated_at->format('d/m/Y')}}</small>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-default mb-5">
			@include('pages.workshops.show.sections.intro')
		</div>
		<div class="col-default mb-5">
			<p><strong>Sobre o workshop</strong></p>
			{!! $workshop->description !!}
		</div>
		<div class="col-default">
			@if($workshop->attendees->find(auth()->user()))
				<div class="alert alert-teal text-center m-0"><strong><i class="fas fa-check-circle mr-2"></i>A sua presença está confirmada, nos vemos lá!</strong></div>
			@else
				@include('pages.workshops.show.sections.confirm')
			@endif
		</div>
	</div>
</section>
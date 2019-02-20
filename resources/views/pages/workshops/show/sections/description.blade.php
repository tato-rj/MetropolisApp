<section class="container mb-6">
	<div class="row">
		<div class="col-default mb-5 border-bottom py-2 px-3">
			<div class="d-apart align-items-center">
				@include('components.share.icons', ['url' => route('workshops.show', $workshop->slug), 'style' => 'share-light', 'description' => $workshop->headline])
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
		<div class="col-default mb-4">
			<p><strong>Sobre o workshop</strong></p>
			{!! $workshop->description !!}
		</div>
		@if($workshop->hasFiles())
		<div class="col-default mb-4">
			<p><strong>Material disponível para esse workshop</strong></p>
			@include('components.workshops.files', ['removable' => false])
		</div>
		@endif
		<div class="col-default mt-4">
			@if(! $workshop->attendees->find(auth()->user()))
				@include('pages.workshops.show.sections.confirm')
			@endif
		</div>
	</div>
</section>
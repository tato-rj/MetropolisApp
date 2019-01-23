<section class="container mb-8 mt-6">
	<div class="row">
		<div class="col-lg-6 col-md-8 col-10 mx-auto">
			<div class="pb-4">
				<div class="mb-4">
					<p class="text-muted mb-1"><strong>Plano {{ucfirst($plan->type)}}</strong></p>
					<h2 class="text-{{$plan->color}} m-0"><strong>{{ucfirst($plan->name)}}</strong></h2>
				</div>
				<div>
					@include('components.plans.icons.'.str_slug($plan->type), ['bonus' => $plan->bonus_text])
				</div>
			</div>
			@subscribed
				@include('pages.plans.subscribe.sections.update')
			@else
				@include('pages.plans.subscribe.sections.confirm')
			@endsubscribed
		</div>
	</div>
</section>

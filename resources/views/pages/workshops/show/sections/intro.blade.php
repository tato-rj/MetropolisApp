@if($workshop->attendees->find(auth()->user()))
	<div class="alert alert-teal text-center mb-5"><strong><i class="fas fa-check-circle mr-2"></i>A sua presença está confirmada, nos vemos lá!</strong></div>
@endif

<div class="d-flex flex-wrap justify-content-center">
	<div class="text-center mx-2 mb-3">
		<div class="bg-teal text-white" style="padding: 2.25rem;">
			<i class="fas fa-3x fa-calendar-alt"></i>
		</div>
		<h5 class="mb-0 bg-light border-bottom border-teal border-1x text-dark py-2"><strong>{{$workshop->starts_at->format('d/m')}}</strong></h5>
	</div>
	<div class="text-center mx-2 mb-3">
		<div class="bg-teal text-white" style="padding: 2.25rem;">
			<i class="fas fa-3x fa-clock"></i>
		</div>
		<h5 class="mb-0 bg-light border-bottom border-teal border-1x text-dark py-2"><strong>{{$workshop->starts_at->format('H')}} horas</strong></h5>
	</div>
	<div class="text-center mx-2 mb-3 {{! $workshop->fee ? 'opacity-4' : null}}">
		<div class=" {{$workshop->fee ? 'bg-teal' : 'bg-grey'}} text-white" style="padding: 2.25rem;">
			<i class="fas fa-3x fa-piggy-bank"></i>
		</div>
		<h5 class="mb-0 bg-light border-bottom border-teal border-1x {{$workshop->fee ? 'text-dark' : 'text-grey'}} py-2"><strong>{{feeToString($workshop->fee)}}</strong></h5>
	</div>
</div>

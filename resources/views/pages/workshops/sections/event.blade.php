<div class="row mb-5 {{! $loop->last ? 'pb-5 border-bottom' : null}}">
	<div class="col-4">
		<img src="{{asset($workshop->cover_image_path)}}" class="w-100 mb-3">
		
		<div class="mb-1"><strong class="text-teal mr-2">DATA</strong>{{$workshop->starts_at->format('d/m/Y')}}</div>
		
		<div class="mb-1"><strong class="text-teal mr-2">HORÁRIO</strong>{{$workshop->starts_at->format('H:i')}} às {{$workshop->ends_at->format('H:i')}}</div>
		
		<div><strong class="text-teal mr-2">INVESTIMENTO</strong><strong class="{{! $workshop->fee ? 'text-red' : null}}">{{$workshop->fee ? feeToString($workshop->fee) : 'Gratuito'}}</strong></div>
	</div>
	<div class="col-8 d-apart flex-column">
		<div class="mb-2 w-100">
			<div class="mb-1">
				@include('components.share.icons', ['url' => route('workshops.show', $workshop->slug), 'description' => $workshop->headline])
			</div>
			
			<h5 class="mb-2"><strong>{{$workshop->name}}</strong></h5>
			
			<div>{{$workshop->headline}}</div>
			
			@include('components.workshops.files-count')
		</div>
		<div class="w-100 d-flex align-items-center justify-content-end">
			@if($showReservation)
			<button data-url-status="{{route('status.workshop', ['reservation_id' => $workshop->reservation->id, 'user_type' => get_class(auth()->user())])}}" data-modal="#event-modal" class="reservation-item btn btn-red"><strong><i class="fas fa-info-circle mr-2"></i>Detalhes da reserva</strong></button>
			@else
			<a href="{{route('workshops.show', $workshop->slug)}}" class="btn btn-teal"><strong><i class="fas fa-info-circle mr-2"></i>Mais informações</strong></a>
			@endif
		</div>
	</div>
</div>
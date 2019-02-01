<div class="col-10 mx-auto">
	@foreach(auth()->user()->upcomingWorkshops as $workshop)
	<div class="alert-{{$workshop->reservation->statusColor}} alert align-items-center d-apart {{$loop->last ? 'mb-4' : null}}">
		<div><i class="fas fa-calendar-alt mr-2"></i>{{$workshop->reservation->statusForUser == 'Confirmado' ? 'Reserva marcada' : 'Confirmando reserva'}} no workshop <strong>{{$workshop->name}}</strong></div>
		<button data-ajax="{{route('workshops.ajax', $workshop->slug)}}" class="workshop-details btn btn-sm btn-{{$workshop->reservation->statusColor}}"><strong>Mais detalhes</strong></button>
	</div>
	@endforeach
</div>
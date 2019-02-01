<ul class="list-flat px-3 py-2">
	<li class="mb-2">
		<span class="text-teal mr-1"><strong>Workshop</strong></span>
		<span>{{$reservation->workshop->name}}</span>
	</li>

	<li class="mb-2">
		<span class="text-teal mr-1"><strong>Data</strong></span>
		<span class="date" data-date="{{$reservation->workshop->starts_at->format('Y-m-d')}}"></span>
	</li>

	<li class="mb-2">
		<span class="text-teal mr-1"><strong>Horário</strong></span>
		<span>das {{$reservation->workshop->starts_at->format('H')}} às {{$reservation->workshop->ends_at->format('H')}} horas</span>
	</li>

	<li class="mb-2">
		<span class="text-teal mr-1"><strong>Status</strong></span>
		<span class="status-label text-{{$reservation->statusColor}}">{{$reservation->statusForUser}}</span>
		
		<small class="text-muted verified-at">
			@if($reservation->verified_at)
				({{'atualizado no dia ' . $reservation->verified_at->format('d/m') . ' às ' . $reservation->verified_at->format('H:i')}})
			@endif
		</small>
	</li>
</ul>

<div class="text-center mb-3">
	<a href="{{route('workshops.show', $reservation->workshop->slug)}}" class="btn btn-sm btn-teal"><strong>Página do workshop</strong></a>
</div>

<div class="bg-light py-2 px-3">
	<p class="text-muted m-0"><small>Para alterar essa reserva, envie um email para <a href="mailto:contato@metropolis.com" class="link-red">contato@metropolis.com</a></small></p>
	@if($reservation->reference)
	<p class="text-muted m-0"><small>O código da reserva é <strong>{{$reservation->reference}}</strong></small></p>
	@endif
</div>


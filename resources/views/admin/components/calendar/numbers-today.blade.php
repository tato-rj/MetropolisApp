<p class="mb-1">
	<i class="fab fa-elementor mr-2 text-muted"></i>
	O escritório tem <strong>{{$eventsToday->count()}} {{str_plural('evento', $eventsToday->count())}}</strong> hoje.
</p>

<p>
	<i class="fas fa-skull-crossbones mr-2 text-muted"></i>
	Nós encontramos <strong class="
	{{$eventsToday->withConflict()->count() > 0 ? 
		'text-red' : 
		'text-green'}}">{{$eventsToday->withConflict()->count()}} {{str_plural('conflitos', $eventsToday->withConflict()->count())}}
	</strong> a serem corrigidos.
</p>
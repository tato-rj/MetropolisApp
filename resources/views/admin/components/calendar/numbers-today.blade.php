<p class="mb-1">
	<i class="fab fa-elementor mr-2 text-muted"></i>
	O escritório tem <strong>{{$eventsToday->count()}} {{trans_choice('words.eventos', $eventsToday->count())}}</strong> hoje.
</p>

<p>
	<i class="fas fa-skull-crossbones mr-2 text-muted"></i>
	Nós encontramos <strong class="
	{{$eventsToday->withConflict()->count() > 0 ? 
		'text-red' : 
		'text-green'}}">{{$eventsToday->withConflict()->count()}} {{trans_choice('words.conflitos', $eventsToday->withConflict()->count())}}
	</strong> a {{trans_choice('words.serem_corrigidos', $eventsToday->withConflict()->count())}}.
</p>
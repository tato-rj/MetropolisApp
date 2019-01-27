@if(auth()->check() && auth()->user()->currentEventCountdown)
<div id="event-alert" data-end="{{auth()->user()->currentEventCountdown['end']}}" class="t-2 position-fixed text-center cursor-pointer bg-green shadow rounded-circle py-2 px-3" style="width: 2.5rem; height: 2.5rem; bottom: 1.2rem; left: 1.2rem; z-index: 5">
	<div class="text-white" style="display: none;">
		<i class="fas fa-stopwatch mr-2"></i>Sessão ativa na {{auth()->user()->currentEventCountdown['name']}}! Ela se encerrará em <span class="font-weight-bold" id="countdown"></span>
	</div>
</div>
@endif
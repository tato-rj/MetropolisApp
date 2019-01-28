@if(auth()->check() && auth()->user()->currentEventCountdown)
<div id="event-alert" data-end="{{auth()->user()->currentEventCountdown['end']}}" class="position-fixed d-flex align-items-center justify-content-center text-center cursor-pointer bg-green shadow py-2 px-3" style="width: 2.85rem; height: 2.85rem; bottom: 1.2rem; left: 1.2rem; z-index: 5; border-radius: 2.85rem">
	<div class="text-white d-flex align-items-center justify-content-center">
		<i class="fas fa-stopwatch"></i>
		<div class="content ml-2" style="display: none;">
			Sessão ativa na {{auth()->user()->currentEventCountdown['name']}}! Ela se encerrará em <span class="font-weight-bold" id="countdown"></span>
		</div>
	  <button type="button" class="close ml-2 text-white content" style="display: none;" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true" class="align-text-top">&times;</span>
	  </button>
	</div>
</div>
@endif
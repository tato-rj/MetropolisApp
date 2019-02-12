<div class="row">
	<div class="col-12 mb-4">
		<div id="calendar-loading" class="text-muted d-flex align-items-start justify-content-center pt-8" style="min-height: 740px">
			<span>Estamos carregando a agenda...</span>
		</div>
		<div id='calendar' data-events="{{$eventsArray}}" data-ajax="{{route('status.ajax')}}"></div>
	</div>
	<div class="col-12">
		<div class="p-2 border d-inline-block">
			<p class="text-muted mb-0 ml-2"><small>LEGENDA</small></p>
			<div class="m-2 d-flex align-items-center">
				<div class="mr-2 shadow-sm btn-yellow" style="width: 20px; height: 20px;"></div>
				<div>aguardando confirmação</div>
			</div>
			<div class="m-2 d-flex align-items-center">
				<div class="mr-2 shadow-sm btn-teal" style="width: 20px; height: 20px;"></div>
				<div>confirmado</div>
			</div>
			<div class="m-2 d-flex align-items-center">
				<div class="mr-2 shadow-sm btn-red" style="width: 20px; height: 20px;"></div>
				<div>conflito</div>
			</div>
			<div class="m-2 d-flex align-items-center">
				<div class="mr-2 shadow-sm btn-grey" style="width: 20px; height: 20px;"></div>
				<div>passado/cancelado</div>
			</div>
		</div>
	</div>
</div>
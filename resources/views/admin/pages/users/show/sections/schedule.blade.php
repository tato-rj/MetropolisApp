<div class="row mb-3">
	<div class="col-12 mb-4">
		<div id="calendar-loading" class="text-muted d-flex align-items-start justify-content-center pt-8" style="min-height: 740px">
			<span>Estamos carregando a agenda...</span>
		</div>
		<div id='calendar' 
			data-events="{{$eventsArray}}" 
			data-ajax="{{route('status.ajax')}}"
			data-update-datetime="{{route('admin.schedule.update.datetime')}}"></div>
	</div>
	<div class="col-12">
		@include('components.calendar.legend')
	</div>
</div>
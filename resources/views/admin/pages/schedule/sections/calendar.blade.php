<div class="row">
	<div class="col-12 mb-4">
		<p class="mb-1"><i class="fab fa-elementor mr-2 text-muted"></i>O escritório tem <strong>{{$eventsCount}} 
			{{str_plural('evento', $eventsCount)}}</strong> hoje.</p>
		<p><i class="fas fa-skull-crossbones mr-2 text-muted"></i>Nós encontramos <strong class="{{$conflictsCount > 0 ? 'text-red' : 'text-green'}}">{{$conflictsCount}} 
			{{str_plural('conflitos', $conflictsCount)}}</strong> a serem corrigidos.</p>
	</div>
	<div class="col-12 mb-4">
		<div id="calendar-loading" class="text-muted d-flex align-items-start justify-content-center pt-8" style="min-height: 740px">
			<span>Estamos carregando a agenda...</span>
		</div>
		<div id='calendar' 
			data-events="{{$eventsArray}}" 
			data-ajax="{{route('status.ajax')}}"
			data-create-event="{{route('admin.schedule.create')}}"
			data-update-datetime="{{route('admin.schedule.update.datetime')}}"></div>
	</div>
	<div class="col-12">
		@include('components.calendar.legend')
	</div>
</div>
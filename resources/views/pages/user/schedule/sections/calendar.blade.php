<section class="mb-7 mt-4 container">
  <div class="row">

{{-- 	<div class="col-10 mx-auto">
		@foreach(auth()->user()->upcomingWorkshops as $workshop)
		@include('components.alerts.workshop')
		@endforeach
	</div> --}}

  	<div class="col-10 mx-auto mb-4">
  		<div id="calendar-loading" class="text-muted d-flex align-items-start justify-content-center pt-8" style="min-height: 740px">
  			<span>Estamos carregando a sua agenda...</span>
  		</div>
  		<div id='calendar' data-events="{{auth()->user()->eventsArray($editable = false)}}" data-ajax="{{route('status.ajax')}}"></div>
  	</div>
    <div class="col-10 mx-auto">
    @include('components.calendar.legend')
    </div>
  </div>
</section>
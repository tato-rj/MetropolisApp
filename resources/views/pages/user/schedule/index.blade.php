@extends('layouts.app')

@push('header')
<style type="text/css">
.fc-toolbar { text-transform: capitalize; }
.fc-content { 
	cursor: pointer;
	color: white;
	padding: 0 .25em;
}
.fc-event {
	border: 0;
	border-radius: 0;
	background-color: #4dc0b5;
}
.fc-title { font-weight: bold }
.fc-unthemed td.fc-today { background-color: #e0f4f2 }
</style>
@endpush

@section('content')

@include('pages.user.schedule.sections._lead')
@include('pages.user.schedule.sections.calendar')
@include('pages.welcome.sections.partners')
@include('pages.welcome.sections.contact')

@include('components.modals.event')

@endsection

@push('scripts')
<script type="text/javascript">
(new CustomDatePicker('#datepicker')).enableTogglers('.toggle-finder', toggleBg = false).create();
</script>
<script type="text/javascript">
$(function() {
  schedule = $('#calendar').attr('data-events');
  ajaxUrl = $('#calendar').attr('data-ajax');
  $('#calendar').fullCalendar({
    weekends: false,
    header: {
    	left: 'prev,next today',
    	center: 'title',
    	right:  'month,agendaWeek,agendaDay'
    },
    views: {
    	agenda: {
    		titleFormat: 'MMMM YYYY'
    	}
    },
    events: JSON.parse(schedule),
    eventClick: function(event) {
    	$('#event-modal').modal('show');
    	$.post(ajaxUrl, {event_id: event.id},
	    	function(data, status){
	    		console.log(data);
	    		$('#event-modal .modal-body').html(data);
	    		$('#event-modal .modal-footer').show();
	    	}
	    );
	}
  })

});
</script>
@endpush
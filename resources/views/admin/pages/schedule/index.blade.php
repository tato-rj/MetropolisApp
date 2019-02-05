@extends('admin.layouts.app')

@section('content')
	@include('admin.pages.schedule.sections.calendar')

  @include('components.modals.event')
  @include('components.modals.plan')
@endsection

@push('scripts')
<script type="text/javascript">
$(function() {
  let schedule = $('#calendar').attr('data-events');
  let ajaxUrl = $('#calendar').attr('data-ajax');
console.log(JSON.parse(schedule));
  $('#calendar').fullCalendar({
    minTime: '08:00',
    maxTime: '18:00',
    allDaySlot: false,
    eventLimit: 3,
    businessHours: {
      start: app.office.day_starts_at+':00',
      end: app.office.day_ends_at+':00',
    },
    header: {
    	left: 'prev,next today',
    	center: 'title',
    	right:  'month,agendaWeek,agendaDay'
    },
    selectConstraint: "businessHours",
    views: {
    	agenda: {
    		titleFormat: 'MMMM YYYY'
    	}
    },
    events: JSON.parse(schedule),
    eventClick: function(event, jsEvent, view) {
      let modalId = $(this).attr('data-modal');
      let $modal = $(modalId);

    	$modal.modal('show');
    	
      $.post(ajaxUrl, {event_id: event.id},
	    	function(data, status){
	    		$modal.find('.modal-body > div:first-child').html(data);
          
          $modal.find('.modal-footer input[name="event_id"]').val(event.id);
          
          fullDatePT($modal.find('.date'));
          
          $modal.find('#loading').hide();

          if ($modal.find('#participants').attr('data-participants') > 1)
  	    		$modal.find('.modal-footer').show();
	    	}).fail(function() {
          $modal.find('.modal-body > div:first-child').html('<p class="text-center my-4 text-red">Não foi possível processar o seu pedido nesse momento</p>');
          $modal.find('#loading').hide();
        });
    },

    eventRender: function( event, element, view ) {
      if (event.end.isBefore(moment())) {
        $(element).addClass('btn-grey');
      } else if (event.statusForUser != 'Confirmado') {
        $(element).addClass('btn-yellow');
      } else {
        $(element).addClass('btn-teal');
      }

      if (event.plan_id === null) {
        $(element).attr('data-modal', '#event-modal');
      } else {
        $(element).attr('data-modal', '#plan-modal');
      }
    },
    eventAfterAllRender: function (view) {
        $('#calendar-loading').remove();
    }
  })
});
</script>
@endpush
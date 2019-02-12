@extends('admin.layouts.app')

@push('header')
<style type="text/css">
.fc-newEvent-button {
    background-color: #e3342f;
}
</style>
@endpush

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

  $('#calendar').fullCalendar({
    minTime: '08:00',
    navLinks: true,
    maxTime: '18:00',
    allDaySlot: false,
    eventLimit: 3,
    businessHours: {
      start: app.office.day_starts_at+':00',
      end: app.office.day_ends_at+':00',
    },
    customButtons: {
      newEvent: {
        text: 'Criar reserva',
        click: function() {
          window.location.href = {!! json_encode(route('admin.schedule.create'), JSON_HEX_TAG) !!};
        }
      }
    },
    header: {
    	left: 'prev,next today',
    	center: 'title',
    	right:  'newEvent month,agendaWeek,agendaDay'
    },
    selectConstraint: "businessHours",
    views: {
      month: {
        titleFormat: 'MMMM YYYY'
      },
      week: {
        titleFormat: 'D MMMM YYYY',
      },
      day: {
        titleFormat: '[Dia] D[,] MMMM YYYY',
      }
    },
    events: JSON.parse(schedule),
    eventClick: function(event, jsEvent, view) {
      let modalId = $(this).attr('data-modal');
      let $modal = $(modalId);

    	$modal.modal('show');
    	
      $.post(ajaxUrl, {event_id: event.id, user_type: app.user.type},
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
      if (event.doesOverlap) {
        $(element).addClass('btn-red');
      } else if (event.end.isBefore(moment())) {
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
        $('.fc-day-number').attr('title', 'Ver agenda nesse dia');
    },
    eventDrop: function(event, delta, revertFunc) {
      if (!confirm("Tem certeza de que deseja atualizar esse evento?")) {
        revertFunc();
      } else {
        updateDatetime(event.id, event.start.format(), event.end.format())
      }
      $('#calendar').rerenderResources();
    },
    eventResize: function(event, delta, revertFunc) {
      if (!confirm("Tem certeza de que deseja atualizar esse evento?")) {
        revertFunc();
      } else {
        updateDatetime(event.id, event.start.format(), event.end.format())
      }
    }
  })
});

function updateDatetime(event_id, starts_at, ends_at) {
  $overlay = $('#loading-overlay');

  $overlay.fadeIn('fast');

  $.post({!! json_encode(route('admin.schedule.update.datetime'), JSON_HEX_TAG) !!}, {event_id: event_id, starts_at: starts_at, ends_at: ends_at},
    function(data, status){
      $overlay.fadeOut('fast');
      $('body').append(data);
    });
}
</script>
@endpush
@extends('layouts.app')

@push('header')
<style type="text/css">
.fc-toolbar { text-transform: capitalize; }
.fc-title {
      white-space: nowrap; 
    overflow: hidden;
    text-overflow: ellipsis;
}
.fc-state-default { 
  background-color: #e9605c;
  background-image: none;
}
.fc-state-active, .fc-next-button, .fc-prev-button, .fc-today-button { background-color: #e3342f; }
.fc-state-disabled { background-color: #f4afad; }
.fc-button {
  color: white;
  text-shadow: none;
  border-radius: 0 !important;
  border: 0;
  box-shadow: none;
}
.fc-content { 
	color: white;
	padding: 0 .25em;
}
.fc-event {
  cursor: pointer;
	border: 0;
	border-radius: 0;
  background-color: #4dc0b5;
  box-shadow: 0 0 1rem rgba(0,0,0,.1);
  transition: 0.12s;
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
  $modal = $('#event-modal');
  schedule = $('#calendar').attr('data-events');
  ajaxUrl = $('#calendar').attr('data-ajax');

  $('#calendar').fullCalendar({
    weekends: false,
    minTime: '08:00',
    maxTime: '18:00',
    allDaySlot: false,
    businessHours: {
      start: '08:00',
      end: '18:00',
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
    eventClick: function(event) {
    	$modal.modal('show');
    	$.post(ajaxUrl, {event_id: event.id},
	    	function(data, status){
	    		$modal.find('.modal-body > div:first-child').html(data);
          
          $modal.find('.modal-footer input[name="event_id"]').val(event.id);
          
          $modal.find('#date').text(
            moment(
              $(this).attr('data-date')
            ).locale('pt').format("D [de] MMMM [de] YYYY")
          );
          
          $modal.find('#loading').hide();

          if ($modal.find('#participants').attr('data-participants') > 1)
  	    		$modal.find('.modal-footer').show();
	    	}
	    );
    },
    eventMouseover: function() {
      $(this).css('background-color', '#389d94');
    },
    eventMouseout: function() {
      $(this).css('background-color', '#4dc0b5');
    },
    eventAfterAllRender: function (view) {
        $('#calendar-loading').remove();
    }
  })
});
</script>
<script type="text/javascript">
function toggleButtonsFor(input)
{
  if (input) {
    resetButtons($('.edit').not(input), $('.save').not(input));
    input.siblings('.edit').toggle();
    input.siblings('.save').toggle();
  } else {
    resetButtons($('.edit'), $('.save'));
  }
}

function toggleInput(input)
{
  if (input) {
    resetInput($('input.event-email').not(input));
    input.attr('readonly', ! input.attr('readonly')).toggleClass('form-control-plaintext form-control');
  } else {
    resetInput($('input.event-email'))
  }
}

function resetInput(input)
{
  input.attr('readonly', true).addClass('form-control-plaintext').removeClass('form-control');
}

function resetButtons(edit, save)
{
    edit.show();
    save.hide();
}

function finishTask(element)
{
  $('.modal-body .event-email').attr('readonly', true).addClass('form-control-plaintext').removeClass('form-control');
  element.siblings('.saved').show();
  resetInput(element.closest('input'));
  element.siblings('.edit').remove();
  element.remove();
}

$('.modal-body').on('click', '.edit', function() {
  $input = $(this).siblings('input');
  toggleInput($input);
  toggleButtonsFor($input);
});

$('.modal-body').on('click', '.save', function() {
  $save = $(this);
  $input = $save.siblings('input');
  address = $save.attr('data-url');
  emails = [];

  $save.text('salvando');

  $('.event-email').each(function() {
    emails.push($(this).val());
  });

  $.post(address, {field: 'emails', emails: JSON.stringify(emails)}, function(data, status) {
    $('body').append(data);
    finishTask($save);
  });
});

$(document).click(function(e) {
    if ($(e.target).closest('.edit, .event-email, .save').length === 0) {
        $('.modal-body .event-email').attr('readonly', true).addClass('form-control-plaintext').removeClass('form-control');
        toggleButtonsFor();
    }
});


</script>
@endpush
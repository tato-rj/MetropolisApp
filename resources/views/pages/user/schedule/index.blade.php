@extends('layouts.app')

@section('content')

@include('pages.user.schedule.sections._lead')
@include('pages.user.schedule.sections.calendar')
@include('pages.welcome.sections.partners')
@include('pages.welcome.sections.contact')

@include('components.modals.event')
@include('components.modals.plan')

@endsection

@push('scripts')
<script type="text/javascript">
(new CustomDatePicker('#datepicker')).enableTogglers('.toggle-finder', toggleBg = false).create();
</script>
<script type="text/javascript">
$(function() {
  let schedule = $('#calendar').attr('data-events');
  let ajaxUrl = $('#calendar').attr('data-ajax');

  $('#calendar').fullCalendar({
    minTime: '08:00',
    maxTime: '18:00',
    allDaySlot: false,
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
<script type="text/javascript">
$(document).on('click', '.check-status:not(.checking)', function() {
  let $button = $(this);
  let $statusLabel = $button.closest('.modal-body').find('.status-label');
  let $verifiedAt = $button.closest('.modal-body').find('.verified-at');
  let $icon = $button.find('i');
  let url = $button.attr('data-url');

  $button.addClass('checking');
  $icon.addClass('spin');
  
  $.post(url, function(data, status){
    $statusLabel.text(data.statusForUser);
    $verifiedAt.text('(atualizado no dia ' + moment(data.verified_at).format('DD/MM') + ' às ' + moment(data.verified_at).format('HH:mm') + ')');
    $icon.toggleClass('fa-sync-alt fa-check');
    $button.toggleClass('text-red text-success check-status cursor-pointer');
    $button.find('span').text('Status atualizado com sucesso');
  }).fail(function(error) {
    console.log(error);
    $button.find('span').text('Não foi possível atualizar agora');
  }).always(function() {
    $icon.removeClass('spin');
    $button.removeClass('checking');
  });
});
</script>

<script type="text/javascript">
$('.workshop-details').on('click', function() {
  let $modal = $('#event-modal');
  let ajaxUrl = $(this).attr('data-ajax');

  $modal.modal('show');

  $.get(ajaxUrl, function(data, status){
      $modal.find('.modal-body > div:first-child').html(data);

      fullDatePT($modal.find('.date'));

      $modal.find('#loading').hide();
    }).fail(function() {
      $modal.find('.modal-body > div:first-child').html('<p class="text-center my-4 text-red">Não foi possível processar o seu pedido nesse momento</p>');
      $modal.find('#loading').hide();
    });
})
</script>
@endpush
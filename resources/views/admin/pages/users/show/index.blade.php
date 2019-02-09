@extends('admin.layouts.app')

@push('header')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/r-2.2.2/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/plug-ins/1.10.19/integration/font-awesome/dataTables.fontAwesome.css">

<style type="text/css">
div.dataTables_paginate li.first a:before, div.dataTables_paginate li.previous a:before {
    top: 8.5;
}

div.dataTables_paginate li.next a:after, div.dataTables_paginate li.last a:after {
    top: 8.5px;
}

table.dataTable thead .sorting:before, table.dataTable thead .sorting_asc:before, table.dataTable thead .sorting_desc:before, table.dataTable thead .sorting_asc_disabled:before, table.dataTable thead .sorting_desc_disabled:before {
    content: none;
}
</style>

<style type="text/css">
.nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link {
    color: #e3342f;
    background-color: #f8f9fa;
    border-color: #dee2e6 #dee2e6 #f8f9fa;
}

.nav-tabs .nav-link:not(.active) {
    color: grey;
    opacity: .6;
}
</style>
@endpush

@section('content')
<ul class="nav nav-tabs mb-4">
  <li class="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#tab-profile">Dados pessoais</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#tab-schedule">Agenda</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#tab-payments">Pagamentos</a>
  </li>
</ul>

<div class="tab-content">
  <div class="tab-pane fade show active" id="tab-profile" role="tabpanel">
    @include('admin.pages.users.show.sections.info')
  </div>
  <div class="tab-pane fade" id="tab-schedule" role="tabpanel">
    @include('admin.pages.users.show.sections.schedule', ['eventsArray' => $user->eventsArray()])
    @include('components.modals.event')
    @include('components.modals.plan')
  </div>
  <div class="tab-pane fade" id="tab-payments" role="tabpanel">
    @include('admin.pages.users.show.sections.payments', ['payments' => $user->payments])
    @include('components.modals.payment')
  </div>
</div>

@endsection

@push('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/r-2.2.2/datatables.min.js"></script>

<script type="text/javascript">
$(function() {
  let schedule = $('#calendar').attr('data-events');
  let ajaxUrl = $('#calendar').attr('data-ajax');

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
    	right:  'newEvent month,agendaWeek,agendaDay'
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
$(document).ready( function () {
    $('#payments-table').DataTable({
    	'language': {
		    "sEmptyTable": "Nenhum registro encontrado",
		    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
		    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
		    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
		    "sInfoPostFix": "",
		    "sInfoThousands": ".",
		    "sLengthMenu": "_MENU_ resultados por página",
		    "sLoadingRecords": "Carregando...",
		    "sProcessing": "Processando...",
		    "sZeroRecords": "Nenhum registro encontrado",
		    "sSearch": "Pesquisar",
		    "oPaginate": {
		        "sNext": "Próximo",
		        "sPrevious": "Anterior",
		        "sFirst": "Primeiro",
		        "sLast": "Último"
		    },
		    "oAria": {
		        "sSortAscending": ": Ordenar colunas de forma ascendente",
		        "sSortDescending": ": Ordenar colunas de forma descendente"
		    }
    	}
    });
});
</script>
@endpush
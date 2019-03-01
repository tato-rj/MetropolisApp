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

.nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link {
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
    <a class="nav-link active font-weight-bold" data-toggle="tab" href="#tab-profile"><i class="fas fa-address-card mr-2"></i>Dados pessoais</a>
  </li>
  <li class="nav-item">
    <a class="nav-link font-weight-bold" data-toggle="tab" href="#tab-schedule"><i class="fas fa-calendar-alt mr-2"></i>Agenda</a>
  </li>
  <li class="nav-item">
    <a class="nav-link font-weight-bold" data-toggle="tab" href="#tab-workshops"><i class="fas fa-chalkboard-teacher mr-2"></i>Workshops</a>
  </li>
  <li class="nav-item">
    <a class="nav-link font-weight-bold" data-toggle="tab" href="#tab-payments"><i class="fas fa-credit-card mr-2"></i>Pagamentos</a>
  </li>
</ul>

<div class="tab-content">
  <div class="tab-pane fade show active" id="tab-profile" role="tabpanel">
    @include('admin.pages.users.show.sections.info')
  </div>
  <div class="tab-pane fade" id="tab-schedule" role="tabpanel">
    @include('admin.pages.users.show.sections.schedule', ['eventsArray' => $user->eventsArray($editable = false, $activeOnly = false)])
  </div>
  <div class="tab-pane fade" id="tab-workshops" role="tabpanel">
    @include('admin.pages.users.show.sections.workshops', ['workshops' => $user->workshops])
  </div>
  <div class="tab-pane fade" id="tab-payments" role="tabpanel">
    @include('admin.pages.users.show.sections.payments', ['payments' => $user->payments])
  </div>
</div>

@include('components.modals.event')
@include('components.modals.plan')
@endsection

@push('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/r-2.2.2/datatables.min.js"></script>

<script type="text/javascript">
(new CustomCalendar('#calendar')).editable().create();
</script>
<script type="text/javascript">
$('.reservation-item').on('click', function() {
  $reservation = $(this);
  let url = $reservation.attr('data-url-status');
  let modalId = $reservation.attr('data-modal');
  let $modal = $(modalId);

  $modal.modal('show');

  $.get(url,
    function(data, status){

      $modal.find('.modal-body > div:first-child').html(data);

      fullDatePT($modal.find('.date'));

      $modal.find('#loading').hide();

    }).fail(function(error) {
      $modal.find('.modal-body > div:first-child').html('<p class="text-center my-4 text-red">Não foi possível processar o seu pedido nesse momento</p>');

      $modal.find('#loading').hide();
    });
});
</script>
<script type="text/javascript">
$(document).ready( function () {
    $('#payments-table, #workshop-table').DataTable({
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
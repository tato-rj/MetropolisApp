@extends('layouts.app')

@section('content')

@include('pages.user.workshops.sections._lead')
@include('pages.user.workshops.sections.list')
@include('pages.welcome.sections.grid')
@include('pages.welcome.sections.partners')
@include('pages.welcome.sections.contact')

@include('components.modals.event')
@endsection

@push('scripts')
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
@endpush
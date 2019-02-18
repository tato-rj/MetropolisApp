@extends('layouts.app')

@section('content')

@include('pages.user.payments.sections._lead')
@include('pages.user.payments.sections.table')
@include('pages.welcome.sections.contact')

@include('components.modals.payment')

@endsection

@push('scripts')
<script type="text/javascript">
$('.payment-item').on('click', function() {
  $payment = $(this);
  let url = $payment.attr('data-url-status');
  let modalId = $payment.attr('data-modal');
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
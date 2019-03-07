<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="bg-light" style="min-height: 100vh">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} | Admin</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/animate.css@3.5.2/animate.min.css">
    
    <link href="{{ mix('css/admin.css') }}" rel="stylesheet">
    
    <link href="{{ asset('css/primer.css') }}" rel="stylesheet">

    <script>
        window.app = <?php echo json_encode([
            'csrfToken' => csrf_token(),
            'user' => [
              'id' => auth()->check() ? auth()->user()->id : null,
              'type' => auth()->check() ? get_class(auth()->user()) : null,
            ],
            'office' => [
              'day_length' => office()->day_length,
              'day_starts_at' => office()->day_starts_at,
              'day_ends_at' => office()->day_ends_at
            ]
        ]); ?>
    </script>

    @stack('header')

</head>

<body class="bg-light">

    <div id="app">
        @include('admin.layouts.header')
        @include('admin.layouts.menu')
        <main class="container-fluid py-4 px-4">
          @yield('content')
          @include('admin.layouts.footer')
        </main>
    </div>

@if(session()->has('status'))
@include('components.alerts.success', ['message' => session('status')])
@endif

@if(session()->has('error'))
@include('components.alerts.error', ['message' => session('error')])
@endif

@include('components.overlays.admin-load')
@include('components.overlays.loading')
@include('components.overlays.responsive')

<script src="{{ mix('js/admin.js') }}"></script>

<script type="text/javascript">
$(document).ready(function() {
  $('#app').css('margin-left', $('.navmenu').outerWidth());
  $('#admin-load-overlay').fadeOut('fast');
});

$('button#toggle-menu').on('click', function() {
  
  if ($('#menu-list .menu-labels').is(':visible')) {
    $(this).css('transform', 'rotate(180deg)');
  } else {
    $(this).css('transform', 'rotate(0deg)');
  }

  $('#menu-list .menu-labels').toggle();
  $('#app').css('margin-left', $('.navmenu').outerWidth());
});

$('.nav-icon').on('click', function() {
  $('button#toggle-menu').css('transform', 'rotate(0deg)');
  $('#menu-list .menu-labels').show();
  $('#app').css('margin-left', $('.navmenu').outerWidth());
});
</script>

<script type="text/javascript">
$(document).on('click', '.show-overlay', function() {
  $('#loading-overlay').fadeIn('fast');
});

$(document).on('click', '.toggle-content', function() {
  $parent = $($(this).attr('data-parent'));
  $sibling = $parent.siblings();
  $sibling.show();
  $parent.hide();
});

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

    }).fail(function(error, status) {
      let message;
      console.log(error);
      if (error.status == 401 || error.status == 403) {
        message = 'Você não tem autorização para ver detalhes desse pagamento.';
      } else if (error.status == 424) {
        message = 'O serviço do PagSeguro está fora do ar.';
      } else {
        message = 'Não foi possível processar o seu pedido nesse momento';
      }

      $modal.find('.modal-body > div:first-child').html('<p class="text-center my-4 text-red">' + message + '</p>');

      $modal.find('#loading').hide();
    });
});
</script>

<script type="text/javascript">
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
});

$(document).ready(function() {
  fullDatePT($('.date-pt'));
});

$('#event-modal, #plan-modal, #payment-modal').on('hidden.bs.modal', function (e) {
  $(this).find('.modal-body > div:first-child').html('');
  $(this).find('#loading').show();
  $(this).find('.modal-footer').hide();
});

</script>

@stack('scripts')
</body>
</html>

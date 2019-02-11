<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} | O seu espaço de co-working no RJ</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/animate.css@3.5.2/animate.min.css">
    
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    
    <link href="{{ asset('css/primer.css') }}" rel="stylesheet">

    <style type="text/css">
    .fixed-bottom-right {
      position: fixed;
      bottom: .65em;
      right: 1em;
    }
    .spin {
      animation-name: spin;
      animation-duration: 1000ms;
      animation-iteration-count: infinite;
      animation-timing-function: linear; 
    }
    @keyframes spin {
      from {
        transform:rotate(0deg);
      }
      to {
        transform:rotate(360deg);
      }
    }
    </style>
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

<body>
    {{-- TEMPORARY PASSWORD FOR DEVELOPMENT PHASE --}}
    @if(session()->has('gate'))
    <div id="app">
        @include('layouts.navbar.bar')
        <main>
            @yield('content')
        </main>
        @include('layouts.footer.layout')
    </div>
    @else
      @include('layouts/dev')
    @endif

@include('components.alerts.event')

@if(session()->has('status'))
@include('components.alerts.success', ['message' => session('status')])
@endif

@if(session()->has('error'))
@include('components.alerts.error', ['message' => session('error')])
@endif

<script src="{{ mix('js/app.js') }}"></script>

<script type="text/javascript">
$(document).ready(function() {
  fullDatePT($('.date-pt'));
});

$('#event-modal, #plan-modal').on('hidden.bs.modal', function (e) {
  $(this).find('.modal-body > div:first-child').html('');
  $(this).find('#loading').show();
  $(this).find('.modal-footer').hide();
});

if ($('#scroll-mark').length > 0) {
  let $navbar = $('.navbar');
  let $navHeight = $navbar.outerHeight();
  let $scrollMark = $('#scroll-mark').offset().top;
  let $limit = $scrollMark - $navHeight;
  let $itemsToShow = $('.show-on-scroll');
  let $logoutButton = $navbar.find('button#logout');
  let $cookieAlert = $('#cookie-alert');

  $(window).scroll(function() {
    let $scrollTop = $(this).scrollTop();

    if ($scrollTop > $limit){
      $navbar.addClass('navbar-light position-fixed bg-white shadow-sm py-2 px-4 slideInDown').removeClass('navbar-dark py-4 px-5');
      $logoutButton.addClass('btn-red-outline').removeClass('btn-light');
      $itemsToShow.fadeIn();
      
      if (! getCookie('cookie_consent'))
        $cookieAlert.show();
      
    } else {
      $navbar.removeClass('navbar-light bg-white shadow-sm position-fixed py-2 px-4 slideInDown').addClass('navbar-dark py-4 px-5');
      $logoutButton.addClass('btn-light').removeClass('btn-red-outline');
      $itemsToShow.fadeOut();
    }
  });
}
</script>

<script type="text/javascript">
let end = $('#event-alert').attr('data-end');

$('#countdown').countdown(end, function(event) {
  $(this).text(event.strftime('%H:%M:%S'));
});

$("#countdown").countdown(end).on("finish.countdown", function(event) {
  $('#event-alert').fadeOut('fast', function() {
    $(this).remove();
  });
});

$('#event-alert').on('click', function() {
  $alert = $(this);

  if ($alert.hasClass('open')) {
    $alert.removeClass('open');
    $alert.css({
      'width': '2.85rem',
      'height': '2.85rem'
    });
    $alert.find('.content').hide();
  } else {
    $alert.addClass('open');

    $alert.css({
      'width': 'auto'
    });
    $alert.find('.content').show();
  }

  $alert.find('button').on('click', function() {
    $alert.fadeOut(function() {
      $(this).remove();
    });
  })
});

</script>

@stack('scripts')
</body>
</html>

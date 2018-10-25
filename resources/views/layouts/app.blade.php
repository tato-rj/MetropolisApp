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

    @stack('header')

</head>

<body>

    <div id="app">
        @include('layouts.navbar.layout')
        <main>
            @yield('content')
        </main>
        @include('layouts.footer.layout')
    </div>

<script src="{{ mix('js/app.js') }}"></script>

<script type="text/javascript">
$(document).ready(function() {
  // May need this
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
@stack('scripts')
</body>
</html>

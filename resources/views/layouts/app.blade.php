<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/animate.css@3.5.2/animate.min.css">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/primer.css') }}" rel="stylesheet">


</head>

<body>

    <div id="app">
        @include('components.navbar.layout')
        <main>
            @yield('content')
        </main>
        @include('components.footer.layout')
    </div>

<script src="{{ mix('js/app.js') }}"></script>
{{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAj8Se-1C_l46OGIKF4QwcgzUm7axrkBeE&callback=officeMap"></script> --}}
<script type="text/javascript">
function officeMap() {
    let escritorio = {lat: -22.907347, lng: -43.176417};

    let map = new google.maps.Map(
      document.getElementById('map'), {zoom: 17, center: escritorio});

    let marker = new google.maps.Marker({position: escritorio, map: map});
}
</script>

<script type="text/javascript">
$(document).ready(function() {
  // May need this
});

if ($('#scroll-mark').length > 0) {
  let $logo = $('.navbar-brand img');
  let $navbar = $('.navbar');
  let $navHeight = $navbar.outerHeight();
  let $scrollMark = $('#scroll-mark').offset().top;
  let $limit = $scrollMark - $navHeight;
  let $itemsToShow = $('.show-on-scroll');
  let $cookieAlert = $('#cookie-alert');

  $(window).scroll(function() {
    let $scrollTop = $(this).scrollTop();

    if ($scrollTop > $limit){
      $navbar.addClass('navbar-light position-fixed bg-white shadow-sm py-2 px-4 slideInDown').removeClass('navbar-dark py-4 px-5');
      // $bell.addClass('text-muted').removeClass('text-white');
      // $whiteLogo.hide();
      $itemsToShow.fadeIn();
      
      if (! getCookie('cookie_consent'))
        $cookieAlert.show();
      
    } else {
      $navbar.removeClass('navbar-light bg-white shadow-sm position-fixed py-2 px-4 slideInDown').addClass('navbar-dark py-4 px-5');
      // $bell.removeClass('text-muted').addClass('text-white');
      // $whiteLogo.show();
      $itemsToShow.fadeOut();
      // $('#help-button .animated').fadeOut();
    }
  });
}
</script>
@stack('scripts')
</body>
</html>

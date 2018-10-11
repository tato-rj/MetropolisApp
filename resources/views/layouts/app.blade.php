<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/primer.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        @include('components.navbar.layout')
        <main>
            @yield('content')
        </main>
    </div>

<script src="{{ asset('js/app.js') }}"></script>

<script type="text/javascript">
$('.toggle-finder').on('click', function() {
    let $this = $(this);
    let background = $this.attr('data-background');
    $('#lead').css('background-image', background);

    $this.addClass('btn-light').removeClass('btn-dark opacity-6').find('i').addClass('text-teal');
    $this.siblings().addClass('btn-dark opacity-6').removeClass('btn-light').find('i').removeClass('text-teal');
});
</script>
</body>
</html>

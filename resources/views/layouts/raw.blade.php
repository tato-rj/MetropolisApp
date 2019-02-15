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
.btn-back-thin {
    height: 30px;
    width: 30px;
    border-top: 1px solid #3c3c3c;
    border-left: 1px solid #3c3c3c;
    display: block;
    top: 40px;
    left: 40px;
    position: absolute;
    z-index: 9;
    transform: rotate(-45deg);
}
</style>
@stack('header')
</head>

<body>

    <div id="app">

        <main>
            @yield('content')
        </main>

    </div>

<script src="{{ mix('js/app.js') }}"></script>
@stack('scripts')
</body>
</html>

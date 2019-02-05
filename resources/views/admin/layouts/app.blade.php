<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} | Admin</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/animate.css@3.5.2/animate.min.css">
    
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    
    <link href="{{ asset('css/primer.css') }}" rel="stylesheet">

    <script>
        window.app = <?php echo json_encode([
            'csrfToken' => csrf_token(),
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

    <div id="app">
        {{-- @include('layouts.navbar.bar') --}}
        <main>
            @yield('content')
        </main>
        {{-- @include('layouts.footer.layout') --}}
    </div>

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

$('#event-modal').on('hidden.bs.modal', function (e) {
  $(this).find('.modal-body > div:first-child').html('');
  $(this).find('#loading').show();
  $(this).find('.modal-footer').hide();
});

</script>

@stack('scripts')
</body>
</html>

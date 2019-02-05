<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>{{ config('app.name') }} | Admin</title>

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
        
        <!-- App styles -->
        <link href="{{ asset('css/primer.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{mix('css/admin.css')}}">
    </head>

    <body data-ma-theme="teal">
        <main class="main">
            <div class="page-loader">
                <div class="page-loader__spinner">
                    <svg viewBox="25 25 50 50">
                        <circle cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
                    </svg>
                </div>
            </div>

            @include('admin.layouts.header')

            @include('admin.layouts.menu')

            <section class="content">
                @yield('content')
    
                @include('admin.layouts.footer')
            </section>
        </main>

        <!-- Javascript -->
        <!-- Vendors -->
        <script src="{{asset('admin-page/vendors/jquery.min.js')}}"></script>
        <script src="{{asset('admin-page/vendors/popper.min.js')}}"></script>
        <script src="{{asset('admin-page/vendors/bootstrap.min.js')}}"></script>
        <script src="{{asset('admin-page/vendors/jquery.scrollbar.min.js')}}"></script>
        <script src="{{asset('admin-page/vendors/jquery-scrollLock.min.js')}}"></script>

        <script src="{{asset('admin-page/vendors/jquery.flot.js')}}"></script>
        <script src="{{asset('admin-page/vendors/jquery.flot.resize.js')}}"></script>
        <script src="{{asset('admin-page/vendors/curvedLines.js')}}"></script>
        <script src="{{asset('admin-page/vendors/jquery.vmap.min.js')}}"></script>
        <script src="{{asset('admin-page/vendors/jquery.vmap.world.js')}}"></script>
        <script src="{{asset('admin-page/vendors/jquery.easypiechart.min.js')}}"></script>
        <script src="{{asset('admin-page/vendors/salvattore.min.js')}}"></script>
        <script src="{{asset('admin-page/vendors/jquery.sparkline.min.js')}}"></script>

        <script src="{{asset('admin-page/demo/js/flot-charts/curved-line.js')}}"></script>
        <script src="{{asset('admin-page/demo/js/flot-charts/dynamic.js')}}"></script>
        <script src="{{asset('admin-page/demo/js/flot-charts/line.js')}}"></script>
        <script src="{{asset('admin-page/demo/js/flot-charts/chart-tooltips.js')}}"></script>
        <script src="{{asset('admin-page/demo/js/other-charts.js')}}"></script>
        <script src="{{asset('admin-page/demo/js/jqvmap.js')}}"></script>

        <!-- App functions and actions -->
        <script src="{{mix('js/admin.js')}}"></script>
    </body>
</html>
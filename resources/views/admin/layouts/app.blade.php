<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Vendor styles -->
        <link rel="stylesheet" href="{{asset('admin-page/vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css')}}">
        <link rel="stylesheet" href="{{asset('admin-page/vendors/bower_components/animate.css/animate.min.css')}}">
        <link rel="stylesheet" href="{{asset('admin-page/vendors/bower_components/jquery.scrollbar/jquery.scrollbar.css')}}">
        <link rel="stylesheet" href="{{asset('admin-page/vendors/bower_components/fullcalendar/dist/fullcalendar.min.css')}}">

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
        
        <!-- App styles -->
        <link rel="stylesheet" href="{{asset('css/admin.css')}}">
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
        <script src="{{asset('admin-page/vendors/bower_components/jquery/dist/jquery.min.js')}}"></script>
        <script src="{{asset('admin-page/vendors/bower_components/popper.js/dist/umd/popper.min.js')}}"></script>
        <script src="{{asset('admin-page/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('admin-page/vendors/bower_components/jquery.scrollbar/jquery.scrollbar.min.js')}}"></script>
        <script src="{{asset('admin-page/vendors/bower_components/jquery-scrollLock/jquery-scrollLock.min.js')}}"></script>

        <script src="{{asset('admin-page/vendors/bower_components/Flot/jquery.flot.js')}}"></script>
        <script src="{{asset('admin-page/vendors/bower_components/Flot/jquery.flot.resize.js')}}"></script>
        <script src="{{asset('admin-page/vendors/bower_components/flot.curvedlines/curvedLines.js')}}"></script>
        <script src="{{asset('admin-page/vendors/bower_components/jqvmap/dist/jquery.vmap.min.js')}}"></script>
        <script src="{{asset('admin-page/vendors/bower_components/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
        <script src="{{asset('admin-page/vendors/bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js')}}"></script>
        <script src="{{asset('admin-page/vendors/bower_components/salvattore/dist/salvattore.min.js')}}"></script>
        <script src="{{asset('admin-page/vendors/jquery.sparkline/jquery.sparkline.min.js')}}"></script>
        <script src="{{asset('admin-page/vendors/bower_components/moment/min/moment.min.js')}}"></script>
        <script src="{{asset('admin-page/vendors/bower_components/fullcalendar/dist/fullcalendar.min.js')}}"></script>

        <!-- Charts and maps-->
        <script src="{{asset('admin-page/demo/js/flot-charts/curved-line.js')}}"></script>
        <script src="{{asset('admin-page/demo/js/flot-charts/dynamic.js')}}"></script>
        <script src="{{asset('admin-page/demo/js/flot-charts/line.js')}}"></script>
        <script src="{{asset('admin-page/demo/js/flot-charts/chart-tooltips.js')}}"></script>
        <script src="{{asset('admin-page/demo/js/other-charts.js')}}"></script>
        <script src="{{asset('admin-page/demo/js/jqvmap.js')}}"></script>

        <!-- App functions and actions -->
        <script src="{{asset('js/admin.js')}}"></script>
    </body>
</html>
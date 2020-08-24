<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('title')

    {{-- Tell the browser to be responsive to screen width --}}
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    {{-- Bootstrap 3.3.7 --}}
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
    {{-- Ionicons --}}
    <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}">
    {{-- Theme style --}}
    <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
    {{-- AdminLTE Skins. Choose a skin from the css folder instead of downloading all of them to reduce the load. --}}
    <link rel="stylesheet" href="{{ asset('dist/css/skins/_all-skins.min.css') }}">
    {{-- Morris chart --}}
    {{-- <link rel="stylesheet" href="{{ asset('bower_components/morris.js/morris.css') }}"> --}}
    {{-- jvectormap --}}
    {{-- <link rel="stylesheet" href="{{ asset('bower_components/jvectormap/jquery-jvectormap.css') }}"> --}}
    {{-- Date Picker --}}
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    {{-- Daterange picker --}}
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
    {{-- bootstrap wysihtml5 - text editor --}}
    {{-- <link rel="stylesheet" href="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}"> --}}
    {{-- DataTables --}}
    <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">

    @yield('styles')

    {{-- Google Font --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    @livewireStyles
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        @include('layouts.module.topbar')

        @include('layouts.module.sidebar')

        @yield('content')

        @include('layouts.module.footer')

        @include('layouts.module.controlsidebar')

    </div>
    {{-- ./wrapper --}}

    {{-- jQuery 3 --}}
    <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
    {{-- jQuery UI 1.11.4 --}}
    <script src="{{ asset('bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
    {{-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip --}}
    <script>
        $.widget.bridge('uibutton', $.ui.button);

        window.setTimeout(function() {
            $(".alert").fadeTo(1000, 500).slideUp(500, function(){
                // $(this).remove();
                $(this).slideUp(500);

            });
        }, 4000);

    </script>
    {{-- Bootstrap 3.3.7 --}}
    <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    {{-- DataTables --}}
    {{-- <script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script> --}}
    {{-- Morris.js charts --}}
    {{-- <script src="{{ asset('bower_components/raphael/raphael.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('bower_components/morris.js/morris.min.js') }}"></script> --}}
    {{-- Sparkline --}}
    <script src="{{ asset('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
    {{-- jvectormap --}}
    {{-- <script src="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script> --}}
    {{-- jQuery Knob Chart --}}
    {{-- <script src="{{ asset('bower_components/jquery-knob/dist/jquery.knob.min.js') }}"></script> --}}
    {{-- daterangepicker --}}
    <script src="{{ asset('bower_components/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    {{-- datepicker --}}
    <script src="{{ asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    {{-- Bootstrap WYSIHTML5 --}}
    {{-- <script src="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script> --}}
    {{-- Slimscroll --}}
    <script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    {{-- FastClick --}}
    <script src="{{ asset('bower_components/fastclick/lib/fastclick.js') }}"></script>
    {{-- AdminLTE App --}}
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    {{-- AdminLTE dashboard demo (This is only for demo purposes) --}}
    {{-- <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script> --}}
    {{-- AdminLTE for demo purposes --}}
    <script src="{{ asset('dist/js/demo.js') }}"></script>

    @yield('scripts')
    @livewireScripts
</body>

</html>

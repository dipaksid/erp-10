<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link type="image/png" sizes="32x32" rel="icon" href="{{ asset('img/erp3.png') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'ERP10'))</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- OLD Project CSS START -->
    <link href="{{ asset('css/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/resp_comman.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="{{ asset('css/admin/sb-admin-2.min.css') }}" rel="stylesheet">
    <!-- OLD Project CSS END here -->

    @include('flatpickr::components.style')
    @yield('styles')
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        .error { font-family: arial, verdana, sans-seriff; font-size: 14px; color: #FF0000; border-color: #FF0000;position: relative; }
    </style>
</head>
<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        @guest
            @include('layouts/guest-nav')
        @else
            @include('layouts/nav')
            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">
                <!-- Main Content -->
                <div id="content">
                    @include('layouts/header')
                    @yield('content')
                </div>
                <!-- End of Main Content -->
                @include('layouts/footer')
            </div>
            <!-- End of Content Wrapper -->
        @endguest
    </div>
    <!-- End of Page Wrapper -->
    @include('layouts/modal')
    <!--- scripts start ----->
    <script src="{{ asset('sp-admin/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('sp-admin/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('sp-admin/jquery-easing/jquery.easing.min.js') }}"></script>
    <script type="module" src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('sp-admin/chart.js/Chart.min.js') }}"></script>
    <!--- scripts end ----->
    @include('flatpickr::components.script')
    @yield('scripts')
</body>
</html>

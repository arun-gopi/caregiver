<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- preloader css -->
    <link rel="stylesheet" href="{{ asset('css/preloader.min.css') }}" type="text/css" />
    <!-- Bootstrap Css -->
    <link href="{{ asset('css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    @yield('style')
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" id="app-style" rel="stylesheet" type="text/css">

</head>

<body data-layout="horizontal">

        <div id="id layout-wrapper">
            <!--Header-->
            @include('partials.topbar')
            <!--Header End-->
            <!--Sidebar-->
            @include('partials.topnav')
            <!--Sidebar End-->
            <main class="py-4">
                @yield('content')
            </main>
        </div>
    <script src="{{ asset('libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('libs/typehead/typeahead.bundle.js') }}"></script>
    <script src="{{ asset('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('libs/alpinejs/cdn.min.js') }}"></script>
    <script src="{{ asset('libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('libs/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <!-- pace js -->
    <script src="{{ asset('libs/pace-js/pace.min.js') }}"></script>  
     @yield('script')
    <script src="{{ asset('js/app.js') }}"></script>
    
    <script>
        feather.replace()
    </script>
</body>

</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title inertia id="app_title">{{ config('app.name', 'Laravel') }}</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

        <!-- Styles -->
{{--        <link rel="stylesheet" href="{{ mix('css/app.css') }}">--}}
{{--        <link rel="stylesheet" href="{{ mix('css/dashboard.css') }}">--}}

        <link rel="stylesheet" href="/css/OverlayScrollbars.min.css">
        <link rel="stylesheet" href="/css/fontawesome_all.min.css">

        <link rel="stylesheet" href="/css/adminlte.min.css">
        <link rel="stylesheet" href="/css/admin_custom.css">

        @routes

        <!-- Scripts -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script src="/js/Chart.bundle.js"></script>

{{--        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>--}}

        <script src="/js/OverlayScrollbars.min.js"></script>

{{--        <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>--}}

        <script src="{{ mix('js/app.js') }}" defer></script>
{{--        <script src="{{ mix('js/dashboard.js') }}" defer></script>--}}
    </head>
    <body class="bg-light sidebar-mini layout-fixed layout-footer-fixed">
        @inertia
    </body>
</html>

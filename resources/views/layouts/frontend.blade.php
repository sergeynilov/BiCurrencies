<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title inertia id="app_title">{{ config('app.name', 'Laravel') }}</title>

    <link rel="shortcut icon" type="image/x-icon" href="/images/frontend_favicon.ico">

    <link href="https://fonts.googleapis.com/css2?family=Yantramanav:wght@300;400;500;700;900&amp;display=swap"
          rel="stylesheet">

    <!-- Styles -->


    @routes

    <!-- Scripts -->

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="/css/theme.css">
{{--    <link rel="stylesheet" href="{{ mix('css/custom_frontend.css') }}">--}}

{{--    <script src="/vendors/@popperjs/popper.min.js"></script>--}}
    <script src="/vendors/bootstrap/bootstrap.min.js"></script>
    <script src="/vendors/is/is.min.js"></script>

{{--    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>--}}

    <script src="/vendors/fontawesome/all.min.js"></script>

{{--    <script src="/assets/js/theme.js"></script>--}}

    <script src="{{ mix('js/app.js') }}" defer></script>

</head>
<body class="bg-light sidebar-mini layout-fixed layout-footer-fixed">
@inertia
</body>
</html>

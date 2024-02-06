<!doctype html>
<html lang="en">

<head>
    <title>CarRental &mdash; Free Website Template by Colorlib</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('website/fonts/icomoon/style.css') }}">

    <link rel="stylesheet" href="{{ asset('website/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('website/css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('website/css/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('website/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('website/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('website/fonts/flaticon/font/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('website/css/aos.css') }}">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{ asset('website/css/style.css') }}">

</head>

<body>

    <div class="site-wrap" id="home-section">
        @include('layouts.parts.header')

        @yield('main')

        @include('layouts.parts.footer')
    </div>

    <script src="{{ asset('website/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('website/js/popper.min.js') }}"></script>
    <script src="{{ asset('website/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('website/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('website/js/jquery.sticky.js') }}"></script>
    <script src="{{ asset('website/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('website/js/jquery.animateNumber.min.js') }}"></script>
    <script src="{{ asset('website/js/jquery.fancybox.min.js') }}"></script>
    <script src="{{ asset('website/js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('website/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('website/js/aos.js') }}"></script>

    <script src="{{ asset('website/js/main.js') }}"></script>

</body>

</html>

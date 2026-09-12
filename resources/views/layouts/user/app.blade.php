<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>E-Maintain@FSDK - @yield('title')</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="{{ asset('user-template/assets/img/fsdk.png') }}" rel="icon">
    <link href="{{ asset('user-template/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Vendor CSS -->
    <link href="{{ asset('user-template/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('user-template/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('user-template/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('user-template/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('user-template/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS -->
    <link href="{{ asset('user-template/assets/css/main.css') }}" rel="stylesheet">
</head>

<body class="index-page">

    <main class="main">
        @include('layouts.user.navbar')
        @yield('content')
    </main>

    @include('layouts.user.footer')

    <!-- Vendor JS -->
    <script src="{{ asset('user-template/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('user-template/assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('user-template/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('user-template/assets/vendor/glightbox/js/glightbox.js') }}"></script>
    <script src="{{ asset('user-template/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('user-template/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('user-template/assets/js/main.js') }}"></script>

    @yield('script')
</body>
</html>
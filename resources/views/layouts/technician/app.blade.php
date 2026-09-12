<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Tech e-Maintain@FSDK - @yield('title')
    </title>

    <meta name="description"
        content="e-Maintain@FSDK Facility and Laboratory Maintenance Management System">

    <meta name="author"
        content="e-Maintain@FSDK">

    <!-- Favicon -->
    <link rel="icon"
        type="image/png"
        href="{{ asset('tech-template/assets/images/favicon.ico') }}">

    <!-- Bootstrap -->
    <link rel="stylesheet"
        href="{{ asset('tech-template/assets/libs/bootstrap/css/bootstrap.min.css') }}">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
        href="{{ asset('tech-template/assets/libs/bootstrap-icons/bootstrap-icons.css') }}">

    <!-- ApexCharts -->
    <link rel="stylesheet"
        href="{{ asset('tech-template/assets/libs/apexcharts/apexcharts.css') }}">

    <!-- Flatpickr -->
    <link rel="stylesheet"
        href="{{ asset('tech-template/assets/libs/flatpickr/flatpickr.min.css') }}">

    <!-- Main CSS -->
    <link rel="stylesheet"
        href="{{ asset('tech-template/assets/css/main.css') }}">

    @stack('styles')

</head>

<body>

    <!-- Sidebar -->
    @include('layouts.technician.sidebar')

    <!-- Main Wrapper -->
    <div class="main-wrapper">

        <!-- Navbar -->
        @include('layouts.technician.navbar')


        <!-- Main Content -->
        <main class="container-fluid py-4">

            @yield('content')

        </main>


        <!-- Footer -->
        @include('layouts.technician.footer')

    </div>


    <!-- Bootstrap -->
    <script src="{{ asset('tech-template/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- ApexCharts -->
    <script src="{{ asset('tech-template/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Flatpickr -->
    <script src="{{ asset('tech-template/assets/libs/flatpickr/flatpickr.min.js') }}"></script>

    <!-- Dashboard JS -->
    <script src="{{ asset('tech-template/assets/js/dashboard.js') }}"></script>

    @stack('scripts')

</body>

</html>
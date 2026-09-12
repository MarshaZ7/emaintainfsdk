<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title> E-Maintain@FSDK - @yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport"/>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('admin-template/assets/img/kaiadmin/favicon.ico') }}" type="image/x-icon"
    />
    <!-- Fonts and icons -->
    <script src="{{ asset('admin-template/assets/js/plugin/webfont/webfont.min.js') }}"></script>

    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons"
                ],
                urls: [
                    "{{ asset('admin-template/assets/css/fonts.min.css') }}"
                ]
            },
            active: function () {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('admin-template/assets/css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('admin-template/assets/css/plugins.min.css') }}"/>

    <link rel="stylesheet" href="{{ asset('admin-template/assets/css/kaiadmin.min.css') }}"/>
    @stack('styles')
    <style>
        .logout-link {
    display: flex !important;
    align-items: center;
    width: 100%;
    text-align: left;
    color: inherit !important;
    padding: 10px 15px;
    cursor: pointer;
}

.logout-link i {
    width: 30px;
    font-size: 16px;
}

.logout-link p {
    margin: 0;
}

.logout-link:hover {
    background: rgba(255, 255, 255, 0.08);
    color: #fff !important;
}
    </style>
</head>

<body>

    <div class="wrapper">

        {{-- Sidebar --}}
        @include('layouts.admin.sidebar')

        {{-- Main Panel --}}
        <div class="main-panel">

            {{-- Navbar --}}
            @include('layouts.admin.navbar')

            {{-- Page Content --}}
            <div class="container">
                <div class="page-inner">

                    @yield('content')

                </div>
            </div>

            {{-- Footer --}}
            @include('layouts.admin.footer')

        </div>

    </div>


    <!-- Core JS Files -->
    <script src="{{ asset('admin-template/assets/js/core/jquery-3.7.1.min.js') }}"></script>

    <script src="{{ asset('admin-template/assets/js/core/popper.min.js') }}"></script>

    <script src="{{ asset('admin-template/assets/js/core/bootstrap.min.js') }}"></script>


    <!-- jQuery Scrollbar -->
    <script src="{{ asset('admin-template/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

    <!-- Chart JS -->
    <script src="{{ asset('admin-template/assets/js/plugin/chart.js/chart.min.js') }}"></script>

    <!-- jQuery Sparkline -->
    <script src="{{ asset('admin-template/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- Chart Circle -->
    <script src="{{ asset('admin-template/assets/js/plugin/chart-circle/circles.min.js') }}"></script>

    <!-- Datatables -->
    <script src="{{ asset('admin-template/assets/js/plugin/datatables/datatables.min.js') }}"></script>

    <!-- Bootstrap Notify -->
    <script src="{{ asset('admin-template/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

    <!-- Vector Maps -->
    <script src="{{ asset('admin-template/assets/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('admin-template/assets/js/plugin/jsvectormap/world.js') }}"></script>

    <!-- Sweet Alert -->
    <script src="{{ asset('admin-template/assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

    <!-- Kaiadmin JS -->
    <script src="{{ asset('admin-template/assets/js/kaiadmin.min.js') }}"></script>

    @stack('scripts')

</body>

</html>
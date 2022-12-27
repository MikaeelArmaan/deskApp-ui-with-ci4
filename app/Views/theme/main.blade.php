<!DOCTYPE html>
<html>

<head>
    <base href="{{ base_url('/') }}" target="_top">
    <meta charset="utf-8">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Auth') }}</title>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="vendors/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="vendors/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="vendors/images/favicon-16x16.png">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ base_url('vendors/styles/core.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ base_url('vendors/styles/icon-font.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ base_url('src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ base_url('src/plugins/datatables/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ base_url('vendors/styles/style.css') }}">
    {{-- <link href="{{ base_url('css/app.css') }}" rel="stylesheet"> --}}
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            //dataLayer.push(arguments);
        }
        //gtag('js', new Date());

        //gtag('config', 'UA-119386393-1');
    </script>
    <script src="<?= site_url('src/scripts/jquery.min.js') ?>"></script>
    <script>
        $(window).on('load', function() {
            $('.pre-loader').fadeOut();
        });
    </script>
    @stack('styles')
</head>

<body id="page-top">
    @include('partials.loader')
    <!-- Topbar -->
    @include('theme.header')
    <!-- End of Topbar -->

    <!-- Sidebar -->
    @include('theme.sidebar')
    <!-- End of Sidebar -->

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">

                <!-- Page Heading -->
                @yield('content')
                @yield('modal')
                <div class="footer-wrap pd-20 mb-20 card-box">
                    <span>&copy; {{ date('Y') }} <a href="https://rockmontwebsolutions.in/"
                            target="_blank">RockmontWebSolutions</a> Developed By : <a href="mailto:armaancomps@gmail.com">Arman Khan</a></span>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Main Content -->


    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- js -->
    <script src="{{ base_url('vendors/scripts/core.js') }}"></script>
    <script src="{{ base_url('vendors/scripts/script.min.js') }}"></script>
    <script src="{{ base_url('vendors/scripts/process.js') }}"></script>
    <script src="{{ base_url('vendors/scripts/layout-settings.js') }}"></script>
    {{-- <script src="{{ base_url('js/manifest.js') }}"></script>
    <script src="{{ base_url('js/vendor.js') }}"></script>
    <script src="{{ base_url('js/app.js') }}"></script> --}}
    <script src="{{ base_url('js/custom.js') }}"></script>
    @stack('scripts')
</body>

</html>

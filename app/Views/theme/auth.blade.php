<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
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
    <link href="{{ base_url('css/app.css') }}" rel="stylesheet">
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
</head>

<body class="login-page">
    @include('partials.loader')
    <div class="login-header box-shadow">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="brand-logo">
                <a href="login.html">
                    <img src="vendors/images/deskapp-logo.svg" alt="">
                </a>
            </div>
            <div class="login-menu">
                <ul>
                    <li><a href="register.html">Register</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-7">
                    <img src="vendors/images/login-page-img.png" alt="">
                </div>
                @yield('content')
            </div>
        </div>
    </div>
   
    {{-- 
@yield('modal')
</div> --}}

    <!-- Custom scripts for all pages-->
    <script src="{{ base_url('js/manifest.js') }}"></script>
    <script src="{{ base_url('js/vendor.js') }}"></script>
    <script src="{{ base_url('js/app.js') }}"></script>
    <script src="{{ base_url('js/custom.js') }}"></script>
    <script src="<?= base_url('vendors/scripts/core.js') ?>"></script>
    <script src="<?= base_url('vendors/scripts/script.min.js') ?>"></script>
    <script src="<?= base_url('vendors/scripts/process.js') ?>"></script>
    <script src="<?= base_url('vendors/scripts/layout-settings.js') ?>"></script>
    <script src="<?= base_url('src/plugins/sweetalert2/sweetalert2.all.js') ?>"></script> 

    @stack('scripts')
</body>

</html>

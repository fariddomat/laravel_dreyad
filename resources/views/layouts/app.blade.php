<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Dashboard') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets') }}/css/nucleo-icons.css" rel="stylesheet" />
    <link href="{{ asset('assets') }}/css/nucleo-svg.css" rel="stylesheet" />
    <style>
        body {
            direction: rtl;
        }

        .sidenav {
            right: 0;
            left: auto;
        }

        @media (min-width: 1200px) {
            .sidenav.fixed-start+.main-content {
                margin-right: 17.125rem;
                /* Adjust based on your layout */
                margin-left: 0 !important;
            }
        }

        .navbar-brand {
            flex-direction: row-reverse;
            /* Make sure logo and text are aligned RTL */
        }
    </style>
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets') }}/css/material-dashboard.css?v=3.0.0" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    <style>
        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        span,
        a,
        button,
        input,
        textarea,
        li,
        td,
        th {
            font-family: 'Cairo', sans-serif !important;
        }

        h1,
        h2,
        h3 {
            font-weight: 700;
            /* عريض */
        }

        p,
        span {
            font-weight: 400;
            /* عادي */
        }

        .bg-gradient-primary {
            background-image: linear-gradient(195deg, #38fbbb 0%, #561BD8 100%) !important;
        }

        .bg-white {
            --bs-bg-opacity: 1;
            background-color: rgba(255, 255, 255, 0.55) !important;
        }

        .card {
            padding: 1rem !important;
        }

        select {
            direction: ltr !important;
        }

        .bg-gradient-primary>.text-white {
            color: #212122 !important;
            font-size: 1.5rem;
            font-weight: bold;
        }
    </style>
<style>
    #preloader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: #ffffff;
        z-index: 9999;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    @media (max-width: 1199.98px) {
    .g-sidenav-show.rtl .sidenav {
        transform: translateX(7.125rem);
    }

    .g-sidenav-show:not(.rtl) .sidenav {
        /* transform: translateX(-1.125rem); */
    }

    .sidenav {
        transition: transform 0.3s ease-in-out;
    }
}
#iconSidenav{
    right: 0 !important;
  left: auto !important;
}

</style>
<script>
    document.addEventListener("DOMContentLoaded", function() {
    const iconSidenav = document.getElementById("iconSidenav");
    const sidenav = document.getElementById("sidenav-main");
    const body = document.body;

    if (iconSidenav) {
        iconSidenav.addEventListener("click", function() {
            if (body.classList.contains("g-sidenav-show")) {
                body.classList.remove("g-sidenav-show");
            } else {
                body.classList.add("g-sidenav-show");
            }
        });
    }
});

</script>
    @yield('styles')
</head>

<body class="g-sidenav-show bg-gray-200 }}">
    <div id="preloader" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: #ffffff; z-index: 9999; display: flex; justify-content: center; align-items: center;">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    @include('components.navbars.sidebar')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg overflow-x-hidden">
        @include('layouts.navigation')



        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main
            style="background: url('{{ asset('bg.jpg') }}') no-repeat center center; background-size: cover; min-height:100vh">
            {{ $slot }}
        </main>
    </main>
</body>

<script src="{{ asset('assets') }}/js/core/popper.min.js"></script>
<script src="{{ asset('assets') }}/js/core/bootstrap.min.js"></script>
<script src="{{ asset('assets') }}/js/plugins/perfect-scrollbar.min.js"></script>
<script src="{{ asset('assets') }}/js/plugins/smooth-scrollbar.min.js"></script>
@stack('js')
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{ asset('assets') }}/js/material-dashboard.min.js?v=3.0.0"></script>


@yield('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var preloader = document.getElementById('preloader');
        window.addEventListener('load', function() {
            preloader.style.display = 'none';
        });
    });
</script>
</html>

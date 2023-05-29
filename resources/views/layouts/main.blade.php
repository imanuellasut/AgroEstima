<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- PWA  -->
    <meta name="theme-color" content="#6777ef"/>
    <link rel="apple-touch-icon" href="{{ asset('img/icons8-ear-of-corn-48.png') }}">
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <!-- start: Icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <!-- start: Icons -->
    <!-- start: CSS -->
    <link rel="stylesheet" href="{{ asset('Template-Dashboard/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Template-Dashboard/css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <!-- end: CSS -->
    <link rel="icon" href="{{ asset('img/icons8-ear-of-corn-48.png') }}">
    <title>@yield('title') | PERKIRAAN HASIL PANEN JAGUNG</title>
</head>

<body>

    <!-- start: Sidebar -->
    <div class="sidebar position-fixed top-0 bottom-0 bg-white border-end">
        <div class="d-flex align-items-center p-3">
            <a href="#" class="sidebar-logo text-uppercase fw-bold text-decoration-none text-indigo fs-4">Agroestima</a>
            <i class="sidebar-toggle ri-arrow-left-circle-line ms-auto fs-5 d-none d-md-block"></i>
        </div>
        <hr>
        @yield('card-profile')
        <ul class="sidebar-menu p-3 m-0 mb-0">
            @yield('dashboard')

            @yield('pertanian')

            @yield('prediksi')

            @yield('kriteria')

            @yield('data-user')

            @yield('profile')

            <hr class="hr-bottom">
            <li class="sidebar-menu-item ">
                <a   href="{{ route('logout') }}" class="" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                    <i class="ri-logout-circle-fill sidebar-menu-item-icon"></i>
                    Keluar
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
    <div class="sidebar-overlay"></div>
    <!-- end: Sidebar -->

    <!-- start: Main -->
    <main class="bg-light">
        <div class="p-2">
            <!-- start: Navbar -->
            @yield('navbar')
            <!-- end: Navbar -->

            <!-- start: Content -->
            <div class="py-4">
                @yield('content')
            </div>
            <!-- end: Content -->
        </div>
    </main>
    <!-- end: Main -->

    <!-- start: JS -->
    <script src="{{ asset('Template-Dashboard/js/jquery.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js" integrity="sha512-sW/w8s4RWTdFFSduOTGtk4isV1+190E/GghVffMA9XczdJ2MDzSzLEubKAs5h0wzgSJOQTRYyaz73L3d6RtJSg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('Template-Dashboard/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('Template-Dashboard/js/script.js') }}"></script>
    <script src=https://code.jquery.com/jquery-3.5.1.js""></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <!-- Start: PWA -->
    <script src="{{ asset('sw.js') }}"></script>
    <script>
        if (!navigator.serviceWorker.controller) {
            navigator.serviceWorker.register("sw.js").then(function (reg) {
                console.log("Service worker has been registered for scope: " + reg.scope);
            });
        }
    </script>
    <!-- End: PWA -->

    @yield('script')

    <!-- end: JS -->
</body>

</html>

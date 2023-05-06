<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- start: Icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <!-- start: Icons -->
    <!-- start: CSS -->
    <link rel="stylesheet" href="{{ asset('Template-Dashboard/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Template-Dashboard/css/style.css') }}">
    <!-- end: CSS -->
    <title>PERKIRAAN HASIL PANEN JAGUNG</title>
</head>

<body>

    <!-- start: Sidebar -->
    <div class="sidebar position-fixed top-0 bottom-0 bg-white border-end">
        <div class="d-flex align-items-center p-3">
            <a href="#" class="sidebar-logo text-uppercase fw-bold text-decoration-none text-indigo fs-4">ArgoEstima</a>
            <i class="sidebar-toggle ri-arrow-left-circle-line ms-auto fs-5 d-none d-md-block"></i>
        </div>
        <hr>
        <a href="#" class="to-profile">
            @yield('card-profile')
        </a>
        <ul class="sidebar-menu p-3 m-0 mb-0">
            <li class="sidebar-menu-item active">
                @yield('dashboard')
            </li>
            <li class="sidebar-menu-item ">
                @yield('pertanian')
            </li>
            <li class="sidebar-menu-item ">
                @yield('prediksi')
            </li>
            <li class="sidebar-menu-item ">
                @yield('kriteria')
            </li>
            <li class="sidebar-menu-item">
                @yield('data-user')
            </li>
            <li class="sidebar-menu-item ">
                @yield('profile')
            </li>
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
    <!-- end: JS -->
</body>

</html>

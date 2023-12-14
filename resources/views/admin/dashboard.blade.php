@extends('layouts.main')

@section('title', 'Dashboard')

<!-- Start: Sidebar -->
@section('card-profile')
    <a href="{{ route('profil_admin') }}" class="to-profile">
        <div class="d-flex card-profile p-2">
            <div class="avatar-profile">
                @if(Auth::user()->foto != null)
                <img src="{{ asset('img/profile/' .Auth::user()->foto ) }}"  style="aspect-ratio: 1 / 1; object-fit: cover">
                @else
                <img src="{{ asset('Template-Dashboard/img/default-profile.jpg') }}"  alt="" style="aspect-ratio: 1 / 1; object-fit: cover">
                @endif
            </div>
            <div class="info-profile">
                @php
                    $data = Auth::user()->name;
                    $name = implode(" ", array_slice(explode(" ", $data), 0, 2));
                @endphp
                <span>{{ $name }}</span>
                <br>
                @if (Auth::user()->role = 1)
                    <small>Admin</small>
                @else
                    <small>Anggota</small>
                @endif
            </div>
        </div>
    </a>
@endsection

@section('dashboard')
    <li class="sidebar-menu-item active">
        <a href="{{ route('dashboard-admin') }}">
            <iconify-icon icon="bxs:dashboard" class="sidebar-menu-item-icon"></iconify-icon>
            Dashboard
        </a>
    </li>
@endsection

@section('data_pertanian')
    <li class="sidebar-menu-item">
        <a href="{{ route('d_pertanian_admin') }}" class="">
            <iconify-icon icon="material-symbols:chart-data-rounded" class="sidebar-menu-item-icon"></iconify-icon>
            Data Pertanian
        </a>
    </li>
@endsection

@section('data_prediksi')
    <li class="sidebar-menu-item">
        <a href="{{ route('d_prediksi_admin') }}" class="">
            <i class="ri-file-chart-fill sidebar-menu-item-icon"></i>
            Prediksi Panen
        </a>
    </li>
@endsection

@section('data_akurasi_fuzzy')
    <li class="sidebar-menu-item ">
        <a href="{{ route('d_akurasi_fuzzy_admin') }}" class="">
            <iconify-icon icon="icon-park-solid:data-screen" class="sidebar-menu-item-icon"></iconify-icon>
            Akurasi Fuzzy
        </a>
    </li>
@endsection

@section('textMasterFuzzy')
    <hr>
    <p class="master-text">Master Fuzzy</p>
@endsection

@section('data-variabel')
    <li class="sidebar-menu-item">
        <a href="{{ route('f_variabel_fuzzy') }}" class="">
            <iconify-icon icon="mdi:folder-sync" class="sidebar-menu-item-icon"></iconify-icon>
            Data Variabel
        </a>
    </li>
@endsection

@section('data-himpunan')
    <li class="sidebar-menu-item">
        <a href="{{ route('f_himpunan_fuzzy') }}" class="">
            <iconify-icon icon="material-symbols:folder-data" class="sidebar-menu-item-icon"></iconify-icon>
            Data Himpunan
        </a>
    </li>
@endsection

@section('data-aturan')
    <li class="sidebar-menu-item">
        <a href="{{ route('f_aturan_fuzzy') }}" class="">
            <iconify-icon icon="material-symbols:folder-managed" class="sidebar-menu-item-icon"></iconify-icon>
            Data Aturan
        </a>
    </li>
@endsection

@section('textMasterUser')
    <hr>
    <p class="master-text">Master User</p>
@endsection

@section('data-anggota')
    <li class="sidebar-menu-item">
        <a href="{{ route('get-anggota') }}" class="">
            <iconify-icon icon="clarity:administrator-solid" class="sidebar-menu-item-icon"></iconify-icon>
            Data Anggota
        </a>
    </li>
@endsection

@section('profile')
    <li class="sidebar-menu-item">
        <a href="{{ route('profil_admin') }}" class="">
            <iconify-icon icon="iconamoon:profile-circle-fill" class="sidebar-menu-item-icon"></iconify-icon>
            Profil
        </a>
    </li>
@endsection
<!-- End: Sidebar -->

@section('navbar')
    <nav class="px-3 py-2 bg-white rounded shadow-sm text-muted">
        <i class="ri-menu-line sidebar-toggle me-3 d-block d-md-none"></i>
        <iconify-icon icon="bxs:dashboard" class="sidebar-menu-item-icon"></iconify-icon>
        <p class="mb-0 me-auto p-1">Dashboard</p>
    </nav>
@endsection

<!-- Start: Content -->
@section('content')
    <!-- start: Summary -->
    <div class="row g-3">
        <div class="col-12 col-sm-6 col-lg-3">
            <a href="#"  class="text-dark text-decoration-none bg-white p-3 rounded shadow-sm d-flex justify-content-between summary-danger">
                <div> <i class="ri-plant-fill summary-icon bg-danger mb-2"></i> </div>
                <div class="info-card">
                    <p>Total Tanam</p>
                    <div class="info-card-satuan">
                        <h4>{{  $totalTanam }}</h4>
                        <p>Tanam</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-12 col-sm-6 col-lg-3">
            <a href="#"  class="text-dark text-decoration-none bg-white p-3 rounded shadow-sm d-flex justify-content-between summary-indigo">
                <div> <i class="ri-bar-chart-2-fill summary-icon bg-indigo mb-2"></i> </div>
                <div class="info-card">
                    <p>Total Panen</p>
                    <div class="info-card-satuan">
                        @php
                            $tonPanen = $totalPanen / 1000;
                            // $tonPanen = round($tonPanen, 2);
                            $tonPanen = number_format($tonPanen, 2, ',' , '.');
                        @endphp
                        @if($totalPanen > 100000)
                        <h4>{{ $tonPanen }}</h4>
                        <p>Ton</p>
                        @else
                        <h4>{{ $totalPanen }}</h4>
                        <p>Kg</p>
                        @endif
                    </div>
                </div>
            </a>
        </div>
        <div class="col-12 col-sm-6 col-lg-3">
            <a href="#" class="text-dark text-decoration-none bg-white p-3 rounded shadow-sm d-flex justify-content-between summary-primary">
                <div>
                    <i class="ri-database-2-fill summary-icon bg-primary mb-2"></i>
                </div>
                <div class="info-card">
                    @php
                        $ton = $totalPrediksi / 1000;
                        // $ton = round($ton, 2);
                        $ton = number_format($ton, 2, ',' , '.');
                    @endphp
                    <p class="text-end">Total Prediksi</p>
                    <div class="info-card-satuan">
                        @if($totalPrediksi > 100000)
                        <h4>{{ $ton }}</h4>
                        <p>Ton</p>
                        @else
                        <h4>{{ $totalPrediksi }}</h4>
                        <p>Kg</p>
                        @endif
                    </div>
                </div>
            </a>
        </div>
        <div class="col-12 col-sm-6 col-lg-3 card-dashboard">
            <a href="#"  class="text-dark text-decoration-none bg-white p-3 rounded shadow-sm d-flex justify-content-between summary-success">
                <div>
                    <i class="ri-line-chart-fill summary-icon bg-success mb-2"></i>
                </div>
                <div class="info-card">
                    <p>Akurasi Prediksi</p>
                    <div class="info-card-satuan">
                        @if($akurasiPrediksi > 100)
                            <h4>100</h4>
                            <p>%</p>
                        @else
                        @php
                            $akurasiPrediksi = number_format($akurasiPrediksi, 2, ',' , '.');
                        @endphp
                            <h4>{{ $akurasiPrediksi }}</h4>
                            <p>%</p>
                        @endif
                    </div>
                </div>
            </a>
        </div>
    </div>
    <!-- end: Summary -->
    <!-- start: Graph -->
    <div class="card-header bg-white text-center mt-3 p-3 shadow-sm rounded">
        <div class="row g-3">
            <div class="card">
                <div class="card-header bg-white text-center">
                    Perbandingan Total Panen Jagung <br>
                    (Data Aktual VS Data Prediksi)
                </div>
                <div class="card-body w-100">
                    <canvas id="barChart" style="max-height: 270px;"></canvas>
                </div>
            </div>
        </div>
    </div>
    <!-- end: Graph -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        var ctx = document.getElementById('barChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode(array_keys($Produksi)) !!},
                datasets: [{
                    label: 'Data Aktual',
                    data: {!! json_encode(array_values($Produksi)) !!},
                    backgroundColor: 'rgb(150, 186, 84)',
                    borderWidth: 1
                },
                {
                    label: 'Data Prediksi',
                    data: {!! json_encode(array_values($Prediksi)) !!},
                    backgroundColor: 'rgba(13, 110, 253)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>

@endsection
<!--End: Content -->

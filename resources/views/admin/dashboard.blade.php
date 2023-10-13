@extends('layouts.main')

@section('title', 'Dashboard')

<!-- Start: Sidebar -->
@section('card-profile')
    <a href="{{ route('profil_admin') }}" class="to-profile">
        <div class="d-flex card-profile p-2">
            <div class="avatar-profile">
                <img src="{{ asset('Template-Dashboard/img/profile-reggy.jpg') }}" alt="" >
            </div>
            <div class="info-profile">
                @if (Auth::user()->role = 1)
                    <small>Admin</small>
                @else
                    <small>Anggota</small>
                @endif
                <br>
                @php
                    $data = Auth::user()->name;
                    $name = implode(" ", array_slice(explode(" ", $data), 0, 2));
                @endphp
                <span>{{ $name }}</span>
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
        <a href="{{ route('d_aturan_fuzzy_admin') }}" class="">
            <iconify-icon icon="icon-park-solid:data-screen" class="sidebar-menu-item-icon"></iconify-icon>
            Akurasi Fuzzy
        </a>
    </li>
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
    <nav class="px-3 py-2 bg-white rounded shadow-sm">
        <i class="ri-menu-line sidebar-toggle me-3 d-block d-md-none"></i>
        <h5 class="fw-bold mb-0 me-auto p-1">Dashboard</h5>
    </nav>
@endsection

<!-- Start: Content -->
@section('content')
    <!-- start: Summary -->
    <div class="row g-3">
        <div class="col-12 col-sm-6 col-lg-3">
            <a href="#"
                class="text-dark text-decoration-none bg-white p-3 rounded shadow-sm d-flex justify-content-between summary-primary">
                <div>
                    <i class="ri-road-map-fill summary-icon bg-primary mb-2"></i>
                </div>
                <div class="info-card">
                    <p>Luas Lahan</p>
                    <div class="info-card-satuan">
                        <h4>100</h4>
                        <p>Ton</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-12 col-sm-6 col-lg-3">
            <a href="#"
                class="text-dark text-decoration-none bg-white p-3 rounded shadow-sm d-flex justify-content-between summary-indigo">
                <div>
                    <i class="ri-bar-chart-2-fill summary-icon bg-indigo mb-2"></i>
                </div>
                <div class="info-card">
                    <p>Total Produksi</p>
                    <div class="info-card-satuan">
                        <h4>100</h4>
                        <p>Ton</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-12 col-sm-6 col-lg-3 card-dashboard">
            <a href="#"
                class="text-dark text-decoration-none bg-white p-3 rounded shadow-sm d-flex justify-content-between summary-success">
                <div>
                    <i class="ri-line-chart-fill summary-icon bg-success mb-2"></i>
                </div>
                <div class="info-card">
                    <p>Produktivias</p>
                    <div class="info-card-satuan">
                        <h4>100</h4>
                        <p>Ha/Ton</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-12 col-sm-6 col-lg-3">
            <a href="#"
                class="text-dark text-decoration-none bg-white p-3 rounded shadow-sm d-flex justify-content-between summary-danger">
                <div>
                    <i class="ri-plant-fill summary-icon bg-danger mb-2"></i>
                </div>
                <div class="info-card">
                    <p>Total Penanaman</p>
                    <div class="info-card-satuan">
                        <h4>100</h4>
                        <p>Tanam</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <!-- end: Summary -->
    <!-- start: Graph -->
    <div class="card-header bg-white text-center mt-3 p-3 shadow-sm rounded">
        <div class="row g-3">
            <div class="card border-0 col-12 col-sm-6 col-lg-6 p-4">
                <div class="card-header bg-white text-center">
                    Perbandingan Total Panen Jagung <br>
                    (Data Aktual VS Data Prediksi)
                </div>
                <div class="card-body">
                    <canvas id="sales-chart"></canvas>
                </div>
            </div>
            <div class="card border-0 col-12 col-sm-6 col-lg-6 p-4">
                <div class="card-header bg-white text-center">
                    Total Produksi Panen Jagung <br>
                    Setiap Masa Panen
                </div>
                <div class="card-body">
                    <canvas id="sales-chart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <!-- end: Graph -->
@endsection
<!--End: Content -->

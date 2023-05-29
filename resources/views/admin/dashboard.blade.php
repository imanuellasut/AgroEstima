@extends('layouts.main')

@section('title', 'Dashboard')

<!-- Start: Sidebar -->
@section('card-profile')
<a href="{{ route('profile-admin') }}" class="to-profile">
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
        <i class="ri-dashboard-fill sidebar-menu-item-icon"></i>
        Dashboard
    </a>
</li>
@endsection

@section('pertanian')
    <li class="sidebar-menu-item">
        <a href="{{ route('pertanian-admin') }}" class="">
            <i class="ri-file-text-fill sidebar-menu-item-icon"></i>
            Data Pertanian
        </a>
    </li>
@endsection

@section('prediksi')
    <li class="sidebar-menu-item ">
        <a href="{{ route('prediksi-admin') }}" class="">
            <i class="ri-file-chart-fill sidebar-menu-item-icon"></i>
            Prediksi Panen
        </a>
    </li>
@endsection

@section('kriteria')
    <li class="sidebar-menu-item ">
        <a href="{{ route('kriteria-admin') }}" class="">
            <i class="ri-file-settings-fill sidebar-menu-item-icon"></i>
            Kriteria
        </a>
    </li>
@endsection

@section('data-user')
    <li class="sidebar-menu-item">
        <a href="{{ route('data-user-admin') }}" class="">
            <i class="ri-file-user-fill sidebar-menu-item-icon"></i>
            Data User
        </a>
    </li>
@endsection

@section('profile')
    <li class="sidebar-menu-item ">
        <a href="{{ route('profile-admin') }}" class="">
            <i class="ri-user-settings-fill sidebar-menu-item-icon"></i>
            Profile
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
    <div class="row g-3 mt-2">
        <div class=""">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white text-center">
                    Perbandingan Total Panen Jagung <br>
                    (Data Aktual VS Data Prediksi)
                </div>
                <div class="card-body">
                    <canvas id="sales-chart"></canvas>
                </div>
            </div>
        </div>
    <!-- end: Graph -->
@endsection
<!--End: Content -->

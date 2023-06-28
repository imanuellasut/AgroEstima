@extends('layouts.main')

@section('title', 'Profile')

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
    <li class="sidebar-menu-item ">
        <a href="{{ route('dashboard-admin') }}">
            <i class="ri-dashboard-fill sidebar-menu-item-icon"></i>
            Dashboard
        </a>
    </li>
@endsection

@section('pertanian')
    <li class="sidebar-menu-item ">
        <a href="{{ route('pertanian-admin') }}" class="">
            <i class="ri-file-text-fill sidebar-menu-item-icon"></i>
            Data Pertanian
        </a>
    </li>
@endsection

@section('prediksi')
    <li class="sidebar-menu-item">
        <a href="{{ route('prediksi-admin') }}" class="">
            <i class="ri-file-chart-fill sidebar-menu-item-icon"></i>
            Prediksi Panen
        </a>
    </li>
@endsection

@section('kriteria')
    <li class="sidebar-menu-item active">
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
        <h5 class="fw-bold mb-0 me-auto p-1">Kriteria</h5>
    </nav>
@endsection

<!-- Start: Content -->
@section('content')
<div class="">
    <div class="card mb-4">
        <div class="card-header">
            <p class="card-title">Kriteria Hama</p>
        </div>
        <div class="card-body">

        </div>
    </div>
    <hr>
    <div class="card">
        <div class="card-header">
            <p class="card-title">Kriteria Perawatan</p>
        </div>
        <div class="card-body">

        </div>
    </div>
</div>

@section('script')
<script>
    $(document).ready(function () {
        $('#example').DataTable();
    });
</script>
@endsection

@endsection
<!--End: Content -->

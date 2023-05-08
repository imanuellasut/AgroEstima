@extends('layouts.main')

@section('title', 'Profile')

<!-- Start: Sidebar -->
@section('card-profile')
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
@endsection

@section('dashboard')
<li class="sidebar-menu-item ">
    <a href="{{ route('dashboard-anggota') }}">
        <i class="ri-dashboard-fill sidebar-menu-item-icon"></i>
        Dashboard
    </a>
</li>
@endsection

@section('pertanian')
    <li class="sidebar-menu-item ">
        <a href="{{ route('pertanian-anggota') }}" class="">
            <i class="ri-file-text-fill sidebar-menu-item-icon"></i>
            Data Pertanian
        </a>
    </li>
@endsection

@section('prediksi')
    <li class="sidebar-menu-item">
        <a href="{{ route('prediksi-anggota') }}" class="">
            <i class="ri-file-chart-fill sidebar-menu-item-icon"></i>
            Prediksi Panen
        </a>
    </li>
@endsection

@section('profile')
    <li class="sidebar-menu-item active">
        <a href="{{ route('profile-anggota') }}" class="">
            <i class="ri-user-settings-fill sidebar-menu-item-icon"></i>
            Profile
        </a>
    </li>
@endsection
<!-- End: Sidebar -->

@section('navbar')
    <nav class="px-3 py-2 bg-white rounded shadow-sm">
        <i class="ri-menu-line sidebar-toggle me-3 d-block d-md-none"></i>
        <h5 class="fw-bold mb-0 me-auto p-1">Profile</h5>
    </nav>
@endsection

<!-- Start: Content -->
@section('content')
<div class="">
    <div class="card card-body ml-1">
        <div class="row gx-4 mb-4 ">
            <div class="col-auto">
                <div class="avatar avatar-xl position-relative">
                <img src="{{ asset('Template-Dashboard/img/profile-reggy.jpg') }}" alt="profile_image"
                class="border-1 shadow-sm rounded-2" style="width: 80px">
                </div>
            </div>
            <div class="col-auto my-auto">
                <div class="h-100">
                    <h5 class="mb-1">
                        {{ $name }}
                    </h5>
                    <p class="mb-0 font-weight-normal text-sm">
                        NIK: {{ Auth::user()->nik }}
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
            <div class="card card-plain h-100">
                <div class="card-header bg-primary text-light">
                    <div class="row">
                        <div class="col-md-8 d-flex align-items-center">
                            <h6 class="mb-0">Information</h6>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="javascript:;">
                                <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    <ul class="list-group">
                        <li class="list-group-item border-0 ps-0 pt-0 text-sm">
                            <strong class="text-dark">Nama :</strong> &nbsp; {{ Auth::user()->name }}</li>
                        <li class="list-group-item border-0 ps-0 text-sm">
                            <strong class="text-dark">NIK :</strong> &nbsp; {{ Auth::user()->nik }}</li>
                        <li class="list-group-item border-0 ps-0 text-sm">
                            <strong class="text-dark">No HP :</strong> &nbsp; {{ Auth::user()->no_hp }}</li>
                        <li class="list-group-item border-0 ps-0 text-sm">
                            <strong class="text-dark">Alamat :</strong> &nbsp; {{ Auth::user()->alamat }}</li>
                        <li class="list-group-item border-0 ps-0 pb-0">
                        <strong class="text-dark text-sm">Email :</strong> &nbsp; {{ Auth::user()->email }}</li>
                    </ul>
                    <hr class="horizontal gray-light my-4">
                    <div class="row g-3 d-flex">
                        <div class="col-12">
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
                        <div class="col-12">
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
                        <div class="col-12">
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
                </div>
            </div>
            </div>
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

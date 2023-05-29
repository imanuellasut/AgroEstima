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
        <li class="sidebar-menu-item">
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
        <li class="sidebar-menu-item active">
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
        <h5 class="fw-bold mb-0 me-auto p-1">Profile</h5>
    </nav>
@endsection

<!-- Start: Content -->
@section('content')
<div class="d-lg-flex">
    <div class="card m-1">
        <div class="card-body" style="width: 250px">
            <li class="mb-2 menu-profile">
                <a href="" class="active-edit">
                    <i class="ri-settings-3-fill"></i>
                    Edit Profile
                </a>
            </li>
            <li class="menu-profile">
                <a href="" class="">
                    <i class="ri-lock-password-fill"></i>
                    Edit Password
                </a>
            </li>
        </div>
    </div>
    <form action="">
        <div class="card m-1">
            <div class="card-body d-lg-flex align-items-center justify-content-center">
                <div class="image-profile" style="margin-right: 10px;">
                    <img src="{{ asset('Template-Dashboard/img/profile-reggy.jpg') }}" class="rounded-2" alt="" style="width: 200px">
                </div>
                <div>
                    <label for="formFile" class="form-label">Upload Foto</label>
                    <input class="form-control" type="file" id="formFile">
                </div>
            </div>
                <hr>
            <div class="card-body d-lg-flex justify-content-center">
                <div class="info-profil row" >
                    <div class="col-md-12 mb-3">
                        <label for="" class="labels mb-1">Nama</label>
                        <input type="text" name="" id="" class="form-control bg-light"
                        value="{{ Auth::user()->name }}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="" class="labels mb-1">NIK (Nomor Induk Kependudukan)</label>
                        <input type="text" name="" id="" class="form-control bg-light"
                        value="{{ Auth::user()->nik }}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="" class="labels mb-1">No Hp</label>
                        <input type="text" name="" id="" class="form-control bg-light"
                        value="{{ Auth::user()->no_hp }}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="" class="labels mb-1">Email</label>
                        <input type="text" name="" id="" class="form-control bg-light"
                        value="{{ Auth::user()->email }}">
                    </div>
                    <div class="col-md-12 ">
                        <label for="" class="labels mb-1">Alamat</label>
                        <textarea type="text" name="" id="" class="form-control bg-light">{{ Auth::user()->alamat }} </textarea>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <button type="submit" class="btn btn-primary mt-3">Simpan</button>
            </div>
        </div>
    </form>
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

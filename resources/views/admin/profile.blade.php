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
                <a href="" class="" data-bs-toggle="modal" data-bs-target="#editProfile">
                    <i class="ri-settings-3-fill"></i>
                    Edit Profile
                </a>
            </li>
            <li class="menu-profile">
                <a href="" class="" data-bs-toggle="modal" data-bs-target="#editPasswrod">
                    <i class="ri-lock-password-fill"></i>
                    Edit Password
                </a>
            </li>
        </div>
    </div>
    <div class="card m-1">
        <div class="card-body d-lg-flex align-items-center justify-content-center">
            <div class="image-profile" style="margin-right: 10px;">
                <img src="{{ asset('Template-Dashboard/img/profile-reggy.jpg') }}" class="rounded-2" alt="" style="width: 200px">
            </div>
        </div>
            <hr>
        <div class="card-body d-lg-flex justify-content-center">
            <div class="info-profil row" >
                <div class="col-md-12 mb-3">
                    <label for="" class="labels mb-1">Nama</label>
                    <input type="text" name="" id="" class="form-control bg-light"
                    value="{{ Auth::user()->name }}" readonly>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="" class="labels mb-1">NIK (Nomor Induk Kependudukan)</label>
                    <input type="text" name="" id="" class="form-control bg-light" readonly
                    value="{{ Auth::user()->nik }}">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="" class="labels mb-1">No Hp</label>
                    <input type="text" name="" id="" class="form-control bg-light" readonly
                    value="{{ Auth::user()->no_hp }}">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="" class="labels mb-1">Email</label>
                    <input type="text" name="" id="" class="form-control bg-light" readonly
                    value="{{ Auth::user()->email }}">
                </div>
                <div class="col-md-12 ">
                    <label for="" class="labels mb-1">Alamat</label>
                    <textarea type="text" name="" id="" class="form-control bg-light" readonly>{{ Auth::user()->alamat }} </textarea>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Profil -->
    <div class="modal fade" id="editProfile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Profile</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="">
                    <div class="modal-body">
                        <div class="info-profil row">
                            <div class="col-md-12 mb-3 form-floating">
                                <input type="text" class="form-control" placeholder="Masukan nama lengkap" id="floatingNama" value="{{ Auth::user()->name }}">
                                <label for="floatingNama" style="margin-left: 10px">Nama Lengkap</label>
                            </div>
                            <div class="col-md-12 mb-3 form-floating">
                                <input type="number" class="form-control" placeholder="Masukan NIK" id="floatingNIK" value="{{ Auth::user()->nik }}" readonly>
                                <label for="floatingNIK" style="margin-left: 10px">NIK (Nomor Induk Kependudukan)</label>
                            </div>
                            <div class="col-md-12 mb-3 form-floating">
                                <input type="number" class="form-control" placeholder="Masukan NO HP" id="floatingNoHP" value="{{ Auth::user()->no_hp }}">
                                <label for="floatingNoHP" style="margin-left: 10px">No HP</label>
                            </div>
                            <div class="col-md-12 mb-3 form-floating">
                                <input type="email" class="form-control" placeholder="Masukan Email" id="floatingEmail" value="{{ Auth::user()->email }}">
                                <label for="floatingEmail" style="margin-left: 10px">Email</label>
                            </div>
                            <div class="col-md-12 mb-3 form-floating">
                                <textarea type="text" class="form-control" placeholder="Masukan Alamat" id="floatingAlamat">{{ Auth::user()->alamat }}</textarea>
                                <label for="floatingAlamat" style="margin-left: 10px">Alamat</label>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="floatingFoto" style="margin-left: 10px">Foto</label>
                                <input type="file" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])" class="form-control" placeholder="Masukan" id="floatingFoto">
                            </div>
                            <div class="col-md-12 mb-3 align-content-center">
                                <img src="" alt="" id="output" width="200px" >
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                        <button type="button" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<!-- Modal Edit password -->
<div class="modal fade" id="editPasswrod" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Password</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="">
                <div class="modal-body">
                    <div class="info-profil row">
                        <div class="col-md-12 mb-3 form-floating">
                            <input type="password" class="form-control" placeholder="Password Lama" id="floatingPass" value="{{ Auth::user()->password }}">
                            <label for="floatingPass" style="margin-left: 10px">Password Lama</label>
                        </div>
                        <div class="col-md-12 mb-3 form-floating">
                            <input type="password" class="form-control" placeholder="Masukan Password" id="floatingPassword">
                            <label for="floatingPassword" style="margin-left: 10px">Password Baru</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                    <button type="button" class="btn btn-primary">Simpan</button>
                </div>
            </form>
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

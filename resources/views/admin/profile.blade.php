@extends('layouts.main')

@section('title', 'Profile')

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
    <li class="sidebar-menu-item">
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
    <li class="sidebar-menu-item active">
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
                    Ubah Profile
                </a>
            </li>
            <li class="menu-profile">
                <a href="" class="" data-bs-toggle="modal" data-bs-target="#editPasswrod">
                    <i class="ri-lock-password-fill"></i>
                    Ubah Password
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
                                <input type="number" class="form-control" placeholder="Masukan NIK" id="floatingNIK" value="{{ Auth::user()->nik }}" maxlength="16">
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
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Ubah Password</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="">
                <div class="modal-body">
                    <div class="info-profil row">
                        <div class="col-md-12 mb-3 form-floating">
                            <input type="password" class="form-control" placeholder="Password Lama" id="floatingPass">
                            <label for="floatingPass" style="margin-left: 10px">Password Baru</label>
                        </div>
                        <div class="col-md-12 mb-3 form-floating">
                            <input type="password" class="form-control" placeholder="Masukan Password" id="floatingPassword">
                            <label for="floatingPassword" style="margin-left: 10px">Password Baru (ulangi)</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                    <button type="button" class="btn btn-primary">Ubah Password</button>
                </div>
            </form>
            <div class="form-control p-5 ml-2 mr-2">
                <p>Perhatikan</p>
                <li>Gunakan password yang unik dan sulit ditebak oleh Orang Lain,
                    tetapi cukup mudah Anda ingat</li>
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

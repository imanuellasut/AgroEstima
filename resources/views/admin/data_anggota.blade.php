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
    <li class="sidebar-menu-item active">
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
        <h5 class="fw-bold mb-0 me-auto p-1">Data Anggota</h5>
    </nav>
@endsection

<!-- Start: Content -->
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <small class="fw-bold">Data Anggota</small>
        <div class="">
            <a class="btn btn-primary btn-sm d-flex" data-bs-toggle="modal" data-bs-target="#tambahAnggota">
                <i class="ri-add-fill mr-2"></i>
                Tambah Data
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="mt-0 table-sm table-responsive">
            <table id="tabelAnggota" class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>No.Hp</th>
                        <th>Alamat</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ( $dataUser as $data  )
                <tbody>
                    <tr>
                        <td scope="row">{{ $no++ }}</td>
                        <td > {{ $data->name }} </td>
                        <td> {{ $data->nik }} </td>
                        <td> {{ $data->no_hp }} </td>
                        <td> {{ $data->alamat }} </td>
                        <td> {{ $data->email }} </td>
                        <td> {{ $data->role }}</td>
                        <td>
                            <div class="text-decoration-none">
                                <div class="d-flex mb-2 btn-group">
                                    @can('anggota-edit')
                                        <a href="" class="btn btn-sm btn-success" style="color: beige" data-bs-toggle="modal" data-bs-target="#editAnggota{{ $anggota->id }}">Edit</a>
                                    @endcan
                                </div>
                                <div class="d-flex btn-group">
                                    <a href="" class="btn btn-sm btn-danger" style="font-size: 0.80rem; color: beige">Hapus</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
                @endforeach
            </table>
        </div>
    </div>
</div>

@include('admin.modal.tambah_anggota')
@include('admin.modal.edit_anggota')

<!-- Modal Edit User -->
    {{-- <div class="modal fade" id="editAnggota{{ $data->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Anggota</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" id="formAnggota">
                    <div class="modal-body">
                        @csrf
                        <div class="info-profil row">
                            <div class="col-md-12 mb-3 form-floating">
                                <input type="text" class="form-control" placeholder="Masukan nama lengkap" id="floatingNama" name="name" value="{{ $data->name }}">
                                <label for="floatingNama" style="margin-left: 10px">Nama Lengkap</label>
                            </div>
                            <div class="col-md-12 mb-3 form-floating">
                                <input type="number" class="form-control" placeholder="Masukan NIK" id="floatingNIK" name="nik">
                                <label for="floatingNIK" style="margin-left: 10px">NIK (Nomor Induk Kependudukan)</label>
                            </div>
                            <div class="col-md-12 mb-3 form-floating">
                                <input type="number" class="form-control" placeholder="Masukan NO HP" id="floatingNoHP" name="no_hp">
                                <label for="floatingNoHP" style="margin-left: 10px">No HP</label>
                            </div>
                            <div class="col-md-12 mb-3 form-floating">
                                <input type="email" class="form-control" placeholder="Masukan Email" id="floatingEmail" name="email">
                                <label for="floatingEmail" style="margin-left: 10px">Email</label>
                            </div>
                            <div class="col-md-12 mb-3 form-floating">
                                <textarea type="text" class="form-control" placeholder="Masukan Alamat" id="floatingAlamat" name="alamat"></textarea>
                                <label for="floatingAlamat" style="margin-left: 10px">Alamat</label>
                            </div>
                            <div class="col-md-12 mb-3 form-floating">
                                <select class="form-select" id="floatingSelect" aria-label="" name="role">
                                    <option selected>Pilih Role</option>
                                    <option value="0">Anggota</option>
                                    <option value="1">Admin</option>
                                </select>
                                <label for="floatingSelect" tyle="margin-left: 20px">ROLE</label>
                            </div>
                            <div class="col-md-12 mb-3 form-floating">
                                <input type="password" class="form-control" placeholder="Masukan Alamat" id="floatingPass" name="password">
                                <label for="floatingPass" style="margin-left: 10px">Password</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="addAnggota">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}

<!-- Modal Sukses -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Success</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="successMessage"></p>
                </div>
            </div>
        </div>
    </div>

@section('script')
<script>
</script>
@endsection

@endsection
<!--End: Content -->

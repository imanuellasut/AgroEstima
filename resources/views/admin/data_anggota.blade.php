@extends('layouts.main')

@section('title', 'Data Anggota')

<!-- Start: Sidebar -->
@section('card-profile')
    <a href="{{ route('profil_admin') }}" class="to-profile">
        <div class="d-flex card-profile p-2">
            <div class="avatar-profile">
                <img src="{{ asset('Template-Dashboard/img/profile-reggy.jpg') }}" alt="" >
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
        <small class="fw-bold">Daftar Data Anggota</small>
        <div class="">
            <a class="tombolTambah d-flex" data-bs-toggle="modal" data-bs-target="#tambahAnggota">
                <span class="iconify" data-icon="zondicons:add-solid" style="color: white; margin-right: 5px" data-width="20"></span>
                Tambah Data
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="d-block">
                <form action="{{ route('get-anggota') }}" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="cari" placeholder="Cari Nama Anggota" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn btn-outline-secondary btn-sm" type="submit" id="button-addon2">Cari</button>
                    </div>
                </form>
        </div>
        <div class="mt-0 table-sm table-responsive">
            <table id="tabelAnggota" class="table table-striped table-hover" >
                <thead style="background-color: #96BA54">
                    <tr style="color: white; height: 3rem;" >
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>No.Hp</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
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
                        <td> {{ $data->email }} </td>
                        <td> {{ $data->role }}</td>
                        <td style="width: 12%;">
                            <a href="" class="tombolEdit m-1" data-bs-toggle="modal"
                            data-bs-target="#editAnggota__{{ $data->id }}">
                                <span class="iconify" data-icon="basil:edit-solid" data-width="20"  style="color: white;"></span>
                            </a>
                            <a href="" class="tombolHapus m-1"
                            data-bs-toggle="modal"
                            data-bs-target="#hapusAnggota_{{ $data->id }}">
                                <span class="iconify" data-icon="material-symbols:delete" data-width="20"  style="color: white;"></span>
                            </a>
                        </td>
                    </tr>
                </tbody>
                @include('admin.modal.show_anggota')
                @include('admin.modal.edit_anggota')
                @include('admin.modal.hapus_anggota')
                @endforeach
            </table>
        </div>
    </div>
</div>

@include('admin.modal.tambah_anggota')

@section('script')
<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
    }
    @if (Session::has('success'))
        toastr.success('{{ Session::get('success') }}')
    @endif

    @if (Session::has('error'))
        toastr.error('{{ Session::get('error') }}')
    @endif
</script>
@endsection
@endsection
<!--End: Content -->

@extends('layouts.main')

@section('title', 'Data Pertanian')

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
    <li class="sidebar-menu-item active">
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

@section('data-anggota')
    <li class="sidebar-menu-item">
        <a href="{{ route('get-anggota') }}" class="">
            <i class="ri-file-user-fill sidebar-menu-item-icon"></i>
            Data Anggota
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
        <h5 class="fw-bold mb-0 me-auto p-1">Prediksi Panen</h5>
    </nav>
@endsection

<!-- Start: Content -->
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <small class="fw-bold">Data Prediksi Panen</small>
        <div class="">
            <a href="#" class="btn btn-primary btn-sm d-flex">
                <i class="ri-add-fill mr-2"></i>
                Tambah Data
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive mt-0 table-sm">
            <table id="example" class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tanggal Tanam</th>
                        <th>Luas Lahan(Ha)</th>
                        <th>Jumlah Bibit(Kg)</th>
                        <th>Perawatan</th>
                        <th>Cuaca</th>
                        <th>Hama</th>
                        <th>Prediksi (Ton)</th>
                        <th>Produksi (Ton)</th>
                        <th>Produktivias (Ton/Ha)</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Reggy Charles Imanuel lasut</td>
                        <td>21-01-2021</td>
                        <td>2</td>
                        <td>50</td>
                        <td>Baik</td>
                        <td>Cerah</td>
                        <td>Sedang</td>
                        <td>120</td>
                        <td>-</td>
                        <td>-</td>
                        <td>
                            <div class="text-decoration-none">
                                <div class="d-flex mb-2 btn-group">
                                    <a href="" class="btn btn-sm btn-success" style="color: beige">Edit</a>
                                </div>
                                <div class="d-flex btn-group">
                                    <a href="" class="btn btn-sm btn-danger" style="font-size: 0.80rem; color: beige">Hapus</a>
                                </div>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>
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

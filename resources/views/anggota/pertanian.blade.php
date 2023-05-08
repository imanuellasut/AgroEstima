@extends('layouts.main')

@section('title', 'Data Pertanian')

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
    <li class="sidebar-menu-item active">
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
    <li class="sidebar-menu-item ">
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
        <h5 class="fw-bold mb-0 me-auto p-1">Data Pertanian</h5>
    </nav>
@endsection

<!-- Start: Content -->
@section('content')
<div class="card">
    <small class="card-header fw-bold">Data Pertanian</small>
    <div class="card-body">
        <div class="table-responsive mt-0">
            <table id="example" class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Id Pertanian</th>
                        <th>Nama</th>
                        <th>Tanggal Tanam</th>
                        <th>Luas Lahan(Ha)</th>
                        <th>Produksi (Ton)</th>
                        <th>Produktivias (Ton/Ha)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>1</td>
                        <td>Reggy Charles Imanuel lasut</td>
                        <td>21-01-2021</td>
                        <td>2</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>1</td>
                        <td>Juan Sebastian Umpele</td>
                        <td>21-01-2021</td>
                        <td>2</td>
                        <td>-</td>
                        <td>-</td>
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

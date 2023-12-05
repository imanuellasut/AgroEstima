@extends('layouts.main')

@section('title', 'Data Akuras Fuzzy')

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
    <li class="sidebar-menu-item active">
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

@section('textMasterFuzzy')
    <hr>
    <p class="master-text">Master Fuzzy</p>
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

@section('textMasterUser')
    <hr>
    <p class="master-text">Master User</p>
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
    <li class="sidebar-menu-item">
        <a href="{{ route('profil_admin') }}" class="">
            <iconify-icon icon="iconamoon:profile-circle-fill" class="sidebar-menu-item-icon"></iconify-icon>
            Profil
        </a>
    </li>
@endsection
<!-- End: Sidebar -->

@section('navbar')
    <nav class="px-3 py-2 bg-white rounded shadow-sm text-muted">
        <i class="ri-menu-line sidebar-toggle me-3 d-block d-md-none"></i>
        <i class="ri-file-chart-fill sidebar-menu-item-icon"></i>
        <p class="mb-0 me-auto p-1">Data Prediksi</p>
    </nav>
@endsection

<!-- Start: Content -->
@section('content')
<div class="d-flex mb-2">
    <a class="tombolBatal my-1" href="{{ route('d_prediksi_admin') }}">
        <span class="iconify" data-icon="ion:arrow-back-outline" style="color: white; margin-right: 5px" data-width="20"></span>
        Kembali
    </a>
</div>
<div class="card">
    <div class="card-header d-lg-flex justify-content-between" style="align-items: center">
        <div class="d-flex">
            <iconify-icon icon="icon-park-solid:data-file" class="sidebar-menu-item-icon"></iconify-icon>
            <small class="fw-bold">Hasil Fuzzifikasi</small>
        </div>
        <hr style="max-width: 100%;">
    </div>
    <div class="card-body">
        <div class="table-responsive mt-0 mb-2">
            <table class="table table-bordered table-hover" >
                <thead style="background-color: #96BA54">
                    <tr style="color: white">
                        <th  style="vertical-align: middle; width: 30%;">Nama Variabel</th>
                        <th  style="vertical-align: middle;">Fungsi Keanggotaan</th>
                        <th class="text-center" style="vertical-align: middle;">Nilai Fuzzifikasi</th>
                    </tr>
                </thead>
                @foreach ($hasil as $namaVariabel => $himpunan)
                <tbody>
                    <tr>
                        <td rowspan="2"  style="vertical-align: middle;">{{ $namaVariabel }}</td>
                        @foreach ($himpunan as $namaHimpunan => $nilai)
                        <td style="vertical-align: middle;">{{ $namaHimpunan }}</td>
                            @foreach ($nilai as $jenisKurva => $nilaiFuzzifikasi)
                            <td style="vertical-align: middle;">{{ $nilaiFuzzifikasi }}</td>
                    </tr>
                            @endforeach
                        @endforeach
                </tbody>
                @endforeach
            </table>
        </div>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header d-lg-flex justify-content-between" style="align-items: center">
        <div class="d-flex">
            <iconify-icon icon="icon-park-solid:data-file" class="sidebar-menu-item-icon"></iconify-icon>
            <small class="fw-bold">Hasil Inferensi</small>
        </div>
        <hr style="max-width: 100%;">
    </div>
    <div class="card-body">
        <div class="table-responsive mt-0 mb-2">
            <table class="table table-bordered table-hover" >
                <thead style="background-color: #96BA54">
                    <tr style="color: white;" class="justify-center align-content-center">
                        <th scope="col" style="text-align: center; width: 5%; vertical-align: middle;" rowspan="2">Kode</th>
                        <th scope="col" style="text-align: center; vertical-align: middle;" colspan="{{ $jumlahVariabel }}">Aturan</th>
                        <th scope="col" style="text-align: center; vertical-align: middle;" rowspan="2">Nilai a</th>
                        <th scope="col" style="text-align: center; vertical-align: middle;" rowspan="2">Keputusan (Nilai z)</th>
                        <th scope="col" style="text-align: center; vertical-align: middle;" rowspan="2">a*z</th>
                    </tr>
                    <tr style="color: white; "class="justify-center align-content-center">
                        @foreach ($variabel as $dataV )
                            <th scope="col" style="text-align: center; vertical-align: middle;">{{ $dataV->nama }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($hasilDefuzzifikasi as $kodeAturan => $keputusan)
                    <tr class="justify-center align-content-center" >
                            <td>{{ $kodeAturan }}</td>
                        @foreach ($dataInferensi[$kodeAturan]['values'] as $variabel => $value)
                            <td> {{ $value }}</td>
                        @endforeach
                            <td>{{ $dataInferensi[$kodeAturan]['min'] }}</td>
                        @foreach ($keputusan as $id => $data)
                            <td>{{ $data['z'] }}</td>
                            <td>{{ $data['a*z'] }}</td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="" style="text-align: center; vertical-align: middle;">
            <div class="">
                @php
                $displayMin = '';
                $displayZ = '';
                @endphp

                @foreach ($hasilDefuzzifikasi as $kodeAturan => $keputusan)
                @foreach ($keputusan as $id => $data)
                    @php
                        $displayMin .= $dataInferensi[$kodeAturan]['min'] . ' + ';
                        $displayZ .= $data['a*z'] . ' + ';
                    @endphp
                @endforeach
                @endforeach

                <small>Nilai a/a*z = ( {{ rtrim($displayMin, ' + ') }} )/( {{ rtrim($displayZ, ' + ') }} )</small>
            </div>
            <div class="mt-2">
                <p>Prediksi: {{ number_format($prediksi, 2, ',', '.' ) }}</p>
        </div>
    </div>
</div>
@endsection
<!--End: Content -->

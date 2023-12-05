@extends('layouts.main')

@section('title', 'Data Pertanian')

<!-- Start: Sidebar -->
@section('card-profile')
    <div class="d-flex card-profile p-2">
        <div class="avatar-profile">
            @if(Auth::user()->foto != null)
                <img src="{{ asset('img/profile/' .Auth::user()->foto ) }}"  style="aspect-ratio: 1 / 1; object-fit: cover">
            @else
                <img src="{{ asset('Template-Dashboard/img/default-profile.jpg') }}"  alt="" style="aspect-ratio: 1 / 1; object-fit: cover">
            @endif
        </div>
        <div class="info-profile">
            @php
                $data = Auth::user()->name;
                $name = implode(" ", array_slice(explode(" ", $data), 0, 2));
            @endphp
            <span>{{ $name }}</span>
            @if (Auth::user()->role = 0)
                <small>Admin</small>
            @else
                <small>Anggota</small>
            @endif
            <br>
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

@section('data_pertanian')
    <li class="sidebar-menu-item ">
        <a href="{{ route('pertanian-anggota') }}" class="">
            <i class="ri-file-text-fill sidebar-menu-item-icon"></i>
            Data Pertanian
        </a>
    </li>
@endsection

@section('data_prediksi')
    <li class="sidebar-menu-item active">
        <a href="{{ route('prediksi-anggota') }}" class="">
            <i class="ri-file-chart-fill sidebar-menu-item-icon"></i>
            Prediksi Panen
        </a>
    </li>
@endsection

@section('data_akurasi_fuzzy')
    <li class="sidebar-menu-item ">
        <a href="{{ route('d_akurasi_fuzzy_anggota') }}" class="">
            <iconify-icon icon="icon-park-solid:data-screen" class="sidebar-menu-item-icon"></iconify-icon>
            Akurasi Fuzzy
        </a>
    </li>
@endsection

@section('profile')
    <li class="sidebar-menu-item">
        <a href="{{ route('profile-anggota') }}" class="">
            <i class="ri-user-settings-fill sidebar-menu-item-icon"></i>
            Profile
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
    <a class="tombolBatal my-1" href="{{ route('prediksi-anggota') }}">
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
        <div class="table-responsive mt-0">
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

<div class="card">
    <div class="card-header d-lg-flex justify-content-between" style="align-items: center">
        <div class="d-flex">
            <iconify-icon icon="icon-park-solid:data-file" class="sidebar-menu-item-icon"></iconify-icon>
            <small class="fw-bold">Hasil Inferensi</small>
        </div>
        <hr style="max-width: 100%;">
    </div>
    <div class="card-body">
        <div class="table-responsive mt-0">
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
                <p>Prediksi: {{ $prediksi }}</p>
        </div>
    </div>
</div>
@endsection
<!--End: Content -->

@extends('layouts.main')

@section('title', 'Data Prediksi')

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
    <li class="sidebar-menu-item ">
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
    <li class="sidebar-menu-item active">
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
        <iconify-icon icon="material-symbols:folder-managed" class="sidebar-menu-item-icon"></iconify-icon>
        <small class="fw-bold mb-0 me-auto p-1">Data Aturan</small>
    </nav>
@endsection

<!-- Start: Content -->
@section('content')
    <div class="card mb-4">
        <div class="card-header d-lg-flex justify-content-between" style="align-items: center">
            <div class="d-flex">
                <iconify-icon icon="material-symbols:folder-managed" class="sidebar-menu-item-icon"></iconify-icon>
                <small class="fw-bold">Tambah Aturan Fuzzy</small>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('tambah_aturan') }}" method="POST" class="form-group">
                @csrf
                <h4>JIKA</h4>
                <hr style="width: 100%; margin-left: 0px">
                <div class="row g-3">
                    @foreach ($variabel as $v)
                        <div class="col-lg-4">
                            <div class="mb-2 form-group">
                                <label class="{{ $v->id }}">{{ $v->nama }}</label>
                                <select class="form-select form-control" id="{{ $v->id }}" name="himpunan[{{ $v->id }}]">
                                    <option selected disabled>-- Pilih --</option>
                                    @foreach ($v->himpunan as $h)
                                        <option value="{{ $h->id }}">{{ $h->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endforeach
                </div>
                <hr style="width: 100%; margin-left: 0px">
                <h4>MAKA</h4>
                <hr style="width: 100%; margin-left: 0px">
                <div class="col-lg-12 mb-2">
                    <label>Produksi</label>
                    <select class="form-select" name="id_keputusan">
                        <option selected disabled>-- Pilih --</option>
                    @foreach ($keputusan as $k)
                        <option value="{{ $k->id_keputusan }}">{{ $k->nama_keputusan }}</option>
                    @endforeach
                    </select>
                </div>
                <div class="d-flex justify-content-lg-end">
                    <button type="submit" class="tombolTambah my-1">
                        <span class="iconify" data-icon="zondicons:add-solid" style="color: white; margin-right: 5px" data-width="20"></span>
                        Tambah Aturan
                    </button>
                </div>
            </form>


            {{-- <form  id="aturanForm">
                @csrf
                <h4>JIKA</h4>
                <hr style="width: 100%; margin-left: 0px">
                <div class="row g-3">
                    @foreach ($variabel as $v)
                    <div class="col-lg-4">
                        <div class="mb-2">
                            <label>{{ $v->nama }}</label>
                            <select class="form-select" name="aturan[{{ $v->id_variabel }}]">
                                <option selected>-- Pilih --</option>
                                @foreach ($v->himpunan as $h)
                                    <option value="{{ $h->id_himpunan }}">{{ $h->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endforeach
                </div>
                <hr style="width: 100%; margin-left: 0px">
                <h4>MAKA</h4>
                <hr style="width: 100%; margin-left: 0px">
                <div class="col-lg-12 mb-2">
                    <label>Produksi</label>
                    <select class="form-select" aria-label="Default select example" name="id_keputusan">
                        <option selected>-- Pilih --</option>
                    @foreach ($keputusan as $k)
                        <option value="{{ $k->id_keputusan }}">{{ $k->nama_keputusan }}</option>
                    @endforeach
                    </select>
                </div>
                <div class="d-flex justify-content-lg-end">
                    <button type="submit" class="tombolTambah my-1">
                        <span class="iconify" data-icon="zondicons:add-solid" style="color: white; margin-right: 5px" data-width="20"></span>
                        Tambah Aturan
                    </button>
                </div>
            </form> --}}
        </div>
    </div>

    <div class="card">
        <div class="card-header d-lg-flex justify-content-between" style="align-items: center">
            <div class="d-flex">
                <iconify-icon icon="material-symbols:folder-managed" class="sidebar-menu-item-icon"></iconify-icon>
                <small class="fw-bold">Daftar Data Aturan Fuzzy</small>
            </div>
        </div>
        <div class="card-body">
            <div class="mt-0 table-sm table-responsive">
                <table class="table table-hover" id="tabelVariabel">
                    <thead style="background-color: #96BA54">
                        <tr style="color: white">
                            <th scope="col" style="width: 2rem">No</th>
                            <th scope="col" style="text-align: center; width: 5rem">Kode</th>
                            <th scope="col" style="text-align: center">Aturan</th>
                            <th scope="col" style="width: 20%; text-align: center">Aksi</th>
                        </tr>
                    </thead>
                    @php
                        $no = 1;
                    @endphp
                    <tbody>
                        @foreach ($aturan_tabel as $kode_aturan => $data)
                            <tr>
                                <td scope="row" class="text-lg-center">{{ $no++ }}</td>
                                <td  class="text-lg-center">{{ $kode_aturan }}</td>
                                <td><b>Jika</b> {{ implode(' Dan ', $data['aturan']) }} <b>Maka</b> Produksi = {{ $data['keputusan'] }}</td>
                                <td class="text-lg-center">
                                    <a href="" class="tombolEdit m-1">
                                        <span class="iconify" data-icon="basil:edit-solid" data-width="20"  style="color: white;"></span>
                                    </a>
                                    <a href="" class="tombolHapus">
                                        <span class="iconify" data-icon="material-symbols:delete" data-width="20"  style="color: white;"></span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
<!--End: Content -->

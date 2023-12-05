@extends('layouts.main')

@section('title', 'Data Pertanian')

<!-- Start: Sidebar -->
@section('card-profile')
    <a href="{{ route('profil_admin') }}" class="to-profile">
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
    <li class="sidebar-menu-item active">
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
    <iconify-icon icon="material-symbols:chart-data-rounded" class="sidebar-menu-item-icon"></iconify-icon>
    <p class="mb-0 me-auto p-1">Data Pertanian</p>
</nav>
@endsection

<!-- Start: Content -->
@section('content')
<div class="card">
    <div class="card-header d-lg-flex justify-content-between" style="align-items: center">
        <div class="d-flex">
            <iconify-icon icon="material-symbols:chart-data-rounded" class="sidebar-menu-item-icon"></iconify-icon>
            <small class=" fw-bold">Daftar Data Pertanian</small>
        </div>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
            <div class="mb-2 d-flex justify-content-between align-items-center">
                <div class="mr-5" style="margin-right: 4px">
                    <form method="GET" action="{{ route('d_pertanian_admin') }}">
                        <select name="perPage" onchange="this.form.submit()" class="form-select">
                            {{-- <option value="" disabled>Data</option> --}}
                            <option value="5" {{ (old('perPage') ? old('perPage') : $perPage) == 5 ? 'selected' : '' }}>5</option>
                            <option value="10" {{ (old('perPage') ? old('perPage') : $perPage) == 10 ? 'selected' : '' }}>10</option>
                            <option value="15" {{ (old('perPage') ? old('perPage') : $perPage) == 15 ? 'selected' : '' }}>15</option>
                        </select>
                    </form>
                </div>
                <div class="">
                    <small>Data per halaman</small>
                </div>
            </div>
        </div>
        <div class="table-responsive mt-0">
            <table class="table table-bordered table-striped table-hover tabelPertanian" id="#tabelPertanian">
                <thead style="background-color: #96BA54">
                    <tr style="color: white">
                        <th class="text-center" style="vertical-align: width: 5%;">No</th>
                        <th class="text-center" style="vertical-align: width: 15%;">Kode</th>
                        <th class="text-center">Nama Anggota</th>
                        <th class="text-center">Tanggal Tanam</th>
                        <th class="text-center">Tanggal Panen</th>
                        <th class="text-center">Hasil Panen</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                @foreach ( $dataP as $key => $pertanian )
                <tbody>
                    <tr>
                        <td class="text-center" style="vertical-align: middle;">
                            {{ $dataP->firstItem() + $key }}
                        </td>
                        <td class="text-center" style="vertical-align: middle;">
                            {{ $pertanian->kode_pertanian }}
                        </td>
                        @php
                            $data = $pertanian->nama_anggota;
                            $name = implode(" ", array_slice(explode(" ", $data), 0, 2));
                        @endphp
                        <td class="text-uppercase" style="vertical-align: middle;">{{ $name }}</td>
                        <td class="text-center" style="vertical-align: middle;">{{ $pertanian->tgl_tanam }}</td>
                        <td class="text-center" style="vertical-align: middle;">{{ $pertanian->tgl_panen }}</td>
                        <td class="text-center" style="vertical-align: middle;">
                            @if($pertanian->jml_produksi == null)
                            <span style="color: black">-</span>
                            @endif
                            {{ $pertanian->jml_produksi }}</td>
                        <td class="text-center">
                            <a href="" class="tombolLihat m-1" data-bs-toggle="modal"
                            data-bs-target="#lihatPertanianAdmin_{{ $pertanian->kode_pertanian }}" >
                                <span class="iconify" data-icon="carbon:view-filled" data-width="20" style="color: white; margin-right: 2px"></span>
                            </a>
                            @include('admin.modal_prediksi.view_pertanian')
                            <a href="" class="tombolEdit m-1" data-bs-toggle="modal"
                            data-bs-target="#updatepertanian_{{ $pertanian->kode_pertanian }}"
                            data-kodePertanian = {{ $pertanian->kode_pertanian }}>
                                <span class="iconify" data-icon="basil:edit-solid" data-width="20"
                                style="color: white;"></span>
                            </a>
                        </td>
                    </tr>
                </tbody>
                @include('admin.modal_prediksi.edit_pertanian')
                @endforeach
            </table>
            <hr class="">
            <div class="d-lg-flex d-md-flex justify-content-lg-between align-items-lg-center">
                <div class="d-lg-flex">
                    <small>{{ $dataP->count()  }} Data dari Halaman {{ $dataP->currentPage() }} </small>
                </div>
                <div class=""> {{ $dataP -> links() }}</div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $(document).on('submit', '#updatePertanianForm', function(e){
            e.preventDefault();
            var kodePertanian = $(this).data('kode_pertanian');
            var data = $(this).serializeArray();
            // console.log(data);

            $.ajax({
                url: '{{ route('perbarui_pertanian') }}',
                type: "POST",
                data: data,
                success: function(response){
                    if(response.status == 'success') {
                        $('.btn-close').click();
                        $('.formUpdatePertanian')[0].reset();
                        $('.tabelPertanian').load(location.href+' .tabelPertanian');
                        toastr["success"]("Data Pertanian Berhasil DiPerbaharui")
                        toastr.options = {
                            "closeButton": true,
                            "progressBar": true,
                        };
                    } else {
                        toastr["error"]("Data Pertanian Gagal DiPerbaharui")
                        toastr.options = {
                            "closeButton": true,
                            "progressBar": true,
                        };
                    }
                }
            })
        })
    } );
</script>

@endsection
<!--End: Content -->

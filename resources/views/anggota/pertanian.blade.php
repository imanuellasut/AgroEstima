@extends('layouts.main')

@section('title', 'Data Pertanian')

<!-- Start: Sidebar -->
@section('card-profile')
    <a href="{{ route('profile-anggota') }}" class="to-profile">
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
                @if (Auth::user()->role = 0)
                    <small>Admin</small>
                @else
                    <small>Anggota</small>
                @endif
            </div>
        </div>
    </a>
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
    <li class="sidebar-menu-item active">
        <a href="{{ route('pertanian-anggota') }}" class="">
            <i class="ri-file-text-fill sidebar-menu-item-icon"></i>
            Data Pertanian
        </a>
    </li>
@endsection

@section('data_prediksi')
    <li class="sidebar-menu-item ">
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
        <div class="table-responsive mt-0">
            <table class="table table-bordered table-striped table-hover tabelPertanianAnggota" id="">
                <thead style="background-color: #96BA54">
                    <tr style="color: white">
                        <th class="text-center" style="middle; width: 15%;">Kode Pertanian</th>
                        <th class="text-center">Nama Anggota</th>
                        <th class="text-center">Tanggal Tanam</th>
                        <th class="text-center">Tanggal Panen</th>
                        <th class="text-center">Hasil Panen</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                @foreach ( $dataP as $pertanian )
                @if($pertanian->tgl_panen)
                <tbody>
                    <tr>
                        <td class="text-center" style="vertical-align: middle;">
                            {{ $pertanian->kode_pertanian }}
                        </td>
                        @php
                            $data = $pertanian->nama_anggota;
                            $name = implode(" ", array_slice(explode(" ", $data), 0, 2));
                        @endphp
                        <td class="text-center text-uppercase" style="vertical-align: middle;">{{ $name }}</td>
                        <td class="text-center" style="vertical-align: middle;">{{ $pertanian->tgl_tanam }}</td>
                        <td class="text-center" style="vertical-align: middle;">{{ $pertanian->tgl_panen }}</td>
                        <td class="text-center" style="vertical-align: middle;">
                            @if($pertanian->jml_produksi == null)
                            <span style="color: black">-</span>
                            @endif
                            {{ number_format($pertanian->jml_produksi, 2, ',', '.') }}</td>
                        <td class="text-center">
                            <a href="" class="tombolLihat m-1" data-bs-toggle="modal"
                            data-bs-target="#lihatPertanian_{{ $pertanian->kode_pertanian }}" >
                                <span class="iconify" data-icon="carbon:view-filled" data-width="20" style="color: white; margin-right: 2px"></span>
                            </a>
                            <a href="" class="tombolEdit m-1" data-bs-toggle="modal"
                            data-bs-target="#updatepertanianAnggota_{{ $pertanian->kode_pertanian }}"
                            data-kodePertanian = {{ $pertanian->kode_pertanian }}>
                                <span class="iconify" data-icon="basil:edit-solid" data-width="20"
                                style="color: white;"></span>
                            </a>
                            @include('anggota.modal_prediksi.view_pertanian')
                        </td>
                        @include('anggota.modal_prediksi.edit_pertanianAnggota')
                    </tr>
                </tbody>
                @endif
                @endforeach
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $(document).on('submit', '#updatePertanianAnggotaForm', function(e){
            e.preventDefault();
            var kodePertanian = $(this).data('kode_pertanian');
            var data = $(this).serializeArray();
            // console.log(data);

            $.ajax({
                url: '{{ route('perbarui_pertanian_anggota') }}',
                type: "POST",
                data: data,
                success: function(response){
                    if(response.status == 'success') {
                        $('.btn-close').click();
                        $('.formUpdatePertanianAnggota')[0].reset();
                        $('.tabelPertanianAnggota').load(location.href+' .tabelPertanianAnggota');
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

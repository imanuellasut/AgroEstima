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
                @php
                    $data = Auth::user()->name;
                    $name = strtoupper(implode(" ", array_slice(explode(" ", $data), 0, 2)));
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
<div class="card">
    <div class="card-header d-lg-flex justify-content-between" style="align-items: center">
        <div class="d-flex">
            <iconify-icon icon="icon-park-solid:data-file" class="sidebar-menu-item-icon"></iconify-icon>
            <small class="fw-bold">Daftar Data Prediksi</small>
        </div>
        <hr style="max-width: 100%;">
        <div>
            <a class="tombolTambah my-1" data-bs-toggle="modal" data-bs-target="#tambahPrediksi">
                <span class="iconify" data-icon="zondicons:add-solid" style="color: white; margin-right: 5px" data-width="20"></span>
                Tambah Data
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive mt-0">
            <table class="table table-bordered table-striped table-hover tablePrediksi" id="shwoTable">
                <thead style="background-color: #96BA54">
                    <tr style="color: white">
                        <th class="text-center" style="vertical-align: middle; width: 5%;">Kode Pertanian</th>
                        <th class="text-center" style="vertical-align: middle;">Anggota</th>
                        <th class="text-center" style="vertical-align: middle;">Tanggal Tanam</th>
                        @foreach ($variabels as $dataV )
                                <th scope="col" style="text-align: center; vertical-align: middle;">{{ $dataV->nama }}</th>
                            @endforeach
                        {{-- @foreach ($variabels as $variabel)
                        <th class="text-center" style="vertical-align: middle;">{{ $variabel->nama }} ({{ $variabel->satuan }})</th>
                        @endforeach --}}
                        <th class="text-center" style="vertical-align: middle;">Hasil Prediksi (Kg)</th>
                        <th class="text-center" style="vertical-align: middle;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataPertanian as $item)
                        <tr class="justify-center align-content-center">
                            <td class="text-center" style="vertical-align: middle;">{{ $item->kode_pertanian }}</td>
                            @php
                                $data = $item->nama_anggota;
                                $name = implode(" ", array_slice(explode(" ", $data), 0, 2));
                            @endphp
                            <td class="text-uppercase" style="vertical-align: middle; text">{{ $name }}</td>
                            <td class="text-center" style="vertical-align: middle;">{{ $item->tgl_tanam }}</td>
                            @php
                                $id_variabel_array = explode(',', $item->id_variabel);
                                $nilai_inputan_array = explode(',', $item->nilai_inputan);
                            @endphp
                            @foreach ($variabels as $variabel)
                                @php
                                    $index = array_search($variabel->id, $id_variabel_array);
                                @endphp
                                <td class="text-center" style="vertical-align: middle;">{{ $index !== false ? $nilai_inputan_array[$index] : '' }}</td>
                            @endforeach
                            <td class="text-center" style="vertical-align: middle;">
                                @if($item->jml_prediksi == null)
                                    <span class="badge bg-danger">Belum Dihitung </span>
                                @else
                                    {{ $item->jml_prediksi }}
                                @endif
                            </td>
                            <td class="text-center" style="width: 25%">
                                @if($item->jml_prediksi == null)
                                    <a href="" class="tombolLihat m-1" data-bs-toggle="modal" data-bs-target="#hitungPrediksi_{{ $item->kode_pertanian }}" >
                                        <span class="iconify" data-icon="mdi:calculator-variant" data-width="20" style="color: white; margin-right: 2px"></span>
                                    </a>
                                    <a href="" class="tombolEdit m-1" data-bs-toggle="modal"
                                    data-bs-target="#updatePrediksi_{{ $item->kode_pertanian }}"
                                    data-kodePertanian = {{ $item->kode_pertanian }}>
                                        <span class="iconify" data-icon="basil:edit-solid" data-width="20"
                                        style="color: white;"></span>
                                    </a>
                                @else

                                @endif
                                <a href="" class="tombolHapus m-1" data-bs-toggle="modal"
                                data-bs-target="#deletePrediksi_{{ $item->kode_pertanian }}">
                                    <span class="iconify" data-icon="material-symbols:delete" data-width="20"  style="color: white;"></span>
                                </a>
                            </td>
                        </tr>
                        @include('admin.modal_prediksi.edit_prediksi')
                        @include('admin.modal_prediksi.delete_prediksi')
                        @include('admin.modal_prediksi.hitung_prediksi')
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('admin.modal_prediksi.add_prediksi')



<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        //Tambah Data Prediksi
        $(document).on('submit', '#tambahPrediksiForm', function(e){
            e.preventDefault();

            var id_variabel = $('#id_variabel').val();
            var data = $(this).serializeArray();
            console.log(id_variabel);

            $.ajax({
                url: '{{ route('tambah_prediksi') }}',
                type: "POST",
                data: data,
                success: function(response) {
                    if(response.status == 'success') {
                        $('.btn-close').click();
                        $('#tambahPrediksiForm')[0].reset();
                        $('.tablePrediksi').load(location.href+' .tablePrediksi');
                        toastr["success"]("Data Prediksi Berhasil Ditambahkan")
                        toastr.options = {
                            "closeButton": true,
                            "progressBar": true,
                        };
                    }
                },
                error: function(err) {
                    console.log(err);
                    let error = err.responseJSON;
                    $('.errMsgContainerTglTanam').empty();
                    if(error.errors.tgl_tanam){
                        $('.errMsgContainerTglTanam').append('<span class="text-danger">'+'*'+error.errors.tgl_tanam+'</span>'+'<br>')
                    }
                    @foreach ($variabels as $variabel)
                        if(error.errors['nilai_' + {{ $variabel->id }}]){
                            $('.errMsgContainerNilai+{{ $variabel->id }}').empty();
                            $('.errMsgContainerNilai{{ $variabel->id }}').append('<span class="text-danger">'+'*'+error.errors['nilai_' + {{ $variabel->id }}]+'</span>'+'<br>')
                        }
                    @endforeach
                }
            });
        });

        //Hapus validasi modal tambah prediksi
        $(document).on('click', '.btn-close', function(e){
            $('.errMsgContainerNilai').empty();
            $('.errMsgContainerTglTanam').empty();
        });

        //tampil Edit Data Prediksi
        $(document).on('submit', '#updatePrediksiForm', function(e){
            e.preventDefault();
            var id_variabel = $('#id_variabel').val();
            var data = $(this).serializeArray();
            console.log(data);
            $.ajax({
                url: '{{ route('perbarui_prediksi') }}',
                type: "POST",
                data: data,
                success: function(response) {
                    if(response.status == 'success') {
                        $('.btn-close').click();
                        $('.tablePrediksi').load(location.href+' .tablePrediksi');
                        toastr["success"]("Data Prediksi Berhasil diPerbarui")
                        toastr.options = {
                            "closeButton": true,
                            "progressBar": true,
                        };
                    }
                },
                error: function(err) {
                    console.log(err);
                    let error = err.responseJSON;
                    $('.errMsgContainerNilai+{{ $variabel->id }}').empty();
                    $('.errMsgContainerTglTanam').empty();
                    if(error.errors.tgl_tanam){
                        $('.errMsgContainerTglTanam').append('<span class="text-danger">'+'*'+error.errors.tgl_tanam+'</span>'+'<br>')
                    }
                    @foreach ($variabels as $variabel)
                        if(error.errors['nilai_' + {{ $variabel->id }}]){
                            $('.errMsgContainerNilai{{ $variabel->id }}').append('<span class="text-danger">'+'*'+error.errors['nilai_' + {{ $variabel->id }}]+'</span>'+'<br>')
                        }
                    @endforeach
                }
            });
        })

        //Delete Data Prediksi
        $(document).on('submit', '#deletePrediksiForm', function(e){
            e.preventDefault();
            var data = $(this).serializeArray();
            // console.log(data);
            $.ajax({
                url: '{{ route('hapus_prediksi') }}',
                type: "DELETE",
                data: data,
                success: function(response) {
                    if(response.status == 'success') {
                        $('.btn-close').click();
                        $('.tablePrediksi').load(location.href+' .tablePrediksi');
                        toastr["success"]("Data Prediksi Berhasil diHapus")
                        toastr.options = {
                            "closeButton": true,
                            "progressBar": true,
                        };
                    }
                }
            });
        });
    });
</script>
@endsection
<!--End: Content -->

@extends('layouts.main')

@section('title', 'Data Himpunan Fuzzy')

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
    <li class="sidebar-menu-item ">
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
    <li class="sidebar-menu-item active">
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
    <nav class="px-3 py-2 bg-white rounded shadow-sm">
        <i class="ri-menu-line sidebar-toggle me-3 d-block d-md-none"></i>
        <h5 class="fw-bold mb-0 me-auto p-1">Data Himpunan Fuzzy</h5>
    </nav>
@endsection

<!-- Start: Content -->
@section('content')
<div class="card mb-4">
    <div class="card-header d-lg-flex justify-content-between " style="align-items: center">
        <div class="d-flex">
            <iconify-icon icon="material-symbols:folder-data" class="sidebar-menu-item-icon"></iconify-icon>
            <small class="fw-bold">Himpunan Keputusan (Produksi) </small>
        </div>
        <hr style="max-width: 100%;">
        <div class="">
            <a class="tombolTambah " data-bs-toggle="modal" data-bs-target="#tambahKeputusan">
                <span class="iconify" data-icon="zondicons:add-solid" style="color: white; margin-right: 5px" data-width="20"></span>
                Tambah Data
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive mt-0">
            <table class="table table-bordered table-striped table-hover tabel_keputusan">
                <thead  style="background-color: #96BA54">
                    <tr  style="color: white">
                        <th scope="col" style="width: 2rem">No</th>
                        <th scope="col">Nama Himpunan Fuzzy</th>
                        <th scope="col">Jenis Kurva</th>
                        <th scope="col">Domain/Nilai</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataKeputusan as $key => $data )
                        <tr>
                            <td style="text-align: center">{{ $key+1 }}</td>
                            <td>{{ $data ->nama_keputusan }}</td>
                            <td>{{ $data ->jenis_kurva }}</td>
                            <td>[{{ $data ->kep_nilai_bawah }}] [{{ $data ->kep_nilai_atas }}]</td>
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

@foreach ( $dataVariabel as $data )
    <div class="card mb-4">
        <div class="card-header d-lg-flex justify-content-between" style="align-items: center">
            <div class="d-flex">
                <iconify-icon icon="material-symbols:folder-data" class="sidebar-menu-item-icon"></iconify-icon>
                <small class="fw-bold">Fungsi Keanggotaan Variabel {{ $data->nama }}</small>
            </div>
            <hr style="max-width: 100%;">
            <div class="">
                <a class="tombolTambah d-flex"
                data-bs-toggle="modal"
                data-bs-target="#tambahAnggota{{ $data->id }}"
                data-id="{{ $data->id }}">
                    <span class="iconify" data-icon="zondicons:add-solid" style="color: white; margin-right: 5px" data-width="20"> </span>
                    Tambah Data
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive mt-0">
                <table class="table table-bordered table-striped table-hover " id="tabel_himpunan_{{ $data->id }}" >
                    <thead  style="background-color: #96BA54">
                        <tr  style="color: white">
                            <th scope="col" style="width: 2rem">No</th>
                            <th scope="col">Nama Himpunan Fuzzy</th>
                            <th scope="col">Jenis Kurva</th>
                            <th scope="col">Domain/Nilai</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataHimpunan as $key=>$himpunan )
                        @if($himpunan->id_variabel == $data->id)
                            <tr>
                                <td style="text-align: center">{{ $key+1 }}</td>
                                <td>{{ $himpunan ->nama }}</td>
                                <td>{{ $himpunan ->jenis_kurva }}</td>
                                <td>[{{ $himpunan ->nilai_bawah }}] [{{ $himpunan ->nilai_atas }}]</td>
                                <td class="text-lg-center">
                                    <a href="" class="tombolEdit m-1">
                                        <span class="iconify" data-icon="basil:edit-solid" data-width="20"  style="color: white;"></span>
                                    </a>
                                    <a href="" class="tombolHapus">
                                        <span class="iconify" data-icon="material-symbols:delete" data-width="20"  style="color: white;"></span>
                                    </a>
                                </td>
                            </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('admin.modal_himpunan.add_himpunan')
@endforeach
@include('admin.modal_himpunan.add_keputusan')

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {

            //Tambah Data Himpunan Keputusan
            $(document).on('click', '#tambah_keputusan', function(e){
                e.preventDefault();
                let nama_keputusan = $('#nama_keputusan').val();
                let jenis_kurva = $('#jenis_kurva_keputusan').val();
                let kep_nilai_bawah = parseFloat($('#kep_nilai_bawah').val()) || null;
                let kep_nilai_atas = parseFloat($('#kep_nilai_atas').val()) || null;

                console.log(nama_keputusan +',' + jenis_kurva + ',' +  kep_nilai_bawah + ',' + kep_nilai_atas);

                $.ajax({
                    url : '{{ route('tambah_keputusan') }}',
                    method : 'POST',
                    data : {
                        _token: '{{ csrf_token() }}',
                        nama_keputusan: nama_keputusan,
                        jenis_kurva: jenis_kurva,
                        kep_nilai_bawah: kep_nilai_bawah,
                        kep_nilai_atas: kep_nilai_atas,
                    },
                    success:function(res){
                        if(res.status=='success'){
                            $('.errMsgContainerNama').empty();
                            $('.errMsgContainerKurva').empty();
                            $('.errMsgContainerAtas').empty();
                            $('.errMsgContainerBawah').empty();
                            $('.btn-close').click();
                            $('#tambahKeputusanForm')[0].reset();
                            $('.tabel_keputusan').load(location.href+' .tabel_keputusan');
                            toastr["success"]("Data Anggota Keputusan Berhasil Ditambahkan")
                            toastr.options = {
                                "closeButton": true,
                                "progressBar": true,
                            };
                        }
                    },
                    error:function(err){
                        console.log(err);
                        let error = err.responseJSON;
                        $('.errMsgContainerNama').empty();
                        $('.errMsgContainerKurva').empty();
                        $('.errMsgContainerAtas').empty();
                        $('.errMsgContainerBawah').empty();
                        if (error && error.errors) {
                            if(error.errors.nama_keputusan){
                                $('.errMsgContainerNama').append('<span class="text-danger">'+'*'+error.errors.nama_keputusan+'</span>'+'<br>');
                            } if(error.errors.jenis_kurva){
                                $('.errMsgContainerKurva').append('<span class="text-danger">'+'*'+error.errors.jenis_kurva+'</span>'+'<br>');
                            } if(error.errors.kep_nilai_atas){
                                $('.errMsgContainerAtas').append('<span class="text-danger">'+'*'+error.errors.kep_nilai_atas+'</span>'+'<br>');
                            } if(error.errors.kep_nilai_bawah){
                                $('.errMsgContainerBawah').append('<span class="text-danger">'+'*'+error.errors.kep_nilai_bawah+'</span>'+'<br>');
                            }
                        }
                    }
                });
            });

            //Tambah Data Himpunan Variabel
            $(document).on('submit', '#tambahHimpunanForm', function(e){
                e.preventDefault();
                let id = $(this).attr('id').split('_')[2];
                let id_variabel = parseFloat($('#id_variabel').val()) || null;
                let formData = $(this).serialize();

                // Dapatkan nilai id_variabel dari formData
                let id_variabel_formData = formData.split('&')[1].split('=')[1];

                // console.log(id_variabel_formData +','+ formData);
                // console.log($('#tabel_himpunan_' + id_variabel_formData).attr('id'));

                $.ajax({
                    url : '{{ route('tambah_himpunan') }}',
                    method : 'POST',
                    data : formData,
                    success:function(res){
                        if(res.status=='success'){
                            $('.errMsgContainerNama').empty();
                            $('.errMsgContainerKurva').empty();
                            $('.errMsgContainerAtas').empty();
                            $('.errMsgContainerBawah').empty();
                            $('.btn-close').click();
                            $('.FormTambahHimpunan_' + id_variabel_formData)[0].reset();
                            $('#tabel_himpunan_' + id_variabel_formData).load(location.href + ' #tabel_himpunan_' + id_variabel_formData + ' > *');
                            toastr["success"]("Data Anggota Himpunan Berhasil Ditambahkan")
                            toastr.options = {
                                "closeButton": true,
                                "progressBar": true,
                            };
                        }
                    },
                    error:function(err){
                        console.log(err);
                        let error = err.responseJSON;
                        $('.errMsgContainerNama').empty();
                        $('.errMsgContainerKurva').empty();
                        $('.errMsgContainerAtas').empty();
                        $('.errMsgContainerBawah').empty();
                        if (error && error.errors) {
                            if(error.errors.nama){
                                $('.errMsgContainerNama').append('<span class="text-danger">'+'*'+error.errors.nama+'</span>'+'<br>');
                            } if(error.errors.jenis_kurva){
                                $('.errMsgContainerKurva').append('<span class="text-danger">'+'*'+error.errors.jenis_kurva+'</span>'+'<br>');
                            } if(error.errors.nilai_atas){
                                $('.errMsgContainerAtas').append('<span class="text-danger">'+'*'+error.errors.nilai_atas+'</span>'+'<br>');
                            } if(error.errors.nilai_bawah){
                                $('.errMsgContainerBawah').append('<span class="text-danger">'+'*'+error.errors.nilai_bawah+'</span>'+'<br>');
                            }
                        }
                    }
                });
            });

        });
    </script>
@endsection
<!--End: Content -->

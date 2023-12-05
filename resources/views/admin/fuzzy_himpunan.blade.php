@extends('layouts.main')

@section('title', 'Data Himpunan Fuzzy')

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
                            <td style="vertical-align: middle; text-align: center">{{ $key+1 }}</td>
                            <td style="vertical-align: middle;">{{ $data ->nama_keputusan }}</td>
                            <td style="vertical-align: middle;">{{ $data ->jenis_kurva }}</td>
                            <td style="vertical-align: middle;">[{{ $data ->kep_nilai_bawah }}] [{{ $data ->kep_nilai_atas }}]</td>
                            <td class="text-lg-center">
                                <a href="" class="tombolEdit m-1 editKeputusan"
                                data-bs-toggle="modal"
                                data-bs-target="#editKeputusan"
                                data-idkeputusan="{{ $data->id_keputusan }}"
                                data-namakeputusan="{{ $data ->nama_keputusan }}"
                                data-jeniskurvakeputusan="{{ $data->jenis_kurva }}"
                                data-kepnilaibawah="{{ $data->kep_nilai_bawah }}"
                                data-kepnilaiatas="{{ $data->kep_nilai_atas }}">
                                    <span class="iconify" data-icon="basil:edit-solid" data-width="20"  style="color: white;"></span>
                                </a>
                                <a href="" class="tombolHapus deleteKeputusan"
                                data-bs-toggle="modal"
                                data-bs-target="#deleteKeputusan_{{ $data->id_keputusan }}"
                                data-idkeputusan="{{ $data->id_keputusan }}"
                                data-namakeputusan="{{ $data ->nama_keputusan }}"
                                data-jeniskurvakeputusan="{{ $data->jenis_kurva }}"
                                data-kepnilaibawah="{{ $data->kep_nilai_bawah }}"
                                data-kepnilaiatas="{{ $data->kep_nilai_atas }}">
                                    <span class="iconify" data-icon="material-symbols:delete" data-width="20"  style="color: white;"></span>
                                </a>
                            </td>
                        </tr>
                        @include('admin.modal_himpunan.edit_keputusan')
                        @include('admin.modal_himpunan.delete_keputusan')
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
            <div class="d-flex">
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
                <table class="table table-bordered table-striped table-hover tabel_anggota_{{$data->id }}" id="tabel_himpunan_{{ $data->id }}" >
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
                        @php
                        $no = 1;
                        @endphp
                        @foreach ($dataHimpunan as $himpunan )
                        @if($himpunan->id_variabel == $data->id)
                            <tr>
                                <td style="vertical-align: middle; text-align: center">{{ $no++ }}</td>
                                <td style="vertical-align: middle;">{{ $himpunan ->nama }}</td>
                                <td style="vertical-align: middle;">{{ $himpunan ->jenis_kurva }}</td>
                                <td style="vertical-align: middle;">[{{ $himpunan ->nilai_bawah }}] [{{ $himpunan ->nilai_atas }}]</td>
                                <td class="text-lg-center">
                                    <a href="" class="tombolEdit m-1 editAnggota"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editAnggota{{ $himpunan->id }}"
                                    data-idvariabel="{{ $data->id }}"
                                    data-id="{{ $himpunan->id }}"
                                    data-namahimpunan="{{ $himpunan ->nama }}"
                                    data-jeniskurvahimpunan="{{ $himpunan->jenis_kurva }}"
                                    data-himnilaibawah="{{ $himpunan->nilai_bawah }}"
                                    data-himnilaiatas="{{ $himpunan->nilai_atas }}">
                                        <span class="iconify" data-icon="basil:edit-solid" data-width="20"  style="color: white;"></span>
                                    </a>
                                    <a href="" class="tombolHapus deleteAnggota"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteAnggota{{ $himpunan->id }}"
                                    data-idvariabel="{{ $data->id }}"
                                    data-id="{{ $himpunan->id }}"
                                    data-namahimpunan="{{ $himpunan ->nama }}"
                                    data-jeniskurvahimpunan="{{ $himpunan->jenis_kurva }}"
                                    data-himnilaibawah="{{ $himpunan->nilai_bawah }}"
                                    data-himnilaiatas="{{ $himpunan->nilai_atas }}">
                                        <span class="iconify" data-icon="material-symbols:delete" data-width="20"  style="color: white;"></span>
                                    </a>
                                </td>
                            </tr>
                            @include('admin.modal_himpunan.delete_himpunan')
                            @include('admin.modal_himpunan.edit_himpunan')
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

            //Edit Data Himpunan Keputusan
            $(document).on('click', '.editKeputusan', function(e){
                e.preventDefault();
                let id = $(this).data('idkeputusan');
                let namaKeputusan = $(this).data('namakeputusan');
                let jenisKurva = $(this).data('jeniskurvakeputusan');
                let kepNilaiBawah = $(this).data('kepnilaibawah');
                let kepNilaiAtas = $(this).data('kepnilaiatas');

                $('#up_id_keputusan').val(id);
                $('#up_nama_keputusan').val(namaKeputusan);
                $('#up_jenis_kurva_keputusan').val(jenisKurva);
                $('#up_kep_nilai_bawah').val(kepNilaiBawah);
                $('#up_kep_nilai_atas').val(kepNilaiAtas);
                $('#updateModal').modal('show');

                // console.log('Kode:', id);
                // console.log('Nama:', namaKeputusan);
                // console.log('Jenis Kurva:', jenisKurva);
                // console.log('Nilai Bawah:', kepNilaiBawah);
                // console.log('Nilai Atas:', kepNilaiAtas);

            });

            //Update Data Himpunan Keputusan
            $(document).on('click', '#update_keputusan', function(e){
                e.preventDefault();
                let up_id_keputusan = parseFloat($('#up_id_keputusan').val()) || null;
                let up_nama_keputusan = $('#up_nama_keputusan').val();
                let up_jenis_kurva_keputusan = $('#up_jenis_kurva_keputusan').val();
                let up_kep_nilai_bawah = parseFloat($('#up_kep_nilai_bawah').val()) || null;
                let up_kep_nilai_atas = parseFloat($('#up_kep_nilai_atas').val()) || null;

                // console.log('Kode:', up_id_keputusan);
                // console.log('Nama:', up_nama_keputusan);
                // console.log('Jenis Kurva:', up_jenis_kurva_keputusan);
                // console.log('Nilai Bawah:', up_kep_nilai_bawah);
                // console.log('Nilai Atas:', up_kep_nilai_atas);

                $.ajax({
                    url : '{{ route('perbarui_keputusan') }}',
                    method : 'POST',
                    data : {
                        _token: '{{ csrf_token() }}',
                        up_id_keputusan : up_id_keputusan,
                        up_nama_keputusan : up_nama_keputusan,
                        up_jenis_kurva_keputusan: up_jenis_kurva_keputusan,
                        up_kep_nilai_bawah: up_kep_nilai_bawah,
                        up_kep_nilai_atas: up_kep_nilai_atas,
                    },
                    success:function(res){
                        if(res.status=='success'){
                            $('.btn-close').click();
                            $('#editKeputusanForm')[0].reset();
                            $('.tabel_keputusan').load(location.href+' .tabel_keputusan');
                            toastr["success"]("Data Anggota Keputusan Berhasil Diedit")
                            toastr.options = {
                                "closeButton": true,
                                "progressBar": true,
                            };
                        }
                    },
                    error:function(err){
                        console.log(err);
                        let error = err.responseJSON;
                        console.log(error);
                        $('.errMsgContainerNama').empty();
                        $('.errMsgContainerKurva').empty();
                        $('.errMsgContainerAtas').empty();
                        $('.errMsgContainerBawah').empty();
                        if (error && error.errors) {
                            if(error.errors.up_nama_keputusan){
                                $('.errMsgContainerNama').append('<span class="text-danger">'+'*'+error.errors.up_nama_keputusan+'</span>'+'<br>');
                            } if(error.errors.up_kep_nilai_atas){
                                $('.errMsgContainerAtas').append('<span class="text-danger">'+'*'+error.errors.up_kep_nilai_atas+'</span>'+'<br>');
                            } if(error.errors.up_kep_nilai_bawah){
                                $('.errMsgContainerBawah').append('<span class="text-danger">'+'*'+error.errors.up_kep_nilai_bawah+'</span>'+'<br>');
                            }
                        }
                    }
                });
            });

            //View Hapus Data Himpunan Keputusan
            $(document).on('click', '.deleteKeputusan', function(e){
                e.preventDefault();
                let id = $(this).data('idkeputusan');
                let namakeputusan = $(this).data('namakeputusan');
                let jenisKurva = $(this).data('jeniskurvakeputusan');
                let kepNilaiBawah = $(this).data('kepnilaibawah');
                let kepNilaiAtas = $(this).data('kepnilaiatas');

                $('#down_id_keputusan').val(id);
                $('#down_nama_keputusan').val(namakeputusan);
                $('#down_jenis_kurva_keputusan').val(jenisKurva);
                $('#down_kep_nilai_bawah').val(kepNilaiBawah);
                $('#down_kep_nilai_atas').val(kepNilaiAtas);
                $('#updateModal').modal('show');
            });

            //Hapus Data Himpunan Keputusan
            $(document).on('click', '#delete_keputusan', function(e){
                e.preventDefault();
                let down_id_keputusan = $('#down_id_keputusan').val();

                $.ajax({
                    url : '{{ route('hapus_keputusan') }}',
                    method : 'delete',
                    data : {
                        _token: '{{ csrf_token() }}',
                        down_id_keputusan : down_id_keputusan,
                    },
                    success:function(res){
                        if(res.status=='success'){
                            $('.btn-close').click();
                            $('.tabel_keputusan').load(location.href+' .tabel_keputusan');
                            toastr["success"]("Data Anggota Keputusan Berhasil Dihapus")
                            toastr.options = {
                                "closeButton": true,
                                "progressBar": true,
                            };
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

            //View Edit Data Himpunan Keputusan
            $(document).on('click', '.editAnggota', function(e){
                e.preventDefault();
                let id = $(this).data('id');
                let idvariabel = $(this).data('idvariabel');
                let namahimpunan = $(this).data('namahimpunan');
                let jenis_kurva_himpunan = $(this).data('jeniskurvahimpunan');
                let himnilaibawah = $(this).data('himnilaibawah');
                let himnilaiatas = $(this).data('himnilaiatas');

                $('#up_id').val(id);
                $('#up_id_variabel').val(idvariabel);
                $('#up_nama_'+ id).val(namahimpunan);
                $('#up_jenis_kurva_'+ id).val(jenis_kurva_himpunan);
                $('#up_him_nilai_bawah_'+ id).val(himnilaibawah);
                $('#up_him_nilai_atas_'+ id).val(himnilaiatas);
                $('#updateModal').modal('show');

                // console.log('Kode:', idvariabel);
                // console.log('Nama:', namahimpunan);
                // console.log('Jenis Kurva:', jenis_kurva_himpunan);
                // console.log('Nilai Bawah:', himnilaibawah);
                // console.log('Nilai Atas:', himnilaiatas);
            });

            //Update Data Himpunan Keputusan
            $(document).on('click', '#editHimpunan', function(e){
                e.preventDefault();
                let id = $('#up_id').val();
                let up_id = $('#up_id').val();
                let id_variabel = parseFloat($('#up_id_variabel').val()) || null;
                let up_nama = $('#up_nama_'+ id).val();
                let up_jenis_kurva = $('#up_jenis_kurva_'+ id).val();
                let up_him_nilai_bawah = parseFloat($('#up_him_nilai_bawah_'+ id).val()) || null;
                let up_him_nilai_atas = parseFloat($('#up_him_nilai_atas_'+ id).val()) || null;

                // console.log('Kode:', id_variabel);
                // console.log('Nama:', up_nama);
                // console.log('Jenis Kurva:', up_jenis_kurva);
                // console.log('Nilai Bawah:', up_him_nilai_bawah);
                // console.log('Nilai Atas:', up_him_nilai_atas);

                $.ajax({
                    url : '{{ route('perbarui_himpunan') }}',
                    method : 'POST',
                    data : {
                        _token: '{{ csrf_token() }}',
                        up_id : up_id,
                        id_variabel : id_variabel,
                        up_nama : up_nama,
                        up_jenis_kurva: up_jenis_kurva,
                        up_him_nilai_bawah: up_him_nilai_bawah,
                        up_him_nilai_atas: up_him_nilai_atas,
                    },
                    success:function(res){
                        if(res.status=='success'){
                            $('.errMsgContainerUpNama').empty();
                            $('.errMsgContainerUpAtas').empty();
                            $('.errMsgContainerUpBawah').empty();
                            $('.btn-close').click();
                            $('.FormEditHimpunan_'+id)[0].reset();
                            $('.tabel_anggota_' + id_variabel).load(location.href+' .tabel_anggota_' + id_variabel);
                            toastr["success"]("Data Anggota Himpunan Berhasil diPerbaharui")
                            toastr.options = {
                                "closeButton": true,
                                "progressBar": true,
                            };
                        }
                    },
                    error:function(err){
                        console.log(err);
                        let error = err.responseJSON;
                        console.log(error);
                        $('.errMsgContainerUpNama').empty();
                        $('.errMsgContainerUpAtas').empty();
                        $('.errMsgContainerUpBawah').empty();
                        if (error && error.errors) {
                            if(error.errors.up_nama){
                                $('.errMsgContainerUpNama').append('<span class="text-danger">'+'*'+error.errors.up_nama+'</span>'+'<br>');
                            } if(error.errors.up_him_nilai_atas){
                                $('.errMsgContainerUpAtas').append('<span class="text-danger">'+'*'+error.errors.up_him_nilai_atas+'</span>'+'<br>');
                            } if(error.errors.up_him_nilai_bawah){
                                $('.errMsgContainerUpBawah').append('<span class="text-danger">'+'*'+error.errors.up_him_nilai_bawah+'</span>'+'<br>');
                            }
                        }
                    }
                });

            });

            //View Hapus Data Himpunan Anggota
            $(document).on('click', '.deleteAnggota', function(e){
                e.preventDefault();
                let id = $(this).data('id');
                let idvariabel = $(this).data('idvariabel');
                let namahimpunan = $(this).data('namahimpunan');
                let jenis_kurva_himpunan = $(this).data('jenis_kurva_himpunan');
                let himnilaibawah = $(this).data('himnilaibawah');
                let himnilaiatas = $(this).data('himnilaiatas');

                $('#down_id').val(id);
                $('#down_idvariabel').val(idvariabel);
                $('#down_nama_himpunan').val(namahimpunan);
                $('#down_jenis_kurva_himpunan').val(jenis_kurva_himpunan);
                $('#down_him_nilai_bawah').val(himnilaibawah);
                $('#down_him_nilai_atas').val(himnilaiatas);
                $('#deleteModal').modal('show');
            });

            //Hapus Data Himpunan Keputusan
            $(document).on('click', '#delete_himpunan', function(e){
                e.preventDefault();
                let down_id = $('#down_id').val();
                let down_idvariabel = parseFloat($('#down_idvariabel').val()) || null;

                $.ajax({
                    url : '{{ route('hapus_himpunan') }}',
                    method : 'delete',
                    data : {
                        _token: '{{ csrf_token() }}',
                        down_id : down_id,
                    },
                    success:function(res){
                        if(res.status=='success'){
                            $('.btn-close').click();
                            $('.tabel_anggota_' + down_idvariabel).load(location.href+' .tabel_anggota_' + down_idvariabel);
                            toastr["success"]("Data Anggota Himpunan Berhasil Dihapus")
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

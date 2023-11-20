@extends('layouts.main')

@section('title', 'Data Variabel')

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
    <li class="sidebar-menu-item">
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
    <li class="sidebar-menu-item active">
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
        <iconify-icon icon="mdi:folder-sync" class="sidebar-menu-item-icon"></iconify-icon>
        <small class="mb-0 me-auto p-1">Data Variabel</small>
    </nav>
@endsection

<!-- Start: Content -->
@section('content')
    <div class="card">
        <div class="card-header d-lg-flex justify-content-between" style="align-items: center">
            <div class="d-flex">
                <iconify-icon icon="mdi:folder-sync" class="sidebar-menu-item-icon"></iconify-icon>
                <small class="fw-bold">Daftar Data Variabel Fuzzy</small>
            </div>
            <hr style="max-width: 100%; margin-left: 0px">
            <div>
                <a class="tombolTambah my-1" data-bs-toggle="modal" data-bs-target="#tambahModal">
                    <span class="iconify" data-icon="zondicons:add-solid" style="color: white; margin-right: 5px" data-width="20"></span>
                    Tambah Data
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="mt-0 table-sm table-responsive">
                <table class="table table-hover" id="tabelVariabel">
                    <thead style="background-color: #96BA54">
                        <tr style="color: white">
                            <th scope="col" style="width: 2rem">#</th>
                            <th scope="col">Nama Variabel</th>
                            <th scope="col">Satuan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataVariabel as $key=>$data )
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $data->nama }}</td>
                            <td>{{ $data->satuan }}</td>
                            <td class="text-lg-center">
                                <a class="tombolEdit m-1 edit-button edit_variabel_form"
                                data-bs-toggle="modal"
                                data-bs-target="#updateModal"
                                data-id="{{ $data->id }}"
                                data-nama="{{ $data->nama }}"
                                data-satuan="{{ $data->satuan }}">
                                    <span class="iconify" data-icon="basil:edit-solid" data-width="20"  style="color: white;"></span>
                                </a>
                                <a class="tombolHapus delete_variabel_form"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteModal"
                                    data-id="{{ $data->id }}"
                                    data-nama="{{ $data->nama }}"
                                    data-satuan="{{ $data->satuan }}">
                                    <span class="iconify" data-icon="material-symbols:delete" data-width="20"  style="color: white;" ></span>
                                </a>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('admin.modal_variabel.add_variabel')
    @include('admin.modal_variabel.update_variabel')
    @include('admin.modal_variabel.delete_variabel')

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>



    <script>
        $(document).ready(function() {

            //Tambah Data Variabel
            $(document).on('click', '#tambah_variabel', function(e){
                e.preventDefault();
                let nama = $('#nama').val();
                let satuan = $('#satuan').val();
                // console.log(nama+satuan);

                $.ajax({
                    url : '{{ route('tambah_variabel') }}',
                    method : 'POST',
                    data : {
                        _token: '{{ csrf_token() }}',
                        nama : nama,
                        satuan : satuan
                    },
                    success:function(res){
                        if(res.status=='success'){
                            $('.btn-close').click();
                            $('#tambahVariabelForm')[0].reset();
                            $('.table').load(location.href+' .table');
                            toastr["success"]("Data Variabel Berhasil Ditambahkan")
                            toastr.options = {
                                "closeButton": true,
                                "progressBar": true,
                            };
                        }
                    }, error:function(err){
                        let error = err.responseJSON;
                        $('.errMsgContainerNama').empty();
                        $('.errMsgContainerSatuan').empty();

                        if(error.errors.nama){
                            $('.errMsgContainerNama').append('<span class="text-danger">'+'*'+error.errors.nama+'</span>'+'<br>')
                        } if(error.errors.satuan){
                            $('.errMsgContainerSatuan').append('<span class="text-danger">'+'*'+error.errors.satuan+'</span>'+'<br>')
                        }
                    }
                });
            });

            //Tampil Edit Data Variabel
            $(document).on('click', '.edit_variabel_form', function(){
                let id = $(this).data('id');
                let nama = $(this).data('nama');
                let satuan = $(this).data('satuan');

                $('#up_id').val(id);
                $('#up_nama').val(nama);
                $('#up_satuan').val(satuan);
            });

            //Edit Data Variabel
            $(document).on('click', '#edit_variabel', function(e){
                e.preventDefault();
                let up_id = $('#up_id').val();
                let up_nama = $('#up_nama').val();
                let up_satuan = $('#up_satuan').val();

                $.ajax({
                    url : '{{ route('perbarui_variabel') }}',
                    method : 'POST',
                    data : {
                        _token: '{{ csrf_token() }}',
                        up_id : up_id,
                        up_nama :up_nama,
                        up_satuan : up_satuan
                    },
                    success:function(res){
                        if(res.status=='success'){
                            $('.btn-close').click();
                            $('#perbaruiVariabelForm')[0].reset();
                            $('.table').load(location.href+' .table');
                            toastr["success"]("Data Variabel Berhasil Ditambahkan")
                            toastr.options = {
                                "closeButton": true,
                                "progressBar": true,
                            };
                        }
                    }, error:function(err){
                        let error = err.responseJSON;
                        $.each(error.errors, function(index, value){
                            $('.errMsgContainer').append('<span class="text-danger">'+value+'</span>'+'<br>')
                        });
                    }
                });
            });

             //Tampil Hapus Data Variabel
            $(document).on('click', '.delete_variabel_form', function(){
                let id = $(this).data('id');
                let nama = $(this).data('nama');
                let satuan = $(this).data('satuan');

                $('#down_id').val(id);
                $('#down_nama').val(nama);
                $('#down_satuan').val(satuan);
            });

            //Hapus Data Variabel
            $(document).on('click', '#delete_variabel', function(e){
                e.preventDefault();
                let down_id = $('#down_id').val();

                $.ajax({
                    url : '{{ route('hapus_variabel') }}',
                    method : 'delete',
                    data : {
                        _token: '{{ csrf_token() }}',
                        down_id : down_id,
                    },
                    success:function(res){
                        if(res.status=='success'){
                            $('.btn-close').click();
                            $('.table').load(location.href+' .table');
                            toastr["success"]("Data Variabel Berhasil Dihapus")
                            toastr.options = {
                                "closeButton": true,
                                "progressBar": true,
                            };
                        }
                    }
                });
            });

            // //Pagination
            // $(document).on('click', '.pagination a', function(e){
            //     e.preventDefault();
            //     let page = $(this).attr('href').split('page=')[1];
            //     variabel(page);

            // });

            // function variabel(page){
            //     $.ajax ({
            //         url : '/admin/data-variabel/pagination-data?='+page,
            //         success:function(data){

            //         }
            //     });
            // }

        } );
    </script>

@endsection

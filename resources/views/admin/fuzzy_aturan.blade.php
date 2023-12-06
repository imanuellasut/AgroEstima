@extends('layouts.main')

@section('title', 'Data Prediksi')

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
    <li class="sidebar-menu-item active">
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
                <div class="d-flex justify-content-end">
                    <button type="submit" class="tombolTambah my-1">
                        <span class="iconify" data-icon="zondicons:add-solid" style="color: white; margin-right: 5px" data-width="20"></span>
                        Tambah Aturan
                    </button>
                </div>
            </form>
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
                <table class="table table-hover">
                    <thead style="background-color: #96BA54">
                        <tr style="color: white;" class="justify-center align-content-center">
                            <th scope="col" style="text-align: center; width: 5%; vertical-align: middle;" rowspan="2">Kode</th>
                            <th scope="col" style="text-align: center; vertical-align: middle;" colspan="{{ $jumlahVariabel }}">Aturan</th>
                            <th scope="col" style="text-align: center; vertical-align: middle;" rowspan="2">Hasil Prediksi</th>
                            <th scope="col" style="text-align: center; vertical-align: middle;" rowspan="2">Aksi</th>
                        </tr>
                        <tr  style="color: white; "class="justify-center align-content-center">
                            @foreach ($variabel as $dataV )
                                <th scope="col" style="text-align: center; vertical-align: middle;">{{ $dataV->nama }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataAturan as $item)
                        <tr class="justify-center align-content-center" >
                            <td class="text-center" style="vertical-align: middle;">{{ $item->kode_aturan }}</td>
                            @php
                                $id_variabel_array = explode(',', $item->id_variabel);
                                $namaHimpunan = explode(',', $item->nama_himpunan);
                            @endphp
                            @foreach ($variabel as $dataV )
                                @php
                                    $index = array_search($dataV->id, $id_variabel_array);
                                @endphp
                                <td class="text-center" style="vertical-align: middle;"> {{ $index !== false ? $namaHimpunan[$index] : '' }}</td>
                            @endforeach
                            @php
                                $data = $item->nama_keputusan;
                                $nameKeputusan = implode("", array_slice(explode(",", $data), 0, 1));
                            @endphp
                            <td class="text-center" style="vertical-align: middle;">{{ $nameKeputusan }}</td>
                            <td class="text-lg-center">
                                <a href="" class="tombolEdit m-1 edit_aturan"
                                data-bs-toggle="modal"
                                data-bs-target="#updateModal"
                                data-kode="{{ $item->kode_aturan }}"
                                data-keputusan="{{ $item->nama_keputusan }}"
                                data-idkeputusan ="{{ $item->id_keputusan }}"
                                data-himpunan="{{ $item->nama_himpunan }}"
                                data-idhimpunan ="{{ $item->id_himpunan }}">
                                    <span class="iconify" data-icon="basil:edit-solid" data-width="20"  style="color: white;"></span>
                                </a>
                                <a href="" class="tombolHapus hapus_aturan"
                                data-bs-toggle="modal"
                                data-bs-target="#deleteModal"
                                data-kode="{{ $item->kode_aturan }}">
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

    @include('admin.modal_aturan.edit_aturan')
    @include('admin.modal_aturan.delete_aturan')

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        //View Edit Data Aturan
        $(document).on('click', '.edit_aturan', function() {

                var kode = $(this).data('kode');
                var himpunan = $(this).data('himpunan').split(',');
                var idhimpunan = $(this).data('idhimpunan').split(',');
                var keputusan = $(this).data('keputusan');
                var idkeputusan = $(this).data('idkeputusan');

                $('#up_kode').val(kode);
                $('#up_himpunan').val(idhimpunan);
                $('#up_keputusan').val(keputusan);


                // Untuk setiap id dalam array idhimpunan
                for (var i = 0; i < idhimpunan.length; i++) {
                    // Dapatkan opsi dengan id yang sesuai
                    var option = $('#option_' + idhimpunan[i]);

                    // Jika opsi ditemukan
                    if (option.length) {
                        // Jika nilai opsi sama dengan nilai dalam array id_himpunan
                        if (option.val() == idhimpunan[i]) {
                            // Tambahkan atribut 'selected' ke opsi ini
                            option.prop('selected', true);
                        }
                    }
                }

                // Dapatkan opsi dengan id yang sesuai
                var option = $('#option_keputusan_' + idkeputusan);

                // Jika opsi ditemukan
                if (option.length) {
                    // Tambahkan atribut 'selected' ke opsi ini
                    option.prop('selected', true);
                }

                console.log('Kode:', kode);
                console.log('Himpunan:', himpunan);
                console.log('ID Himpunan:', idhimpunan);
                console.log('Keputusan:', keputusan);
                console.log('ID Keputusan:', idkeputusan);
                console.log('Opsi:', option)

        });

         //update Data Variabel
        $(document).on('click', '#edit_variabel', function(e){
            e.preventDefault();
            let up_keputusan = $('#up_keputusan').val();
            let up_kode = $('#up_kode').val();

            console.log('Keputusan:', up_keputusan);
            console.log('Kode:', up_kode);

            // Mendapatkan nilai dari setiap elemen select up_himpunan
            @foreach ($variabel as $v)
                let up_himpunan_{{ $v->id }} = $('#up_himpunan[{{ $v->id }}]').val();
                @foreach ($v->himpunan  as $h )
                let option_{{ $h->id }} = $('#option_{{ $h->id }}').val();
                console.log('Himpunan {{ $v->id }}:',);
                @endforeach
            @endforeach;
        });

        $(document).on('click', '.hapus_aturan', function() {
            var kode = $(this).data('kode');
            var aturan = $(this).data('aturan');
            var keputusan = $(this).data('keputusan');

            $('#down_kode').val(kode);
            $('#down_aturan').val(aturan);
            $('#down_keputusan').val(keputusan);
        } );

        $(document).on('click', '#delete_aturan', function(e){
                e.preventDefault();
                let down_kode = $('#down_kode').val();

                $.ajax({
                    url : '{{ route('hapus_aturan') }}',
                    method : 'delete',
                    data : {
                        _token: '{{ csrf_token() }}',
                        down_kode : down_kode,
                    },
                    success:function(res){
                        if(res.status=='success'){
                            $('.btn-close').click();
                            $('.table').load(location.href+' .table');
                            toastr["success"]("Data Aturan Berhasil Dihapus")
                            toastr.options = {
                                "closeButton": true,
                                "progressBar": true,
                            };
                        }
                    }
                });
            });
    } );

    toastr.options = {
        "closeButton": true,
        "progressBar": true,
    }
    @if (Session::has('success'))
        toastr.success('{{ Session::get('success') }}')
    @endif
</script>
@endsection
<!--End: Content -->

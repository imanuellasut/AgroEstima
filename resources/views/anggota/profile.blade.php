@extends('layouts.main')

@section('title', 'Profile')

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
    <li class="sidebar-menu-item ">
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
    <li class="sidebar-menu-item active">
        <a href="{{ route('profile-anggota') }}" class="">
            <i class="ri-user-settings-fill sidebar-menu-item-icon"></i>
            Profile
        </a>
    </li>
@endsection
<!-- End: Sidebar -->

@section('navbar')
    <nav class="px-3 py-2 bg-white rounded shadow-sm">
        <i class="ri-menu-line sidebar-toggle me-3 d-block d-md-none"></i>
        <h5 class="fw-bold mb-0 me-auto p-1">Profile</h5>
    </nav>
@endsection

<!-- Start: Content -->
@section('content')
<div class="d-lg-flex">
    <div class="card m-1">
        <div class="card-body" style="width: 250px">
            <li class="mb-2 menu-profile">
                <a href="" class="" data-bs-toggle="modal" data-bs-target="#editProfileAnggota_{{ Auth::user()->nik }}">
                    <i class="ri-settings-3-fill"></i>
                    Ubah Profile
                </a>
            </li>
            <li class="menu-profile">
                <a href="" class="" data-bs-toggle="modal" data-bs-target="#editPasswrodAnggota_{{ Auth::user()->nik }}">
                    <i class="ri-lock-password-fill"></i>
                    Ubah Password
                </a>
            </li>
        </div>
    </div>
    <div class="card m-1">
        <div class="card-body d-lg-flex align-items-center justify-content-center">
            @if(Auth::user()->foto != null)
            <div class="image-profile" style="margin-right: 10px;">
                <img src="{{ asset('img/profile/' .Auth::user()->foto ) }}" class="rounded-2" alt="" style="width: 200px; height: auto; aspect-ratio: 1 / 1; object-fit: cover">
            </div>
            @else
            <div class="image-profile" style="margin-right: 10px;">
                <img src="{{ asset('Template-Dashboard/img/default-profile.jpg' ) }}" class="rounded-2" alt="" style="width: 200px; height: auto; aspect-ratio: 1 / 1; object-fit: cover">
            </div>
            @endif
        </div>
            <hr>
        <div class="card-body d-lg-flex justify-content-center">
            <div class="info-profil row" >
                <div class="col-md-12 mb-3">
                    <label for="" class="labels mb-1">Nama</label>
                    <input type="text" name="" id="" class="form-control bg-light"
                    value="{{ Auth::user()->name }}" readonly>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="" class="labels mb-1">NIK (Nomor Induk Kependudukan)</label>
                    <input type="text" name="" id="" class="form-control bg-light" readonly
                    value="{{ Auth::user()->nik }}">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="" class="labels mb-1">No Hp</label>
                    <input type="text" name="" id="" class="form-control bg-light" readonly
                    value="{{ Auth::user()->no_hp }}">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="" class="labels mb-1">Email</label>
                    <input type="text" name="" id="" class="form-control bg-light" readonly
                    value="{{ Auth::user()->email }}">
                </div>
                <div class="col-md-12 ">
                    <label for="" class="labels mb-1">Alamat</label>
                    <textarea type="text" name="" id="" class="form-control bg-light" readonly>{{ Auth::user()->alamat }} </textarea>
                </div>
            </div>
        </div>
    </div>
</div>

@include('anggota.modal_profile.editProfile')
@include('anggota.modal_profile.editPassword')

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function () {
        $(document).on('submit', '#formEditProfileAnggota', function(e){
            e.preventDefault();

            var data = new FormData(this);
            for (var pair of data.entries()) {
                console.log(pair[0]+ ', ' + pair[1]);
            }

            $.ajax({
                url: '{{ route('update_profile_anggota') }}',
                type: 'POST',
                data: data,
                contentType: false,
                processData: false,
                success: function(response){
                    $('.btn-close').click();
                    //AutoReload
                    setTimeout(function() {
                        location.reload();
                    }, 500);
                    // tampilkan pesan success
                    toastr["success"]("Profil berhasil diubah")
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
                    };
                },
                error: function(error){
                    console.log(error);
                    // tampilkan pesan error
                    toastr["success"]("Profil tidak berhasil diubah")
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
                    };
                }
            });
        });

        $(document).on('click', '#clickPassAnggota', function(e){
            e.preventDefault();

            let newPassword = $('#new_password').val();
            let confirmPassword = $('#confirm_new_password').val();

            if (newPassword !== confirmPassword) {
                toastr["error"]("Password tidak sama")
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                };
                return;
            }

            console.log(newPassword, confirmPassword);

            $.ajax({
                url: '{{ route('update_password_anggota') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    new_password: newPassword,
                    new_password_confirmation: confirmPassword
                },
                success: function(response){
                    $('.btn-close').click();
                    //AutoReload
                    setTimeout(function() {
                        location.reload();
                    }, 500);
                    // tampilkan pesan success
                    toastr["success"]("Password berhasil diubah")
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
                    };
                },
                error: function(error){
                    console.log(error);
                    // tampilkan pesan error
                    toastr["error"]("Password tidak berhasil diubah dikarenakan jumlah password kurang dari 8 karakter")
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
                    };
                }
            });
        });
    });
</script>

@endsection
<!--End: Content -->

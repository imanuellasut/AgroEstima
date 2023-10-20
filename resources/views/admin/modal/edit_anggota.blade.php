<div class="modal fade" id="editAnggota__{{ $data->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Anggota</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('update-anggota', $data->id) }}" method="POST" id="formUbahAnggota">
                <div class="modal-body">
                    @csrf
                    <div class="info-profil row">
                        <div class="col-md-12 mb-3 form-floating">
                            <input type="text" class="form-control" placeholder="Masukan nama lengkap" id="floatingNama" name="name" value="{{ old('name', $data->name) }}">
                            <label for="floatingNama" style="margin-left: 10px">Nama Lengkap</label>
                        </div>
                        <div class="col-md-12 mb-3 form-floating">
                            <input type="number" class="form-control" placeholder="Masukan NIK" id="floatingNIK" name="nik" value="{{ old('nik', $data->nik) }}">
                            <label for="floatingNIK" style="margin-left: 10px">NIK (Nomor Induk Kependudukan)</label>
                        </div>
                        <div class="col-md-12 mb-3 form-floating">
                            <input type="number" class="form-control" placeholder="Masukan NO HP" id="floatingNoHP" name="no_hp" value="{{ old('no_hp', $data->no_hp) }}">
                            <label for="floatingNoHP" style="margin-left: 10px">No HP</label>
                        </div>
                        <div class="col-md-12 mb-3 form-floating">
                            <input type="email" class="form-control" placeholder="Masukan Email" id="floatingEmail" name="email" value="{{ old('email', $data->email) }}">
                            <label for="floatingEmail" style="margin-left: 10px">Email</label>
                        </div>
                        <div class="col-md-12 mb-3 form-floating">
                            <textarea type="text" class="form-control" placeholder="Masukan Alamat" id="floatingAlamat" name="alamat">{{ $data->alamat }}</textarea>
                            <label for="floatingAlamat" style="margin-left: 10px">Alamat</label>
                        </div>
                        <div class="col-md-12 mb-3 form-floating">
                            <select class="form-select" id="floatingSelect" aria-label="" name="role">
                                <option value="1" {{ $data->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="0" {{ $data->role == 'anggota' ? 'selected' : '' }}>Anggota</option>
                            </select>
                            <label for="floatingSelect" style="margin-left: 10px">ROLE</label>
                        </div>
                        <div class="col-md-12 mb-3 form-floating">
                            <input type="password" class="form-control" placeholder="Masukan Alamat" id="floatingPass" name="password" value="">
                            <label for="floatingPass" style="margin-left: 10px">Password</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="tombolEdit" id="ubahAnggota">Ubah</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                </div>
            </form>
        </div>
    </div>
</div>

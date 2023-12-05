<div class="modal fade" id="editProfile_{{ Auth::user()->nik }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Profile</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" id="formEditProfile">
                <div class="modal-body">
                    <div class="info-profil row">
                        <div class="col-md-12 mb-3 form-floating">
                            <input type="text" class="form-control" placeholder="Masukan nama lengkap" name="name" id="name" value="{{ Auth::user()->name }}">
                            <label for="nama" style="margin-left: 10px">Nama Lengkap</label>
                        </div>
                        <div class="col-md-12 mb-3 form-floating">
                            <input type="number" class="form-control" placeholder="Masukan NIK" id="nik" name="nik" value="{{ Auth::user()->nik }}" maxlength="16">
                            <label for="nik" style="margin-left: 10px">NIK (Nomor Induk Kependudukan)</label>
                        </div>
                        <div class="col-md-12 mb-3 form-floating">
                            <input type="number" class="form-control" placeholder="Masukan NO HP" name="no_hp" id="no_hp" value="{{ Auth::user()->no_hp }}">
                            <label for="floatingNoHP" style="margin-left: 10px">No HP</label>
                        </div>
                        <div class="col-md-12 mb-3 form-floating">
                            <input type="email" class="form-control" placeholder="Masukan Email" id="email" name="email" value="{{ Auth::user()->email }}">
                            <label for="email" style="margin-left: 10px">Email</label>
                        </div>
                        <div class="col-md-12 mb-3 form-floating">
                            <textarea type="text" class="form-control" placeholder="Masukan Alamat" name="alamat" id="alamat">{{ Auth::user()->alamat }}</textarea>
                            <label for="floatingAlamat" style="margin-left: 10px">Alamat</label>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="foto" style="margin-left: 10px">Foto</label>
                            <input type="file" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])" class="form-control" placeholder="Masukan" id="foto" name="foto">
                        </div>
                        <div class="col-md-12 mb-3 align-content-center">
                            <img src="" alt="" id="output" width="200px" >
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                </div>
            </form>
        </div>
    </div>
</div>

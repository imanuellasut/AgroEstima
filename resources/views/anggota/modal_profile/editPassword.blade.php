<div class="modal fade" id="editPasswrodAnggota_{{ Auth::user()->nik }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Ubah Password</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="" id="formPassword">
                <div class="modal-body">
                    <div class="info-profil row">
                        <input type="text" value="{{ Auth::user()->id }}" hidden>
                        <div class="col-md-12 mb-3 form-floating">
                            <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Masukan Password">
                            <label for="new_password" style="margin-left: 10px">Password Baru</label>
                        </div>
                        <div class="col-md-12 mb-3 form-floating">
                            <input type="password" class="form-control" placeholder="Masukan Password" id="confirm_new_password" name="new_password_confirmation">
                            <label for="confirm_new_password" style="margin-left: 10px">Password Baru (ulangi)</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="tombolEdit" id="clickPassAnggota">Perbaharui</button>
                    <button type="button" class="tombolBatal" data-bs-dismiss="modal">Kembali</button>
                </div>
            </form>
            <div class="form-control p-5 ml-2 mr-2">
                <p>Perhatikan</p>
                <li class="text-danger">Gunakan password yang unik dan sulit ditebak oleh Orang Lain,
                    tetapi cukup mudah Anda ingat</li>
                <li class="text-danger">Panjang Password 8 Karakter</li>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="tambahAnggota" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Anggota Baru</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('add-anggota') }}" method="POST" id="formAnggota">
                <div class="modal-body">
                    @csrf
                    <div class="info-profil row">
                        <div class="col-md-12 mb-3 form-floating">
                            <input type="text" class="form-control" placeholder="Masukan nama lengkap" id="floatingNama" name="name">
                            <label for="floatingNama" style="margin-left: 10px">Nama Lengkap</label>
                        </div>
                        <div class="col-md-12 mb-3 form-floating">
                            <input type="number" class="form-control" placeholder="Masukan NIK" id="floatingNIK" name="nik" maxlength="16">
                            <label for="floatingNIK" style="margin-left: 10px">NIK (Nomor Induk Kependudukan)</label>
                        </div>
                        <div class="col-md-12 mb-3 form-floating">
                            <input type="number" class="form-control" placeholder="Masukan NO HP" id="floatingNoHP" name="no_hp" maxlength="12">
                            <label for="floatingNoHP" style="margin-left: 10px">No HP</label>
                        </div>
                        <div class="col-md-12 mb-3 form-floating">
                            <input type="email" class="form-control" placeholder="Masukan Email" id="floatingEmail" name="email">
                            <label for="floatingEmail" style="margin-left: 10px">Email</label>
                        </div>
                        <div class="col-md-12 mb-3 form-floating">
                            <textarea type="text" class="form-control" placeholder="Masukan Alamat" id="floatingAlamat" name="alamat"></textarea>
                            <label for="floatingAlamat" style="margin-left: 10px">Alamat</label>
                        </div>
                        <div class="col-md-12 mb-3 form-floating">
                            <select class="form-select" id="floatingSelect" aria-label="" name="role">
                                <option selected>Pilih Role</option>
                                <option value="0">Anggota</option>
                                <option value="1">Admin</option>
                            </select>
                            <label for="floatingSelect" style="margin-left: 10px">ROLE</label>
                        </div>
                        <div class="col-md-12 mb-3 form-floating">
                            <input type="password" class="form-control" placeholder="Masukan Passowrd" id="floatingPass" name="password">
                            <label for="floatingPass" style="margin-left: 10px">Password</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="tombolTambah" id="addAnggota">Tambah</button>
                    <button type="button" class="tombolBatal" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>

</script>

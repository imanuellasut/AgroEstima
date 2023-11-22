<div class="modal fade" id="editKeputusan" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <form action="" method="post" id="editKeputusanForm">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Edit Anggota Keputusan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text"  id="up_id_keputusan" name="up_id_keputusan" hidden>
                    <div class="p-2">
                        <div class="errMsgContainerNama mb-2"></div>
                        <div class="col-md-12 mb-3 form-floating">
                            <input type="text" class="form-control" placeholder="Masukan Nama Keputusan" id="up_nama_keputusan" name="up_nama_keputusan">
                            <label for="up_nama_keputusan">Nama Anggota</label>
                        </div>
                        <div class="errMsgContainerKurva mb-2"></div>
                        <div class="col-md-12 mb-3">
                            <label class="mb-2">Jenis Kurva</label>
                            <select class="form-select" aria-label="Default select example" id="up_jenis_kurva_keputusan" name="up_jenis_kurva_keputusan">
                                <option selected disabled >-- Pilih Kurva --</option>
                                <option value="Linier Turun">Linier Turun</option>
                                <option value="Linier Naik">Linier Naik</option>
                            </select>
                        </div>
                        <div class="errMsgContainerBawah mb-2"></div>
                        <div class="col-md-12 mb-3 form-floating">
                            <input type="number"  class="form-control" placeholder="Masukan Nilai  Bawah" id="up_kep_nilai_bawah" name="up_kep_nilai_bawah">
                            <label for="up_kep_nilai_bawah" >Nilai Bawah</label>
                        </div>
                        <div class="errMsgContainerAtas mb-2"></div>
                        <div class="col-md-12 mb-3 form-floating">
                            <input type="number"  class="form-control" placeholder="Masukan Nilai Atas" id="up_kep_nilai_atas" name="up_kep_nilai_atas">
                            <label for="up_kep_nilai_atas" >Nilai Atas</label>
                        </div>
                        <div class="modal-footer">
                            <button class="tombolEdit " id="update_keputusan">
                                <iconify-icon icon="dashicons:update-alt" style="margin-right: 5px"></iconify-icon>
                                Perbarui
                            </button>
                            <button type="button" class="tombolBatal" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

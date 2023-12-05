<div class="modal fade" id="tambahKeputusan" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <form action="" method="post" id="tambahKeputusanForm">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Tambah Anggota Keputusan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="p-2">
                        <div class="errMsgContainerNama mb-2"></div>
                        <div class="col-md-12 mb-3 form-floating">
                            <input type="text" class="form-control" placeholder="Masukan Nama Keputusan" id="nama_keputusan" name="nama_keputusan">
                            <label for="nama_keputusan">Nama Anggota</label>
                        </div>
                        <div class="errMsgContainerKurva mb-2"></div>
                        <div class="col-md-12 mb-3">
                            <label class="mb-2">Jenis Kurva</label>
                            <select class="form-select" aria-label="Default select example" id="jenis_kurva_keputusan" name="jenis_kurva" onchange="changeImage(this.value)">
                                <option selected disabled >-- Pilih Kurva --</option>
                                <option value="Linier Turun">Linier Turun</option>
                                <option value="Linier Naik">Linier Naik</option>
                            </select>
                        </div>
                        <div class="errMsgContainerBawah mb-2"></div>
                        <div class="col-md-12 mb-3 form-floating">
                            <input type="number"  class="form-control" placeholder="Masukan Nilai  Bawah" id="kep_nilai_bawah" name="kep_nilai_bawah">
                            <label for="bawah" >Nilai Bawah</label>
                        </div>
                        <div class="errMsgContainerAtas mb-2"></div>
                        <div class="col-md-12 mb-3 form-floating">
                            <input type="number"  class="form-control" placeholder="Masukan Nilai Atas" id="kep_nilai_atas" name="kep_nilai_atas">
                            <label for="kep_nilai_atas" >Nilai Atas</label>
                        </div>
                        <div class="col-md-12 mb-3">
                            <img id="kurvaImage" src="" alt="" style="width: 100%">
                        </div>
                        <div class="modal-footer">
                            <button class="tombolTambah " id="tambah_keputusan">
                                <iconify-icon icon="material-symbols:save" style="margin-right: 5px"></iconify-icon>
                                Simpan
                            </button>
                            <button type="button" class="tombolBatal" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    function changeImage(value) {
        var imgSrc = "";
        if (value == "Linier Turun") {
            imgSrc = "{{ asset('img/derajat_keanggotaan/Linier Turun.png') }}";
        } else if (value == "Linier Naik") {
            imgSrc = "{{ asset('img/derajat_keanggotaan/Linier Naik.png') }}";
        }
        document.getElementById("kurvaImage").src = imgSrc;
    }
</script>

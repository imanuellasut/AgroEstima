<div class="modal fade" id="tambahAnggota{{ $data->id }}" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <form action="" method="post" id="tambahHimpunanForm" class="FormTambahHimpunan_{{ $data->id }}">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Tambah Anggota {{ $data->nama }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="p-2">
                        <div class="errMsgContainerNama mb-2">
                        </div>
                        <input type="text" value="{{ $data->id }}" id="id_variabel" name="id_variabel" hidden>
                        <div class="col-md-12 mb-3 form-floating">
                            <input type="text" class="form-control" placeholder="Masukan Nama" id="nama" name="nama" value="">
                            <label for="nama_{{ $data->id }}" >Nama Anggota</label>
                        </div>
                        <div class="errMsgContainerKurva mb-2">
                            <span class="text-danger"></span>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="mb-2">Jenis Kurva</label>
                            <select class="form-select" aria-label="Default select example" id="jenis_kurva" name="jenis_kurva">
                                <option selected disabled >-- Pilih Kurva --</option>
                                <option value="Linier Turun">Linier Turun</option>
                                <option value="Linier Naik">Linier Naik</option>
                            </select>
                        </div>
                        <div class="errMsgContainerBawah mb-2"></div>
                        <div class="col-md-12 mb-3 form-floating">
                            <input type="number" class="form-control" placeholder="Masukan Nilai Bawah" id="nilai_bawah" name="nilai_bawah">
                            <label for="nilai_bawah}" >Nilai Bawah</label>
                        </div>
                        <div class="errMsgContainerAtas mb-2"></div>
                        <div class="col-md-12 mb-3 form-floating">
                            <input type="number" class="form-control" placeholder="Masukan Nilai  Atas" id="nilai_atas" name="nilai_atas">
                            <label for="nilai_atas" >Nilai Atas</label>
                        </div>
                        <div class="modal-footer">
                            <button class="tombolTambah" id="tambahHimpunan" type="submit" data-id="{{ $data->id }}">
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

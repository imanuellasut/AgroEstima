<div class="modal fade" id="editAnggota{{ $himpunan->id }}" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <form action="" method="post" id="tambahHimpunanForm" class="FormEditHimpunan_{{ $himpunan->id }}">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Edit Anggota  himpunan {{ $data->nama }}?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="p-2">
                        <div class="errMsgContainerUpNama mb-2">
                        </div>
                        <input type="text" id="up_id" hidden>
                        <input type="text"  id="up_id_variabel" name="id_variabel" hidden>
                        <div class="col-md-12 mb-3 form-floating">
                            <input type="text" class="form-control" placeholder="Masukan Nama" id="up_nama_{{ $himpunan->id }}" name="up_nama" value="">
                            <label for="up_nama" >Nama Anggota</label>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="mb-2">Jenis Kurva</label>
                            <select class="form-select" aria-label="Default select example" id="up_jenis_kurva_{{ $himpunan->id }}" name="up_jenis_kurva">
                                <option selected disabled >-- Pilih Kurva --</option>
                                <option value="Linier Turun">Linier Turun</option>
                                <option value="Linier Naik">Linier Naik</option>
                            </select>
                        </div>
                        <div class="errMsgContainerUpBawah mb-2"></div>
                        <div class="col-md-12 mb-3 form-floating">
                            <input type="number" class="form-control" placeholder="Masukan Nilai Bawah" id="up_him_nilai_bawah_{{ $himpunan->id }}" name="up_him_nilai_bawah">
                            <label for="nilai_bawah" >Nilai Bawah</label>
                        </div>
                        <div class="errMsgContainerUpAtas mb-2"></div>
                        <div class="col-md-12 mb-3 form-floating">
                            <input type="number" class="form-control" placeholder="Masukan Nilai  Atas" id="up_him_nilai_atas_{{ $himpunan->id }}" name="up_him_nilai_atas">
                            <label for="up_him_nilai_atas" >Nilai Atas</label>
                        </div>
                        <div class="modal-footer">
                            <button class="tombolEdit" id="editHimpunan" type="submit" data-id="{{ $himpunan->id }}">
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

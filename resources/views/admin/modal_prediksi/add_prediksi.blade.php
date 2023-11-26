<div class="modal fade" id="tambahPrediksi" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <form action="" method="post" id="tambahPrediksiForm" class="formTambahPrediksi">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Tambah Prediksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="p-2">
                        <div class="errMsgContainerTglTanam mb-2"></div>
                        <input type="text" id="id_user" name="id_user" value="{{ Auth::user()->id }}" hidden>
                        <div class="col-md-12 mb-3 form-floating">
                            <input type="date" class="form-control" placeholder="Masukan Nama" id="tgl_tanam" name="tgl_tanam">
                            <label for="nama" >Tanggal Tanam</label>
                        </div>
                        @foreach ($variabels as $variabel)
                        <div class="errMsgContainerNilai{{ $variabel->id }} mb-2"></div>
                        <div class="col-md-12 mb-3 form-floating">
                            <input type="text" name="id_variabel_{{ $variabel->id }}" value="{{ $variabel->id }}" hidden>
                            <input type="text" class="form-control" placeholder="Masukan Nama" id="nilai_{{ $variabel->id }}" name="nilai_{{ $variabel->id }}">
                            <label for="nama" >{{ $variabel->nama }}</label>
                        </div>
                        @endforeach
                        <div class="modal-footer">
                            <button type="submit" class="tombolTambah " id="tambah_prediksi">
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

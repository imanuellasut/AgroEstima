<div class="modal fade" id="updatepertanian_{{ $pertanian->kode_pertanian }}" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <form action="" method="post" id="updatePertanianForm" class="formUpdatePertanian">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Edit Data Pertanian {{ $pertanian->kode_pertanian }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" id="kode_pertanian" name="kode_pertanian" value="{{ $pertanian->kode_pertanian }}" hidden>
                    <input type="text" id="id_user" name="id_user" value="{{ Auth::user()->id }}" hidden>
                    <div class="col-md-12 mb-3 form-floating">
                        <input type="date" class="form-control" placeholder="Masukan Nama" id="tgl_panen" name="tgl_panen" value="{{ $pertanian->tgl_panen }}">
                        <label for="nama" >Tanggal Panen</label>
                    </div>
                    <div class="col-md-12 mb-3 form-floating">
                        <input type="number" class="form-control" placeholder="Masukan Nama" id="jml_produksi" name="jml_produksi" value="{{ $pertanian->jml_produksi }}">
                        <label for="nama" >Hasil Panen (Kg)</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="tombolEdit " id="edit_prediksi">
                        <iconify-icon icon="dashicons:update-alt" style="margin-right: 5px"></iconify-icon>
                        Perbarui
                    </button>
                    <button type="button" class="tombolBatal" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </form>
</div>

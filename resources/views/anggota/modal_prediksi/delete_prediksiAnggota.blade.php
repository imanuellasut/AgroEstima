<div class="modal fade" id="deletePrediksiAnggota_{{ $item->kode_pertanian }}" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <form action="" method="post" id="deletePrediksiFormAnggota" class="formDeletePrediksiAnggota">
        @csrf
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Konfirmasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" id="kode_pertanian" name="kode_pertanian" value="{{ $item->kode_pertanian }}" hidden>
                    <div class="mb-2">
                        Apakah Anda yakin akan menghapus <br> Data Prediksi :  {{ $item->kode_pertanian }}</b> ?
                    </div>
                    <div class="modal-footer">
                        <button class="tombolHapus " id="delete_keputusan">
                            <iconify-icon icon="material-symbols:delete" style="margin-right: 5px"></iconify-icon>
                            Hapus
                        </button>
                        <button type="button" class="tombolBatal" data-bs-dismiss="modal">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

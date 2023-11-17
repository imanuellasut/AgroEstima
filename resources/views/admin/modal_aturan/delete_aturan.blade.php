<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <form action="" method="post" id="deleteAturanForm">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Hapus Aturan </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12 mb-3 form-floating">
                        <input type="text" class="form-control" placeholder="Masukan Nama" id="down_kode" name="down_kode" disabled>
                        <label for="down_kode" >Kode Aturan</label>
                    </div>
                    <div class="col-md-12 mb-3 form-floating">
                        <textarea name="down_aturan" id="down_aturan" cols="55" rows="4" disabled></textarea>
                    </div>
                    <div class="col-md-12 mb-3 form-floating">
                        <input type="text" class="form-control" placeholder="Masukan Nama" id="down_keputusan" name="down_keputusan" disabled>
                        <label for="down_keputusan" >Keputusan</label>
                    </div>
                    <div class="form-group modal-footer">
                        <button class="tombolHapus " id="delete_aturan">
                            <iconify-icon icon="material-symbols:delete" style="margin-right: 5px"></iconify-icon>
                            Hapus</button>
                        <button type="button" class="tombolBatal" data-bs-dismiss="modal">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

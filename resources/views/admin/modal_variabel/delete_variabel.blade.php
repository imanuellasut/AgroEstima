<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <form action="" method="post" id="deleteVariabelForm">
        @csrf
        <input type="hidden"  id="down_id">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Apakah Anda yakin akan menghapus variabel?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="p-2">
                        <div class="col-md-12 mb-3 form-floating">
                            <input type="text" class="form-control" placeholder="Masukan Nama" id="down_nama" name="up_nama" disabled>
                            <label for="nama">Nama Variabel</label>
                        </div>
                        <div class="col-md-12 mb-3 form-floating">
                            <input type="text" class="form-control" placeholder="Masukan Nama" id="down_satuan" name="up_satuan" disabled>
                            <label for="satuan" >Satuan</label>
                        </div>
                        <div class="form-group modal-footer">
                            <button class="tombolHapus " id="delete_variabel">
                                <iconify-icon icon="material-symbols:delete" style="margin-right: 5px"></iconify-icon>
                                Hapus</button>
                            <button type="button" class="tombolBatal" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

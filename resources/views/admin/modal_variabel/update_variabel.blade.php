<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <form action="" method="post" id="perbaruiVariabelForm">
        @csrf
        <input type="hidden"  id="up_id">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Edit Variabel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="p-2">
                        <div class="errMsgContainer mb-2">

                        </div>
                        <div class="col-md-12 mb-3 form-floating">
                            <input type="text" class="form-control" placeholder="Masukan Nama" id="up_nama" name="up_nama" >
                            <label for="nama" >Nama Variabel</label>
                        </div>
                        <div class="col-md-12 mb-3 form-floating">
                            <input type="text" class="form-control" placeholder="Masukan Nama" id="up_satuan" name="up_satuan">
                            <label for="satuan" >Satuan</label>
                        </div>
                        <div class="form-group modal-footer">
                            <button class="tombolTambah " id="edit_variabel">
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

<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <form action="" method="post" id="tambahVariabelForm">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Tambah Variabel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="p-2">
                        <div class="errMsgContainer mb-2">

                        </div>
                        <div class="col-md-12 mb-3 form-floating">
                            <input type="text" class="form-control" placeholder="Masukan Nama" id="nama" name="nama"></input>
                            <label for="nama" >Nama Variabel</label>
                        </div>
                        <div class="col-md-12 mb-3 form-floating">
                            <input type="text" class="form-control" placeholder="Masukan Nama" id="satuan" name="satuan"></input>
                            <label for="satuan" >Satuan</label>
                        </div>
                        <div class="modal-footer">
                            <button class="tombolTambah " id="tambah_variabel">
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

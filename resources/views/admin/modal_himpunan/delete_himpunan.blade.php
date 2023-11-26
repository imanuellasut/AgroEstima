<div class="modal fade" id="deleteAnggota{{ $himpunan->id }}" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <form action="" method="post" id="deleteHimpunanForm">
        @csrf
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" id="down_idvariabel" hidden>
                    <input type="text"  id="down_id" name="id" hidden>
                    <div class="mb-2">
                        Apakah anda yakin akan menghapus <br>
                        Anggota Himpunan {{ $data->nama }} :  <b>{{ $himpunan->nama }}</b> ?
                    </div>
                    <div class="modal-footer">
                        <button class="tombolHapus" id="delete_himpunan" type="submit"
                        data-id="{{ $data->id }}">
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

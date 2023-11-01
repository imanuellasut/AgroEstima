<div class="modal fade" id="hapusAnggota_{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Apakah  yakin ingin menghapus data ini?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p> <b>Nama :</b> {{  $data->name }}</p>
                <p> <b>NIK :</b> {{  $data->nik }}</p>
            </div>
            <div class="modal-footer">
                <a href="/admin/delete-user/{{ $data->id }}" class="tombolHapus"> Hapus </a>
                <button type="button" class="tombolBatal" data-bs-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

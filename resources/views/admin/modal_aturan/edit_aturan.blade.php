<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <form action="{{ route('perbarui_aturan') }}" method="post" >
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Aturan </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12 mb-3 form-floating">
                        <input type="text" class="form-control" placeholder="Masukan Nama" id="up_kode" name="up_kode" hidden>
                    </div>

                    <div>
                        <h4>Jika</h4>
                        <hr style="width: 100%; margin-left: 0px">
                    </div>
                    <div class="row g-3">
                        @foreach ($variabel as $v)
                        <div class="col-6">
                            <div class="mb-2 form-group">
                                <label for="up_himpunan">{{ $v->nama }}</label>
                                <select class="form-select form-control" id="up_himpunan" name="himpunan[{{ $v->id }}]">
                                    <option  disabled>-- Pilih --</option>
                                    @foreach ($v->himpunan as $h)
                                    <option value="{{ $h->id }}" id="option_{{ $h->id }}">{{ $h->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <hr style="width: 100%; margin-left: 0px">
                    <h4>MAKA</h4>
                    <hr style="width: 100%; margin-left: 0px">
                    <div class="col-lg-12 mb-2 form-group">
                        <label for="up_keputusan">Produksi</label>
                        <select class="form-select" name="id_keputusan" id="up_keputusan">
                            <option  disabled>-- Pilih --</option>
                        @foreach ($keputusan as $k)
                            <option value="{{ $k->id_keputusan }}" id="option_keputusan_{{ $k->id_keputusan }}">{{ $k->nama_keputusan }}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="p-2">
                        <div class="errMsgContainer mb-2">
                        </div>
                        <div class="form-group modal-footer">
                            <button class="tombolEdit" type="submit">
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

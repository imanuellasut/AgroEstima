<div class="modal fade" id="updatePrediksiAnggota_{{ $item->kode_pertanian }}" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <form action="" method="post" id="updatePrediksiAnggotaForm" class="formUpdatePrediksiAnggota">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Edit Prediksi {{ $item->kode_pertanian }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="p-2">
                        <input type="text" id="kode_pertanian" name="kode_pertanian" value="{{ $item->kode_pertanian }}" hidden>
                        <input type="text" id="id_user" name="id_user" value="{{ Auth::user()->id }}" hidden>
                        <div class="errMsgContainerTglTanam mb-2"></div>
                        <div class="col-md-12 mb-3 form-floating">
                            <input type="date" class="form-control" placeholder="Masukan Nama" id="tgl_tanam" name="tgl_tanam" value="{{ $item->tgl_tanam }}">
                            <label for="nama" >Tanggal Tanam</label>
                        </div>
                        @php
                            $id_variabel_array = explode(',', $item->id_variabel);
                            $nilai_inputan_array = explode(',', $item->nilai_inputan);
                        @endphp
                        @foreach ($variabels as $variabel)
                        @php
                            $index = array_search($variabel->id, $id_variabel_array);
                        @endphp
                        <div class="errMsgContainerNilai{{ $variabel->id }} mb-2"></div>
                        <div class="col-md-12 mb-3 form-floating">
                            <input type="text" name="id_variabel_{{ $variabel->id }}" value="{{ $variabel->id }}" hidden>
                            <input type="number" class="form-control" placeholder="Masukan Nama" id="nilai_{{ $variabel->id }}" name="nilai_{{ $variabel->id }}" value="{{ $index !== false ? $nilai_inputan_array[$index] : '' }}">
                            <label for="nama" >{{ $variabel->nama }}</label>
                        </div>
                        @endforeach
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

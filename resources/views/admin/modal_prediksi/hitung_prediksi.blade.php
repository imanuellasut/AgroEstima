<div class="modal fade" id="hitungPrediksi_{{ $item->kode_pertanian }}" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <form action="{{ route('hitung_prediksi') }}" method="post" id="hitungPrediksiForm" class="formHitungPrediksi">
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
                        Apakah Anda yakin akan melakukan perhitungan Prediksi Panen tanaman jagung ? <br>
                        Data Prediksi :  {{ $item->kode_pertanian }}</b>
                        <div>
                            <small>Tanggal Tanam : {{ $item->tgl_tanam }} </small>
                        </div>
                        @php
                            $id_variabel_array = explode(',', $item->id_variabel);
                            $nilai_inputan_array = explode(',', $item->nilai_inputan);
                        @endphp
                        @foreach ($variabels as $variabel)
                        @php
                            $index = array_search($variabel->id, $id_variabel_array);
                        @endphp
                        <div>
                            <small>Nilai {{ $variabel->nama }} : {{ $index !== false ? $nilai_inputan_array[$index] : '' }} </small>
                        </div>
                        @endforeach
                    </div>
                    <div class="modal-footer">
                        <button class="tombolLihat " id="delete_keputusan" type="submit">
                            <span class="iconify" data-icon="mdi:calculator-variant" data-width="20" style="color: white; margin-right: 2px"></span>
                            Hitung
                        </button>
                        <button type="button" class="tombolBatal" data-bs-dismiss="modal">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

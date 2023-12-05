<div class="modal" id="lihatPertanian_{{ $pertanian->kode_pertanian }}" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Data Pertanian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="mb-4 table table-bordered">
                    <thead>
                        <tr>
                            <td class="text-start">Kode Pertanian</td>
                            <td>:</td>
                            <th>{{ $pertanian->kode_pertanian }}</th>
                        </tr>
                        <tr>
                            <td class="text-start">Tangal Tanam</td>
                            <td>:</td>
                            <th>{{ $pertanian->tgl_tanam }}</th>
                        </tr>
                        <tr>
                            <td class="text-start">Tangal Panen</td>
                            <td>:</td>
                            <th>{{ $pertanian->tgl_panen }}</th>
                        </tr>
                        @php
                            $id_variabel_array = explode(',', $pertanian->id_variabel);
                            $nilai_inputan_array = explode(',', $pertanian->nilai);
                        @endphp
                        @foreach ( $dataVariabel as $v )
                        <tr>
                            <td class="text-start">{{ $v->nama }}</td>
                            <td>:</td>
                            @php
                                $index = array_search($v->id, $id_variabel_array);
                            @endphp
                            <th>{{ $index !== false ? $nilai_inputan_array[$index] : '' }}</th>
                        </tr>
                        @endforeach
                        <tr>
                            <td class="text-start">Hasil Panen</td>
                            <td>:</td>
                            <th>{{ $pertanian->jml_produksi }} Kg</th>
                        </tr>
                        <tr>
                            <td class="text-start">Hasil Prediksi</td>
                            <td>:</td>
                            <th>{{ $pertanian->jml_prediksi }} Kg</th>
                        </tr>
                    </thead>
                </table>
                <div class="modal-footer">
                    <button type="button" class="tombolBatal" data-bs-dismiss="modal">Kembali</button>
                </div>
            </div>
        </div>
    </div>
</div>

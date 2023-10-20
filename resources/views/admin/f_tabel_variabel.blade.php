<table class="table">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Kode</th>
            <th scope="col">Nama Variabel</th>
            <th scope="col">Satuan</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    @php
        $no = 1;
    @endphp
    @foreach ($dataVariabel as $data )
    <tbody>
        <tr>
            <td>{{$no++ }}</td>
            <td>{{ $data->kode }}</td>
            <td>{{ $data->nama }}</td>
            <td>{{ $data->satuan }}</td>
            <td>
                <a class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editAnggota">
                    <i class="ri-pencil-fill"></i>
                </a>
                <a class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusAnggota">
                    <i class="ri-delete-bin-6-fill"></i>
                </a>
        </tr>
    </tbody>
    @endforeach
</table>

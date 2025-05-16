<h2>Data Harian - {{ \Carbon\Carbon::parse($tanggal)->format('d M Y') }}</h2>

<table width="100%" border="1" cellspacing="0" cellpadding="5">
    <thead>
        <tr>
            <th>Surveyor</th>
            <th>Komoditas</th>
            <th>Penjual</th>
            <th>Alamat</th>
            <th>Harga</th>
            <th>Satuan</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
        <tr>
            <td>{{ $item->user->name }}</td>
            <td>{{ $item->komoditas->name }}</td>
            <td>{{ $item->responden->name }}</td>
            <td>{{ $item->responden->address }}</td>
            <td>{{ $item->data_input }}</td>
            <td>{{ $item->komoditas->satuan }}</td>
            <td>{{ $item->status ? 'Aktif' : 'Tidak Aktif' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
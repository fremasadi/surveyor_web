<!-- resources/views/pdf/data-harian.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Data Harian - {{ \Carbon\Carbon::parse($tanggal)->format('d M Y') }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 5px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Data Harian - {{ \Carbon\Carbon::parse($tanggal)->format('d M Y') }}</h2>

    <table>
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
</body>
</html>
<!-- resources/views/pdf/data-harian.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Data Harian - {{ \Carbon\Carbon::parse($tanggal)->format('d M Y') }}</title>
    <style>
        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #000;
            background-color: #fff;
            margin: 10px;
            padding: 10px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 16px;
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
            font-size: 10px;
        }
        th {
            background-color: #f2f2f2;
        }
        .debug-info {
            font-size: 10px;
            color: #666;
            margin-bottom: 15px;
        }
        .no-data {
            text-align: center;
            padding: 20px;
            font-style: italic;
        }
    </style>
</head>
<body>
    <h2>Data Harian - {{ \Carbon\Carbon::parse($tanggal)->format('d M Y') }}</h2>

    @if(isset($debug))
    <div class="debug-info">
        <p>Debug Info: Tanggal: {{ $debug['tanggal'] }}, Jumlah Data: {{ $debug['jumlah_data'] }}</p>
    </div>
    @endif

    @if(count($data) > 0)
    <table>
        <thead>
            <tr>
                <th>No</th>
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
            @foreach ($data as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->user->name ?? 'N/A' }}</td>
                <td>{{ $item->komoditas->name ?? 'N/A' }}</td>
                <td>{{ $item->responden->name ?? 'N/A' }}</td>
                <td>{{ $item->responden->address ?? 'N/A' }}</td>
                <td>{{ $item->data_input ?? 'N/A' }}</td>
                <td>{{ $item->komoditas->satuan ?? 'N/A' }}</td>
                <td>{{ $item->status ? 'Aktif' : 'Tidak Aktif' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="no-data">
        <p>Tidak ada data untuk tanggal {{ \Carbon\Carbon::parse($tanggal)->format('d M Y') }}</p>
    </div>
    @endif

    <div style="text-align: right; margin-top: 30px;">
        <p>Dicetak pada: {{ now()->format('d M Y H:i:s') }}</p>
    </div>
</body>
</html>
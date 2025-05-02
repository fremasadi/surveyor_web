<!DOCTYPE html>
<html>
<head>
    <title>Data Harian</title>
</head>
<body>
    <h1>Data Harian</h1>
    <p>Nama Surveyor: {{ $dataHarian->user->name }}</p>
    <p>Komoditas: {{ $dataHarian->komoditas->name }}</p>
    <p>Harga Input: {{ $dataHarian->data_input }}</p>
    <p>Tanggal: {{ $dataHarian->tanggal }}</p>
    <!-- Tambahkan detail lain sesuai kebutuhan -->
</body>
</html>

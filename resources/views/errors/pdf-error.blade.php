<!DOCTYPE html>
<html>
<head>
    <title>Error Generating PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .error-container {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
        }
        h1 {
            color: #721c24;
        }
        .details {
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            margin-top: 20px;
        }
        .back-btn {
            display: inline-block;
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <h1>Terjadi Kesalahan Saat Mencetak PDF</h1>
        <p>Maaf, terjadi kesalahan saat mencoba mencetak PDF. Mohon coba lagi nanti atau hubungi administrator sistem.</p>
    </div>

    <div class="details">
        <h3>Detail Kesalahan:</h3>
        <p><strong>Waktu:</strong> {{ now() }}</p>
        <p><strong>Tanggal yang dicoba dicetak:</strong> {{ $tanggal }}</p>
        @if(config('app.debug'))
        <p><strong>Pesan Error:</strong> {{ $message }}</p>
        @endif
    </div>

    <a href="{{ url()->previous() }}" class="back-btn">Kembali</a>
</body>
</html>
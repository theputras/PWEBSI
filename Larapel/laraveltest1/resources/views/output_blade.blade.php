<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Output Data (Blade)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Tugas 1: Hasil Input (Konsep Blade)</h1>
        <hr>
        
        <div class="card">
            <div class="card-header">
                Data yang Diterima
            </div>
            <div class="card-body">
                <p><strong>Tanggal:</strong> {{ $data['tgl'] }}</p>
                <p><strong>Nama:</strong> {{ $data['nama'] }}</p>
                <p><strong>Alamat:</strong> {{ $data['alamat'] }}</p>
                <p><strong>No. Telepon:</strong> {{ $data['telp'] }}</p>
            </div>
        </div>
        
        <a href="{{ route('blade.input') }}" class="btn btn-secondary mt-3">Kembali ke Form</a>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Output Data (jQuery)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Tugas 2: Hasil Input (Konsep jQuery)</h1>
        <hr>
        
        <div class="card">
            <div class="card-header">
                Data yang Diterima dari URL
            </div>
            <div class="card-body">
                <p><strong>Tanggal:</strong> {{ $data['tgl'] ?? 'Tidak ada data' }}</p>
                <p><strong>Nama:</strong> {{ $data['nama'] ?? 'Tidak ada data' }}</p>
                <p><strong>Alamat:</strong> {{ $data['alamat'] ?? 'Tidak ada data' }}</p>
                <p><strong>No. Telepon:</strong> {{ $data['telp'] ?? 'Tidak ada data' }}</p>
            </div>
        </div>
        
        <a href="{{ route('jquery.input') }}" class="btn btn-secondary mt-3">Kembali ke Form</a>
    </div>
</body>
</html>
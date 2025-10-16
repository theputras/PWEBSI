<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <h2 class="text-center fw-bold mb-4">Edit Data Barang</h2>

        @foreach($barang as $row)
        <form action="/barang/editt" method="post" class="card p-4 shadow-sm">
            @csrf
            <div class="mb-3">
                <label class="form-label">Kode Barang</label>
                <input type="text" name="kode" class="form-control" value="{{ $row->kodebr }}" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Barang</label>
                <input type="text" name="nama" class="form-control" value="{{ $row->nama }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Satuan</label>
                <input type="text" name="satuan" class="form-control" value="{{ $row->satuan }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Harga Beli</label>
                <input type="number" name="beli" class="form-control" value="{{ $row->hargabeli }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Harga Jual</label>
                <input type="number" name="jual" class="form-control" value="{{ $row->hargajual }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Diskon (%)</label>
                <input type="number" name="diskon" class="form-control" value="{{ $row->diskon }}" required>
            </div>

            <div class="d-flex justify-content-between">
                <a href="/barang" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-success">Update</button>
            </div>
        </form>
        @endforeach
    </div>
</body>
</html>

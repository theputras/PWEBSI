<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"> -->
</head>
<body class="bg-light">
    <div class="container py-5">
        <h2 class="text-center fw-bold mb-4">Tambah Barang Baru</h2>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/barang/simpan" method="post" class="card p-4 shadow-sm">
            @csrf
            <div class="mb-3">
                <label class="form-label">Kode Barang</label>
                <input type="text" name="kode" class="form-control" value="{{ old('kode') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Barang</label>
                <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Satuan</label>
                <input type="text" name="satuan" class="form-control" value="{{ old('satuan') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Harga Beli</label>
                <input type="number" name="beli" class="form-control" value="{{ old('beli') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Harga Jual</label>
                <input type="number" name="jual" class="form-control" value="{{ old('jual') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Diskon (%)</label>
                <input type="number" name="diskon" class="form-control" value="{{ old('diskon') }}" required>
            </div>

            <div class="d-flex justify-content-between">
                <a href="/barang" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</body>
</html>

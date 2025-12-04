<html>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<body>   
<div class="container">
    <h2>Tambah Produk Baru</h2>
    <form action="store" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama">Nama Produk:</label>
            <input type="text" name="nama" class="form-control" placeholder="Nama Produk">
        </div>

        <div class="form-group">
            <label for="satuan">Satuan:</label>
            <input type="text" name="satuan" class="form-control" placeholder="pcs, kg, liter">
        </div>

        <div class="form-group">
            <label for="harga">Harga:</label>
            <input type="number" step="0.01" name="harga" class="form-control" placeholder="Contoh: 10000.50">
        </div>

        <button type="submit" class="btn btn-success mt-3">Simpan</button>
        <a href="index" class="btn btn-secondary mt-3">Batal</a>
    </form>
</div>
</body>
</html>
<html>
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </head>
<body>   
<div class="container mt-5">
    <h2>Edit Produk</h2>
    
    <form action="{{ url('update/' . $products->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="nama">Nama Produk:</label>
            <input type="text" name="nama" class="form-control" value="{{ $products->nama }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="satuan">Satuan:</label>
            <input type="text" name="satuan" class="form-control" value="{{ $products->satuan }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="harga">Harga:</label>
            <input type="number" step="0.01" name="harga" class="form-control" value="{{ $products->harga }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ url('index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>
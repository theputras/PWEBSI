
<html>
  <head>
  <title>orm</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>  
<div class="container">
    <h2>Daftar Produk</h2>    
    <a href="create" class="btn btn-success mb-3">Tambah Produk Baru</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Satuan</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $p)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $p->nama }}</td>
                <td>{{ $p->satuan }}</td>
                <td>{{ number_format($p->harga, 2) }}</td>
                <td>
                    <form action="destroy/{{$p->id}}" method="POST">
                        <a href="edit/{{$p->id}}" class="btn btn-primary btn-sm">Edit</a>
                        
                        @csrf
                        @method('DELETE')
                        
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    
</div>
</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <h2 class="mb-4 text-center fw-bold">Daftar Barang</h2>

        <div class="d-flex justify-content-between mb-3">
            <div>
                <input type="text" id="cari" class="form-control d-inline w-auto" placeholder="Cari kode barang">
                <button class="btn btn-secondary" onclick="MyCari()">Cari</button>
            </div>
            <a href="/barang/tambah" class="btn btn-primary">+ Tambah Barang</a>
        </div>

        <table class="table table-bordered table-striped text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Satuan</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Diskon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($barang as $row)
                <tr>
                    <td>{{ $row->kodebr }}</td>
                    <td>{{ $row->nama }}</td>
                    <td>{{ $row->satuan }}</td>
                    <td>Rp {{ number_format($row->hargabeli, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($row->hargajual, 0, ',', '.') }}</td>
                    <td>{{ $row->diskon }}%</td>
                    <td>
                        <a href="/barang/edit/{{ $row->kodebr }}" class="btn btn-sm btn-warning">Edit</a>
                        <a href="/barang/hapus/{{ $row->kodebr }}" class="btn btn-sm btn-danger"
                           onclick="return confirm('Yakin hapus {{ $row->nama }}?')">Hapus</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-muted">Belum ada data barang</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <script>
        function MyCari() {
            const x = document.getElementById("cari").value;
            if (x.trim() !== "") {
                window.location.href = `/barang/cari/${x}`;
            }
        }
    </script>
</body>
</html>

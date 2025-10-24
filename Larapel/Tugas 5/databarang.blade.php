<html>
<head>
    <title>Data Barang</title>
    <script type="text/javascript">
        function MyCari() {
            var x = document.getElementById("cari").value;
            window.location.href = "/barang/cari/" + x;
        }
    </script>
</head>
<body>
    <input type="text" id="cari" name="cari">
    <button onclick="MyCari()">Cari</button>
    <br><br>

    <a href="/barang/tambah"><button>Tambah</button></a>
    <br><br>

    <table border="1">
        <tr>
            <th>Kode</th>
            <th>Nama</th>
            <th>Satuan</th>
            <th>Harga Beli</th>
            <th>Harga Jual</th>
            <th>Diskon</th>
            <th>Aksi</th>
        </tr>

        @foreach($barang as $row)
        <tr>
            <td>{{ $row->kodebr }}</td>
            <td>{{ $row->nama }}</td>
            <td>{{ $row->satuan }}</td>
            <td>{{ $row->hargabeli }}</td>
            <td>{{ $row->hargajual }}</td>
            <td>{{ $row->diskon }}</td>
            <td>
                <a href="/barang/edit/{{ $row->kodebr }}"><button>Edit</button></a>
                <a href="/barang/hapus/{{ $row->kodebr }}"><button>Hapus</button></a>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>

<html>
<body>
<h2>Data Barang</h2>
<table border="1" cellpadding="5">
    <tr><th>ID</th><th>Nama</th><th>Harga</th></tr>
    @foreach($barang as $b)
        <tr>
            <td>{{ $b['id'] }}</td>
            <td>{{ $b['nama'] }}</td>
            <td>Rp {{ number_format($b['harga'],0,",",".") }}</td>
        </tr>
    @endforeach
</table>
</body>
</html>

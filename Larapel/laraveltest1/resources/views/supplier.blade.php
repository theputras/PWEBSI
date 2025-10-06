<html>
<body>
<h2>Data Supplier</h2>
<table border="1" cellpadding="5">
    <tr><th>ID</th><th>Nama</th><th>Kota</th></tr>
    @foreach($supplier as $s)
        <tr>
            <td>{{ $s['id'] }}</td>
            <td>{{ $s['nama'] }}</td>
            <td>{{ $s['kota'] }}</td>
        </tr>
    @endforeach
</table>
</body>
</html>

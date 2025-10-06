<html>
<body>
<h2>Data Karyawan</h2>
<table border="1" cellpadding="5">
    <tr><th>ID</th><th>Nama</th><th>Jabatan</th></tr>
    @foreach($karyawan as $k)
        <tr>
            <td>{{ $k['id'] }}</td>
            <td>{{ $k['nama'] }}</td>
            <td>{{ $k['jabatan'] }}</td>
        </tr>
    @endforeach
</table>
</body>
</html>

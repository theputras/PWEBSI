<html>
<head>
    <title>Edit Barang</title>
</head>
<body>
@foreach($barang as $row)
<form action="/barang/editt" method="post">
    {{ csrf_field() }}
    Kode Barang : <input type="text" name="kode" value="{{ $row->kodebr }}" readonly><br>
    Nama Barang : <input type="text" name="nama" value="{{ $row->nama }}"><br>
    Satuan : <input type="text" name="satuan" value="{{ $row->satuan }}"><br>
    Harga Beli : <input type="text" name="beli" value="{{ $row->hargabeli }}"><br>
    Harga Jual : <input type="text" name="jual" value="{{ $row->hargajual }}"><br>
    Diskon : <input type="text" name="diskon" value="{{ $row->diskon }}"><br><br>
    <input type="submit" value="Update">
</form>
@endforeach

<br>
<a href="/barang"><button>Kembali</button></a>
</body>
</html>

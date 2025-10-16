<html>
<head>
    <title>Tambah Barang</title>
</head>
<body>
@if(count($errors) > 0)
    <div style="color:red">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="/barang/simpan" method="post">
    {{ csrf_field() }}
    Kode Barang : <input type="text" name="kode" value="{{ old('kode') }}"><br>
    Nama Barang : <input type="text" name="nama" value="{{ old('nama') }}"><br>
    Satuan : <input type="text" name="satuan" value="{{ old('satuan') }}"><br>
    Harga Beli : <input type="text" name="beli" value="{{ old('beli') }}"><br>
    Harga Jual : <input type="text" name="jual" value="{{ old('jual') }}"><br>
    Diskon : <input type="text" name="diskon" value="{{ old('diskon') }}"><br><br>
    <input type="submit" value="Simpan">
</form>

<br>
<a href="/barang"><button>Kembali</button></a>
</body>
</html>

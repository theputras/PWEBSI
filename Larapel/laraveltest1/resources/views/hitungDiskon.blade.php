<form action="/hitungdiskon" method="POST">
    @csrf
    <input type="text" name="harga" placeholder="Masukkan Harga">
    <input type="text" name="persenDiskon" placeholder="Masukkan Diskon (%)">
    <button type="submit">Hitung Diskon</button>
</form>

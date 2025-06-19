<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Test Form</title>
</head>
<body>
    <fieldset>
        <legend>Data</legend>
        <form action="latihan05.php" method="post">
            <label for="name">Nama</label>
            <input type="text" name="nama" placeholder="Masukkan nama">
            <br><br>

            <label for="alamat">Alamat</label>
            <textarea name="alamat" placeholder="Masukkan Alamat"></textarea>
            <br><br>
s
            <label for="jurusan">Pilih sesuatu:</label>
            <select id="jurusan" name="jurusan">
                <option value="S1 Sistem">S1 Sistem</option>
                <option value="S2 Perikanan">S2 Perikanan</option>
                <option value="TK">TK</option>
            </select>
            <br><br>

            <label>Jenis Kelamin</label><br>
            <input type="radio" id="Laki-Laki" name="gender" value="Laki-Laki">
            <label for="Laki-Laki">L</label><br>

            <input type="radio" id="Perempuan" name="gender" value="Perempuan">
            <label for="Perempuan">P</label>
            <br><br>

            <label>Pendidikan</label><br>
            <input type="checkbox" id="sd" name="pendidikan[]" value="SD">
            <label for="sd">SD</label><br>

            <input type="checkbox" id="smp" name="pendidikan[]" value="SMP">
            <label for="smp">SMP</label><br>

            <input type="checkbox" id="sma" name="pendidikan[]" value="SMA">
            <label for="sma">SMA</label>
            <br><br>

            <button type="submit" name="kirim" value="kirim">Submit</button>
        </form>
    </fieldset>
</body>
</html>
    
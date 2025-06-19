<?php
include 'koneksi.php';

$kode = $_GET['kode'];
$query = "SELECT * FROM karyawan WHERE kode = '$kode'";
$result = mysqli_query($connection, $query);
$data = mysqli_fetch_assoc($result);
?>


<a href="index.php">← Kembali</a>
<br>
<h3>Form Ubah Data</h3>
<form method="POST" action="index.php">
    <input type="hidden" name="kode" value="<?= $data['kode']; ?>">

    <label>Nama:</label><br>
    <input type="text" name="nama" value="<?= $data['nama']; ?>"><br><br>

    <label>Jabatan:</label><br>
    <input type="text" name="jabatan" value="<?= htmlspecialchars($data['jabatan']); ?>"><br><br>

    <label>Alamat:</label><br>
    <textarea name="alamat"><?= $data['alamat']; ?></textarea><br><br>

    <label>Telpon:</label><br>
    <input type="text" name="telpon" value="<?= $data['telpon']; ?>"><br><br>

    <label>Pendidikan:</label><br>
    <input type="text" name="pendidikan" value="<?= $data['pendidikan']; ?>"><br><br> 
    
    <label>Password:</label><br>
    <input type="text" name="password" value="<?= $data['password']; ?>"><br><br>

    <label>Jenis Kelamin:</label><br>
    <select name="jeniskelamin">
        <option value="L" <?= $data['jeniskelamin'] == 'L' ? 'selected' : ''; ?>>Laki-laki</option>
        <option value="P" <?= $data['jeniskelamin'] == 'P' ? 'selected' : ''; ?>>Perempuan</option>
    </select><br><br>

    <label>Tanggal Lahir:</label><br>
    <input type="date" name="tgllahir" value="<?= $data['tgllahir']; ?>"><br><br>

    <button type="submit" value="ubah" name="ubah">Ubah</button>
    <button type="submit" name="hapus" value="hapus">Hapus</button>

</form>


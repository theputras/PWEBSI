<?php
include 'koneksi.php';


?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Karyawan</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #888;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .add-btn {
            padding: 4px 10px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<h2>Tambah Karyawan</h2>
<form method="POST" action="index.php">
    <label>Kode:</label><br>
    <input type="text" name="kode" required><br><br>

    <label>Nama:</label><br>
    <input type="text" name="nama" required><br><br>

    <label>Jabatan:</label><br>
    <input type="text" name="jabatan" required><br><br>

    <label>Alamat:</label><br>
    <textarea name="alamat" required></textarea><br><br>

    <label>Telpon:</label><br>
    <input type="text" name="telpon" required><br><br>

    <label>Pendidikan:</label><br>
    <input type="text" name="pendidikan" required><br><br>    
    
    <label>Password:</label><br>
    <input type="text" name="password" required><br><br>

    <label>Jenis Kelamin:</label><br>
    <select name="jeniskelamin" required>
        <option value="">-- Pilih --</option>
        <option value="L">Laki-laki</option>
        <option value="P">Perempuan</option>
    </select><br><br>

    <label>Tanggal Lahir:</label><br>
    <input type="date" name="tgllahir" value="<?= date('Y-m-d'); ?>" required><br><br>


    <button class="add-btn" type="submit" name="tambah">Tambah</button>
</form>

<hr>



</body>
</html>
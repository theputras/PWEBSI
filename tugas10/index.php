<?php
include 'koneksi.php';

$query = "SELECT * FROM karyawan";
$result = mysqli_query($connection, $query);


if (isset($_POST['ubah'])) {
    $kode         = $_POST['kode']; // isinya dari tombol <button name="ubah" value="K001">
    $nama         = $_POST['nama'];
    $jabatan      = $_POST['jabatan'];
    $alamat       = $_POST['alamat'];
    $telpon       = $_POST['telpon'];
    $pendidikan   = $_POST['pendidikan'];
    $jeniskelamin = $_POST['jeniskelamin'];
    $password = $_POST['password'];
    $tgllahir     = $_POST['tgllahir'];

    $query = "UPDATE karyawan SET 
        nama = '$nama',
        jabatan = '$jabatan',
        alamat = '$alamat',
        telpon = '$telpon',
        pendidikan = '$pendidikan',
        jeniskelamin = '$jeniskelamin',
        password = '$password',
        tgllahir = '$tgllahir'
        WHERE kode = '$kode'";
    if (mysqli_query($connection, $query)) {
        header("Location: index.php");
        exit();
        header("");
    } else {
        header("Location: index.php");
        exit();
    }
    $status = mysqli_query($connection, $query) ? 'berhasil' : 'gagal';
}

if (isset($_POST['hapus'])) {
    $kode         = $_POST['kode']; // isinya dari tombol <button name="ubah" value="K001">
    $nama         = $_POST['nama'];
    $jabatan      = $_POST['jabatan'];
    $alamat       = $_POST['alamat'];
    $telpon       = $_POST['telpon'];
    $pendidikan   = $_POST['pendidikan'];
    $jeniskelamin = $_POST['jeniskelamin'];
    $password = $_POST['password'];
    $tgllahir     = $_POST['tgllahir'];

    $query = "DELETE FROM karyawan WHERE kode = '$kode'";
    if (mysqli_query($connection, $query)) {
        header("Location: index.php");
        exit();
    } else {
        header("Location: index.php");
        exit();
    }
    $status = mysqli_query($connection, $query) ? 'dihapus' : 'hapusgagal';
}


if (isset($_POST['tambah'])) {
    $kode         = $_POST['kode'];
    $nama         = $_POST['nama'];
    $jabatan      = $_POST['jabatan'];
    $alamat       = $_POST['alamat'];
    $telpon       = $_POST['telpon'];
    $pendidikan   = $_POST['pendidikan'];
    $jeniskelamin = $_POST['jeniskelamin'];
    $tgllahir     = $_POST['tgllahir'];
    $password     = $_POST['password'];

    $query = "INSERT INTO karyawan (kode, nama, jabatan, alamat, telpon, pendidikan, jeniskelamin, tgllahir, password)
              VALUES ('$kode', '$nama', '$jabatan', '$alamat', '$telpon', '$pendidikan', '$jeniskelamin', '$tgllahir',  '$password')";

    if (mysqli_query($connection, $query)) {
        header("Location: index.php?status=tambah");
        exit();
    } else {
        header("Location: index.php?status=gagaltambah");
        exit();
    }
}


?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Karyawan</title>
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
        .view-btn {
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

<button onclick="window.location.href = 'tambah.php';">Tambah</button>

<hr>


    <h2>Data Karyawan</h2>
    <table>
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Alamat</th>
                <th>Telpon</th>
                <th>Pendidikan</th>
                <th>Jenis Kelamin</th>
                <th>Password</th>
                <th>Tanggal Lahir</th>
                <th>View</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $row['kode']; ?></td>
                <td><?= $row['nama']; ?></td>
                <td><?= $row['jabatan']; ?></td>
                <td><?= $row['alamat']; ?></td>
                <td><?= $row['telpon']; ?></td>
                <td><?= $row['pendidikan']; ?></td>
                <td><?= $row['jeniskelamin']; ?></td>
                <td><?= $row['password']; ?></td>
                <td><?= $row['tgllahir']; ?></td>
                <td><a href="view.php?kode=<?= $row['kode']; ?>" class="view-btn">View</a></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
<?php if (isset($_GET['status'])): ?>
    <div style="padding:10px; background:#eee;">
        <?php
        if ($_GET['status'] == 'berhasil') echo "✅ Data berhasil diubah!";
        elseif ($_GET['status'] == 'gagal') echo "❌ Gagal mengubah data!";
        elseif ($_GET['status'] == 'hapus') echo "🗑️ Data berhasil dihapus!";
        elseif ($_GET['status'] == 'hapusgagal') echo "⚠️ Gagal menghapus data!";
        elseif ($_GET['status'] == 'tambah') echo '✅ Karyawan berhasil ditambahkan!';
        elseif ($_GET['status'] == 'gagaltambah') echo '❌ Gagal menambahkan data.';
        ?>
    </div>
<?php endif; ?>


</body>
</html>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "<h2>Hasil Input Form:</h2>";

    echo "Nama: " . htmlspecialchars($_POST['nama']) . "<br>";
    echo "Alamat: " . htmlspecialchars($_POST['alamat']) . "<br>";
    echo "Jurusan: " . htmlspecialchars($_POST['jurusan']) . "<br>";
    echo "Jenis Kelamin: " . (isset($_POST['gender']) ? htmlspecialchars($_POST['gender']) : 'Belum dipilih') . "<br>";

    echo "Pendidikan: <ul>";
    if (!empty($_POST['pendidikan'])) {
        foreach ($_POST['pendidikan'] as $item) {
            echo "<li>" . htmlspecialchars($item) . "</li>";
        }
    } else {
        echo "<li>Tidak ada</li>";
    }
    echo "</ul>";
} else {
    echo "Akses langsung tidak diperbolehkan. Silakan isi form melalui <a href='tugas02.php'>tugas02.php</a>.";
}
?>

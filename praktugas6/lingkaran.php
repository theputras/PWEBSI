<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $r = $_POST['jari'];
  $luas = 3.14159 * $r * $r;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Hasil Luas Lingkaran</title>
</head>
<body>
  <h2>Hasil Perhitungan Luas Lingkaran</h2>
  <p>Jari-jari: <?= htmlspecialchars($r) ?> satuan</p>
  <p>Luas: <?= number_format($luas, 2) ?> satuan²</p>
  <a href="index.php">🔙 Kembali</a>
</body>
</html>

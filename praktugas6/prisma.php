<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $luas_alas = $_POST['luas_alas'];
  $tinggi = $_POST['tinggi'];
  $volume = $luas_alas * $tinggi;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Hasil Volume Prisma</title>
</head>
<body>
  <h2>Hasil Perhitungan Volume Prisma</h2>
  <p>Luas Alas: <?= htmlspecialchars($luas_alas) ?> satuan²</p>
  <p>Tinggi: <?= htmlspecialchars($tinggi) ?> satuan</p>
  <p>Volume: <?= number_format($volume, 2) ?> satuan³</p>
  <a href="index.php">🔙 Kembali</a>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Hitung Lingkaran & Prisma</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 50px;
      background: #f2f2f2;
    }
    .form-box {
      background: white;
      padding: 20px;
      margin-bottom: 30px;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      max-width: 400px;
    }
    input, button {
      padding: 10px;
      margin-top: 10px;
      width: 100%;
      font-size: 16px;
    }
  </style>
</head>
<body>
  <h2>🔥 Aplikasi Penghitung 🔥</h2>

  <div class="form-box">
    <h3>Hitung Luas Lingkaran</h3>
    <form action="lingkaran.php" method="POST">
      <label for="jari">Masukkan Jari-jari (r):</label>
      <input type="number" name="jari" id="jari" step="any" required>
      <button type="submit">Hitung Luas</button>
    </form>
  </div>

  <div class="form-box">
    <h3>Hitung Volume Prisma</h3>
    <form action="prisma.php" method="POST">
      <label for="luas_alas">Luas Alas:</label>
      <input type="number" name="luas_alas" id="luas_alas" step="any" required>

      <label for="tinggi">Tinggi Prisma:</label>
      <input type="number" name="tinggi" id="tinggi" step="any" required>

      <button type="submit">Hitung Volume</button>
    </form>
  </div>
</body>
</html>

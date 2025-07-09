<!DOCTYPE html>
<html lang="en">
<head>
  <title>Manajemen Penjualan</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-sm navbar-dark bg-danger">
  <div class="container-fluid">
    <a class="navbar-brand text-white fw-bold" href="#">UAS PHP</a>
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link text-white" href="#" data-page="./penjualan.php">Penjualan</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="#" data-page="./supplier.php">Supplier</a>
      </li>   
      <li class="nav-item">
        <a class="nav-link text-white" href="#" data-page="./pembelian.php">Pembelian</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="#" data-page="./item.php">Item</a>
      </li>
    </ul>
  </div>
</nav>

<div class="container mt-4">
  <div id="isi" class="p-4 border rounded bg-light shadow-sm">
    <!-- Konten akan dimuat di sini -->
  </div>
</div>

<script>
$(document).ready(function() {
  // Load halaman default (Penjualan)
  $("#isi").load("./penjualan.php");

  // Navigasi menu klik
  $(".nav-link").click(function(e) {
    e.preventDefault();
    const target = $(this).data("page");
    $("#isi").load(target);
  });
});


</script>

</body>
</html>

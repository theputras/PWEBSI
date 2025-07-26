<!DOCTYPE html>
<html lang="en">
<head>
  <title>Manajemen Penjualan</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

  <style>
  .nav-link.active {
    background-color: white !important;
    color: #dc3545 !important; /* merah kayak .bg-danger */
    font-weight: bold;
    border-radius: 0.375rem;
  }
</style>
</head>
<body>
<?php
// Sertakan file koneksi.php untuk mendapatkan status koneksi
include 'koneksi.php';

// Tentukan kelas alert berdasarkan status koneksi
$alert_class = $db_connected ? 'alert-success' : 'alert-danger';
$icon = $db_connected ? '✅' : '❌';
?>

<nav class="navbar navbar-expand-sm navbar-dark bg-danger">
  <div class="container-fluid">
    <a class="navbar-brand text-white fw-bold" href="#">UAS PHP</a>
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link text-white active" href="#" data-page="./penjualan.php">Penjualan</a>
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

<div class="container mt-3">
  <div class="alert <?= $alert_class ?> text-center" role="alert">
     Status Koneksi Database <?=  $icon ?>: <?= $db_message ?> 
  </div>

  <div id="isi" class="p-4 border rounded bg-light shadow-sm">
    </div>
</div>

<script>
// Deklarasi daftarItem di sini agar hanya sekali
let daftarItem = []; 
let daftarPembelianItem = []; // Array untuk menampung item yang akan dibeli dalam satu transaksi
let allItemsData = []; 
let allItemsDataPembelian = []; // Variabel untuk menyimpan semua data item yang dimuat
$(document).ready(function() {
  // Load halaman default (Penjualan)
  $("#isi").load("./penjualan.php");

  // Navigasi menu klik
$(".nav-link").click(function(e) {
  e.preventDefault();
  const target = $(this).data("page");

  // Tambahkan class active ke yang diklik, hapus dari yang lain
  $(".nav-link").removeClass("active");
  $(this).addClass("active");

  // Load kontennya
  $("#isi").load(target);
});

});


</script>

</body>
</html>
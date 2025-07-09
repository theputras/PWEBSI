<?php
include "controller.php";

// Tampilkan tabel
// $data = getAllItems();

// Jika ada permintaan POST dari jQuery, langsung jalankan insertItem
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    insertItem(); // ⬅️ Pakai fungsi yang udah kita bikin
    exit; // Hentikan agar tidak render HTML form-nya lagi
}

if (isset($_GET['action']) && $_GET['action'] === 'getAllItems') {
    getAllItems();
    exit;
}
?>
<div class="container">
  <h4 class="mb-3">Input Item Baru</h4>
  <form id="formItem" class="row g-3">
    <div class="col-md-3">
      <input type="text" name="kode" class="form-control" placeholder="Kode Item" required>
    </div>
    <div class="col-md-3">
      <input type="text" name="nama" class="form-control" placeholder="Nama Item" required>
    </div>
    <div class="col-md-2">
      <input type="text" name="satuan" class="form-control" placeholder="Satuan" required>
    </div>
    <div class="col-md-2">
      <input type="number" name="harga" class="form-control" placeholder="Harga" required>
    </div>
    <div class="col-md-2">
      <button type="submit" class="btn btn-primary w-100">Simpan</button>
    </div>
  </form>

  <hr class="my-4">

  <h5>Daftar Item</h5>
  <table class="table table-bordered table-striped mt-3">
    <thead class="table-dark">
      <tr>
        <th>Kode</th>
        <th>Nama</th>
        <th>Satuan</th>
        <th>Harga</th>
      </tr>
    </thead>
    <tbody id="daftarItem">
      
    </tbody>
  </table>
</div>
<!-- Toast Container -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999">
  <div id="liveToast" class="toast align-items-center text-white bg-danger border-0" role="alert">
    <div class="d-flex">
      <div class="toast-body" id="toastBody">
        <!-- isi notif -->
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
    </div>
  </div>
</div>

<script>
$(document).ready(function () {

function reloadItems() {
  $.get("./controller.php?action=getAllItems", function (responseRaw) {
    const response = typeof responseRaw === "string" ? JSON.parse(responseRaw) : responseRaw;

    if (response.status === "success") {
      let html = "";
      response.data.forEach(item => {
        html += `
          <tr>
            <td>${item.kode}</td>
            <td>${item.nama}</td>
            <td>${item.satuan}</td>
            <td>Rp ${parseFloat(item.harga).toLocaleString()}</td>
          </tr>
        `;
      });
      $("#daftarItem").html(html);
    }
  });
  
}


  $('#formItem').on('submit', function(e) {
    e.preventDefault();
    $.post("./controller.php", $(this).serialize(), function(response) {
      const res = JSON.parse(response);

      // ✅ Tampilkan toast
      $('#toastBody').text(res.message);
      const toast = new bootstrap.Toast($('#liveToast')[0]);
      toast.show();

      if (res.status === "success") {
        reloadItems();              // ✅ Muat ulang data
        $('#formItem')[0].reset();  // ✅ Reset form
      }
    });
  });

  // Load awal saat page dibuka
  reloadItems();
});


</script>


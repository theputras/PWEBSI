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
        <th>Aksi</th>
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
                  <td>
             <button class="btn btn-warning btn-sm edit-btn"
        data-kode="${item.kode}"
        data-nama="${item.nama}"
        data-satuan="${item.satuan}"
        data-harga="${item.harga}">
  <i class="bi bi-pencil-square"></i>
</button>

              <button class="btn btn-sm btn-danger delete-btn" data-kode="${item.kode}">
                <i class="bi bi-trash"></i>
              </button>
            </td>
          </tr>
        `;
      });
      $("#daftarItem").html(html);
    }
  });
  
}

$(document).on("click", ".delete-btn", function () {
  const kode = $(this).data("kode");
  if (confirm("Yakin ingin menghapus item dengan kode: " + kode + "?")) {
    $.post("./controller.php", { action: "deleteItem", kode }, function (res) {
      const response = typeof res === "string" ? JSON.parse(res) : res;
      $('#toastBody').text(response.message);
      const toast = new bootstrap.Toast($('#liveToast')[0]);
      toast.show();
      if (response.status === "success") {
        reloadItems();
      }
    });
  }
});

let isEdit = false;

$(document).on('click', '.edit-btn', function () {
    isEdit = true;
$('input[name="kode"]').prop('readonly', true);
  const kode = $(this).data('kode');
  const nama = $(this).data('nama');
  const satuan = $(this).data('satuan');
  const harga = $(this).data('harga');

  // Isi form dengan data yang diklik
  $('input[name="kode"]').val(kode);
  $('input[name="nama"]').val(nama);
  $('input[name="satuan"]').val(satuan);
  $('input[name="harga"]').val(harga);
  $('#kodeLama').val(kode); // simpan kode lama

  // Ganti tombol
  $('#formItem button[type="submit"]').text('Update').removeClass('btn-primary').addClass('btn-warning');
});


$('#formItem').on('submit', function(e) {
  e.preventDefault();
  let actionType = isEdit ? 'updateItem' : 'insertItem';
    console.log(actionType);
  const formData = $(this).serialize() + `&action=${actionType}`;
  

  $.post("./controller.php", formData, function(response) {
    const res = JSON.parse(response);
    $('#toastBody').text(res.message);
    const toast = new bootstrap.Toast($('#liveToast')[0]);
    toast.show();

    if (res.status === "success") {
      reloadItems();
      $('#formItem')[0].reset();
      $('input[name="kode"]').prop('readonly', false);
      $('#formItem button[type="submit"]').text('Simpan').removeClass('btn-warning').addClass('btn-primary');
      isEdit = false;
    }
  });
});

  // Load awal saat page dibuka
  reloadItems();
});


</script>


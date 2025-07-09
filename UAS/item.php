<?php
include "controller.php";
?>

<div class="container">
  <h4 class="mb-3">Input Item Baru</h4>
  <form id="formItem" class="row g-3">
    <div class="col-md-3">
      <input type="text" name="kode_item" class="form-control" placeholder="Kode Item">
    </div>
    <div class="col-md-3">
      <input type="text" name="nama" class="form-control" placeholder="Nama Item" required>
    </div>
    <div class="col-md-2">
      <input type="text" name="satuan" class="form-control" placeholder="Satuan" required>
    </div>    
    <div class="col-md-2">
      <input type="number" name="jumlah_item" class="form-control" placeholder="Jumlah" required>
    </div>
    <div class="col-md-2">
      <input type="number" name="harga" class="form-control" placeholder="Harga" required>
    </div>
    <div class="col-md-2">
      <button type="submit" class="btn btn-primary w-100">Simpan</button>
    </div>
  </form>

  <hr class="my-4">

<div class="d-flex justify-content-between align-items-center">
  <h5 class="mb-0">Daftar Item</h5>
  <button class="btn btn-danger btn-sm" id="btnHapusTerpilih"><i class="bi bi-trash"></i> Hapus Terpilih</button>
</div>

  <table class="table table-bordered table-striped mt-3">
    <thead class="table-dark">
      <tr>
       <th><input type="checkbox" id="selectAll"></th> 
        <th>Kode</th>
        <th>Nama</th>
        <th>Satuan</th>
        <th>Jumlah</th>
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
        <td><input type="checkbox" class="check-item" value="${item.kode_item}"></td>
        <td>${item.kode_item}</td>
        <td>${item.nama}</td>
        <td>${item.satuan}</td>
        <td>${parseFloat(item.jumlah_item).toLocaleString()}</td>
        <td>Rp ${parseFloat(item.harga).toLocaleString()}</td>
        <td>
        <button class="btn btn-warning btn-sm edit-btn"
        data-kode_item="${item.kode_item}"
        data-nama="${item.nama}"
        data-satuan="${item.satuan}"
        data-harga="${item.harga}"
        data-jumlah-item="${item.jumlah_item}">
        <i class="bi bi-pencil-square"></i>
        </button>
        
        <button class="btn btn-sm btn-danger delete-btn" data-kode_item="${item.kode_item}">
        <i class="bi bi-trash"></i>
        </button>
        </td>
        </tr>
        `;
    });
    $("#daftarItem").html(html);
    $('#selectAll').prop('checked', false);

}
});

}


$(document).on("click", ".delete-btn", function () {
  const kode_item = $(this).data("kode_item");
  if (confirm("Yakin ingin menghapus item dengan kode_item: " + kode_item + "?")) {
    $.post("./controller.php", { action: "deleteItem", kode_item }, function (res) {
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
$('#btnHapusTerpilih').on('click', function () {
  const kodeDipilih = $(".check-item:checked").map(function () {
    return this.value;
  }).get();

  if (kodeDipilih.length === 0) {
    $('#toastBody').text("⚠️ Pilih minimal satu item untuk dihapus.");
    new bootstrap.Toast($('#liveToast')[0]).show();
    return;
  }

  if (confirm("Yakin ingin menghapus beberapa item ini?")) {
    $.post("./controller.php", { action: "deleteMultipleItems", kode_list: kodeDipilih }, function (res) {
      const response = typeof res === "string" ? JSON.parse(res) : res;
      $('#toastBody').text(response.message);
      new bootstrap.Toast($('#liveToast')[0]).show();
      if (response.status === "success") {
        reloadItems();
      }
    });
  }
});

// Checkbox Select All
$(document).on('change', '#selectAll', function () {
  $('.check-item').prop('checked', this.checked);
});
let isEdit = false;

$(document).on('click', '.edit-btn', function () {
    isEdit = true;
$('input[name="kode_item"]').prop('readonly', true);
  const kode_item = $(this).data('kode_item');
  const nama = $(this).data('nama');
  const satuan = $(this).data('satuan');
  const harga = $(this).data('harga');
  const jumlah_item = $(this).data('jumlah-item');

  // Isi form dengan data yang diklik
  $('input[name="kode_item"]').val(kode_item);
  $('input[name="nama"]').val(nama);
  $('input[name="satuan"]').val(satuan);
  $('input[name="harga"]').val(harga);
  $('input[name="jumlah_item"]').val(jumlah_item);

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
      $('input[name="kode_item"]').prop('readonly', false);
      $('#formItem button[type="submit"]').text('Simpan').removeClass('btn-warning').addClass('btn-primary');
      isEdit = false;
    }
  });
});

  // Load awal saat page dibuka
  reloadItems();
});


</script>


<?php include "controller.php"; ?>

<div class="container">
  <h4 class="mb-3">Transaksi Penjualan</h4>
  <form id="formTransaksi">
    <div class="row mb-3">
      <div class="col-md-3">
        <label>Tanggal</label>
        <input type="date" name="tanggal" class="form-control" value="<?= date('Y-m-d') ?>" required>
      </div>
      <div class="col-md-3">
        <label>Konsumen</label>
        <input type="text" name="konsumen" class="form-control" required>
      </div>
    </div>

    <div class="row g-2 align-items-end">
      <div class="col-md-2">
        <label>Kode</label>
        <select class="form-select" id="kode_item">
          <option value="">Pilih Barang</option>
        </select>
      </div>
      <div class="col-md-2">
        <label>Nama</label>
        <input type="text" id="nama_item" class="form-control" readonly>
      </div>
      <div class="col-md-1">
        <label>Satuan</label>
        <input type="text" id="satuan_item" class="form-control" readonly>
      </div>
      <div class="col-md-2">
        <label>Harga</label>
        <input type="number" id="harga_item" class="form-control" readonly>
      </div>
      <div class="col-md-1">
        <label>Qty</label>
        <input type="number" id="qty_item" class="form-control" min="1" value="1">
      </div>
      <div class="col-md-2">
        <label>Subtotal</label>
        <input type="text" id="subtotal_item" class="form-control" readonly>
      </div>
      <div class="col-md-2">
        <button type="button" class="btn btn-primary w-100" id="btnTambahItem">Tambah</button>
      </div>
    </div>

    <hr>

    <table class="table table-bordered mt-3" id="tabelItem">
      <thead class="table-dark">
        <tr>
          <th>Hapus</th>
          <th>Kode</th>
          <th>Nama</th>
          <th>Satuan</th>
          <th>Harga</th>
          <th>Qty</th>
          <th>Subtotal</th>
        </tr>
      </thead>
      <tbody></tbody>
      <tfoot>
        <tr>
          <th colspan="5" class="text-end">Total Qty</th>
          <th id="totalQty">0</th>
          <th id="totalHarga">Rp 0</th>
        </tr>
      </tfoot>
    </table>

    <div class="mt-4 d-flex gap-2">
      <button type="submit" class="btn btn-success">Simpan</button>
      <button type="reset" class="btn btn-secondary">Cancel</button>
    </div>
  </form>
</div>

<script>
let daftarItem = [];

function updateTabel() {
  const tbody = $("#tabelItem tbody");
  tbody.empty();
  let totalQty = 0, totalHarga = 0;

  daftarItem.forEach((item, i) => {
    totalQty += item.qty;
    totalHarga += item.subtotal;

    tbody.append(`
      <tr>
        <td><button type="button" class="btn btn-danger btn-sm btnHapus" data-index="${i}">X</button></td>
        <td>${item.kode}</td>
        <td>${item.nama}</td>
        <td>${item.satuan}</td>
        <td>${item.harga}</td>
        <td>${item.qty}</td>
        <td>${item.subtotal}</td>
      </tr>
    `);
  });

  $("#totalQty").text(totalQty);
  $("#totalHarga").text("Rp " + totalHarga.toLocaleString());
}

$(document).ready(function () {
  // Ambil data item ke dropdown
  $.get("./controller.php?action=getItemsOptions", function (resRaw) {
    const res = typeof resRaw === "string" ? JSON.parse(resRaw) : resRaw;
    if (res.status === "success") {
      $("#kode_item").html(res.options);
    }
  });

  // Saat kode_item dipilih, isi nama + satuan + harga
$("#kode_item").on("change", function () {
  const kode = $(this).val();
  if (!kode) return;

  $.get("./controller.php?action=getItemByKode&kode_item=" + kode, function (resRaw) {
    const res = typeof resRaw === "string" ? JSON.parse(resRaw) : resRaw;
    if (res.status === "success") {
      const data = res.data;
      $("#nama_item").val(data.nama);
      $("#satuan_item").val(data.satuan);
      $("#harga_item").val(data.harga);
      $("#qty_item").val(1);
      $("#subtotal_item").val(data.harga);
    }
  });
});

$("#qty_item").on("input", function () {
  const qty = parseInt($(this).val()) || 0;
  const harga = parseFloat($("#harga_item").val()) || 0;
  $("#subtotal_item").val(qty * harga);
});


  $("#qty_item").on("input", function () {
    const qty = parseInt(this.value) || 1;
    const harga = parseFloat($("#harga_item").val()) || 0;
    $("#subtotal_item").val(harga * qty);
  });

  $("#btnTambahItem").on("click", function () {
    const kode = $("#kode_item").val();
    const nama = $("#nama_item").val();
    const satuan = $("#satuan_item").val();
    const harga = parseFloat($("#harga_item").val());
    const qty = parseInt($("#qty_item").val());
    const subtotal = harga * qty;

    if (!kode || qty < 1) return alert("Pilih item dan qty valid!");

    daftarItem.push({ kode, nama, satuan, harga, qty, subtotal });
    updateTabel();
  });

  // Hapus baris item
  $(document).on("click", ".btnHapus", function () {
    const index = $(this).data("index");
    daftarItem.splice(index, 1);
    updateTabel();
  });

  // Submit form
  $("#formTransaksi").on("submit", function (e) {
    e.preventDefault();
    const konsumen = $(this).find('[name="konsumen"]').val();
    if (daftarItem.length === 0) return alert("Isi minimal satu barang!");

    daftarItem.forEach(item => {
      $.post("./controller.php", {
        action: "insertPenjualan",
        kode_item: item.kode,
        konsumen: konsumen,
        qty: item.qty
      }, function (res) {
        console.log(res);
      });
    });

    alert("Transaksi berhasil disimpan.");
    daftarItem = [];
    updateTabel();
    this.reset();
  });
});
</script>

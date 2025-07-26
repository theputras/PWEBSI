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
        <input type="text" id="harga_item" class="form-control" readonly>
      </div>
      <div class="col-md-1">
        <label>Qty</label>
        <input type="number" id="qty_item" class="form-control" min="1" value="0">
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

<hr>
<h4 class="mb-3">Tabel Transaksi</h4>
  <table class="table table-bordered mt-3" id="tabelPenjualan">
      <thead class="table-dark">
          <tr>
            <th>Kode Transaksi</th>
            <th>Tanggal</th>
            <th>Konsumen</th>
            <th>Total Qty</th>
            <th>Total Penjualan</th>
            <th>Aksi</th>
  </tr>
      </thead>
      <tbody></tbody>

    </table>


<div class="modal fade" id="detailTransaksiModal" tabindex="-1" aria-labelledby="detailTransaksiModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailTransaksiModalLabel">Detail Transaksi Penjualan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p><strong>Kode Transaksi:</strong> <span id="modalKodeTr"></span></p>
        <p><strong>Tanggal:</strong> <span id="modalTanggal"></span></p>
        <p><strong>Konsumen:</strong> <span id="modalKonsumen"></span></p>

        <h6>Detail Item:</h6>
        <table class="table table-bordered table-striped">
          <thead class="table-dark">
            <tr>
              <th>Kode Item</th>
              <th>Nama Item</th>
              <th>Satuan</th>
              <th>Harga</th>
              <th>Qty</th>
              <th>Subtotal</th>
            </tr>
          </thead>
          <tbody id="modalDetailItemTableBody">
            </tbody>
          <tfoot>
            <tr>
              <th colspan="4" class="text-end">TOTAL QTY</th>
              <th id="modalTotalQty">0</th>
              <th id="modalTotalHarga">Rp 0</th>
            </tr>
          </tfoot>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>


<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999">
  <div id="liveToast" class="toast align-items-center text-white bg-danger border-0" role="showToast">
    <div class="d-flex">
      <div class="toast-body" id="toastBody">
        </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
    </div>
  </div>
</div>
<script>
let daftarItem = []; // Pastikan daftarItem dideklarasikan di sini atau di luar fungsi $(document).ready
function showToast(message, type = 'danger') {
  const toastEl = document.getElementById('liveToast');
  const toastBody = document.getElementById('toastBody');

  // Ganti warna background toast sesuai tipe
  toastEl.className = `toast align-items-center text-white bg-${type} border-0`;

  toastBody.innerText = message;

  const toast = new bootstrap.Toast(toastEl);
  toast.show();
}

function loadPenjualan() {
  $.get("./controller.php?action=getPenjualan", function (resRaw) {
    const res = typeof resRaw === "string" ? JSON.parse(resRaw) : resRaw;

    if (res.status !== "success") {
      showToast("❌ Gagal ambil data penjualan.");
      return;
    }

    const tbody = $("#tabelPenjualan tbody");
    tbody.empty();

  res.data.forEach((row, i) => {
  tbody.append(`
    <tr>
      <td>${row.kodetr}</td>
      <td>${row.tanggal}</td>
      <td>${row.konsumen}</td>
      <td>${row.totalqty}</td>
      <td>Rp ${parseFloat(row.total_penjualan).toLocaleString("id-ID")}</td>
      <td>
        <button class="btn btn-info btn-sm btnDetail" data-kodetr="${row.kodetr}" title="Lihat Detail"
          data-tanggal="${row.tanggal}" data-konsumen="${row.konsumen}"
          data-totalqty="${row.totalqty}" data-totalpenjualan="${row.total_penjualan}">
          🔍
        </button>
      </td>
    </tr>
  `);
});

  });
}



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
        <td>Rp ${item.harga.toLocaleString("id-ID")}</td>
        <td>${item.qty}</td>
        <td>Rp ${item.subtotal.toLocaleString("id-ID")}</td>
      </tr>
    `);
  });

  $("#totalQty").text(totalQty);
  $("#totalHarga").text("Rp " + totalHarga.toLocaleString("id-ID"));
}


$(document).ready(function () {
loadPenjualan(); // ambil data saat pertama buka halaman

  // Ambil data item ke dropdown
  const $dropdown = $('#kode_item');

  if ($dropdown.length > 0) {
    $.get('./controller.php?action=getItemsOptions', function (resRaw) {
      const res = typeof resRaw === "string" ? JSON.parse(resRaw) : resRaw;

      if (res.status === 'success') {
        let html = '<option value="">Pilih Barang</option>';
        html += res.options; // pastiin ini udah <option ...>
        $dropdown.html(html);
      } else {
        $dropdown.html('<option value="">Gagal memuat data</option>');
      }
    });
  } else {
    console.warn('#kode_item not found di DOM!');
  }

  // Saat kode_item dipilih, isi nama + satuan + harga
$("#kode_item").on("change", function () {
  const kode = $(this).val();
  if (!kode) return;

  $.get("./controller.php?action=getItemByKode&kode_item=" + kode, function (resRaw) {
    const res = typeof resRaw === "string" ? JSON.parse(resRaw) : resRaw;
    if (res.status === "success") {
  const data = res.data;
  const harga = parseFloat(data.harga);

  $("#nama_item").val(data.nama);
  $("#satuan_item").val(data.satuan);

  // Simpan angka asli di .data("raw")
  $("#harga_item").val(harga.toLocaleString("id-ID")).data("raw", harga);
  $("#qty_item").val(1);
  $("#subtotal_item").val(harga.toLocaleString("id-ID"));
}

  });
});

// $("#qty_item").on("input", function () {
//   const qty = parseInt($(this).val()) || 0;
//   const harga = parseFloat($("#harga_item").val()) || 0;
//   $("#subtotal_item").val(qty * harga);
// });


//   $("#qty_item").on("input", function () {
//     const qty = parseInt(this.value) || 1;
//     const harga = parseFloat($("#harga_item").val()) || 0;
//     $("#subtotal_item").val(harga * qty);
//   });

$("#qty_item").on("input", function () {
  const qty = parseInt(this.value) || 0;
  const harga = parseFloat($("#harga_item").data("raw")) || 0; // Ambil dari data("raw")
  const subtotal = harga * qty;

  $("#subtotal_item").val(subtotal.toLocaleString("id-ID"));
});


$("#btnTambahItem").on("click", function () {
  const kode = $("#kode_item").val();
  const nama = $("#nama_item").val();
  const satuan = $("#satuan_item").val();

  // ✅ HARGA & QTY HARUS DIPARSE DARI ANGKA MURNI!
  const harga = parseFloat($("#harga_item").data("raw")); // ambil dari .data("raw")
  const qty = parseInt($("#qty_item").val());
  const subtotal = harga * qty;

  if (!kode || qty < 1 || isNaN(harga)) { // Tambahkan validasi harga
    showToast("Pilih item, masukkan qty valid, dan pastikan harga ada!");
    return;
  }


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
  if (daftarItem.length === 0) return showToast("Isi minimal satu barang!");

  // Susun ulang daftarItem biar sesuai struktur server
  const items = daftarItem.map(item => ({
    kode_item: item.kode,
    nama: item.nama,
    satuan: item.satuan,
    harga: item.harga,
    qty: item.qty
  }));

  $.post("./controller.php", {
    action: "insertPenjualan",
    konsumen: konsumen,
    items: items
  }, function (resRaw) {
    const res = typeof resRaw === "string" ? JSON.parse(resRaw) : resRaw;

    if (res.status === "success") {
      showToast(res.message, 'success'); // Tambahkan type success
      daftarItem = [];
      updateTabel();
      $("#formTransaksi")[0].reset();
      loadPenjualan(); // 🚀 Tambahin ini biar tabel bawah auto update
    } else {
      showToast(res.message);
    }
  });
});


// Event listener untuk tombol "🔍 Detail"
$(document).on("click", ".btnDetail", function () {
  const kodetr = $(this).data("kodetr");
  const tanggal = $(this).data("tanggal");
  const konsumen = $(this).data("konsumen");
  const totalqty = $(this).data("totalqty");
  const totalpenjualan = $(this).data("totalpenjualan");


  // Isi data master ke modal
  $('#modalKodeTr').text(kodetr);
  $('#modalTanggal').text(tanggal);
  $('#modalKonsumen').text(konsumen);


  $.get(`./controller.php?action=detailPenjualan&kodetr=${kodetr}`, function (resRaw) {
    const res = typeof resRaw === "string" ? JSON.parse(resRaw) : resRaw;

    if (res.status === "success") {
      let detailHtml = '';
      let modalTotalQty = 0;
      let modalTotalHarga = 0;
      res.data.forEach((item) => {
        modalTotalQty += item.qty;
        modalTotalHarga += parseFloat(item.subtotal);
        detailHtml += `
          <tr>
            <td>${item.kode_item}</td>
            <td>${item.nama}</td>
            <td>${item.satuan}</td>
            <td>Rp ${parseFloat(item.harga).toLocaleString("id-ID")}</td>
            <td>${item.qty}</td>
            <td>Rp ${parseFloat(item.subtotal).toLocaleString("id-ID")}</td>
          </tr>
        `;
      });
      $('#modalDetailItemTableBody').html(detailHtml);
      $('#modalTotalQty').text(modalTotalQty);
      $('#modalTotalHarga').text(`Rp ${modalTotalHarga.toLocaleString("id-ID")}`);

      // Tampilkan modal
      const detailModal = new bootstrap.Modal(document.getElementById('detailTransaksiModal'));
      detailModal.show();

    } else {
      showToast(res.message);
    }
  });
});


});
</script>
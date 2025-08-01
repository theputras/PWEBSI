<?php include "controller.php"; ?>

<div class="container">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Transaksi Penjualan</h4>
    <button class="btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#formTransaksiCollapse" aria-expanded="false" aria-controls="formTransaksiCollapse">
      Tambah Transaksi Baru
    </button>
  </div>

  <div class="collapse" id="formTransaksiCollapse">
    <div class="card card-body mb-4">
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
          <div class="col-md-3 position-relative"> <label>Kode/Nama Item</label>
            <input type="text" class="form-control" id="kode_item_search" placeholder="Cari atau Pilih Barang">
            <input type="hidden" id="kode_item_selected" name="kode_item_selected"> 

            <div id="item_suggestions" class="list-group position-absolute w-100 bg-white border border-secondary rounded shadow-lg" style="z-index:1000; max-height:200px; overflow-y:auto; display:none;">
              </div>
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
          <div class="col-md-1">
            <button type="button" class="btn btn-primary w-100" id="btnTambahItem"><i class="bi bi-plus-square"></i></button>
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
  </div>
</div>

<hr>
<div class="container">
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
</div>

<div class="modal fade" id="detailTransaksiModal" tabindex="-1" aria-labelledby="detailTransaksiModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailTransaksiModalLabel">Detail Transaksi Penjualan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modalPrintArea"> <p><strong>Kode Transaksi:</strong> <span id="modalKodeTr"></span></p>
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
        <button type="button" class="btn btn-primary" id="btnPrintDetail"><i class="bi bi-printer"></i> Print</button>
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
// Variabel daftarItem sudah di index.php
function showToast(message, type = 'danger') {
  const toastEl = document.getElementById('liveToast');
  const toastBody = document.getElementById('toastBody');

  // Ganti warna background toast sesuai tipe
  toastEl.className = `toast align-items-center text-white bg-${type} border-0`;

  toastBody.innerText = message;

  const toast = new bootstrap.Toast(toastEl);
  toast.show();
}

// Fungsi untuk merender tabel penjualan
function renderPenjualanTable(data) {
    const tbody = $("#tabelPenjualan tbody");
    tbody.empty();

    if (data && data.length > 0) {
        data.forEach((row) => {
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
                             <i class="bi bi-eye"></i>
                        </button>
                    </td>
                </tr>
            `);
        });
    } else {
        tbody.append(`<tr><td colspan="6" class="text-center">Tidak ada data penjualan.</td></tr>`);
    }
}


function loadPenjualan() {
  const cacheKey = 'penjualanData';
  const cachedData = localStorage.getItem(cacheKey);
    const cacheExpiryTime = 5 * 60 * 1000; // 5 menit

    // 1. Coba muat dari cache dulu (untuk "sat set")
    if (cachedData) {
        try {
            const parsedCache = JSON.parse(cachedData);
            if (Date.now() - parsedCache.timestamp < cacheExpiryTime) {
                console.log('Memuat data penjualan dari cache...');
                renderPenjualanTable(parsedCache.data);
            } else {
                console.log('Cache penjualan kadaluarsa, akan diperbarui...');
                localStorage.removeItem(cacheKey); // Hapus cache kadaluarsa
            }
        } catch (e) {
            console.error("Gagal parsing cache penjualan:", e);
            localStorage.removeItem(cacheKey);
        }
    }

    // 2. Selalu ambil data terbaru dari server di latar belakang
    $.get("./controller.php?action=getPenjualan", function (resRaw) {
        const res = typeof resRaw === "string" ? JSON.parse(resRaw) : resRaw;

        if (res.status === "success") {
            const currentServerData = JSON.stringify(res.data);
            let isDataChanged = true;

            // Cek apakah data dari server berbeda dengan yang di cache
            if (cachedData) {
                try {
                    const parsedCache = JSON.parse(cachedData);
                    if (JSON.stringify(parsedCache.data) === currentServerData) {
                        isDataChanged = false; // Data tidak berubah, tidak perlu render ulang
                    }
                } catch (e) {
                    // Biarkan isDataChanged tetap true jika ada error parsing cache
                }
            }
            
            // Render hanya jika data berubah atau tidak ada di cache
            if (isDataChanged) {
                console.log('Memperbarui data penjualan dari server...');
                renderPenjualanTable(res.data);
                // Simpan data terbaru ke cache
                localStorage.setItem(cacheKey, JSON.stringify({
                    data: res.data,
                    timestamp: Date.now()
                }));
            } else {
                console.log('Data penjualan tidak berubah, menggunakan data cache yang ada.');
            }

        } else {
            showToast("❌ Gagal ambil data penjualan dari server.");
            // Jika gagal ambil dari server dan tidak ada cache, tampilkan pesan kosong
            if (!cachedData) {
                renderPenjualanTable([]); // Render tabel kosong jika tidak ada cache dan gagal fetch
            }
        }
    }).fail(function() {
        showToast("⚠️ Gagal terhubung ke server untuk data penjualan.");
        // Jika request gagal total dan tidak ada cache, tampilkan pesan kosong
        if (!cachedData) {
            renderPenjualanTable([]);
        }
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

// Variabel untuk menyimpan semua data item yang dimuat dari server


$(document).ready(function () {
loadPenjualan(); // ambil data saat pertama buka halaman
  const cacheKey = 'penjualanData';

  // Ambil data item ke allItemsData dan inisialisasi saran
  $.get('./controller.php?action=getItemOptions', function (resRaw) {
    const res = typeof resRaw === "string" ? JSON.parse(resRaw) : resRaw;

    if (res.status === 'success' && res.full_data) {
        allItemsData = res.full_data;
        // Inisialisasi saran awal (opsional, bisa kosong)
        // renderItemSuggestions(allItemsData); 
    } else {
        showToast("Gagal memuat daftar item untuk pencarian.", "danger");
    }
  });


    // Fungsi untuk merender saran item
    function renderItemSuggestions(filteredItems) {
        const suggestionsDiv = $('#item_suggestions');
        suggestionsDiv.empty();
        if (filteredItems.length > 0) {
            filteredItems.forEach(item => {
                const suggestionText = `${item.nama} (Stok: ${item.jumlah_item}, Harga: Rp. ${parseFloat(item.harga).toLocaleString("id-ID")}) - ${item.kode_item}`;
                suggestionsDiv.append(`
                    <a href="#" class="list-group-item list-group-item-action" 
                       data-kode_item="${item.kode_item}"
                       data-nama="${item.nama}"
                       data-satuan="${item.satuan}"
                       data-harga="${item.harga}"
                       data-jumlah_item="${item.jumlah_item}">
                       ${suggestionText}
                    </a>
                `);
            });
            suggestionsDiv.show();
        } else {
            suggestionsDiv.hide();
        }
    }

    // Event listener untuk input pencarian
    $('#kode_item_search').on('input', function() {
        const searchTerm = $(this).val().toLowerCase();
        if (searchTerm.length === 0) {
            $('#item_suggestions').hide().empty();
            // Kosongkan juga field detail jika pencarian dikosongkan
            $("#kode_item_selected").val("");
            $("#nama_item").val("");
            $("#satuan_item").val("");
            $("#harga_item").val("").removeData("raw");
            $("#qty_item").val(0);
            $("#subtotal_item").val("Rp 0");
            return;
        }

        const filtered = allItemsData.filter(item => 
            item.nama.toLowerCase().includes(searchTerm) || 
            item.kode_item.toLowerCase().includes(searchTerm) ||
            item.satuan.toLowerCase().includes(searchTerm) // Pencarian per kalimat
        );
        renderItemSuggestions(filtered);
    });

    // Event listener saat saran item diklik
    $(document).on('click', '#item_suggestions .list-group-item', function(e) {
        e.preventDefault();
        const selectedItemKode = $(this).data('kode_item');
        const selectedItemNama = $(this).data('nama');
        const selectedItemSatuan = $(this).data('satuan');
        const selectedItemHarga = $(this).data('harga');
        const selectedItemJumlah = $(this).data('jumlah_item'); // Stok yang tersedia

        // Isi input pencarian dan hidden input
        $('#kode_item_search').val(`${selectedItemNama} - ${selectedItemKode}`);
        $('#kode_item_selected').val(selectedItemKode);

        // Isi detail item lainnya
        $("#nama_item").val(selectedItemNama);
        $("#satuan_item").val(selectedItemSatuan);
        $("#harga_item").val(parseFloat(selectedItemHarga).toLocaleString("id-ID")).data("raw", parseFloat(selectedItemHarga));
        $("#qty_item").val(1); // Default Qty 1
        $("#subtotal_item").val(parseFloat(selectedItemHarga).toLocaleString("id-ID"));
        
        $('#item_suggestions').hide(); // Sembunyikan saran
        $("#qty_item").focus(); // Fokus ke Qty
    });

    // Sembunyikan saran jika klik di luar
    $(document).on('click', function(e) {
        if (!$(e.target).closest('#kode_item_search, #item_suggestions').length) {
            $('#item_suggestions').hide();
        }
    });


$("#qty_item").on("input", function () {
  const qty = parseInt(this.value) || 0;
  const harga = parseFloat($("#harga_item").data("raw")) || 0; // Ambil dari data("raw")
  const subtotal = harga * qty;

  $("#subtotal_item").val(subtotal.toLocaleString("id-ID"));
});


$("#btnTambahItem").on("click", function () {
  const kode = $("#kode_item_selected").val(); // Ambil dari hidden input
  const nama = $("#nama_item").val();
  const satuan = $("#satuan_item").val();

  // ✅ HARGA & QTY HARUS DIPARSE DARI ANGKA MURNI!
  const harga = parseFloat($("#harga_item").data("raw")); // ambil dari .data("raw")
  const qty = parseInt($("#qty_item").val());
  const subtotal = harga * qty;

  if (!kode || qty < 1 || isNaN(harga)) { // Tambahkan validasi harga
    showToast("Pilih item, masukkan qty valid, dan pastikan harga ada!", "danger");
    return;
  }
  // Cek stok (opsional tapi sangat disarankan)
    const selectedItemData = allItemsData.find(item => item.kode_item === kode);
    if (selectedItemData && qty > selectedItemData.jumlah_item) {
        showToast(`Stok ${nama} (${selectedItemData.satuan}) tidak cukup. Tersedia: ${selectedItemData.jumlah_item}`, "danger");
        return;
    }


  daftarItem.push({ kode, nama, satuan, harga, qty, subtotal });
  updateTabel();
  
  // Bersihkan form item setelah ditambahkan
  $('#kode_item_search').val("");
  $('#kode_item_selected').val("");
  $("#nama_item").val("");
  $("#satuan_item").val("");
  $("#harga_item").val("").removeData("raw");
  $("#qty_item").val("");
  $("#subtotal_item").val("Rp 0");
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
  if (daftarItem.length === 0) return showToast("Isi minimal satu barang!", "danger");

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
    localStorage.removeItem(cacheKey);
      showToast(res.message, 'success'); // Tambahkan type success
      daftarItem = [];
      updateTabel();
      $("#formTransaksi")[0].reset();
      loadPenjualan(); // 🚀 Tambahin ini biar tabel bawah auto update
      // Tutup form setelah berhasil disimpan
      const formCollapse = new bootstrap.Collapse(document.getElementById('formTransaksiCollapse'));
      formCollapse.hide();
    } else {
      showToast(res.message, "danger");
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
      showToast(res.message, "danger");
    }
  });
});
// Fungsi untuk mencetak isi modal
$('#btnPrintDetail').on('click', function() {
    const printContents = document.getElementById('modalPrintArea').innerHTML;
    const originalContents = document.body.innerHTML;
    // const originalHeadContents = document.head.innerHTML; // Tidak diperlukan lagi

    // Gaya untuk cetak
    const printStyles = `
        <style>
            body { margin: 20mm !important; } /* Margins for print */
            @media print {
                body { margin: 10mm !important; } /* Less margin for actual print */
                /* Sembunyikan elemen non-print lainnya jika ada, misalnya navbar, toast, dll */
                .navbar, .toast, .modal-footer, .btn-close { display: none !important; }
                /* Atur ulang ukuran tabel agar pas di halaman jika perlu */
                table { width: 100% !important; border-collapse: collapse !important; }
                th, td { border: 1px solid #dee2e6 !important; padding: .75rem !important; }
                .table-dark { background-color: #343a40 !important; color: white !important; -webkit-print-color-adjust: exact; }
                /* Ensure background colors print */
            }
        </style>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    `;

    // Buat HTML lengkap untuk cetak
    const fullPrintHtml = `
        <!DOCTYPE html>
        <html>
        <head>
            <title>Detail Transaksi Penjualan</title>
            ${printStyles}
        </head>
        <body>
            ${printContents}
        </body>
        </html>
    `;

    // Ganti seluruh konten dokumen dengan konten cetak
    document.open(); // Buka dokumen untuk penulisan ulang
    document.write(fullPrintHtml);
    document.close(); // Tutup dokumen untuk penulisan ulang

    // Cetak
    window.print();

    // Kembalikan konten asli setelah cetak
    // Menggunakan location.reload() adalah cara termudah untuk mengembalikan DOM asli
    // karena mengganti document.body.innerHTML bisa merusak event listener JS.
    location.reload(); 
});

});
</script>
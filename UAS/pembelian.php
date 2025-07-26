<?php include "controller.php"; ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Transaksi Pembelian</h4>
        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#formPembelianCollapse" aria-expanded="false" aria-controls="formPembelianCollapse">
          Tambah Pembelian
        </button>
    </div>

    <div class="collapse" id="formPembelianCollapse">
        <div class="card card-body mb-4">
            <form id="formTransaksiPembelian">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label for="tanggal_pembelian" class="form-label">Tanggal</label>
                        <input type="date" name="tanggal_pembelian" id="tanggal_pembelian" class="form-control" value="<?= date('Y-m-d') ?>" required>
                    </div>
                    <div class="col-md-3">
                        <label for="kode_supplier_pembelian" class="form-label">Supplier</label>
                        <select class="form-select" id="kode_supplier_pembelian" name="kode_supplier" required>
                            <option value="">Pilih Supplier</option>
                            </select>
                    </div>
                </div>

                <h6 class="mt-4">Tambah Item Pembelian:</h6>
                <div class="row g-2 align-items-end mb-3">
                    <div class="col-md-3">
                        <label for="kode_item_pembelian" class="form-label">Kode Item</label>
                        <input class="form-control" list="item_options_pembelian" id="kode_item_pembelian" placeholder="Ketik Kode/Nama Item">
                        <datalist id="item_options_pembelian">
                          </datalist>
                    </div>
                    <div class="col-md-3">
                        <label for="nama_item_pembelian" class="form-label">Nama Item</label>
                        <input type="text" id="nama_item_pembelian" class="form-control" readonly>
                    </div>
                    <div class="col-md-2">
                        <label for="harga_beli_item_pembelian" class="form-label">Harga Beli</label>
                        <input type="number" id="harga_beli_item_pembelian" class="form-control" min="0" value="0">
                    </div>
                    <div class="col-md-1">
                        <label for="qty_item_pembelian" class="form-label">Qty</label>
                        <input type="number" id="qty_item_pembelian" class="form-control" min="1" value="0">
                    </div>
                    <div class="col-md-2">
                        <label for="subtotal_item_pembelian" class="form-label">Subtotal</label>
                        <input type="text" id="subtotal_item_pembelian" class="form-control" readonly>
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-primary w-100" id="btnTambahItemPembelian">+</button>
                    </div>
                </div>

                <table class="table table-bordered table-striped" id="tabelItemPembelian">
                    <thead class="table-dark">
                        <tr>
                            <th>Aksi</th>
                            <th>Kode Item</th>
                            <th>Nama Item</th>
                            <th>Harga Beli</th>
                            <th>Qty</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody id="daftarItemPembelian">
                        </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4" class="text-end">Total Qty</th>
                            <th id="totalQtyPembelian">0</th>
                            <th id="totalHargaPembelian">Rp 0</th>
                        </tr>
                    </tfoot>
                </table>

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-success">Save Transaction</button>
                    <button type="button" class="btn btn-secondary" id="btnCancelPembelianForm">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <hr class="my-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Daftar Pembelian</h4>
        <button class="btn btn-danger btn-sm" id="btnHapusTerpilihPembelian">
            <i class="bi bi-trash"></i> Hapus Terpilih
        </button>
    </div>

    <table class="table table-bordered table-striped mt-3" id="tabelDaftarPembelian">
        <thead class="table-dark">
            <tr>
                <th><input type="checkbox" id="selectAllPembelian"></th> <th>ID Pembelian</th>
                <th>Kode Supplier</th>
                <th>Nama Supplier</th>
                <th>Tanggal Pembelian</th>
                <th>Total Biaya</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="dataDaftarPembelian">
            </tbody>
    </table>
</div>

<div class="modal fade" id="detailPembelianModal" tabindex="-1" aria-labelledby="detailPembelianModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailPembelianModalLabel">Detail Pembelian</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p><strong>ID Pembelian:</strong> <span id="modalIdPembelian"></span></p>
        <p><strong>Tanggal:</strong> <span id="modalTanggalPembelian"></span></p>
        <p><strong>Supplier:</strong> <span id="modalNamaSupplier"></span> (<span id="modalKodeSupplier"></span>)</p>
        <p><strong>Status:</strong> <span id="modalStatusPembelian"></span></p>

        <h6>Detail Item:</h6>
        <table class="table table-bordered table-striped">
          <thead class="table-dark">
            <tr>
              <th>Kode Item</th>
              <th>Nama Item</th>
              <th>Qty</th>
              <th>Harga Beli</th>
              <th>Subtotal</th>
            </tr>
          </thead>
          <tbody id="modalDetailItemPembelianTableBody">
            </tbody>
          <tfoot>
            <tr>
              <th colspan="3" class="text-end">TOTAL QTY</th>
              <th id="modalTotalQtyPembelian">0</th>
              <th id="modalTotalHargaPembelian">Rp 0</th>
            </tr>
          </tfoot>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" id="btnHapusPembelianModal">Hapus Transaksi Ini</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>


<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999">
  <div id="liveToast" class="toast align-items-center text-white bg-danger border-0" role="alert">
    <div class="d-flex">
      <div class="toast-body" id="toastBody">
        </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
    </div>
  </div>
</div>

<script>
// showToast() dan daftarItem[] sudah dideklarasikan di index.php

// let daftarPembelianItem = []; // Array untuk menampung item yang akan dibeli dalam satu transaksi

// let allItemsData = []; 
// Fungsi untuk merender tabel item pembelian di form transaksi
function updateTabelPembelianItems() {
    const tbody = $("#daftarItemPembelian");
    tbody.empty();
    let totalQty = 0, totalHarga = 0;

    if (daftarPembelianItem.length > 0) {
        daftarPembelianItem.forEach((item, i) => {
            totalQty += item.qty;
            totalHarga += item.subtotal;

            tbody.append(`
                <tr>
                    <td><button type="button" class="btn btn-danger btn-sm btnHapusItemPembelian" data-index="${i}">X</button></td>
                    <td>${item.kode_item}</td>
                    <td>${item.nama}</td>
                    <td>Rp ${parseFloat(item.harga_beli).toLocaleString("id-ID")}</td>
                    <td>${item.qty}</td>
                    <td>Rp ${parseFloat(item.subtotal).toLocaleString("id-ID")}</td>
                </tr>
            `);
        });
    } else {
        tbody.append(`<tr><td colspan="6" class="text-center">Belum ada item ditambahkan.</td></tr>`);
    }
    

    $("#totalQtyPembelian").text(totalQty);
    $("#totalHargaPembelian").text("Rp " + totalHarga.toLocaleString("id-ID"));
}

// Fungsi untuk merender tabel daftar pembelian
function renderDaftarPembelianTable(data) {
    const tbody = $("#dataDaftarPembelian");
    tbody.empty();

    if (data && data.length > 0) {
        data.forEach((row) => {
            tbody.append(`
                <tr>
                    <td><input type="checkbox" class="check-pembelian" value="${row.id_pembelian}"></td> <td>${row.id_pembelian}</td>
                    <td>${row.kode_supplier}</td>
                    <td>${row.nama_supplier}</td>
                    <td>${row.tanggal_pembelian}</td>
                    <td>Rp ${parseFloat(row.total_biaya).toLocaleString("id-ID")}</td>
                    <td><span class="badge ${row.status_pembelian === 'lunas' ? 'bg-success' : 'bg-warning'}">${row.status_pembelian}</span></td>
                    <td>
                        <button class="btn btn-info btn-sm btnDetailPembelian"
                            data-id_pembelian="${row.id_pembelian}"
                            data-kode_supplier="${row.kode_supplier}"
                            data-nama_supplier="${row.nama_supplier}"
                            data-tanggal_pembelian="${row.tanggal_pembelian}"
                            data-total_biaya="${row.total_biaya}"
                            data-status_pembelian="${row.status_pembelian}"
                            title="Lihat Detail Pembelian">
                            <i class="bi bi-eye"></i>
                        </button>
                        <button class="btn btn-danger btn-sm btnHapusDaftarPembelian" data-id_pembelian="${row.id_pembelian}" title="Hapus Pembelian">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
            `);
        });
    } else {
        tbody.append(`<tr><td colspan="8" class="text-center">Tidak ada data pembelian.</td></tr>`); // Kolom colspan disesuaikan
    }
    $('#selectAllPembelian').prop('checked', false); // Pastikan checkbox select all tidak tercentang
}

// Fungsi untuk memuat data daftar pembelian dengan caching
function loadDaftarPembelian() {
    const cacheKey = 'pembelianData';
    const cachedData = localStorage.getItem(cacheKey);
    const cacheExpiryTime = 5 * 60 * 1000; // 5 menit

    // 1. Coba muat dari cache dulu (untuk "sat set")
    if (cachedData) {
        try {
            const parsedCache = JSON.parse(cachedData);
            if (Date.now() - parsedCache.timestamp < cacheExpiryTime) {
                console.log('Memuat data pembelian dari cache...');
                renderDaftarPembelianTable(parsedCache.data);
            } else {
                console.log('Cache pembelian kadaluarsa, akan diperbarui...');
                localStorage.removeItem(cacheKey);
            }
        } catch (e) {
            console.error("Gagal parsing cache pembelian:", e);
            localStorage.removeItem(cacheKey);
        }
    }

    // 2. Selalu ambil data terbaru dari server di latar belakang
    $.get("./controller.php?action=getPembelian", function (resRaw) {
        const res = typeof resRaw === "string" ? JSON.parse(resRaw) : resRaw;

        if (res.status === "success") {
            const currentServerData = JSON.stringify(res.data);
            let isDataChanged = true;

            if (cachedData) {
                try {
                    const parsedCache = JSON.parse(cachedData);
                    if (JSON.stringify(parsedCache.data) === currentServerData) {
                        isDataChanged = false;
                    }
                } catch (e) {}
            }
            
            if (isDataChanged) {
                console.log('Memperbarui data pembelian dari server...');
                renderDaftarPembelianTable(res.data);
                localStorage.setItem(cacheKey, JSON.stringify({
                    data: res.data,
                    timestamp: Date.now()
                }));
            } else {
                console.log('Data pembelian tidak berubah, menggunakan data cache yang ada.');
            }

        } else {
            showToast("❌ Gagal ambil data pembelian dari server.");
            if (!cachedData) {
                renderDaftarPembelianTable([]);
            }
        }
    }).fail(function() {
        showToast("⚠️ Gagal terhubung ke server untuk data pembelian.");
        if (!cachedData) {
            renderDaftarPembelianTable([]);
        }
    });
}


$(document).ready(function () {
    loadDaftarPembelian(); // Muat data pembelian saat halaman dimuat

    // Muat dropdown supplier
    $.get("./controller.php?action=getSupplierOptions", function(resRaw) {
        const res = typeof resRaw === "string" ? JSON.parse(resRaw) : resRaw;
        if (res.status === "success") {
            let htmlOptions = "<option value=''>Pilih Supplier</option>";
            htmlOptions += res.options;
            $("#kode_supplier_pembelian").html(htmlOptions);
        } else {
            showToast("Gagal memuat daftar supplier.", "danger");
        }
    });

    // Muat data item ke datalist pembelian
    $.get('./controller.php?action=getItemsOptions', function (resRaw) {
        const res = typeof resRaw === "string" ? JSON.parse(resRaw) : resRaw;

        if (res.status === 'success') {
            allItemsData = res.full_data || []; // Simpan data lengkapnya
            let datalistHtml = '';
            allItemsData.forEach(item => {
                // value dari option adalah kode_item, label adalah apa yang terlihat
                datalistHtml += `<option value="${item.kode_item}" label="${item.nama} (Stok: ${item.jumlah_item}, Harga: Rp. ${parseFloat(item.harga).toLocaleString("id-ID")})"></option>`;
            });
            $('#item_options_pembelian').html(datalistHtml);
        } else {
            showToast("Gagal memuat daftar item untuk datalist.", "danger");
        }
    });

    // Ketika Kode Item diubah (input datalist)
    $("#kode_item_pembelian").on("change", function() {
        const kode = $(this).val();
        if (!kode) { // Jika input kosong
            $("#nama_item_pembelian").val("");
            $("#harga_beli_item_pembelian").val(0);
            $("#qty_item_pembelian").val(0);
            $("#subtotal_item_pembelian").val("Rp 0");
            return;
        }

        // Cari item di allItemsData (yang sudah dimuat)
        const selectedItem = allItemsData.find(item => item.kode_item === kode);

        if (selectedItem) {
            const hargaBeli = parseFloat(selectedItem.harga_beli); // Ambil harga_beli dari data
            $("#nama_item_pembelian").val(selectedItem.nama);
            $("#harga_beli_item_pembelian").val(hargaBeli); // Isi harga_beli
            $("#qty_item_pembelian").val(1); // Default qty 1
            $("#subtotal_item_pembelian").val((hargaBeli * 1).toLocaleString("id-ID"));
        } else {
            // Jika kode tidak ditemukan di data lokal (misal user mengetik kode yang salah)
            showToast("Kode item tidak valid atau tidak ditemukan.", "warning");
            $("#nama_item_pembelian").val("");
            $("#harga_beli_item_pembelian").val(0);
            $("#qty_item_pembelian").val(0);
            $("#subtotal_item_pembelian").val("Rp 0");
        }
    });

    // Perhitungan subtotal saat Qty atau Harga Beli berubah
    $("#qty_item_pembelian, #harga_beli_item_pembelian").on("input", function() {
        const qty = parseInt($("#qty_item_pembelian").val()) || 0;
        const hargaBeli = parseFloat($("#harga_beli_item_pembelian").val()) || 0;
        const subtotal = qty * hargaBeli;
        $("#subtotal_item_pembelian").val(subtotal.toLocaleString("id-ID"));
    });

    // Tambah Item ke daftarPembelianItem
    $("#btnTambahItemPembelian").on("click", function() {
        const kode_item = $("#kode_item_pembelian").val();
        const nama = $("#nama_item_pembelian").val();
        const harga_beli = parseFloat($("#harga_beli_item_pembelian").val());
        const qty = parseInt($("#qty_item_pembelian").val());
        const subtotal = harga_beli * qty;

        if (!kode_item || !nama || isNaN(harga_beli) || qty <= 0) {
            showToast("Lengkapi detail item pembelian (Kode, Nama, Harga Beli, Qty).", "danger");
            return;
        }

        // Cek duplikasi item
        const existingItemIndex = daftarPembelianItem.findIndex(item => item.kode_item === kode_item);
        if (existingItemIndex > -1) {
            daftarPembelianItem[existingItemIndex].qty += qty;
            daftarPembelianItem[existingItemIndex].subtotal += subtotal;
        } else {
            daftarPembelianItem.push({ kode_item, nama, harga_beli, qty, subtotal });
        }
        
        updateTabelPembelianItems();
        $("#kode_item_pembelian, #nama_item_pembelian, #subtotal_item_pembelian").val("");
        $("#harga_beli_item_pembelian, #qty_item_pembelian").val(0);
        $("#kode_item_pembelian").focus();
    });

    // Hapus Item dari daftarPembelianItem
    $(document).on("click", ".btnHapusItemPembelian", function() {
        const index = $(this).data("index");
        daftarPembelianItem.splice(index, 1);
        updateTabelPembelianItems();
    });

    // Submit Form Transaksi Pembelian
    $('#formTransaksiPembelian').on('submit', function(e) {
        e.preventDefault();
        const kode_supplier = $("#kode_supplier_pembelian").val();
        if (!kode_supplier) {
            showToast("Pilih supplier untuk transaksi ini.", "danger");
            return;
        }
        if (daftarPembelianItem.length === 0) {
            showToast("Tambahkan minimal satu item untuk transaksi pembelian.", "danger");
            return;
        }

        // Siapkan data untuk dikirim ke controller
        const itemsToSubmit = daftarPembelianItem.map(item => ({
            kode_item: item.kode_item,
            jumlah: item.qty,
            harga_beli: item.harga_beli
        }));

        $.post("./controller.php", {
            action: "insertPembelian",
            kode_supplier: kode_supplier,
            items_pembelian: itemsToSubmit // Kirim array item pembelian
        }, function(resRaw) {
            const res = typeof resRaw === "string" ? JSON.parse(res) : resRaw;
            showToast(res.message, res.status === "success" ? "success" : "danger");

            if (res.status === "success") {
                daftarPembelianItem = []; // Reset item list
                updateTabelPembelianItems(); // Kosongkan tabel
                $('#formTransaksiPembelian')[0].reset(); // Reset form master
                loadDaftarPembelian(); // Muat ulang daftar pembelian
                const formCollapse = new bootstrap.Collapse(document.getElementById('formPembelianCollapse'));
                formCollapse.hide(); // Sembunyikan form
            }
        }).fail(function() {
            showToast("⚠️ Gagal terhubung ke server untuk menyimpan pembelian.", "danger");
        });
    });

    // Event listener untuk tombol Batal Form Pembelian
    $('#btnCancelPembelianForm').on('click', function() {
        daftarPembelianItem = [];
        updateTabelPembelianItems();
        $('#formTransaksiPembelian')[0].reset();
        const formCollapse = bootstrap.Collapse.getInstance(document.getElementById('formPembelianCollapse'));
        if (formCollapse) {
             formCollapse.hide();
        }
    });

    // Event listener untuk tombol Detail Pembelian di tabel daftar
    $(document).on('click', '.btnDetailPembelian', function() {
        const idPembelian = $(this).data('id_pembelian');
        const kodeSupplier = $(this).data('kode_supplier');
        const namaSupplier = $(this).data('nama_supplier');
        const tanggalPembelian = $(this).data('tanggal_pembelian');
        const statusPembelian = $(this).data('status_pembelian');

        // Isi data master ke modal
        $('#modalIdPembelian').text(idPembelian);
        $('#modalTanggalPembelian').text(tanggalPembelian);
        $('#modalKodeSupplier').text(kodeSupplier);
        $('#modalNamaSupplier').text(namaSupplier);
        $('#modalStatusPembelian').text(statusPembelian);
        
        // Atur tombol hapus modal
        $('#btnHapusPembelianModal').data('id_pembelian', idPembelian);


        // Ambil detail item pembelian
        $.get(`./controller.php?action=getDetailPembelian&id_pembelian=${idPembelian}`, function(resRaw) {
            const res = typeof resRaw === "string" ? JSON.parse(res) : resRaw;
            if (res.status === "success") {
                let detailHtml = '';
                let modalTotalQty = 0;
                let modalTotalHarga = 0;
                res.data.forEach((item) => {
                    modalTotalQty += item.jumlah;
                    modalTotalHarga += parseFloat(item.subtotal);
                    detailHtml += `
                        <tr>
                            <td>${item.kode_item}</td>
                            <td>${item.nama}</td>
                            <td>${item.jumlah}</td>
                            <td>Rp ${parseFloat(item.harga_beli).toLocaleString("id-ID")}</td>
                            <td>Rp ${parseFloat(item.subtotal).toLocaleString("id-ID")}</td>
                        </tr>
                    `;
                });
                $('#modalDetailItemPembelianTableBody').html(detailHtml);
                $('#modalTotalQtyPembelian').text(modalTotalQty);
                $('#modalTotalHargaPembelian').text(`Rp ${modalTotalHarga.toLocaleString("id-ID")}`);

                const detailModal = new bootstrap.Modal(document.getElementById('detailPembelianModal'));
                detailModal.show();
            } else {
                showToast("Gagal memuat detail pembelian: " + res.message, "danger");
            }
        }).fail(function() {
            showToast("⚠️ Gagal terhubung ke server untuk detail pembelian.", "danger");
        });
    });

    // Event listener untuk tombol Hapus Transaksi Ini di modal detail pembelian
    $('#btnHapusPembelianModal').on('click', function() {
        const idPembelian = $(this).data('id_pembelian');
        if (confirm(`Yakin ingin menghapus transaksi pembelian ID ${idPembelian} ini? Stok item akan dikembalikan.`)) {
            $.post("./controller.php", { action: "deletePembelian", id_pembelian: idPembelian }, function(resRaw) {
                const res = typeof resRaw === "string" ? JSON.parse(res) : resRaw;
                showToast(res.message, res.status === "success" ? "success" : "danger");
                if (res.status === "success") {
                    const detailModal = bootstrap.Modal.getInstance(document.getElementById('detailPembelianModal'));
                    if (detailModal) detailModal.hide();
                    loadDaftarPembelian(); // Muat ulang daftar pembelian setelah hapus
                }
            }).fail(function() {
                showToast("⚠️ Gagal terhubung ke server untuk menghapus pembelian.", "danger");
            });
        }
    });

    // Event listener untuk tombol Hapus di tabel daftar pembelian
    $(document).on('click', '.btnHapusDaftarPembelian', function() {
        const idPembelian = $(this).data('id_pembelian');
        if (confirm(`Yakin ingin menghapus transaksi pembelian ID ${idPembelian} ini? Stok item akan dikembalikan.`)) {
            $.post("./controller.php", { action: "deletePembelian", id_pembelian: idPembelian }, function(resRaw) {
                const res = typeof resRaw === "string" ? JSON.parse(res) : resRaw;
                showToast(res.message, res.status === "success" ? "success" : "danger");
                if (res.status === "success") {
                    loadDaftarPembelian(); // Muat ulang daftar pembelian setelah hapus
                }
            }).fail(function() {
                showToast("⚠️ Gagal terhubung ke server untuk menghapus pembelian.", "danger");
            });
        }
    });

    // Checkbox Select All untuk Pembelian
    $(document).on('change', '#selectAllPembelian', function () {
      $('.check-pembelian').prop('checked', this.checked);
    });

    // Tombol Hapus Terpilih untuk Pembelian
    $('#btnHapusTerpilihPembelian').on('click', function () {
      const idsDipilih = $(".check-pembelian:checked").map(function () {
        return this.value;
      }).get();

      if (idsDipilih.length === 0) {
        showToast("⚠️ Pilih minimal satu transaksi pembelian untuk dihapus.", "warning");
        return;
      }

      if (confirm(`Yakin ingin menghapus ${idsDipilih.length} transaksi pembelian terpilih ini? Stok item akan dikembalikan.`)) {
        $.post("./controller.php", { action: "deleteMultiplePembelian", ids_list: idsDipilih }, function (res) {
          const response = typeof res === "string" ? JSON.parse(res) : res;
          showToast(response.message, response.status === "success" ? "success" : "danger");
          if (response.status === "success") {
            loadDaftarPembelian(); // Muat ulang data setelah sukses hapus
          }
        }).fail(function() {
            showToast("⚠️ Gagal terhubung ke server untuk menghapus transaksi terpilih.", "danger");
        });
      }
    });

});
</script>
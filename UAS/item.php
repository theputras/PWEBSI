<?php
include "controller.php";
?>

<div class="container">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Input Item Baru</h4>
    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#formItemCollapse" aria-expanded="false" aria-controls="formItemCollapse">
      Tambah Item
    </button>
  </div>

  <div class="collapse" id="formItemCollapse">
    <div class="card card-body mb-4">
      <form id="formItem" class="row g-3">
        <div class="col-md-3">
          <label for="kode_item" class="form-label">Kode Item</label>
          <input type="text" name="kode_item" id="kode_item" class="form-control" placeholder="Kode Item">
        </div>
        <div class="col-md-3">
          <label for="nama" class="form-label">Nama Item</label>
          <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Item" required>
        </div>
        <div class="col-md-2">
          <label for="satuan" class="form-label">Satuan</label>
          <input type="text" name="satuan" id="satuan" class="form-control" placeholder="Satuan" required>
        </div>    
        <div class="col-md-2">
          <label for="jumlah_item" class="form-label">Jumlah</label>
          <input type="number" name="jumlah_item" id="jumlah_item" class="form-control" placeholder="Jumlah" required>
        </div>
        <div class="col-md-2">
          <label for="harga_beli" class="form-label">Harga Beli</label>
          <input type="number" name="harga_beli" id="harga_beli" class="form-control" placeholder="Harga Beli" required>
        </div>
        <div class="col-md-2">
          <label for="harga_jual" class="form-label">Harga Jual</label>
          <input type="number" name="harga_jual" id="harga_jual" class="form-control" placeholder="Harga Jual" required>
          </div>
        <div class="col-md-auto">
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        <div class="col-md-auto">
          <button type="button" class="btn btn-secondary" id="btnBatalForm">Batal</button>
        </div>
      </form>
    </div>
  </div>

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
        <th>Harga Beli</th>
        <th>Harga Jual</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody id="daftarItem">
      
    </tbody>
  </table>
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
// Fungsi showToast di sini juga agar bisa digunakan di item.php
function showToast(message, type = 'danger') {
  const toastEl = document.getElementById('liveToast');
  const toastBody = document.getElementById('toastBody');

  // Ganti warna background toast sesuai tipe
  toastEl.className = `toast align-items-center text-white bg-${type} border-0`;

  toastBody.innerText = message;

  const toast = new bootstrap.Toast(toastEl);
  toast.show();
}

// Fungsi untuk merender tabel item
function renderItemTable(data) {
    const tbody = $("#daftarItem");
    tbody.empty();

    if (data && data.length > 0) {
        let html = "";
        data.forEach(item => {
            html += `
                <tr>
                    <td><input type="checkbox" class="check-item" value="${item.kode_item}"></td>
                    <td>${item.kode_item}</td>
                    <td>${item.nama}</td>
                    <td>${item.satuan}</td>
                    <td>${parseFloat(item.jumlah_item).toLocaleString("id-ID")}</td>
                    <td>Rp ${parseFloat(item.harga_beli).toLocaleString("id-ID")}</td>
                    <td>Rp ${parseFloat(item.harga).toLocaleString("id-ID")}</td>
                    <td>
                        <button class="btn btn-warning btn-sm edit-btn"
                            data-kode_item="${item.kode_item}"
                            data-nama="${item.nama}"
                            data-satuan="${item.satuan}"
                            data-harga_beli="${item.harga_beli}"
                            data-harga_jual="${item.harga}"
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
        tbody.html(html);
    } else {
        tbody.html(`<tr><td colspan="8" class="text-center">Tidak ada data item.</td></tr>`);
    }
    $('#selectAll').prop('checked', false); // Pastikan checkbox select all tidak tercentang
}

$(document).ready(function () {
    
    function reloadItems() {
        const cacheKey = 'itemData';
        const cachedData = localStorage.getItem(cacheKey);
        const cacheExpiryTime = 5 * 60 * 1000; // 5 menit

        // 1. Coba muat dari cache dulu (untuk "sat set")
        if (cachedData) {
            try {
                const parsedCache = JSON.parse(cachedData);
                if (Date.now() - parsedCache.timestamp < cacheExpiryTime) {
                    console.log('Memuat data item dari cache...');
                    renderItemTable(parsedCache.data);
                } else {
                    console.log('Cache item kadaluarsa, akan diperbarui...');
                    localStorage.removeItem(cacheKey); // Hapus cache kadaluarsa
                }
            } catch (e) {
                console.error("Gagal parsing cache item:", e);
                localStorage.removeItem(cacheKey);
            }
        }

        // 2. Selalu ambil data terbaru dari server di latar belakang
        $.get("./controller.php?action=getAllItems", function (resRaw) {
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
                    console.log('Memperbarui data item dari server...');
                    renderItemTable(res.data);
                    // Simpan data terbaru ke cache
                    localStorage.setItem(cacheKey, JSON.stringify({
                        data: res.data,
                        timestamp: Date.now()
                    }));
                } else {
                    console.log('Data item tidak berubah, menggunakan data cache yang ada.');
                }

            } else {
                showToast("❌ Gagal ambil data item dari server.");
                // Jika gagal ambil dari server dan tidak ada cache, tampilkan pesan kosong
                if (!cachedData) {
                    renderItemTable([]); // Render tabel kosong jika tidak ada cache dan gagal fetch
                }
            }
        }).fail(function() {
            showToast("⚠️ Gagal terhubung ke server untuk data item.");
            // Jika request gagal total dan tidak ada cache, tampilkan pesan kosong
            if (!cachedData) {
                renderItemTable([]);
            }
        });
    }


    $(document).on("click", ".delete-btn", function () {
      const kode_item = $(this).data("kode_item");
      if (confirm("Yakin ingin menghapus item dengan kode_item: " + kode_item + "?")) {
        $.post("./controller.php", { action: "deleteItem", kode_item }, function (res) {
          const response = typeof res === "string" ? JSON.parse(res) : res;
          showToast(response.message, response.status === "success" ? "success" : "danger");
          if (response.status === "success") {
            reloadItems();
          }
        }).fail(function() {
            showToast("⚠️ Gagal terhubung ke server untuk menghapus item.");
        });
      }
    });

    $('#btnHapusTerpilih').on('click', function () {
      const kodeDipilih = $(".check-item:checked").map(function () {
        return this.value;
      }).get();

      if (kodeDipilih.length === 0) {
        showToast("⚠️ Pilih minimal satu item untuk dihapus.");
        return;
      }

      if (confirm("Yakin ingin menghapus beberapa item ini?")) {
        $.post("./controller.php", { action: "deleteMultipleItems", kode_list: kodeDipilih }, function (res) {
          const response = typeof res === "string" ? JSON.parse(res) : res;
          showToast(response.message, response.status === "success" ? "success" : "danger");
          if (response.status === "success") {
            reloadItems();
          }
        }).fail(function() {
            showToast("⚠️ Gagal terhubung ke server untuk menghapus item terpilih.");
        });
      }
    });

    // Checkbox Select All
    $(document).on('change', '#selectAll', function () {
      $('.check-item').prop('checked', this.checked);
    });

    let isEdit = false;

    // Fungsi untuk mereset form ke mode "Simpan"
    function resetForm() {
        isEdit = false;
        $('#formItem')[0].reset();
        $('input[name="kode_item"]').prop('readonly', false);
        $('#formItem button[type="submit"]').text('Simpan').removeClass('btn-warning').addClass('btn-primary');
        // Tutup form collapse jika terbuka setelah reset
        const formCollapse = bootstrap.Collapse.getInstance(document.getElementById('formItemCollapse'));
        if (formCollapse) {
             formCollapse.hide();
        }
    }

    $(document).on('click', '.edit-btn', function () {
        isEdit = true;
        $('input[name="kode_item"]').prop('readonly', true);
        const kode_item = $(this).data('kode_item');
        const nama = $(this).data('nama');
        const satuan = $(this).data('satuan');
        const harga_beli = $(this).data('harga_beli'); // Ambil harga_beli
        const harga_jual = $(this).data('harga_jual'); // Ambil harga_jual
        const jumlah_item = $(this).data('jumlah-item');

        // Isi form dengan data yang diklik
        $('input[name="kode_item"]').val(kode_item);
        $('input[name="nama"]').val(nama);
        $('input[name="satuan"]').val(satuan);
        $('input[name="harga_beli"]').val(harga_beli); // Isi harga_beli
        $('input[name="harga_jual"]').val(harga_jual); // Isi harga_jual
        $('input[name="jumlah_item"]').val(jumlah_item);

        // Ganti tombol dan buka form
        $('#formItem button[type="submit"]').text('Update').removeClass('btn-primary').addClass('btn-warning');
        const formCollapse = new bootstrap.Collapse(document.getElementById('formItemCollapse'), { toggle: false });
        formCollapse.show(); // Tampilkan form edit
    });

    // Event listener untuk tombol Batal
    $('#btnBatalForm').on('click', function() {
        resetForm();
    });


    $('#formItem').on('submit', function(e) {
        e.preventDefault();
        let actionType = isEdit ? 'updateItem' : 'insertItem';
        const formData = $(this).serialize() + `&action=${actionType}`;
        
        $.post("./controller.php", formData, function(response) {
            const res = JSON.parse(response);
            showToast(res.message, res.status === "success" ? "success" : "danger");

            if (res.status === "success") {
                reloadItems();
                resetForm(); // Panggil resetForm untuk mengosongkan dan menutup form
            }
        }).fail(function() {
            showToast("⚠️ Gagal terhubung ke server untuk menyimpan/memperbarui item.");
        });
    });

    // Load awal saat page dibuka
    reloadItems();
});
</script>
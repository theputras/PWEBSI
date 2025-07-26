<?php include "controller.php"; ?>

<div class="container">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Input Supplier Baru</h4>
    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#formSupplierCollapse" aria-expanded="false" aria-controls="formSupplierCollapse">
      Tambah Supplier
    </button>
  </div>

  <div class="collapse" id="formSupplierCollapse">
    <div class="card card-body mb-4">
      <form id="formSupplier" class="row g-3">
        <div class="col-md-3">
          <label for="kode_supplier_input" class="form-label">Kode Supplier</label>
          <input type="text" name="kode_supplier" id="kode_supplier_input" class="form-control" placeholder="Kode Supplier" >
        </div>
        <div class="col-md-3">
          <label for="nama_supplier_input" class="form-label">Nama Supplier</label>
          <input type="text" name="nama_supplier" id="nama_supplier_input" class="form-control" placeholder="Nama Supplier" required>
        </div>
        <div class="col-md-4">
          <label for="alamat_input" class="form-label">Alamat</label>
          <input type="text" name="alamat" id="alamat_input" class="form-control" placeholder="Alamat">
        </div>    
        <div class="col-md-2">
          <label for="kontak_input" class="form-label">Kontak</label>
          <input type="text" name="kontak" id="kontak_input" class="form-control" placeholder="Kontak (Telp/HP)">
        </div>
        <div class="col-md-3">
          <label for="email_input" class="form-label">Email</label>
          <input type="email" name="email" id="email_input" class="form-control" placeholder="Email">
        </div>
        <div class="col-md-auto">
          <button type="submit" class="btn btn-success">Simpan</button>
        </div>
        <div class="col-md-auto">
          <button type="button" class="btn btn-secondary" id="btnBatalSupplierForm">Batal</button>
        </div>
      </form>
    </div>
  </div>

  <hr class="my-4">

  <div class="d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Daftar Supplier</h5>
    </div>

  <table class="table table-bordered table-striped mt-3">
    <thead class="table-dark">
      <tr>
        <th>Kode Supplier</th>
        <th>Nama Supplier</th>
        <th>Alamat</th>
        <th>Kontak</th>
        <th>Email</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody id="daftarSupplier">
      
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
// Fungsi showToast (pastikan ini ada di setiap halaman jika tidak global di index.php)
function showToast(message, type = 'danger') {
  const toastEl = document.getElementById('liveToast');
  const toastBody = document.getElementById('toastBody');

  toastEl.className = `toast align-items-center text-white bg-${type} border-0`;
  toastBody.innerText = message;
  const toast = new bootstrap.Toast(toastEl);
  toast.show();
}

// Fungsi untuk merender tabel supplier
function renderSupplierTable(data) {
    const tbody = $("#daftarSupplier");
    tbody.empty();

    if (data && data.length > 0) {
        let html = "";
        data.forEach(supplier => {
            html += `
                <tr>
                    <td>${supplier.kode_supplier}</td>
                    <td>${supplier.nama_supplier}</td>
                    <td>${supplier.alamat || '-'}</td>
                    <td>${supplier.kontak || '-'}</td>
                    <td>${supplier.email || '-'}</td>
                    <td>
                        <button class="btn btn-warning btn-sm edit-btn"
                            data-kode_supplier="${supplier.kode_supplier}"
                            data-nama_supplier="${supplier.nama_supplier}"
                            data-alamat="${supplier.alamat}"
                            data-kontak="${supplier.kontak}"
                            data-email="${supplier.email}">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                        <button class="btn btn-sm btn-danger delete-btn" data-kode_supplier="${supplier.kode_supplier}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
            `;
        });
        tbody.html(html);
    } else {
        tbody.html(`<tr><td colspan="6" class="text-center">Tidak ada data supplier.</td></tr>`);
    }
    // $('#selectAllSupplier').prop('checked', false); // Jika ada select all
}

$(document).ready(function () {
    const cacheKey = 'supplierData';
    // Fungsi untuk memuat ulang data supplier dengan caching
    function loadSuppliers() {
    const cacheKey = 'supplierData';
        const cachedData = localStorage.getItem(cacheKey);
        const cacheExpiryTime = 5 * 60 * 1000; // 5 menit

        // 1. Coba muat dari cache dulu
        if (cachedData) {
            try {
                const parsedCache = JSON.parse(cachedData);
                if (Date.now() - parsedCache.timestamp < cacheExpiryTime) {
                    console.log('Memuat data supplier dari cache...');
                    renderSupplierTable(parsedCache.data);
                } else {
                    console.log('Cache supplier kadaluarsa, akan diperbarui...');
                    localStorage.removeItem(cacheKey);
                }
            } catch (e) {
                console.error("Gagal parsing cache supplier:", e);
                localStorage.removeItem(cacheKey);
            }
        }

        // 2. Selalu ambil data terbaru dari server di latar belakang
        $.get("./controller.php?action=getAllSuppliers", function (resRaw) {
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
                    console.log('Memperbarui data supplier dari server...');
                    renderSupplierTable(res.data);
                    localStorage.setItem(cacheKey, JSON.stringify({
                        data: res.data,
                        timestamp: Date.now()
                    }));
                } else {
                    console.log('Data supplier tidak berubah, menggunakan data cache yang ada.');
                }

            } else {
                showToast("❌ Gagal ambil data supplier dari server.");
                if (!cachedData) {
                    renderSupplierTable([]);
                }
            }
        }).fail(function() {
            showToast("⚠️ Gagal terhubung ke server untuk data supplier.");
            if (!cachedData) {
                renderSupplierTable([]);
            }
        });
    }

    // Load awal saat page dibuka
    loadSuppliers();

    let isEdit = false;

    // Fungsi untuk mereset form ke mode "Simpan"
    function resetForm() {
        isEdit = false;
        $('#formSupplier')[0].reset();
        $('input[name="kode_supplier"]').prop('readonly', false);
        $('#formSupplier button[type="submit"]').text('Simpan').removeClass('btn-warning').addClass('btn-success');
        const formCollapse = bootstrap.Collapse.getInstance(document.getElementById('formSupplierCollapse'));
        if (formCollapse) {
             formCollapse.hide(); // Sembunyikan form setelah reset/simpan
        }
    }

    // Event listener untuk tombol Edit
    $(document).on('click', '.edit-btn', function () {
        isEdit = true;
        $('input[name="kode_supplier"]').prop('readonly', true); // Kode tidak bisa diubah saat edit

        const kode_supplier = $(this).data('kode_supplier');
        const nama_supplier = $(this).data('nama_supplier');
        const alamat = $(this).data('alamat');
        const kontak = $(this).data('kontak');
        const email = $(this).data('email');

        // Isi form dengan data yang diklik
        $('input[name="kode_supplier"]').val(kode_supplier);
        $('input[name="nama_supplier"]').val(nama_supplier);
        $('input[name="alamat"]').val(alamat);
        $('input[name="kontak"]').val(kontak);
        $('input[name="email"]').val(email);

        // Ganti teks tombol submit dan tampilkan form
        $('#formSupplier button[type="submit"]').text('Update').removeClass('btn-success').addClass('btn-warning');
        const formCollapse = new bootstrap.Collapse(document.getElementById('formSupplierCollapse'), { toggle: false });
        formCollapse.show(); // Tampilkan form edit
    });

    // Event listener untuk tombol Hapus
    $(document).on("click", ".delete-btn", function () {
        const kode_supplier = $(this).data("kode_supplier");
        if (confirm("Yakin ingin menghapus supplier dengan kode: " + kode_supplier + "?")) {
            $.post("./controller.php", { action: "deleteSupplier", kode_supplier: kode_supplier }, function (res) {
                const response = typeof res === "string" ? JSON.parse(res) : res;
                showToast(response.message, response.status === "success" ? "success" : "danger");
                if (response.status === "success") {
                    loadSuppliers();
                }
            }).fail(function() {
                showToast("⚠️ Gagal terhubung ke server untuk menghapus supplier.");
            });
        }
    });

    // Event listener untuk submit form Supplier
    $('#formSupplier').on('submit', function(e) {
        e.preventDefault();
        let actionType = isEdit ? 'updateSupplier' : 'insertSupplier';
        const formData = $(this).serialize() + `&action=${actionType}`;
        
        $.post("./controller.php", formData, function(response) {
            const res = JSON.parse(response);
            showToast(res.message, res.status === "success" ? "success" : "danger");

            if (res.status === "success") {
            localStorage.removeItem(cacheKey);
                loadSuppliers(); // Muat ulang data setelah sukses
                resetForm(); // Reset dan sembunyikan form
            }
        }).fail(function() {
            showToast("⚠️ Gagal terhubung ke server untuk menyimpan/memperbarui supplier.");
        });
    });

    // Event listener untuk tombol Batal
    $('#btnBatalSupplierForm').on('click', function() {
        resetForm();
    });

});
</script>
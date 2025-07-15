<?php
// Koneksi database
include 'controller.php';
?>

    <div class="container mt-4">
        <h2>Daftar Pembelian</h2>

        <!-- Form Pembelian -->
        <form id="formPembelian">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" class="form-control" name="kode_supplier" id="kode_supplier" placeholder="Kode Supplier" required>
                </div>
                <div class="col-md-4">
                    <input type="number" class="form-control" name="total_biaya" id="total_biaya" placeholder="Total Biaya" required>
                </div>
                <div class="col-md-4">
                    <select name="status_pembelian" id="status_pembelian" class="form-control">
                        <option value="pending">Pending</option>
                        <option value="lunas">Lunas</option>
                    </select>
                </div>
                <div class="col-md-4 mt-2">
                    <button type="submit" class="btn btn-primary w-100">Tambah Pembelian</button>
                </div>
            </div>
        </form>

        <hr>

        <!-- Tabel Pembelian -->
        <h4>Detail Pembelian</h4>
        <table class="table table-bordered mt-3" id="tablePembelian">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Kode Supplier</th>
                    <th>Total Biaya</th>
                    <th>Status Pembelian</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="daftarPembelian"></tbody>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            let idPembelian = 0;  // ID untuk transaksi pembelian (bisa diubah sesuai logika bisnis)

            // Fungsi untuk mengambil data pembelian
            function reloadPembelian() {
                $.get("./controller.php?action=getPembelian", function(response) {
                    const res = JSON.parse(response);
                    if (res.status === "success") {
                        let html = "";
                        res.data.forEach((item, index) => {
                            html += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${item.kode_supplier}</td>
                                <td>${parseFloat(item.total_biaya).toLocaleString()}</td>
                                <td>${item.status_pembelian}</td>
                                <td>
                                    <button class="btn btn-info btn-sm edit-btn" data-id="${item.id_pembelian}">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </button>
                                    <button class="btn btn-danger btn-sm delete-btn" data-id="${item.id_pembelian}">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </td>
                            </tr>`;
                        });
                        $("#daftarPembelian").html(html);
                    } else {
                        alert("Gagal memuat data pembelian");
                    }
                });
            }

            // Panggil reload data saat pertama kali dibuka
            reloadPembelian();

            // Fungsi untuk menambah pembelian
            $('#formPembelian').on('submit', function(e) {
                e.preventDefault();

                const kode_supplier = $('#kode_supplier').val();
                const total_biaya = $('#total_biaya').val();
                const status_pembelian = $('#status_pembelian').val();

                if (!kode_supplier || !total_biaya) {
                    alert("Harap isi semua data");
                    return;
                }

                // Kirim data ke controller.php untuk menambah pembelian
                $.post("./controller.php", {
                    action: 'insertPembelian',
                    kode_supplier: kode_supplier,
                    total_biaya: total_biaya,
                    status_pembelian: status_pembelian
                }, function(response) {
                    const res = JSON.parse(response);
                    if (res.status === "success") {
                        reloadPembelian();  // Reload data setelah berhasil menambah
                        $('#formPembelian')[0].reset();  // Reset form
                    } else {
                        alert("Gagal menambah pembelian");
                    }
                });
            });

            // Fungsi untuk menghapus pembelian
            $(document).on('click', '.delete-btn', function() {
                const id_pembelian = $(this).data('id');
                if (confirm("Yakin ingin menghapus pembelian ini?")) {
                    $.post("./controller.php", { action: "deletePembelian", id_pembelian: id_pembelian }, function(response) {
                        const res = JSON.parse(response);
                        if (res.status === "success") {
                            reloadPembelian();
                        } else {
                            alert("Gagal menghapus pembelian");
                        }
                    });
                }
            });

            // Fungsi untuk mengedit pembelian
            $(document).on('click', '.edit-btn', function() {
                const id_pembelian = $(this).data('id');
                // Implementasi edit bisa mengisi form dengan data yang sesuai berdasarkan ID pembelian
                // Fungsi edit lanjutkan sesuai kebutuhan
            });
        });
    </script>

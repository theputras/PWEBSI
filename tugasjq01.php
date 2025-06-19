<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Kasir Sederhana</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light text-dark">

<div class="container my-5">
    <div class="card shadow rounded-4">
        <div class="card-body">
            <h2 class="card-title mb-4 text-primary">🛒 Aplikasi Kasir Sederhana</h2>
            <form id="formKasir" class="mb-4">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label for="kode" class="form-label">Kode</label>
                        <input type="text" class="form-control" id="kode" placeholder="Masukkan Kode">
                    </div>
                    <div class="col-md-3">
                        <label for="nama" class="form-label">Nama Barang</label>
                        <input type="text" class="form-control" id="nama" placeholder="Nama Barang">
                    </div>
                    <div class="col-md-3">
                        <label for="satuan" class="form-label">Satuan</label>
                        <input type="text" class="form-control" id="satuan" placeholder="Contoh: pcs, dus">
                    </div>
                    <div class="col-md-2">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" class="form-control" id="harga" placeholder="Harga">
                    </div>
                    <div class="col-md-1 d-flex align-items-end">
                        <button type="submit" id="tambah" class="btn btn-success w-100">
                            <i class="bi bi-plus-circle"></i>
                        </button>
                    </div>
                </div>
            </form>
</form>

    <table class="table table-bordered table-striped">
        <thead class="table-primary">
            <tr>
                <th>Action</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Satuan</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody id="tableData">
            <!-- Data akan ditambahkan di sini -->
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4"><b>Total</b></td>
                <td id="totalHarga" class="text-end">0</td>
            </tr>
            <tr>
                <td colspan="4"><b>Diskon (%)</b></td>
                <td><input type="number" id="diskon" value="0" min="0" max="100" class="form-control"></td>
            </tr>
            <tr>
                <td colspan="4"><b>PPN (%)</b></td>
                <td><input type="number" id="ppn" value="0" min="0" max="100" class="form-control"></td>
            </tr>
            <tr>
                <td colspan="4"><b>Grand Total</b></td>
                <td id="grandTotal" class="text-end">0</td>
            </tr>
            <tr>
                <td colspan="4"><b>Bayar</b></td>
                <td><input type="number" id="bayar" value="0" class="form-control"></td>
            </tr>
            <tr>
                <td colspan="4"><b>Kembali</b></td>
                <td id="kembali" class="text-end">0</td>
            </tr>
        </tfoot>
    </table>
</div>


    <script>
       $(document).ready(function() {

var totalHarga = 0;

// Fungsi untuk memperbarui grand total
function GrandTotal() {
    var diskon = parseFloat($("#diskon").val()) || 0;
    var ppn = parseFloat($("#ppn").val()) || 0;

    var diskonAmount = totalHarga * (diskon / 100);
    var ppnAmount = totalHarga * (ppn / 100);

    var grandTotal = totalHarga - diskonAmount + ppnAmount;

    // Update total dan grand total
    $('#totalHarga').text(totalHarga);
    $('#grandTotal').text(grandTotal);

    // Update Kembali
    var bayar = parseFloat($("#bayar").val()) || 0;
    var kembali = bayar - grandTotal;
    $('#kembali').text(kembali);
}

// Handle delete item
$('#tableData').on('click', '.delete', function() {
    var row = $(this).closest('tr');
    var harga = parseFloat(row.find('td:eq(4)').text());
    totalHarga -= harga;  // Kurangi harga dari total
    GrandTotal();  // Update Grand Total
    row.remove();
});

// Fungsi untuk mengecek apakah input valid
function checkInputs() {
    var kode = $("#kode").val();
    var nama = $("#nama").val();
    var satuan = $("#satuan").val();
    var harga = $("#harga").val();
    
    // Jika ada input yang kosong, disable tombol tambah
    if (kode && nama && satuan && harga) {
        $("#tambah").prop('disabled', false);  // Enable tombol
    } else {
        $("#tambah").prop('disabled', true);  // Disable tombol
    }
}

// Handle add item
$("#tambah").click(function() {
    var kode = $("#kode").val();
    var nama = $("#nama").val();
    var satuan = $("#satuan").val();
    var harga = parseFloat($("#harga").val()) || 0;  // Jika harga tidak valid (NaN), set harga ke 0
    
    totalHarga += harga;  // Tambahkan harga ke total
    $("#tableData").append(
        "<tr>" +
        "<td align='center'><button class='delete'>Delete</button></td>" +
        "<td>" + kode + "</td><td>" + nama + "</td><td>" + satuan + "</td><td>" + harga + "</td>" +
        "</tr>");
    GrandTotal();  // Update Grand Total

    // Clear input fields after adding
    $("#kode").val('');
    $("#nama").val('');
    $("#satuan").val('');
    $("#harga").val('');
    checkInputs();  // Check if inputs are empty to disable/enable the button
});

// Recalculate Grand Total when Diskon or PPN is changed
$("#diskon, #ppn, #bayar").on('input', function() {
    GrandTotal();
});

// Check input fields when they are changed
$("#kode, #nama, #satuan, #harga").on('input', function() {
    checkInputs();  // Check if all inputs are filled
});

// Initial check to disable button if any field is empty
checkInputs();

});

    </script>
</body>
</html>
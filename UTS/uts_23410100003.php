<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Kasir 23410100003</title>
    <script src="./index.js"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light text-dark">

<main id="kasir" class="mt-4">
<div class="container my-5">
    <div class="card shadow rounded-4">
        <div class="card-body" style="background-color: #e6f3e6;">
            <h2 class="card-title mb-4 text-primary">🛒 Aplikasi Kasir Sederhana</h2>
            
<!-- Tombol untuk membuka modal Inventory -->


<form id="formKasir" class="mb-4">
    <div class="row g-2 align-items-center">
        <div class="col-md-1">
            <input type="text" class="form-control" id="kode" placeholder="Kode" data-bs-toggle="modal" data-bs-target="#barangListModal">
        </div>
        <div class="col-md-1">
            <input type="text" class="form-control" id="nama" placeholder="Nama Barang">
        </div>
        <div class="col-md-1">
            <input type="number" class="form-control" id="jumlah" value="1" min="1" placeholder="Jumlah">
        </div>
        <div class="col-md-1">
            <input type="text" class="form-control" id="satuan" placeholder="Satuan">
        </div>
        <div class="col-md-1">
            <input type="number" class="form-control" id="harga" placeholder="Harga" min="0">
        </div>
        <div class="col-md-1">
            <input type="number" class="form-control" id="diameter" placeholder="Diameter" value="1" min="1">
        </div>
        <div class="col-md-1">
            <input type="number" class="form-control" id="tinggi" placeholder="Tinggi" value="1" min="1">
        </div>
        <div class="col-md-2">
            <div class="alert alert-info text-center" id="luas-permukaan-total">Luas Permukaan Total: 0 cm²</div>
        </div>
    
        <div class="col-md-2">
            <div class="input-group">
                <span class="input-group-text">Subtotal</span>
                <span class="form-control" id="subtotal">Rp 0</span>
                <input type="hidden" id="subtotal-hidden" value="0">
            </div>
        </div>
        <div class="col-md-auto">
            <button type="submit" id="tambah" class="btn btn-success">
                <i class="bi bi-plus-circle"></i>
            </button>
        </div>
    </div>
</form>


<table class="table table-bordered table-striped">
    <thead class="table-primary">
        <tr>
                <th>Aksi</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Satuan</th>
                            <th>Diameter</th>
                            <th>Tinggi</th>
                            <th>Luas Permukaan</th>
                            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody id="tableData">
        <!-- Data akan ditambahkan di sini -->
    </tbody>
    <tfoot id="perhtunganTabel">
        
        </tfoot>
    </table>
  <div id="grandTotal" class="">Grand Total: 0</div>
</main>

</div>


    <!-- <script>
     
 $(document).ready(function() {
    // Declare totalHarga in a broader scope
    var totalHarga = 0;

    // Define GrandTotal function
    function GrandTotal() {
        // Calculate total from table rows
        totalHarga = 0;
        $("#tableData tr").each(function() {
            // Get subtotal from the last column (index 9)
            var subtotal = parseFloat($(this).find('td:eq(9)').text()) || 0;
            totalHarga += subtotal;
        });

        // Get discount and tax values (default to 0 if not entered)
        var diskon = parseFloat($("#diskon").val()) || 0;
        var ppn = parseFloat($("#ppn").val()) || 0;

        // Calculate discount amount
        var diskonAmount = totalHarga * (diskon / 100);
        
        // Calculate tax amount
        var ppnAmount = totalHarga * (ppn / 100);

        // Calculate grand total
        var grandTotal = totalHarga - diskonAmount + ppnAmount;

        // Update displays
        $('#totalHarga').text(totalHarga.toFixed(2));
        $('#grandTotal').text(grandTotal.toFixed(2));

        // Calculate change if payment is made
        var bayar = parseFloat($("#bayar").val()) || 0;
        var kembali = bayar - grandTotal;
        $('#kembali').text(kembali.toFixed(2));
    }

    // Function to check if item code already exists  
    function isItemCodeExists(kode) {  
        let exists = false;  
        $("#tableData tr").each(function() {  
            // Check the kode column (index 1)  
            if ($(this).find('td:eq(1)').text() === kode) {  
                exists = true;  
                return false; // Break the loop  
            }  
        });  
        return exists;  
    }  

    // Handle delete item
    $('#tableData').on('click', '.delete', function() {
        var row = $(this).closest('tr');
        row.remove();
        GrandTotal();  // Ensure GrandTotal is called after removing the row
    });

    // Handle add item
    $("#tambah").off("click").on("click", function (e) {
        e.preventDefault(); // Prevent form submission

        const kode = $("#kode").val();
        const nama = $("#nama").val();
        const satuan = $("#satuan").val();
        const harga = parseFloat($("#harga").val()) || 0;
        const jumlah = parseInt($("#jumlah").val()) || 1;
        const diameter = parseFloat($("#diameter").val()) || 1;
        const tinggi = parseFloat($("#tinggi").val()) || 1;
     // Check for duplicate item code
      if (isItemCodeExists(kode)) {
    // Show standard JavaScript alert
    alert(`Barang dengan kode ${kode} sudah ada dalam daftar!`);
    return; // Stop further execution
}


        const luas = hitungLuasPermukaanTabung(diameter, tinggi).toFixed(2);
        const subtotal = (harga * jumlah * luas).toFixed(2);

        // Tambahkan ke tabel
        $("#tableData").append(
            "<tr>" +
            "<td><button class='delete btn btn-sm btn-danger'>Hapus</button></td>" +
            "<td>" + kode + "</td>" +
            "<td>" + nama + "</td>" +
            "<td>" + harga + "</td>" +
            "<td>" + jumlah + "</td>" +
            "<td>" + satuan + "</td>" +
            "<td>" + diameter + "</td>" +
            "<td>" + tinggi + "</td>" +
            "<td>" + luas + "</td>" +
            "<td>" + subtotal + "</td>" +
            "</tr>"
        );

        // Reset input
        $("#kode, #nama, #satuan, #harga, #jumlah, #diameter, #tinggi").val('');

        // Update Grand Total
        GrandTotal();

        // Validasi ulang input
        checkInputs();
    });

    // Ensure GrandTotal is called on various events
    $("#diskon, #ppn, #bayar").on('input', function() {
        GrandTotal();
    });

    // Function to check inputs
    function checkInputs() {
        var kode = $("#kode").val();
        var nama = $("#nama").val();
        var satuan = $("#satuan").val();
        var harga = $("#harga").val();

        if (kode && nama && satuan && harga) {
            $("#tambah").prop('disabled', false);
        } else {
            $("#tambah").prop('disabled', true);
        }
    }

    // Initial input check
    checkInputs();
});

// Function outside document ready (if needed separately)
function hitungLuasPermukaanTabung(d, t) {
    const r = d / 2;
    return 2 * Math.PI * r * (r + t); // 2πr(r + t)
}


// Pilih barang dari list
$(document).on('click', '.pilih-barang', function() {
    const kode = $(this).data('kode');
    const nama = $(this).data('nama');
    const satuan = $(this).data('satuan');
    const harga = $(this).data('harga');
    $("#kode").val(kode);
    $("#nama").val(nama);
    $("#satuan").val(satuan);
    $("#harga").val(harga);
    $("#barangListModal").modal('hide');
    checkInputs();
});

function checkInputs() {
    var kode = $("#kode").val();
    var nama = $("#nama").val();
    var satuan = $("#satuan").val();
    var harga = $("#harga").val();

    if (kode && nama && satuan && harga) {
        $("#tambah").prop('disabled', false);
    } else {
        $("#tambah").prop('disabled', true);
    }
}


</script> -->




<!-- Modal List Barang -->
<div class="modal fade" id="barangListModal" tabindex="-1" aria-labelledby="barangListModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="barangListModalLabel">Pilih Barang</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <table class="table table-striped">
          <thead class="table-dark">
            <tr>
              <th>Kode</th>
              <th>Nama</th>
              <th>Satuan</th>
              <th>Harga</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody id="listBarang">
            <tr>
              <td>BRG001</td>
              <td>Sabun</td>
              <td>pcs</td>
              <td>3000</td>
              <td><button class="btn btn-sm btn-success pilih-barang" data-kode="BRG001" data-nama="Sabun" data-satuan="pcs" data-harga="3000">Pilih</button></td>
            </tr> 
            <tr>
              <td>BRG003</td>
              <td>Beras</td>
              <td>kg</td>
              <td>300000</td>
              <td><button class="btn btn-sm btn-success pilih-barang" data-kode="BRG003" data-nama="Beras" data-satuan="kg" data-harga="300000">Pilih</button></td>
            </tr>
            <tr>
              <td>BRG002</td>
              <td>Sampo</td>
              <td>btl</td>
              <td>12000</td>
              <td><button class="btn btn-sm btn-success pilih-barang" data-kode="BRG002" data-nama="Sampo" data-satuan="btl" data-harga="12000">Pilih</button></td>
            </tr>
            <tr>
              <td>BRG004</td>
              <td>Samsung Galaxy S25 Ultra</td>
              <td>pcs</td>
              <td>25000000</td>
              <td><button class="btn btn-sm btn-success pilih-barang" data-kode="BRG004" data-nama="Samsung Galaxy S25 Ultra" data-satuan="pcs" data-harga="25000000">Pilih</button></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</body>
</html>
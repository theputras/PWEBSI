<!DOCTYPE html>
<html lang="id"> <!-- Menentukan bahwa dokumen ini adalah HTML dan bahasa yang digunakan adalah Bahasa Indonesia -->
<head>
  <meta charset="UTF-8"> <!-- Menentukan karakter encoding untuk dokumen -->
  <title>BON UTANG</title> <!-- Judul halaman yang akan ditampilkan di tab browser -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"> <!-- Menghubungkan file CSS Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet"> <!-- Menghubungkan file CSS untuk ikon Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script> <!-- Menghubungkan file JavaScript Bootstrap -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Menghubungkan jQuery untuk manipulasi DOM -->

  <script>
    $(document).ready(function() { // Menunggu hingga dokumen siap
      // Ketika tombol "Pilih" di modal diklik
      $(document).on('click', '.pilih-barang', function() {
        var kode = $(this).data('kode'); // Mengambil data kode dari tombol yang diklik
        var nama = $(this).data('nama'); // Mengambil data nama dari tombol yang diklik
        var harga = $(this).data('harga'); // Mengambil data harga dari tombol yang diklik

        // Isi input dengan data yang dipilih
        $('#kode').val(kode); // Mengisi input kode
        $('#nama').val(nama); // Mengisi input nama
        $('#harga').val(harga); // Mengisi input harga

        // Reset subtotal
        updateSubtotal(); // Memperbarui subtotal setelah memilih barang
        
        // Tutup modal
        $('#popupPilihan').modal('hide'); // Menutup modal setelah memilih barang
      });

      // Fungsi untuk menghitung subtotal
      function updateSubtotal() {
        var harga = parseFloat($('#harga').val()) || 0; // Mengambil harga dan mengubahnya menjadi float
        var jumlah = parseInt($('#jumlah').val()) || 0; // Mengambil jumlah dan mengubahnya menjadi integer
        var panjang = parseFloat($('#panjang').val()) || 0; // Mengambil panjang
        var lebar = parseFloat($('#lebar').val()) || 0; // Mengambil lebar
        var tinggi = parseFloat($('#tinggi').val()) || 0; // Mengambil tinggi

        // Menghitung keliling luas permukaan
        var kelilingLuasPermukaan = 2 * (panjang * lebar + panjang * tinggi + lebar * tinggi); // Menghitung keliling luas permukaan
        var subtotal = harga * jumlah * kelilingLuasPermukaan; // Menghitung subtotal

        // Tampilkan subtotal live
        $('#subtotal').text(subtotal.toFixed(2)); // Menampilkan subtotal dengan 2 desimal
      }

      // Event listener untuk input yang mempengaruhi subtotal
      $('#jumlah, #panjang, #lebar, #tinggi').on('input', function() {
        updateSubtotal(); // Memperbarui subtotal setiap kali input berubah
      });

      $('#tambah').click(function() { // Ketika tombol tambah diklik
        var kode = $('#kode').val(); // Mengambil kode
        var nama = $('#nama').val(); // Mengambil nama
        var harga = parseFloat($('#harga').val()); // Mengambil harga
        var jumlah = parseInt($('#jumlah').val()); // Mengambil jumlah
        var panjang = parseFloat($('#panjang').val()); // Mengambil panjang
        var lebar = parseFloat($('#lebar').val()); // Mengambil lebar
        var tinggi = parseFloat($('#tinggi').val()); // Mengambil tinggi

        // Menghitung keliling luas permukaan
        var kelilingLuasPermukaan = 2 * (panjang * lebar + panjang * tinggi + lebar * tinggi); // Menghitung keliling luas permukaan
        var subtotal = harga * jumlah * kelilingLuasPermukaan; // Menghitung subtotal

        // Menambahkan data ke tabel
        $('#tabledata tbody').append(`
          <tr>
            <td><button class="btn btn-danger btn-sm hapus">Hapus</button></td> <!-- Tombol hapus -->
            <td>${kode}</td> <!-- Menampilkan kode -->
            <td>${nama}</td> <!-- Menampilkan nama -->
            <td>${harga}</td> <!-- Menampilkan harga -->
            <td>${jumlah}</td> <!-- Menampilkan jumlah -->
            <td>${panjang}</td> <!-- Menampilkan panjang -->
            <td>${lebar}</td> <!-- Menampilkan lebar -->
            <td>${tinggi}</td> <!-- Menampilkan tinggi -->
            <td>${kelilingLuasPermukaan}</td> <!-- Menampilkan keliling luas permukaan -->
            <td>${subtotal}</td> <!-- Menampilkan subtotal -->
          </tr>
        `);

        // Menghitung grand total, total jumlah, dan total luas permukaan
        var grandTotal = 0; // Inisialisasi grand total
        var totalJumlah = 0; // Inisialisasi total jumlah
        var totalLuasPermukaan = 0; // Inisialisasi total luas permukaan

        $('#tabledata tbody tr').each(function() { // Menghitung total dari setiap baris
          grandTotal += parseFloat($(this).find('td:last').text()); // Menambahkan subtotal ke grand total
          totalJumlah += parseInt($(this).find('td:nth-child(5)').text()); // Menambahkan jumlah ke total jumlah
          totalLuasPermukaan += parseFloat($(this).find('td:nth-child(9)').text()); // Menambahkan luas permukaan ke total luas permukaan
        });

        $('#hasil').text(grandTotal); // Menampilkan grand total
        $('#totalJumlah').text(totalJumlah); // Menampilkan total jumlah
        $('#totalLuasPermukaan').text(totalLuasPermukaan); // Menampilkan total luas permukaan

        // Reset subtotal display
        $('#subtotal').text('0.00'); // Mengatur subtotal kembali ke 0
      });

      // Menghapus baris ketika tombol hapus diklik
      $(document).on('click', '.hapus', function() { // Ketika tombol hapus diklik
        $(this).closest('tr').remove(); // Menghapus baris yang sesuai
        var grandTotal = 0; // Inisialisasi grand total
        var totalJumlah = 0; // Inisialisasi total jumlah
        var totalLuasPermukaan = 0; // Inisialisasi total luas permukaan

        $('#tabledata tbody tr').each(function() { // Menghitung grand total setelah penghapusan
          grandTotal += parseFloat($(this).find('td:last').text()); // Menambahkan subtotal ke grand total
          totalJumlah += parseInt($(this).find('td:nth-child(5)').text()); // Menambahkan jumlah ke total jumlah
          totalLuasPermukaan += parseFloat($(this).find('td:nth-child(9)').text()); // Menambahkan luas permukaan ke total luas permukaan
        });

        $('#hasil').text(grandTotal); // Menampilkan grand total
        $('#totalJumlah').text(totalJumlah); // Menampilkan total jumlah
        $('#totalLuasPermukaan').text(totalLuasPermukaan); // Menampilkan total luas permukaan
      });
    });
  </script>

  <style>
    .form-label { 
      padding-right: 10px;
    } 
    .input-group {
      padding: 0 15px; 
    }
  </style>
</head>

<body class="p-4"> <!-- Memberikan padding pada body -->
  <div class="card"> <!-- Membuat kartu untuk konten -->
    <div class="card-header bg-success text-white text-center"> <!-- Header kartu -->
      <h4>BON UTANG</h4> <!-- Judul di header -->
    </div>
    
    <div class="card-body"> <!-- Bagian utama dari kartu -->
      <div class="row mb-3"> <!-- Baris untuk input barang -->
        <div class="col-sm-2"> <!-- Kolom untuk kode barang -->
          <div class="input-group"> <!-- Grup input untuk kode barang -->
            <input type="text" class="form-control" id="kode" placeholder="*Kode" readonly> <!-- Input untuk kode barang -->
            <button class="btn btn-outline-secondary" type="button" data-bs-toggle="modal" data-bs-target="#popupPilihan"> <!-- Tombol untuk membuka modal -->
              <i class="bi bi-search"></i> <!-- Ikon pencarian -->
            </button>
          </div>
        </div>
        <div class="col-sm-2"> <!-- Kolom untuk nama barang -->
          <input type="text" class="form-control" id="nama" placeholder="Nama"> <!-- Input untuk nama barang -->
        </div>
        <div class="col-sm-1"> <!-- Kolom untuk harga barang -->
          <input type="number" class="form-control" id="harga" placeholder="Harga"> <!-- Input untuk harga barang -->
        </div>
        <div class="col-sm-1"> <!-- Kolom untuk jumlah barang -->
          <input type="number" class="form-control" id="jumlah" placeholder="Jumlah" value="1"> <!-- Input untuk jumlah barang -->
        </div>
        <div class="col-sm-1"> <!-- Kolom untuk panjang -->
          <input type="number" class="form-control" id="panjang" placeholder="Panjang" value="1"> <!-- Input untuk panjang -->
        </div>
        <div class="col-sm-1"> <!-- Kolom untuk lebar -->
          <input type="number" class="form-control" id="lebar" placeholder="Lebar" value="1"> <!-- Input untuk lebar -->
        </div>
        <div class="col-sm-1"> <!-- Kolom untuk tinggi -->
          <input type="number" class="form-control" id="tinggi" placeholder="Tinggi" value="1"> <!-- Input untuk tinggi -->
        </div>
        <div class="col-sm-2"> <!-- Kolom untuk subtotal -->
          <label for="subtotal" class="form-label">Subtotal:</label> <!-- Label untuk subtotal -->
          <span id="subtotal">0.00</span> <!-- Menampilkan subtotal -->
        </div>
        <div class="col-sm-1"> <!-- Kolom untuk tombol tambah -->
          <button id="tambah" class="btn btn-success w-100">+</button> <!-- Tombol untuk menambah barang ke tabel -->
        </div>
      </div>

      <table id="tabledata" class="table table-bordered table-striped"> <!-- Tabel untuk menampilkan data barang -->
        <thead class="table-success"> <!-- Bagian header tabel -->
          <tr>
            <th>Aksi</th> <!-- Kolom untuk aksi (hapus) -->
            <th>Kode</th> <!-- Kolom untuk kode barang -->
            <th>Nama</th> <!-- Kolom untuk nama barang -->
            <th>Harga</th> <!-- Kolom untuk harga barang -->
            <th>Jumlah</th> <!-- Kolom untuk jumlah barang -->
            <th>Panjang</th> <!-- Kolom untuk panjang -->
            <th>Lebar</th> <!-- Kolom untuk lebar -->
            <th>Tinggi</th> <!-- Kolom untuk tinggi -->
            <th>Luas Permukaan</th> <!-- Kolom untuk luas permukaan -->
            <th>Subtotal</th> <!-- Kolom untuk subtotal -->
          </tr>
        </thead>
        <tbody></tbody> <!-- Bagian tubuh tabel yang akan diisi dengan data -->
        <tfoot>
          <tr>
            <th colspan="4" class="text-end">Total Jumlah</th> <!-- Menampilkan total jumlah -->
            <th id="totalJumlah">0</th> <!-- Menampilkan total jumlah -->
            <th colspan="3" class="text-end">Total Luas Permukaan</th> <!-- Menampilkan total luas permukaan -->
            <th id="totalLuasPermukaan">0</th> <!-- Menampilkan total luas permukaan -->
            <th></th> <!-- Kolom kosong untuk mengisi ruang -->
          </tr>
          <tr>
            <th colspan="8" class="text-end">Grand Total</th> <!-- Menampilkan grand total -->
            <th id="hasil">0</th> <!-- Menampilkan hasil grand total -->
          </tr>
        </tfoot>
      </table>
    </div>
    
    <div class="card-footer bg-success text-white text-center">UTS PEMROGRAMAN WEB</div> <!-- Footer kartu -->
  </div>

  <div class="modal fade" id="popupPilihan" tabindex="-1"> <!-- Modal untuk memilih produk -->
    <div class="modal-dialog modal-lg"> <!-- Dialog modal dengan ukuran besar -->
      <div class="modal-content"> <!-- Konten modal -->
        <div class="modal-header bg-success text-white"> <!-- Header modal -->
          <h5 class="modal-title">Pilih Produk</h5> <!-- Judul modal -->
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button> <!-- Tombol untuk menutup modal -->
        </div>
        <div class="modal-body"> <!-- Bagian tubuh modal -->
          <table class="table table-bordered"> <!-- Tabel untuk menampilkan produk -->
            <thead>
              <tr>
                <th>Kode</th> <!-- Kolom untuk kode produk -->
                <th>Nama</th> <!-- Kolom untuk nama produk -->
                <th>Harga</th> <!-- Kolom untuk harga produk -->
                <th>Pilih</th> <!-- Kolom untuk memilih produk -->
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>P001</td> <!-- Kode produk -->
                <td>SEMEN GRESIK</td> <!-- Nama produk -->
                <td>50</td> <!-- Harga produk -->
                <td><button class="btn btn-sm btn-primary pilih-barang" data-kode="P001" data-nama="SEMEN GRESIK" data-harga="50">Pilih</button></td> <!-- Tombol pilih produk -->
              </tr>
              <tr>
                <td>P002</td> <!-- Kode produk -->
                <td>PASIR</td> <!-- Nama produk -->
                <td>150</td> <!-- Harga produk -->
                <td><button class="btn btn-sm btn-primary pilih-barang" data-kode="P002" data-nama="PASIR" data-harga="150">Pilih</button></td> <!-- Tombol pilih produk -->
              </tr>
              <tr>
                <td>P003</td> <!-- Kode produk -->
                <td>BESI 8IN</td> <!-- Nama produk -->
                <td>40</td> <!-- Harga produk -->
                <td><button class="btn btn-sm btn-primary pilih-barang" data-kode="P003" data-nama="BESI 8IN" data-harga="40">Pilih</button></td> <!-- Tombol pilih produk -->
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</body>
</html>

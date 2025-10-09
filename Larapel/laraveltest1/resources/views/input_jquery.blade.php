<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Input Form (jQuery)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Tugas 2: Input Form (Konsep jQuery)</h1>
        <hr>
        
        <form id="form-jquery">
            <div class="mb-3">
                <label for="tgl" class="form-label">Tanggal</label>
                <input type="date" class="form-control" id="tgl" name="tgl" required>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="telp" class="form-label">No. Telepon</label>
                <input type="tel" class="form-control" id="telp" name="telp" required>
            </div>
            <button type="submit" class="btn btn-success">Kirim Data dengan jQuery</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        // Pastikan dokumen siap sebelum menjalankan jQuery
        $(document).ready(function() {
            // Tangkap event submit pada form dengan id 'form-jquery'
            $('#form-jquery').on('submit', function(event) {
                // 1. Mencegah form dikirim secara default (agar halaman tidak refresh)
                event.preventDefault();

                // 2. Ambil semua nilai dari input
                var tgl = $('#tgl').val();
                var nama = $('#nama').val();
                var alamat = $('#alamat').val();
                var telp = $('#telp').val();

                // 3. Bangun URL untuk halaman output dengan parameter
                var baseUrl = "{{ route('jquery.output') }}";
                var redirectUrl = baseUrl + "?tgl=" + encodeURIComponent(tgl) + "&nama=" + encodeURIComponent(nama) + "&alamat=" + encodeURIComponent(alamat) + "&telp=" + encodeURIComponent(telp);

                // 4. Arahkan browser ke URL yang baru
                window.location.href = redirectUrl;
            });
        });
    </script>
</body>
</html>
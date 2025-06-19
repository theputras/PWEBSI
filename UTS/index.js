
(function() {

    
    // Array to track required libraries
    var requiredLibraries = [
        { 
            name: 'jQuery', 
            src: 'https://code.jquery.com/jquery-3.6.0.min.js',
            test: () => typeof window.jQuery !== 'undefined'
        },
        { 
            name: 'Bootstrap', 
            src: 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js',
            test: () => typeof bootstrap !== 'undefined' || (window.bootstrap && window.bootstrap.Modal)
        }
    ];

    // Function to load libraries sequentially
    function loadLibraries(libraries, callback) {
        var currentIndex = 0;

        function loadNext() {
            if (currentIndex >= libraries.length) {
                callback();
                return;
            }

            var lib = libraries[currentIndex];
            
            // Check if library is already loaded
            if (lib.test()) {
                currentIndex++;
                loadNext();
                return;
            }

            // Create script element
            var script = document.createElement('script');
            script.src = lib.src;
            script.onload = function() {
                currentIndex++;
                loadNext();
            };
            script.onerror = function() {
                console.error(`Failed to load ${lib.name}`);
                currentIndex++;
                loadNext();
            };

            document.head.appendChild(script);
        }

        loadNext();
    }

    // Main application initialization function
    function initializeApp() {
        // Use jQuery.noConflict() to avoid conflicts with other libraries
        var $ = jQuery.noConflict();

        // Document ready function
        $(function() {
            // Fungsi Hitung Luas Permukaan Tabung
           function hitungLuasPermukaanTabung(d, t) {
    const r = d / 2;
    // Luas selimut (sisi samping) + 2 luas lingkaran penutup (atas dan bawah)
    return (2 * Math.PI * r * t) + (2 * Math.PI * r * r);
}

 // Fungsi format angka dengan 2 desimal
            function formatNumber(num) {
                return num.toFixed(2);
            }

            // Fungsi update perhitungan
            function updateCalculations() {
                const diameter = parseFloat($("#diameter").val()) || 0;
                const tinggi = parseFloat($("#tinggi").val()) || 0;

                // Hitung radius
                const radius = diameter / 2;

                // Perhitungan detail
                const luasPermukaanTotal = formatNumber(2 * Math.PI * radius * (radius + tinggi));

                // Update tampilan perhitungan
                // $("#luas-alas").text(`Luas Alas: ${luasAlas} cm²`);
                // $("#luas-selimut").text(`Luas Selimut: ${luasSelimut} cm²`);
                $("#luas-permukaan-total").text(`Luas Permukaan Total: ${luasPermukaanTotal} cm²`);

                // Update subtotal
                const harga = parseFloat($("#harga").val()) || 0;
                const jumlah = parseInt($("#jumlah").val()) || 1;
                const subtotal = (harga * jumlah * luasPermukaanTotal).toFixed(2);

                // Tampilkan subtotal di form
                $("#subtotal").text(`Rp ${subtotal}`);
                $("#subtotal-hidden").val(subtotal);
            }

            // [Rest of the previous initialization code]

            // Event listeners untuk update perhitungan
            $("#diameter, #tinggi, #harga, #jumlah").on('input', updateCalculations);

            // [Rest of the previous code]

            // Initial calculations setup
            updateCalculations();

            // Fungsi update subtotal
            function updateSubtotal() {
                const harga = parseFloat($("#harga").val()) || 0;
                const jumlah = parseInt($("#jumlah").val()) || 1;
                const diameter = parseFloat($("#diameter").val()) || 1;
                const tinggi = parseFloat($("#tinggi").val()) || 1;

                const luas = hitungLuasPermukaanTabung(diameter, tinggi).toFixed(2);
                const subtotal = (harga * jumlah * luas).toFixed(2);

                // Tampilkan subtotal di form
                $("#subtotal").text(`Rp ${subtotal}`);
                $("#subtotal-hidden").val(subtotal);
            }

       

            // Fungsi Hitung Grand Total
            function GrandTotal() {
                // Hitung total dari baris tabel
                let grandTotal = 0;
                $("#tableData tr").each(function() {
                    // Ambil subtotal dari kolom terakhir (index 9)
                    var subtotalText  = parseFloat($(this).find('td:eq(9)').text()) || 0;
                    const subtotal = parseFloat(subtotalText) || 0;
                    
                         // Tambahkan ke grand total
                        grandTotal += subtotal;
                });

          
   // Update elemen grand total
    $("#grandTotal").text(`Grand Total: Rp ${grandTotal.toLocaleString('id-ID')}`);
        
            }

            // Fungsi cek apakah kode barang sudah ada
            function isItemCodeExists(kode) {  
                let exists = false;  
                $("#tableData tr").each(function() {  
                    // Cek kolom kode (index 1)  
                    if ($(this).find('td:eq(1)').text() === kode) {  
                        exists = true;  
                        return false; // Hentikan loop  
                    }  
                });  
                return exists;  
            }  

            // Fungsi cek input
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

            // Event listeners untuk update subtotal
            $("#harga, #jumlah, #diameter, #tinggi").on('input', updateSubtotal);

            // Hapus item dari tabel
            $('#tableData').on('click', '.delete', function() {
                var row = $(this).closest('tr');
                row.remove();
                GrandTotal();  // Pastikan GrandTotal dipanggil setelah menghapus baris
            });

            // Tambah item ke tabel
            $("#formKasir").on("submit", function (e) {
                e.preventDefault(); // Cegah submit form

                const kode = $("#kode").val();
                const nama = $("#nama").val();
                const satuan = $("#satuan").val();
                const harga = parseFloat($("#harga").val()) || 0;
                const jumlah = parseInt($("#jumlah").val()) || 1;
                const diameter = parseFloat($("#diameter").val()) || 1;
                const tinggi = parseFloat($("#tinggi").val()) || 1;

                // Cek duplikasi kode barang
                if (isItemCodeExists(kode)) {
                    alert(`Barang dengan kode ${kode} sudah ada dalam daftar!`);
                    return;
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
                    "<td>" + subtotal.toLocaleString('id-ID') + "</td>" +
                    "</tr>"
                );

                // Reset input
                $("#kode, #nama, #satuan, #harga, #jumlah, #diameter, #tinggi").val('');
                $("#subtotal").text('Rp 0');

                // Update Grand Total
                GrandTotal();

                // Validasi ulang input
                checkInputs();
            });

            // Panggil GrandTotal saat input berubah
            $("#diskon, #ppn, #bayar").on('input', function() {
                GrandTotal();
            });

            // Cek input awal
            checkInputs();

            // Pilih barang dari list
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

    // Tutup modal
    $('#barangListModal').modal('hide');

    // Hapus backdrop secara manual
    $('.modal-backdrop').remove();

    

    // Trigger subtotal calculation
    updateSubtotal();
    checkInputs();
});

            // Initial subtotal setup
            updateSubtotal();
        });
    }

    // Start loading libraries
    loadLibraries(requiredLibraries, initializeApp);
})();

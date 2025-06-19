<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body>
<div class="flex flex-col items-center justify-center h-screen bg-[#011024]">
    <h1 class="text-2xl font-bold mb-4 text-white">Kalkulator Sederhana</h1>
    <div id="kalkulator" class="bg-[#011b3d] p-6 rounded shadow-md w-full max-w-sm">
        <label for="nilai1" class="block text-white mb-2">Nilai 1</label>
        <input placeholder="Nilai 1" type="number" id="nilai1" name="nilai1" required class="rounded-[10px] text-white border bg-[#0b2952] border-[#042a5c] p-2 rounded w-full mb-4">
        <label for="nilai1" class="block text-white mb-2">Nilai 2</label>
        <input placeholder="Nilai 2" type="number" id="nilai2" name="nilai2" required class="rounded-[10px] text-white border bg-[#0b2952] border-[#042a5c] p-2 rounded w-full mb-4">
        <button type="button" onclick="kali()" class="bg-blue-500 text-white py-2 px-4 rounded">✖️</button>
        <button type="button" onclick="bagi()" class="bg-blue-500 text-white py-2 px-4 rounded mt-4">➗</button>
        <button type="button" onclick="tambah()" class="bg-blue-500 text-white py-2 px-4 rounded mt-4">➕</button>
        <button type="button" onclick="kurang()" class="bg-blue-500 text-white py-2 px-4 rounded mt-4">➖</button>
        <button type="button" onclick="luaslingkaran()" class="bg-blue-500 text-white py-2 px-4 rounded mt-4">Luas Lingkaran</button>
        <button type="button" onclick="hapus()" class="bg-red-500 text-white py-2 px-4 rounded mt-4">Hapus</button>
        <button type="button" onclick="keluar()" class="bg-red-500 text-white py-2 px-4 rounded mt-4">Keluar</button>
        <button type="button" onclick="tampil()" class="bg-red-500 text-white py-2 px-4 rounded mt-4">tampil</button>
        
</div>
        
    <span id="hasil" class="mt-4 text-lg text-white">Hasil</span>

</div>

    <script>
   function getNilai() {
        // Mengambil nilai terbaru dari input
        var nilai1 = parseFloat(document.getElementById("nilai1").value);
        var nilai2 = parseFloat(document.getElementById("nilai2").value);
        return { nilai1, nilai2 };
    }

const x = ["java", "javascript", "python", "php", "html", "css"];

    function tampil() {
        document.getElementById("hasil").textContent = "Hasil: " + x.join(", ");
    }
    function kali() {
        var { nilai1, nilai2 } = getNilai();
        var hasil = nilai1 * nilai2;
        document.getElementById("hasil").textContent = "Hasil: " + hasil;
    }

    function bagi() {
        var { nilai1, nilai2 } = getNilai();
        var hasil = nilai1 / nilai2;
        document.getElementById("hasil").textContent = "Hasil: " + hasil;
    }
    function luaslingkaran() {
        var { nilai1, nilai2 } = getNilai();
        var hasil = nilai1 * Math.PI;
        document.getElementById("hasil").textContent = "Hasil: " + hasil.toFixed(2);
    }

    function tambah() {
        var { nilai1, nilai2 } = getNilai();
        var hasil = nilai1 + nilai2;
        document.getElementById("hasil").textContent = "Hasil: " + hasil;
    }

    function kurang() {
        var { nilai1, nilai2 } = getNilai();
        var hasil = nilai1 - nilai2;
        document.getElementById("hasil").textContent = "Hasil: " + hasil;
    }
    
    function hapus() {
        // Menghapus nilai pada input Nilai 1 dan Nilai 2
        document.getElementById("nilai1").value = "";
        document.getElementById("nilai2").value = "";
        // Menghapus hasil perhitungan
        document.getElementById("hasil").textContent = "Hasil";
    }

    function keluar() {
        // Mengarahkan halaman ke latihanjs01.php
        window.location.href = "latihanjs01.php";
    }
        </script>
</body>
</html>
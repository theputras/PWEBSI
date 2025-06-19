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
        <input placeholder="baris" id="baris" name="baris" required class="rounded-[10px] text-white border bg-[#0b2952] border-[#042a5c] p-2 rounded w-full mb-4">
        <input placeholder="kolom" id="kolom" name="kolom" required class="rounded-[10px] text-white border bg-[#0b2952] border-[#042a5c] p-2 rounded w-full mb-4">
        <input placeholder="Nilai 1" id="nilai" name="nilai" required class="rounded-[10px] text-white border bg-[#0b2952] border-[#042a5c] p-2 rounded w-full mb-4">
        <button type="button" onclick="tampil()" class="bg-red-500 text-white py-2 px-4 rounded mt-4">tampil</button>
        <button type="button" onclick="isi()" class="bg-red-500 text-white py-2 px-4 rounded mt-4">Isi</button>
        
</div>
        
    <span id="hasil" class="mt-4 text-lg text-white">Hasil</span>

</div>

    <script>


const x = [2] [3];

    function isi() {
        var b;
        var k;
        var n;
        b = document.getElementById("baris").value;
        k = document.getElementById("kolom").value;
        n = document.getElementById("nilai").value;
        x[b] [k] = n;
    }
    
    function tampil() {
    
        var text;
        for(let i = 0; i < 3; i++)
            for(let j = 0; j < 4; j++){
                text = text + x[i] [j];
                console.log(text);
            }
        
        document.getElementById("hasil").textContent = "Hasil: " + text;
    }
        </script>
</body>
</html>
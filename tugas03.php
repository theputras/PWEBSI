<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Barang</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f5f5f5;
        }

        .container {
            background-color: #d1d1d1;
            border-radius: 10px;
            padding: 30px 40px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 25px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid ;
            border-radius: 5px;
            height: 50px;
        }

        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield; /* Firefox */
        }

        button {
            padding: 10px;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            background-color: rgb(136, 136, 136);
            color: white;
            font-size: 16px;
        }
        
    
        button:hover {
            background-color: #bcbcbc;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Data Barang</h1>
        <form action="proses.php" method="post">
            <label for="kode">Kode</label>
            <input type="number" id="kode" name="kode" placeholder="Masukkan kode">

            <label for="nama">Nama</label>
            <input type="text" id="nama" name="nama" placeholder="Masukkan nama barang">

            <label for="satuan">Satuan</label>
            <input type="number" id="satuan" name="satuan" placeholder="Masukkan satuan (misal: pcs, kg)">

            <label for="harga">Harga</label>
            <input type="number" id="harga" name="harga" placeholder="Masukkan harga">

            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JS</title>
</head>
<body>
<h1>Hello World</h1>
<p id="pertama">test web</p>
<button id="rubah" onclick="fungsipertama()"> Ubah</button>
<button id="info" onclick="fungsiinfo()">INfo</button>
<button id="infoconsole" onclick="fungsiconsole()">INfo Console</button>
    <script>
    function fungsipertama(){
    document.getElementById("pertama").innerHTML = "I LOVE CSS";
    }
    
    function fungsiinfo(){
        window.alert("Selamat datang su");
        
        }
    function fungsiconsole(){
        console.log("Selamat datang di console");
    }
    </script>
</body>
</html>
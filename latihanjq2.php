<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>latihan jq 2</title>
    <script src="jquery.min.js"></script>
</head>
<body>
    <form action="">
    
      <Label>Nilai 1</Label>
    <input type="number" name="" id="n1" placeholder="Nilai 1">   
    <Label>Nilai 2</Label>
    <input type="number" name="" id="n2" placeholder="Nilai 2">   
    <button type="button" id="tambah">+</button>
    <Label>Hasil</Label>
    <input type="text" name="" id="hasil" placeholder="hasil" readonly>
    
    
    </form>
  
    
    
    <script>
   $(document).ready(function() {
        $("#tambah").click(function() {
            var n1 = parseInt($("#n1").val());
            var n2 = parseInt($("#n2").val());
            var hasil = n1 + n2;
            $("#hasil").val(hasil);
            return false;
        });
    });
    
    </script>
</body>
</html>
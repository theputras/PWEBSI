<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>latihan jq 3</title>
    <script src="jquery.min.js"></script>
</head>
<body>
    
    
    <input type="text" name="" id="kode" placeholder="Kode">   
    <input type="text" name="" id="nama" placeholder="Nama">  
    <input type="text" name="" id="satuan" placeholder="Satuan">  
    <input type="text" name="" id="harga" placeholder="Harga">  
    <button type="button" id="tambah">+</button>
    <!-- <Label>Hasil</Label>
    <input type="text" name="" id="hasil" placeholder="hasil" readonly>
    <br> -->
    <table border="1" >
    <thead>
    <tr>
    <th>Action</th>    
    <th>Kode</th>    
    <th>Nama</th>
    <th>Satuan</th>
    <th>Harga</th>
    </tr>
    </thead>
    
    <tbody id="tableData">
    
    </tbody>
    
    <tfoot>
    <td colspan="4"> Grand Total</td>
    <td id="totalHarga">0</td>
    </tfoot>
    
    </table>
  
    
    
    <script>
      $(document).ready(function() { 
      
      var totalHarga = 0;

      // Fungsi untuk memperbarui grand total
      function GrandTotal() {
          $('#totalHarga').text(totalHarga.toFixed(2));
      }

      // Handle delete item
      $('#tableData').on('click', '.delete', function() {
          var row = $(this).closest('tr');
          var harga = parseFloat(row.find('td:eq(4)').text());
          totalHarga -= harga;  // Kurangi harga dari total
          GrandTotal();  // Update Grand Total
          row.remove();
      });
      
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
            "<td>" + kode + "</td><td>" + nama + "</td><td>" + satuan + "</td><td>" + harga.toFixed(2) + "</td>" +
            "</tr>");
        GrandTotal();  // Update Grand Total

        // Clear input fields after adding
        $("#kode").val('');
        $("#nama").val('');
        $("#satuan").val('');
        $("#harga").val('');
      });
      
    });
    </script>
</body>
</html>
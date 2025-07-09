<!DOCTYPE html>
<html>
<head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
<input type="date" id="tanggal" placeholder="tanggal"><br>
<input type="text" id="konsumen" placeholder="konsumen"><br>
<input type="text" id="telp" placeholder="Telp"><br>
<input type="text" id="alamat" placeholder="alamat"><br><br>

<input type="text" id="kodeitem" placeholder="Kode">
<input type="text" id="nama" placeholder="Nama">
<input type="text" id="satuan" placeholder="Satuan">
<input type="text" id="hargajual" placeholder="Harga">
<input type="text" id="qty" placeholder="Qty">

<button id="tambah">+</button><br>
<table border="1" id="tabledata" >
    <thead>        
            <th>Action</th>
            <th>Kode</th>
            <th>Nama</th>
            <th>Satuan</th>
            <th>Harga</th>   
            <th>Qty</th>      
            <th>Subtotal</th>   
    </thead>  
    <tbody >
    </tbody>
    <tfood>
    <td colspan="5"> TOTAL QTY</td><td><div id="totalqty">0</div></td>
    <td><div id="total">0</div></td>
    </tfood>
</table>   
<br>
<button id="save">SAVE</button><button id="cancel">CANCEL</button><br>
<script>
$(document).ready(function(){
function hitung()
{
    var tot = 0;
    var totqty = 0;
    $('#tabledata tr').each(function(){
       var isi = $(this);
       var isi1  = isi.find("td:eq(6)").text();
       tot = Number(tot) + Number(isi1);
       console.log(tot);
       var isi1qty  = isi.find("td:eq(5)").text();
       totqty = Number(totqty) + Number(isi1qty);
       console.log(totqty);
    });

    $("#totalqty").text(totqty);
    $("#total").text(tot);
}    

$("#tambah").click(function(){
    var kodeitem = $("#kodeitem").val();
    var nama = $("#nama").val();
    var satuan = $("#satuan").val();
    var hargajual = $("#hargajual").val();
    var qty = $("#qty").val();
    var subtotal = hargajual*qty;
   
    $('#tabledata').append("<tr>"+
    "<td><button id=\"id"+kodeitem+"\" class=\"remove\">X</button></td>"+
    "<td>"+kodeitem+"</td>"+
    "<td>"+nama+"</td>"+
    "<td>"+satuan+"</td>"+
    "<td>"+hargajual+"</td>"+
    "<td>"+qty+"</td>"+
    "<td>"+subtotal+"</td>"+
    "</tr>");   

    hitung();
});  

$('#tabledata').on('click','.remove',function(){
var id =$(this).attr('id');
$(this).closest('tr').remove();
hitung();
});

$("#save").click(function () {
    var tanggal = $("#tanggal").val();
    var konsumen = $("#konsumen").val();
    var telp = $("#telp").val();
    var alamat = $("#alamat").val();
    var total = $("#total").text();
    var totalqty = $("#totalqty").text();

var formData = new FormData();
    formData.append("tanggal",tanggal); 
    formData.append("konsumen",konsumen); 
    formData.append("telp",telp); 
    formData.append("alamat",alamat); 
    formData.append("total",total); 
    formData.append("totalqty",totalqty);
var itemdetail = [];
var detail=[];
$("#tabledata tr").each(function(){
var x = $(this);
itemdetail = {
    kodeitem:x.find("td:eq(1)").text(),
    hargajual:x.find("td:eq(4)").text(),
    qty:x.find("td:eq(5)").text(),
    subtotal:x.find("td:eq(6)").text()
}
detail.push(itemdetail);
console.log(itemdetail);

}) ;   
    formData.append("detail",JSON.stringify(detail));
$.ajax({
  type: "post",
  url: "latihanphp015.php",
  timeout: 10000,
  data: formData,
  processData: false, //  Jangan memproses data (karena FormData)
  contentType: false, // Biarkan jQuery menentukan tipe konten
  cache: false,
  success: function(response) {
   console.log(response) ;
   //location.reload();
  },
  error: function(xhr, status, error) {
    console.error(xhr.responseText);
  }
});

});


});
</script>  
</body>
</html>
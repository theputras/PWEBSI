
<?php
include "koneksi.php";
$sql = "select * from masterpenjulan";
$result = $conn->query($sql);

?>
<button id="tambahtr">TAMBAH</button>
<table border="1"  >
    <thead>        
            <th>Action</th>
            <th>KodeTR</th>
            <th>Tanggal</th>
            <th>Konsumen</th>
            <th>QTY</th>   
            <th>Total</th>      
           
    </thead>  
    <tbody id="tabledata">
<?php
while($row = $result->fetch_assoc())
{  
    echo '<tr><td>';
    echo '<button onclick="myfungsi()">VIEW</button></td><td>';
    echo $row["kodetr"].'</td><td>';
    echo $row["tanggal"].'</td><td>';
    echo $row["konsumen"].'</td><td>';
    echo $row["totalqty"].'</td><td>';
    echo $row["total"].'</td></tr>';
}
?>
    </tbody>
    <tfood>
    <td colspan="4"> TOTAL </td><td><div id="totalqty">0</div></td>
    <td><div id="total">0</div></td>
    </tfood>
</table>   
<script>
$("#tambahtr").click(function(){
$("#isi").load("latihanphp014.php");
}); 
</script>
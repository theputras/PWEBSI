<?php
header('Content-Type: application/json');
    echo $_POST["tanggal"]; 
    echo "<br>";
    echo $_POST["telp"]; 
    echo "<br>";
    echo $_POST["alamat"]; 
    echo "<br>";
    echo $_POST["total"]; 
    echo "<br>";
    echo $_POST["totalqty"]; 
    echo "<br>";
    echo "<pre>";
    print_r($_POST["detail"]);
    echo "<pre>";


?>
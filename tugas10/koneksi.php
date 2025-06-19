<?php

$serverName = "localhost";
$username = "theputras";
$password = "tpm1240*";
$dbName = "karyawan";

$connection = new mysqli($serverName, $username, $password, $dbName);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}


?>
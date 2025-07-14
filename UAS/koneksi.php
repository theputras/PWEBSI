<?php


// Ambil variabel dari .env
$host = '0.tcp.ap.ngrok.io';
$port = '19849';
$dbname = 'tugas';
$user = 'mobile1';
$pass = 'mobile121';

function getConnection() {
    global $host, $port, $dbname, $user, $pass;
    
    // Buat koneksi MySQLi
    $conn = new mysqli($host, $user, $pass, $dbname, $port);
    
    // Cek koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }
    
    return $conn;
}
// Buat koneksi MySQLi
$conn = new mysqli($host, $user, $pass, $dbname, $port);
// echo "Koneksi berhasil ke database '$dbname' pada host '$host:$port'<br>";
// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>

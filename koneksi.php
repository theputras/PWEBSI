<?php


// Ambil variabel dari .env
$host = '0.tcp.ap.ngrok.io';
$port = '17451';
$dbname = 'tugas';
$user = 'mobile1';
$pass = 'mobile121';

// Buat koneksi MySQLi
$conn = new mysqli($host, $user, $pass, $dbname, $port);
// echo "Koneksi berhasil ke database '$dbname' pada host '$host:$port'<br>";
// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>

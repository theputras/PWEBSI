<?php
// Ambil variabel dari .env
$host = '41.216.191.160';
$port = '3306';
$dbname = 'tugas';
$user = 'mobile1';
$pass = 'mobile121';

// Inisialisasi variabel status
$db_connected = false;
$db_message = "";

// Buat koneksi MySQLi
$conn = new mysqli($host, $user, $pass, $dbname, $port);

// Cek koneksi
if ($conn->connect_error) {
    $db_connected = false;
    $db_message = "Koneksi gagal: " . $conn->connect_error;
    // Jangan die() di sini, agar halaman utama tetap bisa dimuat
} else {
    $db_connected = true;
    $db_message = "Koneksi berhasil ke database '$dbname' pada host '$host'";
}

function getConnection() {
    global $host, $port, $dbname, $user, $pass;

    // Buat koneksi MySQLi
    $conn = new mysqli($host, $user, $pass, $dbname, $port);

    // Cek koneksi
    if ($conn->connect_error) {
        return null; // Mengembalikan null jika koneksi gagal
    }

    return $conn;
}
?>
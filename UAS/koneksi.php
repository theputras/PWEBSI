<?php

// Daftar koneksi DB (tanpa .env)
$connections = [
    [
        'label' => 'Primary',
        'host'  => '41.216.191.160',
        'port'  => 3306,
        'user'  => 'mobile1',
        'pass'  => 'mobile121',
        'db'    => 'tugas'
    ],
    [
        'label' => 'Backup',
        'host'  => '192.168.1.100',
        'port'  => 3306,
        'user'  => 'backupuser',
        'pass'  => 'backuppass',
        'db'    => 'tugas'
    ]
];

$conn = null;
$activeLabel = null;
$db_connected = false;
$db_message = "";

foreach ($connections as $config) {
    try {
        $testConn = @mysqli_connect(
            $config['host'],
            $config['user'],
            $config['pass'],
            $config['db'],
            (int)$config['port']
        );
        if ($testConn && $testConn instanceof mysqli && !$testConn->connect_errno) {
            $conn = $testConn;
            $activeLabel = "{$config['label']} ({$config['user']}@{$config['host']}:{$config['port']})";
            $db_connected = true;
            $db_message = "Koneksi berhasil ke database '{$config['db']}' pakai $activeLabel";
            break;
        }
    } catch (mysqli_sql_exception $e) {
        error_log("Gagal konek ke {$config['label']} DB: " . $e->getMessage());
    }
}

if (!$conn) {
    $db_connected = false;
    $db_message = "Gagal konek ke semua database (primary & backup).";
    // Jangan die() biar halaman tetap bisa jalan, tinggal cek $db_connected sebelum query
}

// Bisa cek status di mana aja setelah include
// echo $db_message;

?>

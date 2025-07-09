<?php
include "koneksi.php";

// Fungsi ambil semua data item
function getAllItems() {
    global $conn;
    $result = $conn->query("SELECT * FROM item ORDER BY kode ASC");
    $items = [];
    while ($row = $result->fetch_assoc()) {
        $items[] = $row;
    }
    echo json_encode([
        "status" => "success",
        "data" => $items
    ]);
}

// Fungsi insert item
function insertItem() {
    global $conn;

    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        echo json_encode([
            "status" => "error",
            "message" => "⚠️ Harus menggunakan metode POST."
        ]);
        return;
    }

    if (
        empty($_POST['kode']) ||
        empty($_POST['nama']) ||
        empty($_POST['satuan']) ||
        !isset($_POST['harga']) || $_POST['harga'] === ''
    ) {
        echo json_encode([
            "status" => "error",
            "message" => "⚠️ Data POST tidak lengkap."
        ]);
        return;
    }

    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $satuan = $_POST['satuan'];
    $harga = $_POST['harga'];

    // Cek duplikat
    $cek = $conn->prepare("SELECT kode FROM item WHERE kode = ?");
    $cek->bind_param("s", $kode);
    $cek->execute();
    $cek->store_result();
    if ($cek->num_rows > 0) {
        echo json_encode([
            "status" => "error",
            "message" => "⚠️ Kode item sudah terdaftar."
        ]);
        return;
    }

    $stmt = $conn->prepare("INSERT INTO item (kode, nama, satuan, harga) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssd", $kode, $nama, $satuan, $harga);

    if ($stmt->execute()) {
        echo json_encode([
            "status" => "success",
            "message" => "✅ Item berhasil disimpan."
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "❌ Gagal menyimpan item."
        ]);
    }
}

function deleteItem() {
    global $conn;

    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        echo json_encode([
            "status" => "error",
            "message" => "⚠️ Harus menggunakan metode POST."
        ]);
        return;
    }

    if (empty($_POST['kode'])) {
        echo json_encode([
            "status" => "error",
            "message" => "⚠️ Kode item tidak boleh kosong."
        ]);
        return;
    }

    $kode = $_POST['kode'];

    $stmt = $conn->prepare("DELETE FROM item WHERE kode = ?");
    $stmt->bind_param("s", $kode);

    if ($stmt->execute()) {
        echo json_encode([
            "status" => "success",
            "message" => "🗑️ Item berhasil dihapus."
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "❌ Gagal menghapus item."
        ]);
    }
}


function updateItem() {
    global $conn;

    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        echo json_encode(["status" => "error", "message" => "⚠️ Harus POST"]);
        return;
    }

    $kode = $_POST['kode'] ?? '';
    $nama = $_POST['nama'] ?? '';
    $satuan = $_POST['satuan'] ?? '';
    $harga = $_POST['harga'] ?? '';

    if (!$kode || !$nama || !$satuan || $harga === '') {
        echo json_encode(["status" => "error", "message" => "⚠️ Data tidak lengkap."]);
        return;
    }

    $stmt = $conn->prepare("UPDATE item SET kode = ?, nama = ?, satuan = ?, harga = ? WHERE kode = ?");
    $stmt->bind_param("sssds", $kode, $nama, $satuan, $harga, $kode);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "✅ Item berhasil diupdate."]);
    } else {
        echo json_encode(["status" => "error", "message" => "❌ Gagal update item."]);
    }
}


// Routing
if (isset($_GET['action']) && $_GET['action'] === 'getAllItems') {
    getAllItems();
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === "deleteItem") {
            deleteItem(); exit;
        } elseif ($_POST['action'] === "updateItem") {
            updateItem(); exit;
        }
    }
    insertItem();
    exit;
}

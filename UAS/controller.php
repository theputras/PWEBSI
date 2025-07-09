<?php
include "koneksi.php";

// Fungsi ambil semua data item
function getAllItems() {
    global $conn;
    $result = $conn->query("SELECT * FROM item ORDER BY kode_item ASC");
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

    $nama   = $_POST['nama']   ?? '';
    $satuan = $_POST['satuan'] ?? '';
    $harga  = $_POST['harga']  ?? '';
    $jumlah_item = $_POST['jumlah_item'] ?? 0; // default ke 0 kalau kosong


    if ($nama === '' || $satuan === '' || $harga === '') {
        echo json_encode([
            "status" => "error",
            "message" => "⚠️ Data POST tidak lengkap (insert)."
        ]);
        return;
    }

    // Auto-generate kode_item kalau kosong
    $kode_item = $_POST['kode_item'] ?? '';
    if ($kode_item === '') {
        do {
            $kode_item = 'item' . random_int(100000, 999999);
            $cek = $conn->prepare("SELECT kode_item FROM item WHERE kode_item = ?");
            $cek->bind_param("s", $kode_item);
            $cek->execute();
            $cek->store_result();
        } while ($cek->num_rows > 0);
    }

    // Cek duplikat (lagi aja biar aman kalau ada manual kirim kode)
    $cek = $conn->prepare("SELECT kode_item FROM item WHERE kode_item = ?");
    $cek->bind_param("s", $kode_item);
    $cek->execute();
    $cek->store_result();
    if ($cek->num_rows > 0) {
        echo json_encode([
            "status" => "error",
            "message" => "⚠️ kode_item $kode_item sudah terdaftar."
        ]);
        return;
    }

    $stmt = $conn->prepare("INSERT INTO item (kode_item, nama, satuan, harga, jumlah_item) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssd", $kode_item, $nama, $satuan, $harga, $jumlah_item);

    if ($stmt->execute()) {
        echo json_encode([
            "status" => "success",
            "message" => "✅ Item berhasil disimpan dengan kode $kode_item."
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

    if (empty($_POST['kode_item'])) {
        echo json_encode([
            "status" => "error",
            "message" => "⚠️ kode_item item tidak boleh kosong."
        ]);
        return;
    }

    $kode_item = $_POST['kode_item'];

    $stmt = $conn->prepare("DELETE FROM item WHERE kode_item = ?");
    $stmt->bind_param("s", $kode_item);

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

    $kode_item = $_POST['kode_item'] ?? '';
    $nama = $_POST['nama'] ?? '';
    $satuan = $_POST['satuan'] ?? '';
    $harga = $_POST['harga'] ?? '';
    $jumlah_item = $_POST['jumlah_item'] ?? 0;

    if (!$kode_item || !$nama || !$satuan || $harga === '') {
        echo json_encode(["status" => "error", "message" => "⚠️ Data tidak lengkap."]);
        return;
    }

$stmt = $conn->prepare("UPDATE item SET nama = ?, satuan = ?, harga = ?, jumlah_item = ? WHERE kode_item = ?");
$stmt->bind_param("ssdss", $nama, $satuan, $harga, $jumlah_item, $kode_item);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "✅ Item berhasil diupdate."]);
    } else {
        echo json_encode(["status" => "error", "message" => "❌ Gagal update item."]);
    }
}

function deleteMultipleItems() {
    global $conn;

    $kodeList = $_POST['kode_list'] ?? [];

    if (!is_array($kodeList) || count($kodeList) === 0) {
        echo json_encode(["status" => "error", "message" => "⚠️ Tidak ada data terpilih."]);
        return;
    }

    $placeholders = implode(',', array_fill(0, count($kodeList), '?'));
    $stmt = $conn->prepare("DELETE FROM item WHERE kode_item IN ($placeholders)");
    $stmt->bind_param(str_repeat('s', count($kodeList)), ...$kodeList);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "✅ Berhasil menghapus beberapa item."]);
    } else {
        echo json_encode(["status" => "error", "message" => "❌ Gagal menghapus item."]);
    }
}




// Penjualan
function insertPenjualan() {
    global $conn;

    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        echo json_encode([
            "status" => "error",
            "message" => "⚠️ Harus menggunakan metode POST."
        ]);
        return;
    }

    $konsumen = $_POST['konsumen'] ?? '';
    $items = $_POST['items'] ?? []; // Array of item

    if ($konsumen === '' || !is_array($items) || count($items) === 0) {
        echo json_encode([
            "status" => "error",
            "message" => "⚠️ Data transaksi tidak lengkap."
        ]);
        return;
    }

    $conn->begin_transaction();

    try {
        // Hitung total dan qty
        $total_penjualan = 0;
        $totalqty = 0;

        foreach ($items as $item) {
            $qty = intval($item['qty']);
            $harga = floatval($item['harga']);
            $subtotal = $qty * $harga;

            $total_penjualan += $subtotal;
            $totalqty += $qty;
        }

        // Insert ke master
        $stmt = $conn->prepare("INSERT INTO masterpenjualan (konsumen, total_penjualan, totalqty) VALUES (?, ?, ?)");
        $stmt->bind_param("sii", $konsumen, $total_penjualan, $totalqty);
        $stmt->execute();
        $kodetr = $conn->insert_id;

        // Insert ke detail
        $stmtDetail = $conn->prepare("INSERT INTO penjualan_detail (kodetr, kode_item, harga, qty, subtotal) VALUES (?, ?, ?, ?, ?)");

        foreach ($items as $item) {
            $kode_item = $item['kode_item'];
            $harga = floatval($item['harga']);
            $qty = intval($item['qty']);
            $subtotal = $harga * $qty;

            $stmtDetail->bind_param("issid", $kodetr, $kode_item, $harga, $qty, $subtotal);
            $stmtDetail->execute();
        }

        $conn->commit();
        echo json_encode([
            "status" => "success",
            "message" => "✅ Transaksi berhasil disimpan dengan kode $kodetr."
        ]);
    } catch (Exception $e) {
        $conn->rollback();
        echo json_encode([
            "status" => "error",
            "message" => "❌ Gagal simpan transaksi: " . $e->getMessage()
        ]);
    }
}

function getPenjualan() {
    global $conn;
    
    $sql = "SELECT 
                mp.kodetr,
                mp.tanggal,
                mp.konsumen,
                mp.total_penjualan,
                mp.totalqty
            FROM masterpenjualan mp
            ORDER BY mp.tanggal DESC";

    $result = $conn->query($sql);
    $penjualan = [];

    while ($row = $result->fetch_assoc()) {
        $penjualan[] = $row;
    }

    echo json_encode([
        "status" => "success",
        "data" => $penjualan
    ]);
}


function getItemOptions() {
    global $conn;

    $result = $conn->query("SELECT kode_item, nama FROM item ORDER BY nama ASC");
    $options = "";
    while ($row = $result->fetch_assoc()) {
        $options .= "<option value='{$row['kode_item']}'>{$row['nama']} ({$row['kode_item']})</option>";
    }

    echo json_encode([
        "status" => "success",
        "options" => $options
    ]);
}


function getItemByKode() {
    global $conn;

    if (!isset($_GET['kode_item'])) {
        echo json_encode([
            "status" => "error",
            "message" => "⚠️ Parameter kode_item tidak ditemukan."
        ]);
        return;
    }

    $kode = $_GET['kode_item'];

    $stmt = $conn->prepare("SELECT * FROM item WHERE kode_item = ?");
    $stmt->bind_param("s", $kode);
    $stmt->execute();
    $result = $stmt->get_result();
    $item = $result->fetch_assoc();

    if ($item) {
        echo json_encode([
            "status" => "success",
            "data" => $item
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "❌ Item tidak ditemukan."
        ]);
    }
}


// Routing

if ($_SERVER["REQUEST_METHOD"] === "GET") {
if (isset($_GET['action'])) {
     if ($_GET['action'] === "getItemsOptions") {
            getItemOptions(); exit;
        }  elseif ($_GET['action'] === "getAllItems") {
            getAllItems(); exit;
        } elseif ($_GET['action'] === "getItemByKode") {
            getItemByKode(); exit;
        } elseif ($_GET['action'] === "getPenjualan") {
            getPenjualan(); exit;
        } 
}
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === "deleteItem") {
            deleteItem(); exit;
        } elseif ($_POST['action'] === "updateItem") {
            updateItem(); exit;
        } elseif ($_POST['action'] === "deleteMultipleItems") {
            deleteMultipleItems(); exit; // 🛠️ TAMBAH INI BIAR DIA DIKENAL
        } elseif ($_POST['action'] === "insertPenjualan") {
            insertPenjualan(); exit; // 🛠️ TAMBAH INI BIAR DIA DIKENAL
        }
    }
    insertItem(); // ⬅️ Biarkan jadi fallback kalau gak ada action, tapi gak error aneh
    exit;
}






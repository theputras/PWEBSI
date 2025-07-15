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
    echo json_encode(["status" => "success", "data" => $items]);
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
    $harga = floatval($_POST['harga'] ?? 0);
     $jumlah_item = intval($_POST['jumlah_item'] ?? 0);


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

    $stmt = $conn->prepare("INSERT INTO item (kode_item, nama, satuan, harga, jumlah_item) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssdi", $kode_item, $nama, $satuan, $harga, $jumlah_item);

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
$stmt->bind_param("ssdis", $nama, $satuan, $harga, $jumlah_item, $kode_item);

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
        $stmtDetail = $conn->prepare("INSERT INTO detailpenjualan (kodetr, kode_item, jumlah, subtotal) VALUES (?, ?, ?, ?)");

     foreach ($items as $item) {
    $kode_item = $item['kode_item'];
    $harga = floatval($item['harga']); // masih dipakai buat subtotal
    $qty = intval($item['qty']);
    $subtotal = $harga * $qty;

    $stmtDetail->bind_param("isid", $kodetr, $kode_item, $qty, $subtotal);
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
    $sql = "
        SELECT 
            mp.kodetr,
            mp.tanggal,
            mp.konsumen,
            mp.total_penjualan,
            mp.totalqty
        FROM masterpenjualan mp
        ORDER BY mp.tanggal DESC
    ";
    $result = $conn->query($sql);
    $penjualan = [];
    while ($row = $result->fetch_assoc()) {
        $penjualan[] = $row;
    }
    echo json_encode(["status" => "success", "data" => $penjualan]);
}




function getItemOptions() {
    global $conn;
    $result = $conn->query("SELECT kode_item, nama FROM item ORDER BY nama ASC");
    $options = "";
    while ($row = $result->fetch_assoc()) {
        $options .= "<option value='{$row['kode_item']}'>{$row['nama']} - {$row['kode_item']}</option>";
    }
    echo json_encode(["status" => "success", "options" => $options]);
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


function detailPenjualan() {
    global $conn;

    if (!isset($_GET['kodetr'])) {
        echo json_encode([
            "status" => "error",
            "message" => "⚠️ Parameter kodetr tidak ditemukan."
        ]);
        return;
    }

    $kodetr = $_GET['kodetr'];

    $sql = "
        SELECT 
            dp.kode_item,
            i.nama,
            i.satuan,
            dp.jumlah AS qty,
            dp.subtotal,
            (dp.subtotal / dp.jumlah) AS harga
        FROM detailpenjualan dp
        JOIN item i ON dp.kode_item = i.kode_item
        WHERE dp.kodetr = ?
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $kodetr);
    $stmt->execute();
    $result = $stmt->get_result();

    $detail = [];
    while ($row = $result->fetch_assoc()) {
        $detail[] = $row;
    }

    echo json_encode([
        "status" => "success",
        "data" => $detail
    ]);
}

// Pembelian
function insertPembelian() {
    global $conn;

    $kode_supplier = $_POST['kode_supplier'] ?? '';
    $total_biaya = $_POST['total_biaya'] ?? 0;
    $status_pembelian = $_POST['status_pembelian'] ?? 'pending';

    // Validasi input
    if (empty($kode_supplier) || $total_biaya <= 0) {
        echo json_encode(["status" => "error", "message" => "Data tidak lengkap atau invalid."]);
        return;
    }

    // Insert into pembelian
    $stmt = $conn->prepare("INSERT INTO pembelian (kode_supplier, total_biaya, status_pembelian) VALUES (?, ?, ?)");
    $stmt->bind_param("sds", $kode_supplier, $total_biaya, $status_pembelian);
    if ($stmt->execute()) {
        $id_pembelian = $stmt->insert_id;

        // Insert detail pembelian (misalnya kita dapat data item dari POST)
        if (!empty($_POST['items']) && is_array($_POST['items'])) {
            $items = $_POST['items'];
            foreach ($items as $item) {
                $kode_item = $item['kode_item'];
                $jumlah = $item['jumlah'];
                $harga_beli = $item['harga_beli'];
                $subtotal = $jumlah * $harga_beli;

                $detailStmt = $conn->prepare("INSERT INTO detail_pembelian (id_pembelian, kode_item, jumlah, harga_beli, subtotal) VALUES (?, ?, ?, ?, ?)");
                $detailStmt->bind_param("isidd", $id_pembelian, $kode_item, $jumlah, $harga_beli, $subtotal);
                $detailStmt->execute();
            }
        }

        echo json_encode(["status" => "success", "message" => "Pembelian berhasil ditambahkan."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Terjadi kesalahan saat menambahkan pembelian."]);
    }
}

function getPembelian() {
    global $conn;

    // Query untuk mengambil pembelian
    $sql = "SELECT * FROM pembelian";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $pembelian = [];
        while ($row = $result->fetch_assoc()) {
            $pembelian[] = $row;
        }

        echo json_encode(["status" => "success", "data" => $pembelian]);
    } else {
        echo json_encode(["status" => "error", "message" => "Data pembelian tidak ditemukan."]);
    }
}



function updatePembelian() {
    global $conn;

    $id_pembelian = $_POST['id_pembelian'] ?? 0;
    $kode_supplier = $_POST['kode_supplier'] ?? '';
    $total_biaya = $_POST['total_biaya'] ?? 0;
    $status_pembelian = $_POST['status_pembelian'] ?? 'pending';

    if ($id_pembelian <= 0 || empty($kode_supplier) || $total_biaya <= 0) {
        echo json_encode(["status" => "error", "message" => "Data tidak lengkap atau invalid."]);
        return;
    }

    // Update pembelian
    $stmt = $conn->prepare("UPDATE pembelian SET kode_supplier = ?, total_biaya = ?, status_pembelian = ? WHERE id_pembelian = ?");
    $stmt->bind_param("sdsi", $kode_supplier, $total_biaya, $status_pembelian, $id_pembelian);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Pembelian berhasil diupdate."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Terjadi kesalahan saat mengupdate pembelian."]);
    }
}


function deletePembelian() {
    global $conn;

    $id_pembelian = $_POST['id_pembelian'] ?? 0;

    if ($id_pembelian <= 0) {
        echo json_encode(["status" => "error", "message" => "ID pembelian tidak valid."]);
        return;
    }

    // Hapus detail pembelian terkait
    $conn->query("DELETE FROM detail_pembelian WHERE id_pembelian = $id_pembelian");

    // Hapus pembelian
    $stmt = $conn->prepare("DELETE FROM pembelian WHERE id_pembelian = ?");
    $stmt->bind_param("i", $id_pembelian);
    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Pembelian berhasil dihapus."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Terjadi kesalahan saat menghapus pembelian."]);
    }
}



function getDetailPembelian() {
    global $conn;

    $id_pembelian = $_GET['id_pembelian'] ?? 0;

    if ($id_pembelian <= 0) {
        echo json_encode(["status" => "error", "message" => "ID pembelian tidak valid."]);
        return;
    }

    // Query untuk mengambil detail pembelian
    $sql = "SELECT * FROM detail_pembelian WHERE id_pembelian = $id_pembelian";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $detail_pembelian = [];
        while ($row = $result->fetch_assoc()) {
            $detail_pembelian[] = $row;
        }

        echo json_encode(["status" => "success", "data" => $detail_pembelian]);
    } else {
        echo json_encode(["status" => "error", "message" => "Detail pembelian tidak ditemukan."]);
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
        } elseif ($_GET['action'] === "detailPenjualan") {
            detailPenjualan(); exit;
        }  elseif ($_GET['action'] === "getPembelian") {
            getPembelian(); exit;
        }   elseif ($_GET['action'] === "getDetailPembelian") {
            getDetailPembelian(); exit;
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
        } elseif ($_POST['action'] === "insertPembelian") {
            insertPembelian(); exit; // 🛠️ TAMBAH INI BIAR DIA DIKENAL
        } elseif ($_POST['action'] === "updatePembelian") {
            updatePembelian(); exit; // 🛠️ TAMBAH INI BIAR DIA DIKENAL
        } elseif ($_POST['action'] === "deletePembelian") {
            deletePembelian(); exit; // 🛠️ TAMBAH INI BIAR DIA DIKENAL
        }
    }
    insertItem(); // ⬅️ Biarkan jadi fallback kalau gak ada action, tapi gak error aneh
    exit;
}






<?php
include "koneksi.php";


// Fungsi ambil semua data item
function getAllItems() {

    global $conn;
    // Ambil juga harga_beli dari database
    $result = $conn->query("SELECT *, harga_beli FROM item ORDER BY kode_item ASC");
    $items = [];
    while ($row = $result->fetch_assoc()) {
        $items[] = $row;
    }
    echo json_encode(["status" => "success", "data" => $items]);
}


// Fungsi insert item
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
    $harga = floatval($_POST['harga'] ?? 0); // Ini adalah harga_jual
    $harga_beli = floatval($_POST['harga_beli'] ?? 0); // Ambil harga_beli
    $jumlah_item = intval($_POST['jumlah_item'] ?? 0);


    if ($nama === '' || $satuan === '' || $harga === '' || $harga_beli === '') { // Tambahkan validasi harga_beli
        echo json_encode([
            "status" => "error",
            "message" => "⚠️ Data POST tidak lengkap (insert). Pastikan harga beli dan harga jual terisi."
        ]);
        return;
    }

    // Auto-generate kode_item kalau kosong
    $kode_item = $_POST['kode_item'] ?? '';
    if ($kode_item === '') {
        do {
            $kode_item = 'ITEM' . random_int(100000, 999999);
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

    // Sesuaikan query INSERT dan bind_param untuk harga_beli
    // PERBAIKAN: Ubah "ssddii" menjadi "sssddi"
    $stmt = $conn->prepare("INSERT INTO item (kode_item, nama, satuan, harga, harga_beli, jumlah_item) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssddi", $kode_item, $nama, $satuan, $harga, $harga_beli, $jumlah_item);

    if ($stmt->execute()) {
        echo json_encode([
            "status" => "success",
            "message" => "✅ Item berhasil disimpan dengan kode $kode_item."
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "❌ Gagal menyimpan item: " . $stmt->error
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

// function deleteItem() {
//     global $conn;

//     if ($_SERVER["REQUEST_METHOD"] !== "POST") {
//         echo json_encode([
//             "status" => "error",
//             "message" => "⚠️ Harus menggunakan metode POST."
//         ]);
//         return;
//     }

//     if (empty($_POST['kode_item'])) {
//         echo json_encode([
//             "status" => "error",
//             "message" => "⚠️ kode_item item tidak boleh kosong."
//         ]);
//         return;
//     }

//     $kode_item = $_POST['kode_item'];

//     $conn->begin_transaction(); // Mulai transaksi

//     try {
//         // 1. Hapus record dari detailpembelian yang terkait dengan item ini
//         $stmt_del_detailpembelian = $conn->prepare("DELETE FROM detailpembelian WHERE kode_item = ?");
//         $stmt_del_detailpembelian->bind_param("s", $kode_item);
//         $stmt_del_detailpembelian->execute();

//         // 2. Hapus record dari detailpenjualan yang terkait dengan item ini
//         $stmt_del_detailpenjualan = $conn->prepare("DELETE FROM detailpenjualan WHERE kode_item = ?");
//         $stmt_del_detailpenjualan->bind_param("s", $kode_item);
//         $stmt_del_detailpenjualan->execute();

//         // 3. Sekarang, hapus item dari tabel item
//         $stmt = $conn->prepare("DELETE FROM item WHERE kode_item = ?");
//         $stmt->bind_param("s", $kode_item);
        
//         if ($stmt->execute()) {
//             $conn->commit(); // Commit transaksi jika semua berhasil
//             echo json_encode([
//                 "status" => "success",
//                 "message" => "🗑️ Item berhasil dihapus beserta detail terkait."
//             ]);
//         } else {
//             throw new Exception("Gagal menghapus item.");
//         }
//     } catch (Exception $e) {
//         $conn->rollback(); // Rollback transaksi jika ada kesalahan
//         echo json_encode([
//             "status" => "error",
//             "message" => "❌ Gagal menghapus item: " . $e->getMessage()
//         ]);
//     }
// }


function updateItem() {
    global $conn;

    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        echo json_encode(["status" => "error", "message" => "⚠️ Harus POST"]);
        return;
    }

    $kode_item = $_POST['kode_item'] ?? '';
    $nama = $_POST['nama'] ?? '';
    $satuan = $_POST['satuan'] ?? '';
    $harga_jual = floatval($_POST['harga'] ?? 0); // Ambil harga_jual dari name="harga"
    $harga_beli = floatval($_POST['harga_beli'] ?? 0); // Ambil harga_beli
    $jumlah_item = intval($_POST['jumlah_item'] ?? 0);

    if (!$kode_item || !$nama || !$satuan || $harga_jual === '' || $harga_beli === '') { // Tambahkan validasi harga_beli
        echo json_encode(["status" => "error", "message" => "⚠️ Data tidak lengkap. Pastikan semua field terisi."]);
        return;
    }

    // Sesuaikan query UPDATE dan bind_param untuk harga_beli
    $stmt = $conn->prepare("UPDATE item SET nama = ?, satuan = ?, harga = ?, harga_beli = ?, jumlah_item = ? WHERE kode_item = ?");
    $stmt->bind_param("ssddis", $nama, $satuan, $harga_jual, $harga_beli, $jumlah_item, $kode_item);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "✅ Item berhasil diupdate."]);
    } else {
        echo json_encode(["status" => "error", "message" => "❌ Gagal update item: " . $stmt->error]);
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

// function deleteMultipleItems() {
//     global $conn;

//     $kodeList = $_POST['kode_list'] ?? [];

//     if (!is_array($kodeList) || count($kodeList) === 0) {
//         echo json_encode(["status" => "error", "message" => "⚠️ Tidak ada data terpilih."]);
//         return;
//     }

//     $conn->begin_transaction(); // Mulai transaksi

//     try {
//         foreach ($kodeList as $kode_item) {
//             // Hapus record dari detailpembelian yang terkait dengan item ini
//             $stmt_del_detailpembelian = $conn->prepare("DELETE FROM detailpembelian WHERE kode_item = ?");
//             $stmt_del_detailpembelian->bind_param("s", $kode_item);
//             $stmt_del_detailpembelian->execute();

//             // Hapus record dari detailpenjualan yang terkait dengan item ini
//             $stmt_del_detailpenjualan = $conn->prepare("DELETE FROM detailpenjualan WHERE kode_item = ?");
//             $stmt_del_detailpenjualan->bind_param("s", $kode_item);
//             $stmt_del_detailpenjualan->execute();

//             // Hapus item dari tabel item
//             $stmt_del_item = $conn->prepare("DELETE FROM item WHERE kode_item = ?");
//             $stmt_del_item->bind_param("s", $kode_item);
//             $stmt_del_item->execute();
//         }

//         $conn->commit(); // Commit transaksi jika semua berhasil
//         echo json_encode(["status" => "success", "message" => "✅ Berhasil menghapus beberapa item beserta detail terkait."]);
//     } catch (Exception $e) {
//         $conn->rollback(); // Rollback transaksi jika ada kesalahan
//         echo json_encode(["status" => "error", "message" => "❌ Gagal menghapus item: " . $e->getMessage()]);
//     }
// }





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
            $harga = floatval($item['harga']); // Ini harga jual
            $subtotal = $qty * $harga;

            $total_penjualan += $subtotal;
            $totalqty += $qty;
        }

        // Generate kode transaksi unik TRxxxx
        do {
            $random_kodetr = 'TR' . random_int(1000, 9999);
            $cek = $conn->prepare("SELECT kodetr FROM masterpenjualan WHERE kodetr = ?");
            $cek->bind_param("s", $random_kodetr);
            $cek->execute();
            $cek->store_result();
        } while ($cek->num_rows > 0);
        
        // Insert ke master
        $stmt = $conn->prepare("INSERT INTO masterpenjualan (kodetr, konsumen, total_penjualan, totalqty) VALUES (?, ?, ?, ?)");
        $kodetr = $random_kodetr;
        $stmt->bind_param("ssdi", $kodetr, $konsumen, $total_penjualan, $totalqty);
        $stmt->execute();

        // Insert ke detail dan update stok item
        $stmtDetail = $conn->prepare("INSERT INTO detailpenjualan (kodetr, kode_item, jumlah, subtotal) VALUES (?, ?, ?, ?)");
        $stmtUpdateStok = $conn->prepare("UPDATE item SET jumlah_item = jumlah_item - ? WHERE kode_item = ?"); // Query untuk mengurangi stok

        foreach ($items as $item) {
            $kode_item = $item['kode_item'];
            $qty = intval($item['qty']);
            $harga = floatval($item['harga']);
            $subtotal = $qty * $harga;
            // Cek stok sebelum update
            $check_stok_stmt = $conn->prepare("SELECT jumlah_item FROM item WHERE kode_item = ?");
            $check_stok_stmt->bind_param("s", $kode_item);
            $check_stok_stmt->execute();
            $check_stok_result = $check_stok_stmt->get_result();
            $current_stock = $check_stok_result->fetch_assoc()['jumlah_item'] ?? 0;

            if ($current_stock < $qty) {
                throw new Exception("Stok untuk item $kode_item tidak cukup. Stok tersedia: $current_stock, Diminta: $qty");
            }

            // Insert detail penjualan
            $stmtDetail->bind_param("ssid", $kodetr, $kode_item, $qty, $subtotal);
            $stmtDetail->execute();

            // Update stok item
            $stmtUpdateStok->bind_param("is", $qty, $kode_item);
            $stmtUpdateStok->execute();
        }

        $conn->commit();
        echo json_encode([
            "status" => "success",
            "message" => "✅ Transaksi berhasil disimpan dengan kode $kodetr dan stok diperbarui."
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
    // PERBAIKAN: Ambil juga kolom 'satuan'
    $result = $conn->query("SELECT kode_item, nama, jumlah_item, harga, harga_beli, satuan FROM item ORDER BY nama ASC");
    $options = "";
    $full_data = []; // Untuk menyimpan data lengkap setiap item
    while ($row = $result->fetch_assoc()) {
        $options .= "<option value='{$row['kode_item']}'>{$row['nama']} (Stok: {$row['jumlah_item']}, Harga: Rp. {$row['harga']}) - {$row['kode_item']}</option>";
        // Simpan data lengkap untuk penggunaan filter sisi klien (jika Select2 tidak digunakan dengan AJAX)
        $full_data[] = [
            'kode_item' => $row['kode_item'],
            'nama' => $row['nama'],
            'jumlah_item' => $row['jumlah_item'],
            'harga' => $row['harga'],
            'harga_beli' => $row['harga_beli'],
            'satuan' => $row['satuan'] // Pastikan satuan juga diambil
        ];
    }
    echo json_encode(["status" => "success", "options" => $options, "full_data" => $full_data]); // Kirim juga full_data
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

    // Ambil juga harga_beli
    $stmt = $conn->prepare("SELECT *, harga_beli FROM item WHERE kode_item = ?");
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
            (dp.subtotal / dp.jumlah) AS harga -- Ini adalah harga jual
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

    // Periksa apakah request method adalah POST
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        echo json_encode(["status" => "error", "message" => "Metode request harus POST."]);
        return;
    }

    // Ambil data dari POST request
    $tanggal_pembelian = $_POST['tanggal_pembelian'] ?? date('Y-m-d'); // Tanggal pembelian
    $kode_supplier = $_POST['kode_supplier'] ?? '';
    $items_pembelian = $_POST['items_pembelian'] ?? []; // Ini adalah array item yang dibeli
    $status_pembelian = $_POST['status_pembelian'] ?? 'pending';


    // Validasi input utama
    if (empty($kode_supplier) || !is_array($items_pembelian) || count($items_pembelian) === 0) {
        echo json_encode(["status" => "error", "message" => "Data pembelian tidak lengkap atau format tidak sesuai."]);
        return;
    }

    // Mulai transaksi
    $conn->begin_transaction();

    try {
        $total_biaya = 0;
        // Hitung total biaya dari semua item yang dibeli
        foreach ($items_pembelian as $item) {
            $jumlah = intval($item['jumlah'] ?? 0);
            $harga_beli = floatval($item['harga_beli'] ?? 0);
            $total_biaya += ($jumlah * $harga_beli);
        }

        // Insert ke tabel master `pembelian`
        // Perhatikan: status_pembelian default 'pending'
        $stmt_master = $conn->prepare("INSERT INTO pembelian (kode_supplier, tanggal_pembelian, total_biaya, status_pembelian) VALUES (?, ?, ?, ?)");
        $stmt_master->bind_param("ssds", $kode_supplier, $tanggal_pembelian, $total_biaya, $status_pembelian);

        $stmt_master->execute();
        $id_pembelian = $conn->insert_id; // Ambil ID pembelian yang baru saja dibuat

        // Insert ke tabel `detailpembelian` dan update stok `item`
        $stmt_detail = $conn->prepare("INSERT INTO detailpembelian (id_pembelian, kode_item, jumlah, harga_beli, subtotal) VALUES (?, ?, ?, ?, ?)");
        $stmt_update_stok = $conn->prepare("UPDATE item SET jumlah_item = jumlah_item + ? WHERE kode_item = ?"); // Tambah stok

        foreach ($items_pembelian as $item) {
            $kode_item = $item['kode_item'] ?? '';
            $jumlah = intval($item['jumlah'] ?? 0);
            $harga_beli = floatval($item['harga_beli'] ?? 0);
            $subtotal_item = $jumlah * $harga_beli;

            // Validasi per item
            if (empty($kode_item) || $jumlah <= 0 || $harga_beli <= 0) {
                throw new Exception("Data item dalam pembelian tidak lengkap atau tidak valid.");
            }

            // Insert detail pembelian
            $stmt_detail->bind_param("isidd", $id_pembelian, $kode_item, $jumlah, $harga_beli, $subtotal_item);
            $stmt_detail->execute();

            // Update stok item
            $stmt_update_stok->bind_param("is", $jumlah, $kode_item);
            $stmt_update_stok->execute();
        }

        $conn->commit();
        echo json_encode(["status" => "success", "message" => "✅ Pembelian berhasil ditambahkan dengan ID: " . $id_pembelian]);

    } catch (Exception $e) {
        $conn->rollback();
        echo json_encode(["status" => "error", "message" => "❌ Gagal menambahkan pembelian: " . $e->getMessage()]);
    }
}

function getPembelian() {
    global $conn;

    // Query untuk mengambil pembelian
    $sql = "SELECT p.*, s.nama_supplier FROM pembelian p JOIN supplier s ON p.kode_supplier = s.kode_supplier ORDER BY p.tanggal_pembelian DESC";
    $result = $conn->query($sql);

    $pembelian = []; // Inisialisasi array kosong
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $pembelian[] = $row;
        }
    }
    // PERBAIKAN: Selalu kembalikan status success dengan data (bisa kosong)
    echo json_encode(["status" => "success", "data" => $pembelian]);
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

    $conn->begin_transaction(); // Mulai transaksi

    try {
        // Ambil detail pembelian untuk mengembalikan stok
        $detail_stmt = $conn->prepare("SELECT kode_item, jumlah FROM detailpembelian WHERE id_pembelian = ?");
        $detail_stmt->bind_param("i", $id_pembelian);
        $detail_stmt->execute();
        $detail_result = $detail_stmt->get_result();

        $update_stok_stmt = $conn->prepare("UPDATE item SET jumlah_item = jumlah_item - ? WHERE kode_item = ?");

        while ($row = $detail_result->fetch_assoc()) {
            $kode_item = $row['kode_item'];
            $jumlah = $row['jumlah'];
            $update_stok_stmt->bind_param("is", $jumlah, $kode_item);
            $update_stok_stmt->execute();
        }

        // Hapus detail pembelian terkait
        $delete_detail_stmt = $conn->prepare("DELETE FROM detailpembelian WHERE id_pembelian = ?");
        $delete_detail_stmt->bind_param("i", $id_pembelian);
        $delete_detail_stmt->execute();

        // Hapus pembayaran terkait (jika ada)
        $delete_pembayaran_stmt = $conn->prepare("DELETE FROM pembayaran WHERE id_pembelian = ?");
        $delete_pembayaran_stmt->bind_param("i", $id_pembelian);
        $delete_pembayaran_stmt->execute();

        // Hapus pembelian
        $stmt = $conn->prepare("DELETE FROM pembelian WHERE id_pembelian = ?");
        $stmt->bind_param("i", $id_pembelian);
        if ($stmt->execute()) {
            $conn->commit(); // Commit transaksi jika semua berhasil
            echo json_encode(["status" => "success", "message" => "Pembelian berhasil dihapus dan stok dikembalikan."]);
        } else {
            throw new Exception("Terjadi kesalahan saat menghapus pembelian.");
        }
    } catch (Exception $e) {
        $conn->rollback(); // Rollback transaksi jika ada kesalahan
        echo json_encode(["status" => "error", "message" => "❌ Gagal menghapus pembelian: " . $e->getMessage()]);
    }
}


function getDetailPembelian() {
    global $conn;

    if (!isset($_GET['id_pembelian'])) {
        echo json_encode(["status" => "error", "message" => "ID pembelian tidak valid."]);
        return;
    }

    $id_pembelian = $_GET['id_pembelian'];

    // Query untuk mengambil detail pembelian
    $sql = "
        SELECT 
            dp.kode_item,
            i.nama,
            dp.jumlah,
            dp.harga_beli,
            dp.subtotal
        FROM detailpembelian dp
        JOIN item i ON dp.kode_item = i.kode_item
        WHERE dp.id_pembelian = ?
    ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_pembelian);
    $stmt->execute();
    $result = $stmt->get_result();


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


function getSupplierOptions() {
    global $conn;
    $result = $conn->query("SELECT kode_supplier, nama_supplier FROM supplier ORDER BY nama_supplier ASC");
    $options = "";
    while ($row = $result->fetch_assoc()) {
        $options .= "<option value='{$row['kode_supplier']}'>{$row['nama_supplier']} - {$row['kode_supplier']}</option>";
    }
    echo json_encode(["status" => "success", "options" => $options]);
}

// ===================================
// Fungsi-fungsi untuk Supplier
// ===================================

function getAllSuppliers() {
    global $conn;
    $result = $conn->query("SELECT * FROM supplier ORDER BY nama_supplier ASC");
    $suppliers = [];
    while ($row = $result->fetch_assoc()) {
        $suppliers[] = $row;
    }
    echo json_encode(["status" => "success", "data" => $suppliers]);
}

function insertSupplier() {
    global $conn;

    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        echo json_encode(["status" => "error", "message" => "⚠️ Harus menggunakan metode POST."]);
        return;
    }

    $kode_supplier = $_POST['kode_supplier'] ?? '';
    $nama_supplier = $_POST['nama_supplier'] ?? '';
    $alamat = $_POST['alamat'] ?? '';
    $kontak = $_POST['kontak'] ?? '';
    $email = $_POST['email'] ?? '';

    // Auto-generate kode_supplier jika kosong
    if (empty($kode_supplier)) {
        do {
            $kode_supplier = 'SUP' . random_int(1000, 9999); // SUP + 4 angka random
            $cek = $conn->prepare("SELECT kode_supplier FROM supplier WHERE kode_supplier = ?");
            $cek->bind_param("s", $kode_supplier);
            $cek->execute();
            $cek->store_result();
        } while ($cek->num_rows > 0);
    }

    if (empty($nama_supplier)) { // Kode supplier sudah ditangani auto-gen
        echo json_encode(["status" => "error", "message" => "⚠️ Nama Supplier harus diisi."]);
        return;
    }

    // Cek duplikat kode supplier (ini akan juga menangani jika user input manual kode yang sudah ada)
    $check_stmt = $conn->prepare("SELECT kode_supplier FROM supplier WHERE kode_supplier = ?");
    $check_stmt->bind_param("s", $kode_supplier);
    $check_stmt->execute();
    $check_stmt->store_result();
    if ($check_stmt->num_rows > 0 && $_POST['kode_supplier'] !== '') { // Hanya cek jika user input manual kode
        echo json_encode(["status" => "error", "message" => "⚠️ Kode Supplier '$kode_supplier' sudah ada. Silakan kosongkan atau gunakan kode lain."]);
        return;
    }


    $stmt = $conn->prepare("INSERT INTO supplier (kode_supplier, nama_supplier, alamat, kontak, email) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $kode_supplier, $nama_supplier, $alamat, $kontak, $email);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "✅ Supplier berhasil ditambahkan dengan kode: " . $kode_supplier]);
    } else {
        echo json_encode(["status" => "error", "message" => "❌ Gagal menambahkan supplier: " . $stmt->error]);
    }
}

function updateSupplier() {
    global $conn;

    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        echo json_encode(["status" => "error", "message" => "⚠️ Harus menggunakan metode POST."]);
        return;
    }

    $kode_supplier = $_POST['kode_supplier'] ?? '';
    $nama_supplier = $_POST['nama_supplier'] ?? '';
    $alamat = $_POST['alamat'] ?? '';
    $kontak = $_POST['kontak'] ?? '';
    $email = $_POST['email'] ?? '';

    if (empty($kode_supplier) || empty($nama_supplier)) {
        echo json_encode(["status" => "error", "message" => "⚠️ Kode dan Nama Supplier tidak boleh kosong."]);
        return;
    }

    $stmt = $conn->prepare("UPDATE supplier SET nama_supplier = ?, alamat = ?, kontak = ?, email = ? WHERE kode_supplier = ?");
    $stmt->bind_param("sssss", $nama_supplier, $alamat, $kontak, $email, $kode_supplier);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "✅ Supplier berhasil diupdate."]);
    } else {
        echo json_encode(["status" => "error", "message" => "❌ Gagal mengupdate supplier: " . $stmt->error]);
    }
}

function deleteSupplier($conn, $kode_supplier) {
    // Inisialisasi jumlah agar tidak undefined!
    $jumlah = 0;

    // Cek apakah supplier masih dipakai di pembelian
    $cek = $conn->prepare("SELECT COUNT(*) FROM pembelian WHERE kode_supplier=?");
    $cek->bind_param("s", $kode_supplier);
    $cek->execute();
    $cek->bind_result($jumlah);

    // cek->fetch() return true/false, isi $jumlah hanya jika fetch() true
    if ($cek->fetch() && $jumlah > 0) {
        $cek->close();
        return [
            'status' => 'error',
            'message' => 'Supplier tidak dapat dihapus karena masih digunakan pada transaksi pembelian.'
        ];
    }
    $cek->close();

    // Kalau tidak ada relasi, baru hapus
    $stmt = $conn->prepare("DELETE FROM supplier WHERE kode_supplier=?");
    $stmt->bind_param("s", $kode_supplier);
    $success = $stmt->execute();
    $stmt->close();

    if ($success) {
        return ['status' => 'success', 'message' => 'Supplier berhasil dihapus.'];
    } else {
        return ['status' => 'error', 'message' => 'Gagal menghapus supplier.'];
    }
}





// Tambahkan fungsi deleteMultiplePembelian
function deleteMultiplePembelian() {
    global $conn;

    $idsList = $_POST['ids_list'] ?? [];

    if (!is_array($idsList) || count($idsList) === 0) {
        echo json_encode(["status" => "error", "message" => "⚠️ Tidak ada transaksi pembelian terpilih."]);
        return;
    }

    $conn->begin_transaction(); // Mulai transaksi

    try {
        foreach ($idsList as $id_pembelian) {
            // 1. Ambil detail pembelian untuk mengembalikan stok
            $detail_stmt = $conn->prepare("SELECT kode_item, jumlah FROM detailpembelian WHERE id_pembelian = ?");
            $detail_stmt->bind_param("i", $id_pembelian);
            $detail_stmt->execute();
            $detail_result = $detail_stmt->get_result();

            $update_stok_stmt = $conn->prepare("UPDATE item SET jumlah_item = jumlah_item - ? WHERE kode_item = ?");

            while ($row = $detail_result->fetch_assoc()) {
                $kode_item = $row['kode_item'];
                $jumlah = $row['jumlah'];
                $update_stok_stmt->bind_param("is", $jumlah, $kode_item);
                $update_stok_stmt->execute();
            }
            $detail_stmt->close(); // Tutup statement setelah selesai

            // 2. Hapus detail pembelian terkait
            $delete_detail_stmt = $conn->prepare("DELETE FROM detailpembelian WHERE id_pembelian = ?");
            $delete_detail_stmt->bind_param("i", $id_pembelian);
            $delete_detail_stmt->execute();
            $delete_detail_stmt->close(); // Tutup statement setelah selesai

            // 3. Hapus pembayaran terkait (jika ada)
            $delete_pembayaran_stmt = $conn->prepare("DELETE FROM pembayaran WHERE id_pembelian = ?");
            $delete_pembayaran_stmt->bind_param("i", $id_pembelian);
            $delete_pembayaran_stmt->execute();
            $delete_pembayaran_stmt->close(); // Tutup statement setelah selesai

            // 4. Hapus pembelian dari tabel master
            $stmt = $conn->prepare("DELETE FROM pembelian WHERE id_pembelian = ?");
            $stmt->bind_param("i", $id_pembelian);
            $stmt->execute();
            $stmt->close(); // Tutup statement setelah selesai
        }

        $conn->commit(); // Commit transaksi jika semua berhasil
        echo json_encode(["status" => "success", "message" => "✅ Berhasil menghapus beberapa transaksi pembelian dan stok dikembalikan."]);
    } catch (Exception $e) {
        $conn->rollback(); // Rollback transaksi jika ada kesalahan
        echo json_encode(["status" => "error", "message" => "❌ Gagal menghapus transaksi pembelian: " . $e->getMessage()]);
    }
}

// Routing

if ($_SERVER["REQUEST_METHOD"] === "GET") {
if (isset($_GET['action'])) {
     if ($_GET['action'] === "getItemOptions") {
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
        } elseif ($_GET['action'] === "getSupplierOptions") { // Added for Pembelian
            getSupplierOptions(); exit;
        } elseif ($_GET['action'] === "getAllSuppliers") { // Tambahkan routing untuk get all suppliers
            getAllSuppliers(); exit;
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
            deleteMultipleItems(); exit;
        } elseif ($_POST['action'] === "insertPenjualan") {
            insertPenjualan(); exit;
        } elseif ($_POST['action'] === "insertPembelian") {
            insertPembelian(); exit;
        } elseif ($_POST['action'] === "updatePembelian") {
            updatePembelian(); exit;
        } elseif ($_POST['action'] === "deletePembelian") {
            deletePembelian(); exit;
        } elseif ($_POST['action'] === "insertItem") {
            insertItem(); exit;
        } elseif ($_POST['action'] === "insertSupplier") {
            insertSupplier(); exit;
        } elseif ($_POST['action'] === "updateSupplier") {
            updateSupplier(); exit;
        } elseif ($_POST['action'] === "deleteSupplier") {
    $kode_supplier = $_POST['kode_supplier'] ?? null; // <-- Tambahkan baris ini!
    $result = deleteSupplier($conn, $kode_supplier);
    echo json_encode($result); // <-- Jangan lupa ini biar hasil bisa dibaca JS-mu
    exit;
}

    }
    // Fallback if no action is specified in POST, assuming it's insertItem
    // This part might need refinement depending on overall API design philosophy
    // insertItem(); // ⬅️ Dihapus agar tidak menjadi fallback yang tidak jelas
    exit;
}
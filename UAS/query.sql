-- tugas.detailpenjualan definition

CREATE TABLE `detailpenjualan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kodetr` int DEFAULT NULL,
  `kode_item` varchar(50) DEFAULT NULL,
  `jumlah` int DEFAULT NULL,
  `subtotal` bigint DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kodetr` (`kodetr`),
  CONSTRAINT `detailpenjualan_ibfk_1` FOREIGN KEY (`kodetr`) REFERENCES `masterpenjualan` (`kodetr`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- tugas.item definition

CREATE TABLE `item` (
  `kode_item` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama` varchar(100) NOT NULL,
  `satuan` varchar(20) DEFAULT NULL,
  `harga` decimal(15,2) DEFAULT '0.00',
  `jumlah_item` int unsigned DEFAULT '0',
  PRIMARY KEY (`kode_item`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- tugas.masterpenjualan definition

CREATE TABLE `masterpenjualan` (
  `kodetr` int NOT NULL AUTO_INCREMENT,
  `tanggal` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `konsumen` varchar(100) DEFAULT NULL,
  `total_penjualan` bigint DEFAULT NULL,
  `totalqty` bigint DEFAULT NULL,
  PRIMARY KEY (`kodetr`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


CREATE TABLE `pembelian` (
  `id_pembelian` INT AUTO_INCREMENT PRIMARY KEY,   -- ID Pembelian (Primary Key)
  `kode_supplier` VARCHAR(50) NOT NULL,             -- Kode Supplier (Relasi dengan tabel Supplier)
  `tanggal_pembelian` TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Tanggal Pembelian
  `total_biaya` DECIMAL(15, 2) NOT NULL,            -- Total Biaya Pembelian
  `status_pembelian` ENUM('pending', 'lunas') DEFAULT 'pending', -- Status Pembelian (pending atau lunas)
  FOREIGN KEY (`kode_supplier`) REFERENCES `supplier`(`kode_supplier`) -- Relasi dengan Supplier
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


CREATE TABLE `detailpembelian` (
  `id_detail` INT AUTO_INCREMENT PRIMARY KEY,      -- ID Detail Pembelian (Primary Key)
  `id_pembelian` INT NOT NULL,                      -- ID Pembelian (Relasi dengan tabel Pembelian)
  `kode_item` VARCHAR(20) NOT NULL,                 -- Kode Item (Relasi dengan tabel Item)
  `jumlah` INT NOT NULL,                            -- Jumlah Item yang Dibeli
  `harga_beli` DECIMAL(15, 2) NOT NULL,             -- Harga Beli Per Item
  `subtotal` DECIMAL(15, 2) NOT NULL,               -- Subtotal untuk item (jumlah * harga_beli)
  FOREIGN KEY (`id_pembelian`) REFERENCES `pembelian`(`id_pembelian`), -- Relasi dengan Pembelian
  FOREIGN KEY (`kode_item`) REFERENCES `item`(`kode_item`) -- Relasi dengan Item
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


CREATE TABLE `supplier` (
  `kode_supplier` VARCHAR(50) PRIMARY KEY,          -- Kode Supplier
  `nama_supplier` VARCHAR(100) NOT NULL,            -- Nama Supplier
  `alamat` VARCHAR(255),                            -- Alamat Supplier
  `kontak` VARCHAR(50),                             -- Kontak Supplier (Nomor Telepon atau Email)
  `email` VARCHAR(100)                              -- Email Supplier
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


CREATE TABLE `pembayaran` (
  `id_pembayaran` INT AUTO_INCREMENT PRIMARY KEY,   -- ID Pembayaran (Primary Key)
  `id_pembelian` INT NOT NULL,                      -- ID Pembelian (Relasi dengan tabel Pembelian)
  `jumlah_bayar` DECIMAL(15, 2) NOT NULL,           -- Jumlah yang Dibayarkan
  `tanggal_bayar` TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Tanggal Pembayaran
  FOREIGN KEY (`id_pembelian`) REFERENCES `pembelian`(`id_pembelian`) -- Relasi dengan Pembelian
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
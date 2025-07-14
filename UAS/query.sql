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
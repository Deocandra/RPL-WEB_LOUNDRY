-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 11, 2026 at 02:08 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_laundry`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id_booking` int NOT NULL,
  `id_customer` int NOT NULL,
  `id_layanan` int NOT NULL,
  `tanggal_booking` date NOT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `berat` decimal(5,2) NOT NULL,
  `total_harga` int NOT NULL,
  `status` enum('menunggu','diproses','selesai','diambil') DEFAULT 'menunggu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id_booking`, `id_customer`, `id_layanan`, `tanggal_booking`, `tanggal_selesai`, `berat`, `total_harga`, `status`) VALUES
(1, 1, 1, '2026-05-10', '2026-05-13', '3.50', 17500, 'diproses'),
(2, 2, 2, '2026-05-11', '2026-05-12', '2.00', 16000, 'menunggu');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id_customer` int NOT NULL,
  `nama_customer` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `alamat` text,
  `no_hp` varchar(15) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_customer`, `nama_customer`, `email`, `password`, `alamat`, `no_hp`, `created_at`) VALUES
(1, 'Budi Santoso', 'budi@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Surabaya', '081234567890', '2026-05-11 02:05:34'),
(2, 'Siti Aminah', 'siti@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Madura', '082345678901', '2026-05-11 02:05:34');

-- --------------------------------------------------------

--
-- Stand-in structure for view `laporan_laundry`
-- (See below for the actual view)
--
CREATE TABLE `laporan_laundry` (
`berat` decimal(5,2)
,`id_booking` int
,`nama_customer` varchar(100)
,`nama_layanan` varchar(100)
,`status` enum('menunggu','diproses','selesai','diambil')
,`status_pembayaran` enum('pending','valid','tidak valid')
,`tanggal_booking` date
,`total_harga` int
);

-- --------------------------------------------------------

--
-- Table structure for table `layanan`
--

CREATE TABLE `layanan` (
  `id_layanan` int NOT NULL,
  `nama_layanan` varchar(100) NOT NULL,
  `harga_per_kg` int NOT NULL,
  `deskripsi` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `layanan`
--

INSERT INTO `layanan` (`id_layanan`, `nama_layanan`, `harga_per_kg`, `deskripsi`) VALUES
(1, 'Cuci Reguler', 5000, 'Pengerjaan 3 hari'),
(2, 'Cuci Kilat', 8000, 'Pengerjaan 1 hari'),
(3, 'Cuci + Setrika', 7000, 'Cuci dan setrika'),
(4, 'Setrika Saja', 4000, 'Hanya setrika');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int NOT NULL,
  `id_booking` int NOT NULL,
  `metode_pembayaran` enum('cash','transfer','e-wallet') NOT NULL,
  `jumlah_bayar` int NOT NULL,
  `tanggal_pembayaran` date NOT NULL,
  `status_pembayaran` enum('pending','valid','tidak valid') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_booking`, `metode_pembayaran`, `jumlah_bayar`, `tanggal_pembayaran`, `status_pembayaran`) VALUES
(1, 1, 'cash', 17500, '2026-05-10', 'valid'),
(2, 2, 'transfer', 16000, '2026-05-11', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','karyawan') NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama`, `username`, `password`, `role`, `created_at`) VALUES
(1, 'Administrator', 'admin', '0192023a7bbd73250516f069df18b500', 'admin', '2026-05-11 02:05:34'),
(2, 'Karyawan Laundry', 'karyawan', '07142c5501c3ea09303d899012e2b47d', 'karyawan', '2026-05-11 02:05:34');

-- --------------------------------------------------------

--
-- Structure for view `laporan_laundry`
--
DROP TABLE IF EXISTS `laporan_laundry`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `laporan_laundry`  AS SELECT `b`.`id_booking` AS `id_booking`, `c`.`nama_customer` AS `nama_customer`, `l`.`nama_layanan` AS `nama_layanan`, `b`.`berat` AS `berat`, `b`.`total_harga` AS `total_harga`, `b`.`status` AS `status`, `p`.`status_pembayaran` AS `status_pembayaran`, `b`.`tanggal_booking` AS `tanggal_booking` FROM (((`booking` `b` join `customer` `c` on((`b`.`id_customer` = `c`.`id_customer`))) join `layanan` `l` on((`b`.`id_layanan` = `l`.`id_layanan`))) left join `pembayaran` `p` on((`b`.`id_booking` = `p`.`id_booking`)))  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id_booking`),
  ADD KEY `id_customer` (`id_customer`),
  ADD KEY `id_layanan` (`id_layanan`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`id_layanan`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_booking` (`id_booking`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id_booking` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id_customer` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `layanan`
--
ALTER TABLE `layanan`
  MODIFY `id_layanan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id_customer`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`id_layanan`) REFERENCES `layanan` (`id_layanan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`id_booking`) REFERENCES `booking` (`id_booking`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

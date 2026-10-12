-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2026 at 07:24 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbumkm`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_produk_masuk`
--

CREATE TABLE `detail_produk_masuk` (
  `id_detail` int(11) NOT NULL,
  `id_masuk` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_produk_masuk`
--

INSERT INTO `detail_produk_masuk` (`id_detail`, `id_masuk`, `id_produk`, `jumlah`) VALUES
(1, 1, 10, 6),
(2, 1, 10, 4),
(3, 2, 10, 2),
(4, 3, 10, 2),
(5, 3, 12, 2),
(6, 4, 12, 3),
(7, 5, 12, 1),
(8, 6, 12, 2),
(9, 7, 12, 2),
(10, 8, 12, 2),
(11, 9, 10, 5),
(12, 10, 10, 6),
(13, 11, 12, 10),
(14, 12, 10, 3),
(15, 13, 10, 4),
(16, 13, 12, 2),
(17, 13, 10, 3),
(18, 14, 10, 3),
(19, 15, 12, 2),
(20, 16, 10, 5),
(21, 17, 10, 20),
(22, 18, 12, 10),
(23, 19, 12, 4),
(24, 20, 12, 5),
(25, 21, 12, 6),
(26, 22, 12, 500),
(27, 22, 12, 500),
(28, 23, 10, 50),
(29, 24, 10, 39),
(30, 25, 10, 2);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(100) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `harga`, `stok`, `gambar`) VALUES
(10, 'P1', 10000, 215, 'dark-black-texture-background.jpg'),
(12, 'pria solo', 19000000, 1051, 'noriyuki-makihara.jpg'),
(15, 'Sawit', 50000, 3858, 'sawit.gif'),
(16, 'Kopi', 10000, 545, 'kopii.gif');

-- --------------------------------------------------------

--
-- Table structure for table `produk_masuk`
--

CREATE TABLE `produk_masuk` (
  `id_masuk` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `id_staf` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk_masuk`
--

INSERT INTO `produk_masuk` (`id_masuk`, `tanggal`, `id_staf`) VALUES
(1, '2026-03-29', 1),
(2, '2026-03-29', 1),
(3, '2026-03-29', 1),
(4, '2026-03-29', 1),
(5, '2026-03-29', 1),
(6, '2026-03-29', 1),
(7, '2026-03-29', 1),
(8, '2026-03-29', 1),
(9, '2026-03-29', 1),
(10, '2026-03-29', 1),
(11, '2026-03-29', 1),
(12, '2026-03-29', 1),
(13, '2026-03-29', 1),
(14, '2026-03-29', 0),
(15, '2026-03-29', 0),
(16, '2026-03-29', 0),
(17, '2026-03-30', 0),
(18, '2026-03-30', 0),
(19, '2026-03-30', 0),
(20, '2026-03-30', 0),
(21, '2026-03-30', 0),
(22, '2026-03-30', 15),
(23, '2026-03-30', 15),
(24, '2026-03-30', 15),
(25, '2026-05-18', 15);

-- --------------------------------------------------------

--
-- Table structure for table `staf`
--

CREATE TABLE `staf` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `level` enum('admin','staf') DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staf`
--

INSERT INTO `staf` (`id`, `username`, `password`, `nama`, `level`) VALUES
(15, 'thomatho', '628b2c61eb4d3de097ec99cdf7e6b68a', 'teronk', 'admin');

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_laporan_pembelian`
-- (See below for the actual view)
--
CREATE TABLE `v_laporan_pembelian` (
`id_masuk` int(11)
,`tanggal` date
,`nama_produk` varchar(100)
,`jumlah` int(11)
);

-- --------------------------------------------------------

--
-- Structure for view `v_laporan_pembelian`
--
DROP TABLE IF EXISTS `v_laporan_pembelian`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_laporan_pembelian`  AS SELECT `pm`.`id_masuk` AS `id_masuk`, `pm`.`tanggal` AS `tanggal`, `p`.`nama_produk` AS `nama_produk`, `dpm`.`jumlah` AS `jumlah` FROM ((`produk_masuk` `pm` left join `detail_produk_masuk` `dpm` on(`pm`.`id_masuk` = `dpm`.`id_masuk`)) left join `produk` `p` on(`p`.`id_produk` = `dpm`.`id_produk`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_produk_masuk`
--
ALTER TABLE `detail_produk_masuk`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `produk_masuk`
--
ALTER TABLE `produk_masuk`
  ADD PRIMARY KEY (`id_masuk`);

--
-- Indexes for table `staf`
--
ALTER TABLE `staf`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_produk_masuk`
--
ALTER TABLE `detail_produk_masuk`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `produk_masuk`
--
ALTER TABLE `produk_masuk`
  MODIFY `id_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `staf`
--
ALTER TABLE `staf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

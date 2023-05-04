-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2021 at 03:41 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zhot_petshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) UNSIGNED NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `nama_barang` varchar(1000) NOT NULL,
  `harga_ecer` int(11) DEFAULT NULL,
  `harga_modal` int(11) DEFAULT NULL,
  `stok` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `kode_barang`, `nama_barang`, `harga_ecer`, `harga_modal`, `stok`, `created_at`, `updated_at`) VALUES
(19, '2323700185040', 'Royal Canin 500gr', 30000, 25000, 12, '2021-06-21 13:10:19', '2021-07-10 15:25:38'),
(22, '8999999526382', 'Tresemme Cond', 24000, 20000, 0, '2021-06-27 18:25:46', '2021-07-11 11:48:04'),
(23, '8999999573089', 'Dove Shampoo', 23500, 20000, 11, '2021-06-27 18:28:03', '2021-07-11 12:12:43'),
(24, '8998866105668', 'Lovely White UV', 17500, 15000, 14, '2021-06-27 18:29:13', '2021-07-11 12:12:43'),
(26, '1949192213071', 'Kacamata', 150000, 100000, 9, '2021-07-11 12:09:42', '2021-07-11 12:12:43');

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id_masuk` int(11) UNSIGNED NOT NULL,
  `jumlah_masuk` int(11) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `nama_supplier` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `id_barang` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `barang_masuk`
--

INSERT INTO `barang_masuk` (`id_masuk`, `jumlah_masuk`, `harga_beli`, `nama_supplier`, `created_at`, `updated_at`, `id_barang`) VALUES
(18, 20, 25000, 'UHUY', '2021-07-05 13:13:39', '2021-07-05 13:13:39', 19),
(19, 20, 20000, 'Borma', '2021-07-05 13:14:12', '2021-07-05 13:14:12', 22),
(20, 20, 20000, 'Borma', '2021-07-05 13:14:22', '2021-07-05 13:14:22', 23),
(21, 20, 15000, 'Griya', '2021-07-05 13:14:36', '2021-07-05 13:14:36', 24),
(22, 10, 100000, 'abcd', '2021-07-11 12:10:59', '2021-07-11 12:10:59', 26);

-- --------------------------------------------------------

--
-- Table structure for table `barang_reject`
--

CREATE TABLE `barang_reject` (
  `id_reject` int(11) UNSIGNED NOT NULL,
  `alasan` varchar(1000) NOT NULL,
  `jumlah_reject` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `id_barang` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `kasir`
--

CREATE TABLE `kasir` (
  `id_kasir` int(11) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `level` enum('1','2') NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kasir`
--

INSERT INTO `kasir` (`id_kasir`, `username`, `pass`, `level`, `created_at`, `updated_at`) VALUES
(2, 'fajarikhsan', '$2y$10$mS7t1qoInfQTHajZEaJOEOuGDVUfTyn68cefEZetVKG2HNGGU7wOy', '1', '2021-07-10 11:01:32', '2021-07-10 12:24:07'),
(3, 'muis', '$2y$10$gMzgZrc/ru7wa80aADIkweLQn3E6Q4qPUOm7gubaimrQDKlE/mCjm', '1', '2021-07-10 11:21:52', '2021-07-10 11:21:52'),
(4, 'lia', '$2y$10$ng2jaYqQIb6YF.lTyBrbve.SrWNNpOM.Jrek8lyqbrrQ6q..OgWt2', '2', '2021-07-10 14:37:43', '2021-07-10 14:37:43');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2021-06-07-023109', 'App\\Database\\Migrations\\Barang', 'default', 'App', 1623037022, 1),
(2, '2021-06-07-023141', 'App\\Database\\Migrations\\BarangReject', 'default', 'App', 1623037023, 1),
(3, '2021-06-07-023146', 'App\\Database\\Migrations\\BarangMasuk', 'default', 'App', 1623037023, 1),
(4, '2021-06-07-023208', 'App\\Database\\Migrations\\Kasir', 'default', 'App', 1623037024, 1),
(5, '2021-06-07-033622', 'App\\Database\\Migrations\\Transaksi', 'default', 'App', 1623037024, 1),
(6, '2021-06-07-033643', 'App\\Database\\Migrations\\Penjualan', 'default', 'App', 1623037025, 1);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `id_barang` int(11) UNSIGNED NOT NULL,
  `id_transaksi` int(11) UNSIGNED NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `id_barang`, `id_transaksi`, `qty`, `created_at`, `updated_at`) VALUES
(55, 24, 41, 1, '2021-07-10 15:02:42', '2021-07-10 15:02:42'),
(56, 19, 41, 2, '2021-07-10 15:02:42', '2021-07-10 15:02:42'),
(57, 24, 42, 1, '2021-07-10 15:05:37', '2021-07-10 15:05:37'),
(58, 22, 42, 4, '2021-07-10 15:05:37', '2021-07-10 15:05:37'),
(59, 19, 43, 2, '2021-07-10 15:25:38', '2021-07-10 15:25:38'),
(60, 23, 44, 1, '2021-07-11 11:44:50', '2021-07-11 11:44:50'),
(61, 24, 44, 1, '2021-07-11 11:44:50', '2021-07-11 11:44:50'),
(62, 22, 44, 1, '2021-07-11 11:44:50', '2021-07-11 11:44:50'),
(63, 22, 45, 8, '2021-07-11 11:47:18', '2021-07-11 11:47:18'),
(64, 22, 46, 2, '2021-07-11 11:48:04', '2021-07-11 11:48:04'),
(65, 24, 47, 1, '2021-07-11 12:12:43', '2021-07-11 12:12:43'),
(66, 23, 47, 1, '2021-07-11 12:12:43', '2021-07-11 12:12:43'),
(67, 26, 47, 1, '2021-07-11 12:12:43', '2021-07-11 12:12:43');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) UNSIGNED NOT NULL,
  `sub_total` int(11) NOT NULL,
  `diskon` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `pembayaran` int(11) NOT NULL,
  `kembalian` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `id_kasir` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `sub_total`, `diskon`, `total_harga`, `pembayaran`, `kembalian`, `created_at`, `updated_at`, `id_kasir`) VALUES
(41, 77500, 7750, 69750, 70000, 250, '2021-07-10 15:02:41', '2021-07-10 15:02:41', 2),
(42, 113500, 0, 113500, 120000, 6500, '2021-07-10 15:05:37', '2021-07-10 15:05:37', 2),
(43, 60000, 0, 60000, 60000, 0, '2021-07-10 15:25:38', '2021-07-10 15:25:38', 4),
(44, 65000, 0, 65000, 65000, 0, '2021-07-11 11:44:50', '2021-07-11 11:44:50', 2),
(45, 192000, 0, 192000, 192000, 0, '2021-07-11 11:47:18', '2021-07-11 11:47:18', 2),
(46, 48000, 0, 48000, 48000, 0, '2021-07-11 11:48:04', '2021-07-11 11:48:04', 2),
(47, 191000, 19100, 171900, 172000, 100, '2021-07-11 12:12:43', '2021-07-11 12:12:43', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id_masuk`),
  ADD KEY `barang_masuk_id_barang_foreign` (`id_barang`);

--
-- Indexes for table `barang_reject`
--
ALTER TABLE `barang_reject`
  ADD PRIMARY KEY (`id_reject`),
  ADD KEY `barang_reject_id_barang_foreign` (`id_barang`);

--
-- Indexes for table `kasir`
--
ALTER TABLE `kasir`
  ADD PRIMARY KEY (`id_kasir`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`),
  ADD KEY `penjualan_id_barang_foreign` (`id_barang`),
  ADD KEY `penjualan_id_transaksi_foreign` (`id_transaksi`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `transaksi_id_kasir_foreign` (`id_kasir`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `id_masuk` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `barang_reject`
--
ALTER TABLE `barang_reject`
  MODIFY `id_reject` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kasir`
--
ALTER TABLE `kasir`
  MODIFY `id_kasir` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD CONSTRAINT `barang_masuk_id_barang_foreign` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE;

--
-- Constraints for table `barang_reject`
--
ALTER TABLE `barang_reject`
  ADD CONSTRAINT `barang_reject_id_barang_foreign` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE;

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_id_barang_foreign` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penjualan_id_transaksi_foreign` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_id_kasir_foreign` FOREIGN KEY (`id_kasir`) REFERENCES `kasir` (`id_kasir`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

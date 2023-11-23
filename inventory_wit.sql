-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2023 at 11:19 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory_wit`
--

-- --------------------------------------------------------

--
-- Table structure for table `history_pemakaian`
--

CREATE TABLE `history_pemakaian` (
  `id` int(11) NOT NULL,
  `nomor_induk_old` varchar(20) DEFAULT NULL,
  `nomor_induk_new` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `ruangan_old` varchar(20) DEFAULT NULL,
  `ruangan_new` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kode_aset` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `history_pemakaian`
--

INSERT INTO `history_pemakaian` (`id`, `nomor_induk_old`, `nomor_induk_new`, `tanggal`, `ruangan_old`, `ruangan_new`, `created_at`, `updated_at`, `kode_aset`) VALUES
(24, NULL, '0653413456', '2023-11-23', NULL, 'UMJ', NULL, NULL, 'KOM-2023102317442'),
(25, NULL, '12345', '2023-11-23', NULL, 'R01', NULL, NULL, 'LAP-20231022104918');

-- --------------------------------------------------------

--
-- Table structure for table `history_perbaikan`
--

CREATE TABLE `history_perbaikan` (
  `id` int(11) NOT NULL,
  `tanggal_perbaikan` date DEFAULT NULL,
  `biaya` int(11) DEFAULT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `tanggal_kerusakan` date NOT NULL,
  `tanggal_selesai_perbaikan` date DEFAULT NULL,
  `tempat_perbaikan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kode_aset` varchar(20) NOT NULL,
  `karyawan_perbaikan` varchar(20) DEFAULT NULL,
  `pemakai_terakhir` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `history_perbaikan`
--

INSERT INTO `history_perbaikan` (`id`, `tanggal_perbaikan`, `biaya`, `deskripsi`, `tanggal_kerusakan`, `tanggal_selesai_perbaikan`, `tempat_perbaikan`, `created_at`, `updated_at`, `kode_aset`, `karyawan_perbaikan`, `pemakai_terakhir`) VALUES
(22, '2023-11-07', NULL, 'Mati', '2023-11-06', NULL, NULL, '2023-11-23 03:15:18', '2023-11-23 03:15:38', 'KOM-2023102317442', NULL, '0653413456'),
(23, NULL, NULL, 'LCD', '2023-11-13', NULL, NULL, '2023-11-23 03:16:08', '2023-11-23 03:16:08', 'LAP-20231022104918', NULL, '12345');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `kode_aset` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `merk` varchar(45) NOT NULL,
  `tanggal` date NOT NULL,
  `harga` int(11) NOT NULL,
  `nilai_residu` int(11) DEFAULT NULL,
  `masa_manfaat` int(11) DEFAULT NULL,
  `depresiasi` int(11) DEFAULT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL,
  `id_kategori` varchar(3) DEFAULT NULL,
  `tahun_1` int(11) DEFAULT NULL,
  `tahun_2` int(11) DEFAULT NULL,
  `tahun_3` int(11) DEFAULT NULL,
  `tahun_4` int(11) DEFAULT NULL,
  `img_url` varchar(255) DEFAULT NULL,
  `vendor` varchar(100) DEFAULT NULL,
  `nomor_induk` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`kode_aset`, `nama`, `merk`, `tanggal`, `harga`, `nilai_residu`, `masa_manfaat`, `depresiasi`, `deskripsi`, `status`, `id_kategori`, `tahun_1`, `tahun_2`, `tahun_3`, `tahun_4`, `img_url`, `vendor`, `nomor_induk`, `created_at`, `updated_at`) VALUES
('KOM-2023102317442', 'Komputer', 'HP', '2021-02-20', 20000000, 5000000, 4, 3750000, 'RAM 8', 'perbaikan', 'APK', 16250000, 12500000, 8750000, 5000000, NULL, 'PT.', '0653413456', '2023-11-23 03:05:38', '2023-11-23 03:15:38'),
('LAP-20231022104918', 'Laptop', 'Asus', '2021-02-28', 15000000, 3750000, 4, 2812500, 'RAM 8', 'rusak', 'APK', 12187500, 9375000, 6562500, 3750000, NULL, 'PT. Cek', '12345', '2023-11-21 20:49:46', '2023-11-23 03:16:08'),
('MOU-20231023171146', 'Mouse', 'X', '2021-03-01', 300000, 75000, 4, 56250, '-', 'normal', 'APK', 243750, 187500, 131250, 75000, NULL, 'PT.', '54321', '2023-11-23 03:12:20', '2023-11-23 03:12:42');

-- --------------------------------------------------------

--
-- Table structure for table `kantor`
--

CREATE TABLE `kantor` (
  `id_kantor` int(11) NOT NULL,
  `kota` varchar(20) NOT NULL,
  `kecamatan` varchar(30) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kantor`
--

INSERT INTO `kantor` (`id_kantor`, `kota`, `kecamatan`, `alamat`, `telepon`, `created_at`, `updated_at`) VALUES
(1, 'Jakarta', 'Kebayoran Lama', 'Jakarta Selatan', '0986543212', NULL, NULL),
(2, 'Bandung', 'Sukajadi', 'Jl. Sukakarya', '0986732221', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `nomor_induk` varchar(20) NOT NULL,
  `img_url` varchar(255) DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `jabatan` varchar(20) NOT NULL,
  `divisi` varchar(20) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`nomor_induk`, `img_url`, `nama`, `gender`, `email`, `telepon`, `jabatan`, `divisi`, `alamat`, `created_at`, `updated_at`) VALUES
('0653413456', NULL, 'John', 0, 'john@gmail.com', '08256789', 'Staff', 'Security', 'Jl. Boulevard', NULL, NULL),
('12345', NULL, 'Reyhan', 0, 'rey@gmail.com', '+6289123456780', 'Staff', 'IT', 'Bandung', '2023-11-23 03:07:25', '2023-11-23 03:07:25'),
('54321', NULL, 'Jennie', 1, 'jen@gmail.com', '+6289123456789', 'Staff', 'IT', 'Bandung', '2023-11-23 03:04:12', '2023-11-23 03:04:12');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` varchar(3) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama`, `created_at`, `updated_at`) VALUES
('APK', 'Aset Perangkat Keras', NULL, NULL),
('APL', 'Aset Perangkat Lunak', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pemakaian`
--

CREATE TABLE `pemakaian` (
  `id` int(11) NOT NULL,
  `kode_aset` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_ruangan` varchar(5) DEFAULT NULL,
  `nomor_induk` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `pemakaian`
--

INSERT INTO `pemakaian` (`id`, `kode_aset`, `created_at`, `updated_at`, `id_ruangan`, `nomor_induk`) VALUES
(18, 'LAP-20231022104918', '2023-11-21 20:49:46', '2023-11-23 03:09:04', 'R01', '12345'),
(22, 'KOM-2023102317442', '2023-11-23 03:05:39', '2023-11-23 03:06:13', 'UMJ', '0653413456'),
(23, 'MOU-20231023171146', '2023-11-23 03:12:20', '2023-11-23 03:12:20', NULL, NULL);

--
-- Triggers `pemakaian`
--
DELIMITER $$
CREATE TRIGGER `update_pemakaian` AFTER UPDATE ON `pemakaian` FOR EACH ROW BEGIN

IF(NEW.nomor_induk OR NEW.id_ruangan) THEN

INSERT INTO history_pemakaian (nomor_induk_old, nomor_induk_new, tanggal, ruangan_old, ruangan_new, kode_aset) VALUES (OLD.nomor_induk, NEW.nomor_induk, CURDATE(),OLD.id_ruangan, NEW.id_ruangan, NEW.kode_aset );

END IF;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `ruangan`
--

CREATE TABLE `ruangan` (
  `id_ruangan` varchar(5) NOT NULL,
  `nama` varchar(45) NOT NULL,
  `lantai` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_kantor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `ruangan`
--

INSERT INTO `ruangan` (`id_ruangan`, `nama`, `lantai`, `created_at`, `updated_at`, `id_kantor`) VALUES
('MGB', 'Ruang Magang', 'lantai 1', NULL, '2023-11-20 22:56:21', 1),
('R01', 'Ruangan 1', 'Lantai 1', '2023-11-21 20:48:44', '2023-11-23 03:02:31', 2),
('UMJ', 'Ruang Umum', 'lantai 2', NULL, '2023-11-20 22:57:36', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(4, 'admin', 'admin@gmail.com', '$2y$10$T8taA3IuF2qpW/.CAj56uOwlgSFLdG66x.OCOerV01hESfu6/YqIi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `history_pemakaian`
--
ALTER TABLE `history_pemakaian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_history_pemakaian_inventory1_idx` (`kode_aset`);

--
-- Indexes for table `history_perbaikan`
--
ALTER TABLE `history_perbaikan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_history_perbaikan_inventory1_idx` (`kode_aset`),
  ADD KEY `fk_history_perbaikan_karyawan1` (`karyawan_perbaikan`),
  ADD KEY `fk_history_perbaikan_karyawan2` (`pemakai_terakhir`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`kode_aset`),
  ADD KEY `fk_inventory_kategori1_idx` (`id_kategori`),
  ADD KEY `fk_inventory_karyawan1_idx` (`nomor_induk`);

--
-- Indexes for table `kantor`
--
ALTER TABLE `kantor`
  ADD PRIMARY KEY (`id_kantor`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`nomor_induk`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `pemakaian`
--
ALTER TABLE `pemakaian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pemakaian_inventory1_idx` (`kode_aset`),
  ADD KEY `fk_pemakaian_ruangan1_idx` (`id_ruangan`),
  ADD KEY `fk_pemakaian_karyawan1_idx` (`nomor_induk`);

--
-- Indexes for table `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`id_ruangan`),
  ADD KEY `fk_ruangan_kantor1_idx` (`id_kantor`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `history_pemakaian`
--
ALTER TABLE `history_pemakaian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `history_perbaikan`
--
ALTER TABLE `history_perbaikan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `kantor`
--
ALTER TABLE `kantor`
  MODIFY `id_kantor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pemakaian`
--
ALTER TABLE `pemakaian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `history_pemakaian`
--
ALTER TABLE `history_pemakaian`
  ADD CONSTRAINT `fk_history_pemakaian_inventory1` FOREIGN KEY (`kode_aset`) REFERENCES `inventory` (`kode_aset`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `history_perbaikan`
--
ALTER TABLE `history_perbaikan`
  ADD CONSTRAINT `fk_history_perbaikan_inventory1` FOREIGN KEY (`kode_aset`) REFERENCES `inventory` (`kode_aset`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_history_perbaikan_karyawan1` FOREIGN KEY (`karyawan_perbaikan`) REFERENCES `karyawan` (`nomor_induk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_history_perbaikan_karyawan2` FOREIGN KEY (`pemakai_terakhir`) REFERENCES `karyawan` (`nomor_induk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `fk_inventory_karyawan1` FOREIGN KEY (`nomor_induk`) REFERENCES `karyawan` (`nomor_induk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_inventory_kategori1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pemakaian`
--
ALTER TABLE `pemakaian`
  ADD CONSTRAINT `fk_pemakaian_inventory1` FOREIGN KEY (`kode_aset`) REFERENCES `inventory` (`kode_aset`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pemakaian_karyawan1` FOREIGN KEY (`nomor_induk`) REFERENCES `karyawan` (`nomor_induk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pemakaian_ruangan1` FOREIGN KEY (`id_ruangan`) REFERENCES `ruangan` (`id_ruangan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ruangan`
--
ALTER TABLE `ruangan`
  ADD CONSTRAINT `fk_ruangan_kantor1` FOREIGN KEY (`id_kantor`) REFERENCES `kantor` (`id_kantor`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

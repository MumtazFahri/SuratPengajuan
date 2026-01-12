-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 11, 2025 at 03:33 AM
-- Server version: 5.7.39
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_surat`
--

-- --------------------------------------------------------

--
-- Table structure for table `progress`
--

CREATE TABLE `progress` (
  `id` int(11) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `progress`
--

INSERT INTO `progress` (`id`, `value`) VALUES
(1, 4),
(2, 3),
(3, 8),
(5, 10);

-- --------------------------------------------------------

--
-- Table structure for table `surat`
--

CREATE TABLE `surat` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  `nama_kegiatan` varchar(255) DEFAULT NULL,
  `jenis_date` varchar(50) DEFAULT NULL,
  `tanggal_kegiatan` date DEFAULT NULL,
  `akhir_kegiatan` date DEFAULT NULL,
  `periode_penugasan` date DEFAULT NULL,
  `akhir_periode_penugasan` date DEFAULT NULL,
  `periode_value` varchar(50) DEFAULT NULL,
  `tempat_kegiatan` varchar(255) DEFAULT NULL,
  `penyelenggara` varchar(255) DEFAULT NULL,
  `jenis_pengajuan` varchar(50) DEFAULT NULL,
  `lingkup_penugasan` varchar(50) DEFAULT NULL,
  `jenis_penugasan_perorangan` varchar(50) DEFAULT NULL,
  `penugasan_lainnya_perorangan` varchar(255) DEFAULT NULL,
  `jenis_penugasan_kelompok` varchar(50) DEFAULT NULL,
  `penugasan_lainnya_kelompok` varchar(255) DEFAULT NULL,
  `format` int(11) DEFAULT NULL,
  `nip` text,
  `nama_dosen` text,
  `jabatan` text,
  `divisi` text,
  `eviden` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `progress`
--
ALTER TABLE `progress`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat`
--
ALTER TABLE `surat`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `progress`
--
ALTER TABLE `progress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `surat`
--
ALTER TABLE `surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 21, 2017 at 02:53 PM
-- Server version: 10.0.31-MariaDB-0ubuntu0.16.04.2
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventaris`
--

-- --------------------------------------------------------

--
-- Table structure for table `alat_keluar`
--

CREATE TABLE `alat_keluar` (
  `id_alat_keluar` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_alat` varchar(10) NOT NULL,
  `jumlah_keluar` varchar(10) NOT NULL,
  `penyaluran` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `alat_keluar`
--

INSERT INTO `alat_keluar` (`id_alat_keluar`, `id_transaksi`, `id_alat`, `jumlah_keluar`, `penyaluran`) VALUES
(1, 3, 'A001', '10', 'Poli Umum'),
(2, 11, 'MU1234', '5', 'Poli Umum'),
(3, 18, '324324', '25', 'Poli Umum'),
(4, 20, '324324', '25', 'Poli Umum'),
(5, 25, '324324', '20', 'Poli Umum'),
(6, 26, 'MU1234', '20', 'Poli Umum');

-- --------------------------------------------------------

--
-- Table structure for table `alat_kesehatan`
--

CREATE TABLE `alat_kesehatan` (
  `id_alat` varchar(10) NOT NULL,
  `satuan` set('pcs','buah') NOT NULL,
  `stok_alat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `alat_kesehatan`
--

INSERT INTO `alat_kesehatan` (`id_alat`, `satuan`, `stok_alat`) VALUES
('324324', 'pcs', 5),
('A001', 'pcs', 65),
('MU1234', 'pcs', 5);

-- --------------------------------------------------------

--
-- Table structure for table `alat_masuk`
--

CREATE TABLE `alat_masuk` (
  `id_alat_masuk` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_alat` varchar(10) NOT NULL,
  `jumlah_masuk` int(11) NOT NULL,
  `asal` varchar(20) NOT NULL,
  `tahun` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `alat_masuk`
--

INSERT INTO `alat_masuk` (`id_alat_masuk`, `id_transaksi`, `id_alat`, `jumlah_masuk`, `asal`, `tahun`) VALUES
(4, 5, 'MU1234', 1, 'APBD', 0000),
(6, 7, 'MU1234', 9, 'APBD', 0000),
(9, 10, 'MU1234', 20, 'APBD', 0000),
(10, 12, '324324', 0, 'APBD', 2017),
(11, 13, '324324', 20, 'APBD', 2017),
(12, 19, '324324', 30, 'APBD', 2017),
(13, 21, '324324', 25, 'APBD', 2017);

-- --------------------------------------------------------

--
-- Table structure for table `alat_rusak`
--

CREATE TABLE `alat_rusak` (
  `id_alat_rusak` int(11) NOT NULL,
  `id_alat` varchar(10) NOT NULL,
  `jumlah_rusak` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `alat_rusak`
--

INSERT INTO `alat_rusak` (`id_alat_rusak`, `id_alat`, `jumlah_rusak`) VALUES
(3, 'A001', 5);

-- --------------------------------------------------------

--
-- Table structure for table `detail_alat`
--

CREATE TABLE `detail_alat` (
  `id_alat` varchar(10) NOT NULL,
  `nama_alat` varchar(20) NOT NULL,
  `gambar` varchar(250) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_alat`
--

INSERT INTO `detail_alat` (`id_alat`, `nama_alat`, `gambar`, `keterangan`) VALUES
('', '', '', ''),
('324324', 'ewfwef', '1498021129.jpg', 'te'),
('A001', 'Kain Kasa', '1497542333.jpeg', 'ini adalah kain kasa'),
('MU1234', 'test', '1498017304.jpg', 'tes');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `nama_pengguna` varchar(50) NOT NULL,
  `sandi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `nama_pengguna`, `sandi`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_alat` varchar(10) NOT NULL,
  `type` set('masuk','keluar') NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_alat`, `type`, `tanggal`) VALUES
(3, 'A001', 'keluar', '2017-06-14'),
(5, 'MU1234', 'masuk', '2017-06-21'),
(7, 'MU1234', 'masuk', '2017-06-21'),
(10, 'MU1234', 'masuk', '2017-06-21'),
(11, 'MU1234', 'keluar', '2017-06-21'),
(12, '324324', 'masuk', '2017-06-21'),
(13, '324324', 'masuk', '2017-07-03'),
(14, '324324', 'keluar', '2017-07-03'),
(15, '324324', 'keluar', '2017-07-03'),
(16, '324324', 'keluar', '2017-07-03'),
(17, '324324', 'keluar', '2017-07-03'),
(18, '324324', 'keluar', '2017-07-03'),
(19, '324324', 'masuk', '2017-07-03'),
(20, '324324', 'keluar', '2017-07-03'),
(21, '324324', 'masuk', '2017-07-03'),
(22, '324324', 'keluar', '2017-07-03'),
(23, '324324', 'keluar', '2017-07-03'),
(24, '324324', 'keluar', '2017-07-03'),
(25, '324324', 'keluar', '2017-07-03'),
(26, 'MU1234', 'keluar', '2017-07-05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alat_keluar`
--
ALTER TABLE `alat_keluar`
  ADD PRIMARY KEY (`id_alat_keluar`,`id_transaksi`),
  ADD KEY `id_alat` (`id_alat`),
  ADD KEY `id_transaksi` (`id_transaksi`);

--
-- Indexes for table `alat_kesehatan`
--
ALTER TABLE `alat_kesehatan`
  ADD PRIMARY KEY (`id_alat`);

--
-- Indexes for table `alat_masuk`
--
ALTER TABLE `alat_masuk`
  ADD PRIMARY KEY (`id_alat_masuk`),
  ADD KEY `id_alat` (`id_alat`),
  ADD KEY `id_transaksi` (`id_transaksi`);

--
-- Indexes for table `alat_rusak`
--
ALTER TABLE `alat_rusak`
  ADD PRIMARY KEY (`id_alat_rusak`),
  ADD KEY `id_alat` (`id_alat`);

--
-- Indexes for table `detail_alat`
--
ALTER TABLE `detail_alat`
  ADD PRIMARY KEY (`id_alat`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_alat` (`id_alat`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alat_keluar`
--
ALTER TABLE `alat_keluar`
  MODIFY `id_alat_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `alat_masuk`
--
ALTER TABLE `alat_masuk`
  MODIFY `id_alat_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `alat_rusak`
--
ALTER TABLE `alat_rusak`
  MODIFY `id_alat_rusak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `alat_keluar`
--
ALTER TABLE `alat_keluar`
  ADD CONSTRAINT `alat_keluar_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `alat_kesehatan`
--
ALTER TABLE `alat_kesehatan`
  ADD CONSTRAINT `alat_kesehatan_ibfk_1` FOREIGN KEY (`id_alat`) REFERENCES `detail_alat` (`id_alat`);

--
-- Constraints for table `alat_masuk`
--
ALTER TABLE `alat_masuk`
  ADD CONSTRAINT `alat_masuk_ibfk_2` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `alat_rusak`
--
ALTER TABLE `alat_rusak`
  ADD CONSTRAINT `alat_rusak_ibfk_1` FOREIGN KEY (`id_alat`) REFERENCES `alat_kesehatan` (`id_alat`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_alat`) REFERENCES `alat_kesehatan` (`id_alat`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

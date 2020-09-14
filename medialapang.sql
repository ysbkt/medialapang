-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2018 at 05:54 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medialapang`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_lapangan`
--

CREATE TABLE `data_lapangan` (
  `id_data_lapangan` int(11) NOT NULL,
  `id_penyedia` int(11) NOT NULL,
  `id_lapangan` int(11) NOT NULL,
  `nama_lapangan` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_lapangan`
--

INSERT INTO `data_lapangan` (`id_data_lapangan`, `id_penyedia`, `id_lapangan`, `nama_lapangan`, `deskripsi`) VALUES
(1, 1, 1, 'lapangan rumput A', 'lorem ipsum dolor amet'),
(2, 1, 1, 'Lapangan ABC', 'Lapangan maen bola');

-- --------------------------------------------------------

--
-- Table structure for table `gambar_lapangan`
--

CREATE TABLE `gambar_lapangan` (
  `id_gambar_lapangan` int(11) NOT NULL,
  `id_data_lapangan` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gambar_lapangan`
--

INSERT INTO `gambar_lapangan` (`id_gambar_lapangan`, `id_data_lapangan`, `gambar`) VALUES
(1, 1, '1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `harga`
--

CREATE TABLE `harga` (
  `id_harga` int(11) NOT NULL,
  `id_data_lapangan` int(11) NOT NULL,
  `skema_1` int(11) NOT NULL,
  `skema_2` int(11) NOT NULL,
  `skema_3` int(11) NOT NULL,
  `skema_4` int(11) NOT NULL,
  `skema_5` int(11) NOT NULL,
  `skema_6` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `harga`
--

INSERT INTO `harga` (`id_harga`, `id_data_lapangan`, `skema_1`, `skema_2`, `skema_3`, `skema_4`, `skema_5`, `skema_6`) VALUES
(1, 1, 100000, 130000, 160000, 130000, 170000, 200000);

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` int(11) NOT NULL,
  `id_data_lapangan` int(11) NOT NULL,
  `hari_main` date DEFAULT NULL,
  `jam_main` varchar(255) DEFAULT NULL,
  `jam_selesai` varchar(255) DEFAULT NULL,
  `tanggal_booking` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `id_data_lapangan`, `hari_main`, `jam_main`, `jam_selesai`, `tanggal_booking`) VALUES
(1, 1, '2018-07-08', '08:00', '19:00', '2018-07-08');

-- --------------------------------------------------------

--
-- Table structure for table `jam`
--

CREATE TABLE `jam` (
  `id_jam` int(11) NOT NULL,
  `jam` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jam`
--

INSERT INTO `jam` (`id_jam`, `jam`) VALUES
(1, '08:00'),
(2, '09:00'),
(3, '10:00'),
(4, '11:00'),
(5, '12:00'),
(6, '13:00'),
(7, '14:00'),
(8, '15:00'),
(9, '16:00'),
(10, '17:00'),
(11, '18:00'),
(12, '19:00'),
(13, '20:00'),
(14, '21:00'),
(15, '22:00'),
(16, '23:00'),
(17, '24:00');

-- --------------------------------------------------------

--
-- Table structure for table `kecamatan`
--

CREATE TABLE `kecamatan` (
  `id_kecamatan` int(11) NOT NULL,
  `nama_kecamatan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kecamatan`
--

INSERT INTO `kecamatan` (`id_kecamatan`, `nama_kecamatan`) VALUES
(1, 'cakung'),
(2, 'cipayung'),
(3, 'ciracas'),
(4, 'duren sawit'),
(5, 'jatinegara'),
(6, 'kramat jati'),
(7, 'makasar'),
(8, 'matraman'),
(9, 'pasar rebo'),
(10, 'pulo gadung');

-- --------------------------------------------------------

--
-- Table structure for table `lapangan`
--

CREATE TABLE `lapangan` (
  `id_lapangan` int(11) NOT NULL,
  `jenis_lapangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lapangan`
--

INSERT INTO `lapangan` (`id_lapangan`, `jenis_lapangan`) VALUES
(1, 'futsal'),
(2, 'basket'),
(3, 'badminton');

-- --------------------------------------------------------

--
-- Table structure for table `penyedia`
--

CREATE TABLE `penyedia` (
  `id_penyedia` int(11) NOT NULL,
  `nama_pemilik` varchar(255) NOT NULL,
  `nama_tempat` varchar(255) NOT NULL,
  `jam_buka` varchar(11) NOT NULL,
  `jam_tutup` varchar(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `kelurahan` varchar(255) NOT NULL,
  `kecamatan` varchar(255) NOT NULL,
  `kotamadya` varchar(255) NOT NULL,
  `kodepos` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penyedia`
--

INSERT INTO `penyedia` (`id_penyedia`, `nama_pemilik`, `nama_tempat`, `jam_buka`, `jam_tutup`, `email`, `password`, `alamat`, `kelurahan`, `kecamatan`, `kotamadya`, `kodepos`) VALUES
(1, 'hanna', 'halim futsal', '08:00', '24:00', 'halim.futsal@gmail.com', '21232F297A57A5A743894A0E4A801FC3', 'Jl. Raya Pd. Gede, RW.3', 'Halim Perdana Kusumah', 'Makasar', 'Jakarta Timur', 13610);

-- --------------------------------------------------------

--
-- Table structure for table `penyewa`
--

CREATE TABLE `penyewa` (
  `id_penyewa` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telepon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penyewa`
--

INSERT INTO `penyewa` (`id_penyewa`, `nama`, `email`, `password`, `telepon`) VALUES
(1, 'dummy', 'test@medialapang.com', '21232f297a57a5a743894a0e4a801fc3', 123456);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_lapangan`
--
ALTER TABLE `data_lapangan`
  ADD PRIMARY KEY (`id_data_lapangan`);

--
-- Indexes for table `gambar_lapangan`
--
ALTER TABLE `gambar_lapangan`
  ADD PRIMARY KEY (`id_gambar_lapangan`);

--
-- Indexes for table `harga`
--
ALTER TABLE `harga`
  ADD PRIMARY KEY (`id_harga`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indexes for table `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD PRIMARY KEY (`id_kecamatan`);

--
-- Indexes for table `lapangan`
--
ALTER TABLE `lapangan`
  ADD PRIMARY KEY (`id_lapangan`);

--
-- Indexes for table `penyedia`
--
ALTER TABLE `penyedia`
  ADD PRIMARY KEY (`id_penyedia`);

--
-- Indexes for table `penyewa`
--
ALTER TABLE `penyewa`
  ADD PRIMARY KEY (`id_penyewa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_lapangan`
--
ALTER TABLE `data_lapangan`
  MODIFY `id_data_lapangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `gambar_lapangan`
--
ALTER TABLE `gambar_lapangan`
  MODIFY `id_gambar_lapangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `harga`
--
ALTER TABLE `harga`
  MODIFY `id_harga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kecamatan`
--
ALTER TABLE `kecamatan`
  MODIFY `id_kecamatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `lapangan`
--
ALTER TABLE `lapangan`
  MODIFY `id_lapangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `penyedia`
--
ALTER TABLE `penyedia`
  MODIFY `id_penyedia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `penyewa`
--
ALTER TABLE `penyewa`
  MODIFY `id_penyewa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

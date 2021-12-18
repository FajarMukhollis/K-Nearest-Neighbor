-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2021 at 09:54 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `knn`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `user` varchar(16) NOT NULL,
  `pass` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`user`, `pass`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tb_atribut`
--

CREATE TABLE `tb_atribut` (
  `id_atribut` varchar(16) NOT NULL,
  `nama_atribut` varchar(255) DEFAULT NULL,
  `status_atribut` varchar(255) DEFAULT NULL,
  `nilai` tinyint(1) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_atribut`
--

INSERT INTO `tb_atribut` (`id_atribut`, `nama_atribut`, `status_atribut`, `nilai`, `keterangan`) VALUES
('A01', 'Umur', 'diketahui', 0, '1 = Remaja (17 – 25), 2 = Dewasa (26 – 45), 3 = Lanjut Usia (45 - 65)'),
('A02', 'Golongan Ekonomi', 'diketahui', 0, '1 = Bawah, 2 = Menengah , 3 = Atas'),
('A03', 'Jumlah Keluarga', 'diketahui', 0, '1 = Sedikit (1 - 3), 2 = Sedang (4 - 5), 3 = Banyak (6 - 11) '),
('A04', 'Pendapatan', 'diketahui', 0, ''),
('A05', 'Hasil', 'dicari', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_dataset`
--

CREATE TABLE `tb_dataset` (
  `id_dataset` int(11) NOT NULL,
  `nomor` int(11) DEFAULT NULL,
  `id_atribut` varchar(16) DEFAULT NULL,
  `id_nilai` int(11) DEFAULT NULL,
  `ket_dataset` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_dataset`
--

INSERT INTO `tb_dataset` (`id_dataset`, `nomor`, `id_atribut`, `id_nilai`, `ket_dataset`) VALUES
(515, 3, 'A05', 46, 'Limijanti Shanyuan'),
(514, 3, 'A04', 800000, 'Limijanti Shanyuan'),
(513, 3, 'A03', 3, 'Limijanti Shanyuan'),
(512, 3, 'A02', 1, 'Limijanti Shanyuan'),
(511, 3, 'A01', 30, 'Limijanti Shanyuan'),
(510, 2, 'A05', 47, 'Johan Iman Sudirman'),
(509, 2, 'A04', 10000000, 'Johan Iman Sudirman'),
(508, 2, 'A03', 3, 'Johan Iman Sudirman'),
(507, 2, 'A02', 3, 'Johan Iman Sudirman'),
(506, 2, 'A01', 28, 'Johan Iman Sudirman'),
(505, 1, 'A05', 46, 'Suherman'),
(504, 1, 'A04', 1500000, 'Suherman'),
(503, 1, 'A03', 2, 'Suherman'),
(502, 1, 'A02', 2, 'Suherman'),
(501, 1, 'A01', 25, 'Suherman'),
(516, 4, 'A01', 25, 'Judas Baskara'),
(517, 4, 'A02', 3, 'Judas Baskara'),
(518, 4, 'A03', 1, 'Judas Baskara'),
(519, 4, 'A04', 9000000, 'Judas Baskara'),
(520, 4, 'A05', 47, 'Judas Baskara'),
(521, 5, 'A01', 32, 'Sudirman Dwi'),
(522, 5, 'A02', 2, 'Sudirman Dwi'),
(523, 5, 'A03', 3, 'Sudirman Dwi'),
(524, 5, 'A04', 3500000, 'Sudirman Dwi'),
(525, 5, 'A05', 46, 'Sudirman Dwi'),
(526, 6, 'A01', 34, 'Leony Utari Sutedja'),
(527, 6, 'A02', 3, 'Leony Utari Sutedja'),
(528, 6, 'A03', 5, 'Leony Utari Sutedja'),
(529, 6, 'A04', 6500000, 'Leony Utari Sutedja'),
(530, 6, 'A05', 47, 'Leony Utari Sutedja'),
(531, 7, 'A01', 27, 'Sari Farida Santoso'),
(532, 7, 'A02', 2, 'Sari Farida Santoso'),
(533, 7, 'A03', 3, 'Sari Farida Santoso'),
(534, 7, 'A04', 400000, 'Sari Farida Santoso'),
(535, 7, 'A05', 46, 'Sari Farida Santoso'),
(536, 8, 'A01', 30, 'Joshua Sibarani'),
(537, 8, 'A02', 3, 'Joshua Sibarani'),
(538, 8, 'A03', 3, 'Joshua Sibarani'),
(539, 8, 'A04', 9000000, 'Joshua Sibarani'),
(540, 8, 'A05', 47, 'Joshua Sibarani'),
(541, 9, 'A01', 27, 'Yohanes Adi Susanto'),
(542, 9, 'A02', 2, 'Yohanes Adi Susanto'),
(543, 9, 'A03', 4, 'Yohanes Adi Susanto'),
(544, 9, 'A04', 4500000, 'Yohanes Adi Susanto'),
(545, 9, 'A05', 46, 'Yohanes Adi Susanto'),
(546, 10, 'A01', 26, 'Eka Tirto Darmadi'),
(547, 10, 'A02', 2, 'Eka Tirto Darmadi'),
(548, 10, 'A03', 3, 'Eka Tirto Darmadi'),
(549, 10, 'A04', 3400000, 'Eka Tirto Darmadi'),
(550, 10, 'A05', 46, 'Eka Tirto Darmadi');

-- --------------------------------------------------------

--
-- Table structure for table `tb_nilai`
--

CREATE TABLE `tb_nilai` (
  `id_nilai` int(11) NOT NULL,
  `id_atribut` varchar(255) DEFAULT NULL,
  `nama_nilai` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_nilai`
--

INSERT INTO `tb_nilai` (`id_nilai`, `id_atribut`, `nama_nilai`) VALUES
(46, 'A05', 'Layak'),
(47, 'A05', 'Tidak layak');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`user`);

--
-- Indexes for table `tb_atribut`
--
ALTER TABLE `tb_atribut`
  ADD PRIMARY KEY (`id_atribut`);

--
-- Indexes for table `tb_dataset`
--
ALTER TABLE `tb_dataset`
  ADD PRIMARY KEY (`id_dataset`);

--
-- Indexes for table `tb_nilai`
--
ALTER TABLE `tb_nilai`
  ADD PRIMARY KEY (`id_nilai`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_dataset`
--
ALTER TABLE `tb_dataset`
  MODIFY `id_dataset` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=551;

--
-- AUTO_INCREMENT for table `tb_nilai`
--
ALTER TABLE `tb_nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

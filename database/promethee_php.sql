-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2023 at 05:03 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `promethee_php`
--

-- --------------------------------------------------------

--
-- Table structure for table `alternatif`
--

CREATE TABLE `alternatif` (
  `id_alternatif` int(11) NOT NULL,
  `kode` varchar(20) NOT NULL,
  `alternatif` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `alternatif`
--

INSERT INTO `alternatif` (`id_alternatif`, `kode`, `alternatif`) VALUES
(1, '1000001', 'Mahendra'),
(2, '1000002', 'Siti Hanifah'),
(3, '1000003', 'Rizky Purnama');

-- --------------------------------------------------------

--
-- Table structure for table `hasil_akhir`
--

CREATE TABLE `hasil_akhir` (
  `id_hasil_akhir` int(11) NOT NULL,
  `id_seleksi_alternatif` int(11) NOT NULL,
  `nilai_lf` double NOT NULL,
  `nilai_ef` double NOT NULL,
  `nilai_nf` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `hasil_akhir`
--

INSERT INTO `hasil_akhir` (`id_hasil_akhir`, `id_seleksi_alternatif`, `nilai_lf`, `nilai_ef`, `nilai_nf`) VALUES
(1, 1, 0.9, 0, 0.9),
(2, 2, 0.25, 0.8, -0.55),
(3, 3, 0.15, 0.5, -0.35),
(4, 4, 0, 0, 0),
(5, 5, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `hasil_awal`
--

CREATE TABLE `hasil_awal` (
  `id_hasil_awal` int(11) NOT NULL,
  `id_seleksi_alternatif_1` int(11) NOT NULL,
  `id_seleksi_alternatif_2` int(11) NOT NULL,
  `nilai` double NOT NULL,
  `id_seleksi` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `hasil_awal`
--

INSERT INTO `hasil_awal` (`id_hasil_awal`, `id_seleksi_alternatif_1`, `id_seleksi_alternatif_2`, `nilai`, `id_seleksi`, `status`) VALUES
(1, 1, 2, 1.3, 1, 1),
(2, 1, 3, 0.5, 1, 1),
(3, 2, 1, 0, 1, 1),
(4, 2, 3, 0.5, 1, 1),
(5, 3, 1, 0, 1, 1),
(6, 3, 2, 0.3, 1, 1),
(7, 4, 5, 0, 2, 1),
(8, 5, 4, 0, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `kriteria` varchar(50) NOT NULL,
  `preferensi` char(3) NOT NULL,
  `tipe_preferensi` int(1) NOT NULL,
  `nilai_q` double NOT NULL,
  `nilai_p` double NOT NULL,
  `gausian` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `kriteria`, `preferensi`, `tipe_preferensi`, `nilai_q`, `nilai_p`, `gausian`) VALUES
(1, 'Pendapatan orang tua', 'Min', 3, 0, 1000, 0),
(2, 'Rata-rata nilai akademik ', 'Max', 3, 0, 10, 0),
(3, 'Nilai prestasi', 'Max', 4, 0.5, 2, 0),
(4, 'Nilai kedisiplinan', 'Max', 4, 0.5, 2, 0),
(5, 'Nilai keorganisasian', 'Max', 4, 0.5, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_kriteria`
--

CREATE TABLE `nilai_kriteria` (
  `id_nilai_kriteria` int(11) NOT NULL,
  `id_seleksi_alternatif` int(11) NOT NULL,
  `id_seleksi_kriteria` int(11) NOT NULL,
  `nilai` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nilai_kriteria`
--

INSERT INTO `nilai_kriteria` (`id_nilai_kriteria`, `id_seleksi_alternatif`, `id_seleksi_kriteria`, `nilai`) VALUES
(1, 1, 1, 2000),
(2, 1, 2, 85),
(3, 1, 3, 2),
(4, 1, 4, 4),
(5, 1, 5, 2),
(6, 2, 1, 1000),
(7, 2, 2, 75),
(8, 2, 3, 3),
(9, 2, 4, 3),
(10, 2, 5, 1),
(11, 3, 1, 1500),
(12, 3, 2, 90),
(13, 3, 3, 1),
(14, 3, 4, 4),
(15, 3, 5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(50) NOT NULL,
  `tipe` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `nama`, `username`, `password`, `tipe`) VALUES
(4, 'Petugas', 'petugas@gmail.com', '570c396b3fc856eceb8aa7357f32af1a', 2),
(3, 'Administrator', 'admin@gmail.com', '0192023a7bbd73250516f069df18b500', 1),
(7, 'Stevanus Christian', 'stevanuschristian88@gmail.com', '6ed61d4b80bb0f81937b32418e98adca', 1);

-- --------------------------------------------------------

--
-- Table structure for table `seleksi`
--

CREATE TABLE `seleksi` (
  `id_seleksi` int(11) NOT NULL,
  `seleksi` varchar(50) NOT NULL,
  `tahun` int(4) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `seleksi`
--

INSERT INTO `seleksi` (`id_seleksi`, `seleksi`, `tahun`, `keterangan`) VALUES
(1, 'Seleksi Beasiswa Prestasi', 2015, '-');

-- --------------------------------------------------------

--
-- Table structure for table `seleksi_alternatif`
--

CREATE TABLE `seleksi_alternatif` (
  `id_seleksi_alternatif` int(11) NOT NULL,
  `id_seleksi` int(11) NOT NULL,
  `id_alternatif` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `seleksi_alternatif`
--

INSERT INTO `seleksi_alternatif` (`id_seleksi_alternatif`, `id_seleksi`, `id_alternatif`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 2, 1),
(5, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `seleksi_kriteria`
--

CREATE TABLE `seleksi_kriteria` (
  `id_seleksi_kriteria` int(11) NOT NULL,
  `id_seleksi` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `bobot` int(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `seleksi_kriteria`
--

INSERT INTO `seleksi_kriteria` (`id_seleksi_kriteria`, `id_seleksi`, `id_kriteria`, `bobot`) VALUES
(1, 1, 1, 3),
(2, 1, 2, 4),
(3, 1, 3, 5),
(4, 1, 4, 3),
(5, 1, 5, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id_alternatif`);

--
-- Indexes for table `hasil_akhir`
--
ALTER TABLE `hasil_akhir`
  ADD PRIMARY KEY (`id_hasil_akhir`);

--
-- Indexes for table `hasil_awal`
--
ALTER TABLE `hasil_awal`
  ADD PRIMARY KEY (`id_hasil_awal`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `nilai_kriteria`
--
ALTER TABLE `nilai_kriteria`
  ADD PRIMARY KEY (`id_nilai_kriteria`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indexes for table `seleksi`
--
ALTER TABLE `seleksi`
  ADD PRIMARY KEY (`id_seleksi`);

--
-- Indexes for table `seleksi_alternatif`
--
ALTER TABLE `seleksi_alternatif`
  ADD PRIMARY KEY (`id_seleksi_alternatif`);

--
-- Indexes for table `seleksi_kriteria`
--
ALTER TABLE `seleksi_kriteria`
  ADD PRIMARY KEY (`id_seleksi_kriteria`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id_alternatif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hasil_akhir`
--
ALTER TABLE `hasil_akhir`
  MODIFY `id_hasil_akhir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hasil_awal`
--
ALTER TABLE `hasil_awal`
  MODIFY `id_hasil_awal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `nilai_kriteria`
--
ALTER TABLE `nilai_kriteria`
  MODIFY `id_nilai_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `seleksi`
--
ALTER TABLE `seleksi`
  MODIFY `id_seleksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `seleksi_alternatif`
--
ALTER TABLE `seleksi_alternatif`
  MODIFY `id_seleksi_alternatif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `seleksi_kriteria`
--
ALTER TABLE `seleksi_kriteria`
  MODIFY `id_seleksi_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

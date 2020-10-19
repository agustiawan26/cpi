-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 21, 2020 at 12:58 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk-embung`
--

-- --------------------------------------------------------

--
-- Table structure for table `alternatif`
--

CREATE TABLE `alternatif` (
  `alternatif_id` int(11) NOT NULL,
  `alternatif` varchar(255) NOT NULL,
  `kecamatan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `alternatif`
--

INSERT INTO `alternatif` (`alternatif_id`, `alternatif`, `kecamatan`) VALUES
(1, 'Dadapayam', 'Bancak'),
(2, 'Mluweh', 'Ungaran Timur'),
(3, 'Lebak', 'Bringin'),
(4, 'Pakis', 'Pabelan'),
(5, 'Jatikurung', 'Pringapus'),
(6, 'Gogodalem', 'Bringin'),
(7, 'Kandangan', 'Pringapus'),
(8, 'Ngrawan', 'Getasan');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `kriteria_id` int(11) NOT NULL,
  `kriteria` varchar(255) NOT NULL,
  `bobot` double NOT NULL,
  `tren` varchar(10) NOT NULL DEFAULT 'negatif',
  `is_para` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`kriteria_id`, `kriteria`, `bobot`, `tren`, `is_para`) VALUES
(1, 'Vegetasi area genangan embung', 12.753, 'positif', 1),
(2, 'Volume material timbunan', 9.545, 'negatif', 0),
(3, 'Luas daerah yang akan dibebaskan', 25.151, 'negatif', 0),
(4, 'Volume tampungan efektif', 13.366, 'positif', 0),
(5, 'Lama operasi', 15.971, 'positif', 0),
(6, 'Harga air/m3', 12.972, 'negatif', 0),
(7, 'Akses jalan menuju site bendungan', 10.242, 'positif', 1);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_tbl`
--

CREATE TABLE `nilai_tbl` (
  `nilai_id` int(11) NOT NULL,
  `nilai_kriteria_id` int(11) NOT NULL,
  `nilai_alternatif_id` int(11) NOT NULL,
  `nilai` double NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nilai_tbl`
--

INSERT INTO `nilai_tbl` (`nilai_id`, `nilai_kriteria_id`, `nilai_alternatif_id`, `nilai`) VALUES
(1, 1, 1, 2),
(2, 1, 2, 5),
(3, 1, 3, 2),
(4, 1, 4, 2),
(5, 1, 5, 5),
(6, 1, 6, 5),
(7, 1, 7, 3),
(8, 1, 8, 3),
(9, 2, 1, 7280),
(10, 2, 2, 196390),
(11, 2, 3, 99140),
(12, 2, 4, 11430),
(13, 2, 5, 29280),
(14, 2, 6, 54722.35),
(15, 2, 7, 46406.3),
(16, 2, 8, 28740),
(17, 3, 1, 4.2),
(18, 3, 2, 2.202),
(19, 3, 3, 2.4),
(20, 3, 4, 3.4),
(21, 3, 5, 5.3),
(22, 3, 6, 7.32),
(23, 3, 7, 2.83),
(24, 3, 8, 4.3),
(25, 4, 1, 538922.441),
(26, 4, 2, 3172333.287),
(27, 4, 3, 783975.83),
(28, 4, 4, 1346651.091),
(29, 4, 5, 39039.746),
(30, 4, 6, 318778),
(31, 4, 7, 35907),
(32, 4, 8, 18750),
(33, 5, 1, 57),
(34, 5, 2, 113),
(35, 5, 3, 57),
(36, 5, 4, 57),
(37, 5, 5, 10),
(38, 5, 6, 63),
(39, 5, 7, 2),
(40, 5, 8, 22),
(41, 6, 1, 30333),
(42, 6, 2, 8322.59),
(43, 6, 3, 8335.122),
(44, 6, 4, 10092.484),
(45, 6, 5, 375650.845),
(46, 6, 6, 74434.54),
(47, 6, 7, 549291.921),
(48, 6, 8, 858700.256),
(49, 7, 1, 2),
(50, 7, 2, 3),
(51, 7, 3, 2),
(52, 7, 4, 2),
(53, 7, 5, 2),
(54, 7, 6, 2),
(55, 7, 7, 2),
(56, 7, 8, 3);

-- --------------------------------------------------------

--
-- Table structure for table `parameter`
--

CREATE TABLE `parameter` (
  `parameter_id` int(11) NOT NULL,
  `kriteria_id` varchar(64) NOT NULL,
  `nama_parameter` varchar(64) NOT NULL,
  `nilai_parameter` int(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parameter`
--

INSERT INTO `parameter` (`parameter_id`, `kriteria_id`, `nama_parameter`, `nilai_parameter`) VALUES
(1, '1', 'Hutan', 5),
(2, '1', 'Semak belukar', 4),
(3, '1', 'ladang/tegalan', 3),
(4, '1', 'Sawah tadah hujan', 2),
(5, '1', 'perkampungan', 1),
(6, '7', 'tersedia jalan aspal sampai site', 4),
(7, '7', 'jalan makadam/tanah sampai site', 3),
(8, '7', 'jalan setapak', 2),
(9, '7', 'tidak tersedia jalan', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `role` enum('admin','manager') NOT NULL DEFAULT 'admin',
  `last_login` timestamp NOT NULL DEFAULT current_timestamp(),
  `photo` varchar(64) NOT NULL DEFAULT 'user.png',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_active` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `email`, `full_name`, `phone`, `role`, `last_login`, `photo`, `created_at`, `is_active`) VALUES
(1, 'admin', '$2y$10$xXCw9JRcCeGFG6ZHdeVeIuVPvXNMGhLgp/czlOKHJ8nzPi7ak3Xne', 'admin@admin.com', 'administrator', '082242376950', 'admin', '2020-07-21 10:57:38', '1.jpg', '2020-01-28 13:41:55', 1),
(2, 'manager', '$2y$10$Z.Hxi58sMWk7HC41njc0TOVM.9QX.5x1hJPA4a4rYSw86u9lRjkgG', 'manager@manager.com', 'manager', '082242376950', 'manager', '2020-07-20 16:11:59', '2.jpg', '2020-03-18 03:21:37', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`alternatif_id`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`kriteria_id`);

--
-- Indexes for table `nilai_tbl`
--
ALTER TABLE `nilai_tbl`
  ADD PRIMARY KEY (`nilai_id`);

--
-- Indexes for table `parameter`
--
ALTER TABLE `parameter`
  ADD PRIMARY KEY (`parameter_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `alternatif_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `kriteria_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `nilai_tbl`
--
ALTER TABLE `nilai_tbl`
  MODIFY `nilai_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `parameter`
--
ALTER TABLE `parameter`
  MODIFY `parameter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

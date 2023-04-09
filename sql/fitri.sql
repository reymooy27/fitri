-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2023 at 07:02 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fitri`
--

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` int(11) NOT NULL,
  `kelas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `kelas`) VALUES
(1, 'X IPA I');

-- --------------------------------------------------------

--
-- Table structure for table `konsultasi`
--

CREATE TABLE `konsultasi` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `userId` int(11) NOT NULL,
  `siswaId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `konsultasi`
--

INSERT INTO `konsultasi` (`id`, `tanggal`, `keterangan`, `userId`, `siswaId`) VALUES
(1, '2023-04-05', 'Lempar kaca', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggaran`
--

CREATE TABLE `pelanggaran` (
  `id` int(11) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `siswaId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sanksi`
--

CREATE TABLE `sanksi` (
  `id` int(11) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `siswaId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kelasId` int(11) NOT NULL,
  `poin` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `nama`, `kelasId`, `poin`) VALUES
(1, 'Rey', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `isAdmin`) VALUES
(1, 'Susan Susanti', 'admin', 'admin', 1),
(2, 'Burhan', 'burhan', 'password', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `konsultasi`
--
ALTER TABLE `konsultasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`),
  ADD KEY `siswaId` (`siswaId`);

--
-- Indexes for table `pelanggaran`
--
ALTER TABLE `pelanggaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `siswaId` (`siswaId`);

--
-- Indexes for table `sanksi`
--
ALTER TABLE `sanksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `siswaId` (`siswaId`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kelasId` (`kelasId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `konsultasi`
--
ALTER TABLE `konsultasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pelanggaran`
--
ALTER TABLE `pelanggaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sanksi`
--
ALTER TABLE `sanksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `konsultasi`
--
ALTER TABLE `konsultasi`
  ADD CONSTRAINT `konsultasi_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `siswa` (`id`);

--
-- Constraints for table `sanksi`
--
ALTER TABLE `sanksi`
  ADD CONSTRAINT `sanksi_ibfk_1` FOREIGN KEY (`siswaId`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

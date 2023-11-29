-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2023 at 08:47 AM
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
-- Database: `si`
--

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nisn` varchar(12) NOT NULL,
  `nama` varchar(15) NOT NULL,
  `intelektual` decimal(4,2) DEFAULT NULL,
  `sikap` decimal(4,2) DEFAULT NULL,
  `kelas` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nisn`, `nama`, `intelektual`, `sikap`, `kelas`) VALUES
('1111111111', 'siswa 1', 30.00, 10.00, 'A'),
('2222222222', 'siswa 2', 36.50, 10.50, 'A'),
('3333333333', 'siswa 3', 29.25, 10.00, 'A'),
('4444444444', 'siswa 4', 33.75, 10.00, 'A'),
('5555555555', 'siswa 5', 29.25, 10.00, 'A'),
('6666666666', 'siswa 6', 33.75, 10.00, 'A'),
('7777777777', 'siswa 7', 27.00, 10.00, 'A'),
('8888888888', 'siswa 8', 30.00, 8.50, 'A');

-- --------------------------------------------------------

--
-- Table structure for table `teladan`
--

CREATE TABLE `teladan` (
  `nisn` varchar(12) DEFAULT NULL,
  `kategori` varchar(15) NOT NULL,
  `nilai` decimal(4,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `email`, `password`) VALUES
('admin123', 'admin@gmail.com', 'admin321'),
('admin43', 'fgsggs@gmail.com', '$2y$10$NT32V7.MvvUAm6jkRLgMou6gg.mxzRXy1hwunSjrPb9ROtRh7I6fm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nisn`);

--
-- Indexes for table `teladan`
--
ALTER TABLE `teladan`
  ADD KEY `FK_teladan_siswa` (`nisn`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `teladan`
--
ALTER TABLE `teladan`
  ADD CONSTRAINT `FK_teladan_siswa` FOREIGN KEY (`nisn`) REFERENCES `siswa` (`nisn`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

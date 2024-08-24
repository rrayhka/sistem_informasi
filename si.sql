-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Des 2023 pada 13.10
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

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
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `nisn` varchar(12) NOT NULL,
  `nama` varchar(15) NOT NULL,
  `intelektual` decimal(4,2) DEFAULT NULL,
  `sikap` decimal(4,2) DEFAULT NULL,
  `perilaku` decimal(4,2) NOT NULL,
  `sistem_lama` decimal(5,2) NOT NULL,
  `fuzzy_baru` decimal(4,2) NOT NULL,
  `akurasi` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`nisn`, `nama`, `intelektual`, `sikap`, `perilaku`, `sistem_lama`, `fuzzy_baru`, `akurasi`) VALUES
('1111111111', 'siswa 1', '30.00', '10.00', '5.50', '45.50', '74.52', '163.78'),
('2222222222', 'siswa 2', '36.50', '10.50', '7.00', '54.00', '74.41', '137.80'),
('3333333333', 'siswa 3', '29.25', '10.00', '7.00', '46.25', '74.48', '161.04'),
('4444444444', 'siswa 4', '33.75', '10.00', '6.50', '50.25', '74.00', '147.26'),
('5555555555', 'siswa 5', '29.25', '10.00', '5.50', '44.75', '74.34', '166.12'),
('6666666666', 'siswa 6', '33.75', '10.00', '5.50', '49.25', '73.97', '150.19'),
('7777777777', 'siswa 7', '27.00', '10.00', '7.00', '44.00', '74.16', '168.55'),
('8888888888', 'siswa 8', '30.00', '8.50', '5.50', '44.00', '74.34', '168.95');

-- --------------------------------------------------------

--
-- Struktur dari tabel `teladan`
--

CREATE TABLE `teladan` (
  `nisn` varchar(12) DEFAULT NULL,
  `kategori` varchar(15) NOT NULL,
  `nilai` decimal(4,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `teladan`
--

INSERT INTO `teladan` (`nisn`, `kategori`, `nilai`) VALUES
('1111111111', 'baik', '74.52'),
('2222222222', 'baik', '74.41'),
('3333333333', 'baik', '74.48'),
('4444444444', 'baik', '74.00'),
('5555555555', 'baik', '74.34'),
('7777777777', 'baik', '74.16'),
('6666666666', 'baik', '73.97'),
('8888888888', 'baik', '74.34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `username` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`username`, `email`, `password`) VALUES
('admin123', 'admin@gmail.com', 'admin321'),
('admin43', 'fgsggs@gmail.com', '$2y$10$NT32V7.MvvUAm6jkRLgMou6gg.mxzRXy1hwunSjrPb9ROtRh7I6fm');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nisn`);

--
-- Indeks untuk tabel `teladan`
--
ALTER TABLE `teladan`
  ADD KEY `FK_teladan_siswa` (`nisn`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `teladan`
--
ALTER TABLE `teladan`
  ADD CONSTRAINT `FK_teladan_siswa` FOREIGN KEY (`nisn`) REFERENCES `siswa` (`nisn`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

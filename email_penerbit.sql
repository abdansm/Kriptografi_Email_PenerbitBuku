-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Des 2024 pada 13.22
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `email_penerbit`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`username`, `password`, `role`) VALUES
('abdan', '$2y$10$NYxjRHeJoE/5KBKgcdjAxeujUxwEh0DiOkhqZ8r3yaDxPmJWCAd86', 'editor'),
('abdul', '$2y$10$Cb3STgrT0wyJmXlhcDa47.eBlFaJwBEWpABCeCiVykQOfibJNHrwG', 'editor'),
('yuyu', '$2y$10$IINnD9afuWU01OOUOb41ZevJA3gZvaj7PfJRXoFzLEovrYohnBM.O', 'editor');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesan`
--

CREATE TABLE `pesan` (
  `id_pesan` int(11) NOT NULL,
  `dari` varchar(20) NOT NULL,
  `kepada` varchar(20) NOT NULL,
  `subjek` varchar(100) NOT NULL,
  `isi_pesan` text NOT NULL,
  `waktu` datetime NOT NULL,
  `status` varchar(10) NOT NULL,
  `file` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pesan`
--

INSERT INTO `pesan` (`id_pesan`, `dari`, `kepada`, `subjek`, `isi_pesan`, `waktu`, `status`, `file`) VALUES
(23, 'abdan', 'abdul', 'maaf', 'wq1QBHUs/y1Lw/P/dn0xd2iHHFUwaV9wxq0lSRlnL4Tv+6+uMeE=', '2024-11-20 16:03:44', 'readed', ''),
(24, 'abdan', 'yuyu', 'halo', 'IhQ61lSRGZofXEe8i+GCGHE=', '2024-11-20 22:11:14', 'readed', ''),
(35, 'abdan', 'abdul', 'yaha', '/BAFX0l9OTJAnYBUf7nXrpvmlG9PrP8fbYu/OIyOL1M=', '2024-11-28 02:17:18', 'readed', 'halo.txt'),
(36, 'abdan', 'yuyu', 'ini dia', 'eNbJSBFoegYE8ZcaJDKDQQxn77EYqfmK777dJ50djumXL8WpofoSSmXr', '2024-11-28 02:22:25', 'readed', 'presentasi1.PNG');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id_pesan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id_pesan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

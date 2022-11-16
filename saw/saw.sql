-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Nov 2022 pada 07.10
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 8.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `saw`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alternatif`
--

CREATE TABLE `alternatif` (
  `id_alternatif` int(5) NOT NULL,
  `kode_alternatif` varchar(5) NOT NULL,
  `nama_alternatif` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `alternatif`
--

INSERT INTO `alternatif` (`id_alternatif`, `kode_alternatif`, `nama_alternatif`) VALUES
(9, 'A1', 'JAPFA COMFEED INDONESIA'),
(10, 'A2', 'NEW HOPE'),
(11, 'A3', 'CHAERON POKPHAND'),
(12, 'A4', 'MALINDO FEEDMILL');

-- --------------------------------------------------------

--
-- Struktur dari tabel `alternatif_kriteria`
--

CREATE TABLE `alternatif_kriteria` (
  `id_alternatif_kriteria` int(5) NOT NULL,
  `id_alternatif` int(5) NOT NULL,
  `id_kriteria` int(5) NOT NULL,
  `id_subkriteria` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `alternatif_kriteria`
--

INSERT INTO `alternatif_kriteria` (`id_alternatif_kriteria`, `id_alternatif`, `id_kriteria`, `id_subkriteria`) VALUES
(37, 9, 2, 4),
(38, 9, 3, 21),
(39, 9, 4, 10),
(40, 9, 5, 15),
(41, 10, 2, 3),
(42, 10, 3, 9),
(43, 10, 4, 11),
(44, 10, 5, 14),
(45, 11, 2, 3),
(46, 11, 3, 9),
(47, 11, 4, 10),
(48, 11, 5, 14),
(49, 12, 2, 2),
(50, 12, 3, 8),
(51, 12, 4, 12),
(52, 12, 5, 13);

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil`
--

CREATE TABLE `hasil` (
  `id_hasil` int(5) NOT NULL,
  `id_alternatif` int(5) NOT NULL,
  `nilai` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `hasil`
--

INSERT INTO `hasil` (`id_hasil`, `id_alternatif`, `nilai`) VALUES
(4, 9, 0.705),
(5, 10, 0.559),
(6, 11, 0.634),
(7, 12, 0.5047);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(5) NOT NULL,
  `kode_kriteria` varchar(5) NOT NULL,
  `nama_kriteria` varchar(50) NOT NULL,
  `bobot` float NOT NULL,
  `tipe` enum('Cost','Benefit') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `kode_kriteria`, `nama_kriteria`, `bobot`, `tipe`) VALUES
(2, 'C01', 'Harga', 0.25, 'Cost'),
(3, 'C02', 'Kualitas', 0.23, 'Benefit'),
(4, 'C03', 'Pengiriman', 0.15, 'Cost'),
(5, 'C04', 'Tempo Pembayaran', 0.2, 'Benefit');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(5) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `level` enum('Admin','User') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `nama_lengkap`, `username`, `password`, `level`) VALUES
(1, 'Administrator', 'admin', '$2y$10$jSrT538lQ1XbZ.f6/pwuIuznGokA6U8o2pP59ehMHhWWAiH/ZviYe', 'Admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `subkriteria`
--

CREATE TABLE `subkriteria` (
  `id_subkriteria` int(5) NOT NULL,
  `id_kriteria` int(5) NOT NULL,
  `nama_subkriteria` varchar(50) NOT NULL,
  `bobot` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `subkriteria`
--

INSERT INTO `subkriteria` (`id_subkriteria`, `id_kriteria`, `nama_subkriteria`, `bobot`) VALUES
(1, 2, '<10.000', 1),
(2, 2, '10.000 - 20.000', 2),
(3, 2, '20.000 - 30.000', 3),
(4, 2, '30.000 - 40.000', 4),
(6, 3, 'Protein dibawan 14%', 1),
(7, 3, 'Protein 14%-15,99%', 2),
(8, 3, 'Protein 16%-17,99%', 3),
(9, 3, 'Protein 18%-19,99%', 4),
(10, 4, '1 Hari', 1),
(11, 4, '2 Hari', 2),
(12, 4, '3 Hari', 3),
(13, 5, '1 Bulan', 1),
(14, 5, '2 Bulan', 2),
(15, 5, '3 Bulan', 3),
(20, 2, '>40.000', 5),
(21, 3, 'Protein diatas 20%', 5),
(22, 4, '4 Hari', 4),
(23, 4, '5 Hari', 5),
(24, 5, '4 Bulan', 4),
(25, 5, '5 Bulan', 5);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id_alternatif`);

--
-- Indeks untuk tabel `alternatif_kriteria`
--
ALTER TABLE `alternatif_kriteria`
  ADD PRIMARY KEY (`id_alternatif_kriteria`),
  ADD KEY `id_alternatif` (`id_alternatif`),
  ADD KEY `id_kriteria` (`id_kriteria`),
  ADD KEY `id_subkriteria` (`id_subkriteria`);

--
-- Indeks untuk tabel `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id_hasil`),
  ADD KEY `id_alternatif` (`id_alternatif`);

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indeks untuk tabel `subkriteria`
--
ALTER TABLE `subkriteria`
  ADD PRIMARY KEY (`id_subkriteria`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id_alternatif` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `alternatif_kriteria`
--
ALTER TABLE `alternatif_kriteria`
  MODIFY `id_alternatif_kriteria` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT untuk tabel `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id_hasil` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `subkriteria`
--
ALTER TABLE `subkriteria`
  MODIFY `id_subkriteria` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `alternatif_kriteria`
--
ALTER TABLE `alternatif_kriteria`
  ADD CONSTRAINT `alternatif_kriteria_ibfk_1` FOREIGN KEY (`id_alternatif`) REFERENCES `alternatif` (`id_alternatif`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `alternatif_kriteria_ibfk_2` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `alternatif_kriteria_ibfk_3` FOREIGN KEY (`id_subkriteria`) REFERENCES `subkriteria` (`id_subkriteria`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `hasil`
--
ALTER TABLE `hasil`
  ADD CONSTRAINT `hasil_ibfk_1` FOREIGN KEY (`id_alternatif`) REFERENCES `alternatif` (`id_alternatif`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `subkriteria`
--
ALTER TABLE `subkriteria`
  ADD CONSTRAINT `subkriteria_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

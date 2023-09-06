-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Sep 2023 pada 03.47
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
-- Database: `navbar_dinamis`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `parent_menu`
--

CREATE TABLE `parent_menu` (
  `id_menu` int(11) NOT NULL,
  `short_name` varchar(255) NOT NULL,
  `long_name` varchar(255) DEFAULT NULL,
  `ikon` varchar(255) NOT NULL,
  `link_parent` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `parent_menu`
--

INSERT INTO `parent_menu` (`id_menu`, `short_name`, `long_name`, `ikon`, `link_parent`) VALUES
(1, 'Home', NULL, '<i class=\"bi bi-house fs-2\"></i>', 'http://localhost/template/metronic-demo6/demo/#'),
(2, 'Auth', 'Authentication', '<i class=\"bi bi-file-earmark-lock fs-2\"></i>', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sub_menu`
--

CREATE TABLE `sub_menu` (
  `id_sub` int(11) NOT NULL,
  `nama_menu` varchar(255) NOT NULL,
  `link_menu` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `sub_menu`
--

INSERT INTO `sub_menu` (`id_sub`, `nama_menu`, `link_menu`, `parent_id`) VALUES
(1, 'Sign In', 'http://localhost/template/metronic-demo6/demo/#', 2),
(2, 'Sign Out', 'http://localhost/template/metronic-demo6/demo/login.php', 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `parent_menu`
--
ALTER TABLE `parent_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indeks untuk tabel `sub_menu`
--
ALTER TABLE `sub_menu`
  ADD PRIMARY KEY (`id_sub`),
  ADD KEY `perent_id` (`parent_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `parent_menu`
--
ALTER TABLE `parent_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `sub_menu`
--
ALTER TABLE `sub_menu`
  MODIFY `id_sub` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `sub_menu`
--
ALTER TABLE `sub_menu`
  ADD CONSTRAINT `sub_menu_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `parent_menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

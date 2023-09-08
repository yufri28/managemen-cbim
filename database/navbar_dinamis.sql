-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 08 Sep 2023 pada 03.14
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

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
-- Struktur dari tabel `auth`
--

CREATE TABLE `auth` (
  `id_auth` int(11) NOT NULL,
  `id_pengguna` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `f_id_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `auth`
--

INSERT INTO `auth` (`id_auth`, `id_pengguna`, `username`, `password`, `f_id_role`) VALUES
(5, NULL, 'admin', '$2y$10$63pA6.ieZJcDHZV.sio/2uXlDGwMb3V94yX5Vdh6NOFMtNx.kHfN.', 9),
(11, NULL, 'Edwin', '$2y$10$6kInUhDpGLViHBqRtpGhN./Z/AduUVXUTvyfftxYeiNnq5hR/D3oK', 14);

-- --------------------------------------------------------

--
-- Struktur dari tabel `man_navbar`
--

CREATE TABLE `man_navbar` (
  `id` int(11) NOT NULL,
  `f_id_menu` int(11) NOT NULL,
  `f_id_auth` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `man_navbar`
--

INSERT INTO `man_navbar` (`id`, `f_id_menu`, `f_id_auth`) VALUES
(42, 1, 5);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `parent_menu`
--

INSERT INTO `parent_menu` (`id_menu`, `short_name`, `long_name`, `ikon`, `link_parent`) VALUES
(1, 'Home', '-', '<i class=\"bi bi-house fs-2\"></i>', 'http://localhost/managemen-cbim/home'),
(2, 'Auth', 'Authentication', '<i class=\"bi bi-file-earmark-lock fs-2\"></i>', 'http://localhost/managemen-cbim/menu/show_menu_add');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `role` varchar(20) NOT NULL,
  `kode_role` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`id_role`, `role`, `kode_role`) VALUES
(9, 'Admin', 1),
(14, 'Kepala Sekolah', 2),
(16, 'Guru', 3),
(17, 'Dosen', 4),
(18, 'Kepegawaian', 5),
(19, 'Kepala Divisi', 6),
(20, 'Direktur', 7),
(21, 'Staf', 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sub_menu`
--

CREATE TABLE `sub_menu` (
  `id_sub` int(11) NOT NULL,
  `nama_menu` varchar(255) NOT NULL,
  `link_menu` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`id_auth`),
  ADD KEY `f_id_role` (`f_id_role`);

--
-- Indeks untuk tabel `man_navbar`
--
ALTER TABLE `man_navbar`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `f_id_menu_2` (`f_id_menu`,`f_id_auth`),
  ADD KEY `f_id_menu` (`f_id_menu`),
  ADD KEY `f_id_auth` (`f_id_auth`);

--
-- Indeks untuk tabel `parent_menu`
--
ALTER TABLE `parent_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

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
-- AUTO_INCREMENT untuk tabel `auth`
--
ALTER TABLE `auth`
  MODIFY `id_auth` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `man_navbar`
--
ALTER TABLE `man_navbar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT untuk tabel `parent_menu`
--
ALTER TABLE `parent_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `sub_menu`
--
ALTER TABLE `sub_menu`
  MODIFY `id_sub` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `auth`
--
ALTER TABLE `auth`
  ADD CONSTRAINT `auth_ibfk_1` FOREIGN KEY (`f_id_role`) REFERENCES `role` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `man_navbar`
--
ALTER TABLE `man_navbar`
  ADD CONSTRAINT `man_navbar_ibfk_1` FOREIGN KEY (`f_id_menu`) REFERENCES `parent_menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `man_navbar_ibfk_2` FOREIGN KEY (`f_id_auth`) REFERENCES `auth` (`id_auth`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sub_menu`
--
ALTER TABLE `sub_menu`
  ADD CONSTRAINT `sub_menu_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `parent_menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Bulan Mei 2025 pada 15.25
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lawregister`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `oharda`
--

CREATE TABLE `oharda` (
  `id` int(11) NOT NULL,
  `no_urut` varchar(50) DEFAULT NULL,
  `tanggal_nomor` varchar(100) DEFAULT NULL,
  `instansi_penyidik` varchar(100) DEFAULT NULL,
  `tgl_diterima_kejaksaan` date DEFAULT NULL,
  `identitas_tersangka` text DEFAULT NULL,
  `waktu_kejadian` datetime DEFAULT NULL,
  `tempat_kejadian` varchar(255) DEFAULT NULL,
  `pasal_disangkakan` text DEFAULT NULL,
  `jaksa_peneliti` varchar(100) DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `oharda`
--

INSERT INTO `oharda` (`id`, `no_urut`, `tanggal_nomor`, `instansi_penyidik`, `tgl_diterima_kejaksaan`, `identitas_tersangka`, `waktu_kejadian`, `tempat_kejadian`, `pasal_disangkakan`, `jaksa_peneliti`, `keterangan`) VALUES
(2, '1', '30002 - 202525', 'ubj', '2025-04-30', 'bagas', '2025-04-30 14:15:00', 'klub malam', '123', 'septe', 'Acc'),
(3, '2', '30003 - 202525', 'ubj', '2025-04-30', 'malik', '2025-04-30 14:26:00', 'gym', '1234', 'septe', 'Belum di Acc'),
(4, '3', '30002 - 202525', 'ubj', '2025-04-30', 'dontol', '2025-04-30 14:27:00', 'lapangan', '1234', 'rajwa', 'Belum di Acc');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_masuk`
--

CREATE TABLE `surat_masuk` (
  `id` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `no_tgl_masuk` varchar(255) DEFAULT NULL,
  `asal_surat` varchar(255) DEFAULT NULL,
  `isi_surat` text DEFAULT NULL,
  `disposisi` varchar(255) DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `surat_masuk`
--

INSERT INTO `surat_masuk` (`id`, `tanggal`, `no_tgl_masuk`, `asal_surat`, `isi_surat`, `disposisi`, `keterangan`) VALUES
(2, '2025-04-06', '3334 - 06/04/2025', 'Universitas Bhayangkara Jakarta Raya', 'Selesainya Masa Magang - An. Prio', 'Buatkan Sertifikat', 'Acc'),
(4, '2025-04-08', '3337 - 29/04/2025', 'Kejaksaan Negeri Bekasi ', 'Penyerahan Sertifikat', 'Sebarkan Kesetiap Siswa & Mahasiswa Magang', 'Acc'),
(9, '2025-04-12', '3337 - 29/04/2025', 'hgjh', 'uhihh', 'iojijoij', 'Belum di Acc'),
(10, '2025-04-05', '3337 - 29/04/2025', 'jhjnk', 'nkn', 'gnv', 'Acc'),
(11, '2025-04-22', '3336 - 06/04/2025', 'dfghjkl', 'mnbmb', 'Sebarkan Kesetiap Siswa & Mahasiswa Magang', 'Belum di Acc'),
(12, '2025-04-23', '3336 - 06/04/2025', 'rfhjnkjn', 'jkkjl', 'Buatkan Sertifikat', 'Belum di Acc'),
(13, '2025-04-05', '3336 - 06/04/2025', 'Universitas Bhayangkara Jakarta Raya', 'jhkjhkjh', 'Buatkan Sertifikat', 'Belum di Acc'),
(14, '2025-04-19', '3336 - 06/04/2025', 'Kejaksaan Negeri Bekasi ', 'mjkbkj', 'Sebarkan Kesetiap Siswa & Mahasiswa Magang', 'Acc'),
(15, '2025-04-17', '3336 - 06/04/2025', 'Universitas Bhayangkara Jakarta Raya', 'ADASD', 'Buatkan Sertifikat', 'Acc');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `role`) VALUES
(1, 'bagas', 'bagas123', 'user'),
(2, 'admin', 'admin123', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `oharda`
--
ALTER TABLE `oharda`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `oharda`
--
ALTER TABLE `oharda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `surat_masuk`
--
ALTER TABLE `surat_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

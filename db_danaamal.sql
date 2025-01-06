-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2025 at 12:00 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_danaamal`
--

-- --------------------------------------------------------

--
-- Table structure for table `donasi`
--

CREATE TABLE `donasi` (
  `id` int(11) NOT NULL,
  `nama_program` varchar(255) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `target_donasi` bigint(20) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `status` enum('Aktif','Selesai') DEFAULT 'Aktif',
  `tgl_batas` date DEFAULT NULL,
  `tgl_mulai` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `donasi`
--

INSERT INTO `donasi` (`id`, `nama_program`, `kategori_id`, `target_donasi`, `deskripsi`, `gambar`, `status`, `tgl_batas`, `tgl_mulai`) VALUES
(15, 'Bantu Pembanguan Aula', 7, 7000000, 'jhwhckhi', 'sample2.png', 'Aktif', '2025-01-07', '2025-01-01'),
(16, 'Bantu Renovasi Perpustakaan', 7, 2500000, 'test', 'sample3.png', 'Aktif', '2025-01-07', '2024-12-31'),
(17, 'Aksi Sosial Mahasiswa Peduli', 8, 1998690, 'wkj', 'sample2.png', 'Selesai', '2024-12-30', '2024-12-19');

-- --------------------------------------------------------

--
-- Table structure for table `donatur`
--

CREATE TABLE `donatur` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_donasi` int(11) NOT NULL,
  `donasi` varchar(15) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `donatur`
--

INSERT INTO `donatur` (`id`, `id_user`, `id_donasi`, `donasi`, `created_at`, `updated_at`, `status`) VALUES
(11, 17, 12, '50000', '2024-12-30 17:57:01', '2024-12-30 17:57:01', 'pending'),
(12, 58, 12, '50000', '2024-12-30 18:01:09', '2024-12-30 18:01:09', 'pending'),
(13, 60, 13, '30000', '2024-12-31 06:21:44', '2024-12-31 06:21:44', 'pending'),
(14, 60, 13, '30000', '2024-12-31 06:22:08', '2024-12-31 06:22:08', 'pending'),
(15, 60, 13, '10000', '2024-12-31 06:22:27', '2024-12-31 06:22:27', 'pending'),
(16, 60, 13, '10000', '2024-12-31 06:23:22', '2024-12-31 06:23:22', 'pending'),
(17, 57, 15, '10000', '2024-12-31 07:14:45', '2024-12-31 07:14:45', 'pending'),
(18, 62, 15, '30000', '2024-12-31 12:13:02', '2024-12-31 12:13:02', 'pending'),
(19, 61, 15, '30000', '2024-12-31 12:16:34', '2024-12-31 12:16:34', 'pending'),
(20, 61, 15, '30000', '2024-12-31 12:19:13', '2024-12-31 12:19:13', 'pending'),
(21, 61, 15, '10000', '2024-12-31 13:35:54', '2024-12-31 13:35:54', 'pending'),
(22, 16, 15, '30000', '2025-01-01 15:40:34', '2025-01-01 15:40:34', 'pending'),
(23, 16, 15, '50000', '2025-01-02 06:01:25', '2025-01-02 06:01:25', 'pending'),
(24, 16, 16, '30000', '2025-01-02 06:01:54', '2025-01-02 06:01:54', 'pending'),
(25, 18, 15, '5000', '2025-01-02 12:55:34', '2025-01-02 12:55:34', 'pending'),
(26, 19, 15, '30000', '2025-01-02 13:03:14', '2025-01-02 13:03:14', 'pending'),
(27, 19, 15, '5000', '2025-01-02 13:04:59', '2025-01-02 13:06:46', 'succes'),
(28, 20, 15, '30000', '2025-01-02 16:12:05', '2025-01-02 16:12:05', 'pending'),
(29, 20, 15, '30000', '2025-01-02 16:17:10', '2025-01-02 16:17:10', 'pending'),
(30, 20, 15, '30000', '2025-01-02 16:24:30', '2025-01-02 16:24:30', 'pending'),
(31, 20, 15, '50000', '2025-01-02 16:36:51', '2025-01-02 16:36:51', 'pending'),
(32, 20, 15, '50000', '2025-01-02 16:37:34', '2025-01-02 16:37:34', 'pending'),
(33, 20, 15, '30000', '2025-01-02 17:01:46', '2025-01-02 17:01:46', 'pending'),
(34, 20, 15, '30000', '2025-01-02 17:20:40', '2025-01-02 17:20:40', 'pending'),
(35, 20, 15, '50000', '2025-01-02 17:20:54', '2025-01-02 17:20:54', 'pending'),
(36, 20, 15, '50000', '2025-01-02 17:21:24', '2025-01-02 17:21:24', 'pending'),
(37, 20, 15, '30000', '2025-01-02 17:52:07', '2025-01-02 17:52:07', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `hubungi_kami`
--

CREATE TABLE `hubungi_kami` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pesan` text NOT NULL,
  `tanggal` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `hubungi_kami`
--

INSERT INTO `hubungi_kami` (`id`, `nama`, `email`, `pesan`, `tanggal`) VALUES
(4, 'Muhammad Ali Maksum', 'muhalimaksum885@gmail.com', 'Assalamualaikum', '2024-12-30 09:38:05'),
(5, 'Ali', 'ali@gmail.com', 'test', '2024-12-31 06:10:24'),
(6, 'alif rizqullah', 'alif@gmail.com', 'test', '2024-12-31 06:59:02'),
(7, 'putri camelia sari', 'putri@gmail.com', 'assalmualaikum', '2024-12-31 11:43:01');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_donasi`
--

CREATE TABLE `kategori_donasi` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `kategori_donasi`
--

INSERT INTO `kategori_donasi` (`id`, `nama`, `deskripsi`, `created_at`, `updated_at`) VALUES
(7, 'Pembangunan', 'Kategori ini mencakup proyek pembangunan dan renovasi fasilitas kampus.', '2024-12-30 17:21:30', '2024-12-30 17:21:30'),
(8, 'Sosial', 'Kategori ini mencakup proyek dan kegiatan sosial di kampus.', '2024-12-30 17:23:57', '2024-12-30 17:23:57');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `expires_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `link_gambar` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `urutan` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `link_gambar`, `id_user`, `created_at`, `urutan`) VALUES
(17, 'assets/img/slider/1735628876_sample1.png', 17, '2024-12-31 07:07:56', 0),
(18, 'assets/img/slider/1735645668_sample2.png', 17, '2024-12-31 11:47:48', 0),
(19, 'assets/img/slider/1735646018_sample3.png', 17, '2024-12-31 11:53:38', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Admin','Donatur') NOT NULL,
  `no_telepon` varchar(20) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `jabatan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `role`, `no_telepon`, `status`, `nama`, `jabatan`) VALUES
(16, 'maksum@gmail.com', '$2y$10$4NH92LVlN3HT2unslqgkGunHsI/7lqQNDvZTnzjt/z3REYpBthPqW', 'Donatur', '083162486191', 'nonaktif', 'Muhammad Ali Maksum', 'Mahasiswa'),
(17, 'admin@gmail.com', '$2y$10$U/2Uihxyi4QxszItqeyx2.sxeFvuIfVsyW5Be3/u/6BHztCGepFDa', 'Admin', '08123456789', 'aktif', 'admin', NULL),
(20, 'donatur@gmail.com', '$2y$10$QSlUPPdkQqNwzaJ0n0.nz.//47EODADSbQ98rMP7rwF5jZrLYStGa', 'Donatur', '083162486192', 'aktif', 'donatur', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `donasi`
--
ALTER TABLE `donasi`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `kategori_id` (`kategori_id`) USING BTREE;

--
-- Indexes for table `donatur`
--
ALTER TABLE `donatur`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `hubungi_kami`
--
ALTER TABLE `hubungi_kami`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `kategori_donasi`
--
ALTER TABLE `kategori_donasi`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `email` (`email`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `donasi`
--
ALTER TABLE `donasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `donatur`
--
ALTER TABLE `donatur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `hubungi_kami`
--
ALTER TABLE `hubungi_kami`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kategori_donasi`
--
ALTER TABLE `kategori_donasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `donasi`
--
ALTER TABLE `donasi`
  ADD CONSTRAINT `donasi_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `kategori_donasi` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

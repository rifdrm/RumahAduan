-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 03, 2025 at 09:02 AM
-- Server version: 8.0.30
-- PHP Version: 8.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_rumah_aduan`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota_keluargas`
--

CREATE TABLE `anggota_keluargas` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `nama_lengkap` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_hubungan` enum('Kepala Keluarga','Istri','Anak','Famili Lain') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `foto_profil` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `master_wargas`
--

CREATE TABLE `master_wargas` (
  `id` bigint UNSIGNED NOT NULL,
  `no_kk` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_kepala_keluarga` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `blok` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_rumah` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rt_rw` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_rumah` enum('Dihuni','Kosong') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Dihuni',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_wargas`
--

INSERT INTO `master_wargas` (`id`, `no_kk`, `nama_kepala_keluarga`, `blok`, `no_rumah`, `rt_rw`, `status_rumah`, `created_at`, `updated_at`) VALUES
(1, '3201010001000001', 'Budi Santoso', 'A1', '10', '001/005', 'Dihuni', '2025-11-30 19:03:58', '2025-11-30 19:03:58'),
(2, '3201010001000002', 'Siti Aminah', 'A1', '11', '001/005', 'Dihuni', '2025-11-30 19:03:58', '2025-11-30 19:03:58'),
(3, '3201010001000003', 'Agus (Pemilik Lama)', 'B3', '05', '002/005', 'Kosong', '2025-11-30 19:03:58', '2025-11-30 19:03:58');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000001_create_cache_table', 1),
(2, '0001_01_01_000002_create_jobs_table', 1),
(3, '2025_11_30_011924_create_master_wargas_table', 1),
(4, '2025_12_01_000000_create_users_table', 1),
(5, '2025_12_01_013132_create_anggota_keluargas_table', 1),
(6, '2025_12_01_013228_create_pengaduans_table', 1),
(7, '2025_12_01_021303_create_sessions_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `pengaduans`
--

CREATE TABLE `pengaduans` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `pelapor_nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul_laporan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` enum('Sampah','Keamanan','Fasilitas','Sosial','Darurat') COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_bukti` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lokasi_kejadian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `urgensi` enum('Rendah','Sedang','Tinggi') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Terkirim','Diproses','Selesai','Ditolak') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Terkirim',
  `tanggapan_admin` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengaduans`
--

INSERT INTO `pengaduans` (`id`, `user_id`, `pelapor_nama`, `judul_laporan`, `deskripsi`, `kategori`, `foto_bukti`, `lokasi_kejadian`, `urgensi`, `status`, `tanggapan_admin`, `created_at`, `updated_at`) VALUES
(1, 2, 'Keluarga Budi', 'Sampah numpuk', 'Sudah seminggu sampah di sini belum diangkut oleh petugas.', 'Fasilitas', 'bukti_aduan/xFztaAIUhUarSm3Lgji3QuSJBltcU9OKUooXpuZO.png', 'Depan Blok A3 no.10', 'Sedang', 'Diproses', 'Sedang dikoordinasikan dengan pihak terkait', '2025-12-01 08:14:14', '2025-12-02 08:47:07'),
(2, 4, 'Keluarga Siti Aminah', 'Pohon rubuh', 'ada pohon rubuh', 'Darurat', 'bukti_aduan/ivxvLY9q1t5xRD1iuhSEjwd1kfMlTC7EuZyIvdkv.png', 'Depan masjid', 'Sedang', 'Selesai', 'kelar', '2025-12-02 08:48:50', '2025-12-02 08:49:26');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('GUbIFC11VFKHWaNQj3EVtHAYWitXb6ysvrDE62PV', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiaUlDS0ZMbzBPdkhGNjN5S1RZUU9xbW82RjlET1d1SFNlUU54ajNLTSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly9ydW1haC1hZHVhbi50ZXN0L2FkbWluL2Rhc2hib2FyZCI7czo1OiJyb3V0ZSI7czoxNToiYWRtaW4uZGFzaGJvYXJkIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mzt9', 1764690998),
('KRiZyreX2CQLO63G2dQB9EodUP0GJD3DswgrgqdW', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoia0dkQ2NCWTlNd3BrTk15T1hteloxRTJpNlltMk1iYUlOWWJ1ME1hayI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9ydW1haC1hZHVhbi50ZXN0L3Byb2ZpbGUiO3M6NToicm91dGUiO3M6MTI6InByb2ZpbGUuZWRpdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1764751790),
('ma5mSRxApAU0CxvonAVfVUgOKoXxiXgenwfzXSCo', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMjZpd1JxRm1WaktnaFlORnE2SEFjcDUwMHd6eTR2Y3ZiUzN0c2l3SCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9tZW51bmdndS12ZXJpZmlrYXNpIjtzOjU6InJvdXRlIjtzOjE3OiJ2ZXJpZmlrYXNpLm5vdGljZSI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjU7fQ==', 1764690992);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `master_warga_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_kk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','warga') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'warga',
  `status_akun` enum('pending','active','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `alasan_penolakan` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `master_warga_id`, `name`, `email`, `password`, `no_hp`, `foto_kk`, `role`, `status_akun`, `alasan_penolakan`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Cek Model', 'cek@test.com', '123', NULL, NULL, 'warga', 'active', '', NULL, '2025-11-30 19:02:57', '2025-12-02 08:21:27'),
(2, 1, 'Keluarga Budi', 'budi@gmail.com', '$2y$12$RSnUum1lWQYtwvss6fAg8.y3fQ9ziZ0uERClivWKUNMGc9G20vHby', '08123456789', 'bukti_kk/DdNEofQ7pbZRPYPieUjSqQw26Ut9BhUHiQXQPiAd.jpg', 'warga', 'active', NULL, NULL, '2025-12-01 06:21:31', '2025-12-01 06:21:31'),
(3, NULL, 'Admin Pak RT', 'admin@gmail.com', '$2y$12$JXC5YJjmYER0fjDufaSuhOV.FcTCI2ZMW7syIggsrsMp4v1Ry4Bzq', '081299999999', NULL, 'admin', 'active', NULL, NULL, '2025-12-02 07:51:03', '2025-12-02 07:51:03'),
(4, 2, 'Keluarga Siti Aminah', 'sitiaminah@gmail.com', '$2y$12$aAO5Hq.WYB6VdMfo.aBSP.v4Xpl4xIP2UOhecsaoc9gVoFXktqxhe', '089632529999', 'bukti_kk/u1mHgSvEVqew66JEOuqUdtrRhVkaBMIpqfy0xVlq.jpg', 'warga', 'active', NULL, NULL, '2025-12-02 08:30:23', '2025-12-02 08:44:29'),
(5, 3, 'Keluarga Lutpi', 'lutpi@gmail.com', '$2y$12$Jw1bX7fowjpjN2tRWJwKneF7c8/Pr.18JGKZ.vqthZmbC2G3ywAbK', '089632529998', 'bukti_kk/YtvMgjfMxdV7WCJSS5jaJXfW0g4qaveNrVw1zhJd.jpg', 'warga', 'pending', NULL, NULL, '2025-12-02 08:56:31', '2025-12-02 08:56:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota_keluargas`
--
ALTER TABLE `anggota_keluargas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `anggota_keluargas_nik_unique` (`nik`),
  ADD KEY `anggota_keluargas_user_id_foreign` (`user_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_wargas`
--
ALTER TABLE `master_wargas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `master_wargas_no_kk_unique` (`no_kk`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengaduans`
--
ALTER TABLE `pengaduans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengaduans_user_id_foreign` (`user_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_master_warga_id_foreign` (`master_warga_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota_keluargas`
--
ALTER TABLE `anggota_keluargas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_wargas`
--
ALTER TABLE `master_wargas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pengaduans`
--
ALTER TABLE `pengaduans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `anggota_keluargas`
--
ALTER TABLE `anggota_keluargas`
  ADD CONSTRAINT `anggota_keluargas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pengaduans`
--
ALTER TABLE `pengaduans`
  ADD CONSTRAINT `pengaduans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_master_warga_id_foreign` FOREIGN KEY (`master_warga_id`) REFERENCES `master_wargas` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

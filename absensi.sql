-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 17, 2024 at 08:30 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absensi`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensis`
--

CREATE TABLE `absensis` (
  `id` bigint UNSIGNED NOT NULL,
  `kelas_id` bigint UNSIGNED NOT NULL,
  `materi_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `code_id` bigint UNSIGNED NOT NULL,
  `teaching_role` enum('Ketua','Asissten','Tutor') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Tutor',
  `date` date NOT NULL,
  `start` time NOT NULL,
  `end` time DEFAULT NULL,
  `duration` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `absensis`
--

INSERT INTO `absensis` (`id`, `kelas_id`, `materi_id`, `user_id`, `code_id`, `teaching_role`, `date`, `start`, `end`, `duration`, `created_at`, `updated_at`) VALUES
(69, 1, 11, 1, 16, 'Asissten', '2024-03-14', '11:50:32', '22:58:03', 247, '2024-03-13 21:50:32', '2024-03-14 08:58:03'),
(78, 4, 11, 1, 27, 'Ketua', '2024-03-14', '19:57:30', '03:54:28', 56, '2024-03-14 05:57:30', '2024-03-14 13:54:28'),
(92, 4, 14, 1, 26, 'Ketua', '2024-03-15', '04:00:35', '04:00:56', 1020, '2024-03-14 14:00:35', '2024-03-14 14:00:56'),
(93, 4, 14, 1, 26, 'Ketua', '2024-03-15', '04:10:58', '04:11:20', 1020, '2024-03-14 14:10:58', '2024-03-14 14:11:20'),
(94, 4, 14, 1, 26, 'Tutor', '2024-03-15', '04:19:19', '04:19:29', 1020, '2024-03-14 14:19:19', '2024-03-14 14:19:29'),
(95, 4, 14, 1, 25, 'Tutor', '2024-03-15', '04:20:35', '04:20:48', 1020, '2024-03-14 14:20:35', '2024-03-14 14:20:48'),
(97, 4, 14, 1, 26, 'Tutor', '2024-03-15', '04:29:35', '04:37:51', 1028, '2024-03-14 14:29:35', '2024-03-14 14:37:51'),
(98, 4, 14, 1, 26, 'Tutor', '2024-03-15', '04:35:37', '04:38:40', 1023, '2024-03-14 14:35:37', '2024-03-14 14:38:40'),
(99, 2, 12, 1, 26, 'Ketua', '2024-03-15', '04:36:54', '04:45:24', NULL, '2024-03-14 14:36:54', '2024-03-14 14:45:24'),
(100, 2, 10, 1, 24, 'Asissten', '2024-03-16', '08:07:17', '08:13:41', 6, '2024-03-16 01:07:17', '2024-03-16 01:13:41'),
(101, 2, 1, 1, 15, 'Asissten', '2024-03-16', '08:32:51', '08:33:41', 0, '2024-03-16 01:32:51', '2024-03-16 01:33:41'),
(102, 2, 3, 1, 21, 'Tutor', '2024-03-16', '12:00:26', '12:00:37', 0, '2024-03-16 05:00:26', '2024-03-16 05:00:38'),
(104, 4, 1, 1, 24, 'Tutor', '2024-03-16', '12:20:08', '12:20:25', 0, '2024-03-16 05:20:08', '2024-03-16 05:20:25'),
(105, 4, 2, 4, 22, 'Tutor', '2024-03-16', '13:43:15', '15:20:47', 97, '2024-03-16 06:43:15', '2024-03-16 08:20:47'),
(106, 2, 20, 4, 21, 'Asissten', '2024-03-17', '03:30:29', '03:34:33', 4, '2024-03-16 20:30:29', '2024-03-16 20:34:33');

-- --------------------------------------------------------

--
-- Table structure for table `absensi_materi`
--

CREATE TABLE `absensi_materi` (
  `absensi_id` bigint UNSIGNED NOT NULL,
  `materi_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `codes`
--

CREATE TABLE `codes` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `id_user_get` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `codes`
--

INSERT INTO `codes` (`id`, `code`, `user_id`, `id_user_get`, `created_at`, `updated_at`) VALUES
(1, '0Ug9AGuf', 1, 1, '2024-03-11 18:40:02', '2024-03-11 19:20:38'),
(4, 'tv79QUUI', 1, 2, '2024-03-11 20:06:07', '2024-03-11 20:08:19'),
(8, 'OzV0psY9', 1, 2, '2024-03-11 21:45:55', '2024-03-11 22:13:22'),
(9, 'qAC5d5pj', 1, 2, '2024-03-12 04:21:18', '2024-03-12 05:07:28'),
(10, 'nZympukS', 1, 2, '2024-03-12 04:21:45', '2024-03-13 06:46:00'),
(15, 'oJ806hjI', 1, NULL, '2024-03-13 17:22:27', '2024-03-13 17:22:27'),
(16, '4b7f5Lw6', 1, 1, '2024-03-13 18:40:59', '2024-03-13 21:50:32'),
(17, 'ZbsD3CTw', 1, NULL, '2024-03-13 19:31:04', '2024-03-13 19:31:04'),
(18, 'dDrmOmcH', 1, NULL, '2024-03-13 19:31:14', '2024-03-13 19:31:14'),
(19, 'eUA8E4ak', 1, NULL, '2024-03-13 20:38:43', '2024-03-13 20:38:43'),
(20, 'wocHPeHD', 1, NULL, '2024-03-13 21:40:59', '2024-03-13 21:40:59'),
(21, '4Gd5MkF4', 1, 4, '2024-03-13 21:41:06', '2024-03-16 20:30:29'),
(22, 'oDYrOqwc', 1, 4, '2024-03-13 21:41:09', '2024-03-16 06:43:15'),
(23, 'RmWyPa7L', 3, NULL, '2024-03-13 21:41:12', '2024-03-13 21:41:12'),
(24, 'HSG2xUyM', 4, 1, '2024-03-13 21:41:15', '2024-03-16 05:20:08'),
(25, 'H0iJ2phE', 4, 1, '2024-03-13 21:41:40', '2024-03-14 14:23:43'),
(26, 'RxEo9SdY', 4, 1, '2024-03-13 21:42:24', '2024-03-14 14:36:54'),
(27, '6gY9wvXs', 3, 1, '2024-03-14 00:16:25', '2024-03-14 08:56:36'),
(28, 'w22ZygYr', 1, NULL, '2024-03-16 05:44:38', '2024-03-16 05:44:38'),
(29, '1NJbauPU', 1, NULL, '2024-03-17 01:26:24', '2024-03-17 01:26:24');

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
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_kelas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tingkat` int NOT NULL,
  `fakultas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jurusan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `nama_kelas`, `tingkat`, `fakultas`, `jurusan`, `created_at`, `updated_at`) VALUES
(1, 'SIS202', 1, 'MIPA', 'Sistem informasi', '2024-03-11 18:37:06', '2024-03-11 18:37:06'),
(2, 'MTK505', 2, 'Teknik', 'Teknik Informatika', '2024-03-13 08:28:10', '2024-03-13 08:28:10'),
(4, 'KLK505', 3, 'MIPA', 'Matematika', '2024-03-14 01:55:20', '2024-03-14 01:55:20');

-- --------------------------------------------------------

--
-- Table structure for table `materis`
--

CREATE TABLE `materis` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_materi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `materis`
--

INSERT INTO `materis` (`id`, `nama_materi`, `created_at`, `updated_at`) VALUES
(1, 'Sistem Cerdas', '2024-03-11 18:37:25', '2024-03-11 18:37:25'),
(2, 'SIG', '2024-03-11 18:37:37', '2024-03-11 18:37:37'),
(3, 'Matematika Diskrit', '2024-03-13 08:30:07', '2024-03-13 08:30:07'),
(4, 'Bahasa Indonesia', '2024-03-13 20:13:34', '2024-03-13 20:13:34'),
(10, 'Kalkulus', '2024-03-13 20:38:15', '2024-03-13 20:38:15'),
(11, 'Kalkulus', '2024-03-13 20:38:15', '2024-03-13 20:38:15'),
(12, 'Sistem Informasi Geografi', '2024-03-13 20:41:30', '2024-03-13 20:41:30'),
(14, 'asd1', '2024-03-13 20:44:29', '2024-03-14 02:11:37'),
(17, 'cvdacfd', '2024-03-13 20:49:51', '2024-03-13 20:49:51'),
(19, 'baruuu', '2024-03-13 20:59:23', '2024-03-13 20:59:23'),
(20, 'Kalkulus 3', '2024-03-13 21:02:22', '2024-03-13 21:02:22'),
(21, 'matemarika diskrit 2', '2024-03-13 21:05:49', '2024-03-13 21:05:49'),
(22, 'mapala', '2024-03-14 02:00:48', '2024-03-14 02:00:48');

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
(28, '2014_10_12_000000_create_users_table', 1),
(29, '2014_10_12_100000_create_password_resets_table', 1),
(30, '2019_08_19_000000_create_failed_jobs_table', 1),
(31, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(32, '2024_03_10_024122_create_codes_table', 1),
(33, '2024_03_10_072107_create_kelas_table', 1),
(34, '2024_03_10_073214_create_materis_table', 1),
(35, '2024_03_11_130513_create_absensis_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_assisten` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `join_date` date NOT NULL,
  `role` enum('admin','pj','asisten') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'asisten',
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `id_assisten`, `email_verified_at`, `join_date`, `role`, `photo`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'farry', 'farry12angian@gmail.com', '$2y$10$nU7Z5CuEOnkoBl.GP/hQn.NNlfB8bQvjdlJPpPze2DIDiPpxleVJG', 'hkjhkjb', NULL, '2024-03-01', 'admin', NULL, NULL, '2024-03-11 18:28:24', '2024-03-11 18:28:24'),
(3, 'asiking', 'aking12@gmail.com', '$2y$10$koJK5uaQogUud600w8diNOE1cE16nP4ABR2Gwq0dvsh.CTWaZ1DPy', 'ASK123', NULL, '2024-03-05', 'pj', NULL, NULL, '2024-03-13 23:29:33', '2024-03-14 03:50:51'),
(4, 'glenn', 'glenbudiman@gmail.com', '$2y$10$Yt9B.hdouU1lWs/YaCtaCeg6xRRKk1uBCZrTxFf3NY/gQH0R2ZDqy', 'GLEN567', NULL, '2024-03-01', 'asisten', NULL, NULL, '2024-03-14 03:13:18', '2024-03-14 03:13:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensis`
--
ALTER TABLE `absensis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `absensis_kelas_id_foreign` (`kelas_id`),
  ADD KEY `absensis_materi_id_foreign` (`materi_id`),
  ADD KEY `absensis_user_id_foreign` (`user_id`),
  ADD KEY `absensis_code_id_foreign` (`code_id`);

--
-- Indexes for table `absensi_materi`
--
ALTER TABLE `absensi_materi`
  ADD KEY `absensi_materi_absensi_id_foreign` (`absensi_id`);

--
-- Indexes for table `codes`
--
ALTER TABLE `codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `codes_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materis`
--
ALTER TABLE `materis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_id_assisten_unique` (`id_assisten`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensis`
--
ALTER TABLE `absensis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `codes`
--
ALTER TABLE `codes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `materis`
--
ALTER TABLE `materis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensis`
--
ALTER TABLE `absensis`
  ADD CONSTRAINT `absensis_code_id_foreign` FOREIGN KEY (`code_id`) REFERENCES `codes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `absensis_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `absensis_materi_id_foreign` FOREIGN KEY (`materi_id`) REFERENCES `materis` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `absensis_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `absensi_materi`
--
ALTER TABLE `absensi_materi`
  ADD CONSTRAINT `absensi_materi_absensi_id_foreign` FOREIGN KEY (`absensi_id`) REFERENCES `absensis` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `codes`
--
ALTER TABLE `codes`
  ADD CONSTRAINT `codes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

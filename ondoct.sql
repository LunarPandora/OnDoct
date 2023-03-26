-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2023 at 11:06 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ondoct`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking_appointment`
--

CREATE TABLE `booking_appointment` (
  `id_appointment` bigint(20) UNSIGNED NOT NULL,
  `antrian` int(11) NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `waktu_appointment` datetime NOT NULL,
  `status_appointment` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_dokter` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_spesialis` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp_dokter` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_dokter` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_dokter` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_surat_praktek` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`id`, `nama_dokter`, `jenis_spesialis`, `no_telp_dokter`, `email_dokter`, `alamat_dokter`, `gender`, `foto_surat_praktek`, `created_at`, `updated_at`) VALUES
(1, 'Dr. Fadli', 'Dokter THT', '081359183591', 'fadli@gmail.com', 'Jl. Sayur', 'l', 'XUYqe9TTOjiT.png', '2023-03-26 12:56:45', '2023-03-26 12:56:45'),
(2, 'Dr. Anifa', 'Dokter gigi', '085713948101', 'anifa@gmail.com', 'Jl. Gerigi', 'p', 'xGtKHKrCwNkq.jpg', '2023-03-26 12:59:26', '2023-03-26 12:59:26');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `farmasi`
--

CREATE TABLE `farmasi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_farmasi` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp_farmasi` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_farmasi` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_farmasi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_izin` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `farmasi`
--

INSERT INTO `farmasi` (`id`, `nama_farmasi`, `no_telp_farmasi`, `email_farmasi`, `alamat_farmasi`, `foto_izin`, `created_at`, `updated_at`) VALUES
(1, 'Apotek Melati', '081351385151', 'apotekmelati@gmail.com', 'Jl. DEF', 'PBJLJVYwNGro.png', '2023-03-26 12:57:36', '2023-03-26 12:57:36'),
(2, 'Apotek Mawar', '081941924094', 'apotekmawar@gmail.com', 'Jl. Buah', 'D01N0ukd9NwK.png', '2023-03-26 13:00:25', '2023-03-26 13:00:25');

-- --------------------------------------------------------

--
-- Table structure for table `history_appointment`
--

CREATE TABLE `history_appointment` (
  `id_appointment` bigint(20) UNSIGNED NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `id_farmasi` int(11) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `id_history_resep` int(11) DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `riwayat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `waktu` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `history_appointment`
--

INSERT INTO `history_appointment` (`id_appointment`, `id_dokter`, `id_farmasi`, `id_pasien`, `id_history_resep`, `status`, `riwayat`, `waktu`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 'done', 'Pilek', '2023-03-31 09:02:00', '2023-03-26 13:06:04', '2023-03-26 13:50:47'),
(2, 1, 2, 2, 2, 'done', 'Batuk', '2023-03-28 08:03:00', '2023-03-26 13:06:31', '2023-03-26 13:54:03'),
(3, 2, 1, 1, 3, 'done', 'Gusi bengkak', '2023-03-30 03:05:00', '2023-03-26 13:28:47', '2023-03-26 13:51:39'),
(4, 2, 2, 2, 5, 'done', 'Gigi lepas', '2023-03-29 07:04:00', '2023-03-26 13:36:13', '2023-03-26 13:54:06');

-- --------------------------------------------------------

--
-- Table structure for table `history_resep`
--

CREATE TABLE `history_resep` (
  `id_resep` bigint(20) UNSIGNED NOT NULL,
  `foto_resep` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `id_farmasi` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `history_resep`
--

INSERT INTO `history_resep` (`id_resep`, `foto_resep`, `id_dokter`, `id_pasien`, `id_farmasi`, `created_at`, `updated_at`) VALUES
(1, 'ZNZ4IEZUUAgJ.jpg', 1, 1, 1, '2023-03-26 13:06:04', '2023-03-26 13:06:04'),
(2, 'YcbDYHEVzXGk.jpg', 1, 2, 2, '2023-03-26 13:06:31', '2023-03-26 13:06:31'),
(3, 'e45hfynSHhos.jpg', 2, 1, 1, '2023-03-26 13:27:28', '2023-03-26 13:27:28'),
(5, 'FSONTUltRTFJ.jpg', 2, 2, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(52, '2014_10_12_100000_create_password_resets_table', 1),
(53, '2019_08_19_000000_create_failed_jobs_table', 1),
(54, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(55, '2023_03_12_073246_create_pasien_table', 1),
(56, '2023_03_12_080724_create_dokter_table', 1),
(57, '2023_03_12_085338_create_farmasi_table', 1),
(58, '2023_03_12_193709_create_user_table', 1),
(59, '2023_03_18_160926_create_booking_appointment_table', 1),
(60, '2023_03_18_160954_create_history_appointment_table', 1),
(61, '2023_03_18_161012_create_history_resep_table', 1),
(62, '2023_03_18_161025_create_terima_resep_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_pasien` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp_pasien` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_pasien` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alergi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `agama` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_pasien` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id`, `nama_pasien`, `no_telp_pasien`, `email_pasien`, `gender`, `alergi`, `agama`, `alamat_pasien`, `created_at`, `updated_at`) VALUES
(1, 'Ethan', '081324913513', 'ethan@gmail.com', 'l', 'Udang', 'Kristen', 'Jl. ABC', '2023-03-26 12:55:58', '2023-03-26 12:55:58'),
(2, 'Hanny', '081249104109', 'hanny@gmail.com', 'p', 'Air', 'Hindu', 'Jl. Terbang', '2023-03-26 12:58:29', '2023-03-26 12:58:29');

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
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ethan@gmail.com', '$2y$10$ZHBlK4YxcrEFcPZ2mBpeHeo91Sdl3/ift2M97WUwEYsfAldFRYSGu', 'pasien', '2023-03-26 12:55:58', '2023-03-26 12:55:58'),
(2, 'fadli@gmail.com', '$2y$10$pmmY/WAhFVzWEuxPTr0ZNebJ8GG/bS58iRYvqguXKJcv8yenEPWla', 'dokter', '2023-03-26 12:56:45', '2023-03-26 12:56:45'),
(3, 'apotekmelati@gmail.com', '$2y$10$wGcfEKJAOdHN9K2LzwRa..GI1APeTSkNwqNdldiNHzMNVOW2S4T1i', 'farmasi', '2023-03-26 12:57:36', '2023-03-26 12:57:36'),
(4, 'hanny@gmail.com', '$2y$10$cYGY3Or/FfcLfH.yQRZ59OoTquFsGsB1CMzBKcrtqzwmpn9wR4.ty', 'pasien', '2023-03-26 12:58:29', '2023-03-26 12:58:29'),
(5, 'anifa@gmail.com', '$2y$10$2rb0.5/QOCteCjlF/fIV/Ojov.oQvN7lj2DbJykPg6hYvK0bCHaiW', 'dokter', '2023-03-26 12:59:26', '2023-03-26 12:59:26'),
(6, 'apotekmawar@gmail.com', '$2y$10$YhLWD8I3k6nEsibrgfdyR.rE6babjQsGbGvZt3s4nurdNcwDsm.rG', 'farmasi', '2023-03-26 13:00:25', '2023-03-26 13:00:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking_appointment`
--
ALTER TABLE `booking_appointment`
  ADD PRIMARY KEY (`id_appointment`);

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `farmasi`
--
ALTER TABLE `farmasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_appointment`
--
ALTER TABLE `history_appointment`
  ADD PRIMARY KEY (`id_appointment`);

--
-- Indexes for table `history_resep`
--
ALTER TABLE `history_resep`
  ADD PRIMARY KEY (`id_resep`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
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
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking_appointment`
--
ALTER TABLE `booking_appointment`
  MODIFY `id_appointment` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `farmasi`
--
ALTER TABLE `farmasi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `history_appointment`
--
ALTER TABLE `history_appointment`
  MODIFY `id_appointment` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `history_resep`
--
ALTER TABLE `history_resep`
  MODIFY `id_resep` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

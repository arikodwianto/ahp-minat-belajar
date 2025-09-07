-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 07, 2025 at 04:27 PM
-- Server version: 8.0.30
-- PHP Version: 8.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ahp_minat`
--

-- --------------------------------------------------------

--
-- Table structure for table `alternatifs`
--

CREATE TABLE `alternatifs` (
  `id` bigint UNSIGNED NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `alternatifs`
--

INSERT INTO `alternatifs` (`id`, `kode`, `nama`, `created_at`, `updated_at`) VALUES
(5, 'A01', 'Visual', '2025-09-05 11:53:42', '2025-09-05 11:53:42'),
(6, 'A02', 'Auditori', '2025-09-05 11:53:52', '2025-09-05 11:53:52'),
(7, 'A03', 'Kinestetik', '2025-09-05 11:54:02', '2025-09-05 11:54:02');

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
-- Table structure for table `hasil_ahp`
--

CREATE TABLE `hasil_ahp` (
  `id` bigint UNSIGNED NOT NULL,
  `kriteria_id` bigint UNSIGNED NOT NULL,
  `bobot` decimal(8,4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hasil_kuisioners`
--

CREATE TABLE `hasil_kuisioners` (
  `id` bigint UNSIGNED NOT NULL,
  `siswa_id` bigint UNSIGNED NOT NULL,
  `pertanyaan_id` bigint UNSIGNED NOT NULL,
  `jawaban_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jawabans`
--

CREATE TABLE `jawabans` (
  `id` bigint UNSIGNED NOT NULL,
  `siswa_id` bigint UNSIGNED NOT NULL,
  `pertanyaan_id` bigint UNSIGNED NOT NULL,
  `nilai` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_kelas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jurusan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `nama_kelas`, `jurusan`, `created_at`, `updated_at`) VALUES
(1, '1', 'A', '2025-09-04 21:47:38', '2025-09-05 11:36:46'),
(2, '1', 'B', '2025-09-04 21:47:57', '2025-09-04 21:47:57');

-- --------------------------------------------------------

--
-- Table structure for table `kriterias`
--

CREATE TABLE `kriterias` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kriterias`
--

INSERT INTO `kriterias` (`id`, `nama`, `kode`, `created_at`, `updated_at`) VALUES
(1, 'Efektivitas', 'C01', '2025-09-04 21:48:30', '2025-09-04 21:48:30'),
(2, 'Pemahaman', 'C02', '2025-09-05 11:49:02', '2025-09-05 11:49:02'),
(3, 'Kemampuan', 'C03', '2025-09-05 11:49:13', '2025-09-05 11:49:13'),
(4, 'Peminatan', 'C04', '2025-09-05 11:49:28', '2025-09-05 11:49:28');

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_08_14_071434_add_role_to_users_table', 1),
(5, '2025_08_14_150000_create_kelas_table', 1),
(6, '2025_08_14_160333_create_kriterias_table', 1),
(7, '2025_08_14_163414_create_siswas_table', 1),
(8, '2025_08_21_073015_create_hasil_ahp_table', 1),
(9, '2025_09_01_073445_create_perbandingan_kriterias_table', 1),
(10, '2025_09_05_025955_create_alternatifs_table', 1),
(11, '2025_09_05_034030_create_pertanyaans_table', 1),
(12, '2025_09_05_034100_create_jawabans_table', 1),
(13, '2025_09_05_034128_create_hasil_kuisioners_table', 1),
(14, '2025_09_05_045036_add_kriteria_id_to_pertanyaans_table', 2),
(15, '2025_09_05_093023_create_perbandingan_alternatifs_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `perbandingan_alternatifs`
--

CREATE TABLE `perbandingan_alternatifs` (
  `id` bigint UNSIGNED NOT NULL,
  `siswa_id` bigint UNSIGNED NOT NULL,
  `kriteria_id` bigint UNSIGNED NOT NULL,
  `alternatif1_id` bigint UNSIGNED NOT NULL,
  `alternatif2_id` bigint UNSIGNED NOT NULL,
  `pilihan` bigint UNSIGNED NOT NULL,
  `nilai` int NOT NULL,
  `alasan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `perbandingan_alternatifs`
--

INSERT INTO `perbandingan_alternatifs` (`id`, `siswa_id`, `kriteria_id`, `alternatif1_id`, `alternatif2_id`, `pilihan`, `nilai`, `alasan`, `created_at`, `updated_at`) VALUES
(80, 1, 3, 6, 5, 6, 1, NULL, '2025-09-05 12:34:13', '2025-09-05 12:34:13'),
(82, 1, 3, 7, 5, 7, 1, NULL, '2025-09-05 12:34:13', '2025-09-05 12:34:13'),
(84, 1, 3, 7, 6, 7, 1, NULL, '2025-09-05 12:34:13', '2025-09-05 12:34:13'),
(86, 1, 4, 6, 5, 6, 1, NULL, '2025-09-05 12:34:18', '2025-09-05 12:34:18'),
(88, 1, 4, 7, 5, 7, 1, NULL, '2025-09-05 12:34:18', '2025-09-05 12:34:18'),
(90, 1, 4, 7, 6, 7, 1, NULL, '2025-09-05 12:34:18', '2025-09-05 12:34:18'),
(92, 1, 2, 6, 5, 6, 1, NULL, '2025-09-05 12:34:36', '2025-09-05 12:34:36'),
(94, 1, 2, 7, 5, 7, 1, NULL, '2025-09-05 12:34:36', '2025-09-05 12:34:36'),
(96, 1, 2, 7, 6, 7, 1, NULL, '2025-09-05 12:34:36', '2025-09-05 12:34:36'),
(98, 1, 1, 6, 5, 6, 0, NULL, '2025-09-06 06:57:30', '2025-09-06 06:57:30'),
(100, 1, 1, 7, 5, 7, 1, NULL, '2025-09-06 06:57:30', '2025-09-06 06:57:30'),
(102, 1, 1, 7, 6, 7, 1, NULL, '2025-09-06 06:57:30', '2025-09-06 06:57:30'),
(104, 1, 1, 6, 5, 6, 0, NULL, '2025-09-06 07:00:40', '2025-09-06 07:00:40'),
(106, 1, 1, 7, 5, 7, 0, NULL, '2025-09-06 07:00:40', '2025-09-06 07:00:40'),
(108, 1, 1, 7, 6, 7, 1, NULL, '2025-09-06 07:00:40', '2025-09-06 07:00:40'),
(110, 1, 2, 6, 5, 6, 1, NULL, '2025-09-06 07:00:40', '2025-09-06 07:00:40'),
(112, 1, 2, 7, 5, 7, 1, NULL, '2025-09-06 07:00:40', '2025-09-06 07:00:40'),
(114, 1, 2, 7, 6, 7, 1, NULL, '2025-09-06 07:00:40', '2025-09-06 07:00:40'),
(116, 1, 3, 6, 5, 6, 1, NULL, '2025-09-06 07:00:40', '2025-09-06 07:00:40'),
(118, 1, 3, 7, 5, 7, 1, NULL, '2025-09-06 07:00:40', '2025-09-06 07:00:40'),
(120, 1, 3, 7, 6, 7, 1, NULL, '2025-09-06 07:00:40', '2025-09-06 07:00:40'),
(122, 1, 4, 6, 5, 6, 1, NULL, '2025-09-06 07:00:40', '2025-09-06 07:00:40'),
(124, 1, 4, 7, 5, 7, 0, NULL, '2025-09-06 07:00:40', '2025-09-06 07:00:40'),
(126, 1, 4, 7, 6, 7, 1, NULL, '2025-09-06 07:00:40', '2025-09-06 07:00:40'),
(128, 1, 1, 6, 5, 6, 0, NULL, '2025-09-06 07:02:09', '2025-09-06 07:02:09'),
(130, 1, 1, 7, 5, 7, 0, NULL, '2025-09-06 07:02:09', '2025-09-06 07:02:09'),
(132, 1, 1, 7, 6, 7, 1, NULL, '2025-09-06 07:02:09', '2025-09-06 07:02:09'),
(134, 1, 2, 6, 5, 6, 1, NULL, '2025-09-06 07:02:09', '2025-09-06 07:02:09'),
(136, 1, 2, 7, 5, 7, 1, NULL, '2025-09-06 07:02:09', '2025-09-06 07:02:09'),
(138, 1, 2, 7, 6, 7, 1, NULL, '2025-09-06 07:02:09', '2025-09-06 07:02:09'),
(140, 1, 3, 6, 5, 6, 1, NULL, '2025-09-06 07:02:09', '2025-09-06 07:02:09'),
(142, 1, 3, 7, 5, 7, 1, NULL, '2025-09-06 07:02:09', '2025-09-06 07:02:09'),
(144, 1, 3, 7, 6, 7, 1, NULL, '2025-09-06 07:02:09', '2025-09-06 07:02:09'),
(146, 1, 4, 6, 5, 6, 1, NULL, '2025-09-06 07:02:09', '2025-09-06 07:02:09'),
(148, 1, 4, 7, 5, 7, 0, NULL, '2025-09-06 07:02:09', '2025-09-06 07:02:09'),
(150, 1, 4, 7, 6, 7, 1, NULL, '2025-09-06 07:02:09', '2025-09-06 07:02:09'),
(152, 1, 1, 6, 5, 6, 0, NULL, '2025-09-06 07:02:38', '2025-09-06 07:02:38'),
(154, 1, 1, 7, 5, 7, 0, NULL, '2025-09-06 07:02:38', '2025-09-06 07:02:38'),
(156, 1, 1, 7, 6, 7, 1, NULL, '2025-09-06 07:02:38', '2025-09-06 07:02:38'),
(158, 1, 2, 6, 5, 6, 1, NULL, '2025-09-06 07:02:38', '2025-09-06 07:02:38'),
(160, 1, 2, 7, 5, 7, 1, NULL, '2025-09-06 07:02:38', '2025-09-06 07:02:38'),
(162, 1, 2, 7, 6, 7, 1, NULL, '2025-09-06 07:02:38', '2025-09-06 07:02:38'),
(164, 1, 3, 6, 5, 6, 1, NULL, '2025-09-06 07:02:38', '2025-09-06 07:02:38'),
(166, 1, 3, 7, 5, 7, 1, NULL, '2025-09-06 07:02:38', '2025-09-06 07:02:38'),
(168, 1, 3, 7, 6, 7, 1, NULL, '2025-09-06 07:02:38', '2025-09-06 07:02:38'),
(170, 1, 4, 6, 5, 6, 1, NULL, '2025-09-06 07:02:38', '2025-09-06 07:02:38'),
(172, 1, 4, 7, 5, 7, 0, NULL, '2025-09-06 07:02:38', '2025-09-06 07:02:38'),
(174, 1, 4, 7, 6, 7, 1, NULL, '2025-09-06 07:02:38', '2025-09-06 07:02:38'),
(176, 1, 1, 6, 5, 6, 0, NULL, '2025-09-06 07:03:21', '2025-09-06 07:03:21'),
(178, 1, 1, 7, 5, 7, 0, NULL, '2025-09-06 07:03:21', '2025-09-06 07:03:21'),
(180, 1, 1, 7, 6, 7, 1, NULL, '2025-09-06 07:03:21', '2025-09-06 07:03:21'),
(182, 1, 2, 6, 5, 6, 1, NULL, '2025-09-06 07:03:21', '2025-09-06 07:03:21'),
(184, 1, 2, 7, 5, 7, 1, NULL, '2025-09-06 07:03:21', '2025-09-06 07:03:21'),
(186, 1, 2, 7, 6, 7, 1, NULL, '2025-09-06 07:03:21', '2025-09-06 07:03:21'),
(188, 1, 3, 6, 5, 6, 1, NULL, '2025-09-06 07:03:21', '2025-09-06 07:03:21'),
(190, 1, 3, 7, 5, 7, 1, NULL, '2025-09-06 07:03:21', '2025-09-06 07:03:21'),
(192, 1, 3, 7, 6, 7, 1, NULL, '2025-09-06 07:03:21', '2025-09-06 07:03:21'),
(194, 1, 4, 6, 5, 6, 1, NULL, '2025-09-06 07:03:21', '2025-09-06 07:03:21'),
(196, 1, 4, 7, 5, 7, 0, NULL, '2025-09-06 07:03:21', '2025-09-06 07:03:21'),
(198, 1, 4, 7, 6, 7, 1, NULL, '2025-09-06 07:03:21', '2025-09-06 07:03:21'),
(200, 1, 1, 6, 5, 6, 0, NULL, '2025-09-06 07:03:45', '2025-09-06 07:03:45'),
(202, 1, 1, 7, 5, 7, 0, NULL, '2025-09-06 07:03:45', '2025-09-06 07:03:45'),
(204, 1, 1, 7, 6, 7, 1, NULL, '2025-09-06 07:03:45', '2025-09-06 07:03:45'),
(206, 1, 2, 6, 5, 6, 1, NULL, '2025-09-06 07:03:45', '2025-09-06 07:03:45'),
(208, 1, 2, 7, 5, 7, 1, NULL, '2025-09-06 07:03:45', '2025-09-06 07:03:45'),
(210, 1, 2, 7, 6, 7, 1, NULL, '2025-09-06 07:03:45', '2025-09-06 07:03:45'),
(212, 1, 3, 6, 5, 6, 1, NULL, '2025-09-06 07:03:45', '2025-09-06 07:03:45'),
(214, 1, 3, 7, 5, 7, 1, NULL, '2025-09-06 07:03:45', '2025-09-06 07:03:45'),
(216, 1, 3, 7, 6, 7, 1, NULL, '2025-09-06 07:03:45', '2025-09-06 07:03:45'),
(218, 1, 4, 6, 5, 6, 1, NULL, '2025-09-06 07:03:45', '2025-09-06 07:03:45'),
(220, 1, 4, 7, 5, 7, 0, NULL, '2025-09-06 07:03:45', '2025-09-06 07:03:45'),
(222, 1, 4, 7, 6, 7, 1, NULL, '2025-09-06 07:03:45', '2025-09-06 07:03:45'),
(224, 1, 1, 6, 5, 6, 0, NULL, '2025-09-06 08:40:12', '2025-09-06 08:40:12'),
(226, 1, 1, 7, 5, 7, 0, NULL, '2025-09-06 08:40:12', '2025-09-06 08:40:12'),
(228, 1, 1, 7, 6, 7, 1, NULL, '2025-09-06 08:40:12', '2025-09-06 08:40:12'),
(230, 1, 2, 6, 5, 6, 1, NULL, '2025-09-06 08:40:12', '2025-09-06 08:40:12'),
(232, 1, 2, 7, 5, 7, 1, NULL, '2025-09-06 08:40:12', '2025-09-06 08:40:12'),
(234, 1, 2, 7, 6, 7, 1, NULL, '2025-09-06 08:40:12', '2025-09-06 08:40:12'),
(236, 1, 3, 6, 5, 6, 1, NULL, '2025-09-06 08:40:12', '2025-09-06 08:40:12'),
(238, 1, 3, 7, 5, 7, 1, NULL, '2025-09-06 08:40:12', '2025-09-06 08:40:12'),
(240, 1, 3, 7, 6, 7, 1, NULL, '2025-09-06 08:40:12', '2025-09-06 08:40:12'),
(242, 1, 4, 6, 5, 6, 1, NULL, '2025-09-06 08:40:12', '2025-09-06 08:40:12'),
(244, 1, 4, 7, 5, 7, 0, NULL, '2025-09-06 08:40:12', '2025-09-06 08:40:12'),
(246, 1, 4, 7, 6, 7, 1, NULL, '2025-09-06 08:40:12', '2025-09-06 08:40:12'),
(248, 1, 1, 6, 5, 6, 0, NULL, '2025-09-06 08:41:40', '2025-09-06 08:41:40'),
(250, 1, 1, 7, 5, 7, 0, NULL, '2025-09-06 08:41:40', '2025-09-06 08:41:40'),
(252, 1, 1, 7, 6, 7, 1, NULL, '2025-09-06 08:41:40', '2025-09-06 08:41:40'),
(254, 1, 2, 6, 5, 6, 1, NULL, '2025-09-06 08:41:40', '2025-09-06 08:41:40'),
(256, 1, 2, 7, 5, 7, 1, NULL, '2025-09-06 08:41:40', '2025-09-06 08:41:40'),
(258, 1, 2, 7, 6, 7, 1, NULL, '2025-09-06 08:41:40', '2025-09-06 08:41:40'),
(260, 1, 3, 6, 5, 6, 1, NULL, '2025-09-06 08:41:40', '2025-09-06 08:41:40'),
(262, 1, 3, 7, 5, 7, 1, NULL, '2025-09-06 08:41:40', '2025-09-06 08:41:40'),
(264, 1, 3, 7, 6, 7, 1, NULL, '2025-09-06 08:41:40', '2025-09-06 08:41:40'),
(266, 1, 4, 6, 5, 6, 1, NULL, '2025-09-06 08:41:40', '2025-09-06 08:41:40'),
(268, 1, 4, 7, 5, 7, 0, NULL, '2025-09-06 08:41:40', '2025-09-06 08:41:40'),
(270, 1, 4, 7, 6, 7, 1, NULL, '2025-09-06 08:41:40', '2025-09-06 08:41:40'),
(272, 1, 1, 6, 5, 6, 0, NULL, '2025-09-06 08:42:03', '2025-09-06 08:42:03'),
(274, 1, 1, 7, 5, 7, 0, NULL, '2025-09-06 08:42:03', '2025-09-06 08:42:03'),
(276, 1, 1, 7, 6, 7, 1, NULL, '2025-09-06 08:42:03', '2025-09-06 08:42:03'),
(278, 1, 2, 6, 5, 6, 1, NULL, '2025-09-06 08:42:03', '2025-09-06 08:42:03'),
(280, 1, 2, 7, 5, 7, 1, NULL, '2025-09-06 08:42:03', '2025-09-06 08:42:03'),
(282, 1, 2, 7, 6, 7, 1, NULL, '2025-09-06 08:42:03', '2025-09-06 08:42:03'),
(284, 1, 3, 6, 5, 6, 1, NULL, '2025-09-06 08:42:03', '2025-09-06 08:42:03'),
(286, 1, 3, 7, 5, 7, 1, NULL, '2025-09-06 08:42:03', '2025-09-06 08:42:03'),
(288, 1, 3, 7, 6, 7, 1, NULL, '2025-09-06 08:42:03', '2025-09-06 08:42:03'),
(290, 1, 4, 6, 5, 6, 1, NULL, '2025-09-06 08:42:03', '2025-09-06 08:42:03'),
(292, 1, 4, 7, 5, 7, 0, NULL, '2025-09-06 08:42:03', '2025-09-06 08:42:03'),
(294, 1, 4, 7, 6, 7, 1, NULL, '2025-09-06 08:42:03', '2025-09-06 08:42:03'),
(296, 1, 1, 6, 5, 6, 0, NULL, '2025-09-06 08:43:04', '2025-09-06 08:43:04'),
(298, 1, 1, 7, 5, 7, 0, NULL, '2025-09-06 08:43:04', '2025-09-06 08:43:04'),
(300, 1, 1, 7, 6, 7, 1, NULL, '2025-09-06 08:43:04', '2025-09-06 08:43:04'),
(302, 1, 2, 6, 5, 6, 1, NULL, '2025-09-06 08:43:04', '2025-09-06 08:43:04'),
(304, 1, 2, 7, 5, 7, 1, NULL, '2025-09-06 08:43:04', '2025-09-06 08:43:04'),
(306, 1, 2, 7, 6, 7, 1, NULL, '2025-09-06 08:43:04', '2025-09-06 08:43:04'),
(308, 1, 3, 6, 5, 6, 1, NULL, '2025-09-06 08:43:04', '2025-09-06 08:43:04'),
(310, 1, 3, 7, 5, 7, 1, NULL, '2025-09-06 08:43:04', '2025-09-06 08:43:04'),
(312, 1, 3, 7, 6, 7, 1, NULL, '2025-09-06 08:43:04', '2025-09-06 08:43:04'),
(314, 1, 4, 6, 5, 6, 1, NULL, '2025-09-06 08:43:04', '2025-09-06 08:43:04'),
(316, 1, 4, 7, 5, 7, 0, NULL, '2025-09-06 08:43:04', '2025-09-06 08:43:04'),
(318, 1, 4, 7, 6, 7, 1, NULL, '2025-09-06 08:43:04', '2025-09-06 08:43:04'),
(320, 1, 1, 6, 5, 6, 0, NULL, '2025-09-06 10:02:11', '2025-09-06 10:02:11'),
(322, 1, 1, 7, 5, 7, 0, NULL, '2025-09-06 10:02:11', '2025-09-06 10:02:11'),
(324, 1, 1, 7, 6, 7, 1, NULL, '2025-09-06 10:02:11', '2025-09-06 10:02:11'),
(326, 1, 2, 6, 5, 6, 1, NULL, '2025-09-06 10:02:11', '2025-09-06 10:02:11'),
(328, 1, 2, 7, 5, 7, 1, NULL, '2025-09-06 10:02:11', '2025-09-06 10:02:11'),
(330, 1, 2, 7, 6, 7, 1, NULL, '2025-09-06 10:02:11', '2025-09-06 10:02:11'),
(332, 1, 3, 6, 5, 6, 1, NULL, '2025-09-06 10:02:11', '2025-09-06 10:02:11'),
(334, 1, 3, 7, 5, 7, 1, NULL, '2025-09-06 10:02:11', '2025-09-06 10:02:11'),
(336, 1, 3, 7, 6, 7, 1, NULL, '2025-09-06 10:02:11', '2025-09-06 10:02:11'),
(338, 1, 4, 6, 5, 6, 1, NULL, '2025-09-06 10:02:11', '2025-09-06 10:02:11'),
(340, 1, 4, 7, 5, 7, 0, NULL, '2025-09-06 10:02:12', '2025-09-06 10:02:12'),
(342, 1, 4, 7, 6, 7, 1, NULL, '2025-09-06 10:02:12', '2025-09-06 10:02:12'),
(344, 1, 1, 6, 5, 6, 0, NULL, '2025-09-06 10:09:06', '2025-09-06 10:09:06'),
(346, 1, 1, 7, 5, 7, 0, NULL, '2025-09-06 10:09:06', '2025-09-06 10:09:06'),
(348, 1, 1, 7, 6, 7, 1, NULL, '2025-09-06 10:09:06', '2025-09-06 10:09:06'),
(350, 1, 2, 6, 5, 6, 1, NULL, '2025-09-06 10:09:06', '2025-09-06 10:09:06'),
(352, 1, 2, 7, 5, 7, 1, NULL, '2025-09-06 10:09:06', '2025-09-06 10:09:06'),
(354, 1, 2, 7, 6, 7, 1, NULL, '2025-09-06 10:09:06', '2025-09-06 10:09:06'),
(356, 1, 3, 6, 5, 6, 1, NULL, '2025-09-06 10:09:06', '2025-09-06 10:09:06'),
(358, 1, 3, 7, 5, 7, 1, NULL, '2025-09-06 10:09:06', '2025-09-06 10:09:06'),
(360, 1, 3, 7, 6, 7, 1, NULL, '2025-09-06 10:09:06', '2025-09-06 10:09:06'),
(362, 1, 4, 6, 5, 6, 1, NULL, '2025-09-06 10:09:06', '2025-09-06 10:09:06'),
(364, 1, 4, 7, 5, 7, 0, NULL, '2025-09-06 10:09:06', '2025-09-06 10:09:06'),
(366, 1, 4, 7, 6, 7, 1, NULL, '2025-09-06 10:09:06', '2025-09-06 10:09:06'),
(367, 1, 1, 5, 6, 5, 7, NULL, '2025-09-06 11:41:37', '2025-09-06 11:41:37'),
(368, 1, 1, 6, 5, 6, 0, NULL, '2025-09-06 11:41:37', '2025-09-06 11:41:37'),
(369, 1, 1, 5, 7, 5, 5, NULL, '2025-09-06 11:41:37', '2025-09-06 11:41:37'),
(370, 1, 1, 7, 5, 7, 0, NULL, '2025-09-06 11:41:37', '2025-09-06 11:41:37'),
(371, 1, 1, 6, 7, 6, 1, NULL, '2025-09-06 11:41:37', '2025-09-06 11:41:37'),
(372, 1, 1, 7, 6, 7, 1, NULL, '2025-09-06 11:41:37', '2025-09-06 11:41:37'),
(373, 1, 2, 5, 6, 5, 1, NULL, '2025-09-06 11:41:37', '2025-09-06 11:41:37'),
(374, 1, 2, 6, 5, 6, 1, NULL, '2025-09-06 11:41:37', '2025-09-06 11:41:37'),
(375, 1, 2, 5, 7, 5, 1, NULL, '2025-09-06 11:41:37', '2025-09-06 11:41:37'),
(376, 1, 2, 7, 5, 7, 1, NULL, '2025-09-06 11:41:37', '2025-09-06 11:41:37'),
(377, 1, 2, 6, 7, 6, 1, NULL, '2025-09-06 11:41:37', '2025-09-06 11:41:37'),
(378, 1, 2, 7, 6, 7, 1, NULL, '2025-09-06 11:41:37', '2025-09-06 11:41:37'),
(379, 1, 3, 5, 6, 5, 1, NULL, '2025-09-06 11:41:37', '2025-09-06 11:41:37'),
(380, 1, 3, 6, 5, 6, 1, NULL, '2025-09-06 11:41:37', '2025-09-06 11:41:37'),
(381, 1, 3, 5, 7, 5, 1, NULL, '2025-09-06 11:41:37', '2025-09-06 11:41:37'),
(382, 1, 3, 7, 5, 7, 1, NULL, '2025-09-06 11:41:37', '2025-09-06 11:41:37'),
(383, 1, 3, 6, 7, 6, 1, NULL, '2025-09-06 11:41:37', '2025-09-06 11:41:37'),
(384, 1, 3, 7, 6, 7, 1, NULL, '2025-09-06 11:41:37', '2025-09-06 11:41:37'),
(385, 1, 4, 5, 6, 5, 1, NULL, '2025-09-06 11:41:37', '2025-09-06 11:41:37'),
(386, 1, 4, 6, 5, 6, 1, NULL, '2025-09-06 11:41:37', '2025-09-06 11:41:37'),
(387, 1, 4, 5, 7, 5, 9, NULL, '2025-09-06 11:41:37', '2025-09-06 11:41:37'),
(388, 1, 4, 7, 5, 7, 0, NULL, '2025-09-06 11:41:37', '2025-09-06 11:41:37'),
(389, 1, 4, 6, 7, 6, 1, NULL, '2025-09-06 11:41:37', '2025-09-06 11:41:37'),
(390, 1, 4, 7, 6, 7, 1, NULL, '2025-09-06 11:41:37', '2025-09-06 11:41:37');

-- --------------------------------------------------------

--
-- Table structure for table `perbandingan_kriterias`
--

CREATE TABLE `perbandingan_kriterias` (
  `id` bigint UNSIGNED NOT NULL,
  `kriteria1_id` bigint UNSIGNED NOT NULL,
  `kriteria2_id` bigint UNSIGNED NOT NULL,
  `nilai` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `perbandingan_kriterias`
--

INSERT INTO `perbandingan_kriterias` (`id`, `kriteria1_id`, `kriteria2_id`, `nilai`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 3.00, '2025-09-06 09:50:40', '2025-09-06 09:50:40'),
(2, 2, 1, 0.33, '2025-09-06 09:50:40', '2025-09-06 09:50:40'),
(3, 1, 3, 3.00, '2025-09-06 09:50:40', '2025-09-06 09:50:40'),
(4, 3, 1, 0.33, '2025-09-06 09:50:40', '2025-09-06 09:50:40'),
(5, 1, 4, 5.00, '2025-09-06 09:50:40', '2025-09-06 09:50:40'),
(6, 4, 1, 0.20, '2025-09-06 09:50:40', '2025-09-06 09:50:40'),
(7, 2, 3, 4.00, '2025-09-06 09:50:40', '2025-09-06 09:50:40'),
(8, 3, 2, 0.25, '2025-09-06 09:50:40', '2025-09-06 09:50:40'),
(9, 2, 4, 2.00, '2025-09-06 09:50:40', '2025-09-06 09:50:40'),
(10, 4, 2, 0.50, '2025-09-06 09:50:40', '2025-09-06 09:50:40'),
(11, 3, 4, 2.00, '2025-09-06 09:50:40', '2025-09-06 09:50:40'),
(12, 4, 3, 0.50, '2025-09-06 09:50:40', '2025-09-06 09:50:40');

-- --------------------------------------------------------

--
-- Table structure for table `pertanyaans`
--

CREATE TABLE `pertanyaans` (
  `id` bigint UNSIGNED NOT NULL,
  `teks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kriteria_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pertanyaans`
--

INSERT INTO `pertanyaans` (`id`, `teks`, `created_at`, `updated_at`, `kriteria_id`) VALUES
(1, 'lllmmm', '2025-09-04 21:51:10', '2025-09-04 21:51:10', 1);

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
('AouuurD645WaSCLxHUSrzrNe1Nl1v1MuWyolBirR', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibnA0aHpWNmwzYjVpM0hLQ0YwVzBUSGxUeGVWdEN2clowNWdneUloSCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fX0=', 1757188191),
('xkcDOEtASu6tdwycGeXjqAPZCWWkx9JurZdxDbrT', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiaGxaS0NheEZJcWtjMVFrazdwdkU3MlNrNUJ1ODZZSGprOUtOSWpoRyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo0MDoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL29wZXJhdG9yL2Rhc2hib2FyZCI7fX0=', 1757218255);

-- --------------------------------------------------------

--
-- Table structure for table `siswas`
--

CREATE TABLE `siswas` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kelas_id` bigint UNSIGNED NOT NULL,
  `tahun_masuk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sekolah_asal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `siswas`
--

INSERT INTO `siswas` (`id`, `nama`, `nis`, `jenis_kelamin`, `tanggal_lahir`, `tempat_lahir`, `agama`, `alamat`, `telepon`, `email`, `kelas_id`, `tahun_masuk`, `sekolah_asal`, `created_at`, `updated_at`) VALUES
(1, 'Arikodwi Anto', '2205', 'Laki-laki', '2005-08-11', 'Ekang', 'Islam', 'KP. Sukoharjo', '81234567890', 'arikodwi@gmail.com', 1, '2023', 'TK', '2025-09-04 21:48:16', '2025-09-04 21:48:16'),
(2, 'Nanik Marieni', '2206', 'Perempuan', '2005-02-14', 'Batam', 'Islam', 'Jl. Merpati 5', '81234567891', 'nanik@gmail.com', 1, '2023', 'SD', '2025-09-04 21:48:16', '2025-09-04 21:48:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'guru'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'Operator', 'operator@example.com', NULL, '$2y$12$v8YLLzgYH2SgQ/X3x9sspOHcUUpqootHuXXOfRgGNa.6z4ew0.DRC', NULL, '2025-09-04 21:46:44', '2025-09-04 21:47:02', 'operator'),
(2, 'Ariko Dwi Anto', 'juraganngetik@gmail.com', NULL, '$2y$12$BEW1YUn/FfYVouVqDHr.o.bS0Y7holkWL.NZrmuz99T2G4LaTmc12', NULL, '2025-09-06 07:17:24', '2025-09-06 07:17:24', 'guru');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alternatifs`
--
ALTER TABLE `alternatifs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `alternatifs_kode_unique` (`kode`);

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
-- Indexes for table `hasil_ahp`
--
ALTER TABLE `hasil_ahp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hasil_ahp_kriteria_id_foreign` (`kriteria_id`);

--
-- Indexes for table `hasil_kuisioners`
--
ALTER TABLE `hasil_kuisioners`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hasil_kuisioners_siswa_id_foreign` (`siswa_id`),
  ADD KEY `hasil_kuisioners_pertanyaan_id_foreign` (`pertanyaan_id`),
  ADD KEY `hasil_kuisioners_jawaban_id_foreign` (`jawaban_id`);

--
-- Indexes for table `jawabans`
--
ALTER TABLE `jawabans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jawabans_siswa_id_foreign` (`siswa_id`),
  ADD KEY `jawabans_pertanyaan_id_foreign` (`pertanyaan_id`);

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
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kriterias`
--
ALTER TABLE `kriterias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kriterias_kode_unique` (`kode`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `perbandingan_alternatifs`
--
ALTER TABLE `perbandingan_alternatifs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `perbandingan_alternatifs_siswa_id_foreign` (`siswa_id`),
  ADD KEY `perbandingan_alternatifs_kriteria_id_foreign` (`kriteria_id`),
  ADD KEY `perbandingan_alternatifs_alternatif1_id_foreign` (`alternatif1_id`),
  ADD KEY `perbandingan_alternatifs_alternatif2_id_foreign` (`alternatif2_id`);

--
-- Indexes for table `perbandingan_kriterias`
--
ALTER TABLE `perbandingan_kriterias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `perbandingan_kriterias_kriteria1_id_foreign` (`kriteria1_id`),
  ADD KEY `perbandingan_kriterias_kriteria2_id_foreign` (`kriteria2_id`);

--
-- Indexes for table `pertanyaans`
--
ALTER TABLE `pertanyaans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pertanyaans_kriteria_id_foreign` (`kriteria_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `siswas`
--
ALTER TABLE `siswas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `siswas_nis_unique` (`nis`),
  ADD KEY `siswas_kelas_id_foreign` (`kelas_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alternatifs`
--
ALTER TABLE `alternatifs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hasil_ahp`
--
ALTER TABLE `hasil_ahp`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hasil_kuisioners`
--
ALTER TABLE `hasil_kuisioners`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jawabans`
--
ALTER TABLE `jawabans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kriterias`
--
ALTER TABLE `kriterias`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `perbandingan_alternatifs`
--
ALTER TABLE `perbandingan_alternatifs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=391;

--
-- AUTO_INCREMENT for table `perbandingan_kriterias`
--
ALTER TABLE `perbandingan_kriterias`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pertanyaans`
--
ALTER TABLE `pertanyaans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `siswas`
--
ALTER TABLE `siswas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hasil_ahp`
--
ALTER TABLE `hasil_ahp`
  ADD CONSTRAINT `hasil_ahp_kriteria_id_foreign` FOREIGN KEY (`kriteria_id`) REFERENCES `kriterias` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hasil_kuisioners`
--
ALTER TABLE `hasil_kuisioners`
  ADD CONSTRAINT `hasil_kuisioners_jawaban_id_foreign` FOREIGN KEY (`jawaban_id`) REFERENCES `jawabans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hasil_kuisioners_pertanyaan_id_foreign` FOREIGN KEY (`pertanyaan_id`) REFERENCES `pertanyaans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hasil_kuisioners_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jawabans`
--
ALTER TABLE `jawabans`
  ADD CONSTRAINT `jawabans_pertanyaan_id_foreign` FOREIGN KEY (`pertanyaan_id`) REFERENCES `pertanyaans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jawabans_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `perbandingan_alternatifs`
--
ALTER TABLE `perbandingan_alternatifs`
  ADD CONSTRAINT `perbandingan_alternatifs_alternatif1_id_foreign` FOREIGN KEY (`alternatif1_id`) REFERENCES `alternatifs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `perbandingan_alternatifs_alternatif2_id_foreign` FOREIGN KEY (`alternatif2_id`) REFERENCES `alternatifs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `perbandingan_alternatifs_kriteria_id_foreign` FOREIGN KEY (`kriteria_id`) REFERENCES `kriterias` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `perbandingan_alternatifs_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `perbandingan_kriterias`
--
ALTER TABLE `perbandingan_kriterias`
  ADD CONSTRAINT `perbandingan_kriterias_kriteria1_id_foreign` FOREIGN KEY (`kriteria1_id`) REFERENCES `kriterias` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `perbandingan_kriterias_kriteria2_id_foreign` FOREIGN KEY (`kriteria2_id`) REFERENCES `kriterias` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pertanyaans`
--
ALTER TABLE `pertanyaans`
  ADD CONSTRAINT `pertanyaans_kriteria_id_foreign` FOREIGN KEY (`kriteria_id`) REFERENCES `kriterias` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `siswas`
--
ALTER TABLE `siswas`
  ADD CONSTRAINT `siswas_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

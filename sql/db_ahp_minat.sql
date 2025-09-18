-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2025 at 03:59 PM
-- Server version: 11.8.2-MariaDB
-- PHP Version: 8.2.12

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
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
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
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hasil_ahp`
--

CREATE TABLE `hasil_ahp` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kriteria_id` bigint(20) UNSIGNED NOT NULL,
  `bobot` decimal(8,4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hasil_kuisioners`
--

CREATE TABLE `hasil_kuisioners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `siswa_id` bigint(20) UNSIGNED NOT NULL,
  `pertanyaan_id` bigint(20) UNSIGNED NOT NULL,
  `jawaban_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jawabans`
--

CREATE TABLE `jawabans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `siswa_id` bigint(20) UNSIGNED NOT NULL,
  `pertanyaan_id` bigint(20) UNSIGNED NOT NULL,
  `nilai` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kelas` varchar(255) NOT NULL,
  `jurusan` varchar(255) DEFAULT NULL,
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
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kode` varchar(255) NOT NULL,
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
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
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
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `perbandingan_alternatifs`
--

CREATE TABLE `perbandingan_alternatifs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `siswa_id` bigint(20) UNSIGNED NOT NULL,
  `kriteria_id` bigint(20) UNSIGNED NOT NULL,
  `alternatif1_id` bigint(20) UNSIGNED NOT NULL,
  `alternatif2_id` bigint(20) UNSIGNED NOT NULL,
  `pilihan` bigint(20) UNSIGNED NOT NULL,
  `nilai` int(11) NOT NULL,
  `alasan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `perbandingan_alternatifs`
--

INSERT INTO `perbandingan_alternatifs` (`id`, `siswa_id`, `kriteria_id`, `alternatif1_id`, `alternatif2_id`, `pilihan`, `nilai`, `alasan`, `created_at`, `updated_at`) VALUES
(416, 2, 1, 6, 5, 6, 1, NULL, '2025-09-17 05:18:47', '2025-09-17 05:18:47'),
(418, 2, 1, 7, 5, 7, 1, NULL, '2025-09-17 05:18:47', '2025-09-17 05:18:47'),
(420, 2, 1, 7, 6, 7, 1, NULL, '2025-09-17 05:18:47', '2025-09-17 05:18:47'),
(422, 2, 2, 6, 5, 6, 0, NULL, '2025-09-17 05:18:47', '2025-09-17 05:18:47'),
(424, 2, 2, 7, 5, 7, 1, NULL, '2025-09-17 05:18:47', '2025-09-17 05:18:47'),
(426, 2, 2, 7, 6, 7, 1, NULL, '2025-09-17 05:18:47', '2025-09-17 05:18:47'),
(428, 2, 3, 6, 5, 6, 1, NULL, '2025-09-17 05:18:47', '2025-09-17 05:18:47'),
(430, 2, 3, 7, 5, 7, 0, NULL, '2025-09-17 05:18:47', '2025-09-17 05:18:47'),
(432, 2, 3, 7, 6, 7, 1, NULL, '2025-09-17 05:18:47', '2025-09-17 05:18:47'),
(434, 2, 4, 6, 5, 6, 0, NULL, '2025-09-17 05:18:47', '2025-09-17 05:18:47'),
(436, 2, 4, 7, 5, 7, 1, NULL, '2025-09-17 05:18:47', '2025-09-17 05:18:47'),
(438, 2, 4, 7, 6, 7, 1, NULL, '2025-09-17 05:18:48', '2025-09-17 05:18:48'),
(440, 2, 1, 6, 5, 6, 0, 'Ia lebih cepat tangkap lewat gambar/diagram', '2025-09-17 06:44:48', '2025-09-17 06:44:48'),
(442, 2, 1, 7, 5, 7, 0, 'Visual lebih efektif daripada praktik langsung baginya', '2025-09-17 06:44:48', '2025-09-17 06:44:48'),
(444, 2, 1, 7, 6, 6, 0, 'Gerakan lebih baik dibanding hanya mendengar', '2025-09-17 06:44:48', '2025-09-17 06:44:48'),
(446, 2, 2, 6, 5, 6, 0, 'Ia paham dengan teks, grafik, dan gambar', '2025-09-17 06:44:48', '2025-09-17 06:44:48'),
(448, 2, 2, 7, 5, 7, 1, 'Visual lebih jelas dibanding praktik langsung', '2025-09-17 06:44:48', '2025-09-17 06:44:48'),
(450, 2, 2, 7, 6, 7, 1, 'Lebih mudah paham dengan praktik daripada sekadar mendengar', '2025-09-17 06:44:48', '2025-09-17 06:44:48'),
(452, 2, 3, 6, 5, 6, 0, 'Ia terbiasa membaca dan melihat contoh', '2025-09-17 06:44:48', '2025-09-17 06:44:48'),
(454, 2, 3, 7, 5, 7, 0, NULL, '2025-09-17 06:44:48', '2025-09-17 06:44:48'),
(456, 2, 3, 7, 6, 6, 0, NULL, '2025-09-17 06:44:48', '2025-09-17 06:44:48'),
(458, 2, 4, 6, 5, 6, 0, 'Ia lebih suka belajar dengan gambar dan video', '2025-09-17 06:44:48', '2025-09-17 06:44:48'),
(460, 2, 4, 7, 5, 7, 0, 'Ia lebih memilih membaca/menonton daripada praktik', '2025-09-17 06:44:48', '2025-09-17 06:44:48'),
(462, 2, 4, 7, 6, 6, 0, 'Lebih suka praktik dibanding hanya mendengar', '2025-09-17 06:44:48', '2025-09-17 06:44:48'),
(464, 2, 1, 6, 5, 6, 0, 'Ia lebih cepat tangkap lewat gambar/diagram', '2025-09-18 06:48:37', '2025-09-18 06:48:37'),
(466, 2, 1, 7, 5, 7, 0, 'Visual lebih efektif daripada praktik langsung baginya', '2025-09-18 06:48:37', '2025-09-18 06:48:37'),
(468, 2, 1, 7, 6, 6, 0, 'Gerakan lebih baik dibanding hanya mendengar', '2025-09-18 06:48:37', '2025-09-18 06:48:37'),
(470, 2, 2, 6, 5, 6, 0, 'Ia paham dengan teks, grafik, dan gambar', '2025-09-18 06:48:37', '2025-09-18 06:48:37'),
(472, 2, 2, 7, 5, 7, 1, 'Visual lebih jelas dibanding praktik langsung', '2025-09-18 06:48:37', '2025-09-18 06:48:37'),
(474, 2, 2, 7, 6, 7, 1, 'Lebih mudah paham dengan praktik daripada sekadar mendengar', '2025-09-18 06:48:37', '2025-09-18 06:48:37'),
(476, 2, 3, 6, 5, 6, 0, 'Ia terbiasa membaca dan melihat contoh', '2025-09-18 06:48:37', '2025-09-18 06:48:37'),
(478, 2, 3, 7, 5, 7, 0, NULL, '2025-09-18 06:48:37', '2025-09-18 06:48:37'),
(480, 2, 3, 7, 6, 6, 0, NULL, '2025-09-18 06:48:37', '2025-09-18 06:48:37'),
(482, 2, 4, 6, 5, 6, 0, 'Ia lebih suka belajar dengan gambar dan video', '2025-09-18 06:48:37', '2025-09-18 06:48:37'),
(484, 2, 4, 7, 5, 7, 0, 'Ia lebih memilih membaca/menonton daripada praktik', '2025-09-18 06:48:37', '2025-09-18 06:48:37'),
(486, 2, 4, 7, 6, 6, 0, 'Lebih suka praktik dibanding hanya mendengar', '2025-09-18 06:48:37', '2025-09-18 06:48:37'),
(488, 2, 1, 6, 5, 6, 0, 'Ia lebih cepat tangkap lewat gambar/diagram', '2025-09-18 06:49:56', '2025-09-18 06:49:56'),
(490, 2, 1, 7, 5, 7, 0, 'Visual lebih efektif daripada praktik langsung baginya', '2025-09-18 06:49:56', '2025-09-18 06:49:56'),
(492, 2, 1, 7, 6, 6, 0, 'Gerakan lebih baik dibanding hanya mendengar', '2025-09-18 06:49:57', '2025-09-18 06:49:57'),
(494, 2, 2, 6, 5, 6, 0, 'Ia paham dengan teks, grafik, dan gambar', '2025-09-18 06:49:57', '2025-09-18 06:49:57'),
(496, 2, 2, 7, 5, 7, 1, 'Visual lebih jelas dibanding praktik langsung', '2025-09-18 06:49:57', '2025-09-18 06:49:57'),
(498, 2, 2, 7, 6, 7, 1, 'Lebih mudah paham dengan praktik daripada sekadar mendengar', '2025-09-18 06:49:57', '2025-09-18 06:49:57'),
(500, 2, 3, 6, 5, 6, 0, 'Ia terbiasa membaca dan melihat contoh', '2025-09-18 06:49:57', '2025-09-18 06:49:57'),
(502, 2, 3, 7, 5, 7, 0, NULL, '2025-09-18 06:49:57', '2025-09-18 06:49:57'),
(504, 2, 3, 7, 6, 6, 0, NULL, '2025-09-18 06:49:57', '2025-09-18 06:49:57'),
(506, 2, 4, 6, 5, 6, 0, 'Ia lebih suka belajar dengan gambar dan video', '2025-09-18 06:49:57', '2025-09-18 06:49:57'),
(508, 2, 4, 7, 5, 7, 0, 'Ia lebih memilih membaca/menonton daripada praktik', '2025-09-18 06:49:57', '2025-09-18 06:49:57'),
(510, 2, 4, 7, 6, 6, 0, 'Lebih suka praktik dibanding hanya mendengar', '2025-09-18 06:49:57', '2025-09-18 06:49:57'),
(512, 2, 1, 6, 5, 6, 0, 'Ia lebih cepat tangkap lewat gambar/diagram', '2025-09-18 06:57:05', '2025-09-18 06:57:05'),
(514, 2, 1, 7, 5, 7, 0, 'Visual lebih efektif daripada praktik langsung baginya', '2025-09-18 06:57:05', '2025-09-18 06:57:05'),
(516, 2, 1, 7, 6, 6, 0, 'Gerakan lebih baik dibanding hanya mendengar', '2025-09-18 06:57:05', '2025-09-18 06:57:05'),
(518, 2, 2, 6, 5, 6, 0, 'Ia paham dengan teks, grafik, dan gambar', '2025-09-18 06:57:05', '2025-09-18 06:57:05'),
(520, 2, 2, 7, 5, 7, 1, 'Visual lebih jelas dibanding praktik langsung', '2025-09-18 06:57:05', '2025-09-18 06:57:05'),
(522, 2, 2, 7, 6, 7, 1, 'Lebih mudah paham dengan praktik daripada sekadar mendengar', '2025-09-18 06:57:05', '2025-09-18 06:57:05'),
(524, 2, 3, 6, 5, 6, 0, 'Ia terbiasa membaca dan melihat contoh', '2025-09-18 06:57:05', '2025-09-18 06:57:05'),
(526, 2, 3, 7, 5, 7, 0, NULL, '2025-09-18 06:57:05', '2025-09-18 06:57:05'),
(528, 2, 3, 7, 6, 6, 0, NULL, '2025-09-18 06:57:05', '2025-09-18 06:57:05'),
(530, 2, 4, 6, 5, 6, 0, 'Ia lebih suka belajar dengan gambar dan video', '2025-09-18 06:57:06', '2025-09-18 06:57:06'),
(532, 2, 4, 7, 5, 7, 0, 'Ia lebih memilih membaca/menonton daripada praktik', '2025-09-18 06:57:06', '2025-09-18 06:57:06'),
(534, 2, 4, 7, 6, 6, 0, 'Lebih suka praktik dibanding hanya mendengar', '2025-09-18 06:57:06', '2025-09-18 06:57:06'),
(535, 2, 1, 5, 6, 5, 5, 'Ia lebih cepat tangkap lewat gambar/diagram', '2025-09-18 06:58:02', '2025-09-18 06:58:02'),
(536, 2, 1, 6, 5, 6, 0, 'Ia lebih cepat tangkap lewat gambar/diagram', '2025-09-18 06:58:02', '2025-09-18 06:58:02'),
(537, 2, 1, 5, 7, 5, 3, 'Visual lebih efektif daripada praktik langsung baginya', '2025-09-18 06:58:02', '2025-09-18 06:58:02'),
(538, 2, 1, 7, 5, 7, 0, 'Visual lebih efektif daripada praktik langsung baginya', '2025-09-18 06:58:02', '2025-09-18 06:58:02'),
(539, 2, 1, 6, 7, 7, 3, 'Gerakan lebih baik dibanding hanya mendengar', '2025-09-18 06:58:02', '2025-09-18 06:58:02'),
(540, 2, 1, 7, 6, 6, 0, 'Gerakan lebih baik dibanding hanya mendengar', '2025-09-18 06:58:02', '2025-09-18 06:58:02'),
(541, 2, 2, 5, 6, 5, 7, 'Ia paham dengan teks, grafik, dan gambar', '2025-09-18 06:58:02', '2025-09-18 06:58:02'),
(542, 2, 2, 6, 5, 6, 0, 'Ia paham dengan teks, grafik, dan gambar', '2025-09-18 06:58:02', '2025-09-18 06:58:02'),
(543, 2, 2, 5, 7, 5, 1, 'Visual lebih jelas dibanding praktik langsung', '2025-09-18 06:58:02', '2025-09-18 06:58:02'),
(544, 2, 2, 7, 5, 7, 1, 'Visual lebih jelas dibanding praktik langsung', '2025-09-18 06:58:02', '2025-09-18 06:58:02'),
(545, 2, 2, 6, 7, 6, 1, 'Lebih mudah paham dengan praktik daripada sekadar mendengar', '2025-09-18 06:58:02', '2025-09-18 06:58:02'),
(546, 2, 2, 7, 6, 7, 1, 'Lebih mudah paham dengan praktik daripada sekadar mendengar', '2025-09-18 06:58:02', '2025-09-18 06:58:02'),
(547, 2, 3, 5, 6, 5, 5, 'Ia terbiasa membaca dan melihat contoh', '2025-09-18 06:58:02', '2025-09-18 06:58:02'),
(548, 2, 3, 6, 5, 6, 0, 'Ia terbiasa membaca dan melihat contoh', '2025-09-18 06:58:02', '2025-09-18 06:58:02'),
(549, 2, 3, 5, 7, 5, 3, NULL, '2025-09-18 06:58:02', '2025-09-18 06:58:02'),
(550, 2, 3, 7, 5, 7, 0, NULL, '2025-09-18 06:58:02', '2025-09-18 06:58:02'),
(551, 2, 3, 6, 7, 7, 3, NULL, '2025-09-18 06:58:02', '2025-09-18 06:58:02'),
(552, 2, 3, 7, 6, 6, 0, NULL, '2025-09-18 06:58:02', '2025-09-18 06:58:02'),
(553, 2, 4, 5, 6, 5, 5, 'Ia lebih suka belajar dengan gambar dan video', '2025-09-18 06:58:02', '2025-09-18 06:58:02'),
(554, 2, 4, 6, 5, 6, 0, 'Ia lebih suka belajar dengan gambar dan video', '2025-09-18 06:58:02', '2025-09-18 06:58:02'),
(555, 2, 4, 5, 7, 5, 3, 'Ia lebih memilih membaca/menonton daripada praktik', '2025-09-18 06:58:02', '2025-09-18 06:58:02'),
(556, 2, 4, 7, 5, 7, 0, 'Ia lebih memilih membaca/menonton daripada praktik', '2025-09-18 06:58:02', '2025-09-18 06:58:02'),
(557, 2, 4, 6, 7, 7, 3, 'Lebih suka praktik dibanding hanya mendengar', '2025-09-18 06:58:02', '2025-09-18 06:58:02'),
(558, 2, 4, 7, 6, 6, 0, 'Lebih suka praktik dibanding hanya mendengar', '2025-09-18 06:58:02', '2025-09-18 06:58:02');

-- --------------------------------------------------------

--
-- Table structure for table `perbandingan_kriterias`
--

CREATE TABLE `perbandingan_kriterias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kriteria1_id` bigint(20) UNSIGNED NOT NULL,
  `kriteria2_id` bigint(20) UNSIGNED NOT NULL,
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
  `id` bigint(20) UNSIGNED NOT NULL,
  `teks` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kriteria_id` bigint(20) UNSIGNED NOT NULL
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
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('EbIEA06OJCblRLvX2aBNfWwSGTEXc7pZW444mXBf', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSTZMSEtTY0pEd2lPYmdVTDBQMkxiNmZmMlZDa09Ub01Va0NHRVVLQSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNjoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL29wZXJhdG9yL3Npc3dhIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9mb3Jnb3QtcGFzc3dvcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1758176734),
('geYVodY8q0sk8d4erXWMmrQr88tEh5oyzzRcDICX', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoickw3SWd3WGY2dlRLdU42YXNpU2gxZjRuUEZiU1pOaE5NaElGYzdvWSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9vcGVyYXRvci9ndXJ1Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1758203966),
('myB1ZgxA5E5e7PczJmWCaoEPCYsmEvC0MRt20m0C', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSHd1QjRocFNqVzd4cnVCZFVyQXl1UU9JZnk1NDZmMUM3eUlRanN5OSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9vcGVyYXRvci9wZXJiYW5kaW5nYW4tYWx0ZXJuYXRpZi9jZXRhay1wZGYiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1758116869),
('Xoh6hFaniSq5yTDdaLDs9phPQmQhhf7K1xpghSxG', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWE1TMkdvdGhrbmxXSTdTN1RQd01Gb2Eya1pTaTV4T2JNNHVWVnlNcSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9vcGVyYXRvci9rcml0ZXJpYSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1758164322);

-- --------------------------------------------------------

--
-- Table structure for table `siswas`
--

CREATE TABLE `siswas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nis` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `agama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `telepon` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `kelas_id` bigint(20) UNSIGNED NOT NULL,
  `tahun_masuk` varchar(255) DEFAULT NULL,
  `sekolah_asal` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `siswas`
--

INSERT INTO `siswas` (`id`, `nama`, `nis`, `jenis_kelamin`, `tanggal_lahir`, `tempat_lahir`, `agama`, `alamat`, `telepon`, `email`, `kelas_id`, `tahun_masuk`, `sekolah_asal`, `created_at`, `updated_at`) VALUES
(2, 'Nanik Marieni', '5511', 'Perempuan', '2005-02-14', 'Batam', 'Islam', 'Jl. Merpati 5', '81234567891', 'nanik@gmail.com', 1, '2023', 'TK Satu Atap', '2025-09-04 21:48:16', '2025-09-17 04:05:49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'guru'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'Operator', 'operator@example.com', NULL, '$2y$12$v8YLLzgYH2SgQ/X3x9sspOHcUUpqootHuXXOfRgGNa.6z4ew0.DRC', NULL, '2025-09-04 21:46:44', '2025-09-04 21:47:02', 'operator'),
(2, 'Suroso, S.pd', 'suroso@gmail.com', NULL, '$2y$12$BEW1YUn/FfYVouVqDHr.o.bS0Y7holkWL.NZrmuz99T2G4LaTmc12', NULL, '2025-09-06 07:17:24', '2025-09-17 05:13:04', 'guru');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hasil_ahp`
--
ALTER TABLE `hasil_ahp`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hasil_kuisioners`
--
ALTER TABLE `hasil_kuisioners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jawabans`
--
ALTER TABLE `jawabans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kriterias`
--
ALTER TABLE `kriterias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `perbandingan_alternatifs`
--
ALTER TABLE `perbandingan_alternatifs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=559;

--
-- AUTO_INCREMENT for table `perbandingan_kriterias`
--
ALTER TABLE `perbandingan_kriterias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pertanyaans`
--
ALTER TABLE `pertanyaans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `siswas`
--
ALTER TABLE `siswas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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

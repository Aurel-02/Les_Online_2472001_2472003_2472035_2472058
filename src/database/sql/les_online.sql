-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2026 at 02:19 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.5.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `les_online`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `user_id`, `type`, `description`, `created_at`, `updated_at`) VALUES
(1, 11, 'materi', 'Menonton video materi pembelajaran', '2026-05-14 05:44:32', '2026-05-14 05:44:32'),
(2, 11, 'materi', 'Menonton video materi pembelajaran', '2026-05-14 05:47:26', '2026-05-14 05:47:26'),
(3, 11, 'catatan', 'Membaca dan membuat catatan materi', '2026-05-14 05:47:29', '2026-05-14 05:47:29'),
(4, 11, 'materi', 'Menonton video materi pembelajaran', '2026-05-14 12:48:44', '2026-05-14 12:48:44'),
(5, 11, 'materi', 'Menonton video materi pembelajaran', '2026-05-14 13:00:28', '2026-05-14 13:00:28'),
(6, 11, 'materi', 'Menonton video materi pembelajaran', '2026-05-14 13:10:53', '2026-05-14 13:10:53'),
(7, 11, 'materi', 'Menonton video materi pembelajaran', '2026-05-14 13:10:57', '2026-05-14 13:10:57'),
(8, 11, 'materi', 'Menonton video materi pembelajaran', '2026-05-14 13:11:11', '2026-05-14 13:11:11'),
(9, 11, 'catatan', 'Membaca dan membuat catatan materi', '2026-05-14 13:11:17', '2026-05-14 13:11:17'),
(10, 11, 'materi', 'Menonton video materi pembelajaran', '2026-05-14 13:11:26', '2026-05-14 13:11:26'),
(11, 11, 'ujian', 'Menyelesaikan Try Out UTBK/SNBT dengan skor raw 15 (nilai 25)', '2026-05-19 13:52:08', '2026-05-19 13:52:08'),
(12, 11, 'materi', 'Menonton video materi pembelajaran', '2026-05-26 08:37:19', '2026-05-26 08:37:19'),
(13, 11, 'catatan', 'Membaca dan membuat catatan materi', '2026-05-26 08:37:30', '2026-05-26 08:37:30'),
(14, 11, 'materi', 'Menonton video materi pembelajaran', '2026-05-26 08:37:39', '2026-05-26 08:37:39'),
(15, 11, 'materi', 'Menonton video materi pembelajaran', '2026-05-26 08:48:51', '2026-05-26 08:48:51'),
(16, 11, 'materi', 'Menonton video materi pembelajaran', '2026-05-26 08:53:30', '2026-05-26 08:53:30'),
(17, 11, 'materi', 'Menonton video materi pembelajaran', '2026-05-26 08:53:33', '2026-05-26 08:53:33'),
(18, 11, 'materi', 'Menonton video materi pembelajaran', '2026-05-26 08:53:53', '2026-05-26 08:53:53'),
(19, 11, 'materi', 'Menonton video materi pembelajaran', '2026-05-26 08:57:24', '2026-05-26 08:57:24'),
(20, 11, 'materi', 'Menonton video materi pembelajaran', '2026-05-26 08:57:37', '2026-05-26 08:57:37'),
(21, 11, 'materi', 'Menonton video materi pembelajaran', '2026-05-26 08:58:39', '2026-05-26 08:58:39'),
(22, 11, 'materi', 'Menonton video materi pembelajaran', '2026-05-26 09:00:34', '2026-05-26 09:00:34'),
(23, 11, 'materi', 'Menonton video materi pembelajaran', '2026-05-26 09:09:41', '2026-05-26 09:09:41'),
(24, 11, 'materi', 'Menonton video materi pembelajaran', '2026-05-26 09:14:26', '2026-05-26 09:14:26'),
(25, 11, 'materi', 'Menonton video materi pembelajaran', '2026-05-26 09:19:45', '2026-05-26 09:19:45'),
(26, 11, 'materi', 'Menonton video materi pembelajaran', '2026-05-26 09:21:15', '2026-05-26 09:21:15'),
(27, 11, 'materi', 'Menonton video materi pembelajaran', '2026-05-26 09:21:57', '2026-05-26 09:21:57'),
(28, 11, 'materi', 'Menonton video materi pembelajaran', '2026-05-26 09:22:10', '2026-05-26 09:22:10'),
(29, 11, 'catatan', 'Membaca dan membuat catatan materi', '2026-05-26 09:26:00', '2026-05-26 09:26:00'),
(30, 11, 'materi', 'Menonton video materi pembelajaran', '2026-05-26 09:26:06', '2026-05-26 09:26:06'),
(31, 11, 'catatan', 'Membaca dan membuat catatan materi', '2026-05-26 09:26:08', '2026-05-26 09:26:08'),
(32, 11, 'materi', 'Menonton video materi pembelajaran', '2026-05-26 09:27:11', '2026-05-26 09:27:11'),
(33, 11, 'catatan', 'Membuka daftar catatan', '2026-05-26 10:02:01', '2026-05-26 10:02:01'),
(34, 11, 'materi', 'Menonton video materi pembelajaran', '2026-05-26 10:02:10', '2026-05-26 10:02:10'),
(35, 11, 'catatan', 'Membuka daftar catatan', '2026-05-26 10:02:28', '2026-05-26 10:02:28'),
(36, 11, 'materi', 'Menonton video materi pembelajaran', '2026-05-26 10:02:38', '2026-05-26 10:02:38'),
(37, 11, 'materi', 'Menonton video materi pembelajaran', '2026-05-26 10:02:47', '2026-05-26 10:02:47'),
(38, 11, 'catatan', 'Membuka daftar catatan', '2026-05-26 10:03:01', '2026-05-26 10:03:01'),
(39, 11, 'catatan', 'Membuka daftar catatan', '2026-05-26 10:03:19', '2026-05-26 10:03:19'),
(40, 11, 'catatan', 'Membuka daftar catatan', '2026-05-26 10:03:50', '2026-05-26 10:03:50'),
(41, 11, 'materi', 'Menonton video materi pembelajaran', '2026-05-26 10:03:58', '2026-05-26 10:03:58'),
(42, 11, 'catatan', 'Membuka daftar catatan', '2026-05-26 10:04:05', '2026-05-26 10:04:05'),
(43, 11, 'catatan', 'Membuka daftar catatan', '2026-05-26 10:05:19', '2026-05-26 10:05:19'),
(44, 11, 'pembelian', 'Membeli paket Persiapan UTBK SBMPTN seharga 525.000 dengan voucher SIAPUTBK', '2026-06-13 02:35:04', '2026-06-13 02:35:04'),
(45, 11, 'pembelian', 'Membeli paket Persiapan UTBK SBMPTN seharga 525.000 dengan voucher SIAPUTBK', '2026-06-13 02:39:50', '2026-06-13 02:39:50'),
(46, 11, 'materi', 'Menonton video materi pembelajaran', '2026-06-18 13:10:46', '2026-06-18 13:10:46'),
(47, 11, 'catatan', 'Membuka daftar catatan', '2026-06-18 13:11:12', '2026-06-18 13:11:12'),
(48, 11, 'materi', 'Menonton video materi pembelajaran', '2026-06-18 13:11:20', '2026-06-18 13:11:20'),
(49, 11, 'ujian', 'Menyelesaikan Try Out UTBK/SNBT dengan skor raw 0 (nilai 0)', '2026-06-18 13:38:12', '2026-06-18 13:38:12'),
(50, 11, 'ujian', 'Menyelesaikan Try Out UTBK/SNBT dengan skor raw 45 (nilai 75)', '2026-06-18 13:42:11', '2026-06-18 13:42:11'),
(51, 6, 'materi', 'Menambahkan materi baru: Pengantar Persamaan Linear Dua Variabel', '2026-06-18 13:54:13', '2026-06-18 13:54:13'),
(52, 11, 'catatan', 'Membuka daftar catatan', '2026-06-18 13:54:46', '2026-06-18 13:54:46'),
(53, 6, 'materi', 'Memperbarui materi: Pengantar Persamaan Linear Dua Variabel', '2026-06-18 14:10:28', '2026-06-18 14:10:28'),
(54, 6, 'materi', 'Menghapus materi: Bahasa Indonesia - Teks Laporan Hasil Observasi', '2026-06-18 14:10:54', '2026-06-18 14:10:54'),
(55, 11, 'pembelian', 'Membeli paket Siap Kejar PTN seharga 330.000 dengan voucher BACK TO SCHOOL', '2026-06-18 14:13:34', '2026-06-18 14:13:34'),
(56, 12, 'pembelian', 'Membeli paket Siap Kejar PTN seharga 330.000 dengan voucher BACK TO SCHOOL', '2026-06-18 14:14:25', '2026-06-18 14:14:25');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `catatan`
--

CREATE TABLE `catatan` (
  `id_catatan` bigint(20) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL,
  `mapel` varchar(255) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `isi_catatan` text NOT NULL,
  `cover_color` varchar(255) NOT NULL DEFAULT 'sage',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `catatan`
--

INSERT INTO `catatan` (`id_catatan`, `id_user`, `mapel`, `judul`, `isi_catatan`, `cover_color`, `created_at`, `updated_at`) VALUES
(1, 11, 'Matematika Wajib', 'Catatan: Matematika Wajib', 'catatan matematika', 'blue', '2026-05-26 10:02:28', '2026-05-26 10:02:28'),
(2, 11, 'Ekonomi', 'Catatan: Ekonomi', 'catatan ekonomi', 'amber', '2026-05-26 10:03:01', '2026-05-26 10:03:01'),
(3, 11, 'Fisika', 'Catatan: Fisika', 'catetan fisika', 'mauve', '2026-06-18 13:11:12', '2026-06-18 13:11:12');

-- --------------------------------------------------------

--
-- Table structure for table `catatans`
--

CREATE TABLE `catatans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `category` varchar(255) NOT NULL DEFAULT 'Umum',
  `content` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `id_exam` int(11) NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `tipe_ujian` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exam_histories`
--

CREATE TABLE `exam_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `jenis` varchar(20) NOT NULL,
  `mapel` varchar(100) NOT NULL,
  `score` int(11) NOT NULL,
  `correct` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam_histories`
--

INSERT INTO `exam_histories` (`id`, `user_id`, `jenis`, `mapel`, `score`, `correct`, `total`, `created_at`, `updated_at`) VALUES
(1, 11, 'uas', 'Matematika Wajib', 0, 0, 10, '2026-05-14 05:10:43', '2026-05-14 05:10:43');

-- --------------------------------------------------------

--
-- Table structure for table `exam_scores`
--

CREATE TABLE `exam_scores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `jenis` varchar(20) NOT NULL,
  `mapel` varchar(100) NOT NULL,
  `score` int(11) NOT NULL,
  `correct` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `utbk_raw_score` int(11) DEFAULT NULL,
  `questions_snapshot` longtext NOT NULL,
  `student_answers` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam_scores`
--

INSERT INTO `exam_scores` (`id`, `user_id`, `jenis`, `mapel`, `score`, `correct`, `total`, `utbk_raw_score`, `questions_snapshot`, `student_answers`, `created_at`, `updated_at`) VALUES
(1, 11, 'uts', 'Matematika Wajib', 0, 0, 10, NULL, '\"[{\\\"id\\\":1,\\\"text\\\":\\\"Soal No. 1: Turunan pertama dari f(x) = 5x\\\\u00b2 + 7x + 8 adalah?\\\",\\\"options\\\":{\\\"A\\\":\\\"5x + 7\\\",\\\"B\\\":\\\"10x + 8\\\",\\\"C\\\":\\\"10x + 7\\\",\\\"D\\\":\\\"5x\\\\u00b2 + 7\\\"},\\\"correct\\\":\\\"C\\\",\\\"explanation\\\":\\\"Aturan turunan pangkat: d\\\\\\/dx(ax^n) = n\\\\u00b7ax^(n-1). Untuk 5x\\\\u00b2 \\\\u2192 2\\\\u00b75x = 10x. Untuk 7x \\\\u2192 7. Konstanta 8 hilang. Jadi f\'(x) = 10x + 7.\\\"},{\\\"id\\\":2,\\\"text\\\":\\\"Soal No. 2: Turunan pertama dari f(x) = 6x\\\\u00b2 + 7x + 5 adalah?\\\",\\\"options\\\":{\\\"A\\\":\\\"6x + 7\\\",\\\"B\\\":\\\"12x + 5\\\",\\\"C\\\":\\\"12x + 7\\\",\\\"D\\\":\\\"6x\\\\u00b2 + 7\\\"},\\\"correct\\\":\\\"C\\\",\\\"explanation\\\":\\\"Aturan turunan pangkat: d\\\\\\/dx(ax^n) = n\\\\u00b7ax^(n-1). Untuk 6x\\\\u00b2 \\\\u2192 2\\\\u00b76x = 12x. Untuk 7x \\\\u2192 7. Konstanta 5 hilang. Jadi f\'(x) = 12x + 7.\\\"},{\\\"id\\\":3,\\\"text\\\":\\\"Soal No. 3: Turunan pertama dari f(x) = 2x\\\\u00b2 + 1x + 8 adalah?\\\",\\\"options\\\":{\\\"A\\\":\\\"2x + 1\\\",\\\"B\\\":\\\"4x + 8\\\",\\\"C\\\":\\\"4x + 1\\\",\\\"D\\\":\\\"2x\\\\u00b2 + 1\\\"},\\\"correct\\\":\\\"C\\\",\\\"explanation\\\":\\\"Aturan turunan pangkat: d\\\\\\/dx(ax^n) = n\\\\u00b7ax^(n-1). Untuk 2x\\\\u00b2 \\\\u2192 2\\\\u00b72x = 4x. Untuk 1x \\\\u2192 1. Konstanta 8 hilang. Jadi f\'(x) = 4x + 1.\\\"},{\\\"id\\\":4,\\\"text\\\":\\\"Soal No. 4: Turunan pertama dari f(x) = 6x\\\\u00b2 + 7x + 2 adalah?\\\",\\\"options\\\":{\\\"A\\\":\\\"6x + 7\\\",\\\"B\\\":\\\"12x + 2\\\",\\\"C\\\":\\\"12x + 7\\\",\\\"D\\\":\\\"6x\\\\u00b2 + 7\\\"},\\\"correct\\\":\\\"C\\\",\\\"explanation\\\":\\\"Aturan turunan pangkat: d\\\\\\/dx(ax^n) = n\\\\u00b7ax^(n-1). Untuk 6x\\\\u00b2 \\\\u2192 2\\\\u00b76x = 12x. Untuk 7x \\\\u2192 7. Konstanta 2 hilang. Jadi f\'(x) = 12x + 7.\\\"},{\\\"id\\\":5,\\\"text\\\":\\\"Soal No. 5: Turunan pertama dari f(x) = 1x\\\\u00b2 + 3x + 4 adalah?\\\",\\\"options\\\":{\\\"A\\\":\\\"1x + 3\\\",\\\"B\\\":\\\"2x + 4\\\",\\\"C\\\":\\\"2x + 3\\\",\\\"D\\\":\\\"1x\\\\u00b2 + 3\\\"},\\\"correct\\\":\\\"C\\\",\\\"explanation\\\":\\\"Aturan turunan pangkat: d\\\\\\/dx(ax^n) = n\\\\u00b7ax^(n-1). Untuk 1x\\\\u00b2 \\\\u2192 2\\\\u00b71x = 2x. Untuk 3x \\\\u2192 3. Konstanta 4 hilang. Jadi f\'(x) = 2x + 3.\\\"},{\\\"id\\\":6,\\\"text\\\":\\\"Soal No. 6: Turunan pertama dari f(x) = 1x\\\\u00b2 + 4x + 6 adalah?\\\",\\\"options\\\":{\\\"A\\\":\\\"1x + 4\\\",\\\"B\\\":\\\"2x + 6\\\",\\\"C\\\":\\\"2x + 4\\\",\\\"D\\\":\\\"1x\\\\u00b2 + 4\\\"},\\\"correct\\\":\\\"C\\\",\\\"explanation\\\":\\\"Aturan turunan pangkat: d\\\\\\/dx(ax^n) = n\\\\u00b7ax^(n-1). Untuk 1x\\\\u00b2 \\\\u2192 2\\\\u00b71x = 2x. Untuk 4x \\\\u2192 4. Konstanta 6 hilang. Jadi f\'(x) = 2x + 4.\\\"},{\\\"id\\\":7,\\\"text\\\":\\\"Soal No. 7: Turunan pertama dari f(x) = 4x\\\\u00b2 + 10x + 4 adalah?\\\",\\\"options\\\":{\\\"A\\\":\\\"4x + 10\\\",\\\"B\\\":\\\"8x + 4\\\",\\\"C\\\":\\\"8x + 10\\\",\\\"D\\\":\\\"4x\\\\u00b2 + 10\\\"},\\\"correct\\\":\\\"C\\\",\\\"explanation\\\":\\\"Aturan turunan pangkat: d\\\\\\/dx(ax^n) = n\\\\u00b7ax^(n-1). Untuk 4x\\\\u00b2 \\\\u2192 2\\\\u00b74x = 8x. Untuk 10x \\\\u2192 10. Konstanta 4 hilang. Jadi f\'(x) = 8x + 10.\\\"},{\\\"id\\\":8,\\\"text\\\":\\\"Soal No. 8: Turunan pertama dari f(x) = 6x\\\\u00b2 + 1x + 2 adalah?\\\",\\\"options\\\":{\\\"A\\\":\\\"6x + 1\\\",\\\"B\\\":\\\"12x + 2\\\",\\\"C\\\":\\\"12x + 1\\\",\\\"D\\\":\\\"6x\\\\u00b2 + 1\\\"},\\\"correct\\\":\\\"C\\\",\\\"explanation\\\":\\\"Aturan turunan pangkat: d\\\\\\/dx(ax^n) = n\\\\u00b7ax^(n-1). Untuk 6x\\\\u00b2 \\\\u2192 2\\\\u00b76x = 12x. Untuk 1x \\\\u2192 1. Konstanta 2 hilang. Jadi f\'(x) = 12x + 1.\\\"},{\\\"id\\\":9,\\\"text\\\":\\\"Soal No. 9: Turunan pertama dari f(x) = 1x\\\\u00b2 + 8x + 8 adalah?\\\",\\\"options\\\":{\\\"A\\\":\\\"1x + 8\\\",\\\"B\\\":\\\"2x + 8\\\",\\\"C\\\":\\\"2x + 8\\\",\\\"D\\\":\\\"1x\\\\u00b2 + 8\\\"},\\\"correct\\\":\\\"C\\\",\\\"explanation\\\":\\\"Aturan turunan pangkat: d\\\\\\/dx(ax^n) = n\\\\u00b7ax^(n-1). Untuk 1x\\\\u00b2 \\\\u2192 2\\\\u00b71x = 2x. Untuk 8x \\\\u2192 8. Konstanta 8 hilang. Jadi f\'(x) = 2x + 8.\\\"},{\\\"id\\\":10,\\\"text\\\":\\\"Soal No. 10: Turunan pertama dari f(x) = 6x\\\\u00b2 + 8x + 8 adalah?\\\",\\\"options\\\":{\\\"A\\\":\\\"6x + 8\\\",\\\"B\\\":\\\"12x + 8\\\",\\\"C\\\":\\\"12x + 8\\\",\\\"D\\\":\\\"6x\\\\u00b2 + 8\\\"},\\\"correct\\\":\\\"C\\\",\\\"explanation\\\":\\\"Aturan turunan pangkat: d\\\\\\/dx(ax^n) = n\\\\u00b7ax^(n-1). Untuk 6x\\\\u00b2 \\\\u2192 2\\\\u00b76x = 12x. Untuk 8x \\\\u2192 8. Konstanta 8 hilang. Jadi f\'(x) = 12x + 8.\\\"}]\"', '\"[]\"', '2026-05-14 05:29:07', '2026-05-14 05:29:07'),
(2, 11, 'uas', 'Matematika Wajib', 0, 0, 10, NULL, '[{\"id\":1,\"text\":\"Soal No. 1: Turunan pertama dari f(x) = 4x\\u00b2 + 8x + 3 adalah?\",\"options\":{\"A\":\"4x + 8\",\"B\":\"8x + 3\",\"C\":\"8x + 8\",\"D\":\"4x\\u00b2 + 8\"},\"correct\":\"C\",\"explanation\":\"Aturan turunan pangkat: d\\/dx(ax^n) = n\\u00b7ax^(n-1). Untuk 4x\\u00b2 \\u2192 2\\u00b74x = 8x. Untuk 8x \\u2192 8. Konstanta 3 hilang. Jadi f\'(x) = 8x + 8.\"},{\"id\":2,\"text\":\"Soal No. 2: Turunan pertama dari f(x) = 6x\\u00b2 + 7x + 2 adalah?\",\"options\":{\"A\":\"6x + 7\",\"B\":\"12x + 2\",\"C\":\"12x + 7\",\"D\":\"6x\\u00b2 + 7\"},\"correct\":\"C\",\"explanation\":\"Aturan turunan pangkat: d\\/dx(ax^n) = n\\u00b7ax^(n-1). Untuk 6x\\u00b2 \\u2192 2\\u00b76x = 12x. Untuk 7x \\u2192 7. Konstanta 2 hilang. Jadi f\'(x) = 12x + 7.\"},{\"id\":3,\"text\":\"Soal No. 3: Turunan pertama dari f(x) = 5x\\u00b2 + 4x + 2 adalah?\",\"options\":{\"A\":\"5x + 4\",\"B\":\"10x + 2\",\"C\":\"10x + 4\",\"D\":\"5x\\u00b2 + 4\"},\"correct\":\"C\",\"explanation\":\"Aturan turunan pangkat: d\\/dx(ax^n) = n\\u00b7ax^(n-1). Untuk 5x\\u00b2 \\u2192 2\\u00b75x = 10x. Untuk 4x \\u2192 4. Konstanta 2 hilang. Jadi f\'(x) = 10x + 4.\"},{\"id\":4,\"text\":\"Soal No. 4: Turunan pertama dari f(x) = 2x\\u00b2 + 3x + 7 adalah?\",\"options\":{\"A\":\"2x + 3\",\"B\":\"4x + 7\",\"C\":\"4x + 3\",\"D\":\"2x\\u00b2 + 3\"},\"correct\":\"C\",\"explanation\":\"Aturan turunan pangkat: d\\/dx(ax^n) = n\\u00b7ax^(n-1). Untuk 2x\\u00b2 \\u2192 2\\u00b72x = 4x. Untuk 3x \\u2192 3. Konstanta 7 hilang. Jadi f\'(x) = 4x + 3.\"},{\"id\":5,\"text\":\"Soal No. 5: Turunan pertama dari f(x) = 2x\\u00b2 + 7x + 6 adalah?\",\"options\":{\"A\":\"2x + 7\",\"B\":\"4x + 6\",\"C\":\"4x + 7\",\"D\":\"2x\\u00b2 + 7\"},\"correct\":\"C\",\"explanation\":\"Aturan turunan pangkat: d\\/dx(ax^n) = n\\u00b7ax^(n-1). Untuk 2x\\u00b2 \\u2192 2\\u00b72x = 4x. Untuk 7x \\u2192 7. Konstanta 6 hilang. Jadi f\'(x) = 4x + 7.\"},{\"id\":6,\"text\":\"Soal No. 6: Turunan pertama dari f(x) = 4x\\u00b2 + 2x + 6 adalah?\",\"options\":{\"A\":\"4x + 2\",\"B\":\"8x + 6\",\"C\":\"8x + 2\",\"D\":\"4x\\u00b2 + 2\"},\"correct\":\"C\",\"explanation\":\"Aturan turunan pangkat: d\\/dx(ax^n) = n\\u00b7ax^(n-1). Untuk 4x\\u00b2 \\u2192 2\\u00b74x = 8x. Untuk 2x \\u2192 2. Konstanta 6 hilang. Jadi f\'(x) = 8x + 2.\"},{\"id\":7,\"text\":\"Soal No. 7: Turunan pertama dari f(x) = 3x\\u00b2 + 9x + 6 adalah?\",\"options\":{\"A\":\"3x + 9\",\"B\":\"6x + 6\",\"C\":\"6x + 9\",\"D\":\"3x\\u00b2 + 9\"},\"correct\":\"C\",\"explanation\":\"Aturan turunan pangkat: d\\/dx(ax^n) = n\\u00b7ax^(n-1). Untuk 3x\\u00b2 \\u2192 2\\u00b73x = 6x. Untuk 9x \\u2192 9. Konstanta 6 hilang. Jadi f\'(x) = 6x + 9.\"},{\"id\":8,\"text\":\"Soal No. 8: Turunan pertama dari f(x) = 4x\\u00b2 + 9x + 0 adalah?\",\"options\":{\"A\":\"4x + 9\",\"B\":\"8x + 0\",\"C\":\"8x + 9\",\"D\":\"4x\\u00b2 + 9\"},\"correct\":\"C\",\"explanation\":\"Aturan turunan pangkat: d\\/dx(ax^n) = n\\u00b7ax^(n-1). Untuk 4x\\u00b2 \\u2192 2\\u00b74x = 8x. Untuk 9x \\u2192 9. Konstanta 0 hilang. Jadi f\'(x) = 8x + 9.\"},{\"id\":9,\"text\":\"Soal No. 9: Turunan pertama dari f(x) = 6x\\u00b2 + 6x + 3 adalah?\",\"options\":{\"A\":\"6x + 6\",\"B\":\"12x + 3\",\"C\":\"12x + 6\",\"D\":\"6x\\u00b2 + 6\"},\"correct\":\"C\",\"explanation\":\"Aturan turunan pangkat: d\\/dx(ax^n) = n\\u00b7ax^(n-1). Untuk 6x\\u00b2 \\u2192 2\\u00b76x = 12x. Untuk 6x \\u2192 6. Konstanta 3 hilang. Jadi f\'(x) = 12x + 6.\"},{\"id\":10,\"text\":\"Soal No. 10: Turunan pertama dari f(x) = 5x\\u00b2 + 3x + 5 adalah?\",\"options\":{\"A\":\"5x + 3\",\"B\":\"10x + 5\",\"C\":\"10x + 3\",\"D\":\"5x\\u00b2 + 3\"},\"correct\":\"C\",\"explanation\":\"Aturan turunan pangkat: d\\/dx(ax^n) = n\\u00b7ax^(n-1). Untuk 5x\\u00b2 \\u2192 2\\u00b75x = 10x. Untuk 3x \\u2192 3. Konstanta 5 hilang. Jadi f\'(x) = 10x + 3.\"}]', '{\"1\":\"A\",\"2\":\"A\",\"3\":\"A\",\"4\":\"A\",\"5\":\"A\",\"6\":\"A\",\"7\":\"A\",\"8\":\"A\",\"9\":\"A\",\"10\":\"A\"}', '2026-05-14 05:33:51', '2026-05-14 05:33:51'),
(3, 11, 'tryout', 'Ekonomi', 25, 6, 15, 15, '[{\"text\":\"Soal No. 1 [Penalaran Umum]: Perhatikan barisan angka: 3, 7, 11, 15, \\u2026 Berapakah angka selanjutnya?\",\"options\":{\"A\":\"14\",\"B\":\"20\",\"C\":\"19\",\"D\":\"15\"},\"correct\":\"C\",\"explanation\":\"Barisan aritmetika dengan beda d=4. Suku ke-5 = 3 + 4\\u00d74 = 19.\",\"id\":1},{\"text\":\"Soal No. 2 [Penalaran Umum]: Perhatikan barisan angka: 6, 16, 26, 36, \\u2026 Berapakah angka selanjutnya?\",\"options\":{\"A\":\"41\",\"B\":\"47\",\"C\":\"46\",\"D\":\"50\"},\"correct\":\"C\",\"explanation\":\"Barisan aritmetika dengan beda d=10. Suku ke-5 = 6 + 4\\u00d710 = 46.\",\"id\":2},{\"text\":\"Soal No. 3 [Penalaran Umum]: Perhatikan barisan angka: 14, 24, 34, 44, \\u2026 Berapakah angka selanjutnya?\",\"options\":{\"A\":\"61\",\"B\":\"62\",\"C\":\"54\",\"D\":\"52\"},\"correct\":\"C\",\"explanation\":\"Barisan aritmetika dengan beda d=10. Suku ke-5 = 14 + 4\\u00d710 = 54.\",\"id\":3},{\"text\":\"Soal No. 4 [Penalaran Umum]: Perhatikan barisan angka: 10, 18, 26, 34, \\u2026 Berapakah angka selanjutnya?\",\"options\":{\"A\":\"48\",\"B\":\"46\",\"C\":\"42\",\"D\":\"37\"},\"correct\":\"C\",\"explanation\":\"Barisan aritmetika dengan beda d=8. Suku ke-5 = 10 + 4\\u00d78 = 42.\",\"id\":4},{\"text\":\"Soal No. 5 [Penalaran Umum]: Semua mamalia berdarah panas. Semua paus adalah mamalia. Kesimpulan yang tepat adalah \\u2026\",\"options\":{\"A\":\"Semua paus hidup di laut\",\"B\":\"Semua paus berdarah panas\",\"C\":\"Sebagian mamalia adalah paus\",\"D\":\"Semua berdarah panas adalah paus\"},\"correct\":\"B\",\"explanation\":\"Silogisme: P1: Semua mamalia berdarah panas. P2: Paus adalah mamalia. Kesimpulan: Paus berdarah panas.\",\"id\":5},{\"text\":\"Soal No. 6 [Penalaran Umum]: Semua dokter adalah sarjana. Rina bukan sarjana. Kesimpulan yang tepat adalah \\u2026\",\"options\":{\"A\":\"Rina mungkin dokter\",\"B\":\"Rina bukan dokter\",\"C\":\"Dokter tidak harus sarjana\",\"D\":\"Sarjana pasti dokter\"},\"correct\":\"B\",\"explanation\":\"Modus Tollens: Semua dokter adalah sarjana. Rina bukan sarjana \\u2192 Rina bukan dokter.\",\"id\":6},{\"text\":\"Soal No. 7 [Literasi Bahasa Indonesia]: Bacaan: \\\"Polusi udara di kota besar terus meningkat akibat emisi kendaraan bermotor. Pemerintah perlu mengambil langkah tegas seperti membatasi penggunaan kendaraan pribadi.\\\" Gagasan utama paragraf tersebut adalah \\u2026\",\"options\":{\"A\":\"Kendaraan bermotor satu-satunya penyebab polusi\",\"B\":\"Polusi udara meningkat dan butuh tindakan pemerintah\",\"C\":\"Pembatasan kendaraan sudah dilakukan\",\"D\":\"Polusi hanya ada di kota besar\"},\"correct\":\"B\",\"explanation\":\"Gagasan utama mencakup masalah (polusi meningkat) dan solusi (pemerintah perlu bertindak).\",\"id\":7},{\"text\":\"Soal No. 8 [Literasi Bahasa Indonesia]: \\\"Membaca adalah jendela dunia.\\\" Makna ungkapan tersebut adalah \\u2026\",\"options\":{\"A\":\"Membaca harus di dekat jendela\",\"B\":\"Dunia terbuat dari buku\",\"C\":\"Membaca membuka wawasan tentang dunia\",\"D\":\"Jendela lebih baik dari buku\"},\"correct\":\"C\",\"explanation\":\"Ungkapan ini bermakna membaca memberikan pengetahuan luas tentang dunia.\",\"id\":8},{\"text\":\"Soal No. 9 [Literasi Bahasa Indonesia]: Kata \\\"konkret\\\" dalam kalimat \\\"Diperlukan langkah konkret untuk mengatasi kemiskinan\\\" bermakna \\u2026\",\"options\":{\"A\":\"Abstrak dan tidak jelas\",\"B\":\"Nyata dan dapat dilaksanakan\",\"C\":\"Teoritis dan akademis\",\"D\":\"Simbolis dan representatif\"},\"correct\":\"B\",\"explanation\":\"\'Konkret\' berarti nyata, berwujud, dan bisa dilaksanakan secara langsung.\",\"id\":9},{\"text\":\"Soal No. 10 [Pengetahuan Kuantitatif]: Harga 8 buku adalah Rp 24.000. Harga 3 buku yang sama adalah \\u2026\",\"options\":{\"A\":\"Rp 30.000\",\"B\":\"Rp 11.000\",\"C\":\"Rp 24.000\",\"D\":\"Rp 27.000\"},\"correct\":\"C\",\"explanation\":\"Harga 1 buku = Rp 24.000 \\u00f7 8 = Rp 3.000. Harga 3 buku = 3 \\u00d7 Rp 3.000 = Rp 24.000.\",\"id\":10},{\"text\":\"Soal No. 11 [Pengetahuan Kuantitatif]: Harga 6 buku adalah Rp 18.000. Harga 3 buku yang sama adalah \\u2026\",\"options\":{\"A\":\"Rp 10.000\",\"B\":\"Rp 9.000\",\"C\":\"Rp 18.000\",\"D\":\"Rp 21.000\"},\"correct\":\"C\",\"explanation\":\"Harga 1 buku = Rp 18.000 \\u00f7 6 = Rp 3.000. Harga 3 buku = 3 \\u00d7 Rp 3.000 = Rp 18.000.\",\"id\":11},{\"text\":\"Soal No. 12 [Pengetahuan Kuantitatif]: Harga 2 buku adalah Rp 4.000. Harga 2 buku yang sama adalah \\u2026\",\"options\":{\"A\":\"Rp -3.000\",\"B\":\"Rp 4.000\",\"C\":\"Rp 4.000\",\"D\":\"Rp 6.000\"},\"correct\":\"C\",\"explanation\":\"Harga 1 buku = Rp 4.000 \\u00f7 2 = Rp 2.000. Harga 2 buku = 2 \\u00d7 Rp 2.000 = Rp 4.000.\",\"id\":12},{\"text\":\"Soal No. 13 [Literasi Bahasa Inggris]: Read: \\\"Despite the heavy rain, the students continued their outdoor activities.\\\" The word \'despite\' is closest in meaning to \\u2026\",\"options\":{\"A\":\"Because of\",\"B\":\"In spite of\",\"C\":\"As a result of\",\"D\":\"Due to\"},\"correct\":\"B\",\"explanation\":\"\'Despite\' = \'in spite of\' \\u2014 both express contrast\\/concession.\",\"id\":13},{\"text\":\"Soal No. 14 [Literasi Bahasa Inggris]: Choose the sentence with correct grammar: \\u2026\",\"options\":{\"A\":\"She don\'t like coffee\",\"B\":\"He doesn\'t likes coffee\",\"C\":\"They doesn\'t like coffee\",\"D\":\"She doesn\'t like coffee\"},\"correct\":\"D\",\"explanation\":\"Subject \'she\' (3rd person singular) uses \'doesn\'t\' + bare infinitive: \'doesn\'t like\'.\",\"id\":14},{\"text\":\"Soal No. 15 [Literasi Bahasa Inggris]: The word \'beneficial\' in the sentence \\\"Regular exercise is beneficial to health\\\" means \\u2026\",\"options\":{\"A\":\"Harmful\",\"B\":\"Irrelevant\",\"C\":\"Advantageous\",\"D\":\"Compulsory\"},\"correct\":\"C\",\"explanation\":\"\'Beneficial\' means advantageous \\/ helpful \\/ giving benefit.\",\"id\":15}]', '{\"1\":\"B\",\"2\":\"C\",\"3\":\"C\",\"4\":\"B\",\"5\":\"B\",\"6\":\"B\",\"7\":\"A\",\"8\":\"C\",\"9\":\"C\",\"10\":\"D\",\"11\":\"A\",\"12\":\"B\",\"13\":\"B\",\"14\":\"C\",\"15\":\"D\"}', '2026-05-19 13:52:08', '2026-05-19 13:52:08'),
(4, 11, 'tryout', 'Matematika Peminatan', 0, 0, 15, 0, '[{\"id\":1,\"text\":\"Soal No. 1 [Penalaran Umum]: Perhatikan barisan angka: 3, 12, 21, 30, \\u2026 Berapakah angka selanjutnya?\",\"options\":{\"A\":\"32\",\"B\":\"42\",\"C\":\"39\",\"D\":\"36\"},\"correct\":\"C\",\"explanation\":\"Barisan aritmetika dengan beda d=9. Suku ke-5 = 3 + 4\\u00d79 = 39.\"},{\"id\":2,\"text\":\"Soal No. 2 [Penalaran Umum]: Perhatikan barisan angka: 2, 5, 8, 11, \\u2026 Berapakah angka selanjutnya?\",\"options\":{\"A\":\"13\",\"B\":\"15\",\"C\":\"14\",\"D\":\"20\"},\"correct\":\"C\",\"explanation\":\"Barisan aritmetika dengan beda d=3. Suku ke-5 = 2 + 4\\u00d73 = 14.\"},{\"id\":3,\"text\":\"Soal No. 3 [Penalaran Umum]: Perhatikan barisan angka: 8, 10, 12, 14, \\u2026 Berapakah angka selanjutnya?\",\"options\":{\"A\":\"15\",\"B\":\"9\",\"C\":\"16\",\"D\":\"13\"},\"correct\":\"C\",\"explanation\":\"Barisan aritmetika dengan beda d=2. Suku ke-5 = 8 + 4\\u00d72 = 16.\"},{\"id\":4,\"text\":\"Soal No. 4 [Penalaran Umum]: Perhatikan barisan angka: 5, 12, 19, 26, \\u2026 Berapakah angka selanjutnya?\",\"options\":{\"A\":\"29\",\"B\":\"31\",\"C\":\"33\",\"D\":\"37\"},\"correct\":\"C\",\"explanation\":\"Barisan aritmetika dengan beda d=7. Suku ke-5 = 5 + 4\\u00d77 = 33.\"},{\"id\":5,\"text\":\"Soal No. 5 [Penalaran Umum]: Semua mamalia berdarah panas. Semua paus adalah mamalia. Kesimpulan yang tepat adalah \\u2026\",\"options\":{\"A\":\"Semua paus hidup di laut\",\"B\":\"Semua paus berdarah panas\",\"C\":\"Sebagian mamalia adalah paus\",\"D\":\"Semua berdarah panas adalah paus\"},\"correct\":\"B\",\"explanation\":\"Silogisme: P1: Semua mamalia berdarah panas. P2: Paus adalah mamalia. Kesimpulan: Paus berdarah panas.\"},{\"id\":6,\"text\":\"Soal No. 6 [Penalaran Umum]: Jika seseorang rajin belajar, maka ia akan sukses. Budi rajin belajar. Kesimpulan yang tepat adalah \\u2026\",\"options\":{\"A\":\"Budi mungkin sukses\",\"B\":\"Budi pasti gagal\",\"C\":\"Budi pasti sukses\",\"D\":\"Sukses tidak bergantung belajar\"},\"correct\":\"C\",\"explanation\":\"Modus Ponens: P\\u2192Q, P \\u22a2 Q. Budi rajin belajar (P), maka Budi sukses (Q).\"},{\"id\":7,\"text\":\"Soal No. 7 [Penalaran Umum]: Semua dokter adalah sarjana. Rina bukan sarjana. Kesimpulan yang tepat adalah \\u2026\",\"options\":{\"A\":\"Rina mungkin dokter\",\"B\":\"Rina bukan dokter\",\"C\":\"Dokter tidak harus sarjana\",\"D\":\"Sarjana pasti dokter\"},\"correct\":\"B\",\"explanation\":\"Modus Tollens: Semua dokter adalah sarjana. Rina bukan sarjana \\u2192 Rina bukan dokter.\"},{\"id\":8,\"text\":\"Soal No. 8 [Literasi Bahasa Indonesia]: Bacaan: \\\"Polusi udara di kota besar terus meningkat akibat emisi kendaraan bermotor. Pemerintah perlu mengambil langkah tegas seperti membatasi penggunaan kendaraan pribadi.\\\" Gagasan utama paragraf tersebut adalah \\u2026\",\"options\":{\"A\":\"Kendaraan bermotor satu-satunya penyebab polusi\",\"B\":\"Polusi udara meningkat dan butuh tindakan pemerintah\",\"C\":\"Pembatasan kendaraan sudah dilakukan\",\"D\":\"Polusi hanya ada di kota besar\"},\"correct\":\"B\",\"explanation\":\"Gagasan utama mencakup masalah (polusi meningkat) dan solusi (pemerintah perlu bertindak).\"},{\"id\":9,\"text\":\"Soal No. 9 [Literasi Bahasa Indonesia]: \\\"Membaca adalah jendela dunia.\\\" Makna ungkapan tersebut adalah \\u2026\",\"options\":{\"A\":\"Membaca harus di dekat jendela\",\"B\":\"Dunia terbuat dari buku\",\"C\":\"Membaca membuka wawasan tentang dunia\",\"D\":\"Jendela lebih baik dari buku\"},\"correct\":\"C\",\"explanation\":\"Ungkapan ini bermakna membaca memberikan pengetahuan luas tentang dunia.\"},{\"id\":10,\"text\":\"Soal No. 10 [Literasi Bahasa Indonesia]: Kata \\\"konkret\\\" dalam kalimat \\\"Diperlukan langkah konkret untuk mengatasi kemiskinan\\\" bermakna \\u2026\",\"options\":{\"A\":\"Abstrak dan tidak jelas\",\"B\":\"Nyata dan dapat dilaksanakan\",\"C\":\"Teoritis dan akademis\",\"D\":\"Simbolis dan representatif\"},\"correct\":\"B\",\"explanation\":\"\'Konkret\' berarti nyata, berwujud, dan bisa dilaksanakan secara langsung.\"},{\"id\":11,\"text\":\"Soal No. 11 [Pengetahuan Kuantitatif]: Harga 8 buku adalah Rp 16.000. Harga 2 buku yang sama adalah \\u2026\",\"options\":{\"A\":\"Rp 17.000\",\"B\":\"Rp 10.000\",\"C\":\"Rp 16.000\",\"D\":\"Rp 18.000\"},\"correct\":\"C\",\"explanation\":\"Harga 1 buku = Rp 16.000 \\u00f7 8 = Rp 2.000. Harga 2 buku = 2 \\u00d7 Rp 2.000 = Rp 16.000.\"},{\"id\":12,\"text\":\"Soal No. 12 [Pengetahuan Kuantitatif]: Harga 8 buku adalah Rp 24.000. Harga 3 buku yang sama adalah \\u2026\",\"options\":{\"A\":\"Rp 16.000\",\"B\":\"Rp 11.000\",\"C\":\"Rp 24.000\",\"D\":\"Rp 27.000\"},\"correct\":\"C\",\"explanation\":\"Harga 1 buku = Rp 24.000 \\u00f7 8 = Rp 3.000. Harga 3 buku = 3 \\u00d7 Rp 3.000 = Rp 24.000.\"},{\"id\":13,\"text\":\"Soal No. 13 [Pengetahuan Kuantitatif]: Harga 6 buku adalah Rp 30.000. Harga 5 buku yang sama adalah \\u2026\",\"options\":{\"A\":\"Rp 34.000\",\"B\":\"Rp 11.000\",\"C\":\"Rp 30.000\",\"D\":\"Rp 35.000\"},\"correct\":\"C\",\"explanation\":\"Harga 1 buku = Rp 30.000 \\u00f7 6 = Rp 5.000. Harga 5 buku = 5 \\u00d7 Rp 5.000 = Rp 30.000.\"},{\"id\":14,\"text\":\"Soal No. 14 [Literasi Bahasa Inggris]: Choose the sentence with correct grammar: \\u2026\",\"options\":{\"A\":\"She don\'t like coffee\",\"B\":\"He doesn\'t likes coffee\",\"C\":\"They doesn\'t like coffee\",\"D\":\"She doesn\'t like coffee\"},\"correct\":\"D\",\"explanation\":\"Subject \'she\' (3rd person singular) uses \'doesn\'t\' + bare infinitive: \'doesn\'t like\'.\"},{\"id\":15,\"text\":\"Soal No. 15 [Literasi Bahasa Inggris]: The word \'beneficial\' in the sentence \\\"Regular exercise is beneficial to health\\\" means \\u2026\",\"options\":{\"A\":\"Harmful\",\"B\":\"Irrelevant\",\"C\":\"Advantageous\",\"D\":\"Compulsory\"},\"correct\":\"C\",\"explanation\":\"\'Beneficial\' means advantageous \\/ helpful \\/ giving benefit.\"}]', '{\"1\":\"A\",\"2\":\"A\",\"3\":\"A\",\"4\":\"A\",\"5\":\"A\",\"6\":\"A\",\"7\":\"A\",\"8\":\"A\",\"9\":\"A\",\"10\":\"A\",\"11\":\"A\",\"12\":\"A\",\"13\":\"A\",\"14\":\"A\",\"15\":\"A\"}', '2026-06-18 13:38:12', '2026-06-18 13:38:12'),
(5, 11, 'tryout', 'Matematika Peminatan', 75, 12, 15, 45, '[{\"id\":1,\"text\":\"Soal No. 1 [Penalaran Umum]: Perhatikan barisan angka: 14, 17, 20, 23, \\u2026 Berapakah angka selanjutnya?\",\"options\":{\"A\":\"32\",\"B\":\"27\",\"C\":\"26\",\"D\":\"31\"},\"correct\":\"C\",\"explanation\":\"Barisan aritmetika dengan beda d=3. Suku ke-5 = 14 + 4\\u00d73 = 26.\"},{\"id\":2,\"text\":\"Soal No. 2 [Penalaran Umum]: Perhatikan barisan angka: 3, 9, 15, 21, \\u2026 Berapakah angka selanjutnya?\",\"options\":{\"A\":\"22\",\"B\":\"23\",\"C\":\"27\",\"D\":\"26\"},\"correct\":\"C\",\"explanation\":\"Barisan aritmetika dengan beda d=6. Suku ke-5 = 3 + 4\\u00d76 = 27.\"},{\"id\":3,\"text\":\"Soal No. 3 [Penalaran Umum]: Perhatikan barisan angka: 13, 18, 23, 28, \\u2026 Berapakah angka selanjutnya?\",\"options\":{\"A\":\"25\",\"B\":\"31\",\"C\":\"33\",\"D\":\"36\"},\"correct\":\"C\",\"explanation\":\"Barisan aritmetika dengan beda d=5. Suku ke-5 = 13 + 4\\u00d75 = 33.\"},{\"id\":4,\"text\":\"Soal No. 4 [Penalaran Umum]: Perhatikan barisan angka: 14, 24, 34, 44, \\u2026 Berapakah angka selanjutnya?\",\"options\":{\"A\":\"59\",\"B\":\"50\",\"C\":\"54\",\"D\":\"62\"},\"correct\":\"C\",\"explanation\":\"Barisan aritmetika dengan beda d=10. Suku ke-5 = 14 + 4\\u00d710 = 54.\"},{\"id\":5,\"text\":\"Soal No. 5 [Penalaran Umum]: Perhatikan barisan angka: 7, 11, 15, 19, \\u2026 Berapakah angka selanjutnya?\",\"options\":{\"A\":\"29\",\"B\":\"15\",\"C\":\"23\",\"D\":\"25\"},\"correct\":\"C\",\"explanation\":\"Barisan aritmetika dengan beda d=4. Suku ke-5 = 7 + 4\\u00d74 = 23.\"},{\"id\":6,\"text\":\"Soal No. 6 [Penalaran Umum]: Perhatikan barisan angka: 7, 14, 21, 28, \\u2026 Berapakah angka selanjutnya?\",\"options\":{\"A\":\"28\",\"B\":\"34\",\"C\":\"35\",\"D\":\"37\"},\"correct\":\"C\",\"explanation\":\"Barisan aritmetika dengan beda d=7. Suku ke-5 = 7 + 4\\u00d77 = 35.\"},{\"id\":7,\"text\":\"Soal No. 7 [Literasi Bahasa Indonesia]: Bacaan: \\\"Polusi udara di kota besar terus meningkat akibat emisi kendaraan bermotor. Pemerintah perlu mengambil langkah tegas seperti membatasi penggunaan kendaraan pribadi.\\\" Gagasan utama paragraf tersebut adalah \\u2026\",\"options\":{\"A\":\"Kendaraan bermotor satu-satunya penyebab polusi\",\"B\":\"Polusi udara meningkat dan butuh tindakan pemerintah\",\"C\":\"Pembatasan kendaraan sudah dilakukan\",\"D\":\"Polusi hanya ada di kota besar\"},\"correct\":\"B\",\"explanation\":\"Gagasan utama mencakup masalah (polusi meningkat) dan solusi (pemerintah perlu bertindak).\"},{\"id\":8,\"text\":\"Soal No. 8 [Literasi Bahasa Indonesia]: \\\"Membaca adalah jendela dunia.\\\" Makna ungkapan tersebut adalah \\u2026\",\"options\":{\"A\":\"Membaca harus di dekat jendela\",\"B\":\"Dunia terbuat dari buku\",\"C\":\"Membaca membuka wawasan tentang dunia\",\"D\":\"Jendela lebih baik dari buku\"},\"correct\":\"C\",\"explanation\":\"Ungkapan ini bermakna membaca memberikan pengetahuan luas tentang dunia.\"},{\"id\":9,\"text\":\"Soal No. 9 [Literasi Bahasa Indonesia]: Kata \\\"konkret\\\" dalam kalimat \\\"Diperlukan langkah konkret untuk mengatasi kemiskinan\\\" bermakna \\u2026\",\"options\":{\"A\":\"Abstrak dan tidak jelas\",\"B\":\"Nyata dan dapat dilaksanakan\",\"C\":\"Teoritis dan akademis\",\"D\":\"Simbolis dan representatif\"},\"correct\":\"B\",\"explanation\":\"\'Konkret\' berarti nyata, berwujud, dan bisa dilaksanakan secara langsung.\"},{\"id\":10,\"text\":\"Soal No. 10 [Pengetahuan Kuantitatif]: Harga 2 buku adalah Rp 6.000. Harga 3 buku yang sama adalah \\u2026\",\"options\":{\"A\":\"Rp 11.000\",\"B\":\"Rp 5.000\",\"C\":\"Rp 6.000\",\"D\":\"Rp 9.000\"},\"correct\":\"C\",\"explanation\":\"Harga 1 buku = Rp 6.000 \\u00f7 2 = Rp 3.000. Harga 3 buku = 3 \\u00d7 Rp 3.000 = Rp 6.000.\"},{\"id\":11,\"text\":\"Soal No. 11 [Pengetahuan Kuantitatif]: Harga 2 buku adalah Rp 6.000. Harga 3 buku yang sama adalah \\u2026\",\"options\":{\"A\":\"Rp 5.000\",\"B\":\"Rp 5.000\",\"C\":\"Rp 6.000\",\"D\":\"Rp 9.000\"},\"correct\":\"C\",\"explanation\":\"Harga 1 buku = Rp 6.000 \\u00f7 2 = Rp 3.000. Harga 3 buku = 3 \\u00d7 Rp 3.000 = Rp 6.000.\"},{\"id\":12,\"text\":\"Soal No. 12 [Pengetahuan Kuantitatif]: Harga 8 buku adalah Rp 16.000. Harga 2 buku yang sama adalah \\u2026\",\"options\":{\"A\":\"Rp 17.000\",\"B\":\"Rp 10.000\",\"C\":\"Rp 16.000\",\"D\":\"Rp 18.000\"},\"correct\":\"C\",\"explanation\":\"Harga 1 buku = Rp 16.000 \\u00f7 8 = Rp 2.000. Harga 2 buku = 2 \\u00d7 Rp 2.000 = Rp 16.000.\"},{\"id\":13,\"text\":\"Soal No. 13 [Pengetahuan Kuantitatif]: Harga 6 buku adalah Rp 30.000. Harga 5 buku yang sama adalah \\u2026\",\"options\":{\"A\":\"Rp 22.000\",\"B\":\"Rp 11.000\",\"C\":\"Rp 30.000\",\"D\":\"Rp 35.000\"},\"correct\":\"C\",\"explanation\":\"Harga 1 buku = Rp 30.000 \\u00f7 6 = Rp 5.000. Harga 5 buku = 5 \\u00d7 Rp 5.000 = Rp 30.000.\"},{\"id\":14,\"text\":\"Soal No. 14 [Literasi Bahasa Inggris]: Read: \\\"Despite the heavy rain, the students continued their outdoor activities.\\\" The word \'despite\' is closest in meaning to \\u2026\",\"options\":{\"A\":\"Because of\",\"B\":\"In spite of\",\"C\":\"As a result of\",\"D\":\"Due to\"},\"correct\":\"B\",\"explanation\":\"\'Despite\' = \'in spite of\' \\u2014 both express contrast\\/concession.\"},{\"id\":15,\"text\":\"Soal No. 15 [Literasi Bahasa Inggris]: The word \'beneficial\' in the sentence \\\"Regular exercise is beneficial to health\\\" means \\u2026\",\"options\":{\"A\":\"Harmful\",\"B\":\"Irrelevant\",\"C\":\"Advantageous\",\"D\":\"Compulsory\"},\"correct\":\"C\",\"explanation\":\"\'Beneficial\' means advantageous \\/ helpful \\/ giving benefit.\"}]', '{\"1\":\"C\",\"2\":\"C\",\"3\":\"C\",\"4\":\"C\",\"5\":\"C\",\"6\":\"C\",\"7\":\"C\",\"8\":\"C\",\"9\":\"C\",\"10\":\"C\",\"11\":\"C\",\"12\":\"C\",\"13\":\"C\",\"14\":\"C\",\"15\":\"C\"}', '2026-06-18 13:42:11', '2026-06-18 13:42:11');

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
-- Table structure for table `jadwal_mengajar`
--

CREATE TABLE `jadwal_mengajar` (
  `id_jadwal` bigint(20) UNSIGNED NOT NULL,
  `hari` enum('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu') NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `mapel` varchar(255) NOT NULL,
  `kelas` varchar(255) NOT NULL,
  `id_guru` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jenjang`
--

CREATE TABLE `jenjang` (
  `id_jenjang` int(11) NOT NULL,
  `nama_jenjang` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `jenjang`
--

INSERT INTO `jenjang` (`id_jenjang`, `nama_jenjang`) VALUES
(1, 'SD'),
(2, 'SMP'),
(3, 'SMA');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` smallint(5) UNSIGNED NOT NULL,
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
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id_major` int(11) NOT NULL,
  `id_university` int(11) DEFAULT NULL,
  `nama_jurusan` varchar(100) DEFAULT NULL,
  `target_nilai` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id_major`, `id_university`, `nama_jurusan`, `target_nilai`) VALUES
(1, 1, 'Kedokteran', 748),
(2, 1, 'Ilmu Komputer', 730),
(3, 1, 'Ilmu Hukum', 715),
(4, 1, 'Psikologi', 710),
(5, 1, 'Ilmu Komunikasi', 705),
(6, 1, 'Sastra Inggris', 680),
(7, 2, 'STEI - Komputasi', 740),
(8, 2, 'FTMD - Kedirgantaraan', 725),
(9, 2, 'SITH - Sains', 690),
(10, 2, 'FITB', 700),
(11, 2, 'FTI - Kampus Jatinangor', 710),
(12, 2, 'FSRD', 695),
(13, 3, 'Kedokteran', 742),
(14, 3, 'Teknologi Informasi', 725),
(15, 3, 'Akuntansi', 718),
(16, 3, 'Manajemen', 712),
(17, 3, 'Farmasi', 705),
(18, 3, 'Teknik Sipil', 698),
(19, 4, 'Kedokteran', 735),
(20, 4, 'Kedokteran Gigi', 715),
(21, 4, 'Kesehatan Masyarakat', 685),
(22, 4, 'Hubungan Internasional', 700),
(23, 4, 'Ilmu Politik', 670),
(24, 5, 'Teknik Informatika', 728),
(25, 5, 'Sistem Informasi', 715),
(26, 5, 'Teknik Elektro', 705),
(27, 5, 'Teknik Mesin', 695),
(28, 5, 'Teknik Perkapalan', 675),
(29, 5, 'Arsitektur', 710),
(30, 6, 'Pendidikan Dokter', 730),
(31, 6, 'Ilmu Komunikasi', 710),
(32, 6, 'Hubungan Internasional', 705),
(33, 6, 'Farmasi', 695),
(34, 6, 'Teknik Geologi', 680);

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

CREATE TABLE `materi` (
  `id_materi` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `link_video` varchar(255) DEFAULT NULL,
  `jenjang` enum('SD','SMP','SMA') NOT NULL,
  `mapel` varchar(255) DEFAULT NULL,
  `kelas` varchar(255) DEFAULT NULL,
  `jurusan` varchar(255) DEFAULT NULL,
  `file_materi` varchar(255) DEFAULT NULL,
  `id_guru` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `materi`
--

INSERT INTO `materi` (`id_materi`, `judul`, `deskripsi`, `link_video`, `jenjang`, `mapel`, `kelas`, `jurusan`, `file_materi`, `id_guru`, `created_at`, `updated_at`) VALUES
(1, 'Matematika - Persamaan Kuadrat', 'Video Matematika', 'https://www.youtube.com/embed/AIS6lYgI1As', 'SMA', NULL, NULL, NULL, NULL, 6, '2026-05-26 09:08:41', '2026-05-26 09:08:41'),
(2, 'Matematika Wajib - Trigonometri', 'Video Matematika Wajib', 'https://www.youtube.com/embed/LS949g6wkKQ', 'SMA', NULL, NULL, NULL, NULL, 6, '2026-05-26 09:08:41', '2026-05-26 09:08:41'),
(3, 'Fisika - Besaran dan Satuan', 'Video Fisika', 'https://www.youtube.com/embed/4J95ZYD387o', 'SMA', NULL, NULL, NULL, NULL, 7, '2026-05-26 09:08:41', '2026-05-26 09:08:41'),
(4, 'Fisika - Hukum Newton', 'Video Fisika Hukum Newton', 'https://www.youtube.com/embed/QV45_JDRZ_c', 'SMA', NULL, NULL, NULL, NULL, 7, '2026-05-26 09:08:41', '2026-05-26 09:08:41'),
(5, 'Kimia - Struktur Atom', 'Video Kimia', 'https://www.youtube.com/embed/3nsOlPrpdsA', 'SMA', NULL, NULL, NULL, NULL, 8, '2026-05-26 09:08:41', '2026-05-26 09:08:41'),
(6, 'Kimia - Ikatan Kimia', 'Video Kimia Ikatan', 'https://www.youtube.com/embed/oD0tDw7B0eU', 'SMA', NULL, NULL, NULL, NULL, 8, '2026-05-26 09:08:41', '2026-05-26 09:08:41'),
(7, 'Biologi - Sel dan Strukturnya', 'Video Biologi', 'https://www.youtube.com/embed/6_GpcjuFTfE', 'SMA', NULL, NULL, NULL, NULL, 9, '2026-05-26 09:08:41', '2026-05-26 09:08:41'),
(8, 'Biologi - Genetika', 'Video Biologi Genetika', 'https://www.youtube.com/embed/-1iU8EKV6iY', 'SMA', NULL, NULL, NULL, NULL, 9, '2026-05-26 09:08:41', '2026-05-26 09:08:41'),
(9, 'Sejarah - Proklamasi Kemerdekaan', 'Video Sejarah', 'https://www.youtube.com/embed/nM4mitSBQKk', 'SMA', NULL, NULL, NULL, NULL, 10, '2026-05-26 09:08:41', '2026-05-26 09:08:41'),
(11, 'Bahasa Inggris - Tenses', 'Video Bahasa Inggris', 'https://www.youtube.com/embed/B2IldXHBDA0', 'SMA', NULL, NULL, NULL, NULL, 7, '2026-05-26 09:08:41', '2026-05-26 09:08:41'),
(12, 'Ekonomi - Kebijakan Moneter', 'Video Ekonomi', 'https://www.youtube.com/embed/kPW_fq-mCt4', 'SMA', NULL, NULL, NULL, NULL, 8, '2026-05-26 09:08:41', '2026-05-26 09:08:41'),
(13, 'Ekonomi - Pendapatan Nasional', 'Video Ekonomi', 'https://www.youtube.com/embed/q34Ml8no9gc', 'SMA', NULL, NULL, NULL, NULL, 8, '2026-05-26 09:08:41', '2026-05-26 09:08:41'),
(14, 'Pengantar Persamaan Linear Dua Variabel', 'Materi ini mencakup penjelasan dasar mengenai sistem persamaan linear dua variabel (SPLDV), cara penyelesaiannya dengan metode substitusi dan eliminasi, beserta contoh soal lengkap. Silakan pelajari modul ini sebagai persiapan menjelang Ujian Tengah Semester.', 'https://www.youtube.com/watch?v=Qc2mRvVubIA', 'SMA', 'Matematika Wajib', '10', 'ipa', NULL, 6, '2026-06-18 13:54:13', '2026-06-18 14:10:28');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id_message` bigint(20) UNSIGNED NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id_message`, `sender_id`, `receiver_id`, `message`, `is_read`, `created_at`, `updated_at`) VALUES
(1, 11, 6, 'selamat malam pak', 1, '2026-06-18 13:34:04', '2026-06-18 13:43:38'),
(2, 6, 11, 'malam', 0, '2026-06-18 13:43:42', '2026-06-18 13:43:42');

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
(4, '2026_05_08_034308_update_empty_id_jenjang_in_user_table', 2),
(5, '2026_05_08_035857_fix_id_jenjang_for_non_siswa_users', 3),
(6, '2026_05_08_043359_add_photo_profile_to_user_table', 4),
(7, '2026_05_09_081449_create_materis_table', 5),
(8, '2026_05_14_120000_create_exam_histories_table', 5),
(9, '2026_05_14_130000_fix_exam_histories_fk', 6),
(10, '2026_05_14_140000_create_exam_scores_table', 7),
(11, '2026_05_14_150000_fix_exam_scores_schema', 7),
(12, '2026_05_14_124141_create_activities_table', 8),
(13, '2026_05_14_195634_create_catatans_table', 9),
(14, '2026_05_19_194734_add_utbk_raw_score_to_exam_scores_table', 10),
(15, '2026_05_21_195251_add_id_paket_to_transaksi_table', 11),
(16, '2026_05_26_163643_create_catatan_table', 12),
(17, '2026_05_26_174929_create_ortu_siswa_table', 13),
(18, '2026_05_23_000001_add_fields_to_materi_table', 14),
(19, '2026_05_23_000002_create_tugas_table', 14),
(20, '2026_05_23_000003_create_jadwal_mengajar_table', 14),
(21, '2026_06_05_100000_create_messages_table', 14),
(22, '2026_06_05_205227_add_deleted_at_to_user_table', 14),
(23, '2026_06_05_213715_add_reactivation_requested_to_user_table', 15),
(24, '2026_06_18_210458_add_jurusan_to_materi_table', 16);

-- --------------------------------------------------------

--
-- Table structure for table `ortu_siswa`
--

CREATE TABLE `ortu_siswa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_orangtua` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ortu_siswa`
--

INSERT INTO `ortu_siswa` (`id`, `id_orangtua`, `id_siswa`, `created_at`, `updated_at`) VALUES
(1, 16, 11, '2026-05-26 10:52:02', '2026-05-26 10:52:02'),
(2, 16, 12, '2026-05-26 10:52:02', '2026-05-26 10:52:02');

-- --------------------------------------------------------

--
-- Table structure for table `paket_pembelajaran`
--

CREATE TABLE `paket_pembelajaran` (
  `id_paket` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `jenjang` enum('SD','SMP','SMA','Umum') DEFAULT NULL,
  `harga` decimal(10,2) DEFAULT NULL,
  `masa_aktif` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paket_pembelajaran`
--

INSERT INTO `paket_pembelajaran` (`id_paket`, `nama`, `jenjang`, `harga`, `masa_aktif`) VALUES
(1, 'Sukses UN Matematika SD', 'SD', 150000.00, 30),
(2, 'Master English Grammar', 'SMP', 250000.00, 60),
(3, 'Intensif Fisika Kuantum', 'SMA', 450000.00, 90),
(4, 'Persiapan UTBK SBMPTN', 'SMA', 600000.00, 180),
(5, 'Siap Kejar PTN', 'SMA', 450000.00, 90);

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
('b4Wzdr4gyujEdag5JC18a4ofKpgUOeyoMcpjqKrt', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJtVDhUMFhrcUpWZlFXUEhQaFBWQmJ1UmRmWHRMTWhxME5nUXllS2dZIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvbG9jYWxob3N0OjgwMDAiLCJyb3V0ZSI6bnVsbH19', 1781792183),
('Dig3zqDm6nXvQKT5uU4ojIpKgkQqZ8384XHNp6im', NULL, '127.0.0.1', 'curl/8.19.0', 'eyJfdG9rZW4iOiJQbFhoVGJVM3Q0S2wzMk5XaU1yc0FqcmZVRE1zUTV0REFZQlBzMmpaIiwidXJsIjp7ImludGVuZGVkIjoiaHR0cDpcL1wvbG9jYWxob3N0OjgwMDBcL3Npc3dhXC9wYWtldC1iZWxhamFyIn0sIl9wcmV2aW91cyI6eyJ1cmwiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvc2lzd2FcL3Bha2V0LWJlbGFqYXIiLCJyb3V0ZSI6InNpc3dhLnBha2V0LWJlbGFqYXIifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1781788461),
('sIxx2H7An8GdNT72hvRn1BZJhqRfQZAgYqyUoe4y', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJMV0RoQnNOVWZEcnptUUdINm9yU0RnYW9JWHFFamZmdmJEZHlQaU9SIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvbG9jYWxob3N0OjgwMDBcL2FkbWluXC9wZW5nZ3VuYSIsInJvdXRlIjoiYWRtaW4udXNlcnMifSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjF9', 1781792171);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_paket` int(10) UNSIGNED DEFAULT NULL,
  `id_voucher` int(11) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  `status` enum('pending','berhasil','gagal') DEFAULT NULL,
  `metode_pembayaran` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_user`, `id_paket`, `id_voucher`, `subtotal`, `status`, `metode_pembayaran`, `created_at`, `updated_at`) VALUES
(1, 11, 4, 2, 525000.00, 'berhasil', 'GoPay', '2026-06-13 02:35:04', '2026-06-13 02:35:04'),
(2, 11, 4, 2, 525000.00, 'berhasil', 'GoPay', '2026-06-13 02:39:50', '2026-06-13 02:39:50'),
(3, 11, 5, 6, 330000.00, 'berhasil', 'DANA', '2026-06-18 14:13:34', '2026-06-18 14:13:34'),
(4, 12, 5, 6, 330000.00, 'berhasil', 'DANA', '2026-06-18 14:14:25', '2026-06-18 14:14:25');

-- --------------------------------------------------------

--
-- Table structure for table `tugas`
--

CREATE TABLE `tugas` (
  `id_tugas` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `deadline` datetime NOT NULL,
  `kelas` varchar(255) NOT NULL,
  `mapel` varchar(255) NOT NULL,
  `file_tugas` varchar(255) DEFAULT NULL,
  `id_guru` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `university`
--

CREATE TABLE `university` (
  `id_university` int(11) NOT NULL,
  `nama_ptn` varchar(100) DEFAULT NULL,
  `lokasi` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `university`
--

INSERT INTO `university` (`id_university`, `nama_ptn`, `lokasi`) VALUES
(1, 'Universitas Indonesia (UI)', 'Depok'),
(2, 'Institut Teknologi Bandung (ITB)', 'Bandung'),
(3, 'Universitas Gadjah Mada (UGM)', 'Yogyakarta'),
(4, 'Universitas Airlangga (UNAIR)', 'Surabaya'),
(5, 'Institut Teknologi Sepuluh Nopember (ITS)', 'Surabaya'),
(6, 'Universitas Padjadjaran (UNPAD)', 'Sumedang'),
(7, 'Universitas Diponegoro (UNDIP)', 'Semarang'),
(8, 'Universitas Brawijaya (UB)', 'Malang'),
(9, 'Universitas Hasanuddin (UNHAS)', 'Makassar'),
(10, 'Universitas Sebelas Maret (UNS)', 'Surakarta'),
(11, 'Universitas Pendidikan Indonesia (UPI)', 'Bandung'),
(12, 'Universitas Negeri Jakarta (UNJ)', 'Jakarta'),
(13, 'Universitas Negeri Yogyakarta (UNY)', 'Yogyakarta'),
(14, 'Universitas Negeri Malang (UM)', 'Malang'),
(15, 'Universitas Andalas (UNAND)', 'Padang'),
(16, 'Universitas Sumatera Utara (USU)', 'Medan'),
(17, 'Universitas Sriwijaya (UNSRI)', 'Palembang'),
(18, 'Universitas Syiah Kuala (USK)', 'Banda Aceh'),
(19, 'Universitas Udayana (UNUD)', 'Denpasar'),
(20, 'Universitas Mulawarman (UNMUL)', 'Samarinda'),
(21, 'Universitas Jenderal Soedirman (UNSOED)', 'Purwokerto'),
(22, 'Universitas Negeri Semarang (UNNES)', 'Semarang'),
(23, 'Universitas Negeri Surabaya (UNESA)', 'Surabaya'),
(24, 'Universitas Jember (UNEJ)', 'Jember'),
(25, 'Universitas Tanjungpura (UNTAN)', 'Pontianak'),
(26, 'Universitas Lambung Mangkurat (ULM)', 'Banjarmasin'),
(27, 'Universitas Mataram (UNRAM)', 'Mataram'),
(28, 'Universitas Pattimura (UNPATTI)', 'Ambon'),
(29, 'Universitas Sam Ratulangi (UNSRAT)', 'Manado'),
(30, 'Universitas Tadulako (UNTAD)', 'Palu');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `reactivation_requested` tinyint(1) NOT NULL DEFAULT 0,
  `role` enum('admin','guru','siswa','orang tua') DEFAULT NULL,
  `photo_profile` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_jenjang` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `email`, `password`, `reactivation_requested`, `role`, `photo_profile`, `created_at`, `id_jenjang`, `deleted_at`) VALUES
(1, 'Alice Administrator', 'alice.admin@lesonline.com', '$2y$12$9nlTrviLF2i0VPOACsRHw.wA1Dvx0moCacRVhyTwBKi785JSuaSem', 0, 'admin', NULL, '2026-05-05 03:36:34', NULL, NULL),
(2, 'Bob Superuser', 'bob.admin@lesonline.com', '$2y$12$9nlTrviLF2i0VPOACsRHw.wA1Dvx0moCacRVhyTwBKi785JSuaSem', 0, 'admin', NULL, '2026-05-05 03:36:34', NULL, NULL),
(3, 'Chandra Ops', 'chandra.admin@lesonline.com', '$2y$12$9nlTrviLF2i0VPOACsRHw.wA1Dvx0moCacRVhyTwBKi785JSuaSem', 0, 'admin', NULL, '2026-05-05 03:36:34', NULL, NULL),
(4, 'Dina Manager', 'dina.admin@lesonline.com', '$2y$12$9nlTrviLF2i0VPOACsRHw.wA1Dvx0moCacRVhyTwBKi785JSuaSem', 0, 'admin', NULL, '2026-05-05 03:36:34', NULL, NULL),
(5, 'Eko Staff', 'eko.admin@lesonline.com', '$2y$12$9nlTrviLF2i0VPOACsRHw.wA1Dvx0moCacRVhyTwBKi785JSuaSem', 0, 'admin', NULL, '2026-05-05 03:36:34', NULL, NULL),
(6, 'Bambang Sudarmadji', 'bambang.guru@lesonline.com', '$2y$12$9nlTrviLF2i0VPOACsRHw.wA1Dvx0moCacRVhyTwBKi785JSuaSem', 0, 'guru', NULL, '2026-05-05 03:36:34', NULL, NULL),
(7, 'Sri Wahyuni', 'sri.guru@lesonline.com', '$2y$12$9nlTrviLF2i0VPOACsRHw.wA1Dvx0moCacRVhyTwBKi785JSuaSem', 0, 'guru', NULL, '2026-05-05 03:36:34', NULL, NULL),
(8, 'Budi Santoso', 'budi.guru@lesonline.com', '$2y$12$9nlTrviLF2i0VPOACsRHw.wA1Dvx0moCacRVhyTwBKi785JSuaSem', 0, 'guru', NULL, '2026-05-05 03:36:34', NULL, NULL),
(9, 'Dewi Lestari', 'dewi.guru@lesonline.com', '$2y$12$9nlTrviLF2i0VPOACsRHw.wA1Dvx0moCacRVhyTwBKi785JSuaSem', 0, 'guru', NULL, '2026-05-05 03:36:34', NULL, NULL),
(10, 'Fajar Nugraha', 'fajar.guru@lesonline.com', '$2y$12$9nlTrviLF2i0VPOACsRHw.wA1Dvx0moCacRVhyTwBKi785JSuaSem', 0, 'guru', NULL, '2026-05-05 03:36:34', NULL, NULL),
(11, 'Gani Pratama', 'gani.siswa@email.com', '$2y$12$9nlTrviLF2i0VPOACsRHw.wA1Dvx0moCacRVhyTwBKi785JSuaSem', 0, 'siswa', NULL, '2026-05-05 03:36:34', 3, NULL),
(12, 'Hana Zaskia', 'hana.siswa@email.com', '$2y$12$9nlTrviLF2i0VPOACsRHw.wA1Dvx0moCacRVhyTwBKi785JSuaSem', 0, 'siswa', NULL, '2026-05-05 03:36:34', 3, NULL),
(13, 'Indra Wijaya', 'indra.siswa@email.com', '$2y$12$9nlTrviLF2i0VPOACsRHw.wA1Dvx0moCacRVhyTwBKi785JSuaSem', 0, 'siswa', NULL, '2026-05-05 03:36:34', 3, NULL),
(14, 'Jihan Putri', 'jihan.siswa@email.com', '$2y$12$9nlTrviLF2i0VPOACsRHw.wA1Dvx0moCacRVhyTwBKi785JSuaSem', 0, 'siswa', NULL, '2026-05-05 03:36:34', 3, NULL),
(15, 'Kevin Sanjaya', 'kevin.siswa@email.com', '$2y$12$9nlTrviLF2i0VPOACsRHw.wA1Dvx0moCacRVhyTwBKi785JSuaSem', 0, 'siswa', NULL, '2026-05-05 03:36:34', 3, NULL),
(16, 'Lestari Mama', 'lestari.ortu@email.com', '$2y$12$9nlTrviLF2i0VPOACsRHw.wA1Dvx0moCacRVhyTwBKi785JSuaSem', 0, 'orang tua', NULL, '2026-05-05 03:36:34', NULL, NULL),
(17, 'Mulyono Papa', 'mulyono.ortu@email.com', '$2y$12$9nlTrviLF2i0VPOACsRHw.wA1Dvx0moCacRVhyTwBKi785JSuaSem', 0, 'orang tua', NULL, '2026-05-05 03:36:34', NULL, NULL),
(18, 'Nina Bunda', 'nina.ortu@email.com', '$2y$12$9nlTrviLF2i0VPOACsRHw.wA1Dvx0moCacRVhyTwBKi785JSuaSem', 0, 'orang tua', NULL, '2026-05-05 03:36:34', NULL, NULL),
(19, 'Oman Ayah', 'oman.ortu@email.com', '$2y$12$9nlTrviLF2i0VPOACsRHw.wA1Dvx0moCacRVhyTwBKi785JSuaSem', 0, 'orang tua', NULL, '2026-05-05 03:36:34', NULL, NULL),
(20, 'Puji Ibu', 'puji.ortu@email.com', '$2y$12$9nlTrviLF2i0VPOACsRHw.wA1Dvx0moCacRVhyTwBKi785JSuaSem', 0, 'orang tua', NULL, '2026-05-05 03:36:34', NULL, NULL);

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
  `role` enum('admin','orang tua','siswa','guru') NOT NULL DEFAULT 'siswa',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id_videos` int(11) NOT NULL,
  `id_paket` int(11) DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE `voucher` (
  `id_voucher` int(11) NOT NULL,
  `kode_voucher` varchar(50) DEFAULT NULL,
  `potongan` decimal(10,2) DEFAULT NULL,
  `tanggal_berakhir` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `voucher`
--

INSERT INTO `voucher` (`id_voucher`, `kode_voucher`, `potongan`, `tanggal_berakhir`) VALUES
(1, 'PINTARMTK', 25000.00, '2026-12-31'),
(2, 'SIAPUTBK', 75000.00, '2026-06-30'),
(3, 'JUARAKELAS', 40000.00, '2026-05-20'),
(4, 'DISKONMABA', 100000.00, '2026-08-15'),
(5, 'LESHEMAT', 15000.00, '2026-12-31'),
(6, 'BACK TO SCHOOL', 120000.00, '2026-07-31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `catatan`
--
ALTER TABLE `catatan`
  ADD PRIMARY KEY (`id_catatan`);

--
-- Indexes for table `catatans`
--
ALTER TABLE `catatans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`id_exam`);

--
-- Indexes for table `exam_histories`
--
ALTER TABLE `exam_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_histories_user_id_index` (`user_id`);

--
-- Indexes for table `exam_scores`
--
ALTER TABLE `exam_scores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_scores_user_id_index` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jadwal_mengajar`
--
ALTER TABLE `jadwal_mengajar`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indexes for table `jenjang`
--
ALTER TABLE `jenjang`
  ADD PRIMARY KEY (`id_jenjang`);

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
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id_major`),
  ADD KEY `id_university` (`id_university`);

--
-- Indexes for table `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id_materi`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id_message`),
  ADD KEY `messages_receiver_id_foreign` (`receiver_id`),
  ADD KEY `messages_sender_id_receiver_id_index` (`sender_id`,`receiver_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ortu_siswa`
--
ALTER TABLE `ortu_siswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ortu_siswa_id_orangtua_id_siswa_unique` (`id_orangtua`,`id_siswa`),
  ADD KEY `ortu_siswa_id_siswa_foreign` (`id_siswa`);

--
-- Indexes for table `paket_pembelajaran`
--
ALTER TABLE `paket_pembelajaran`
  ADD PRIMARY KEY (`id_paket`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_voucher` (`id_voucher`);

--
-- Indexes for table `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id_tugas`);

--
-- Indexes for table `university`
--
ALTER TABLE `university`
  ADD PRIMARY KEY (`id_university`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_user_jenjang` (`id_jenjang`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id_videos`),
  ADD KEY `id_paket` (`id_paket`);

--
-- Indexes for table `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`id_voucher`),
  ADD UNIQUE KEY `kode_voucher` (`kode_voucher`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `catatan`
--
ALTER TABLE `catatan`
  MODIFY `id_catatan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `catatans`
--
ALTER TABLE `catatans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `id_exam` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam_histories`
--
ALTER TABLE `exam_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `exam_scores`
--
ALTER TABLE `exam_scores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jadwal_mengajar`
--
ALTER TABLE `jadwal_mengajar`
  MODIFY `id_jadwal` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenjang`
--
ALTER TABLE `jenjang`
  MODIFY `id_jenjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id_major` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `materi`
--
ALTER TABLE `materi`
  MODIFY `id_materi` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id_message` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `ortu_siswa`
--
ALTER TABLE `ortu_siswa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `paket_pembelajaran`
--
ALTER TABLE `paket_pembelajaran`
  MODIFY `id_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id_tugas` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `university`
--
ALTER TABLE `university`
  MODIFY `id_university` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id_videos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `voucher`
--
ALTER TABLE `voucher`
  MODIFY `id_voucher` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD CONSTRAINT `jurusan_ibfk_1` FOREIGN KEY (`id_university`) REFERENCES `university` (`id_university`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `ortu_siswa`
--
ALTER TABLE `ortu_siswa`
  ADD CONSTRAINT `ortu_siswa_id_orangtua_foreign` FOREIGN KEY (`id_orangtua`) REFERENCES `user` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `ortu_siswa_id_siswa_foreign` FOREIGN KEY (`id_siswa`) REFERENCES `user` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_voucher`) REFERENCES `voucher` (`id_voucher`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_jenjang` FOREIGN KEY (`id_jenjang`) REFERENCES `jenjang` (`id_jenjang`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `videos_ibfk_1` FOREIGN KEY (`id_paket`) REFERENCES `paket_pembelajaran` (`id_paket`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

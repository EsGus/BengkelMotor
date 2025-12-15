-- phpMyAdmin SQL Dump
-- version 6.0.0-dev+20250927.af95a2e028
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 15, 2025 at 08:49 AM
-- Server version: 9.1.0
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bengkelmotor`
--

-- --------------------------------------------------------

--
-- Table structure for table `ban`
--

CREATE TABLE `ban` (
  `idBan` bigint UNSIGNED NOT NULL,
  `namaBan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok` int NOT NULL,
  `harga` decimal(12,2) NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ban`
--

INSERT INTO `ban` (`idBan`, `namaBan`, `stok`, `harga`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 'FDR TL GENZI PRO Ring 14', 15, 212000.00, 'ban1.png', NULL, NULL),
(2, 'IRC Tubeless Ring 14', 15, 195000.00, 'ban2.png', NULL, NULL),
(3, 'FDR TT/TL FLEMMO Ring 14 Ban Motor Tube Type dan Tubeless Accessories Motorcycle Rasio - 80/90-14 TL', 10, 225000.00, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `booking_servis`
--

CREATE TABLE `booking_servis` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_pelanggan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nopol` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipe_motor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_servis` date NOT NULL,
  `jam_servis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keluhan` text COLLATE utf8mb4_unicode_ci,
  `status` enum('Menunggu','Selesai') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Menunggu',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `booking_servis`
--

INSERT INTO `booking_servis` (`id`, `nama_pelanggan`, `no_hp`, `nopol`, `tipe_motor`, `tgl_servis`, `jam_servis`, `keluhan`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Esta', '089530840095', '123123141', 'Honda Beat', '2025-12-02', '12:00', NULL, 'Selesai', '2025-11-30 13:26:05', '2025-11-30 13:27:29'),
(2, 'Estha Gusti Ubanggi', '01241414', '148142746', 'Honda Brio', '2025-12-12', '14:00', NULL, 'Selesai', '2025-12-01 09:56:52', '2025-12-01 09:57:12'),
(3, 'hdiowjfqekfeq', 'dahdhqke193', 'a8318741', 'duqghdq', '4240-02-08', '12:45', NULL, 'Selesai', '2025-12-02 09:08:01', '2025-12-02 18:56:01'),
(4, 'Michael Jery', '0987423748', 'B 1234 XC', 'Vario', '2025-12-12', '11:30', 'Ban Motor Pecah', 'Menunggu', '2025-12-03 01:28:07', '2025-12-03 01:28:07'),
(5, 'Michael Jerry', '9898414', 'AB 64714 XC', 'Honda', '2025-12-11', '11:15', 'Ban pecah', 'Selesai', '2025-12-03 01:32:03', '2025-12-03 01:57:27'),
(6, 'Michael Jerry', '9898414', 'AB 64714 XC', 'Honda', '2025-12-11', '16:30', 'Ban pecah', 'Menunggu', '2025-12-03 01:55:53', '2025-12-03 01:55:53');

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
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `product_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `product_id`, `product_type`, `qty`, `created_at`, `updated_at`) VALUES
(29, 2, 3, 'ban', 1, '2025-12-02 13:38:03', '2025-12-02 13:38:03'),
(33, 4, 2, 'oli', 1, '2025-12-03 01:23:19', '2025-12-03 01:23:19');

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id` bigint UNSIGNED NOT NULL,
  `id_transaksi` bigint UNSIGNED NOT NULL,
  `id_produk` bigint UNSIGNED NOT NULL,
  `jenis_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'sparepart',
  `jumlah` int NOT NULL,
  `harga_saat_transaksi` decimal(12,2) NOT NULL,
  `subtotal` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id`, `id_transaksi`, `id_produk`, `jenis_produk`, `jumlah`, `harga_saat_transaksi`, `subtotal`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'oli', 1, 62000.00, 62000.00, '2025-11-30 13:06:06', '2025-11-30 13:06:06'),
(2, 1, 1, 'ban', 1, 212000.00, 212000.00, '2025-11-30 13:06:06', '2025-11-30 13:06:06');

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
-- Table structure for table `gear`
--

CREATE TABLE `gear` (
  `idGear` bigint UNSIGNED NOT NULL,
  `namaGear` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok` int NOT NULL,
  `harga` decimal(12,2) NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gear`
--

INSERT INTO `gear` (`idGear`, `namaGear`, `stok`, `harga`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 'Gear Set Girset Komplit Honda', 10, 127000.00, 'gear1.png', NULL, NULL);

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
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` bigint UNSIGNED NOT NULL,
  `nama_kategori` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `keterangan`, `deskripsi`) VALUES
(1, 'Oli', 'Pelumas Mesin', NULL),
(2, 'Ban', 'Ban Tubeless & Biasa', NULL),
(3, 'Sparepart', 'Suku cadang asli', NULL),
(4, 'Gear', 'Gear set & Rantai', NULL),
(5, 'Jasa', 'Biaya Pemasangan/Servis', NULL);

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
(4, '2025_10_14_114519_create_kategoris_table', 1),
(5, '2025_10_14_114520_create_produks_table', 1),
(6, '2025_10_14_115639_create_pelanggans_table', 1),
(7, '2025_11_18_170056_create_transaksi_table', 1),
(8, '2025_11_18_170147_create_detail_transaksi_table', 1),
(9, '2025_11_18_170208_create_booking_servis_table', 1),
(10, '2025_11_18_171439_add_biaya_admin_to_transaksi_table', 1),
(11, '2025_11_18_201655_create_spareparts_table', 1),
(12, '2025_11_30_155112_create_carts_table', 1),
(13, '2025_11_30_162915_create_gears_table', 1),
(14, '2025_11_30_163647_create_olis_table', 1),
(15, '2025_11_30_164510_create_bans_table', 1),
(16, '2025_11_30_192908_add_role_to_users_table', 1),
(17, '2025_12_02_140627_create_pegawais_table', 2),
(18, '2025_12_02_161520_create_pegawais_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `oli`
--

CREATE TABLE `oli` (
  `idOli` bigint UNSIGNED NOT NULL,
  `namaOli` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok` int NOT NULL,
  `harga` decimal(12,2) NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oli`
--

INSERT INTO `oli` (`idOli`, `namaOli`, `stok`, `harga`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 'MOTUL Oil Motor SCOOTER POWER LE', 20, 62000.00, 'oli1.png', NULL, NULL),
(2, 'Shell Advance AX7 Scooter', 25, 55000.00, 'oli2.png', NULL, NULL);

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
-- Table structure for table `pegawais`
--

CREATE TABLE `pegawais` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pegawais`
--

INSERT INTO `pegawais` (`id`, `nama`, `jabatan`, `email`, `foto`, `created_at`, `updated_at`) VALUES
(1, 'Yola Valery', 'CEO AXERA MOTOR', 'yola@example.com', 'img/marsya.jpeg', '2025-12-02 09:18:53', '2025-12-02 09:18:53'),
(4, 'Intan Ayu Wibisono', 'Kasir', 'intan@example.com', 'img/putri.jpeg', '2025-12-02 09:20:09', '2025-12-02 09:52:55'),
(5, 'Yola Valery', 'CEO AXERA MOTOR', 'yola@example.com', 'img/marsya.jpeg', '2025-12-02 09:43:55', '2025-12-02 09:43:55'),
(6, 'Rian Saputra', 'Montir', 'rian@example.com', 'img/jcwk.jpeg', '2025-12-02 09:43:56', '2025-12-02 09:43:56'),
(7, 'Intan Ayu', 'Kasir', 'intan@example.com', 'img/putri.jpeg', '2025-12-02 09:43:57', '2025-12-02 09:43:57'),
(8, 'Viana', 'Co Kepala Bengkel', 'viana@gmail.com', 'img/no-image.jpg', '2025-12-02 10:02:19', '2025-12-02 10:02:19');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggans`
--

CREATE TABLE `pelanggans` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_motor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_polisi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pelanggans`
--

INSERT INTO `pelanggans` (`id`, `user_id`, `no_hp`, `alamat`, `jenis_motor`, `no_polisi`, `created_at`, `updated_at`) VALUES
(1, 1, '081234567890', 'Yogyakarta', 'Vario 150', 'AB 1234 XY', '2025-11-30 13:06:06', '2025-11-30 13:06:06');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` bigint UNSIGNED NOT NULL,
  `id_kategori` bigint UNSIGNED DEFAULT NULL,
  `nama_produk` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga` decimal(10,2) DEFAULT NULL,
  `stok` int DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `id_kategori`, `nama_produk`, `harga`, `stok`, `deskripsi`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 5, 'Biaya Jasa Pasang / Servis', 14000.00, 999, NULL, 'jasa.png', '2025-11-30 13:06:05', '2025-11-30 13:06:05');

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
('6dT2qlV5IRfn9mpTxnEWtCFt4rFG70K5FhNSPm5X', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRWRETzU1N0p3bks1eEhaQ1VMajlrSm9wUkZ4VkY2R2xaaGtWMTN3diI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ob21lIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1764752305),
('bi4xh2I2NyQ6y5GI2ez9iztZ5glNIV39mQxVMeRe', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidnZFajY4NlpZbmphSGl6Z1V6TmpNRFhPTUtZM3EzNDhvZXhkQ0NiWiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fX0=', 1764750513),
('ubbh13zHqLVcqMoy8mRU5vBpmHPb1vHEG6hPpWmL', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYWpjMjMyRzg2WHpLWWxyVFpKUTRuZ0kzV1ZMVWNvTGlxUzVLbjRIWSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1765788446),
('xt6MYIXO0imjtZSLD3v3a3IhW0k03GJphVT3E6vC', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNDhNSm10Wkxnd3lrMFJwVGNlZ1BrVWhMZGRTaWNUUkc4SGJTZFBuZiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHBzOi8vYmVuZ2tlbG1vdG9yLnRlc3QvYmFuIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Nzt9', 1764953818);

-- --------------------------------------------------------

--
-- Table structure for table `spareparts`
--

CREATE TABLE `spareparts` (
  `idSparepart` bigint UNSIGNED NOT NULL,
  `namaSparepart` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok` int NOT NULL,
  `harga` decimal(12,2) NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `spareparts`
--

INSERT INTO `spareparts` (`idSparepart`, `namaSparepart`, `stok`, `harga`, `gambar`, `created_at`, `updated_at`) VALUES
(2, 'Suku Cadang Motor Generik 2', 15, 70000.00, 'spar2.png', NULL, NULL),
(3, 'Suku Cadang Motor Generik 3', 15, 80000.00, 'spar3.png', NULL, NULL),
(5, 'Suku Cadang Motor Generik 5', 15, 100000.00, 'spar5.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `tanggal_transaksi` datetime NOT NULL,
  `total_harga` decimal(12,2) NOT NULL,
  `biaya_admin` decimal(10,2) NOT NULL DEFAULT '0.00',
  `metode_pembayaran` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_pembayaran` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `user_id`, `tanggal_transaksi`, `total_harga`, `biaya_admin`, `metode_pembayaran`, `status_pembayaran`, `created_at`, `updated_at`) VALUES
(1, 1, '2025-11-30 20:06:06', 289000.00, 1000.00, 'BCA Virtual Account', 'lunas', '2025-11-30 13:06:06', '2025-11-30 13:06:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Estha Gusti', 'estha', NULL, NULL, '$2y$12$wYzv4c7GjCBG6muzPvN3cevwMegJD0N2ELli51g5gMsE.jwSgKUbq', 'user', NULL, '2025-11-30 13:06:05', '2025-11-30 13:06:05'),
(2, 'Administrator', 'admin', NULL, NULL, '$2y$12$uzoYWCXYvx/5juxPCOXkeuNnODbSNZxfUrzlnBIPVsAeFh1sIGvki', 'admin', NULL, '2025-11-30 13:06:06', '2025-11-30 13:06:06'),
(3, 'Gusti', 'Gusti', NULL, NULL, '$2y$12$BY.N3MhxaqhTik.cjK493uzxx1m0yf643.sFhK8z58UONEufPSqvi', 'user', NULL, '2025-11-30 13:24:57', '2025-11-30 13:24:57'),
(4, 'fatma', 'fatma', NULL, NULL, '$2y$12$yuSQxoZmOlZ14RbMZYZQwupSCtEjiiMwU8xWcXJ1utfF0MUbBzGkm', 'user', NULL, '2025-12-02 04:09:22', '2025-12-02 04:09:22'),
(5, 'Michael', 'Michael', NULL, NULL, '$2y$12$b2mqwIwZmejvTkeH.keyc.LUNqU8b.FEa9fgQUnF93qy0JAg7yJOO', 'user', NULL, '2025-12-03 01:25:42', '2025-12-03 01:25:42'),
(6, 'Andre', 'Andre', NULL, NULL, '$2y$12$3ZbxGt.bZp1xzOtX3913Xejnw40ZKi5O.4wjWD2hsuTRqJiaY3266', 'user', NULL, '2025-12-03 01:53:04', '2025-12-03 01:53:04'),
(7, 'Bili', 'Bili', NULL, NULL, '$2y$12$U0lenr3hioInvICzYKq9suxgmE1hm8cyUacVvCkDdsMtqlyFKOZsO', 'user', NULL, '2025-12-05 09:53:10', '2025-12-05 09:53:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ban`
--
ALTER TABLE `ban`
  ADD PRIMARY KEY (`idBan`);

--
-- Indexes for table `booking_servis`
--
ALTER TABLE `booking_servis`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `gear`
--
ALTER TABLE `gear`
  ADD PRIMARY KEY (`idGear`);

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
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oli`
--
ALTER TABLE `oli`
  ADD PRIMARY KEY (`idOli`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pegawais`
--
ALTER TABLE `pegawais`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelanggans`
--
ALTER TABLE `pelanggans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelanggans_user_id_foreign` (`user_id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produk_id_kategori_foreign` (`id_kategori`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `spareparts`
--
ALTER TABLE `spareparts`
  ADD PRIMARY KEY (`idSparepart`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_user_id_index` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ban`
--
ALTER TABLE `ban`
  MODIFY `idBan` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `booking_servis`
--
ALTER TABLE `booking_servis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gear`
--
ALTER TABLE `gear`
  MODIFY `idGear` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `oli`
--
ALTER TABLE `oli`
  MODIFY `idOli` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pegawais`
--
ALTER TABLE `pegawais`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pelanggans`
--
ALTER TABLE `pelanggans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `spareparts`
--
ALTER TABLE `spareparts`
  MODIFY `idSparepart` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pelanggans`
--
ALTER TABLE `pelanggans`
  ADD CONSTRAINT `pelanggans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_id_kategori_foreign` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

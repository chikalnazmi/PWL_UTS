-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 23, 2024 at 08:56 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pwl_uts`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_09_11_021447_create_m_level_table', 1),
(6, '2024_09_11_023357_create_m_kategori_table', 2),
(7, '2024_09_11_023433_create_m_supplier_table', 2),
(8, '2024_09_11_024833_create_m_user_table', 3),
(9, '2024_09_11_031033_create_m_barang_table', 4),
(10, '2024_09_11_031924_create_t_penjualan_table', 5),
(11, '2024_09_11_032145_create_t_stok_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `m_barang`
--

CREATE TABLE `m_barang` (
  `barang_id` bigint UNSIGNED NOT NULL,
  `fk_kategori_id` bigint UNSIGNED NOT NULL,
  `barang_kode` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `barang_nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_beli` int NOT NULL,
  `harga_jual` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_barang`
--

INSERT INTO `m_barang` (`barang_id`, `fk_kategori_id`, `barang_kode`, `barang_nama`, `harga_beli`, `harga_jual`, `created_at`, `updated_at`) VALUES
(101, 1, 'ACC001', 'Aurora Charms', 2000000, 2500000, NULL, '2024-10-22 14:22:08'),
(102, 1, 'ACC002', 'Lunar Grace', 1500000, 1800000, NULL, NULL),
(103, 1, 'ACC003', 'Ethereal Dream', 500000, 700000, NULL, NULL),
(104, 1, 'ACC004', 'Mystic Halo', 3000000, 3500000, NULL, NULL),
(105, 1, 'ACC005', 'Serenity Loop', 250000, 400000, NULL, NULL),
(106, 2, 'ACC006', 'Celestial Aura', 5000000, 5500000, NULL, NULL),
(107, 2, 'ACC007', 'Eclipse Jewel', 4500000, 5000000, NULL, NULL),
(108, 2, 'ACC008', 'Starlight Whisper', 2500000, 3000000, NULL, NULL),
(109, 2, 'ACC009', 'Twilight Reflection', 3500000, 4000000, NULL, NULL),
(110, 2, 'ACC010', 'Silver Mirage', 1200000, 1500000, NULL, NULL),
(111, 3, 'ACC011', 'Ocean Breeze', 1000000, 1500000, NULL, NULL),
(112, 3, 'ACC012', 'Velvet Horizon', 1200000, 1700000, NULL, NULL),
(113, 3, 'ACC013', 'Obsidian Glow', 2000000, 2500000, NULL, NULL),
(114, 3, 'ACC014', 'Crystal Dawn', 500000, 800000, NULL, NULL),
(115, 3, 'ACC015', 'Jade Harmony', 750000, 1000000, NULL, NULL),
(116, 4, 'ACC016', 'Solstice Radiance', 7000000, 7500000, NULL, NULL),
(117, 4, 'ACC017', 'Golden Ember', 3000000, 3500000, NULL, NULL),
(118, 4, 'ACC018', 'Eternal Flame', 6000000, 6500000, NULL, NULL),
(119, 4, 'ACC019', 'Sapphire Horizon', 4000000, 4500000, NULL, NULL),
(120, 4, 'ACC020', 'Moonlit Silver', 1500000, 2000000, NULL, NULL),
(121, 5, 'ACC021', 'Timeless Elegance', 10000000, 12000000, NULL, NULL),
(122, 5, 'ACC022', 'Midnight Glow', 1500000, 2000000, NULL, NULL),
(123, 5, 'ACC023', 'Glimmering Wave', 2500000, 3000000, NULL, NULL),
(124, 5, 'ACC024', 'Seaside Horizon', 4000000, 4500000, NULL, NULL),
(127, 5, 'ACC025', 'Golden Swan', 10000, 100000, '2024-10-22 13:47:04', '2024-10-22 13:47:04');

-- --------------------------------------------------------

--
-- Table structure for table `m_kategori`
--

CREATE TABLE `m_kategori` (
  `kategori_id` bigint UNSIGNED NOT NULL,
  `kategori_kode` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori_nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_kategori`
--

INSERT INTO `m_kategori` (`kategori_id`, `kategori_kode`, `kategori_nama`, `created_at`, `updated_at`) VALUES
(1, 'A001', 'Gelang', NULL, '2024-10-22 13:46:06'),
(2, 'B002', 'Kalung', NULL, NULL),
(3, 'C003', 'Anting', NULL, NULL),
(4, 'D004', 'Cincin', NULL, NULL),
(5, 'E005', 'Jam Tangan', NULL, NULL),
(6, 'F006', 'Baju', '2024-10-22 12:47:59', '2024-10-22 12:47:59');

-- --------------------------------------------------------

--
-- Table structure for table `m_level`
--

CREATE TABLE `m_level` (
  `level_id` bigint UNSIGNED NOT NULL,
  `level_kode` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `level_nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_level`
--

INSERT INTO `m_level` (`level_id`, `level_kode`, `level_nama`, `created_at`, `updated_at`) VALUES
(1, 'ADM', 'Administrator', NULL, '2024-10-22 05:23:13'),
(2, 'MNG', 'Manager', NULL, NULL),
(3, 'STF', 'Staff/Kasir', NULL, NULL),
(4, 'HRD', 'Human Resource', NULL, NULL),
(5, 'OWN', 'Owner', NULL, NULL),
(9, 'KYW', 'Karyawan', '2024-10-22 12:49:58', '2024-10-22 12:49:58');

-- --------------------------------------------------------

--
-- Table structure for table `m_supplier`
--

CREATE TABLE `m_supplier` (
  `supplier_id` bigint UNSIGNED NOT NULL,
  `supplier_kode` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_supplier`
--

INSERT INTO `m_supplier` (`supplier_id`, `supplier_kode`, `supplier_nama`, `supplier_alamat`, `created_at`, `updated_at`) VALUES
(1, 'S001', 'PT Gelang Indah', 'Jl. Merdeka No. 10, Jakarta', NULL, NULL),
(2, 'S002', 'CV Kalung Mewah', 'Jl. Pahlawan No. 23, Bandung', NULL, NULL),
(3, 'S003', 'UD Anting Cantik', 'Jl. Cendana No. 45, Surabaya', NULL, NULL),
(4, 'S004', 'PT Cincin Gemilang', 'Jl. Sudirman No. 12, Yogyakarta', NULL, NULL),
(5, 'S005', 'CV Jam Tangan Elegan', 'Jl. Kartini No. 78, Bali', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_user`
--

CREATE TABLE `m_user` (
  `user_id` bigint UNSIGNED NOT NULL,
  `level_id` bigint UNSIGNED NOT NULL,
  `username` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_profile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_user`
--

INSERT INTO `m_user` (`user_id`, `level_id`, `username`, `nama`, `password`, `user_profile`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', 'Administrator', '$2y$12$lSGcaX5zyThC7OwMSoh0U.LKKgVWEtvZWP1K49oosf/1m0lWu8.mi', 'C:\\laragon\\www\\PWL_UTS\\public\\image/profile/1729668742.jpg', NULL, '2024-10-23 00:32:22'),
(2, 2, 'manager', 'Manager', '$2y$12$Fk6XuyBjOI37RsU15omN4ume..tmw20PfW/qEVr59zDOeZhQAr4v2', NULL, NULL, NULL),
(3, 3, 'staff', 'Staff/Kasir', '$2y$12$Uy7ASuVgXVYBAj5g9NZjmOXJPMCp8HCzgsFufcQM1utfL/cYfhtp.', NULL, NULL, NULL),
(4, 1, 'chikalnazmi', 'Chikal Nazmi Mahira', '$2y$12$9RxVFh4Q2Bl69pTqVOpjeOGYzp5pJmB5TGWbWIhbjveEYBGrCRKEy', NULL, '2024-10-22 05:03:38', '2024-10-22 05:03:38'),
(5, 1, 'chikalnazzz', 'Chikal Nazmi Mahira', '$2y$12$kIcssgGs.WBSXrw6/C2iQuDwqEIvchiCQUZMIjByHnG1m88F5jaS6', 'C:\\laragon\\www\\PWL_UTS\\public\\image/profile/1729629056.jpg', '2024-10-22 12:47:20', '2024-10-22 13:30:56');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_penjualan`
--

CREATE TABLE `t_penjualan` (
  `penjualan_id` bigint UNSIGNED NOT NULL,
  `fk_user_id` bigint UNSIGNED NOT NULL,
  `pembeli` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `penjualan_kode` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `penjualan_tanggal` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_penjualan`
--

INSERT INTO `t_penjualan` (`penjualan_id`, `fk_user_id`, `pembeli`, `penjualan_kode`, `penjualan_tanggal`, `created_at`, `updated_at`) VALUES
(1, 1, 'Budi Santoso', 'PJ001', '2024-10-21 15:10:10', NULL, NULL),
(2, 2, 'Siti Nurhaliza', 'PJ002', '2024-10-21 15:10:10', NULL, NULL),
(3, 3, 'Andi Saputra', 'PJ003', '2024-10-21 15:10:10', NULL, NULL),
(4, 1, 'Joko Widodo', 'PJ004', '2024-10-21 15:10:10', NULL, NULL),
(5, 2, 'Lina Susanti', 'PJ005', '2024-10-21 15:10:10', NULL, NULL),
(6, 3, 'Toni Suryana', 'PJ006', '2024-10-21 15:10:10', NULL, NULL),
(7, 1, 'Aisyah Putri', 'PJ007', '2024-10-21 15:10:10', NULL, NULL),
(8, 2, 'Ahmad Dani', 'PJ008', '2024-10-21 15:10:10', NULL, NULL),
(9, 3, 'Bambang Hartono', 'PJ009', '2024-10-21 15:10:10', NULL, NULL),
(10, 1, 'Slamet Riyadi', 'PJ010', '2024-10-21 15:10:10', NULL, NULL),
(11, 2, 'Ayu Rahayu', 'PJ011', '0000-00-00 00:00:00', '2024-10-22 15:07:50', NULL),
(12, 3, 'Budi Santoso', 'PJ012', '0000-00-00 00:00:00', '2024-10-22 15:07:50', NULL),
(13, 1, 'Dewi Sartika', 'PJ013', '0000-00-00 00:00:00', '2024-10-22 15:07:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_penjualan_detail`
--

CREATE TABLE `t_penjualan_detail` (
  `detail_id` bigint UNSIGNED NOT NULL,
  `fk_penjualan_id` bigint UNSIGNED NOT NULL,
  `fk_barang_id` bigint UNSIGNED NOT NULL,
  `harga` int NOT NULL,
  `jumlah` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_penjualan_detail`
--

INSERT INTO `t_penjualan_detail` (`detail_id`, `fk_penjualan_id`, `fk_barang_id`, `harga`, `jumlah`, `created_at`, `updated_at`) VALUES
(1, 1, 101, 8500000, 2, NULL, NULL),
(2, 1, 102, 4000000, 1, NULL, NULL),
(3, 1, 103, 11000000, 1, NULL, NULL),
(4, 2, 106, 900000, 1, NULL, NULL),
(5, 2, 107, 600000, 2, NULL, NULL),
(6, 2, 108, 350000, 3, NULL, NULL),
(7, 3, 111, 25000, 5, NULL, NULL),
(8, 3, 112, 30000, 4, NULL, NULL),
(9, 3, 113, 35000, 2, NULL, NULL),
(10, 4, 104, 6500000, 1, NULL, NULL),
(11, 4, 105, 12500000, 1, NULL, NULL),
(12, 4, 106, 900000, 2, NULL, NULL),
(13, 5, 107, 600000, 1, NULL, NULL),
(14, 5, 108, 350000, 2, NULL, NULL),
(15, 5, 109, 350000, 1, NULL, NULL),
(16, 6, 110, 300000, 3, NULL, NULL),
(17, 6, 111, 25000, 2, NULL, NULL),
(18, 6, 112, 30000, 1, NULL, NULL),
(19, 7, 113, 35000, 1, NULL, NULL),
(20, 7, 114, 10000, 4, NULL, NULL),
(21, 7, 115, 20000, 2, NULL, NULL),
(22, 8, 101, 8500000, 1, NULL, NULL),
(23, 8, 102, 4000000, 2, NULL, NULL),
(24, 8, 103, 11000000, 1, NULL, NULL),
(25, 9, 106, 900000, 2, NULL, NULL),
(26, 9, 107, 600000, 1, NULL, NULL),
(27, 9, 108, 350000, 2, NULL, NULL),
(28, 10, 109, 350000, 1, NULL, NULL),
(29, 10, 110, 300000, 2, NULL, NULL),
(30, 10, 111, 25000, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_stok`
--

CREATE TABLE `t_stok` (
  `stok_id` bigint UNSIGNED NOT NULL,
  `fk_supplier_id` bigint UNSIGNED NOT NULL,
  `fk_barang_id` bigint UNSIGNED NOT NULL,
  `fk_user_id` bigint UNSIGNED NOT NULL,
  `stok_tanggal` datetime NOT NULL,
  `stok_jumlah` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_stok`
--

INSERT INTO `t_stok` (`stok_id`, `fk_supplier_id`, `fk_barang_id`, `fk_user_id`, `stok_tanggal`, `stok_jumlah`, `created_at`, `updated_at`) VALUES
(1, 2, 101, 2, '2024-10-23 00:00:00', 50, NULL, '2024-10-22 14:23:06'),
(2, 1, 102, 3, '2024-10-21 15:10:37', 100, NULL, NULL),
(3, 1, 103, 3, '2024-10-21 15:10:37', 70, NULL, NULL),
(4, 2, 104, 3, '2024-10-21 15:10:37', 120, NULL, NULL),
(5, 2, 105, 3, '2024-10-21 15:10:37', 80, NULL, NULL),
(6, 3, 106, 3, '2024-10-21 15:10:37', 60, NULL, NULL),
(7, 3, 107, 3, '2024-10-21 15:10:37', 90, NULL, NULL),
(8, 4, 108, 3, '2024-10-21 15:10:37', 150, NULL, NULL),
(9, 4, 109, 3, '2024-10-21 15:10:37', 100, NULL, NULL),
(10, 5, 110, 3, '2024-10-21 15:10:37', 200, NULL, NULL),
(11, 5, 111, 3, '2024-10-21 15:10:37', 250, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_barang`
--
ALTER TABLE `m_barang`
  ADD PRIMARY KEY (`barang_id`),
  ADD KEY `m_barang_fk_kategori_id_index` (`fk_kategori_id`);

--
-- Indexes for table `m_kategori`
--
ALTER TABLE `m_kategori`
  ADD PRIMARY KEY (`kategori_id`),
  ADD UNIQUE KEY `m_kategori_kategori_kode_unique` (`kategori_kode`);

--
-- Indexes for table `m_level`
--
ALTER TABLE `m_level`
  ADD PRIMARY KEY (`level_id`),
  ADD UNIQUE KEY `m_level_level_kode_unique` (`level_kode`);

--
-- Indexes for table `m_supplier`
--
ALTER TABLE `m_supplier`
  ADD PRIMARY KEY (`supplier_id`),
  ADD UNIQUE KEY `m_supplier_supplier_kode_unique` (`supplier_kode`);

--
-- Indexes for table `m_user`
--
ALTER TABLE `m_user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `m_user_username_unique` (`username`),
  ADD KEY `m_user_level_id_index` (`level_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `t_penjualan`
--
ALTER TABLE `t_penjualan`
  ADD PRIMARY KEY (`penjualan_id`),
  ADD KEY `t_penjualan_fk_user_id_index` (`fk_user_id`);

--
-- Indexes for table `t_penjualan_detail`
--
ALTER TABLE `t_penjualan_detail`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `t_penjualan_detail_fk_penjualan_id_index` (`fk_penjualan_id`),
  ADD KEY `t_penjualan_detail_fk_barang_id_index` (`fk_barang_id`);

--
-- Indexes for table `t_stok`
--
ALTER TABLE `t_stok`
  ADD PRIMARY KEY (`stok_id`),
  ADD KEY `t_stok_fk_supplier_id_index` (`fk_supplier_id`),
  ADD KEY `t_stok_fk_barang_id_index` (`fk_barang_id`),
  ADD KEY `t_stok_fk_user_id_index` (`fk_user_id`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `m_barang`
--
ALTER TABLE `m_barang`
  MODIFY `barang_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `m_kategori`
--
ALTER TABLE `m_kategori`
  MODIFY `kategori_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `m_level`
--
ALTER TABLE `m_level`
  MODIFY `level_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `m_supplier`
--
ALTER TABLE `m_supplier`
  MODIFY `supplier_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `m_user`
--
ALTER TABLE `m_user`
  MODIFY `user_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_penjualan`
--
ALTER TABLE `t_penjualan`
  MODIFY `penjualan_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `t_penjualan_detail`
--
ALTER TABLE `t_penjualan_detail`
  MODIFY `detail_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `t_stok`
--
ALTER TABLE `t_stok`
  MODIFY `stok_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `m_barang`
--
ALTER TABLE `m_barang`
  ADD CONSTRAINT `m_barang_fk_kategori_id_foreign` FOREIGN KEY (`fk_kategori_id`) REFERENCES `m_kategori` (`kategori_id`);

--
-- Constraints for table `m_user`
--
ALTER TABLE `m_user`
  ADD CONSTRAINT `m_user_level_id_foreign` FOREIGN KEY (`level_id`) REFERENCES `m_level` (`level_id`);

--
-- Constraints for table `t_penjualan`
--
ALTER TABLE `t_penjualan`
  ADD CONSTRAINT `t_penjualan_fk_user_id_foreign` FOREIGN KEY (`fk_user_id`) REFERENCES `m_user` (`user_id`);

--
-- Constraints for table `t_penjualan_detail`
--
ALTER TABLE `t_penjualan_detail`
  ADD CONSTRAINT `t_penjualan_detail_fk_barang_id_foreign` FOREIGN KEY (`fk_barang_id`) REFERENCES `m_barang` (`barang_id`),
  ADD CONSTRAINT `t_penjualan_detail_fk_penjualan_id_foreign` FOREIGN KEY (`fk_penjualan_id`) REFERENCES `t_penjualan` (`penjualan_id`);

--
-- Constraints for table `t_stok`
--
ALTER TABLE `t_stok`
  ADD CONSTRAINT `t_stok_fk_barang_id_foreign` FOREIGN KEY (`fk_barang_id`) REFERENCES `m_barang` (`barang_id`),
  ADD CONSTRAINT `t_stok_fk_supplier_id_foreign` FOREIGN KEY (`fk_supplier_id`) REFERENCES `m_supplier` (`supplier_id`),
  ADD CONSTRAINT `t_stok_fk_user_id_foreign` FOREIGN KEY (`fk_user_id`) REFERENCES `m_user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

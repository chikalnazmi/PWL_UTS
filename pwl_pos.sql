-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 25, 2024 at 01:31 AM
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
-- Database: `pwl_pos`
--

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
(11, '2024_09_11_032145_create_t_stok_table', 5),
(12, '2024_09_11_035026_create_t_penjualan_detail_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `m_barang`
--

CREATE TABLE `m_barang` (
  `barang_id` bigint UNSIGNED NOT NULL,
  `fk_kategori_id` bigint UNSIGNED NOT NULL,
  `barang_kode` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barang_nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_beli` int NOT NULL,
  `harga_jual` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_barang`
--

INSERT INTO `m_barang` (`barang_id`, `fk_kategori_id`, `barang_kode`, `barang_nama`, `harga_beli`, `harga_jual`, `created_at`, `updated_at`) VALUES
(101, 1, 'ELE001', 'Laptop Dell Inspiron', 8000000, 8500000, NULL, NULL),
(102, 1, 'ELE002', 'Headphone Sony WH-1000XM4', 3500000, 4000000, NULL, NULL),
(103, 1, 'ELE003', 'Smartphone Samsung Galaxy S21', 10000000, 11000000, NULL, NULL),
(104, 1, 'ELE004', 'Smartwatch Apple Watch Series 7', 6000000, 6500000, NULL, NULL),
(105, 1, 'ELE005', 'Tablet iPad Pro', 12000000, 12500000, NULL, NULL),
(106, 2, 'FAS001', 'Jaket Kulit Pria', 750000, 900000, NULL, NULL),
(107, 2, 'FAS002', 'Sepatu Sneakers Wanita', 500000, 600000, NULL, NULL),
(108, 2, 'FAS003', 'Tas Ransel Kulit', 400000, 550000, NULL, NULL),
(109, 2, 'FAS004', 'Celana Chino Pria', 250000, 350000, NULL, NULL),
(110, 2, 'FAS005', 'Kemeja Flanel Wanita', 200000, 300000, NULL, NULL),
(111, 3, 'FOOD001', 'Biskuit Gandum', 15000, 25000, NULL, NULL),
(112, 3, 'FOOD002', 'Keripik Singkong Pedas', 20000, 30000, NULL, NULL),
(113, 3, 'FOOD003', 'Coklat Batang', 25000, 35000, NULL, NULL),
(114, 3, 'FOOD004', 'Minuman Teh Botol', 5000, 10000, NULL, NULL),
(115, 3, 'FOOD005', 'Kacang Goreng', 10000, 20000, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_kategori`
--

CREATE TABLE `m_kategori` (
  `kategori_id` bigint UNSIGNED NOT NULL,
  `kategori_kode` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori_nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_kategori`
--

INSERT INTO `m_kategori` (`kategori_id`, `kategori_kode`, `kategori_nama`, `created_at`, `updated_at`) VALUES
(1, 'A001', 'Elektronik', NULL, NULL),
(2, 'B002', 'Fashion', NULL, NULL),
(3, 'C003', 'Makanan', NULL, NULL),
(4, 'D004', 'Buku', NULL, NULL),
(5, 'E005', 'Olahraga', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_level`
--

CREATE TABLE `m_level` (
  `level_id` bigint UNSIGNED NOT NULL,
  `level_kode` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level_nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_level`
--

INSERT INTO `m_level` (`level_id`, `level_kode`, `level_nama`, `created_at`, `updated_at`) VALUES
(1, 'ADM', 'Administrator', NULL, NULL),
(2, 'MNG', 'Manager', NULL, NULL),
(3, 'STF', 'Staff/Kasir', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_supplier`
--

CREATE TABLE `m_supplier` (
  `supplier_id` bigint UNSIGNED NOT NULL,
  `supplier_kode` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_supplier`
--

INSERT INTO `m_supplier` (`supplier_id`, `supplier_kode`, `supplier_nama`, `supplier_alamat`, `created_at`, `updated_at`) VALUES
(1, 'S001', 'PT Sumber Makmur', 'Jl. Merdeka No. 10, Jakarta', NULL, NULL),
(2, 'S002', 'CV Elektronik Jaya', 'Jl. Pahlawan No. 23, Bandung', NULL, NULL),
(3, 'S003', 'UD Maju Terus', 'Jl. Cendana No. 45, Surabaya', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_user`
--

CREATE TABLE `m_user` (
  `user_id` bigint UNSIGNED NOT NULL,
  `level_id` bigint UNSIGNED NOT NULL,
  `username` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_user`
--

INSERT INTO `m_user` (`user_id`, `level_id`, `username`, `nama`, `password`, `created_at`, `updated_at`) VALUES
(1, 1, 'abecekut', 'abeabe', '$2y$12$MfkyugjfElLlp3FNhuYp/.gPjD.GHokIFuWL6pRVFHkbUtJH2ahcu', NULL, '2024-09-20 08:40:03'),
(2, 2, 'manager', 'Manager', '$2y$12$2Am7bP7b4xdqD.odcnzRgeevJyTG5nXX5y44jOO2kGXUC4Vp6Hi76', NULL, NULL),
(3, 3, 'staff', 'Staff/Kasir', '$2y$12$GGp6blmDXFMu5eTtqqdKvO3O15fQp6m.D0f3PE9dJvZLbDhVcfCN2', NULL, NULL),
(4, 2, 'manager_dua', 'Manager 2', '$2y$12$t8TwFqa9Sd9vFP0FJvXC3.9tj9VoL4pgjcW0WmnUBNk6H28OpinAy', '2024-09-17 18:59:26', '2024-09-17 18:59:26'),
(6, 2, 'manager22', 'Manager Dua Dua', '$2y$12$2x.EWKqNdmUknT3k0FAkI./4VqV6ap7qy6dxPvlinw0pmDC7MBqdq', '2024-09-19 03:35:11', '2024-09-19 03:35:11'),
(7, 2, 'manager33', 'Manager Tiga Tiga', '$2y$12$G0o0ESaXT69gpctinQ.b.OuRpCsZtkSES/tgv7WbflIKPbxYS.LQ6', '2024-09-19 03:41:26', '2024-09-19 03:41:26'),
(19, 2, 'manager56', 'Manager55', '$2y$12$AKaP.r5dejpIZBADL6Si1e9OptPUtTanff121K/o1tQt9arKqQph6', '2024-09-19 06:06:47', '2024-09-19 06:06:47'),
(22, 2, 'manager11', 'Manager11', '$2y$12$EUB71dOUVnnPN0ts10zJzuXmwNAQUO5rT53tEdQlEeQcb0t2tPU/W', '2024-09-19 06:16:59', '2024-09-19 06:16:59');

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
  `pembeli` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penjualan_kode` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penjualan_tanggal` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_penjualan`
--

INSERT INTO `t_penjualan` (`penjualan_id`, `fk_user_id`, `pembeli`, `penjualan_kode`, `penjualan_tanggal`, `created_at`, `updated_at`) VALUES
(1, 1, 'Budi Santoso', 'PJ001', '2024-09-14 02:19:56', NULL, NULL),
(2, 2, 'Siti Nurhaliza', 'PJ002', '2024-09-14 02:19:56', NULL, NULL),
(3, 3, 'Andi Saputra', 'PJ003', '2024-09-14 02:19:56', NULL, NULL),
(4, 1, 'Joko Widodo', 'PJ004', '2024-09-14 02:19:56', NULL, NULL),
(5, 2, 'Lina Susanti', 'PJ005', '2024-09-14 02:19:56', NULL, NULL),
(6, 3, 'Toni Suryana', 'PJ006', '2024-09-14 02:19:56', NULL, NULL),
(7, 1, 'Aisyah Putri', 'PJ007', '2024-09-14 02:19:56', NULL, NULL),
(8, 2, 'Ahmad Dani', 'PJ008', '2024-09-14 02:19:56', NULL, NULL),
(9, 3, 'Bambang Hartono', 'PJ009', '2024-09-14 02:19:56', NULL, NULL),
(10, 1, 'Slamet Riyadi', 'PJ010', '2024-09-14 02:19:56', NULL, NULL);

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
(1, 1, 101, 3, '2024-09-14 02:01:32', 50, NULL, NULL),
(2, 1, 102, 3, '2024-09-14 02:01:32', 100, NULL, NULL),
(3, 1, 103, 3, '2024-09-14 02:01:32', 70, NULL, NULL),
(4, 1, 104, 3, '2024-09-14 02:01:32', 200, NULL, NULL),
(5, 1, 105, 3, '2024-09-14 02:01:32', 150, NULL, NULL),
(6, 2, 106, 3, '2024-09-14 02:01:32', 60, NULL, NULL),
(7, 2, 107, 3, '2024-09-14 02:01:32', 80, NULL, NULL),
(8, 2, 108, 3, '2024-09-14 02:01:32', 90, NULL, NULL),
(9, 2, 109, 3, '2024-09-14 02:01:32', 120, NULL, NULL),
(10, 2, 110, 3, '2024-09-14 02:01:32', 100, NULL, NULL),
(11, 3, 111, 3, '2024-09-14 02:01:32', 300, NULL, NULL),
(12, 3, 112, 3, '2024-09-14 02:01:32', 250, NULL, NULL),
(13, 3, 113, 3, '2024-09-14 02:01:32', 150, NULL, NULL),
(14, 3, 114, 3, '2024-09-14 02:01:32', 400, NULL, NULL),
(15, 3, 115, 3, '2024-09-14 02:01:32', 500, NULL, NULL);

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
  MODIFY `barang_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `m_kategori`
--
ALTER TABLE `m_kategori`
  MODIFY `kategori_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `m_level`
--
ALTER TABLE `m_level`
  MODIFY `level_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `m_supplier`
--
ALTER TABLE `m_supplier`
  MODIFY `supplier_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `m_user`
--
ALTER TABLE `m_user`
  MODIFY `user_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_penjualan`
--
ALTER TABLE `t_penjualan`
  MODIFY `penjualan_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `t_penjualan_detail`
--
ALTER TABLE `t_penjualan_detail`
  MODIFY `detail_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `t_stok`
--
ALTER TABLE `t_stok`
  MODIFY `stok_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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

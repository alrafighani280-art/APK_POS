-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for poss
CREATE DATABASE IF NOT EXISTS `poss` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `poss`;

-- Dumping structure for table poss.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table poss.cache: ~0 rows (approximately)

-- Dumping structure for table poss.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table poss.cache_locks: ~0 rows (approximately)

-- Dumping structure for table poss.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table poss.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table poss.item_penjualan
CREATE TABLE IF NOT EXISTS `item_penjualan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `penjualan_id` bigint unsigned NOT NULL,
  `produk_id` bigint unsigned NOT NULL,
  `kuantitas` int NOT NULL,
  `harga_satuan` int NOT NULL,
  `subtotal` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table poss.item_penjualan: ~1 rows (approximately)
INSERT INTO `item_penjualan` (`id`, `penjualan_id`, `produk_id`, `kuantitas`, `harga_satuan`, `subtotal`, `created_at`, `updated_at`) VALUES
	(1, 1, 2, 1, 20000, 20000, '2026-08-25 14:03:45', '2026-08-25 14:03:45'),
	(3, 2, 1, 1, 1250000000, 1250000000, '2026-09-01 03:51:19', '2026-09-01 03:51:19'),
	(4, 3, 2, 1, 20000, 20000, '2026-09-03 02:56:33', '2026-09-03 02:56:33');

-- Dumping structure for table poss.jenis
CREATE TABLE IF NOT EXISTS `jenis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `nama_jenis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table poss.jenis: ~3 rows (approximately)
INSERT INTO `jenis` (`id`, `user_id`, `nama_jenis`, `created_at`, `updated_at`) VALUES
	(2, 18, 'makanan', '2026-08-21 01:55:48', '2026-08-21 01:55:48'),
	(3, 18, 'minuman', '2026-08-21 01:55:55', '2026-08-21 01:55:55'),
	(4, 18, 'dessert', '2026-08-21 01:56:26', '2026-08-21 01:56:26'),
	(5, 18, 'properti', '2026-08-21 01:57:44', '2026-08-21 01:57:44'),
	(6, 18, 'Makanan Ringan', '2026-09-01 03:47:26', '2026-09-01 03:47:26');

-- Dumping structure for table poss.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table poss.jobs: ~0 rows (approximately)

-- Dumping structure for table poss.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table poss.job_batches: ~0 rows (approximately)

-- Dumping structure for table poss.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table poss.migrations: ~0 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_roles_table', 1),
	(2, '0001_01_01_000000_create_users_table', 1),
	(3, '0001_01_01_000001_create_cache_table', 1),
	(4, '0001_01_01_000002_create_jobs_table', 1),
	(5, '2026_04_20_072852_create_produk_table', 1),
	(6, '2026_04_20_074143_create_penjualan_table', 1),
	(7, '2026_04_20_075045_create_item_penjualan_table', 1),
	(8, '2026_07_27_065124_create_jenis_table', 1);

-- Dumping structure for table poss.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table poss.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table poss.penjualan
CREATE TABLE IF NOT EXISTS `penjualan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `total_pembayaran` int NOT NULL,
  `metode_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('OPEN','COMPLETED') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `penjualan_user_id_foreign` (`user_id`),
  CONSTRAINT `penjualan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table poss.penjualan: ~0 rows (approximately)
INSERT INTO `penjualan` (`id`, `user_id`, `total_pembayaran`, `metode_pembayaran`, `status`, `created_at`, `updated_at`) VALUES
	(1, 18, 20000, 'QRIS', 'COMPLETED', '2026-08-21 02:03:44', '2026-08-25 14:04:04'),
	(2, 18, 1250000000, 'QRIS', 'COMPLETED', '2026-08-25 14:16:14', '2026-09-01 03:51:25'),
	(3, 18, 20000, 'QRIS', 'COMPLETED', '2026-09-03 02:56:27', '2026-09-03 02:56:39');

-- Dumping structure for table poss.produk
CREATE TABLE IF NOT EXISTS `produk` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `jenis_id` bigint unsigned NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_beli` int NOT NULL,
  `harga_jual` int NOT NULL,
  `stok` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `produk_nama_index` (`nama`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table poss.produk: ~2 rows (approximately)
INSERT INTO `produk` (`id`, `user_id`, `jenis_id`, `foto`, `nama`, `harga_beli`, `harga_jual`, `stok`, `created_at`, `updated_at`) VALUES
	(1, 18, 1, 'products/6QG7oAxyTY6UBt20C4P5bMk7zdJuLC9jlgCqrnCd.jpg', 'richard-mille-rm-11-03', 1200000000, 1250000000, 1, '2026-08-21 01:53:02', '2026-09-01 03:51:19'),
	(3, 18, 3, 'products/EsXl6e2iqyC5sEcR2XktnCgs539prK6PmzWnZ2aD.jpg', 'ice lemon', 15000, 17500, 10, '2026-09-03 01:38:35', '2026-09-03 01:38:35');

-- Dumping structure for table poss.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table poss.roles: ~2 rows (approximately)
INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'admin', '2026-08-18 07:24:35', '2026-08-18 07:24:35'),
	(2, 'kasir', '2026-08-18 07:24:35', '2026-08-18 07:24:35');

-- Dumping structure for table poss.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table poss.sessions: ~5 rows (approximately)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('5v0PXXehcBb1uNr5kSuD6nh0gHMrtaaR1uKnUMsG', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNzZrWVNBY0FVRFQxWXVYVTNwbnBNQ0ZxTWJmQW1hQXRLNEo3eWYwTCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2Rhc2hib2FyZCI7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjI3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1788243813),
	('8OtiVyEkKzevto3Q54GzPWj0aZFhzCmMRYPYeKMC', 18, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWG1nbWx5WHF3YXhOcFRHZDQ0WVBEb01MWTc0aEtCbWl3S3ZiQXd4biI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wZW5qdWFsYW4iO3M6NToicm91dGUiO3M6MTU6InBlbmp1YWxhbi5pbmRleCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE4O30=', 1788313346),
	('c7CkZXAenzQlxfvWxeGLGJEA37lAOABVWWzcXpN9', 18, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoidnZhTVpHbGdvd3YxY0tqeThJSkQ4a3FPQUZMc0ZPVGs0aDJnd0RLeCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWsiO3M6NToicm91dGUiO3M6MTI6InByb2R1ay5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6Mjg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWsiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxODt9', 1788406519),
	('vLscZsZWwRNWWzbLkYdfWClrNiKjeAGr1zRo9hVP', 18, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSW5Wd1dQd3ZvZ2VPQmxnSTk2azg0RGtNeWV4RFpnTXF3bWpudGtKTyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6OToiZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTg7fQ==', 1788400704),
	('xEMUO0ZDQo0hC5V7wS2JNc12d76iio9AObP4918s', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOFBlUnBrVmdrMlJjZzlCdHY1bE1ORDdKMTVMdWJNUGpTUVNSMmVVbSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fX0=', 1788245225);

-- Dumping structure for table poss.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  FULLTEXT KEY `users_name_email_fulltext` (`name`,`email`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table poss.users: ~3 rows (approximately)
INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(18, 1, 'alra', 'admin@gmail.com', NULL, '$2y$12$I7Q3TRucFAi4osv6y8KczeLnbTCVjE82r9LA3viO0D/0nHrKMLPJ.', NULL, '2026-08-20 02:53:26', '2026-08-20 02:53:26'),
	(19, 2, 'yahuu', 'kasir1@gmail.com', NULL, '$2y$12$Sido4uKdAQ8HkNLQYKITR.bn.9JtCQWz1N6a/j8UwLe52G.0jGqui', NULL, '2026-08-20 02:55:46', '2026-08-20 02:55:46'),
	(20, 2, 'Reifan', 'kasir2@gmail.com', NULL, '$2y$12$MJmI1FLy2K9kvInPXhSwF.J680GQ9CLYfe2vlrSeWWvpDi7riVL86', NULL, '2026-09-01 03:43:06', '2026-09-01 03:43:06');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

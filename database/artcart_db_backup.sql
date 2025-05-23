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

-- Dumping data for table artcart_project.cache: ~0 rows (approximately)

-- Dumping data for table artcart_project.cache_locks: ~0 rows (approximately)

-- Dumping data for table artcart_project.carts: ~1 rows (approximately)
INSERT INTO `carts` (`id`, `user_id`, `razorpay_payment_id`, `created_at`, `updated_at`) VALUES
	(1, 1, 'pay_QYMOwaMQsSx9ks', '2025-05-22 07:27:59', '2025-05-23 06:21:59');

-- Dumping data for table artcart_project.cart_items: ~0 rows (approximately)
INSERT INTO `cart_items` (`id`, `cart_id`, `user_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
	(14, 1, 1, 3, 1, '2025-05-23 06:29:48', '2025-05-23 06:29:48');

-- Dumping data for table artcart_project.failed_jobs: ~0 rows (approximately)

-- Dumping data for table artcart_project.jobs: ~0 rows (approximately)

-- Dumping data for table artcart_project.job_batches: ~0 rows (approximately)

-- Dumping data for table artcart_project.migrations: ~9 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2025_05_21_060915_create_products_table', 2),
	(5, '2025_05_21_061148_create_product_images_table', 2),
	(6, '2025_05_21_061830_create_product_images_table', 3),
	(7, '2025_05_21_061917_create_cart_items_table', 3),
	(8, '2025_05_21_131535_create_carts_table', 4),
	(9, '2025_05_21_133542_create_personal_access_tokens_table', 5),
	(10, '2025_05_23_054256_add_razorpay_payment_id_to_carts_table', 6),
	(11, '2025_05_23_072940_create_orders_table', 7),
	(12, '2025_05_23_073012_create_order_items_table', 7);

-- Dumping data for table artcart_project.orders: ~7 rows (approximately)
INSERT INTO `orders` (`id`, `user_id`, `total_amount`, `razorpay_payment_id`, `status`, `created_at`, `updated_at`) VALUES
	(1, 1, 60000.00, 'pay_QYIg3bdMEAF9Py', 'paid', '2025-05-23 02:43:24', '2025-05-23 02:43:24'),
	(2, 1, 90000.00, 'pay_QYIvQOzmFmyEfI', 'paid', '2025-05-23 02:57:57', '2025-05-23 02:57:57'),
	(3, 1, 600.00, 'pay_QYJ1PIMm0F9KZi', 'paid', '2025-05-23 03:03:37', '2025-05-23 03:03:37'),
	(4, 1, 750.00, 'pay_QYK9He87VvSZfi', 'paid', '2025-05-23 04:09:45', '2025-05-23 04:09:45'),
	(5, 1, 150.00, 'pay_QYKeQvdBMbhcST', 'paid', '2025-05-23 04:39:18', '2025-05-23 04:39:18'),
	(6, 1, 750.00, 'pay_QYKjvAh3NV9TCb', 'paid', '2025-05-23 04:44:26', '2025-05-23 04:44:26'),
	(7, 1, 150.00, 'pay_QYML3Em5rJvvmc', 'paid', '2025-05-23 06:18:17', '2025-05-23 06:18:17'),
	(8, 1, 1050.00, 'pay_QYMUhoyNSn3Hhs', 'paid', '2025-05-23 06:27:27', '2025-05-23 06:27:27'),
	(9, 1, 150.00, 'pay_QYMcBzgIPFKmwY', 'paid', '2025-05-23 06:34:32', '2025-05-23 06:34:32');

-- Dumping data for table artcart_project.order_items: ~0 rows (approximately)
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
	(1, 2, 3, 4, 150.00, '2025-05-23 02:57:57', '2025-05-23 02:57:57'),
	(2, 2, 4, 2, 150.00, '2025-05-23 02:57:57', '2025-05-23 02:57:57'),
	(3, 3, 4, 4, 150.00, '2025-05-23 03:03:37', '2025-05-23 03:03:37'),
	(4, 4, 3, 5, 150.00, '2025-05-23 04:09:46', '2025-05-23 04:09:46'),
	(5, 5, 3, 1, 150.00, '2025-05-23 04:39:18', '2025-05-23 04:39:18'),
	(6, 6, 3, 5, 150.00, '2025-05-23 04:44:26', '2025-05-23 04:44:26'),
	(7, 7, 3, 1, 150.00, '2025-05-23 06:18:17', '2025-05-23 06:18:17'),
	(8, 8, 4, 7, 150.00, '2025-05-23 06:27:27', '2025-05-23 06:27:27'),
	(9, 9, 3, 1, 150.00, '2025-05-23 06:34:32', '2025-05-23 06:34:32');

-- Dumping data for table artcart_project.password_reset_tokens: ~0 rows (approximately)

-- Dumping data for table artcart_project.personal_access_tokens: ~22 rows (approximately)
INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
	(1, 'App\\Models\\User', 1, 'ArtCart', '9e71fd07124f992c3bcbcfd59b8a314451040d6162cc73a412be1544ffe11805', '["*"]', '2025-05-22 05:18:35', NULL, '2025-05-22 04:36:55', '2025-05-22 05:18:35'),
	(2, 'App\\Models\\User', 1, 'ArtCart', '973f44f553fc63a369ed749d5514d7e99f2e97a188b9b10b83bfbd7d04aba261', '["*"]', NULL, NULL, '2025-05-22 05:47:34', '2025-05-22 05:47:34'),
	(3, 'App\\Models\\User', 1, 'ArtCart', '40581bef16f1769335ee0ba5b1451b1ad869505466a433e074089a345490b546', '["*"]', NULL, NULL, '2025-05-22 05:51:29', '2025-05-22 05:51:29'),
	(4, 'App\\Models\\User', 1, 'ArtCart', '6e890cf63028ea5cc391706177f63ff7ea699ede11dfba4d68978f1f138e7f46', '["*"]', NULL, NULL, '2025-05-22 05:52:13', '2025-05-22 05:52:13'),
	(5, 'App\\Models\\User', 1, 'ArtCart', 'ec5059beb58a14d3ce1b51b8d8911b35412406c942d0e641563be02325c52a7b', '["*"]', NULL, NULL, '2025-05-22 05:52:23', '2025-05-22 05:52:23'),
	(6, 'App\\Models\\User', 1, 'ArtCart', 'c3f87f14c37ed004d51f5dcc14209b263900bfc55136d8b28bcbbe3c4d57a894', '["*"]', NULL, NULL, '2025-05-22 05:54:18', '2025-05-22 05:54:18'),
	(7, 'App\\Models\\User', 1, 'ArtCart', '3f095dc3a2f9291a3e9b55a8d4d1a4a24b9bd275390b361376f7c24745a2ee9f', '["*"]', NULL, NULL, '2025-05-22 05:55:30', '2025-05-22 05:55:30'),
	(8, 'App\\Models\\User', 1, 'ArtCart', 'ab113de3108fef37e15c144cc35d8325544667a79dec2955a099657ed82df44f', '["*"]', NULL, NULL, '2025-05-22 05:55:44', '2025-05-22 05:55:44'),
	(9, 'App\\Models\\User', 1, 'ArtCart', '6902bc23bb254f188a52eb419232c82fb92f0323c017a3e927bf5e6456102779', '["*"]', NULL, NULL, '2025-05-22 05:56:23', '2025-05-22 05:56:23'),
	(10, 'App\\Models\\User', 1, 'ArtCart', 'ffaf30bfd2c1a23ed18f8773d0ed7ec9b458d9a30a3c9fab2cf33b8ee52a238e', '["*"]', NULL, NULL, '2025-05-22 06:05:55', '2025-05-22 06:05:55'),
	(11, 'App\\Models\\User', 1, 'ArtCart', '9275e9b63b4bdb714caa21c606eaf48c7f46527f95bb2c54021312f37e0eebf8', '["*"]', NULL, NULL, '2025-05-22 06:08:34', '2025-05-22 06:08:34'),
	(12, 'App\\Models\\User', 1, 'ArtCart', '07200893504ad247b6bba58adf9ce9b8c8036e04d2afadb111fa07a7128e8f4b', '["*"]', NULL, NULL, '2025-05-22 06:12:12', '2025-05-22 06:12:12'),
	(13, 'App\\Models\\User', 1, 'ArtCart', '3024627a8ea827beb6daadde75d128121734931fe2372e8ddddfa1e3bc23aba5', '["*"]', NULL, NULL, '2025-05-22 07:02:41', '2025-05-22 07:02:41'),
	(14, 'App\\Models\\User', 1, 'ArtCart', '6f535390f171f2bb9146cc9ff2188ea4b97aa917ce02c74ac1ecaf023c308277', '["*"]', NULL, NULL, '2025-05-22 07:05:44', '2025-05-22 07:05:44'),
	(15, 'App\\Models\\User', 1, 'ArtCart', 'ecfc38153c2934e88c0e8af282d189726b80d9668b3b83c84745f54059d33905', '["*"]', NULL, NULL, '2025-05-22 07:06:11', '2025-05-22 07:06:11'),
	(16, 'App\\Models\\User', 1, 'ArtCart', 'e3cda707ed650c5b27a357bf1926711847f9b23cdb5cb83cb20fd4ab394d81dd', '["*"]', NULL, NULL, '2025-05-22 07:07:00', '2025-05-22 07:07:00'),
	(17, 'App\\Models\\User', 1, 'ArtCart', 'c407b48f779ad20197cf4285a888e24f2eaddc25b80970dd1a45e0c21779fefc', '["*"]', NULL, NULL, '2025-05-22 07:09:55', '2025-05-22 07:09:55'),
	(18, 'App\\Models\\User', 1, 'ArtCart', '21f64cc8b60fb3239f9c9ed593499a82217b9330e57e12f46e95683b70fe2e97', '["*"]', NULL, NULL, '2025-05-22 07:10:42', '2025-05-22 07:10:42'),
	(19, 'App\\Models\\User', 1, 'ArtCart', 'f479f14ea91022775957f66f4ef7bf2595908b95eeaf0e62f5a6aa7fe5e9ed1a', '["*"]', NULL, NULL, '2025-05-22 07:11:45', '2025-05-22 07:11:45'),
	(20, 'App\\Models\\User', 1, 'ArtCart', '28828c07a705fc9e6790a9e01f39f5c5a99ab1177bf534782816b258fa02dfb6', '["*"]', '2025-05-23 01:26:55', NULL, '2025-05-22 07:12:56', '2025-05-23 01:26:55'),
	(21, 'App\\Models\\User', 1, 'ArtCart', '9ca805dfede3edf475b36f0de9fbb7b9696355803a554ac13ff0262856b5c434', '["*"]', '2025-05-22 07:57:09', NULL, '2025-05-22 07:25:29', '2025-05-22 07:57:09'),
	(22, 'App\\Models\\User', 1, 'ArtCart', 'c8a640c8b082577c935beb5025b7d99cd8bc47b5f360f90373aef838da0630fa', '["*"]', '2025-05-23 04:37:02', NULL, '2025-05-23 01:28:52', '2025-05-23 04:37:02');

-- Dumping data for table artcart_project.products: ~4 rows (approximately)
INSERT INTO `products` (`id`, `name`, `price`, `created_at`, `updated_at`) VALUES
	(3, 'Fridge Magnet', 150.00, '2025-05-21 06:15:33', '2025-05-21 06:15:33'),
	(4, 'Magnet', 150.00, '2025-05-21 06:21:26', '2025-05-22 05:18:11'),
	(6, 'Digital Drawing', 1500.00, '2025-05-22 05:16:12', '2025-05-22 05:16:12'),
	(7, 'Illustration Art Piece', 2000.00, '2025-05-23 01:36:48', '2025-05-23 01:36:48');

-- Dumping data for table artcart_project.product_images: ~9 rows (approximately)
INSERT INTO `product_images` (`id`, `product_id`, `image_path`, `created_at`, `updated_at`) VALUES
	(5, 3, 'product_images/HLq3cQHH28AhTZ6JWm38F4uh74AZjb5XxxejB5q9.png', '2025-05-21 06:35:05', '2025-05-21 06:35:05'),
	(7, 6, 'product_images/KxZaOsjx9EPcmCChQAvGBv4zr1Wzvr2xj6827Fck.png', '2025-05-22 05:16:12', '2025-05-22 05:16:12'),
	(8, 6, 'product_images/EUgMT73R28s8jhCMibAH8ZKXGQ3ygJH2vFqq5exQ.png', '2025-05-22 05:16:12', '2025-05-22 05:16:12'),
	(9, 6, 'product_images/XauuplwucWDj9jPrP9fGZw3VdmaGlkbdtwrgWZq2.png', '2025-05-22 05:16:12', '2025-05-22 05:16:12'),
	(10, 4, 'product_images/aIxGXvC5T1I4RuGT2NytymG0nax09GAec2npvMG1.jpg', '2025-05-22 05:18:11', '2025-05-22 05:18:11'),
	(11, 4, 'product_images/yhSRk00uaWRCXUEL7vJEJO4WcsYAmEA5gDDC56lW.png', '2025-05-22 05:18:11', '2025-05-22 05:18:11'),
	(12, 7, 'product_images/22T0O9ggCv4XN5LDT1oCrDVSW6Zd0FnzFnQlSIp7.png', '2025-05-23 01:36:48', '2025-05-23 01:36:48'),
	(13, 7, 'product_images/yOzs2wOfSm7Hc1cflHBRSOlfBmAm8s2mh0bykGK6.png', '2025-05-23 01:36:48', '2025-05-23 01:36:48'),
	(14, 7, 'product_images/W4rLkNiiTzBanmB5zs43kLT1SSHyOFy8Wj6lbBBg.png', '2025-05-23 01:36:48', '2025-05-23 01:36:48');

-- Dumping data for table artcart_project.sessions: ~2 rows (approximately)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('SWfb3x0DSp17hhV9F3DR4fc8X5oTEd30kbexO3Cj', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiU1lRSHVTRVpBU1NIOUx1TWxYaWpTOEgwRk9Jcm1taGVoS0plNmc1dCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9vcmRlcnMvOCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czo0OiJhdXRoIjthOjE6e3M6MjE6InBhc3N3b3JkX2NvbmZpcm1lZF9hdCI7aToxNzQ3OTk2MDcwO319', 1748001467),
	('XBNKFo1w02a7GWmF9Xd8mOajHQlsdQACzW6WcDXu', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOFZVZFFkbkVPekZXWGV3V3VTV0tMSzlySGdUQWpGM1BYY3JLeFd1TCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9mcm9udGVuZC9wcm9kdWN0cyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1748001875);

-- Dumping data for table artcart_project.users: ~0 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Test User', 'test@example.com', NULL, '$2y$12$2hqyk22oumT4.d4AT3ylDuKoEo8rtcdNplZcpKO.7L3yDEVzQNZ2O', NULL, '2025-05-21 02:53:58', '2025-05-21 02:53:58');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

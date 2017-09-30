-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.14 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.4.0.5174
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table laravel-base.admin_menu
CREATE TABLE IF NOT EXISTS `admin_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `order` int(11) NOT NULL DEFAULT '0',
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uri` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel-base.admin_menu: 10 rows
/*!40000 ALTER TABLE `admin_menu` DISABLE KEYS */;
INSERT INTO `admin_menu` (`id`, `parent_id`, `order`, `title`, `icon`, `uri`, `created_at`, `updated_at`) VALUES
	(1, 0, 1, 'Index', 'fa-bar-chart', '/', NULL, NULL),
	(2, 0, 2, 'Admin', 'fa-tasks', NULL, NULL, NULL),
	(3, 2, 3, 'Users', 'fa-users', 'auth/users', NULL, NULL),
	(4, 2, 4, 'Roles', 'fa-user', 'auth/roles', NULL, NULL),
	(5, 2, 5, 'Permissions', 'fa-ban', 'auth/permissions', NULL, NULL),
	(6, 2, 6, 'Menu', 'fa-bars', 'auth/menu', NULL, NULL),
	(7, 2, 7, 'Log', 'fa-history', 'auth/logs', NULL, NULL),
	(8, 0, 8, 'Logs', 'fa-file', 'logs/', NULL, NULL),
	(9, 0, 9, 'Users Test', 'fa-users', 'users', NULL, NULL),
	(10, 0, 10, 'Jobs', 'fa-linkedin', 'jobs', NULL, NULL);
/*!40000 ALTER TABLE `admin_menu` ENABLE KEYS */;

-- Dumping structure for table laravel-base.admin_operation_log
CREATE TABLE IF NOT EXISTS `admin_operation_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `input` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_operation_log_user_id_index` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=358 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel-base.admin_operation_log: 357 rows
/*!40000 ALTER TABLE `admin_operation_log` DISABLE KEYS */;
INSERT INTO `admin_operation_log` (`id`, `user_id`, `path`, `method`, `ip`, `input`, `created_at`, `updated_at`) VALUES
	(1, 1, 'admin', 'GET', '127.0.0.1', '[]', '2017-09-20 01:20:47', '2017-09-20 01:20:47'),
	(2, 1, 'admin/auth/users', 'GET', '127.0.0.1', '{"_pjax":"#pjax-container"}', '2017-09-20 01:21:11', '2017-09-20 01:21:11'),
	(3, 1, 'admin/auth/permissions', 'GET', '127.0.0.1', '{"_pjax":"#pjax-container"}', '2017-09-20 01:25:45', '2017-09-20 01:25:45'),
	(4, 1, 'admin/auth/roles', 'GET', '127.0.0.1', '{"_pjax":"#pjax-container"}', '2017-09-20 01:26:02', '2017-09-20 01:26:02'),
	(5, 1, 'admin/auth/permissions', 'GET', '127.0.0.1', '{"_pjax":"#pjax-container"}', '2017-09-20 01:26:13', '2017-09-20 01:26:13'),
	(6, 1, 'admin/auth/users', 'GET', '127.0.0.1', '{"_pjax":"#pjax-container"}', '2017-09-20 01:26:28', '2017-09-20 01:26:28'),
	(7, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '{"_pjax":"#pjax-container"}', '2017-09-20 01:26:31', '2017-09-20 01:26:31'),
	(8, 1, 'admin/auth/menu/3/edit', 'GET', '127.0.0.1', '{"_pjax":"#pjax-container"}', '2017-09-20 01:27:12', '2017-09-20 01:27:12'),
	(9, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '{"_pjax":"#pjax-container"}', '2017-09-20 01:27:28', '2017-09-20 01:27:28'),
	(10, 1, 'admin/auth/menu/5/edit', 'GET', '127.0.0.1', '{"_pjax":"#pjax-container"}', '2017-09-20 01:27:34', '2017-09-20 01:27:34'),
	(11, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '{"_pjax":"#pjax-container"}', '2017-09-20 01:27:37', '2017-09-20 01:27:37'),
	(12, 1, 'admin/auth/menu/4/edit', 'GET', '127.0.0.1', '{"_pjax":"#pjax-container"}', '2017-09-20 01:27:44', '2017-09-20 01:27:44'),
	(13, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '{"_pjax":"#pjax-container"}', '2017-09-20 01:27:48', '2017-09-20 01:27:48'),
	(14, 1, 'admin/logs', 'GET', '127.0.0.1', '[]', '2017-09-20 01:46:18', '2017-09-20 01:46:18'),
	(15, 1, 'admin/logs', 'GET', '127.0.0.1', '[]', '2017-09-20 02:19:56', '2017-09-20 02:19:56'),
	(16, 1, 'admin/logs', 'GET', '127.0.0.1', '{"_pjax":"#pjax-container"}', '2017-09-20 02:20:00', '2017-09-20 02:20:00'),
	(17, 1, 'admin/logs/laravel.log/tail', 'GET', '127.0.0.1', '{"offset":"111802"}', '2017-09-20 02:20:29', '2017-09-20 02:20:29'),
	(18, 1, 'admin/logs/laravel.log/tail', 'GET', '127.0.0.1', '{"offset":"111802"}', '2017-09-20 02:20:31', '2017-09-20 02:20:31'),
	(19, 1, 'admin/logs/laravel.log/tail', 'GET', '127.0.0.1', '{"offset":"111802"}', '2017-09-20 02:20:33', '2017-09-20 02:20:33'),
	(20, 1, 'admin', 'GET', '127.0.0.1', '{"_pjax":"#pjax-container"}', '2017-09-20 02:20:41', '2017-09-20 02:20:41'),
	(21, 1, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2017-09-20 15:28:45', '2017-09-20 15:28:45'),
	(22, 1, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2017-09-20 17:46:15', '2017-09-20 17:46:15'),
	(23, 1, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2017-09-20 17:50:55', '2017-09-20 17:50:55'),
	(24, 1, 'admin/auth/setting', 'PUT', '127.0.0.1', '{"name":"Administrator","password":"$2y$10$DYGQdSIiZlyLb18e\\/O2UrepTt6VOCRsfJS5OAi\\/H7tezrtFgZr\\/qe","password_confirmation":"$2y$10$DYGQdSIiZlyLb18e\\/O2UrepTt6VOCRsfJS5OAi\\/H7tezrtFgZr\\/qe","_token":"ZEg15RJKdaWhW8YyAsDYgxL5uSKVQi1qTV1J4e0c","_method":"PUT","_previous_":"http:\\/\\/laravel-base.localhost.com\\/admin\\/auth\\/login"}', '2017-09-20 17:52:22', '2017-09-20 17:52:22'),
	(25, 1, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2017-09-20 17:52:23', '2017-09-20 17:52:23'),
	(26, 1, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2017-09-20 17:54:14', '2017-09-20 17:54:14'),
	(27, 1, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2017-09-20 17:55:50', '2017-09-20 17:55:50'),
	(28, 1, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2017-09-20 20:28:54', '2017-09-20 20:28:54'),
	(29, 1, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2017-09-21 14:03:51', '2017-09-21 14:03:51'),
	(30, 1, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2017-09-21 15:24:50', '2017-09-21 15:24:50'),
	(31, 1, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2017-09-21 15:25:10', '2017-09-21 15:25:10'),
	(32, 1, 'admin/auth/setting', 'PUT', '127.0.0.1', '{"name":"Administrator","password":"$2y$10$DYGQdSIiZlyLb18e\\/O2UrepTt6VOCRsfJS5OAi\\/H7tezrtFgZr\\/qe","password_confirmation":"$2y$10$DYGQdSIiZlyLb18e\\/O2UrepTt6VOCRsfJS5OAi\\/H7tezrtFgZr\\/qe","_token":"VyMsQmMlv4fjCTEtB0e4IhHWUgPQF4yeTwC5Vpc0","_method":"PUT","_previous_":"http:\\/\\/laravel-base.localhost.com\\/admin\\/auth\\/login"}', '2017-09-21 15:25:45', '2017-09-21 15:25:45'),
	(33, 1, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2017-09-21 15:25:46', '2017-09-21 15:25:46'),
	(34, 1, 'admin/auth/setting', 'PUT', '127.0.0.1', '{"name":"Administrator","password":"$2y$10$DYGQdSIiZlyLb18e\\/O2UrepTt6VOCRsfJS5OAi\\/H7tezrtFgZr\\/qe","password_confirmation":"$2y$10$DYGQdSIiZlyLb18e\\/O2UrepTt6VOCRsfJS5OAi\\/H7tezrtFgZr\\/qe","_token":"VyMsQmMlv4fjCTEtB0e4IhHWUgPQF4yeTwC5Vpc0","_method":"PUT"}', '2017-09-21 15:27:15', '2017-09-21 15:27:15'),
	(35, 1, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2017-09-21 15:27:16', '2017-09-21 15:27:16'),
	(36, 1, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2017-09-21 15:36:01', '2017-09-21 15:36:01'),
	(37, 1, 'admin/auth/permissions', 'GET', '127.0.0.1', '{"_pjax":"#pjax-container"}', '2017-09-21 15:46:46', '2017-09-21 15:46:46'),
	(38, 1, 'admin/auth/permissions', 'GET', '127.0.0.1', '[]', '2017-09-21 15:53:00', '2017-09-21 15:53:00'),
	(39, 1, 'admin/auth/permissions/7/edit', 'GET', '127.0.0.1', '{"_pjax":"#pjax-container"}', '2017-09-21 15:53:06', '2017-09-21 15:53:06'),
	(40, 1, 'admin/auth/permissions/7', 'PUT', '127.0.0.1', '{"slug":"test","name":"Test","http_method":["GET","POST",null],"http_path":"\\/auth\\/roles\\r\\n\\/auth\\/permissions\\r\\n\\/auth\\/menu\\r\\n\\/auth\\/logs","_token":"VyMsQmMlv4fjCTEtB0e4IhHWUgPQF4yeTwC5Vpc0","_method":"PUT","_previous_":"http:\\/\\/laravel-base.localhost.com\\/admin\\/auth\\/permissions"}', '2017-09-21 15:53:22', '2017-09-21 15:53:22'),
	(41, 1, 'admin/auth/permissions', 'GET', '127.0.0.1', '[]', '2017-09-21 15:53:23', '2017-09-21 15:53:23'),
	(42, 1, 'admin/auth/setting', 'GET', '127.0.0.1', '{"_pjax":"#pjax-container"}', '2017-09-21 16:05:47', '2017-09-21 16:05:47'),
	(43, 1, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2017-09-21 16:07:05', '2017-09-21 16:07:05'),
	(44, 1, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2017-09-21 16:28:56', '2017-09-21 16:28:56'),
	(45, 1, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2017-09-21 16:29:34', '2017-09-21 16:29:34'),
	(46, 1, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2017-09-21 16:29:38', '2017-09-21 16:29:38'),
	(47, 1, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2017-09-21 16:31:51', '2017-09-21 16:31:51'),
	(48, 1, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2017-09-21 16:33:14', '2017-09-21 16:33:14'),
	(49, 1, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2017-09-21 16:34:29', '2017-09-21 16:34:29'),
	(50, 1, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2017-09-22 00:15:33', '2017-09-22 00:15:33'),
	(51, 1, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2017-09-22 00:27:34', '2017-09-22 00:27:34'),
	(52, 1, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2017-09-22 00:41:43', '2017-09-22 00:41:43'),
	(53, 1, 'admin/auth/setting', 'PUT', '127.0.0.1', '{"name":"Administrator","password":"$2y$10$DYGQdSIiZlyLb18e\\/O2UrepTt6VOCRsfJS5OAi\\/H7tezrtFgZr\\/qe","password_confirmation":"$2y$10$DYGQdSIiZlyLb18e\\/O2UrepTt6VOCRsfJS5OAi\\/H7tezrtFgZr\\/qe","_token":"FJJymQBBhsQejlTLdohsmO8C85RvLB4xgYYJsiEt","_method":"PUT","_previous_":"http:\\/\\/laravel-base.localhost.com\\/admin\\/auth\\/login"}', '2017-09-22 00:42:37', '2017-09-22 00:42:37'),
	(54, 1, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2017-09-22 00:42:38', '2017-09-22 00:42:38'),
	(55, 1, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2017-09-22 00:43:30', '2017-09-22 00:43:30'),
	(56, 1, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2017-09-22 00:44:57', '2017-09-22 00:44:57'),
	(57, 1, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2017-09-22 00:45:20', '2017-09-22 00:45:20'),
	(58, 1, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2017-09-22 00:54:50', '2017-09-22 00:54:50'),
	(59, 1, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2017-09-22 00:55:07', '2017-09-22 00:55:07'),
	(60, 1, 'admin/auth/setting', 'PUT', '127.0.0.1', '{"name":"Administrator","password":"$2y$10$DYGQdSIiZlyLb18e\\/O2UrepTt6VOCRsfJS5OAi\\/H7tezrtFgZr\\/qe","password_confirmation":"$2y$10$DYGQdSIiZlyLb18e\\/O2UrepTt6VOCRsfJS5OAi\\/H7tezrtFgZr\\/qe","_token":"FJJymQBBhsQejlTLdohsmO8C85RvLB4xgYYJsiEt","_method":"PUT","_previous_":"http:\\/\\/laravel-base.localhost.com\\/admin\\/auth\\/login"}', '2017-09-22 00:55:31', '2017-09-22 00:55:31'),
	(61, 1, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2017-09-22 00:55:32', '2017-09-22 00:55:32'),
	(62, 1, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2017-09-22 03:50:07', '2017-09-22 03:50:07'),
	(63, 1, 'admin/users', 'GET', '127.0.0.1', '[]', '2017-09-22 03:50:12', '2017-09-22 03:50:12'),
	(64, 1, 'admin/users', 'GET', '127.0.0.1', '[]', '2017-09-22 03:59:47', '2017-09-22 03:59:47'),
	(65, 1, 'admin', 'GET', '127.0.0.1', '{"_pjax":"#pjax-container"}', '2017-09-22 03:59:50', '2017-09-22 03:59:50'),
	(66, 1, 'admin/auth/users', 'GET', '127.0.0.1', '{"_pjax":"#pjax-container"}', '2017-09-22 03:59:54', '2017-09-22 03:59:54'),
	(67, 1, 'admin/logs', 'GET', '127.0.0.1', '{"_pjax":"#pjax-container"}', '2017-09-22 04:00:01', '2017-09-22 04:00:01'),
	(68, 1, 'admin/auth/roles', 'GET', '127.0.0.1', '{"_pjax":"#pjax-container"}', '2017-09-22 04:00:08', '2017-09-22 04:00:08'),
	(69, 1, 'admin/auth/permissions', 'GET', '127.0.0.1', '{"_pjax":"#pjax-container"}', '2017-09-22 04:00:10', '2017-09-22 04:00:10'),
	(70, 1, 'admin/auth/permissions', 'GET', '127.0.0.1', '[]', '2017-09-22 04:02:37', '2017-09-22 04:02:37'),
	(71, 1, 'admin/auth/permissions', 'GET', '127.0.0.1', '[]', '2017-09-22 04:02:46', '2017-09-22 04:02:46'),
	(72, 1, 'admin/users', 'GET', '127.0.0.1', '{"_pjax":"#pjax-container"}', '2017-09-22 04:02:49', '2017-09-22 04:02:49'),
	(73, 1, 'admin/users/create', 'GET', '127.0.0.1', '{"_pjax":"#pjax-container"}', '2017-09-22 04:02:53', '2017-09-22 04:02:53'),
	(74, 1, 'admin/users', 'GET', '127.0.0.1', '[]', '2017-09-22 04:02:54', '2017-09-22 04:02:54'),
	(75, 1, 'admin/users', 'GET', '127.0.0.1', '[]', '2017-09-25 14:49:45', '2017-09-25 14:49:45'),
	(76, 1, 'admin/users/create', 'GET', '127.0.0.1', '{"_pjax":"#pjax-container"}', '2017-09-25 14:49:52', '2017-09-25 14:49:52'),
	(77, 1, 'admin/users', 'GET', '127.0.0.1', '[]', '2017-09-25 14:49:53', '2017-09-25 14:49:53'),
	(78, 1, 'admin/users/create', 'GET', '127.0.0.1', '{"_pjax":"#pjax-container"}', '2017-09-25 15:11:30', '2017-09-25 15:11:30'),
	(79, 1, 'admin/users', 'GET', '127.0.0.1', '[]', '2017-09-25 15:11:30', '2017-09-25 15:11:30'),
	(80, 1, 'admin/logs', 'GET', '127.0.0.1', '[]', '2017-09-25 15:28:38', '2017-09-25 15:28:38'),
	(81, 1, 'admin/logs', 'GET', '127.0.0.1', '{"_pjax":"#pjax-container"}', '2017-09-25 15:28:52', '2017-09-25 15:28:52'),
	(82, 1, 'admin/users', 'GET', '127.0.0.1', '[]', '2017-09-25 15:41:03', '2017-09-25 15:41:03'),
	(83, 1, 'admin/users/create', 'GET', '127.0.0.1', '{"_pjax":"#pjax-container"}', '2017-09-25 15:41:11', '2017-09-25 15:41:11'),
	(84, 1, 'admin/users', 'GET', '127.0.0.1', '[]', '2017-09-25 15:52:07', '2017-09-25 15:52:07'),
	(85, 1, 'admin/users/create', 'GET', '127.0.0.1', '{"_pjax":"#pjax-container"}', '2017-09-25 15:52:12', '2017-09-25 15:52:12'),
	(86, 1, 'admin/users/create', 'GET', '127.0.0.1', '{"_pjax":"#pjax-container"}', '2017-09-25 15:56:51', '2017-09-25 15:56:51'),
	(87, 1, 'admin/users/create', 'GET', '127.0.0.1', '[]', '2017-09-25 15:57:11', '2017-09-25 15:57:11'),
	(88, 1, 'admin/users', 'GET', '127.0.0.1', '[]', '2017-09-25 15:57:47', '2017-09-25 15:57:47'),
	(89, 1, 'admin/users', 'GET', '127.0.0.1', '[]', '2017-09-25 15:57:58', '2017-09-25 15:57:58'),
	(90, 1, 'admin/users/create', 'GET', '127.0.0.1', '{"_pjax":"#pjax-container"}', '2017-09-25 15:58:02', '2017-09-25 15:58:02'),
	(91, 1, 'admin/users', 'GET', '127.0.0.1', '[]', '2017-09-25 15:58:52', '2017-09-25 15:58:52'),
	(92, 1, 'admin/users', 'GET', '127.0.0.1', '[]', '2017-09-25 15:58:58', '2017-09-25 15:58:58'),
	(93, 1, 'admin/users/create', 'GET', '127.0.0.1', '{"_pjax":"#pjax-container"}', '2017-09-25 15:59:01', '2017-09-25 15:59:01'),
	(94, 1, 'admin/users', 'GET', '127.0.0.1', '[]', '2017-09-25 18:13:27', '2017-09-25 18:13:27'),
	(95, 1, 'admin/users/create', 'GET', '127.0.0.1', '[]', '2017-09-25 18:13:36', '2017-09-25 18:13:36'),
	(96, 1, 'admin/users', 'GET', '127.0.0.1', '[]', '2017-09-25 18:18:57', '2017-09-25 18:18:57'),
	(97, 1, 'admin/users/create', 'GET', '127.0.0.1', '{"_pjax":"#pjax-container"}', '2017-09-25 18:19:02', '2017-09-25 18:19:02'),
	(98, 1, 'admin/users/create', 'GET', '127.0.0.1', '[]', '2017-09-25 18:21:26', '2017-09-25 18:21:26'),
	(99, 1, 'admin/users', 'POST', '127.0.0.1', '{"name":"Rodrigo Butta","email":"rbutta@gmail.com","_token":"Wpx7JywBVY80og6aobByFJm2fSbEe2Ek8eaUGjxY","_previous_":"http:\\/\\/laravel-base.localhost.com\\/admin\\/users"}', '2017-09-25 18:23:52', '2017-09-25 18:23:52'),
	(100, 1, 'admin/users', 'GET', '127.0.0.1', '[]', '2017-09-25 18:23:52', '2017-09-25 18:23:52'),
	(101, 1, 'admin/users/1/edit', 'GET', '127.0.0.1', '{"_pjax":"#pjax-container"}', '2017-09-25 18:24:01', '2017-09-25 18:24:01'),
	(102, 1, 'admin/users/1', 'PUT', '127.0.0.1', '{"name":"Rodrigo Butta ed","email":"rbutta@gmail.com","_token":"Wpx7JywBVY80og6aobByFJm2fSbEe2Ek8eaUGjxY","_method":"PUT","_previous_":"http:\\/\\/laravel-base.localhost.com\\/admin\\/users"}', '2017-09-25 18:25:08', '2017-09-25 18:25:08'),
	(103, 1, 'admin/users', 'GET', '127.0.0.1', '[]', '2017-09-25 18:25:08', '2017-09-25 18:25:08'),
	(104, 1, 'admin/users/1/edit', 'GET', '127.0.0.1', '{"_pjax":"#pjax-container"}', '2017-09-25 18:25:12', '2017-09-25 18:25:12'),
	(105, 1, 'admin/users/1', 'PUT', '127.0.0.1', '{"name":"Rodrigo Butta","email":"rbutta@gmail.com","_token":"Wpx7JywBVY80og6aobByFJm2fSbEe2Ek8eaUGjxY","_method":"PUT","_previous_":"http:\\/\\/laravel-base.localhost.com\\/admin\\/users"}', '2017-09-25 18:25:16', '2017-09-25 18:25:16'),
	(106, 1, 'admin/users', 'GET', '127.0.0.1', '[]', '2017-09-25 18:25:17', '2017-09-25 18:25:17'),
	(107, 1, 'admin/users', 'GET', '127.0.0.1', '[]', '2017-09-25 19:33:49', '2017-09-25 19:33:49'),
	(108, 1, 'admin/job', 'GET', '127.0.0.1', '[]', '2017-09-25 19:43:16', '2017-09-25 19:43:16'),
	(109, 1, 'admin/job', 'GET', '127.0.0.1', '[]', '2017-09-25 19:51:52', '2017-09-25 19:51:52'),
	(110, 1, 'admin/job', 'GET', '127.0.0.1', '[]', '2017-09-25 19:52:43', '2017-09-25 19:52:43'),
	(111, 1, 'admin/job', 'GET', '127.0.0.1', '[]', '2017-09-25 20:02:19', '2017-09-25 20:02:19'),
	(112, 1, 'admin/job', 'GET', '127.0.0.1', '[]', '2017-09-25 20:02:51', '2017-09-25 20:02:51'),
	(113, 1, 'admin/job', 'GET', '127.0.0.1', '[]', '2017-09-25 20:13:05', '2017-09-25 20:13:05'),
	(114, 1, 'admin/job', 'GET', '127.0.0.1', '[]', '2017-09-25 20:17:59', '2017-09-25 20:17:59'),
	(115, 1, 'admin/job', 'GET', '127.0.0.1', '[]', '2017-09-25 20:19:48', '2017-09-25 20:19:48'),
	(116, 1, 'admin/jobs/create', 'GET', '127.0.0.1', '[]', '2017-09-25 20:19:55', '2017-09-25 20:19:55'),
	(117, 1, 'admin/job', 'GET', '127.0.0.1', '[]', '2017-09-25 20:23:20', '2017-09-25 20:23:20'),
	(118, 1, 'admin/jobs/create', 'GET', '127.0.0.1', '[]', '2017-09-25 20:23:23', '2017-09-25 20:23:23'),
	(119, 1, 'admin/jobs/create', 'GET', '127.0.0.1', '[]', '2017-09-25 20:25:35', '2017-09-25 20:25:35'),
	(120, 1, 'admin/jobs/create', 'GET', '127.0.0.1', '[]', '2017-09-25 20:25:51', '2017-09-25 20:25:51'),
	(121, 1, 'admin/jobs/create', 'GET', '127.0.0.1', '[]', '2017-09-25 20:25:57', '2017-09-25 20:25:57'),
	(122, 1, 'admin/jobs', 'POST', '127.0.0.1', '{"title":"Job 1111","description":"kasd jaskldj alkd jakld jaskla","_token":"Wpx7JywBVY80og6aobByFJm2fSbEe2Ek8eaUGjxY"}', '2017-09-25 20:26:20', '2017-09-25 20:26:20'),
	(123, 1, 'admin/jobs/create', 'GET', '127.0.0.1', '[]', '2017-09-25 20:26:21', '2017-09-25 20:26:21'),
	(124, 1, 'admin/jobs', 'POST', '127.0.0.1', '{"title":"Job 1111","description":"kasd jaskldj alkd jakld jaskla","_token":"Wpx7JywBVY80og6aobByFJm2fSbEe2Ek8eaUGjxY"}', '2017-09-25 20:27:17', '2017-09-25 20:27:17'),
	(125, 1, 'admin/jobs/create', 'GET', '127.0.0.1', '[]', '2017-09-25 20:27:19', '2017-09-25 20:27:19'),
	(126, 1, 'admin/jobs', 'POST', '127.0.0.1', '{"title":"Job 1111","description":"kasd jaskldj alkd jakld jaskla","_token":"Wpx7JywBVY80og6aobByFJm2fSbEe2Ek8eaUGjxY"}', '2017-09-25 20:27:34', '2017-09-25 20:27:34'),
	(127, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-25 20:27:34', '2017-09-25 20:27:34'),
	(128, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-25 20:28:59', '2017-09-25 20:28:59'),
	(129, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-25 20:29:55', '2017-09-25 20:29:55'),
	(130, 1, 'admin/jobs/1/edit', 'GET', '127.0.0.1', '{"_pjax":"#pjax-container"}', '2017-09-25 20:30:01', '2017-09-25 20:30:01'),
	(131, 1, 'admin/jobs/1', 'PUT', '127.0.0.1', '{"user_id":null,"title":"Job 1111","description":"kasd jaskldj alkd jakld jaskla editado","_token":"Wpx7JywBVY80og6aobByFJm2fSbEe2Ek8eaUGjxY","_method":"PUT","_previous_":"http:\\/\\/laravel-base.localhost.com\\/admin\\/jobs"}', '2017-09-25 20:32:14', '2017-09-25 20:32:14'),
	(132, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-25 20:32:15', '2017-09-25 20:32:15'),
	(133, 1, 'admin/jobs/1/edit', 'GET', '127.0.0.1', '{"_pjax":"#pjax-container"}', '2017-09-25 20:32:41', '2017-09-25 20:32:41'),
	(134, 1, 'admin/jobs/1', 'PUT', '127.0.0.1', '{"user_id":null,"title":"Job 1111 nombre 2","description":"kasd jaskldj alkd jakld jaskla editado","_token":"Wpx7JywBVY80og6aobByFJm2fSbEe2Ek8eaUGjxY","_method":"PUT","_previous_":"http:\\/\\/laravel-base.localhost.com\\/admin\\/jobs"}', '2017-09-25 20:32:48', '2017-09-25 20:32:48'),
	(135, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-25 20:32:48', '2017-09-25 20:32:48'),
	(136, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-25 20:34:15', '2017-09-25 20:34:15'),
	(137, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-25 20:35:39', '2017-09-25 20:35:39'),
	(138, 1, 'admin/jobs/create', 'GET', '127.0.0.1', '{"_pjax":"#pjax-container"}', '2017-09-25 20:35:42', '2017-09-25 20:35:42'),
	(139, 1, 'admin/jobs', 'POST', '127.0.0.1', '{"user_id":null,"title":"Job nro 2","description":"sd d dsd da da sdasads","_token":"Wpx7JywBVY80og6aobByFJm2fSbEe2Ek8eaUGjxY","_previous_":"http:\\/\\/laravel-base.localhost.com\\/admin\\/jobs"}', '2017-09-25 20:35:49', '2017-09-25 20:35:49'),
	(140, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-25 20:35:50', '2017-09-25 20:35:50'),
	(141, 1, 'admin/jobs/create', 'GET', '127.0.0.1', '{"_pjax":"#pjax-container"}', '2017-09-25 20:35:52', '2017-09-25 20:35:52'),
	(142, 1, 'admin/jobs', 'POST', '127.0.0.1', '{"user_id":null,"title":"Job nro 3","description":"ds dasadsadsdas  daads das","_token":"Wpx7JywBVY80og6aobByFJm2fSbEe2Ek8eaUGjxY","_previous_":"http:\\/\\/laravel-base.localhost.com\\/admin\\/jobs"}', '2017-09-25 20:35:58', '2017-09-25 20:35:58'),
	(143, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-25 20:35:59', '2017-09-25 20:35:59'),
	(144, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-25 20:42:42', '2017-09-25 20:42:42'),
	(145, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-25 20:44:33', '2017-09-25 20:44:33'),
	(146, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-25 20:46:22', '2017-09-25 20:46:22'),
	(147, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-25 21:00:27', '2017-09-25 21:00:27'),
	(148, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-25 21:06:54', '2017-09-25 21:06:54'),
	(149, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-25 21:13:18', '2017-09-25 21:13:18'),
	(150, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-25 21:13:41', '2017-09-25 21:13:41'),
	(151, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-25 21:14:23', '2017-09-25 21:14:23'),
	(152, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-25 21:14:43', '2017-09-25 21:14:43'),
	(153, 1, 'admin/jobs/1', 'PUT', '127.0.0.1', '{"_method":"PUT","_token":"Wpx7JywBVY80og6aobByFJm2fSbEe2Ek8eaUGjxY","_orderable":"0"}', '2017-09-25 21:14:47', '2017-09-25 21:14:47'),
	(154, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-25 21:15:27', '2017-09-25 21:15:27'),
	(155, 1, 'admin/jobs/1', 'PUT', '127.0.0.1', '{"_method":"PUT","_token":"Wpx7JywBVY80og6aobByFJm2fSbEe2Ek8eaUGjxY","_orderable":"0"}', '2017-09-25 21:18:20', '2017-09-25 21:18:20'),
	(156, 1, 'admin/jobs/2', 'PUT', '127.0.0.1', '{"_method":"PUT","_token":"Wpx7JywBVY80og6aobByFJm2fSbEe2Ek8eaUGjxY","_orderable":"0"}', '2017-09-25 21:19:08', '2017-09-25 21:19:08'),
	(157, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-25 21:21:43', '2017-09-25 21:21:43'),
	(158, 1, 'admin/jobs/2', 'PUT', '127.0.0.1', '{"_method":"PUT","_token":"Wpx7JywBVY80og6aobByFJm2fSbEe2Ek8eaUGjxY","_orderable":"0"}', '2017-09-25 21:21:58', '2017-09-25 21:21:58'),
	(159, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-25 21:34:58', '2017-09-25 21:34:58'),
	(160, 1, 'admin/jobs/1', 'PUT', '127.0.0.1', '{"_method":"PUT","_token":"Wpx7JywBVY80og6aobByFJm2fSbEe2Ek8eaUGjxY","_orderable":"0"}', '2017-09-25 21:35:01', '2017-09-25 21:35:01'),
	(161, 1, 'admin/jobs', 'GET', '127.0.0.1', '{"_pjax":"#pjax-container"}', '2017-09-25 21:35:29', '2017-09-25 21:35:29'),
	(162, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-25 21:35:44', '2017-09-25 21:35:44'),
	(163, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-25 21:36:10', '2017-09-25 21:36:10'),
	(164, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-25 21:38:33', '2017-09-25 21:38:33'),
	(165, 1, 'admin/jobs/3', 'PUT', '127.0.0.1', '{"_method":"PUT","_token":"Wpx7JywBVY80og6aobByFJm2fSbEe2Ek8eaUGjxY","_orderable":"1"}', '2017-09-25 21:38:37', '2017-09-25 21:38:37'),
	(166, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-25 21:38:39', '2017-09-25 21:38:39'),
	(167, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-25 21:41:21', '2017-09-25 21:41:21'),
	(168, 1, 'admin/jobs/1', 'PUT', '127.0.0.1', '{"_method":"PUT","_token":"Wpx7JywBVY80og6aobByFJm2fSbEe2Ek8eaUGjxY","_orderable":"1"}', '2017-09-25 21:41:25', '2017-09-25 21:41:25'),
	(169, 1, 'admin/jobs', 'GET', '127.0.0.1', '{"_pjax":"#pjax-container"}', '2017-09-25 21:41:30', '2017-09-25 21:41:30'),
	(170, 1, 'admin/jobs/3', 'PUT', '127.0.0.1', '{"_method":"PUT","_token":"Wpx7JywBVY80og6aobByFJm2fSbEe2Ek8eaUGjxY","_orderable":"1"}', '2017-09-25 21:41:51', '2017-09-25 21:41:51'),
	(171, 1, 'admin/jobs', 'GET', '127.0.0.1', '{"_pjax":"#pjax-container"}', '2017-09-25 21:41:52', '2017-09-25 21:41:52'),
	(172, 1, 'admin/jobs/create', 'GET', '127.0.0.1', '{"_pjax":"#pjax-container"}', '2017-09-25 21:53:12', '2017-09-25 21:53:12'),
	(173, 1, 'admin/jobs', 'POST', '127.0.0.1', '{"user_id":null,"title":"Job 4","description":"asdklasdk asdklasd","_token":"Wpx7JywBVY80og6aobByFJm2fSbEe2Ek8eaUGjxY","_previous_":"http:\\/\\/laravel-base.localhost.com\\/admin\\/jobs"}', '2017-09-25 21:53:18', '2017-09-25 21:53:18'),
	(174, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-25 21:53:19', '2017-09-25 21:53:19'),
	(175, 1, 'admin/jobs/1', 'PUT', '127.0.0.1', '{"_method":"PUT","_token":"Wpx7JywBVY80og6aobByFJm2fSbEe2Ek8eaUGjxY","_orderable":"1"}', '2017-09-25 21:53:24', '2017-09-25 21:53:24'),
	(176, 1, 'admin/jobs', 'GET', '127.0.0.1', '{"_pjax":"#pjax-container"}', '2017-09-25 21:53:24', '2017-09-25 21:53:24'),
	(177, 1, 'admin/jobs/1', 'PUT', '127.0.0.1', '{"_method":"PUT","_token":"Wpx7JywBVY80og6aobByFJm2fSbEe2Ek8eaUGjxY","_orderable":"1"}', '2017-09-25 21:53:26', '2017-09-25 21:53:26'),
	(178, 1, 'admin/jobs', 'GET', '127.0.0.1', '{"_pjax":"#pjax-container"}', '2017-09-25 21:53:27', '2017-09-25 21:53:27'),
	(179, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-26 12:47:01', '2017-09-26 12:47:01'),
	(180, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-26 13:43:10', '2017-09-26 13:43:10'),
	(181, 1, 'admin/jobs/1', 'PUT', '127.0.0.1', '{"name":"description","value":"kasd jaskldj alkd jakld jaskla editado dede grid","pk":"1","_token":"yxqIZR9G6L7ech63SabEnwViydLXp4UreetlQIJO","_editable":"1","_method":"PUT"}', '2017-09-26 13:43:22', '2017-09-26 13:43:22'),
	(182, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-26 13:43:30', '2017-09-26 13:43:30'),
	(183, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-26 13:46:53', '2017-09-26 13:46:53'),
	(184, 1, 'admin/jobs/1', 'PUT', '127.0.0.1', '{"visible":"on","_token":"yxqIZR9G6L7ech63SabEnwViydLXp4UreetlQIJO","_method":"PUT"}', '2017-09-26 13:46:57', '2017-09-26 13:46:57'),
	(185, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-26 13:48:03', '2017-09-26 13:48:03'),
	(186, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-26 13:48:44', '2017-09-26 13:48:44'),
	(187, 1, 'admin/jobs/2', 'PUT', '127.0.0.1', '{"visible":"off","_token":"yxqIZR9G6L7ech63SabEnwViydLXp4UreetlQIJO","_method":"PUT"}', '2017-09-26 13:48:47', '2017-09-26 13:48:47'),
	(188, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-26 13:49:05', '2017-09-26 13:49:05'),
	(189, 1, 'admin/jobs/2', 'PUT', '127.0.0.1', '{"visible":"off","_token":"yxqIZR9G6L7ech63SabEnwViydLXp4UreetlQIJO","_method":"PUT"}', '2017-09-26 13:49:08', '2017-09-26 13:49:08'),
	(190, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-26 13:50:03', '2017-09-26 13:50:03'),
	(191, 1, 'admin/jobs/2', 'PUT', '127.0.0.1', '{"published":"on","_token":"yxqIZR9G6L7ech63SabEnwViydLXp4UreetlQIJO","_method":"PUT"}', '2017-09-26 13:50:09', '2017-09-26 13:50:09'),
	(192, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-26 13:53:33', '2017-09-26 13:53:33'),
	(193, 1, 'admin/jobs/2', 'PUT', '127.0.0.1', '{"published":"on","_token":"yxqIZR9G6L7ech63SabEnwViydLXp4UreetlQIJO","_method":"PUT"}', '2017-09-26 13:53:36', '2017-09-26 13:53:36'),
	(194, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-26 13:54:04', '2017-09-26 13:54:04'),
	(195, 1, 'admin/jobs/3', 'PUT', '127.0.0.1', '{"published":"off","_token":"yxqIZR9G6L7ech63SabEnwViydLXp4UreetlQIJO","_method":"PUT"}', '2017-09-26 13:54:07', '2017-09-26 13:54:07'),
	(196, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-26 13:54:23', '2017-09-26 13:54:23'),
	(197, 1, 'admin/jobs/2', 'PUT', '127.0.0.1', '{"published":"on","_token":"yxqIZR9G6L7ech63SabEnwViydLXp4UreetlQIJO","_method":"PUT"}', '2017-09-26 13:54:27', '2017-09-26 13:54:27'),
	(198, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-26 13:54:31', '2017-09-26 13:54:31'),
	(199, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-26 14:10:58', '2017-09-26 14:10:58'),
	(200, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-26 23:15:54', '2017-09-26 23:15:54'),
	(201, 1, 'admin/jobs/1', 'PUT', '127.0.0.1', '{"_method":"PUT","_token":"cDIN54rtOXf22htTXntFAxWQ5tvUV7M5FRCXTO5L","_orderable":"1"}', '2017-09-26 23:16:04', '2017-09-26 23:16:04'),
	(202, 1, 'admin/jobs', 'GET', '127.0.0.1', '{"_pjax":"#pjax-container"}', '2017-09-26 23:16:04', '2017-09-26 23:16:04'),
	(203, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-26 23:16:07', '2017-09-26 23:16:07'),
	(204, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-26 23:36:51', '2017-09-26 23:36:51'),
	(205, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-26 23:38:05', '2017-09-26 23:38:05'),
	(206, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-26 23:38:35', '2017-09-26 23:38:35'),
	(207, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-26 23:43:32', '2017-09-26 23:43:32'),
	(208, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-26 23:46:00', '2017-09-26 23:46:00'),
	(209, 1, 'admin/jobs/2', 'PUT', '127.0.0.1', '{"_method":"PUT","_token":"cDIN54rtOXf22htTXntFAxWQ5tvUV7M5FRCXTO5L","_orderable":"1"}', '2017-09-26 23:46:27', '2017-09-26 23:46:27'),
	(210, 1, 'admin/jobs', 'GET', '127.0.0.1', '{"_pjax":"#pjax-container"}', '2017-09-26 23:46:28', '2017-09-26 23:46:28'),
	(211, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-26 23:46:33', '2017-09-26 23:46:33'),
	(212, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-26 23:47:47', '2017-09-26 23:47:47'),
	(213, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-26 23:55:16', '2017-09-26 23:55:16'),
	(214, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-26 23:56:34', '2017-09-26 23:56:34'),
	(215, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-26 23:58:35', '2017-09-26 23:58:35'),
	(216, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 00:09:54', '2017-09-27 00:09:54'),
	(217, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 00:13:55', '2017-09-27 00:13:55'),
	(218, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 00:14:09', '2017-09-27 00:14:09'),
	(219, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 00:14:46', '2017-09-27 00:14:46'),
	(220, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 00:19:30', '2017-09-27 00:19:30'),
	(221, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 00:20:04', '2017-09-27 00:20:04'),
	(222, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 00:20:29', '2017-09-27 00:20:29'),
	(223, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 00:20:40', '2017-09-27 00:20:40'),
	(224, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 00:20:51', '2017-09-27 00:20:51'),
	(225, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 00:21:35', '2017-09-27 00:21:35'),
	(226, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 00:22:55', '2017-09-27 00:22:55'),
	(227, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 00:23:42', '2017-09-27 00:23:42'),
	(228, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 00:25:58', '2017-09-27 00:25:58'),
	(229, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 00:28:17', '2017-09-27 00:28:17'),
	(230, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 00:32:36', '2017-09-27 00:32:36'),
	(231, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 00:32:57', '2017-09-27 00:32:57'),
	(232, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 00:33:26', '2017-09-27 00:33:26'),
	(233, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 00:34:22', '2017-09-27 00:34:22'),
	(234, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 00:34:33', '2017-09-27 00:34:33'),
	(235, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 00:42:06', '2017-09-27 00:42:06'),
	(236, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 00:43:39', '2017-09-27 00:43:39'),
	(237, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 00:43:45', '2017-09-27 00:43:45'),
	(238, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 00:44:53', '2017-09-27 00:44:53'),
	(239, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 00:45:00', '2017-09-27 00:45:00'),
	(240, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 00:45:15', '2017-09-27 00:45:15'),
	(241, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 00:45:45', '2017-09-27 00:45:45'),
	(242, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 00:50:01', '2017-09-27 00:50:01'),
	(243, 1, 'admin/jobs/sort', 'POST', '127.0.0.1', '{"_method":"POST","_token":"cDIN54rtOXf22htTXntFAxWQ5tvUV7M5FRCXTO5L","_sortable":"11","ids":["2","1","3","4"]}', '2017-09-27 00:50:05', '2017-09-27 00:50:05'),
	(244, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 00:51:33', '2017-09-27 00:51:33'),
	(245, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 00:53:34', '2017-09-27 00:53:34'),
	(246, 1, 'admin/jobs/sort', 'POST', '127.0.0.1', '{"_method":"POST","_token":"cDIN54rtOXf22htTXntFAxWQ5tvUV7M5FRCXTO5L","_sortable":"11","ids":["1","3","2","4"]}', '2017-09-27 00:53:39', '2017-09-27 00:53:39'),
	(247, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 01:00:45', '2017-09-27 01:00:45'),
	(248, 1, 'admin/jobs/sort', 'POST', '127.0.0.1', '{"_method":"POST","_token":"cDIN54rtOXf22htTXntFAxWQ5tvUV7M5FRCXTO5L","_sortable":"true","min":"11","ids":["2","1","3","4"]}', '2017-09-27 01:00:48', '2017-09-27 01:00:48'),
	(249, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 01:01:30', '2017-09-27 01:01:30'),
	(250, 1, 'admin/jobs/sort', 'POST', '127.0.0.1', '{"_method":"POST","_token":"cDIN54rtOXf22htTXntFAxWQ5tvUV7M5FRCXTO5L","_sortable":"true","min":"11","ids":["2","1","3","4"]}', '2017-09-27 01:01:35', '2017-09-27 01:01:35'),
	(251, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 01:01:45', '2017-09-27 01:01:45'),
	(252, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 01:06:13', '2017-09-27 01:06:13'),
	(253, 1, 'admin/jobs/sort', 'POST', '127.0.0.1', '{"_method":"POST","_token":"cDIN54rtOXf22htTXntFAxWQ5tvUV7M5FRCXTO5L","_sortable":"true","min":"11","ids":["2","3","1","4"]}', '2017-09-27 01:06:26', '2017-09-27 01:06:26'),
	(254, 1, 'admin/jobs', 'GET', '127.0.0.1', '{"_pjax":"#pjax-container"}', '2017-09-27 01:06:27', '2017-09-27 01:06:27'),
	(255, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 01:06:54', '2017-09-27 01:06:54'),
	(256, 1, 'admin/jobs/sort', 'POST', '127.0.0.1', '{"_method":"POST","_token":"cDIN54rtOXf22htTXntFAxWQ5tvUV7M5FRCXTO5L","_sortable":"true","min":"11","ids":["1","2","3","4"]}', '2017-09-27 01:06:59', '2017-09-27 01:06:59'),
	(257, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 01:07:38', '2017-09-27 01:07:38'),
	(258, 1, 'admin/jobs/sort', 'POST', '127.0.0.1', '{"_method":"POST","_token":"cDIN54rtOXf22htTXntFAxWQ5tvUV7M5FRCXTO5L","_sortable":"true","min":"11","ids":["1","3","2","4"]}', '2017-09-27 01:07:42', '2017-09-27 01:07:42'),
	(259, 1, 'admin/jobs', 'GET', '127.0.0.1', '{"_pjax":"#pjax-container"}', '2017-09-27 01:07:43', '2017-09-27 01:07:43'),
	(260, 1, 'admin/jobs/1', 'PUT', '127.0.0.1', '{"published":"on","_token":"cDIN54rtOXf22htTXntFAxWQ5tvUV7M5FRCXTO5L","_method":"PUT"}', '2017-09-27 01:13:11', '2017-09-27 01:13:11'),
	(261, 1, 'admin/jobs/sort', 'POST', '127.0.0.1', '{"_method":"POST","_token":"cDIN54rtOXf22htTXntFAxWQ5tvUV7M5FRCXTO5L","_sortable":"true","min":"11","ids":["3","1","2","4"]}', '2017-09-27 01:49:23', '2017-09-27 01:49:23'),
	(262, 1, 'admin/jobs', 'GET', '127.0.0.1', '{"_pjax":"#pjax-container"}', '2017-09-27 01:49:23', '2017-09-27 01:49:23'),
	(263, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 14:45:38', '2017-09-27 14:45:38'),
	(264, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 14:46:27', '2017-09-27 14:46:27'),
	(265, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 15:15:04', '2017-09-27 15:15:04'),
	(266, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 15:15:22', '2017-09-27 15:15:22'),
	(267, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 15:15:47', '2017-09-27 15:15:47'),
	(268, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 15:15:55', '2017-09-27 15:15:55'),
	(269, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 15:17:06', '2017-09-27 15:17:06'),
	(270, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 15:17:33', '2017-09-27 15:17:33'),
	(271, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 15:23:00', '2017-09-27 15:23:00'),
	(272, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 15:23:07', '2017-09-27 15:23:07'),
	(273, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 15:23:38', '2017-09-27 15:23:38'),
	(274, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 15:24:11', '2017-09-27 15:24:11'),
	(275, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 15:25:19', '2017-09-27 15:25:19'),
	(276, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 15:31:46', '2017-09-27 15:31:46'),
	(277, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 15:35:41', '2017-09-27 15:35:41'),
	(278, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 15:36:05', '2017-09-27 15:36:05'),
	(279, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 15:36:24', '2017-09-27 15:36:24'),
	(280, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 15:38:06', '2017-09-27 15:38:06'),
	(281, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 15:38:56', '2017-09-27 15:38:56'),
	(282, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 15:38:56', '2017-09-27 15:38:56'),
	(283, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 15:38:57', '2017-09-27 15:38:57'),
	(284, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 15:40:02', '2017-09-27 15:40:02'),
	(285, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 15:43:18', '2017-09-27 15:43:18'),
	(286, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 15:44:20', '2017-09-27 15:44:20'),
	(287, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 15:45:10', '2017-09-27 15:45:10'),
	(288, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 15:45:46', '2017-09-27 15:45:46'),
	(289, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 15:51:14', '2017-09-27 15:51:14'),
	(290, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 15:59:57', '2017-09-27 15:59:57'),
	(291, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 16:00:14', '2017-09-27 16:00:14'),
	(292, 1, 'admin/jobs/sort', 'POST', '127.0.0.1', '{"_method":"POST","_token":"ajZawvAskeULLarMZPBRhIDlCUWC6bCaq2ExQEPq","_sortable":"true","min":"11","ids":["1","3","2","4"]}', '2017-09-27 16:00:18', '2017-09-27 16:00:18'),
	(293, 1, 'admin/jobs', 'GET', '127.0.0.1', '{"_pjax":"#pjax-container"}', '2017-09-27 16:00:19', '2017-09-27 16:00:19'),
	(294, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 16:00:21', '2017-09-27 16:00:21'),
	(295, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 16:01:58', '2017-09-27 16:01:58'),
	(296, 1, 'admin/jobs/sort', 'POST', '127.0.0.1', '{"_method":"POST","_token":"ajZawvAskeULLarMZPBRhIDlCUWC6bCaq2ExQEPq","_sortable":"true","min":"11","ids":["3","2","4","1"]}', '2017-09-27 16:02:05', '2017-09-27 16:02:05'),
	(297, 1, 'admin/jobs', 'GET', '127.0.0.1', '{"_pjax":"#pjax-container"}', '2017-09-27 16:02:06', '2017-09-27 16:02:06'),
	(298, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 16:02:23', '2017-09-27 16:02:23'),
	(299, 1, 'admin/jobs/sort', 'POST', '127.0.0.1', '{"_method":"POST","_token":"ajZawvAskeULLarMZPBRhIDlCUWC6bCaq2ExQEPq","_sortable":"true","min":"11","ids":["1","3","2","4"]}', '2017-09-27 16:02:27', '2017-09-27 16:02:27'),
	(300, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 16:11:09', '2017-09-27 16:11:09'),
	(301, 1, 'admin/jobs/sort', 'POST', '127.0.0.1', '{"_method":"POST","_token":"ajZawvAskeULLarMZPBRhIDlCUWC6bCaq2ExQEPq","_sortable":"true","min":"11","ids":["4","1","3","2"]}', '2017-09-27 16:13:10', '2017-09-27 16:13:10'),
	(302, 1, 'admin/jobs/4', 'PUT', '127.0.0.1', '{"published":"off","_token":"ajZawvAskeULLarMZPBRhIDlCUWC6bCaq2ExQEPq","_method":"PUT"}', '2017-09-27 16:14:34', '2017-09-27 16:14:34'),
	(303, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 16:16:54', '2017-09-27 16:16:54'),
	(304, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 18:08:07', '2017-09-27 18:08:07'),
	(305, 1, 'admin/jobs', 'POST', '127.0.0.1', '{"_method":"POST","_token":"ajZawvAskeULLarMZPBRhIDlCUWC6bCaq2ExQEPq","_sortable":"true","min":"11","ids":["1","4","3","2"]}', '2017-09-27 18:08:53', '2017-09-27 18:08:53'),
	(306, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 18:17:37', '2017-09-27 18:17:37'),
	(307, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 18:19:27', '2017-09-27 18:19:27'),
	(308, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 18:22:03', '2017-09-27 18:22:03'),
	(309, 1, 'admin/jobs', 'POST', '127.0.0.1', '{"_method":"POST","_token":"ajZawvAskeULLarMZPBRhIDlCUWC6bCaq2ExQEPq","_sortable":"true","min":"11","ids":["1","4","3","2"]}', '2017-09-27 18:22:12', '2017-09-27 18:22:12'),
	(310, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 18:23:19', '2017-09-27 18:23:19'),
	(311, 1, 'admin/jobs', 'POST', '127.0.0.1', '{"_method":"POST","_token":"ajZawvAskeULLarMZPBRhIDlCUWC6bCaq2ExQEPq","_sortable":"true","min":"11","ids":["1","4","3","2"]}', '2017-09-27 18:23:28', '2017-09-27 18:23:28'),
	(312, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 18:32:04', '2017-09-27 18:32:04'),
	(313, 1, 'admin/jobs', 'POST', '127.0.0.1', '{"_method":"POST","_token":"ajZawvAskeULLarMZPBRhIDlCUWC6bCaq2ExQEPq","_sortable":"true","min":"11","ids":["1","4","3","2"]}', '2017-09-27 18:32:10', '2017-09-27 18:32:10'),
	(314, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 18:33:24', '2017-09-27 18:33:24'),
	(315, 1, 'admin/jobs', 'POST', '127.0.0.1', '{"_method":"POST","_token":"ajZawvAskeULLarMZPBRhIDlCUWC6bCaq2ExQEPq","_sortable":"true","min":"11","ids":["1","4","3","2"]}', '2017-09-27 18:33:29', '2017-09-27 18:33:29'),
	(316, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 18:34:44', '2017-09-27 18:34:44'),
	(317, 1, 'admin/jobs', 'POST', '127.0.0.1', '{"_method":"POST","_token":"ajZawvAskeULLarMZPBRhIDlCUWC6bCaq2ExQEPq","_sortable":"true","min":"11","ids":["1","4","3","2"]}', '2017-09-27 18:34:49', '2017-09-27 18:34:49'),
	(318, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 18:35:23', '2017-09-27 18:35:23'),
	(319, 1, 'admin/jobs', 'POST', '127.0.0.1', '{"_method":"POST","_token":"ajZawvAskeULLarMZPBRhIDlCUWC6bCaq2ExQEPq","_sortable":"true","min":"11","ids":["1","4","3","2"]}', '2017-09-27 18:35:27', '2017-09-27 18:35:27'),
	(320, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 18:45:28', '2017-09-27 18:45:28'),
	(321, 1, 'admin/jobs', 'POST', '127.0.0.1', '{"_method":"POST","_token":"ajZawvAskeULLarMZPBRhIDlCUWC6bCaq2ExQEPq","_sortable":"true","min":"11","ids":["1","4","3","2"]}', '2017-09-27 18:45:35', '2017-09-27 18:45:35'),
	(322, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 18:49:35', '2017-09-27 18:49:35'),
	(323, 1, 'admin/jobs', 'POST', '127.0.0.1', '{"_method":"POST","_token":"ajZawvAskeULLarMZPBRhIDlCUWC6bCaq2ExQEPq","_sortable":"true","min":"11","ids":["1","4","3","2"]}', '2017-09-27 18:49:39', '2017-09-27 18:49:39'),
	(324, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 19:02:43', '2017-09-27 19:02:43'),
	(325, 1, 'admin/jobs', 'POST', '127.0.0.1', '{"_method":"POST","_token":"ajZawvAskeULLarMZPBRhIDlCUWC6bCaq2ExQEPq","_sortable":"true","min":"11","ids":["1","4","3","2"]}', '2017-09-27 19:02:47', '2017-09-27 19:02:47'),
	(326, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 19:03:58', '2017-09-27 19:03:58'),
	(327, 1, 'admin/jobs', 'POST', '127.0.0.1', '{"_method":"POST","_token":"ajZawvAskeULLarMZPBRhIDlCUWC6bCaq2ExQEPq","_sortable":"true","min":"11","ids":["1","4","3","2"]}', '2017-09-27 19:04:05', '2017-09-27 19:04:05'),
	(328, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 19:05:16', '2017-09-27 19:05:16'),
	(329, 1, 'admin/jobs', 'POST', '127.0.0.1', '{"_method":"POST","_token":"ajZawvAskeULLarMZPBRhIDlCUWC6bCaq2ExQEPq","_sortable":"true","min":"11","ids":["1","4","3","2"]}', '2017-09-27 19:05:21', '2017-09-27 19:05:21'),
	(330, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 19:05:40', '2017-09-27 19:05:40'),
	(331, 1, 'admin/jobs', 'POST', '127.0.0.1', '{"_method":"POST","_token":"ajZawvAskeULLarMZPBRhIDlCUWC6bCaq2ExQEPq","_sortable":"true","min":"11","ids":["4","3","1","2"]}', '2017-09-27 19:05:43', '2017-09-27 19:05:43'),
	(332, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 19:05:58', '2017-09-27 19:05:58'),
	(333, 1, 'admin/jobs', 'POST', '127.0.0.1', '{"_method":"POST","_token":"ajZawvAskeULLarMZPBRhIDlCUWC6bCaq2ExQEPq","_sortable":"true","min":"11","ids":["1","4","3","2"]}', '2017-09-27 19:06:01', '2017-09-27 19:06:01'),
	(334, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 19:06:12', '2017-09-27 19:06:12'),
	(335, 1, 'admin/jobs', 'POST', '127.0.0.1', '{"_method":"POST","_token":"ajZawvAskeULLarMZPBRhIDlCUWC6bCaq2ExQEPq","_sortable":"true","min":"11","ids":["1","4","3","2"]}', '2017-09-27 19:06:18', '2017-09-27 19:06:18'),
	(336, 1, 'admin/jobs', 'POST', '127.0.0.1', '{"_method":"POST","_token":"ajZawvAskeULLarMZPBRhIDlCUWC6bCaq2ExQEPq","_sortable":"true","min":"11","ids":["4","1","3","2"]}', '2017-09-27 19:07:53', '2017-09-27 19:07:53'),
	(337, 1, 'admin/jobs', 'POST', '127.0.0.1', '{"_method":"POST","_token":"ajZawvAskeULLarMZPBRhIDlCUWC6bCaq2ExQEPq","_sortable":"true","min":"11","ids":["4","3","1","2"]}', '2017-09-27 19:17:31', '2017-09-27 19:17:31'),
	(338, 1, 'admin/jobs', 'POST', '127.0.0.1', '{"_method":"POST","_token":"ajZawvAskeULLarMZPBRhIDlCUWC6bCaq2ExQEPq","_sortable":"true","min":"11","ids":["4","1","3","2"]}', '2017-09-27 19:19:25', '2017-09-27 19:19:25'),
	(339, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 19:21:11', '2017-09-27 19:21:11'),
	(340, 1, 'admin/jobs', 'POST', '127.0.0.1', '{"_method":"POST","_token":"ajZawvAskeULLarMZPBRhIDlCUWC6bCaq2ExQEPq","_sortable":"true","min":"11","ids":["1","4","3","2"]}', '2017-09-27 19:21:17', '2017-09-27 19:21:17'),
	(341, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 19:27:51', '2017-09-27 19:27:51'),
	(342, 1, 'admin/jobs', 'POST', '127.0.0.1', '{"_method":"POST","_token":"ajZawvAskeULLarMZPBRhIDlCUWC6bCaq2ExQEPq","_sortable":"true","min":"11","ids":["1","4","3","2"]}', '2017-09-27 19:27:56', '2017-09-27 19:27:56'),
	(343, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 19:28:35', '2017-09-27 19:28:35'),
	(344, 1, 'admin/jobs', 'POST', '127.0.0.1', '{"_method":"POST","_token":"ajZawvAskeULLarMZPBRhIDlCUWC6bCaq2ExQEPq","_sortable":"true","min":"11","ids":["1","4","3","2"]}', '2017-09-27 19:28:39', '2017-09-27 19:28:39'),
	(345, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 19:28:42', '2017-09-27 19:28:42'),
	(346, 1, 'admin/jobs/1', 'PUT', '127.0.0.1', '{"published":"off","_token":"ajZawvAskeULLarMZPBRhIDlCUWC6bCaq2ExQEPq","_method":"PUT"}', '2017-09-27 19:29:22', '2017-09-27 19:29:22'),
	(347, 1, 'admin/jobs/4', 'PUT', '127.0.0.1', '{"name":"description","value":"asdklasdk asdklasd EDITADITO","pk":"4","_token":"ajZawvAskeULLarMZPBRhIDlCUWC6bCaq2ExQEPq","_editable":"1","_method":"PUT"}', '2017-09-27 19:29:35', '2017-09-27 19:29:35'),
	(348, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 19:29:40', '2017-09-27 19:29:40'),
	(349, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 19:30:21', '2017-09-27 19:30:21'),
	(350, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 19:31:27', '2017-09-27 19:31:27'),
	(351, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 19:31:48', '2017-09-27 19:31:48'),
	(352, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 19:32:03', '2017-09-27 19:32:03'),
	(353, 1, 'admin/users', 'GET', '127.0.0.1', '{"_pjax":"#pjax-container"}', '2017-09-27 19:32:32', '2017-09-27 19:32:32'),
	(354, 1, 'admin/users/1/edit', 'GET', '127.0.0.1', '{"_pjax":"#pjax-container"}', '2017-09-27 19:32:39', '2017-09-27 19:32:39'),
	(355, 1, 'admin/users', 'GET', '127.0.0.1', '{"_pjax":"#pjax-container"}', '2017-09-27 19:32:43', '2017-09-27 19:32:43'),
	(356, 1, 'admin/logs', 'GET', '127.0.0.1', '{"_pjax":"#pjax-container"}', '2017-09-27 19:32:46', '2017-09-27 19:32:46'),
	(357, 1, 'admin/jobs', 'GET', '127.0.0.1', '[]', '2017-09-27 19:34:47', '2017-09-27 19:34:47');
/*!40000 ALTER TABLE `admin_operation_log` ENABLE KEYS */;

-- Dumping structure for table laravel-base.admin_permissions
CREATE TABLE IF NOT EXISTS `admin_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `http_method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `http_path` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_permissions_name_unique` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel-base.admin_permissions: 8 rows
/*!40000 ALTER TABLE `admin_permissions` DISABLE KEYS */;
INSERT INTO `admin_permissions` (`id`, `name`, `slug`, `http_method`, `http_path`, `created_at`, `updated_at`) VALUES
	(1, 'All permission', '*', '', '*', NULL, NULL),
	(2, 'Dashboard', 'dashboard', 'GET', '/', NULL, NULL),
	(3, 'Login', 'auth.login', '', '/auth/login\r\n/auth/logout', NULL, NULL),
	(4, 'User setting', 'auth.setting', 'GET,PUT', '/auth/setting', NULL, NULL),
	(5, 'Auth management', 'auth.management', '', '/auth/roles\r\n/auth/permissions\r\n/auth/menu\r\n/auth/logs', NULL, NULL),
	(6, 'Logs', 'ext.log-viewer', NULL, '/logs*', '2017-09-20 02:19:27', '2017-09-20 02:19:27'),
	(7, 'Test', 'test', 'GET,POST', '/auth/roles\r\n/auth/permissions\r\n/auth/menu\r\n/auth/logs', NULL, '2017-09-21 15:53:22'),
	(8, 'Jobs View', 'jobs.view', 'GET', '/jobs', '2017-09-27 20:09:51', '2017-09-27 20:10:34');
/*!40000 ALTER TABLE `admin_permissions` ENABLE KEYS */;

-- Dumping structure for table laravel-base.admin_roles
CREATE TABLE IF NOT EXISTS `admin_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_roles_name_unique` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel-base.admin_roles: 2 rows
/*!40000 ALTER TABLE `admin_roles` DISABLE KEYS */;
INSERT INTO `admin_roles` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
	(1, 'Administrator', 'administrator', '2017-09-20 01:10:41', '2017-09-20 01:10:41'),
	(2, 'Limitado', 'limited', '2017-09-27 20:05:29', '2017-09-27 20:05:29');
/*!40000 ALTER TABLE `admin_roles` ENABLE KEYS */;

-- Dumping structure for table laravel-base.admin_role_menu
CREATE TABLE IF NOT EXISTS `admin_role_menu` (
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `admin_role_menu_role_id_menu_id_index` (`role_id`,`menu_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel-base.admin_role_menu: 1 rows
/*!40000 ALTER TABLE `admin_role_menu` DISABLE KEYS */;
INSERT INTO `admin_role_menu` (`role_id`, `menu_id`, `created_at`, `updated_at`) VALUES
	(1, 2, NULL, NULL);
/*!40000 ALTER TABLE `admin_role_menu` ENABLE KEYS */;

-- Dumping structure for table laravel-base.admin_role_permissions
CREATE TABLE IF NOT EXISTS `admin_role_permissions` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `admin_role_permissions_role_id_permission_id_index` (`role_id`,`permission_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel-base.admin_role_permissions: 8 rows
/*!40000 ALTER TABLE `admin_role_permissions` DISABLE KEYS */;
INSERT INTO `admin_role_permissions` (`role_id`, `permission_id`, `created_at`, `updated_at`) VALUES
	(1, 1, NULL, NULL),
	(2, 2, NULL, NULL),
	(2, 3, NULL, NULL),
	(2, 4, NULL, NULL),
	(2, 5, NULL, NULL),
	(2, 6, NULL, NULL),
	(2, 7, NULL, NULL),
	(2, 8, NULL, NULL);
/*!40000 ALTER TABLE `admin_role_permissions` ENABLE KEYS */;

-- Dumping structure for table laravel-base.admin_role_users
CREATE TABLE IF NOT EXISTS `admin_role_users` (
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `admin_role_users_role_id_user_id_index` (`role_id`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel-base.admin_role_users: 2 rows
/*!40000 ALTER TABLE `admin_role_users` DISABLE KEYS */;
INSERT INTO `admin_role_users` (`role_id`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 1, NULL, NULL),
	(2, 2, NULL, NULL);
/*!40000 ALTER TABLE `admin_role_users` ENABLE KEYS */;

-- Dumping structure for table laravel-base.admin_users
CREATE TABLE IF NOT EXISTS `admin_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_users_username_unique` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel-base.admin_users: 2 rows
/*!40000 ALTER TABLE `admin_users` DISABLE KEYS */;
INSERT INTO `admin_users` (`id`, `username`, `password`, `name`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'admin', '$2y$10$DYGQdSIiZlyLb18e/O2UrepTt6VOCRsfJS5OAi/H7tezrtFgZr/qe', 'Administrator', 'images/38bbcde318ef5cbaf40901ee67ec396a.jpg', NULL, '2017-09-20 01:10:41', '2017-09-22 00:55:31'),
	(2, 'Test', '$2y$10$2T6R8MQGn70O.5wfWOU.husiqDxB1bYzhU1oc11SPbMLMopZuFUBW', 'test', NULL, 'BKCgPdCzSIOP0g24KS9XvvRbxKcTvUW9phUQoUqGvOIS6YEhlhFu4GFX6kUH', '2017-09-27 20:04:09', '2017-09-27 20:04:09');
/*!40000 ALTER TABLE `admin_users` ENABLE KEYS */;

-- Dumping structure for table laravel-base.admin_user_permissions
CREATE TABLE IF NOT EXISTS `admin_user_permissions` (
  `user_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `admin_user_permissions_user_id_permission_id_index` (`user_id`,`permission_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel-base.admin_user_permissions: 0 rows
/*!40000 ALTER TABLE `admin_user_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin_user_permissions` ENABLE KEYS */;

-- Dumping structure for table laravel-base.campaign
CREATE TABLE IF NOT EXISTS `campaign` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table laravel-base.campaign: 1 rows
/*!40000 ALTER TABLE `campaign` DISABLE KEYS */;
INSERT INTO `campaign` (`id`, `name`, `slug`, `note`, `enabled`, `created_at`, `updated_at`) VALUES
	(1, 'Rodrigo Butta 2', 'rbutta@gmail.com', 'Alguna nota importante privada', 1, '2017-09-25 18:23:52', '2017-09-30 01:27:57');
/*!40000 ALTER TABLE `campaign` ENABLE KEYS */;

-- Dumping structure for table laravel-base.job
CREATE TABLE IF NOT EXISTS `job` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sort` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `published` bit(1) DEFAULT b'0',
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- Dumping data for table laravel-base.job: ~4 rows (approximately)
/*!40000 ALTER TABLE `job` DISABLE KEYS */;
INSERT INTO `job` (`id`, `sort`, `user_id`, `title`, `published`, `description`, `created_at`, `updated_at`) VALUES
	(1, 11, NULL, 'Job 1111 nombre 2', b'1', 'kasd alkd jakld jaskla editado dede grid 3', '2017-09-25 20:27:34', '2017-09-28 14:57:11'),
	(2, 14, NULL, 'Job nro 2', b'0', 'sd d dsd da da sdasads', '2017-09-25 20:35:49', '2017-09-26 23:46:27'),
	(3, 13, NULL, 'Job nro 3', b'0', 'ds dasadsadsdas  daads das', '2017-09-25 20:35:59', '2017-09-25 21:53:24'),
	(4, 12, NULL, 'Job 4', b'0', 'asdklasdk asdklasd EDITADITO', '2017-09-25 21:53:18', '2017-09-27 21:32:14');
/*!40000 ALTER TABLE `job` ENABLE KEYS */;

-- Dumping structure for table laravel-base.leads
CREATE TABLE IF NOT EXISTS `leads` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table laravel-base.leads: 1 rows
/*!40000 ALTER TABLE `leads` DISABLE KEYS */;
INSERT INTO `leads` (`id`, `name`, `email`, `created_at`, `updated_at`) VALUES
	(1, 'Lead 1', 'lead1@gmail.com', '2017-09-25 15:26:56', '2017-09-25 15:26:57');
/*!40000 ALTER TABLE `leads` ENABLE KEYS */;

-- Dumping structure for table laravel-base.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel-base.migrations: 3 rows
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(74, '2014_10_12_100000_create_password_resets_table', 2),
	(73, '2016_01_04_173148_create_admin_tables', 2),
	(72, '2014_10_12_000000_create_users_table', 2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table laravel-base.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel-base.password_resets: 0 rows
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table laravel-base.tree
CREATE TABLE IF NOT EXISTS `tree` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0',
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table laravel-base.tree: ~8 rows (approximately)
/*!40000 ALTER TABLE `tree` DISABLE KEYS */;
INSERT INTO `tree` (`id`, `parent_id`, `sort`, `title`, `created_at`, `updated_at`) VALUES
	(1, 0, 1, 'Categoria 1 en serio?', '2017-09-29 18:21:03', '2017-09-29 18:21:54'),
	(2, 1, 2, 'Categoria 2 en serio?', '2017-09-29 18:21:04', '2017-09-29 18:21:54'),
	(37, 0, 3, 'Cat 3', '2017-09-29 21:21:09', '2017-09-29 21:34:47'),
	(38, 0, 8, 'Cat 4', '2017-09-29 21:22:47', '2017-09-29 21:34:47'),
	(39, 42, 6, 'cat 5', '2017-09-29 21:27:44', '2017-09-29 21:34:47'),
	(40, 42, 7, 'cat 6', '2017-09-29 21:29:51', '2017-09-29 21:34:47'),
	(41, 42, 5, 'cat 7', '2017-09-29 21:30:09', '2017-09-29 21:34:47'),
	(42, 0, 4, 'Categoría 8', '2017-09-29 21:34:28', '2017-09-29 21:34:47');
/*!40000 ALTER TABLE `tree` ENABLE KEYS */;

-- Dumping structure for table laravel-base.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel-base.user: 1 rows
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `name`, `email`, `note`, `enabled`, `created_at`, `updated_at`) VALUES
	(1, 'Rodrigo Butta 2', 'rbutta@gmail.com', 'Alguna nota importante privada', 1, '2017-09-25 18:23:52', '2017-09-30 01:27:57');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

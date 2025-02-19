-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 19, 2025 at 01:47 PM
-- Server version: 8.0.41
-- PHP Version: 8.3.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `equitify_business`
--

-- --------------------------------------------------------

--
-- Table structure for table `balances`
--

CREATE TABLE `balances` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `balance` decimal(15,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `interest` decimal(15,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `balances`
--

INSERT INTO `balances` (`id`, `user_id`, `balance`, `created_at`, `updated_at`, `interest`) VALUES
(1, 2, 1000.00, '2024-11-23 14:43:04', '2024-11-23 17:21:59', 0.00),
(2, 61, 165679.00, '2024-11-24 12:44:19', '2025-02-01 22:51:38', 551.25),
(3, 62, 59500.00, '2024-11-24 12:44:22', '2025-01-29 13:56:43', 0.00),
(4, 63, 860.00, '2024-11-24 23:22:10', '2025-02-16 02:58:33', 3190.56),
(5, 64, 39741.00, '2024-11-28 14:08:15', '2025-02-16 02:17:09', 0.00),
(6, 66, 110405.00, '2024-12-01 18:41:28', '2024-12-01 18:41:33', 0.00),
(7, 72, 99.00, '2025-01-31 13:12:57', '2025-01-31 13:17:06', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

CREATE TABLE `deposits` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `transaction_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `wallet_id` bigint UNSIGNED NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deposits`
--

INSERT INTO `deposits` (`id`, `user_id`, `transaction_number`, `wallet_id`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'ND9HX8NFUB', 4, 4500.00, 'completed', '2024-11-23 14:42:18', '2024-11-23 14:43:04'),
(2, 2, '7ZVDKPHD41', 4, 12000.00, 'completed', '2024-11-23 17:19:55', '2024-11-23 17:20:32'),
(3, 61, 'VVLELRXD7L', 4, 14000.00, 'completed', '2024-11-24 12:40:55', '2024-11-24 12:44:19'),
(4, 62, 'JKW8U7YZWG', 4, 8000.00, 'completed', '2024-11-24 12:42:56', '2024-11-24 12:44:22'),
(5, 62, 'XJQUHEAZEX', 2, 16500.00, 'completed', '2024-11-24 12:43:33', '2024-11-24 12:44:25'),
(6, 61, 'INQSJJJTBL', 2, 40000.00, 'completed', '2024-11-24 12:59:10', '2024-11-24 13:00:05'),
(7, 61, 'RNMO4RNRTC', 4, 4500.00, 'completed', '2024-11-24 13:05:56', '2024-11-24 14:16:36'),
(8, 61, 'IR9BRACRJY', 4, 6900.00, 'completed', '2024-11-24 14:12:24', '2024-11-24 14:16:41'),
(10, 63, 'DLSOXKOESV', 4, 6800.00, 'completed', '2024-11-24 23:03:13', '2024-11-24 23:22:15'),
(11, 64, 'HWOPX1ZLWC', 4, 40000.00, 'completed', '2024-11-28 14:07:13', '2024-11-28 14:08:15'),
(12, 64, '9Q05JFGRX1', 1, 2550.00, 'completed', '2024-11-28 14:07:33', '2024-11-28 14:08:19'),
(13, 61, '9EGFFGIG7V', 4, 10000.00, 'completed', '2024-11-30 08:11:17', '2024-11-30 08:17:17'),
(14, 61, 'GRCNUMBNXO', 4, 3680.00, 'completed', '2024-11-30 08:13:12', '2024-11-30 08:17:02'),
(15, 66, 'RQLPABMICP', 4, 100000.00, 'completed', '2024-12-01 18:39:35', '2024-12-01 18:41:28'),
(16, 66, 'HZSE8MEFWQ', 1, 10405.00, 'completed', '2024-12-01 18:40:00', '2024-12-01 18:41:33'),
(17, 61, 'XLDYQCWZ9F', 4, 35000.00, 'completed', '2024-12-02 15:06:58', '2024-12-02 15:07:42'),
(18, 61, 'PV45VJ5P5E', 4, 11450.00, 'completed', '2024-12-02 15:07:13', '2024-12-02 15:07:48'),
(19, 62, '2UVVYNFZO4', 4, 4000.00, 'completed', '2024-12-02 15:09:04', '2024-12-17 08:19:03'),
(20, 64, 'EXLLWSHYN7', 4, 6000.00, 'completed', '2024-12-10 20:55:55', '2024-12-13 03:20:55'),
(21, 61, 'FJQSOGVG4E', 4, 16500.00, 'completed', '2024-12-13 03:19:51', '2024-12-17 08:19:06'),
(22, 64, 'CAREOJXPCA', 4, 25000.00, 'completed', '2024-12-17 08:18:07', '2024-12-17 08:19:09'),
(23, 62, 'B6UTBAYCAR', 1, 8000.00, 'completed', '2024-12-17 23:25:00', '2024-12-17 23:28:03'),
(24, 62, 'OAYNEJJJIL', 4, 5000.00, 'completed', '2024-12-17 23:25:21', '2024-12-17 23:28:09'),
(25, 61, 'SRGKUVNLRC', 4, 10000.00, 'completed', '2024-12-17 23:26:30', '2024-12-17 23:28:27'),
(26, 61, '48CZC3IEJW', 3, 5000.00, 'completed', '2024-12-17 23:26:45', '2024-12-17 23:28:30'),
(27, 64, 'PCKTCXWW01', 4, 15000.00, 'completed', '2024-12-18 00:24:32', '2024-12-18 00:25:21'),
(28, 64, 'NYO0TML7AX', 3, 9600.00, 'completed', '2024-12-18 00:24:54', '2024-12-19 01:24:44'),
(29, 63, 'RBK19F6SY8', 4, 544.00, 'completed', '2024-12-19 01:07:30', '2024-12-19 01:24:35'),
(30, 61, 'SNOUA0AVIH', 4, 1000.00, 'completed', '2024-12-31 16:32:03', '2024-12-31 16:33:09'),
(31, 62, 'RS1WAQC1F1', 4, 8600.00, 'completed', '2025-01-16 21:35:07', '2025-01-16 21:40:18'),
(32, 62, 'AQLZH2OTJ8', 4, 5000.00, 'completed', '2025-01-16 21:36:10', '2025-01-16 21:40:21'),
(33, 62, '0OJ6G76ST8', 1, 18000.00, 'completed', '2025-01-16 21:36:26', '2025-01-16 21:40:25'),
(34, 64, 'WYKSY9ZYGW', 1, 50000.00, 'completed', '2025-01-16 21:37:29', '2025-01-16 22:11:21'),
(35, 64, '23UCUFCW3E', 4, 5000.00, 'completed', '2025-01-16 21:37:37', '2025-01-16 22:11:24'),
(36, 64, 'N2Z84FDCWY', 4, 1500.00, 'completed', '2025-01-16 21:37:53', '2025-01-16 22:11:28'),
(37, 61, 'JWEBDNHLF8', 4, 5000.00, 'completed', '2025-01-25 18:32:19', '2025-01-26 21:31:30'),
(38, 61, 'H4DMUMW2UZ', 4, 13000.00, 'completed', '2025-01-25 18:32:32', '2025-01-26 21:31:38'),
(39, 61, 'C0WW6DMXJW', 3, 6500.00, 'completed', '2025-01-25 18:32:44', '2025-01-26 21:31:57'),
(40, 61, 'ZFRCZQMCHM', 2, 41000.00, 'completed', '2025-01-25 18:32:59', '2025-01-26 21:32:03'),
(41, 62, 'WMVXAQ8LES', 4, 9900.00, 'completed', '2025-01-25 18:34:14', '2025-01-26 21:33:00'),
(42, 62, 'ALL3074S9J', 2, 5000.00, 'completed', '2025-01-25 18:34:27', '2025-01-26 21:33:03'),
(43, 64, 'JUTPGUW1KU', 1, 2000.00, 'completed', '2025-01-29 13:49:43', '2025-01-29 13:56:02'),
(44, 64, 'QUCWGNFZ0U', 1, 3900.00, 'completed', '2025-01-29 13:49:56', '2025-01-29 13:56:06'),
(45, 64, 'NDKAYQ5VRT', 1, 20500.00, 'completed', '2025-01-29 13:50:12', '2025-01-29 13:56:09'),
(46, 64, 'JAJ2ECGEOT', 1, 1500.00, 'completed', '2025-01-29 13:50:23', '2025-02-04 21:37:38'),
(47, 64, 'E7K9L2AX8Q', 4, 5900.00, 'completed', '2025-02-04 21:33:46', '2025-02-04 21:37:42'),
(48, 64, 'OEMLG34SV9', 4, 2800.00, 'completed', '2025-02-04 21:33:56', '2025-02-04 21:37:45'),
(49, 64, 'RRD0GUQ0QV', 4, 2000.00, 'completed', '2025-02-04 21:34:06', '2025-02-04 21:37:48'),
(50, 64, 'SKEILUKMFI', 3, 10500.00, 'completed', '2025-02-04 21:34:18', '2025-02-04 21:37:56'),
(51, 64, 'TW8OSK9YWR', 4, 8000.00, 'completed', '2025-02-04 21:34:31', '2025-02-04 21:37:59'),
(52, 64, 'ZXJLDUZ7DP', 4, 5090.00, 'completed', '2025-02-04 21:34:46', '2025-02-04 21:38:02'),
(53, 64, 'DZQ45T2PBG', 4, 500.00, 'completed', '2025-02-04 21:34:56', '2025-02-16 02:17:09'),
(54, 64, 'UJMCLG8ZHB', 4, 500.00, 'completed', '2025-02-04 21:36:50', '2025-02-16 02:17:09'),
(55, 63, 'NELA6VOHL2', 4, 725.00, 'completed', '2025-02-16 01:57:34', '2025-02-16 02:17:21');

-- --------------------------------------------------------

--
-- Table structure for table `investments`
--

CREATE TABLE `investments` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `plan_id` bigint UNSIGNED NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `return_on_investment` decimal(15,2) NOT NULL,
  `investPercentage` double NOT NULL DEFAULT '0',
  `remainingTime` int NOT NULL DEFAULT '0',
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `investments`
--

INSERT INTO `investments` (`id`, `user_id`, `plan_id`, `amount`, `start_time`, `end_time`, `return_on_investment`, `investPercentage`, `remainingTime`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 3000.00, '2024-11-23 15:04:29', '2025-02-23 15:04:29', 1350.00, 0, 0, 'active', '2024-11-23 15:04:29', '2024-11-23 15:04:29'),
(2, 2, 2, 11500.00, '2024-11-23 17:21:59', '2025-02-23 17:21:59', 7935.00, 0, 0, 'active', '2024-11-23 17:21:59', '2024-11-23 17:21:59'),
(3, 61, 2, 10000.00, '2024-11-24 12:45:31', '2025-02-24 12:45:31', 6900.00, 88.62288647343, 904344, 'active', '2024-11-24 12:45:31', '2025-02-14 01:33:07'),
(4, 61, 1, 3500.00, '2024-11-24 12:45:50', '2025-02-01 21:40:00', 1575.00, 100, 0, 'completed', '2024-11-24 12:45:50', '2025-02-01 22:51:38'),
(5, 61, 5, 500.00, '2024-11-24 12:46:05', '2025-02-24 12:46:05', 150.00, 88.62245873591, 904378, 'active', '2024-11-24 12:46:05', '2025-02-14 01:33:07'),
(6, 62, 1, 3000.00, '2024-11-24 12:54:50', '2025-02-24 12:54:50', 1350.00, 0, 0, 'active', '2024-11-24 12:54:50', '2024-11-24 12:54:50'),
(7, 62, 2, 6000.00, '2024-11-24 12:55:11', '2025-02-24 12:55:11', 4140.00, 0, 0, 'active', '2024-11-24 12:55:11', '2024-11-24 12:55:11'),
(8, 63, 2, 6800.00, '2024-11-24 23:35:19', '2025-02-02 01:35:00', 4692.00, 100, 0, 'completed', '2024-11-24 23:35:19', '2025-02-02 16:42:54'),
(9, 61, 3, 22000.00, '2024-12-08 02:58:30', '2025-03-08 02:58:30', 15400.00, 75.489673353909, 1905923, 'active', '2024-12-08 02:58:30', '2025-02-14 01:33:07'),
(10, 64, 1, 2050.00, '2024-12-10 20:55:36', '2025-03-10 20:55:36', 922.50, 0, 0, 'active', '2024-12-10 20:55:36', '2024-12-10 20:55:36'),
(11, 64, 2, 14999.00, '2024-12-10 20:56:19', '2025-03-10 20:56:19', 10349.31, 0, 0, 'active', '2024-12-10 20:56:19', '2024-12-10 20:56:19'),
(12, 61, 1, 2000.00, '2024-12-18 18:39:14', '2025-03-18 18:39:14', 900.00, 63.652687757202, 2826367, 'active', '2024-12-18 18:39:14', '2025-02-14 01:33:07'),
(13, 63, 1, 1560.00, '2025-02-16 02:58:33', '2025-05-16 02:58:33', 546.00, 2.6024890761548, 7489479, 'active', '2025-02-16 02:58:33', '2025-02-18 10:33:54');

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '2024_11_12_050012_create_plans_table', 1),
(3, '2024_11_12_050013_create_withdrawals_table', 1),
(4, '2024_11_12_050153_create_transfers_table', 1),
(5, '2024_11_12_050154_create_deposits_table', 1),
(6, '2024_11_12_050154_create_referrals_table', 1),
(7, '2024_11_12_051445_create_wallets_table', 1),
(8, '2024_11_12_051449_create_investments_table', 1),
(9, '2024_11_12_100057_add_referral_code_to_users_table', 1),
(10, '2024_11_12_125411_create_cache_table', 1),
(11, '2024_11_12_135817_create_sessions_table', 1),
(12, '2024_11_15_003054_add_status_to_investments_table', 1),
(13, '2024_11_15_030046_add_start_and_end_time_to_investments_table', 1),
(14, '2024_11_15_031345_create_balances_table', 1),
(15, '2024_11_21_084740_add_interest_to_users_table', 1),
(16, '2024_11_21_090228_add_last_bonus_at_to_referrals_table', 1),
(17, '2024_11_21_111512_add_columns_to_users_table', 1),
(18, '2024_11_21_150659_create_password_resets_table', 1),
(19, '2024_11_21_151209_create_transactions_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expires_at` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`id`, `email`, `token`, `expires_at`, `created_at`, `updated_at`) VALUES
(3, 'wisedeveloper1@gmail.com', 'zTHc2famMm81IILQ01ddn3OGqdO9lcayRS7svRyLILr6CVgKckgfeKGjm93T', '2025-02-07 15:05:13', '2025-02-07 13:05:13', '2025-02-07 13:05:13'),
(4, 'harleyrose9026@gmail.com', 'sIfWPfboHn3YDxxcwCyLliRk56VwYdZRMDFPceldAvTJoleePhD52f1JxVVn', '2025-02-07 21:55:15', '2025-02-07 19:55:15', '2025-02-07 19:55:15'),
(6, 'riverahills1@gmail.com', 'zSmpXjxpRkUsvEWDWbsTRexeAsy3qqgjMLncCxVSjNVoJJtbmezwSOksczC0', '2025-02-09 13:10:52', '2025-02-09 11:10:52', '2025-02-09 11:10:52');

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
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `interest` decimal(5,2) NOT NULL,
  `duration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `min_amount` decimal(15,2) NOT NULL,
  `max_amount` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `name`, `interest`, `duration`, `min_amount`, `max_amount`, `created_at`, `updated_at`) VALUES
(1, 'SILVER PLAN', 35.00, '1', 1000.00, 3999.00, '2024-11-22 14:51:13', '2024-12-22 20:48:01'),
(2, 'CRYPTOCURRENCY PLAN', 45.00, '1', 2000.00, 4999.00, '2024-11-22 14:51:14', '2024-12-22 20:32:26'),
(3, 'BLOCKCHAIN ETFs', 69.00, '1', 5000.00, 14999.00, '2024-11-22 14:51:14', '2024-12-22 20:33:36'),
(4, 'DEFI PORTFOLIO', 70.00, '1', 15000.00, 1499999.00, '2024-11-22 14:51:14', '2024-12-22 20:38:51'),
(5, 'GOLDEN PLAN', 50.00, '1', 150000.00, 9999999.00, '2024-11-22 14:51:14', '2024-12-22 20:46:00'),
(11, 'TRIAL PLAN', 30.00, '1', 50.00, 499.00, '2024-12-22 20:26:22', '2024-12-22 20:48:35');

-- --------------------------------------------------------

--
-- Table structure for table `referrals`
--

CREATE TABLE `referrals` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `referred_user_id` bigint UNSIGNED NOT NULL,
  `referral_bonus` decimal(15,2) NOT NULL,
  `last_bonus_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('c3fwO6gXikgRFAC3xPDwC4OvTif1SSQaOyznCG1i', NULL, '43.158.91.71', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOHJQMDRlUjdKc1dVbEVuNUdReU54ekdOOG9YSnNCWmd5aURCQTlRcCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHBzOi8vZXF1aXRpZnl0cmFkZXMuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1739954942),
('FTNWXoevjnSWOe2kheyXTCQDkPG2UIDiF7rEbMvW', NULL, '102.91.71.236', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiZUJlMG9TbG9tYks3MkZ5TDByOXdPUnQzeGN1WnVDYWc2ZmgzWjdVUiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1739951955),
('JFxWyKCD4VBMuzEn4NwPgysVQ0ns3Tti5vgyMHoK', NULL, '117.33.163.216', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTDVncDByckR2MmJZU292NFJZQ2YxakRZN1htZEZ5ZXoxeGlZRUpMaSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHBzOi8vd3d3LmVxdWl0aWZ5dHJhZGVzLmNvbSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1739963311),
('kbAptcZOREUqD5I4MjeSLsz98HnIgDdj2R3r8yoH', NULL, '43.129.38.128', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSHJhZ2pubHRuM3Q2bjJxM1ZtUzY1Mzh5ajZlTGJZZEVFMDBSRjdjUiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHBzOi8vd3d3LmVxdWl0aWZ5dHJhZGVzLmNvbSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1739966921),
('lkPiRp1q4MQAC3sxXSpqKH71FDexAzlyC9AyCuOP', NULL, '99.80.127.142', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.80 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWWFiUlBCdUw1U2lOSm04NmVsT2dIVlRFang5dFJLWjVYWXNZRkZlVyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHBzOi8vZXF1aXRpZnl0cmFkZXMuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1739941236),
('llzkkvcDgLTttKOiXpDilAq2TM7Eq6tbuozVGA78', NULL, '43.157.202.235', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidlFWYVJyZ2libGFTMWFYVVdSeVltWm5IUjhMNUFwZklWRjFyYmprcCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHBzOi8vZXF1aXRpZnl0cmFkZXMuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1739965365),
('o9NP8sjI9iJMGYKwz6hP0r68OAZO4H5eigckkrV0', NULL, '102.91.71.236', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiOERJR2FtTTltOFpwNndxZFpCQjl3VGh3QmpYSmdMZFNaMWNKeG5NdSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1739951954),
('OHU09goTSH2ja8jO6GrNRj0DuTVlVal1NVp7swAu', NULL, '102.91.77.107', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiYzUyOVNVSjM3NDQ5a01hYkJDTURVV1l2eXFZeVR5OWgyVkdsZUpSTSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1739970301),
('ps9wNUlNWKvCrdcHcZexUU36M56rf4hMwk9H5lcb', NULL, '117.62.235.53', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMnp3ZlJ6TXhPRG0wMDF0M2p3U0xSZGdYTVJleEdiNkpnaWMzMk9qRCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHBzOi8vZXF1aXRpZnl0cmFkZXMuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1739943777),
('Vbun8HymrxFGMe6F1WnY5U4doqqaNeme1JAr1t6G', NULL, '77.74.177.118', 'Mozilla/5.0 (Linux; arm_64; Android 12; CPH2205) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 YaBrowser/23.3.3.86.00 SA/3 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOXFhY1BLV0duVjJCUk9ranQ2TGdVdHdvV2h5dks4ZG5UTTVzZVRqTiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHBzOi8vZXF1aXRpZnl0cmFkZXMuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1739950942),
('xek2PmdhTsNm9ec0QiPUrt6IwWJuofmToo0SLxC3', NULL, '34.90.235.227', 'Scrapy/2.11.2 (+https://scrapy.org)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQ3VaTFkyY1FlYWtQZTlRSzM5Sm0wYnhLRU51akFCdmdDeVM0QTVFNyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHBzOi8vZXF1aXRpZnl0cmFkZXMuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1739969345),
('Y2AU0Y4MJWfJY95e1PtMEohpDmKbJzFgm6rXI1KL', NULL, '95.142.121.31', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidzVHQXRPZ1dlQWFpcU9KRkF4b1VPdlNzdDJLVHprM21jSEVpWmI5RCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjA6Imh0dHBzOi8vZXF1aXRpZnl0cmFkZXMuY29tLy9zaXRvL3dwLWluY2x1ZGVzL3dsd21hbmlmZXN0LnhtbCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1739946316);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint UNSIGNED NOT NULL,
  `transaction_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `status` enum('pending','completed','failed') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('transfer','withdrawal','investment') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `withdrawal_id` bigint UNSIGNED DEFAULT NULL,
  `investment_id` bigint UNSIGNED DEFAULT NULL,
  `transfer_id` bigint UNSIGNED DEFAULT NULL,
  `remark` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transfers`
--

CREATE TABLE `transfers` (
  `id` bigint UNSIGNED NOT NULL,
  `sender_id` bigint UNSIGNED NOT NULL,
  `receiver_id` bigint UNSIGNED NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `referral_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `plain_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `verification_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `identity_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `identity_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proof_of_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unverified',
  `account` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `reason` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `referral_code`, `mobile`, `password`, `plain_password`, `role`, `verification_code`, `country`, `image`, `address`, `identity_image`, `identity_type`, `proof_of_address`, `status`, `account`, `reason`, `created_at`, `updated_at`) VALUES
(1, 'danny', 'admin@danny.com', 'dewise', NULL, '1234567890', '$2y$12$zsWraWp1Apow7zTop7Sxc.nqrkA.ZrLSyLG8QWWpqSqCicrWCa02y', NULL, 'admin', NULL, 'Country', NULL, NULL, NULL, NULL, NULL, 'verified', 'active', NULL, '2024-11-22 14:51:16', '2024-11-24 14:03:05'),
(2, 'John Doe', 'johndoe@example.com', 'johndoe', NULL, '0987654321', '$2y$12$e2CdzfoXQs6SU2bikMCfz.HlYBC0Jq30NaKpafMdFZ3rUWjtboxtm', NULL, 'user', '666666', 'Country', NULL, NULL, NULL, NULL, NULL, 'verified', 'active', NULL, '2024-11-22 14:51:17', '2024-11-22 14:51:17'),
(61, 'Deborah Rivera', 'riverahills1@gmail.com', 'riverahills', NULL, '9095084150', '$2y$12$sajPAFtz4PAOOJT1fcCmqudZO8mzTdgw1UKjRZyTSHiv/sJKgQZFW', NULL, 'user', '428919', 'America', NULL, NULL, NULL, NULL, NULL, 'verified', 'active', NULL, '2024-11-24 12:27:36', '2024-11-24 12:34:54'),
(62, 'Harley Rose', 'harleyrose9026@gmail.com', 'Harley', NULL, '6083256485', '$2y$12$bkHkivgNWhBio8xz7oPxdurXXFN0oR0aaPgr/NA7anep.SjaMaTQG', NULL, 'user', '694335', 'America', NULL, NULL, NULL, NULL, NULL, 'verified', 'active', NULL, '2024-11-24 12:33:20', '2024-11-24 12:42:31'),
(63, 'Antonio Jiménez Hernández', 'mtono07@hotmail.com', 'Mtono', NULL, '5572760151', '$2y$12$MCg1nwqvpZhUWPqiiz8eCe3KjlMoK5nJ0p0gnfNILKi4DkKjPVChm', NULL, 'user', '842532', 'México', NULL, NULL, NULL, NULL, NULL, 'verified', 'active', NULL, '2024-11-24 15:50:21', '2024-11-24 22:55:00'),
(64, 'Juan Granados', 'juangranados1170@gmail.com', 'JuanG', NULL, '805623595', '$2y$12$IhxTcN0RGmyerWG.9QjKNOCbygA2PokghYU3QYbF3JLA5HHDbly1C', NULL, 'user', '737180', 'Mexico', NULL, NULL, NULL, NULL, NULL, 'verified', 'active', NULL, '2024-11-24 16:15:34', '2024-11-24 16:20:41'),
(65, 'Louis', 'luisjusto500@gmail.com', 'luisj', NULL, '5053368521', '$2y$12$sIvCOpfcdJ8k6k5OhhJdDu.A4A/fO79.m8Cz8f35RvEhZukjsXTn6', NULL, 'user', '697524', 'America', NULL, NULL, NULL, NULL, NULL, 'unverified', 'active', NULL, '2024-12-01 18:32:05', '2024-12-01 18:32:05'),
(66, 'Louis', 'louisrolland79@gmail.com', 'Rolland', NULL, '5054236251', '$2y$12$AQH9.hj5yznmQVTOsDL2Au//SKQ2GiGhiAkmMwdeK9C2VlnRXTOeK', NULL, 'user', '545771', 'American', NULL, NULL, NULL, NULL, NULL, 'verified', 'active', NULL, '2024-12-01 18:34:30', '2024-12-01 18:39:01'),
(67, 'Ethan Brooks', 'elonmusk776937@gmail.com', 'Ethan', NULL, '+9450853362', '$2y$12$FuVVFfxkXSHTo2I/D2qew.gV0g.a5sFMkxUvTHeGHnUJfFB.wfaeK', NULL, 'user', '903042', 'USA', NULL, NULL, NULL, NULL, NULL, 'unverified', 'active', NULL, '2024-12-02 15:10:53', '2024-12-02 15:10:53'),
(68, 'Repellendus Volupta', 'wisedeveloper11@gmail.com', 'Voluptates sed qui n', NULL, '636587289', '$2y$12$drRD4J4QliHzj48m3GgcseMchIzW5oGtct1OYXJR.p9d.6s9Hf.aC', NULL, 'user', '788103', 'Autem voluptas ut re', NULL, NULL, NULL, NULL, NULL, 'unverified', 'active', NULL, '2024-12-03 13:19:22', '2024-12-03 13:19:22'),
(69, 'Gabriel', 'gabsmith0079@gmail.com', 'Smith', NULL, '6063215894', '$2y$12$zl5lB4QGJlNUwc2VjYUJzOkIQqlnxOVaQnU7Yfi.YcleW5h2gwSKe', NULL, 'user', '403372', 'Canada', NULL, NULL, NULL, NULL, NULL, 'unverified', 'active', NULL, '2024-12-03 13:44:14', '2024-12-03 13:44:14'),
(70, 'Tarek assaf', 'assaf_tarek@hotmail.com', 'Assaf424', NULL, '00467000199336', '$2y$12$8YdKYsUADbVL3YX6WnwpTOIOileTC6UwDRvGMfhYJ8SsoOQdwUIwC', NULL, 'user', '187278', 'Sweden', NULL, NULL, NULL, NULL, NULL, 'unverified', 'active', NULL, '2025-01-23 18:20:32', '2025-01-23 18:20:32'),
(71, 'Victor', 'blexonbrainz@gmail.com', 'Victor', NULL, '+2348155666255', '$2y$12$tP9WjEeaF9jCTEOWBHRf7et/VIc7mGNU1mAvwkMXpvKGvQ6z/KXKm', NULL, 'user', '869877', 'Nigeria', NULL, NULL, NULL, NULL, NULL, 'unverified', 'active', NULL, '2025-01-27 19:38:09', '2025-01-27 19:38:09'),
(72, 'Juan Granados', 'juangranados70@gmail.com', 'Juan70', NULL, '5594766662', '$2y$12$Mp9HVay/1ignkAA2iLmgA.5LyG..6DKrexTh17i344Nl6kMrcz9bu', NULL, 'user', '240876', 'United States of America', NULL, NULL, NULL, NULL, NULL, 'verified', 'active', NULL, '2025-01-30 23:28:07', '2025-01-30 23:29:01');

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` bigint UNSIGNED NOT NULL,
  `coin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `network` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `min_amount` decimal(15,2) NOT NULL,
  `max_amount` decimal(15,2) NOT NULL,
  `image_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wallets`
--

INSERT INTO `wallets` (`id`, `coin`, `network`, `address`, `min_amount`, `max_amount`, `image_path`, `created_at`, `updated_at`) VALUES
(1, 'Bitcoin (BTC)', 'BTC', 'bc1q5mdd2mwmlscct5gzrm5ev6krfe6z2erh4ysq6w', 500.00, 100000.00, 'btc.jpeg', '2024-11-22 14:51:17', '2024-11-23 13:41:24'),
(2, 'Ethereum (ETH)', 'Eth', '0xc58A4D4218D5e8caa23C1c0791a0FdF40Be28CF1', 500.00, 100000.00, 'eth.png', '2024-11-22 14:51:17', '2024-11-23 13:46:24'),
(3, 'Tether (USDT)', 'ERC-20', '0xc58A4D4218D5e8caa23C1c0791a0FdF40Be28CF1', 500.00, 100000.00, 'usdt.png', '2024-11-22 14:51:17', '2024-11-23 13:45:31'),
(4, 'Tether (USDT)', 'TRC-20', 'TPdtYtchCMyNY5QY1bQX93QXQ4p2Rgi5j1', 500.00, 100000.00, 'usdt.png', '2024-11-22 14:51:17', '2024-11-23 13:44:28');

-- --------------------------------------------------------

--
-- Table structure for table `withdrawals`
--

CREATE TABLE `withdrawals` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `transaction_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_account_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `routing_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zelle_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paypal_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wallet_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `network` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coin_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_proof` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `feedback` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `withdrawals`
--

INSERT INTO `withdrawals` (`id`, `user_id`, `transaction_number`, `amount`, `method`, `bank_name`, `bank_account_number`, `routing_number`, `address`, `zelle_email`, `paypal_email`, `wallet_address`, `network`, `coin_type`, `transaction_proof`, `feedback`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, '2877756766', 1000.00, 'crypto', NULL, NULL, NULL, NULL, NULL, NULL, 'TPdtYtchCMyNY5QY1bQX93QXQ4p2Rgi5j1', 'TRC-20', 'Tether', NULL, NULL, 'complete', '2024-11-23 15:15:00', '2024-11-23 15:19:10'),
(2, 62, '1256855785', 10000.00, 'crypto', NULL, NULL, NULL, NULL, NULL, NULL, 'TPdtYtchCMyNY5QY1bQX93QXQ4p2Rgi5j1', 'TRC-20', 'Tether', NULL, NULL, 'complete', '2024-11-24 12:57:05', '2024-11-24 12:57:27'),
(3, 61, '3493219691', 9000.00, 'crypto', NULL, NULL, NULL, NULL, NULL, NULL, 'TPdtYtchCMyNY5QY1bQX93QXQ4p2Rgi5j1', 'TRC-20', 'Tether', NULL, NULL, 'complete', '2024-11-24 13:00:43', '2024-11-24 13:02:13'),
(4, 61, '5705464672', 2500.00, 'crypto', NULL, NULL, NULL, NULL, NULL, NULL, 'TPdtYtchCMyNY5QY1bQX93QXQ4p2Rgi5j1', 'TRC-20', 'Tether', NULL, NULL, 'complete', '2024-11-24 13:01:11', '2024-11-24 13:02:16'),
(5, 61, '8633257416', 4500.00, 'crypto', NULL, NULL, NULL, NULL, NULL, NULL, 'TPdtYtchCMyNY5QY1bQX93QXQ4p2Rgi5j1', 'TRC-20', 'Tether', NULL, NULL, 'complete', '2024-11-24 13:01:39', '2024-11-24 13:02:19'),
(6, 61, '5445075947', 5000.00, 'crypto', NULL, NULL, NULL, NULL, NULL, NULL, 'TPdtYtchCMyNY5QY1bQX93QXQ4p2Rgi5j1', 'USDT TRC20', 'Tether', NULL, NULL, 'complete', '2024-11-30 08:12:30', '2024-11-30 08:17:27'),
(8, 61, '5637875338', 950.00, 'crypto', NULL, NULL, NULL, NULL, NULL, NULL, 'TPdtYtchCMyNY5QY1bQX93QXQ4p2Rgi5j1', 'USDT TRC20', 'Tether', NULL, NULL, 'complete', '2024-11-30 08:16:32', '2024-11-30 08:17:36'),
(9, 64, '8975999453', 21000.00, 'crypto', NULL, NULL, NULL, NULL, NULL, NULL, 'TPdtYtchCMyNY5QY1bQX93QXQ4p2Rgi5j1', 'TRC-20', 'Tether', NULL, NULL, 'complete', '2024-12-01 18:43:01', '2024-12-01 18:43:57'),
(10, 62, '4613882875', 4000.00, 'crypto', NULL, NULL, NULL, NULL, NULL, NULL, 'TPdtYtchCMyNY5QY1bQX93QXQ4p2Rgi5j1', 'TRC-20', 'Tether', NULL, 'Dear customer you can make more withdrawals', 'complete', '2024-12-02 15:09:39', '2024-12-02 15:12:32'),
(11, 62, '6325248895', 500.00, 'crypto', NULL, NULL, NULL, NULL, NULL, NULL, 'TPdtYtchCMyNY5QY1bQX93QXQ4p2Rgi5j1', 'TRC-20', 'Tether', NULL, 'Your payment was delayed because of some certain reasons which we can\'t disclose. Sorry for the inconvenience.', 'complete', '2024-12-02 15:14:40', '2024-12-17 08:14:31'),
(12, 64, '9828989556', 1000.00, 'crypto', NULL, NULL, NULL, NULL, NULL, NULL, 'TPdtYtchCMyNY5QY1bQX93QXQ4p2Rgi5j1', 'TRC-20', 'Tether', NULL, 'Exercise some patience your withdrawal will be approved soon', 'complete', '2024-12-08 03:00:47', '2024-12-17 08:14:36'),
(13, 64, '8569407100', 9500.00, 'crypto', NULL, NULL, NULL, NULL, NULL, NULL, 'TPdtYtchCMyNY5QY1bQX93QXQ4p2Rgi5j1', 'TRC-20', 'Tether', NULL, NULL, 'complete', '2024-12-17 08:13:25', '2024-12-17 08:14:41'),
(14, 64, '1152778641', 8000.00, 'crypto', NULL, NULL, NULL, NULL, NULL, NULL, 'TPdtYtchCMyNY5QY1bQX93QXQ4p2Rgi5j1', 'TRC-20', 'Tether', NULL, 'Done. You can make more withdrawals', 'complete', '2024-12-17 08:22:01', '2024-12-17 08:22:53'),
(15, 61, '3649153852', 3000.00, 'crypto', NULL, NULL, NULL, NULL, NULL, NULL, 'TPdtYtchCMyNY5QY1bQX93QXQ4p2Rgi5j1', 'TRC-20', 'Tether', NULL, 'Thank you', 'complete', '2024-12-17 08:24:14', '2024-12-17 08:25:08'),
(16, 62, '9626982112', 5000.00, 'crypto', NULL, NULL, NULL, NULL, NULL, NULL, 'TPdtYtchCMyNY5QY1bQX93QXQ4p2Rgi5j1', 'TRC-20', 'Tether', NULL, NULL, 'complete', '2025-01-16 21:35:54', '2025-01-29 13:56:43'),
(17, 64, '5523631491', 5000.00, 'crypto', NULL, NULL, NULL, NULL, NULL, NULL, 'TPdtYtchCMyNY5QY1bQX93QXQ4p2Rgi5j1', 'BTC', 'BTC', NULL, 'Your withdrawal has been approved', 'complete', '2025-01-29 13:52:22', '2025-01-29 13:57:15'),
(18, 64, '8346391543', 1900.00, 'crypto', NULL, NULL, NULL, NULL, NULL, NULL, 'TPdtYtchCMyNY5QY1bQX93QXQ4p2Rgi5j1', 'ERC-20', 'ETH', NULL, NULL, 'complete', '2025-01-29 13:52:52', '2025-01-29 13:57:18'),
(19, 64, '1588470460', 3500.00, 'crypto', NULL, NULL, NULL, NULL, NULL, NULL, 'TPdtYtchCMyNY5QY1bQX93QXQ4p2Rgi5j1', 'TRC-20', 'Tether', NULL, NULL, 'complete', '2025-01-29 13:53:25', '2025-01-29 13:57:22'),
(20, 64, '3654211557', 90200.00, 'crypto', NULL, NULL, NULL, NULL, NULL, NULL, 'TPdtYtchCMyNY5QY1bQX93QXQ4p2Rgi5j1', 'BTC', 'BTC', NULL, 'Your withdrawal has been approved', 'complete', '2025-01-29 13:53:56', '2025-02-04 21:38:17'),
(21, 64, '4593399888', 5000.00, 'crypto', NULL, NULL, NULL, NULL, NULL, NULL, 'TPdtYtchCMyNY5QY1bQX93QXQ4p2Rgi5j1', 'ERC-20', 'ETH', NULL, NULL, 'complete', '2025-02-04 21:35:30', '2025-02-04 21:38:25'),
(22, 64, '9080023536', 200.00, 'crypto', NULL, NULL, NULL, NULL, NULL, NULL, 'TPdtYtchCMyNY5QY1bQX93QXQ4p2Rgi5j1', 'ERC-20', 'ETH', NULL, NULL, 'complete', '2025-02-04 21:35:52', '2025-02-04 21:38:28'),
(23, 64, '4454123886', 5000.00, 'crypto', NULL, NULL, NULL, NULL, NULL, NULL, 'TPdtYtchCMyNY5QY1bQX93QXQ4p2Rgi5j1', 'ERC-20', 'ETH', NULL, NULL, 'complete', '2025-02-04 21:36:02', '2025-02-04 21:38:20'),
(24, 64, '8142912639', 750.00, 'crypto', NULL, NULL, NULL, NULL, NULL, NULL, 'TPdtYtchCMyNY5QY1bQX93QXQ4p2Rgi5j1', 'TRC-20', 'Tether', NULL, NULL, 'complete', '2025-02-04 21:36:22', '2025-02-04 21:38:31'),
(25, 64, '1541221376', 10000.00, 'crypto', NULL, NULL, NULL, NULL, NULL, NULL, 'TPdtYtchCMyNY5QY1bQX93QXQ4p2Rgi5j1', 'TRC-20', 'Tether', NULL, NULL, 'complete', '2025-02-04 21:36:39', '2025-02-04 21:38:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `balances`
--
ALTER TABLE `balances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `balances_user_id_foreign` (`user_id`);

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
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposits`
--
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `deposits_transaction_number_unique` (`transaction_number`),
  ADD KEY `deposits_user_id_foreign` (`user_id`);

--
-- Indexes for table `investments`
--
ALTER TABLE `investments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `investments_user_id_foreign` (`user_id`),
  ADD KEY `investments_plan_id_foreign` (`plan_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `referrals`
--
ALTER TABLE `referrals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `referrals_user_id_foreign` (`user_id`),
  ADD KEY `referrals_referred_user_id_foreign` (`referred_user_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transactions_transaction_id_unique` (`transaction_id`),
  ADD KEY `transactions_user_id_foreign` (`user_id`),
  ADD KEY `transactions_withdrawal_id_foreign` (`withdrawal_id`),
  ADD KEY `transactions_investment_id_foreign` (`investment_id`),
  ADD KEY `transactions_transfer_id_foreign` (`transfer_id`);

--
-- Indexes for table `transfers`
--
ALTER TABLE `transfers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transfers_sender_id_foreign` (`sender_id`),
  ADD KEY `transfers_receiver_id_foreign` (`receiver_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_mobile_unique` (`mobile`),
  ADD UNIQUE KEY `users_referral_code_unique` (`referral_code`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `withdrawals_transaction_number_unique` (`transaction_number`),
  ADD KEY `withdrawals_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `balances`
--
ALTER TABLE `balances`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deposits`
--
ALTER TABLE `deposits`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `investments`
--
ALTER TABLE `investments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `referrals`
--
ALTER TABLE `referrals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transfers`
--
ALTER TABLE `transfers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `withdrawals`
--
ALTER TABLE `withdrawals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `balances`
--
ALTER TABLE `balances`
  ADD CONSTRAINT `balances_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `deposits`
--
ALTER TABLE `deposits`
  ADD CONSTRAINT `deposits_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `investments`
--
ALTER TABLE `investments`
  ADD CONSTRAINT `investments_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `investments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `referrals`
--
ALTER TABLE `referrals`
  ADD CONSTRAINT `referrals_referred_user_id_foreign` FOREIGN KEY (`referred_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `referrals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_investment_id_foreign` FOREIGN KEY (`investment_id`) REFERENCES `investments` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `transactions_transfer_id_foreign` FOREIGN KEY (`transfer_id`) REFERENCES `transfers` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_withdrawal_id_foreign` FOREIGN KEY (`withdrawal_id`) REFERENCES `withdrawals` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `transfers`
--
ALTER TABLE `transfers`
  ADD CONSTRAINT `transfers_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transfers_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD CONSTRAINT `withdrawals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2021 at 01:16 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `it_inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `id` int(5) NOT NULL,
  `t24_br` varchar(10) DEFAULT NULL,
  `br_name` varchar(50) DEFAULT NULL,
  `short_name` varchar(20) DEFAULT NULL,
  `br_type` int(1) DEFAULT NULL,
  `cluster_id` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`id`, `t24_br`, `br_name`, `short_name`, `br_type`, `cluster_id`) VALUES
(2, 'BD0010002', 'Gulshan Corporate Branch', 'GCB', 1, NULL),
(3, 'BD0010003', 'Kachua Branch', 'KCU', 1, 6),
(4, 'BD0010004', 'Motijheel Branch', 'MTJ', 1, 1),
(5, 'BD0010005', 'Bakshigonj Branch', 'BKJ', 1, 3),
(6, 'BD0010006', 'Bhulta Branch', 'BHL', 1, 1),
(7, 'BD0010007', 'Haluaghat Branch', 'HLG', 1, 3),
(8, 'BD0010008', 'Chinishpur Branch', 'CNS', 1, 2),
(9, 'BD0010009', 'Shyampur Branch', 'SAM', 1, 1),
(10, 'BD0010010', 'Chandpur Branch', 'CND', 1, 6),
(11, 'BD0010011', 'Polashbari Branch', 'PLS', 1, 2),
(12, 'BD0010012', 'Sreebardi Branch', 'SBD', 1, 3),
(13, 'BD0010013', 'Tarakanda Branch', 'TKD', 1, 3),
(14, 'BD0010014', 'Sherpur Branch', 'SPR', 1, 3),
(15, 'BD0010015', 'Joypara Branch', 'JOY', 1, 1),
(16, 'BD0010016', 'Patuakhali Branch', 'PKL', 1, 5),
(17, 'BD0010017', 'Imamgonj Branch', 'IMJ', 1, 1),
(18, 'BD0010018', 'Aganagar Branch', 'AGR', 1, 1),
(19, 'BD0010019', 'Dumki Branch', 'DMK', 1, 5),
(20, 'BD0010020', 'Jamalpur Branch', 'JML', 1, 3),
(21, 'BD0010021', 'Nalitabari Branch', 'NLT', 1, 3),
(22, 'BD0010022', 'Bogra Branch', 'BOG', 1, 5),
(23, 'BD0010023', 'Khatungonj Branch', 'LGR', 1, 4),
(24, 'BD0010024', 'Lohagara Branch', 'KTG', 1, 4),
(25, 'BD0010025', 'Mawna Branch', 'MAW', 1, 2),
(26, 'BD0010026', 'Kamrangirchor Branch', 'KCR', 1, 1),
(27, 'BD0010027', 'Rahimanagar Branch', 'RGR', 1, 6),
(28, 'BD0010028', 'Siddhirgonj Branch', 'SDG', 1, 1),
(29, 'BD0010029', 'Gridkalindiya Branch', 'GKD', 1, 6),
(30, 'BD0010030', 'Mymensingh Branch', 'MYN', 1, 3),
(31, 'BD0010031', 'Netrokona Branch', 'NTK', 1, 3),
(32, 'BD0010032', 'Keranihat Branch', 'KHT', 1, 4),
(33, 'BD0010033', 'Hazigonj Branch', 'HAJ', 1, 6),
(34, 'BD0010034', 'Kalashkathi Branch', 'KLS', 1, 5),
(35, 'BD0010035', 'Khulna Branch', 'KLN', 1, 5),
(36, 'BD0010036', 'Chandnighat Branch', 'CGT', 1, 4),
(37, 'BD0010037', 'Goalabazar Branch', 'GBR', 1, 4),
(38, 'BD0010038', 'Gopalgonj Branch', 'GPL', 1, 5),
(39, 'BD0010039', 'Mirpur Branch', 'MIR', 1, 2),
(40, 'BD0010040', 'Subidkhali Branch', 'SKL', 1, 5),
(41, 'BD0010041', 'Brahmanbaria Branch', 'BBR', 1, 4),
(42, 'BD0010042', 'Naogaon Branch', 'NAG', 1, 5),
(43, 'BD0010043', 'Narayanpur Branch', 'NPR', 1, 6),
(44, 'BD0010044', 'Cumilla Branch', 'COM', 1, 6),
(45, 'BD0010001', 'Human Resources Division', 'HRD', 2, NULL),
(46, 'BD0010001', 'Information Technology Division', 'ITD', 2, NULL),
(47, 'BD0010001', 'International Division', 'ID', 2, NULL),
(48, 'BD0010001', 'Treasury Division', 'TRD', 2, NULL),
(49, 'BD0010001', 'Financial Administration Division', 'FAD', 2, NULL),
(50, 'BD0010001', 'Banking Operation Division', 'BOD', 2, NULL),
(51, 'BD0010001', 'Office of Chairman', 'OC', 2, NULL),
(52, 'BD0010001', 'Internal Control & Compliance Division', 'ICCD', 2, NULL),
(53, 'BD0010001', 'Board Secretariat', 'BS', 2, NULL),
(54, 'BD0010001', 'Office of MD & CEO', 'MDS', 2, NULL),
(55, 'BD0010001', 'Research & Planning Division', 'REPLD', 2, NULL),
(56, 'BD0010001', 'Law & Recovery Department', 'LRD', 2, NULL),
(57, 'BD0010001', 'Risk Management Division', 'RMD', 2, NULL),
(58, 'BD0010001', 'Credit Admin, Monitoring & Recovery Division', 'CAMRCD', 2, NULL),
(59, 'BD0010001', 'SME, Agri & Rural Banking Division', 'SME', 2, NULL),
(60, 'BD0010001', 'Corporate Banking Division', 'CBD', 2, NULL),
(61, 'BD0010001', 'Credit Risk Management Division', 'CRMD', 2, NULL),
(62, 'BD0010001', 'Retail Banking Division', '', 2, NULL),
(63, 'BD0010001', 'General Services Division', 'GSD', 2, NULL),
(64, 'BD0010001', 'Marketing Division', '', 2, NULL),
(65, 'BD0010001', 'Business Team', '', 2, NULL),
(66, 'BD0010001', 'Office of MD & CEO (CC)', 'OAMD', 2, NULL),
(67, 'BD0010001', 'Recovery Team', 'RT', 2, NULL),
(68, 'BD0010050', 'Bibir Bazar Branch', 'BIB', 1, 6),
(69, 'BD0010051', 'Dhanmondi Branch', 'DHN', 1, 1),
(70, 'BD0010056', 'Tangail Branch', 'TNG', 1, 3),
(71, 'BD0010045', 'Jhenaigati Branch', 'JNG', 1, 3),
(72, 'BD0010046', 'Kalmakanda Branch', 'KND', 1, 3),
(73, 'BD0010001', 'Head Office', 'BNK', 1, NULL),
(75, 'BD0010047', 'Gulshan South Avenue Branch', 'GSA', 1, 2),
(76, 'BD0010048', 'Nilphamari Branch', 'NIL', 1, 5),
(77, 'BD0010049', 'Sujatpur Bazar Branch', 'SJT', 1, 6),
(78, 'BD0010057', 'Kakrail Branch', 'KAK', 1, 1),
(79, 'BD0010052', 'Islampur Branch', 'ISP', 1, 3),
(80, 'BD0010053', 'Shyamgonj Kalibari Bazar Branch', 'SMJ', 1, 3),
(81, 'BD0010054', 'Bashundhara Branch', 'BSN', 1, 2),
(82, 'BD0010055', 'Uttara Branch', 'UTT', 1, 2),
(83, 'BD0010058', 'Kazi Nazrul Islam Avenue Branch', 'KNI', 1, 1),
(84, 'BD0010059', 'Pragati Sarani Branch', 'PSB', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `branch_returns`
--

CREATE TABLE `branch_returns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_or_division_id` int(11) NOT NULL,
  `delivery_person` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_person_mobile_no` varbinary(20) DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `remarks` varchar(300) CHARACTER SET utf8 DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1 = available 0= unavailable',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `branch_return_details`
--

CREATE TABLE `branch_return_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `return_id` bigint(20) NOT NULL,
  `stockin_details_id` bigint(20) NOT NULL,
  `conditions` tinyint(1) NOT NULL DEFAULT 1,
  `reason` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `deleted_at`, `deleted_by`, `created_at`, `updated_at`) VALUES
(1, 'HP', NULL, NULL, '2021-08-29 10:50:19', '2021-08-29 10:51:10'),
(2, 'Acer', NULL, NULL, '2021-08-29 10:51:33', '2021-08-29 10:51:42'),
(3, 'Dell', NULL, NULL, '2021-09-07 08:31:41', '2021-09-07 08:31:41');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `deleted_at`, `deleted_by`, `created_at`, `updated_at`) VALUES
(1, 'Hardware', NULL, NULL, '2021-08-25 06:38:16', '2021-08-25 06:38:16'),
(2, 'Software', NULL, NULL, '2021-08-25 06:38:25', '2021-08-25 06:38:25'),
(3, 'Test Group', NULL, NULL, '2021-10-24 09:25:18', '2021-10-24 09:25:29');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `concat_person` varbinary(150) NOT NULL,
  `mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deliver_to_branches`
--

CREATE TABLE `deliver_to_branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` int(11) NOT NULL,
  `requisition_no` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_person` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_person_mobile_no` varbinary(20) DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1 = available 0= unavailable',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2020_04_13_044143_create_permission_tables', 1),
(10, '2020_04_22_120306_create_otps', 1),
(11, '2020_04_22_120314_create_otp_counts', 1),
(12, '2020_06_10_145012_create_companies', 1),
(13, '2020_06_10_145140_create_products', 1),
(14, '2020_06_12_114311_create_oreders', 1),
(15, '2020_06_12_114705_create_oreder_details', 1),
(16, '2020_06_14_221531_create_daily_sells', 1),
(17, '2020_06_15_165650_create_categories', 1),
(18, '2020_06_17_122639_create_monthly_sells', 1),
(19, '2020_06_17_163429_create_expense_categories', 1),
(20, '2020_06_17_163731_create_expenses', 1),
(21, '2020_06_18_115525_create_customers', 1),
(22, '2020_06_18_120008_create_customer_dues', 1),
(23, '2020_06_27_145957_create_daily_balances', 1),
(24, '2020_06_28_113043_create_computer_work', 1),
(25, '2020_06_30_120845_create_return_items', 1),
(26, '2020_07_02_100159_create_loan_providers', 1),
(27, '2020_07_02_101025_create_loan_details', 1),
(28, '2021_06_08_013550_create_selling_products_table', 1),
(29, '2021_06_08_014400_create_suppliers_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1),
(1, 'App\\User', 2);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `otps`
--

CREATE TABLE `otps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `mobile` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` enum('system','visitor') COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `otp_counts`
--

CREATE TABLE `otp_counts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `mobile` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `count` int(10) UNSIGNED NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` enum('system','visitor') COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'System User Management', 'web', '2021-08-24 06:40:14', '2021-08-24 06:40:14'),
(2, 'Role Management', 'web', '2021-08-24 06:40:14', '2021-08-24 06:40:14'),
(3, 'Product Management', 'web', '2021-08-24 06:40:14', '2021-08-24 06:40:14'),
(4, 'Invoice Management', 'web', '2021-08-24 06:40:15', '2021-08-24 06:40:15'),
(5, 'Administration', 'web', '2021-08-24 06:40:15', '2021-08-24 06:40:15'),
(6, 'Settings', 'web', '2021-08-24 06:40:15', '2021-08-24 06:40:15'),
(7, 'Company Management', 'web', '2021-08-24 06:40:15', '2021-08-24 06:40:15'),
(8, 'Report Manager', 'web', '2021-08-24 06:40:15', '2021-08-24 06:40:15'),
(9, 'Expense Category', 'web', '2021-08-24 06:40:15', '2021-08-24 06:40:15'),
(10, 'Expense Management', 'web', '2021-08-24 06:40:15', '2021-08-24 06:40:15'),
(11, 'Customer Management', 'web', '2021-08-24 06:40:15', '2021-08-24 06:40:15'),
(12, 'Customer Due Management', 'web', '2021-08-24 06:40:15', '2021-08-24 06:40:15'),
(13, 'Loan Management', 'web', '2021-08-24 06:40:15', '2021-08-24 06:40:15'),
(14, 'Stock Management', 'web', '2021-09-09 07:11:38', '2021-09-01 07:11:16');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `available_qty` int(11) NOT NULL,
  `depriciation_period` tinyint(2) NOT NULL COMMENT 'In year',
  `depriciation_amount` int(11) NOT NULL COMMENT 'Taka',
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1 = available 0= unavailable',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category_id`, `sub_category_id`, `brand_id`, `available_qty`, `depriciation_period`, `depriciation_amount`, `status`, `deleted_at`, `deleted_by`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(8, 'HRM Version 1.0', 1, 2, 2, 1, 3, 100000, 1, NULL, NULL, '2021-10-28 05:57:53', 1, '2021-10-31 05:41:57', NULL),
(9, 'DELL Mouse 300', 1, 1, 3, 0, 2, 150, 1, NULL, NULL, '2021-10-28 05:59:57', 1, '2021-10-31 05:29:01', NULL),
(10, 'Test Mouse Wireless', 3, 1, 1, 1, 3, 200, 1, NULL, NULL, '2021-10-28 06:01:26', 1, '2021-10-31 05:41:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `receive_product_details`
--

CREATE TABLE `receive_product_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `repair_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `qty` int(11) NOT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `repair_product_details`
--

CREATE TABLE `repair_product_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `repair_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `product_unique_id` bigint(20) NOT NULL,
  `problem_desc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `return_items`
--

CREATE TABLE `return_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `qty` int(11) NOT NULL,
  `unit_price` double(10,2) NOT NULL,
  `total_price` double(10,2) NOT NULL,
  `discount` double(10,2) NOT NULL,
  `returnable_amount` double(10,2) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'web', '2021-08-24 06:40:15', '2021-08-24 06:40:15');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1);

-- --------------------------------------------------------

--
-- Table structure for table `send_to_repair`
--

CREATE TABLE `send_to_repair` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `delivery_person` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_person_mobile_no` varbinary(20) DEFAULT NULL,
  `send_date` date NOT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stockout_details`
--

CREATE TABLE `stockout_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stockout_id` bigint(20) UNSIGNED NOT NULL,
  `stockin_details_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) UNSIGNED NOT NULL DEFAULT 1,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stockout_details`
--

INSERT INTO `stockout_details` (`id`, `stockout_id`, `stockin_details_id`, `quantity`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(9, 35, 33, 1, 1, '2021-10-28 07:20:32', NULL, NULL),
(10, 35, 35, 1, 1, '2021-10-28 07:20:32', NULL, NULL),
(11, 37, 34, 1, 1, '2021-10-28 09:51:14', NULL, NULL),
(12, 38, 36, 1, 1, '2021-10-31 05:23:44', NULL, NULL),
(13, 38, 37, 1, 1, '2021-10-31 05:23:45', NULL, NULL),
(14, 38, 39, 1, 1, '2021-10-31 05:23:45', NULL, NULL),
(15, 39, 38, 1, 1, '2021-10-31 05:29:01', NULL, NULL),
(16, 40, 40, 1, 1, '2021-10-31 05:41:57', NULL, NULL),
(17, 40, 42, 1, 1, '2021-10-31 05:41:57', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stock_details`
--

CREATE TABLE `stock_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stockin_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `unit_price` double(10,2) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` double(10,2) DEFAULT NULL,
  `purchase_date` date NOT NULL,
  `warranty_period` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warranty_ymd` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `warranty_expiry_date` date NOT NULL,
  `unique_id` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=in_stock, 2=delivered,\r\n3=returned,\r\n4=in_vendor,\r\n5=from_vendor,\r\n10=damaged',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock_details`
--

INSERT INTO `stock_details` (`id`, `stockin_id`, `product_id`, `unit_price`, `quantity`, `total_price`, `purchase_date`, `warranty_period`, `warranty_ymd`, `warranty_expiry_date`, `unique_id`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(33, 68, 8, 300000.00, 1, 300000.00, '2021-10-28', '2', 'y', '2023-10-28', 'HRM 1.0', 1, '2021-10-28 06:03:43', NULL, NULL),
(34, 68, 10, 600.00, 1, 600.00, '2021-10-28', '3', 'y', '2024-10-28', 'WIreless_MOUSE_', 1, '2021-10-28 06:03:43', NULL, NULL),
(35, 68, 9, 300.00, 1, 300.00, '2021-10-28', '2', 'y', '2023-10-28', 'DELL_MOUSE_001', 1, '2021-10-28 06:03:43', NULL, NULL),
(36, 69, 9, 300.00, 1, 300.00, '2021-10-31', '2', 'y', '2023-10-31', 'MOUSE003', 1, '2021-10-31 05:21:54', NULL, NULL),
(37, 69, 9, 300.00, 1, 300.00, '2021-10-31', '2', 'y', '2023-10-31', 'MOUSE004', 1, '2021-10-31 05:21:54', NULL, NULL),
(38, 69, 9, 300.00, 1, 300.00, '2021-10-31', '2', 'y', '2023-10-31', 'MOUSE05', 1, '2021-10-31 05:21:54', NULL, NULL),
(39, 69, 10, 600.00, 1, 600.00, '2021-10-31', '3', 'y', '2024-10-31', 'MOUSE006', 1, '2021-10-31 05:21:54', NULL, NULL),
(40, 70, 8, 300000.00, 1, 300000.00, '2021-10-31', '3', 'y', '2024-10-31', 'HRM003', 15, '2021-10-31 05:40:43', '2021-10-31 05:41:57', NULL),
(41, 70, 8, 400000.00, 1, 400000.00, '2021-10-31', '5', 'y', '2026-10-31', 'HRM004', 1, '2021-10-31 05:40:43', NULL, NULL),
(42, 70, 10, 600.00, 1, 600.00, '2021-10-31', '3', 'y', '2024-10-31', 'MOUSE007', 15, '2021-10-31 05:40:43', '2021-10-31 05:41:57', NULL),
(43, 70, 10, 600.00, 1, 600.00, '2021-10-31', '3', 'y', '2024-10-31', 'MOUSE008', 1, '2021-10-31 05:40:43', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stock_in`
--

CREATE TABLE `stock_in` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_no` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `registration_no` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `narration` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock_in`
--

INSERT INTO `stock_in` (`id`, `invoice_no`, `registration_no`, `narration`, `supplier_id`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(68, 'INV001', 'REG001', 'nrrrrr', 1, 1, 1, NULL, NULL, '2021-10-28 06:03:43', '2021-10-28 06:03:43', NULL),
(69, 'INV002', 'REG002', 'Inv 2 reg 2', 1, 1, 1, NULL, NULL, '2021-10-31 05:21:54', '2021-10-31 05:21:54', NULL),
(70, 'INV003', 'REG003', 'MOUSE and HRM', 2, 1, 1, NULL, NULL, '2021-10-31 05:40:43', '2021-10-31 05:40:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stock_outs`
--

CREATE TABLE `stock_outs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `challan_no` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_or_division_id` bigint(20) UNSIGNED NOT NULL,
  `requisition_no` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_date` date NOT NULL,
  `narration` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock_outs`
--

INSERT INTO `stock_outs` (`id`, `challan_no`, `branch_or_division_id`, `requisition_no`, `delivery_date`, `narration`, `status`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(35, 'CHA0001', 4, 'REQ0001', '2021-10-28', 'wewww', 1, '2021-10-28 07:20:32', '2021-10-28 07:20:32', NULL, 1, NULL, NULL),
(37, 'CHA002', 5, 'REQ002', '2021-10-20', 'dsf fgdfgd', 1, '2021-10-28 09:51:14', '2021-10-28 09:51:14', NULL, 1, NULL, NULL),
(38, 'CHA003', 81, 'REQ003', '2021-10-31', 'mouses for bashundhara', 1, '2021-10-31 05:23:44', '2021-10-31 05:23:44', NULL, 1, NULL, NULL),
(39, 'CHA004', 6, 'REQ004', '2021-10-31', 'bhulta br ch 04, req 04,', 1, '2021-10-31 05:29:01', '2021-10-31 05:29:01', NULL, 1, NULL, NULL),
(40, 'CHA005', 22, 'REQ005', '2021-10-31', 'BOGRA 05', 1, '2021-10-31 05:41:57', '2021-10-31 05:41:57', NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `category_id`, `name`, `deleted_at`, `deleted_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'Mouse', NULL, NULL, '2021-08-29 06:53:46', '2021-08-29 06:53:46'),
(2, 2, 'HRM', NULL, NULL, '2021-09-05 06:59:05', '2021-09-05 06:59:05');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_contact_person` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_contact_no` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `supplier_name`, `supplier_contact_person`, `supplier_contact_no`, `supplier_address`, `deleted_at`, `deleted_by`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Ryans Electronics', 'Zahirul Islam', '01677888999', 'Agargaon, Dhaka', NULL, NULL, NULL, NULL, '2021-09-01 10:28:20', '2021-09-01 10:28:20'),
(2, 'Computer Source', 'Jobayer Khan', '01777555111', 'Dhaka', NULL, NULL, NULL, NULL, '2021-09-01 10:43:31', '2021-09-01 10:52:58'),
(3, 'Bashundhara Electronics', 'Roman Prodhan', '01333444555', 'Dhaka, Bangladesh', '2021-09-01 11:14:09', 1, 1, 1, '2021-09-01 10:59:13', '2021-09-01 11:14:09'),
(4, 'Network Supplierrrr', 'Anowar Hossennnnn', '01322444521', 'Gulshan, Dhakaaa', NULL, NULL, 1, 1, '2021-09-05 05:50:46', '2021-09-05 05:51:15'),
(5, 'Supplier Company Name Test', 'Supplier Contact', '01322444232', 'dha', '2021-09-06 10:23:46', 1, 1, NULL, '2021-09-05 06:52:21', '2021-09-06 10:23:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('system','visitor') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'visitor',
  `api_token` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `mobile_no`, `email`, `password`, `type`, `api_token`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', '01675923371', 'admin@gmail.com', '$2a$12$tva0lBcc5nsblMEf5vdeDuuwQ2Pf6gjl4O5X7S55BM/ZD6RG.ILJ6', 'system', NULL, NULL, NULL, '2021-08-24 06:40:16', '2021-08-24 06:40:16'),
(2, 'Jobayed Ullah', '01763353145', 'shuvo.pma@gmail.com', '$2y$10$JtQGdH.EQykcvjKdvAAAbuzs2EL7dugHjv3J7qwNKhN4KtIUk9Egi', 'system', NULL, NULL, NULL, '2021-10-26 09:28:05', '2021-10-26 09:28:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branch_returns`
--
ALTER TABLE `branch_returns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branch_return_details`
--
ALTER TABLE `branch_return_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deliver_to_branches`
--
ALTER TABLE `deliver_to_branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `otps`
--
ALTER TABLE `otps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `otps_user_id_foreign` (`user_id`),
  ADD KEY `otps_mobile_index` (`mobile`),
  ADD KEY `otps_token_index` (`token`);

--
-- Indexes for table `otp_counts`
--
ALTER TABLE `otp_counts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `otp_counts_user_id_foreign` (`user_id`),
  ADD KEY `otp_counts_mobile_index` (`mobile`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receive_product_details`
--
ALTER TABLE `receive_product_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `repair_product_details`
--
ALTER TABLE `repair_product_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `return_items`
--
ALTER TABLE `return_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `send_to_repair`
--
ALTER TABLE `send_to_repair`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stockout_details`
--
ALTER TABLE `stockout_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_details`
--
ALTER TABLE `stock_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_in`
--
ALTER TABLE `stock_in`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_outs`
--
ALTER TABLE `stock_outs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_mobile_no_type_unique` (`mobile_no`,`type`),
  ADD UNIQUE KEY `users_email_type_unique` (`email`,`type`),
  ADD UNIQUE KEY `users_api_token_unique` (`api_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `branch_returns`
--
ALTER TABLE `branch_returns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `branch_return_details`
--
ALTER TABLE `branch_return_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deliver_to_branches`
--
ALTER TABLE `deliver_to_branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `otps`
--
ALTER TABLE `otps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `otp_counts`
--
ALTER TABLE `otp_counts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `receive_product_details`
--
ALTER TABLE `receive_product_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `repair_product_details`
--
ALTER TABLE `repair_product_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `return_items`
--
ALTER TABLE `return_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `send_to_repair`
--
ALTER TABLE `send_to_repair`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stockout_details`
--
ALTER TABLE `stockout_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `stock_details`
--
ALTER TABLE `stock_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `stock_in`
--
ALTER TABLE `stock_in`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `stock_outs`
--
ALTER TABLE `stock_outs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `otps`
--
ALTER TABLE `otps`
  ADD CONSTRAINT `otps_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION;

--
-- Constraints for table `otp_counts`
--
ALTER TABLE `otp_counts`
  ADD CONSTRAINT `otp_counts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2020 at 10:41 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `employee`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'admin@admin.com', NULL, '$2y$10$Sz/WWKDHhBq.TARRBEEfK.MuIP3jH0lDS6FYS.U/3MBE8sc4Oi4P6', NULL, '2020-08-20 19:02:54', '2020-08-20 19:02:54'),
(2, 'Writer Admin', 'writer@writer.com', NULL, '$2y$10$/nAU1UuI6k7BlHlJnV2eEOIB42OtINhLuAmGWbJOrh2m5aeyfyUpS', NULL, '2020-08-20 19:02:54', '2020-08-20 19:02:54');

-- --------------------------------------------------------

--
-- Table structure for table `agreements`
--

CREATE TABLE `agreements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agreements`
--

INSERT INTO `agreements` (`id`, `created_at`, `updated_at`) VALUES
(1, '2020-08-20 19:02:54', '2020-08-20 19:02:54'),
(2, '2020-08-20 19:02:55', '2020-08-20 19:02:55'),
(3, '2020-08-20 19:02:55', '2020-08-20 19:02:55');

-- --------------------------------------------------------

--
-- Table structure for table `agreement_translations`
--

CREATE TABLE `agreement_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `agreement_id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agreement_translations`
--

INSERT INTO `agreement_translations` (`id`, `agreement_id`, `locale`, `title`) VALUES
(1, 1, 'ar', 'راتب شهري ثابت'),
(2, 1, 'en', 'A fixed monthly salary'),
(3, 1, 'fr', 'Une allocation mensuelle fixe'),
(4, 2, 'ar', 'راتب مع مكافأه علي نسبة انجاز'),
(5, 2, 'en', 'A salary with a bonus on the percentage of completion'),
(6, 2, 'fr', 'Un salaire avec une prime sur le pourcentage d\'avancement'),
(7, 3, 'ar', 'مكافأه علي نسبة انجاز'),
(8, 3, 'en', 'Reward for achievement'),
(9, 3, 'fr', 'Récompense pour réussite');

-- --------------------------------------------------------

--
-- Table structure for table `bids`
--

CREATE TABLE `bids` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bids`
--

INSERT INTO `bids` (`id`, `description`, `job_id`, `employee_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'استطيع القيام بالعمل', 2, 1, 1, NULL, '2020-08-21 21:41:50', '2020-08-22 16:19:23');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `bio` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `block` tinyint(4) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `email`, `email_verified_at`, `photo`, `bio`, `phone`, `website`, `password`, `block`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Company Account', 'company@company.com', NULL, 'default.png', NULL, NULL, NULL, '$2y$10$y7D6uvVOTc5bJCyd.7q24uFmlS0.0B54Na8wFYoe4eunmozOsps4y', 0, NULL, '2020-08-20 19:02:54', '2020-08-20 19:02:54');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `conventions`
--

CREATE TABLE `conventions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `agreement_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `conventions`
--

INSERT INTO `conventions` (`id`, `agreement_id`, `created_at`, `updated_at`) VALUES
(1, 2, '2020-08-20 19:03:29', '2020-08-20 19:03:29');

-- --------------------------------------------------------

--
-- Table structure for table `convention_translations`
--

CREATE TABLE `convention_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `convention_id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `main_items` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_items` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `convention_translations`
--

INSERT INTO `convention_translations` (`id`, `convention_id`, `locale`, `main_items`, `sub_items`) VALUES
(1, 1, 'en', '<p>dsa</p>', '<p>dsa</p>'),
(2, 1, 'ar', '<p>dsa</p>', '<p>dsa</p>'),
(3, 1, 'fr', '<p>dsa</p>', '<p>dsa</p>');

-- --------------------------------------------------------

--
-- Table structure for table `corporations`
--

CREATE TABLE `corporations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `corporation_translations`
--

CREATE TABLE `corporation_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `corporation_id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `created_at`, `updated_at`) VALUES
(1, '2020-08-20 19:02:56', '2020-08-20 19:02:56');

-- --------------------------------------------------------

--
-- Table structure for table `department_translations`
--

CREATE TABLE `department_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `department_translations`
--

INSERT INTO `department_translations` (`id`, `department_id`, `locale`, `title`) VALUES
(1, 1, 'ar', 'غير مصنف'),
(2, 1, 'en', 'unclassified'),
(3, 1, 'fr', 'non classé');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `bio` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `languages` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `block` int(11) NOT NULL DEFAULT 0,
  `work_from` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `work_to` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `work_days_in_week` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `email`, `email_verified_at`, `password`, `photo`, `bio`, `languages`, `country`, `block`, `work_from`, `work_to`, `work_days_in_week`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Employee Account', 'employee@employee.com', NULL, '$2y$10$PgQtdjjuEgRoVEAoA6HOJ.Q/M7tsc9hPT2480301x3.OCipeHUcam', 'default.png', NULL, '[\"Arabic\",\"English\"]', NULL, 0, '1:00 AM', '9:00 PM', 4, NULL, '2020-08-20 19:02:54', '2020-08-20 19:02:54');

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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `job_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `convention_id` bigint(20) UNSIGNED DEFAULT NULL,
  `work_from` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `work_to` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `work_days_in_week` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salary` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `helper_type` bigint(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `refusal_details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `company_id`, `job_type_id`, `convention_id`, `work_from`, `work_to`, `work_days_in_week`, `salary`, `helper_type`, `status`, `refusal_details`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 1, 2, 1, '1:30 AM', '2:30 AM', '4', '500', 1, 4, 'yregtd', '2020-08-21 16:22:26', '2020-08-21 20:36:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `job_translations`
--

CREATE TABLE `job_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_translations`
--

INSERT INTO `job_translations` (`id`, `job_id`, `locale`, `title`, `description`) VALUES
(4, 2, 'en', '25434', '<p>354354</p>'),
(5, 2, 'ar', '354', '<p>354</p>'),
(6, 2, 'fr', '354354', '<p>354354</p>');

-- --------------------------------------------------------

--
-- Table structure for table `job_types`
--

CREATE TABLE `job_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_types`
--

INSERT INTO `job_types` (`id`, `company_id`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, '2020-08-20 19:05:43', '2020-08-20 19:05:43'),
(2, 1, 1, '2020-08-20 19:05:51', '2020-08-20 19:05:51');

-- --------------------------------------------------------

--
-- Table structure for table `job_type_translations`
--

CREATE TABLE `job_type_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_type_id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_type_translations`
--

INSERT INTO `job_type_translations` (`id`, `job_type_id`, `locale`, `title`) VALUES
(1, 1, 'en', '0101'),
(2, 1, 'ar', '3543'),
(3, 1, 'fr', '345345'),
(4, 2, 'en', '345354'),
(5, 2, 'ar', '35445'),
(6, 2, 'fr', '354354');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direction` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ltr',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `code`, `locale`, `direction`, `created_at`, `updated_at`) VALUES
(1, 'English', 'us', 'en', 'ltr', '2020-08-20 19:02:54', '2020-08-20 19:02:54'),
(2, 'Arabic', 'ae', 'ar', 'rtl', '2020-08-20 19:02:54', '2020-08-20 19:02:54'),
(3, 'French', 'fr', 'fr', 'ltr', '2020-08-20 19:02:54', '2020-08-20 19:02:54');

-- --------------------------------------------------------

--
-- Table structure for table `language_configs`
--

CREATE TABLE `language_configs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `var` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `language_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meals`
--

CREATE TABLE `meals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `offer_type` tinyint(4) NOT NULL,
  `block` tinyint(4) NOT NULL DEFAULT 0,
  `price` int(11) NOT NULL DEFAULT 0,
  `offer_price` int(11) NOT NULL DEFAULT 0,
  `start_offer_at` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end_offer_at` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meal_product`
--

CREATE TABLE `meal_product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `meal_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meal_translations`
--

CREATE TABLE `meal_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `meal_id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2020_08_08_130038_create_admins_table', 1),
(4, '2020_08_09_132109_create_languages_table', 1),
(5, '2020_08_09_132449_create_language_configs_table', 1),
(6, '2020_08_09_185349_create_companies_table', 1),
(7, '2020_08_10_171054_create_plans_table', 1),
(8, '2020_08_11_170128_create_agreements_table', 1),
(9, '2020_08_11_174526_create_conventions_table', 1),
(10, '2020_08_11_235012_create_employee_table', 1),
(11, '2020_08_12_153608_create_support_systems_table', 1),
(12, '2020_08_12_163901_create_contact_us_table', 1),
(13, '2020_08_13_032333_create_departments_table', 1),
(14, '2020_08_13_034054_create_products_table', 1),
(15, '2020_08_13_043227_create_related_products_table', 1),
(16, '2020_08_13_165910_create_meals_table', 1),
(17, '2020_08_13_171407_create_meal_product_table', 1),
(18, '2020_08_14_091822_create_questions_table', 1),
(19, '2020_08_14_095112_create_service_categories_table', 1),
(20, '2020_08_14_100722_create_services_table', 1),
(21, '2020_08_16_165240_create_skills_table', 1),
(22, '2020_08_16_185859_create_skill_employee_table', 1),
(23, '2020_08_16_194931_create_permission_tables', 1),
(24, '2020_08_18_190908_create_corporations_table', 1),
(25, '2020_08_18_203612_create_job_types_table', 1),
(26, '2020_08_19_194053_create_jobs_table', 1),
(27, '2020_08_21_153255_create_missions_table', 2),
(29, '2020_08_21_184202_create_bids_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `missions`
--

CREATE TABLE `missions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `missions`
--

INSERT INTO `missions` (`id`, `company_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(5, 1, 2, NULL, '2020-08-21 14:37:57', '2020-08-21 14:38:22');

-- --------------------------------------------------------

--
-- Table structure for table `mission_translations`
--

CREATE TABLE `mission_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mission_id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mission` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mission_translations`
--

INSERT INTO `mission_translations` (`id`, `mission_id`, `locale`, `mission`) VALUES
(10, 5, 'en', '687687'),
(11, 5, 'ar', '687687'),
(12, 5, 'fr', '687678');

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_permissions`
--

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\Admin', 1),
(2, 'App\\Models\\Admin', 1),
(3, 'App\\Models\\Admin', 1),
(4, 'App\\Models\\Admin', 1),
(5, 'App\\Models\\Admin', 1),
(6, 'App\\Models\\Admin', 1),
(7, 'App\\Models\\Admin', 1),
(8, 'App\\Models\\Admin', 1),
(9, 'App\\Models\\Admin', 1),
(10, 'App\\Models\\Admin', 1),
(11, 'App\\Models\\Admin', 1),
(12, 'App\\Models\\Admin', 1),
(13, 'App\\Models\\Admin', 1),
(14, 'App\\Models\\Admin', 1),
(15, 'App\\Models\\Admin', 1),
(16, 'App\\Models\\Admin', 1),
(17, 'App\\Models\\Admin', 1),
(18, 'App\\Models\\Admin', 1),
(19, 'App\\Models\\Admin', 1),
(20, 'App\\Models\\Admin', 1),
(21, 'App\\Models\\Admin', 1),
(22, 'App\\Models\\Admin', 1),
(23, 'App\\Models\\Admin', 1),
(24, 'App\\Models\\Admin', 1),
(25, 'App\\Models\\Admin', 1),
(26, 'App\\Models\\Admin', 1),
(27, 'App\\Models\\Admin', 1),
(28, 'App\\Models\\Admin', 1),
(29, 'App\\Models\\Admin', 1),
(30, 'App\\Models\\Admin', 1),
(31, 'App\\Models\\Admin', 1),
(32, 'App\\Models\\Admin', 1),
(33, 'App\\Models\\Admin', 1),
(34, 'App\\Models\\Admin', 1),
(35, 'App\\Models\\Admin', 1),
(36, 'App\\Models\\Admin', 1),
(37, 'App\\Models\\Admin', 1),
(38, 'App\\Models\\Admin', 1),
(39, 'App\\Models\\Admin', 1),
(40, 'App\\Models\\Admin', 1),
(41, 'App\\Models\\Admin', 1),
(42, 'App\\Models\\Admin', 1),
(43, 'App\\Models\\Admin', 1),
(44, 'App\\Models\\Admin', 1),
(45, 'App\\Models\\Admin', 1),
(46, 'App\\Models\\Admin', 1),
(47, 'App\\Models\\Admin', 1),
(48, 'App\\Models\\Admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'create_companies', 'admin', '2020-08-20 19:02:56', '2020-08-20 19:02:56'),
(2, 'read_companies', 'admin', '2020-08-20 19:02:57', '2020-08-20 19:02:57'),
(3, 'update_companies', 'admin', '2020-08-20 19:02:57', '2020-08-20 19:02:57'),
(4, 'delete_companies', 'admin', '2020-08-20 19:02:57', '2020-08-20 19:02:57'),
(5, 'create_plans', 'admin', '2020-08-20 19:02:57', '2020-08-20 19:02:57'),
(6, 'read_plans', 'admin', '2020-08-20 19:02:57', '2020-08-20 19:02:57'),
(7, 'update_plans', 'admin', '2020-08-20 19:02:57', '2020-08-20 19:02:57'),
(8, 'delete_plans', 'admin', '2020-08-20 19:02:57', '2020-08-20 19:02:57'),
(9, 'create_employees', 'admin', '2020-08-20 19:02:57', '2020-08-20 19:02:57'),
(10, 'read_employees', 'admin', '2020-08-20 19:02:57', '2020-08-20 19:02:57'),
(11, 'update_employees', 'admin', '2020-08-20 19:02:57', '2020-08-20 19:02:57'),
(12, 'delete_employees', 'admin', '2020-08-20 19:02:57', '2020-08-20 19:02:57'),
(13, 'create_support-systems', 'admin', '2020-08-20 19:02:57', '2020-08-20 19:02:57'),
(14, 'read_support-systems', 'admin', '2020-08-20 19:02:57', '2020-08-20 19:02:57'),
(15, 'update_support-systems', 'admin', '2020-08-20 19:02:57', '2020-08-20 19:02:57'),
(16, 'delete_support-systems', 'admin', '2020-08-20 19:02:57', '2020-08-20 19:02:57'),
(17, 'create_departments', 'admin', '2020-08-20 19:02:57', '2020-08-20 19:02:57'),
(18, 'read_departments', 'admin', '2020-08-20 19:02:57', '2020-08-20 19:02:57'),
(19, 'update_departments', 'admin', '2020-08-20 19:02:58', '2020-08-20 19:02:58'),
(20, 'delete_departments', 'admin', '2020-08-20 19:02:58', '2020-08-20 19:02:58'),
(21, 'create_blacklist', 'admin', '2020-08-20 19:02:58', '2020-08-20 19:02:58'),
(22, 'read_blacklist', 'admin', '2020-08-20 19:02:58', '2020-08-20 19:02:58'),
(23, 'update_blacklist', 'admin', '2020-08-20 19:02:58', '2020-08-20 19:02:58'),
(24, 'delete_blacklist', 'admin', '2020-08-20 19:02:58', '2020-08-20 19:02:58'),
(25, 'create_skills', 'admin', '2020-08-20 19:02:58', '2020-08-20 19:02:58'),
(26, 'read_skills', 'admin', '2020-08-20 19:02:58', '2020-08-20 19:02:58'),
(27, 'update_skills', 'admin', '2020-08-20 19:02:58', '2020-08-20 19:02:58'),
(28, 'delete_skills', 'admin', '2020-08-20 19:02:58', '2020-08-20 19:02:58'),
(29, 'create_agreements', 'admin', '2020-08-20 19:02:58', '2020-08-20 19:02:58'),
(30, 'read_agreements', 'admin', '2020-08-20 19:02:58', '2020-08-20 19:02:58'),
(31, 'update_agreements', 'admin', '2020-08-20 19:02:58', '2020-08-20 19:02:58'),
(32, 'delete_agreements', 'admin', '2020-08-20 19:02:58', '2020-08-20 19:02:58'),
(33, 'create_contact-us', 'admin', '2020-08-20 19:02:58', '2020-08-20 19:02:58'),
(34, 'read_contact-us', 'admin', '2020-08-20 19:02:58', '2020-08-20 19:02:58'),
(35, 'update_contact-us', 'admin', '2020-08-20 19:02:58', '2020-08-20 19:02:58'),
(36, 'delete_contact-us', 'admin', '2020-08-20 19:02:58', '2020-08-20 19:02:58'),
(37, 'create_settings', 'admin', '2020-08-20 19:02:58', '2020-08-20 19:02:58'),
(38, 'read_settings', 'admin', '2020-08-20 19:02:58', '2020-08-20 19:02:58'),
(39, 'update_settings', 'admin', '2020-08-20 19:02:58', '2020-08-20 19:02:58'),
(40, 'delete_settings', 'admin', '2020-08-20 19:02:58', '2020-08-20 19:02:58'),
(41, 'create_languages', 'admin', '2020-08-20 19:02:58', '2020-08-20 19:02:58'),
(42, 'read_languages', 'admin', '2020-08-20 19:02:59', '2020-08-20 19:02:59'),
(43, 'update_languages', 'admin', '2020-08-20 19:02:59', '2020-08-20 19:02:59'),
(44, 'delete_languages', 'admin', '2020-08-20 19:02:59', '2020-08-20 19:02:59'),
(45, 'create_admins', 'admin', '2020-08-20 19:02:59', '2020-08-20 19:02:59'),
(46, 'read_admins', 'admin', '2020-08-20 19:02:59', '2020-08-20 19:02:59'),
(47, 'update_admins', 'admin', '2020-08-20 19:02:59', '2020-08-20 19:02:59'),
(48, 'delete_admins', 'admin', '2020-08-20 19:02:59', '2020-08-20 19:02:59');

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `price` double(8,2) NOT NULL,
  `number_of_jobs` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plan_translations`
--

CREATE TABLE `plan_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `plan_id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `quantity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `loyalty_points` int(11) NOT NULL DEFAULT 0,
  `recommended` tinyint(4) NOT NULL DEFAULT 0,
  `block` tinyint(4) NOT NULL DEFAULT 0,
  `price` int(11) NOT NULL DEFAULT 0,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_translations`
--

CREATE TABLE `product_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `question_translations`
--

CREATE TABLE `question_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `related_products`
--

CREATE TABLE `related_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `related_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `service_category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_categories`
--

CREATE TABLE `service_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_category_translations`
--

CREATE TABLE `service_category_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_category_id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_translations`
--

CREATE TABLE `service_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `skill_employee`
--

CREATE TABLE `skill_employee` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `skill_id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `skill_translations`
--

CREATE TABLE `skill_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `skill_id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_systems`
--

CREATE TABLE `support_systems` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_system_translations`
--

CREATE TABLE `support_system_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `support_system_id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `agreements`
--
ALTER TABLE `agreements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agreement_translations`
--
ALTER TABLE `agreement_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `agreement_translations_agreement_id_locale_unique` (`agreement_id`,`locale`),
  ADD KEY `agreement_translations_locale_index` (`locale`);

--
-- Indexes for table `bids`
--
ALTER TABLE `bids`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bids_job_id_foreign` (`job_id`),
  ADD KEY `bids_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `companies_email_unique` (`email`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conventions`
--
ALTER TABLE `conventions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `conventions_agreement_id_foreign` (`agreement_id`);

--
-- Indexes for table `convention_translations`
--
ALTER TABLE `convention_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `convention_translations_convention_id_locale_unique` (`convention_id`,`locale`),
  ADD KEY `convention_translations_locale_index` (`locale`);

--
-- Indexes for table `corporations`
--
ALTER TABLE `corporations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `corporations_company_id_foreign` (`company_id`);

--
-- Indexes for table `corporation_translations`
--
ALTER TABLE `corporation_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `corporation_translations_corporation_id_locale_unique` (`corporation_id`,`locale`),
  ADD KEY `corporation_translations_locale_index` (`locale`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department_translations`
--
ALTER TABLE `department_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `department_translations_department_id_locale_unique` (`department_id`,`locale`),
  ADD KEY `department_translations_locale_index` (`locale`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employees_email_unique` (`email`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_company_id_foreign` (`company_id`),
  ADD KEY `jobs_job_type_id_foreign` (`job_type_id`),
  ADD KEY `jobs_convention_id_foreign` (`convention_id`);

--
-- Indexes for table `job_translations`
--
ALTER TABLE `job_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `job_translations_job_id_locale_unique` (`job_id`,`locale`),
  ADD KEY `job_translations_locale_index` (`locale`);

--
-- Indexes for table `job_types`
--
ALTER TABLE `job_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_types_company_id_foreign` (`company_id`),
  ADD KEY `job_types_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `job_type_translations`
--
ALTER TABLE `job_type_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `job_type_translations_job_type_id_locale_unique` (`job_type_id`,`locale`),
  ADD KEY `job_type_translations_locale_index` (`locale`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `language_configs`
--
ALTER TABLE `language_configs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `language_configs_language_id_foreign` (`language_id`);

--
-- Indexes for table `meals`
--
ALTER TABLE `meals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `meals_department_id_foreign` (`department_id`),
  ADD KEY `meals_company_id_foreign` (`company_id`);

--
-- Indexes for table `meal_product`
--
ALTER TABLE `meal_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `meal_product_meal_id_foreign` (`meal_id`);

--
-- Indexes for table `meal_translations`
--
ALTER TABLE `meal_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `meal_translations_meal_id_locale_unique` (`meal_id`,`locale`),
  ADD KEY `meal_translations_locale_index` (`locale`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `missions`
--
ALTER TABLE `missions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `missions_company_id_foreign` (`company_id`);

--
-- Indexes for table `mission_translations`
--
ALTER TABLE `mission_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mission_translations_mission_id_locale_unique` (`mission_id`,`locale`),
  ADD KEY `mission_translations_locale_index` (`locale`);

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
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plan_translations`
--
ALTER TABLE `plan_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `plan_translations_plan_id_locale_unique` (`plan_id`,`locale`),
  ADD KEY `plan_translations_locale_index` (`locale`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_department_id_foreign` (`department_id`),
  ADD KEY `products_company_id_foreign` (`company_id`);

--
-- Indexes for table `product_translations`
--
ALTER TABLE `product_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_translations_product_id_locale_unique` (`product_id`,`locale`),
  ADD KEY `product_translations_locale_index` (`locale`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_company_id_foreign` (`company_id`);

--
-- Indexes for table `question_translations`
--
ALTER TABLE `question_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `question_translations_question_id_locale_unique` (`question_id`,`locale`),
  ADD KEY `question_translations_locale_index` (`locale`);

--
-- Indexes for table `related_products`
--
ALTER TABLE `related_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `related_products_product_id_foreign` (`product_id`);

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
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `services_company_id_foreign` (`company_id`),
  ADD KEY `services_service_category_id_foreign` (`service_category_id`);

--
-- Indexes for table `service_categories`
--
ALTER TABLE `service_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_categories_company_id_foreign` (`company_id`);

--
-- Indexes for table `service_category_translations`
--
ALTER TABLE `service_category_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `service_category_translations_service_category_id_locale_unique` (`service_category_id`,`locale`),
  ADD KEY `service_category_translations_locale_index` (`locale`);

--
-- Indexes for table `service_translations`
--
ALTER TABLE `service_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `service_translations_service_id_locale_unique` (`service_id`,`locale`),
  ADD KEY `service_translations_locale_index` (`locale`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skill_employee`
--
ALTER TABLE `skill_employee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `skill_employee_skill_id_foreign` (`skill_id`),
  ADD KEY `skill_employee_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `skill_translations`
--
ALTER TABLE `skill_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `skill_translations_skill_id_locale_unique` (`skill_id`,`locale`),
  ADD KEY `skill_translations_locale_index` (`locale`);

--
-- Indexes for table `support_systems`
--
ALTER TABLE `support_systems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_system_translations`
--
ALTER TABLE `support_system_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `support_system_translations_support_system_id_locale_unique` (`support_system_id`,`locale`),
  ADD KEY `support_system_translations_locale_index` (`locale`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `agreements`
--
ALTER TABLE `agreements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `agreement_translations`
--
ALTER TABLE `agreement_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `bids`
--
ALTER TABLE `bids`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `conventions`
--
ALTER TABLE `conventions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `convention_translations`
--
ALTER TABLE `convention_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `corporations`
--
ALTER TABLE `corporations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `corporation_translations`
--
ALTER TABLE `corporation_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `department_translations`
--
ALTER TABLE `department_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `job_translations`
--
ALTER TABLE `job_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `job_types`
--
ALTER TABLE `job_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `job_type_translations`
--
ALTER TABLE `job_type_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `language_configs`
--
ALTER TABLE `language_configs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meals`
--
ALTER TABLE `meals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meal_product`
--
ALTER TABLE `meal_product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meal_translations`
--
ALTER TABLE `meal_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `missions`
--
ALTER TABLE `missions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mission_translations`
--
ALTER TABLE `mission_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plan_translations`
--
ALTER TABLE `plan_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_translations`
--
ALTER TABLE `product_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `question_translations`
--
ALTER TABLE `question_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `related_products`
--
ALTER TABLE `related_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_categories`
--
ALTER TABLE `service_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_category_translations`
--
ALTER TABLE `service_category_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_translations`
--
ALTER TABLE `service_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `skill_employee`
--
ALTER TABLE `skill_employee`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `skill_translations`
--
ALTER TABLE `skill_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_systems`
--
ALTER TABLE `support_systems`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_system_translations`
--
ALTER TABLE `support_system_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `agreement_translations`
--
ALTER TABLE `agreement_translations`
  ADD CONSTRAINT `agreement_translations_agreement_id_foreign` FOREIGN KEY (`agreement_id`) REFERENCES `agreements` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bids`
--
ALTER TABLE `bids`
  ADD CONSTRAINT `bids_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bids_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `conventions`
--
ALTER TABLE `conventions`
  ADD CONSTRAINT `conventions_agreement_id_foreign` FOREIGN KEY (`agreement_id`) REFERENCES `agreements` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `convention_translations`
--
ALTER TABLE `convention_translations`
  ADD CONSTRAINT `convention_translations_convention_id_foreign` FOREIGN KEY (`convention_id`) REFERENCES `conventions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `corporations`
--
ALTER TABLE `corporations`
  ADD CONSTRAINT `corporations_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `corporation_translations`
--
ALTER TABLE `corporation_translations`
  ADD CONSTRAINT `corporation_translations_corporation_id_foreign` FOREIGN KEY (`corporation_id`) REFERENCES `corporations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `department_translations`
--
ALTER TABLE `department_translations`
  ADD CONSTRAINT `department_translations_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jobs`
--
ALTER TABLE `jobs`
  ADD CONSTRAINT `jobs_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jobs_convention_id_foreign` FOREIGN KEY (`convention_id`) REFERENCES `conventions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jobs_job_type_id_foreign` FOREIGN KEY (`job_type_id`) REFERENCES `job_types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `job_translations`
--
ALTER TABLE `job_translations`
  ADD CONSTRAINT `job_translations_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `job_types`
--
ALTER TABLE `job_types`
  ADD CONSTRAINT `job_types_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `job_types_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `job_types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `job_type_translations`
--
ALTER TABLE `job_type_translations`
  ADD CONSTRAINT `job_type_translations_job_type_id_foreign` FOREIGN KEY (`job_type_id`) REFERENCES `job_types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `language_configs`
--
ALTER TABLE `language_configs`
  ADD CONSTRAINT `language_configs_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `meals`
--
ALTER TABLE `meals`
  ADD CONSTRAINT `meals_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `meals_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `meal_product`
--
ALTER TABLE `meal_product`
  ADD CONSTRAINT `meal_product_meal_id_foreign` FOREIGN KEY (`meal_id`) REFERENCES `meals` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `meal_translations`
--
ALTER TABLE `meal_translations`
  ADD CONSTRAINT `meal_translations_meal_id_foreign` FOREIGN KEY (`meal_id`) REFERENCES `meals` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `missions`
--
ALTER TABLE `missions`
  ADD CONSTRAINT `missions_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mission_translations`
--
ALTER TABLE `mission_translations`
  ADD CONSTRAINT `mission_translations_mission_id_foreign` FOREIGN KEY (`mission_id`) REFERENCES `missions` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `plan_translations`
--
ALTER TABLE `plan_translations`
  ADD CONSTRAINT `plan_translations_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_translations`
--
ALTER TABLE `product_translations`
  ADD CONSTRAINT `product_translations_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `question_translations`
--
ALTER TABLE `question_translations`
  ADD CONSTRAINT `question_translations_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `related_products`
--
ALTER TABLE `related_products`
  ADD CONSTRAINT `related_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `services_service_category_id_foreign` FOREIGN KEY (`service_category_id`) REFERENCES `service_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `service_categories`
--
ALTER TABLE `service_categories`
  ADD CONSTRAINT `service_categories_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `service_category_translations`
--
ALTER TABLE `service_category_translations`
  ADD CONSTRAINT `service_category_translations_service_category_id_foreign` FOREIGN KEY (`service_category_id`) REFERENCES `service_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `service_translations`
--
ALTER TABLE `service_translations`
  ADD CONSTRAINT `service_translations_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `skill_employee`
--
ALTER TABLE `skill_employee`
  ADD CONSTRAINT `skill_employee_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `skill_employee_skill_id_foreign` FOREIGN KEY (`skill_id`) REFERENCES `skills` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `skill_translations`
--
ALTER TABLE `skill_translations`
  ADD CONSTRAINT `skill_translations_skill_id_foreign` FOREIGN KEY (`skill_id`) REFERENCES `skills` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `support_system_translations`
--
ALTER TABLE `support_system_translations`
  ADD CONSTRAINT `support_system_translations_support_system_id_foreign` FOREIGN KEY (`support_system_id`) REFERENCES `support_systems` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

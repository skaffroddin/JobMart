-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 01, 2025 at 10:46 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `JobMart`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Technology', 'active', '2024-11-24 06:30:00', '2024-11-24 06:30:00'),
(2, 'Healthcare', 'active', '2024-11-24 06:30:00', '2024-11-24 06:30:00'),
(3, 'Finance', 'inactive', '2024-11-24 06:30:00', '2024-11-24 06:30:00'),
(4, 'Education', 'active', '2024-11-24 06:30:00', '2024-11-24 06:30:00'),
(5, 'Retail', 'inactive', '2024-11-24 06:30:00', '2024-11-24 06:30:00');

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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `job_type_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `vacancy` int(11) NOT NULL,
  `salary` varchar(255) DEFAULT NULL,
  `location` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `benefits` text DEFAULT NULL,
  `responsibility` text DEFAULT NULL,
  `qualifications` text DEFAULT NULL,
  `keywords` text DEFAULT NULL,
  `experience` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_location` varchar(255) DEFAULT NULL,
  `company_website` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `isFeatured` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `title`, `category_id`, `job_type_id`, `user_id`, `vacancy`, `salary`, `location`, `description`, `benefits`, `responsibility`, `qualifications`, `keywords`, `experience`, `company_name`, `company_location`, `company_website`, `created_at`, `updated_at`, `status`, `isFeatured`) VALUES
(1, 'Software Developer', 2, 1, 1, 20, '3LPA', 'Chennai', 'fdjhfagufWJKFWABJKFWKBJ', 'DFJBFHFRFHKK', 'gjhgheshuherrt', 'errghlgrkgjrgj', 'jfhh', '3', 'ABC Comapny', 'Chennai', 'https://abc@gmailcom', '2024-10-29 05:01:34', '2024-10-29 05:01:34', 1, 0),
(3, 'Web Developer', 1, 1, 1, 100, '5LPA', 'Kolkata', 'djkaffjkjfjef', 'sfjbfsheje.jk', 'dfsjhfegfeufeuek', 'fkwhfhuew', 'efhggfhu', '3', 'xyz Comapny', 'Kolkata', 'https://xyz@gmail.com', '2024-10-29 05:10:50', '2024-11-09 09:19:17', 0, 1),
(4, 'Account', 3, 2, 1, 20, '20k', 'New Town', 'vjdsbjbjbjgrbjgrbj', 'dfjhauirwiriifwf', 'bfwgriwgrlwigr', 'fagilliugif', 'Accountant', '3', 'Account Coampny', 'New Town', 'https://acc@gamil.com', '2024-10-29 05:25:39', '2024-10-29 05:25:39', 1, 0),
(104, 'Technical Program Manager', 5, 1, 1, 4, NULL, 'Pollichtown', 'Quidem vel consequatur assumenda quaerat id rerum qui. Totam reprehenderit a ut velit id autem quis. Ut corrupti sequi qui est qui. Quia sunt perspiciatis molestias optio ad laboriosam et.', NULL, NULL, NULL, NULL, '4', 'Douglas, Nienow and Hartmann', NULL, NULL, '2024-11-23 09:47:07', '2024-11-23 09:47:07', 1, 0),
(106, 'Bookkeeper', 3, 5, 1, 5, NULL, 'Johnschester', 'Qui nesciunt dolores iure libero odit facilis rerum. Odit culpa odit tempora alias cupiditate. Recusandae sed est ea veritatis voluptas expedita.', NULL, NULL, NULL, NULL, '1', 'Schmitt, Kozey and Rowe', NULL, NULL, '2024-11-23 09:47:07', '2024-11-23 09:47:07', 1, 0),
(109, 'Prepress Technician', 5, 3, 1, 3, NULL, 'Kimberlyfurt', 'Facere dolorum quidem magni non. Officiis omnis sed accusantium qui. Eos nisi iusto debitis quis voluptate nobis. Rerum ut blanditiis et odio libero aspernatur.', NULL, NULL, NULL, NULL, '10', 'Funk PLC', NULL, NULL, '2024-11-23 09:47:07', '2024-11-23 09:47:07', 1, 0),
(110, 'Park Naturalist', 4, 1, 1, 3, NULL, 'Kochville', 'Tenetur dolorum ad illo cupiditate molestiae. Aut qui neque laboriosam quaerat dicta. Ullam voluptatem omnis voluptatem cumque et.', NULL, NULL, NULL, NULL, '9', 'Renner, Hills and Crist', NULL, NULL, '2024-11-23 09:47:07', '2024-11-23 09:47:07', 1, 0),
(114, 'Radio Operator', 4, 2, 1, 5, NULL, 'Jaysonfurt', 'Repellat et adipisci ut soluta porro. Voluptas velit nihil molestias expedita et commodi. Eos doloremque ullam vitae beatae dolores corrupti. Dolores consequatur quasi harum quibusdam incidunt.', NULL, NULL, NULL, NULL, '9', 'Bosco and Sons', NULL, NULL, '2024-11-23 09:47:07', '2024-11-23 09:47:07', 1, 0),
(116, 'Warehouse', 5, 5, 1, 3, NULL, 'Port Alecview', 'Sed dolorem deleniti voluptatem qui adipisci. Est nesciunt aut sint eveniet.', NULL, NULL, NULL, NULL, '3', 'Hane Ltd', NULL, NULL, '2024-11-23 09:47:07', '2024-11-23 09:47:07', 1, 0),
(118, 'Ship Carpenter and Joiner', 2, 5, 1, 4, NULL, 'East Viviannefort', 'Ducimus sunt voluptatem velit provident. Qui doloremque sed corporis. Sequi culpa excepturi quas cupiditate amet at nobis.', NULL, NULL, NULL, NULL, '10', 'Keebler PLC', NULL, NULL, '2024-11-23 09:47:07', '2024-11-23 09:47:07', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `job_applications`
--

CREATE TABLE `job_applications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `employer_id` bigint(20) UNSIGNED NOT NULL,
  `applied_data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_types`
--

CREATE TABLE `job_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_types`
--

INSERT INTO `job_types` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Software Engineer', 'active', '2024-11-24 06:30:00', '2024-11-24 06:30:00'),
(2, 'Data Scientist', 'active', '2024-11-24 06:30:00', '2024-11-24 06:30:00'),
(3, 'Product Manager', 'inactive', '2024-11-24 06:30:00', '2024-11-24 06:30:00'),
(4, 'UX Designer', 'active', '2024-11-24 06:30:00', '2024-11-24 06:30:00'),
(5, 'Marketing Specialist', 'inactive', '2024-11-24 06:30:00', '2024-11-24 06:30:00');

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
(1, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2024_10_29_095503_create_users_table', 1),
(5, '2024_10_29_100558_create_categories_table', 2),
(6, '2024_10_29_101137_create_job_types_table', 3),
(7, '2024_10_29_101357_create_jobs_table', 4),
(8, '2024_10_29_101601_alter_jobs_table', 5),
(9, '2024_10_29_101832_create_saved_job_table', 6),
(10, '2024_10_29_102102_create_job_applicatios_table', 7),
(11, '2024_10_29_102830_alter_jobs_table', 8),
(12, '2024_10_29_104207_add_status_column_to_jobs_table', 8),
(13, '2024_10_29_104839_add_is_featured_column_to_jobs_table', 9),
(14, '2024_10_30_044128_alter_users_table', 10);

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `image` varchar(255) DEFAULT NULL,
  `desgination` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `image`, `desgination`, `mobile`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Affroddin', 'admin@gmail.com', NULL, '$2y$10$4UNeYh4Ln2GyasU4QrBvl.HVa9zSiThAl8sJCnTm0dVvZCG/qDlHO', '1-1740821729-jpeg', 'Software Engineer', '8240617824', 'admin', NULL, '2024-10-29 04:29:17', '2025-03-01 04:05:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_user_id_foreign` (`user_id`),
  ADD KEY `jobs_category_id_foreign` (`category_id`),
  ADD KEY `jobs_job_type_id_foreign` (`job_type_id`);

--
-- Indexes for table `job_applications`
--
ALTER TABLE `job_applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_applications_job_id_foreign` (`job_id`),
  ADD KEY `job_applications_user_id_foreign` (`user_id`),
  ADD KEY `job_applications_employer_id_foreign` (`employer_id`);

--
-- Indexes for table `job_types`
--
ALTER TABLE `job_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `job_applications`
--
ALTER TABLE `job_applications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `job_types`
--
ALTER TABLE `job_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jobs`
--
ALTER TABLE `jobs`
  ADD CONSTRAINT `jobs_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jobs_job_type_id_foreign` FOREIGN KEY (`job_type_id`) REFERENCES `job_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jobs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `job_applications`
--
ALTER TABLE `job_applications`
  ADD CONSTRAINT `job_applications_employer_id_foreign` FOREIGN KEY (`employer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `job_applications_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `job_applications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

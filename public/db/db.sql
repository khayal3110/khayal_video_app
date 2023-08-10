-- phpMyAdmin SQL Dump
-- version 5.2.1-1.fc38
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 08, 2023 at 04:09 PM
-- Server version: 10.5.21-MariaDB
-- PHP Version: 8.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `video_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `video_id` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `video_id`, `comment`, `created_at`, `updated_at`) VALUES
(6, '1', '1', 'nyc', '2023-08-08 04:27:49', '2023-08-08 04:27:49'),
(7, '1', '3', 'nyc', '2023-08-08 05:11:40', '2023-08-08 05:11:40'),
(8, '1', '3', 'super', '2023-08-08 05:15:03', '2023-08-08 05:15:03'),
(9, '5', '4', 'Very Goood VBieo', '2023-08-08 05:41:39', '2023-08-08 05:41:39'),
(10, '5', '4', 'Very good Viewo 3', '2023-08-08 05:42:05', '2023-08-08 05:42:05'),
(11, '5', '5', 'Done', '2023-08-08 07:15:48', '2023-08-08 07:15:48'),
(12, '10', '10', 'First Comment', '2023-08-08 10:35:17', '2023-08-08 10:35:17');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_07_22_081507_create_user_details_table', 1),
(6, '2022_07_22_111101_create_user_verifies_table', 1),
(7, '2022_07_27_042746_add_phone_code_to_user_details_table', 2),
(8, '2023_04_24_161751_create_phone_registers_table', 2),
(9, '2023_08_08_064520_create_videos_table', 2),
(10, '2023_08_08_083304_create_comments_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
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
-- Table structure for table `phone_registers`
--

CREATE TABLE `phone_registers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `phone_no` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin@gmail.com', 'balkardeveloper', NULL, '$2y$10$nmn2t1jvRJvPhQAV1wdznOIVHC.kuMrDwTgQl64QxksokdYqVj1HS', 'customer', NULL, '2023-08-07 23:49:30', '2023-08-07 23:49:30'),
(2, 'admins@gmail.com', 'balkardevelopers', NULL, '$2y$10$JwbJsCvIpKgXb8EXEglpVe9KrQS/.CYY2a2jNU4kKtqegX3VXsrce', 'customer', NULL, '2023-08-07 23:58:46', '2023-08-07 23:58:46'),
(3, 'adminss@gmail.com', 'balkardeveloperss', NULL, '$2y$10$1HFqwiRrgMbEPdtkryjXyuF7BOmp0PKQWYFuWB8MjVUTswe1fDRcO', 'customer', NULL, '2023-08-07 23:59:13', '2023-08-07 23:59:13'),
(4, 'balkardeveloper@gmail.com', 'user1', NULL, '$2y$10$yJuorM/ZP7jc2rTM.giqruu0soyTeAIZvNa7Oj9XBgFWlH0UtnGke', 'customer', NULL, '2023-08-08 02:49:10', '2023-08-08 02:49:10'),
(5, 'niteshspp189@gmail.com', 'nitesh123', NULL, '$2y$10$5eIVv8ErLmI0S2S26hqQdu7tBdEX/SIlwqjLxqT7RTzGEZRD5gtZi', 'customer', NULL, '2023-08-08 05:36:17', '2023-08-08 05:36:17'),
(6, 'niteshspp18999@gmail.com', 'nitesh', NULL, '$2y$10$55HGYRS0271gjnPauOIbLekIggLMstR9a1FkArfuls4QPmTXeGl1u', 'customer', NULL, '2023-08-08 07:01:31', '2023-08-08 07:01:31'),
(7, 'niteshspp18d999@gmail.com', 'nitesh444', NULL, '$2y$10$jnnwtYOiKNv8U87nTnrSvOhtEMS5s3amAeiljhj.r4VMDxBGri3Bm', 'customer', NULL, '2023-08-08 07:02:47', '2023-08-08 07:02:47'),
(8, 'niteshspp1448d999@gmail.com', 'nitesh44444', NULL, '$2y$10$ZZZ1JpqBvNAVYd2z13YD9O3j3gWa3Vf5b2GWrIFwRvZ3WscYEEu3u', 'customer', NULL, '2023-08-08 07:02:54', '2023-08-08 07:02:54'),
(9, 'niteshspp44189@gmail.com', 'niteshspp18944444', NULL, '$2y$10$TgywLmVXIPvvNh1zgehyf.H97wB28NVGotTgBX3dblHpUQnye/nuS', 'customer', NULL, '2023-08-08 07:05:16', '2023-08-08 07:05:16'),
(10, 'niteshspp1899@gmai.com', 'niteshspp90', NULL, '$2y$10$90hOZUcZHUgT/6ZLiQtz7ObfyQ0683sLoKm6piqYxG0NOUF2QJ3ou', 'customer', NULL, '2023-08-08 10:33:00', '2023-08-08 10:33:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `profile_icon` varchar(255) NOT NULL,
  `is_email_verified` int(11) NOT NULL,
  `is_phone_verified` int(11) NOT NULL,
  `phone_code` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_verifies`
--

CREATE TABLE `user_verifies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `otp` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `user_id`, `title`, `description`, `image`, `video`, `created_at`, `updated_at`) VALUES
(1, 1, 'ssss', 'ssss', '_shape-image.png', '_WhatsApp Video 2023-04-29 at 6.20.07 PM.mp4', '2023-08-08 02:00:27', '2023-08-08 02:00:27'),
(2, 4, 'new video', 'new video', '_team.jpg', '_WhatsApp Video 2023-04-29 at 6.20.04 PM.mp4', '2023-08-08 04:28:44', '2023-08-08 04:28:44'),
(3, 1, 'ggg', 'ggg', '_hero1.png', '_WhatsApp Video 2023-04-29 at 6.20.04 PM.mp4', '2023-08-08 05:01:25', '2023-08-08 05:01:25'),
(4, 5, 'Video 1', 'Video 1', '_dummy.jpg', '_video1.mp4', '2023-08-08 05:37:52', '2023-08-08 05:37:52'),
(5, 5, 'sdf', 'sdf', '_download.png', '_video1.mp4', '2023-08-08 07:11:35', '2023-08-08 07:11:35'),
(6, 5, 'asdf', 'asdf', '_Screenshot from 2023-08-02 22-41-08.png', '_video1.mp4', '2023-08-08 07:25:01', '2023-08-08 07:25:01'),
(7, 5, 'Video 1', 'Video 1', '_dummy.jpg', '_video1.mp4', '2023-08-08 05:37:52', '2023-08-08 05:37:52'),
(8, 5, 'sdf', 'sdf', '_download.png', '_video1.mp4', '2023-08-08 07:11:35', '2023-08-08 07:11:35'),
(9, 5, 'asdf', 'asdf', '_Screenshot from 2023-08-02 22-41-08.png', '_video1.mp4', '2023-08-08 07:25:01', '2023-08-08 07:25:01'),
(10, 10, 'The First Video', 'The First Video', '_dummy.jpg', '_video1.mp4', '2023-08-08 10:34:25', '2023-08-08 10:34:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
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
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `phone_registers`
--
ALTER TABLE `phone_registers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_verifies`
--
ALTER TABLE `user_verifies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `phone_registers`
--
ALTER TABLE `phone_registers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_verifies`
--
ALTER TABLE `user_verifies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2022 at 03:44 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ateammt`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `eventTitle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `eventDescription` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `userId` int(11) NOT NULL,
  `featuredImage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `eventTitle`, `eventDescription`, `startDate`, `endDate`, `userId`, `featuredImage`, `location`, `address`, `status`, `created_at`, `updated_at`) VALUES
(1, 'R & D - A trial solo by Raghav Mandava', 'Catch Raghav Mandava live at the happy high with his new trial solo - R & DLimited seats only', '2022-04-27', '2022-04-28', 1, '165018598615.jpg', 'Delhi', '119, 5th Floor, Sishan House, near UCO Bank, Shahpur Jat, New Delhi, Delhi', 1, '2022-04-17 03:29:46', '2022-04-17 03:31:17'),
(2, 'Wetnow season 4 - 2022', 'After the Huge success of Holiwood colors & music festival season 7 - 2022 . Swag ventures presents Wetnow season 4 - 2022 1st pool party of this season Featuring DJs Dj Jackson Dj zacksnare', '2022-05-10', '2022-05-15', 1, '165019345175.jpg', 'Noida', '19, Ashoka Rd, Janpath, Connaught Place, New Delhi, Delhi', 1, '2022-04-06 05:34:11', '2022-04-17 05:34:11'),
(3, 'International Conference on Networking, Communication and Computing Technology', '24 people interested. Rated 4.0 by 2 people. Check out who is attending ✭ exhibiting ✭ speaking ✭ schedule & agenda ✭ reviews ✭ timing ✭ entry ticket fees. 2022 edition of International Conference', '2022-04-27', '2022-04-27', 1, '1650193581100.jpg', 'Cochin', 'Jose Junction, warriam road Opposite Lotus Club, Kochi, Kerala', 1, '2022-04-17 05:36:21', '2022-04-17 05:36:21'),
(4, 'A trial solo ', 'Catch Raghav Mandava live at the happy high with his new trial solo - R & DLimited seats only', '2022-07-01', '2022-07-03', 1, '165018598615.jpg', 'Lucknow', '119, 5th Floor, Sishan House, near UCO Bank, Shahpur Jat, New Delhi, Delhi', 1, '2022-04-17 03:29:46', '2022-04-17 03:31:17'),
(5, 'Wetnow season 5 - 2023', 'After the Huge success of Holiwood colors & music festival season 7 - 2022 . Swag ventures presents Wetnow season 4 - 2022 1st pool party of this season Featuring DJs Dj Jackson Dj zacksnare', '2022-08-05', '2022-08-11', 1, '165019345175.jpg', 'Noida', '19, Ashoka Rd, Janpath, Connaught Place, New Delhi, Delhi', 1, '2022-03-08 11:14:09', '2022-05-20 05:34:11'),
(6, 'International Conference ', '24 people interested. Rated 4.0 by 2 people. Check out who is attending ✭ exhibiting ✭ speaking ✭ schedule & agenda ✭ reviews ✭ timing ✭ entry ticket fees. 2022 edition of International Conference', '2022-04-27', '2022-04-27', 1, '1650193581100.jpg', 'Cochin', 'Jose Junction, warriam road Opposite Lotus Club, Kochi, Kerala', 1, '2022-03-14 05:36:21', '2022-06-24 05:36:21'),
(7, 'test', '24 people interested. Rated 4.0 by 2 people. Check out who is attending ✭ exhibiting ✭ speaking ✭ schedule & agenda ✭ reviews ✭ timing ✭ entry ticket fees. 2022 edition of International Conference', '2022-04-28', '2022-04-30', 2, '165019933494.jpg', 'Trivandrum', 'test address', 1, '2022-04-17 07:12:14', '2022-04-17 07:21:37');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invited_users`
--

CREATE TABLE `invited_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `eventId` int(11) NOT NULL,
  `userEmail` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invited_users`
--

INSERT INTO `invited_users` (`id`, `eventId`, `userEmail`, `created_at`, `updated_at`) VALUES
(1, 1, 'kiran25813@gmail.com', '2022-04-17 03:31:35', '2022-04-17 03:31:35'),
(2, 1, 'test@gm.com', '2022-04-17 03:31:35', '2022-04-17 03:31:35'),
(3, 7, 'test@gm.com', '2022-04-17 07:20:18', '2022-04-17 07:20:18'),
(4, 7, 'kir@gm.com', '2022-04-17 07:20:18', '2022-04-17 07:20:18'),
(5, 7, 'abc@xyz.com', '2022-04-17 07:20:18', '2022-04-17 07:20:18');

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
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_04_16_190640_add_dob_to_users_table', 2),
(6, '2022_04_16_202852_create_events_table', 3),
(8, '2022_04_17_070527_create_invited_users_table', 4),
(9, '2022_04_17_123507_add_user_id_to_event_table', 5);

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `gender` enum('male','female') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `dob`, `remember_token`, `created_at`, `updated_at`, `gender`) VALUES
(1, 'Kiran Raj', 'kiran25813@gmail.com', NULL, '$2y$10$Ctgd9UikXcfEE3tbbzeNv.1ojGMxOmvFoKC81FoyrJRptRG44l2HO', '1994-09-01', NULL, '2022-04-16 14:03:55', '2022-04-16 14:03:55', 'male'),
(2, 'Test User', 'test@gm.com', NULL, '$2y$10$WI4yBhkKGKBEAhDO.wQ/sOOPNDjN8RuQMP7sHXwNrk/fLsubVJby6', '2000-09-13', NULL, '2022-04-17 07:10:38', '2022-04-17 07:10:38', 'male');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `invited_users`
--
ALTER TABLE `invited_users`
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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invited_users`
--
ALTER TABLE `invited_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

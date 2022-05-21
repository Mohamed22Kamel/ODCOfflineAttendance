-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2022 at 01:14 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `odcofflineattendance`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Hackathons', NULL, NULL),
(2, 'flutter test', '2022-05-20 11:37:47', '2022-05-20 11:37:47');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `description`, `category_id`, `start`, `end`, `created_at`, `updated_at`) VALUES
(1, 'Flutter', 'Hackathon For Flutter in ODC', 1, '2022-05-21', '2022-05-26', NULL, '2022-05-20 14:24:22'),
(2, 'test', 'Flutter Hackathon test', 2, '2022-05-12', '2022-05-25', '2022-05-20 11:37:57', '2022-05-20 14:03:26');

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
-- Table structure for table `instructors`
--

CREATE TABLE `instructors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `instructors`
--

INSERT INTO `instructors` (`id`, `name`, `email`, `image`, `phone`, `created_at`, `updated_at`) VALUES
(1, 'Mo Salah', 'mohamed22kamel@icloud.com', NULL, '01159675941', NULL, NULL);

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
(61, '2014_10_12_000000_create_users_table', 1),
(62, '2014_10_12_100000_create_password_resets_table', 1),
(63, '2019_08_19_000000_create_failed_jobs_table', 1),
(64, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(65, '2022_05_10_083049_create_instructors_table', 1),
(66, '2022_05_10_084305_create_students_table', 1),
(67, '2022_05_10_085107_create_categories_table', 1),
(68, '2022_05_10_085840_create_courses_table', 1),
(69, '2022_05_10_092321_create_student_courses_table', 1),
(70, '2022_05_10_092805_create_student_attendances_table', 1);

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
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `email`, `image`, `phone`, `created_at`, `updated_at`) VALUES
(223, 'Youssef Milad', 'youssefm.sead@gmail.com', NULL, '01222511276', '2022-05-21 09:08:32', '2022-05-21 09:08:32'),
(224, 'Mohamed Abdelsalam', 'mohamedabdelsalam656@gmail.com', NULL, '01156780002', '2022-05-21 09:08:35', '2022-05-21 09:08:35'),
(225, 'Joseph Maged', 'jmaged2012@gmail.com', NULL, '01220875000', '2022-05-21 09:08:36', '2022-05-21 09:08:36'),
(226, 'Ammar Abdelmohsen', 'ammarmohamed13@gmail.com', NULL, '01116185647', '2022-05-21 09:08:37', '2022-05-21 09:08:37'),
(227, 'Karim Essam', 'dev.karime.gaber@gmail.com', NULL, '01061719355', '2022-05-21 09:08:39', '2022-05-21 09:08:39'),
(228, 'Mahmoud Ezzat', 'ezzatmahmoud08@gmail.com', NULL, '01129316102', '2022-05-21 09:08:40', '2022-05-21 09:08:40'),
(229, 'Hussein Elbhrawy', 'hussein.elbhrawy74@gmail.com', NULL, '01069233929', '2022-05-21 09:08:41', '2022-05-21 09:08:41'),
(230, 'Mohamed Gamal', 'gmgm60ayahoo.com@gmail.com', NULL, '01281139642', '2022-05-21 09:08:42', '2022-05-21 09:08:42'),
(231, 'Osama Mosa', 'osamamosabusiness@gmail.com', NULL, '01091786060', '2022-05-21 09:08:43', '2022-05-21 09:08:43'),
(232, 'Ahmed Mossad', 'mosad7196@gmail.com', NULL, '01282662411', '2022-05-21 09:08:45', '2022-05-21 09:08:45'),
(233, 'Marian Nader', 'mariannader3769@gmail.com', NULL, '01023992459', '2022-05-21 09:08:46', '2022-05-21 09:08:46'),
(234, 'Hossam Jamal', 'hossamjamal6@gmail.com', NULL, '01020929592', '2022-05-21 09:08:47', '2022-05-21 09:08:47'),
(235, 'David Maged', 'davidmaged171@gmail.com', NULL, '01285054601', '2022-05-21 09:08:48', '2022-05-21 09:08:48'),
(236, 'Ehab Mamdouh', 'ehabpop4040@gmail.com', NULL, '01221486459', '2022-05-21 09:08:50', '2022-05-21 09:08:50'),
(237, 'Taha Elkholy', 'tahaelkholy.dev@gmail.com', NULL, '01017459347', '2022-05-21 09:08:52', '2022-05-21 09:08:52'),
(238, 'Mohamed Gamal', 'mohamedelbalooty123@gmail.com', NULL, '01229483395', '2022-05-21 09:08:53', '2022-05-21 09:08:53'),
(239, 'Mahmoud Reda', 'mahmoudreda123456789101112@gmail.com', NULL, '01277556432', '2022-05-21 09:08:55', '2022-05-21 09:08:55'),
(240, 'hamada mohamed', 'hamada.devlop@gmail.com', NULL, '01141403984', '2022-05-21 09:09:02', '2022-05-21 09:09:02'),
(241, 'Hager Khaled', 'hagerk720@gmail.com', NULL, '01144342836', '2022-05-21 09:09:05', '2022-05-21 09:09:05'),
(242, 'Abdelrahman Rashad', 'abdelrahman.a.rashad@gmail.com', NULL, '01129118218', '2022-05-21 09:09:06', '2022-05-21 09:09:06'),
(243, 'mohamed mohsen', 'mohamedmohsen2468@gmail.com', NULL, '01067273499', '2022-05-21 09:09:08', '2022-05-21 09:09:08'),
(244, 'Abdelrahman Elfeki', 'aelfky66@gmail.com', NULL, '01062609580', '2022-05-21 09:09:10', '2022-05-21 09:09:10'),
(245, 'Ahmed El-Shenawy', 'ahmedelshenawy376@gmail.com', NULL, '01113945471', '2022-05-21 09:09:11', '2022-05-21 09:09:11'),
(246, 'ahmed mahmoud', 'ahmed.elbeah@icloud.com', NULL, '01026198131', '2022-05-21 09:09:12', '2022-05-21 09:09:12'),
(247, 'Mustafa Elazab', 'mustafa_elazabawy@yahoo.com', NULL, '01555465611', '2022-05-21 09:09:13', '2022-05-21 09:09:13'),
(248, 'Abdelrahman Hossam', 'abdooo.hussam@gmail.com', NULL, '01118232384', '2022-05-21 09:09:14', '2022-05-21 09:09:14'),
(249, 'Mahmoud Essam Elden Ali Eid Nameish', 'mnameish@gmail.com', NULL, '01115985384', '2022-05-21 09:09:15', '2022-05-21 09:09:15'),
(250, 'Mahmoud Fathy', 'mahmoud.fathy11699@gmail.com', NULL, '01009664154', '2022-05-21 09:09:17', '2022-05-21 09:09:17'),
(251, 'Ibrahim Atef', 'atf343069@gmail.com', NULL, '01126754631', '2022-05-21 09:09:18', '2022-05-21 09:09:18'),
(252, 'Esraa Abdellatif Ahmed', 'esraa.abd.a99@gmail.com', NULL, '01093723604', '2022-05-21 09:09:19', '2022-05-21 09:09:19'),
(253, 'Omar Radwan', 'oradwan037@gmail.com', NULL, '01116921424', '2022-05-21 09:09:20', '2022-05-21 09:09:20'),
(254, 'kamal magdy', 'kemoeng40@gmail.com', NULL, '01553737066', '2022-05-21 09:09:22', '2022-05-21 09:09:22'),
(255, 'Moamen Rabee', 'moamen.rabee2003@gmail.com', NULL, '01273308123', '2022-05-21 09:09:23', '2022-05-21 09:09:23'),
(256, 'Islam Karam', 'karameslam11@gmail.com', NULL, '01000275471', '2022-05-21 09:09:24', '2022-05-21 09:09:24'),
(257, 'ahmed ahmedabodev', 'ahmedabodif123456@gmail.com', NULL, '01095264867', '2022-05-21 09:09:25', '2022-05-21 09:09:25'),
(258, 'Mohammed Elsayed', 'mo7md28@gmail.com', NULL, '01117587226', '2022-05-21 09:09:27', '2022-05-21 09:09:27'),
(259, 'Mohamed Elabd', 'mohamedragabelabd7@gmail.com', NULL, '01112870010', '2022-05-21 09:09:28', '2022-05-21 09:09:28'),
(260, 'Abdelrahman Anany', 'eng.abdelrahman.anany@gmail.com', NULL, '01118836732', '2022-05-21 09:09:29', '2022-05-21 09:09:29'),
(261, 'Yasser Ibrahem', 'yasserelabasy1997@gmail.com', NULL, '01014012989', '2022-05-21 09:09:30', '2022-05-21 09:09:30');

-- --------------------------------------------------------

--
-- Table structure for table `student_attendances`
--

CREATE TABLE `student_attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_course_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_courses`
--

CREATE TABLE `student_courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_courses`
--

INSERT INTO `student_courses` (`id`, `student_id`, `course_id`, `created_at`, `updated_at`) VALUES
(8, 223, 1, '2022-05-21 09:08:32', '2022-05-21 09:08:32'),
(9, 224, 1, '2022-05-21 09:08:35', '2022-05-21 09:08:35'),
(10, 225, 1, '2022-05-21 09:08:36', '2022-05-21 09:08:36'),
(11, 226, 1, '2022-05-21 09:08:37', '2022-05-21 09:08:37'),
(12, 227, 1, '2022-05-21 09:08:39', '2022-05-21 09:08:39'),
(13, 228, 1, '2022-05-21 09:08:40', '2022-05-21 09:08:40'),
(14, 229, 1, '2022-05-21 09:08:41', '2022-05-21 09:08:41'),
(15, 230, 1, '2022-05-21 09:08:42', '2022-05-21 09:08:42'),
(16, 231, 1, '2022-05-21 09:08:43', '2022-05-21 09:08:43'),
(17, 232, 1, '2022-05-21 09:08:45', '2022-05-21 09:08:45'),
(18, 233, 1, '2022-05-21 09:08:46', '2022-05-21 09:08:46'),
(19, 234, 1, '2022-05-21 09:08:47', '2022-05-21 09:08:47'),
(20, 235, 1, '2022-05-21 09:08:48', '2022-05-21 09:08:48'),
(21, 236, 1, '2022-05-21 09:08:50', '2022-05-21 09:08:50'),
(22, 237, 1, '2022-05-21 09:08:52', '2022-05-21 09:08:52'),
(23, 238, 1, '2022-05-21 09:08:53', '2022-05-21 09:08:53'),
(24, 239, 1, '2022-05-21 09:08:55', '2022-05-21 09:08:55'),
(25, 240, 1, '2022-05-21 09:09:02', '2022-05-21 09:09:02'),
(26, 241, 1, '2022-05-21 09:09:05', '2022-05-21 09:09:05'),
(27, 242, 1, '2022-05-21 09:09:06', '2022-05-21 09:09:06'),
(28, 243, 1, '2022-05-21 09:09:08', '2022-05-21 09:09:08'),
(29, 244, 1, '2022-05-21 09:09:10', '2022-05-21 09:09:10'),
(30, 245, 1, '2022-05-21 09:09:11', '2022-05-21 09:09:11'),
(31, 246, 1, '2022-05-21 09:09:12', '2022-05-21 09:09:12'),
(32, 247, 1, '2022-05-21 09:09:13', '2022-05-21 09:09:13'),
(33, 248, 1, '2022-05-21 09:09:14', '2022-05-21 09:09:14'),
(34, 249, 1, '2022-05-21 09:09:15', '2022-05-21 09:09:15'),
(35, 250, 1, '2022-05-21 09:09:17', '2022-05-21 09:09:17'),
(36, 251, 1, '2022-05-21 09:09:18', '2022-05-21 09:09:18'),
(37, 252, 1, '2022-05-21 09:09:19', '2022-05-21 09:09:19'),
(38, 253, 1, '2022-05-21 09:09:20', '2022-05-21 09:09:20'),
(39, 254, 1, '2022-05-21 09:09:22', '2022-05-21 09:09:22'),
(40, 255, 1, '2022-05-21 09:09:23', '2022-05-21 09:09:23'),
(41, 256, 1, '2022-05-21 09:09:24', '2022-05-21 09:09:24'),
(42, 257, 1, '2022-05-21 09:09:25', '2022-05-21 09:09:25'),
(43, 258, 1, '2022-05-21 09:09:27', '2022-05-21 09:09:27'),
(44, 259, 1, '2022-05-21 09:09:28', '2022-05-21 09:09:28'),
(45, 260, 1, '2022-05-21 09:09:29', '2022-05-21 09:09:29'),
(46, 261, 1, '2022-05-21 09:09:30', '2022-05-21 09:09:30');

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
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courses_category_id_foreign` (`category_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `instructors`
--
ALTER TABLE `instructors`
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
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_attendances`
--
ALTER TABLE `student_attendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_attendances_student_course_id_foreign` (`student_course_id`);

--
-- Indexes for table `student_courses`
--
ALTER TABLE `student_courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_courses_student_id_foreign` (`student_id`),
  ADD KEY `student_courses_course_id_foreign` (`course_id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `instructors`
--
ALTER TABLE `instructors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=262;

--
-- AUTO_INCREMENT for table `student_attendances`
--
ALTER TABLE `student_attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `student_courses`
--
ALTER TABLE `student_courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `student_attendances`
--
ALTER TABLE `student_attendances`
  ADD CONSTRAINT `student_attendances_student_course_id_foreign` FOREIGN KEY (`student_course_id`) REFERENCES `student_courses` (`id`);

--
-- Constraints for table `student_courses`
--
ALTER TABLE `student_courses`
  ADD CONSTRAINT `student_courses_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `student_courses_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

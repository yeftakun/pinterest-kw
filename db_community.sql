-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2024 at 01:09 AM
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
-- Database: `db_community`
--

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `level_id` int(11) NOT NULL,
  `level_name` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`level_id`, `level_name`) VALUES
(1, 'Admin'),
(2, 'User'),
(34, 'sdahdvahsds');

-- --------------------------------------------------------

--
-- Table structure for table `otp`
--

CREATE TABLE `otp` (
  `user_name` varchar(30) DEFAULT NULL,
  `otp_code` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `post_img_path` varchar(200) DEFAULT NULL,
  `post_title` varchar(100) DEFAULT NULL,
  `post_description` varchar(300) DEFAULT NULL,
  `post_link` varchar(300) DEFAULT NULL,
  `create_in` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `post_img_path`, `post_title`, `post_description`, `post_link`, `create_in`) VALUES
(2, 47, 'shiroko.jpg', 'Shiroko ICON 1', '0', '0', '2024-06-03 17:56:06'),
(3, 47, 'shiroko-1.jpg', 'Shiroko ICON 2', 'Gambar ini contoh kalau 1 file yg sama bisa di upload karena perubahan penamaan.', 'd', '2024-06-03 17:56:51'),
(4, 48, 'bocchi care face.jpg', 'Gambar Wajah Peduli', 'd', 'd', '2024-06-03 17:59:39'),
(5, 47, 'bocchi-turu.jpg', 'Bocchi Turu', 'ini gambar bocchi turu wkwkw', '#', '2024-06-04 14:20:37'),
(6, 47, 'Sakurajima_Mai_Beginning_CSS.jpg', 'Beginner CSS', 'd', '#', '2024-06-04 17:06:36'),
(7, 47, 'Sakurajima_Mai_Beginning_CSS-1.jpg', 'Same Like Before', 'dsdsds', '#', '2024-06-04 17:15:12'),
(8, 48, 'Bocchi Py.jpg', '', '', '', '2024-06-04 17:20:23'),
(10, 47, 'Sakurai_Mikage_Holds_Introduction_to_Algorithms.jpg', 'Contoh Gambar', 'Contoh Gambar\r\nbaris1\r\nbaris2\r\n#anime #animegirl\r\n', '', '2024-06-04 21:49:47');

-- --------------------------------------------------------

--
-- Table structure for table `posts_tags`
--

CREATE TABLE `posts_tags` (
  `tag_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post_likes`
--

CREATE TABLE `post_likes` (
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date_liked` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `tag_id` int(11) NOT NULL,
  `tag_title` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(30) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `user_profile_path` varchar(200) DEFAULT NULL,
  `user_bio` varchar(300) DEFAULT NULL,
  `level_id` int(11) DEFAULT NULL,
  `password` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL,
  `create_in` timestamp NOT NULL DEFAULT current_timestamp(),
  `delete_in` timestamp NOT NULL DEFAULT (current_timestamp() + interval 3 minute),
  `tele_chat_id` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `name`, `user_profile_path`, `user_bio`, `level_id`, `password`, `status`, `create_in`, `delete_in`, `tele_chat_id`) VALUES
(8, 'admin', 'Admin', 'default.png', 'Ini adalah akun dari admin', 1, '123', 'Aktif', '2024-06-01 07:20:27', '2024-06-01 07:50:27', NULL),
(47, 'yeftaasyel', 'Yefta Asyel', 'default.png', 'Akun yefta sebagai user', 2, '123', 'Aktif', '2024-06-03 17:50:17', '2024-06-03 17:53:17', '1627790263'),
(48, 'bocchi', 'Hitori Gotou', 'default.png', 'akun kedua yefta', 2, '123', 'Aktif', '2024-06-03 17:57:45', '2024-06-03 18:00:45', '7197610153');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`level_id`);

--
-- Indexes for table `otp`
--
ALTER TABLE `otp`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `user_name_2` (`user_name`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `idx_user_id` (`user_id`);

--
-- Indexes for table `posts_tags`
--
ALTER TABLE `posts_tags`
  ADD KEY `idx_tag_id` (`tag_id`),
  ADD KEY `idx_post_id` (`post_id`);

--
-- Indexes for table `post_likes`
--
ALTER TABLE `post_likes`
  ADD KEY `idx_post_id` (`post_id`),
  ADD KEY `idx_user_id` (`user_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tag_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `tele_chat_id` (`tele_chat_id`),
  ADD UNIQUE KEY `user_name_2` (`user_name`),
  ADD UNIQUE KEY `user_name_3` (`user_name`),
  ADD KEY `idx_level_id` (`level_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `level_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `otp`
--
ALTER TABLE `otp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `otp`
--
ALTER TABLE `otp`
  ADD CONSTRAINT `fk_user_name` FOREIGN KEY (`user_name`) REFERENCES `users` (`user_name`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `posts_tags`
--
ALTER TABLE `posts_tags`
  ADD CONSTRAINT `posts_tags_ibfk_1` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`tag_id`),
  ADD CONSTRAINT `posts_tags_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`);

--
-- Constraints for table `post_likes`
--
ALTER TABLE `post_likes`
  ADD CONSTRAINT `post_likes_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`),
  ADD CONSTRAINT `post_likes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`level_id`) REFERENCES `level` (`level_id`);

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `hapus_data_nonaktif` ON SCHEDULE EVERY 1 MINUTE STARTS '2024-06-01 13:43:44' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
    DELETE FROM users WHERE status = 'Nonaktif' AND delete_in <= NOW();
END$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

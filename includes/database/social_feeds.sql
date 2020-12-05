-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2020 at 09:18 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `social_feeds`
--

-- --------------------------------------------------------

--
-- Table structure for table `friend_requests`
--

CREATE TABLE `friend_requests` (
  `id` int(11) NOT NULL,
  `request_to` varchar(50) NOT NULL,
  `request_by` varchar(50) NOT NULL,
  `request_time` datetime NOT NULL,
  `request_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `friend_requests`
--

INSERT INTO `friend_requests` (`id`, `request_to`, `request_by`, `request_time`, `request_status`) VALUES
(11, 'Star_Ananthu', 'Gabar_Singh', '2020-11-16 21:52:08', 'friends');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `post_id` int(255) NOT NULL,
  `post_status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `post_id`, `post_status`) VALUES
(6, 4, 4, 'liked'),
(7, 4, 17, 'liked'),
(8, 9, 17, 'liked'),
(11, 9, 104, 'liked');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `post_body` text NOT NULL,
  `post_image` text NOT NULL,
  `likes` int(10) NOT NULL DEFAULT 0,
  `post_to` varchar(100) NOT NULL DEFAULT 'none',
  `posted_by` varchar(100) NOT NULL,
  `posted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `post_body`, `post_image`, `likes`, `post_to`, `posted_by`, `posted_at`) VALUES
(1, 'First Post!', '1603901400_IMG_0013.JPG', 0, 'none', 'Star_Ananthu', '2020-10-20 05:05:02'),
(2, 'Second Post!', '1603901493_IMG_0013.JPG', 0, 'none', 'Star_Ananthu', '2020-10-21 05:11:33'),
(3, 'Third post!', '1603905581_IMG_0764.JPG', 0, 'none', 'Star_Ananthu', '2020-10-23 06:19:41'),
(4, 'Hello guys', '1603981934_1515429424-picsay.jpg', 1, 'none', 'Ananthu_Sv', '2020-10-29 20:46:26'),
(5, 'Hope all are good', '1603983440_css.png', 0, 'none', 'Ananthu_Sv', '2020-10-29 03:57:20'),
(8, 'Nice no image', 'none', 0, 'none', 'Ananthu_Sv', '2020-10-29 16:46:08'),
(9, '<i>Hello</i>', 'none', 0, 'none', 'Ananthu_Sv', '2020-10-29 17:12:18'),
(10, 'Hello', 'none', 0, 'none', 'Ananthu_Sv', '2020-10-29 17:13:13'),
(11, 'Nice one post increment added', 'none', 0, 'none', 'Ananthu_Sv', '2020-10-29 17:24:34'),
(12, 'Hello guys hw r u?', 'none', 0, 'none', 'Ananthu_Sv', '2020-10-29 17:30:17'),
(13, 'Nice', 'none', 0, 'none', 'Admin_007', '2020-10-29 17:32:15'),
(14, 'Cool', 'none', 0, 'none', 'Admin_007', '2020-10-29 17:32:28'),
(15, 'My laptop :)', '1604783391_IMG_20191006_112708.jpg', 0, 'none', 'Star_Ananthu', '2020-11-07 22:09:51'),
(17, 'Good to see you all\r\n', 'none', 2, 'none', 'Gabar_Singh', '2020-11-16 08:00:02'),
(18, 'Wooooooo', 'none', 0, 'none', 'Kokila_Ben', '2020-11-16 09:21:27'),
(19, 'hello all\r\n', 'none', 0, 'none', 'Kokila_Ben', '2020-11-16 09:25:19'),
(20, 'Huuu', 'none', 0, 'none', 'Kokila_Ben', '2020-11-16 09:26:59'),
(21, 'Huuuloiuytrfdcvbnjmk', 'none', 0, 'none', 'Kokila_Ben', '2020-11-16 09:28:21'),
(23, 'jhgfvbhj', 'none', 0, 'none', 'Kokila_Ben', '2020-11-16 09:38:06'),
(67, 'hi', 'none', 0, 'none', 'Ananthu_Sv', '2020-11-26 13:33:12'),
(68, 'Hello', 'none', 0, 'none', 'Ananthu_Sv', '2020-11-26 13:35:26'),
(70, 'Nice', 'none', 0, 'none', 'Kokila_Ben', '2020-11-27 06:57:56'),
(71, 'hi', 'none', 0, 'none', 'Kokila_Ben', '2020-11-27 07:35:10'),
(84, 'ji', 'none', 0, 'none', 'Kokila_Ben', '2020-11-27 07:48:00'),
(85, 'jiii', 'none', 0, 'none', 'Kokila_Ben', '2020-11-27 07:51:27'),
(95, 'nj', 'none', 0, 'none', 'Gabar_Singh', '2020-11-27 08:15:23'),
(96, 'jiiioo', 'none', 0, 'none', 'Gabar_Singh', '2020-11-27 08:18:32'),
(97, 'alert(1)\r\n', 'none', 0, 'none', 'Gabar_Singh', '2020-11-27 11:53:16'),
(99, 'WOW', 'none', 0, 'none', 'Gabar_Singh', '2020-11-27 14:31:54'),
(104, 'hi', 'none', 1, 'none', 'Gabar_Singh', '2020-11-28 20:06:03'),
(130, 'ok', 'none', 0, 'none', 'Gabar_Singh', '2020-12-03 09:09:52'),
(131, 'Lol how are you', 'none', 0, 'Ananthu_Sv', 'Gabar_Singh', '2020-12-04 08:48:15'),
(132, 'lol', 'none', 0, 'Ananthu_Sv', 'Gabar_Singh', '2020-12-04 08:50:55'),
(133, 'lol', 'none', 0, 'Ananthu_Sv', 'Gabar_Singh', '2020-12-04 08:54:45');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(20) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `joined` date NOT NULL,
  `user_image` text NOT NULL,
  `last_seen` bigint(20) NOT NULL,
  `account_type` varchar(15) NOT NULL DEFAULT 'private',
  `posts` int(10) NOT NULL DEFAULT 0,
  `friends` int(10) NOT NULL DEFAULT 0,
  `friends_list` text NOT NULL,
  `bio` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `username`, `password`, `joined`, `user_image`, `last_seen`, `account_type`, `posts`, `friends`, `friends_list`, `bio`) VALUES
(4, 'Ananthu', 'Sv', 'sananthu47@gmail.com', 'Ananthu_Sv', '$2y$10$rp1Mp2fpZYffb.QpdDOwNODaeyIXt0OiJkOpcJHeC7KfNGIVe8Apa', '2020-10-26', '1604906411_1601758369_IMG_9994.JPG', 1607065766, 'private', 10, 3, ',Star_Ananthu,Kokila_Ben,Gabar_Singh,', ''),
(5, 'Admin', '007', 'admin@gmail.com', 'Admin_007', '$2y$10$p91IB0EgG3Mcrqtna9mfv.YFRGQk.IMAb2ces1aepecG8Kiy8DFj6', '2020-10-26', '1604951272_profile.jpg', 0, 'public', 2, 1, ',Star_Ananthu,', ''),
(6, 'Star', 'Ananthu', 'ananthu@gmail.com', 'Star_Ananthu', '$2y$10$veq6UcQNesOsijUOr1v2h.lfwXYFEzTYT2STgVExkN2HAluDaLHBe', '2020-10-26', '1604951382_1602359930_IMG-20180808-WA0011.jpg', 0, 'private', 4, 3, ',Ananthu_Sv,Admin_007,Gabar_Singh,', '#Pop\r\n#yoyo\r\nHi all!'),
(8, 'Kokila', 'Ben', 'kokila@gmail.com', 'Kokila_Ben', '$2y$10$inoBTtaG2cEbeBevW.ezuOirsinKx0lMqsHJXae.2ROi8CQCLgtD6', '2020-11-08', 'profile.png', 0, 'private', 9, 2, ',Ananthu_Sv,Gabar_Singh,', ''),
(9, 'Gabar', 'Singh', 'gabar@gmail.com', 'Gabar_Singh', '$2y$10$oCgHZM24b1jqyBuSPUYfu.SEyp2iHRf/q1hrwmcv6QvwH1iPpX6Vi', '2020-11-12', '1605119795_randomguy.jpg', 1607069924, 'private', 10, 3, ',Ananthu_Sv,Kokila_Ben,Star_Ananthu,', 'Hello all I am new here');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `friend_requests`
--
ALTER TABLE `friend_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `friend_requests`
--
ALTER TABLE `friend_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
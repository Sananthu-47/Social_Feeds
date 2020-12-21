-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2020 at 09:45 PM
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
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(255) NOT NULL,
  `post_id` int(255) NOT NULL,
  `comment_user_id` int(255) NOT NULL,
  `comment` text NOT NULL,
  `comment_date` datetime NOT NULL,
  `comment_status` varchar(10) NOT NULL DEFAULT 'approved'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `comment_user_id`, `comment`, `comment_date`, `comment_status`) VALUES
(15, 150, 8, 'Cool', '2020-12-20 01:54:16', 'approved'),
(16, 150, 8, 'Noice', '2020-12-20 01:55:02', 'approved'),
(17, 133, 8, 'Fine', '2020-12-20 01:55:09', 'approved'),
(18, 150, 5, 'Fab!', '2020-12-20 01:55:40', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `comment_likes`
--

CREATE TABLE `comment_likes` (
  `id` int(255) NOT NULL,
  `post_id` int(255) NOT NULL,
  `comment_id` int(255) NOT NULL,
  `reply_comment_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `liked_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment_likes`
--

INSERT INTO `comment_likes` (`id`, `post_id`, `comment_id`, `reply_comment_id`, `user_id`, `liked_at`) VALUES
(4, 150, 16, 0, 9, '2020-12-22 02:13:40'),
(5, 150, 18, 0, 9, '2020-12-22 02:14:15'),
(6, 150, 15, 0, 9, '2020-12-22 02:14:17');

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
(47, 'Guddu_Pandit', 'Gabar_Singh', '2020-12-21 00:35:47', 'friends');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `post_id` int(255) NOT NULL,
  `liked_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `post_id`, `liked_at`) VALUES
(26, 13, 152, '2020-12-20 01:52:13'),
(27, 13, 150, '2020-12-20 01:52:18'),
(28, 13, 139, '2020-12-20 01:52:21'),
(29, 9, 14, '2020-12-20 01:53:07'),
(30, 6, 150, '2020-12-20 01:53:33'),
(31, 6, 139, '2020-12-20 01:53:35'),
(32, 6, 147, '2020-12-20 01:53:37'),
(33, 6, 131, '2020-12-20 01:53:53'),
(34, 8, 150, '2020-12-20 01:54:11'),
(35, 8, 147, '2020-12-20 01:54:20'),
(36, 8, 139, '2020-12-20 01:54:21'),
(37, 5, 152, '2020-12-20 01:55:26'),
(38, 5, 151, '2020-12-20 01:55:30'),
(39, 5, 150, '2020-12-20 01:55:32'),
(40, 9, 155, '2020-12-22 00:54:26'),
(41, 9, 154, '2020-12-22 00:54:30'),
(43, 9, 152, '2020-12-22 00:57:29'),
(45, 9, 150, '2020-12-22 01:19:36');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `notified_at` datetime NOT NULL,
  `notification_status` varchar(10) NOT NULL,
  `notification_to` int(255) NOT NULL,
  `notification_from` int(255) NOT NULL,
  `post_id` int(255) NOT NULL,
  `comment_message` text NOT NULL,
  `comment_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notified_at`, `notification_status`, `notification_to`, `notification_from`, `post_id`, `comment_message`, `comment_id`) VALUES
(67, 'like', '2020-12-20 01:52:14', 'unseen', 6, 13, 152, 'none', 0),
(68, 'like', '2020-12-20 01:52:18', 'unseen', 9, 13, 150, 'none', 0),
(69, 'like', '2020-12-20 01:52:21', 'unseen', 9, 13, 139, 'none', 0),
(70, 'like', '2020-12-20 01:53:08', 'unseen', 5, 9, 14, 'none', 0),
(71, 'like', '2020-12-20 01:53:33', 'unseen', 9, 6, 150, 'none', 0),
(72, 'like', '2020-12-20 01:53:35', 'unseen', 9, 6, 139, 'none', 0),
(73, 'like', '2020-12-20 01:53:37', 'unseen', 9, 6, 147, 'none', 0),
(74, 'like', '2020-12-20 01:53:53', 'unseen', 9, 6, 131, 'none', 0),
(75, 'like', '2020-12-20 01:54:11', 'unseen', 9, 8, 150, 'none', 0),
(76, 'comment', '2020-12-20 01:54:16', 'unseen', 9, 8, 150, 'Cool', 15),
(77, 'like', '2020-12-20 01:54:20', 'unseen', 9, 8, 147, 'none', 0),
(78, 'like', '2020-12-20 01:54:21', 'unseen', 9, 8, 139, 'none', 0),
(79, 'comment', '2020-12-20 01:55:02', 'unseen', 9, 8, 150, 'Noice', 16),
(80, 'comment', '2020-12-20 01:55:09', 'unseen', 9, 8, 133, 'Fine', 17),
(81, 'like', '2020-12-20 01:55:27', 'unseen', 6, 5, 152, 'none', 0),
(82, 'like', '2020-12-20 01:55:30', 'unseen', 6, 5, 151, 'none', 0),
(83, 'like', '2020-12-20 01:55:32', 'unseen', 9, 5, 150, 'none', 0),
(84, 'comment', '2020-12-20 01:55:40', 'unseen', 9, 5, 150, 'Fab!', 18),
(94, 'friend_req_accept', '2020-12-21 00:35:56', 'unseen', 9, 13, 0, 'none', 0),
(95, 'like', '2020-12-22 00:54:26', 'unseen', 13, 9, 155, 'none', 0),
(96, 'like', '2020-12-22 00:54:30', 'unseen', 13, 9, 154, 'none', 0),
(97, 'like', '2020-12-22 00:57:22', 'unseen', 6, 9, 152, 'none', 0),
(98, 'like', '2020-12-22 00:57:29', 'unseen', 6, 9, 152, 'none', 0),
(99, 'like', '2020-12-22 01:13:44', 'unseen', 9, 9, 150, 'none', 0),
(100, 'like', '2020-12-22 01:19:36', 'unseen', 9, 9, 150, 'none', 0),
(104, 'comment_like', '2020-12-22 02:13:40', 'unseen', 8, 9, 150, 'Noice', 0),
(105, 'comment_like', '2020-12-22 02:14:15', 'unseen', 5, 9, 150, 'Fab!', 0),
(106, 'comment_like', '2020-12-22 02:14:17', 'unseen', 8, 9, 150, 'Cool', 0);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `post_body` text NOT NULL,
  `post_image` text NOT NULL,
  `post_to` varchar(100) NOT NULL DEFAULT 'none',
  `posted_by` varchar(100) NOT NULL,
  `posted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `post_body`, `post_image`, `post_to`, `posted_by`, `posted_at`) VALUES
(1, 'First Post!', '1603901400_IMG_0013.JPG', 'none', 'Star_Ananthu', '2020-10-20 05:05:02'),
(2, 'Second Post!', '1603901493_IMG_0013.JPG', 'none', 'Star_Ananthu', '2020-10-21 05:11:33'),
(3, 'Third post!', '1603905581_IMG_0764.JPG', 'none', 'Star_Ananthu', '2020-10-23 06:19:41'),
(4, 'Hello guys', '1603981934_1515429424-picsay.jpg', 'none', 'Ananthu_Sv', '2020-10-29 20:46:26'),
(5, 'Hope all are good', '1603983440_css.png', 'none', 'Ananthu_Sv', '2020-10-29 03:57:20'),
(8, 'Nice no image', 'none', 'none', 'Ananthu_Sv', '2020-10-29 16:46:08'),
(9, '<i>Hello</i>', 'none', 'none', 'Ananthu_Sv', '2020-10-29 17:12:18'),
(10, 'Hello', 'none', 'none', 'Ananthu_Sv', '2020-10-29 17:13:13'),
(11, 'Nice one post increment added', 'none', 'none', 'Ananthu_Sv', '2020-10-29 17:24:34'),
(12, 'Hello guys hw r u?', 'none', 'none', 'Ananthu_Sv', '2020-10-29 17:30:17'),
(13, 'Nice', 'none', 'none', 'Admin_007', '2020-10-29 17:32:15'),
(14, 'Cool', 'none', 'none', 'Admin_007', '2020-10-29 17:32:28'),
(15, 'My laptop :)', '1604783391_IMG_20191006_112708.jpg', 'none', 'Star_Ananthu', '2020-11-07 22:09:51'),
(17, 'Good to see you all\r\n', 'none', 'none', 'Gabar_Singh', '2020-11-16 08:00:02'),
(18, 'Wooooooo', 'none', 'none', 'Kokila_Ben', '2020-11-16 09:21:27'),
(19, 'hello all\r\n', 'none', 'none', 'Kokila_Ben', '2020-11-16 09:25:19'),
(20, 'Huuu', 'none', 'none', 'Kokila_Ben', '2020-11-16 09:26:59'),
(21, 'Huuuloiuytrfdcvbnjmk', 'none', 'none', 'Kokila_Ben', '2020-11-16 09:28:21'),
(23, 'jhgfvbhj', 'none', 'none', 'Kokila_Ben', '2020-11-16 09:38:06'),
(67, 'hi', 'none', 'none', 'Ananthu_Sv', '2020-11-26 13:33:12'),
(68, 'Hello', 'none', 'none', 'Ananthu_Sv', '2020-11-26 13:35:26'),
(70, 'Nice', 'none', 'none', 'Kokila_Ben', '2020-11-27 06:57:56'),
(71, 'hi', 'none', 'none', 'Kokila_Ben', '2020-11-27 07:35:10'),
(84, 'ji', 'none', 'none', 'Kokila_Ben', '2020-11-27 07:48:00'),
(85, 'jiii', 'none', 'none', 'Kokila_Ben', '2020-11-27 07:51:27'),
(95, 'nj', 'none', 'none', 'Gabar_Singh', '2020-11-27 08:15:23'),
(96, 'jiiioo', 'none', 'none', 'Gabar_Singh', '2020-11-27 08:18:32'),
(97, 'alert(1)\r\n', 'none', 'none', 'Gabar_Singh', '2020-11-27 11:53:16'),
(99, 'WOW', 'none', 'none', 'Gabar_Singh', '2020-11-27 14:31:54'),
(104, 'hi', 'none', 'none', 'Gabar_Singh', '2020-11-28 20:06:03'),
(130, 'ok', 'none', 'none', 'Gabar_Singh', '2020-12-03 09:09:52'),
(131, 'Lol how are you', 'none', 'Ananthu_Sv', 'Gabar_Singh', '2020-12-04 08:48:15'),
(132, 'lol', 'none', 'Ananthu_Sv', 'Gabar_Singh', '2020-12-04 08:50:55'),
(133, 'lol', 'none', 'Ananthu_Sv', 'Gabar_Singh', '2020-12-04 08:54:45'),
(139, 'hi', 'none', 'none', 'Gabar_Singh', '2020-12-08 00:07:12'),
(147, 'yo yo', 'none', 'none', 'Gabar_Singh', '2020-12-13 01:43:48'),
(150, 'New theme', '1608149638_Bootstrap theme.jpg', 'none', 'Gabar_Singh', '2020-12-17 01:43:58'),
(151, 'Check this code!!!', '1608315442_html.jpg', 'Gabar_Singh', 'Star_Ananthu', '2020-12-18 23:47:22'),
(152, 'Cool dude', 'none', 'Gabar_Singh', 'Star_Ananthu', '2020-12-18 23:55:32'),
(153, 'Nice', 'none', 'none', 'Guddu_Pandit', '2020-12-21 00:33:27'),
(154, 'Cool\r\n', 'none', 'none', 'Guddu_Pandit', '2020-12-21 00:33:33'),
(155, 'OOPs', 'none', 'none', 'Guddu_Pandit', '2020-12-21 00:33:40');

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
(4, 'Ananthu', 'Sv', 'sananthu47@gmail.com', 'Ananthu_Sv', '$2y$10$rp1Mp2fpZYffb.QpdDOwNODaeyIXt0OiJkOpcJHeC7KfNGIVe8Apa', '2020-10-26', '1604906411_1601758369_IMG_9994.JPG', 1608228264, 'private', 10, 3, ',Star_Ananthu,Kokila_Ben,Gabar_Singh,', ''),
(5, 'Admin', '007', 'admin@gmail.com', 'Admin_007', '$2y$10$p91IB0EgG3Mcrqtna9mfv.YFRGQk.IMAb2ces1aepecG8Kiy8DFj6', '2020-10-26', '1604951272_profile.jpg', 1608409584, 'public', 2, 2, ',Star_Ananthu,Gabar_Singh,', ''),
(6, 'Star', 'Ananthu', 'ananthu@gmail.com', 'Star_Ananthu', '$2y$10$veq6UcQNesOsijUOr1v2h.lfwXYFEzTYT2STgVExkN2HAluDaLHBe', '2020-10-26', '1604951382_1602359930_IMG-20180808-WA0011.jpg', 1608409661, 'private', 6, 3, ',Ananthu_Sv,Admin_007,Gabar_Singh,', '#Pop\r\n#yoyo\r\nHi all!'),
(8, 'Kokila', 'Ben', 'kokila@gmail.com', 'Kokila_Ben', '$2y$10$inoBTtaG2cEbeBevW.ezuOirsinKx0lMqsHJXae.2ROi8CQCLgtD6', '2020-11-08', 'profile.png', 1608583455, 'private', 9, 2, ',Ananthu_Sv,Gabar_Singh,', ''),
(9, 'Gabar', 'Singh', 'gabar@gmail.com', 'Gabar_Singh', '$2y$10$oCgHZM24b1jqyBuSPUYfu.SEyp2iHRf/q1hrwmcv6QvwH1iPpX6Vi', '2020-11-12', '1605119795_randomguy.jpg', 1608583503, 'private', 13, 6, ',Ananthu_Sv,Kokila_Ben,Star_Ananthu,Unknown_Player,Admin_007,Guddu_Pandit,', 'Hello all'),
(10, 'Unknown', 'Player', 'unknown@gmail.com', 'Unknown_Player', '$2y$10$zAnZ/7FymmrJlrrU50hy5eFuOFQrDb.2gw5S0MqMj0Nbqm5SSUPI6', '2020-12-10', 'profile.png', 1608005015, 'private', 0, 1, ',Gabar_Singh,', ''),
(11, 'Fall', 'Gays', 'fall@gmail.com', 'Fall_Gays', '$2y$10$E/O0ipsEy/QvVpDkbY4pEOEwtA3FpBSmvGJrUz7f1RWB4WJJ3FYFy', '2020-12-17', 'profile.png', 1608408610, 'private', 0, 0, ',', ''),
(13, 'Guddu', 'Pandit', 'guddu@gmail.com', 'Guddu_Pandit', '$2y$10$7ePpB1OJXTzDu.8YUqSiHOZxloM7Ry8ltVAgGwwiLtWSS8UGUr5YW', '2020-12-20', 'profile.png', 1608492787, 'private', 3, 1, ',Gabar_Singh,', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment_likes`
--
ALTER TABLE `comment_likes`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
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
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `comment_likes`
--
ALTER TABLE `comment_likes`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `friend_requests`
--
ALTER TABLE `friend_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

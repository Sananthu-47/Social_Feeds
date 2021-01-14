-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2021 at 07:09 PM
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
(2, 151, 9, 'ok', '2021-01-02 14:59:44', 'approved'),
(3, 156, 9, 'coool right', '2021-01-03 15:59:01', 'approved');

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
(12, 151, 2, 0, 9, '2021-01-02 15:30:12'),
(24, 151, 0, 1, 9, '2021-01-02 15:48:40'),
(26, 151, 0, 3, 9, '2021-01-02 15:51:31'),
(29, 151, 0, 2, 9, '2021-01-02 23:32:51');

-- --------------------------------------------------------

--
-- Table structure for table `comment_replies`
--

CREATE TABLE `comment_replies` (
  `id` int(255) NOT NULL,
  `post_id` int(255) NOT NULL,
  `comment_id` int(255) NOT NULL,
  `replied_to` int(255) NOT NULL,
  `replied_from` int(255) NOT NULL,
  `replied_at` datetime NOT NULL,
  `replied_message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment_replies`
--

INSERT INTO `comment_replies` (`id`, `post_id`, `comment_id`, `replied_to`, `replied_from`, `replied_at`, `replied_message`) VALUES
(1, 151, 2, 9, 9, '2021-01-02 15:29:12', 'ok'),
(2, 151, 2, 9, 6, '2021-01-02 15:39:53', 'peace'),
(3, 151, 2, 9, 9, '2021-01-02 15:51:25', 'osm');

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
(1, 9, 151, '2021-01-02 23:39:11'),
(2, 9, 150, '2021-01-03 00:54:52'),
(3, 9, 147, '2021-01-03 15:09:35'),
(4, 9, 139, '2021-01-03 15:09:37'),
(5, 9, 133, '2021-01-03 15:09:39'),
(6, 9, 132, '2021-01-03 15:09:47'),
(7, 9, 156, '2021-01-03 15:15:54'),
(8, 9, 104, '2021-01-03 15:40:16');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(255) NOT NULL,
  `message_from` int(255) NOT NULL,
  `message_to` int(255) NOT NULL,
  `message` text NOT NULL,
  `sent_at` datetime NOT NULL,
  `seen_status` varchar(50) NOT NULL DEFAULT 'not seen'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `message_from`, `message_to`, `message`, `sent_at`, `seen_status`) VALUES
(1, 9, 6, 'Hello how are you?', '2021-01-05 23:37:25', 'not seen'),
(2, 6, 9, 'Good you?', '2021-01-06 23:37:25', 'not seen');

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
  `comment_id` int(255) NOT NULL,
  `replied_comment_id` int(255) NOT NULL,
  `notification_number` varchar(50) NOT NULL DEFAULT 'not-checked'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notified_at`, `notification_status`, `notification_to`, `notification_from`, `post_id`, `comment_message`, `comment_id`, `replied_comment_id`, `notification_number`) VALUES
(4, 'comment', '2021-01-02 14:59:44', 'unseen', 6, 9, 151, 'ok', 2, 0, 'not-checked'),
(13, 'comment_reply', '2021-01-02 15:29:12', 'unseen', 9, 9, 151, 'ok', 2, 1, 'checked'),
(15, 'comment_like', '2021-01-02 15:30:12', 'unseen', 9, 9, 151, 'ok', 2, 0, 'checked'),
(17, 'comment_reply', '2021-01-02 15:39:54', 'unseen', 9, 6, 151, 'peace', 2, 2, 'checked'),
(28, 'reply_like', '2021-01-02 15:48:40', 'unseen', 9, 9, 151, 'ok', 0, 1, 'checked'),
(30, 'comment_reply', '2021-01-02 15:51:25', 'unseen', 9, 9, 151, 'osm', 2, 3, 'checked'),
(31, 'reply_like', '2021-01-02 15:51:31', 'unseen', 9, 9, 151, 'osm', 0, 3, 'checked'),
(34, 'reply_like', '2021-01-02 23:32:51', 'unseen', 6, 9, 151, 'peace', 0, 2, 'not-checked'),
(35, 'like', '2021-01-02 23:39:11', 'unseen', 6, 9, 151, 'none', 0, 0, 'not-checked'),
(36, 'like', '2021-01-03 00:54:52', 'unseen', 9, 9, 150, 'none', 0, 0, 'checked'),
(37, 'like', '2021-01-03 15:09:36', 'unseen', 9, 9, 147, 'none', 0, 0, 'checked'),
(38, 'like', '2021-01-03 15:09:37', 'unseen', 9, 9, 139, 'none', 0, 0, 'checked'),
(39, 'like', '2021-01-03 15:09:39', 'unseen', 9, 9, 133, 'none', 0, 0, 'checked'),
(40, 'like', '2021-01-03 15:09:47', 'unseen', 9, 9, 132, 'none', 0, 0, 'checked'),
(41, 'like', '2021-01-03 15:15:54', 'unseen', 9, 9, 156, 'none', 0, 0, 'checked'),
(42, 'like', '2021-01-03 15:40:16', 'seen', 9, 9, 104, 'none', 0, 0, 'checked'),
(43, 'comment', '2021-01-03 15:59:01', 'unseen', 9, 9, 156, 'coool right', 3, 0, 'not-checked');

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
(155, 'OOPs', 'none', 'none', 'Guddu_Pandit', '2020-12-21 00:33:40'),
(156, ' Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex suscipit in, cupiditate odit quam, rem magnam cumque iure id libero dicta ducimus ipsam dolores temporibus est provident numquam magni sit.\r\n Eveniet saepe, earum tempora, nulla at, debitis omnis aperiam est placeat natus corrupti aliquid! Eaque officia dolores possimus nemo ad. Modi impedit officiis tempora quia autem consequatur quaerat quas ipsum!\r\n Nam cumque adipisci fugit soluta fuga quia est molestias inventore facilis, recusandae quo possimus reiciendis, quod ratione quam explicabo aperiam veritatis! Modi ullam saepe repellat deleniti. Amet error vero dolorum!\r\n Itaque molestiae reprehenderit, ea numquam tempore eius minima aliquid temporibus optio quam voluptates id esse asperiores, accusamus necessitatibus delectus! Eveniet facere quas dolore mollitia reiciendis? Rerum consequuntur sequi repudiandae ad!\r\n Minus recusandae cumque perspiciatis fuga quibusdam, minima velit, asperiores distinctio magni dolorem ad animi qui. Minus labore aut nisi magni aliquid voluptatem corrupti iste, nobis distinctio adipisci tenetur dignissimos porro.\r\n Magnam consequatur nulla quibusdam velit possimus numquam quae voluptatem quos itaque, ea, voluptates deleniti officiis dolor expedita laudantium ad quam adipisci? Maiores at soluta architecto consequatur accusantium quia hic magnam!\r\n Voluptate expedita ut, autem nesciunt aperiam quis iure obcaecati. Dolore, nulla sapiente, sunt enim debitis aut ullam ad fugiat provident corporis, doloremque est. Ut illum quisquam quibusdam autem possimus blanditiis!\r\n Cupiditate nisi voluptatem molestiae ullam delectus magni recusandae asperiores porro dolor itaque temporibus nam, reiciendis doloremque dolores et laudantium molestias. Architecto mollitia dicta numquam adipisci atque rerum expedita temporibus laborum.\r\n Fugit est eaque aliquam amet nihil possimus enim, illo obcaecati, nisi similique eos alias earum optio corrupti unde a facilis quod accusantium sapiente nobis temporibus magni veritatis. Eveniet, ullam quaerat!\r\n Ea eos rerum totam ab harum provident, quaerat sapiente laboriosam aspernatur quibusdam nemo ipsum. Iusto quia a ipsam explicabo dicta velit sit expedita, dolorem fugiat veritatis culpa, mollitia voluptate ex!', 'none', 'none', 'Gabar_Singh', '2021-01-03 15:15:41');

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
(4, 'Ananthu', 'Sv', 'sananthu47@gmail.com', 'Ananthu_Sv', '$2y$10$rp1Mp2fpZYffb.QpdDOwNODaeyIXt0OiJkOpcJHeC7KfNGIVe8Apa', '2020-10-26', '1604906411_1601758369_IMG_9994.JPG', 1609667583, 'private', 10, 3, ',Star_Ananthu,Kokila_Ben,Gabar_Singh,', ''),
(5, 'Admin', '007', 'admin@gmail.com', 'Admin_007', '$2y$10$p91IB0EgG3Mcrqtna9mfv.YFRGQk.IMAb2ces1aepecG8Kiy8DFj6', '2020-10-26', '1604951272_profile.jpg', 1609099365, 'public', 2, 2, ',Star_Ananthu,Gabar_Singh,', ''),
(6, 'Star', 'Ananthu', 'ananthu@gmail.com', 'Star_Ananthu', '$2y$10$veq6UcQNesOsijUOr1v2h.lfwXYFEzTYT2STgVExkN2HAluDaLHBe', '2020-10-26', '1604951382_1602359930_IMG-20180808-WA0011.jpg', 1609583391, 'private', 6, 3, ',Ananthu_Sv,Admin_007,Gabar_Singh,', '#Pop\r\n#yoyo\r\nHi all!'),
(8, 'Kokila', 'Ben', 'kokila@gmail.com', 'Kokila_Ben', '$2y$10$inoBTtaG2cEbeBevW.ezuOirsinKx0lMqsHJXae.2ROi8CQCLgtD6', '2020-11-08', 'profile.png', 1608897588, 'private', 9, 2, ',Ananthu_Sv,Gabar_Singh,', ''),
(9, 'Gabar', 'Singh', 'gabar@gmail.com', 'Gabar_Singh', '$2y$10$oCgHZM24b1jqyBuSPUYfu.SEyp2iHRf/q1hrwmcv6QvwH1iPpX6Vi', '2020-11-12', '1605119795_randomguy.jpg', 1609870193, 'private', 14, 6, ',Ananthu_Sv,Kokila_Ben,Star_Ananthu,Unknown_Player,Admin_007,Guddu_Pandit,', 'Hello all'),
(10, 'Unknown', 'Player', 'unknown@gmail.com', 'Unknown_Player', '$2y$10$zAnZ/7FymmrJlrrU50hy5eFuOFQrDb.2gw5S0MqMj0Nbqm5SSUPI6', '2020-12-10', 'profile.png', 1609180014, 'private', 0, 1, ',Gabar_Singh,', ''),
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
-- Indexes for table `comment_replies`
--
ALTER TABLE `comment_replies`
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
-- Indexes for table `messages`
--
ALTER TABLE `messages`
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
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `comment_likes`
--
ALTER TABLE `comment_likes`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `comment_replies`
--
ALTER TABLE `comment_replies`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `friend_requests`
--
ALTER TABLE `friend_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

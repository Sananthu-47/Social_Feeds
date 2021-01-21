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
) ;

CREATE TABLE `friend_requests` (
  `id` int(11) NOT NULL,
  `request_to` varchar(50) NOT NULL,
  `request_by` varchar(50) NOT NULL,
  `request_time` datetime NOT NULL,
  `request_status` varchar(10) NOT NULL
) ;

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `post_body` text NOT NULL,
  `post_image` text NOT NULL,
  `post_to` varchar(100) NOT NULL DEFAULT 'none',
  `posted_by` varchar(100) NOT NULL,
  `posted_at` datetime NOT NULL
) ;

CREATE TABLE `likes` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `post_id` int(255) NOT NULL,
  `liked_at` datetime NOT NULL
) ;

CREATE TABLE `comments` (
  `id` int(255) NOT NULL,
  `post_id` int(255) NOT NULL,
  `comment_user_id` int(255) NOT NULL,
  `comment` text NOT NULL,
  `comment_date` datetime NOT NULL,
  `comment_status` varchar(10) NOT NULL DEFAULT 'approved'
) ;

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
) ;

CREATE TABLE `comment_likes` (
  `id` int(255) NOT NULL,
  `post_id` int(255) NOT NULL,
  `comment_id` int(255) NOT NULL,
  `reply_comment_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `liked_at` datetime NOT NULL
) ;

CREATE TABLE `comment_replies` (
  `id` int(255) NOT NULL,
  `post_id` int(255) NOT NULL,
  `comment_id` int(255) NOT NULL,
  `replied_to` int(255) NOT NULL,
  `replied_from` int(255) NOT NULL,
  `replied_at` datetime NOT NULL,
  `replied_message` varchar(255) NOT NULL
) ;

CREATE TABLE `messages` (
  `id` int(255) NOT NULL,
  `message_from` int(255) NOT NULL,
  `message_to` int(255) NOT NULL,
  `message` text NOT NULL,
  `sent_at` datetime NOT NULL,
  `seen_status` varchar(50) NOT NULL DEFAULT 'not seen',
  `msg_deleted` varchar(10) NOT NULL DEFAULT 'none'
) ;


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
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comment_likes`
--
ALTER TABLE `comment_likes`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comment_replies`
--
ALTER TABLE `comment_replies`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `friend_requests`
--
ALTER TABLE `friend_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

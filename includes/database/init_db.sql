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
);

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `post_body` text NOT NULL,
  `post_image` text NOT NULL,
  `post_to` varchar(100) NOT NULL DEFAULT 'none',
  `posted_by` varchar(100) NOT NULL,
  `posted_at` datetime NOT NULL
);

CREATE TABLE `likes` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `post_id` int(255) NOT NULL,
  `post_status` varchar(10) DEFAULT NULL,
  `liked_at` datetime NOT NULL
) ;

CREATE TABLE `comments` (
  `id` int(255) NOT NULL,
  `post_id` int(255) NOT NULL,
  `comment_user_id` int(255) NOT NULL,
  `comment` text NOT NULL,
  `comment_date` datetime NOT NULL,
  `comment_status` varchar(10) NOT NULL DEFAULT 'approved',
  `notification_status` varchar(10) NOT NULL DEFAULT 'unseen'
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
  `comment_id` int(255) NOT NULL
) ;
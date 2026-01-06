-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2026 at 09:56 AM
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
-- Database: `blog_application`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_text` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `post_id`, `user_id`, `comment_text`, `created_at`) VALUES
(1, 1, 3, 'So true!.. Confidence really is that inner calm that doesn’t need to prove itself to anyone..', '2026-01-06 13:38:00'),
(2, 4, 3, '“Love this mindset! Every skill learned is a win. Keep shining!”', '2026-01-06 13:40:18'),
(4, 6, 1, 'Love this! Progress is in the little things we often overlook', '2026-01-06 13:42:17');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `like_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`like_id`, `user_id`, `post_id`) VALUES
(3, 1, 3),
(2, 1, 4),
(5, 1, 6),
(1, 2, 1),
(4, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `title`, `content`, `created_at`) VALUES
(1, 1, 'Confidence Isn’t Loud — It’s Peaceful..', 'Real confidence isn’t shouting for attention. It’s knowing who you are, what you want, and what you deserve — without needing approval. It’s quiet. Calm. Certain. And it comes from self-respect.', '2026-01-06 13:21:27'),
(2, 3, 'Your Dreams Require Action — Not Just Motivation', 'Motivation feels good, but it fades. Discipline doesn’t. Show up even when you don’t feel like it. Progress comes from consistency, not mood. Your future depends on what you do daily.', '2026-01-06 13:23:58'),
(3, 2, 'Keep Going — Your Time Will Come ⏳..', '“Hard work is never wasted. Even if the results don’t appear immediately, they always come at the right time. Stay patient and stay committed.”..', '2026-01-06 13:26:33'),
(4, 2, 'Small Steps, Big Dreams 🌟', '“I’m focusing on my personal growth — one small step at a time. Every new skill brings new confidence. The goal is simple: never stop learning.”', '2026-01-06 13:27:30'),
(6, 3, 'Small Wins Matter More Than You Think', 'We often wait for big achievements to feel proud — a new job, a promotion, a degree. But the truth is, progress lives in the small wins: finishing a task, showing up on a tough day, choosing growth over comfort. Celebrate the tiny steps. They’re the real reason you’ll reach your big goals.', '2026-01-06 13:31:28'),
(7, 1, 'Balancing Studies & Skills 📚', '“Balancing my studies while learning new skills is challenging — but completely worth it. Good time management is the real key to success.”', '2026-01-06 13:49:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `password`, `profile_pic`) VALUES
(1, 'Laiba', 'laibaajaz089@gmail.com', '$2y$10$52srK/PbeRh/dCeXjMGaTO02636wkuQeE.DnwpLCC3DRbYiqvDyiW', 'user_1.jpg'),
(2, 'Aisha', 'aisha123@gmail.com', '$2y$10$b23vzJS.vHDw/3QCb4Q89OnjKYTVtI1xEqmZtM8jOORUPN/tumciC', 'default.jpg'),
(3, 'Kashaf', 'kashaf@gmail.com', '$2y$10$0mdDcNrrlWCRqNHUaF14Ge7.8Hn1ASEgULzR8PDoGXFfRdw4PWXUi', 'user_3.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`like_id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`post_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

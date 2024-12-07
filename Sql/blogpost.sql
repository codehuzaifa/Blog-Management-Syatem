-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2024 at 03:25 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blogpost`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`) VALUES
(1, 'Life Style', '2024-12-07 15:05:34'),
(2, 'Study', '2024-12-07 15:05:52'),
(3, 'Daily News', '2024-12-07 15:06:03'),
(4, 'EDUCATIOn', '2024-12-07 17:24:08'),
(5, 'Hotel', '2024-12-07 17:25:36');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `is_approved` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_name`, `content`, `is_approved`, `created_at`) VALUES
(2, 16, 'asdasd', 'asdasdasd', 1, '2024-12-07 13:49:06'),
(3, 16, 'asdas', 'asdasd', 1, '2024-12-07 13:49:45'),
(4, 16, 'asd', 'aszxczxc', 1, '2024-12-07 13:50:00'),
(5, 16, 'Mahesh ', 'YES ITS OSM DUDE\r\n', 1, '2024-12-07 13:50:34'),
(7, 8, 'Huzaif ali', 'waa mza aagya', 0, '2024-12-07 13:59:26'),
(8, 23, 'HUZAIFA ALI', 'yeshhhh modi ji i know you bro', 1, '2024-12-07 14:02:19'),
(9, 23, 'HUZAIFA ALI', 'yeshhhh modi ji i know you bro', 1, '2024-12-07 14:02:19'),
(10, 23, 'HUZAIFA ALI', 'yeshhhh modi ji i know you bro', 1, '2024-12-07 14:02:19'),
(11, 23, 'HUZAIFA ALI', 'yeshhhh modi ji i know you bro', 1, '2024-12-07 14:02:19'),
(12, 23, 'HUZAIFA ALI', 'yeshhhh modi ji i know you bro', 1, '2024-12-07 14:02:19'),
(13, 23, 'HUZAIFA ALI', 'yeshhhh modi ji i know you bro', 1, '2024-12-07 14:02:19'),
(14, 23, 'HUZAIFA ALI', 'yeshhhh modi ji i know you bro', 1, '2024-12-07 14:02:19'),
(15, 23, 'HUZAIFA ALI', 'yeshhhh modi ji i know you bro', 1, '2024-12-07 14:02:19'),
(16, 23, 'HUZAIFA ALI', 'yeshhhh modi ji i know you bro', 1, '2024-12-07 14:02:19'),
(17, 23, 'HUZAIFA ALI', 'yeshhhh modi ji i know you bro', 1, '2024-12-07 14:02:19'),
(18, 23, 'HUZAIFA ALI', 'yeshhhh modi ji i know you bro', 1, '2024-12-07 14:02:19'),
(19, 23, 'HUZAIFA ALI', 'yeshhhh modi ji i know you bro', 1, '2024-12-07 14:02:19'),
(20, 23, 'HUZAIFA ALI', 'yeshhhh modi ji i know you bro', 1, '2024-12-07 14:02:19'),
(21, 23, 'HUZAIFA ALI', 'yeshhhh modi ji i know you bro', 1, '2024-12-07 14:02:19'),
(22, 23, 'HUZAIFA ALI', 'yeshhhh modi ji i know you bro', 1, '2024-12-07 14:02:19'),
(23, 23, 'HUZAIFA ALI', 'yeshhhh modi ji i know you bro', 0, '2024-12-07 14:02:19'),
(24, 23, 'HUZAIFA ALI', 'yeshhhh modi ji i know you bro', 0, '2024-12-07 14:02:19'),
(25, 23, 'HUZAIFA ALI', 'yeshhhh modi ji i know you bro', 0, '2024-12-07 14:02:19'),
(26, 23, 'HUZAIFA ALI', 'yeshhhh modi ji i know you bro', 0, '2024-12-07 14:02:19'),
(27, 23, 'HUZAIFA ALI', 'yeshhhh modi ji i know you bro', 0, '2024-12-07 14:02:19'),
(28, 23, 'HUZAIFA ALI', 'yeshhhh modi ji i know you bro', 0, '2024-12-07 14:02:19'),
(29, 10, 'Huzaifa ali', ' hahahahahhahahaa', 1, '2024-12-07 18:48:20');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(225) NOT NULL,
  `description` text,
  `authername` text,
  `publish_date` datetime NOT NULL,
  `status` enum('draft','published') DEFAULT 'published',
  `category_id` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `image`, `description`, `authername`, `publish_date`, `status`, `category_id`) VALUES
(8, 'RAJJ BHAI KI KAHANI', '1733566279_QR_Code.png', 'kal hua aesa ke bs bata nhi sakta me ', 'RAJ BHAI', '2024-12-07 11:51:05', 'published', 0),
(9, 'RAJJ BHAI KI KAHANI', '1733552465_Screenshot 2024-10-07 122026.png', 'kal hua aesa ke bs bata nhi sakta me ', 'RAJ BHAI', '2024-12-07 11:51:05', 'published', 0),
(10, 'RAJJ BHAI KI KAHANI', '1733552465_Screenshot 2024-10-07 122026.png', 'kal hua aesa ke bs bata nhi sakta me ', 'RAJ BHAI', '2024-12-07 11:51:05', 'published', 3),
(11, 'RAJJ BHAI KI KAHANI', '1733552465_Screenshot 2024-10-07 122026.png', 'kal hua aesa ke bs bata nhi sakta me ', 'RAJ BHAI', '2024-12-07 11:51:05', 'published', 0),
(12, 'RAJJ BHAI KI KAHANI', '1733552465_Screenshot 2024-10-07 122026.png', 'kal hua aesa ke bs bata nhi sakta me ', 'RAJ BHAI', '2024-12-07 11:51:05', 'published', 0),
(13, 'RAJJ BHAI KI KAHANI', '1733552465_Screenshot 2024-10-07 122026.png', 'kal hua aesa ke bs bata nhi sakta me ', 'RAJ BHAI', '2024-12-07 11:51:05', 'published', 0),
(14, 'RAJJ BHAI KI KAHANI', '1733552465_Screenshot 2024-10-07 122026.png', 'kal hua aesa ke bs bata nhi sakta me ', 'RAJ BHAI', '2024-12-07 11:51:05', 'published', 0),
(15, 'RAJJ BHAI KI KAHANI', '1733552465_Screenshot 2024-10-07 122026.png', 'kal hua aesa ke bs bata nhi sakta me ', 'RAJ BHAI', '2024-12-07 11:51:05', 'published', 0),
(16, 'RAJJ BHAI KI KAHANI', '1733552465_Screenshot 2024-10-07 122026.png', 'kal hua aesa ke bs bata nhi sakta me ', 'RAJ BHAI', '2024-12-07 11:51:05', 'published', 0),
(17, 'RAJJ BHAI KI KAHANI', '1733552465_Screenshot 2024-10-07 122026.png', 'kal hua aesa ke bs bata nhi sakta me ', 'RAJ BHAI', '2024-12-07 11:51:05', 'published', 1),
(18, 'RAJJ BHAI KI KAHANI', '1733552465_Screenshot 2024-10-07 122026.png', 'kal hua aesa ke bs bata nhi sakta me ', 'RAJ BHAI', '2024-12-07 11:51:05', 'published', 3),
(19, 'RAJJ BHAI KI KAHANI', '1733552465_Screenshot 2024-10-07 122026.png', 'kal hua aesa ke bs bata nhi sakta me ', 'RAJ BHAI', '2024-12-07 11:51:05', 'published', 3),
(20, 'RAJJ BHAI KI KAHANI', '1733552465_Screenshot 2024-10-07 122026.png', 'kal hua aesa ke bs bata nhi sakta me ', 'RAJ BHAI', '2024-12-07 11:51:05', 'published', 3),
(21, 'RAJJ BHAI KI KAHANI', '1733552465_Screenshot 2024-10-07 122026.png', 'kal hua aesa ke bs bata nhi sakta me ', 'RAJ BHAI', '2024-12-07 11:51:05', 'published', 3),
(22, 'RAJJ BHAI KI KAHANI', '1733552465_Screenshot 2024-10-07 122026.png', 'kal hua aesa ke bs bata nhi sakta me ', 'RAJ BHAI', '2024-12-07 11:51:05', 'published', 3),
(23, 'JYOTI LOVEEEEE', '1733560285_Shri_Narendra_Modi,_Prime_Minister_of_India.jpg', 'Narendra Damodardas Modi[a] (born 17 September 1950)[b] is an Indian politician who has served as Prime Minister of India since 2014. Modi was the chief minister of Gujarat from 2001 to 2014 and is the member of parliament (MP) for Varanasi. He is a member of the Bharatiya Janata Party (BJP) and of the Rashtriya Swayamsevak Sangh (RSS), a right-wing Hindu nationalist paramilitary volunteer organisation. He is the longest-serving prime minister outside the Indian National Congress.[4]\r\n\r\nModi was born and raised in Vadnagar in northeastern Gujarat, where he completed his secondary education. He was introduced to the RSS at the age of eight. At the age of 18, he was married to Jashodaben Modi, whom he abandoned soon after, only publicly acknowledging her four decades later when legally required to do so. Modi became a full-time worker for the RSS in Gujarat in 1971. The RSS assigned him to the BJP in 1985 and he rose through the party hierarchy, becoming general secretary in 1998.[c] In 2001, Modi was appointed Chief Minister of Gujarat and elected to the legislative assembly soon after. His administration is considered complicit in the 2002 Gujarat riots,[d] and has been criticised for its management of the crisis. According to official records, a little over', 'JYOTI LOVEEEEE', '2024-12-07 14:01:25', 'published', 3),
(24, 'LAKHAN Ki kahani', '1733566303_Facts Of Training on Twitter.jpg', 'hahahahahahaha ahahahahahahhaaha ahahhaahahahhah ahahahahahahaha hahahaha', 'LAKHAN', '2024-12-07 15:41:43', 'published', 3),
(25, 'Raju bhai', '1733566385_WhatsApp Image 2024-11-22 at 11.32.54 AM.jpeg', 'kaslkdlkasjdklaj salskd lkas das;dhasjdfhasd fljadhf adlf jdsahvjasdf a\'dskf\'\\a sdkfakdjfkadsf\\\'adsk f\'aksd\'fa', 'Raju', '2024-12-07 15:43:05', 'published', 3),
(26, 'LIFE STYLE', '1733568434_4_5958585735228429579.jpg', 'asjlan als lasldaslk asdasd', 'LIFE BOY', '2024-12-07 16:01:07', 'published', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `email`, `password`, `is_active`, `created_at`) VALUES
(1, 'Huziafa ali', 'huzaifa@gmail.com', '$2y$10$aIMlFa3jZCgGbCN3BJuKFuY5.AcuU60WTFz2Rt0OXmzn8Zkpf9/ei', 1, '2024-12-07 11:59:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `posts` ADD FULLTEXT KEY `title` (`title`,`description`,`authername`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 08, 2022 at 10:10 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uploadsproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(3) UNSIGNED NOT NULL,
  `mediaType` enum('A','V','I') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `mediaType`) VALUES
(1, 'A'),
(2, 'V'),
(3, 'I');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) UNSIGNED NOT NULL,
  `comment` varchar(150) NOT NULL,
  `userId` int(11) NOT NULL,
  `fileUploadsId` int(11) NOT NULL,
  `datePosted` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `userId`, `fileUploadsId`, `datePosted`) VALUES
(1, 'Cool Image', 2, 91, '2021-01-19');

-- --------------------------------------------------------

--
-- Table structure for table `fileuploads`
--

CREATE TABLE `fileuploads` (
  `id` int(11) UNSIGNED NOT NULL,
  `userId` int(12) DEFAULT NULL,
  `mediaType` enum('A','V','I') NOT NULL,
  `datePosted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fileName` varchar(75) NOT NULL,
  `access` enum('Pub','Pri') NOT NULL DEFAULT 'Pub',
  `title` varchar(50) NOT NULL DEFAULT 'No Title'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fileuploads`
--

INSERT INTO `fileuploads` (`id`, `userId`, `mediaType`, `datePosted`, `fileName`, `access`, `title`) VALUES
(76, 1, 'I', '2020-12-24 22:52:35', '0a777a5c1d7d48099e30485e21fc59fa.jpg', 'Pub', ''),
(78, 1, 'A', '2020-12-30 16:40:26', '4_5938417234526340835.mp3', 'Pub', ''),
(79, 1, 'A', '2020-12-30 16:40:35', 'Chike-Roju.mp3', 'Pub', ''),
(80, 1, 'A', '2020-12-30 16:40:45', '4_5936178362564217754.mp3', 'Pub', ''),
(81, 1, 'A', '2020-12-30 16:41:10', 'Omah-Lay-lolo.mp3', 'Pub', ''),
(82, 1, 'A', '2020-12-30 16:56:32', 'Odumeje-Umu-Jesus-ft-Flavour-(TrendyBeatz.com).mp3', 'Pub', ''),
(83, 1, 'A', '2020-12-30 16:57:02', 'CKay - Love Nwantiti Remix ft. Joeboy _ Kuami Euge(1080P_HD).mp4.mp3', 'Pub', ''),
(84, 1, 'A', '2020-12-30 18:41:16', 'Carrie_Underwood_-_Love_Wins.mp3', 'Pub', ''),
(85, 1, 'I', '2021-01-01 22:04:14', 'FB_IMG_15924297157427271.jpg', 'Pub', ''),
(86, 8, 'A', '2021-01-01 23:05:10', 'Ada_I_Testify_9jaflaver.com_.mp3', 'Pub', ''),
(87, 1, 'I', '2021-01-02 07:30:18', 'toaHeftiba96.jpg', 'Pub', ''),
(91, 1, 'I', '2021-01-02 21:42:08', 'a1385bb9bb7d4ec6a186ac9cdbfde144.jpg', 'Pub', ''),
(92, 1, 'I', '2021-01-02 21:42:38', 'droneshot2.jpg', 'Pub', ''),
(93, 1, 'I', '2021-01-03 02:54:17', 'ccc.jpg', 'Pub', ''),
(94, 2, 'I', '2021-01-03 04:06:54', '1-3.jpg', 'Pub', ''),
(95, 1, 'I', '2021-01-03 04:08:08', 'F1804EC3-B56E-4704-AC6B-94C59C1ADC7CL0001-1.jpg', 'Pub', ''),
(96, 2, 'I', '2021-01-03 04:08:43', 'chair_and_plants-wallpaper-1280x1024.jpg', 'Pub', ''),
(97, 1, 'I', '2021-01-03 05:49:54', 'arusflyWtzI.jpg', 'Pub', 'olisa'),
(98, 1, 'I', '2021-01-03 05:52:18', '7942745_img20181008110257_jpegbf050222c0bc2a895ad7f4277528f492.jpg', 'Pub', 'gvgngf '),
(99, 1, 'I', '2021-01-03 05:55:42', 'IMG_20171004_060058.jpg', 'Pub', ''),
(100, 2, 'I', '2021-01-03 05:58:09', '50bc621de1ae492382a687ea18255d49.jpg', 'Pub', ''),
(101, 2, 'I', '2021-01-03 06:07:52', '20200829_160226.jpg', 'Pub', ''),
(102, 1, 'I', '2021-01-03 06:14:41', 'ecee5f10c2ce439dbb9b11d678827fe3.jpg', 'Pub', ''),
(103, 2, 'I', '2021-01-03 06:40:47', '4998427b6a374840b48d312d242054a3.jpg', 'Pub', ''),
(104, 1, 'I', '2021-01-03 07:27:43', 'ac9fcf46ae4144a7aff623a6c37e2553.jpg', 'Pub', ''),
(105, 2, 'I', '2021-01-03 07:59:39', 'aaa.jpg', 'Pub', ''),
(106, 1, 'I', '2021-01-03 08:03:38', 'Amazon.jpg', 'Pub', ''),
(107, 2, 'I', '2021-01-03 08:09:03', 'chewyRks.jpg', 'Pub', 'olisa'),
(108, 2, 'I', '2021-01-19 03:34:58', '3fb96d25f8112ea7e67aedefb7e4e9d3.jpg', 'Pub', 'zzzbb'),
(113, 1, 'I', '2021-01-20 08:18:02', '20adf225f6898d91a9ff6a574726375f.jpg', 'Pub', 'ngffd'),
(114, 1, 'I', '2021-02-19 20:25:30', 'capitol-wallpaper-1280x1024.jpg', 'Pub', 'cyril'),
(115, NULL, 'I', '2021-03-02 05:26:54', 'C:fakepathScreenshot (15).png', 'Pub', 'FAKE'),
(116, NULL, 'I', '2021-03-02 05:27:23', 'Screenshot (34).png', 'Pub', 'FAKE'),
(117, NULL, 'I', '2021-03-02 05:30:23', 'C:fakepathScreenshot (33).png', 'Pub', 'FAKE'),
(118, NULL, 'I', '2021-03-02 06:12:23', 'C:fakepathScreenshot (6).png', 'Pub', 'FAKE'),
(119, NULL, 'I', '2021-03-02 06:19:51', 'C:fakepathScreenshot (60).png', 'Pub', 'FAKE'),
(120, 1, 'I', '2021-03-03 01:55:49', 'images.jpg', 'Pub', 'FAKE'),
(121, 1, 'A', '2021-03-09 07:05:07', 'Prophet emaka Odumeje Spiritual Music (7).mp3', 'Pub', 'odumeje'),
(122, 1, 'A', '2021-03-09 07:05:37', 'EMEKA ODUMEJE SPECIAL (6).mp3', 'Pub', 'odu'),
(124, 1, 'I', '2021-04-27 05:14:58', '20200622_111611.jpg', 'Pub', 'emelie mds'),
(126, 1, 'A', '2021-04-28 18:42:06', 'La casa de papel - Bella Ciao.mp3', 'Pub', 'wwww'),
(127, 1, 'A', '2021-04-28 18:43:09', 'big old shoulders.mp3', 'Pub', 'Big old'),
(128, 1, 'V', '2021-04-28 18:43:49', '2. Introduction to Modern JavaScript (ES6).mp4', 'Pub', 'dxdds'),
(129, 1, 'V', '2021-04-28 18:44:27', 'Ajax Live Data Search using Jquery PHP MySql.mp4', 'Pub', 'zdfbfd'),
(133, 1, 'V', '2021-04-28 19:38:24', '50b480599d314322a57a2e57571b40dc.mp4', 'Pub', 'nmvmnvmhc'),
(135, 1, 'I', '2021-04-30 10:25:50', 'heart.png', 'Pub', 'heart'),
(136, 1, 'V', '2021-05-09 23:32:09', 'Lead me 2 d cross.3gp', 'Pub', 'jbj, bn'),
(138, 1, 'V', '2021-05-10 16:02:10', '4_5985439107713599670.mp4', 'Pub', 'refdfdbhj'),
(139, 1, 'A', '2021-05-11 09:24:58', 'oceans.mp3', 'Pub', 'oceans');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(12) UNSIGNED NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `otherName` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `gender` enum('M','F') NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `otherName`, `username`, `password`, `gender`, `dateCreated`) VALUES
(1, 'chiemelie', 'chiemelie', 'ezehigc@gmail.com', 'chiemelie', 'chiemelie chiemelie', '123', 'M', '2020-12-24 00:00:00'),
(2, 'ig', 'ignatius', 'igc@gmail.com', 'ig', 'ig ignatius', 'qqq', 'M', '2020-12-24 00:00:00'),
(3, 'bundu', 'buu', 'bb@gmail.com', 'buu', 'bundu buu', 'zzz', 'M', '2020-12-24 00:00:00'),
(5, 'fName', 'lName', 'email', 'oName', 'names', 'pass', 'M', '2020-12-24 00:00:00'),
(6, 'cyril', 'cyril', 'chi@gmail.com', 'cyril', 'cyril cyril', '123', 'M', '2021-01-01 22:03:43'),
(7, 'ebuka', 'chiemelie', 'chi@gmail.com', 'wwww', 'ebuka chiemelie', '123', 'M', '2021-01-01 22:58:16'),
(8, 'cccc', 'ccc', 'igc@gmail.com', 'cccc', 'cccc ccc', '123', 'F', '2021-01-01 23:01:34');

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fileuploads`
--
ALTER TABLE `fileuploads`
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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `fileuploads`
--
ALTER TABLE `fileuploads`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2021 at 09:20 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `budget_facebook`
--

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` tinyint(4) NOT NULL,
  `name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`) VALUES
(1, 'like'),
(2, 'comment'),
(3, 'share');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `status_code` varchar(5) NOT NULL,
  `content` varchar(280) NOT NULL,
  `date` date NOT NULL,
  `visibility_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`status_code`, `content`, `date`, `visibility_id`) VALUES
('S1241', 'dsfafwa', '2021-04-10', 102),
('S2352', '32423', '2021-04-06', 103),
('S2532', 'afrqwwq', '2021-04-12', 102),
('S3216', 'Shgasvfjkaswbflkiawq', '2021-04-08', 103),
('S3241', '324235235', '2021-04-12', 102),
('S3254', 'asfdwqa', '2021-04-12', 102),
('S3323', '46 a4ft gs4 d4w3sa345r ***&532', '2021-04-12', 102),
('S3334', '2qwre2 2 aswdreaqwew', '2021-04-07', 102),
('S3423', 'rhrtwer4tew4', '2021-04-12', 102),
('S3463', 'Z***Q3w4rq24e1', '2021-04-12', 102),
('S3673', 'ewt3452345', '2021-04-12', 102),
('S4363', 'sdazfegreasfwea', '2021-04-12', 102),
('S4365', 'dsgsetw345', '2021-04-12', 102),
('S4564', 'asdwq', '2021-04-12', 102),
('S4575', 'cvsdffew', '2021-04-12', 102),
('S4634', '43653453', '2021-04-06', 102),
('S5223', 'sadawq', '2021-04-12', 102),
('S5325', 'asdgddeee', '2021-04-11', 102),
('S5466', 'gdr', '2021-04-12', 102),
('S5474', 'dhgdsrtfswer', '2021-04-12', 102),
('S5555', 'gfsgsdvds ewqrqwrq', '2021-04-08', 101),
('S5735', 'dsgeew', '2021-04-12', 102),
('S5856', 'sdgwe5w', '2021-04-12', 102),
('S6345', 'sdgewewf', '2021-04-12', 102),
('S6436', 'asfwa', '2021-04-12', 102),
('S6546', 'asfwa', '2021-04-12', 102),
('S6555', 'dsfawfw', '2021-04-12', 102),
('S6785', 'Actual post; who woulda thought', '2021-04-12', 102),
('S6969', 'HELLO WORLD PLEASE WORK', '2021-04-12', 103),
('S7354', '&&&&&#W532q', '2021-04-12', 102),
('S7634', 'dgaeeas', '2021-04-12', 102),
('S7697', 'tjruty', '2021-04-12', 102),
('S7986', 'fdgwetwe4', '2021-04-12', 102),
('S8586', '**% %754swESDF', '2021-04-12', 102),
('S9080', 'hdrfyherty', '2021-04-12', 102),
('Syery', 'dsfghryweyr', '2021-04-12', 102);

-- --------------------------------------------------------

--
-- Table structure for table `post_permissions`
--

CREATE TABLE `post_permissions` (
  `id` int(11) NOT NULL,
  `code` varchar(5) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post_permissions`
--

INSERT INTO `post_permissions` (`id`, `code`, `permission_id`) VALUES
(25, 'S2352', 1),
(26, 'S2352', 3),
(27, 'S3334', 2),
(28, 'S5555', 1),
(29, 'S5555', 2),
(30, 'S5555', 3),
(31, 'S3216', 1),
(32, 'S1241', 1),
(33, 'S1241', 2),
(34, 'S1241', 3),
(35, 'S5325', 1),
(36, 'S5325', 3),
(42, 'S4564', 1),
(43, 'S4564', 2),
(44, 'S4564', 3),
(45, 'S5223', 1),
(46, 'S5223', 2),
(47, 'S5223', 3),
(48, 'S3254', 1),
(49, 'S6785', 1),
(50, 'S6785', 2),
(51, 'S6785', 3),
(52, 'S4575', 2),
(53, 'S4575', 3),
(54, 'S6345', 1),
(55, 'S6345', 3),
(56, 'S5735', 2),
(57, 'S5735', 3),
(58, 'S4363', 2),
(59, 'S4363', 3),
(60, 'S6546', 1),
(61, 'S6546', 3),
(62, 'S6436', 1),
(63, 'S6436', 3),
(64, 'S6969', 1),
(65, 'S6969', 2),
(66, 'S6969', 3),
(67, 'S6969', 1),
(68, 'S6969', 2),
(69, 'S6969', 3),
(70, 'S6969', 1),
(71, 'S6969', 2),
(72, 'S6969', 3),
(73, 'S6969', 1),
(74, 'S6969', 2),
(75, 'S6969', 3),
(76, 'S7354', 1),
(77, 'S7354', 2);

-- --------------------------------------------------------

--
-- Table structure for table `visibility`
--

CREATE TABLE `visibility` (
  `id` int(11) NOT NULL,
  `name` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `visibility`
--

INSERT INTO `visibility` (`id`, `name`) VALUES
(101, 'Only Me'),
(102, 'Friends'),
(103, 'Public');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`status_code`);

--
-- Indexes for table `post_permissions`
--
ALTER TABLE `post_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visibility`
--
ALTER TABLE `visibility`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `post_permissions`
--
ALTER TABLE `post_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `visibility`
--
ALTER TABLE `visibility`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

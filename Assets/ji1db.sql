-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 03, 2017 at 03:38 PM
-- Server version: 10.1.24-MariaDB
-- PHP Version: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ji1db`
--

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE `links` (
  `id` int(11) NOT NULL,
  `long` varchar(700) NOT NULL,
  `short` varchar(50) NOT NULL,
  `userCreated` varchar(11) NOT NULL DEFAULT 'guest',
  `click` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `links`
--

INSERT INTO `links` (`id`, `long`, `short`, `userCreated`, `click`) VALUES
(1, 'sdfsdfds', 'sdfdsfdsfdsf', 'guest', 0),
(2, 'sdfsdfds', 'sdfdsfdsfdsf', 'guest', 0),
(3, 'sdfsdfds', 'sdfdsfdsfdsf', 'guest', 0),
(4, 'sdfsdfds', 'sdfdsfdsfdsf', 'guest', 0),
(5, 'http://a.com', 'http://a.com', 'http://a.co', 0),
(6, 'http://a.com13242', 'http://a.com13242', 'http://a.co', 0),
(7, 'http://a.com/13242', 'http://a.com/13242', 'http://a.co', 0),
(8, 'http://a.com', 'http://a.com', 'http://a.co', 0),
(9, 'http://a.com', 'http://a.com', 'http://a.co', 0),
(10, 'http://a.com', 'http://pc/linkshortner/shortner.php/2496', 'http://a.co', 0),
(11, 'http://a.com', 'http://pc/linkshortner/shortner.php/558', 'guest', 0),
(12, 'http://a.com', 'http://pc/linkshortner/shortner.php/9343', 'guest', 0),
(13, 'http://a.com', 'http://pc/linkshortner/shortner.php/9169', 'guest', 0),
(14, 'http://a.com', 'http://pc/linkshortner/shortner.php/9206', 'guest', 0),
(15, 'http://a.com', 'http://pc/linkshortner/shortner.php/3911', 'guest', 0),
(16, 'http://a.com', 'http://pc/linkshortner/shortner.php/7998', 'guest', 0),
(17, 'http://a.com', 'http://pc/linkshortner/shortner.php/2579', 'guest', 0),
(18, 'http://a.com', 'http://pc/linkshortner/shortner.php/6588', 'guest', 0),
(19, 'http://a.com', 'http://pc/linkshortner/shortner.php/2759', 'guest', 0),
(20, 'http://a.com', 'http://pc/linkshortner/shortner.php/8108', 'guest', 0),
(21, 'http://a.com', 'http://pc/linkshortner/shortner.php/5389', 'guest', 0),
(22, 'http://a.com', 'http://pc/linkshortner/shortner.php/3566', 'guest', 0),
(23, 'http://a.com', 'http://pc/linkshortner/shortner.php/7172', 'guest', 0),
(24, 'http://a.com', 'http://pc/linkshortner/shortner.php/3727', 'guest', 0),
(25, 'http://a.com', 'http://pc/linkshortner/shortner.php/3542', 'guest', 0),
(26, 'http://a.com', 'http://pc/linkshortner/shortner.php/4605', 'guest', 0),
(27, 'http://a.com', 'http://pc/linkshortner/shortner.php/5892', 'guest', 0),
(28, 'http://a.com', 'http://pc/linkshortner/shortner.php/6756', 'guest', 0),
(29, 'http://a.com', 'http://pc/linkshortner/shortner.php/6640', 'guest', 0),
(30, 'http://a.com', 'http://pc/linkshortner/shortner.php/4881', 'guest', 0),
(31, 'http://a.com', 'http://pc/linkshortner/shortner.php/8780', 'guest', 0),
(32, 'http://a.com', 'http://pc/linkshortner/shortner.php/7947', 'guest', 0),
(33, 'http://a.com', 'http://pc/linkshortner/shortner.php/6554', 'guest', 0),
(34, 'http://a.com', 'http://pc/linkshortner/shortner.php/7193', 'guest', 0),
(35, 'http://a.com', 'http://pc/linkshortner/shortner.php/7260', 'guest', 0),
(36, 'http://a.com', 'http://pc/linkshortner/shortner.php/2970', 'guest', 0),
(37, 'http://a.com', 'http://pc/linkshortner/shortner.php/7084', 'guest', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `isShowAdd` tinyint(1) DEFAULT '0',
  `shabaCode` varchar(20) NOT NULL,
  `inventory` int(11) DEFAULT '0',
  `isAdvisor` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `mail`, `password`, `isShowAdd`, `shabaCode`, `inventory`, `isAdvisor`) VALUES
(4, 'kamyar', 'kamrosoft@yahoo.com', 'ka1010101010', 1, '1234567899123456789', 0, 0),
(5, 'sdsa', 'sfdsds', 'sdfsdfsd', 0, 'sffsdgfd', 0, 0),
(6, 'http://a.com', 'http://a.com', 'http://a.com', 0, 'http://a.com', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `links`
--
ALTER TABLE `links`
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
-- AUTO_INCREMENT for table `links`
--
ALTER TABLE `links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

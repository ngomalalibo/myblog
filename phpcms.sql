-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2020 at 11:17 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpcms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `addedby` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `datetime`, `username`, `password`, `addedby`) VALUES
(3, 'Sep-21-2020 10:04:03 AM +0100', 'ngo', '1234', 'Ngo Alalibo');

-- --------------------------------------------------------

--
-- Table structure for table `admin_posts`
--

CREATE TABLE `admin_posts` (
  `id` int(10) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `title` varchar(200) NOT NULL,
  `category` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL,
  `image` varchar(200) NOT NULL,
  `post` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_posts`
--

INSERT INTO `admin_posts` (`id`, `datetime`, `title`, `category`, `author`, `image`, `post`) VALUES
(6, 'Sep-20-2020 14:34:32 PM +0100', 'This is great', 'Java', 'Ngo Alalibo', 'carousel3_resized.jpg', 'Great colors'),
(8, 'Sep-20-2020 19:40:02 PM +0100', 'Beome your best self', 'Training', 'Ngo Alalibo', 'carousel3_resized.jpg', 'Become your best self is the best thing to do on your journey to pleasing God'),
(9, 'Sep-20-2020 20:06:10 PM +0100', 'sdfghj', 'Archived', 'Ngo Alalibo', 'image1_sized.jpg', 'sdghgfd'),
(10, 'Sep-21-2020 10:21:01 AM +0100', 'Testing admin', 'HTML', 'ngo', 'adobe.jpg', 'Testing'),
(11, 'Sep-21-2020 10:28:31 AM +0100', 'Post 1', 'Training', 'ngo', 'alesia-kazantceva-XLm6-fPwK5Q-unsplash.jpg', 'frttr'),
(12, 'Sep-21-2020 10:28:45 AM +0100', 'post 2', 'Archived', 'ngo', 'allie-KzUsqBRU0T4-unsplash.jpg', 'erfgff'),
(13, 'Sep-21-2020 10:28:56 AM +0100', 'post 3', 'Java', 'ngo', 'andrew-neel-cckf4TsHAuw-unsplash.jpg', 'fgf'),
(14, 'Sep-21-2020 10:29:07 AM +0100', 'post 4', 'HTML', 'ngo', 'andrew-neel-QLqNalPe0RA-unsplash.jpg', 'dfvbdf'),
(15, 'Sep-21-2020 10:29:17 AM +0100', 'post 5', 'Fiction', 'ngo', 'annie-spratt-vGgn0xLdy8s-unsplash.jpg', 'fgfdf'),
(16, 'Sep-21-2020 10:29:33 AM +0100', 'post 7', 'Trending', 'ngo', 'austin-chan-ukzHlkoz1IE-unsplash.jpg', 'fgf'),
(17, 'Sep-21-2020 10:29:48 AM +0100', 'post 8', 'Training', 'ngo', 'austin-distel-mpN7xjKQ_Ns-unsplash.jpg', 'fgffgb'),
(18, 'Sep-21-2020 10:30:04 AM +0100', 'post 9', 'Java', 'ngo', 'carousel5.jpg', 'ertg'),
(19, 'Sep-21-2020 10:30:14 AM +0100', 'post 10', 'Archived', 'ngo', 'carousel4.jpg', 'fgfg');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `creatorname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `datetime`, `name`, `creatorname`) VALUES
(2, 'Sep-19-2020 13:21:32 PM +0100', 'Trending', 'Ngo Alalibo'),
(3, 'Sep-19-2020 13:21:48 PM +0100', 'Fiction', 'Ngo Alalibo'),
(4, 'Sep-19-2020 13:25:48 PM +0100', 'HTML', 'Ngo Alalibo'),
(5, 'Sep-19-2020 13:26:01 PM +0100', 'Java', 'Ngo Alalibo'),
(6, 'Sep-19-2020 17:05:56 PM +0100', 'Archived', 'Ngo Alalibo'),
(7, 'Sep-19-2020 17:09:32 PM +0100', 'Training', 'Ngo Alalibo');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `comment` varchar(300) NOT NULL,
  `status` varchar(20) NOT NULL,
  `postid` int(10) NOT NULL,
  `approvedby` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `datetime`, `name`, `email`, `comment`, `status`, `postid`, `approvedby`) VALUES
(2, 'Sep-20-2020 15:47:23 PM +0100', 'Nengi', 'nengi@gmail.com', 'Great write up', 'ON', 6, ''),
(3, 'Sep-20-2020 15:48:37 PM +0100', 'Ngo Alalibo', 'ngomalalibo@yahoo.com', 'Comment', 'OFF', 6, 'ngo');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_posts`
--
ALTER TABLE `admin_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `commentpostid` (`postid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `admin_posts`
--
ALTER TABLE `admin_posts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `commentposts` FOREIGN KEY (`postid`) REFERENCES `admin_posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

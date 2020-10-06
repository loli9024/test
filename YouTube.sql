-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 06, 2020 at 03:28 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `YouTube`
--
CREATE DATABASE IF NOT EXISTS `YouTube` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `YouTube`;


ALTER USER 'root'@'localhost' IDENTIFIED BY 'secret';

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Film & Animation'),
(2, 'Autos & Vehicles'),
(3, 'Music'),
(4, 'Pets & Animals'),
(5, 'Sports'),
(6, 'Gaming');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `postedBy` varchar(25) NOT NULL,
  `videoId` int(11) NOT NULL,
  `responseTo` varchar(25) NOT NULL,
  `body` varchar(500) NOT NULL,
  `datePosted` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `postedBy`, `videoId`, `responseTo`, `body`, `datePosted`) VALUES
(1, 'loreldr', 1, '0', 'wow', '2020-05-12 18:50:26'),
(2, 'laurita', 6, '0', 'Super!!!!', '2020-05-12 19:09:57'),
(3, 'laurita', 2, '0', 'wowwwwwww', '2020-05-12 19:13:00'),
(4, 'laurita', 1, '0', 'super', '2020-05-12 19:14:28'),
(5, 'laurita', 2, '0', 'feooo', '2020-05-12 19:15:12'),
(6, 'loreldr', 1, '0', 'prueba', '2020-05-15 19:02:07'),
(7, 'loreldr', 1, '0', 'prueba', '2020-05-15 19:03:03'),
(8, 'lorediaz', 1, '0', 'prueba', '2020-05-19 22:21:41'),
(9, 'lorediaz', 1, '0', 'prueba', '2020-05-19 22:23:14'),
(10, 'lorediaz', 1, '0', 'prueba', '2020-05-19 22:25:08'),
(11, 'lorediaz', 1, '0', 'prueba', '2020-05-19 22:25:34'),
(12, 'lorediaz', 1, '0', 'prueba', '2020-05-19 22:39:37'),
(13, 'lorediaz', 1, '0', 'pruebaaaa', '2020-05-19 22:40:13'),
(14, 'lorediaz', 1, '0', 'e', '2020-05-19 22:43:22'),
(15, 'lorediaz', 1, '0', 'p', '2020-05-19 22:43:30');

-- --------------------------------------------------------

--
-- Table structure for table `dislikes`
--

CREATE TABLE `dislikes` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `videoId` int(11) NOT NULL,
  `commentId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dislikes`
--

INSERT INTO `dislikes` (`id`, `username`, `videoId`, `commentId`) VALUES
(1, 'loreldr', 1, 0),
(6, 'laurita', 2, 0),
(8, 'laurita', 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `videoId` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `username`, `videoId`, `date`) VALUES
(1, 'loreldr', 6, '2020-05-15 21:16:51'),
(2, 'loreldr', 6, '2020-05-15 21:17:35'),
(3, 'loreldr', 6, '2020-05-15 21:22:51'),
(4, 'loreldr', 5, '2020-05-15 21:23:07'),
(5, 'loreldr', 1, '2020-05-15 21:23:10'),
(6, 'loreldr', 1, '2020-05-15 21:23:50'),
(7, 'loreldr', 1, '2020-05-15 21:23:55'),
(8, 'loreldr', 5, '2020-05-15 21:24:09'),
(9, 'loreldr', 2, '2020-05-15 21:24:15'),
(10, 'loreldr', 3, '2020-05-15 21:24:16'),
(11, 'loreldr', 4, '2020-05-15 21:24:17'),
(12, 'loreldr', 5, '2020-05-15 21:24:19'),
(13, 'loreldr', 6, '2020-05-15 22:23:00'),
(14, 'loreldr', 6, '2020-05-15 22:26:01'),
(15, 'laurita', 2, '2020-05-15 22:41:56'),
(16, 'laurita', 4, '2020-05-15 22:42:01'),
(17, 'laurita', 1, '2020-05-17 16:11:52'),
(18, 'laurita', 2, '2020-05-17 16:15:56'),
(19, 'laurita', 2, '2020-05-17 16:18:57'),
(20, 'laurita', 2, '2020-05-17 16:19:50'),
(21, 'laurita', 2, '2020-05-17 16:20:02'),
(22, 'laurita', 2, '2020-05-17 16:20:41'),
(23, 'laurita', 2, '2020-05-17 16:20:42'),
(24, 'laurita', 6, '2020-05-17 19:11:40'),
(25, 'laurita', 16, '2020-05-17 22:31:58'),
(26, 'laurita', 19, '2020-05-17 22:32:08'),
(27, 'laurita', 19, '2020-05-17 22:55:23'),
(28, 'loreldr', 1, '2020-05-17 22:56:45'),
(29, 'loreldr', 1, '2020-05-17 22:56:48'),
(30, 'loreldr', 3, '2020-05-17 22:57:29'),
(31, 'loreldr', 20, '2020-05-17 22:57:41'),
(32, 'loreldr', 20, '2020-05-18 11:03:09'),
(33, 'loreldr', 20, '2020-05-18 11:42:08'),
(34, 'loreldr', 20, '2020-05-18 11:43:39'),
(35, 'loreldr', 20, '2020-05-18 11:45:50'),
(36, 'loreldr', 21, '2020-05-18 11:55:03'),
(37, 'loreldr', 21, '2020-05-18 12:02:10'),
(38, 'laurita', 18, '2020-05-18 21:07:32'),
(39, 'laurita', 17, '2020-05-18 21:07:37'),
(40, 'laurita', 8, '2020-05-18 21:19:02'),
(41, 'laurita', 7, '2020-05-18 21:33:44'),
(42, 'laurita', 3, '2020-05-18 22:09:19'),
(43, 'laurita', 3, '2020-05-18 22:50:26'),
(44, 'laurita', 3, '2020-05-18 22:50:28'),
(45, 'laurita', 3, '2020-05-18 22:50:29'),
(46, 'laurita', 3, '2020-05-18 22:50:30'),
(47, 'laurita', 3, '2020-05-18 22:50:31'),
(48, 'laurita', 3, '2020-05-18 22:54:44'),
(49, 'loreldr', 1, '2020-05-19 21:42:25'),
(50, 'loreldr', 1, '2020-05-19 21:43:21'),
(51, 'loreldr', 1, '2020-05-19 21:53:29'),
(52, 'loreldr', 1, '2020-05-19 21:54:23'),
(53, 'loreldr', 1, '2020-05-19 21:55:27'),
(54, 'loreldr', 1, '2020-05-19 21:55:47'),
(55, 'loreldr', 1, '2020-05-19 21:58:45'),
(56, 'loreldr', 1, '2020-05-19 21:59:18'),
(57, 'lorediaz', 3, '2020-05-19 22:00:11'),
(58, 'loreldr', 1, '2020-05-19 22:05:01'),
(59, 'lorediaz', 1, '2020-05-19 22:05:12'),
(60, 'lorediaz', 1, '2020-05-19 22:05:12'),
(61, 'lorediaz', 1, '2020-05-19 22:21:26'),
(62, 'lorediaz', 1, '2020-05-19 22:23:10'),
(63, 'lorediaz', 1, '2020-05-19 22:23:18'),
(64, 'lorediaz', 1, '2020-05-19 22:25:00'),
(65, 'lorediaz', 1, '2020-05-19 22:25:29'),
(66, 'lorediaz', 1, '2020-05-19 22:29:13'),
(67, 'lorediaz', 1, '2020-05-19 22:29:23'),
(68, 'lorediaz', 1, '2020-05-19 22:30:22'),
(69, 'lorediaz', 1, '2020-05-19 22:31:43'),
(70, 'lorediaz', 1, '2020-05-19 22:34:23'),
(71, 'lorediaz', 1, '2020-05-19 22:35:15'),
(72, 'lorediaz', 1, '2020-05-19 22:36:11'),
(73, 'lorediaz', 1, '2020-05-19 22:36:41'),
(74, 'lorediaz', 1, '2020-05-19 22:37:31'),
(75, 'lorediaz', 1, '2020-05-19 22:37:55'),
(76, 'lorediaz', 1, '2020-05-19 22:38:16'),
(77, 'lorediaz', 1, '2020-05-19 22:39:09'),
(78, 'lorediaz', 1, '2020-05-19 22:39:28'),
(79, 'lorediaz', 1, '2020-05-19 22:40:08'),
(80, 'lorediaz', 1, '2020-05-19 22:41:36'),
(81, 'lorediaz', 1, '2020-05-19 22:43:24'),
(82, 'lorediaz', 1, '2020-05-19 22:45:09'),
(83, 'lorediaz', 1, '2020-05-19 23:15:27'),
(84, 'loreldr', 1, '2020-05-19 23:30:52');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `videoId` int(11) NOT NULL,
  `commentId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `username`, `videoId`, `commentId`) VALUES
(225, 'loreldr', 0, 1),
(228, 'laurita', 0, 2),
(232, 'laurita', 0, 3),
(235, 'laurita', 0, 1),
(237, 'laurita', 1, 0),
(238, 'loreldr', 2, 0),
(239, 'laurita', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `message` varchar(500) NOT NULL,
  `user_to` varchar(100) NOT NULL,
  `user_from` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `videoId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `message`, `user_to`, `user_from`, `status`, `videoId`) VALUES
(6, 'New video called prueba007 upload by laurita', 'loreldr', 'laurita', 1, 20),
(7, 'New video called notificale a Lore upload by laurita', 'loreldr', 'laurita', 1, 21),
(8, 'New video called tes001 uploaded by laurita', 'loreldr', 'laurita', 0, 22);

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL,
  `userTo` varchar(25) NOT NULL,
  `userFrom` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `userTo`, `userFrom`) VALUES
(1, 'loreldr', 'laurita'),
(2, 'laurita', 'loreldr');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstName` varchar(25) NOT NULL,
  `lastName` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profilePic` varchar(255) NOT NULL DEFAULT 'assets/images/maleuser.png',
  `signUpDate` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstName`, `lastName`, `username`, `email`, `password`, `profilePic`, `signUpDate`, `status`) VALUES
(1, 'Lorena', 'Diaz', 'loreldr', 'loli9024@hotmail.com', '49aa8e5d8bd5fe44c03da1de9f43affd95cc74d9c78ee8329d6fe4b22d4bb15cdff375804759e43441ed613a7fa48a4e2cf02c2de98a9cfc65db369f9006d98f', 'uploads/icons8-upload-24.png', '2020-04-30 20:14:05', 1),
(2, 'Laura', 'Carlton', 'laurita', 'laura@hotmail.com', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', 'assets/images/maleuser.png', '2020-05-12 19:09:02', 1),
(9, 'lore', 'diaz', 'lorediaz', 'lorenadiazrodriguez@hotmail.com', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', 'uploads/30879542580_5b4e553b94_o.jpg', '2020-05-19 21:22:36', 1);

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE `video` (
  `id` int(11) NOT NULL,
  `title` varchar(70) NOT NULL,
  `uploadedBy` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  `privacy` int(11) NOT NULL,
  `filePath` varchar(1000) NOT NULL,
  `category` int(11) DEFAULT NULL,
  `uploadDate` datetime NOT NULL DEFAULT current_timestamp(),
  `views` int(11) DEFAULT 0,
  `duration` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`id`, `title`, `uploadedBy`, `description`, `privacy`, `filePath`, `category`, `uploadDate`, `views`, `duration`) VALUES
(1, 'prueba', 'loreldr', 'prueba', 0, 'uploads/5eb544fd8f7f9.mp4', 2, '2020-05-08 21:39:41', 102, NULL),
(2, 'prueba001', 'loreldr', 'prueba', 0, 'uploads/5eba5f3a0c399.mp4', 2, '2020-05-12 18:32:58', 32, NULL),
(3, 'prueba002', 'loreldr', 'prueba', 0, 'uploads/5eba5f87418d9.mp4', 1, '2020-05-12 18:34:15', 18, NULL),
(4, 'prueba003', 'loreldr', 'prueba', 0, 'uploads/5eba5ff088be3.mp4', 1, '2020-05-12 18:36:00', 6, NULL),
(5, 'prueba004', 'loreldr', 'prueba', 0, 'uploads/5eba673ad8a70.mp4', 6, '2020-05-12 19:07:06', 5, NULL),
(6, 'laurita001', 'laurita', 'Laura', 0, 'uploads/5eba67c2b7fc5.mp4', 1, '2020-05-12 19:09:22', 9, NULL),
(7, 'prueba notificación', 'laurita', 'prueba', 0, 'uploads/5ec100fb41dd0.mp4', 2, '2020-05-17 19:16:43', 1, NULL),
(8, 'prueba notification 2', 'laurita', 'purueba', 0, 'uploads/5ec1026488664.mp4', 2, '2020-05-17 19:22:44', 1, NULL),
(9, 'test', 'laurita', 'test', 0, 'uploads/5ec107d4808ea.mp4', 2, '2020-05-17 19:45:56', 0, NULL),
(10, 'notification', 'laurita', 'test', 0, 'uploads/5ec1104c41c38.mp4', 2, '2020-05-17 20:22:04', 0, NULL),
(11, 'notification', 'laurita', 'test', 0, 'uploads/5ec110fe99101.mp4', 2, '2020-05-17 20:25:02', 0, NULL),
(12, 'notification', 'laurita', 'test', 0, 'uploads/5ec11189f1972.mp4', 2, '2020-05-17 20:27:22', 0, NULL),
(13, 'notification', 'laurita', 'test', 0, 'uploads/5ec124e58afe2.mp4', 2, '2020-05-17 21:49:57', 0, NULL),
(14, 'notification', 'laurita', 'test', 0, 'uploads/5ec12aae0dcad.mp4', 2, '2020-05-17 22:14:38', 0, NULL),
(15, 'prueba001', 'laurita', '123', 0, 'uploads/5ec12ac2eb127.mp4', 1, '2020-05-17 22:14:58', 0, NULL),
(16, 'prueba001', 'laurita', '123', 0, 'uploads/5ec12ce43a3a6.mp4', 1, '2020-05-17 22:24:04', 1, NULL),
(17, 'prueba001', 'laurita', '123', 0, 'uploads/5ec12cfa80c13.mp4', 1, '2020-05-17 22:24:26', 1, NULL),
(18, 'prueba001', 'laurita', '123', 0, 'uploads/5ec12d12441c0.mp4', 1, '2020-05-17 22:24:50', 1, NULL),
(19, 'test004', 'laurita', 'test', 0, 'uploads/5ec12d7f976cd.mp4', 2, '2020-05-17 22:26:39', 2, NULL),
(20, 'prueba007', 'laurita', 'prueba', 0, 'uploads/5ec13481edfb0.mp4', 2, '2020-05-17 22:56:34', 5, NULL),
(21, 'notificale a Lore', 'laurita', 'Loreldr', 0, 'uploads/5ec1eae69add7.mp4', 1, '2020-05-18 11:54:46', 3, NULL),
(22, 'tes001', 'laurita', 'test', 0, 'uploads/5ec27706b0313.mp4', 2, '2020-05-18 21:52:38', 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dislikes`
--
ALTER TABLE `dislikes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `dislikes`
--
ALTER TABLE `dislikes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

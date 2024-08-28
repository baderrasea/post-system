-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2024 at 01:29 PM
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
-- Database: `db_mosnad`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text DEFAULT NULL,
  `media_type` enum('image','video','audio','file') NOT NULL,
  `media_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `UserId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `media_type`, `media_path`, `created_at`, `UserId`) VALUES
(2, 'dd', 'fds', 'image', 'uploads/‏‏لقطة الشاشة (2).png', '2024-08-28 09:41:05', 2),
(4, 'first post', 'dddddddddddddddddddddddfsd\r\ndsddsfsdfsd\r\n', 'image', 'uploads/‏‏لقطة الشاشة (2).png', '2024-08-28 10:19:34', 11),
(5, 'badr 2', 'ddddddddddddddddddd\r\ndddddddddddddddddddddddddddddddddd', 'image', 'uploads/‏‏لقطة الشاشة (1).png', '2024-08-28 11:16:44', 11),
(6, 'hell yeah', 'what the hell', 'image', 'uploads/‏‏لقطة الشاشة (2).png', '2024-08-28 11:24:05', 6);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `Username` varchar(200) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Age` int(11) DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL,
  `verified` tinyint(1) DEFAULT 0,
  `Token` varchar(255) DEFAULT NULL,
  `roles` int(11) NOT NULL DEFAULT 2,
  `permissions` int(11) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `Username`, `Email`, `Age`, `Password`, `verified`, `Token`, `roles`, `permissions`) VALUES
(1, 'badr_admin', 'badr@gmail.com', 23, '$2y$10$IP07.Uaxeup4K7DCKfxqgOx6XyDnr.wpHvCUA.SfSKd6KoCxMO51e', 0, NULL, 1, 2),
(6, 'badr2', 'badr2@gmail.com', 23, '$2y$10$IP07.Uaxeup4K7DCKfxqgOx6XyDnr.wpHvCUA.SfSKd6KoCxMO51e', 0, NULL, 2, 2),
(11, 'badr', 'badr7@gmail.com', 22, '$2y$10$gQkDdkKf2jBLYvNfXBFnLukBSJpu0noG/ApFdkxCDucrDHd.j9rIi', 0, NULL, 2, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

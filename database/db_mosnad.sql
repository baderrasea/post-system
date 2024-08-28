-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2024 at 01:01 PM
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
(2, 'badr', 'badr2@gmail.com', 22, '$2y$10$0t43T8QWpFYkCgCBwaXvEeLg8giexKBD54AmJF62QI3kBHBUdbwgC', 0, 'd9cef16d0d65c0c1fe863824ba80114fa340e8cd58fecf6c7aafd88f78a448a3055d3a20977c2cbd726a0c3d940c269b1b2f', 2, 2),
(4, 'badr', 'baderrasaa8@gmail.com2', 2, '$2y$10$y5mpj1ZmDE69Ol9V78WIS.8gyme3G5oc3og2kkyUYW.dNY0sjCS0u', 0, '04d3632cb449d8ae0a79ebd1ab00a3f31d06db0b505a71ee3547b92f68f3bf37bb55e3b4fc6c1ddce2a11dd59c4cb00949cb', 2, 2),
(5, 'badr', 'badraldeenrasea@gmail.com', 22, '$2y$10$tWOSPJHa5cKemG9rOtCucOMZDKnEYBNKsDrXbAdwPb1Qu63pAPu6y', 0, '58730564d8c1a5f9cdf021d6e2b8a1fba9fde015892db54638491f557c8b9b0bbeff745aeaf48eebd5bed5ade6f4ffe5b112', 2, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

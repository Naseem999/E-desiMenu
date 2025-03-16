-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 12, 2021 at 08:44 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id16143662_edesimenu`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_tab`
--

CREATE TABLE `admin_tab` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('0','1') NOT NULL,
  `company` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_tab`
--

INSERT INTO `admin_tab` (`id`, `username`, `pass`, `email`, `role`, `company`) VALUES
(8, 'admin_main', 'admin', 'naseem98550@gmail.com', '1', 'edesimenu'),
(39, 'admin_naseem_test', 'naseem_test6026d37f24f3c', 'naseem98550@gmail.com', '0', 'naseem_test');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `c_name` varchar(255) NOT NULL,
  `num_tables` int(255) NOT NULL,
  `c_des` varchar(255) NOT NULL,
  `c_logo` varchar(255) NOT NULL,
  `timestamp_` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `username`, `pass`, `email`, `c_name`, `num_tables`, `c_des`, `c_logo`, `timestamp_`) VALUES
(19, 'naseem', '$2y$10$DN1xLI5IobohqpeZ88KBu.hBVM7VSc8ojl.4tZrlIz2fyVq7ILX.O', 'naseem98550@gmail.com', 'naseem_test', 10, 'hello world this is my co', 'checkout_sodexo.png', '2021-02-12');

-- --------------------------------------------------------

--
-- Table structure for table `notifications_edesimenu`
--

CREATE TABLE `notifications_edesimenu` (
  `id` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `n_for` varchar(255) NOT NULL,
  `timestamp_` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications_edesimenu`
--

INSERT INTO `notifications_edesimenu` (`id`, `title`, `n_for`, `timestamp_`) VALUES
(6, 'New User Registered: username:naseem', 'edesimenu', '2021-02-12 19:11:57');

-- --------------------------------------------------------

--
-- Table structure for table `offers_naseem_test`
--

CREATE TABLE `offers_naseem_test` (
  `id` int(255) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp_` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `offers_naseem_test`
--

INSERT INTO `offers_naseem_test` (`id`, `name`, `image`, `timestamp_`) VALUES
(1, '40% discount', 'banner_manu1.png', '2021-02-12 19:22:53');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(255) NOT NULL,
  `plan_id` varchar(255) NOT NULL,
  `c_name` varchar(255) NOT NULL,
  `c_email` varchar(255) NOT NULL,
  `menu_customization` enum('on','off') NOT NULL DEFAULT 'off',
  `task` enum('on','off') NOT NULL DEFAULT 'off',
  `employee_managment` enum('on','off') NOT NULL DEFAULT 'off',
  `e_kitchen` enum('on','off') NOT NULL DEFAULT 'off',
  `wallet` enum('on','off') NOT NULL DEFAULT 'off',
  `feedback` enum('on','off') NOT NULL DEFAULT 'off',
  `parsel` enum('on','off') NOT NULL DEFAULT 'off',
  `stock` enum('on','off') NOT NULL DEFAULT 'off',
  `qr_code` enum('on','off') NOT NULL DEFAULT 'off'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `plan_id`, `c_name`, `c_email`, `menu_customization`, `task`, `employee_managment`, `e_kitchen`, `wallet`, `feedback`, `parsel`, `stock`, `qr_code`) VALUES
(40, 'naseem_test_Premium_6026d37f24788', 'naseem_test', 'naseem98550@gmail.com', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` int(11) NOT NULL,
  `plan_id` varchar(255) NOT NULL,
  `c_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `plan` varchar(255) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'deactivated'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `plan_id`, `c_name`, `email`, `plan`, `start`, `end`, `status`) VALUES
(82, 'naseem_test_Premium_6026d37f24788', 'naseem_test', 'naseem98550@gmail.com', 'Premium', '2021-02-13', '2021-03-13', 'activated');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_tab`
--
ALTER TABLE `admin_tab`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications_edesimenu`
--
ALTER TABLE `notifications_edesimenu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offers_naseem_test`
--
ALTER TABLE `offers_naseem_test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `plan_id` (`plan_id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `plan_id` (`plan_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_tab`
--
ALTER TABLE `admin_tab`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `notifications_edesimenu`
--
ALTER TABLE `notifications_edesimenu`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `offers_naseem_test`
--
ALTER TABLE `offers_naseem_test`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

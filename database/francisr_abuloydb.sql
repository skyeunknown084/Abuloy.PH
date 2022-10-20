-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 17, 2022 at 12:23 AM
-- Server version: 5.6.41-84.1
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `francisr_abuloydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1 = admin, 2 = user',
  `d_firstname` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `d_middlename` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `d_lastname` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `d_birthdate` datetime NOT NULL,
  `d_date_of_death` datetime NOT NULL,
  `d_goal_amount` text CHARACTER SET utf8mb4 NOT NULL,
  `d_summary` longtext CHARACTER SET utf8mb4 NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 NOT NULL DEFAULT 'no-image-available.png',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `user_id`, `type`, `d_firstname`, `d_middlename`, `d_lastname`, `d_birthdate`, `d_date_of_death`, `d_goal_amount`, `d_summary`, `avatar`, `date_created`) VALUES
(1, 1, 2, 'Andres', 'De Castro', 'Bonifacio', '1863-11-30 00:00:00', '1897-05-10 00:00:00', '5000', 'Andrés Bonifacio y de Castro was a Filipino freemason and revolutionary leader. He is often called \"The Father of the Philippine Revolution\", and considered one of the national heroes of the Philippines. ', '1650706140_Andres-Bonifacio.jpg', '2022-04-23 04:29:44'),
(2, 1, 2, 'Jose', 'Protacio', 'Rizal', '1861-06-19 00:00:00', '1896-12-30 00:00:00', '1000', 'José Protasio Rizal Mercado y Alonso Realonda was a Filipino nationalist, writer and polymath active at the end of the Spanish colonial period of the Philippines. He is considered the national hero of the Philippines.', '1650706560_Jose-Rizal.jpg', '2022-04-23 04:36:24'),
(3, 2, 2, 'Emilio', 'Famy', 'Aguinaldo', '1899-01-23 00:00:00', '1901-03-23 00:00:00', '5000', '\"General Emilio Aguinaldo\" redirects here. For the municipality, see General Emilio Aguinaldo, Cavite.\r\nIn this Spanish name, the first or paternal surname is Aguinaldo and the second or maternal family name is Famy.', '1652335260_EmilioAguinaldo.jpg', '2022-05-12 01:01:45');

-- --------------------------------------------------------

--
-- Table structure for table `gcash_payments`
--

CREATE TABLE `gcash_payments` (
  `id` int(11) NOT NULL,
  `account_id` int(30) NOT NULL,
  `user_type` int(1) NOT NULL DEFAULT '2',
  `gcash_pay_reference` text,
  `account_name` text NOT NULL,
  `donator_name` varchar(255) DEFAULT NULL,
  `condolence_message` text,
  `gcash_amount` varchar(255) NOT NULL,
  `gcash_fee` int(30) NOT NULL,
  `gcash_abuloy_fee` int(30) NOT NULL,
  `gcash_abuloy_amount` varchar(255) DEFAULT NULL,
  `gcash_status` varchar(255) NOT NULL DEFAULT 'pending' COMMENT 'pending,paid,refunds,expired,cancelled'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gcash_payments`
--

INSERT INTO `gcash_payments` (`id`, `account_id`, `user_type`, `gcash_pay_reference`, `account_name`, `donator_name`, `condolence_message`, `gcash_amount`, `gcash_fee`, `gcash_abuloy_fee`, `gcash_abuloy_amount`, `gcash_status`) VALUES
(1, 2, 2, '', '', 'qwe', 'qwe', '123', 0, 0, NULL, 'pending'),
(2, 2, 2, '', '', '', 'asd', '1232', 0, 0, NULL, 'pending'),
(3, 2, 2, '', '', '', 'asd', '321', 0, 0, NULL, 'pending'),
(4, 2, 2, '', '', '', 'xzc', '21', 0, 0, NULL, 'pending'),
(5, 2, 2, '', '', '', 'dasd', '12312', 0, 0, NULL, 'pending'),
(6, 2, 2, '', '', '', 'thank you', '5', 0, 0, NULL, 'paid'),
(7, 3, 2, '', '', '', 'Thanks ', '1', 0, 0, NULL, 'pending'),
(8, 3, 2, '', 'Emilio Aguinaldo', 'Fdr', 'Ysgeg', '1', 0, 0, NULL, 'paid');

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `cover_img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `name`, `email`, `contact`, `address`, `cover_img`) VALUES
(1, 'Abuloy', 'citychapels@gmail.com', '+63 (977) 811 3377', 'City Chapels Inc., General Malvar Avenue,\nBarangay San Roque, Santo Tomas City, Batangas, Philippines, 4234', 'no-logo.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1 = admin, 2 = user',
  `phone_number` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `type`, `phone_number`, `date_created`) VALUES
(1, 'Francis', 'Reyes', 'abuloyph.citychapels@gmail.com', 'a486053a98eba1a49259f9a00e7bbafb', 2, '9268632944', '2022-04-23 04:28:12'),
(2, 'Jessele', 'Del Mundo', 'jesseledm@gmail.com', '200820e3227815ed1756a6b531e7e0d2', 1, '9771936413', '2022-05-12 00:56:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gcash_payments`
--
ALTER TABLE `gcash_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_id` (`account_id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
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
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gcash_payments`
--
ALTER TABLE `gcash_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

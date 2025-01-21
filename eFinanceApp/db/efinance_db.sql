-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2025 at 02:18 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `efinance_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `loan_type` varchar(100) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `interest_rate` decimal(5,2) NOT NULL,
  `term` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` enum('pending','approved','rejected','paid') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_logs`
--

CREATE TABLE `transaction_logs` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `transaction_type` enum('credit','debit') NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `previous_balance` decimal(15,2) NOT NULL,
  `current_balance` decimal(15,2) NOT NULL,
  `description` text,
  `sent_at` datetime NOT NULL,
  `received_at` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction_logs`
--

INSERT INTO `transaction_logs` (`id`, `user_id`, `to_user_id`, `transaction_type`, `amount`, `previous_balance`, `current_balance`, `description`, `sent_at`, `received_at`, `created_at`) VALUES
(1, 3, 1, 'credit', '10.00', '0.00', '0.00', 'Fund Transfer', '2024-12-11 02:25:01', '2025-01-21 02:25:01', '2025-01-20 20:25:01'),
(2, 1, 4, 'credit', '12.00', '0.00', '0.00', 'Fund Transfer', '2025-01-21 02:25:14', '2025-01-21 02:25:14', '2025-01-20 20:25:14'),
(3, 1, 6, 'credit', '15.00', '0.00', '0.00', 'Fund Transfer', '2025-01-21 02:26:24', '2025-01-21 02:26:24', '2025-01-20 20:26:24'),
(4, 1, 5, 'credit', '250.00', '0.00', '0.00', 'Fund Transfer', '2025-01-21 04:00:05', '2025-01-21 04:00:05', '2025-01-20 22:00:05'),
(5, 1, 3, 'credit', '123.00', '0.00', '0.00', 'Fund Transfer', '2025-01-21 15:44:52', '2025-01-21 15:44:52', '2025-01-21 09:44:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(70) NOT NULL,
  `gender` varchar(8) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `dob` datetime NOT NULL,
  `mobile_no` varchar(20) NOT NULL,
  `profile_img` varchar(255) NOT NULL,
  `balance` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `gender`, `address`, `created_at`, `is_active`, `dob`, `mobile_no`, `profile_img`, `balance`) VALUES
(1, 'shuvro.debnath', 'Shuvro@123', 'Shuvro Debnath', 'Male', 'KhilbarirTek, Shahjadpur, Dhaka', '2025-01-19 05:58:40', 1, '1997-07-11 05:57:09', '01759110968', 'shuvro_pic.jpg', 13580.8),
(2, 'akash.sarker', 'Akash@123', 'Akash Sarker', 'Male', 'Banani, Dhaka', '2025-01-20 09:15:30', 1, '1995-05-15 08:00:00', '01712345678', 'akash_pic.jpg', 20000.5),
(3, 'riya.kabir', 'Riya@123', 'Riya Kabir', 'Female', 'Dhanmondi, Dhaka', '2025-01-20 11:45:20', 1, '1998-09-22 07:30:00', '01798765432', 'riya_pic.jpg', 18153.8),
(4, 'farhan.islam', 'Farhan@123', 'Farhan Islam', 'Male', 'Gulshan, Dhaka', '2025-01-20 15:00:10', 1, '1992-03-10 06:45:00', '01755667788', 'farhan_pic.jpg', 25024),
(5, 'mita.chowdhury', 'Mita@123', 'Mita Chowdhury', 'Female', 'Uttara, Dhaka', '2025-01-20 18:25:45', 1, '2000-12-12 08:15:00', '01766778899', 'mita_pic.jpg', 15250.2),
(6, 'arif.hossain', 'Arif@123', 'Arif Hossain', 'Male', 'Mirpur, Dhaka', '2025-01-20 21:40:30', 1, '1990-01-05 05:30:00', '01799887766', 'arif_pic.jpg', 30030);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `transaction_logs`
--
ALTER TABLE `transaction_logs`
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
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transaction_logs`
--
ALTER TABLE `transaction_logs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `loans`
--
ALTER TABLE `loans`
  ADD CONSTRAINT `loans_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

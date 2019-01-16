-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 16, 2019 at 01:49 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `turboer1_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(50) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `date_created` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `lat` varchar(100) NOT NULL,
  `lng` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dispatch_log`
--

CREATE TABLE `dispatch_log` (
  `id` int(50) NOT NULL,
  `dispatch_id` varchar(100) NOT NULL,
  `dispatch_status` varchar(100) NOT NULL COMMENT 'applies only to (dropped,booked,pickedup,droppedoff)',
  `user_id` varchar(100) NOT NULL,
  `date_created` varchar(100) NOT NULL,
  `lat` varchar(100) NOT NULL,
  `lng` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'pending' COMMENT 'seen,pending',
  `seen_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dispatch_request`
--

CREATE TABLE `dispatch_request` (
  `id` int(50) NOT NULL,
  `transaction_id` varchar(100) NOT NULL,
  `requester_address` varchar(100) NOT NULL,
  `requester_lat` varchar(100) NOT NULL,
  `requester_lng` varchar(100) NOT NULL,
  `pickup_address` varchar(100) NOT NULL,
  `pickup_lat` varchar(100) NOT NULL,
  `pickup_lng` varchar(100) NOT NULL,
  `dropoff_address` varchar(100) NOT NULL,
  `dropoff_lat` varchar(100) NOT NULL,
  `dropoff_lng` varchar(100) NOT NULL,
  `dispatch_description` varchar(100) NOT NULL,
  `customer_id` varchar(100) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `user_parent_id` varchar(100) NOT NULL COMMENT 'dispatcher''s company',
  `dispatch_status` varchar(100) NOT NULL COMMENT 'pending,dropped,booked,pickedup,droppedoff',
  `payment_type` varchar(100) NOT NULL COMMENT 'card,cash',
  `payment_method` varchar(100) NOT NULL COMMENT 'payment_before_dispatch,payment_after_dispatch',
  `payment_status` varchar(100) NOT NULL COMMENT 'pending,success'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` int(50) NOT NULL,
  `charging_flat_rate` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `charging_flat_rate`) VALUES
(1, '500');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(50) NOT NULL,
  `parent_id` varchar(50) NOT NULL DEFAULT '0',
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `company_logo` varchar(100) NOT NULL,
  `passport` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `current_address` varchar(100) NOT NULL,
  `lat` varchar(100) NOT NULL,
  `lng` varchar(100) NOT NULL,
  `date_created` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL COMMENT 'admin,admin-staff,dispatcher,company,company-staff',
  `status` varchar(100) NOT NULL,
  `charging_pattern` varchar(100) NOT NULL COMMENT 'platform,rate-per-km,company-defined-rate',
  `rate_per_km` varchar(100) NOT NULL,
  `company_defined_rate` varchar(100) NOT NULL,
  `dispatch_availability` varchar(100) NOT NULL COMMENT 'free,booked'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dispatch_log`
--
ALTER TABLE `dispatch_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dispatch_request`
--
ALTER TABLE `dispatch_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dispatch_log`
--
ALTER TABLE `dispatch_log`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dispatch_request`
--
ALTER TABLE `dispatch_request`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

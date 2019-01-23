-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 23, 2019 at 05:54 AM
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
  `status` varchar(100) NOT NULL DEFAULT '1',
  `date_created` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `lat` varchar(100) NOT NULL,
  `lng` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `first_name`, `middle_name`, `surname`, `gender`, `email`, `phone`, `password`, `status`, `date_created`, `address`, `lat`, `lng`) VALUES
(1, 'nnamdi', 'alexander', 'akamukali', 'Male', 'easymagic1@gmail.com', '08175299162', 'september', '1', '', '10 Sodipo street Badore Ajah', '6.4957622', '3.5972481'),
(3, 'Nnamdi.', 'Alexander.', 'Akamukali', 'Male', 'nnamware@yahoo.com', '+2348175299162', 'admin6', '1', '', '10 Sodipo Street Badore Ajah.', '6.533119999999999', '3.3619968');

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

--
-- Dumping data for table `dispatch_log`
--

INSERT INTO `dispatch_log` (`id`, `dispatch_id`, `dispatch_status`, `user_id`, `date_created`, `lat`, `lng`, `address`, `status`, `seen_by`) VALUES
(1, '4', 'booked', '9', '2019-01-23 05:15:26', '6.4489788', '3.510453699999971', '', 'pending', '');

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
  `dispatch_distance` varchar(100) NOT NULL,
  `customer_id` varchar(100) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `user_parent_id` varchar(100) NOT NULL COMMENT 'dispatcher''s company',
  `dispatch_status` varchar(100) NOT NULL DEFAULT 'pending' COMMENT 'pending,cancelled,dropped,booked,pickedup,droppedoff',
  `payment_type` varchar(100) NOT NULL COMMENT 'card,cash',
  `payment_method` varchar(100) NOT NULL COMMENT 'payment_before_dispatch,payment_after_dispatch',
  `payment_status` varchar(100) NOT NULL DEFAULT 'pending' COMMENT 'pending,success',
  `date_created` varchar(100) NOT NULL,
  `dispatch_amount` varchar(100) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dispatch_request`
--

INSERT INTO `dispatch_request` (`id`, `transaction_id`, `requester_address`, `requester_lat`, `requester_lng`, `pickup_address`, `pickup_lat`, `pickup_lng`, `dropoff_address`, `dropoff_lat`, `dropoff_lng`, `dispatch_description`, `dispatch_distance`, `customer_id`, `user_id`, `user_parent_id`, `dispatch_status`, `payment_type`, `payment_method`, `payment_status`, `date_created`, `dispatch_amount`) VALUES
(2, 'c14862c', '10 Sodipo street Badore Ajah', '6.4957622', '3.5972481', 'Lekki Phase 1, Lekki, Nigeria', '6.4439009', '3.475083600000062', 'Ikoyi Road, Lagos, Nigeria', '6.4517646', '3.413556500000027', '', '', '1', '9', '6', 'pending', '', '', 'pending', '2019-01-23 04:38:50', '0'),
(3, '2a7baf3', '10 Sodipo street Badore Ajah', '6.4957622', '3.5972481', 'Ikoyi Club 1938 Road, Lagos, Nigeria', '6.452392499999999', '3.428398399999992', 'Surulere, Lagos, Nigeria', '6.4979884', '3.3439290999999685', '', '', '1', '9', '6', 'pending', '', '', 'pending', '2019-01-23 05:10:46', '0'),
(4, '542122c', '10 Sodipo street Badore Ajah', '6.4957622', '3.5972481', 'Ikoyi Club 1938 Road, Lagos, Nigeria', '6.452392499999999', '3.428398399999992', 'Badore Road, Lagos, Nigeria', '6.503638899999999', '3.601250299999947', '', '', '1', '9', '6', 'booked', '', '', 'pending', '2019-01-23 05:15:26', '0');

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` int(50) NOT NULL,
  `charging_flat_rate` varchar(100) NOT NULL,
  `service_charge` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `charging_flat_rate`, `service_charge`) VALUES
(1, '5100', '14.5');

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
  `role` varchar(100) NOT NULL COMMENT 'admin,staff,dispatcher,company,company-staff',
  `status` varchar(100) NOT NULL DEFAULT '1',
  `charging_pattern` varchar(100) NOT NULL COMMENT 'platform,rate-per-km,company-defined-rate',
  `charged_rate` varchar(100) NOT NULL,
  `company_defined_rate` varchar(100) NOT NULL,
  `dispatch_availability` varchar(100) NOT NULL DEFAULT 'free' COMMENT 'free,booked'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `parent_id`, `email`, `password`, `gender`, `company_name`, `company_logo`, `passport`, `username`, `current_address`, `lat`, `lng`, `date_created`, `role`, `status`, `charging_pattern`, `charged_rate`, `company_defined_rate`, `dispatch_availability`) VALUES
(1, '6', 'dummy-email', 'dummy', '', '', '', '', '', '', '6.4489788', '3.510453699999971', '', 'dispatcher', '0', '', '', '', 'free'),
(2, '0', 'admin', 'admin', '', '', '', '', '', '', '', '', '', 'admin', '1', '', '', '', 'free'),
(3, '2', 'admin-staff', 'admin', '', '', '', '', 'Staff11', '', '', '', '', 'staff', '0', '', '', '', 'free'),
(4, '2', 'admin-staff2', 'staff', '', '', '', '', 'Staff2', '', '', '', '', 'staff', '1', '', '', '', 'free'),
(5, '2', 'admin3', 'admin', '', '', '', '', 'admin3', '', '', '', '', 'staff', '1', '', '', '', 'free'),
(6, '2', 'r2@domain.com', 'admin1', '', 'R2-Soft', 'c6816b1_b-logo.jpg', '', 'R2..', '', '', '', '', 'company', '1', 'rate-per-km', '500', '', 'free'),
(7, '2', 'r3@domain.com', 'admin', '', '', 'fd0702a_large_JenniferLopezCA.jpg', '', 'r3', '', '', '', '', 'company', '1', 'rate-per-km', '100', '', 'free'),
(8, '6', 'r2staff@domain.com', 'admin', '', '', '', '', 'r2staff.', '', '', '', '', 'company-staff', '1', '', '', '', 'free'),
(9, '6', 'r2dispatcher@domain.com', 'admin', '', '', '', '', 'r2dispatcher', '', '6.4489788', '3.510453699999971', '', 'dispatcher', '1', '', '', '', 'booked'),
(10, '6', 'r2staff2@domain.com', 'admin', '', '', '', '', 'r2staff2', '', '', '', '', 'company-staff', '1', '', '', '', 'free'),
(11, '2', 'company@domain.com', 'company', '', '', '98ad6bb_id-card.jpg', '', 'company2', '', '', '', '', 'company', '1', 'company-defined-rate', '6500', '', 'free'),
(12, '2', 'newcompany@domain.com', 'admin', '', '', 'f7fb0eb_poster.PNG', '', 'newcompany', '', '', '', '', 'company', '1', 'rate-per-km', '500', '', 'free'),
(15, '11', 'company-staff@domain.com', 'staff1', '', '', '', '', 'company-staff.', '', '', '', '', 'company-staff', '1', '', '', '', 'free'),
(16, '11', 'company-dispatcher@domain.com', 'dispatcher', '', '', '', '', 'company-dispatcher..', '', '', '', '', 'dispatcher', '1', '', '', '', 'free'),
(17, '11', 'company-dispatcher2@domain.com', 'staff', '', '', '', '', 'company-staff2', '', '', '', '', 'dispatcher', '1', '', '', '', 'free');

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
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `dispatch_log`
--
ALTER TABLE `dispatch_log`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dispatch_request`
--
ALTER TABLE `dispatch_request`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

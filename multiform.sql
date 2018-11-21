-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2018 at 03:28 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `multiform`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_billing_detail`
--

CREATE TABLE IF NOT EXISTS `user_billing_detail` (
  `u_id` int(11) NOT NULL,
  `bill_first_name` varchar(255) NOT NULL,
  `bill_address` varchar(400) NOT NULL,
  `bill_city` varchar(255) NOT NULL,
  `bill_pincode` int(25) NOT NULL,
  `bill_country` varchar(255) NOT NULL,
  `card_number` int(50) NOT NULL,
  `card_holder` varchar(255) NOT NULL,
  `card_expiry` date NOT NULL,
  `card_cvv` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_family_detail`
--

CREATE TABLE IF NOT EXISTS `user_family_detail` (
  `u_id` int(11) NOT NULL,
`family_member_id` int(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `gender` varchar(255) NOT NULL,
  `resident_state` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_personal_detail`
--

CREATE TABLE IF NOT EXISTS `user_personal_detail` (
`u_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `resident_state` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `phone_no` int(25) NOT NULL,
  `email` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `password` varchar(400) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_plan_detail`
--

CREATE TABLE IF NOT EXISTS `user_plan_detail` (
  `u_id` int(11) NOT NULL,
  `enrollee_type` varchar(255) NOT NULL,
  `pricing_plan` varchar(255) NOT NULL,
  `plan_cost` double NOT NULL,
  `plan_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_family_detail`
--
ALTER TABLE `user_family_detail`
 ADD PRIMARY KEY (`family_member_id`);

--
-- Indexes for table `user_personal_detail`
--
ALTER TABLE `user_personal_detail`
 ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_family_detail`
--
ALTER TABLE `user_family_detail`
MODIFY `family_member_id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_personal_detail`
--
ALTER TABLE `user_personal_detail`
MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

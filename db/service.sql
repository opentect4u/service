-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 01, 2019 at 10:36 AM
-- Server version: 5.7.25-0ubuntu0.18.04.2
-- PHP Version: 7.2.15-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `service`
--

-- --------------------------------------------------------

--
-- Table structure for table `md_customers`
--

CREATE TABLE `md_customers` (
  `cust_cd` int(20) NOT NULL,
  `cust_name` varchar(100) NOT NULL,
  `cust_addr` text NOT NULL,
  `cust_ph_no` varchar(50) DEFAULT NULL,
  `cust_email` varchar(50) DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_dt` datetime DEFAULT NULL,
  `modified_by` varchar(50) DEFAULT NULL,
  `modified_dt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `md_mc_type`
--

CREATE TABLE `md_mc_type` (
  `mc_id` int(10) NOT NULL,
  `mc_type` varchar(100) NOT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_dt` datetime DEFAULT NULL,
  `modified_by` varchar(50) DEFAULT NULL,
  `modified_dt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `md_parts`
--

CREATE TABLE `md_parts` (
  `sl_no` int(10) NOT NULL,
  `parts_desc` varchar(100) NOT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_dt` datetime DEFAULT NULL,
  `modified_by` varchar(50) DEFAULT NULL,
  `modified_dt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `md_problem`
--

CREATE TABLE `md_problem` (
  `sl_no` int(10) NOT NULL,
  `problem_desc` varchar(100) NOT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_dt` datetime DEFAULT NULL,
  `modified_by` varchar(50) DEFAULT NULL,
  `modified_dt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `md_service_centre`
--

CREATE TABLE `md_service_centre` (
  `sl_no` int(10) NOT NULL,
  `center_name` varchar(100) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `cnct_no` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `in_charge` varchar(100) DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_dt` datetime DEFAULT NULL,
  `modified_by` varchar(50) DEFAULT NULL,
  `modified_dt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `md_tech`
--

CREATE TABLE `md_tech` (
  `emp_code` varchar(50) NOT NULL,
  `tech_name` varchar(100) NOT NULL,
  `tech_ph` varchar(50) NOT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_dt` date DEFAULT NULL,
  `modified_by` varchar(50) DEFAULT NULL,
  `modified_dt` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `md_users`
--

CREATE TABLE `md_users` (
  `user_id` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` char(1) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_status` char(1) NOT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_dt` datetime DEFAULT NULL,
  `modified_by` varchar(50) DEFAULT NULL,
  `modified_dt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `md_users`
--

INSERT INTO `md_users` (`user_id`, `password`, `user_type`, `user_name`, `user_status`, `created_by`, `created_dt`, `modified_by`, `modified_dt`) VALUES
('sss', '$2y$10$60KbbFvsMr8Z8gatA.oFqehmwVaa2g7GES0wkmZxRDc95hHaSqNy6', 'A', 'Synergic', 'A', 'Tan', '2018-11-19 00:00:00', 'sss', '2019-02-28 04:18:41');

-- --------------------------------------------------------

--
-- Table structure for table `td_audit_trail`
--

CREATE TABLE `td_audit_trail` (
  `sl_no` int(11) NOT NULL,
  `login_dt` datetime NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `terminal_name` varchar(50) DEFAULT NULL,
  `logout_dt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `td_mc_trans`
--

CREATE TABLE `td_mc_trans` (
  `trans_dt` date NOT NULL,
  `trans_cd` int(10) NOT NULL,
  `cust_cd` int(10) NOT NULL,
  `trans_type` char(1) NOT NULL,
  `mc_type_id` int(10) NOT NULL,
  `sl_no` varchar(50) NOT NULL,
  `mc_prob` int(10) NOT NULL,
  `warr_status` char(1) NOT NULL,
  `mc_qty` int(10) NOT NULL DEFAULT '0',
  `srv_ctr` int(5) NOT NULL,
  `cust_person` varchar(100) NOT NULL,
  `cust_per_ph` varchar(50) NOT NULL,
  `engg_invol` varchar(100) NOT NULL,
  `bill_no` varchar(50) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `remarks` varchar(100) NOT NULL,
  `approval_status` char(1) NOT NULL DEFAULT 'U',
  `created_by` varchar(50) DEFAULT NULL,
  `created_dt` datetime DEFAULT NULL,
  `approved_by` varchar(50) DEFAULT NULL,
  `approved_dt` datetime DEFAULT NULL,
  `modified_by` varchar(50) DEFAULT NULL,
  `modified_dt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `td_parts_trans`
--

CREATE TABLE `td_parts_trans` (
  `trans_dt` date NOT NULL,
  `trans_no` int(10) NOT NULL,
  `trans_type` char(1) NOT NULL,
  `bill_no` varchar(50) NOT NULL,
  `arrival_dt` date NOT NULL,
  `comp_sl_no` int(10) NOT NULL,
  `parts_desc` varchar(100) NOT NULL,
  `comp_qty` int(10) NOT NULL DEFAULT '0',
  `serv_ctr` int(10) NOT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `oder_by` varchar(100) DEFAULT NULL,
  `trf_mode` char(1) DEFAULT NULL,
  `srv_to` int(10) NOT NULL DEFAULT '0',
  `balance` int(10) NOT NULL DEFAULT '0',
  `sl_no` varchar(50) DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_dt` datetime DEFAULT NULL,
  `modified_by` varchar(50) DEFAULT NULL,
  `modified_dt` datetime DEFAULT NULL,
  `approval_status` char(1) NOT NULL DEFAULT 'U',
  `approved_by` varchar(50) DEFAULT NULL,
  `approved_dt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `md_customers`
--
ALTER TABLE `md_customers`
  ADD PRIMARY KEY (`cust_cd`);

--
-- Indexes for table `md_mc_type`
--
ALTER TABLE `md_mc_type`
  ADD PRIMARY KEY (`mc_id`);

--
-- Indexes for table `md_parts`
--
ALTER TABLE `md_parts`
  ADD PRIMARY KEY (`sl_no`);

--
-- Indexes for table `md_problem`
--
ALTER TABLE `md_problem`
  ADD PRIMARY KEY (`sl_no`);

--
-- Indexes for table `md_service_centre`
--
ALTER TABLE `md_service_centre`
  ADD PRIMARY KEY (`sl_no`);

--
-- Indexes for table `md_tech`
--
ALTER TABLE `md_tech`
  ADD PRIMARY KEY (`emp_code`);

--
-- Indexes for table `md_users`
--
ALTER TABLE `md_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `td_audit_trail`
--
ALTER TABLE `td_audit_trail`
  ADD PRIMARY KEY (`sl_no`);

--
-- Indexes for table `td_mc_trans`
--
ALTER TABLE `td_mc_trans`
  ADD PRIMARY KEY (`trans_dt`,`trans_cd`,`sl_no`,`trans_type`) USING BTREE;

--
-- Indexes for table `td_parts_trans`
--
ALTER TABLE `td_parts_trans`
  ADD PRIMARY KEY (`trans_dt`,`trans_no`,`comp_sl_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `md_customers`
--
ALTER TABLE `md_customers`
  MODIFY `cust_cd` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `md_mc_type`
--
ALTER TABLE `md_mc_type`
  MODIFY `mc_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `md_parts`
--
ALTER TABLE `md_parts`
  MODIFY `sl_no` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `md_problem`
--
ALTER TABLE `md_problem`
  MODIFY `sl_no` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `md_service_centre`
--
ALTER TABLE `md_service_centre`
  MODIFY `sl_no` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `td_audit_trail`
--
ALTER TABLE `td_audit_trail`
  MODIFY `sl_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

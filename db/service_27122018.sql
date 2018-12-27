-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 27, 2018 at 05:14 PM
-- Server version: 5.7.24-0ubuntu0.18.04.1
-- PHP Version: 7.2.10-0ubuntu0.18.04.1

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

--
-- Dumping data for table `md_customers`
--

INSERT INTO `md_customers` (`cust_cd`, `cust_name`, `cust_addr`, `cust_ph_no`, `cust_email`, `created_by`, `created_dt`, `modified_by`, `modified_dt`) VALUES
(1, 'Tanmoy Mondal', '82.L.N Road ,Po.Rabindra Nager,Kolkata-700065\r\n24 PGS(N)', '9831887194', 'meettan@gmail.com', 'sss', '2018-11-26 03:06:46', 'sss', '2018-11-26 05:05:20'),
(2, 'Bankra CCS Ltd.', 'Bankra,West Bengal,\r\nHowrah', '9433342456', 'bankraccs@rediff.com', 'sss', '2018-11-26 03:20:37', 'sss', '2018-11-26 05:07:54'),
(3, 'Kolkata Corporation', 'SN Banerjee Street(Corporation Street)\r\nKolkat', '(033)25664312/9831774582', 'kolkatacorp@ccd.com', 'sss', '2018-11-26 03:22:34', 'sss', '2018-11-26 05:03:22'),
(4, 'Asansol MiniBus Union', 'Asonsol,Burdwan(West) West Bengal', '(03228)24789564', 'asnmini@union.in', 'sss', '2018-11-26 05:07:07', NULL, NULL);

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

--
-- Dumping data for table `md_mc_type`
--

INSERT INTO `md_mc_type` (`mc_id`, `mc_type`, `created_by`, `created_dt`, `modified_by`, `modified_dt`) VALUES
(1, 'Billing Machine BBP2T', 'sss', '2018-11-26 05:52:34', NULL, NULL),
(2, 'Billing Machine BBP2T Juniour', 'sss', '2018-11-26 05:53:01', NULL, NULL),
(3, 'Billing Machine BBP3T', 'sss', '2018-11-26 05:53:32', NULL, NULL),
(4, 'BPOS Tharmal Printer 3TU', 'sss', '2018-11-26 05:53:44', NULL, NULL),
(5, 'ETIM Machine DDS', 'sss', '2018-11-26 05:53:58', NULL, NULL),
(6, 'ETIM Parking Petrol Pump &amp; Others', 'sss', '2018-11-26 05:54:26', NULL, NULL),
(7, 'Bluetooth Printer 3inch', 'sss', '2018-11-26 05:54:43', 'sss', '2018-11-26 06:06:25'),
(8, 'qwertyyuyuj', 'sss', '2018-11-29 12:58:59', 'sss', '2018-11-29 12:59:08');

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

--
-- Dumping data for table `md_parts`
--

INSERT INTO `md_parts` (`sl_no`, `parts_desc`, `created_by`, `created_dt`, `modified_by`, `modified_dt`) VALUES
(1, 'PRINTER-2 Inch', NULL, NULL, NULL, NULL),
(2, 'PRINTER-3 Inch', NULL, NULL, NULL, NULL),
(3, 'BATTERY-7.4V BHP', NULL, NULL, NULL, NULL),
(4, 'BATTERY-3.V', NULL, NULL, NULL, NULL),
(5, 'GAER SET', NULL, NULL, NULL, NULL),
(6, 'PAPER FLAP-2 Inch', NULL, NULL, NULL, NULL),
(7, 'PAPER FLAP-3 Inch', NULL, NULL, NULL, NULL),
(8, 'PAPER ROLLER-2 Inch', NULL, NULL, NULL, NULL),
(9, 'PAPER ROLLER-3 Inch', NULL, NULL, NULL, NULL),
(10, 'CHARGER-9.V BT', NULL, NULL, NULL, NULL),
(11, 'CHARGER-10.2V BHP', NULL, NULL, NULL, NULL),
(12, 'CHARGER-10.2V BBP', NULL, NULL, NULL, NULL),
(13, 'KEYPAD BUS TICKET', NULL, NULL, NULL, NULL),
(14, 'KEYPAD PARKING', NULL, NULL, NULL, NULL),
(15, 'KEYPAD BANKING', NULL, NULL, NULL, NULL),
(16, 'REXIN BAG', NULL, NULL, NULL, NULL),
(17, 'USB CABLE BT', NULL, NULL, NULL, NULL),
(18, 'PCB-BHP', NULL, NULL, NULL, NULL),
(19, 'PCB-BBP', NULL, NULL, NULL, NULL),
(20, 'PCB-BT', NULL, NULL, NULL, NULL),
(21, 'DISPLAY-BHP', NULL, NULL, NULL, NULL),
(22, 'DISPLAY-BBP', NULL, NULL, NULL, NULL),
(23, 'ABB BOX-BT', NULL, NULL, NULL, NULL),
(24, 'ABB BOX-BHP', NULL, NULL, NULL, NULL),
(25, 'METAL CUTTER', NULL, NULL, NULL, NULL),
(26, 'RESET SWITCH', NULL, NULL, NULL, NULL),
(27, 'ABB BOX-BBP', NULL, NULL, NULL, NULL),
(28, 'BATTERY 7.4v BT', NULL, NULL, NULL, NULL),
(29, 'USB CABLE BHP', NULL, NULL, NULL, NULL),
(30, 'BBP BATTERY', NULL, NULL, NULL, NULL),
(31, 'BBP KEYPAD', NULL, NULL, NULL, NULL),
(32, 'BBP FLIP COVER 2 Inch', NULL, NULL, NULL, NULL),
(33, 'BBP FLIP COVER 3 Inch', NULL, NULL, NULL, NULL),
(34, 'BBP GLASS', NULL, NULL, NULL, NULL),
(35, 'BBP CHARGER', NULL, NULL, NULL, NULL),
(36, 'ON/OFF IC', NULL, NULL, NULL, NULL),
(37, 'SERVICING', NULL, NULL, NULL, NULL),
(38, 'RETURN', NULL, NULL, NULL, NULL),
(39, 'GSM MODULE', NULL, NULL, NULL, NULL);

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

--
-- Dumping data for table `md_problem`
--

INSERT INTO `md_problem` (`sl_no`, `problem_desc`, `created_by`, `created_dt`, `modified_by`, `modified_dt`) VALUES
(1, 'abcdfgtyyuuuuu', 'sss', '2018-11-29 12:53:12', NULL, NULL),
(2, 'tyityieytiyitiowe4tyoi', 'sss', '2018-11-29 12:53:22', 'sss', '2018-11-29 12:53:30'),
(3, 'Swithed off automatic', 'sss', '2018-11-29 01:07:10', 'sss', '2018-11-29 01:07:24');

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

--
-- Dumping data for table `md_service_centre`
--

INSERT INTO `md_service_centre` (`sl_no`, `center_name`, `address`, `cnct_no`, `email`, `in_charge`, `created_by`, `created_dt`, `modified_by`, `modified_dt`) VALUES
(1, 'Kolkata', 'nnnnknk;', '9831887194', 'pin05@rediffmail.com', 'Amit Datta', 'sss', '2018-11-29 12:12:39', 'sss', '2018-11-29 01:06:48'),
(2, 'Siliguri', 'wohowhfhwfpiwf\r\nwfklwflll', '2589989', 'lclcl@jfijfp.com', 'Rakesh Singh', 'sss', '2018-11-29 01:01:27', NULL, NULL);

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

--
-- Dumping data for table `md_tech`
--

INSERT INTO `md_tech` (`emp_code`, `tech_name`, `tech_ph`, `created_by`, `created_dt`, `modified_by`, `modified_dt`) VALUES
('21', 'Amit Kumar Dutta', '9831887194', 'sss', '2018-12-21', 'sss', '2018-12-21'),
('58', 'Sanjay Prasad', '741589635', 'sss', '2018-12-21', NULL, NULL);

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
('sss', '$2y$10$I5RflPqwjOrxRneEL0V/ROxvDIgXy9eUkjSiTAnPbBj3LnFSRuwJy', 'A', 'Synergic', 'A', 'Tan', '2018-11-19 00:00:00', NULL, NULL);

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

--
-- Dumping data for table `td_audit_trail`
--

INSERT INTO `td_audit_trail` (`sl_no`, `login_dt`, `user_id`, `user_name`, `terminal_name`, `logout_dt`) VALUES
(1, '2018-11-19 04:16:43', 'sss', '', '::1', NULL),
(2, '2018-11-19 04:21:41', 'sss', '', '::1', NULL),
(3, '2018-11-19 04:29:26', 'sss', '', '::1', NULL),
(4, '2018-11-19 04:30:44', 'sss', '', '::1', NULL),
(5, '2018-11-19 05:07:51', 'sss', '', '::1', NULL),
(6, '2018-11-19 05:51:16', 'sss', '', '::1', NULL),
(7, '2018-11-19 06:31:20', 'sss', '', '::1', NULL),
(8, '2018-11-19 06:32:08', 'sss', '', '::1', NULL),
(9, '2018-11-19 06:33:21', 'sss', '', '::1', NULL),
(10, '2018-11-19 06:44:57', 'sss', '', '::1', NULL),
(11, '2018-11-21 04:39:07', 'sss', '', '::1', NULL),
(12, '2018-11-22 11:28:26', 'sss', '', '::1', NULL),
(13, '2018-11-22 11:38:46', 'sss', '', '::1', NULL),
(14, '2018-11-22 11:39:54', 'sss', '', '::1', NULL),
(15, '2018-11-22 12:23:17', 'sss', '', '::1', NULL),
(16, '2018-11-22 01:18:50', 'sss', '', '::1', NULL),
(17, '2018-11-22 01:19:27', 'sss', '', '::1', NULL),
(18, '2018-11-22 02:52:46', 'sss', '', '::1', NULL),
(19, '2018-11-22 06:16:44', 'sss', '', '::1', NULL),
(20, '2018-11-23 11:31:35', 'sss', '', '127.0.0.1', NULL),
(21, '2018-11-23 11:33:10', 'sss', '', '::1', NULL),
(22, '2018-11-23 11:51:04', 'sss', '', '::1', NULL),
(23, '2018-11-23 01:07:37', 'sss', '', '127.0.0.1', NULL),
(24, '2018-11-23 01:08:12', 'sss', '', '::1', NULL),
(25, '2018-11-23 04:17:38', 'sss', '', '::1', NULL),
(26, '2018-11-23 05:11:23', 'sss', '', '::1', NULL),
(27, '2018-11-23 06:12:27', 'sss', '', '::1', NULL),
(28, '2018-11-26 11:04:25', 'sss', '', '::1', NULL),
(29, '2018-11-26 02:39:24', 'sss', '', '::1', NULL),
(30, '2018-11-26 05:27:54', 'sss', '', '::1', NULL),
(31, '2018-11-26 05:31:04', 'sss', '', '::1', NULL),
(32, '2018-11-26 06:26:50', 'sss', '', '::1', NULL),
(33, '2018-11-26 06:32:33', 'sss', '', '::1', NULL),
(34, '2018-11-26 06:34:46', 'sss', '', '::1', NULL),
(35, '2018-11-26 06:36:06', 'sss', '', '::1', NULL),
(36, '2018-11-29 11:21:20', 'sss', '', '::1', NULL),
(37, '2018-11-29 03:25:05', 'sss', '', '::1', NULL),
(38, '2018-11-30 11:45:15', 'sss', '', '::1', NULL),
(39, '2018-11-30 04:14:03', 'sss', '', '::1', NULL),
(40, '2018-11-30 06:03:35', 'sss', '', '::1', NULL),
(41, '2018-12-03 11:27:57', 'sss', '', '::1', NULL),
(42, '2018-12-03 11:41:00', 'sss', '', '::1', NULL),
(43, '2018-12-03 02:10:30', 'sss', '', '::1', NULL),
(44, '2018-12-03 04:49:28', 'sss', '', '::1', NULL),
(45, '2018-12-03 06:14:33', 'sss', '', '::1', NULL),
(46, '2018-12-05 04:32:28', 'sss', '', '::1', NULL),
(47, '2018-12-07 11:07:55', 'sss', '', '::1', NULL),
(48, '2018-12-07 12:21:15', 'sss', '', '::1', NULL),
(49, '2018-12-07 12:48:16', 'sss', '', '::1', NULL),
(50, '2018-12-07 12:51:41', 'sss', '', '::1', NULL),
(51, '2018-12-07 05:02:22', 'sss', '', '::1', NULL),
(52, '2018-12-07 05:38:44', 'sss', '', '::1', NULL),
(53, '2018-12-10 11:25:29', 'sss', '', '::1', NULL),
(54, '2018-12-11 11:39:18', 'sss', '', '::1', NULL),
(55, '2018-12-11 01:31:09', 'sss', '', '::1', NULL),
(56, '2018-12-11 01:31:31', 'sss', '', '::1', NULL),
(57, '2018-12-11 03:44:18', 'sss', '', '::1', NULL),
(58, '2018-12-14 11:30:57', 'sss', '', '::1', NULL),
(59, '2018-12-14 05:43:49', 'sss', '', '::1', NULL),
(60, '2018-12-17 05:21:47', 'sss', '', '::1', NULL),
(61, '2018-12-18 11:40:30', 'sss', '', '::1', NULL),
(62, '2018-12-18 01:09:05', 'sss', '', '::1', NULL),
(63, '2018-12-18 03:02:06', 'sss', '', '::1', NULL),
(64, '2018-12-18 05:23:51', 'sss', '', '::1', NULL),
(65, '2018-12-18 05:40:39', 'sss', '', '::1', NULL),
(66, '2018-12-18 05:44:33', 'sss', '', '::1', NULL),
(67, '2018-12-18 05:55:45', 'sss', '', '::1', NULL),
(68, '2018-12-19 12:16:16', 'sss', '', '::1', NULL),
(69, '2018-12-19 04:18:33', 'sss', '', '::1', NULL),
(70, '2018-12-19 04:45:47', 'sss', '', '::1', NULL),
(71, '2018-12-19 05:54:18', 'sss', '', '::1', NULL),
(72, '2018-12-19 06:18:37', 'sss', '', '::1', NULL),
(73, '2018-12-20 01:01:30', 'sss', '', '::1', NULL),
(74, '2018-12-20 01:20:10', 'sss', '', '::1', NULL),
(75, '2018-12-20 01:27:00', 'sss', '', '::1', NULL),
(76, '2018-12-20 06:56:46', 'sss', '', '::1', NULL),
(77, '2018-12-21 11:39:25', 'sss', '', '::1', NULL),
(78, '2018-12-21 01:19:29', 'sss', '', '::1', NULL),
(79, '2018-12-24 01:07:51', 'sss', '', '::1', NULL),
(80, '2018-12-24 01:07:51', 'sss', '', '::1', NULL),
(81, '2018-12-24 01:38:58', 'sss', '', '::1', NULL),
(82, '2018-12-26 11:47:30', 'sss', '', '::1', NULL),
(83, '2018-12-26 01:16:25', 'sss', '', '::1', NULL),
(84, '2018-12-26 05:42:43', 'sss', '', '::1', NULL),
(85, '2018-12-27 11:09:47', 'sss', '', '::1', NULL),
(86, '2018-12-27 11:41:16', 'sss', '', '::1', NULL),
(87, '2018-12-27 11:45:25', 'sss', '', '::1', NULL),
(88, '2018-12-27 12:23:43', 'sss', '', '::1', NULL),
(89, '2018-12-27 12:51:25', 'sss', '', '::1', NULL),
(90, '2018-12-27 12:52:13', 'sss', '', '::1', NULL),
(91, '2018-12-27 03:11:20', 'sss', '', '::1', NULL),
(92, '2018-12-27 03:48:07', 'sss', '', '::1', NULL),
(93, '2018-12-27 04:46:55', 'sss', '', '::1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `td_mc_stock`
--

CREATE TABLE `td_mc_stock` (
  `trans_dt` date NOT NULL,
  `trans_cd` int(10) NOT NULL,
  `srv_ctr` int(5) NOT NULL,
  `qty` int(10) NOT NULL,
  `balance` int(10) NOT NULL
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
  `remarks` varchar(100) NOT NULL,
  `approval_status` char(1) NOT NULL DEFAULT 'U',
  `created_by` varchar(50) DEFAULT NULL,
  `created_dt` datetime DEFAULT NULL,
  `approved_by` varchar(50) DEFAULT NULL,
  `approved_dt` datetime DEFAULT NULL,
  `modified_by` varchar(50) DEFAULT NULL,
  `modified_dt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `td_mc_trans`
--

INSERT INTO `td_mc_trans` (`trans_dt`, `trans_cd`, `cust_cd`, `trans_type`, `mc_type_id`, `sl_no`, `mc_prob`, `warr_status`, `mc_qty`, `srv_ctr`, `cust_person`, `cust_per_ph`, `engg_invol`, `remarks`, `approval_status`, `created_by`, `created_dt`, `approved_by`, `approved_dt`, `modified_by`, `modified_dt`) VALUES
('2018-12-19', 1, 2, 'I', 5, '', 0, '', 3, 1, 'Baren', '9741759834', 'Bappa', 'For Servicing', 'U', 'sss', '2018-12-19 01:26:46', NULL, NULL, 'sss', '2018-12-19 04:51:30');

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
  `srv_to` int(10) DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_dt` datetime DEFAULT NULL,
  `modified_by` varchar(50) DEFAULT NULL,
  `modified_dt` datetime DEFAULT NULL,
  `approval_status` char(1) NOT NULL DEFAULT 'U',
  `approved_by` varchar(50) DEFAULT NULL,
  `approved_dt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `td_parts_trans`
--

INSERT INTO `td_parts_trans` (`trans_dt`, `trans_no`, `trans_type`, `bill_no`, `arrival_dt`, `comp_sl_no`, `parts_desc`, `comp_qty`, `serv_ctr`, `remarks`, `oder_by`, `trf_mode`, `srv_to`, `created_by`, `created_dt`, `modified_by`, `modified_dt`, `approval_status`, `approved_by`, `approved_dt`) VALUES
('2018-12-27', 1, 'I', 'Mum/Ho/18-19/001', '2018-12-20', 5, 'GAER SET', 200, 1, 'Stock in from Mumbai HO VIA AIR 5 items', NULL, NULL, NULL, 'sss', '2018-12-27 12:24:46', 'sss', '2018-12-27 12:52:49', 'U', NULL, NULL),
('2018-12-27', 1, 'I', 'Mum/Ho/18-19/001', '2018-12-20', 12, 'CHARGER-10.2V BBP', 48, 1, 'Stock in from Mumbai HO VIA AIR 5 items', NULL, NULL, NULL, 'sss', '2018-12-27 12:24:46', 'sss', '2018-12-27 12:52:49', 'U', NULL, NULL),
('2018-12-27', 1, 'I', 'Mum/Ho/18-19/001', '2018-12-20', 20, 'PCB-BT', 225, 1, 'Stock in from Mumbai HO VIA AIR 5 items', NULL, NULL, NULL, 'sss', '2018-12-27 12:24:46', 'sss', '2018-12-27 12:52:49', 'U', NULL, NULL),
('2018-12-27', 1, 'I', 'Mum/Ho/18-19/001', '2018-12-20', 21, 'DISPLAY-BHP', 103, 1, 'Stock in from Mumbai HO VIA AIR 5 items', NULL, NULL, NULL, 'sss', '2018-12-27 12:24:46', 'sss', '2018-12-27 12:52:49', 'U', NULL, NULL),
('2018-12-27', 1, 'I', 'Mum/Ho/18-19/001', '2018-12-20', 28, 'BATTERY 7.4v BT', 84, 1, 'Stock in from Mumbai HO VIA AIR 5 items', NULL, NULL, NULL, 'sss', '2018-12-27 12:24:46', 'sss', '2018-12-27 12:52:49', 'U', NULL, NULL),
('2018-12-27', 2, 'T', 'Trf/kol-sil/18-19/001', '2018-12-27', 5, 'GAER SET', -30, 1, 'Kolkata to Siliguri via bus service', NULL, 'T', 2, 'sss', '2018-12-27 01:07:31', 'sss', '2018-12-27 03:22:41', 'U', NULL, NULL),
('2018-12-27', 2, 'T', 'Trf/kol-sil/18-19/001', '2018-12-27', 20, 'PCB-BT', -80, 1, 'Kolkata to Siliguri via bus service', NULL, 'T', 2, 'sss', '2018-12-27 01:07:31', 'sss', '2018-12-27 03:22:41', 'U', NULL, NULL),
('2018-12-27', 3, 'D', 'DMG/kol/18-19/001', '2018-12-27', 3, 'BATTERY-7.4V BHP', -4, 1, 'cdewqkl;pp', 'Amit Singh', NULL, NULL, 'sss', '2018-12-27 05:00:27', 'sss', '2018-12-27 05:13:23', 'U', NULL, NULL),
('2018-12-27', 3, 'D', 'DMG/kol/18-19/001', '2018-12-27', 20, 'PCB-BT', -5, 1, 'cdewqkl;pp', 'Amit Singh', NULL, NULL, 'sss', '2018-12-27 05:00:27', 'sss', '2018-12-27 05:13:23', 'U', NULL, NULL);

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
-- Indexes for table `td_mc_stock`
--
ALTER TABLE `td_mc_stock`
  ADD PRIMARY KEY (`trans_dt`,`trans_cd`);

--
-- Indexes for table `td_mc_trans`
--
ALTER TABLE `td_mc_trans`
  ADD PRIMARY KEY (`trans_dt`,`trans_cd`);

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
  MODIFY `cust_cd` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `md_mc_type`
--
ALTER TABLE `md_mc_type`
  MODIFY `mc_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `md_parts`
--
ALTER TABLE `md_parts`
  MODIFY `sl_no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `md_problem`
--
ALTER TABLE `md_problem`
  MODIFY `sl_no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `md_service_centre`
--
ALTER TABLE `md_service_centre`
  MODIFY `sl_no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `td_audit_trail`
--
ALTER TABLE `td_audit_trail`
  MODIFY `sl_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

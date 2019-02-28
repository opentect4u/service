-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 28, 2019 at 04:52 PM
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

--
-- Dumping data for table `md_customers`
--

INSERT INTO `md_customers` (`cust_cd`, `cust_name`, `cust_addr`, `cust_ph_no`, `cust_email`, `created_by`, `created_dt`, `modified_by`, `modified_dt`) VALUES
(1, 'Tanmoy Mondal', '82.L.N Road ,Po.Rabindra Nager,Kolkata-700065\r\n24 PGS(N)', '9831887194', 'meettan@gmail.com', 'sss', '2018-11-26 03:06:46', 'sss', '2018-11-26 05:05:20'),
(2, 'Bankra CCS Ltd.', 'Bankra,West Bengal,\r\nHowrah', '9433342456', 'bankraccs@rediff.com', 'sss', '2018-11-26 03:20:37', 'sss', '2018-11-26 05:07:54'),
(3, 'Kolkata Corporation', 'SN Banerjee Street(Corporation Street)\r\nKolkat', '(033)25664312/9831774582', 'kolkatacorp@ccd.com', 'sss', '2018-11-26 03:22:34', 'sss', '2018-11-26 05:03:22'),
(4, 'Asansol MiniBus Union', 'Asonsol,Burdwan(West) West Bengal', '(03228)24789564', 'asnmini@union.in', 'sss', '2018-11-26 05:07:07', NULL, NULL),
(5, 'Raiganj Central Co-operative Bank', 'Raiganj,Uttar Dinajpur\r\nWest Bengal-733134', '03523244107', 'rccbltd@gmail.com', 'sss', '2019-01-31 12:37:33', 'sss', '2019-01-31 12:38:44'),
(6, 'JACKI', '85KLOO', '1238547458', 'rccbltd@gmail.com', 'sss', '2019-02-28 02:32:09', NULL, NULL);

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
(8, 'Paper Roll', 'sss', '2018-11-29 12:58:59', 'sss', '2019-01-31 12:39:45'),
(9, 'Computer H/W', 'sss', '2019-01-31 12:40:46', NULL, NULL),
(10, 'fefef', 'sss', '2019-02-28 02:32:32', NULL, NULL);

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
(36, 'ON/OFF Integrated Chip', NULL, NULL, 'sss', '2019-01-31 12:41:24'),
(37, 'SERVICING', NULL, NULL, NULL, NULL),
(38, 'RETURN', NULL, NULL, NULL, NULL),
(39, 'GSM MODULE', NULL, NULL, NULL, NULL),
(40, 'Test Parts', 'sss', '2019-01-31 12:42:00', NULL, NULL),
(41, 'Test Parts', 'sss', '2019-02-28 02:47:46', NULL, NULL),
(42, 'Test Parts', 'sss', '2019-02-28 02:47:52', NULL, NULL),
(43, '1qas', 'sss', '2019-02-28 02:52:27', NULL, NULL);

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
(1, 'Damaged Keyboard', 'sss', '2018-11-29 12:53:12', 'sss', '2019-01-31 12:42:52'),
(2, 'Printer Not Working', 'sss', '2018-11-29 12:53:22', 'sss', '2019-01-31 12:43:48'),
(3, 'Swithed off automatic', 'sss', '2018-11-29 01:07:10', 'sss', '2018-11-29 01:07:24'),
(4, 'LED Problem', 'sss', '2019-01-31 12:43:22', NULL, NULL),
(5, 'yyy', 'sss', '2019-02-28 02:37:11', NULL, NULL),
(6, 'yyy', 'sss', '2019-02-28 02:38:51', NULL, NULL);

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
(2, 'Siliguri', 'wohowhfhwfpiwf\r\nwfklwflll', '2589989', 'lclcl@jfijfp.com', 'Rakesh Singh', 'sss', '2018-11-29 01:01:27', NULL, NULL),
(3, 'Malda', 'Malda Town ,Beside Amit Gas\r\nWest Bengal', '9874118490', 'maldaservice@gmail.com', 'Arfi Billa Molla', 'sss', '2019-01-31 12:44:28', 'sss', '2019-01-31 12:45:42'),
(4, 'Mumbai', '', '01238547458', '', '', 'sss', '2019-02-26 01:13:58', 'sss', '2019-02-26 01:14:31');

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
('117', 'Biswajit Chakraborty', '9687449608', 'sss', '2019-01-31', NULL, NULL),
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
('amit', '$2y$10$UgF81Dq96oXY1NXYwOTdrO.3/AAbEfDyV8kW/0USWL9rh6VUu/N4O', 'G', 'Amit Kumar Singh', 'A', 'sss', '2019-02-28 03:00:56', 'amit', '2019-02-28 04:20:34'),
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
(93, '2018-12-27 04:46:55', 'sss', '', '::1', NULL),
(94, '2018-12-27 06:51:14', 'sss', '', '::1', NULL),
(95, '2018-12-28 03:11:09', 'sss', '', '::1', NULL),
(96, '2019-01-09 06:36:21', 'sss', '', '::1', NULL),
(97, '2019-01-15 03:56:48', 'sss', '', '::1', NULL),
(98, '2019-01-16 05:57:18', 'sss', '', '::1', NULL),
(99, '2019-01-31 12:25:07', 'sss', '', '::1', NULL),
(100, '2019-01-31 12:26:31', 'sss', '', '::1', NULL),
(101, '2019-01-31 12:29:00', 'sss', '', '::1', NULL),
(102, '2019-01-31 12:32:12', 'sss', '', '::1', NULL),
(103, '2019-01-31 03:43:10', 'sss', '', '::1', NULL),
(104, '2019-02-01 11:20:12', 'sss', '', '::1', NULL),
(105, '2019-02-01 11:35:05', 'sss', '', '::1', NULL),
(106, '2019-02-01 12:57:29', 'sss', '', '::1', NULL),
(107, '2019-02-01 02:29:34', 'sss', '', '::1', NULL),
(108, '2019-02-04 12:05:32', 'sss', '', '::1', NULL),
(109, '2019-02-04 12:55:26', 'sss', '', '::1', NULL),
(110, '2019-02-04 02:22:01', 'sss', '', '::1', NULL),
(111, '2019-02-04 04:26:56', 'sss', '', '::1', NULL),
(112, '2019-02-05 11:25:55', 'sss', '', '::1', NULL),
(113, '2019-02-05 11:49:28', 'sss', '', '::1', NULL),
(114, '2019-02-05 02:33:01', 'sss', '', '::1', NULL),
(115, '2019-02-05 03:10:47', 'sss', '', '::1', NULL),
(116, '2019-02-05 05:01:54', 'sss', '', '::1', NULL),
(117, '2019-02-26 12:39:42', 'sss', '', '::1', NULL),
(118, '2019-02-26 03:43:48', 'sss', '', '::1', NULL),
(119, '2019-02-26 03:43:49', 'sss', '', '::1', NULL),
(120, '2019-02-26 05:27:26', 'sss', '', '::1', NULL),
(121, '2019-02-27 12:42:12', 'sss', '', '::1', NULL),
(122, '2019-02-27 05:16:03', 'sss', '', '::1', NULL),
(123, '2019-02-28 11:13:09', 'sss', '', '::1', NULL),
(124, '2019-02-28 02:10:23', 'sss', '', '::1', NULL),
(125, '2019-02-28 02:15:49', 'sss', '', '::1', NULL),
(126, '2019-02-28 02:17:29', 'sss', '', '::1', NULL),
(127, '2019-02-28 02:31:37', 'sss', '', '::1', NULL),
(128, '2019-02-28 02:45:59', 'sss', '', '::1', NULL),
(129, '2019-02-28 03:00:08', 'sss', '', '::1', NULL),
(130, '2019-02-28 03:50:16', 'amit', '', '::1', NULL),
(131, '2019-02-28 03:50:41', 'sss', '', '::1', NULL),
(132, '2019-02-28 03:51:38', 'sss', '', '::1', NULL),
(133, '2019-02-28 04:19:31', 'sss', '', '::1', NULL),
(134, '2019-02-28 04:20:05', 'amit', '', '::1', NULL),
(135, '2019-02-28 04:20:24', 'amit', '', '::1', NULL),
(136, '2019-02-28 04:20:39', 'amit', '', '::1', NULL),
(137, '2019-02-28 04:49:28', 'sss', '', '::1', NULL),
(138, '2019-02-28 04:50:28', 'sss', '', '::1', NULL);

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

--
-- Dumping data for table `td_mc_trans`
--

INSERT INTO `td_mc_trans` (`trans_dt`, `trans_cd`, `cust_cd`, `trans_type`, `mc_type_id`, `sl_no`, `mc_prob`, `warr_status`, `mc_qty`, `srv_ctr`, `cust_person`, `cust_per_ph`, `engg_invol`, `bill_no`, `amount`, `remarks`, `approval_status`, `created_by`, `created_dt`, `approved_by`, `approved_dt`, `modified_by`, `modified_dt`) VALUES
('2019-02-26', 20191, 4, 'I', 3, '10002587', 2, 'I', 0, 1, 'Arun kr', '9841745208', 'Amit Datta', NULL, '0.00', '4 Nos mc received', 'A', 'sss', '2019-02-26 04:34:08', 'sss', '2019-02-26 05:58:42', NULL, NULL),
('2019-02-26', 20191, 4, 'S', 3, '10002587', 2, 'I', 0, 1, 'Arun kr', '9841745208', '21', NULL, '0.00', 'Service Done', 'A', 'sss', '2019-02-26 05:58:42', 'sss', '2019-02-27 03:23:27', NULL, NULL),
('2019-02-26', 20191, 4, 'I', 3, '10002588', 1, 'I', 0, 1, 'Arun kr', '9841745208', 'Amit Datta', NULL, '0.00', '4 Nos mc received', 'U', 'sss', '2019-02-26 04:34:08', NULL, NULL, NULL, NULL),
('2019-02-26', 20191, 4, 'I', 3, '10002590', 1, 'I', 0, 1, 'Arun kr', '9841745208', 'Amit Datta', NULL, '0.00', '4 Nos mc received', 'U', 'sss', '2019-02-26 04:34:08', NULL, NULL, NULL, NULL),
('2019-02-26', 20191, 4, 'I', 3, 'AS/1002587', 1, 'O', 0, 1, 'Arun kr', '9841745208', 'Amit Datta', NULL, '0.00', '4 Nos mc received', 'A', 'sss', '2019-02-26 04:34:08', 'sss', '2019-02-27 02:45:58', NULL, NULL),
('2019-02-26', 20192, 5, 'I', 5, 'DDS-874/85', 3, 'I', 0, 1, 'Raju', '9841002578', 'Sanjoy Prasad', NULL, '0.00', '2 nos received', 'A', '', '2019-02-26 05:26:55', 'sss', '2019-02-28 01:01:58', NULL, NULL),
('2019-02-26', 20192, 5, 'I', 5, 'DDS/128-0274', 4, 'O', 0, 1, 'Raju', '9841002578', 'Sanjoy Prasad', NULL, '0.00', '2 nos received', 'A', '', '2019-02-26 05:26:55', 'sss', '2019-02-28 02:34:29', NULL, NULL),
('2019-02-27', 20191, 4, 'O', 3, '10002587', 2, 'I', 0, 1, 'Gosai Maharaj', '8240378957', '21', NULL, '0.00', 'Service Done', 'A', 'sss', '2019-02-27 03:23:27', 'sss', '2019-02-27 03:23:27', NULL, NULL),
('2019-02-27', 20191, 4, 'O', 3, 'AS/1002587', 1, 'O', 0, 1, 'Pagla Dasu', '9831887194', '117', 'SSS/INV/001258', '250.00', 'lhdwoihdoihoi', 'A', 'sss', '2019-02-27 03:32:55', 'sss', '2019-02-27 03:32:55', NULL, NULL),
('2019-02-27', 20191, 4, 'S', 3, 'AS/1002587', 1, 'O', 0, 1, 'Arun kr', '9841745208', '117', NULL, '0.00', 'keypad changed', 'A', 'sss', '2019-02-27 02:45:58', 'sss', '2019-02-27 03:32:55', NULL, NULL),
('2019-02-28', 20192, 5, 'S', 5, 'DDS-874/85', 3, 'I', 0, 1, 'Raju', '9841002578', '117', NULL, '0.00', 'no parts changed', 'U', 'sss', '2019-02-28 01:01:58', NULL, NULL, NULL, NULL),
('2019-02-28', 20192, 5, 'S', 5, 'DDS/128-0274', 4, 'O', 0, 1, 'Raju', '9841002578', '58', NULL, '0.00', 'ok', 'U', 'sss', '2019-02-28 02:34:29', NULL, NULL, NULL, NULL),
('2019-02-28', 20193, 6, 'I', 7, 'SG001/100', 2, 'I', 0, 1, 'JACKI', '12345', 'QDQD', NULL, '0.00', 'rrqw3r', 'U', 'sss', '2019-02-28 02:33:19', NULL, NULL, NULL, NULL);

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
-- Dumping data for table `td_parts_trans`
--

INSERT INTO `td_parts_trans` (`trans_dt`, `trans_no`, `trans_type`, `bill_no`, `arrival_dt`, `comp_sl_no`, `parts_desc`, `comp_qty`, `serv_ctr`, `remarks`, `oder_by`, `trf_mode`, `srv_to`, `balance`, `sl_no`, `created_by`, `created_dt`, `modified_by`, `modified_dt`, `approval_status`, `approved_by`, `approved_dt`) VALUES
('2019-02-26', 1, 'I', 'Mum/In/0012', '2019-02-25', 1, 'PRINTER-2 Inch', 100, 1, 'Parts In', NULL, NULL, 0, 0, NULL, 'sss', '2019-02-26 01:17:38', NULL, NULL, 'U', NULL, NULL),
('2019-02-26', 1, 'I', 'Mum/In/0012', '2019-02-25', 3, 'BATTERY-7.4V BHP', 200, 1, 'Parts In', NULL, NULL, 0, 0, NULL, 'sss', '2019-02-26 01:17:38', NULL, NULL, 'U', NULL, NULL),
('2019-02-26', 1, 'I', 'Mum/In/0012', '2019-02-25', 10, 'CHARGER-9.V BT', 50, 1, 'Parts In', NULL, NULL, 0, 0, NULL, 'sss', '2019-02-26 01:17:38', NULL, NULL, 'U', NULL, NULL),
('2019-02-26', 1, 'I', 'Mum/In/0012', '2019-02-25', 15, 'KEYPAD BANKING', 250, 1, 'Parts In', NULL, NULL, 0, 0, NULL, 'sss', '2019-02-26 01:17:38', NULL, NULL, 'U', NULL, NULL),
('2019-02-26', 1, 'I', 'Mum/In/0012', '2019-02-25', 36, 'ON/OFF Integrated Chip', 300, 1, 'Parts In', NULL, NULL, 0, 0, NULL, 'sss', '2019-02-26 01:17:38', NULL, NULL, 'U', NULL, NULL),
('2019-02-26', 2, 'I', 'HO-KOL/00025', '2019-02-20', 7, 'PAPER FLAP-3 Inch', 15, 1, 'Parts in to Kolkata', NULL, NULL, 0, 0, NULL, 'sss', '2019-02-26 01:22:08', NULL, NULL, 'U', NULL, NULL),
('2019-02-26', 2, 'I', 'HO-KOL/00025', '2019-02-20', 18, 'PCB-BHP', 200, 1, 'Parts in to Kolkata', NULL, NULL, 0, 0, NULL, 'sss', '2019-02-26 01:22:08', NULL, NULL, 'U', NULL, NULL),
('2019-02-26', 2, 'I', 'HO-KOL/00025', '2019-02-20', 26, 'RESET SWITCH', 28, 1, 'Parts in to Kolkata', NULL, NULL, 0, 0, NULL, 'sss', '2019-02-26 01:22:08', NULL, NULL, 'U', NULL, NULL),
('2019-02-26', 2, 'I', 'HO-KOL/00025', '2019-02-20', 30, 'BBP BATTERY', 521, 1, 'Parts in to Kolkata', NULL, NULL, 0, 0, NULL, 'sss', '2019-02-26 01:22:08', NULL, NULL, 'U', NULL, NULL),
('2019-02-26', 3, 'T', 'TRF/KOL-SIL/2019-001', '2019-02-26', 10, 'CHARGER-9.V BT', -18, 1, 'Parts Transfer', NULL, 'C', 2, 0, NULL, 'sss', '2019-02-26 01:26:18', NULL, NULL, 'U', NULL, NULL),
('2019-02-26', 3, 'T', 'TRF/KOL-SIL/2019-001', '2019-02-26', 15, 'KEYPAD BANKING', -40, 1, 'Parts Transfer', NULL, 'C', 2, 0, NULL, 'sss', '2019-02-26 01:26:18', NULL, NULL, 'U', NULL, NULL),
('2019-02-26', 3, 'T', 'TRF/KOL-SIL/2019-001', '2019-02-26', 30, 'BBP BATTERY', -82, 1, 'Parts Transfer', NULL, 'C', 2, 0, NULL, 'sss', '2019-02-26 01:26:18', NULL, NULL, 'U', NULL, NULL),
('2019-02-26', 4, 'O', '20191', '2019-02-26', 1, 'PRINTER-2 Inch', -1, 1, 'Service Done', NULL, NULL, 0, 0, '10002587', 'sss', '2019-02-26 05:58:42', NULL, NULL, 'U', NULL, NULL),
('2019-02-26', 4, 'O', '20191', '2019-02-26', 10, 'CHARGER-9.V BT', -1, 1, 'Service Done', NULL, NULL, 0, 0, '10002587', 'sss', '2019-02-26 05:58:42', NULL, NULL, 'U', NULL, NULL),
('2019-02-26', 5, 'D', 'DMG/14/1001', '2019-02-26', 10, 'CHARGER-9.V BT', -2, 1, 'Damaged', 'Amit Singh', NULL, 0, 0, NULL, 'sss', '2019-02-26 06:16:50', NULL, NULL, 'U', NULL, NULL),
('2019-02-26', 5, 'D', 'DMG/14/1001', '2019-02-26', 26, 'RESET SWITCH', -1, 1, 'Damaged', 'Amit Singh', NULL, 0, 0, NULL, 'sss', '2019-02-26 06:16:50', NULL, NULL, 'U', NULL, NULL),
('2019-02-27', 1, 'O', '20191', '2019-02-27', 15, 'KEYPAD BANKING', -1, 1, 'keypad changed', NULL, NULL, 0, 0, 'AS/1002587', 'sss', '2019-02-27 02:45:58', NULL, NULL, 'U', NULL, NULL),
('2019-02-27', 1, 'O', '20191', '2019-02-27', 36, 'ON/OFF Integrated Chip', -1, 1, 'keypad changed', NULL, NULL, 0, 0, 'AS/1002587', 'sss', '2019-02-27 02:45:58', NULL, NULL, 'U', NULL, NULL);

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
  MODIFY `cust_cd` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `md_mc_type`
--
ALTER TABLE `md_mc_type`
  MODIFY `mc_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `md_parts`
--
ALTER TABLE `md_parts`
  MODIFY `sl_no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `md_problem`
--
ALTER TABLE `md_problem`
  MODIFY `sl_no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `md_service_centre`
--
ALTER TABLE `md_service_centre`
  MODIFY `sl_no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `td_audit_trail`
--
ALTER TABLE `td_audit_trail`
  MODIFY `sl_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

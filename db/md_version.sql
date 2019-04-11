-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 11, 2019 at 04:15 PM
-- Server version: 5.7.25-0ubuntu0.18.04.2
-- PHP Version: 7.2.15-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `service1`
--

-- --------------------------------------------------------

--
-- Table structure for table `md_version`
--

CREATE TABLE `md_version` (
  `sl_no` int(10) NOT NULL,
  `mc_type` char(1) NOT NULL,
  `version_name` varchar(100) NOT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_dt` date DEFAULT NULL,
  `modified_by` varchar(50) DEFAULT NULL,
  `modified_dt` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `md_version`
--

INSERT INTO `md_version` (`sl_no`, `mc_type`, `version_name`, `created_by`, `created_dt`, `modified_by`, `modified_dt`) VALUES
(1, 'B', 'BANK 101', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(2, 'B', 'BANK 102', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(3, 'B', 'BANK 101(GPRS)', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(4, 'B', 'BANK 801', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(5, 'B', 'BANK 901', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(6, 'B', 'BANK 902', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(7, 'B', 'COCHIN BANK 201 NORMAL', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(8, 'B', 'COCHINE BANKING GPRS BASIC', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(9, 'B', 'COCHIN BANK WITH DUE AMOUNT', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(10, 'B', 'COCHINE BANK WITH CSV FILE', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(11, 'B', 'SHRAM SARTHI BANK', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(12, 'B', 'SYNDICATE BANK', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(13, 'B', 'MANGLORE BANKING', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(14, 'B', 'MAHUAA BANKING', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(15, 'B', 'PROGRESSIVE BANKING', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(16, 'B', 'BANDHAN BANKING (GPRS)', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(17, 'B', 'ALLHABAD BANKING', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(18, 'B', 'VARDHMAN BANKING', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(19, 'B', 'COCHINE BANKING VERSION', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(20, 'B', 'NETWIN COCHINE BANKING', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(21, 'B', 'HASTI BANKING', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(22, 'B', 'MOHASSIL BANK', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(23, 'B', 'BARAMSAGAR VERSION', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(24, 'B', 'PAYNPARK NORMAL VERSION', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(25, 'B', 'PAYNPARK BARCODE', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(26, 'B', 'PAYNPARK RFID', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(27, 'B', 'PAYNPARK (GSM/GPRS)', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(28, 'B', 'PARKING SKYLABS', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(29, 'B', 'PAYNPARK RFID AVANI MALL', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(30, 'B', 'PAYNPARK ADVANCE AMOUNT', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(31, 'B', 'PAYNPARK RFID WITH GPRS', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(32, 'B', 'PAYNPARK GST', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(33, 'B', 'SHEGAON PARKING', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(34, 'B', 'TILLNAKA VERSION(BASIC/GPRS/12-99 KEYS/BARCODE)', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(35, 'B', 'ASHOKA TOLLNAKA BASIC VERSION', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(36, 'B', 'ASHOKA TOLLNAKA BARCODE VERSION', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(37, 'B', 'RELIANCE TOLLNAKA BARCODE', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(38, 'B', 'FIXED PAYNPARK', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(39, 'B', 'TOLLPLAZA SERVEY', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(40, 'B', 'FIXED PARKING THEUR', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(41, 'B', 'TLC TOLLNAKA', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(42, 'B', 'IBI TOLLNAKA', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(43, 'B', 'ILFS TOLLNAKA', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(44, 'B', 'PETROL PUMP VERSION', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(45, 'B', 'PETROL PUMP (GSM)', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(46, 'B', 'GAS METER BILLING', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(47, 'B', 'PETROL PUMP NPZZLE VERION', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(48, 'B', 'PATNA BUS TICKETING', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(49, 'B', 'PUNJA BUS TICKETING', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(50, 'B', 'COCHINE BUS TICKETING', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(51, 'B', 'NAGPUR BUS TICKETING', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(52, 'B', 'RAJKOT BUS TICKETING', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(53, 'B', 'VAN DISTRIBUTION VAT', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(54, 'B', 'VAN DISTRIBUTION GST WITH CESS', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(55, 'B', 'VAN DIST FREE PRODUCT', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(56, 'B', 'VAN DIST JAR ENTRY', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(57, 'B', 'VAN DIST BARCODE', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(58, 'B', 'MEAL DISTRIBUTION', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(59, 'B', 'SALES VERTION', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(60, 'B', 'CASH SALE WITH GST', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(61, 'B', 'GSB FOOD SELL', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(62, 'B', 'SALE WITH STOCK(GPRS)', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(63, 'B', 'WHOLESALE CLOTH MERCHANT', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(64, 'B', 'MINI SALES(GPRS)', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(65, 'B', 'VARSHA CABLE TV BASIC', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(66, 'B', 'CABLE TV VERTION (SMALL RECEIPT)', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(67, 'B', 'DHARWAD CABLE TV', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(68, 'B', 'CABLE TV BARCODE VERSION', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(69, 'B', 'CABLE TV RAJKOT VERSION', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(70, 'B', 'CABLE TV WITH GST', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(71, 'B', 'SHEGAON DENAGI VERSION', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(72, 'B', 'DENAGI UNICODE VERSION', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(73, 'B', 'WAKADI DENAGI', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(74, 'B', 'STUDENT ATTENDANCE', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(75, 'B', 'ATTENDANCE (GPRS)', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(76, 'B', 'TAX COLLECTION (GPRS)', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(77, 'B', 'BAZAR PAVTI VERSION', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(78, 'B', 'NAGAR PALIKA VERSION -LINUX', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(79, 'B', 'FOOTWEAR', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(80, 'B', 'FOODSELL', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(81, 'B', 'IRCTC FOOD CATERING (GPRS)', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(82, 'B', 'TERDAL (CHIT FUND)', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(83, 'B', 'BALAJI CINEMA (TWO RING TALKIES)', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(84, 'B', 'GO GAS (GPRS)', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(85, 'B', 'STOCK MAINTAINCE', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(86, 'B', 'MITRAA APPLICATION (FLOWER)', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(87, 'B', 'FISH APPLICATION', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(88, 'B', 'VAISHNODEVI APPLICATION (COUPON)', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(89, 'B', 'CADBURY VERSION (CANTEEN)', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(90, 'B', 'MOBILE RECHARGE', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(91, 'B', 'APMC', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(92, 'B', 'PATHALOGY VERSION', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(93, 'B', 'ELECTION VERSION', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(94, 'B', 'BLR TRANSPORT (FOR CAB)', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(95, 'B', 'E-WALLET', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(96, 'B', 'COLD STORAGE (FRUIT CRATES)', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(97, 'B', 'MILK VERSION', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(98, 'L', 'BASIC HSN VERSION', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(99, 'L', 'HSN VERSION WITH MOBILE NO.ENTRY', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(100, 'L', 'BASIC VOID VERSION', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(101, 'L', 'RESTAURANT VERSION', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(102, 'L', 'GARMENTS VERSION', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(103, 'L', 'JEWELLERY VERSION', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(104, 'L', 'FRUIT MARKET VERSION', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(105, 'L', 'MANUAL SELLING VERSION', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(106, 'L', 'SCHOOL VERSION', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(107, 'L', 'GAS CYLINDER', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(108, 'L', 'CESS VERSION', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(109, 'L', 'PETROL PUMP', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(110, 'L', 'SHEGAON PALKI VERSION', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(111, 'L', 'ELECTRICITY VERSION', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(112, 'L', 'MEDICAL VERSION', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(113, 'L', 'STUDENT FEES VERSION', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(114, 'L', 'OTHERS', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(115, 'P', 'BT 2INCH', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(116, 'P', 'BT 3INCH', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(117, 'P', 'THERMAL 3TU', 'sss', '2019-04-08', 'sss', '2019-04-08'),
(118, 'O', 'OTHERS', 'sss', '2019-04-08', 'sss', '2019-04-08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `md_version`
--
ALTER TABLE `md_version`
  ADD PRIMARY KEY (`sl_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `md_version`
--
ALTER TABLE `md_version`
  MODIFY `sl_no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

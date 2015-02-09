-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2015 at 04:36 PM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_mobile`
--

-- --------------------------------------------------------

--
-- Table structure for table `accessory`
--

CREATE TABLE IF NOT EXISTS `accessory` (
  `acc_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสอุปกรณ์เสริม',
  `acc_name` varchar(100) NOT NULL COMMENT 'ชื่ออุปกรณ์เสริม',
  `acc_desc` text NOT NULL COMMENT 'คำอธิบายอุปกรณ์เสริม',
  `acc_createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'วันที่สร้างอุปกรณ์เสริม',
  `acc_createby` int(11) NOT NULL COMMENT 'ผู้สร้างอุปกรณ์เสริม',
  `acc_updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'วันที่แก้ไขอุปกรณ์เสริม',
  `acc_updateby` int(11) NOT NULL COMMENT 'ผู้แก้ไขอุปกรณ์เสริม',
  PRIMARY KEY (`acc_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `accessory`
--

INSERT INTO `accessory` (`acc_id`, `acc_name`, `acc_desc`, `acc_createdate`, `acc_createby`, `acc_updatedate`, `acc_updateby`) VALUES
(1, 'แบตเตอรี่', 'แบตเตอรี่', '2015-01-08 15:46:50', 1, '2015-01-09 06:04:24', 1),
(2, 'ซิมการ์ด', 'ซิมการ์ด', '2015-01-08 15:46:54', 1, '2015-01-08 15:48:25', 1),
(3, 'สายชาร์จ', 'สายชาร์จ', '2015-01-08 15:47:11', 1, '2015-01-08 15:47:11', 1),
(4, 'ไม้เซลฟี่', 'ไม้เซลฟี่', '2015-01-09 06:04:16', 1, '2015-01-09 06:04:16', 1),
(5, 'หูฟัง', 'หูฟัง smalltalk', '2015-01-09 06:05:16', 1, '2015-01-21 14:39:53', 1),
(6, 'กรอบโทรศัพท์', 'กรอบโทรศัพท์', '2015-01-09 06:05:43', 1, '2015-01-09 06:05:43', 1);

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE IF NOT EXISTS `brand` (
  `bra_id` int(11) NOT NULL AUTO_INCREMENT,
  `bra_nameth` varchar(100) NOT NULL,
  `bra_nameeng` varchar(100) NOT NULL,
  `bra_createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `bra_createby` int(11) NOT NULL,
  `bra_updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `bra_updateby` int(11) NOT NULL,
  PRIMARY KEY (`bra_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`bra_id`, `bra_nameth`, `bra_nameeng`, `bra_createdate`, `bra_createby`, `bra_updatedate`, `bra_updateby`) VALUES
(1, 'โนเกียร์', 'Nokia', '2015-01-06 17:00:00', 1, '2015-01-08 08:40:09', 1),
(2, 'ซุมซุง', 'SumSung', '2015-01-06 17:00:00', 1, '2015-01-06 17:00:00', 1),
(3, 'ไอโฟน', 'Iphone', '2015-01-06 17:00:00', 1, '2015-01-06 17:00:00', 1),
(4, 'เอเซ่อ', 'acer', '2015-01-08 08:39:14', 1, '2015-01-08 08:39:14', 1),
(5, 'Asuz', 'Asuz', '2015-01-21 14:33:14', 1, '2015-01-21 14:33:14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `color`
--

CREATE TABLE IF NOT EXISTS `color` (
  `col_id` int(11) NOT NULL AUTO_INCREMENT,
  `col_nameth` varchar(100) NOT NULL,
  `col_nameeng` varchar(100) NOT NULL,
  `col_createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `col_createby` int(11) NOT NULL,
  `col_updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `col_updateby` int(11) NOT NULL,
  PRIMARY KEY (`col_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `color`
--

INSERT INTO `color` (`col_id`, `col_nameth`, `col_nameeng`, `col_createdate`, `col_createby`, `col_updatedate`, `col_updateby`) VALUES
(1, 'แดง', 'red', '2015-01-08 08:11:07', 1, '2015-01-08 08:26:13', 1),
(2, 'เขียว', 'green', '2015-01-08 08:13:20', 1, '2015-01-08 08:13:20', 1),
(4, 'น้ำเงิน', 'blue', '2015-01-08 08:25:51', 1, '2015-01-08 08:25:51', 1),
(5, 'ดำ', 'black', '2015-01-08 08:26:06', 1, '2015-01-08 08:26:06', 1),
(8, 'เหลือง', 'Yellow', '2015-01-08 08:35:30', 1, '2015-01-18 10:57:57', 1),
(9, 'ทอง', 'Gold', '2015-01-19 14:09:30', 1, '2015-01-19 14:09:30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `in_repair`
--

CREATE TABLE IF NOT EXISTS `in_repair` (
  `inrep_id` int(11) NOT NULL AUTO_INCREMENT,
  `inrep_code` varchar(20) NOT NULL,
  `per_idcard` varchar(15) NOT NULL,
  `inrep_createdate` date NOT NULL,
  `inrep_getdate` date NOT NULL,
  `bra_id` int(11) NOT NULL,
  `mod_id` int(11) NOT NULL,
  `inrep_emi` varchar(50) NOT NULL COMMENT 'เลขเครื่อง',
  `col_id` int(11) NOT NULL,
  `inrep_remark` text NOT NULL,
  `inrep_accessory_other` text NOT NULL COMMENT 'อุปกรณ์เสริมอื่นๆ',
  `inrep_problem_other` text NOT NULL COMMENT 'ปัญหาอื่นๆ',
  `inrep_createby` int(11) NOT NULL,
  `inrep_updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `inrep_updateby` int(11) NOT NULL,
  `inrep_status` int(2) NOT NULL COMMENT 'สถานะซ่อม ',
  PRIMARY KEY (`inrep_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `in_repair`
--

INSERT INTO `in_repair` (`inrep_id`, `inrep_code`, `per_idcard`, `inrep_createdate`, `inrep_getdate`, `bra_id`, `mod_id`, `inrep_emi`, `col_id`, `inrep_remark`, `inrep_accessory_other`, `inrep_problem_other`, `inrep_createby`, `inrep_updatedate`, `inrep_updateby`, `inrep_status`) VALUES
(6, 'RP00002', '1219800120650', '2015-01-20', '2015-01-20', 2, 5, '12sdsdsdsdsd', 9, '$repair_id', 'ระยอง', 'ระยอง', 1, '2015-01-23 15:12:02', 1, 1),
(7, 'RP00007', '1219800120650', '2015-01-22', '2015-01-22', 2, 4, '0878356866', 9, '0878356866', '', '0878356866', 1, '2015-01-23 15:12:35', 1, 1),
(8, 'RP00008', '1219800120650', '2015-01-23', '2015-01-23', 1, 1, '10000', 9, 'คุณ พูลสวัสดิ์', '', '', 1, '2015-01-23 15:41:06', 1, 1),
(9, 'RP00008', '1219800120650', '2015-01-23', '2015-01-23', 1, 1, '10000', 9, 'คุณ พูลสวัสดิ์', '', '', 1, '2015-01-23 15:41:16', 1, 1),
(10, 'RP00010', '1219800120633', '2015-01-23', '2015-01-23', 5, 6, '12sdsdsdsdsd', 8, 'ฐนัตตา', '', 'ฐนัตตา', 1, '2015-01-23 15:43:11', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `in_repair_accessory`
--

CREATE TABLE IF NOT EXISTS `in_repair_accessory` (
  `inrepacc_id` int(11) NOT NULL AUTO_INCREMENT,
  `acc_id` int(11) NOT NULL,
  `inrep_id` int(11) NOT NULL,
  PRIMARY KEY (`inrepacc_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=92 ;

--
-- Dumping data for table `in_repair_accessory`
--

INSERT INTO `in_repair_accessory` (`inrepacc_id`, `acc_id`, `inrep_id`) VALUES
(67, 1, 6),
(68, 2, 6),
(69, 3, 6),
(70, 4, 6),
(71, 5, 6),
(72, 6, 6),
(73, 0, 6),
(74, 1, 7),
(75, 2, 7),
(76, 3, 7),
(77, 4, 7),
(78, 5, 7),
(83, 1, 8),
(84, 2, 8),
(87, 1, 9),
(88, 2, 9),
(89, 1, 10),
(90, 2, 10),
(91, 3, 10);

-- --------------------------------------------------------

--
-- Table structure for table `in_repair_problem`
--

CREATE TABLE IF NOT EXISTS `in_repair_problem` (
  `inrepprob_id` int(11) NOT NULL AUTO_INCREMENT,
  `prob_id` int(11) NOT NULL,
  `inrep_id` int(11) NOT NULL,
  PRIMARY KEY (`inrepprob_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=69 ;

--
-- Dumping data for table `in_repair_problem`
--

INSERT INTO `in_repair_problem` (`inrepprob_id`, `prob_id`, `inrep_id`) VALUES
(53, 1, 6),
(54, 2, 6),
(55, 3, 6),
(56, 4, 6),
(57, 0, 6),
(58, 1, 7),
(62, 1, 8),
(65, 1, 9),
(66, 2, 9),
(67, 2, 10),
(68, 3, 10);

-- --------------------------------------------------------

--
-- Table structure for table `model`
--

CREATE TABLE IF NOT EXISTS `model` (
  `mod_id` int(11) NOT NULL AUTO_INCREMENT,
  `mod_nameth` varchar(100) NOT NULL,
  `mod_nameeng` varchar(100) NOT NULL,
  `bra_id` int(11) NOT NULL COMMENT 'รหัส ยี้ห้อ',
  `mod_createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `mod_createby` int(11) NOT NULL,
  `mod_updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `mod_updateby` int(11) NOT NULL,
  PRIMARY KEY (`mod_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `model`
--

INSERT INTO `model` (`mod_id`, `mod_nameth`, `mod_nameeng`, `bra_id`, `mod_createdate`, `mod_createby`, `mod_updatedate`, `mod_updateby`) VALUES
(1, 'เอ็น 95', 'N 95', 1, '2015-01-06 17:00:00', 1, '2015-01-08 15:56:18', 1),
(2, 'ไอโฟน 4', 'Iphone 4', 3, '2015-01-06 17:00:00', 1, '2015-01-06 17:00:00', 1),
(3, 'ไอโฟน', 'Iphone 5s', 3, '2015-01-08 09:06:27', 1, '2015-01-08 09:06:27', 1),
(4, 'Galaxy Note 8', 'Galaxy Note 8', 2, '2015-01-08 15:56:42', 1, '2015-01-08 15:56:42', 1),
(5, 'ซัมซุง 5s', 'Sumsung 5s', 2, '2015-01-08 15:57:09', 1, '2015-01-08 15:57:53', 1),
(6, 'Phone 1', 'Phone 1', 5, '2015-01-21 14:33:41', 1, '2015-01-21 14:33:41', 1);

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE IF NOT EXISTS `person` (
  `per_id` int(11) NOT NULL AUTO_INCREMENT,
  `per_status` int(2) NOT NULL COMMENT ' ''1'' => ''พนักงานร้าน'',         ''2'' => ''พนักงานซ่อม'',         ''3'' => ''เจ้าของร้าน'',         ''4'' => ''ลูกค้า'',',
  `per_fname` varchar(50) NOT NULL,
  `per_lname` varchar(50) NOT NULL,
  `per_username` varchar(50) NOT NULL,
  `per_password` varchar(50) NOT NULL,
  `per_idcard` varchar(15) NOT NULL,
  `per_address` text NOT NULL,
  `per_mobile` varchar(50) NOT NULL,
  `per_email` varchar(50) NOT NULL,
  `per_createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `per_createby` int(11) NOT NULL,
  `per_updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `per_updateby` int(11) NOT NULL,
  PRIMARY KEY (`per_id`),
  UNIQUE KEY `per_idcard` (`per_idcard`),
  KEY `per_idcard_2` (`per_idcard`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`per_id`, `per_status`, `per_fname`, `per_lname`, `per_username`, `per_password`, `per_idcard`, `per_address`, `per_mobile`, `per_email`, `per_createdate`, `per_createby`, `per_updatedate`, `per_updateby`) VALUES
(1, 3, 'admin', 'admin', 'admin', '1234', '1219800120650', 'ระยอง', '1234567890', '', '2015-01-21 13:44:36', 0, '2015-01-21 14:12:46', 1),
(2, 3, 'user', 'user', 'user', '1234', '1234567890123', 'ระยอง', '1234567890', 'user@gmail.com', '2015-01-21 13:44:36', 0, '2015-01-21 14:13:04', 1),
(4, 4, 'คุณ พูลสวัสดิ์ อิอิ', 'คุณ พูลสวัสดิ์', 'poolsawat', 'poolsawat', '1219800120653', 'กทม', '1234567890', '', '2015-01-21 13:44:36', 0, '2015-01-21 14:14:35', 1),
(5, 2, 'pool13433', 'pool13433', 'pool13433', '1234', '1234567891011', 'เชียงไหม่', '0878356866', 'rayong@gmail.com', '2015-01-21 14:01:32', 1, '2015-01-21 14:01:32', 1),
(6, 1, 'ลูกค้า VIP', 'ลูกค้า VIP', 'customer', 'customer', '1234567890124', 'ภูเก็ต', '1234567890', 'customer@gmail.ocm', '2015-01-21 14:16:02', 1, '2015-01-21 14:31:53', 1),
(7, 2, 'คุณ พูลสวัสดิ์ อิอิ', 'คุณ พูลสวัสดิ์', 'pool13433', '1234', '1219800120654', 'บุรีรัม', '1234567890', '', '2015-01-21 16:13:18', 1, '2015-01-21 16:13:18', 1),
(8, 2, 'ช่างพูล', 'ช่างพูล', 'pool1234', '1234', '1234567890120', 'ยะลา', '1234567890', 'pool1234@gmail.com', '2015-01-23 15:11:36', 1, '2015-01-23 15:11:36', 1),
(9, 0, 'ฐนัตตา', 'ฐนัตตา', '', '', '1219800120633', 'ฐนัตตา', '', '', '2015-01-23 15:43:11', 0, '2015-01-23 15:43:11', 0),
(10, 1, '1234', '1234', 'user', '1234', '1234123412341', '1234', '1234123411', '1234@gmail.com', '2015-01-29 06:08:39', 0, '2015-01-29 06:08:39', 0);

-- --------------------------------------------------------

--
-- Table structure for table `prefix`
--

CREATE TABLE IF NOT EXISTS `prefix` (
  `pre_id` int(11) NOT NULL AUTO_INCREMENT,
  `pre_name` varchar(100) NOT NULL,
  `pre_createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pre_createby` int(11) NOT NULL,
  `pre_updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pre_updateby` int(11) NOT NULL,
  PRIMARY KEY (`pre_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `problem`
--

CREATE TABLE IF NOT EXISTS `problem` (
  `prob_id` int(11) NOT NULL AUTO_INCREMENT,
  `prob_name` varchar(100) NOT NULL,
  `prob_desc` text NOT NULL,
  `prob_createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `prob_createby` int(11) NOT NULL,
  `prob_updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `prob_updateby` int(11) NOT NULL,
  PRIMARY KEY (`prob_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `problem`
--

INSERT INTO `problem` (`prob_id`, `prob_name`, `prob_desc`, `prob_createdate`, `prob_createby`, `prob_updatedate`, `prob_updateby`) VALUES
(1, 'สายชาร์จ หลุด', 'สายชาร์จ หลุด', '2015-01-08 10:25:37', 1, '2015-01-08 10:33:23', 1),
(2, 'เครื่องเปิดไม่ได้', 'เครื่องเปิดไม่ได้', '2015-01-08 10:33:39', 1, '2015-01-21 14:39:37', 1),
(3, 'แบตหมดเร็ว', 'แบตหมดเร็ว', '2015-01-08 10:38:49', 1, '2015-01-08 10:38:49', 1),
(4, 'เครื่องดับเอง', 'เครื่องดับเอง', '2015-01-09 06:06:00', 1, '2015-01-09 06:06:00', 1),
(5, 'จอแตก', 'จอแตก', '2015-01-09 06:06:09', 1, '2015-01-09 06:06:09', 1),
(6, 'ปุ่มหลุด', 'ปุ่มหลุด', '2015-01-09 06:06:20', 1, '2015-01-09 06:06:20', 1),
(7, 'แบตบวม', 'แบตบวม', '2015-01-09 06:06:33', 1, '2015-01-09 06:06:33', 1),
(8, 'จอฟ้า', 'จอฟ้า', '2015-01-09 06:06:41', 1, '2015-01-09 06:06:41', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `prod_id` int(11) NOT NULL AUTO_INCREMENT,
  `prod_name` varchar(100) NOT NULL,
  `prod_desc` text NOT NULL,
  `col_id` int(11) NOT NULL,
  `mod_id` int(11) NOT NULL,
  `prod_number` varchar(50) NOT NULL COMMENT 'เลขเครื่อง',
  `prod_createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `prod_createby` int(11) NOT NULL,
  `prod_updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `prod_updateby` int(11) NOT NULL,
  PRIMARY KEY (`prod_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`prod_id`, `prod_name`, `prod_desc`, `col_id`, `mod_id`, `prod_number`, `prod_createdate`, `prod_createby`, `prod_updatedate`, `prod_updateby`) VALUES
(1, 'iphone 6', 'iphone 6', 1, 3, '', '2015-01-08 16:09:07', 1, '2015-01-21 14:39:19', 1),
(2, 'iphone 6', 'iphone 6', 9, 2, '', '2015-01-21 14:34:53', 1, '2015-01-21 14:34:53', 1);

-- --------------------------------------------------------

--
-- Table structure for table `repair_assign`
--

CREATE TABLE IF NOT EXISTS `repair_assign` (
  `rep_id` int(11) NOT NULL COMMENT 'รหัสใบซ่อม',
  `rep_repairers` int(11) NOT NULL COMMENT 'รหัสผนักงาน',
  `rep_suppose_startdate` date NOT NULL COMMENT 'วันเริ่มซ่อมแบบประมาณการ',
  `rep_suppose_enddate` date NOT NULL COMMENT 'วันสิ้นสุดซ่อมแบบประมาณการ',
  `rep_estimate_date` date NOT NULL,
  `rep_estimate_status` int(2) NOT NULL DEFAULT '1' COMMENT 'สถานะประเมิน 1 = รอประเมิน,2 = ประเมินแล้ว',
  `rep_estimate_remark` text NOT NULL,
  `rep_estimate_price` int(11) NOT NULL DEFAULT '0',
  `rep_actual_startdate` date NOT NULL COMMENT 'เริ่มซ่อมจริง',
  `rep_actual_enddate` date NOT NULL COMMENT 'สิ้นสุดซ่อมจริง',
  `rep_status_remark` text COMMENT 'เหตุผลการส่งงาน',
  UNIQUE KEY `rep_id` (`rep_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `repair_assign`
--

INSERT INTO `repair_assign` (`rep_id`, `rep_repairers`, `rep_suppose_startdate`, `rep_suppose_enddate`, `rep_estimate_date`, `rep_estimate_status`, `rep_estimate_remark`, `rep_estimate_price`, `rep_actual_startdate`, `rep_actual_enddate`, `rep_status_remark`) VALUES
(6, 8, '2015-01-23', '2015-01-23', '2015-01-22', 0, '', 0, '2015-01-22', '2015-01-27', ''),
(7, 8, '2015-01-23', '2015-01-23', '2015-01-22', 1, '', 0, '2015-01-22', '2015-01-22', ''),
(8, 5, '2015-01-23', '2015-01-23', '2015-01-23', 1, '', 0, '2015-01-23', '2015-01-23', ''),
(9, 8, '2015-01-23', '2015-01-23', '2015-01-23', 1, '', 0, '2015-01-23', '2015-01-23', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2015 at 04:32 AM
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
  `inrep_status` int(2) NOT NULL COMMENT ' 1 => ''รอประเมิน'',   2 => ''ประเมินเสร็จสิ้น รอ อนุมัตจากเจ้าของเครื่อง'',         3 => ''อนุมัติการซ่อม จากลูกค้าเรียบร้อยแล้ว'',         4 => ''ยกเลิก/ไม่อนุมัติการซ่อม จากลูกค้า'',         5 => ''ซ่อม'',         6 => ''ซ่อมเสร็จแล้ว'',         7 => ''เกิดปัญหา'',         8 => '' รับของเสร็จสิ้น จบการซ่อม''',
  `inrep_code` varchar(20) NOT NULL,
  `per_id` int(11) NOT NULL,
  `inrep_createdate` date NOT NULL COMMENT 'วันมาซ่อม',
  `inrep_getdate` date NOT NULL COMMENT 'วันมารับของที่นัด',
  `inrep_realdate` date NOT NULL COMMENT 'วันมารับ จริง',
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
  PRIMARY KEY (`inrep_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `in_repair`
--

INSERT INTO `in_repair` (`inrep_id`, `inrep_status`, `inrep_code`, `per_id`, `inrep_createdate`, `inrep_getdate`, `inrep_realdate`, `bra_id`, `mod_id`, `inrep_emi`, `col_id`, `inrep_remark`, `inrep_accessory_other`, `inrep_problem_other`, `inrep_createby`, `inrep_updatedate`, `inrep_updateby`) VALUES
(6, 4, 'RP00002', 4, '2015-02-14', '2015-02-14', '0000-00-00', 2, 5, '12sdsdsdsdsd', 9, '$repair_id', 'ระยอง', 'ระยอง', 1, '2015-02-14 14:26:44', 1),
(7, 2, 'RP00007', 1, '2015-02-14', '2015-02-14', '0000-00-00', 2, 4, '0878356866', 9, '0878356866', '', '0878356866', 1, '2015-02-14 13:01:28', 1),
(8, 2, 'RP00008', 1, '2015-02-14', '2015-02-14', '0000-00-00', 1, 1, '10000', 9, 'คุณ พูลสวัสดิ์', '', '', 1, '2015-02-14 14:25:01', 1),
(9, 1, 'RP00008', 12, '2015-02-14', '2015-02-14', '0000-00-00', 1, 1, '10000', 9, 'คุณ พูลสวัสดิ์', '', '', 1, '2015-02-14 14:40:39', 1),
(10, 8, 'RP00010', 11, '2015-02-14', '2015-02-14', '2015-02-15', 5, 6, '12sdsdsdsdsd', 8, 'ฐนัตตา', '', 'ฐนัตตา', 1, '2015-02-14 14:40:48', 1),
(11, 0, 'RP00011', 15, '2015-02-21', '2015-02-21', '2015-02-21', 1, 1, '12sdsdsdsdsd', 1, 'เครื่องเปิดไม่ติด\r\nสายชาร์ด ขาด\r\nลำโพงไม่ทำงาน\r\nสัญญาณไม่ดี', '', '121212', 1, '2015-02-21 14:22:19', 1),
(12, 2, 'RP00012', 13, '2015-02-14', '2015-02-14', '0000-00-00', 1, 1, '111111', 4, '11111', '', '', 1, '2015-02-14 13:09:17', 1),
(13, 0, 'RP00012', 2, '2015-02-14', '2015-02-14', '0000-00-00', 1, 1, '111111', 4, '11111', '', '', 1, '2015-02-14 12:57:54', 1),
(14, 1, 'RP00014', 1, '2015-02-14', '2015-02-14', '0000-00-00', 3, 3, '111111', 9, 'ssdsdsd', '', '', 1, '2015-02-14 13:01:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `in_repair_accessory`
--

CREATE TABLE IF NOT EXISTS `in_repair_accessory` (
  `inrepacc_id` int(11) NOT NULL AUTO_INCREMENT,
  `inrepacc_check` int(1) NOT NULL DEFAULT '0' COMMENT '0 = ไม่ได้คืน ,1 = คืนครบ',
  `acc_id` int(11) NOT NULL,
  `inrep_id` int(11) NOT NULL,
  PRIMARY KEY (`inrepacc_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=140 ;

--
-- Dumping data for table `in_repair_accessory`
--

INSERT INTO `in_repair_accessory` (`inrepacc_id`, `inrepacc_check`, `acc_id`, `inrep_id`) VALUES
(99, 0, 1, 14),
(100, 0, 2, 14),
(101, 0, 3, 14),
(102, 0, 1, 13),
(103, 0, 3, 13),
(104, 0, 1, 6),
(105, 0, 2, 6),
(106, 0, 3, 6),
(107, 0, 4, 6),
(108, 0, 5, 6),
(109, 0, 6, 6),
(110, 0, 0, 6),
(111, 0, 1, 7),
(112, 0, 2, 7),
(113, 0, 3, 7),
(114, 0, 4, 7),
(115, 0, 5, 7),
(116, 0, 1, 8),
(117, 0, 2, 8),
(118, 1, 1, 10),
(119, 1, 2, 10),
(120, 0, 3, 10),
(121, 0, 1, 9),
(122, 0, 2, 9),
(123, 0, 1, 12),
(124, 0, 3, 12),
(137, 0, 1, 11),
(138, 0, 2, 11),
(139, 0, 3, 11);

-- --------------------------------------------------------

--
-- Table structure for table `in_repair_problem`
--

CREATE TABLE IF NOT EXISTS `in_repair_problem` (
  `inrepprob_id` int(11) NOT NULL AUTO_INCREMENT,
  `prob_id` int(11) NOT NULL,
  `inrep_id` int(11) NOT NULL,
  PRIMARY KEY (`inrepprob_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=95 ;

--
-- Dumping data for table `in_repair_problem`
--

INSERT INTO `in_repair_problem` (`inrepprob_id`, `prob_id`, `inrep_id`) VALUES
(74, 2, 14),
(75, 1, 13),
(76, 2, 13),
(77, 1, 6),
(78, 2, 6),
(79, 3, 6),
(80, 4, 6),
(81, 0, 6),
(82, 1, 7),
(83, 1, 8),
(84, 2, 10),
(85, 3, 10),
(86, 1, 9),
(87, 2, 9),
(88, 1, 12),
(89, 2, 12),
(94, 2, 11);

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
  `pre_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`per_id`),
  UNIQUE KEY `per_idcard` (`per_idcard`),
  KEY `per_idcard_2` (`per_idcard`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`per_id`, `per_status`, `per_fname`, `per_lname`, `per_username`, `per_password`, `per_idcard`, `per_address`, `per_mobile`, `per_email`, `per_createdate`, `per_createby`, `per_updatedate`, `per_updateby`, `pre_id`) VALUES
(1, 3, 'admin', 'admin', 'admin', '1234', '1219800120650', 'ระยอง', '1234567890', 'poon_mp@hotmail.com', '2015-01-21 13:44:36', 0, '2015-02-15 09:03:03', 1, NULL),
(2, 3, 'user', 'user', 'user', '1234', '1234567890123', 'ระยอง', '1234567890', '', '2015-01-21 13:44:36', 0, '2015-01-21 14:13:04', 1, NULL),
(4, 4, 'คุณ พูลสวัสดิ์', 'คุณ 11111111', 'customer', '1234', '1219800120653', 'ระยอง', '1234567890', 'poon@gmail.com', '2015-01-21 13:44:36', 0, '2015-02-14 17:16:45', 4, NULL),
(5, 2, 'pool13433', 'pool13433', 'pool13433', '1234', '1234567891011', 'เชียงไหม่', '0878356866', 'rayong@gmail.com', '2015-01-21 14:01:32', 1, '2015-01-21 14:01:32', 1, NULL),
(6, 4, 'ลูกค้า VIP', 'ลูกค้า VIP', 'customer', 'customer', '1234567890124', 'ภูเก็ต', '1234567890', 'customer@gmail.ocm', '2015-01-21 14:16:02', 1, '2015-02-16 16:05:50', 6, NULL),
(7, 2, 'คุณ พูลสวัสดิ์ อิอิ', 'คุณ พูลสวัสดิ์', 'employee', '1234', '1219800120654', 'บุรีรัม', '1234567890', 'poon@gmail.com', '2015-01-21 16:13:18', 1, '2015-01-21 16:13:18', 1, NULL),
(8, 2, 'ช่างพูล', 'ช่างพูล', 'pool1234', '1234', '1234567890120', 'ยะลา', '1234567890', 'pool1234@gmail.com', '2015-01-23 15:11:36', 1, '2015-01-23 15:11:36', 1, NULL),
(9, 4, 'ฐนัตตา', 'ฐนัตตา', 'thanatta', 'thanatta', '1219800120633', 'ฐนัตตา', '0801166617', 'thanatta@gmail.com', '2015-01-23 15:43:11', 0, '2015-02-16 12:09:02', 1, NULL),
(10, 1, '1234', '1234', 'user', '1234', '1234123412341', '1234', '1234123411', '1234@gmail.com', '2015-01-29 06:08:39', 0, '2015-01-29 06:08:39', 0, NULL),
(11, 4, 'คุณ facebook', 'คุณ facebook', '9999', '9999', '9999999999999', '9999999999999', '0878356866', '9999@gmail.com', '2015-02-14 12:59:05', 0, '2015-02-15 12:08:50', 1, NULL),
(12, 4, 'คุณลูกค้าชั้นดี', 'คุณลูกค้าชั้นดี', '8888', '8888', '8888888888888', '8888888888888', '1234567890', '8888@gmail.com', '2015-02-14 12:59:33', 0, '2015-02-15 12:07:47', 1, NULL),
(13, 4, '7777777777777', '7777777777777', '7777', '7777', '7777777777777', '7777777777777', '', '', '2015-02-14 12:59:50', 0, '2015-02-14 12:59:50', 0, NULL),
(14, 4, '5555555555555', '5555555555555', '5555', '5555', '5555555555555', '5555555555555', '5555555555555', '5555@gmail.com', '2015-02-14 13:00:13', 0, '2015-02-16 12:09:23', 1, NULL),
(15, 4, 'คุณ นิสัยดี', 'คุณ นิสัยดี', '4444', '4444', '4444444444444', '4444444444444', '1234567890', '', '2015-02-14 13:00:29', 0, '2015-02-15 12:06:08', 1, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `prefix`
--

INSERT INTO `prefix` (`pre_id`, `pre_name`, `pre_createdate`, `pre_createby`, `pre_updatedate`, `pre_updateby`) VALUES
(1, 'นาย', '2015-02-15 15:40:23', 1, '2015-02-15 15:40:23', 1),
(2, 'นาง', '2015-02-15 15:40:23', 1, '2015-02-15 15:40:34', 1),
(4, 'นางสาว', '2015-02-15 15:41:17', 1, '2015-02-15 15:41:17', 1),
(5, 'ดร.', '2015-02-15 15:41:25', 1, '2015-02-15 15:41:25', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

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
(8, 'จอฟ้า', 'จอฟ้า', '2015-01-09 06:06:41', 1, '2015-01-09 06:06:41', 1),
(9, 'ลำโพง เสียงไม่ดัง', 'ลำโพง เสียงไม่ดัง', '2015-02-18 06:02:33', 1, '2015-02-18 06:02:33', 1),
(10, 'ไมค์ พุดไม่ดัง', 'ไมค์ พุดไม่ดัง', '2015-02-18 06:02:53', 1, '2015-02-18 06:02:53', 1),
(11, 'เปิดใช้งาน app ในเครื่องไม่ได้', 'เปิดใช้งาน app ในเครื่องไม่ได้', '2015-02-18 06:03:30', 1, '2015-02-18 06:03:30', 1);

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
-- Table structure for table `repairers`
--

CREATE TABLE IF NOT EXISTS `repairers` (
  `rep_id` int(11) NOT NULL COMMENT 'รหัสใบซ่อม',
  `rep_repairers` int(11) NOT NULL COMMENT 'รหัสผนักงาน',
  `rep_suppose_startdate` date NOT NULL COMMENT 'วันเริ่มซ่อมแบบประมาณการ',
  `rep_suppose_enddate` date NOT NULL COMMENT 'วันสิ้นสุดซ่อมแบบประมาณการ',
  `rep_estimate_date` date NOT NULL,
  `rep_estimate_status` int(2) NOT NULL DEFAULT '0' COMMENT 'สถานะประเมิน 1 = รับซ่อม ,2 = ไม่รับซ่อม เพราะ ไม่สามารถซ่อมได้',
  `rep_estimate_remark` text NOT NULL,
  `rep_estimate_price` int(11) NOT NULL DEFAULT '0',
  `rep_actual_startdate` date NOT NULL COMMENT 'เริ่มซ่อมจริง',
  `rep_actual_enddate` date NOT NULL COMMENT 'สิ้นสุดซ่อมจริง',
  `rep_status_remark` text COMMENT 'เหตุผลการส่งงาน',
  UNIQUE KEY `rep_id` (`rep_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `repairers`
--

INSERT INTO `repairers` (`rep_id`, `rep_repairers`, `rep_suppose_startdate`, `rep_suppose_enddate`, `rep_estimate_date`, `rep_estimate_status`, `rep_estimate_remark`, `rep_estimate_price`, `rep_actual_startdate`, `rep_actual_enddate`, `rep_status_remark`) VALUES
(6, 8, '2015-02-15', '2015-02-14', '2015-02-14', 0, '1111111', 111, '2015-01-22', '2015-01-27', ''),
(7, 8, '2015-02-14', '2015-02-14', '2015-02-14', 0, '90000', 90000, '2015-01-22', '2015-01-22', ''),
(8, 5, '2015-02-14', '2015-02-14', '2015-02-15', 1, '19999', 19999, '2015-01-23', '2015-01-23', ''),
(9, 8, '2015-02-14', '2015-02-14', '2015-01-23', 0, '', 0, '2015-01-23', '2015-01-23', ''),
(10, 7, '2015-02-12', '2015-02-14', '2015-02-15', 1, '1111', 111111, '2015-02-15', '2015-02-15', 'เครื่องเก่าเกินซ่อม'),
(11, 8, '2015-02-28', '2015-02-28', '2015-02-14', 0, '', 0, '2015-02-14', '2015-02-14', ''),
(12, 5, '2015-02-14', '2015-02-14', '2015-02-15', 1, '111111', 1111111, '2015-02-14', '2015-02-14', ''),
(14, 5, '2015-02-14', '2015-02-14', '2015-02-14', 0, '', 0, '2015-02-14', '2015-02-14', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

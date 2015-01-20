-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2015 at 05:25 PM
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
  `acc_id` int(11) NOT NULL AUTO_INCREMENT,
  `acc_name` varchar(100) NOT NULL,
  `acc_desc` text NOT NULL,
  `acc_createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `acc_createby` int(11) NOT NULL,
  `acc_updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `acc_updateby` int(11) NOT NULL,
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
(5, 'หูฟัง', 'หูฟัง smalltalk', '2015-01-09 06:05:16', 1, '2015-01-09 06:05:16', 1),
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`bra_id`, `bra_nameth`, `bra_nameeng`, `bra_createdate`, `bra_createby`, `bra_updatedate`, `bra_updateby`) VALUES
(1, 'โนเกียร์', 'Nokia', '2015-01-06 17:00:00', 1, '2015-01-08 08:40:09', 1),
(2, 'ซุมซุง', 'SumSung', '2015-01-06 17:00:00', 1, '2015-01-06 17:00:00', 1),
(3, 'ไอโฟน', 'Iphone', '2015-01-06 17:00:00', 1, '2015-01-06 17:00:00', 1),
(4, 'เอเซ่อ', 'acer', '2015-01-08 08:39:14', 1, '2015-01-08 08:39:14', 1);

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
  `per_idcard` varchar(15) NOT NULL COMMENT 'เลขบัตรลูกค้า',
  `inrep_createdate` date NOT NULL,
  `inrep_getdate` date NOT NULL,
  `bra_id` int(11) NOT NULL COMMENT 'รหัสยี้ห้อ',
  `mod_id` int(11) NOT NULL COMMENT 'รหัสรุ่น',
  `inrep_emi` varchar(50) NOT NULL COMMENT 'เลขเครื่อง',
  `col_id` int(11) NOT NULL COMMENT 'รหัสสี',
  `inrep_remark` text NOT NULL COMMENT 'หมายเหตุ',
  `inrep_accessory_other` text NOT NULL,
  `inrep_problem_other` text NOT NULL,
  `inrep_createby` int(11) NOT NULL,
  `inrep_updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `inrep_updateby` int(11) NOT NULL,
  `inrep_status` int(2) NOT NULL COMMENT 'สถานะใบ [0=รอซ่อม,1=ซ่อม,2=ซ่อมเสร็จแล้ว,3=เกิดปัญหา]',
  PRIMARY KEY (`inrep_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `in_repair`
--

INSERT INTO `in_repair` (`inrep_id`, `inrep_code`, `per_idcard`, `inrep_createdate`, `inrep_getdate`, `bra_id`, `mod_id`, `inrep_emi`, `col_id`, `inrep_remark`, `inrep_accessory_other`, `inrep_problem_other`, `inrep_createby`, `inrep_updatedate`, `inrep_updateby`, `inrep_status`) VALUES
(6, 'RP00002', '1219800120650', '2015-01-20', '2015-01-20', 2, 5, '12sdsdsdsdsd', 9, '$repair_id', 'ระยอง', 'ระยอง', 1, '2015-01-20 16:23:13', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `in_repair_accessory`
--

CREATE TABLE IF NOT EXISTS `in_repair_accessory` (
  `inrepacc_id` int(11) NOT NULL AUTO_INCREMENT,
  `acc_id` int(11) NOT NULL,
  `inrep_id` int(11) NOT NULL,
  PRIMARY KEY (`inrepacc_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=74 ;

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
(73, 0, 6);

-- --------------------------------------------------------

--
-- Table structure for table `in_repair_problem`
--

CREATE TABLE IF NOT EXISTS `in_repair_problem` (
  `inrepprob_id` int(11) NOT NULL AUTO_INCREMENT,
  `prob_id` int(11) NOT NULL,
  `inrep_id` int(11) NOT NULL,
  PRIMARY KEY (`inrepprob_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=58 ;

--
-- Dumping data for table `in_repair_problem`
--

INSERT INTO `in_repair_problem` (`inrepprob_id`, `prob_id`, `inrep_id`) VALUES
(53, 1, 6),
(54, 2, 6),
(55, 3, 6),
(56, 4, 6),
(57, 0, 6);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `model`
--

INSERT INTO `model` (`mod_id`, `mod_nameth`, `mod_nameeng`, `bra_id`, `mod_createdate`, `mod_createby`, `mod_updatedate`, `mod_updateby`) VALUES
(1, 'เอ็น 95', 'N 95', 1, '2015-01-06 17:00:00', 1, '2015-01-08 15:56:18', 1),
(2, 'ไอโฟน 4', 'Iphone 4', 3, '2015-01-06 17:00:00', 1, '2015-01-06 17:00:00', 1),
(3, 'ไอโฟน', 'Iphone 5s', 3, '2015-01-08 09:06:27', 1, '2015-01-08 09:06:27', 1),
(4, 'Galaxy Note 8', 'Galaxy Note 8', 2, '2015-01-08 15:56:42', 1, '2015-01-08 15:56:42', 1),
(5, 'ซัมซุง 5s', 'Sumsung 5s', 2, '2015-01-08 15:57:09', 1, '2015-01-08 15:57:53', 1);

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE IF NOT EXISTS `person` (
  `per_id` int(11) NOT NULL AUTO_INCREMENT,
  `per_fname` varchar(50) NOT NULL,
  `per_lname` varchar(50) NOT NULL,
  `per_username` varchar(50) NOT NULL,
  `per_password` varchar(50) NOT NULL,
  `per_idcard` varchar(15) NOT NULL,
  `per_address` text NOT NULL,
  `per_mobile` varchar(50) NOT NULL,
  `per_email` varchar(50) NOT NULL,
  `per_status` int(2) NOT NULL COMMENT '0 = ทั่วไป,1=admin,2=member',
  PRIMARY KEY (`per_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`per_id`, `per_fname`, `per_lname`, `per_username`, `per_password`, `per_idcard`, `per_address`, `per_mobile`, `per_email`, `per_status`) VALUES
(1, 'admin', 'admin', 'admin', '1234', '', 'ระยอง', '', '', 1),
(2, 'user', 'user', 'user', '1234', '', '', '', '', 2),
(3, 'admin', 'admin', '', '', '1234567890123', 'ระยอง', '1234567890', '', 0),
(4, 'poolsawat', 'apin', '', '', '1219800120650', 'ระยอง', '0878356866', '', 0);

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
(2, 'เครื่องเปิดไม่ได้', 'เครื่องเปิดไม่ได้', '2015-01-08 10:33:39', 1, '2015-01-08 10:33:39', 1),
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`prod_id`, `prod_name`, `prod_desc`, `col_id`, `mod_id`, `prod_number`, `prod_createdate`, `prod_createby`, `prod_updatedate`, `prod_updateby`) VALUES
(1, 'iphone 6', 'iphone 6', 1, 3, '', '2015-01-08 16:09:07', 1, '2015-01-08 16:09:07', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

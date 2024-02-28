-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2024 at 02:45 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ops`
--

-- --------------------------------------------------------

--
-- Table structure for table `card`
--

CREATE TABLE IF NOT EXISTS `card` (
`card_id` int(11) NOT NULL,
  `card_serialnum` varchar(50) NOT NULL,
  `card_dateregister` varchar(50) NOT NULL,
  `card_isactive` varchar(50) NOT NULL,
  `card_isuse` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `card`
--

INSERT INTO `card` (`card_id`, `card_serialnum`, `card_dateregister`, `card_isactive`, `card_isuse`) VALUES
(2, 'A543847465', '2024-02-22', 'no', 'no'),
(4, 'A543847463', '2024-02-17', 'no', 'no'),
(5, 'A543847469', '2024-02-16', 'yes', 'no'),
(6, 'A27383A36', '2024-12-31', 'yes', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `car_record`
--

CREATE TABLE IF NOT EXISTS `car_record` (
`car_id` int(11) NOT NULL,
  `car_platenum` varchar(50) NOT NULL,
  `car_model` varchar(50) NOT NULL,
  `car_brand` varchar(50) NOT NULL,
  `car_color` varchar(50) NOT NULL,
  `fk_staff_id` int(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `car_record`
--

INSERT INTO `car_record` (`car_id`, `car_platenum`, `car_model`, `car_brand`, `car_color`, `fk_staff_id`) VALUES
(20, 'VJJ1234', 'saga', 'honda', 'BLUE', 27),
(21, 'BKF1234', 'Myvi', 'Perodua', 'Pink', 27),
(22, 'vad12351', 'city', 'honda', 'red', 28),
(23, 'vap1241', 'Myvi', 'honda', 'red', 29),
(24, 'kip1324', 'benz', 'mercedes', 'red', 30),
(26, '2015213', 'AXIA', 'PERODUA ', 'RED', 32),
(27, 'kkk1234', 'AXIA', 'PERODUA ', 'black', 33),
(28, 'VAP 295', 'AXIA', 'PERODUA ', 'SILVER', 34);

-- --------------------------------------------------------

--
-- Table structure for table `employee_type`
--

CREATE TABLE IF NOT EXISTS `employee_type` (
`emptype_id` int(11) NOT NULL,
  `emptype_name` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `employee_type`
--

INSERT INTO `employee_type` (`emptype_id`, `emptype_name`) VALUES
(2, 'staff'),
(3, 'consultant'),
(4, 'management'),
(5, 'visiting'),
(6, 'outsource');

-- --------------------------------------------------------

--
-- Table structure for table `health_record`
--

CREATE TABLE IF NOT EXISTS `health_record` (
`health_id` int(11) NOT NULL,
  `health_type` varchar(100) NOT NULL,
  `health_startdate` varchar(100) NOT NULL,
  `health_remark` varchar(100) NOT NULL,
  `health_recorddate` varchar(100) NOT NULL,
  `health_iscomplete` varchar(50) NOT NULL,
  `fk_staff_id` int(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `health_record`
--

INSERT INTO `health_record` (`health_id`, `health_type`, `health_startdate`, `health_remark`, `health_recorddate`, `health_iscomplete`, `fk_staff_id`) VALUES
(17, 'other', '27/02/2024 - 10/03/2024', 'FEVER HIGH', '27/02/2024', 'no', 32),
(18, 'pregnant', '27/02/2024 - 07/03/2024', 'pregnant', '27/02/2024', 'no', 33),
(19, 'other', '27/02/2024 - 24/03/2024', 'FEVER HIGH', '28/02/2024', 'yes', 34),
(20, 'pregnant', '27/02/2024 - 07/03/2024', 'LALALA', '28/02/2024', 'yes', 34);

-- --------------------------------------------------------

--
-- Table structure for table `info`
--

CREATE TABLE IF NOT EXISTS `info` (
`info_id` int(11) NOT NULL,
  `info_motorb1` varchar(50) NOT NULL,
  `info_motorb2` varchar(50) NOT NULL,
  `info_bayb2` varchar(50) NOT NULL,
  `info_reserved` varchar(50) NOT NULL,
  `info_pregnantpt` varchar(50) NOT NULL,
  `info_mded` varchar(50) NOT NULL,
  `info_oku` varchar(50) NOT NULL,
  `info_valet` varchar(50) NOT NULL,
  `info_dialysis` varchar(50) NOT NULL,
  `info_pregnantstaff` varchar(50) NOT NULL,
  `info_ae` varchar(50) NOT NULL,
  `info_er` varchar(50) NOT NULL,
  `info_ambulance` varchar(50) NOT NULL,
  `info_oncall` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `info`
--

INSERT INTO `info` (`info_id`, `info_motorb1`, `info_motorb2`, `info_bayb2`, `info_reserved`, `info_pregnantpt`, `info_mded`, `info_oku`, `info_valet`, `info_dialysis`, `info_pregnantstaff`, `info_ae`, `info_er`, `info_ambulance`, `info_oncall`) VALUES
(1, '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23'),
(2, '15', '12', '13', '14', '2', '1', '3', '4', '18', '20', '21', '1', '1', '5'),
(3, '0', '0', '0', '0', '3', '3', '0', '6', '0', '4', '0', '3', '2', '6');

-- --------------------------------------------------------

--
-- Table structure for table `parking`
--

CREATE TABLE IF NOT EXISTS `parking` (
`parking_id` int(11) NOT NULL,
  `fk_user_id` int(50) NOT NULL,
  `fk_card_id` int(11) NOT NULL,
  `fk_lot_id` int(11) NOT NULL,
  `parking_iscardreturn` varchar(50) NOT NULL,
  `parking_datecardborrow` varchar(50) NOT NULL,
  `parking_datecardreturn` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `parking`
--

INSERT INTO `parking` (`parking_id`, `fk_user_id`, `fk_card_id`, `fk_lot_id`, `parking_iscardreturn`, `parking_datecardborrow`, `parking_datecardreturn`) VALUES
(3, 27, 5, 10, 'yes', '26/02/2024', '28/02/2024 09:06:13 am'),
(4, 32, 5, 11, 'no', '27/02/2024', ''),
(5, 33, 6, 11, 'yes', '27/02/2024', '27/02/2024 02:12:33 pm'),
(6, 34, 5, 12, 'yes', '28/02/2024', '28/02/2024 06:30:09 pm');

-- --------------------------------------------------------

--
-- Table structure for table `parking_lot`
--

CREATE TABLE IF NOT EXISTS `parking_lot` (
`lot_id` int(11) NOT NULL,
  `lot_number` varchar(100) NOT NULL,
  `lot_delegation` varchar(100) NOT NULL,
  `lot_isactive` varchar(50) NOT NULL,
  `lot_isreserve` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `parking_lot`
--

INSERT INTO `parking_lot` (`lot_id`, `lot_number`, `lot_delegation`, `lot_isactive`, `lot_isreserve`) VALUES
(10, '522', 'staff', 'yes', 'yes'),
(11, '524', 'management', 'yes', 'yes'),
(12, '295', 'staff', 'yes', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE IF NOT EXISTS `services` (
`services_id` int(11) NOT NULL,
  `services_name` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`services_id`, `services_name`) VALUES
(2, 'Finance'),
(3, 'Information Technology'),
(4, 'Nursing'),
(5, 'OUTSOURCE');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`user_id` int(11) NOT NULL,
  `user_fname` varchar(50) NOT NULL,
  `user_staffid` varchar(50) NOT NULL,
  `user_phone` varchar(50) NOT NULL,
  `user_position` varchar(50) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `user_dateregister` varchar(150) NOT NULL,
  `user_isactive` varchar(50) NOT NULL,
  `fk_services_id` int(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_fname`, `user_staffid`, `user_phone`, `user_position`, `user_type`, `user_dateregister`, `user_isactive`, `fk_services_id`) VALUES
(27, 'Ameirul Mustaqim', '20122456', '0193071722', 'IT', '2', '2024-12-31', 'yes', 3),
(28, 'Ali bin Abu', '202348', '01234567', 'Finance', '2', '2024-11-01', 'yes', 2),
(29, 'anas bin talib', '2012245', '0123487415', 'Nurse', '2', '2024-12-31', 'yes', 4),
(30, 'drg', '201521', '01234512', 'radiologist', '3', '2024-12-31', 'yes', 3),
(32, 'OMAR BIN SALAM', '20154215', '012345124', 'IT', '2', '2024-12-31', 'yes', 3),
(33, 'salam bin isnin', '2016671', '012421541', 'it', '2', '2024-12-31', 'yes', 3),
(34, 'NORRAIRIN BINTI ABU BAKAR', '2015586', '0126321869', 'EXECUTIVE', '2', '2015-10-01', '', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `card`
--
ALTER TABLE `card`
 ADD PRIMARY KEY (`card_id`);

--
-- Indexes for table `car_record`
--
ALTER TABLE `car_record`
 ADD PRIMARY KEY (`car_id`);

--
-- Indexes for table `employee_type`
--
ALTER TABLE `employee_type`
 ADD PRIMARY KEY (`emptype_id`);

--
-- Indexes for table `health_record`
--
ALTER TABLE `health_record`
 ADD PRIMARY KEY (`health_id`);

--
-- Indexes for table `info`
--
ALTER TABLE `info`
 ADD PRIMARY KEY (`info_id`);

--
-- Indexes for table `parking`
--
ALTER TABLE `parking`
 ADD PRIMARY KEY (`parking_id`);

--
-- Indexes for table `parking_lot`
--
ALTER TABLE `parking_lot`
 ADD PRIMARY KEY (`lot_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
 ADD PRIMARY KEY (`services_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `card`
--
ALTER TABLE `card`
MODIFY `card_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `car_record`
--
ALTER TABLE `car_record`
MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `employee_type`
--
ALTER TABLE `employee_type`
MODIFY `emptype_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `health_record`
--
ALTER TABLE `health_record`
MODIFY `health_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `info`
--
ALTER TABLE `info`
MODIFY `info_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `parking`
--
ALTER TABLE `parking`
MODIFY `parking_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `parking_lot`
--
ALTER TABLE `parking_lot`
MODIFY `lot_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
MODIFY `services_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

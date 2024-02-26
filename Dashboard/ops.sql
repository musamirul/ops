-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2024 at 01:45 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `card`
--

INSERT INTO `card` (`card_id`, `card_serialnum`, `card_dateregister`, `card_isactive`, `card_isuse`) VALUES
(2, 'A543847465', '2024-02-22', 'no', 'no'),
(4, 'A543847463', '2024-02-17', 'no', 'no'),
(5, 'A543847469', '2024-02-16', 'yes', 'yes'),
(6, 'A27383A36', '2024-12-31', 'yes', 'no'),
(7, 'A27383A36', '2024-12-01', 'no', 'no'),
(8, 'A27383A36', '2024-12-31', 'yes', 'no');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `car_record`
--

INSERT INTO `car_record` (`car_id`, `car_platenum`, `car_model`, `car_brand`, `car_color`, `fk_staff_id`) VALUES
(12, 'VJJ4898', 'Myvi', 'Perodua', 'Black', 23),
(13, 'VAJ1456', 'BEZZA', 'PERODUA ', 'Black', 23),
(14, 'VAP295', 'AXIA', 'PERODUA ', 'SILVER', 24),
(15, 'WHD538', 'SATRIA', 'PROTON', 'BLUE', 24);

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
  `health_period` int(100) NOT NULL,
  `health_remark` varchar(100) NOT NULL,
  `health_recorddate` varchar(100) NOT NULL,
  `fk_staff_id` int(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `health_record`
--

INSERT INTO `health_record` (`health_id`, `health_type`, `health_startdate`, `health_period`, `health_remark`, `health_recorddate`, `fk_staff_id`) VALUES
(9, 'fever', '2024-02-25', 2, 'long fever 2', '25/02/2024', 23),
(10, 'illness', '2024-12-31', 5, 'health remark', '26/02/2024', 23),
(11, 'PREGNANT', '2024-02-26', 6, 'END DATE', '26/02/2024', 24);

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
  `parking_datecardreturn` varchar(50) NOT NULL,
  `parking_duration` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `parking_lot`
--

INSERT INTO `parking_lot` (`lot_id`, `lot_number`, `lot_delegation`, `lot_isactive`, `lot_isreserve`) VALUES
(3, '533', 'consultant', 'yes', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE IF NOT EXISTS `services` (
`services_id` int(11) NOT NULL,
  `services_name` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`services_id`, `services_name`) VALUES
(2, 'Finance'),
(3, 'Information Technology'),
(4, 'Nursing');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_fname`, `user_staffid`, `user_phone`, `user_position`, `user_type`, `user_dateregister`, `user_isactive`, `fk_services_id`) VALUES
(23, 'Ameirul Mustaqim', '2016670', '0193071722', 'IT', '2', '2024-12-31', 'yes', 3),
(24, 'NORRAIRIN BINTI ABU BAKAR', '2015586', '0126321869', 'EXECUTIVE', '2', '2015-10-01', 'yes', 3);

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
MODIFY `card_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `car_record`
--
ALTER TABLE `car_record`
MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `employee_type`
--
ALTER TABLE `employee_type`
MODIFY `emptype_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `health_record`
--
ALTER TABLE `health_record`
MODIFY `health_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `parking`
--
ALTER TABLE `parking`
MODIFY `parking_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `parking_lot`
--
ALTER TABLE `parking_lot`
MODIFY `lot_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
MODIFY `services_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

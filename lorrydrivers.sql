-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2017 at 08:11 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lorrydrivers`
--

-- --------------------------------------------------------

--
-- Table structure for table `dailytravel`
--

CREATE TABLE IF NOT EXISTS `dailytravel` (
  `sno` int(10) NOT NULL AUTO_INCREMENT,
  `lorryno` varchar(15) NOT NULL,
  `drivername` varchar(20) NOT NULL,
  `dateoftravel` varchar(15) NOT NULL,
  `reading` int(11) NOT NULL,
  `quantity` float NOT NULL,
  `distance` float NOT NULL,
  `kmpl` float NOT NULL,
  `drivermuster` int(11) NOT NULL DEFAULT '0',
  `cleanerdays` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`sno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `dailytravel`
--

INSERT INTO `dailytravel` (`sno`, `lorryno`, `drivername`, `dateoftravel`, `reading`, `quantity`, `distance`, `kmpl`, `drivermuster`, `cleanerdays`) VALUES
(1, 'AP16TB1881', 'KISHORE', '2017-07-04', 150705, 200, 705, 3.525, 0, 0),
(2, 'AP16TB909', 'SAIDA', '2017-07-04', 150695, 202, 695, 3.44059, 0, 0),
(3, 'AP27W4455', 'LAKSHMAN', '2017-07-04', 150650, 205, 650, 3.17073, 0, 0),
(4, 'AP16TB1899', 'KISHORE', '2017-07-12', 150590, 253, 590, 2.33202, 0, 0),
(5, 'AP16TB1881', 'KISHORE', '2017-07-06', 150580, 250, 580, 2.32, 0, 0),
(6, 'AP16TB1881', 'KISHORE', '2017-08-04', 150590, 220, 10, 0.0454545, 0, 0),
(7, 'AP16TB909', 'LAKSHMAN', '2017-07-08', 100584, 253, 584, 2.3083, 0, 0),
(8, 'AP16TB909', 'KISHORE', '2017-07-09', 100632, 260, 48, 0.184615, 3, 1),
(9, 'AP27W909', 'UPPU SRINU', '2017-07-08', 100584, 253, 584, 2.3083, 2, 1),
(10, 'AP16TW9099', 'UPPU SRINU', '2017-07-08', 101000, 220, 1000, 4.54545, 2, 1),
(11, 'AP16TW9099', 'LAKSHMAN', '2017-07-08', 101450, 150, 450, 3, 2, 1),
(13, 'AP27W909', 'KISHORE', '2017-05-01', 101000, 250, 416, 1.664, 1, 1),
(14, 'AP16TB1899', 'SAIDA', '2017-05-01', 100600, 220, 600, 2.72727, 1, 0),
(16, 'Please select l', 'Please select driver', '2017-07-09', 150590, 220, 150590, 684.5, 2, 1),
(17, 'AP16TB1881', 'KISHORE', '2017-07-07', 150590, 220, 0, 0, 2, 1),
(18, 'AP16TB1881', 'SAIDA', '2017-07-02', 101000, 220, -49590, -225.41, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE IF NOT EXISTS `drivers` (
  `sno` int(11) NOT NULL AUTO_INCREMENT,
  `drivername` varchar(20) NOT NULL,
  `driversalary` int(11) NOT NULL DEFAULT '20000',
  `cleanersalary` int(11) NOT NULL DEFAULT '9000',
  `driverbeta` int(11) NOT NULL DEFAULT '175',
  `cleanerbeta` int(11) NOT NULL DEFAULT '125',
  PRIMARY KEY (`sno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`sno`, `drivername`, `driversalary`, `cleanersalary`, `driverbeta`, `cleanerbeta`) VALUES
(1, 'KISHORE', 20000, 9000, 175, 150),
(2, 'SAIDA', 20000, 9000, 175, 150),
(3, 'LAKSHMAN', 20000, 9000, 175, 150),
(4, 'UPPU SRINU', 20000, 9000, 175, 150),
(5, 'B SAMBAIAH', 20000, 9000, 175, 150),
(6, 'CHITTI BABU', 20000, 9000, 175, 150),
(7, 'VIJAYA RAO', 20000, 9000, 175, 150),
(8, 'R SAMBAIAH', 20000, 9000, 175, 150),
(9, 'NAGA RAJU', 20000, 9000, 175, 150),
(10, 'EBELU', 20000, 9000, 175, 150),
(11, 'MABU SUBHANI', 20000, 9000, 175, 150),
(14, 'JAMALAIAH', 20000, 9000, 175, 150),
(17, 'RAMAIAH', 20000, 9000, 175, 150),
(18, 'VENKATA RATNAM', 20000, 9000, 175, 150),
(19, 'SUBHANI', 20000, 9000, 175, 150);

-- --------------------------------------------------------

--
-- Table structure for table `lorries`
--

CREATE TABLE IF NOT EXISTS `lorries` (
  `sno` int(11) NOT NULL AUTO_INCREMENT,
  `lorryno` varchar(15) NOT NULL,
  `reading` int(11) NOT NULL DEFAULT '100000',
  `dieselrate` float NOT NULL DEFAULT '62.18',
  `instoken` int(11) NOT NULL DEFAULT '4806',
  `deptint` int(11) NOT NULL,
  `ramarao` int(11) NOT NULL DEFAULT '1890',
  `expenses` int(11) NOT NULL,
  `autonagar` int(11) NOT NULL,
  `sealtyres` int(11) NOT NULL,
  `breakinsp` int(11) NOT NULL DEFAULT '7000',
  `nagendram` int(11) NOT NULL DEFAULT '1000',
  `kmpllimit` float NOT NULL,
  PRIMARY KEY (`sno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `lorries`
--

INSERT INTO `lorries` (`sno`, `lorryno`, `reading`, `dieselrate`, `instoken`, `deptint`, `ramarao`, `expenses`, `autonagar`, `sealtyres`, `breakinsp`, `nagendram`, `kmpllimit`) VALUES
(1, 'AP16TB1881', 101000, 62, 4806, 39000, 1890, 10000, 7175, 30000, 7000, 1000, 2.2),
(7, 'AP16TB1899', 100600, 62.18, 4806, 39000, 1890, 10000, 111035, 30000, 7000, 1000, 2.54),
(8, 'AP16TB909', 100632, 62.18, 4806, 39000, 1890, 10000, 3580, 30000, 7000, 1000, 2.79),
(9, 'AP16TW9099', 101450, 62.18, 4806, 39000, 1890, 10000, 5300, 30000, 7000, 1000, 3.05),
(10, 'AP27W4455', 100000, 62.18, 4806, 39000, 1890, 10000, 37235, 45000, 7000, 1000, 2.46),
(11, 'AP27W909', 101000, 62.18, 4806, 39000, 1890, 10000, 20750, 30000, 7000, 1000, 2.81);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

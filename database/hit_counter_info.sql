-- phpMyAdmin SQL Dump
-- version 3.4.3.1
-- http://www.phpmyadmin.net
--
-- Host: pdb14.awardspace.net
-- Generation Time: Aug 16, 2014 at 11:46 PM
-- Server version: 5.1.73
-- PHP Version: 5.3.27

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `1654686_cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `hit_counter_info`
--

DROP TABLE IF EXISTS `hit_counter_info`;
CREATE TABLE IF NOT EXISTS `hit_counter_info` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `longIP` int(11) NOT NULL,
  `pageID` int(11) NOT NULL,
  `cc` int(2) NOT NULL,
  `browser` varchar(255) NOT NULL,
  `version` varchar(20) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `hit_counter_info`
--

INSERT INTO `hit_counter_info` (`ID`, `longIP`, `pageID`, `cc`, `browser`, `version`, `datetime`) VALUES
(33, 1157605312, 1, 32, 'Google Chrome', '23.1.6', '2014-08-15 02:55:23'),
(34, 1157605312, 2, 32, 'Google Chrome', '23.1.6', '2014-08-15 02:58:16'),
(35, 1157605312, 3, 32, 'Google Chrome', '23.1.6', '2014-08-15 03:01:18');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

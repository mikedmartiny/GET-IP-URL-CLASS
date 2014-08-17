-- phpMyAdmin SQL Dump
-- version 3.4.3.1
-- http://www.phpmyadmin.net
--
-- Host: pdb14.awardspace.net
-- Generation Time: Aug 16, 2014 at 11:47 PM
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
-- Table structure for table `hit_counter_referrers`
--

DROP TABLE IF EXISTS `hit_counter_referrers`;
CREATE TABLE IF NOT EXISTS `hit_counter_referrers` (
  `refID` int(11) NOT NULL AUTO_INCREMENT,
  `ref_url` varchar(255) NOT NULL,
  `ref_count` int(11) NOT NULL,
  PRIMARY KEY (`refID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `hit_counter_referrers`
--

INSERT INTO `hit_counter_referrers` (`refID`, `ref_url`, `ref_count`) VALUES
(2, 'bookmark', 22),
(3, 'http://martinycms.dx.am/blog/playground/browser_test.php', 1),
(4, 'http://martinycms.dx.am/blog/playground/', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

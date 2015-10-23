-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 23, 2015 at 03:37 AM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `PccBay`
--

-- --------------------------------------------------------

--
-- Table structure for table `pb_users`
--

CREATE TABLE IF NOT EXISTS `pb_users` (
  `user_id` varchar(200) NOT NULL,
  `num_of_ratings` int(11) NOT NULL,
  `total_ratings` int(11) NOT NULL,
  `permissions` int(11) NOT NULL,
  `id_card_key` varchar(255) NOT NULL,
  `contact_info` varchar(1024) NOT NULL,
  `user_data` varchar(1024) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pb_users`
--

INSERT INTO `pb_users` (`user_id`, `num_of_ratings`, `total_ratings`, `permissions`, `id_card_key`, `contact_info`, `user_data`) VALUES
('100006044469574', 0, 0, 100, '124981', '[{ 	\r\n	"resident": false, 	\r\n	"building": "null", 	\r\n	"room": "null", 	\r\n	"phone": "850 281-9161",\r\n	"email": "josh@inspirosity.net" \r\n}]', '[{\r\n	"ID": 100006044469574, 	\r\n	"username": "JoshFerguson", 	\r\n	"name": "Josh Ferguson", \r\n	"avatar": "https://scontent-atl3-1.xx.fbcdn.net/hphotos-xpl1/t31.0-8/11228039_1686546648223468_7048846777877974576_o.jpg", 	\r\n	"registered": "10/20/2015", 	\r\n	"permissions": "100", 	\r\n	"theme": "default",\r\n	"interest": "tech, Art" \r\n}]');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pb_users`
--
ALTER TABLE `pb_users`
  ADD PRIMARY KEY (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

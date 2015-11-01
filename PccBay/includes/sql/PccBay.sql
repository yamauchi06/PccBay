-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 01, 2015 at 06:05 AM
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
-- Table structure for table `pb_comments`
--

CREATE TABLE IF NOT EXISTS `pb_comments` (
  `id` int(200) NOT NULL,
  `post_id` varchar(200) NOT NULL,
  `date` varchar(200) NOT NULL,
  `author` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL,
  `comment` longtext NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pb_comments`
--

INSERT INTO `pb_comments` (`id`, `post_id`, `date`, `author`, `status`, `comment`) VALUES
(1, '10', 'October 31, 2015, 11:40 pm', '100006044469574', 'open', 'Can you budge on the price at all?'),
(2, '10', 'October 31, 2015, 11:41 pm', '10000607254332', 'open', 'Nah this is a good price, Ill Take it!!');

-- --------------------------------------------------------

--
-- Table structure for table `pb_post`
--

CREATE TABLE IF NOT EXISTS `pb_post` (
  `product_id` int(200) NOT NULL,
  `type` varchar(200) NOT NULL,
  `user_id` varchar(200) NOT NULL,
  `product_info` longtext NOT NULL COMMENT 'Product title, description, price, date created',
  `trans_info` varchar(1024) NOT NULL COMMENT 'sold to, date sold, payment method, transaction complete flag',
  `status` varchar(200) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pb_post`
--

INSERT INTO `pb_post` (`product_id`, `type`, `user_id`, `product_info`, `trans_info`, `status`) VALUES
(1, 'product', '100001056120276', '[{"timestamp":"October 26, 2015, 1:43 pm","title":"Hats","desc":"An assortment of hats for all occasions","tags":"hats,style,mens,apparel","price":"15.00","condition":"100","images":"6809iwA9Ho,UaTmxgEkIE,5H9QjknRxJ"}]', '[{"completed":0,"method":0,"sold_to":0,"date_sold":0}]', 'open'),
(2, 'product', '100006044469574', '[{"timestamp":"October 26, 2015, 6:27 pm","title":"Used textbooks","desc":"50 dollars for all or 10 per book","tags":"textbooks, science, history","price":"50.00","condition":"44","images":"vBBU7TxoYf,TNJReHzRFX"}]', '[{"completed":0,"method":0,"sold_to":0,"date_sold":0}]', 'open'),
(3, 'product', '100006044469574', '[{"timestamp":"October 26, 2015, 6:30 pm","title":"Snacks","desc":"A whole bunch of snacks","tags":"snacks,food","price":"45.00","condition":"98","images":"Pe3B28aKQg"}]', '[{"completed":0,"method":0,"sold_to":0,"date_sold":0}]', 'open'),
(4, 'product', '100006044469574', '[{"timestamp":"October 26, 2015, 6:32 pm","title":"DSLR Nikon Camera","desc":"Used but works like new","tags":"tech,camera,photography","price":"200.00","condition":"67","images":"64V78HQp0V"}]', '[{"completed":0,"method":0,"sold_to":0,"date_sold":0}]', 'open'),
(5, 'product', '100006044469574', '[{"timestamp":"October 26, 2015, 6:34 pm","title":"Jailbroken iPhone 4S","desc":"Jailbroken iPhone 4S","tags":"phone,iphone","price":"100.00","condition":"34","images":"NfAsvbVKJn"}]', '[{"completed":0,"method":0,"sold_to":0,"date_sold":0}]', 'open'),
(6, 'product', '100001056120276', '[{"timestamp":"October 26, 2015, 6:36 pm","title":"K-cups","desc":"","tags":"K-cups,coffee,drink","price":"20.00","condition":"91","images":"1A0kP9T75X"}]', '[{"completed":0,"method":0,"sold_to":0,"date_sold":0}]', 'open'),
(7, 'question', '100006044469574', '[{"timestamp":"October 27, 2015, 12:01 am","title":"How to use PCCbay","desc":"Does anyone know how to use this?","tags":"FAQ,PCCbay,help","price":"","condition":"null","images":""}]', '[{"completed":0,"method":0,"sold_to":0,"date_sold":0}]', 'open'),
(8, 'discussion', '100006044469574', '[{"timestamp":"October 27, 2015, 12:15 am","title":"Fine Arts","desc":"How About that child Prodigy","tags":"Prodigy,Fine Arts,Ethan Bortnick","price":"","condition":"null","images":"G6gbX9ICnT"}]', '[{"completed":0,"method":0,"sold_to":0,"date_sold":0}]', 'open'),
(9, 'discussion', '100001056120276', '[{"timestamp":"October 27, 2015, 8:53 pm","title":"The Big Idea Behind PCCbay","desc":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec venenatis vehicula eros in dapibus. Nunc mattis neque porttitor tempor congue. Pellentesque convallis feugiat pretium. Donec maximus imperdiet ligula efficitur convallis. Proin hendrerit semper augue,","tags":"Lorem,ipsum,PCCbay","price":"","condition":"null","images":""}]', '[{"completed":0,"method":0,"sold_to":0,"date_sold":0}]', 'open'),
(10, 'product', '100006044469574', '[{"timestamp":"October 31, 2015, 3:35 am","title":"2015 MacBook Pro with Retina display","desc":"<ol><li>2.7GHz Processor</li><li>2.7GHz dual-core Intel Core</li><li>i5 Turbo Boost up to 3.1GHz</li><li>8GB 1866MHz LPDDR3 memory 128GB PCIe-based flash storage</li></ol><ul><li>Intel Iris Graphics 6100</li><li>Built-in battery (10 hours)</li><li>2 Force Touch trackpad</li><li>Power adapter and power cord</li><li>AC Wall Plug</li></ul><p>A Mac includes 90 days of free telephone technical support and a one-year limited warranty. If you purchase the AppleCare Protection Plan, you can extend that coverage to three years from the original purchase date of your Mac 128 GB Storage</p>","tags":"MacBook Pro,Laptop,Computer,Mac,Apple","price":"1,299.00","condition":"80","images":"3dhALzY0OI,pBAXPpOsOR,9dbJWlQABt"}]', '[{"completed":0,"method":0,"sold_to":0,"date_sold":0}]', 'open');

-- --------------------------------------------------------

--
-- Table structure for table `pb_safe_image`
--

CREATE TABLE IF NOT EXISTS `pb_safe_image` (
  `id` int(200) NOT NULL,
  `uid` varchar(200) NOT NULL,
  `size` varchar(200) NOT NULL,
  `type` varchar(200) NOT NULL,
  `date` varchar(200) NOT NULL,
  `author` varchar(200) NOT NULL,
  `file` varchar(200) NOT NULL,
  `string` longtext NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pb_safe_image`
--

INSERT INTO `pb_safe_image` (`id`, `uid`, `size`, `type`, `date`, `author`, `file`, `string`) VALUES
(1, '6809iwA9Ho', '540:400', 'jpg', 'October 26, 2015, 1:43 pm', '100006044469574', 'c9fffeb9b6ed917b2b650f95955ca969CFTc6UcYIJ.jpg', '/images/user-data/2015_26_10/c9fffeb9b6ed917b2b650f95955ca969CFTc6UcYIJ.jpg'),
(2, 'UaTmxgEkIE', '490:518', 'jpg', 'October 26, 2015, 1:43 pm', '100006044469574', 'c9fffeb9b6ed917b2b650f95955ca9695uKCbwxclq.jpg', '/images/user-data/2015_26_10/c9fffeb9b6ed917b2b650f95955ca9695uKCbwxclq.jpg'),
(3, '5H9QjknRxJ', '2742:2801', 'jpg', 'October 26, 2015, 1:43 pm', '100006044469574', 'c9fffeb9b6ed917b2b650f95955ca969yVLvNyerCE.jpg', '/images/user-data/2015_26_10/c9fffeb9b6ed917b2b650f95955ca969yVLvNyerCE.jpg'),
(4, 'vBBU7TxoYf', '1600:1200', 'jpg', 'October 26, 2015, 6:27 pm', '100006044469574', '6485b21954ec16e7088b58aeb6889a390B2d30VPTy.jpg', '/images/user-data/2015_26_10/6485b21954ec16e7088b58aeb6889a390B2d30VPTy.jpg'),
(5, 'TNJReHzRFX', '353:350', 'gif', 'October 26, 2015, 6:27 pm', '100006044469574', '6485b21954ec16e7088b58aeb6889a39Vdje9zhV30.gif', '/images/user-data/2015_26_10/6485b21954ec16e7088b58aeb6889a39Vdje9zhV30.gif'),
(6, '0HB8bp3xco', '606:360', 'jpg', 'October 26, 2015, 6:29 pm', '100006044469574', 'b3e767c6058fb08506b764b80cc39e653qXJivzTWk.jpg', '/images/user-data/2015_26_10/b3e767c6058fb08506b764b80cc39e653qXJivzTWk.jpg'),
(7, 'Pe3B28aKQg', '606:360', 'jpg', 'October 26, 2015, 6:30 pm', '100006044469574', 'f5797bd13078926ae33d946a174997f9ua9PhJCBmM.jpg', '/images/user-data/2015_26_10/f5797bd13078926ae33d946a174997f9ua9PhJCBmM.jpg'),
(8, '64V78HQp0V', '644:568', 'jpg', 'October 26, 2015, 6:32 pm', '100006044469574', '27e14a539a3db86f261a670ba5cd9044AA50jKF2tg.jpg', '/images/user-data/2015_26_10/27e14a539a3db86f261a670ba5cd9044AA50jKF2tg.jpg'),
(9, 'NfAsvbVKJn', '480:853', 'jpg', 'October 26, 2015, 6:34 pm', '100006044469574', 'd15bddd1c93a813bf605e17acdbbfa36Z5iPPwi06S.jpg', '/images/user-data/2015_26_10/d15bddd1c93a813bf605e17acdbbfa36Z5iPPwi06S.jpg'),
(10, '1A0kP9T75X', '960:540', 'jpg', 'October 26, 2015, 6:36 pm', '100006044469574', '8bce111b8fa015cd09176343e9fb6996ixz8sFeCFM.jpg', '/images/user-data/2015_26_10/8bce111b8fa015cd09176343e9fb6996ixz8sFeCFM.jpg'),
(13, 'G6gbX9ICnT', '534:401', 'jpg', 'October 27, 2015, 12:15 am', '100006044469574', 'cc1e682e2a7b3ff5fba509c77effffb99362baa9.jpg', '/images/user-data/2015_10_27/cc1e682e2a7b3ff5fba509c77effffb99362baa9.jpg'),
(14, '3dhALzY0OI', '769:517', 'jpg', 'October 31, 2015, 3:35 am', '100006044469574', '52ca1ef1dfacb161a8f23998938da9e010ef9ce0.jpg', '/images/user-data/2015_10_31/52ca1ef1dfacb161a8f23998938da9e010ef9ce0.jpg'),
(15, 'pBAXPpOsOR', '900:530', 'jpg', 'October 31, 2015, 3:35 am', '100006044469574', '197a50d9c6a1f915025561bda761ad1f7af4abf6.jpg', '/images/user-data/2015_10_31/197a50d9c6a1f915025561bda761ad1f7af4abf6.jpg'),
(16, '9dbJWlQABt', '534:312', 'png', 'October 31, 2015, 3:35 am', '100006044469574', '7bcf2c52e082f824b7f6067ae5eeddd936cbe953.png', '/images/user-data/2015_10_31/7bcf2c52e082f824b7f6067ae5eeddd936cbe953.png'),
(17, '57BXJb3A7W', '235:235', 'jpg', 'October 31, 2015, 3:41 am', '100006044469574', 'a8c99d09a3cd14b42bc7b7bb47a203a427d64e30.jpg', '/images/user-data/2015_10_31/a8c99d09a3cd14b42bc7b7bb47a203a427d64e30.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pb_short_url`
--

CREATE TABLE IF NOT EXISTS `pb_short_url` (
  `id` int(200) NOT NULL,
  `open` varchar(200) NOT NULL,
  `short` varchar(200) NOT NULL,
  `long` text NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pb_short_url`
--

INSERT INTO `pb_short_url` (`id`, `open`, `short`, `long`) VALUES
(3, 'true', 'Xt5y22i', '/?gift=Xt5y22i');

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
('100006044469574', 0, 0, 100, '124981', '[{"resident":"false","building":"","room":"","phone":"850 281-9161","email":"josh@inspirosity.net","notify_d":"true","notify_m":"true"}]', '[{"ID":"100006044469574","username":"JoshFerguson","name":"Josh Ferguson","avatar":"https://scontent-atl3-1.xx.fbcdn.net/hphotos-xpl1/t31.0-8/11228039_1686546648223468_7048846777877974576_o.jpg","registered":"10/20/2015","permissions":"100","theme":"dark","interest":"Design,Graphics,Advertising,Textbooks,Pensacola FL"}]'),
('100001056120276', 0, 0, 100, '', '[{"resident":"true","building":"","room":"","phone":"","email":"","notify_d":"true","notify_m":"true"}]', '[{"ID":"100001056120276","username":"joseph.gengarella","name":"Joseph Gengarella","avatar":"https://scontent-iad3-1.xx.fbcdn.net/hphotos-xlp1/v/t1.0-9/10403522_878791748832688_1007985923560409411_n.jpg?oh=08d6efbe0cbea75280afdf0895ede224&oe=56B3F054","registered":"10/27/2015","permissions":"100","theme":"default","interest":""}]'),
('10000607254332', 0, 0, 0, '000000', '[{"resident":"true","building":"Young","room":"345","phone":"(555) 555-5555","email":"TestUser@email.com","notify_d":"false","notify_m":"false"}]', '[{"ID":"10000607254332","username":"SteveJobs","name":"Steve Jobs","avatar":"https://image.freepik.com/free-vector/steve-jobs-vector-tribute_25-14787.jpg","registered":"10/01/2015","permissions":"100","theme":"blue","interest":""}]');

-- --------------------------------------------------------

--
-- Table structure for table `pb_user_points`
--

CREATE TABLE IF NOT EXISTS `pb_user_points` (
  `id` int(200) NOT NULL,
  `user_id` varchar(200) NOT NULL,
  `points` varchar(200) NOT NULL,
  `point_data` mediumtext NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pb_user_points`
--

INSERT INTO `pb_user_points` (`id`, `user_id`, `points`, `point_data`) VALUES
(1, '100006044469574', '100', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pb_comments`
--
ALTER TABLE `pb_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pb_post`
--
ALTER TABLE `pb_post`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `pb_safe_image`
--
ALTER TABLE `pb_safe_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pb_short_url`
--
ALTER TABLE `pb_short_url`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pb_users`
--
ALTER TABLE `pb_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `pb_user_points`
--
ALTER TABLE `pb_user_points`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pb_comments`
--
ALTER TABLE `pb_comments`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `pb_post`
--
ALTER TABLE `pb_post`
  MODIFY `product_id` int(200) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `pb_safe_image`
--
ALTER TABLE `pb_safe_image`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `pb_short_url`
--
ALTER TABLE `pb_short_url`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pb_user_points`
--
ALTER TABLE `pb_user_points`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

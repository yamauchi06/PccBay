-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 20, 2015 at 03:03 AM
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pb_comments`
--

INSERT INTO `pb_comments` (`id`, `post_id`, `date`, `author`, `status`, `comment`) VALUES
(1, '3', 'November 7, 2015, 7:31 pm', '100001056120276', 'open', 'Yummy!'),
(2, '13', 'November 7, 2015, 7:31 pm', '100001056120276', 'open', 'The text on this page is messed up'),
(3, '7', 'November 7, 2015, 7:31 pm', '100001056120276', 'open', 'Be smarter than the computer'),
(4, '7', 'November 7, 2015, 7:32 pm', '10000607254332', 'open', 'Get a jobs'),
(5, '10', 'November 7, 2015, 7:33 pm', '10000607254332', 'open', 'Ill Take it. although I invented it.'),
(6, '14', 'November 7, 2015, 7:48 pm', '100006044469574', 'open', '42'),
(7, '10', 'November 7, 2015, 8:06 pm', '10000607254332', 'open', 'whoopy'),
(8, '1', 'November 8, 2015, 4:52:12 am', '100006044469574', 'open', 'Test comment'),
(9, '10', 'November 9, 2015, 7:52:10 pm', '100006044469574', 'open', 'test comment'),
(10, '7', 'November 9, 2015, 7:52:36 pm', '100006044469574', 'open', 'test'),
(11, '10', 'November 10, 2015, 2:58:56 am', '100001056120276', 'open', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry'),
(12, '10', 'November 10, 2015, 2:59:04 am', '100001056120276', 'open', ' Lorem Ipsum has been the industry'),
(13, '10', 'November 10, 2015, 2:59:21 am', '10000607254332', 'open', 'took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into '),
(14, '10', 'November 10, 2015, 2:59:48 am', '100006044469574', 'open', 'When should we do this'),
(15, '14', 'November 11, 2015, 1:05:54 am', '100001056120276', 'open', 'thanks'),
(16, '17', 'November 12, 2015, 10:14:34 pm', '9286529385629835', 'open', 'How much?'),
(17, '17', 'November 16, 2015, 10:26:08 pm', '100001056120276', 'open', 'test commnt');

-- --------------------------------------------------------

--
-- Table structure for table `pb_developers`
--

CREATE TABLE IF NOT EXISTS `pb_developers` (
  `id` int(200) NOT NULL,
  `app_id` varchar(200) NOT NULL,
  `secret` varchar(200) NOT NULL,
  `user` varchar(200) NOT NULL,
  `permissions` varchar(200) NOT NULL,
  `user_data` longtext NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pb_developers`
--

INSERT INTO `pb_developers` (`id`, `app_id`, `secret`, `user`, `permissions`, `user_data`) VALUES
(1, '9827354187582375129873', '712638715312875', 'root', 'rw', '');

-- --------------------------------------------------------

--
-- Table structure for table `pb_notify`
--

CREATE TABLE IF NOT EXISTS `pb_notify` (
  `id` int(200) NOT NULL,
  `notify_to` varchar(200) NOT NULL,
  `notify_from` varchar(200) NOT NULL,
  `item` varchar(200) NOT NULL,
  `intro` varchar(200) NOT NULL,
  `content` varchar(200) NOT NULL,
  `link` varchar(200) NOT NULL,
  `date` varchar(200) NOT NULL,
  `seen` int(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pb_notify`
--

INSERT INTO `pb_notify` (`id`, `notify_to`, `notify_from`, `item`, `intro`, `content`, `link`, `date`, `seen`) VALUES
(1, '100006044469574', '100001056120276', '3', 'Commented on', 'Yummy!', '/item?id=3', 'November 7, 2015, 7:31 pm', 1),
(2, '10000607254332', '100001056120276', '13', 'Commented on', 'The text on this page is messed up', '/item?id=13', 'November 7, 2015, 7:31 pm', 0),
(3, '100006044469574', '100001056120276', '7', 'Commented on', 'Be smarter than the computer', '/item?id=7', 'November 7, 2015, 7:31 pm', 1),
(4, '100006044469574', '10000607254332', '7', 'Commented on', 'Get a jobs', '/item?id=7', 'November 7, 2015, 7:32 pm', 1),
(5, '100006044469574', '10000607254332', '10', 'Commented on', 'Ill Take it. although I invented it.', '/item?id=10', 'November 7, 2015, 7:33 pm', 1),
(6, '100001056120276', '100006044469574', '14', 'Commented on', '42', '/item?id=14', 'November 7, 2015, 7:48 pm', 0),
(7, '100006044469574', '10000607254332', '10', 'Commented on', 'whoopy', '/item?id=10', 'November 7, 2015, 8:06 pm', 1),
(8, '100001056120276', '100006044469574', '1', 'Commented on', 'Test comment', '/item?id=1', 'November 8, 2015, 4:52:12 am', 0),
(9, '100006044469574', '100006044469574', '10', 'Commented on', 'test comment', '/item?id=10', 'November 9, 2015, 7:52:10 pm', 1),
(10, '100006044469574', '100006044469574', '7', 'Commented on', 'test', '/item?id=7', 'November 9, 2015, 7:52:36 pm', 1),
(11, '100006044469574', '100001056120276', '10', 'Commented on', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry', '/item?id=10', 'November 10, 2015, 2:58:56 am', 1),
(12, '100006044469574', '100001056120276', '10', 'Commented on', '', '/item?id=10', 'November 10, 2015, 2:59:04 am', 1),
(13, '100006044469574', '10000607254332', '10', 'Commented on', 'took a galley of type and scrambled it to make a type specimen book. It has survived not only five ', '/item?id=10', 'November 10, 2015, 2:59:21 am', 1),
(14, '100006044469574', '100006044469574', '10', 'Commented on', 'When should we do this', '/item?id=10', 'November 10, 2015, 2:59:48 am', 0),
(15, '100001056120276', '100001056120276', '14', 'Commented on', 'thanks', '/item?id=14', 'November 11, 2015, 1:05:54 am', 0),
(16, '100006044469574', '9286529385629835', '17', 'Commented on', 'How much?', '/item?id=17', 'November 12, 2015, 10:14:34 pm', 0),
(17, '100006044469574', '100001056120276', '17', 'Commented on', 'test commnt', '/item?id=17', 'November 16, 2015, 10:26:08 pm', 0);

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
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

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
(10, 'product', '100006044469574', '[{"timestamp":"October 31, 2015, 3:35 am","title":"2015 MacBook Pro with Retina display","desc":"<ol><li>2.7GHz Processor</li><li>2.7GHz dual-core Intel Core</li><li>i5 Turbo Boost up to 3.1GHz</li><li>8GB 1866MHz LPDDR3 memory 128GB PCIe-based flash storage</li></ol><ul><li>Intel Iris Graphics 6100</li><li>Built-in battery (10 hours)</li><li>2 Force Touch trackpad</li><li>Power adapter and power cord</li><li>AC Wall Plug</li></ul><p>A Mac includes 90 days of free telephone technical support and a one-year limited warranty. If you purchase the AppleCare Protection Plan, you can extend that coverage to three years from the original purchase date of your Mac 128 GB Storage</p>","tags":"MacBook Pro,Laptop,Computer,Mac,Apple","price":"1,299.00","condition":"80","images":"3dhALzY0OI,pBAXPpOsOR,9dbJWlQABt"}]', '[{"completed":0,"method":0,"sold_to":0,"date_sold":0}]', 'open'),
(13, 'product', '10000607254332', '[{"timestamp":"November 1, 2015, 9:51 pm","title":"iPhone Collection","desc":"&lt;span&gt;Availableingold,silver,spacegray,androsegold,iPhone&amp;nbsp;6sfeaturesanA9chip,3D&amp;nbsp;Touch,ultrafastLTE&amp;nbsp;Advancedwireless,Touch&amp;nbsp;ID,a12MPiSightcamera,andiOS&amp;nbsp;9.&lt;br&gt;&lt;br&gt;&lt;/span&gt;A9chipwith64-bitarchitecture&lt;span&gt;EmbeddedM9motioncoprocessor&lt;br&gt;&lt;br&gt;&lt;/span&gt;&lt;span&gt;Second-generationfingerprintsensorbuiltintotheHomebutton&lt;br&gt;&lt;/span&gt;&lt;br&gt;Videoformatssupported:H.264videoupto1080p,60framespersecond,HighProfilelevel4.2withAAC-LCaudioupto160Kbps,48kHz,stereoaudioin.m4v,.mp4,and.movfileformats;MPEG-4videoupto2.5Mbps,640by480pixels,30framespersecond,SimpleProfilewithAAC-LCaudioupto160Kbpsperchannel,48kHz,stereoaudioin.m4v,.mp4,and.movfileformats;MotionJPEG(M-JPEG)upto35Mbps,1280by720pixels,30framespersecond,audioinulaw,PCMstereoaudioin.avifileformat&lt;span&gt;&lt;br&gt;&lt;br&gt;&lt;br&gt;&lt;/span&gt;","tags":"iphone,phone,apple","price":"300.00","condition":"100","images":"D5cOZeP8sO,23XGOCWxuW,5ckAZ8hxM6"}]', '[{"completed":0,"method":0,"sold_to":0,"date_sold":0}]', 'open'),
(14, 'question', '100001056120276', '[{"timestamp":"November 5, 2015, 7:44 am","title":"The Meaning Of Life","desc":"What is the meaning of life?","tags":"life,meanings","price":"","condition":"null","images":""}]', '[{"completed":0,"method":0,"sold_to":0,"date_sold":0}]', 'open'),
(15, 'product', '10000607254332', '[{"timestamp":"November 8, 2015, 12:13 pm","title":"Lollipops","desc":"<span>One way to help prevent obesity is to exercise &#34;portion control&#34;. Dum Dums are a perfectly sized treat, providing a quick, high-flavor treat without consuming too much.<br></span><br>It is important to allow treats, such as candy and other snacks, in moderation rather than eliminate them. Children who learn the importance of balanced eating will be better-equipped to manage their own diet as adults.<br><br>Candy calories do not contribute a large percentage of the fat and sugar in the American diet. In fact, less than two percent of the fat and ten percent of the sugar in our diets are supplied by candy. Most of the fat actually comes from the high-fat animal products we eat. The main sources of sugar in America&rsquo;s diets are sugary beverages, baked goods, and frozen desserts. (Candy Myths from candyusa.org web site)<br>","tags":"food, candy","price":"","condition":"97","images":"BbnYnaMdaui6gMdARH9W"}]', '[{"completed":0,"method":0,"sold_to":0,"date_sold":0}]', 'open'),
(16, 'product', '1982418468126194826', '[{"timestamp":"November 8, 2015, 12:43 pm","title":"Lego Iron Man","desc":"Blahhhhhhhhhh","tags":"lego,toy,toys,super hero","price":"1.00","condition":"32","images":"rkr5x2twOIImq9XpgiqL"}]', '[{"completed":0,"method":0,"sold_to":0,"date_sold":0}]', 'open'),
(17, 'question', '100006044469574', '[{"timestamp":"November 9, 2015, 11:27 pm","title":"Web Design","desc":"Whether you&#8217;re promoting services, a new book, or need an informational site for your organization, your website will be your most public face. A poorly designed website&#8212;or no website at all&#8212;will be a turn-off to prospective clients, something that should be avoided. We will discuss your specific needs and develop a site that&#8217;s not just attractive and well-functioning, but promotes your business even when you can&#8217;t.","tags":"web,design,art","price":"20.00","condition":"100","images":"W5mlYQsJFH,S9OMpzsJbz"}]', '[{"completed":0,"method":0,"sold_to":0,"date_sold":0}]', 'open');

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
) ENGINE=MyISAM AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;

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
(17, '57BXJb3A7W', '235:235', 'jpg', 'October 31, 2015, 3:41 am', '100006044469574', 'a8c99d09a3cd14b42bc7b7bb47a203a427d64e30.jpg', '/images/user-data/2015_10_31/a8c99d09a3cd14b42bc7b7bb47a203a427d64e30.jpg'),
(18, 'D5cOZeP8sO', '900:720', 'jpg', 'November 1, 2015, 9:51 pm', '10000607254332', '7d99da6a0535dc62d4396ace86557e23861420e5.jpg', '/images/user-data/2015_11_1/7d99da6a0535dc62d4396ace86557e23861420e5.jpg'),
(19, '23XGOCWxuW', '900:675', 'jpg', 'November 1, 2015, 9:51 pm', '10000607254332', 'd1ee0ecc37adb651dea60af31df2f25c241458d2.jpg', '/images/user-data/2015_11_1/d1ee0ecc37adb651dea60af31df2f25c241458d2.jpg'),
(20, '5ckAZ8hxM6', '900:600', 'jpg', 'November 1, 2015, 9:51 pm', '10000607254332', '396a269a3516dc79150b888cb390ed1bed9778b6.jpg', '/images/user-data/2015_11_1/396a269a3516dc79150b888cb390ed1bed9778b6.jpg'),
(21, 'BbnYnaMdaui6gMdARH9W', '640:353', 'jpg', 'November 8, 2015, 7:13 pm', '10000607254332', '07e19fbe48efd44cd326ecb82a409e6759627fa6.jpg', '/images/user-data/2015_11_8/07e19fbe48efd44cd326ecb82a409e6759627fa6.jpg'),
(22, 'rkr5x2twOIImq9XpgiqL', '300:244', 'jpg', 'November 8, 2015, 7:43 pm', '100006044469574', '9b2a54b257a71517e3c00f904577e495a8c9a466.jpg', '/images/user-data/2015_11_8/9b2a54b257a71517e3c00f904577e495a8c9a466.jpg'),
(35, 'S9OMpzsJbz', '800:585', 'jpg', 'November 10, 2015, 11:03 pm', '100006044469574', 'S9OMpzsJbz.jpg', '/images/user-data/2015_11_10/S9OMpzsJbz.jpg'),
(36, 'W5mlYQsJFH', '800:436', 'jpg', 'November 10, 2015, 11:03 pm', '100006044469574', 'W5mlYQsJFH.jpg', '/images/user-data/2015_11_10/W5mlYQsJFH.jpg'),
(38, '2k8CsysXVL', '200:200', 'jpg', 'November 15, 2015, 4:17 am', '', '2k8CsysXVL.jpg', '/images/user-data/2015_11_15/2k8CsysXVL.jpg'),
(39, 'xIczXxtMml', '200:200', 'jpg', 'November 15, 2015, 4:53 pm', '', 'xIczXxtMml.jpg', '/images/user-data/2015_11_15/xIczXxtMml.jpg'),
(40, 'B6QeygzOsR', '900:600', 'jpg', 'November 15, 2015, 9:15 pm', '', 'B6QeygzOsR.jpg', '/images/user-data/2015_11_15/B6QeygzOsR.jpg'),
(41, 'BlVNNU8PsS', '200:200', 'jpg', 'November 15, 2015, 9:16 pm', 'Guest', 'BlVNNU8PsS.jpg', '/images/user-data/2015_11_15/BlVNNU8PsS.jpg'),
(42, 'nOXiSILxea', '900:600', 'jpg', 'November 15, 2015, 9:17 pm', 'Guest', 'nOXiSILxea.jpg', '/images/user-data/2015_11_15/nOXiSILxea.jpg'),
(43, 'arDSrrYR9Z', '200:200', 'jpg', 'November 15, 2015, 9:17 pm', 'Guest', 'arDSrrYR9Z.jpg', '/images/user-data/2015_11_15/arDSrrYR9Z.jpg'),
(44, 'M8pNkmfwYv', '900:962', 'jpg', 'November 15, 2015, 9:17 pm', 'Guest', 'M8pNkmfwYv.jpg', '/images/user-data/2015_11_15/M8pNkmfwYv.jpg'),
(45, 'BTrswRAezN', '200:200', 'jpg', 'November 15, 2015, 9:22 pm', 'Guest', 'BTrswRAezN.jpg', '/images/user-data/2015_11_15/BTrswRAezN.jpg'),
(46, 'YJCIfSnrRz', '900:962', 'jpg', 'November 15, 2015, 9:22 pm', 'Guest', 'YJCIfSnrRz.jpg', '/images/user-data/2015_11_15/YJCIfSnrRz.jpg'),
(53, 'o7RVb7KlRJ', '500:375', 'jpg', 'November 16, 2015, 2:36 am', '100006044469574', 'o7RVb7KlRJ.jpg', '/images/user-data/2015_11_16/o7RVb7KlRJ.jpg'),
(48, 'LpnY42vqcN', '200:200', 'jpg', 'November 15, 2015, 9:23 pm', 'Guest', 'LpnY42vqcN.jpg', '/images/user-data/2015_11_15/LpnY42vqcN.jpg'),
(50, 'Gan85QTN2m', '900:600', 'jpg', 'November 15, 2015, 9:25 pm', 'Guest', 'Gan85QTN2m.jpg', '/images/user-data/2015_11_15/Gan85QTN2m.jpg'),
(52, 'JuZFf73KVk', '200:200', 'jpg', 'November 15, 2015, 9:26 pm', 'Guest', 'JuZFf73KVk.jpg', '/images/user-data/2015_11_15/JuZFf73KVk.jpg'),
(54, 'C4tY4hcaA5', '900:506', 'jpg', 'November 16, 2015, 2:36 am', '100006044469574', 'C4tY4hcaA5.jpg', '/images/user-data/2015_11_16/C4tY4hcaA5.jpg'),
(59, 'wFG4ty1H65', '500:500', 'jpg', 'November 19, 2015, 5:50 am', '100006044469574', 'wFG4ty1H65.jpg', '/images/user-data/2015_11_19/wFG4ty1H65.jpg'),
(58, 'qHQY1DnVVJ', '900:506', 'jpg', 'November 16, 2015, 2:39 am', '100006044469574', 'qHQY1DnVVJ.jpg', '/images/user-data/2015_11_16/qHQY1DnVVJ.jpg'),
(57, 'xH2bVZT6yZ', '500:375', 'jpg', 'November 16, 2015, 2:39 am', '100006044469574', 'xH2bVZT6yZ.jpg', '/images/user-data/2015_11_16/xH2bVZT6yZ.jpg'),
(60, 'XWuMtP6vGu', '843:403', 'jpg', 'November 19, 2015, 5:51 am', '100006044469574', 'XWuMtP6vGu.jpg', '/images/user-data/2015_11_19/XWuMtP6vGu.jpg'),
(61, 'FkkkxQreJs', '803:700', 'jpg', 'November 19, 2015, 5:51 am', '100006044469574', 'FkkkxQreJs.jpg', '/images/user-data/2015_11_19/FkkkxQreJs.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pb_services`
--

CREATE TABLE IF NOT EXISTS `pb_services` (
  `id` int(200) NOT NULL,
  `service_id` varchar(200) NOT NULL,
  `category` varchar(200) NOT NULL,
  `title` varchar(200) NOT NULL,
  `cost` varchar(200) NOT NULL,
  `location` varchar(200) NOT NULL,
  `hours` varchar(200) NOT NULL,
  `established` varchar(200) NOT NULL,
  `expires` varchar(200) NOT NULL,
  `bio` longtext NOT NULL,
  `cover` varchar(200) NOT NULL,
  `logo` varchar(200) NOT NULL,
  `owner` varchar(200) NOT NULL,
  `members` varchar(200) NOT NULL,
  `ratings` varchar(200) NOT NULL,
  `portfolio` longtext NOT NULL,
  `status` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pb_services`
--

INSERT INTO `pb_services` (`id`, `service_id`, `category`, `title`, `cost`, `location`, `hours`, `established`, `expires`, `bio`, `cover`, `logo`, `owner`, `members`, `ratings`, `portfolio`, `status`) VALUES
(2, '0193060916', 'Hair Care', 'llama care', '10.00', 'none', '', 'November 15, 2015, 7:40:36 pm', '', 'This is a super cool hair styling gig. word to the wide i use my pet llama to cut the hair.', 'qHQY1DnVVJ', 'xH2bVZT6yZ', '100006044469574', '', '2', '', 'open'),
(3, '6162898267', 'Design', 'Inspirosoty', '10.00', 'none', '', 'November 18, 2015, 10:51:58 pm', '', 'Whether you&rsquo;re promoting services, a new book, or need an informational site for your organization, your website will be your most public face. A poorly designed website-or no website at all-will be a turn-off to prospective clients, something that should be avoided. We will discuss your specific needs and develop a site that&rsquo;s not just attractive and well-functioning, but promotes your business even when you can&rsquo;t.', 'XWuMtP6vGu', 'wFG4ty1H65', '100006044469574', '', '4.5', 'FkkkxQreJs', 'open'),
(4, '6456584854', 'Ride Share', 'Going to New York', '50.00', 'Texas', '', 'November 18, 2015, 11:17:10 pm', '', 'Will give ride to New York city.', '', '', '100006044469574', '', '', '', 'open');

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
-- Table structure for table `pb_tags`
--

CREATE TABLE IF NOT EXISTS `pb_tags` (
  `tag_id` int(11) NOT NULL,
  `tag` varchar(200) NOT NULL,
  `count` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pb_tags`
--

INSERT INTO `pb_tags` (`tag_id`, `tag`, `count`) VALUES
(1, 'hats', '1'),
(2, 'style', '1'),
(3, 'mens', '1'),
(4, 'apparel', '1'),
(5, 'textbooks', '1'),
(6, ' science', '1'),
(7, ' history', '1'),
(8, 'snacks', '1'),
(9, 'food', '1'),
(10, 'tech', '1'),
(11, 'camera', '1'),
(12, 'photography', '1'),
(13, 'phone', '2'),
(14, 'iphone', '2'),
(15, 'k-cups', '1'),
(16, 'coffee', '1'),
(17, 'drink', '1'),
(18, 'faq', '1'),
(19, 'pccbay', '2'),
(20, 'help', '1'),
(21, 'prodigy', '1'),
(22, 'fine arts', '1'),
(23, 'ethan bortnick', '1'),
(24, 'lorem', '1'),
(25, 'ipsum', '1'),
(26, 'macbook pro', '1'),
(27, 'laptop', '1'),
(28, 'computer', '1'),
(29, 'mac', '1'),
(30, 'apple', '2');

-- --------------------------------------------------------

--
-- Table structure for table `pb_users`
--

CREATE TABLE IF NOT EXISTS `pb_users` (
  `user_id` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `num_of_ratings` int(11) NOT NULL,
  `total_ratings` int(11) NOT NULL,
  `permissions` int(11) NOT NULL,
  `id_card_key` varchar(255) NOT NULL,
  `contact_info` varchar(1024) NOT NULL,
  `user_data` varchar(1024) NOT NULL,
  `steps` varchar(1024) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pb_users`
--

INSERT INTO `pb_users` (`user_id`, `username`, `num_of_ratings`, `total_ratings`, `permissions`, `id_card_key`, `contact_info`, `user_data`, `steps`) VALUES
('100006044469574', 'JoshFerguson', 0, 0, 100, '124981', '[{"resident":"false","building":"","room":"","phone":"850 281-9161","email":"josh@inspirosity.net","notify_d":"true","notify_m":"true"}]', '[{"ID":"100006044469574","username":"JoshFerguson","name":"Josh Ferguson","avatar":"https://scontent-atl3-1.xx.fbcdn.net/hphotos-xpl1/t31.0-8/11228039_1686546648223468_7048846777877974576_o.jpg","registered":"10/20/2015","permissions":"100","theme":"darkblue","interest":"Design,Graphics,Advertising,Textbooks,Pensacola FL"}]', ''),
('100001056120276', 'joseph.gengarella', 0, 0, 100, '', '[{"resident":"true","building":"Coberly","room":"555","phone":"555-888-999","email":"","notify_d":"true","notify_m":"true"}]', '[{"ID":"100001056120276","username":"joseph.gengarella","name":"Joseph Gengarella","avatar":"https://scontent-iad3-1.xx.fbcdn.net/hphotos-xlp1/v/t1.0-9/10403522_878791748832688_1007985923560409411_n.jpg?oh=08d6efbe0cbea75280afdf0895ede224&oe=56B3F054","registered":"10/27/2015","permissions":"100","theme":"darkgreen","interest":""}]', ''),
('10000607254332', 'SteveJobs', 0, 0, 25, '000000', '[{"resident":"true","building":"Young","room":"345","phone":"(555) 555-5555","email":"TestUser@email.com","notify_d":"false","notify_m":"false"}]', '[{"ID":"10000607254332","username":"SteveJobs","name":"Steve Jobs","avatar":"https://image.freepik.com/free-vector/steve-jobs-vector-tribute_25-14787.jpg","registered":"10/01/2015","permissions":"100","theme":"blue","interest":""}]', ''),
('9286529385629835', 'testuaer1', 0, 0, 25, '12345678', '', '[{"ID":"9286529385629835","username":"testuaer1","name":"Test User one","avatar":"/images/test-images/baby.jpg","registered":"10/20/2015","permissions":"100","theme":"darkblue","interest":"Design,Graphics,Advertising,Textbooks,Pensacola FL"}]', ''),
('1982418468126194826', 'TestUser2', 0, 0, 50, '98765431', '', '[{"ID":"1982418468126194826","username":"TestUser2","name":"Test User Two","avatar":"/images/test-images/man.jpg","registered":"10/20/2015","permissions":"100","theme":"darkblue","interest":"Design,Graphics,Advertising,Textbooks,Pensacola FL"}]', '');

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
-- Indexes for table `pb_developers`
--
ALTER TABLE `pb_developers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pb_notify`
--
ALTER TABLE `pb_notify`
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
-- Indexes for table `pb_services`
--
ALTER TABLE `pb_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pb_short_url`
--
ALTER TABLE `pb_short_url`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pb_tags`
--
ALTER TABLE `pb_tags`
  ADD PRIMARY KEY (`tag_id`);

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
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `pb_developers`
--
ALTER TABLE `pb_developers`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pb_notify`
--
ALTER TABLE `pb_notify`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `pb_post`
--
ALTER TABLE `pb_post`
  MODIFY `product_id` int(200) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `pb_safe_image`
--
ALTER TABLE `pb_safe_image`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT for table `pb_services`
--
ALTER TABLE `pb_services`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `pb_short_url`
--
ALTER TABLE `pb_short_url`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pb_tags`
--
ALTER TABLE `pb_tags`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `pb_user_points`
--
ALTER TABLE `pb_user_points`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 08, 2024 at 01:14 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `travel_booking_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
CREATE TABLE IF NOT EXISTS `bookings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userid` int NOT NULL,
  `travelid` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `city` text NOT NULL,
  `state` int NOT NULL,
  `zipcode` int NOT NULL,
  `seats` int NOT NULL,
  `status` int NOT NULL,
  `timecreated` int NOT NULL,
  `timemodified` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `userid`, `travelid`, `name`, `phone`, `email`, `address`, `city`, `state`, `zipcode`, `seats`, `status`, `timecreated`, `timemodified`) VALUES
(1, 117, 107, 'vijay', 2147483647, '', 'faridabad hariyana', 'faridabad', 8, 123456, 1, 1, 1720441632, 0);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `status` int NOT NULL,
  `timecreated` int NOT NULL,
  `timemodified` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `status`, `timecreated`, `timemodified`) VALUES
(1, 'dfsdf', 1, 1718883444, 0),
(2, 'ps1', 1, 1718883466, 0),
(3, 'international', 1, 1718883482, 0),
(4, 'rwere', 1, 1718883560, 0),
(5, 'ett', 1, 1718883568, 0),
(6, 'sdfsfsdfsfs', 1, 1718883589, 0),
(7, 'dsdfsdf', 1, 1718883650, 0),
(8, 'sdfsd', 1, 1718883769, 0),
(9, 'sdfsdf', 1, 1718883837, 0),
(10, 'rwerw', 1, 1718883854, 0),
(11, 'sdfsddfsgdsgg', 1, 1718883884, 0),
(12, 'wwww', 1, 1718883979, 0),
(13, 'jaguar', 1, 1718884010, 0),
(14, 'alpa', 1, 1718884360, 0),
(15, 'dsdsddf', 1, 1718884450, 0),
(16, 'sdfsdfdsfsdf', 1, 1718884468, 0),
(17, 'ewrwer', 1, 1718884499, 0),
(18, 'sdfsdfrete', 1, 1718884538, 0),
(19, 'rwer', 1, 1718887868, 0),
(20, 'rwerq', 1, 1718887990, 0),
(21, 'rwerwerwerw', 1, 1718888039, 0),
(22, 'iyturty', 1, 1718888066, 0),
(23, 'julait', 1, 1718888109, 0),
(24, 'sdfsdfsdfsdf', 1, 1718888162, 0),
(25, 'oyuiuyiytu', 1, 1718888219, 0),
(26, 'hfdgfdgfdg', 1, 1718888242, 0),
(27, 'hhhfghfg', 1, 1718888329, 0),
(28, 'yiytuytu', 1, 1718888392, 0),
(29, 'uiyuuiytuty', 1, 1718888433, 0),
(30, 'iououiyui', 1, 1718888631, 0),
(31, 'iopuiouiyui', 1, 1718888693, 0),
(32, 'ooooo', 1, 1718974853, 0),
(33, 'saddasd', 1, 1718975387, 0),
(34, 'India', 1, 1719204516, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userid` int NOT NULL,
  `travelid` int NOT NULL,
  `reciept` varchar(100) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `amount` int NOT NULL,
  `currency` char(50) NOT NULL,
  `payment_id` varchar(255) NOT NULL,
  `entity` varchar(100) NOT NULL,
  `attempts` int NOT NULL,
  `status` text NOT NULL,
  `created_at` int NOT NULL,
  `timecreated` int NOT NULL,
  `timemodified` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `userid`, `travelid`, `reciept`, `order_id`, `amount`, `currency`, `payment_id`, `entity`, `attempts`, `status`, `created_at`, `timecreated`, `timemodified`) VALUES
(1, 109, 111, '1720430781668bb0bdc5229', 'order_OW5W3oNqOPW2K8', 47197, 'INR', 'pay_OW5W9zGTlyvMJF', 'order', 0, 'paid', 1720430789, 1720430782, 0),
(2, 109, 106, '1720432695668bb837cea86', 'order_OW63lEcJVKvMjW', 926, 'INR', 'pay_OW63rs69ydkuDi', 'order', 0, 'paid', 1720432703, 1720432697, 0),
(3, 117, 108, '1720434123668bbdcba6194', 'order_OW6SuIdUFCVaWn', 45288, 'INR', '', 'order', 0, 'created', 1720434132, 1720434125, 0),
(4, 117, 106, '1720434231668bbe3771871', 'order_OW6UmNIXFzaeEz', 926, 'INR', '', 'order', 0, 'created', 1720434238, 1720434231, 0),
(5, 117, 110, '1720434312668bbe882b48f', 'order_OW6WCPjYYWzPiT', 9257, 'INR', '', 'order', 0, 'created', 1720434319, 1720434312, 0),
(6, 117, 107, '1720434535668bbf671d7ae', 'order_OW6a7osmzIv9Ss', 9273, 'INR', '', 'order', 0, 'created', 1720434542, 1720434535, 0),
(7, 117, 108, '1720434611668bbfb3e1ea7', 'order_OW6bTevpVSUpMR', 22644, 'INR', '', 'order', 0, 'created', 1720434618, 1720434612, 0),
(8, 117, 111, '1720434718668bc01e9db3e', 'order_OW6dMAB5CzgHIz', 23598, 'INR', '', 'order', 0, 'created', 1720434725, 1720434718, 0),
(9, 117, 107, '1720435205668bc205dde6f', 'order_OW6lwphg53DHs6', 18547, 'INR', '', 'order', 0, 'created', 1720435213, 1720435206, 0),
(10, 117, 107, '1720437626668bcb7a1622f', 'order_OW7SZDevcwEhyd', 9273, 'INR', '', 'order', 0, 'created', 1720437634, 1720437627, 0),
(11, 117, 107, '1720437628668bcb7c0d42b', 'order_OW7SaJxHLa6Jj9', 9273, 'INR', '', 'order', 0, 'created', 1720437635, 1720437628, 0),
(12, 117, 107, '1720438360668bce5850985', 'order_OW7fUfDZ6B7xRI', 9273, 'INR', '', 'order', 0, 'created', 1720438368, 1720438361, 0),
(13, 117, 107, '1720438364668bce5c62e83', 'order_OW7fXhXSseEqud', 9273, 'INR', '', 'order', 0, 'created', 1720438371, 1720438364, 0),
(14, 117, 107, '1720438400668bce80c6778', 'order_OW7gCRA2Z8gtTN', 9273, 'INR', '', 'order', 0, 'created', 1720438408, 1720438401, 0),
(15, 117, 107, '1720438432668bcea052840', 'order_OW7gjwQQ9Q12y2', 9273, 'INR', '', 'order', 0, 'created', 1720438439, 1720438432, 0),
(16, 117, 107, '1720438471668bcec723efc', 'order_OW7hQBh1oMaQfz', 9273, 'INR', '', 'order', 0, 'created', 1720438478, 1720438471, 0),
(17, 117, 107, '1720441325668bd9eda4327', 'order_OW8VhJTkkYFCKn', 9273, 'INR', '', 'order', 0, 'created', 1720441333, 1720441326, 0),
(18, 117, 107, '1720441516668bdaac70f07', 'order_OW8Z2O8rypqgXW', 9273, 'INR', '', 'order', 0, 'created', 1720441523, 1720441516, 0),
(19, 117, 107, '1720441632668bdb201df68', 'order_OW8b4aSU0jkXPa', 9273, 'INR', '', 'order', 0, 'created', 1720441639, 1720441632, 0);

-- --------------------------------------------------------

--
-- Table structure for table `travel`
--

DROP TABLE IF EXISTS `travel`;
CREATE TABLE IF NOT EXISTS `travel` (
  `id` int NOT NULL AUTO_INCREMENT,
  `categoryid` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `image` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `price` int NOT NULL,
  `days` int NOT NULL,
  `status` int NOT NULL,
  `timecreated` int NOT NULL,
  `timemodified` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=113 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `travel`
--

INSERT INTO `travel` (`id`, `categoryid`, `title`, `description`, `image`, `price`, `days`, `status`, `timecreated`, `timemodified`) VALUES
(106, 34, 'Shimla', ' s s sd sdfsd', 'images/106_download (2).jpg', 785, 2, 1, 1719555370, 0),
(107, 34, 'Goa', 'ds sd fsdf sdfsdfsdf sd', 'images/107_images (15).jpg', 7859, 2, 1, 1719555395, 0),
(108, 34, 'Durgapur', 'sdf fsd fsd fsd fsdsdfsdfsdfsdfsdsd  d sd gfd fdg fd gfd fd gfd bd fd gfdgfdgfdg fdg', 'images/108_download (5).png', 19190, 4, 1, 1719566864, 0),
(109, 3, 'Jammu Kashmir', 'sf sfsdfsdfsf', 'images/109_download (2).jpg', 7542, 5, 1, 1719570236, 0),
(110, 34, 'Delhi', 'Filler text is text that shares some characteristics of a real written text, but is random or otherwise generated. It may be used to display a sample of fonts, generate text for testing, or to spoof an e-mail spam filter. Wikipedia', 'images/110_banner2.png', 7845, 4, 1, 1719570405, 1719571078),
(111, 34, 'Dubai', 'Dubai is a city and emirate in the United Arab Emirates known for luxury shopping, ultramodern architecture and a lively nightlife scene. Burj Khalifa, an 828m-tall tower, dominates the skyscraper-filled skyline. At its foot lies Dubai Fountain, with jets and lights choreographed to music.', 'images/111_images (20).jpg', 19999, 2, 1, 1719572398, 0),
(112, 34, 'Singapore', 'Singapore is a sunny, tropical island in Southeast Asia, off the southern tip of the Malay Peninsula. The city-state is 710 square kilometres and inhabited by five million people from four major communities; Chinese (majority), Malay, Indian and Eurasian.', 'images/112_images (21).jpg', 9888, 1, 0, 1719572450, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  `password` varchar(16) NOT NULL,
  `role` char(30) NOT NULL,
  `confirmed` int NOT NULL,
  `suspended` int NOT NULL,
  `timecreated` int NOT NULL,
  `timemodified` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=118 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `role`, `confirmed`, `suspended`, `timecreated`, `timemodified`) VALUES
(94, 'kalu', 'dakiyah567@lisoren.com', 'Admin@1234', 'user', 0, 0, 1718773937, 0),
(106, 'jaani', 'bafeh52418@lisoren.com', 'Admin@12345', 'user', 1, 0, 1718781021, 0),
(109, 'veer', 'benihef493@lisoren.com', 'Admin@123', 'user', 1, 0, 1718782258, 0),
(110, 'savan', 'betotay238@luravell.com', 'Admin@123', 'user', 1, 0, 1718794418, 0),
(111, 'vivek', 'wekoloy907@gawte.com', 'Welcome@1234', 'user', 1, 0, 1718868872, 0),
(112, 'vinay', 'gogom62168@lisoren.com', '', 'user', 0, 0, 1718870050, 0),
(113, 'sonu', 'kivajob516@mposhop.com', 'Admin@123', 'user', 1, 0, 1719484307, 0),
(114, 'dheeraj', 'xobidic798@mposhop.com', 'Login@1234#', 'user', 1, 0, 1719485311, 0),
(117, 'rahul', 'jiwer45902@furnato.com', 'Admin@12', 'user', 1, 0, 1720434004, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

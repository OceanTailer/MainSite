SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
 
 
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
 
--
-- Database: `davaoweb_oceantailer`
--
 
-- --------------------------------------------------------
 
--
-- Table structure for table `admin_settings`
--
 
CREATE TABLE IF NOT EXISTS `admin_settings` (
  `auth_apiLogin` text NOT NULL,
  `auth_apiKey` text NOT NULL,
  `auth_apiSandbox` int(11) NOT NULL,
  `supplier_selFee` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
 
--
-- Dumping data for table `admin_settings`
--
 
INSERT INTO `admin_settings` (`auth_apiLogin`, `auth_apiKey`, `auth_apiSandbox`, `supplier_selFee`) VALUES
('2QusWx9Qh57j', '72wGtYKJ439C3x3K', 1, 5);
 
-- --------------------------------------------------------
 
--
-- Table structure for table `admin_supplier_payment`
--
 
CREATE TABLE IF NOT EXISTS `admin_supplier_payment` (
  `asp_id` int(11) NOT NULL AUTO_INCREMENT,
  `asp_amount` text NOT NULL,
  `u_id` int(11) NOT NULL COMMENT 'supplier id',
  `bnk_id` int(11) NOT NULL,
  `asp_date` text NOT NULL,
  `asp_auth_respond` text NOT NULL,
  `asp_value_send` text NOT NULL,
  `asp_summary` text NOT NULL,
  PRIMARY KEY (`asp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
 
-- --------------------------------------------------------
 
--
-- Table structure for table `bank_account`
--
 
CREATE TABLE IF NOT EXISTS `bank_account` (
  `bnk_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `bnk_owner` text NOT NULL,
  `bnk_name` text NOT NULL,
  `bnk_address` text NOT NULL,
  `bnk_account` text NOT NULL,
  `bnk_id_code` text NOT NULL,
  PRIMARY KEY (`bnk_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;
 
--
-- Dumping data for table `bank_account`
--
 
INSERT INTO `bank_account` (`bnk_id`, `u_id`, `c_id`, `bnk_owner`, `bnk_name`, `bnk_address`, `bnk_account`, `bnk_id_code`) VALUES
(8, 26, 236, 'James Angub', 'BDO, Bajada Branch', '', '1252010570000012', '125200057'),
(10, 42, 174, 'Juan Dodong', 'PBI', '', '1252010570000012', '125200057'),
(11, 43, 236, 'BuyDBest', 'Wells Fargo 24 Garwood Rd. Fairlawn NJ 07410', '', '123456789465135', '1247'),
(12, 44, 236, 'Testing One', 'One Network Bank', 'Davao City', '8985934859898', '1234'),
(13, 45, 174, 'Jan Hendrix', 'Philippine National bank', 'C.M. Recto Davao City. Philippines', '5921084129141153', '412504131');
 
-- --------------------------------------------------------
 
--
-- Table structure for table `billing_address`
--
 
CREATE TABLE IF NOT EXISTS `billing_address` (
  `ba_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `ba_add1` text NOT NULL,
  `ba_add2` text NOT NULL,
  `ba_city` text NOT NULL,
  `ba_province` text NOT NULL,
  `ba_postal` text NOT NULL,
  `ba_phone_num` text NOT NULL,
  `ba_phone_ext` text NOT NULL,
  `ba_isset` text NOT NULL,
  PRIMARY KEY (`ba_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;
 
--
-- Dumping data for table `billing_address`
--
 
INSERT INTO `billing_address` (`ba_id`, `u_id`, `c_id`, `ba_add1`, `ba_add2`, `ba_city`, `ba_province`, `ba_postal`, `ba_phone_num`, `ba_phone_ext`, `ba_isset`) VALUES
(24, 26, 236, 'Sarphil District.', '', 'Davao City', 'Connecticut', '8000', '09222070498', '', '1'),
(25, 27, 236, 'Agdao Davao City', '', 'Davao City', 'Alabama', '8000', '09586578374', '23', '1'),
(26, 28, 236, '12 jsdjsdj st', '', 'Lucena City', 'Alabama', '12345', '7654321234', '123', '1'),
(27, 34, 174, 'Davao City ', 'General Santos City ', 'Davao ', 'Alabama', '8000', '9469477534', '63', '1'),
(28, 27, 174, 'Agdao Davao City', '', 'Davaao City', 'Davao del sur', '8000', '091234359923', '23', '0'),
(30, 40, 174, 'Agdao Disctrict', '', 'Davao', 'Davao del Sur', '8000', '09248858946', '', '1'),
(32, 42, 236, 'Agdao District', '', 'Davao City', 'Idaho', '8000', '09222070498', '63', ''),
(33, 43, 236, '24 Garwood Rd.', '', 'Fairlawn', 'New Jersey', '07410', '2019211630', '', ''),
(34, 44, 236, 'Billing Testing', '', 'Davao City', 'Alabama', '8000', '1243534', '', ''),
(35, 45, 174, 'Davao city', 'Davao City', 'Davao City', 'Alabama', '80000', '0822973789', '12', '');
 
-- --------------------------------------------------------
 
--
-- Table structure for table `brand`
--
 
CREATE TABLE IF NOT EXISTS `brand` (
  `b_id` int(11) NOT NULL AUTO_INCREMENT,
  `m_id` int(11) NOT NULL,
  `b_name` text NOT NULL,
  PRIMARY KEY (`b_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;
 
--
-- Dumping data for table `brand`
--
 
INSERT INTO `brand` (`b_id`, `m_id`, `b_name`) VALUES
(1, 1, 'Galaxy Note 1'),
(2, 2, 'Iphone 5'),
(3, 1, 'Galaxy Note Tab'),
(4, 1, 'Galaxy Tab 2'),
(5, 1, 'Galaxy Tab 3'),
(6, 1, 'Galaxy Tab 4'),
(7, 2, 'Iphone 4s'),
(8, 12, 'Out Reach Star'),
(9, 1, 'Galaxy Brand'),
(10, 29, 'Jordan 8'),
(11, 29, 'Addidas Jordan Series'),
(12, 30, 'Rebook 2013'),
(13, 31, 'Nike Series'),
(14, 32, 'Blackberry 9360'),
(15, 0, 'dolly wink'),
(16, 0, 'etude'),
(18, 0, 'Johnson''s baby'),
(19, 0, 'JOHNSON''S? HEAD-TO-TOE? Baby Wash'),
(20, 0, 'JOHNSON''S? HEAD-TO-TOE? Baby Washsa'),
(21, 0, 'California Baby Bubble Bath Aromatherapy, Chamomile & Herbs'),
(22, 1, 'Samsung S4'),
(23, 40, 'Hamilton Beach 12-Cup Coffeemaker'),
(24, 40, 'Hamilton Beach 25475 Breakfast Sandwich Maker'),
(25, 0, 'Sylvania SW-086 Nonstick Omelet Maker'),
(26, 0, 'Safavieh Carrie Storage Side Table w/ 2 Wicker Baskets'),
(27, 0, 'Winsome Omaha Storage Rack with Foldable Basket'),
(28, 44, 'Altra Furniture Storage Unit with 5 Baskets'),
(29, 45, 'Tommy Hilfiger Pillow Case and Print Sheet Set'),
(30, 46, 'Calvin Klein Home Bamboo Flower King Comforter, Hyacinth'),
(31, 47, 'Disney''s Mickey Mouse Bath Rug 25.5" X 27"'),
(32, 49, 'Lasko 755320 Ceramic Tower Heater with Digital Display and Remote Control'),
(33, 50, 'Garden Creations JB5629 Solar-Powered LED Accent Light, Set of 8'),
(34, 51, 'Dyson Home Cleaning Kit'),
(35, 52, 'Allied 49030 180-Piece Home Maintenance Tool Set'),
(36, 53, 'Power Saw - Pumpkin Carving Tool'),
(37, 54, 'Bosch DDB180-02 18-Volt Lithium-Ion 3/8-Inch Cordless Drill/Driver Kit with 2 Batteries, Charger and Case'),
(38, 56, 'GE 13W (60W Equivalent) Energy SmartTM Light Bulbs'),
(39, 57, 'Smart Solar 3782WRM2 Black Umbrella Hanging Solar Lantern, 2-Pack'),
(40, 58, 'Yards & Beyond Dual Use Coach Style Solar Lights - 2 Pack'),
(41, 59, 'BriteLeafs 4-in-1 Electric Facial & Body Brush Spa Cleaning System (BL-802)'),
(42, 60, 'St. Ives Facial Moisturizer, Timeless Skin Collagen Elastin'),
(43, 61, 'My Beauty Diary Mask- Aloe (10 pcs)'),
(44, 62, 'stila Stay All Day 10-in-1 HD Beauty Balm, 1.5 fl. oz.'),
(45, 63, 'BURBERRY Body Milk, 85 ml.'),
(46, 0, 'Jack Black Industrial Strength Hand Healer'),
(47, 65, 'SpongeBob SquarePants: It''s A SpongeBob Christmas'),
(48, 66, 'Nescafe Dolce Gusto for Nescafe Dolce Gusto Brewers, Skinny Cappuccino, '),
(49, 67, 'Nature Valley Chewy Yogurt Granola Bars, 6 Count Box'),
(50, 68, 'dsafdasfas'),
(51, 0, 'Lego Games');
 
-- --------------------------------------------------------
 
--
-- Table structure for table `buyer_supplier_detail`
--
 
CREATE TABLE IF NOT EXISTS `buyer_supplier_detail` (
  `bsd_id` int(11) NOT NULL AUTO_INCREMENT,
  `bt_id` int(11) NOT NULL,
  `u_supplier` int(11) NOT NULL,
  `u_buyer` int(11) NOT NULL,
  `bsd_total_item` float NOT NULL,
  `bsd_total_paymet` float NOT NULL,
  `bsd_trans_id` text NOT NULL,
  `bsd_correlation_id` text NOT NULL,
  `bsd_ccv2match` text NOT NULL,
  `bsd_ack` text NOT NULL,
  `bsd_timestamp` text NOT NULL,
  `bsd_status` text NOT NULL,
  `bsd_reason` text NOT NULL,
  `bsd_is_feedback` int(11) NOT NULL,
  `bsd_buyer_rate` float NOT NULL,
  `bsd_buyer_feedback` text NOT NULL,
  `bsd_feedback_date` text NOT NULL,
  `bsd_memo` text NOT NULL,
  PRIMARY KEY (`bsd_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
 
-- --------------------------------------------------------
 
--
-- Table structure for table `buyer_supplier_message`
--
 
CREATE TABLE IF NOT EXISTS `buyer_supplier_message` (
  `bsm_id` int(11) NOT NULL AUTO_INCREMENT,
  `bsd_id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `sender_type` text NOT NULL,
  `bsm_subject` text NOT NULL,
  `bsm_message` text NOT NULL,
  `bsm_reason` text NOT NULL,
  `bsm_time` text NOT NULL,
  `bsm_supplier_read` int(11) NOT NULL,
  `bsm_buyer_read` int(11) NOT NULL,
  `bsm_attachment` text NOT NULL,
  PRIMARY KEY (`bsm_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
 
-- --------------------------------------------------------
 
--
-- Table structure for table `buyer_supplier_reply`
--
 
CREATE TABLE IF NOT EXISTS `buyer_supplier_reply` (
  `bsr_id` int(11) NOT NULL AUTO_INCREMENT,
  `bsm_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `bsr_content` text NOT NULL,
  `bsr_time` text NOT NULL,
  `bsr_attachment` text NOT NULL,
  PRIMARY KEY (`bsr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
 
-- --------------------------------------------------------
 
--
-- Table structure for table `buyer_transaction`
--
 
CREATE TABLE IF NOT EXISTS `buyer_transaction` (
  `bt_id` int(11) NOT NULL AUTO_INCREMENT,
  `bt_invoice` text NOT NULL,
  `u_id` int(11) NOT NULL,
  `ccu_id` int(11) NOT NULL,
  `ba_id` int(11) NOT NULL,
  `bt_type` text NOT NULL,
  `bt_trans_id` text NOT NULL,
  `bt_total_payment` float NOT NULL,
  `bt_total_shipping` float NOT NULL,
  `bt_total_item` int(11) NOT NULL,
  `bt_timestamp` text NOT NULL,
  `bt_correlation_id` text NOT NULL,
  `bt_ccv2match` text NOT NULL,
  `bt_ack` text NOT NULL,
  `bt_status` text NOT NULL,
  `bt_time` text NOT NULL,
  `bt_time_payed` text NOT NULL,
  `bt_is_sameBilling_to_ship` int(11) NOT NULL,
  PRIMARY KEY (`bt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
 
-- --------------------------------------------------------
 
--
-- Table structure for table `buyer_transaction_detail`
--
 
CREATE TABLE IF NOT EXISTS `buyer_transaction_detail` (
  `btd_id` int(11) NOT NULL AUTO_INCREMENT,
  `bt_id` int(11) NOT NULL,
  `ic_id` int(11) NOT NULL,
  `btd_quan` int(11) NOT NULL,
  `btd_amount` float NOT NULL,
  `btd_shipamount` float NOT NULL,
  `btd_subamount` float NOT NULL,
  `btd_shipped_stat` int(11) NOT NULL,
  `btd_productFee` float NOT NULL,
  PRIMARY KEY (`btd_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
 
-- --------------------------------------------------------
 
--
-- Table structure for table `buyer_transaction_ship`
--
 
CREATE TABLE IF NOT EXISTS `buyer_transaction_ship` (
  `bts_id` int(11) NOT NULL AUTO_INCREMENT,
  `bt_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `bts_name` text NOT NULL,
  `bts_add1` text NOT NULL,
  `bts_add2` text NOT NULL,
  `bts_city` text NOT NULL,
  `bts_prov` text NOT NULL,
  `bts_postal` text NOT NULL,
  `bts_phone_num` text NOT NULL,
  `bts_phone_ext` text NOT NULL,
  PRIMARY KEY (`bts_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
 
-- --------------------------------------------------------
 
--
-- Table structure for table `category`
--
 
CREATE TABLE IF NOT EXISTS `category` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_name` text NOT NULL,
  `c_default` int(11) NOT NULL,
  `c_parent` int(11) NOT NULL DEFAULT '0',
  `c_level` int(11) NOT NULL DEFAULT '0',
  `c_link` text NOT NULL,
  `c_feePercent` float NOT NULL,
  `c_default_image` text NOT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=223 ;
 
--
-- Dumping data for table `category`
--
 
INSERT INTO `category` (`c_id`, `c_name`, `c_default`, `c_parent`, `c_level`, `c_link`, `c_feePercent`, `c_default_image`) VALUES
(56, 'Home & Kitchen', 0, 0, 0, 'home-&-kitchen', 6, 'http://betaoceantailer.spottyme.com/categories/home.jpg'),
(57, 'Beauty & Health', 0, 0, 0, 'beauty-&-health', 2, 'http://betaoceantailer.spottyme.com/categories/beauty.jpg'),
(58, 'Electronics', 0, 0, 0, 'electronics', 4, 'http://betaoceantailer.spottyme.com/categories/electronic1.jpg'),
(59, 'Sports & Outdoors', 0, 0, 0, 'sports-outdoors', 3, 'http://betaoceantailer.spottyme.com/categories/sports.jpg'),
(60, 'Pets', 0, 0, 0, 'pets', 4, 'http://betaoceantailer.spottyme.com/categories/pets.jpg'),
(62, 'Home & Garden', 0, 56, 1, 'home-and-garden', 4, 'http://betaoceantailer.spottyme.com/categories/garden.jpg'),
(68, 'Hardwares', 0, 56, 1, 'men-shoes', 0, 'http://betaoceantailer.spottyme.com/categories/tools_and_hardwares.jpg'),
(77, 'Toys & Games', 0, 0, 0, 'toys-&-games', 6, 'http://betaoceantailer.spottyme.com/categories/games.jpg'),
(78, 'Beauty', 0, 57, 1, 'health', 4, 'http://betaoceantailer.spottyme.com/categories/health.jpg'),
(79, 'Healthy Grocery', 0, 57, 1, 'healthy-grocery', 2, 'http://betaoceantailer.spottyme.com/categories/healthy_grocery.jpg'),
(80, 'Gadgets', 0, 58, 1, 'gadgets', 2, 'http://betaoceantailer.spottyme.com/categories/gadeget.jpg'),
(82, 'Computers', 0, 58, 1, 'computers', 2, 'http://betaoceantailer.spottyme.com/categories/computer.jpg'),
(83, 'Indoor', 0, 59, 1, 'indoor', 2, 'http://betaoceantailer.spottyme.com/categories/indoor.jpg'),
(84, 'Outdoor', 0, 59, 1, 'outdoor', 4, 'http://betaoceantailer.spottyme.com/categories/outdoors.jpg'),
(90, 'Baby', 0, 77, 1, 'baby', 2, 'http://betaoceantailer.spottyme.com/categories/baby_toys.jpg'),
(91, 'Kids', 0, 77, 1, 'kids-toys-and-games', 3, 'http://betaoceantailer.spottyme.com/categories/kid_toys.jpg'),
(93, 'Kitchen & Dining', 0, 62, 2, 'kitchen-&-dining', 1, ''),
(94, 'Furniture & Decor', 0, 62, 2, 'furniture-&-decor', 1, ''),
(96, 'Bedding & Bath', 0, 62, 2, 'bedding-&-bath', 2, ''),
(98, 'Appliances', 0, 62, 2, 'appliances', 2, ''),
(99, 'Lawn & Garden', 0, 62, 2, 'lawn-&-garden', 1, ''),
(100, 'Fine Arts', 0, 62, 2, 'fine-arts', 1, ''),
(101, 'Home Improvement', 0, 68, 2, 'home-improvement', 1, ''),
(102, 'Power & Hand tools', 0, 68, 2, 'power-&-hand-tools', 1, ''),
(103, 'Facial', 0, 78, 2, 'facial', 1, ''),
(104, 'Luxury Beauty', 0, 78, 2, 'luxury-beauty', 1, ''),
(105, 'Men''s Grooming', 0, 78, 2, 'men''s-grooming', 1, ''),
(106, 'Baby Care', 0, 78, 2, 'baby-care', 1, ''),
(107, 'Health, household & Baby Care', 0, 78, 2, 'health-household-&-baby-care', 1, ''),
(108, 'Grocery & Gourment Food', 0, 79, 2, 'grocery-&-gourment-food', 1, ''),
(109, 'Natural & Organic', 0, 79, 2, 'natural-&-organic', 1, ''),
(110, 'Wine', 0, 79, 2, 'wine', 1, ''),
(111, 'TV & Video', 0, 80, 2, 'tv-&-video', 0, ''),
(112, 'Home Audio & Theater', 0, 80, 2, 'home-audio-&-theater', 1, ''),
(113, 'Camera, Photo & Video', 0, 80, 2, 'camera-photo-&-video', 1, ''),
(115, 'MP3 Playes & Accessories', 0, 80, 2, 'mp3-playes-&-accessories', 1, ''),
(116, 'Car Electronics & GPS', 0, 80, 2, 'car-electronics-&-gps', 1, ''),
(117, 'Musical Instruments', 0, 80, 2, 'musical-instruments', 1, ''),
(118, 'Electronics Accessories', 0, 80, 2, 'electronics-accessories', 1, ''),
(119, 'Trade In Electronics', 0, 80, 2, 'trade-in-electronics', 1, ''),
(125, 'Laptops & Tablets', 0, 82, 2, 'laptops-&-tablets', 1, ''),
(126, 'Desktops & Monitors', 0, 82, 2, 'desktops-&-monitors', 1, ''),
(127, 'Computer Accessories', 0, 82, 2, 'computer-accessories', 1, ''),
(128, 'Computer Parts & Components', 0, 82, 2, 'computer-parts-&-components', 1, ''),
(129, 'Software', 0, 82, 2, 'software', 1, ''),
(130, 'PC Games', 0, 82, 2, 'pc-games', 1, ''),
(131, 'Printer & Ink', 0, 82, 2, 'printer-&-ink', 1, ''),
(133, 'Exercise & Fitness', 0, 83, 2, 'exercise-&-fitness', 1, ''),
(134, 'Equipments', 0, 83, 2, 'equipments', 1, ''),
(135, 'Athletic Clothing', 0, 83, 2, 'athletic-clothing', 1, ''),
(136, 'Outdoor Clothing', 0, 84, 2, 'outdoor-clothing', 1, ''),
(137, 'Hunting', 0, 84, 2, 'hunting', 1, ''),
(138, 'Fishing', 0, 84, 2, 'fishing', 1, ''),
(139, 'Climbing', 0, 84, 2, 'climbing', 1, ''),
(140, 'Scuba Diving', 0, 84, 2, 'scuba-diving', 1, ''),
(141, 'Surfing', 0, 84, 2, 'surfing', 1, ''),
(142, 'Cycling', 0, 84, 2, 'cycling', 1, ''),
(166, 'Baby Toys', 0, 90, 2, 'baby-toys', 1, ''),
(167, 'Baby Games', 0, 90, 2, 'baby-games', 1, ''),
(168, 'Baby Clothing', 0, 90, 2, 'baby-clothing', 1, ''),
(169, 'Kids Clothing', 0, 91, 2, 'kids-clothing', 1, ''),
(170, 'Kids Games', 0, 91, 2, 'kids-games', 1, ''),
(171, 'Kids Video Games & Toys', 0, 91, 2, 'kids-video-games-&-toys', 1, ''),
(174, 'Art, Craft & Sewing', 0, 62, 2, 'art,-craft-&-sewing', 1, ''),
(175, 'Lamps & Light Fixtures', 0, 68, 2, 'lamps-&-light-fixtures', 4, ''),
(176, 'Kitchen & Bath Fixtures', 0, 68, 2, 'kitchen-&-bath-fixtures', 2, ''),
(177, 'Hardware', 0, 68, 2, 'hardware', 1, ''),
(178, 'Home Automation', 0, 68, 2, 'home-automation', 2, ''),
(179, 'OceantailerFresh', 0, 79, 2, 'oceantailerfresh', 1, ''),
(180, 'Video Games', 0, 80, 2, 'video-games', 2, ''),
(181, 'Cell Phones & Accessories', 0, 80, 2, 'cell-phones-&-accessories', 1, ''),
(182, 'Appliances', 0, 80, 2, 'appliances', 3, ''),
(183, 'Office & School Supplies', 0, 82, 2, 'office-&-school-supplies', 2, ''),
(184, 'Indoor Accessories', 0, 83, 2, 'indoor-accessories', 1, ''),
(185, 'Outdoor Accessories', 0, 84, 2, 'outdoor-accessories', 2, ''),
(186, 'Dogs', 0, 60, 1, 'dogs', 1, 'http://betaoceantailer.spottyme.com/categories/domestic1.jpg'),
(187, 'Cats', 0, 60, 1, 'cats', 1, 'http://betaoceantailer.spottyme.com/categories/miming.jpg'),
(188, 'Fish & Aquatic Pets', 0, 60, 1, 'fish-&-aquatic-pets', 1, 'http://betaoceantailer.spottyme.com/categories/fifish.jpg'),
(189, 'Small Animals', 0, 60, 1, 'small-animals', 1, 'http://betaoceantailer.spottyme.com/categories/rarat.jpg'),
(190, 'Birds', 0, 60, 1, 'birds', 1, ''),
(191, 'Reptiles and Amphibians', 0, 60, 1, 'reptiles-and-amphibians', 1, ''),
(192, 'Food', 0, 186, 2, 'food', 1, ''),
(193, 'Toys', 0, 186, 2, 'toys', 1, ''),
(194, 'Apparel', 0, 186, 2, 'apparel', 1, ''),
(195, 'Treats', 0, 186, 2, 'treats', 1, ''),
(196, 'Training', 0, 186, 2, 'training', 1, ''),
(197, 'Food', 0, 187, 2, 'food', 1, ''),
(198, 'Toys', 0, 187, 2, 'toys', 1, ''),
(199, 'Apparel', 0, 187, 2, 'apparel', 1, ''),
(200, 'Treats', 0, 187, 2, 'treats', 1, ''),
(201, 'Training', 0, 187, 2, 'training', 1, ''),
(202, 'Food', 0, 188, 2, 'food', 1, ''),
(203, 'Toys', 0, 188, 2, 'toys', 1, ''),
(204, 'Apparel', 0, 188, 2, 'apparel', 1, ''),
(205, 'Treats', 0, 188, 2, 'treats', 1, ''),
(206, 'Training', 0, 188, 2, 'training', 1, ''),
(207, 'Food', 0, 189, 2, 'food', 1, ''),
(208, 'Toys', 0, 189, 2, 'toys', 1, ''),
(209, 'Apparel', 0, 189, 2, 'apparel', 1, ''),
(210, 'Treats', 0, 189, 2, 'treats', 1, ''),
(211, 'Training', 0, 189, 2, 'training', 1, ''),
(212, 'Toys', 0, 190, 2, 'toys', 1, ''),
(213, 'Apparel', 0, 190, 2, 'apparel', 1, ''),
(214, 'Treats', 0, 190, 2, 'treats', 1, ''),
(215, 'Training', 0, 190, 2, 'training', 1, ''),
(216, 'Food', 0, 191, 2, 'food', 1, ''),
(217, 'Toys', 0, 191, 2, 'toys', 1, ''),
(218, 'Apparel', 0, 191, 2, 'apparel', 1, ''),
(219, 'Treats', 0, 191, 2, 'treats', 1, ''),
(220, 'Training', 0, 191, 2, 'training', 1, ''),
(221, '', 0, 56, 1, '', 0, ''),
(222, '', 0, 56, 1, '', 0, '');
 
-- --------------------------------------------------------
 
--
-- Table structure for table `config`
--
 
CREATE TABLE IF NOT EXISTS `config` (
  `config_name` varchar(255) NOT NULL,
  `config_value` longtext NOT NULL,
  `site_id` int(11) unsigned NOT NULL,
  KEY `site_id` (`site_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
 
--
-- Dumping data for table `config`
--
 
INSERT INTO `config` (`config_name`, `config_value`, `site_id`) VALUES
('domain', 'betaoceantailer.davaowebjobs.com', 1),
('script_path', '/ticket', 1),
('https', '0', 1),
('port_number', '80', 1),
('name', 'Oceantailer', 1),
('cookie_name', 'sts', 1),
('encryption_key', '8yG0QKMzvXAkqwaMiy5HZJon5k9Vd07R', 1),
('database_version', '18', 1),
('program_version', '2.5', 1),
('ad_server', '', 1),
('ad_account_suffix', '', 1),
('ad_base_dn', '', 1),
('ad_create_accounts', '0', 1),
('ad_enabled', '0', 1),
('lockout_enabled', '1', 1),
('login_message', '', 1),
('cron_intervals', 'a:7:{i:0;a:4:{s:4:"name";s:17:"every_two_minutes";s:11:"description";s:17:"Every Two Minutes";s:8:"next_run";s:19:"0000-00-00 00:00:00";s:9:"frequency";s:3:"120";}i:1;a:4:{s:4:"name";s:18:"every_five_minutes";s:11:"description";s:18:"Every Five Minutes";s:8:"next_run";s:19:"0000-00-00 00:00:00";s:9:"frequency";s:3:"300";}i:2;a:4:{s:4:"name";s:21:"every_fifteen_minutes";s:11:"description";s:21:"Every Fifteen Minutes";s:8:"next_run";s:19:"0000-00-00 00:00:00";s:9:"frequency";s:3:"900";}i:3;a:4:{s:4:"name";s:10:"every_hour";s:11:"description";s:10:"Every Hour";s:8:"next_run";s:19:"0000-00-00 00:00:00";s:9:"frequency";s:4:"3600";}i:4;a:4:{s:4:"name";s:9:"every_day";s:11:"description";s:9:"Every Day";s:8:"next_run";s:19:"0000-00-00 00:00:00";s:9:"frequency";s:5:"86400";}i:5;a:4:{s:4:"name";s:10:"every_week";s:11:"description";s:10:"Every Week";s:8:"next_run";s:19:"0000-00-00 00:00:00";s:9:"frequency";s:6:"604800";}i:6;a:4:{s:4:"name";s:11:"every_month";s:11:"description";s:11:"Every Month";s:8:"next_run";s:19:"0000-00-00 00:00:00";s:9:"frequency";s:7:"2592000";}}', 1),
('last_update_response', '', 1),
('gravatar_enabled', '1', 1),
('registration_enabled', '0', 1),
('storage_enabled', '0', 1),
('storage_path', '', 1),
('html_enabled', '1', 1),
('default_department', '1', 1),
('plugin_data', 'a:1:{i:0;s:13:"forums/forums";}', 1),
('plugin_update_data', 'a:0:{}', 1),
('anonymous_tickets_reply', '0', 1),
('notification_new_ticket_subject', '#SITE_NAME# - #TICKET_SUBJECT#', 1),
('notification_new_ticket_body', '\n        #TICKET_DESCRIPTION#\n      <br /><br />\n      #TICKET_KEY#\n      <br /><br />\n      #GUEST_URL#', 1),
('notification_new_ticket_note_subject', '#SITE_NAME# - #TICKET_SUBJECT#', 1),
('notification_new_ticket_note_body', '\n       #TICKET_NOTE_DESCRIPTION#\n     <br /><br />\n      #TICKET_KEY#\n      <br /><br />\n      #GUEST_URL#', 1),
('notification_new_user_subject', '#SITE_NAME# - New Account', 1),
('notification_new_user_body', '\n      Hi #USER_FULLNAME#,\n       <br /><br />\n      A user account has been created for you at #SITE_NAME#.\n       <br /><br />\n      URL:        #SITE_ADDRESS#<br />\n        Name:       #USER_FULLNAME#<br />\n       Username:   #USER_NAME#<br />\n       Password:   #USER_PASSWORD#', 1),
('guest_portal', '0', 1),
('guest_portal_index_html', '                                                   ', 1),
('default_language', 'english_aus', 1),
('captcha_enabled', '0', 1),
('default_theme', 'standard', 1),
('default_timezone', 'Australia/Sydney', 1),
('default_smtp_account', '0', 1),
('pushover_enabled', '0', 1),
('pushover_user_enabled', '0', 1),
('pushover_token', '', 1),
('pushover_notify_users', 'a:0:{}', 1),
('license_key', '', 1),
('log_limit', '100000', 1),
('forums_version', '1', 1),
('forums_installed', '1', 1);
 
-- --------------------------------------------------------
 
--
-- Table structure for table `country`
--
 
CREATE TABLE IF NOT EXISTS `country` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_code` text NOT NULL,
  `c_name` text NOT NULL,
  `c_long_name` text NOT NULL,
  `c_iso3` text NOT NULL,
  `c_numcode` text NOT NULL,
  `c_un_member` text NOT NULL,
  `c_calling_code` text NOT NULL,
  `c_ctld` text NOT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=251 ;
 
--
-- Dumping data for table `country`
--
 
INSERT INTO `country` (`c_id`, `c_code`, `c_name`, `c_long_name`, `c_iso3`, `c_numcode`, `c_un_member`, `c_calling_code`, `c_ctld`) VALUES
(1, 'AF', 'Afghanistan', 'Islamic Republic of Afghanistan', 'AFG', '004', 'yes', '93', '.af'),
(2, 'AX', 'Aland Islands', '&Aring;land Islands', 'ALA', '248', 'no', '358', '.ax'),
(3, 'AL', 'Albania', 'Republic of Albania', 'ALB', '008', 'yes', '355', '.al'),
(4, 'DZ', 'Algeria', 'People''s Democratic Republic of Algeria', 'DZA', '012', 'yes', '213', '.dz'),
(5, 'AS', 'American Samoa', 'American Samoa', 'ASM', '016', 'no', '1+684', '.as'),
(6, 'AD', 'Andorra', 'Principality of Andorra', 'AND', '020', 'yes', '376', '.ad'),
(7, 'AO', 'Angola', 'Republic of Angola', 'AGO', '024', 'yes', '244', '.ao'),
(8, 'AI', 'Anguilla', 'Anguilla', 'AIA', '660', 'no', '1+264', '.ai'),
(9, 'AQ', 'Antarctica', 'Antarctica', 'ATA', '010', 'no', '672', '.aq'),
(10, 'AG', 'Antigua and Barbuda', 'Antigua and Barbuda', 'ATG', '028', 'yes', '1+268', '.ag'),
(11, 'AR', 'Argentina', 'Argentine Republic', 'ARG', '032', 'yes', '54', '.ar'),
(12, 'AM', 'Armenia', 'Republic of Armenia', 'ARM', '051', 'yes', '374', '.am'),
(13, 'AW', 'Aruba', 'Aruba', 'ABW', '533', 'no', '297', '.aw'),
(14, 'AU', 'Australia', 'Commonwealth of Australia', 'AUS', '036', 'yes', '61', '.au'),
(15, 'AT', 'Austria', 'Republic of Austria', 'AUT', '040', 'yes', '43', '.at'),
(16, 'AZ', 'Azerbaijan', 'Republic of Azerbaijan', 'AZE', '031', 'yes', '994', '.az'),
(17, 'BS', 'Bahamas', 'Commonwealth of The Bahamas', 'BHS', '044', 'yes', '1+242', '.bs'),
(18, 'BH', 'Bahrain', 'Kingdom of Bahrain', 'BHR', '048', 'yes', '973', '.bh'),
(19, 'BD', 'Bangladesh', 'People''s Republic of Bangladesh', 'BGD', '050', 'yes', '880', '.bd'),
(20, 'BB', 'Barbados', 'Barbados', 'BRB', '052', 'yes', '1+246', '.bb'),
(21, 'BY', 'Belarus', 'Republic of Belarus', 'BLR', '112', 'yes', '375', '.by'),
(22, 'BE', 'Belgium', 'Kingdom of Belgium', 'BEL', '056', 'yes', '32', '.be'),
(23, 'BZ', 'Belize', 'Belize', 'BLZ', '084', 'yes', '501', '.bz'),
(24, 'BJ', 'Benin', 'Republic of Benin', 'BEN', '204', 'yes', '229', '.bj'),
(25, 'BM', 'Bermuda', 'Bermuda Islands', 'BMU', '060', 'no', '1+441', '.bm'),
(26, 'BT', 'Bhutan', 'Kingdom of Bhutan', 'BTN', '064', 'yes', '975', '.bt'),
(27, 'BO', 'Bolivia', 'Plurinational State of Bolivia', 'BOL', '068', 'yes', '591', '.bo'),
(28, 'BQ', 'Bonaire, Sint Eustatius and Saba', 'Bonaire, Sint Eustatius and Saba', 'BES', '535', 'no', '599', '.bq'),
(29, 'BA', 'Bosnia and Herzegovina', 'Bosnia and Herzegovina', 'BIH', '070', 'yes', '387', '.ba'),
(30, 'BW', 'Botswana', 'Republic of Botswana', 'BWA', '072', 'yes', '267', '.bw'),
(31, 'BV', 'Bouvet Island', 'Bouvet Island', 'BVT', '074', 'no', 'NONE', '.bv'),
(32, 'BR', 'Brazil', 'Federative Republic of Brazil', 'BRA', '076', 'yes', '55', '.br'),
(33, 'IO', 'British Indian Ocean Territory', 'British Indian Ocean Territory', 'IOT', '086', 'no', '246', '.io'),
(34, 'BN', 'Brunei', 'Brunei Darussalam', 'BRN', '096', 'yes', '673', '.bn'),
(35, 'BG', 'Bulgaria', 'Republic of Bulgaria', 'BGR', '100', 'yes', '359', '.bg'),
(36, 'BF', 'Burkina Faso', 'Burkina Faso', 'BFA', '854', 'yes', '226', '.bf'),
(37, 'BI', 'Burundi', 'Republic of Burundi', 'BDI', '108', 'yes', '257', '.bi'),
(38, 'KH', 'Cambodia', 'Kingdom of Cambodia', 'KHM', '116', 'yes', '855', '.kh'),
(39, 'CM', 'Cameroon', 'Republic of Cameroon', 'CMR', '120', 'yes', '237', '.cm'),
(40, 'CA', 'Canada', 'Canada', 'CAN', '124', 'yes', '1', '.ca'),
(41, 'CV', 'Cape Verde', 'Republic of Cape Verde', 'CPV', '132', 'yes', '238', '.cv'),
(42, 'KY', 'Cayman Islands', 'The Cayman Islands', 'CYM', '136', 'no', '1+345', '.ky'),
(43, 'CF', 'Central African Republic', 'Central African Republic', 'CAF', '140', 'yes', '236', '.cf'),
(44, 'TD', 'Chad', 'Republic of Chad', 'TCD', '148', 'yes', '235', '.td'),
(45, 'CL', 'Chile', 'Republic of Chile', 'CHL', '152', 'yes', '56', '.cl'),
(46, 'CN', 'China', 'People''s Republic of China', 'CHN', '156', 'yes', '86', '.cn'),
(47, 'CX', 'Christmas Island', 'Christmas Island', 'CXR', '162', 'no', '61', '.cx'),
(48, 'CC', 'Cocos (Keeling) Islands', 'Cocos (Keeling) Islands', 'CCK', '166', 'no', '61', '.cc'),
(49, 'CO', 'Colombia', 'Republic of Colombia', 'COL', '170', 'yes', '57', '.co'),
(50, 'KM', 'Comoros', 'Union of the Comoros', 'COM', '174', 'yes', '269', '.km'),
(51, 'CG', 'Congo', 'Republic of the Congo', 'COG', '178', 'yes', '242', '.cg'),
(52, 'CK', 'Cook Islands', 'Cook Islands', 'COK', '184', 'some', '682', '.ck'),
(53, 'CR', 'Costa Rica', 'Republic of Costa Rica', 'CRI', '188', 'yes', '506', '.cr'),
(54, 'CI', 'Cote d''ivoire (Ivory Coast)', 'Republic of C&ocirc;te D''Ivoire (Ivory Coast)', 'CIV', '384', 'yes', '225', '.ci'),
(55, 'HR', 'Croatia', 'Republic of Croatia', 'HRV', '191', 'yes', '385', '.hr'),
(56, 'CU', 'Cuba', 'Republic of Cuba', 'CUB', '192', 'yes', '53', '.cu'),
(57, 'CW', 'Curacao', 'Cura&ccedil;ao', 'CUW', '531', 'no', '599', '.cw'),
(58, 'CY', 'Cyprus', 'Republic of Cyprus', 'CYP', '196', 'yes', '357', '.cy'),
(59, 'CZ', 'Czech Republic', 'Czech Republic', 'CZE', '203', 'yes', '420', '.cz'),
(60, 'CD', 'Democratic Republic of the Congo', 'Democratic Republic of the Congo', 'COD', '180', 'yes', '243', '.cd'),
(61, 'DK', 'Denmark', 'Kingdom of Denmark', 'DNK', '208', 'yes', '45', '.dk'),
(62, 'DJ', 'Djibouti', 'Republic of Djibouti', 'DJI', '262', 'yes', '253', '.dj'),
(63, 'DM', 'Dominica', 'Commonwealth of Dominica', 'DMA', '212', 'yes', '1+767', '.dm'),
(64, 'DO', 'Dominican Republic', 'Dominican Republic', 'DOM', '214', 'yes', '1+809, 8', '.do'),
(65, 'EC', 'Ecuador', 'Republic of Ecuador', 'ECU', '218', 'yes', '593', '.ec'),
(66, 'EG', 'Egypt', 'Arab Republic of Egypt', 'EGY', '818', 'yes', '20', '.eg'),
(67, 'SV', 'El Salvador', 'Republic of El Salvador', 'SLV', '222', 'yes', '503', '.sv'),
(68, 'GQ', 'Equatorial Guinea', 'Republic of Equatorial Guinea', 'GNQ', '226', 'yes', '240', '.gq'),
(69, 'ER', 'Eritrea', 'State of Eritrea', 'ERI', '232', 'yes', '291', '.er'),
(70, 'EE', 'Estonia', 'Republic of Estonia', 'EST', '233', 'yes', '372', '.ee'),
(71, 'ET', 'Ethiopia', 'Federal Democratic Republic of Ethiopia', 'ETH', '231', 'yes', '251', '.et'),
(72, 'FK', 'Falkland Islands (Malvinas)', 'The Falkland Islands (Malvinas)', 'FLK', '238', 'no', '500', '.fk'),
(73, 'FO', 'Faroe Islands', 'The Faroe Islands', 'FRO', '234', 'no', '298', '.fo'),
(74, 'FJ', 'Fiji', 'Republic of Fiji', 'FJI', '242', 'yes', '679', '.fj'),
(75, 'FI', 'Finland', 'Republic of Finland', 'FIN', '246', 'yes', '358', '.fi'),
(76, 'FR', 'France', 'French Republic', 'FRA', '250', 'yes', '33', '.fr'),
(77, 'GF', 'French Guiana', 'French Guiana', 'GUF', '254', 'no', '594', '.gf'),
(78, 'PF', 'French Polynesia', 'French Polynesia', 'PYF', '258', 'no', '689', '.pf'),
(79, 'TF', 'French Southern Territories', 'French Southern Territories', 'ATF', '260', 'no', '', '.tf'),
(80, 'GA', 'Gabon', 'Gabonese Republic', 'GAB', '266', 'yes', '241', '.ga'),
(81, 'GM', 'Gambia', 'Republic of The Gambia', 'GMB', '270', 'yes', '220', '.gm'),
(82, 'GE', 'Georgia', 'Georgia', 'GEO', '268', 'yes', '995', '.ge'),
(83, 'DE', 'Germany', 'Federal Republic of Germany', 'DEU', '276', 'yes', '49', '.de'),
(84, 'GH', 'Ghana', 'Republic of Ghana', 'GHA', '288', 'yes', '233', '.gh'),
(85, 'GI', 'Gibraltar', 'Gibraltar', 'GIB', '292', 'no', '350', '.gi'),
(86, 'GR', 'Greece', 'Hellenic Republic', 'GRC', '300', 'yes', '30', '.gr'),
(87, 'GL', 'Greenland', 'Greenland', 'GRL', '304', 'no', '299', '.gl'),
(88, 'GD', 'Grenada', 'Grenada', 'GRD', '308', 'yes', '1+473', '.gd'),
(89, 'GP', 'Guadaloupe', 'Guadeloupe', 'GLP', '312', 'no', '590', '.gp'),
(90, 'GU', 'Guam', 'Guam', 'GUM', '316', 'no', '1+671', '.gu'),
(91, 'GT', 'Guatemala', 'Republic of Guatemala', 'GTM', '320', 'yes', '502', '.gt'),
(92, 'GG', 'Guernsey', 'Guernsey', 'GGY', '831', 'no', '44', '.gg'),
(93, 'GN', 'Guinea', 'Republic of Guinea', 'GIN', '324', 'yes', '224', '.gn'),
(94, 'GW', 'Guinea-Bissau', 'Republic of Guinea-Bissau', 'GNB', '624', 'yes', '245', '.gw'),
(95, 'GY', 'Guyana', 'Co-operative Republic of Guyana', 'GUY', '328', 'yes', '592', '.gy'),
(96, 'HT', 'Haiti', 'Republic of Haiti', 'HTI', '332', 'yes', '509', '.ht'),
(97, 'HM', 'Heard Island and McDonald Islands', 'Heard Island and McDonald Islands', 'HMD', '334', 'no', 'NONE', '.hm'),
(98, 'HN', 'Honduras', 'Republic of Honduras', 'HND', '340', 'yes', '504', '.hn'),
(99, 'HK', 'Hong Kong', 'Hong Kong', 'HKG', '344', 'no', '852', '.hk'),
(100, 'HU', 'Hungary', 'Hungary', 'HUN', '348', 'yes', '36', '.hu'),
(101, 'IS', 'Iceland', 'Republic of Iceland', 'ISL', '352', 'yes', '354', '.is'),
(102, 'IN', 'India', 'Republic of India', 'IND', '356', 'yes', '91', '.in'),
(103, 'ID', 'Indonesia', 'Republic of Indonesia', 'IDN', '360', 'yes', '62', '.id'),
(104, 'IR', 'Iran', 'Islamic Republic of Iran', 'IRN', '364', 'yes', '98', '.ir'),
(105, 'IQ', 'Iraq', 'Republic of Iraq', 'IRQ', '368', 'yes', '964', '.iq'),
(106, 'IE', 'Ireland', 'Ireland', 'IRL', '372', 'yes', '353', '.ie'),
(107, 'IM', 'Isle of Man', 'Isle of Man', 'IMN', '833', 'no', '44', '.im'),
(108, 'IL', 'Israel', 'State of Israel', 'ISR', '376', 'yes', '972', '.il'),
(109, 'IT', 'Italy', 'Italian Republic', 'ITA', '380', 'yes', '39', '.jm'),
(110, 'JM', 'Jamaica', 'Jamaica', 'JAM', '388', 'yes', '1+876', '.jm'),
(111, 'JP', 'Japan', 'Japan', 'JPN', '392', 'yes', '81', '.jp'),
(112, 'JE', 'Jersey', 'The Bailiwick of Jersey', 'JEY', '832', 'no', '44', '.je'),
(113, 'JO', 'Jordan', 'Hashemite Kingdom of Jordan', 'JOR', '400', 'yes', '962', '.jo'),
(114, 'KZ', 'Kazakhstan', 'Republic of Kazakhstan', 'KAZ', '398', 'yes', '7', '.kz'),
(115, 'KE', 'Kenya', 'Republic of Kenya', 'KEN', '404', 'yes', '254', '.ke'),
(116, 'KI', 'Kiribati', 'Republic of Kiribati', 'KIR', '296', 'yes', '686', '.ki'),
(117, 'XK', 'Kosovo', 'Republic of Kosovo', '---', '---', 'some', '381', ''),
(118, 'KW', 'Kuwait', 'State of Kuwait', 'KWT', '414', 'yes', '965', '.kw'),
(119, 'KG', 'Kyrgyzstan', 'Kyrgyz Republic', 'KGZ', '417', 'yes', '996', '.kg'),
(120, 'LA', 'Laos', 'Lao People''s Democratic Republic', 'LAO', '418', 'yes', '856', '.la'),
(121, 'LV', 'Latvia', 'Republic of Latvia', 'LVA', '428', 'yes', '371', '.lv'),
(122, 'LB', 'Lebanon', 'Republic of Lebanon', 'LBN', '422', 'yes', '961', '.lb'),
(123, 'LS', 'Lesotho', 'Kingdom of Lesotho', 'LSO', '426', 'yes', '266', '.ls'),
(124, 'LR', 'Liberia', 'Republic of Liberia', 'LBR', '430', 'yes', '231', '.lr'),
(125, 'LY', 'Libya', 'Libya', 'LBY', '434', 'yes', '218', '.ly'),
(126, 'LI', 'Liechtenstein', 'Principality of Liechtenstein', 'LIE', '438', 'yes', '423', '.li'),
(127, 'LT', 'Lithuania', 'Republic of Lithuania', 'LTU', '440', 'yes', '370', '.lt'),
(128, 'LU', 'Luxembourg', 'Grand Duchy of Luxembourg', 'LUX', '442', 'yes', '352', '.lu'),
(129, 'MO', 'Macao', 'The Macao Special Administrative Region', 'MAC', '446', 'no', '853', '.mo'),
(130, 'MK', 'Macedonia', 'The Former Yugoslav Republic of Macedonia', 'MKD', '807', 'yes', '389', '.mk'),
(131, 'MG', 'Madagascar', 'Republic of Madagascar', 'MDG', '450', 'yes', '261', '.mg'),
(132, 'MW', 'Malawi', 'Republic of Malawi', 'MWI', '454', 'yes', '265', '.mw'),
(133, 'MY', 'Malaysia', 'Malaysia', 'MYS', '458', 'yes', '60', '.my'),
(134, 'MV', 'Maldives', 'Republic of Maldives', 'MDV', '462', 'yes', '960', '.mv'),
(135, 'ML', 'Mali', 'Republic of Mali', 'MLI', '466', 'yes', '223', '.ml'),
(136, 'MT', 'Malta', 'Republic of Malta', 'MLT', '470', 'yes', '356', '.mt'),
(137, 'MH', 'Marshall Islands', 'Republic of the Marshall Islands', 'MHL', '584', 'yes', '692', '.mh'),
(138, 'MQ', 'Martinique', 'Martinique', 'MTQ', '474', 'no', '596', '.mq'),
(139, 'MR', 'Mauritania', 'Islamic Republic of Mauritania', 'MRT', '478', 'yes', '222', '.mr'),
(140, 'MU', 'Mauritius', 'Republic of Mauritius', 'MUS', '480', 'yes', '230', '.mu'),
(141, 'YT', 'Mayotte', 'Mayotte', 'MYT', '175', 'no', '262', '.yt'),
(142, 'MX', 'Mexico', 'United Mexican States', 'MEX', '484', 'yes', '52', '.mx'),
(143, 'FM', 'Micronesia', 'Federated States of Micronesia', 'FSM', '583', 'yes', '691', '.fm'),
(144, 'MD', 'Moldava', 'Republic of Moldova', 'MDA', '498', 'yes', '373', '.md'),
(145, 'MC', 'Monaco', 'Principality of Monaco', 'MCO', '492', 'yes', '377', '.mc'),
(146, 'MN', 'Mongolia', 'Mongolia', 'MNG', '496', 'yes', '976', '.mn'),
(147, 'ME', 'Montenegro', 'Montenegro', 'MNE', '499', 'yes', '382', '.me'),
(148, 'MS', 'Montserrat', 'Montserrat', 'MSR', '500', 'no', '1+664', '.ms'),
(149, 'MA', 'Morocco', 'Kingdom of Morocco', 'MAR', '504', 'yes', '212', '.ma'),
(150, 'MZ', 'Mozambique', 'Republic of Mozambique', 'MOZ', '508', 'yes', '258', '.mz'),
(151, 'MM', 'Myanmar (Burma)', 'Republic of the Union of Myanmar', 'MMR', '104', 'yes', '95', '.mm'),
(152, 'NA', 'Namibia', 'Republic of Namibia', 'NAM', '516', 'yes', '264', '.na'),
(153, 'NR', 'Nauru', 'Republic of Nauru', 'NRU', '520', 'yes', '674', '.nr'),
(154, 'NP', 'Nepal', 'Federal Democratic Republic of Nepal', 'NPL', '524', 'yes', '977', '.np'),
(155, 'NL', 'Netherlands', 'Kingdom of the Netherlands', 'NLD', '528', 'yes', '31', '.nl'),
(156, 'NC', 'New Caledonia', 'New Caledonia', 'NCL', '540', 'no', '687', '.nc'),
(157, 'NZ', 'New Zealand', 'New Zealand', 'NZL', '554', 'yes', '64', '.nz'),
(158, 'NI', 'Nicaragua', 'Republic of Nicaragua', 'NIC', '558', 'yes', '505', '.ni'),
(159, 'NE', 'Niger', 'Republic of Niger', 'NER', '562', 'yes', '227', '.ne'),
(160, 'NG', 'Nigeria', 'Federal Republic of Nigeria', 'NGA', '566', 'yes', '234', '.ng'),
(161, 'NU', 'Niue', 'Niue', 'NIU', '570', 'some', '683', '.nu'),
(162, 'NF', 'Norfolk Island', 'Norfolk Island', 'NFK', '574', 'no', '672', '.nf'),
(163, 'KP', 'North Korea', 'Democratic People''s Republic of Korea', 'PRK', '408', 'yes', '850', '.kp'),
(164, 'MP', 'Northern Mariana Islands', 'Northern Mariana Islands', 'MNP', '580', 'no', '1+670', '.mp'),
(165, 'NO', 'Norway', 'Kingdom of Norway', 'NOR', '578', 'yes', '47', '.no'),
(166, 'OM', 'Oman', 'Sultanate of Oman', 'OMN', '512', 'yes', '968', '.om'),
(167, 'PK', 'Pakistan', 'Islamic Republic of Pakistan', 'PAK', '586', 'yes', '92', '.pk'),
(168, 'PW', 'Palau', 'Republic of Palau', 'PLW', '585', 'yes', '680', '.pw'),
(169, 'PS', 'Palestine', 'State of Palestine (or Occupied Palestinian Territory)', 'PSE', '275', 'some', '970', '.ps'),
(170, 'PA', 'Panama', 'Republic of Panama', 'PAN', '591', 'yes', '507', '.pa'),
(171, 'PG', 'Papua New Guinea', 'Independent State of Papua New Guinea', 'PNG', '598', 'yes', '675', '.pg'),
(172, 'PY', 'Paraguay', 'Republic of Paraguay', 'PRY', '600', 'yes', '595', '.py'),
(173, 'PE', 'Peru', 'Republic of Peru', 'PER', '604', 'yes', '51', '.pe'),
(174, 'PH', 'Phillipines', 'Republic of the Philippines', 'PHL', '608', 'yes', '63', '.ph'),
(175, 'PN', 'Pitcairn', 'Pitcairn', 'PCN', '612', 'no', 'NONE', '.pn'),
(176, 'PL', 'Poland', 'Republic of Poland', 'POL', '616', 'yes', '48', '.pl'),
(177, 'PT', 'Portugal', 'Portuguese Republic', 'PRT', '620', 'yes', '351', '.pt'),
(178, 'PR', 'Puerto Rico', 'Commonwealth of Puerto Rico', 'PRI', '630', 'no', '1+939', '.pr'),
(179, 'QA', 'Qatar', 'State of Qatar', 'QAT', '634', 'yes', '974', '.qa'),
(180, 'RE', 'Reunion', 'R&eacute;union', 'REU', '638', 'no', '262', '.re'),
(181, 'RO', 'Romania', 'Romania', 'ROU', '642', 'yes', '40', '.ro'),
(182, 'RU', 'Russia', 'Russian Federation', 'RUS', '643', 'yes', '7', '.ru'),
(183, 'RW', 'Rwanda', 'Republic of Rwanda', 'RWA', '646', 'yes', '250', '.rw'),
(184, 'BL', 'Saint Barthelemy', 'Saint Barth&eacute;lemy', 'BLM', '652', 'no', '590', '.bl'),
(185, 'SH', 'Saint Helena', 'Saint Helena, Ascension and Tristan da Cunha', 'SHN', '654', 'no', '290', '.sh'),
(186, 'KN', 'Saint Kitts and Nevis', 'Federation of Saint Christopher and Nevis', 'KNA', '659', 'yes', '1+869', '.kn'),
(187, 'LC', 'Saint Lucia', 'Saint Lucia', 'LCA', '662', 'yes', '1+758', '.lc'),
(188, 'MF', 'Saint Martin', 'Saint Martin', 'MAF', '663', 'no', '590', '.mf'),
(189, 'PM', 'Saint Pierre and Miquelon', 'Saint Pierre and Miquelon', 'SPM', '666', 'no', '508', '.pm'),
(190, 'VC', 'Saint Vincent and the Grenadines', 'Saint Vincent and the Grenadines', 'VCT', '670', 'yes', '1+784', '.vc'),
(191, 'WS', 'Samoa', 'Independent State of Samoa', 'WSM', '882', 'yes', '685', '.ws'),
(192, 'SM', 'San Marino', 'Republic of San Marino', 'SMR', '674', 'yes', '378', '.sm'),
(193, 'ST', 'Sao Tome and Principe', 'Democratic Republic of S&atilde;o Tom&eacute; and Pr&iacute;ncipe', 'STP', '678', 'yes', '239', '.st'),
(194, 'SA', 'Saudi Arabia', 'Kingdom of Saudi Arabia', 'SAU', '682', 'yes', '966', '.sa'),
(195, 'SN', 'Senegal', 'Republic of Senegal', 'SEN', '686', 'yes', '221', '.sn'),
(196, 'RS', 'Serbia', 'Republic of Serbia', 'SRB', '688', 'yes', '381', '.rs'),
(197, 'SC', 'Seychelles', 'Republic of Seychelles', 'SYC', '690', 'yes', '248', '.sc'),
(198, 'SL', 'Sierra Leone', 'Republic of Sierra Leone', 'SLE', '694', 'yes', '232', '.sl'),
(199, 'SG', 'Singapore', 'Republic of Singapore', 'SGP', '702', 'yes', '65', '.sg'),
(200, 'SX', 'Sint Maarten', 'Sint Maarten', 'SXM', '534', 'no', '1+721', '.sx'),
(201, 'SK', 'Slovakia', 'Slovak Republic', 'SVK', '703', 'yes', '421', '.sk'),
(202, 'SI', 'Slovenia', 'Republic of Slovenia', 'SVN', '705', 'yes', '386', '.si'),
(203, 'SB', 'Solomon Islands', 'Solomon Islands', 'SLB', '090', 'yes', '677', '.sb'),
(204, 'SO', 'Somalia', 'Somali Republic', 'SOM', '706', 'yes', '252', '.so'),
(205, 'ZA', 'South Africa', 'Republic of South Africa', 'ZAF', '710', 'yes', '27', '.za'),
(206, 'GS', 'South Georgia and the South Sandwich Islands', 'South Georgia and the South Sandwich Islands', 'SGS', '239', 'no', '500', '.gs'),
(207, 'KR', 'South Korea', 'Republic of Korea', 'KOR', '410', 'yes', '82', '.kr'),
(208, 'SS', 'South Sudan', 'Republic of South Sudan', 'SSD', '728', 'yes', '211', '.ss'),
(209, 'ES', 'Spain', 'Kingdom of Spain', 'ESP', '724', 'yes', '34', '.es'),
(210, 'LK', 'Sri Lanka', 'Democratic Socialist Republic of Sri Lanka', 'LKA', '144', 'yes', '94', '.lk'),
(211, 'SD', 'Sudan', 'Republic of the Sudan', 'SDN', '729', 'yes', '249', '.sd'),
(212, 'SR', 'Suriname', 'Republic of Suriname', 'SUR', '740', 'yes', '597', '.sr'),
(213, 'SJ', 'Svalbard and Jan Mayen', 'Svalbard and Jan Mayen', 'SJM', '744', 'no', '47', '.sj'),
(214, 'SZ', 'Swaziland', 'Kingdom of Swaziland', 'SWZ', '748', 'yes', '268', '.sz'),
(215, 'SE', 'Sweden', 'Kingdom of Sweden', 'SWE', '752', 'yes', '46', '.se'),
(216, 'CH', 'Switzerland', 'Swiss Confederation', 'CHE', '756', 'yes', '41', '.ch'),
(217, 'SY', 'Syria', 'Syrian Arab Republic', 'SYR', '760', 'yes', '963', '.sy'),
(218, 'TW', 'Taiwan', 'Republic of China (Taiwan)', 'TWN', '158', 'former', '886', '.tw'),
(219, 'TJ', 'Tajikistan', 'Republic of Tajikistan', 'TJK', '762', 'yes', '992', '.tj'),
(220, 'TZ', 'Tanzania', 'United Republic of Tanzania', 'TZA', '834', 'yes', '255', '.tz'),
(221, 'TH', 'Thailand', 'Kingdom of Thailand', 'THA', '764', 'yes', '66', '.th'),
(222, 'TL', 'Timor-Leste (East Timor)', 'Democratic Republic of Timor-Leste', 'TLS', '626', 'yes', '670', '.tl'),
(223, 'TG', 'Togo', 'Togolese Republic', 'TGO', '768', 'yes', '228', '.tg'),
(224, 'TK', 'Tokelau', 'Tokelau', 'TKL', '772', 'no', '690', '.tk'),
(225, 'TO', 'Tonga', 'Kingdom of Tonga', 'TON', '776', 'yes', '676', '.to'),
(226, 'TT', 'Trinidad and Tobago', 'Republic of Trinidad and Tobago', 'TTO', '780', 'yes', '1+868', '.tt'),
(227, 'TN', 'Tunisia', 'Republic of Tunisia', 'TUN', '788', 'yes', '216', '.tn'),
(228, 'TR', 'Turkey', 'Republic of Turkey', 'TUR', '792', 'yes', '90', '.tr'),
(229, 'TM', 'Turkmenistan', 'Turkmenistan', 'TKM', '795', 'yes', '993', '.tm'),
(230, 'TC', 'Turks and Caicos Islands', 'Turks and Caicos Islands', 'TCA', '796', 'no', '1+649', '.tc'),
(231, 'TV', 'Tuvalu', 'Tuvalu', 'TUV', '798', 'yes', '688', '.tv'),
(232, 'UG', 'Uganda', 'Republic of Uganda', 'UGA', '800', 'yes', '256', '.ug'),
(233, 'UA', 'Ukraine', 'Ukraine', 'UKR', '804', 'yes', '380', '.ua'),
(234, 'AE', 'United Arab Emirates', 'United Arab Emirates', 'ARE', '784', 'yes', '971', '.ae'),
(235, 'GB', 'United Kingdom', 'United Kingdom of Great Britain and Nothern Ireland', 'GBR', '826', 'yes', '44', '.uk'),
(236, 'US', 'United States', 'United States of America', 'USA', '840', 'yes', '1', '.us'),
(237, 'UM', 'United States Minor Outlying Islands', 'United States Minor Outlying Islands', 'UMI', '581', 'no', 'NONE', 'NONE'),
(238, 'UY', 'Uruguay', 'Eastern Republic of Uruguay', 'URY', '858', 'yes', '598', '.uy'),
(239, 'UZ', 'Uzbekistan', 'Republic of Uzbekistan', 'UZB', '860', 'yes', '998', '.uz'),
(240, 'VU', 'Vanuatu', 'Republic of Vanuatu', 'VUT', '548', 'yes', '678', '.vu'),
(241, 'VA', 'Vatican City', 'State of the Vatican City', 'VAT', '336', 'no', '39', '.va'),
(242, 'VE', 'Venezuela', 'Bolivarian Republic of Venezuela', 'VEN', '862', 'yes', '58', '.ve'),
(243, 'VN', 'Vietnam', 'Socialist Republic of Vietnam', 'VNM', '704', 'yes', '84', '.vn'),
(244, 'VG', 'Virgin Islands, British', 'British Virgin Islands', 'VGB', '092', 'no', '1+284', '.vg'),
(245, 'VI', 'Virgin Islands, US', 'Virgin Islands of the United States', 'VIR', '850', 'no', '1+340', '.vi'),
(246, 'WF', 'Wallis and Futuna', 'Wallis and Futuna', 'WLF', '876', 'no', '681', '.wf'),
(247, 'EH', 'Western Sahara', 'Western Sahara', 'ESH', '732', 'no', '212', '.eh'),
(248, 'YE', 'Yemen', 'Republic of Yemen', 'YEM', '887', 'yes', '967', '.ye'),
(249, 'ZM', 'Zambia', 'Republic of Zambia', 'ZMB', '894', 'yes', '260', '.zm'),
(250, 'ZW', 'Zimbabwe', 'Republic of Zimbabwe', 'ZWE', '716', 'yes', '263', '.zw');
 
-- --------------------------------------------------------
 
--
-- Table structure for table `credit_card`
--
 
CREATE TABLE IF NOT EXISTS `credit_card` (
  `cc_id` int(11) NOT NULL AUTO_INCREMENT,
  `cc_type` text NOT NULL,
  PRIMARY KEY (`cc_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;
 
--
-- Dumping data for table `credit_card`
--
 
INSERT INTO `credit_card` (`cc_id`, `cc_type`) VALUES
(1, 'Visa'),
(2, 'MasterCard'),
(3, 'American Express'),
(4, 'Discover'),
(5, 'Diners Club'),
(6, 'JCB');
 
-- --------------------------------------------------------
 
--
-- Table structure for table `credit_card_user`
--
 
CREATE TABLE IF NOT EXISTS `credit_card_user` (
  `ccu_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) NOT NULL,
  `cc_id` int(11) NOT NULL,
  `ccu_name` text NOT NULL,
  `ccu_number` text NOT NULL,
  `ccu_ccv` text NOT NULL,
  `ccu_exp_month` text NOT NULL,
  `ccu_exp_year` text NOT NULL,
  `ccu_isset` text NOT NULL,
  PRIMARY KEY (`ccu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;
 
--
-- Dumping data for table `credit_card_user`
--
 
INSERT INTO `credit_card_user` (`ccu_id`, `u_id`, `cc_id`, `ccu_name`, `ccu_number`, `ccu_ccv`, `ccu_exp_month`, `ccu_exp_year`, `ccu_isset`) VALUES
(24, 26, 1, 'James Angub', '9485736253647263', '123', '1', '2020', '1'),
(25, 27, 1, 'Adrian Angub', '4309437267760423', '127', '6', '2018', '1'),
(26, 28, 1, 'Mary Rose Somera', '5432123456789012', '123', '1', '2020', '1'),
(27, 34, 1, 'Lorenzo Lino Andres Bahinting', '4661639066648657', '808', '7', '2018', '1'),
(28, 39, 1, 'Juan dela Cruz', '1232434434343453', '132', '1', '2017', '1'),
(29, 40, 1, 'Juan dela Cruz', '1232434434343453', '132', '1', '2017', '1'),
(30, 41, 3, 'Juan Dodong', '3848438295127384', '234', '7', '2018', ''),
(31, 42, 3, 'Juan Dodong', '3848438295127384', '234', '7', '2018', ''),
(32, 43, 3, 'Gil Bar-Lev', '3717894561234564', '123', '9', '2014', ''),
(33, 44, 3, 'Testing One', '123432123454345', '1234', '1', '2019', ''),
(34, 45, 2, 'Jan Hendrix', '4404527819038700', '327', '1', '2020', '');
 
-- --------------------------------------------------------
 
--
-- Table structure for table `events`
--
 
CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Event Primary Key',
  `event_number` int(11) NOT NULL,
  `user_id` int(11) unsigned NOT NULL COMMENT 'User ID',
  `server_id` int(11) unsigned DEFAULT NULL COMMENT 'The ID of the remote log client',
  `remote_id` int(11) unsigned DEFAULT NULL COMMENT 'The Event Primary Key from the remote client',
  `event_date` datetime NOT NULL COMMENT 'Event Datetime in local timezone',
  `event_date_utc` datetime NOT NULL COMMENT 'Event Datetime in UTC timezone',
  `event_type` varchar(255) NOT NULL COMMENT 'The type of event',
  `event_source` varchar(255) NOT NULL COMMENT 'Text description of the source of the event',
  `event_severity` varchar(255) NOT NULL COMMENT 'Notice, Warning etc',
  `event_file` text NOT NULL COMMENT 'The full file location of the source of the event',
  `event_file_line` int(11) NOT NULL COMMENT 'The line in the file that triggered the event',
  `event_ip_address` varchar(255) NOT NULL COMMENT 'IP Address of the user that triggered the event',
  `event_summary` varchar(255) DEFAULT NULL COMMENT 'A summary of the description',
  `event_description` text NOT NULL COMMENT 'Full description of the event',
  `event_trace` longtext COMMENT 'Full PHP trace',
  `event_synced` int(1) unsigned DEFAULT '0',
  `site_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `event_type` (`event_type`),
  KEY `event_source` (`event_source`),
  KEY `user_id` (`user_id`),
  KEY `server_id` (`server_id`),
  KEY `event_date` (`event_date`),
  KEY `site_id` (`site_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=69 ;
 
--
-- Dumping data for table `events`
--
 
INSERT INTO `events` (`id`, `event_number`, `user_id`, `server_id`, `remote_id`, `event_date`, `event_date_utc`, `event_type`, `event_source`, `event_severity`, `event_file`, `event_file_line`, `event_ip_address`, `event_summary`, `event_description`, `event_trace`, `event_synced`, `site_id`) VALUES
(1, 512, 0, NULL, NULL, '2013-11-04 11:33:26', '2013-11-03 23:33:26', 'local_login_failed', 'auth', 'warning', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/auth.class.php', 356, '125.212.121.139', NULL, 'Local Login Failed "<a href="http://betaoceantailer.davaowebjobs.com/ticket/users/view/1/">admin</a>"', NULL, 0, 1),
(2, 1024, 1, NULL, NULL, '2013-11-04 11:33:33', '2013-11-03 23:33:33', 'local_login_successful', 'auth', 'notice', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/auth.class.php', 339, '125.212.121.139', NULL, 'Local Login Successful "<a href="http://betaoceantailer.davaowebjobs.com/ticket/users/view/1/">admin</a>"', NULL, 0, 1),
(3, 1024, 1, NULL, NULL, '2013-11-04 12:55:28', '2013-11-04 00:55:28', 'local_login_successful', 'auth', 'notice', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/auth.class.php', 339, '125.212.121.139', NULL, 'Local Login Successful "<a href="http://betaoceantailer.davaowebjobs.com/ticket/users/view/1/">admin</a>"', NULL, 0, 1),
(4, 1024, 1, NULL, NULL, '2013-11-04 12:56:02', '2013-11-04 00:56:02', 'add', 'users', 'notice', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/users.class.php', 428, '125.212.121.139', NULL, 'User Added "<a href="http://betaoceantailer.davaowebjobs.com/ticket/users/view/2/">test</a>"', NULL, 0, 1),
(5, 512, 0, NULL, NULL, '2013-11-04 14:05:41', '2013-11-04 02:05:41', 'unknown_user', 'auth', 'warning', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/auth.class.php', 459, '125.212.121.139', NULL, 'Local Login Failed "admin" - Unknown Account', NULL, 0, 1),
(6, 512, 0, NULL, NULL, '2013-11-11 15:04:07', '2013-11-11 03:04:07', 'unknown_user', 'auth', 'warning', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/auth.class.php', 459, '103.14.60.248', NULL, 'Local Login Failed "admin" - Unknown Account', NULL, 0, 1),
(7, 512, 0, NULL, NULL, '2013-11-11 15:04:16', '2013-11-11 03:04:16', 'unknown_user', 'auth', 'warning', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/auth.class.php', 459, '103.14.60.248', NULL, 'Local Login Failed "admin" - Unknown Account', NULL, 0, 1),
(8, 512, 0, NULL, NULL, '2013-11-11 15:04:40', '2013-11-11 03:04:40', 'unknown_user', 'auth', 'warning', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/auth.class.php', 459, '103.14.60.248', NULL, 'Local Login Failed "admin" - Unknown Account', NULL, 0, 1),
(9, 512, 0, NULL, NULL, '2013-11-11 15:04:44', '2013-11-11 03:04:44', 'unknown_user', 'auth', 'warning', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/auth.class.php', 459, '103.14.60.248', NULL, 'Local Login Failed "admin" - Unknown Account', NULL, 0, 1),
(10, 512, 0, NULL, NULL, '2013-11-11 15:04:51', '2013-11-11 03:04:51', 'unknown_user', 'auth', 'warning', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/auth.class.php', 459, '103.14.60.248', NULL, 'Local Login Failed "admin" - Unknown Account', NULL, 0, 1),
(11, 512, 0, NULL, NULL, '2013-11-11 15:38:56', '2013-11-11 03:38:56', 'unknown_user', 'auth', 'warning', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/auth.class.php', 459, '103.14.60.248', NULL, 'Local Login Failed "admin" - Unknown Account', NULL, 0, 1),
(12, 512, 0, NULL, NULL, '2013-11-11 15:39:01', '2013-11-11 03:39:01', 'unknown_user', 'auth', 'warning', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/auth.class.php', 459, '103.14.60.248', NULL, 'Local Login Failed "admin" - Unknown Account', NULL, 0, 1),
(13, 512, 0, NULL, NULL, '2013-11-13 12:42:42', '2013-11-13 00:42:42', 'unknown_user', 'auth', 'warning', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/auth.class.php', 459, '103.14.60.234', NULL, 'Local Login Failed "admin" - Unknown Account', NULL, 0, 1),
(14, 512, 0, NULL, NULL, '2013-11-13 12:42:50', '2013-11-13 00:42:50', 'unknown_user', 'auth', 'warning', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/auth.class.php', 459, '103.14.60.234', NULL, 'Local Login Failed "admin" - Unknown Account', NULL, 0, 1),
(15, 512, 0, NULL, NULL, '2013-11-13 12:42:55', '2013-11-13 00:42:55', 'unknown_user', 'auth', 'warning', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/auth.class.php', 459, '103.14.60.234', NULL, 'Local Login Failed "admin" - Unknown Account', NULL, 0, 1),
(16, 512, 0, NULL, NULL, '2013-11-13 12:42:59', '2013-11-13 00:42:59', 'unknown_user', 'auth', 'warning', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/auth.class.php', 459, '103.14.60.234', NULL, 'Local Login Failed "admin" - Unknown Account', NULL, 0, 1),
(17, 512, 0, NULL, NULL, '2013-11-13 12:43:05', '2013-11-13 00:43:05', 'local_login_failed', 'auth', 'warning', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/auth.class.php', 356, '103.14.60.234', NULL, 'Local Login Failed "<a href="http://betaoceantailer.davaowebjobs.com/ticket/users/view/1/">admin</a>"', NULL, 0, 1),
(18, 512, 0, NULL, NULL, '2013-11-13 12:45:53', '2013-11-13 00:45:53', 'local_login_failed', 'auth', 'warning', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/auth.class.php', 356, '103.14.60.234', NULL, 'Local Login Failed "<a href="http://betaoceantailer.davaowebjobs.com/ticket/users/view/1/">admin</a>"', NULL, 0, 1),
(19, 512, 0, NULL, NULL, '2013-11-13 12:45:58', '2013-11-13 00:45:58', 'local_login_failed', 'auth', 'warning', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/auth.class.php', 356, '103.14.60.234', NULL, 'Local Login Failed "<a href="http://betaoceantailer.davaowebjobs.com/ticket/users/view/1/">admin</a>"', NULL, 0, 1),
(20, 1024, 2, NULL, NULL, '2013-11-13 12:47:02', '2013-11-13 00:47:02', 'local_login_successful', 'auth', 'notice', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/auth.class.php', 339, '103.14.60.234', NULL, 'Local Login Successful "<a href="http://betaoceantailer.davaowebjobs.com/ticket/users/view/2/">test</a>"', NULL, 0, 1),
(21, 1024, 2, NULL, NULL, '2013-11-13 12:49:16', '2013-11-13 00:49:16', 'local_login_successful', 'auth', 'notice', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/auth.class.php', 339, '103.14.60.234', NULL, 'Local Login Successful "<a href="http://betaoceantailer.davaowebjobs.com/ticket/users/view/2/">test</a>"', NULL, 0, 1),
(22, 1024, 2, NULL, NULL, '2013-11-13 12:49:40', '2013-11-13 00:49:40', 'edit', 'users', 'notice', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/users.class.php', 579, '103.14.60.234', NULL, 'User Edited "<a href="http://betaoceantailer.davaowebjobs.com/ticket/users/view/1/">admin</a>"', NULL, 0, 1),
(23, 1024, 2, NULL, NULL, '2013-11-13 13:04:13', '2013-11-13 01:04:13', 'enable', 'plugins', 'notice', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/plugins.class.php', 236, '103.14.60.234', NULL, 'Plugin Enabled "forums/forums"', NULL, 0, 1),
(24, 1024, 2, NULL, NULL, '2013-11-13 13:04:13', '2013-11-13 01:04:13', 'install', 'forums_install', 'notice', '/home/davaoweb/public_html/betaoceantailer/ticket/user/plugins/forums/forums_install.class.php', 115, '103.14.60.234', NULL, 'Forums Installed.', NULL, 0, 1),
(25, 1024, 2, NULL, NULL, '2013-11-13 13:05:01', '2013-11-13 01:05:01', 'edit', 'forums', 'notice', '/home/davaoweb/public_html/betaoceantailer/ticket/user/plugins/forums/forums.plugin.php', 743, '103.14.60.234', NULL, 'Forum Settings Edited', NULL, 0, 1),
(26, 1024, 2, NULL, NULL, '2013-11-13 13:05:21', '2013-11-13 01:05:21', 'edit', 'forums', 'notice', '/home/davaoweb/public_html/betaoceantailer/ticket/user/plugins/forums/forums.plugin.php', 743, '103.14.60.234', NULL, 'Forum Settings Edited', NULL, 0, 1),
(27, 1024, 2, NULL, NULL, '2013-11-13 13:05:26', '2013-11-13 01:05:26', 'edit', 'forums', 'notice', '/home/davaoweb/public_html/betaoceantailer/ticket/user/plugins/forums/forums.plugin.php', 743, '103.14.60.234', NULL, 'Forum Settings Edited', NULL, 0, 1),
(28, 1024, 2, NULL, NULL, '2013-11-13 13:05:48', '2013-11-13 01:05:48', 'local_login_successful', 'auth', 'notice', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/auth.class.php', 339, '103.14.60.234', NULL, 'Local Login Successful "<a href="http://betaoceantailer.davaowebjobs.com/ticket/users/view/2/">test</a>"', NULL, 0, 1),
(29, 512, 0, NULL, NULL, '2013-11-13 13:07:22', '2013-11-13 01:07:22', 'local_login_failed', 'auth', 'warning', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/auth.class.php', 356, '103.14.60.234', NULL, 'Local Login Failed "<a href="http://betaoceantailer.davaowebjobs.com/ticket/users/view/1/">admin</a>"', NULL, 0, 1),
(30, 512, 0, NULL, NULL, '2013-11-13 13:07:28', '2013-11-13 01:07:28', 'local_login_failed', 'auth', 'warning', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/auth.class.php', 356, '103.14.60.234', NULL, 'Local Login Failed "<a href="http://betaoceantailer.davaowebjobs.com/ticket/users/view/1/">admin</a>"', NULL, 0, 1),
(31, 1024, 2, NULL, NULL, '2013-11-13 13:07:59', '2013-11-13 01:07:59', 'local_login_successful', 'auth', 'notice', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/auth.class.php', 339, '103.14.60.234', NULL, 'Local Login Successful "<a href="http://betaoceantailer.davaowebjobs.com/ticket/users/view/2/">test</a>"', NULL, 0, 1),
(32, 512, 0, NULL, NULL, '2013-11-13 13:08:20', '2013-11-13 01:08:20', 'login_failed_account_lockout', 'auth', 'warning', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/auth.class.php', 239, '103.14.60.234', NULL, 'Login Failed "<a href="http://betaoceantailer.davaowebjobs.com/ticket/users/view/1/">admin</a>" - Account Temporarily Locked.', NULL, 0, 1),
(33, 1024, 2, NULL, NULL, '2013-11-13 13:08:27', '2013-11-13 01:08:27', 'local_login_successful', 'auth', 'notice', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/auth.class.php', 339, '103.14.60.234', NULL, 'Local Login Successful "<a href="http://betaoceantailer.davaowebjobs.com/ticket/users/view/2/">test</a>"', NULL, 0, 1),
(34, 1024, 2, NULL, NULL, '2013-11-13 13:15:40', '2013-11-13 01:15:40', 'delete', 'users', 'notice', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/users.class.php', 828, '103.14.60.234', NULL, 'User Deleted ID 1', NULL, 0, 1),
(35, 1024, 2, NULL, NULL, '2013-11-13 13:16:17', '2013-11-13 01:16:17', 'add', 'users', 'notice', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/users.class.php', 428, '103.14.60.234', NULL, 'User Added "<a href="http://betaoceantailer.davaowebjobs.com/ticket/users/view/4/">James Angub</a>"', NULL, 0, 1),
(36, 1024, 2, NULL, NULL, '2013-11-13 13:17:42', '2013-11-13 01:17:42', 'add', 'ticket_status', 'notice', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/ticket_status.class.php', 88, '103.14.60.234', NULL, 'Ticket Status Added "Pending"', NULL, 0, 1),
(37, 1024, 2, NULL, NULL, '2013-11-13 13:18:59', '2013-11-13 01:18:59', 'add', 'ticket_departments', 'notice', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/ticket_departments.class.php', 92, '103.14.60.234', NULL, 'Ticket Department Added "Accounting"', NULL, 0, 1),
(38, 1024, 2, NULL, NULL, '2013-11-13 13:19:27', '2013-11-13 01:19:27', 'add', 'ticket_departments', 'notice', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/ticket_departments.class.php', 92, '103.14.60.234', NULL, 'Ticket Department Added "Inventory"', NULL, 0, 1),
(39, 1024, 2, NULL, NULL, '2013-11-13 13:20:04', '2013-11-13 01:20:04', 'add', 'ticket_departments', 'notice', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/ticket_departments.class.php', 92, '103.14.60.234', NULL, 'Ticket Department Added "Buyer Supports"', NULL, 0, 1),
(40, 1024, 2, NULL, NULL, '2013-11-13 13:20:19', '2013-11-13 01:20:19', 'add', 'ticket_departments', 'notice', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/ticket_departments.class.php', 92, '103.14.60.234', NULL, 'Ticket Department Added "Supplier Supports"', NULL, 0, 1),
(41, 1024, 2, NULL, NULL, '2013-11-13 13:20:34', '2013-11-13 01:20:34', 'edit', 'ticket_priorities', 'notice', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/ticket_priorities.class.php', 169, '103.14.60.234', NULL, 'Ticket Priority Edited "Low"', NULL, 0, 1),
(42, 1024, 2, NULL, NULL, '2013-11-13 13:20:34', '2013-11-13 01:20:34', 'edit', 'ticket_priorities', 'notice', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/ticket_priorities.class.php', 169, '103.14.60.234', NULL, 'Ticket Priority Edited "Medium"', NULL, 0, 1),
(43, 1024, 2, NULL, NULL, '2013-11-13 13:20:34', '2013-11-13 01:20:34', 'edit', 'ticket_priorities', 'notice', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/ticket_priorities.class.php', 169, '103.14.60.234', NULL, 'Ticket Priority Edited "High"', NULL, 0, 1),
(44, 1024, 2, NULL, NULL, '2013-11-13 13:20:34', '2013-11-13 01:20:34', 'edit', 'settings', 'notice', '/home/davaoweb/public_html/betaoceantailer/ticket/user/themes/standard/pages/settings/tickets.php', 47, '103.14.60.234', NULL, 'Settings Edited', NULL, 0, 1),
(45, 1024, 4, NULL, NULL, '2013-11-13 13:21:48', '2013-11-13 01:21:48', 'local_login_successful', 'auth', 'notice', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/auth.class.php', 339, '103.14.60.234', NULL, 'Local Login Successful "<a href="http://betaoceantailer.davaowebjobs.com/ticket/users/view/4/">James Angub</a>"', NULL, 0, 1),
(46, 1024, 2, NULL, NULL, '2013-11-13 13:24:57', '2013-11-13 01:24:57', 'local_login_successful', 'auth', 'notice', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/auth.class.php', 339, '103.14.60.234', NULL, 'Local Login Successful "<a href="http://betaoceantailer.davaowebjobs.com/ticket/users/view/2/">test</a>"', NULL, 0, 1),
(47, 1024, 2, NULL, NULL, '2013-11-13 13:25:04', '2013-11-13 01:25:04', 'local_login_successful', 'auth', 'notice', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/auth.class.php', 339, '103.14.60.234', NULL, 'Local Login Successful "<a href="http://betaoceantailer.davaowebjobs.com/ticket/users/view/2/">test</a>"', NULL, 0, 1),
(48, 1024, 4, NULL, NULL, '2013-11-13 13:26:27', '2013-11-13 01:26:27', 'local_login_successful', 'auth', 'notice', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/auth.class.php', 339, '103.14.60.234', NULL, 'Local Login Successful "<a href="http://betaoceantailer.davaowebjobs.com/ticket/users/view/4/">James Angub</a>"', NULL, 0, 1),
(49, 1024, 4, NULL, NULL, '2013-11-13 13:30:41', '2013-11-13 01:30:41', 'edit', 'ticket_departments', 'notice', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/ticket_departments.class.php', 211, '103.14.60.234', NULL, 'Ticket Department Edited "Buyer Supports"', NULL, 0, 1),
(50, 1024, 4, NULL, NULL, '2013-11-13 13:32:54', '2013-11-13 01:32:54', 'add', 'users', 'notice', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/users.class.php', 428, '103.14.60.234', NULL, 'User Added "<a href="http://betaoceantailer.davaowebjobs.com/ticket/users/view/5/">Gilad Bar-Lev</a>"', NULL, 0, 1),
(51, 512, 0, NULL, NULL, '2013-11-13 14:23:35', '2013-11-13 02:23:35', 'local_login_failed', 'auth', 'warning', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/auth.class.php', 356, '103.14.60.234', NULL, 'Local Login Failed "<a href="http://betaoceantailer.davaowebjobs.com/ticket/users/view/4/">James Angub</a>"', NULL, 0, 1),
(52, 1024, 4, NULL, NULL, '2013-11-13 14:23:44', '2013-11-13 02:23:44', 'local_login_successful', 'auth', 'notice', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/auth.class.php', 339, '103.14.60.234', NULL, 'Local Login Successful "<a href="http://betaoceantailer.davaowebjobs.com/ticket/users/view/4/">James Angub</a>"', NULL, 0, 1),
(53, 1024, 4, NULL, NULL, '2013-11-13 14:25:24', '2013-11-13 02:25:24', 'add', 'tickets', 'notice', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/tickets.class.php', 227, '103.14.60.234', NULL, 'Ticket Added "<a href="http://betaoceantailer.davaowebjobs.com/ticket/tickets/view/1/">Subject 1</a>"', NULL, 0, 1),
(54, 1024, 4, NULL, NULL, '2013-11-13 14:26:39', '2013-11-13 02:26:39', 'edit', 'users', 'notice', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/users.class.php', 579, '103.14.60.234', NULL, 'User Edited "<a href="http://betaoceantailer.davaowebjobs.com/ticket/users/view/2/">test</a>"', NULL, 0, 1),
(55, 1024, 4, NULL, NULL, '2013-11-13 14:27:05', '2013-11-13 02:27:05', 'edit', 'tickets', 'notice', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/tickets.class.php', 391, '103.14.60.234', NULL, 'Ticket Edited "<a href="http://betaoceantailer.davaowebjobs.com/ticket/tickets/view/1/">Subject 1</a>"', NULL, 0, 1),
(56, 1024, 2, NULL, NULL, '2013-11-13 14:27:43', '2013-11-13 02:27:43', 'local_login_successful', 'auth', 'notice', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/auth.class.php', 339, '103.14.60.234', NULL, 'Local Login Successful "<a href="http://betaoceantailer.davaowebjobs.com/ticket/users/view/2/">test</a>"', NULL, 0, 1),
(57, 1024, 2, NULL, NULL, '2013-11-13 14:28:12', '2013-11-13 02:28:12', 'add', 'ticket_notes', 'notice', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/ticket_notes.class.php', 147, '103.14.60.234', NULL, 'Ticket Note Added "<a href="http://betaoceantailer.davaowebjobs.com/ticket/tickets/view/1/">Note</a>"', NULL, 0, 1),
(58, 1024, 2, NULL, NULL, '2013-11-13 14:28:12', '2013-11-13 02:28:12', 'edit', 'tickets', 'notice', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/tickets.class.php', 391, '103.14.60.234', NULL, 'Ticket Edited ID <a href="http://betaoceantailer.davaowebjobs.com/ticket/tickets/view/1/">1</a>', NULL, 0, 1),
(59, 1024, 2, NULL, NULL, '2013-11-15 15:10:23', '2013-11-15 03:10:23', 'local_login_successful', 'auth', 'notice', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/auth.class.php', 339, '103.14.60.7', NULL, 'Local Login Successful "<a href="http://betaoceantailer.davaowebjobs.com/ticket/users/view/2/">test</a>"', NULL, 0, 1),
(60, 1024, 2, NULL, NULL, '2013-11-15 15:10:38', '2013-11-15 03:10:38', 'local_login_successful', 'auth', 'notice', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/auth.class.php', 339, '125.60.240.202', NULL, 'Local Login Successful "<a href="http://betaoceantailer.davaowebjobs.com/ticket/users/view/2/">test</a>"', NULL, 0, 1),
(61, 1024, 2, NULL, NULL, '2013-11-15 15:12:31', '2013-11-15 03:12:31', 'add', 'tickets', 'notice', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/tickets.class.php', 227, '103.14.60.7', NULL, 'Ticket Added "<a href="http://betaoceantailer.davaowebjobs.com/ticket/tickets/view/2/">Problem Login to my account</a>"', NULL, 0, 1),
(62, 512, 0, NULL, NULL, '2013-11-15 15:14:02', '2013-11-15 03:14:02', 'local_login_failed', 'auth', 'warning', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/auth.class.php', 356, '103.14.60.7', NULL, 'Local Login Failed "<a href="http://betaoceantailer.davaowebjobs.com/ticket/users/view/4/">James Angub</a>"', NULL, 0, 1),
(63, 512, 0, NULL, NULL, '2013-11-15 15:14:14', '2013-11-15 03:14:14', 'local_login_failed', 'auth', 'warning', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/auth.class.php', 356, '103.14.60.7', NULL, 'Local Login Failed "<a href="http://betaoceantailer.davaowebjobs.com/ticket/users/view/4/">James Angub</a>"', NULL, 0, 1),
(64, 512, 0, NULL, NULL, '2013-11-15 15:14:57', '2013-11-15 03:14:57', 'unknown_user', 'auth', 'warning', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/auth.class.php', 459, '103.14.60.7', NULL, 'Local Login Failed "jaimedoy" - Unknown Account', NULL, 0, 1),
(65, 1024, 4, NULL, NULL, '2013-11-15 15:15:04', '2013-11-15 03:15:04', 'local_login_successful', 'auth', 'notice', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/auth.class.php', 339, '103.14.60.7', NULL, 'Local Login Successful "<a href="http://betaoceantailer.davaowebjobs.com/ticket/users/view/4/">James Angub</a>"', NULL, 0, 1),
(66, 1024, 2, NULL, NULL, '2013-11-16 05:27:04', '2013-11-15 17:27:04', 'local_login_successful', 'auth', 'notice', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/auth.class.php', 339, '125.60.240.202', NULL, 'Local Login Successful "<a href="http://betaoceantailer.davaowebjobs.com/ticket/users/view/2/">test</a>"', NULL, 0, 1),
(67, 1024, 2, NULL, NULL, '2013-11-16 05:39:31', '2013-11-15 17:39:31', 'edit', 'users', 'notice', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/users.class.php', 579, '125.60.240.202', NULL, 'User Edited "<a href="http://betaoceantailer.davaowebjobs.com/ticket/users/view/2/">test</a>"', NULL, 0, 1),
(68, 1024, 2, NULL, NULL, '2013-11-16 05:39:31', '2013-11-15 17:39:31', 'edit', 'users', 'notice', '/home/davaoweb/public_html/betaoceantailer/ticket/system/classes/users.class.php', 579, '125.60.240.202', NULL, 'User Edited "<a href="http://betaoceantailer.davaowebjobs.com/ticket/users/view/2/">test</a>"', NULL, 0, 1);
 
-- --------------------------------------------------------
 
--
-- Table structure for table `files_to_tickets`
--
 
CREATE TABLE IF NOT EXISTS `files_to_tickets` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ticket_id` int(11) unsigned NOT NULL,
  `file_id` int(11) unsigned NOT NULL,
  `site_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ticket_id` (`ticket_id`),
  KEY `file_id` (`file_id`),
  KEY `site_id` (`site_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
 
-- --------------------------------------------------------
 
--
-- Table structure for table `forum_posts`
--
 
CREATE TABLE IF NOT EXISTS `forum_posts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` int(11) unsigned NOT NULL,
  `thread_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `date_added` datetime NOT NULL,
  `message` longtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `site_id` (`site_id`),
  KEY `thread_id` (`thread_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
 
-- --------------------------------------------------------
 
--
-- Table structure for table `forum_sections`
--
 
CREATE TABLE IF NOT EXISTS `forum_sections` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` int(11) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `site_id` (`site_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;
 
--
-- Dumping data for table `forum_sections`
--
 
INSERT INTO `forum_sections` (`id`, `site_id`, `name`) VALUES
(1, 1, 'Products and Inventory'),
(2, 1, 'Transaction Problem'),
(3, 1, 'FAQS');
 
-- --------------------------------------------------------
 
--
-- Table structure for table `forum_threads`
--
 
CREATE TABLE IF NOT EXISTS `forum_threads` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `section_id` int(11) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` longtext NOT NULL,
  `date_added` datetime NOT NULL,
  `last_modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `site_id` (`site_id`),
  KEY `user_id` (`user_id`),
  KEY `last_modified` (`last_modified`),
  KEY `section_id` (`section_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;
 
--
-- Dumping data for table `forum_threads`
--
 
INSERT INTO `forum_threads` (`id`, `site_id`, `user_id`, `section_id`, `title`, `message`, `date_added`, `last_modified`) VALUES
(1, 1, 2, 1, 'Thread 1', '<p>Testing Thread 1</p>', '2013-11-13 13:25:39', '2013-11-13 13:25:39');
 
-- --------------------------------------------------------
 
--
-- Table structure for table `inventory`
--
 
CREATE TABLE IF NOT EXISTS `inventory` (
  `i_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) NOT NULL,
  `ucp_ean` text NOT NULL,
  `manuf_num` text NOT NULL,
  `m_id` int(11) NOT NULL,
  `b_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `weight` text NOT NULL,
  `weightScale` text NOT NULL,
  `qty` int(11) NOT NULL,
  `sup_fee` float NOT NULL,
  `ship_alone` int(11) NOT NULL,
  `d_height` text NOT NULL,
  `d_width` text NOT NULL,
  `d_dept` text NOT NULL,
  `d_scale` text NOT NULL,
  `i_time` text NOT NULL,
  PRIMARY KEY (`i_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;
 
--
-- Dumping data for table `inventory`
--
 
INSERT INTO `inventory` (`i_id`, `u_id`, `ucp_ean`, `manuf_num`, `m_id`, `b_id`, `c_id`, `weight`, `weightScale`, `qty`, `sup_fee`, `ship_alone`, `d_height`, `d_width`, `d_dept`, `d_scale`, `i_time`) VALUES
(1, 1, '2186413476237h', '12846834rwej8479', 2, 23, 93, '4.8', 'Pounds', 0, 4.8, 1, '10.5', '8.9', '13.9', 'Inches', '1385052561'),
(2, 1, '124823423jj2321', '398214863472e', 40, 24, 93, '1', 'Pounds', 0, 0, 1, '6.8', '8.8', '6.9', 'Inches', '1383760210'),
(3, 1, '9743958234jf8479', '3298759wrfu9w84', 10, 25, 93, '3.6', 'Pounds', 0, 3.6, 1, '4.12', '16.7', '10', 'Inches', '1385052575'),
(4, 1, '2764325923nv298347', 'qwu467342', 0, 26, 94, '24.2', 'Pounds', 0, 0, 1, '27.6', '15.9', '13', 'Inches', '1383761088'),
(5, 1, '82347823h87348', '237628ch78324', 0, 27, 94, '11', 'Pounds', 0, 0, 1, '12.4', '16.7', '20.5', 'Inches', '1383761647'),
(6, 1, '419234723jc92jc', '2138782chn423', 44, 28, 94, '12.1', 'Pounds', 0, 0, 1, '33.5', '13', '17.7', 'Inches', '1383761850'),
(7, 1, '19247893hc2f934', 'q29403n603948', 45, 29, 96, '2.8', 'Pounds', 0, 0, 1, '96', '0.2', '66', 'Inches', '1383762459'),
(8, 1, 'B0006V6DC2', 'B0006V6DC2', 46, 30, 96, '9', 'Pounds', 0, 0, 1, '92', '11', '107', 'Inches', '1383762757'),
(9, 1, ' B005HER56G', ' B005HER56G', 47, 31, 96, '1.1', 'Pounds', 0, 0, 1, '27', '25.5', '0.5', 'Inches', '1383763066'),
(10, 1, 'B000TTV2QS', 'B000TTV2QS', 49, 32, 101, '9', 'Pounds', 0, 0, 1, '24', '15', '15', 'Inches', '1383763300'),
(11, 1, 'JB5629', 'JB5629', 50, 33, 101, '2.6', 'Pounds', 0, 0, 1, '13.50', '4.25', '4.25', 'Inches', '1383763548'),
(12, 1, 'B002OHKLJW', 'B002OHKLJW', 51, 34, 101, '2', 'Pounds', 0, 0, 1, '14.9', '9.4', '19.6', 'Inches', '1383763781'),
(13, 1, '49030', '49030', 52, 35, 102, '1', 'Pounds', 0, 0, 1, '13.2', '3.5', '15.8', 'Inches', '1383764032'),
(14, 1, 'B003PSR1C4', 'B003PSR1C4', 53, 36, 102, '6.4', 'Pounds', 0, 0, 1, '10.8', '1.6', '4.5', 'Inches', '1383846364'),
(15, 1, 'B0046REI60', 'B0046REI60', 54, 37, 102, '9.1', 'Pounds', 0, 0, 1, '5.5', '16', '15.5', 'Inches', '1383846945'),
(16, 1, '043168310642', '043168310642', 56, 38, 175, '1.9', 'Pounds', 0, 0, 1, '1.5', '11', '13.5', 'Inches', '1383847205'),
(17, 1, 'B004BKI2M8', 'B004BKI2M8', 57, 39, 175, '1', 'Pounds', 0, 0, 1, '4.5', '4.1', '4.1', 'Inches', '1383847415'),
(18, 1, ' B0025TMRYQ', ' B0025TMRYQ', 58, 40, 175, '2.7', 'Pounds', 0, 0, 1, '1', '1', '1', 'Inches', '1383847621'),
(19, 1, '609613298844', '609613298844', 59, 41, 103, '3', 'Pounds', 0, 0, 1, '0', '0', '0', 'Inches', '1383847880'),
(20, 1, '077043104736', '077043104736', 60, 42, 103, '12.3', 'Pounds', 0, 0, 1, '3', '3.6', '3.7', 'Inches', '1383848059'),
(21, 1, 'B001R5SBHG', 'B001R5SBHG', 61, 43, 103, '1', 'Pounds', 0, 0, 1, '1', '1', '1', 'Inches', '1383848349'),
(22, 1, 'B0079RJ1QG', 'B0079RJ1QG', 62, 44, 104, '.8', 'Pounds', 0, 38, 1, '5.5', '1', '2.6', 'Inches', '1383848540'),
(23, 1, 'B00D3RNX1K', 'B00D3RNX1K', 63, 45, 104, '12.8', 'Pounds', 0, 0, 1, '8.9', '2', '2', 'Inches', '1383881704'),
(24, 1, 'B0006O4M8Q', 'B0006O4M8Q', 0, 46, 104, '3', 'Pounds', 0, 0, 1, '5.9', '1.5', '2.4', 'Inches', '1383882080'),
(25, 1, 'B009ZM4OFG', 'B009ZM4OFG', 65, 47, 111, '1', 'Pounds', 0, 2.99, 1, '1', '1', '1', 'Inches', '1383933475'),
(26, 1, ' B003YU5SGO', ' B003YU5SGO', 66, 48, 108, '2', 'Pounds', 0, 27.18, 1, '5', '14.7', '5', 'Inches', '1383933816'),
(27, 1, '016000151499', '016000151499', 67, 49, 108, '3.4', 'Pounds', 0, 14.21, 1, '4.7', '11.8', '7.4', 'Inches', '1383934245'),
(28, 1, '1212454', '123123', 2, 2, 0, '12', 'Pounds', 0, 12, 1, '32', '43', '53', 'Inches', '1384311199'),
(29, 1, 'dasda', 'sadasfawsrq3312', 68, 50, 102, '1', 'Pounds', 0, 0, 1, '1', '1', '1', 'Inches', '1384328353'),
(30, 1, '123452342', '1231243245', 0, 51, 236, '12', 'Pounds', 0, 12, 1, '32', '43', '23', 'Inches', '1384486123');
 
-- --------------------------------------------------------
 
--
-- Table structure for table `inventory_child`
--
 
CREATE TABLE IF NOT EXISTS `inventory_child` (
  `ic_id` int(11) NOT NULL AUTO_INCREMENT,
  `i_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `SKU` text NOT NULL COMMENT 'Supplier type only',
  `ic_quan` int(11) NOT NULL,
  `ic_price` float NOT NULL,
  `ic_retail_price` float NOT NULL,
  `ic_leadtime` text NOT NULL,
  `ic_prom_text` text NOT NULL,
  `ic_time` text NOT NULL,
  `ic_map` text NOT NULL,
  `ic_ship_cost` float NOT NULL,
  `ic_ship_country` int(11) NOT NULL,
  PRIMARY KEY (`ic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
 
-- --------------------------------------------------------
 
--
-- Table structure for table `inventory_image`
--
 
CREATE TABLE IF NOT EXISTS `inventory_image` (
  `ii_id` int(11) NOT NULL AUTO_INCREMENT,
  `i_id` int(11) NOT NULL,
  `ii_link` text NOT NULL,
  `ii_name` text NOT NULL,
  `ii_feat` text NOT NULL,
  `ii_time` text NOT NULL,
  PRIMARY KEY (`ii_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
 
-- --------------------------------------------------------
 
--
-- Table structure for table `manufacturer`
--
 
CREATE TABLE IF NOT EXISTS `manufacturer` (
  `m_id` int(11) NOT NULL AUTO_INCREMENT,
  `m_name` text NOT NULL,
  PRIMARY KEY (`m_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=71 ;
 
--
-- Dumping data for table `manufacturer`
--
 
INSERT INTO `manufacturer` (`m_id`, `m_name`) VALUES
(1, 'Samsung'),
(2, 'Apple'),
(3, 'Toshiba'),
(5, 'BuyDBest'),
(6, 'Nokia'),
(7, 'LG'),
(8, 'Philips'),
(9, 'Phizer'),
(10, 'Acer'),
(11, 'Nestle'),
(12, 'Star'),
(13, 'AMD'),
(14, 'Magnolia'),
(15, 'honda'),
(16, 'Mitsubishi'),
(17, 'NIssan'),
(18, 'Toyota'),
(19, 'Ford'),
(20, 'Ferrari'),
(21, 'Subaru'),
(22, 'Panasonic'),
(24, 'Sharp'),
(25, 'IBM'),
(26, 'Caloric'),
(27, 'Whirpool'),
(28, 'HP'),
(29, 'Addidas'),
(30, 'Reebok'),
(31, 'Nike'),
(32, 'Blackberry'),
(38, 'Johnsons and johnson'),
(39, 'California Baby'),
(40, 'hamilton beach'),
(41, 'Sylvania'),
(42, 'Safavieh'),
(43, 'Winsome'),
(44, 'Altra Furniture'),
(45, ' Tommy Hilfiger'),
(46, 'Calvin Klein'),
(47, 'Disney'),
(48, 'Lasko'),
(49, 'Lasko'),
(50, 'Garden Creations'),
(51, 'Dyson'),
(52, 'Allied'),
(53, 'Pumpkin Masters'),
(54, 'Bosch'),
(55, 'GE'),
(56, 'General Electric'),
(57, 'Smart Solar'),
(58, 'Yards & Beyond'),
(59, 'US Advanced Healthcare'),
(60, 'St.Ives'),
(61, 'My Beauty Diary'),
(62, 'Stila'),
(63, 'Burberry'),
(64, 'Jack Black'),
(65, 'Nickelodeon'),
(66, 'Nescafe'),
(67, 'Nature Valley'),
(68, 'adidas'),
(69, 'adidas'),
(70, 'Lego');
 
-- --------------------------------------------------------
 
--
-- Table structure for table `messages`
--
 
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `from_user_id` int(11) unsigned NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` longtext NOT NULL,
  `date_added` datetime NOT NULL,
  `last_modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `site_id` (`site_id`),
  KEY `user_id` (`user_id`),
  KEY `from_user_id` (`from_user_id`),
  KEY `last_modified` (`last_modified`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;
 
--
-- Dumping data for table `messages`
--
 
INSERT INTO `messages` (`id`, `site_id`, `user_id`, `from_user_id`, `subject`, `message`, `date_added`, `last_modified`) VALUES
(1, 1, 5, 2, 'test', 'test', '2013-11-16 05:41:46', '2013-11-16 05:41:46');
 
-- --------------------------------------------------------
 
--
-- Table structure for table `message_notes`
--
 
CREATE TABLE IF NOT EXISTS `message_notes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `message_id` int(11) unsigned NOT NULL,
  `site_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `message` longtext NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `site_id` (`site_id`),
  KEY `message_id` (`message_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
 
-- --------------------------------------------------------
 
--
-- Table structure for table `message_unread`
--
 
CREATE TABLE IF NOT EXISTS `message_unread` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `message_id` int(11) unsigned DEFAULT NULL,
  `message_note_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `site_id` (`site_id`),
  KEY `message_id` (`message_id`),
  KEY `message_note_id` (`message_note_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;
 
--
-- Dumping data for table `message_unread`
--
 
INSERT INTO `message_unread` (`id`, `site_id`, `user_id`, `message_id`, `message_note_id`) VALUES
(1, 1, 5, 1, NULL);
 
-- --------------------------------------------------------
 
--
-- Table structure for table `order_cancel`
--
 
CREATE TABLE IF NOT EXISTS `order_cancel` (
  `ocl_id` int(11) NOT NULL AUTO_INCREMENT,
  `ocl_name` text NOT NULL,
  `user_type` int(11) NOT NULL,
  PRIMARY KEY (`ocl_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
 
-- --------------------------------------------------------
 
--
-- Table structure for table `order_refund`
--
 
CREATE TABLE IF NOT EXISTS `order_refund` (
  `or_id` int(11) NOT NULL AUTO_INCREMENT,
  `or_name` text NOT NULL,
  PRIMARY KEY (`or_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
 
-- --------------------------------------------------------
 
--
-- Table structure for table `order_refund_record`
--
 
CREATE TABLE IF NOT EXISTS `order_refund_record` (
  `orr_id` int(11) NOT NULL AUTO_INCREMENT,
  `bsd_id` int(11) NOT NULL,
  `orr_date` text NOT NULL,
  `orr_prod_amnt` float NOT NULL,
  `orr_ship_amnt` float NOT NULL,
  `orr_total` float NOT NULL,
  `orr_reason` text NOT NULL,
  `orr_memo` text NOT NULL,
  PRIMARY KEY (`orr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
 
-- --------------------------------------------------------
 
--
-- Table structure for table `order_return`
--
 
CREATE TABLE IF NOT EXISTS `order_return` (
  `o_ret_id` int(11) NOT NULL AUTO_INCREMENT,
  `o_ret_name` text NOT NULL,
  PRIMARY KEY (`o_ret_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
 
-- --------------------------------------------------------
 
--
-- Table structure for table `permission`
--
 
CREATE TABLE IF NOT EXISTS `permission` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_name` text NOT NULL,
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;
 
--
-- Dumping data for table `permission`
--
 
INSERT INTO `permission` (`p_id`, `p_name`) VALUES
(1, 'Manage Administrators'),
(2, 'Manage Inventory'),
(3, 'Manage Sales'),
(4, 'View Suppliers'),
(5, 'Approve/Deny Suppliers'),
(6, 'View Buyers'),
(7, 'Approve/Deny Buyers'),
(8, 'Manage Categories'),
(9, 'Manage Manufacturers/Brands'),
(10, 'Manage Products'),
(11, 'Manage Carriers');
 
-- --------------------------------------------------------
 
--
-- Table structure for table `permission_assign`
--
 
CREATE TABLE IF NOT EXISTS `permission_assign` (
  `permission_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  PRIMARY KEY (`permission_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=167 ;
 
--
-- Dumping data for table `permission_assign`
--
 
INSERT INTO `permission_assign` (`permission_id`, `u_id`, `p_id`) VALUES
(102, 16, 4),
(103, 16, 6),
(104, 16, 7),
(105, 16, 10),
(115, 37, 1),
(116, 37, 2),
(117, 37, 3),
(118, 37, 4),
(119, 37, 5),
(120, 37, 6),
(121, 37, 7),
(122, 37, 8),
(123, 37, 9),
(124, 37, 10),
(125, 37, 11),
(166, 38, 11);
 
-- --------------------------------------------------------
 
--
-- Table structure for table `pop_accounts`
--
 
CREATE TABLE IF NOT EXISTS `pop_accounts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` int(11) unsigned NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `enabled` int(1) unsigned NOT NULL DEFAULT '0',
  `hostname` varchar(255) NOT NULL,
  `port` int(11) NOT NULL DEFAULT '110',
  `tls` int(1) NOT NULL DEFAULT '0',
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `download_files` int(1) NOT NULL DEFAULT '0',
  `department_id` int(11) unsigned NOT NULL,
  `priority_id` int(11) unsigned NOT NULL,
  `leave_messages` int(1) NOT NULL DEFAULT '0',
  `smtp_account_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `site_id` (`site_id`),
  KEY `enabled` (`enabled`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
 
-- --------------------------------------------------------
 
--
-- Table structure for table `pop_messages`
--
 
CREATE TABLE IF NOT EXISTS `pop_messages` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `message_id` text NOT NULL,
  `site_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `message_id` (`message_id`(300)),
  KEY `site_id` (`site_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
 
-- --------------------------------------------------------
 
--
-- Table structure for table `queue`
--
 
CREATE TABLE IF NOT EXISTS `queue` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `data` longtext NOT NULL,
  `type` varchar(255) NOT NULL,
  `start_date` datetime DEFAULT NULL,
  `date` datetime NOT NULL,
  `retry` int(11) unsigned DEFAULT '0',
  `site_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `site_id` (`site_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;
 
--
-- Dumping data for table `queue`
--
 
INSERT INTO `queue` (`id`, `data`, `type`, `start_date`, `date`, `retry`, `site_id`) VALUES
(1, 'YTo0OntzOjc6InN1YmplY3QiO3M6MjU6Ik9jZWFudGFpbGVyIC0gTmV3IEFjY291bnQiO3M6NDoiYm9keSI7czoyMjE6IgoJCUhpIHRlc3QsCgkJPGJyIC8+PGJyIC8+CgkJQSB1c2VyIGFjY291bnQgaGFzIGJlZW4gY3JlYXRlZCBmb3IgeW91IGF0IE9jZWFudGFpbGVyLgoJCTxiciAvPjxiciAvPgoJCVVSTDogCQlodHRwOi8vYmV0YW9jZWFudGFpbGVyLmRhdmFvd2Viam9icy5jb20vdGlja2V0PGJyIC8+CgkJTmFtZToJCXRlc3Q8YnIgLz4KCQlVc2VybmFtZToJdGVzdDxiciAvPgoJCVBhc3N3b3JkOgl0ZXN0IjtzOjQ6Imh0bWwiO2I6MTtzOjI6InRvIjthOjI6e3M6MjoidG8iO3M6MTQ6InRlc3RAZ21haWwuY29tIjtzOjc6InRvX25hbWUiO3M6NDoidGVzdCI7fX0=', 'email', '0000-00-00 00:00:00', '2013-11-04 12:56:02', 0, 1),
(2, 'YTo0OntzOjc6InN1YmplY3QiO3M6MjU6Ik9jZWFudGFpbGVyIC0gTmV3IEFjY291bnQiO3M6NDoiYm9keSI7czoyNDc6IgoJCUhpIEphbWVzIEFuZ3ViLAoJCTxiciAvPjxiciAvPgoJCUEgdXNlciBhY2NvdW50IGhhcyBiZWVuIGNyZWF0ZWQgZm9yIHlvdSBhdCBPY2VhbnRhaWxlci4KCQk8YnIgLz48YnIgLz4KCQlVUkw6IAkJaHR0cDovL2JldGFvY2VhbnRhaWxlci5kYXZhb3dlYmpvYnMuY29tL3RpY2tldDxiciAvPgoJCU5hbWU6CQlKYW1lcyBBbmd1YjxiciAvPgoJCVVzZXJuYW1lOglqYW1lc2FuMms8YnIgLz4KCQlQYXNzd29yZDoJamFtZXM1NTUyMTQiO3M6NDoiaHRtbCI7YjoxO3M6MjoidG8iO2E6Mjp7czoyOiJ0byI7czoxOToiamFtZXNhbjJrQGdtYWlsLmNvbSI7czo3OiJ0b19uYW1lIjtzOjExOiJKYW1lcyBBbmd1YiI7fX0=', 'email', '0000-00-00 00:00:00', '2013-11-13 13:16:17', 0, 1),
(3, 'YTo0OntzOjc6InN1YmplY3QiO3M6MjU6Ik9jZWFudGFpbGVyIC0gTmV3IEFjY291bnQiO3M6NDoiYm9keSI7czoyNDE6IgoJCUhpIEdpbGFkIEJhci1MZXYsCgkJPGJyIC8+PGJyIC8+CgkJQSB1c2VyIGFjY291bnQgaGFzIGJlZW4gY3JlYXRlZCBmb3IgeW91IGF0IE9jZWFudGFpbGVyLgoJCTxiciAvPjxiciAvPgoJCVVSTDogCQlodHRwOi8vYmV0YW9jZWFudGFpbGVyLmRhdmFvd2Viam9icy5jb20vdGlja2V0PGJyIC8+CgkJTmFtZToJCUdpbGFkIEJhci1MZXY8YnIgLz4KCQlVc2VybmFtZToJZ2lsYWQ8YnIgLz4KCQlQYXNzd29yZDoJYWRtaW4iO3M6NDoiaHRtbCI7YjoxO3M6MjoidG8iO2E6Mjp7czoyOiJ0byI7czoyMDoiZ2lsYWRibEBidXlkYmVzdC5jb20iO3M6NzoidG9fbmFtZSI7czoxMzoiR2lsYWQgQmFyLUxldiI7fX0=', 'email', '0000-00-00 00:00:00', '2013-11-13 13:32:54', 0, 1),
(4, 'YTo0OntzOjc6InN1YmplY3QiO3M6MjM6Ik9jZWFudGFpbGVyIC0gU3ViamVjdCAxIjtzOjQ6ImJvZHkiO3M6NzU6IgoJCTxwPkRlc2NyaXB0aW9uIDE8L3A+CgkJPGJyIC8+PGJyIC8+CgkJW1RJRDpBSExSVE90Uy0xXQoJCTxiciAvPjxiciAvPgoJCSI7czo0OiJodG1sIjtiOjE7czoyOiJ0byI7YToyOntzOjI6InRvIjtzOjE5OiJqYW1lc2FuMmtAZ21haWwuY29tIjtzOjc6InRvX25hbWUiO3M6MTE6IkphbWVzIEFuZ3ViIjt9fQ==', 'email', '0000-00-00 00:00:00', '2013-11-13 14:25:24', 0, 1),
(5, 'YTo0OntzOjc6InN1YmplY3QiO3M6MjM6Ik9jZWFudGFpbGVyIC0gU3ViamVjdCAxIjtzOjQ6ImJvZHkiO3M6ODA6IgoJCTxwPlJlcGx5IDEgdGVzdDxiciAvPjwvcD4KCQk8YnIgLz48YnIgLz4KCQlbVElEOkFITFJUT3RTLTFdCgkJPGJyIC8+PGJyIC8+CgkJIjtzOjQ6Imh0bWwiO2I6MTtzOjI6InRvIjthOjI6e3M6MjoidG8iO3M6MTk6ImphbWVzYW4ya0BnbWFpbC5jb20iO3M6NzoidG9fbmFtZSI7czoxMToiSmFtZXMgQW5ndWIiO319', 'email', '0000-00-00 00:00:00', '2013-11-13 14:28:12', 0, 1),
(6, 'YTo0OntzOjc6InN1YmplY3QiO3M6MjM6Ik9jZWFudGFpbGVyIC0gU3ViamVjdCAxIjtzOjQ6ImJvZHkiO3M6ODA6IgoJCTxwPlJlcGx5IDEgdGVzdDxiciAvPjwvcD4KCQk8YnIgLz48YnIgLz4KCQlbVElEOkFITFJUT3RTLTFdCgkJPGJyIC8+PGJyIC8+CgkJIjtzOjQ6Imh0bWwiO2I6MTtzOjI6InRvIjthOjI6e3M6MjoidG8iO3M6MTQ6InRlc3RAZ21haWwuY29tIjtzOjc6InRvX25hbWUiO3M6NDoidGVzdCI7fX0=', 'email', '0000-00-00 00:00:00', '2013-11-13 14:28:12', 0, 1),
(7, 'YTo0OntzOjc6InN1YmplY3QiO3M6NDE6Ik9jZWFudGFpbGVyIC0gUHJvYmxlbSBMb2dpbiB0byBteSBhY2NvdW50IjtzOjQ6ImJvZHkiO3M6Njk6IgoJCTxwPnRlc3Rpbmc8L3A+CgkJPGJyIC8+PGJyIC8+CgkJW1RJRDplNkpYa0JhMS0yXQoJCTxiciAvPjxiciAvPgoJCSI7czo0OiJodG1sIjtiOjE7czoyOiJ0byI7YToyOntzOjI6InRvIjtzOjE0OiJ0ZXN0QGdtYWlsLmNvbSI7czo3OiJ0b19uYW1lIjtzOjQ6InRlc3QiO319', 'email', '0000-00-00 00:00:00', '2013-11-15 15:12:31', 0, 1);
 
-- --------------------------------------------------------
 
--
-- Table structure for table `scale`
--
 
CREATE TABLE IF NOT EXISTS `scale` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `scale_name` text NOT NULL,
  PRIMARY KEY (`s_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;
 
--
-- Dumping data for table `scale`
--
 
INSERT INTO `scale` (`s_id`, `scale_name`) VALUES
(1, 'Kilogram'),
(5, 'Pounds');
 
-- --------------------------------------------------------
 
--
-- Table structure for table `scale_dimension`
--
 
CREATE TABLE IF NOT EXISTS `scale_dimension` (
  `sd_id` int(11) NOT NULL AUTO_INCREMENT,
  `sd_name` text NOT NULL,
  PRIMARY KEY (`sd_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;
 
--
-- Dumping data for table `scale_dimension`
--
 
INSERT INTO `scale_dimension` (`sd_id`, `sd_name`) VALUES
(1, 'Inches'),
(2, 'Meters'),
(3, 'Centimeters');
 
-- --------------------------------------------------------
 
--
-- Table structure for table `sessions`
--
 
CREATE TABLE IF NOT EXISTS `sessions` (
  `session_id` varchar(32) NOT NULL DEFAULT '',
  `session_start` datetime NOT NULL,
  `session_start_utc` datetime NOT NULL,
  `session_expire` datetime NOT NULL,
  `session_expire_utc` datetime NOT NULL,
  `session_data` text,
  `session_active_key` varchar(32) DEFAULT NULL,
  `ip_address` varchar(100) DEFAULT NULL,
  `site_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `session_expire` (`session_expire`),
  KEY `site_id` (`site_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
 
--
-- Dumping data for table `sessions`
--
 
INSERT INTO `sessions` (`session_id`, `session_start`, `session_start_utc`, `session_expire`, `session_expire_utc`, `session_data`, `session_active_key`, `ip_address`, `site_id`) VALUES
('348be70a8bfbc96ca07b951056f44ab5', '2013-11-16 06:08:42', '2013-11-15 18:08:42', '2013-11-16 07:08:42', '2013-11-15 19:08:42', '8lgFsgfsBsd1-ksumQqrIhc_vdzungIfvp48aIKeIM1IX-efJGuAs7AO2YBDmBEAKTE-iwzxfdxAJGT95NXLB5qf6OPhRnYdOz20X7_gET3J9ledRbZRWloEiXfPxNi47z5OwV-c6MHKAh_KJ5Dr_dYPgcYVoaRsj5I1KaGLyoj2kzT8Sx9dQcK7Cuyahgz1-CeNqMwxCXJdpihXVFChTcO9B7z1PTMwqEnddB81EEKvv3IqMn7KT4j42aIr_yaZbhKgQtoJeSF8LFsv2LX0PWm9cPC2-mRU2s2OZn1G2rcqZMGfmFu6owv6x-z-detOXxXL2KC2BvZ6uRI6BDnchOYD9acnAX-yWN_8Ukslm4pHz0m6fTpTlgVzTspjjvqS7l5ucPzHWCLYsNC7mis5NvFJZ--XfBSR9HF9tyrQV3s.', NULL, '125.60.240.202', 1),
('53f4b850597d20842cece305d1907832', '2013-11-15 15:15:12', '2013-11-15 03:15:12', '2013-11-15 16:15:12', '2013-11-15 04:15:12', 'ln0iIhPMF-zZ1Gkb15-4tlhFHSrHZaZ7s9ROCIRMhG3eJmbvXD-x25aGmPy-RVbsNapaxPzulLfLfiNiNYL02yHz1wTdiGSvhbjDyzgIOdYpH4e-M4156lPjKYdV6sN-mtZhn1iXczQv8jNSJ2EVqObVGnermFmP8Got5_kmwNF_bI77DeS12UsBsy8jchvioGs0KyAm6bZGb6Qgj8BbbFrGqz66FduDjjKBeEqPFpPpCf0LTGPyqD3F6rZM6nIz-4yEL7ShyNQxvcRQmn9wuRWdo67RAytoID0FhoxCOWXJ64CkWjT7rBtREtZwRPILQwBHgky6gEkOmcuAQGdCevZr-2rVlPm265-z9M_1wr-pqGhWXyJd5_RAkhA14fYmo8yu6hQR5xU2eZuiZXPPHrqhIlFpt8zF8T1deu4ephIwEyIR5kIYciI5whOkMqS2p_vEU_J9vJNM4ZeeiUTCQA..', NULL, '103.14.60.7', 1),
('41f546d539f9087490ef4cabb99b714d', '2013-11-15 15:35:16', '2013-11-15 03:35:16', '2013-11-15 16:35:16', '2013-11-15 04:35:16', 'fNKaouU9kr-VFH_4dREwiMJ9L72G6TsyEsqjfqDKC8lflC9cwwCyq4dDxZ5xscyL', NULL, '125.60.240.202', 1),
('aa572616e50170205fcd2d1b2f5f4871', '2013-11-13 14:39:02', '2013-11-13 02:39:02', '2013-11-13 15:39:02', '2013-11-13 03:39:02', 'hdf4I_tB7YMEHqct4A3sO8pf0F_SlZFcvXjVB_dAMvkLai7xwgAylADqu3CooXHkasf-m2KnNIZp3aOL07eaQ4LHy6ihKKwGI9m9nUOod1zQGsrIe9th52tiFO9q1nAP9-6kIEm8KPnGbRCPxfKH66YvO6_wHQe7cC_yUr6M7p8SbhnvctCV2JOUMgbDN9c2Oqc0eK5ocB1iNJSA3pz4dEYGlZiQL09gXTADqXN4SP7N2ynPBzhhFIUFafwQheyb3lSfJDypRkGmNUPBGzcnNOe9lr23MnB-XmVsCraJZpMKyWN3XxkgbwwanM9gjPKuSEsMMKNb8Fp2_fDpUPZ6Ue0HbSeH4iLb2vLpmm7V7-5TUr5vxoenLf3soj5mITU2Wbz90-Jr96oFZfDgvQEa0w..', NULL, '103.14.60.234', 1);
 
-- --------------------------------------------------------
 
--
-- Table structure for table `shipping_carrier`
--
 
CREATE TABLE IF NOT EXISTS `shipping_carrier` (
  `sc_id` int(11) NOT NULL AUTO_INCREMENT,
  `sc_name` text NOT NULL,
  `sc_desc` text NOT NULL,
  PRIMARY KEY (`sc_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;
 
--
-- Dumping data for table `shipping_carrier`
--
 
INSERT INTO `shipping_carrier` (`sc_id`, `sc_name`, `sc_desc`) VALUES
(1, 'FedEx', ''),
(2, 'DHL', ''),
(3, 'UPS', ''),
(4, 'USPS', ''),
(5, 'DHL Global Mail', ''),
(6, 'UPS Mail Innovations', ''),
(7, 'FedEx SmartPost', ''),
(8, 'OSM', ''),
(9, 'OnTrac', ''),
(10, 'Streamlite', ''),
(11, 'Newgistics', ''),
(12, 'Blue package', ''),
(13, 'Canada Post', ''),
(15, 'test', 'tsetst');
 
-- --------------------------------------------------------
 
--
-- Table structure for table `shipping_carrier_country`
--
 
CREATE TABLE IF NOT EXISTS `shipping_carrier_country` (
  `scc_id` int(11) NOT NULL AUTO_INCREMENT,
  `sc_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  PRIMARY KEY (`scc_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;
 
--
-- Dumping data for table `shipping_carrier_country`
--
 
INSERT INTO `shipping_carrier_country` (`scc_id`, `sc_id`, `country_id`) VALUES
(13, 1, 8),
(14, 1, 15),
(15, 1, 49),
(16, 1, 236),
(17, 2, 5),
(18, 5, 14),
(19, 1, 32),
(20, 1, 7),
(21, 1, 17),
(24, 15, 15),
(25, 2, 236);
 
-- --------------------------------------------------------
 
--
-- Table structure for table `smtp_accounts`
--
 
CREATE TABLE IF NOT EXISTS `smtp_accounts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` int(11) unsigned NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `enabled` int(1) unsigned NOT NULL DEFAULT '0',
  `hostname` varchar(255) NOT NULL,
  `port` int(11) NOT NULL DEFAULT '25',
  `tls` int(1) NOT NULL DEFAULT '0',
  `authentication` int(1) NOT NULL DEFAULT '0',
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email_address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `site_id` (`site_id`),
  KEY `enabled` (`enabled`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
 
-- --------------------------------------------------------
 
--
-- Table structure for table `state`
--
 
CREATE TABLE IF NOT EXISTS `state` (
  `st_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_id` int(11) NOT NULL,
  `st_name` text NOT NULL,
  PRIMARY KEY (`st_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;
 
--
-- Dumping data for table `state`
--
 
INSERT INTO `state` (`st_id`, `c_id`, `st_name`) VALUES
(1, 236, 'Alabama'),
(2, 236, 'Alaska'),
(3, 236, 'Arizona'),
(4, 236, 'Arkansas'),
(5, 236, 'California'),
(6, 236, 'Colorado'),
(7, 236, 'Connecticut'),
(8, 236, 'Delaware'),
(9, 236, 'Florida'),
(10, 236, 'Georgia'),
(11, 236, 'Hawaii'),
(12, 236, 'Idaho'),
(13, 236, 'Illinois'),
(14, 236, 'Indiana'),
(15, 236, 'Iowa'),
(16, 236, 'Kansas'),
(17, 236, 'Kentucky'),
(18, 236, 'Louisiana'),
(19, 236, 'Maine'),
(20, 236, 'Maryland'),
(21, 236, 'Massachusetts'),
(22, 236, 'Michigan'),
(23, 236, 'Minnesota'),
(24, 236, 'Mississippi'),
(25, 236, 'Missouri'),
(26, 236, 'Montana'),
(27, 236, 'Nebraska'),
(28, 236, 'Nevada'),
(30, 236, 'Hampshire'),
(31, 236, 'New Jersey'),
(32, 236, 'New Mexico'),
(33, 236, 'New York'),
(34, 236, 'North Carolina'),
(35, 236, 'North Dakota'),
(36, 236, 'Ohio'),
(37, 236, 'Oklahoma'),
(38, 236, 'Oregon'),
(39, 236, 'Pennsylvania'),
(40, 236, 'Rhode Island'),
(41, 236, 'South Dakota'),
(42, 236, 'Tennessee'),
(43, 236, 'Texas'),
(44, 236, 'Utah'),
(45, 236, 'Vermont'),
(46, 236, 'Virginia'),
(47, 236, 'Washington'),
(48, 236, 'West Virginia'),
(49, 236, 'Wisconsin'),
(50, 236, 'Wyoming');
 
-- --------------------------------------------------------
 
--
-- Table structure for table `storage`
--
 
CREATE TABLE IF NOT EXISTS `storage` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `uuid` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `extension` varchar(255) DEFAULT NULL,
  `description` text,
  `type` varchar(255) DEFAULT NULL,
  `category_id` int(11) unsigned DEFAULT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `site_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uuid` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
 
-- --------------------------------------------------------
 
--
-- Table structure for table `supplier_shipprod_info`
--
 
CREATE TABLE IF NOT EXISTS `supplier_shipprod_info` (
  `ssi_id` int(11) NOT NULL AUTO_INCREMENT,
  `bsd_id` int(11) NOT NULL,
  `ssi_track` text NOT NULL,
  `ssi_shipMethod` text NOT NULL,
  `ssi_carrier` text NOT NULL,
  `ssi_country` int(11) NOT NULL,
  `ssi_start` text NOT NULL,
  `ssi_end` text NOT NULL,
  `ssi_time` text NOT NULL,
  `u_id` int(11) NOT NULL,
  `ssi_status` int(11) NOT NULL,
  `ssi_shipExtra` float NOT NULL,
  `ssi_supMemo` text NOT NULL,
  PRIMARY KEY (`ssi_id`),
  KEY `ssi_id` (`ssi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
 
-- --------------------------------------------------------
 
--
-- Table structure for table `tickets`
--
 
CREATE TABLE IF NOT EXISTS `tickets` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `date_added` datetime NOT NULL,
  `last_modified` datetime NOT NULL,
  `subject` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `priority_id` int(11) unsigned NOT NULL,
  `state_id` int(11) unsigned NOT NULL DEFAULT '1',
  `assigned_user_id` int(11) unsigned DEFAULT NULL,
  `key` varchar(8) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `merge_ticket_id` int(11) unsigned DEFAULT NULL,
  `site_id` int(11) unsigned NOT NULL,
  `submitted_user_id` int(11) unsigned DEFAULT NULL,
  `department_id` int(11) unsigned NOT NULL DEFAULT '1',
  `html` int(1) unsigned NOT NULL DEFAULT '0',
  `date_state_changed` datetime DEFAULT NULL,
  `access_key` varchar(32) DEFAULT NULL,
  `pop_account_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `state_id` (`state_id`),
  KEY `assigned_user_id` (`assigned_user_id`),
  KEY `priority_id` (`priority_id`),
  KEY `user_id` (`user_id`),
  KEY `last_modified` (`last_modified`),
  KEY `site_id` (`site_id`),
  KEY `submitted_user_id` (`submitted_user_id`),
  KEY `department_id` (`department_id`),
  KEY `date_state_changed` (`date_state_changed`),
  KEY `access_key` (`access_key`),
  KEY `pop_account_id` (`pop_account_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;
 
--
-- Dumping data for table `tickets`
--
 
INSERT INTO `tickets` (`id`, `date_added`, `last_modified`, `subject`, `description`, `user_id`, `priority_id`, `state_id`, `assigned_user_id`, `key`, `name`, `email`, `merge_ticket_id`, `site_id`, `submitted_user_id`, `department_id`, `html`, `date_state_changed`, `access_key`, `pop_account_id`) VALUES
(1, '2013-11-13 14:25:24', '2013-11-13 14:28:12', 'Subject 1', '                                                                    <p>Description 1</p>                                                            ', 4, 1, 1, 2, 'AHLRTOtS', NULL, NULL, NULL, 1, 4, 2, 1, '2013-11-13 14:27:05', 'hzJT50Fswx2tAZKxdcyDlE3bjRpvE5CR', NULL),
(2, '2013-11-15 15:12:31', '2013-11-15 15:12:31', 'Problem Login to my account', '<p>testing</p>', 2, 1, 1, NULL, 'e6JXkBa1', NULL, NULL, NULL, 1, 2, 1, 1, '2013-11-15 15:12:31', 'vRSWFtNcarngCd6G3LFDarhkGoZyCVWK', NULL);
 
-- --------------------------------------------------------
 
--
-- Table structure for table `ticket_departments`
--
 
CREATE TABLE IF NOT EXISTS `ticket_departments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `enabled` int(1) unsigned NOT NULL DEFAULT '1',
  `site_id` int(11) unsigned NOT NULL,
  `public_view` int(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `enabled` (`enabled`),
  KEY `site_id` (`site_id`),
  KEY `public_view` (`public_view`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;
 
--
-- Dumping data for table `ticket_departments`
--
 
INSERT INTO `ticket_departments` (`id`, `name`, `enabled`, `site_id`, `public_view`) VALUES
(1, 'Default Department', 1, 1, 1),
(2, 'Accounting', 1, 1, 1),
(3, 'Inventory', 1, 1, 1),
(4, 'Buyer Supports', 1, 1, 1),
(5, 'Supplier Supports', 1, 1, 1);
 
-- --------------------------------------------------------
 
--
-- Table structure for table `ticket_fields`
--
 
CREATE TABLE IF NOT EXISTS `ticket_fields` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` int(11) unsigned NOT NULL,
  `value` varchar(255) NOT NULL,
  `ticket_field_group_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `site_id` (`site_id`),
  KEY `ticket_field_group_id` (`ticket_field_group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
 
-- --------------------------------------------------------
 
--
-- Table structure for table `ticket_field_group`
--
 
CREATE TABLE IF NOT EXISTS `ticket_field_group` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` int(11) unsigned NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `client_modify` int(1) NOT NULL,
  `enabled` int(1) NOT NULL,
  `default_field_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `site_id` (`site_id`),
  KEY `enabled` (`enabled`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;
 
--
-- Dumping data for table `ticket_field_group`
--
 
INSERT INTO `ticket_field_group` (`id`, `site_id`, `name`, `type`, `client_modify`, `enabled`, `default_field_id`) VALUES
(1, 1, 'Deadline', 'textinput', 1, 1, NULL);
 
-- --------------------------------------------------------
 
--
-- Table structure for table `ticket_field_values`
--
 
CREATE TABLE IF NOT EXISTS `ticket_field_values` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` int(11) unsigned NOT NULL,
  `ticket_id` int(11) unsigned NOT NULL,
  `ticket_field_group_id` int(11) unsigned NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `site_id` (`site_id`),
  KEY `ticket_id` (`ticket_id`),
  KEY `ticket_field_group_id` (`ticket_field_group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;
 
--
-- Dumping data for table `ticket_field_values`
--
 
INSERT INTO `ticket_field_values` (`id`, `site_id`, `ticket_id`, `ticket_field_group_id`, `value`) VALUES
(1, 1, 2, 1, 'none');
 
-- --------------------------------------------------------
 
--
-- Table structure for table `ticket_notes`
--
 
CREATE TABLE IF NOT EXISTS `ticket_notes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ticket_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `description` longtext NOT NULL,
  `date_added` datetime NOT NULL,
  `site_id` int(11) unsigned NOT NULL,
  `html` int(1) unsigned NOT NULL DEFAULT '0',
  `private` int(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `ticket_id` (`ticket_id`),
  KEY `user_id` (`user_id`),
  KEY `site_id` (`site_id`),
  KEY `private` (`private`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;
 
--
-- Dumping data for table `ticket_notes`
--
 
INSERT INTO `ticket_notes` (`id`, `ticket_id`, `user_id`, `description`, `date_added`, `site_id`, `html`, `private`) VALUES
(1, 1, 2, '<p>Reply 1 test<br></p>', '2013-11-13 14:28:12', 1, 1, 0);
 
-- --------------------------------------------------------
 
--
-- Table structure for table `ticket_priorities`
--
 
CREATE TABLE IF NOT EXISTS `ticket_priorities` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `enabled` int(1) NOT NULL DEFAULT '1',
  `site_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `site_id` (`site_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;
 
--
-- Dumping data for table `ticket_priorities`
--
 
INSERT INTO `ticket_priorities` (`id`, `name`, `enabled`, `site_id`) VALUES
(1, 'Low', 1, 1),
(2, 'Medium', 1, 1),
(3, 'High', 1, 1);
 
-- --------------------------------------------------------
 
--
-- Table structure for table `ticket_status`
--
 
CREATE TABLE IF NOT EXISTS `ticket_status` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `colour` varchar(255) NOT NULL,
  `enabled` int(1) NOT NULL DEFAULT '1',
  `active` int(1) NOT NULL DEFAULT '1',
  `site_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `site_id` (`site_id`),
  KEY `active` (`active`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;
 
--
-- Dumping data for table `ticket_status`
--
 
INSERT INTO `ticket_status` (`id`, `name`, `colour`, `enabled`, `active`, `site_id`) VALUES
(1, 'Open', 'e93e3e', 1, 1, 1),
(2, 'Closed', '71c255', 1, 0, 1),
(3, 'Pending', 'd7f018', 1, 1, 1);
 
-- --------------------------------------------------------
 
--
-- Table structure for table `translation`
--
 
CREATE TABLE IF NOT EXISTS `translation` (
  `tr_id` int(11) NOT NULL AUTO_INCREMENT,
  `i_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `tr_title` text NOT NULL,
  `tr_short_desc` text NOT NULL,
  `tr_desc` text NOT NULL,
  `tr_time` text NOT NULL,
  PRIMARY KEY (`tr_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;
 
--
-- Dumping data for table `translation`
--
 
INSERT INTO `translation` (`tr_id`, `i_id`, `c_id`, `tr_title`, `tr_short_desc`, `tr_desc`, `tr_time`) VALUES
(1, 1, 236, 'Hamilton Beach 12-Cup Coffeemaker', 'Coffee Maker\n                                            ', 'First cup convenience - pause and serve function lets you pour a cup while coffee is brewing\nCone-shaped filter basket extracts coffee''s rich, complex flavor\nLarge water window for fast, easy filling\nNonstick keep-hot plate\nLighted "on" button                                        ', '1383759587'),
(2, 2, 236, 'Hamilton Beach 25475 Breakfast Sandwich Maker', 'Electric sandwich Maker                                       ', 'Ready in 5 minutes, cook delicious breakfast sandwiches in the comfort of your own home\nUse your own fresh ingredients, including eggs, cheese and much more\nMake sandwiches with English muffins, biscuits, small bagels, and more\nAll removable parts are dishwasher safe; surfaces are covered with durable, nonstick coating\nQuick and easy recipes included                                        ', '1383760210'),
(3, 3, 236, 'Sylvania SW-086 Nonstick Omelet Maker', 'Omelette maker                                        ', 'Enjoy Omelets in Minutes Well-designed and practical the Sylvania Omelet Maker creates perfectly shaped and delicious omelets every time. The nonstick surface evenly cooks the omelet and makes cleanup easy. The cool touch housing safeguards you from accidental burns. Cooks 1 egg in 5-6 minutes and 2 eggs in 7-8 minutes. Voltage: 120 VAC, Frequency: 60 Hz, Wattage: 750 W, Amperage: 6.25 A. UL Listed                                       ', '1383760546'),
(4, 4, 236, 'Safavieh Carrie Storage Side Table w/ 2 Wicker Baskets', 'side table\nThe distressed black finish of this side table is sure to update any decor\nThis storage table features two wicker baskets drawers, each measuring 13 inches wide by 10.4 inches deep by 4.7 inches tall\nCrafted of solid pine wood\nPerfect for a living room, den, library, bedroom or study\nNo assembly required, this storage table measures 15.9 inches wide by 13 inches deep by 27.6 inches tall                                ', 'Add a stylish touch to your home with the Safavieh American Home Collection Newburgh Distressed Black Storage Side Table. This modern table features a contemporary style and functional design. Constructed with a sturdy wood frame, the Newburgh Storage Table features two wicker baskets and is finished in a versatile distressed black hue. The Newburgh Storage Table will be a welcome addition to any room. The Newburgh Storage Table features two wicker baskets drawers, each giving ample storage with dimensions of 13 -Inch wide by 10.4 -Inch deep by 4.7 -Inch tall. No assembly required                                 ', '1383761088'),
(5, 5, 236, 'Winsome Omaha Storage Rack with Foldable Basket', 'Omaha Storage Rack comes with 2 foldable baskets\nRack made of wood in black color\nBaskets made from Corn Husk in Chocolate color\n\n                                          ', '\n          Simple with plenty of storage for this Omaha Storage Rack with Foldable Baskets. Choose from 2, 3 or 4 baskets rack. Baskets open size is 13.98-Inch Width by 10.63-Inch Depth by 7.48-Inch Height and Folded size is 23.03-Inch by 9.84-Inch by 1.97-Inch. Overall 2 Baskets Storage Rack size is 16.73-Inch Width by 12.40-Inch Depth by 20.47-Inch Height and finished in Black color. Rack is made with combination of solid and composite wood. Basket is Corn Husk. Assembly Require.                 ', '1383761647'),
(6, 6, 236, 'Altra Furniture Storage Unit with 5 Baskets', '5 woven baskets hold personal items\nMade of Solid wood\nRestoration Gray finish\n                                          ', 'This adorable storage accent piece not only comes in a trendy gray finish but also has storage bins to keep your stuff organized and clutter free.\n                                            ', '1383761850'),
(7, 7, 236, 'Tommy Hilfiger Pillow Case and Print Sheet Set', 'Twin set includes flat sheet, fitted sheet and pillowcase\nFitted sheet has elastic all around for better fit\nFabric is brushed for extra softness\nCotton Percale and polyester blend for easy care\n                                          ', 'Tommy Hilfiger Novelty Print Sheet Sets are made of extra soft percale cotton polyester blend. The playful patterns offer instant updates to the bedroom with Tommy Hilfiger Signature Style. They are also easy care. Each set includes Flat Sheet, Fitted Sheet, set of Pillowcases (1 pillowcase included with Twin and Twin Extra Long size).                                           ', '1383762459'),
(8, 8, 236, 'Calvin Klein Home Bamboo Flower King Comforter, Hyacinth', '"NEW" Bamboo Flower Comforter by Calvin Klein Home Collection.\nSize: King 107 in. x 92 in. - 100% Pure Cotton fabric with plush Fiber Filling.\nEasy Care: Machine Wash & Dry.\nBrand New in the original package, tag may be clipped to prevent store returns.\nPattern: Bamboo Flower. Reverse side is Hyacinth Rhythmic Stripe.\n                                          ', '\nTraditional Japanese floral on a textured print background. 100% pure combed cotton percale. 220 thread count, vat dyed and printed.\n                                            ', '1383762757'),
(9, 9, 236, 'Disney''s Mickey Mouse Bath Rug ', '100% cotton\n25.5" Xx 27" bath rug\nSpot clean only with cold water and mild detergent.\nLine dry out of direct sunlight\nNot for use for children 3 years of age and under.\n                                         ', 'See you real soon! The ever-lovable Mickey Mouse steals the show in this bath rug from Disney, featuring a classic Mickey face in pure tufted cotton for a playful addition to your bathroom.                                       ', '1383763066'),
(10, 10, 236, 'Lasko 755320 Ceramic Tower Heater with Digital Display and Remote Control', '1500 watts of comfort.\nTop-access push-button controls with digital display; low/high speed settings\nWidespread oscillation; programmable thermostat; 8-hour timer; quiet operation\nFully asembled. 8.5" x 7.25" x 23" tall\nTower heater with elongated self-regulating ceramic heating element, automatic overheat protection and cool-touch housing. ETL listed\n                                         ', 'Lasko''s #755320 Tower Heater with multi-function remote control will quietly and effectively warm any room with style. Digital controls are easy to use.\n                                         ', '1383763300'),
(11, 11, 236, 'Garden Creations JB5629 Solar-Powered LED Accent Light, Set of 8', 'Easy to install--no wires to run\nSolar-powered lights automatically turn on at dusk and off at dawn\nMade from durable weatherproof materials\nSuper-bright white LED lights charged by the sun\nApproximately 13.5 inches tall                                         ', 'No wiring or electricity is required to install these Garden Creations solar-powered LED accent lights. They soak up the sun''s energy by day and shine brightly at night. The white LED lights illuminate walks, gardens, and patios. This set includes eight lights, each of which measures 4.25 inches by 4.25 inches by 13.5 inches.\n                                          ', '1383763548'),
(12, 12, 236, 'Dyson Home Cleaning Kit', 'Dyson engineered\n1 yr warranty\n                                         ', 'Includes tools for soft dusting, removing stubborn dirt and cleaning hard to reach places\n                                         ', '1383763781'),
(13, 13, 236, 'Allied 49030 180-Piece Home Maintenance Tool Set', '80-piece home maintenance and project tool set\nSteel and rubber construction for optimal durability and comfort\nClaw hammer, linesman and long-nose pliers, 8-inch torpedo level, SAE and metric sockets, 3/8-inch spark-plug socket, and more\nRatcheting bit handle with 10-piece bit driver set, 4-piece screwdrivers, 12-inch tape\nOrganized in a compact carrying case (16 by 13 by 3.5 inches)\n                                            ', 'Packed with 180 high-quality steel and rubber tools for general home use, this handy tool kit is a great way to keep tools for home maintenance, repair, and special projects in easy reach. A handy claw hammer pulls nails and hammers in small to medium-size nails for anything from mounting shelving to putting up picture frames. Linesman and long-nose pliers are great for gripping things in tight quarters. And, an 8-inch torpedo level takes the guesswork out of hanging things straight. Standard and metric socket sets and ratchets have you covered for bolt and nut attachments large and small. And a 3/8-inch spark-plug socket helps with the small-engine maintenance. The kit also includes a ratcheting bit handle and 10-piece bit driver set, 4 screwdrivers, a 12-foot tape measure with fractional readout, and more! Organized in a compact gray storage/carrying case, you??ll know just where that tool is when you need it most. If you buy all these tools individually at the hardware store, you''ll easily pay twice as much                 ', '1383764032'),
(14, 14, 236, 'Power Saw - Pumpkin Carving Tool', 'plastic, metal\nPower Saw Handle\n2 Blades Included\n2 Patterns Included\n\n                                         ', 'Pumpkin Masters Power Saw makes carving your Jack-O-Lantern easy and quick. Carve custom designs with ease. Batteries included.\n                                           ', '1383846364'),
(15, 15, 236, 'Bosch DDB180-02 18-Volt Lithium-Ion 3/8-Inch Cordless Drill/Driver Kit with 2 Batteries, Charger and Case', 'Compact drill/driver weighs just 3 pounds--helps you work for hours with less fatigue\nFeatures 0-400/0-1,300 RPM and 400 in./lbs. of torque\nWorks with both Slim Pack and Fat Pack batteries (two 18-volt Slim Pack batteries included)\n15-position clutch settings for precise driving applications\nIntegrated LED light is great for dark or enclosed areas\n                                         ', 'Compact drill/driver weighs just 3 pounds--helps you work for hours with less fatigue\nFeatures 0-400/0-1,300 RPM and 400 in./lbs. of torque\nWorks with both Slim Pack and Fat Pack batteries (two 18-volt Slim Pack batteries included)\n15-position clutch settings for precise driving applications\nIntegrated LED light is great for dark or enclosed areas\n                                         ', '1383846945'),
(16, 16, 236, 'GE 13W (60W Equivalent) Energy SmartTM Light Bulbs ', 'Replace your 60 watt bulbs with these energy efficient 13 watt bulbs that last 5 years per bulb.\nSmall compact size. Easy open store pack.\nElectronic flicker-free starting.\n1 CFL bulb lasts as long as 8 incandescent bulbs.\nLight output - 825 lumens. Energy used - 13 watts. Life - 8000 hours.\n                                            ', 'Color Temperature\n2700 Kelvin\n\nWattage\n13 Watts\n\nBulb Voltage\n120.00\n                                           ', '1383847205'),
(17, 17, 236, 'Smart Solar 3782WRM2 Black Umbrella Hanging Solar Lantern, 2-Pack', 'Open bottom lantern is ideal for clipping to umbrella for ambient lighting around table\nLanterns can be placed on flat surfaces and have energy saving LEDs in each light\nPowered by an integrated solar panel that automatically turns the lamp on at dusk and off at dawn\nUp to 8 hours of light in darkness when fully charged\nIncludes handle, hanging clips and replaceable rechargeable Ni-MH battery\n                                           ', 'An elegant accessory for any garden, this beautiful fountain creates a relaxing atmosphere designed to bring the beauty of Nature to your backyard. No operating costs or maintenance required.                                         ', '1383847415'),
(18, 18, 236, 'Yards & Beyond Dual Use Coach Style Solar Lights - 2 Pack', 'Dual Use Coach Style Solar Light\nIncludes Shepherds Hook & Post, Black Plastic\n1 Natural White LED\n1 600 mAH "AA" NiMH Rechargeable Battery Included\n\n                                         ', 'Yards & Beyond Dual Use Coach Style Solar Lights - 2 Pack                                           ', '1383847621'),
(19, 19, 236, 'BriteLeafs 4-in-1 Electric Facial & Body Brush Spa Cleaning System', '\n Restore soft and smooth skin, reduce and erase fine lines & blackheads\nRotating brush to exfoliate dead skin cells to reveal radiant and youthful skin\n2 settings: "Low" for daily cleaning, "High" for exfoliation, uses 2 "AA" batteries\n4 attachments included: a) Soft Sponge: Gently massages your skin to increase skin elasticity and better facial product absorption. b) Soft Brush: Gently rotate to deep clean your skin. Used with your facial wash to get better results. c) Pumice: Gently exfoliates, polishes and removes rough callus skin on foot or elbow d) Nail polish: Smoothing and buffing nails                                     ', '4-in-1 battery operated Electric Face & Body Spa Cleaning Set Features: 1. Restore soft and smooth skin 2. Exfoliate dead skin cells to reveal radiant and youthful skin 3. Reduce and erase fine lines & blackheads 4. Compact and light-weight 5. 2 settings: "Low" for daily cleaning, "High" for exfoliation 6. 4 attachments included: a) Soft Sponge: Gently massages your skin to increase skin elasticity and better facial product absorption. b) Soft Brush: Gently rotate to deep clean your skin. Used with your facial wash to get better results. c) Pumice: Gently exfoliates, polishes and removes rough callus skin on foot or elbow d) Nail polish: Smoothing and buffing nails Specifications: 1. Power: 2 "AA" batteries 2. Dimensions: 130 x 70 x 48 mm 3. Weight: 5oz 4. Operation condition: Temperature 10-40''C (50-104''F), Humidity 30%-90% 5. This product is not waterproof and can not be used in the shower\n                                            ', '1383847880'),
(20, 20, 236, 'St. Ives Facial Moisturizer, Timeless Skin Collagen Elastin', 'One, 10-ounce jar of St. Ives Timeless Skin Collagen Elastin Facial Moisturizer\nFormulated to reduce the appearance of fine lines and maintain a youthful appearance\nMade with collagen and elastin proteins\nHydrates for visibly softer, smoother skin\nSt. Ives formulas use effective, natural ingredients for fresher, younger looking skin\n                                          ', 'Timeless skin collagen elastin facial moisturizer is made with collagen and elastin proteins. It hydrates for visibly softer, smoother skin. For this item the Lot Code Format is: MMDDYPPBB.Translated this means this item was produced on: For example : Lot code 06053JB35 = June 5, 2013 from JB05. The shelf life on this item is 630 days from manufacture date.\n                                           ', '1383848059'),
(21, 21, 236, 'My Beauty Diary Mask- Aloe (10 pcs) by My Beauty Diary', 'oisturizes, repairs, revitalizes and nourishes skin\nFor use on normal skin, especially recommended for dry and damaged skin\n\n                                           ', 'Aloe - provides skin with adequate moisture content Rose - improves dry and rough skin texture Amino acid - nourishes and moisturizes skin Hyaluronic acid - highly effective in moisture retention\n                                           ', '1383848349'),
(22, 22, 236, 'stila Stay All Day 10-in-1 HD Beauty Balm, 1.5 fl. oz.', 'Stila''s Stay All Day 10-in-1 HD Beauty Balm is a priming beauty balm that seemingly turns back the hands of time by visibly improving the look and feel of skin and creating an impeccable canvas for flawless makeup application.\nBenefits\nHelps reduce pore size. Provides oil and blemish control. Reduces redness and skin irritation.\n                                            ', '\nStila''s Stay All Day 10-in-1 HD Beauty Balm is a priming beauty balm that seemingly turns back the hands of time by visibly improving the look and feel of skin and creating an impeccable canvas for flawless makeup application.\nBenefits\nHelps reduce pore size. Provides oil and blemish control. Reduces redness and skin irritation.                                         ', '1383848540'),
(23, 23, 236, 'BURBERRY Body Milk, 85 ml.', 'Burberry Body Milk is a lightweight, moisturising body milk spray infused with Burberry Body Eau de Parfum.\n                                          ', 'Burberry Body Milk is a lightweight body lotion spray infused with Burberry Body Eau de Parfum. Natural oils moisturise the skin to leave it soft, smooth and hydrated. Layer with the Eau de Parfum or Intense fragrance for added depth and longevity. The body milk is presented in a multi-faceted glass bottle. 85ml. Made in France\n                                         ', '1383881704'),
(24, 24, 236, 'Jack Black Industrial Strength Hand Healer', 'This rich, nongreasy formula helps heal and soothe dry, chapped, cracked hands. Road-tested by golfers, carpenters, and chefs, this hard-working hand cream repairs tough, calloused skin and cuticles, providing lasting relief.\n                                            ', '\nThis rich, nongreasy formula helps heal and soothe dry, chapped, cracked hands. Road-tested by golfers, carpenters, and chefs, this hard-working hand cream repairs tough, calloused skin and cuticles, providing lasting relief.                                         ', '1383882080'),
(25, 25, 236, 'SpongeBob SquarePants: It''s A SpongeBob Christmas ', 'At Christmastime in Bikini Bottom, everyone''s excited except Plankton, who always gets a lump of coal from Santa. But he vows this year he''ll finally get his wish - the Krabby Patty formula! He''s gonna make everyone in Bikini Bottom bad!\n                                            ', '\nAt Christmastime in Bikini Bottom, everyone''s excited except Plankton, who always gets a lump of coal from Santa. But he vows this year he''ll finally get his wish - the Krabby Patty formula! He''s gonna make everyone in Bikini Bottom bad!                                          ', '1383933475'),
(26, 26, 236, 'Nescafe Dolce Gusto for Nescafe Dolce Gusto Brewers, Skinny Cappuccino, 16 Count (Pack of 3)', 'Pack of 3, 16-count boxes of Nescafe Dolce Gusto Cappuccino Skinny Capsules\nSlightly sweetened milk on top of rich espresso--just 50 calories\nSingle-serve capsule system offers coffeehouse quality drinks without the messy cleanup\nPop in the capsule for a single-serve coffee experience\nCompatible with DeLonghi Nescafe Dolce Gusto Genio, Piccolo, Melody 2, Circolo, and Creative coffee makers\n                                           ', 'Pack of 3, 16-count boxes of Nescafe Dolce Gusto Cappuccino Skinny Capsules\nSlightly sweetened milk on top of rich espresso--just 50 calories\nSingle-serve capsule system offers coffeehouse quality drinks without the messy cleanup\nPop in the capsule for a single-serve coffee experience\nCompatible with DeLonghi Nescafe Dolce Gusto Genio, Piccolo, Melody 2, Circolo, and Creative coffee makers                                        ', '1383933816'),
(27, 27, 236, 'Nature Valley Chewy Yogurt Granola Bars, 6 Count Box', 'Pack of six, 6-counts per box (total of 36 counts)\nYogurt coated blend\nGood source of whole grain\nHigh in calcium\nNo trans fat or cholesterol\n                                          ', 'Nature Valley Chewy Yogurt Granola Bars, Variety Pack of Vanilla and Strawberry are chewy granola bars with a naturally flavored yogurt coating blend, chewy all natural goodness with a sweet yogurt coating, giving you a boost of calcium and flavor. As a good source of whole grain, these bars are the perfect delicious snack that fulfill your cravings while delivering the energy you need with absolutely no trans fat or cholesterol.\n                                         ', '1383934245'),
(28, 28, 236, 'test', 'fsdf                         ', 'sdf\n                                           ', '1384311199'),
(29, 29, 236, '1', '1', '1', '1384328353'),
(30, 30, 236, 'Leog Game(Limited Edition)', 'Tes', 'Test', '1384486040');
 
-- --------------------------------------------------------
 
--
-- Table structure for table `user`
--
 
CREATE TABLE IF NOT EXISTS `user` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_username` text NOT NULL,
  `u_pass` text NOT NULL,
  `u_fname` text NOT NULL,
  `u_lname` text NOT NULL,
  `u_email` text NOT NULL,
  `u_company` text NOT NULL,
  `u_permit` text NOT NULL,
  `u_type` int(11) NOT NULL,
  `u_status` int(11) NOT NULL,
  `u_admin_approve` int(11) NOT NULL DEFAULT '0',
  `u_verify_code` text NOT NULL,
  `u_time` text NOT NULL,
  `u_pic` text NOT NULL,
  `u_superAdmin` int(11) NOT NULL,
  `u_restriction` text NOT NULL,
  `u_return` text NOT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;
 
--
-- Dumping data for table `user`
--
 
INSERT INTO `user` (`u_id`, `u_username`, `u_pass`, `u_fname`, `u_lname`, `u_email`, `u_company`, `u_permit`, `u_type`, `u_status`, `u_admin_approve`, `u_verify_code`, `u_time`, `u_pic`, `u_superAdmin`, `u_restriction`, `u_return`) VALUES
(1, 'admin', 'XlqLC1d1xvTMWcDWRkjMf5q573XDQOYGCzuON8eCkbFDrEqfPmN/XwkLqxwbdgkElx5tgXdnWcBGI3UWWX3+2g==', 'James Angub', '', '1jamesan2k@gmail.com', '', '', 1, 1, 0, '', '0000-00-00', 'http://betaoceantailer.spottyme.com/avatars/11.png', 1, '', ''),
(26, 'jamesan2k', 'fvmDFzhyY3zZa5I6TP1lmQRE2sUtFZCPwzmwyZh73cRg5UtBshkuzxhmdywS3axCrShHPIeOHfxI25yP0AZlRw==', 'James', 'Angub', '2jamesan2k@gmail.com', 'Jaimedoy Enterprise', '2431412321423', 2, 1, 1, 'gvlxn08oipjssnfvt0numhqzf', '1370392808', 'http://betaoceantailer.spottyme.com/avatars/26.png', 0, 'd dfgev', 'returns returns'),
(27, 'adrianangub', 'ni3Jxams566PVEMMxW+h76axGjW5VsYwI4gwrEJXUje3bz3a9Q2YjMi3F3LjpAP1pxEMFRHkAkSCMfwko58jZA==', 'Adrian', 'Angub', '3jamesan2k@gmail.com', 'Doy Association', '412312424', 3, 1, 1, '08lka5baxduy2dh6oohspggwn', '1370394570', 'http://betaoceantailer.spottyme.com/avatars/27.png', 0, '', ''),
(28, 'rosieysomera', '1Nokj11QHTRwB7RArGl/PAWeiRgpHiI+06e6WMPGE6M8S6f56AxGpOzIUT3J4i9MXZKsve+OaE55H1ZGqNb6Tg==', 'Mary Rose', 'Somera', 'rosette1331@yahoo.com', '', '', 3, 1, 1, 'vgx3y0q6n17g57m2avnk6mv6d', '1371516082', '', 0, '', ''),
(33, 'james.angub', '6OiTodNxIBzlKrZ+bWscNaMG23/Vi0BWeIBY+WqgMqaWw9V4jsye5ka+xjl2cnmx50SmGVXaLS7lrNjGTaPZkQ==', 'Jaime', 'Doy', 'jamesan2k@gmail.com', '', '', 1, 1, 1, '', '1371602467', '', 0, '', ''),
(34, 'jaimedoy', 'fvmDFzhyY3zZa5I6TP1lmQRE2sUtFZCPwzmwyZh73cRg5UtBshkuzxhmdywS3axCrShHPIeOHfxI25yP0AZlRw==', 'lanz', 'bahinting', 'lorenz53192@gmail.com', 'jaime Doy Inc', '23548954', 2, 1, 1, 'dfjcwsyyl3xertehid52egtor', '1371606546', '', 0, '', ''),
(37, 'giladbl', 'cbUX+roWWzMevvqlleKXhRVdsKKBnSo4FfiK6aCC2NSbXt+8/5Rwq8lxGmSWN3cbEdLgTo4tVrSSadQdaSjkeQ==', 'Gil', 'Bar', 'giladbl@buydbest.com', '', '', 1, 1, 1, '', '1375232976', '', 0, '', ''),
(38, 'mary_rose', 'wxFmY5ZAFyYTebDosB93tQxpX763ces1NIpgIHYjVb9kQEnDbO29H167oq28VUTYKUk1wIgV7oPDmA6XbIv+pg==', 'Mary Rose', 'Somera', 'maryrosesomera@coefficientsco.com', '', '', 1, 1, 1, '', '1378858996', '', 0, '', ''),
(40, 'juan_delacruz', '65KxtDakSSBny8bF++xpcEXBaqDi9vw8Y0FfAD0hOZVRGN/Bwl5YZXi5iAt3t5orTXSrxS8BamDjLMnA6QCsBA==', 'Juan', 'Dela Cruz', 'juan_delacruz@gmail.com', '', '', 3, 1, 1, 'aq6nlcfigy2td79vsyndodgyv', '1378860603', '', 0, '', ''),
(42, 'juan_dodong', 'qC3o/CM1OVO0hHC8kJDzA7rGlT7fIWFMzHxOy9KCZgpHXWg9xgbmY8V9xabe+rSv0Vt1BLZbgKGMsPeNTzkkug==', 'Juan Dodong', 'Cruz', 'juan_dodong@gmail.com', 'Mang Jose Shop', '9854729838', 2, 0, 0, 'n4ofjs7dubbjuopqfc3tmyzbh', '1378866939', '', 0, '', ''),
(43, 'gbarlev', 'WPeDhXMZoKR9ovTReUprtOgYNIFscG4WYV/2KgAg1jAJ2NXJGK9HkWJ4nFw8cFEWW4/JPvpNbQuAZewMVyPnRQ==', 'Gil', 'Bar-Lev', 'giladbl77@gmail.com', 'BuyDBest', '12-789456423', 2, 1, 1, 'yptmkcdqhcbdorpetiwbd79kn', '1379106757', '', 0, 'This is restriction list', 'This is our return policy\n'),
(44, 'testing_1', 'IG9DDyiarmrhyQ7xS7BmJiM26Y65noQe58BXgvawVXBJ/rDFCoJTiI5qlWbRBhIAa2sP8wgpGlLRPYJrbLk1+w==', 'Testing One', 'Tesitng Last Name', 'testing_1@gmail.com', 'Testing 1', '12434509', 2, 1, 0, 'kfietcy1gms2ccm2pd0vdvhly', '1379461379', '', 0, '', ''),
(45, 'janhendrix2127', 'ei64QQ2xhqQAO5q2Pey2eKhR1WpacnUkpb6/6ycpk5dyY7qu1e1ahGChVWk8OfI8A+3CXyWr2Rq0rNL3kpaArA==', 'jan', 'hendrix', 'janhendrix2127@gmail.com', 'etude house', '333333333', 2, 1, 1, 's9bzfl8e1uityuavjxmv6kzzg', '1383628295', '', 0, '', '');
 
-- --------------------------------------------------------
 
--
-- Table structure for table `users`
--
 
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `salt` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `authentication_id` int(11) unsigned NOT NULL DEFAULT '0',
  `group_id` int(11) unsigned NOT NULL DEFAULT '0',
  `user_level` int(11) unsigned NOT NULL DEFAULT '1',
  `allow_login` int(1) unsigned NOT NULL DEFAULT '0',
  `site_id` int(11) unsigned NOT NULL,
  `failed_logins` int(11) unsigned DEFAULT NULL,
  `fail_expires` datetime DEFAULT NULL,
  `email_notifications` int(1) unsigned NOT NULL DEFAULT '1',
  `reset_key` varchar(255) DEFAULT NULL,
  `reset_expiry` datetime DEFAULT NULL,
  `address` text,
  `phone_number` varchar(255) DEFAULT NULL,
  `pushover_key` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `site_id` (`site_id`),
  KEY `pushover_key` (`pushover_key`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;
 
--
-- Dumping data for table `users`
--
 
INSERT INTO `users` (`id`, `name`, `username`, `password`, `salt`, `email`, `authentication_id`, `group_id`, `user_level`, `allow_login`, `site_id`, `failed_logins`, `fail_expires`, `email_notifications`, `reset_key`, `reset_expiry`, `address`, `phone_number`, `pushover_key`) VALUES
(4, 'James Angub', 'jamesan2k', 'dcf0733d513de4b65b4512c4fa231b154c7548be8e1a97df14b63a610e8c03bace9fcaa6b45aa2d80d64e26d739dc121d3efff42a72d86b07b05b12ab5ca8de8', '7guxDsASOViKxFi4gErKk1latMkCD1Jx59zc4ZCJ5OtOyC1XwxaXgSb1aVIXZc67', 'jamesan2k@gmail.com', 1, 0, 2, 1, 1, 0, '2013-11-15 15:15:04', 1, NULL, NULL, '', '3051249', NULL),
(2, 'test', 'test', '00593d0cd52d53a372439e4c981f0a265bc48c03dca14913d2199a5ccbca7403da3a480e2beaa254f7147ad4d63798e01291ef8dfba3ebd59aa67b07b836ff58', 'JFfDi86HwIdxueJLZB975NucgRBAFhwK49FuhreP5UXndQYiOs6Gt6Fh5qd9gph5', 'test@gmail.com', 1, 0, 4, 1, 1, 0, '2013-11-16 05:27:04', 1, NULL, NULL, '', '12434324', NULL),
(3, 'jan ', 'janhendrix2127', '6bc61cb8dc119e33467f476ae58d6958f97d63045e1a6f4b221211cdc2c79b3d5ec69ab9dbc121e305a495a3793a68d75b76a167c597be15ebdd6f46b97a5449', 'GLcfVACKagAnOfgSdvYDBNwU501uGu35Zt0wdeyfADAsH5TnmqMNagIoTKbeiKpG', 'etude house', 1, 0, 1, 1, 1, NULL, NULL, 1, NULL, NULL, 'Davao city', '0822973789 12', NULL),
(5, 'Gilad Bar-Lev', 'gilad', '1aeb9cabc198457582f334033e74a7c5660e16b90d103d9e6c3acfe12e348bc807627c8bd4b395611dd4cfa2b3d404fec94bf5ef74a7be21b7ab93d8a0825298', '2xEhwg3YDz4gAi6hFg7aduqbD5nJtCrqgJGLG58xS6JlwqfL8Iyq38VZ4gA0e96g', 'giladbl@buydbest.com', 1, 0, 2, 1, 1, NULL, NULL, 1, NULL, NULL, '', '', NULL);
 
-- --------------------------------------------------------
 
--
-- Table structure for table `users_to_departments`
--
 
CREATE TABLE IF NOT EXISTS `users_to_departments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `department_id` int(11) unsigned NOT NULL,
  `site_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique` (`user_id`,`department_id`,`site_id`),
  KEY `site_id` (`site_id`),
  KEY `user_id` (`user_id`),
  KEY `department_id` (`department_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;
 
--
-- Dumping data for table `users_to_departments`
--
 
INSERT INTO `users_to_departments` (`id`, `user_id`, `department_id`, `site_id`) VALUES
(3, 2, 1, 1),
(2, 5, 1, 1),
(4, 2, 2, 1),
(5, 2, 3, 1),
(6, 2, 4, 1),
(7, 2, 5, 1);
 
-- --------------------------------------------------------
 
--
-- Table structure for table `user_type`
--
 
CREATE TABLE IF NOT EXISTS `user_type` (
  `ut_id` int(11) NOT NULL AUTO_INCREMENT,
  `ut_name` text NOT NULL,
  `ut_protect` int(11) NOT NULL,
  PRIMARY KEY (`ut_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;
 
--
-- Dumping data for table `user_type`
--
 
INSERT INTO `user_type` (`ut_id`, `ut_name`, `ut_protect`) VALUES
(1, 'admin', 1),
(2, 'supplier', 1);
 
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
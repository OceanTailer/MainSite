-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 21, 2013 at 01:55 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `oceantailer`
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
('2QusWx9Qh57j', '72wGtYKJ439C3x3K', 1, 123);

-- --------------------------------------------------------

--
-- Table structure for table `admin_supplier_payment`
--

CREATE TABLE IF NOT EXISTS `admin_supplier_payment` (
  `asp_id` int(11) NOT NULL AUTO_INCREMENT,
  `asp_amount` text NOT NULL,
  `u_id` int(11) NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `bank_account`
--

INSERT INTO `bank_account` (`bnk_id`, `u_id`, `c_id`, `bnk_owner`, `bnk_name`, `bnk_address`, `bnk_account`, `bnk_id_code`) VALUES
(5, 14, 236, 'ADrian Angub', 'Bdo Agdao', '', '23909402193', '1233'),
(6, 15, 236, 'Test Angub', 'Bdo', '', '2344354541412', '12'),
(7, 17, 236, 'James Angub', 'Agdao Davao City', '', '0984958428349', '0932'),
(8, 19, 236, 'James angub', 'test bamnk', 'none', '123124123123123', '123232324'),
(9, 20, 236, 'None', 'Davao', 'Davaods', '12214932048923234', '123233222');

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
  `ba_isset` int(11) NOT NULL,
  PRIMARY KEY (`ba_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `billing_address`
--

INSERT INTO `billing_address` (`ba_id`, `u_id`, `c_id`, `ba_add1`, `ba_add2`, `ba_city`, `ba_province`, `ba_postal`, `ba_phone_num`, `ba_phone_ext`, `ba_isset`) VALUES
(13, 14, 209, 'address 1', '', 'davao3', 'Alabama', '8000', '434154213', '12', 1),
(14, 15, 221, 'address 2', '2', 'Agdao', 'Alabama', '9000', '0923843989879', '12', 1),
(15, 15, 236, 'address 2', '', 'Agdao', 'Alabama', '434', '235345', '23', 0),
(16, 17, 174, 'address1 ', 'address 2', 'Davao City', 'Davao', '80000', '09234343', '12', 1),
(23, 15, 230, 'address 2', '2', 'Agdao', 'Delaware', '9000', '0923843989879', '45', 0),
(28, 15, 236, 'address 2', '2', 'Agdao', 'Delaware', '9000', '0923843989879', '', 0),
(29, 19, 217, 'test', 'rwas', 'Davao', 'Davao City', '8000', '123124312321', '12', 0),
(30, 20, 236, 'davao', 'Dsad', 'Davao', 'Alabama', '12312', '123123', '23', 0);

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE IF NOT EXISTS `brand` (
  `b_id` int(11) NOT NULL AUTO_INCREMENT,
  `m_id` int(11) NOT NULL,
  `b_name` text NOT NULL,
  PRIMARY KEY (`b_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`b_id`, `m_id`, `b_name`) VALUES
(3, 1, 'Galaxy Note Tab'),
(4, 1, 'Galaxy Tab 2'),
(12, 6, 'Jordan 1.1'),
(13, 7, 'Mandaue Chair'),
(14, 8, 'Lumia 2.1'),
(15, 6, 'Jordan 1.2'),
(16, 9, 'Iphone 4.5'),
(17, 6, 'Jordan 1.3');

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
  `bsd_timestamp` text NOT NULL,
  `bsd_trans_id` text NOT NULL,
  `bsd_correlation_id` text NOT NULL,
  `bsd_ccv2match` text NOT NULL,
  `bsd_ack` text NOT NULL,
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
  `bsr_attachment` text NOT NULL,
  `bsr_time` text NOT NULL,
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
  `bt_status` text NOT NULL COMMENT '0 not shipped yet, 1 already shiped and payed, -1 fund is not enough or error in payment transaction, 3-sends customer received amount and 4 supplier already recieved their money',
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=77 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`c_id`, `c_name`, `c_default`, `c_parent`, `c_level`, `c_link`, `c_feePercent`, `c_default_image`) VALUES
(56, 'Home & Kitchen', 0, 0, 0, 'shoes-and-accessories', 2, 'http://localhost/oceantailer/categories/kitchen.png'),
(57, 'Cameras and Photo', 0, 0, 0, 'cameras-and-photo', 0, 'http://localhost/oceantailer/categories/photo-camera1.png'),
(58, 'Musical Instruments', 0, 0, 0, 'musical-instruments', 0, 'http://localhost/oceantailer/categories/inst1.png'),
(59, 'Books and Magazines', 0, 0, 0, 'books-and-magazines', 0, 'http://localhost/oceantailer/categories/mag1.png'),
(60, 'Mobile Phones', 0, 0, 0, 'mobile-phones', 0, 'http://localhost/oceantailer/categories/cp.png'),
(61, 'Appliances', 0, 0, 0, 'appliances', 0, 'http://localhost/oceantailer/categories/app1.png'),
(62, 'Women Shoes', 0, 56, 1, 'women-shoes', 0, ''),
(63, 'Open-toe shoes', 0, 62, 2, 'open-toe-shoes', 5, ''),
(64, 'Classy Shoes', 0, 62, 2, 'classy-shoes', 0, ''),
(65, 'Casual shoes', 0, 62, 2, 'casual-shoes', 0, ''),
(66, 'Evening shoes', 0, 62, 2, 'evening-shoes', 0, ''),
(67, 'Other shoes', 0, 62, 2, 'other-shoes', 0, ''),
(68, 'Men Shoes', 0, 56, 1, 'men-shoes', 0, ''),
(69, 'Open-toe shoes', 0, 68, 2, 'open-toe-shoes', 0, ''),
(70, 'Classy Shoes', 0, 68, 2, 'classy-shoes', 0, ''),
(71, 'Casual shoes', 0, 68, 2, 'casual-shoes', 0, ''),
(72, 'Sport shoes', 0, 68, 2, 'sport-shoes', 0, ''),
(73, 'Kicks', 0, 68, 2, 'kicks', 0, ''),
(74, 'Other', 0, 68, 2, 'other', 0, ''),
(75, 'DSLR', 0, 57, 1, 'dslr', 5, ''),
(76, '', 0, 56, 1, '', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `config_name` varchar(255) NOT NULL,
  `config_value` longtext NOT NULL,
  `site_id` int(11) unsigned NOT NULL,
  KEY `site_id` (`site_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`config_name`, `config_value`, `site_id`) VALUES
('domain', 'localhost', 1),
('script_path', '/oceantailer/ticket', 1),
('https', '0', 1),
('port_number', '80', 1),
('name', 'Oceantailer', 1),
('cookie_name', 'sts', 1),
('encryption_key', '1aTV7mtHnTSA3HtWKGOBb4gULizHWq3u', 1),
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
('plugin_data', 'a:0:{}', 1),
('plugin_update_data', 'a:0:{}', 1),
('anonymous_tickets_reply', '0', 1),
('notification_new_ticket_subject', '#SITE_NAME# - #TICKET_SUBJECT#', 1),
('notification_new_ticket_body', '\r\n		#TICKET_DESCRIPTION#\r\n		<br /><br />\r\n		#TICKET_KEY#\r\n		<br /><br />\r\n		#GUEST_URL#', 1),
('notification_new_ticket_note_subject', '#SITE_NAME# - #TICKET_SUBJECT#', 1),
('notification_new_ticket_note_body', '\r\n		#TICKET_NOTE_DESCRIPTION#\r\n		<br /><br />\r\n		#TICKET_KEY#\r\n		<br /><br />\r\n		#GUEST_URL#', 1),
('notification_new_user_subject', '#SITE_NAME# - New Account', 1),
('notification_new_user_body', '\r\n		Hi #USER_FULLNAME#,\r\n		<br /><br />\r\n		A user account has been created for you at #SITE_NAME#.\r\n		<br /><br />\r\n		URL: 		#SITE_ADDRESS#<br />\r\n		Name:		#USER_FULLNAME#<br />\r\n		Username:	#USER_NAME#<br />\r\n		Password:	#USER_PASSWORD#', 1),
('guest_portal', '0', 1),
('guest_portal_index_html', '', 1),
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
('log_limit', '100000', 1);

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
  `ccu_isset` int(11) NOT NULL,
  PRIMARY KEY (`ccu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `credit_card_user`
--

INSERT INTO `credit_card_user` (`ccu_id`, `u_id`, `cc_id`, `ccu_name`, `ccu_number`, `ccu_ccv`, `ccu_exp_month`, `ccu_exp_year`, `ccu_isset`) VALUES
(14, 15, 3, 'Test ', '1111111111112321', '123', '9', '2013', 1),
(15, 15, 1, 'Test Angub', '1111222232222323', '123', '1', '2018', 0),
(16, 14, 1, 'test', '1111111111111111', '123', '1', '2020', 0),
(17, 14, 3, 'James Angub', '1232323232323232', '123', '1', '2020', 1),
(18, 14, 3, 'Jaime doy', '1111111111111111', '123', '1', '2020', 0),
(19, 17, 1, 'James Angub', '1234232323232323', '123', '1', '2016', 1),
(20, 15, 3, 'Test Angub haha', '1111111111111111', '123', '1', '2020', 0),
(21, 15, 1, 'yrdy', '5656565656565656', '123', '1', '2020', 0),
(22, 19, 1, 'James', '3123322212323232', '123', '1', '2018', 0),
(23, 20, 1, 'James', '8738383838383838', '122', '1', '2020', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_number`, `user_id`, `server_id`, `remote_id`, `event_date`, `event_date_utc`, `event_type`, `event_source`, `event_severity`, `event_file`, `event_file_line`, `event_ip_address`, `event_summary`, `event_description`, `event_trace`, `event_synced`, `site_id`) VALUES
(1, 1024, 1, NULL, NULL, '2013-11-04 12:22:23', '2013-11-04 00:22:23', 'local_login_successful', 'auth', 'notice', 'C:\\wamp\\www\\oceantailer\\ticket\\system\\classes\\auth.class.php', 339, '127.0.0.1', NULL, 'Local Login Successful "<a href="http://localhost/oceantailer/ticket/users/view/1/">admin</a>"', NULL, 0, 1),
(2, 1024, 1, NULL, NULL, '2013-11-04 12:23:43', '2013-11-04 00:23:43', 'add', 'users', 'notice', 'C:\\wamp\\www\\oceantailer\\ticket\\system\\classes\\users.class.php', 428, '127.0.0.1', NULL, 'User Added "<a href="http://localhost/oceantailer/ticket/users/view/2/">Test buyer</a>"', NULL, 0, 1),
(3, 512, 0, NULL, NULL, '2013-11-04 13:26:58', '2013-11-04 01:26:58', 'local_login_failed', 'auth', 'warning', 'C:\\wamp\\www\\oceantailer\\ticket\\system\\classes\\auth.class.php', 356, '127.0.0.1', NULL, 'Local Login Failed "<a href="http://localhost/oceantailer/ticket/users/view/3/">test1 </a>"', NULL, 0, 1),
(4, 512, 0, NULL, NULL, '2013-11-04 13:27:13', '2013-11-04 01:27:13', 'local_login_failed', 'auth', 'warning', 'C:\\wamp\\www\\oceantailer\\ticket\\system\\classes\\auth.class.php', 356, '127.0.0.1', NULL, 'Local Login Failed "<a href="http://localhost/oceantailer/ticket/users/view/3/">test1 </a>"', NULL, 0, 1),
(5, 1024, 4, NULL, NULL, '2013-11-04 13:38:21', '2013-11-04 01:38:21', 'local_login_successful', 'auth', 'notice', 'C:\\wamp\\www\\oceantailer\\ticket\\system\\classes\\auth.class.php', 339, '127.0.0.1', NULL, 'Local Login Successful "<a href="http://localhost/oceantailer/ticket/users/view/4/">Test </a>"', NULL, 0, 1),
(6, 512, 0, NULL, NULL, '2013-11-04 13:59:35', '2013-11-04 01:59:35', 'local_login_failed', 'auth', 'warning', 'C:\\wamp\\www\\oceantailer\\ticket\\system\\classes\\auth.class.php', 356, '127.0.0.1', NULL, 'Local Login Failed "<a href="http://localhost/oceantailer/ticket/users/view/4/">Test </a>"', NULL, 0, 1),
(7, 1024, 4, NULL, NULL, '2013-11-04 13:59:42', '2013-11-04 01:59:42', 'local_login_successful', 'auth', 'notice', 'C:\\wamp\\www\\oceantailer\\ticket\\system\\classes\\auth.class.php', 339, '127.0.0.1', NULL, 'Local Login Successful "<a href="http://localhost/oceantailer/ticket/users/view/4/">Test </a>"', NULL, 0, 1),
(8, 1024, 4, NULL, NULL, '2013-11-04 14:34:29', '2013-11-04 02:34:29', 'local_login_successful', 'auth', 'notice', 'C:\\wamp\\www\\oceantailer\\ticket\\system\\classes\\auth.class.php', 339, '127.0.0.1', NULL, 'Local Login Successful "<a href="http://localhost/oceantailer/ticket/users/view/4/">Test </a>"', NULL, 0, 1),
(9, 1024, 4, NULL, NULL, '2013-11-11 13:45:46', '2013-11-11 01:45:46', 'local_login_successful', 'auth', 'notice', 'C:\\wamp\\www\\oceantailer\\ticket\\system\\classes\\auth.class.php', 339, '127.0.0.1', NULL, 'Local Login Successful "<a href="http://localhost/oceantailer/ticket/users/view/4/">Test </a>"', NULL, 0, 1),
(10, 512, 0, NULL, NULL, '2013-11-11 14:15:57', '2013-11-11 02:15:57', 'local_login_failed', 'auth', 'warning', 'C:\\wamp\\www\\oceantailer\\ticket\\system\\classes\\auth.class.php', 356, '127.0.0.1', NULL, 'Local Login Failed "<a href="http://localhost/oceantailer/ticket/users/view/1/">admin</a>"', NULL, 0, 1),
(11, 512, 0, NULL, NULL, '2013-11-11 14:16:49', '2013-11-11 02:16:49', 'local_login_failed', 'auth', 'warning', 'C:\\wamp\\www\\oceantailer\\ticket\\system\\classes\\auth.class.php', 356, '127.0.0.1', NULL, 'Local Login Failed "<a href="http://localhost/oceantailer/ticket/users/view/1/">admin</a>"', NULL, 0, 1),
(12, 512, 0, NULL, NULL, '2013-11-11 14:18:30', '2013-11-11 02:18:30', 'local_login_failed', 'auth', 'warning', 'C:\\wamp\\www\\oceantailer\\ticket\\system\\classes\\auth.class.php', 356, '127.0.0.1', NULL, 'Local Login Failed "<a href="http://localhost/oceantailer/ticket/users/view/1/">admin</a>"', NULL, 0, 1),
(13, 512, 0, NULL, NULL, '2013-11-11 14:18:33', '2013-11-11 02:18:33', 'local_login_failed', 'auth', 'warning', 'C:\\wamp\\www\\oceantailer\\ticket\\system\\classes\\auth.class.php', 356, '127.0.0.1', NULL, 'Local Login Failed "<a href="http://localhost/oceantailer/ticket/users/view/1/">admin</a>"', NULL, 0, 1),
(14, 512, 0, NULL, NULL, '2013-11-11 14:18:42', '2013-11-11 02:18:42', 'local_login_failed', 'auth', 'warning', 'C:\\wamp\\www\\oceantailer\\ticket\\system\\classes\\auth.class.php', 356, '127.0.0.1', NULL, 'Local Login Failed "<a href="http://localhost/oceantailer/ticket/users/view/1/">admin</a>"', NULL, 0, 1),
(15, 512, 0, NULL, NULL, '2013-11-11 14:19:10', '2013-11-11 02:19:10', 'login_failed_account_lockout', 'auth', 'warning', 'C:\\wamp\\www\\oceantailer\\ticket\\system\\classes\\auth.class.php', 239, '127.0.0.1', NULL, 'Login Failed "<a href="http://localhost/oceantailer/ticket/users/view/1/">admin</a>" - Account Temporarily Locked.', NULL, 0, 1),
(16, 512, 0, NULL, NULL, '2013-11-11 14:22:29', '2013-11-11 02:22:29', 'login_failed_account_lockout', 'auth', 'warning', 'C:\\wamp\\www\\oceantailer\\ticket\\system\\classes\\auth.class.php', 239, '127.0.0.1', NULL, 'Login Failed "<a href="http://localhost/oceantailer/ticket/users/view/1/">admin</a>" - Account Temporarily Locked.', NULL, 0, 1),
(17, 512, 0, NULL, NULL, '2013-11-11 14:22:35', '2013-11-11 02:22:35', 'login_failed_account_lockout', 'auth', 'warning', 'C:\\wamp\\www\\oceantailer\\ticket\\system\\classes\\auth.class.php', 239, '127.0.0.1', NULL, 'Login Failed "<a href="http://localhost/oceantailer/ticket/users/view/1/">admin</a>" - Account Temporarily Locked.', NULL, 0, 1),
(18, 512, 0, NULL, NULL, '2013-11-11 14:22:39', '2013-11-11 02:22:39', 'login_failed_account_lockout', 'auth', 'warning', 'C:\\wamp\\www\\oceantailer\\ticket\\system\\classes\\auth.class.php', 239, '127.0.0.1', NULL, 'Login Failed "<a href="http://localhost/oceantailer/ticket/users/view/1/">admin</a>" - Account Temporarily Locked.', NULL, 0, 1),
(19, 1024, 4, NULL, NULL, '2013-11-11 14:35:51', '2013-11-11 02:35:51', 'local_login_successful', 'auth', 'notice', 'C:\\wamp\\www\\oceantailer\\ticket\\system\\classes\\auth.class.php', 339, '127.0.0.1', NULL, 'Local Login Successful "<a href="http://localhost/oceantailer/ticket/users/view/4/">Test </a>"', NULL, 0, 1),
(20, 512, 0, NULL, NULL, '2013-11-11 15:05:02', '2013-11-11 03:05:02', 'unknown_user', 'auth', 'warning', 'C:\\wamp\\www\\oceantailer\\ticket\\system\\classes\\auth.class.php', 459, '127.0.0.1', NULL, 'Local Login Failed "jamesan2k" - Unknown Account', NULL, 0, 1),
(21, 512, 0, NULL, NULL, '2013-11-11 15:38:40', '2013-11-11 03:38:40', 'local_login_failed', 'auth', 'warning', 'C:\\wamp\\www\\oceantailer\\ticket\\system\\classes\\auth.class.php', 356, '127.0.0.1', NULL, 'Local Login Failed "<a href="http://localhost/oceantailer/ticket/users/view/1/">admin</a>"', NULL, 0, 1),
(22, 512, 0, NULL, NULL, '2013-11-11 15:38:46', '2013-11-11 03:38:46', 'login_failed_account_lockout', 'auth', 'warning', 'C:\\wamp\\www\\oceantailer\\ticket\\system\\classes\\auth.class.php', 239, '127.0.0.1', NULL, 'Login Failed "<a href="http://localhost/oceantailer/ticket/users/view/1/">admin</a>" - Account Temporarily Locked.', NULL, 0, 1),
(23, 512, 0, NULL, NULL, '2013-11-11 15:38:52', '2013-11-11 03:38:52', 'login_failed_account_lockout', 'auth', 'warning', 'C:\\wamp\\www\\oceantailer\\ticket\\system\\classes\\auth.class.php', 239, '127.0.0.1', NULL, 'Login Failed "<a href="http://localhost/oceantailer/ticket/users/view/1/">admin</a>" - Account Temporarily Locked.', NULL, 0, 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`i_id`, `u_id`, `ucp_ean`, `manuf_num`, `m_id`, `b_id`, `c_id`, `weight`, `weightScale`, `qty`, `sup_fee`, `ship_alone`, `d_height`, `d_width`, `d_dept`, `d_scale`, `i_time`) VALUES
(23, 14, '111112222222222', '1111111111', 6, 15, 236, '11', 'Kilogram', 0, 11, 0, '111', '111', '111', 'Meters', '1384940605'),
(24, 14, '32432123123', '143434', 6, 15, 63, 'test', 'Pounds', 0, 0, 1, '12', '43', '34', 'Inches', '1373187389'),
(25, 14, '435234235434545', '2343455452342', 9, 16, 62, '23', 'Pounds', 0, 700, 1, '43', '54', '56', 'Inches', '1371001515'),
(26, 1, '1254325123124', '12312431231412', 6, 17, 58, '12', 'Pounds', 0, 45, 1, '23', '43', '54', 'Inches', '1379579168'),
(27, 1, 't3412341', '12312412', 6, 12, 56, '23', 'Pounds', 0, 12, 1, '43', '123', '23', 'Inches', '1384319116');

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
  `ic_map` text NOT NULL,
  `ic_ship_cost` float NOT NULL,
  `ic_ship_country` int(11) NOT NULL,
  `ic_prom_text` text NOT NULL,
  `ic_time` text NOT NULL,
  PRIMARY KEY (`ic_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `inventory_child`
--

INSERT INTO `inventory_child` (`ic_id`, `i_id`, `u_id`, `SKU`, `ic_quan`, `ic_price`, `ic_retail_price`, `ic_leadtime`, `ic_map`, `ic_ship_cost`, `ic_ship_country`, `ic_prom_text`, `ic_time`) VALUES
(14, 23, 14, '214234354234', 0, 5000, 1000, '30 Days', '', 45, 236, 'tyest', '1379649626'),
(16, 24, 14, '25', 1, 40, 56, '12 days', '45', 12, 236, 'test', '1370782695'),
(17, 25, 14, '1234345653423', 1, 900, 1050, '30 Days', '', 0, 236, '', '1371001515'),
(18, 23, 17, '125423', 60, 450, 600, '250', '0', 50, 250, 'None', '1379497542'),
(19, 26, 14, '', 1, 0, 0, '', '', 0, 1, '', '1379580261');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `inventory_image`
--

INSERT INTO `inventory_image` (`ii_id`, `i_id`, `ii_link`, `ii_name`, `ii_feat`, `ii_time`) VALUES
(4, 14, 'http://localhost/oceantailer/product_image/14/1368714032portfolio_jaime.jpg', 'portfolio_jaime.jpg', '1', '1368714032'),
(6, 14, 'http://localhost/oceantailer/product_image/14/1369045536logo.jpg', 'logo.jpg', '0', '1369045536'),
(7, 14, 'http://localhost/oceantailer/product_image/14/1369045987logo.png', 'logo.png', '0', '1369045987'),
(8, 14, 'http://localhost/oceantailer/product_image/14/1369046015logo.png', 'logo.png', '0', '1369046015'),
(9, 15, 'http://localhost/oceantailer/product_image/15/1369062531Ajax_logo_badge.jpg', 'Ajax_logo_badge.jpg', '1', '1369062531'),
(10, 15, 'http://localhost/oceantailer/product_image/15/1370280424Starr.jpg', 'Starr.jpg', '0', '1370280424'),
(11, 15, 'http://localhost/oceantailer/product_image/15/1370280440dancing-wallpaper.jpg', 'dancing-wallpaper.jpg', '0', '1370280440'),
(12, 22, 'http://localhost/oceantailer/product_image/22/1370332342156slqr.png', '156slqr.png', '0', '1370332342'),
(13, 22, 'http://localhost/oceantailer/product_image/22/1370332357Result.jpg', 'Result.jpg', '0', '1370332357'),
(14, 23, 'http://localhost/oceantailer/product_image/23/1370338167156slqr.png', '156slqr.png', '0', '1370338167'),
(15, 23, 'http://localhost/oceantailer/product_image/23/1370338176dancing-wallpaper.jpg', 'dancing-wallpaper.jpg', '0', '1370338176');

-- --------------------------------------------------------

--
-- Table structure for table `manufacturer`
--

CREATE TABLE IF NOT EXISTS `manufacturer` (
  `m_id` int(11) NOT NULL AUTO_INCREMENT,
  `m_name` text NOT NULL,
  PRIMARY KEY (`m_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `manufacturer`
--

INSERT INTO `manufacturer` (`m_id`, `m_name`) VALUES
(1, 'Samsung'),
(3, 'Toshiba'),
(6, 'Adidas'),
(7, 'Mandaue Foam'),
(8, 'Nokia'),
(9, 'Apple');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `order_cancel`
--

CREATE TABLE IF NOT EXISTS `order_cancel` (
  `ocl_id` int(11) NOT NULL AUTO_INCREMENT,
  `ocl_name` text NOT NULL,
  `user_type` int(11) NOT NULL,
  PRIMARY KEY (`ocl_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `order_cancel`
--

INSERT INTO `order_cancel` (`ocl_id`, `ocl_name`, `user_type`) VALUES
(1, 'Wrong Item Selected', 3),
(2, 'Wrong Seller Selected', 3),
(3, 'Item is Defective', 3),
(4, 'Unwanted Item', 3),
(5, 'Wrong Price Set', 2),
(6, 'No stock Available', 2);

-- --------------------------------------------------------

--
-- Table structure for table `order_refund`
--

CREATE TABLE IF NOT EXISTS `order_refund` (
  `or_id` int(11) NOT NULL AUTO_INCREMENT,
  `or_name` text NOT NULL,
  PRIMARY KEY (`or_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `order_refund`
--

INSERT INTO `order_refund` (`or_id`, `or_name`) VALUES
(1, 'No Inventory'),
(2, 'Customer Return'),
(3, 'Buyer Cancelled'),
(4, 'General Adjustment'),
(5, 'Could Not Ship'),
(6, 'Different Item'),
(7, 'Merchandise Not Received'),
(8, 'Merchandise Not As Described'),
(9, 'Pricing Error'),
(10, 'Shipping Address Undeliverable'),
(11, 'Delivered Late by Carrier'),
(12, 'Missed Fulfillment Promise'),
(13, 'Delivered Late by Carrier'),
(14, 'Missed Fulfillment Promise');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `order_return`
--

INSERT INTO `order_return` (`o_ret_id`, `o_ret_name`) VALUES
(1, 'Wrong Item Selected'),
(2, 'Wrong Seller Selected');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=106 ;

--
-- Dumping data for table `permission_assign`
--

INSERT INTO `permission_assign` (`permission_id`, `u_id`, `p_id`) VALUES
(102, 16, 4),
(103, 16, 6),
(104, 16, 7),
(105, 16, 10);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pop_messages`
--

CREATE TABLE IF NOT EXISTS `pop_messages` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `message_id` text NOT NULL,
  `site_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `message_id` (`message_id`(255)),
  KEY `site_id` (`site_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `queue`
--

INSERT INTO `queue` (`id`, `data`, `type`, `start_date`, `date`, `retry`, `site_id`) VALUES
(1, 'YTo0OntzOjc6InN1YmplY3QiO3M6MjU6Ik9jZWFudGFpbGVyIC0gTmV3IEFjY291bnQiO3M6NDoiYm9keSI7czoyMzA6Ig0KCQlIaSBUZXN0IGJ1eWVyLA0KCQk8YnIgLz48YnIgLz4NCgkJQSB1c2VyIGFjY291bnQgaGFzIGJlZW4gY3JlYXRlZCBmb3IgeW91IGF0IE9jZWFudGFpbGVyLg0KCQk8YnIgLz48YnIgLz4NCgkJVVJMOiAJCWh0dHA6Ly9sb2NhbGhvc3Qvb2NlYW50YWlsZXIvdGlja2V0PGJyIC8+DQoJCU5hbWU6CQlUZXN0IGJ1eWVyPGJyIC8+DQoJCVVzZXJuYW1lOgl0ZXN0PGJyIC8+DQoJCVBhc3N3b3JkOgl0ZXN0IjtzOjQ6Imh0bWwiO2I6MTtzOjI6InRvIjthOjI6e3M6MjoidG8iO3M6MTQ6InRlc3RAZ21haWwuY29tIjtzOjc6InRvX25hbWUiO3M6MTA6IlRlc3QgYnV5ZXIiO319', 'email', '0000-00-00 00:00:00', '2013-11-04 12:23:43', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `scale`
--

CREATE TABLE IF NOT EXISTS `scale` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `scale_name` text NOT NULL,
  PRIMARY KEY (`s_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `scale`
--

INSERT INTO `scale` (`s_id`, `scale_name`) VALUES
(2, 'Kilogram'),
(4, 'Pounds');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`session_id`, `session_start`, `session_start_utc`, `session_expire`, `session_expire_utc`, `session_data`, `session_active_key`, `ip_address`, `site_id`) VALUES
('4aqjtevglhs62v69hhp951n0f2', '2013-11-11 15:38:52', '2013-11-11 03:38:52', '2013-11-11 16:38:52', '2013-11-11 04:38:52', 'page|s:20:"/oceantailer/ticket/";', NULL, '127.0.0.1', 1),
('bkv2g4psera9lo8co653e8lbu2', '2013-11-04 14:44:18', '2013-11-04 02:44:18', '2013-11-04 15:44:18', '2013-11-04 03:44:18', 'page|s:28:"/oceantailer/ticket/tickets/";user_data|a:9:{s:2:"id";s:1:"4";s:4:"name";s:5:"Test ";s:8:"username";s:8:"testing1";s:8:"group_id";s:1:"0";s:5:"email";s:4:"None";s:10:"user_level";s:1:"1";s:17:"authentication_id";s:1:"1";s:19:"email_notifications";s:1:"1";s:12:"pushover_key";N;}', NULL, '127.0.0.1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `shipping_carrier`
--

CREATE TABLE IF NOT EXISTS `shipping_carrier` (
  `sc_id` int(11) NOT NULL AUTO_INCREMENT,
  `sc_name` text NOT NULL,
  `sc_desc` text NOT NULL,
  PRIMARY KEY (`sc_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

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
(13, 'Canada Post', '');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_carrier_country`
--

CREATE TABLE IF NOT EXISTS `shipping_carrier_country` (
  `scc_id` int(11) NOT NULL AUTO_INCREMENT,
  `sc_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  PRIMARY KEY (`scc_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `shipping_carrier_country`
--

INSERT INTO `shipping_carrier_country` (`scc_id`, `sc_id`, `country_id`) VALUES
(8, 1, 1),
(9, 1, 9),
(10, 1, 40),
(11, 2, 236),
(12, 2, 93);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ticket_departments`
--

INSERT INTO `ticket_departments` (`id`, `name`, `enabled`, `site_id`, `public_view`) VALUES
(1, 'Default Department', 1, 1, 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ticket_status`
--

INSERT INTO `ticket_status` (`id`, `name`, `colour`, `enabled`, `active`, `site_id`) VALUES
(1, 'Open', 'e93e3e', 1, 1, 1),
(2, 'Closed', '71c255', 1, 0, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `translation`
--

INSERT INTO `translation` (`tr_id`, `i_id`, `c_id`, `tr_title`, `tr_short_desc`, `tr_desc`, `tr_time`) VALUES
(1, 5, 1, 'Ajax', 'Ajax Short Desc\n							', 'Ajax Long Desc\n							', '1367942613'),
(2, 5, 2, 'Ajax Tide Bar', 'This is A Pinoy translation', 'Main Pinoy Translation hahaha', '1367943226'),
(3, 6, 1, 'Umbrella', 'SHort Description Umbrella', 'Main Description Umbrella', '1368176637'),
(5, 7, 1, 'Iphone 42 New', '24 New', '34 New dser', '1368218408'),
(6, 8, 1, 'Test', 'Test', 'r1241423', '1368560825'),
(8, 15, 236, 'Jordan', 'Jordan Sports', 'Jordan Sports long desc', '1369370684'),
(10, 18, 236, 'Mandaue Foam Test', 'Test Foam Manduae\n								', 'Main Mandaue haha\n								', '1369410097'),
(11, 19, 236, 'Test 1 Jordan', 'Jordan Testing\n								', 'Jordan Testing haha\n								', '1369848159'),
(12, 20, 236, 'Test Jordan Haha', 'shor desc jordan\n								', 'Main Desc jordan\n								', '1369848336'),
(13, 21, 236, 'Nokia Description Test', 'Shrot Description Test\n								', 'Main Description Test\n								', '1369849013'),
(14, 22, 236, 'Jordan Test2', 'short Desc\n								', 'Main Decjkjhk\n								', '1370269520'),
(15, 14, 236, 'Hi test', 'Short Test', 'Main Test', '1370293258'),
(17, 22, 61, 'test', 'dsfd', 'fgryfdgkjk jkjhkj', '1370333042'),
(18, 23, 236, 'Addidas 1.2', 'Legit Shoes that has airconditioner and shit\n								', 'this shoes has swag. \n								', '1370338134'),
(19, 24, 236, 'Test desc', 'fefewfsd						', 'ferfreferf		', '1370782695'),
(21, 23, 231, 'tsdtrse', 'sdfsd', 'fsdfwef', '1370790219'),
(22, 25, 236, 'Iphone Black', 'test\n								', '\n		Test						', '1371001515'),
(23, 26, 236, 'Adidas 1.3 No Color', 'Short Description\n											', 'short description test\n											', '1379579168'),
(24, 27, 236, 'tst', '21312ed								', 'qweqwdssad									', '1384319116');

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
  `u_company` text NOT NULL,
  `u_permit` text NOT NULL,
  `u_email` text NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_id`, `u_username`, `u_pass`, `u_fname`, `u_lname`, `u_company`, `u_permit`, `u_email`, `u_type`, `u_status`, `u_admin_approve`, `u_verify_code`, `u_time`, `u_pic`, `u_superAdmin`, `u_restriction`, `u_return`) VALUES
(1, 'admin', 'DXNuCbwu1h5+hUiqHMRMKA+CDj+7fJogaqJ6DnkoAo2AspnqBvaMz3xc6LNdjZpjU+jiSsCFqyIBZRyF0DwC3w==', 'James Angub', '', '', '', 'jamesan2k@gmail.com', 1, 1, 0, '', '0000-00-00', 'http://localhost/oceantailer/avatars/1.png', 1, '', ''),
(14, 'jaimedoy', 'DXNuCbwu1h5+hUiqHMRMKA+CDj+7fJogaqJ6DnkoAo2AspnqBvaMz3xc6LNdjZpjU+jiSsCFqyIBZRyF0DwC3w==', 'adrian 1', 'angub 1', 'Jaime Doy Compy', '23r234234', 'adiran@yahoo.com', 2, 1, 0, 'me9wjnqktmrzu46uak2idblrs', '1369684879', 'http://localhost/oceantailer/avatars/14.png', 0, 'fdsfsdcsdc dfddsfdsfsdfdsfgvfdgbfd', 'sdsadsad'),
(15, 'testangub', 'RCqkl/jXaCYhykZFaq6p0yh8ndKiTwvVAXlggIKMz7VCsXqvbkZlsfE8O2ASVgT4gRTunl1DmHEd/dYHDBONPQ==', 'Jaime', 'Angub', 'yey', 'tsdfrew', 'james_an2k@gmail.com', 3, 1, 1, '4jgxmtzatcpr8uxtkjxvhyhte', '1369705628', 'http://localhost/oceantailer/avatars/151.png', 0, '', ''),
(16, 'adrianangub', 'DXNuCbwu1h5+hUiqHMRMKA+CDj+7fJogaqJ6DnkoAo2AspnqBvaMz3xc6LNdjZpjU+jiSsCFqyIBZRyF0DwC3w==', 'adrian', 'angub', '', '', 'adrianangub@yahoo.com', 1, 1, 1, '', '1371288161', '', 0, '', ''),
(17, 'jamesan2k', 'wsv068FdX6uN63vzUKQ0IOD+F7gElozMZzyAf8IEpjVQxI12USi/3gQ020gsMzjFItit06E4fKk2BMGeFYWRxA==', 'James 2', 'Angub 2', 'DWJ', '0894932894', 'jams_an2k@yahoo.com.ph', 2, 1, 1, 'gf152bzys5uylluciofamxhk9', '1373638308', 'http://localhost/oceantailer/avatars/17.png', 0, '', ''),
(18, 'adrian', 'X6eMQrltLAI36BdChcW44Pj8GeHWqCTVSxtHYJHns2dvrIfQsP9cUo+yjHngyxpa0zgC7uxGPtdF2/VhuV937w==', 'Adrian', 'Angub', '', '', 'adrianangub@gmail.com', 1, 1, 1, '', '1378062592', '', 0, '', ''),
(20, 'testing1', '2tsm98vAKInl7tkNk9JkJOojk5Lwvw+nkLQHx8ZXbpYblY43KfPZzNS5S9iHMfiUqGdJdB3m5enfryvHRff5gg==', 'Test', 'Tisng 1', 'None', '32132421', 'testing@mgai.com', 2, 0, 0, 't5ujblbn7pvywfkarzz7ybjn1', '1383529051', '', 0, '', '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `salt`, `email`, `authentication_id`, `group_id`, `user_level`, `allow_login`, `site_id`, `failed_logins`, `fail_expires`, `email_notifications`, `reset_key`, `reset_expiry`, `address`, `phone_number`, `pushover_key`) VALUES
(1, 'admin', 'admin', 'db8807df2b64dc687df440611c19c4b07984e70865a1ecfe316535d59a887eb7fdc1fbfea414030926e87b0588a12c989eeed64737a7509c92a44bd068275d42', '6tSItQMAoytem7n7HwGLG52kEZI94oqQbmk7ouAcmQx64RYq1UPe1QzZG8FDWseg', 'admin@gmail.com', 1, 0, 2, 1, 1, 6, '2013-11-11 15:53:40', 1, NULL, NULL, NULL, NULL, NULL),
(2, 'Test buyer', 'test', '0246146cf6d6e76f40668bf41a9d75c8ab371734729255e319c31abb714b4f8394018d7378e5cbb633e3c167d38019de16994f9726dff245835d430ab97f91ee', 'uINZ6Ejm4xiSuiCaEBVb8cVUBiWjUiOHdITbkjcgNh0yeQwR0dIZxY6KgtdBPro6', 'test@gmail.com', 1, 0, 1, 1, 1, NULL, NULL, 1, NULL, NULL, '', '009421321', NULL),
(4, 'Test ', 'testing1', 'd0a814be906e0d44fb5b56b4449e7ff583f05fbcf7443d5dddd7301d261dc72409e3137a94a5abcae9645e073b29d92032b0b3b17bac22e581aba04e5f3770c9', 'uLGJ005Woqjs6LtgqtYqUOGTQv6dSb3SarGbtHiiOcBHrUVU5VZAeDZ3SpHD41DV', 'None', 1, 0, 1, 1, 1, 0, '2013-11-11 14:35:51', 1, NULL, NULL, 'davao', '123123 23', NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users_to_departments`
--

INSERT INTO `users_to_departments` (`id`, `user_id`, `department_id`, `site_id`) VALUES
(1, 2, 1, 1);

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

-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2015 at 10:06 PM
-- Server version: 5.6.26
-- PHP Version: 5.5.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `metrimonialdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `AdminId` int(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `adminchat`
--

CREATE TABLE IF NOT EXISTS `adminchat` (
  `chatId` int(255) NOT NULL,
  `adminId` int(255) NOT NULL,
  `detailId` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `adminchatdetail`
--

CREATE TABLE IF NOT EXISTS `adminchatdetail` (
  `detailId` int(255) NOT NULL,
  `to` text NOT NULL,
  `message` varchar(255) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `adminnotification`
--

CREATE TABLE IF NOT EXISTS `adminnotification` (
  `Notificationid` int(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bandetials`
--

CREATE TABLE IF NOT EXISTS `bandetials` (
  `banDetailsId` int(255) NOT NULL,
  `adminId` int(25) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `banlist`
--

CREATE TABLE IF NOT EXISTS `banlist` (
  `BanId` int(25) NOT NULL,
  `UserID` int(255) NOT NULL,
  `banDetailsId` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `block`
--

CREATE TABLE IF NOT EXISTS `block` (
  `blockId` int(25) NOT NULL,
  `detailsId` int(25) NOT NULL,
  `blockeduser` varchar(25) NOT NULL,
  `reason` text NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blocklist`
--

CREATE TABLE IF NOT EXISTS `blocklist` (
  `blocklistId` int(25) NOT NULL,
  `UserID` int(255) NOT NULL,
  `detailsId` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE IF NOT EXISTS `chat` (
  `chatId` int(25) NOT NULL,
  `chatdetailId` int(25) NOT NULL,
  `UserID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `chatdetails`
--

CREATE TABLE IF NOT EXISTS `chatdetails` (
  `chatdetailsId` int(25) NOT NULL,
  `from` varchar(25) NOT NULL,
  `to` varchar(25) NOT NULL,
  `message` varchar(255) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `cityid` bigint(20) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`cityid`, `name`) VALUES
(1, 'Kabul'),
(2, 'Kandahar'),
(3, 'Herat'),
(4, 'Mazar-i-Sharif'),
(5, 'Kunduz'),
(6, 'Taloqan'),
(7, 'Jalabad'),
(8, 'Puli Khumri'),
(9, 'Charikar'),
(10, 'Sheberghan'),
(11, 'Ghazni'),
(12, 'Sar-e Pol'),
(13, 'Khost'),
(14, 'Chaghcharan'),
(15, 'Mihtarlam'),
(16, 'Farah'),
(17, 'Pul-i-Alam'),
(18, 'Samangan'),
(19, 'Lashkar Gah');

-- --------------------------------------------------------

--
-- Table structure for table `commission`
--

CREATE TABLE IF NOT EXISTS `commission` (
  `commissionId` int(255) NOT NULL,
  `rate` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `countryid` int(25) NOT NULL,
  `name` text NOT NULL,
  `code` int(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=206 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`countryid`, `name`, `code`) VALUES
(1, 'Afghanistan', 93),
(2, 'Albania', 355),
(3, 'Algeria', 213),
(4, 'American Samoa', 685),
(5, 'Andorra', 376),
(6, 'Angola', 244),
(7, 'Australian Antarctic Territory', 672),
(8, 'Antilles', 599),
(9, 'Argentina', 54),
(10, 'Armenia', 374),
(11, 'Aruba', 297),
(12, 'Ascension Island', 247),
(13, 'Australia', 61),
(14, 'Austria', 43),
(15, 'Azerbaijan', 994),
(16, 'Azores', 351),
(17, 'Bahrain', 973),
(18, 'Bangladesh', 880),
(19, 'Belarus', 375),
(20, 'Belgium', 32),
(21, 'Belize', 501),
(22, 'Benin', 229),
(23, 'Bhutan', 975),
(24, 'Bolivia', 591),
(25, 'Bosnia Herzegovina', 387),
(26, 'Botswana', 267),
(27, 'Brazil', 55),
(28, 'Brunei Darussalam', 673),
(29, 'Bulgaria', 359),
(30, 'Burkina Faso', 226),
(31, 'Burma (Myanmar)', 95),
(32, 'Burundi', 257),
(33, 'Cambodia', 855),
(34, 'Cameroon', 237),
(35, 'Canada', 1),
(36, 'Cape Verde Islands', 238),
(37, 'Central African Republic', 236),
(38, 'Chad', 235),
(39, 'Chile', 56),
(40, 'China', 86),
(41, 'Christmas Island', 672),
(42, 'Cocos Island', 672),
(43, 'Colombia', 57),
(44, 'Comoros', 269),
(45, 'Congo', 242),
(46, 'Cook Islands', 682),
(47, 'Costa Rica', 506),
(48, 'Croatia', 385),
(49, 'Cuba', 53),
(50, 'Cyprus', 357),
(51, 'Czech Republic', 42),
(52, 'Denmark', 45),
(53, 'Djibouti', 253),
(54, 'Ecuador', 593),
(55, 'Egypt', 20),
(56, 'El Salvador', 503),
(57, 'Equatorial Guinea', 240),
(58, 'Eritrea', 291),
(59, 'Estonia', 372),
(60, 'Ethiopia', 251),
(61, 'Falkland Islands', 500),
(62, 'Faroe Islands', 298),
(63, 'Fiji', 679),
(64, 'Finland', 358),
(65, 'France', 33),
(66, 'French Guiana', 594),
(67, 'French Polynesia', 689),
(68, 'Gabon', 241),
(69, 'Gambia', 220),
(70, 'Georgia', 995),
(71, 'Germany', 49),
(72, 'Ghana', 233),
(73, 'Gibraltar', 350),
(74, 'Greece', 30),
(75, 'Greenland', 299),
(76, 'Guadeloupe', 590),
(77, 'Guam', 671),
(78, 'Guatemala', 502),
(79, 'Guinea', 224),
(80, 'Guinea-Bissau', 245),
(81, 'Guyana', 592),
(82, 'Haiti', 509),
(83, 'Honduras', 504),
(84, 'Hong Kong', 852),
(85, 'Hungary', 36),
(86, 'Iceland', 354),
(87, 'India', 91),
(88, 'Indonesia', 62),
(89, 'Iran', 98),
(90, 'Iraq', 964),
(91, 'Ireland', 353),
(92, 'Israel', 972),
(93, 'Italy', 39),
(94, 'Japan', 81),
(95, 'Jordan', 962),
(96, 'Kazakhstan', 7),
(97, 'Kenya', 254),
(98, 'Kirghizstan', 7),
(99, 'Kiribati', 686),
(100, 'Kosovo', 381),
(101, 'Kuwait', 965),
(102, 'Laos', 856),
(103, 'Latvia', 371),
(104, 'Lebanon', 961),
(105, 'Lesotho', 266),
(106, 'Liberia', 231),
(107, 'Libya', 218),
(108, 'Liechtenstein', 423),
(109, 'Lithuania', 370),
(110, 'Luxembourg', 352),
(111, 'Macao', 853),
(112, 'Macedonia', 389),
(113, 'Madagascar', 261),
(114, 'Malawi', 265),
(115, 'Malaysia', 60),
(116, 'Maldives', 960),
(117, 'Mali', 223),
(118, 'Malta', 356),
(119, 'Marshall Islands', 692),
(120, 'Martinique', 596),
(121, 'Mauritania', 222),
(122, 'Mauritius', 230),
(123, 'Mayotte', 269),
(124, 'Mexico', 52),
(125, 'Micronesia', 691),
(126, 'Moldova', 373),
(127, 'Monaco', 377),
(128, 'Mongolia', 976),
(129, 'Montenegro', 382),
(130, 'Morocco', 212),
(131, 'Mozambique', 258),
(132, 'Namibia', 264),
(133, 'Nauru', 674),
(134, 'Napal', 977),
(135, 'Netherlands (Holland)', 31),
(136, 'Netherlands Antilles', 599),
(137, 'New Caledonia', 687),
(138, 'New Zealand', 64),
(139, 'Nicaragua', 505),
(140, 'Niger Republic', 227),
(141, 'Nigeria', 234),
(142, 'Norway', 47),
(143, 'North Korea', 850),
(144, 'Oman', 968),
(145, 'Pakistan', 92),
(146, 'Panama', 507),
(147, 'Papua New Guinea', 675),
(148, 'Paraguay', 595),
(149, 'Peru', 51),
(150, 'Philippines', 63),
(151, 'Pitcairn Island', 649),
(152, 'Poland', 48),
(153, 'Portugal', 351),
(154, 'Qatar', 974),
(155, 'Romania', 40),
(156, 'Russia', 7),
(157, 'Rwanda', 250),
(158, 'St Helena', 290),
(159, 'San Marino', 378),
(160, 'Saudi Arabia', 966),
(161, 'Senegal', 221),
(162, 'Serbia', 381),
(163, 'Seychelles', 248),
(164, 'Sierra Leone', 232),
(165, 'Singapore', 65),
(166, 'Slovakia', 421),
(167, 'Slovenia', 386),
(168, 'Solomon Islands', 677),
(169, 'Somalia', 252),
(170, 'South Africa', 27),
(171, 'South Korea', 82),
(172, 'Spain', 349),
(173, 'Sri Lanka', 94),
(174, 'Sudan', 249),
(175, 'Surinam', 597),
(176, 'Swaziland', 268),
(177, 'Sweden', 46),
(178, 'Switzerland', 41),
(179, 'Syria', 963),
(180, 'Taiwan', 886),
(181, 'Tajikistan', 7),
(182, 'Tanzania', 255),
(183, 'Thailand', 66),
(184, 'Togo', 228),
(185, 'Tonga', 676),
(186, 'Tunisia', 216),
(187, 'Turkey', 90),
(188, 'Turkmenistan', 7),
(189, 'Tuvalu', 688),
(190, 'Uganda', 256),
(191, 'Ukraine', 380),
(192, 'United Arab Emirates', 971),
(193, 'United Kingdom', 44),
(194, 'Uraguay', 598),
(195, 'USA', 1),
(196, 'Uzbekistan', 998),
(197, 'Vanuatu', 678),
(198, 'Vatican City', 39),
(199, 'Venezuela', 58),
(200, 'Vietnam', 84),
(201, 'Western Samoa', 685),
(202, 'Yemen', 967),
(203, 'Zaire (Congo)', 243),
(204, 'Zambia', 260),
(205, 'Zimbabwe', 263);

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE IF NOT EXISTS `currency` (
  `currencyId` bigint(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `code` varchar(3) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`currencyId`, `name`, `code`) VALUES
(1, 'Australian Dollar', 'AUD'),
(2, 'Brazilian Real', 'BRL'),
(3, 'Canadian Dollar', 'CRD'),
(4, 'Czech Koruna', 'CZK'),
(5, 'Danish Krone', 'DKK'),
(6, 'Euro', 'EUR'),
(7, 'Hong Kong Dollar', 'HKD'),
(8, 'Hungarian Forint', 'HUF'),
(9, 'Israeli New Sheqel', 'ILS'),
(10, 'Japanese Yen', 'JPY'),
(11, 'Malaysian Ringgit ', 'MYR'),
(12, 'Mexican Peso', 'MXN'),
(13, 'Norwegian Krone', 'NOK'),
(14, 'New Zealand Dollar', 'NZD'),
(15, 'Philippine Peso', 'PHP'),
(16, 'Polish Zloty', 'PLN'),
(17, 'Pound Sterling', 'GBP'),
(18, 'Russian Ruble', 'RUB'),
(19, 'Singapore Dollar', 'SGD'),
(20, 'Swedish Krona', 'SEK'),
(21, 'Swiss Franc', 'CHF'),
(22, 'Taiwan New Dollar ', 'TWD'),
(23, 'Thai Baht', 'THB'),
(24, 'Turkish Lira', 'TRY'),
(25, 'U.S. Dollar', 'USD');

-- --------------------------------------------------------

--
-- Table structure for table `details`
--

CREATE TABLE IF NOT EXISTS `details` (
  `detailsId` int(25) NOT NULL,
  `from` varchar(25) NOT NULL,
  `to` varchar(25) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `disabilities`
--

CREATE TABLE IF NOT EXISTS `disabilities` (
  `disabilitiesId` int(10) NOT NULL,
  `type` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `disabilities`
--

INSERT INTO `disabilities` (`disabilitiesId`, `type`) VALUES
(1, 'Autism'),
(2, 'Chronic Illness'),
(3, 'Hearing loss & deafness'),
(4, 'Intellectual disability'),
(5, 'learning disability'),
(6, 'Memory loss'),
(7, 'Mental illness'),
(8, 'Physical disability'),
(9, 'Speech & language disorder'),
(10, 'Vision loss & blindness');

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE IF NOT EXISTS `education` (
  `eduId` int(25) NOT NULL,
  `type` varchar(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`eduId`, `type`) VALUES
(1, 'MiddleSchool'),
(2, 'Intermediate'),
(3, 'Bachelors'),
(4, 'Masters'),
(5, 'Doctorate'),
(6, 'Uneducated'),
(7, 'Diploma'),
(8, 'Associate Degree'),
(9, 'Honors Degree');

-- --------------------------------------------------------

--
-- Table structure for table `family`
--

CREATE TABLE IF NOT EXISTS `family` (
  `familyId` int(25) NOT NULL,
  `familytypeid` int(25) NOT NULL,
  `statusid` int(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `family`
--

INSERT INTO `family` (`familyId`, `familytypeid`, `statusid`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 2, 1),
(7, 2, 2),
(8, 2, 3),
(9, 2, 4),
(10, 2, 5),
(11, 3, 1),
(12, 3, 2),
(13, 3, 3),
(14, 3, 4),
(15, 3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `familystatus`
--

CREATE TABLE IF NOT EXISTS `familystatus` (
  `statusid` int(10) NOT NULL,
  `type` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `familystatus`
--

INSERT INTO `familystatus` (`statusid`, `type`) VALUES
(1, 'Middle Class'),
(2, 'Upper Middle Class'),
(3, 'Upper Class'),
(4, 'High Class'),
(5, 'Lower Middle Class');

-- --------------------------------------------------------

--
-- Table structure for table `familytype`
--

CREATE TABLE IF NOT EXISTS `familytype` (
  `familytypeid` int(10) NOT NULL,
  `type` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `familytype`
--

INSERT INTO `familytype` (`familytypeid`, `type`) VALUES
(1, 'Joint'),
(2, 'Nuclear'),
(3, 'Single Parent');

-- --------------------------------------------------------

--
-- Table structure for table `favourites`
--

CREATE TABLE IF NOT EXISTS `favourites` (
  `favouritesId` int(25) NOT NULL,
  `from` varchar(25) NOT NULL,
  `at` varchar(25) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `field`
--

CREATE TABLE IF NOT EXISTS `field` (
  `fieldId` int(25) NOT NULL,
  `type` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `field`
--

INSERT INTO `field` (`fieldId`, `type`) VALUES
(1, 'Bussiness'),
(2, 'Law'),
(3, 'Medical'),
(4, 'Computer & Information Technology'),
(5, 'Arts'),
(6, 'Commerce'),
(7, 'Engineering Technology'),
(8, 'Fashion'),
(9, 'Fine Arts'),
(10, 'Finance & Accounting'),
(11, 'Education'),
(12, 'Architecture'),
(13, 'Others'),
(14, 'ArmedForces'),
(15, 'Medicine'),
(16, 'Travel & Tourism'),
(17, 'Nursing/HealthSciences'),
(18, 'Advertising/Marketing'),
(19, 'Administrative Services'),
(20, 'Office Administration'),
(21, 'Shipping');

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE IF NOT EXISTS `gender` (
  `genderId` int(255) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`genderId`, `type`) VALUES
(1, 'Male'),
(2, 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `imageId` int(255) NOT NULL,
  `UserID` int(255) NOT NULL,
  `image` longblob NOT NULL,
  `approved` tinyint(1) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE IF NOT EXISTS `language` (
  `languageId` int(255) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`languageId`, `type`) VALUES
(1, 'English'),
(2, 'French'),
(3, 'Arbi'),
(4, 'Urdu'),
(5, 'German');

-- --------------------------------------------------------

--
-- Table structure for table `lists`
--

CREATE TABLE IF NOT EXISTS `lists` (
  `listid` int(255) NOT NULL,
  `id` int(255) NOT NULL,
  `userId` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `marketer`
--

CREATE TABLE IF NOT EXISTS `marketer` (
  `marketerId` int(255) NOT NULL,
  `Username` text NOT NULL,
  `password` varchar(8) NOT NULL,
  `detailId` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `marketerdetail`
--

CREATE TABLE IF NOT EXISTS `marketerdetail` (
  `detailId` int(255) NOT NULL,
  `commissionId` int(255) NOT NULL,
  `listId` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `martial`
--

CREATE TABLE IF NOT EXISTS `martial` (
  `martialid` int(10) NOT NULL,
  `type` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `martial`
--

INSERT INTO `martial` (`martialid`, `type`) VALUES
(1, 'Single'),
(2, 'Married'),
(3, 'Widower'),
(4, 'Separated'),
(5, 'Divorced');

-- --------------------------------------------------------

--
-- Table structure for table `membership`
--

CREATE TABLE IF NOT EXISTS `membership` (
  `typeId` int(25) NOT NULL,
  `type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `msgId` int(25) NOT NULL,
  `detailsId` int(25) NOT NULL,
  `UserID` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
  `Notificationid` int(255) NOT NULL,
  `UserID` int(255) NOT NULL,
  `seen` tinyint(1) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `occupation`
--

CREATE TABLE IF NOT EXISTS `occupation` (
  `occupationId` int(25) NOT NULL,
  `type` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `occupation`
--

INSERT INTO `occupation` (`occupationId`, `type`) VALUES
(1, 'Private Company'),
(2, 'Government'),
(3, 'PublicSector'),
(4, 'Defense'),
(5, 'Civil Services'),
(6, 'self employed'),
(7, 'Bussiness'),
(8, 'not working');

-- --------------------------------------------------------

--
-- Table structure for table `profession`
--

CREATE TABLE IF NOT EXISTS `profession` (
  `professionId` int(25) NOT NULL,
  `eduId` int(25) NOT NULL,
  `fieldId` int(25) NOT NULL,
  `occupationId` int(25) NOT NULL,
  `salary` int(25) NOT NULL,
  `currencyId` bigint(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profession`
--

INSERT INTO `profession` (`professionId`, `eduId`, `fieldId`, `occupationId`, `salary`, `currencyId`) VALUES
(10, 1, 1, 1, 200, 1);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `profileId` int(255) NOT NULL,
  `UserID` int(255) NOT NULL,
  `genderId` int(25) NOT NULL,
  `dob` date NOT NULL,
  `phone` varchar(25) NOT NULL,
  `stateId` int(25) NOT NULL,
  `languageId` int(25) NOT NULL,
  `religionId` int(25) NOT NULL,
  `yourselfdescription` varchar(255) NOT NULL,
  `height` int(5) NOT NULL,
  `weight` int(5) NOT NULL,
  `martialId` int(25) NOT NULL,
  `disabilitiesId` int(25) DEFAULT NULL,
  `familyId` int(25) NOT NULL,
  `professionId` int(25) NOT NULL,
  `partnerpreference` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`profileId`, `UserID`, `genderId`, `dob`, `phone`, `stateId`, `languageId`, `religionId`, `yourselfdescription`, `height`, `weight`, `martialId`, `disabilitiesId`, `familyId`, `professionId`, `partnerpreference`) VALUES
(5, 12, 1, '1992-10-31', '+932275622', 1, 1, 1, 'testing', 148, 106, 1, NULL, 1, 10, 'i just want to add');

-- --------------------------------------------------------

--
-- Table structure for table `religion`
--

CREATE TABLE IF NOT EXISTS `religion` (
  `religionId` int(25) NOT NULL,
  `type` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `religion`
--

INSERT INTO `religion` (`religionId`, `type`) VALUES
(1, 'Islam'),
(2, 'Chiristianity'),
(3, 'Hindusim'),
(4, 'Judaism'),
(5, 'Buddhism'),
(6, 'Shinto'),
(7, 'Atheism'),
(8, 'Taosim');

-- --------------------------------------------------------

--
-- Table structure for table `religionsect`
--

CREATE TABLE IF NOT EXISTS `religionsect` (
  `religionsectId` int(25) NOT NULL,
  `religionId` int(25) NOT NULL,
  `sectId` int(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `religionsect`
--

INSERT INTO `religionsect` (`religionsectId`, `religionId`, `sectId`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 2, 4),
(5, 2, 5),
(6, 2, 6),
(7, 3, 18),
(8, 3, 19),
(9, 3, 20),
(10, 3, 21),
(11, 4, 7),
(12, 4, 8),
(13, 4, 9),
(14, 4, 10),
(15, 4, 11),
(16, 6, 12),
(17, 6, 13),
(18, 6, 14),
(19, 6, 15),
(20, 8, 16),
(21, 8, 17),
(22, 5, 22),
(23, 5, 23),
(24, 5, 24),
(25, 5, 25),
(26, 7, 26),
(27, 7, 27),
(28, 7, 28),
(29, 7, 29);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `roleid` int(255) NOT NULL,
  `type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sect`
--

CREATE TABLE IF NOT EXISTS `sect` (
  `sectId` int(25) NOT NULL,
  `type` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sect`
--

INSERT INTO `sect` (`sectId`, `type`) VALUES
(1, 'Sunni'),
(2, 'Shia'),
(3, 'Sufism'),
(4, 'Orthodox'),
(5, 'Protestants'),
(6, 'Catholic'),
(7, 'Orthodox Judaism'),
(8, 'Reform Judaism'),
(9, 'Conservative Judaism'),
(10, 'Hasidic Judaism'),
(11, 'Kabbalah'),
(12, 'Tenrikyo'),
(13, 'Konkokyo'),
(14, 'Kurozumikyo'),
(15, 'Shinto Taikyo'),
(16, 'Religious Taoism (Daojiao)'),
(17, 'Philosophical Taoism (Daojia)'),
(18, 'Saivism'),
(19, 'Shaktism'),
(20, 'Vaishnavism'),
(21, 'Smartism'),
(22, 'Theravada Buddhism'),
(23, ' Mahayana Buddhism'),
(24, 'Zen Buddhism'),
(25, 'Tantric Buddhism'),
(26, 'Agnostic'),
(27, 'Activist'),
(28, 'Seeker-agnostic'),
(29, 'Anti-theist');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE IF NOT EXISTS `state` (
  `stateid` int(25) NOT NULL,
  `countryid` int(25) NOT NULL,
  `cityid` int(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`stateid`, `countryid`, `cityid`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 1, 9),
(10, 1, 10),
(11, 1, 11),
(12, 1, 12),
(13, 1, 13),
(14, 1, 14),
(15, 1, 15),
(16, 1, 16),
(17, 1, 17),
(18, 1, 18),
(19, 1, 19);

-- --------------------------------------------------------

--
-- Table structure for table `subadmin`
--

CREATE TABLE IF NOT EXISTS `subadmin` (
  `said` int(255) NOT NULL,
  `username` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `roleid` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `successstories`
--

CREATE TABLE IF NOT EXISTS `successstories` (
  `storyId` int(255) NOT NULL,
  `UserID` int(255) NOT NULL,
  `story` varchar(255) NOT NULL,
  `approved` text NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `UserID` bigint(20) NOT NULL,
  `UserName` text NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(200) NOT NULL,
  `Active` tinyint(1) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `UserName`, `Email`, `Password`, `Active`, `CreatedAt`) VALUES
(1, 'haziqAhmed', 'haziq.ahmed92@gmail.com', 'haziq5692', 1, '2015-12-04 19:00:00'),
(2, 'mubeen', 'mubeen@gmail.com', 'mubeenKiet', 1, '2015-12-04 19:00:00'),
(12, 'ahmed', 'ahmed@gmail.com', 'oAow1ZlJl7S7wNxxsP5tXw==', 1, '2015-12-07 19:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `usermembership`
--

CREATE TABLE IF NOT EXISTS `usermembership` (
  `membershipId` int(25) NOT NULL,
  `UserID` int(255) NOT NULL,
  `typeId` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdminId`);

--
-- Indexes for table `adminchat`
--
ALTER TABLE `adminchat`
  ADD PRIMARY KEY (`chatId`);

--
-- Indexes for table `adminchatdetail`
--
ALTER TABLE `adminchatdetail`
  ADD PRIMARY KEY (`detailId`);

--
-- Indexes for table `adminnotification`
--
ALTER TABLE `adminnotification`
  ADD PRIMARY KEY (`Notificationid`);

--
-- Indexes for table `bandetials`
--
ALTER TABLE `bandetials`
  ADD PRIMARY KEY (`banDetailsId`);

--
-- Indexes for table `banlist`
--
ALTER TABLE `banlist`
  ADD PRIMARY KEY (`BanId`);

--
-- Indexes for table `block`
--
ALTER TABLE `block`
  ADD PRIMARY KEY (`blockId`);

--
-- Indexes for table `blocklist`
--
ALTER TABLE `blocklist`
  ADD PRIMARY KEY (`blocklistId`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`chatId`);

--
-- Indexes for table `chatdetails`
--
ALTER TABLE `chatdetails`
  ADD PRIMARY KEY (`chatdetailsId`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`cityid`);

--
-- Indexes for table `commission`
--
ALTER TABLE `commission`
  ADD PRIMARY KEY (`commissionId`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`countryid`);

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`currencyId`);

--
-- Indexes for table `details`
--
ALTER TABLE `details`
  ADD PRIMARY KEY (`detailsId`);

--
-- Indexes for table `disabilities`
--
ALTER TABLE `disabilities`
  ADD PRIMARY KEY (`disabilitiesId`);

--
-- Indexes for table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`eduId`);

--
-- Indexes for table `family`
--
ALTER TABLE `family`
  ADD PRIMARY KEY (`familyId`);

--
-- Indexes for table `familystatus`
--
ALTER TABLE `familystatus`
  ADD PRIMARY KEY (`statusid`);

--
-- Indexes for table `familytype`
--
ALTER TABLE `familytype`
  ADD PRIMARY KEY (`familytypeid`);

--
-- Indexes for table `favourites`
--
ALTER TABLE `favourites`
  ADD PRIMARY KEY (`favouritesId`);

--
-- Indexes for table `field`
--
ALTER TABLE `field`
  ADD PRIMARY KEY (`fieldId`);

--
-- Indexes for table `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`genderId`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`imageId`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`languageId`);

--
-- Indexes for table `lists`
--
ALTER TABLE `lists`
  ADD PRIMARY KEY (`listid`);

--
-- Indexes for table `marketer`
--
ALTER TABLE `marketer`
  ADD PRIMARY KEY (`marketerId`);

--
-- Indexes for table `martial`
--
ALTER TABLE `martial`
  ADD PRIMARY KEY (`martialid`);

--
-- Indexes for table `membership`
--
ALTER TABLE `membership`
  ADD PRIMARY KEY (`typeId`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`msgId`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`Notificationid`);

--
-- Indexes for table `occupation`
--
ALTER TABLE `occupation`
  ADD PRIMARY KEY (`occupationId`);

--
-- Indexes for table `profession`
--
ALTER TABLE `profession`
  ADD PRIMARY KEY (`professionId`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`profileId`);

--
-- Indexes for table `religion`
--
ALTER TABLE `religion`
  ADD PRIMARY KEY (`religionId`);

--
-- Indexes for table `religionsect`
--
ALTER TABLE `religionsect`
  ADD PRIMARY KEY (`religionsectId`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`roleid`);

--
-- Indexes for table `sect`
--
ALTER TABLE `sect`
  ADD PRIMARY KEY (`sectId`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`stateid`);

--
-- Indexes for table `subadmin`
--
ALTER TABLE `subadmin`
  ADD PRIMARY KEY (`said`);

--
-- Indexes for table `successstories`
--
ALTER TABLE `successstories`
  ADD PRIMARY KEY (`storyId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `usermembership`
--
ALTER TABLE `usermembership`
  ADD PRIMARY KEY (`membershipId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `AdminId` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `adminchat`
--
ALTER TABLE `adminchat`
  MODIFY `chatId` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `adminchatdetail`
--
ALTER TABLE `adminchatdetail`
  MODIFY `detailId` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `adminnotification`
--
ALTER TABLE `adminnotification`
  MODIFY `Notificationid` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bandetials`
--
ALTER TABLE `bandetials`
  MODIFY `banDetailsId` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `banlist`
--
ALTER TABLE `banlist`
  MODIFY `BanId` int(25) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `block`
--
ALTER TABLE `block`
  MODIFY `blockId` int(25) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blocklist`
--
ALTER TABLE `blocklist`
  MODIFY `blocklistId` int(25) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `chatId` int(25) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `chatdetails`
--
ALTER TABLE `chatdetails`
  MODIFY `chatdetailsId` int(25) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `cityid` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `commission`
--
ALTER TABLE `commission`
  MODIFY `commissionId` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `countryid` int(25) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=206;
--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `currencyId` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `details`
--
ALTER TABLE `details`
  MODIFY `detailsId` int(25) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `disabilities`
--
ALTER TABLE `disabilities`
  MODIFY `disabilitiesId` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `eduId` int(25) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `family`
--
ALTER TABLE `family`
  MODIFY `familyId` int(25) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `familystatus`
--
ALTER TABLE `familystatus`
  MODIFY `statusid` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `familytype`
--
ALTER TABLE `familytype`
  MODIFY `familytypeid` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `favourites`
--
ALTER TABLE `favourites`
  MODIFY `favouritesId` int(25) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `field`
--
ALTER TABLE `field`
  MODIFY `fieldId` int(25) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `gender`
--
ALTER TABLE `gender`
  MODIFY `genderId` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `imageId` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `languageId` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `lists`
--
ALTER TABLE `lists`
  MODIFY `listid` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `marketer`
--
ALTER TABLE `marketer`
  MODIFY `marketerId` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `martial`
--
ALTER TABLE `martial`
  MODIFY `martialid` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `membership`
--
ALTER TABLE `membership`
  MODIFY `typeId` int(25) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `msgId` int(25) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `Notificationid` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `occupation`
--
ALTER TABLE `occupation`
  MODIFY `occupationId` int(25) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `profession`
--
ALTER TABLE `profession`
  MODIFY `professionId` int(25) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `profileId` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `religion`
--
ALTER TABLE `religion`
  MODIFY `religionId` int(25) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `religionsect`
--
ALTER TABLE `religionsect`
  MODIFY `religionsectId` int(25) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `roleid` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sect`
--
ALTER TABLE `sect`
  MODIFY `sectId` int(25) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `stateid` int(25) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `subadmin`
--
ALTER TABLE `subadmin`
  MODIFY `said` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `successstories`
--
ALTER TABLE `successstories`
  MODIFY `storyId` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `usermembership`
--
ALTER TABLE `usermembership`
  MODIFY `membershipId` int(25) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

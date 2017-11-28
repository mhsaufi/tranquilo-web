-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Nov 28, 2017 at 04:30 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tranquilo_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tranquilo_application`
--

CREATE TABLE `tranquilo_application` (
  `application_id` int(11) NOT NULL,
  `application_deal` int(11) DEFAULT NULL,
  `application_installment` int(11) DEFAULT NULL,
  `application_description` text,
  `application_client` int(11) NOT NULL,
  `application_status` int(11) NOT NULL DEFAULT '1',
  `application_update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `application_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tranquilo_application`
--

INSERT INTO `tranquilo_application` (`application_id`, `application_deal`, `application_installment`, `application_description`, `application_client`, `application_status`, `application_update_date`, `application_date`) VALUES
(1, 5, 4, 'YOLO', 2, 1, '2017-11-28 06:40:14', '2017-11-21 12:20:48'),
(6, 5, 4, 'YOLO', 2, 1, '2017-11-28 06:40:11', '2017-11-21 12:24:38'),
(7, 2, 1, 'YOLO 2', 2, 1, '2017-11-28 06:03:12', '2017-11-21 12:26:03'),
(8, 2, 1, 'YOLO 2', 2, 1, '2017-11-28 06:03:15', '2017-11-21 12:26:35'),
(9, 1, 300, 'Hope approved', 2, 2, '2017-11-28 06:40:27', '2017-11-27 02:25:38');

-- --------------------------------------------------------

--
-- Table structure for table `tranquilo_application_status`
--

CREATE TABLE `tranquilo_application_status` (
  `application_status_id` int(11) NOT NULL,
  `application_status_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tranquilo_application_status`
--

INSERT INTO `tranquilo_application_status` (`application_status_id`, `application_status_title`) VALUES
(1, 'Pending'),
(2, 'Reviewed'),
(3, 'Accepted'),
(4, 'Declined');

-- --------------------------------------------------------

--
-- Table structure for table `tranquilo_bookmark`
--

CREATE TABLE `tranquilo_bookmark` (
  `bookmark_id` int(11) NOT NULL,
  `bookmark_user` int(11) NOT NULL,
  `bookmark_deal` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tranquilo_bookmark`
--

INSERT INTO `tranquilo_bookmark` (`bookmark_id`, `bookmark_user`, `bookmark_deal`) VALUES
(1, 2, '5|4|2|7|6|9');

-- --------------------------------------------------------

--
-- Table structure for table `tranquilo_business_type`
--

CREATE TABLE `tranquilo_business_type` (
  `b_type_id` int(11) NOT NULL,
  `b_type_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tranquilo_business_type`
--

INSERT INTO `tranquilo_business_type` (`b_type_id`, `b_type_title`) VALUES
(1, 'Sale'),
(2, 'Rental'),
(3, 'Ownership Transfer'),
(4, 'Free'),
(5, 'Contract'),
(6, 'Homestay');

-- --------------------------------------------------------

--
-- Table structure for table `tranquilo_deal`
--

CREATE TABLE `tranquilo_deal` (
  `d_id` int(11) NOT NULL,
  `d_client` int(11) DEFAULT NULL,
  `d_owner` int(11) NOT NULL,
  `d_contact` text,
  `d_description` longtext,
  `d_payment_type` int(11) DEFAULT NULL,
  `d_b_type` int(11) NOT NULL,
  `d_model` int(11) NOT NULL,
  `d_installment` int(11) DEFAULT NULL,
  `d_value` int(11) NOT NULL,
  `d_status` int(11) NOT NULL,
  `d_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tranquilo_deal`
--

INSERT INTO `tranquilo_deal` (`d_id`, `d_client`, `d_owner`, `d_contact`, `d_description`, `d_payment_type`, `d_b_type`, `d_model`, `d_installment`, `d_value`, `d_status`, `d_date`) VALUES
(1, NULL, 1, '0135448612', '<p><br></p>', NULL, 1, 1, NULL, 450000, 1, '2017-11-18 03:17:21'),
(3, NULL, 1, '0135448612', '<p><br></p>', NULL, 4, 3, NULL, 450000, 1, '2017-11-18 03:34:52'),
(4, NULL, 1, '0135448612', '<p><br></p>', NULL, 4, 4, NULL, 450000, 1, '2017-11-18 07:18:23'),
(5, NULL, 1, '0135448612', '<p><br></p>', NULL, 5, 5, NULL, 450000, 1, '2017-11-18 07:26:14'),
(6, NULL, 1, '0135448612', '<p>Goona change everything back to the original state<br></p>', NULL, 2, 4, NULL, 450000, 1, '2017-11-23 07:19:05'),
(7, NULL, 1, '0135448612', '<p><br></p>', NULL, 2, 5, NULL, 450000, 1, '2017-11-23 07:24:45'),
(8, NULL, 1, '0135448612', '<p><br></p>', NULL, 2, 4, NULL, 450000, 1, '2017-11-26 21:21:50'),
(9, NULL, 1, '0135448612', '<p><br></p>', NULL, 2, 6, NULL, 450000, 1, '2017-11-26 22:18:27'),
(10, NULL, 1, '0135448612', '<p>Nothing to be scared of..huhu<br></p>', NULL, 3, 1, NULL, 230000, 1, '2017-11-27 03:41:37');

-- --------------------------------------------------------

--
-- Table structure for table `tranquilo_deal_status`
--

CREATE TABLE `tranquilo_deal_status` (
  `status_id` int(11) NOT NULL,
  `status_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tranquilo_deal_status`
--

INSERT INTO `tranquilo_deal_status` (`status_id`, `status_title`) VALUES
(1, 'None'),
(2, 'Reserved'),
(3, 'Booked'),
(4, 'Pending'),
(5, 'Processed'),
(6, 'Finish'),
(7, 'Expired');

-- --------------------------------------------------------

--
-- Table structure for table `tranquilo_house_type`
--

CREATE TABLE `tranquilo_house_type` (
  `h_type_id` int(11) NOT NULL,
  `h_type_title` text NOT NULL,
  `type_class` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tranquilo_house_type`
--

INSERT INTO `tranquilo_house_type` (`h_type_id`, `h_type_title`, `type_class`) VALUES
(1, 'Terrace', 1),
(2, 'Townhouse', 1),
(3, 'Semi-D', 1),
(4, 'Bungalow', 1),
(5, 'Apartments', 2),
(6, 'Flats', 2),
(7, 'Condominiums', 2),
(8, 'SoHo', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tranquilo_message`
--

CREATE TABLE `tranquilo_message` (
  `message_id` int(11) NOT NULL,
  `message_sender` int(11) NOT NULL,
  `message_recipient` int(11) DEFAULT NULL,
  `message_subject` text NOT NULL,
  `message_content` longtext NOT NULL,
  `message_status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tranquilo_message`
--

INSERT INTO `tranquilo_message` (`message_id`, `message_sender`, `message_recipient`, `message_subject`, `message_content`, `message_status`, `created_at`) VALUES
(1, 1, 2, 'This is a testing message only', 'Hi there i am a testing object', 2, '2017-11-24 15:02:14'),
(2, 3, 2, 'Tranquilo Application', 'Your application for Naratha Semi Houses on Nov 21, 2017 had been reviewed by owner<br><br><br><i class=\'fa icon-phone\'></i>0325567844<br><br><small><em>customer@tranquiloproperty.net</em></small>', 2, '2017-11-24 17:18:58'),
(3, 3, 2, 'Tranquilo Application', 'Your application for Naratha Semi Houses on Nov 21, 2017 had been reviewed by owner<br><br><br><i class=\'fa icon-phone\'></i>0325567844<br><br><small><em>customer@tranquiloproperty.net</em></small>', 2, '2017-11-24 17:47:51'),
(4, 3, 2, 'Tranquilo Application', 'Your application for Villa Sungai Ramal on Nov 21, 2017 had been reviewed by owner<br><br><br><i class=\'fa icon-phone\'></i>0325567844<br><br><small><em>customer@tranquiloproperty.net</em></small>', 2, '2017-11-24 17:48:04'),
(5, 3, 2, 'Tranquilo Application', 'Your application for Naratha Semi Houses on Nov 21, 2017 had been reviewed by owner<br><br><br><i class=\'fa icon-phone\'></i>0325567844<br><br><small><em>customer@tranquiloproperty.net</em></small>', 2, '2017-11-24 17:48:12'),
(6, 3, 2, 'Tranquilo Application', 'Your application for Villa Sungai Ramal on Nov 21, 2017 had been reviewed by owner<br><br><br><i class=\'fa icon-phone\'></i>0325567844<br><br><small><em>customer@tranquiloproperty.net</em></small>', 1, '2017-11-24 17:48:23'),
(7, 3, 2, 'Tranquilo Application', 'Your application for Naratha Semi Houses on Nov 21, 2017 had been reviewed by owner<br><br><br><i class=\'fa icon-phone\'></i>0325567844<br><br><small><em>customer@tranquiloproperty.net</em></small>', 1, '2017-11-24 17:49:45'),
(8, 3, 2, 'Tranquilo Application', 'Your application for Villa Sungai Ramal on Nov 21, 2017 had been reviewed by owner<br><br><br><i class=\'fa icon-phone\'></i>0325567844<br><br><small><em>customer@tranquiloproperty.net</em></small>', 1, '2017-11-24 17:57:59'),
(9, 3, 2, 'Tranquilo Application', 'Your application for Villa Sungai Ramal on Nov 21, 2017 has been accepted by owner<br><br><br><i class=\'fa icon-phone\'></i>0325567844<br><br><small><em>customer@tranquiloproperty.net</em></small>', 1, '2017-11-24 17:58:05'),
(10, 3, 2, 'Tranquilo Application', 'Your application for Naratha Semi Houses on Nov 21, 2017 had been reviewed by owner<br><br><br><i class=\'fa icon-phone\'></i>0325567844<br><br><small><em>customer@tranquiloproperty.net</em></small>', 2, '2017-11-24 18:28:47'),
(11, 3, 2, 'Tranquilo Application', 'Your application for Villa Sungai Ramal on Nov 21, 2017 had been reviewed by owner<br><br><br><i class=\'fa icon-phone\'></i>0325567844<br><br><small><em>customer@tranquiloproperty.net</em></small>', 1, '2017-11-24 18:29:09'),
(12, 3, 2, 'Tranquilo Application', 'Your application for Naratha Semi Houses on Nov 21, 2017 had been reviewed by owner<br><br><br><i class=\'fa icon-phone\'></i>0325567844<br><br><small><em>customer@tranquiloproperty.net</em></small>', 2, '2017-11-24 18:32:20'),
(13, 3, 2, 'Tranquilo Application', 'Your application for Naratha Semi Houses on Nov 21, 2017 has been rejected by owner<br>We apologized for the declined. Try and look for more property on our site.<br>Thank you.<br><br><br><i class=\'fa icon-phone\'></i>0325567844<br><br><small><em>customer@tranquiloproperty.net</em></small>', 2, '2017-11-24 18:32:23'),
(14, 3, 2, 'Tranquilo Application', 'Your application for Naratha Semi Houses on Nov 21, 2017 had been reviewed by owner<br><br><br><i class=\'fa icon-phone\'></i>0325567844<br><br><small><em>customer@tranquiloproperty.net</em></small>', 2, '2017-11-24 18:32:27'),
(15, 3, 2, 'Tranquilo Application', 'Your application for Naratha Semi Houses on Nov 21, 2017 has been rejected by owner<br>We apologized for the declined. Try and look for more property on our site.<br>Thank you.<br><br><br><i class=\'fa icon-phone\'></i>0325567844<br><br><small><em>customer@tranquiloproperty.net</em></small>', 1, '2017-11-24 20:41:55'),
(16, 3, 2, 'Tranquilo Application', 'Your application for Setia Villa S6 on Nov 27, 2017 had been reviewed by owner<br><br><br><i class=\'fa icon-phone\'></i>0325567844<br><br><small><em>customer@tranquiloproperty.net</em></small>', 1, '2017-11-27 02:27:55'),
(17, 3, 2, 'Tranquilo Application', 'Your application for Setia Villa S6 on Nov 27, 2017 has been rejected by owner<br>We apologized for the declined. Try and look for more property on our site.<br>Thank you.<br><br><br><i class=\'fa icon-phone\'></i>0325567844<br><br><small><em>customer@tranquiloproperty.net</em></small>', 1, '2017-11-27 13:14:19'),
(18, 3, 2, 'Tranquilo Application', 'Your application for Villa Sungai Ramal on Nov 21, 2017 has been rejected by owner<br>We apologized for the declined. Try and look for more property on our site.<br>Thank you.<br><br><br><i class=\'fa icon-phone\'></i>0325567844<br><br><small><em>customer@tranquiloproperty.net</em></small>', 1, '2017-11-27 13:19:59'),
(19, 3, 2, 'Tranquilo Application', 'Your application for Villa Sungai Ramal on Nov 21, 2017 has been rejected by owner<br>We apologized for the declined. Try and look for more property on our site.<br>Thank you.<br><br><br><i class=\'fa icon-phone\'></i>0325567844<br><br><small><em>customer@tranquiloproperty.net</em></small>', 1, '2017-11-27 13:21:41'),
(20, 3, 2, 'Tranquilo Application', 'Your application for Villa Sungai Ramal on Nov 21, 2017 has been rejected by owner<br>We apologized for the declined. Try and look for more property on our site.<br>Thank you.<br><br><br><i class=\'fa icon-phone\'></i>0325567844<br><br><small><em>customer@tranquiloproperty.net</em></small>', 1, '2017-11-27 13:22:20'),
(21, 3, 2, 'Tranquilo Application', 'Your application for Villa Sungai Ramal on Nov 21, 2017 has been rejected by owner<br>We apologized for the declined. Try and look for more property on our site.<br>Thank you.<br><br><br><i class=\'fa icon-phone\'></i>0325567844<br><br><small><em>customer@tranquiloproperty.net</em></small>', 1, '2017-11-27 13:23:03'),
(22, 3, 2, 'Tranquilo Application', 'Your application for Villa Sungai Ramal on Nov 21, 2017 has been rejected by owner<br>We apologized for the declined. Try and look for more property on our site.<br>Thank you.<br><br><br><i class=\'fa icon-phone\'></i>0325567844<br><br><small><em>customer@tranquiloproperty.net</em></small>', 1, '2017-11-27 13:29:55'),
(23, 3, 2, 'Tranquilo Application', 'Your application for Setia Villa S6 on Nov 27, 2017 had been reviewed by owner<br><br><br><i class=\'fa icon-phone\'></i>0325567844<br><br><small><em>customer@tranquiloproperty.net</em></small>', 1, '2017-11-28 06:03:36'),
(24, 3, 2, 'Tranquilo Application', 'Your application for Villa Sungai Ramal on Nov 21, 2017 had been reviewed by owner<br><br><br><i class=\'fa icon-phone\'></i>0325567844<br><br><small><em>customer@tranquiloproperty.net</em></small>', 1, '2017-11-28 06:15:07'),
(25, 3, 2, 'Tranquilo Application', 'Your application for Villa Sungai Ramal on Nov 21, 2017 had been reviewed by owner<br><br><br><i class=\'fa icon-phone\'></i>0325567844<br><br><small><em>customer@tranquiloproperty.net</em></small>', 1, '2017-11-28 06:16:10'),
(26, 3, 2, 'Tranquilo Application', 'Your application for Villa Sungai Ramal on Nov 21, 2017 had been reviewed by owner<br><br><br><i class=\'fa icon-phone\'></i>0325567844<br><br><small><em>customer@tranquiloproperty.net</em></small>', 1, '2017-11-28 06:17:03'),
(27, 3, 2, 'Tranquilo Application', 'Your application for Villa Sungai Ramal on Nov 21, 2017 had been reviewed by owner<br><br><br><i class=\'fa icon-phone\'></i>0325567844<br><br><small><em>customer@tranquiloproperty.net</em></small>', 1, '2017-11-28 06:25:56'),
(28, 3, 2, 'Tranquilo Application', 'Your application for Setia Villa S6 on Nov 27, 2017 had been reviewed by owner<br><br><br><i class=\'fa icon-phone\'></i>0325567844<br><br><small><em>customer@tranquiloproperty.net</em></small>', 1, '2017-11-28 06:27:08'),
(29, 3, 2, 'Tranquilo Application', 'Your application for Villa Sungai Ramal on Nov 21, 2017 had been reviewed by owner<br><br><br><i class=\'fa icon-phone\'></i>0325567844<br><br><small><em>customer@tranquiloproperty.net</em></small>', 1, '2017-11-28 06:28:15'),
(30, 3, 2, 'Tranquilo Application', 'Your application for Villa Sungai Ramal on Nov 21, 2017 had been reviewed by owner<br><br><br><i class=\'fa icon-phone\'></i>0325567844<br><br><br><small><em>customer@tranquiloproperty.net</em></small><br><br><br>', 1, '2017-11-28 06:36:42'),
(31, 3, 2, 'Tranquilo Application', 'Your application for Setia Villa S6 on Nov 27, 2017 had been reviewed by owner<br><br><br><i class=\'fa icon-phone\'></i>0325567844<br><br><br><small><em>customer@tranquiloproperty.net</em></small><br><br><br>', 2, '2017-11-28 06:40:23');

-- --------------------------------------------------------

--
-- Table structure for table `tranquilo_message_status`
--

CREATE TABLE `tranquilo_message_status` (
  `message_status_id` int(11) NOT NULL,
  `message_status_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tranquilo_message_status`
--

INSERT INTO `tranquilo_message_status` (`message_status_id`, `message_status_title`) VALUES
(1, 'Unread'),
(2, 'Read'),
(3, 'Draft'),
(4, 'Deleted');

-- --------------------------------------------------------

--
-- Table structure for table `tranquilo_model`
--

CREATE TABLE `tranquilo_model` (
  `m_id` int(11) NOT NULL,
  `m_title` text,
  `m_year` text,
  `m_price` int(11) DEFAULT NULL,
  `m_b_type` int(11) DEFAULT NULL,
  `m_h_type` int(11) DEFAULT NULL,
  `m_owner` int(11) DEFAULT NULL,
  `m_description` text,
  `m_description_html` longtext,
  `m_b_type_2` int(11) DEFAULT NULL,
  `m_gallery` longtext NOT NULL,
  `m_gallery_key` text NOT NULL,
  `m_state` int(11) DEFAULT NULL,
  `m_address` text,
  `m_view` int(11) NOT NULL DEFAULT '0',
  `m_rate_value` int(11) NOT NULL DEFAULT '0',
  `m_rate_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tranquilo_model`
--

INSERT INTO `tranquilo_model` (`m_id`, `m_title`, `m_year`, `m_price`, `m_b_type`, `m_h_type`, `m_owner`, `m_description`, `m_description_html`, `m_b_type_2`, `m_gallery`, `m_gallery_key`, `m_state`, `m_address`, `m_view`, `m_rate_value`, `m_rate_by`, `created_at`) VALUES
(1, 'Setia Villa S6', '2', 560000, 5, 2, 1, '', '', NULL, 'Setia-Eco-Glades-Cyberjaya-2Sty-Semi-D-House-For-Rent-Cyberjaya-Malaysia.jpg', 'Z6BT1XJYW95IPACEUOQ3', 1, 'Jalan Gombak Setia, Gombak', 179, 2, 1, '2017-11-27 10:38:40'),
(2, 'Naratha Semi Houses', '3', 654000, 3, 3, 1, NULL, '', NULL, 'semi-d-house-for-sell-RM-980k-new_9.jpg', '8370UQT2H6ADR9ZX1JOM', 14, 'Jalan Keramat 8 Datuk Keramat', 43, 0, 0, '2017-11-27 10:38:40'),
(3, 'Keramat Bayu', '3', 850000, 2, 2, 1, '', '<h2><b>Keramat bayu</b></h2><p>Jalan Keramat 7</p><h2><br></h2>', NULL, 'Best-Deal!-Semi-D-for-Sale-Jalan-Girang-Macpherson-Potong-Pasir-Singapore.jpg', 'NVD1RPZLUGYWTBMH0Q9C', 14, 'Jalan Keramat 7, Datok Keramat', 32, 0, 0, '2017-11-27 10:38:40'),
(4, 'Sungai Besi Idaman', '5', 500, 2, 3, 1, 'Idaman Sungai Besi. Jalan Merbahaya', '', NULL, '566913_0_original9huS.jpg', 'J2NL5XSM176VC84AQIB3', 14, 'Jalan Sungai Besi, Sungai Besi 53300, Selangor', 107, 0, 0, '2017-11-27 10:38:40'),
(5, 'Villa Sungai Ramal', '2', 350000, 3, 7, 1, 'Villa Sungai Ramal, Jalan Sungai Besi, Sungai Ramal Dalam', '<p><br></p>', NULL, 'AAEAAQAAAAAAAAgoAAAAJGM2NWQ2NjU3LWY5OWQtNDRhOS1hZmNiLWQ1ZWM1OThjYWRlNQ.jpg', '0VMLODKPEZHBQR6S9CWT', 14, 'Jalan Sungai Besi, Sungai Ramal Dalam', 84, 0, 0, '2017-11-27 10:38:40'),
(6, 'Suria Minton VIlla', '3', 1788653, NULL, 7, 1, 'Nothing to describe', '<p><br></p>', NULL, 'PPHO.2021764.V550.jpg', 'K295DY6PFZTB0JU3WREN', 1, 'Jalan Suria KLCC', 31, 3, 1, '2017-11-27 10:38:40');

-- --------------------------------------------------------

--
-- Table structure for table `tranquilo_rating`
--

CREATE TABLE `tranquilo_rating` (
  `rating_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rated_model` longtext NOT NULL,
  `avg_rated` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tranquilo_rating`
--

INSERT INTO `tranquilo_rating` (`rating_id`, `user_id`, `rated_model`, `avg_rated`) VALUES
(1, 2, '6|1', '3|2');

-- --------------------------------------------------------

--
-- Table structure for table `tranquilo_review`
--

CREATE TABLE `tranquilo_review` (
  `review_id` int(11) NOT NULL,
  `review_content` text NOT NULL,
  `review_status` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `deal_id` int(11) NOT NULL,
  `review_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tranquilo_review`
--

INSERT INTO `tranquilo_review` (`review_id`, `review_content`, `review_status`, `user_id`, `deal_id`, `review_date`) VALUES
(1, 'Setia Villa S6 located close to uptown. Lots of cheap shop there. Good location anyway', 2, 2, 1, '2017-11-27 03:03:00'),
(2, 'Narathiwat section', 2, 2, 1, '2017-11-27 03:07:49'),
(3, 'Narathiwat section', 2, 2, 1, '2017-11-27 03:08:50'),
(4, 'Narathiwat section', 2, 2, 1, '2017-11-27 03:09:10'),
(5, 'Narathiwat section', 2, 2, 1, '2017-11-27 03:15:02'),
(6, 'sehingga terjadi nya perpisahan', 2, 2, 1, '2017-11-27 03:35:10'),
(7, 'karam aku dilautan duka', 2, 2, 1, '2017-11-27 03:37:55'),
(8, 'apakah salahku', 2, 2, 1, '2017-11-27 03:38:36'),
(9, 'kentang gorengku masak hangus', 2, 2, 1, '2017-11-27 03:40:09'),
(10, 'Narathiwat?', 2, 2, 2, '2017-11-27 03:40:43'),
(11, 'hangus terbakar', 2, 1, 5, '2017-11-27 05:07:28');

-- --------------------------------------------------------

--
-- Table structure for table `tranquilo_review_status`
--

CREATE TABLE `tranquilo_review_status` (
  `review_status_id` int(11) NOT NULL,
  `review_status_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tranquilo_review_status`
--

INSERT INTO `tranquilo_review_status` (`review_status_id`, `review_status_title`) VALUES
(1, 'Pending'),
(2, 'Approved'),
(3, 'Display'),
(4, 'Banned');

-- --------------------------------------------------------

--
-- Table structure for table `tranquilo_state`
--

CREATE TABLE `tranquilo_state` (
  `state_id` int(11) NOT NULL,
  `state_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tranquilo_state`
--

INSERT INTO `tranquilo_state` (`state_id`, `state_title`) VALUES
(1, 'Kuala Lumpur'),
(2, 'Johor'),
(3, 'Sabah'),
(4, 'Sarawak'),
(5, 'Kedah'),
(6, 'Kelantan'),
(7, 'Terengganu'),
(8, 'Perlis'),
(9, 'Pulau Pinang'),
(10, 'Perak'),
(11, 'Pahang'),
(12, 'Melaka'),
(13, 'Negeri Sembilan'),
(14, 'Selangor');

-- --------------------------------------------------------

--
-- Table structure for table `tranquilo_users`
--

CREATE TABLE `tranquilo_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `role` int(11) NOT NULL DEFAULT '3',
  `img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tranquilo_users`
--

INSERT INTO `tranquilo_users` (`id`, `name`, `phone_no`, `email`, `address`, `state`, `status`, `role`, `img`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Ahmad', '0135448612', 'ahmad@gmail.com', NULL, NULL, 1, 2, NULL, '$2y$10$q7bL5jNe3HbyfmKzu0T3FO0XqTL/LDPJr/relRR.mIjqgOBnf510.', '', '2017-11-17 07:00:39', '2017-11-17 07:00:39'),
(2, 'piyad', NULL, 'habibmohdsaufi@gmail.com', NULL, NULL, 1, 3, 'fifapc.ico', '$2y$10$E4mCAUl/s3zUUq4wCmTNk.C1cHmyxyeNK97fyU2o.lWPlYVgom9c.', '', '2017-11-18 11:51:32', '2017-11-18 11:51:32'),
(3, 'Tranquilo Property', '0325567844', 'customer@tranquiloproperty.net', NULL, 2, 1, 3, NULL, '', NULL, '2017-11-21 22:00:00', NULL),
(6, 'Admin', NULL, 'admin@tranquilo.com', NULL, NULL, 1, 1, NULL, '$2y$10$6Ik29NBb3uDEQtvaeEXFJ.gnHWmpfOslxa2tem6/b6hrpf8eusnzu', '', '2017-11-28 01:20:59', '2017-11-28 01:20:59');

-- --------------------------------------------------------

--
-- Table structure for table `tranquilo_users_role`
--

CREATE TABLE `tranquilo_users_role` (
  `role_id` int(11) NOT NULL,
  `role_title` text NOT NULL,
  `role_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tranquilo_users_role`
--

INSERT INTO `tranquilo_users_role` (`role_id`, `role_title`, `role_status`) VALUES
(1, 'Admin', 1),
(2, 'Landlord', 1),
(3, 'Users', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tranquilo_users_status`
--

CREATE TABLE `tranquilo_users_status` (
  `user_status_id` int(11) NOT NULL,
  `user_status_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tranquilo_users_status`
--

INSERT INTO `tranquilo_users_status` (`user_status_id`, `user_status_title`) VALUES
(1, 'Active'),
(2, 'Locked'),
(3, 'Blacklisted'),
(4, 'Inactive');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tranquilo_application`
--
ALTER TABLE `tranquilo_application`
  ADD PRIMARY KEY (`application_id`);

--
-- Indexes for table `tranquilo_application_status`
--
ALTER TABLE `tranquilo_application_status`
  ADD PRIMARY KEY (`application_status_id`);

--
-- Indexes for table `tranquilo_bookmark`
--
ALTER TABLE `tranquilo_bookmark`
  ADD PRIMARY KEY (`bookmark_id`);

--
-- Indexes for table `tranquilo_business_type`
--
ALTER TABLE `tranquilo_business_type`
  ADD PRIMARY KEY (`b_type_id`);

--
-- Indexes for table `tranquilo_deal`
--
ALTER TABLE `tranquilo_deal`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `tranquilo_deal_status`
--
ALTER TABLE `tranquilo_deal_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `tranquilo_house_type`
--
ALTER TABLE `tranquilo_house_type`
  ADD PRIMARY KEY (`h_type_id`);

--
-- Indexes for table `tranquilo_message`
--
ALTER TABLE `tranquilo_message`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `tranquilo_message_status`
--
ALTER TABLE `tranquilo_message_status`
  ADD PRIMARY KEY (`message_status_id`);

--
-- Indexes for table `tranquilo_model`
--
ALTER TABLE `tranquilo_model`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `tranquilo_rating`
--
ALTER TABLE `tranquilo_rating`
  ADD PRIMARY KEY (`rating_id`);

--
-- Indexes for table `tranquilo_review`
--
ALTER TABLE `tranquilo_review`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `tranquilo_review_status`
--
ALTER TABLE `tranquilo_review_status`
  ADD PRIMARY KEY (`review_status_id`);

--
-- Indexes for table `tranquilo_state`
--
ALTER TABLE `tranquilo_state`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `tranquilo_users`
--
ALTER TABLE `tranquilo_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tranquilo_users_role`
--
ALTER TABLE `tranquilo_users_role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `tranquilo_users_status`
--
ALTER TABLE `tranquilo_users_status`
  ADD PRIMARY KEY (`user_status_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tranquilo_application`
--
ALTER TABLE `tranquilo_application`
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tranquilo_application_status`
--
ALTER TABLE `tranquilo_application_status`
  MODIFY `application_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tranquilo_bookmark`
--
ALTER TABLE `tranquilo_bookmark`
  MODIFY `bookmark_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tranquilo_business_type`
--
ALTER TABLE `tranquilo_business_type`
  MODIFY `b_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tranquilo_deal`
--
ALTER TABLE `tranquilo_deal`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tranquilo_deal_status`
--
ALTER TABLE `tranquilo_deal_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tranquilo_house_type`
--
ALTER TABLE `tranquilo_house_type`
  MODIFY `h_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tranquilo_message`
--
ALTER TABLE `tranquilo_message`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `tranquilo_message_status`
--
ALTER TABLE `tranquilo_message_status`
  MODIFY `message_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tranquilo_model`
--
ALTER TABLE `tranquilo_model`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tranquilo_rating`
--
ALTER TABLE `tranquilo_rating`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tranquilo_review`
--
ALTER TABLE `tranquilo_review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tranquilo_review_status`
--
ALTER TABLE `tranquilo_review_status`
  MODIFY `review_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tranquilo_state`
--
ALTER TABLE `tranquilo_state`
  MODIFY `state_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `tranquilo_users`
--
ALTER TABLE `tranquilo_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tranquilo_users_role`
--
ALTER TABLE `tranquilo_users_role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tranquilo_users_status`
--
ALTER TABLE `tranquilo_users_status`
  MODIFY `user_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

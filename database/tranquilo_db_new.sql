-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Nov 21, 2017 at 04:39 PM
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
(1, 5, 4, 'YOLO', 2, 1, '2017-11-21 12:20:48', '2017-11-21 12:20:48'),
(6, 5, 4, 'YOLO', 2, 1, '2017-11-21 12:24:38', '2017-11-21 12:24:38'),
(7, 2, 1, 'YOLO 2', 2, 1, '2017-11-21 12:26:03', '2017-11-21 12:26:03'),
(8, 2, 1, 'YOLO 2', 2, 1, '2017-11-21 12:26:35', '2017-11-21 12:26:35'),
(9, 2, 1, 'YOLO 2', 2, 1, '2017-11-21 12:27:26', '2017-11-21 12:27:26');

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
(5, 'Contract');

-- --------------------------------------------------------

--
-- Table structure for table `tranquilo_deal`
--

CREATE TABLE `tranquilo_deal` (
  `d_id` int(11) NOT NULL,
  `d_client` int(11) DEFAULT NULL,
  `d_owner` int(11) NOT NULL,
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

INSERT INTO `tranquilo_deal` (`d_id`, `d_client`, `d_owner`, `d_payment_type`, `d_b_type`, `d_model`, `d_installment`, `d_value`, `d_status`, `d_date`) VALUES
(1, NULL, 1, NULL, 5, 1, NULL, 450000, 1, '2017-11-18 03:17:21'),
(2, NULL, 1, NULL, 3, 2, NULL, 560000, 1, '2017-11-18 03:31:13'),
(3, NULL, 1, NULL, 2, 3, NULL, 450000, 1, '2017-11-18 03:34:52'),
(4, NULL, 1, NULL, 2, 4, NULL, 250, 1, '2017-11-18 07:18:23'),
(5, NULL, 1, NULL, 3, 5, NULL, 249999, 1, '2017-11-18 07:26:14');

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
-- Table structure for table `tranquilo_favourite`
--

CREATE TABLE `tranquilo_favourite` (
  `fav_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `deal_id_arr` longtext NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `m_view` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tranquilo_model`
--

INSERT INTO `tranquilo_model` (`m_id`, `m_title`, `m_year`, `m_price`, `m_b_type`, `m_h_type`, `m_owner`, `m_description`, `m_description_html`, `m_b_type_2`, `m_gallery`, `m_gallery_key`, `m_state`, `m_address`, `m_view`) VALUES
(1, 'Setia Villa S6', '2', 560000, 5, 2, 1, '', '', NULL, 'Setia-Eco-Glades-Cyberjaya-2Sty-Semi-D-House-For-Rent-Cyberjaya-Malaysia.jpg', 'Z6BT1XJYW95IPACEUOQ3', 1, 'Jalan Gombak Setia, Gombak', 1),
(2, 'Naratha Semi Houses', '3', 654000, 3, 3, 1, NULL, '', NULL, 'semi-d-house-for-sell-RM-980k-new_9.jpg', '8370UQT2H6ADR9ZX1JOM', 14, 'Jalan Keramat 8 Datuk Keramat', 0),
(3, 'Keramat Bayu', '3', 850000, 2, 2, 1, '', '<h2><b>Keramat bayu</b></h2><p>Jalan Keramat 7</p><h2><br></h2>', NULL, 'Best-Deal!-Semi-D-for-Sale-Jalan-Girang-Macpherson-Potong-Pasir-Singapore.jpg', 'NVD1RPZLUGYWTBMH0Q9C', 14, 'Jalan Keramat 7, Datok Keramat', 2),
(4, 'Sungai Besi Idaman', '5', 500, 2, 3, 1, 'Idaman Sungai Besi. Jalan Merbahaya', '', NULL, '566913_0_original9huS.jpg', 'J2NL5XSM176VC84AQIB3', 14, 'Jalan Sungai Besi, Sungai Besi 53300, Selangor', 42),
(5, 'Villa Sungai Ramal', '2', 350000, 3, 7, 1, 'Villa Sungai Ramal, Jalan Sungai Besi, Sungai Ramal Dalam', '<p><br></p>', NULL, 'AAEAAQAAAAAAAAgoAAAAJGM2NWQ2NjU3LWY5OWQtNDRhOS1hZmNiLWQ1ZWM1OThjYWRlNQ.jpg', '0VMLODKPEZHBQR6S9CWT', 14, 'Jalan Sungai Besi, Sungai Ramal Dalam', 5);

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
(2, 'hazard', NULL, 'hazard@chelseafc.com', NULL, NULL, 1, 3, NULL, '$2y$10$iGt96IhSYbIEPS171./lBegw0hYTBge650atSBpoAVRBUV9E9S6OG', '', '2017-11-18 11:51:32', '2017-11-18 11:51:32');

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
-- Indexes for table `tranquilo_favourite`
--
ALTER TABLE `tranquilo_favourite`
  ADD PRIMARY KEY (`fav_id`);

--
-- Indexes for table `tranquilo_house_type`
--
ALTER TABLE `tranquilo_house_type`
  ADD PRIMARY KEY (`h_type_id`);

--
-- Indexes for table `tranquilo_model`
--
ALTER TABLE `tranquilo_model`
  ADD PRIMARY KEY (`m_id`);

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
-- AUTO_INCREMENT for table `tranquilo_business_type`
--
ALTER TABLE `tranquilo_business_type`
  MODIFY `b_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tranquilo_deal`
--
ALTER TABLE `tranquilo_deal`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tranquilo_deal_status`
--
ALTER TABLE `tranquilo_deal_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tranquilo_favourite`
--
ALTER TABLE `tranquilo_favourite`
  MODIFY `fav_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tranquilo_house_type`
--
ALTER TABLE `tranquilo_house_type`
  MODIFY `h_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tranquilo_model`
--
ALTER TABLE `tranquilo_model`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tranquilo_state`
--
ALTER TABLE `tranquilo_state`
  MODIFY `state_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `tranquilo_users`
--
ALTER TABLE `tranquilo_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tranquilo_users_role`
--
ALTER TABLE `tranquilo_users_role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

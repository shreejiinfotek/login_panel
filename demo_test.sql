-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 17, 2017 at 08:44 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `demo_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(150) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `address` varchar(2000) NOT NULL,
  `password` varchar(100) NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `profile_path` varchar(500) NOT NULL,
  `verification_code` varchar(10) NOT NULL,
  `block` tinyint(4) NOT NULL DEFAULT '0',
  `user_type` enum('SA','A') DEFAULT 'SA' COMMENT 'SA: Super Admin,A: Admin',
  `is_approve` int(11) NOT NULL,
  `created_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `phone_number`, `address`, `password`, `ip_address`, `profile_path`, `verification_code`, `block`, `user_type`, `is_approve`, `created_date`) VALUES
(1, 'Super Admin', 'info@kusumfoundation.com', '8000069869', '', 'b+3y1WRSehaRNLBgOx4Q+Yi0/1sjotUKkEyVdSgi6u7mGpyZI3E4yJ0ax/t7yXNwWATlET2GVKYu2HvQRj+2TA==', '', 'uploads/ProfilePicture/122416170506.png', '', 0, 'SA', 0, '0000-00-00'),
(2, 'Administrator', 'rajpatel69869@gmail.com', '8000069869', 'Rajkot', 'sL8uJ4nMHW6mKXa9BOTTNexnf60VFm3V1MUk9NjC4b7ftgWdKXo1ZIOXVFp1DZqRDPmzOETKZkpKioQmuW1M7Q==', '', 'uploads/ProfilePicture/041517024825.png', '', 0, 'A', 1, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE IF NOT EXISTS `banner` (
  `banner_id` int(10) NOT NULL AUTO_INCREMENT,
  `banner_path` varchar(500) NOT NULL,
  `caption` varchar(200) NOT NULL,
  `display_order` int(50) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`banner_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=67 ;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`banner_id`, `banner_path`, `caption`, `display_order`, `is_active`) VALUES
(64, 'uploads/Banner/041817145832.png', 'Be the love you never received', 1, 1),
(65, 'uploads/Banner/041817145951.png', 'Be the love you never received', 2, 1),
(66, 'uploads/Banner/041817145736.png', 'Be the love you never received', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `ip_address` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `user_agent` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE IF NOT EXISTS `content` (
  `content_id` int(10) NOT NULL AUTO_INCREMENT,
  `page_name` varchar(100) NOT NULL,
  `page_title` varchar(100) NOT NULL,
  `inner_images` varchar(500) NOT NULL,
  `page_description` text NOT NULL,
  `meta_title` varchar(100) NOT NULL,
  `meta_keyword` varchar(2000) NOT NULL,
  `meta_description` varchar(4000) NOT NULL,
  `display_order` int(10) NOT NULL,
  `is_page_description` int(1) NOT NULL DEFAULT '0',
  `url_path` varchar(100) NOT NULL,
  `is_banner` int(1) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `is_menu` int(1) NOT NULL,
  `is_not_delete` int(11) NOT NULL,
  PRIMARY KEY (`content_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`content_id`, `page_name`, `page_title`, `inner_images`, `page_description`, `meta_title`, `meta_keyword`, `meta_description`, `display_order`, `is_page_description`, `url_path`, `is_banner`, `is_active`, `is_menu`, `is_not_delete`) VALUES
(9, 'Register', 'Register', '', '', 'Register', 'Register', 'Register', 9, 0, 'register', 0, 1, 0, 0),
(10, 'Login', 'Login', '', '', 'Login', 'Login', 'Login', 10, 0, 'login', 0, 1, 0, 0),
(12, 'My Account', 'My Account', '', '', 'My Account', 'My Account', 'My Account', 12, 0, 'my-account', 0, 1, 0, 0),
(13, 'Change Profile', 'Change Profile', '', '', 'Change Profile', 'Change Profile', 'Change Profile', 13, 0, 'change-profile', 0, 1, 0, 0),
(14, 'Change Password', 'Change Password', '', '', 'Change Password', 'Change Password', 'Change Password', 0, 0, 'change-password', 0, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE IF NOT EXISTS `newsletter` (
  `news_latter_id` int(10) NOT NULL AUTO_INCREMENT,
  `subject` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `created_date` date NOT NULL,
  `last_send_date` date NOT NULL,
  `is_status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`news_latter_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `newsletter`
--

INSERT INTO `newsletter` (`news_latter_id`, `subject`, `description`, `created_date`, `last_send_date`, `is_status`) VALUES
(15, 'test admin', '<p>test admin</p>\r\n', '2016-10-04', '2017-04-13', 0),
(17, 'test sent', '<p>test draft</p>\r\n', '2016-11-19', '2016-11-19', 0);

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_subscription`
--

CREATE TABLE IF NOT EXISTS `newsletter_subscription` (
  `news_letter_subscription_id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `create_date` date NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `ip_address` varchar(50) NOT NULL,
  PRIMARY KEY (`news_letter_subscription_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `newsletter_subscription`
--

INSERT INTO `newsletter_subscription` (`news_letter_subscription_id`, `email`, `name`, `create_date`, `is_active`, `ip_address`) VALUES
(19, 'rajpatel69869@gmail.com', NULL, '2017-03-01', 1, '::1'),
(20, 'jhfhg@gmal.com', NULL, '2017-04-19', 1, '103.47.216.102'),
(21, 'niranjanjee@gmail.com', NULL, '2017-05-26', 1, '47.29.8.208');

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE IF NOT EXISTS `site_settings` (
  `site_settings_id` int(11) NOT NULL AUTO_INCREMENT,
  `site_email` varchar(50) NOT NULL,
  `site_copy_right` varchar(100) NOT NULL,
  `site_project_name` varchar(100) NOT NULL,
  `site_url` varchar(100) NOT NULL,
  `default_page_size` int(10) NOT NULL,
  `meta_title` text NOT NULL,
  `meta_keyword` text NOT NULL,
  `meta_description` text NOT NULL,
  `site_phone_number` varchar(50) NOT NULL,
  `site_office_address` text NOT NULL,
  `admin_mailing_address` varchar(100) NOT NULL,
  PRIMARY KEY (`site_settings_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`site_settings_id`, `site_email`, `site_copy_right`, `site_project_name`, `site_url`, `default_page_size`, `meta_title`, `meta_keyword`, `meta_description`, `site_phone_number`, `site_office_address`, `admin_mailing_address`) VALUES
(1, 'info@test.org', '© 2017 Test. All rights reserved.', 'Login Panel', 'http://localhost/demo-register/', 20, 'Welcome To Login', 'Login', 'Login', '8000069869', '', 'rajpatel69869@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `student_register`
--

CREATE TABLE IF NOT EXISTS `student_register` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_name` varchar(300) NOT NULL,
  `student_fathername` varchar(200) NOT NULL,
  `student_email` varchar(300) DEFAULT NULL,
  `student_mobile` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `student_image` varchar(300) DEFAULT NULL,
  `student_address` varchar(3000) DEFAULT NULL,
  `student_state` varchar(200) DEFAULT NULL,
  `student_district` varchar(200) NOT NULL,
  `student_city` varchar(200) DEFAULT NULL,
  `student_zip` varchar(20) DEFAULT NULL,
  `student_country` varchar(300) NOT NULL,
  `OTP` int(11) DEFAULT NULL COMMENT 'Send OTP at registration time',
  `OTP_verification` tinyint(1) DEFAULT NULL COMMENT 'OTP verify',
  `caste_community` varchar(50) DEFAULT NULL COMMENT 'APL, BPL, SC & ST ',
  `gender` enum('Male','Female','Other') DEFAULT NULL COMMENT 'To find sex retio',
  `DOB` date DEFAULT NULL COMMENT 'Date of Birth',
  `age` int(11) DEFAULT NULL COMMENT 'if DOB no available add Age',
  `register_date` date NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1' COMMENT 'OTP verified user can login, otherwise admin will activate the user',
  `Created_at` datetime DEFAULT NULL COMMENT 'Entery created date and time',
  `Updated_at` timestamp NULL DEFAULT NULL COMMENT 'Record chage date and time, it will auto update',
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `student_register`
--

INSERT INTO `student_register` (`student_id`, `student_name`, `student_fathername`, `student_email`, `student_mobile`, `password`, `student_image`, `student_address`, `student_state`, `student_district`, `student_city`, `student_zip`, `student_country`, `OTP`, `OTP_verification`, `caste_community`, `gender`, `DOB`, `age`, `register_date`, `is_active`, `Created_at`, `Updated_at`) VALUES
(1, 'Rajdip patel', 'Mavaji Bhai', 'rajpatel698691@gmail.com', '8000069869', 'B/0NyfNa63alOqZK67IBaaZoXM87C9XnU3B6BCueQXT6LKrzrm8MrWiS37kvqtnVOJynolHyczDBmId4w/B6GQ==', 'uploads/RegisterUserProfile/041717152605.jpg', 'Test', 'test', 'Rajkot', 'test', 'test', 'India', NULL, NULL, 'SC & ST', 'Male', '1992-04-25', 23, '2017-04-17', 1, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

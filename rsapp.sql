-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2024 at 07:25 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rsapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `bar_categories`
--

CREATE TABLE `bar_categories` (
  `bar_cat_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bar_categories`
--

INSERT INTO `bar_categories` (`bar_cat_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'softdrinks', '2024-03-21 09:18:16', NULL),
(2, 'colddrinks', '2024-03-21 09:18:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bar_items`
--

CREATE TABLE `bar_items` (
  `bar_item_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `is_menu_item` tinyint(1) NOT NULL DEFAULT 0,
  `bar_cat_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bar_items`
--

INSERT INTO `bar_items` (`bar_item_id`, `created_at`, `updated_at`, `name`, `description`, `price`, `image_path`, `is_menu_item`, `bar_cat_id`) VALUES
(1, '2024-03-21 09:39:33', NULL, 'Mojito', 'refreshingg Mojito!', 70.00, 'mojito.png', 0, 1),
(2, '2024-03-21 09:40:33', NULL, 'Soda', 'Refreshing Soda!', 50.00, 'soda.png', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `cab_booking`
--

CREATE TABLE `cab_booking` (
  `id` int(11) NOT NULL,
  `service_order_id` bigint(20) UNSIGNED NOT NULL,
  `trip_type` varchar(50) NOT NULL,
  `pickup_location` varchar(255) NOT NULL,
  `pickup_date` date NOT NULL,
  `pickup_time` time NOT NULL,
  `drop_location` varchar(255) DEFAULT NULL,
  `rental_hours` int(11) DEFAULT NULL,
  `no_of_persons` int(11) DEFAULT NULL,
  `special_request` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `cab_booking_view`
-- (See below for the actual view)
--
CREATE TABLE `cab_booking_view` (
`trip_type` varchar(50)
,`pickup_location` varchar(255)
,`pickup_date` date
,`pickup_time` time
,`drop_location` varchar(255)
,`rental_hours` int(11)
,`no_of_persons` int(11)
,`special_request` text
,`booking_reference_number` varchar(50)
,`service_id` bigint(20) unsigned
,`booking_date_time` datetime
,`guest_id` bigint(20) unsigned
,`total_amount` decimal(20,6)
,`payment_status` int(11)
,`status` int(11)
,`id` bigint(20) unsigned
);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `total_price` decimal(8,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `created_at`, `updated_at`, `name`) VALUES
(1, '2024-03-01 05:46:34', NULL, 'Fastfood'),
(2, '2024-03-01 05:47:13', NULL, 'South_Indian'),
(3, '2024-03-09 09:30:55', NULL, 'pizza');

-- --------------------------------------------------------

--
-- Table structure for table `decorations`
--

CREATE TABLE `decorations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `booking_time_from` time DEFAULT NULL,
  `booking_time_to` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `booking_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `decorations`
--

INSERT INTO `decorations` (`id`, `name`, `image`, `description`, `price`, `booking_time_from`, `booking_time_to`, `created_at`, `updated_at`, `booking_date`) VALUES
(1, 'Candle light dinner', 'candle_light_dinner.jpg', 'Location: Romantic rooftop\r\nDecoration: Soft candle lights, rose petals, and elegant table settings\r\nInclusions: Gourmet three-course meal, personalized service', 100.00, '20:00:00', '21:30:00', '2024-03-13 06:31:51', '2024-03-19 22:47:36', '2024-03-18'),
(2, 'Beach Bonfire Nights', 'Beach_Bonfire_Nights.jpg', 'Host beachfront bonfire nights where guests can gather around a crackling fire, roast marshmallows, and enjoy live music or storytelling under the starlit sky. It\'s a cozy and romantic evening activity that brings people together.', 100.00, '07:00:00', '10:00:00', '2024-03-14 07:32:26', '2024-03-19 02:16:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `decoration_bookings`
--

CREATE TABLE `decoration_bookings` (
  `id` int(100) NOT NULL,
  `decoration_id` int(10) UNSIGNED NOT NULL,
  `decoration_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `booking_time_from` time NOT NULL,
  `booking_time_to` time NOT NULL,
  `booking_date` date NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'pending',
  `action` varchar(50) DEFAULT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `decoration_bookings`
--

INSERT INTO `decoration_bookings` (`id`, `decoration_id`, `decoration_name`, `price`, `booking_time_from`, `booking_time_to`, `booking_date`, `status`, `action`, `description`, `created_at`, `updated_at`) VALUES
(55, 1, 'Candle light dinner', 100.00, '09:15:00', '10:15:00', '2024-03-21', 'pending', NULL, '', '2024-03-21 04:33:41', '2024-03-21 04:33:41'),
(56, 1, 'Candle light dinner', 100.00, '09:00:00', '09:30:00', '2024-03-21', 'pending', NULL, '', '2024-03-21 05:20:31', '2024-03-21 05:20:31'),
(57, 1, 'Candle light dinner', 100.00, '10:00:00', '11:00:00', '2024-03-21', 'pending', NULL, '', '2024-03-21 05:24:09', '2024-03-21 05:24:09');

-- --------------------------------------------------------

--
-- Table structure for table `extended_stay_booking`
--

CREATE TABLE `extended_stay_booking` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_order_id` bigint(20) UNSIGNED NOT NULL,
  `extend_till_date` date NOT NULL,
  `special_request` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `extended_stay_booking_view`
-- (See below for the actual view)
--
CREATE TABLE `extended_stay_booking_view` (
`id` bigint(20) unsigned
,`service_id` bigint(20) unsigned
,`booking_reference_number` varchar(50)
,`booking_date_time` datetime
,`guest_id` bigint(20) unsigned
,`total_amount` decimal(20,6)
,`payment_status` int(11)
,`status` int(11)
,`extend_till_date` date
,`special_request` text
);

-- --------------------------------------------------------

--
-- Table structure for table `extra_bed_order`
--

CREATE TABLE `extra_bed_order` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_order_id` bigint(20) UNSIGNED NOT NULL,
  `rate_id` bigint(20) UNSIGNED NOT NULL,
  `rate` decimal(20,6) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `special_request` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `extra_bed_order_view`
-- (See below for the actual view)
--
CREATE TABLE `extra_bed_order_view` (
`service_id` bigint(20) unsigned
,`booking_reference_number` varchar(50)
,`booking_date_time` datetime
,`id` bigint(20) unsigned
,`guest_id` bigint(20) unsigned
,`total_amount` decimal(20,6)
,`payment_status` int(11)
,`status` int(11)
,`special_request` text
,`qty` int(11)
,`rate` decimal(20,6)
);

-- --------------------------------------------------------

--
-- Table structure for table `extra_bed_rate`
--

CREATE TABLE `extra_bed_rate` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rate` decimal(8,2) NOT NULL,
  `description` text NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `extra_bed_rate`
--

INSERT INTO `extra_bed_rate` (`id`, `rate`, `description`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 600.00, '', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `name`, `image`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Spa_booking', 'Book_spa.webp', NULL, '2024-03-27 07:19:23', NULL),
(2, 'Cab_booking', 'cab_booking.jpg', NULL, '2024-03-27 07:19:32', NULL),
(3, 'Book_guide', 'Book_guide.webp', NULL, '2024-03-28 04:58:18', NULL),
(4, 'custom_decoration', 'Custom_decoration.webp', NULL, '2024-03-28 04:59:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `floor`
--

CREATE TABLE `floor` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `narration` text DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `floor`
--

INSERT INTO `floor` (`id`, `title`, `narration`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Ground Floor', NULL, 0, '2024-03-06 10:30:20', NULL),
(2, '1st Floor', NULL, 0, '2024-03-06 10:30:56', NULL),
(3, 'Front Garden', NULL, 0, '2024-03-06 10:31:07', NULL),
(4, '2nd Floor', NULL, 0, '2024-03-06 10:31:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `guest_booking`
--

CREATE TABLE `guest_booking` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `check_in_datetime` datetime DEFAULT NULL,
  `check_out_datetime` datetime DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guest_booking`
--

INSERT INTO `guest_booking` (`id`, `room_id`, `name`, `mobile`, `email`, `check_in_datetime`, `check_out_datetime`, `user_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'Dhruti', '', 'pateldhruti803@gmail.com', NULL, NULL, 0, NULL, NULL, '2024-02-21 00:38:56'),
(2, 1, 'Udit', '', 'uditsharma9058@gmail.com', NULL, NULL, 0, NULL, NULL, '2024-02-20 22:44:21'),
(3, 1, 'Daxesh', '', 'bhoidaxesh143@gmail.com', NULL, NULL, 0, NULL, NULL, NULL),
(4, 2, 'Dhruti', '', 'dhrutipatel803@gmail.com', NULL, NULL, 0, NULL, NULL, NULL),
(5, 3, 'Dhruti', '', 'dhrutipatel.200410107055@gmail.com', NULL, NULL, 0, NULL, NULL, NULL),
(6, 2, 'Bhumi', '', 'bhumi6dabhi@gmail.com', NULL, NULL, NULL, NULL, '2024-03-26 10:46:41', '2024-03-26 10:46:41');

-- --------------------------------------------------------

--
-- Table structure for table `guest_otps`
--

CREATE TABLE `guest_otps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `otp` varchar(255) NOT NULL,
  `expiration_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guest_otps`
--

INSERT INTO `guest_otps` (`id`, `user_id`, `email`, `otp`, `expiration_time`, `created_at`, `updated_at`) VALUES
(1, 1, 'pateldhruti803@gmail.com', '961604', '2024-02-21 07:40:21', '2024-02-21 00:51:16', '2024-02-21 00:51:16'),
(2, 1, 'pateldhruti803@gmail.com', '269190', '2024-02-21 07:40:21', '2024-02-21 00:52:14', '2024-02-21 00:52:14'),
(3, 1, 'pateldhruti803@gmail.com', '103091', '2024-02-21 07:40:21', '2024-02-21 00:53:39', '2024-02-21 00:53:39'),
(128, 1, 'pateldhruti803@gmail.com', '604597', '2024-03-01 00:14:48', '2024-03-01 00:12:48', '2024-03-01 00:12:48'),
(129, 1, 'pateldhruti803@gmail.com', '710712', '2024-03-01 23:47:39', '2024-03-01 23:45:39', '2024-03-01 23:45:39'),
(130, 1, 'pateldhruti803@gmail.com', '129876', '2024-03-02 00:00:55', '2024-03-01 23:58:55', '2024-03-01 23:58:55'),
(131, 1, 'pateldhruti803@gmail.com', '746747', '2024-03-02 00:02:12', '2024-03-02 00:00:12', '2024-03-02 00:00:12'),
(132, 1, 'pateldhruti803@gmail.com', '148335', '2024-03-02 00:35:59', '2024-03-02 00:33:59', '2024-03-02 00:33:59'),
(133, 1, 'pateldhruti803@gmail.com', '551030', '2024-03-02 00:37:16', '2024-03-02 00:35:16', '2024-03-02 00:35:16'),
(134, 1, 'pateldhruti803@gmail.com', '200937', '2024-03-02 00:38:41', '2024-03-02 00:36:41', '2024-03-02 00:36:41'),
(135, 1, 'pateldhruti803@gmail.com', '452697', '2024-03-02 00:40:01', '2024-03-02 00:38:01', '2024-03-02 00:38:01'),
(136, 1, 'pateldhruti803@gmail.com', '224492', '2024-03-02 01:02:51', '2024-03-02 01:00:51', '2024-03-02 01:00:51'),
(137, 1, 'pateldhruti803@gmail.com', '413986', '2024-03-02 01:04:03', '2024-03-02 01:02:03', '2024-03-02 01:02:03'),
(138, 1, 'pateldhruti803@gmail.com', '319800', '2024-03-02 01:05:33', '2024-03-02 01:03:33', '2024-03-02 01:03:33'),
(139, 1, 'pateldhruti803@gmail.com', '758902', '2024-03-02 01:09:15', '2024-03-02 01:07:15', '2024-03-02 01:07:15'),
(140, 1, 'pateldhruti803@gmail.com', '331748', '2024-03-02 01:10:59', '2024-03-02 01:08:59', '2024-03-02 01:08:59'),
(141, 1, 'pateldhruti803@gmail.com', '742572', '2024-03-02 01:12:11', '2024-03-02 01:10:11', '2024-03-02 01:10:11'),
(142, 1, 'pateldhruti803@gmail.com', '497456', '2024-03-02 01:14:07', '2024-03-02 01:12:07', '2024-03-02 01:12:07'),
(143, 1, 'pateldhruti803@gmail.com', '927266', '2024-03-02 01:15:27', '2024-03-02 01:13:27', '2024-03-02 01:13:27'),
(144, 1, 'pateldhruti803@gmail.com', '581128', '2024-03-02 01:17:58', '2024-03-02 01:15:58', '2024-03-02 01:15:58'),
(145, 1, 'pateldhruti803@gmail.com', '407231', '2024-03-02 01:20:01', '2024-03-02 01:18:01', '2024-03-02 01:18:01'),
(146, 1, 'pateldhruti803@gmail.com', '441356', '2024-03-02 01:20:35', '2024-03-02 01:18:35', '2024-03-02 01:18:35'),
(147, 1, 'pateldhruti803@gmail.com', '818190', '2024-03-03 22:35:39', '2024-03-03 22:33:39', '2024-03-03 22:33:39'),
(148, 1, 'pateldhruti803@gmail.com', '687375', '2024-03-03 23:21:14', '2024-03-03 23:19:14', '2024-03-03 23:19:14'),
(149, 1, 'pateldhruti803@gmail.com', '487718', '2024-03-04 01:36:12', '2024-03-04 01:34:12', '2024-03-04 01:34:12'),
(150, 1, 'pateldhruti803@gmail.com', '165072', '2024-03-04 01:54:42', '2024-03-04 01:52:42', '2024-03-04 01:52:42'),
(151, 1, 'pateldhruti803@gmail.com', '377484', '2024-03-04 01:55:54', '2024-03-04 01:53:54', '2024-03-04 01:53:54'),
(152, 1, 'pateldhruti803@gmail.com', '386992', '2024-03-04 02:01:38', '2024-03-04 01:59:38', '2024-03-04 01:59:38'),
(153, 1, 'pateldhruti803@gmail.com', '481008', '2024-03-04 03:08:29', '2024-03-04 03:06:29', '2024-03-04 03:06:29'),
(154, 1, 'pateldhruti803@gmail.com', '576278', '2024-03-04 04:40:34', '2024-03-04 04:38:34', '2024-03-04 04:38:34'),
(155, 1, 'pateldhruti803@gmail.com', '919476', '2024-03-04 06:54:30', '2024-03-04 06:52:30', '2024-03-04 06:52:30'),
(156, 1, 'pateldhruti803@gmail.com', '419134', '2024-03-04 11:16:10', '2024-03-04 11:14:10', '2024-03-04 11:14:10'),
(157, 4, 'dhrutipatel803@gmail.com', '165529', '2024-03-04 22:32:04', '2024-03-04 22:30:04', '2024-03-04 22:30:04'),
(158, 4, 'dhrutipatel803@gmail.com', '292375', '2024-03-04 22:34:26', '2024-03-04 22:32:26', '2024-03-04 22:32:26'),
(159, 1, 'pateldhruti803@gmail.com', '976760', '2024-03-04 22:36:04', '2024-03-04 22:34:04', '2024-03-04 22:34:04'),
(160, 4, 'dhrutipatel803@gmail.com', '894634', '2024-03-04 22:39:28', '2024-03-04 22:37:28', '2024-03-04 22:37:28'),
(161, 4, 'dhrutipatel803@gmail.com', '488541', '2024-03-05 00:55:09', '2024-03-05 00:53:09', '2024-03-05 00:53:09'),
(162, 4, 'dhrutipatel803@gmail.com', '357797', '2024-03-06 04:00:45', '2024-03-06 03:58:45', '2024-03-06 03:58:45'),
(163, 4, 'dhrutipatel803@gmail.com', '222957', '2024-03-07 03:56:12', '2024-03-07 03:54:12', '2024-03-07 03:54:12'),
(164, 4, 'dhrutipatel803@gmail.com', '446502', '2024-03-07 10:08:34', '2024-03-07 10:06:34', '2024-03-07 10:06:34'),
(165, 1, 'pateldhruti803@gmail.com', '691245', '2024-03-09 04:12:15', '2024-03-09 04:10:15', '2024-03-09 04:10:15'),
(166, 4, 'dhrutipatel803@gmail.com', '697044', '2024-03-09 04:15:03', '2024-03-09 04:13:03', '2024-03-09 04:13:03'),
(167, 4, 'dhrutipatel803@gmail.com', '297791', '2024-03-10 06:40:50', '2024-03-10 06:38:50', '2024-03-10 06:38:50'),
(168, 4, 'dhrutipatel803@gmail.com', '747710', '2024-03-11 04:10:58', '2024-03-11 04:08:58', '2024-03-11 04:08:58'),
(169, 4, 'dhrutipatel803@gmail.com', '713869', '2024-03-11 08:04:22', '2024-03-11 08:02:22', '2024-03-11 08:02:22'),
(170, 4, 'dhrutipatel803@gmail.com', '399781', '2024-03-11 11:27:17', '2024-03-11 11:25:17', '2024-03-11 11:25:17'),
(171, 4, 'dhrutipatel803@gmail.com', '217739', '2024-03-12 04:27:12', '2024-03-12 04:25:12', '2024-03-12 04:25:12'),
(172, 1, 'pateldhruti803@gmail.com', '553672', '2024-03-13 04:09:50', '2024-03-13 04:07:50', '2024-03-13 04:07:50'),
(173, 1, 'pateldhruti803@gmail.com', '555267', '2024-03-13 07:29:36', '2024-03-13 07:27:36', '2024-03-13 07:27:36'),
(174, 1, 'pateldhruti803@gmail.com', '145564', '2024-03-13 09:12:26', '2024-03-13 09:10:26', '2024-03-13 09:10:26'),
(175, 1, 'pateldhruti803@gmail.com', '680314', '2024-03-13 09:26:32', '2024-03-13 09:24:32', '2024-03-13 09:24:32'),
(176, 1, 'pateldhruti803@gmail.com', '809351', '2024-03-14 04:09:01', '2024-03-14 04:07:01', '2024-03-14 04:07:01'),
(177, 1, 'pateldhruti803@gmail.com', '726025', '2024-03-14 07:07:35', '2024-03-14 07:05:35', '2024-03-14 07:05:35'),
(178, 1, 'pateldhruti803@gmail.com', '662054', '2024-03-15 04:10:38', '2024-03-15 04:08:38', '2024-03-15 04:08:38'),
(179, 1, 'pateldhruti803@gmail.com', '522029', '2024-03-16 04:09:33', '2024-03-16 04:07:33', '2024-03-16 04:07:33'),
(180, 1, 'pateldhruti803@gmail.com', '127184', '2024-03-16 05:57:32', '2024-03-16 05:55:32', '2024-03-16 05:55:32'),
(181, 1, 'pateldhruti803@gmail.com', '222223', '2024-03-16 06:29:20', '2024-03-16 06:27:20', '2024-03-16 06:27:20'),
(182, 4, 'dhrutipatel803@gmail.com', '206760', '2024-03-16 06:30:28', '2024-03-16 06:28:28', '2024-03-16 06:28:28'),
(183, 4, 'dhrutipatel803@gmail.com', '986423', '2024-03-16 06:32:58', '2024-03-16 06:30:58', '2024-03-16 06:30:58'),
(184, 5, 'dhrutipatel.200410107055@gmail.com', '528423', '2024-03-16 10:50:50', '2024-03-16 10:48:50', '2024-03-16 10:48:50'),
(185, 5, 'dhrutipatel.200410107055@gmail.com', '370281', '2024-03-16 10:55:20', '2024-03-16 10:53:20', '2024-03-16 10:53:20'),
(186, 1, 'pateldhruti803@gmail.com', '422246', '2024-03-18 04:03:28', '2024-03-18 04:01:28', '2024-03-18 04:01:28'),
(187, 1, 'pateldhruti803@gmail.com', '741547', '2024-03-18 05:37:46', '2024-03-18 05:35:46', '2024-03-18 05:35:46'),
(188, 1, 'pateldhruti803@gmail.com', '643178', '2024-03-18 09:41:39', '2024-03-18 09:39:39', '2024-03-18 09:39:39'),
(189, 1, 'pateldhruti803@gmail.com', '808320', '2024-03-19 05:14:03', '2024-03-19 05:12:03', '2024-03-19 05:12:03'),
(190, 1, 'pateldhruti803@gmail.com', '925422', '2024-03-19 07:12:45', '2024-03-19 07:10:45', '2024-03-19 07:10:45'),
(191, 1, 'pateldhruti803@gmail.com', '920321', '2024-03-19 10:45:51', '2024-03-19 10:43:51', '2024-03-19 10:43:51'),
(192, 1, 'pateldhruti803@gmail.com', '968266', '2024-03-20 04:07:13', '2024-03-20 04:05:13', '2024-03-20 04:05:13'),
(193, 1, 'pateldhruti803@gmail.com', '456893', '2024-03-21 04:17:30', '2024-03-21 04:15:30', '2024-03-21 04:15:30'),
(194, 1, 'pateldhruti803@gmail.com', '840197', '2024-03-21 09:19:54', '2024-03-21 09:17:54', '2024-03-21 09:17:54'),
(195, 1, 'pateldhruti803@gmail.com', '116876', '2024-03-22 06:10:42', '2024-03-22 06:08:42', '2024-03-22 06:08:42'),
(196, 1, 'pateldhruti803@gmail.com', '493762', '2024-03-25 12:13:35', '2024-03-25 12:11:35', '2024-03-25 12:11:35'),
(197, 5, 'dhrutipatel.200410107055@gmail.com', '888571', '2024-03-26 04:11:17', '2024-03-26 04:09:17', '2024-03-26 04:09:17'),
(198, 1, 'pateldhruti803@gmail.com', '187945', '2024-03-26 04:24:47', '2024-03-26 04:22:47', '2024-03-26 04:22:47'),
(199, 6, 'bhumi6dabhi@gmail.com', '385349', '2024-03-26 10:49:32', '2024-03-26 10:47:32', '2024-03-26 10:47:32'),
(200, 1, 'pateldhruti803@gmail.com', '256437', '2024-03-27 08:54:48', '2024-03-27 08:52:48', '2024-03-27 08:52:48'),
(201, 1, 'pateldhruti803@gmail.com', '724970', '2024-03-27 15:16:27', '2024-03-27 15:14:27', '2024-03-27 15:14:27'),
(202, 1, 'pateldhruti803@gmail.com', '165243', '2024-03-27 16:42:30', '2024-03-27 16:40:30', '2024-03-27 16:40:30'),
(203, 1, 'pateldhruti803@gmail.com', '971108', '2024-03-28 04:09:38', '2024-03-28 04:07:38', '2024-03-28 04:07:38'),
(204, 1, 'pateldhruti803@gmail.com', '276359', '2024-03-28 04:52:08', '2024-03-28 04:50:08', '2024-03-28 04:50:08'),
(205, 1, 'pateldhruti803@gmail.com', '214337', '2024-03-28 04:53:50', '2024-03-28 04:51:50', '2024-03-28 04:51:50'),
(206, 1, 'pateldhruti803@gmail.com', '274513', '2024-03-28 05:08:29', '2024-03-28 05:06:29', '2024-03-28 05:06:29'),
(207, 1, 'pateldhruti803@gmail.com', '186043', '2024-03-28 05:40:15', '2024-03-28 05:38:15', '2024-03-28 05:38:15'),
(208, 1, 'pateldhruti803@gmail.com', '544025', '2024-03-28 05:41:26', '2024-03-28 05:39:26', '2024-03-28 05:39:26'),
(209, 1, 'pateldhruti803@gmail.com', '767843', '2024-03-28 05:48:24', '2024-03-28 05:46:24', '2024-03-28 05:46:24'),
(210, 1, 'pateldhruti803@gmail.com', '466913', '2024-03-28 06:05:04', '2024-03-28 06:03:04', '2024-03-28 06:03:04'),
(211, 6, 'bhumi6dabhi@gmail.com', '950578', '2024-03-28 06:59:05', '2024-03-28 06:57:05', '2024-03-28 06:57:05'),
(212, 6, 'bhumi6dabhi@gmail.com', '577245', '2024-03-29 06:15:38', '2024-03-29 06:13:38', '2024-03-29 06:13:38');

-- --------------------------------------------------------

--
-- Table structure for table `guides`
--

CREATE TABLE `guides` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `experience` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `guide_id` varchar(30) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guides`
--

INSERT INTO `guides` (`id`, `name`, `age`, `experience`, `created_at`, `updated_at`, `image`, `guide_id`, `price`, `description`) VALUES
(1, 'raj', 30, '5 years', '2024-03-14 09:48:59', '2024-03-14 09:48:59', 'raj.jpg', 'GD0001', 500.00, 'Meet Raj, your friendly and knowledgeable guide to explore the vibrant wonders of Goa. With over a decade of experience in guiding tourists, Raj is your go-to expert for an unforgettable journey through this coastal paradise. His deep understanding of Goa\'s rich history, culture, and traditions will enrich your experience as you traverse its sun-kissed beaches, ancient forts, and lush spice plantations. Raj\'s passion for adventure and exploration ensures that every moment of your trip is filled with excitement and discovery. From bustling markets to tranquil backwaters, Raj will unveil the hidden gems of Goa, leaving you captivated by its beauty and charm.'),
(2, 'maya', 28, '3 years', '2024-03-14 09:52:38', '2024-03-14 09:52:38', 'maya.jpg', 'GD0002', 800.00, 'Introducing Maya, your enthusiastic and compassionate guide ready to lead you on an enchanting exploration of Goa\'s treasures. With her warm smile and gentle demeanor, Maya creates a welcoming atmosphere for travelers of all ages. Her extensive knowledge of Goa\'s diverse landscapes, from its pristine beaches to its vibrant wildlife sanctuaries, makes her the perfect companion for an immersive journey. Whether you seek thrilling water sports or serene sunset cruises, Maya\'s attention to detail ensures that every aspect of your trip is tailored to your preferences. Let Maya be your guide to Goa\'s hidden coves, bustling markets, and ancient temples, where every moment is infused with wonder and adventure.\r\n\r\n\r\n\r\n\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `guides_booking`
--

CREATE TABLE `guides_booking` (
  `id` int(10) UNSIGNED NOT NULL,
  `guide_id` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `age` int(10) UNSIGNED NOT NULL,
  `experience` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `image` varchar(255) DEFAULT NULL,
  `price` int(100) UNSIGNED NOT NULL,
  `description` text NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guides_booking`
--

INSERT INTO `guides_booking` (`id`, `guide_id`, `name`, `age`, `experience`, `created_at`, `updated_at`, `image`, `price`, `description`, `status`, `date`, `time`) VALUES
(80, 'GD0001', 'raj', 30, '5 years', '2024-03-20 23:18:44', '2024-03-20 23:19:57', 'raj.jpg', 500, 'Meet Raj, your friendly and knowledgeable guide to explore the vibrant wonders of Goa. With over a decade of experience in guiding tourists, Raj is your go-to expert for an unforgettable journey through this coastal paradise. His deep understanding of Goa\'s rich history, culture, and traditions will enrich your experience as you traverse its sun-kissed beaches, ancient forts, and lush spice plantations. Raj\'s passion for adventure and exploration ensures that every moment of your trip is filled with excitement and discovery. From bustling markets to tranquil backwaters, Raj will unveil the hidden gems of Goa, leaving you captivated by its beauty and charm.', 'Cancelled', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hotel_table`
--

CREATE TABLE `hotel_table` (
  `hotel_id` int(11) NOT NULL,
  `hotel_name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `is_menu_item` tinyint(1) NOT NULL DEFAULT 0,
  `category_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `created_at`, `updated_at`, `name`, `description`, `price`, `image_path`, `is_menu_item`, `category_id`) VALUES
(1, '2024-03-01 05:47:39', NULL, 'Burger', 'Yummy Burger!!', 70.00, 'burger.jpeg', 1, 1),
(2, '2024-03-01 05:50:32', NULL, 'Masala_Dosa', 'Yummy Dosa!!', 100.00, 'Dosa.png', 1, 2),
(6, '2024-03-09 09:31:16', NULL, 'Farmhouse', 'Cheesy Pizza!', 100.00, 'farmhouse.png', 0, 3),
(7, '2024-03-09 09:33:52', NULL, 'Maharaja', 'King of Burger!!', 100.00, 'Maharaja.png', 0, 1),
(8, '2024-03-14 06:38:06', NULL, 'Idli', 'Yummy Idlis!', 60.00, 'idli.png', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `laundry_order`
--

CREATE TABLE `laundry_order` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `laundry_type_id` bigint(20) UNSIGNED NOT NULL,
  `service_order_id` bigint(20) UNSIGNED NOT NULL,
  `special_request` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `laundry_order_view`
-- (See below for the actual view)
--
CREATE TABLE `laundry_order_view` (
`laundry_type_id` bigint(20) unsigned
,`laundry_service_type` varchar(255)
,`id` bigint(20) unsigned
,`service_id` bigint(20) unsigned
,`booking_date_time` datetime
,`booking_reference_number` varchar(50)
,`guest_id` bigint(20) unsigned
,`total_amount` decimal(20,6)
,`status` int(11)
,`special_request` text
,`payment_status` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `laundry_type`
--

CREATE TABLE `laundry_type` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laundry_type`
--

INSERT INTO `laundry_type` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Wash', '2024-03-19 04:35:25', '2024-03-19 04:35:25'),
(2, 'Iron', '2024-03-19 04:35:33', '2024-03-19 04:35:33'),
(3, 'Dry Cleaning', '2024-03-19 04:36:16', '2024-03-19 04:36:16'),
(4, 'Wash & Iron', '2024-03-19 04:36:30', '2024-03-19 04:36:30');

-- --------------------------------------------------------

--
-- Table structure for table `linen`
--

CREATE TABLE `linen` (
  `linen_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `image_path` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `user_id` int(100) NOT NULL DEFAULT 4,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `linen`
--

INSERT INTO `linen` (`linen_id`, `name`, `quantity`, `image_path`, `price`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Blankets', 0, 'blanklets.png', NULL, 4, '2024-03-16 07:35:27', NULL),
(2, 'Pillow', 0, 'pillow.png', NULL, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `linen_cart`
--

CREATE TABLE `linen_cart` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `linen_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `linen_past`
--

CREATE TABLE `linen_past` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `order_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `linen_past`
--

INSERT INTO `linen_past` (`id`, `name`, `image_path`, `quantity`, `price`, `created_at`, `updated_at`, `order_id`) VALUES
(1, 'Blankets', 'blanklets.png', 2, NULL, '2024-03-18 01:50:09', '2024-03-18 01:50:09', 'LO01'),
(2, 'Pillow', 'pillow.png', 2, NULL, '2024-03-18 01:50:09', '2024-03-18 01:50:09', 'LO01'),
(3, 'Blankets', 'blanklets.png', 1, NULL, '2024-03-18 02:00:19', '2024-03-18 02:00:19', 'LO02'),
(4, 'Pillow', 'pillow.png', 2, NULL, '2024-03-26 00:13:03', '2024-03-26 00:13:03', 'LO03'),
(5, 'Blankets', 'blanklets.png', 2, NULL, '2024-03-28 05:24:32', '2024-03-28 05:24:32', 'LO04'),
(6, 'Blankets', 'blanklets.png', 1, NULL, '2024-03-28 06:45:30', '2024-03-28 06:45:30', 'LO05'),
(7, 'Blankets', 'blanklets.png', 1, NULL, '2024-03-28 08:39:59', '2024-03-28 08:39:59', 'LO06');

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `narration` text DEFAULT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `title`, `narration`, `created_on`, `user_id`) VALUES
(1, 'Waiting For Approval', NULL, '2024-03-04 17:07:45', 0),
(2, 'In Process', NULL, '2024-03-04 17:08:00', 0),
(3, 'Cancelled', NULL, '2024-03-04 17:08:09', 0),
(4, 'Confirmed', NULL, '2024-03-04 23:10:38', 0),
(5, 'Completed', NULL, '2024-03-16 14:41:40', 0),
(6, 'Awaiting acknowledgement', NULL, '2024-03-06 17:17:11', 0);

-- --------------------------------------------------------

--
-- Table structure for table `past_orders`
--

CREATE TABLE `past_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `order_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `past_orders`
--

INSERT INTO `past_orders` (`id`, `name`, `description`, `price`, `image_path`, `quantity`, `created_at`, `updated_at`, `order_id`) VALUES
(29, 'Farmhouse', 'Cheesy Pizza!', 100.00, 'farmhouse.png', 1, '2024-03-28 08:20:32', '2024-03-28 08:20:32', 'OF01');

-- --------------------------------------------------------

--
-- Table structure for table `past_toi`
--

CREATE TABLE `past_toi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `past_toi`
--

INSERT INTO `past_toi` (`id`, `order_id`, `name`, `image_path`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 'TO01', 'Comb', 'comb.png', 5, '2024-03-16 00:46:32', '2024-03-16 00:46:32'),
(2, 'TO01', 'Brush', 'brush.png', 4, '2024-03-16 00:46:33', '2024-03-16 00:46:33'),
(3, 'TO01', 'Shampoo', 'shampoo.png', 3, '2024-03-16 00:46:33', '2024-03-16 00:46:33'),
(4, 'TO02', 'Brush', 'brush.png', 2, '2024-03-16 00:54:13', '2024-03-16 00:54:13'),
(5, 'TO03', 'Brush', 'brush.png', 3, '2024-03-16 01:21:04', '2024-03-16 01:21:04'),
(6, 'TO04', 'Shampoo', 'shampoo.png', 3, '2024-03-16 01:21:57', '2024-03-16 01:21:57'),
(7, 'TO05', 'Brush', 'brush.png', 3, '2024-03-16 03:32:41', '2024-03-16 03:32:41'),
(8, 'TO05', 'Shampoo', 'shampoo.png', 6, '2024-03-16 03:32:41', '2024-03-16 03:32:41');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `room_number` varchar(50) NOT NULL,
  `floor_id` bigint(20) UNSIGNED NOT NULL,
  `room_type_id` bigint(20) NOT NULL,
  `rate` decimal(20,6) DEFAULT NULL,
  `room_image` varchar(50) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id`, `room_number`, `floor_id`, `room_type_id`, `rate`, `room_image`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '101', 2, 1, 1500.000000, NULL, NULL, '2024-03-06 11:06:52', NULL),
(2, '203', 4, 6, 3000.000000, NULL, NULL, '2024-03-06 11:33:05', NULL),
(3, '301', 3, 4, 5000.000000, NULL, NULL, '2024-03-06 11:34:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `room_cleaning_order`
--

CREATE TABLE `room_cleaning_order` (
  `id` bigint(20) NOT NULL,
  `service_order_id` bigint(20) UNSIGNED NOT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `special_request` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_cleaning_order`
--

INSERT INTO `room_cleaning_order` (`id`, `service_order_id`, `date`, `time`, `special_request`, `created_at`, `updated_at`) VALUES
(55, 284, '2024-04-05', '09:30:00', NULL, '2024-03-28 06:39:20', '2024-03-28 06:39:20');

-- --------------------------------------------------------

--
-- Stand-in structure for view `room_cleaning_order_view`
-- (See below for the actual view)
--
CREATE TABLE `room_cleaning_order_view` (
`date` date
,`time` time
,`special_request` text
,`booking_reference_number` varchar(50)
,`service_id` bigint(20) unsigned
,`booking_date_time` datetime
,`guest_id` bigint(20) unsigned
,`total_amount` decimal(20,6)
,`payment_status` int(11)
,`status` int(11)
,`id` bigint(20) unsigned
);

-- --------------------------------------------------------

--
-- Table structure for table `room_type`
--

CREATE TABLE `room_type` (
  `id` bigint(20) NOT NULL,
  `title` varchar(50) NOT NULL,
  `narration` text DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_type`
--

INSERT INTO `room_type` (`id`, `title`, `narration`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Royal', NULL, 0, '2024-03-06 10:25:44', NULL),
(2, 'Vintage', NULL, 0, '2024-03-06 10:32:15', NULL),
(3, 'Queen\'s Villa', NULL, 0, '2024-03-06 10:32:28', NULL),
(4, 'King\'s Villa', NULL, 0, '2024-03-06 10:32:39', NULL),
(5, 'Royal Sea view', NULL, 0, '2024-03-06 10:32:53', NULL),
(6, 'Deluxe', NULL, 0, '2024-03-06 10:33:05', NULL),
(7, 'Suite', NULL, 0, '2024-03-06 10:33:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `narration` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `title`, `image`, `user_id`, `description`, `narration`, `created_at`, `updated_at`) VALUES
(1, 'Room Cleaning', 'room_cleaning.jpeg', NULL, NULL, NULL, '2024-03-06 06:36:23', '2024-03-28 06:30:14'),
(2, 'Extra Bed', 'extra_bed.jpeg', NULL, NULL, NULL, '2024-03-14 07:41:27', '2024-03-28 06:30:16'),
(3, 'Extend Stay', 'extend_stay.jpeg', NULL, NULL, NULL, '2024-03-15 10:23:32', '2024-03-29 06:14:34'),
(4, 'Laundry', 'laundry.jpeg', NULL, NULL, NULL, '2024-03-19 05:39:08', '2024-03-28 06:30:19'),
(5, 'Linen Order', 'linen.jpeg', NULL, NULL, NULL, '2024-03-28 06:14:20', '2024-03-28 06:30:20'),
(6, 'Toiletries Order', 'toletries.jpeg', NULL, NULL, NULL, '2024-03-28 06:15:36', '2024-03-29 06:14:48');

-- --------------------------------------------------------

--
-- Table structure for table `service_order`
--

CREATE TABLE `service_order` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED DEFAULT NULL,
  `facility_id` bigint(20) UNSIGNED DEFAULT NULL,
  `booking_reference_number` varchar(50) DEFAULT NULL,
  `booking_date_time` datetime DEFAULT NULL,
  `guest_id` bigint(20) UNSIGNED DEFAULT NULL,
  `total_amount` decimal(20,6) DEFAULT NULL,
  `payment_status` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_order`
--

INSERT INTO `service_order` (`id`, `service_id`, `facility_id`, `booking_reference_number`, `booking_date_time`, `guest_id`, `total_amount`, `payment_status`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
(284, 1, NULL, 'N000284', '2024-03-28 12:09:20', 6, NULL, NULL, 6, NULL, '2024-03-28 06:39:20', '2024-03-28 06:39:20'),
(285, NULL, 1, 'S000285', '2024-03-28 12:21:45', 6, 14000.000000, NULL, 1, NULL, '2024-03-28 06:51:45', '2024-03-28 06:51:45');

-- --------------------------------------------------------

--
-- Table structure for table `spa_booking`
--

CREATE TABLE `spa_booking` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_order_id` bigint(20) UNSIGNED NOT NULL,
  `spa_service_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `spa_package_id` bigint(20) UNSIGNED DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `amount` decimal(20,6) DEFAULT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `no_of_persons` int(11) DEFAULT NULL,
  `special_request` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `spa_booking`
--

INSERT INTO `spa_booking` (`id`, `service_order_id`, `spa_service_type_id`, `spa_package_id`, `duration`, `amount`, `date`, `time`, `no_of_persons`, `special_request`, `created_at`, `updated_at`) VALUES
(125, 285, NULL, 2, '195', 14000.000000, '2024-03-30', '11:00:00', 7, NULL, '2024-03-28 06:51:45', '2024-03-28 06:51:45');

-- --------------------------------------------------------

--
-- Stand-in structure for view `spa_booking_view`
-- (See below for the actual view)
--
CREATE TABLE `spa_booking_view` (
`item_name` varchar(255)
,`date` date
,`time` time
,`amount` decimal(20,6)
,`special_request` text
,`number_of_persons` int(11)
,`duration` varchar(255)
,`status` int(11)
,`booking_reference_number` varchar(50)
,`guest_id` bigint(20) unsigned
,`service_id` bigint(20) unsigned
,`payment_status` int(11)
,`total_amount` decimal(20,6)
,`id` bigint(20) unsigned
);

-- --------------------------------------------------------

--
-- Table structure for table `spa_package`
--

CREATE TABLE `spa_package` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL DEFAULT 0,
  `user_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `spa_package`
--

INSERT INTO `spa_package` (`id`, `title`, `image`, `description`, `price`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Massage Therapy', 'package1.jpeg', '', 5000, NULL, NULL, '2024-03-09 04:30:59'),
(2, 'Nail Service', 'package1.jpeg', '', 2000, NULL, NULL, '2024-03-09 09:40:23'),
(3, 'Hair Service', 'package1.jpeg', '', 6000, NULL, NULL, '2024-03-09 09:40:32');

-- --------------------------------------------------------

--
-- Table structure for table `spa_package_items`
--

CREATE TABLE `spa_package_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `spa_package_id` bigint(20) UNSIGNED NOT NULL,
  `spa_service_type_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `spa_package_items`
--

INSERT INTO `spa_package_items` (`id`, `spa_package_id`, `spa_service_type_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 8, NULL, NULL, NULL),
(2, 1, 9, NULL, NULL, NULL),
(3, 3, 5, NULL, NULL, NULL),
(4, 3, 6, NULL, NULL, NULL),
(5, 2, 1, NULL, NULL, NULL),
(6, 2, 3, NULL, NULL, NULL),
(7, 2, 4, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `spa_service_type`
--

CREATE TABLE `spa_service_type` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `duration` varchar(50) DEFAULT NULL,
  `price` int(11) NOT NULL DEFAULT 0,
  `user_id` bigint(20) DEFAULT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `spa_service_type`
--

INSERT INTO `spa_service_type` (`id`, `title`, `image`, `duration`, `price`, `user_id`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Manicure', 'manicure.jpeg', '30', 200, NULL, '', '2024-03-07 08:47:08', '2024-03-07 12:27:03'),
(2, 'Pedicure', 'manicure.jpeg', '30', 200, NULL, '', '2024-03-07 08:47:33', '2024-03-09 09:40:49'),
(3, 'Nail Extensions', 'manicure.jpeg', '120', 500, NULL, '', '2024-03-07 08:48:31', '2024-03-09 09:40:54'),
(4, 'Nail Art and Design', 'manicure.jpeg', '45', 300, NULL, '', '2024-03-07 08:48:40', '2024-03-09 09:41:00'),
(5, 'Hair Cuts', 'manicure.jpeg', '30', 600, NULL, '', '2024-03-07 08:49:45', '2024-03-09 09:41:06'),
(6, 'Hair Coloring', 'manicure.jpeg', '40', 2000, NULL, '', '2024-03-07 08:50:22', '2024-03-09 09:41:11'),
(7, 'Hair Extensions', 'manicure.jpeg', '50', 5000, NULL, '', '2024-03-07 08:51:19', '2024-03-09 09:41:20'),
(8, 'Swedish Massage', 'manicure.jpeg', '40', 1200, NULL, '', '2024-03-07 08:51:56', '2024-03-09 09:41:28'),
(9, 'Deep Tissue Massage', 'manicure.jpeg', '180', 1500, NULL, '', '2024-03-07 08:52:17', '2024-03-09 09:41:34');

-- --------------------------------------------------------

--
-- Stand-in structure for view `spa_service_view`
-- (See below for the actual view)
--
CREATE TABLE `spa_service_view` (
`package_id` bigint(20) unsigned
,`package_name` varchar(255)
,`included_services` mediumtext
,`package_price` int(11)
,`image` varchar(50)
,`total_duration` double
);

-- --------------------------------------------------------

--
-- Table structure for table `toiletries`
--

CREATE TABLE `toiletries` (
  `toiletries_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `toiletries`
--

INSERT INTO `toiletries` (`toiletries_id`, `name`, `quantity`, `image_path`, `created_at`, `updated_at`) VALUES
(1, 'Brush', 0, 'brush.png', '2024-03-03 04:14:06', NULL),
(2, 'Shampoo', 0, 'shampoo.png', '2024-03-04 04:16:04', NULL),
(3, 'Comb', 0, 'comb.png', '2024-03-02 04:16:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `toiletries_cart`
--

CREATE TABLE `toiletries_cart` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 4,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `toiletries_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `toiletries_cart`
--

INSERT INTO `toiletries_cart` (`id`, `user_id`, `quantity`, `image_path`, `created_at`, `updated_at`, `toiletries_id`, `name`) VALUES
(4, 4, 1, 'brush.png', '2024-03-28 08:28:40', '2024-03-28 08:28:40', 1, 'Brush');

-- --------------------------------------------------------

--
-- Structure for view `cab_booking_view`
--
DROP TABLE IF EXISTS `cab_booking_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `cab_booking_view`  AS SELECT `cab_booking`.`trip_type` AS `trip_type`, `cab_booking`.`pickup_location` AS `pickup_location`, `cab_booking`.`pickup_date` AS `pickup_date`, `cab_booking`.`pickup_time` AS `pickup_time`, `cab_booking`.`drop_location` AS `drop_location`, `cab_booking`.`rental_hours` AS `rental_hours`, `cab_booking`.`no_of_persons` AS `no_of_persons`, `cab_booking`.`special_request` AS `special_request`, `service_order`.`booking_reference_number` AS `booking_reference_number`, `service_order`.`service_id` AS `service_id`, `service_order`.`booking_date_time` AS `booking_date_time`, `service_order`.`guest_id` AS `guest_id`, `service_order`.`total_amount` AS `total_amount`, `service_order`.`payment_status` AS `payment_status`, `service_order`.`status` AS `status`, `service_order`.`id` AS `id` FROM (`cab_booking` join `service_order` on(`cab_booking`.`service_order_id` = `service_order`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `extended_stay_booking_view`
--
DROP TABLE IF EXISTS `extended_stay_booking_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `extended_stay_booking_view`  AS SELECT `service_order`.`id` AS `id`, `service_order`.`service_id` AS `service_id`, `service_order`.`booking_reference_number` AS `booking_reference_number`, `service_order`.`booking_date_time` AS `booking_date_time`, `service_order`.`guest_id` AS `guest_id`, `service_order`.`total_amount` AS `total_amount`, `service_order`.`payment_status` AS `payment_status`, `service_order`.`status` AS `status`, `extended_stay_booking`.`extend_till_date` AS `extend_till_date`, `extended_stay_booking`.`special_request` AS `special_request` FROM (`extended_stay_booking` join `service_order` on(`extended_stay_booking`.`service_order_id` = `service_order`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `extra_bed_order_view`
--
DROP TABLE IF EXISTS `extra_bed_order_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `extra_bed_order_view`  AS SELECT `service_order`.`service_id` AS `service_id`, `service_order`.`booking_reference_number` AS `booking_reference_number`, `service_order`.`booking_date_time` AS `booking_date_time`, `service_order`.`id` AS `id`, `service_order`.`guest_id` AS `guest_id`, `service_order`.`total_amount` AS `total_amount`, `service_order`.`payment_status` AS `payment_status`, `service_order`.`status` AS `status`, `extra_bed_order`.`special_request` AS `special_request`, `extra_bed_order`.`quantity` AS `qty`, `extra_bed_order`.`rate` AS `rate` FROM (`extra_bed_order` join `service_order` on(`extra_bed_order`.`service_order_id` = `service_order`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `laundry_order_view`
--
DROP TABLE IF EXISTS `laundry_order_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `laundry_order_view`  AS SELECT `laundry_order`.`laundry_type_id` AS `laundry_type_id`, `laundry_type`.`title` AS `laundry_service_type`, `service_order`.`id` AS `id`, `service_order`.`service_id` AS `service_id`, `service_order`.`booking_date_time` AS `booking_date_time`, `service_order`.`booking_reference_number` AS `booking_reference_number`, `service_order`.`guest_id` AS `guest_id`, `service_order`.`total_amount` AS `total_amount`, `service_order`.`status` AS `status`, `laundry_order`.`special_request` AS `special_request`, `service_order`.`payment_status` AS `payment_status` FROM ((`laundry_order` join `service_order` on(`laundry_order`.`service_order_id` = `service_order`.`id`)) join `laundry_type` on(`laundry_order`.`laundry_type_id` = `laundry_type`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `room_cleaning_order_view`
--
DROP TABLE IF EXISTS `room_cleaning_order_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `room_cleaning_order_view`  AS SELECT `room_cleaning_order`.`date` AS `date`, `room_cleaning_order`.`time` AS `time`, `room_cleaning_order`.`special_request` AS `special_request`, `service_order`.`booking_reference_number` AS `booking_reference_number`, `service_order`.`service_id` AS `service_id`, `service_order`.`booking_date_time` AS `booking_date_time`, `service_order`.`guest_id` AS `guest_id`, `service_order`.`total_amount` AS `total_amount`, `service_order`.`payment_status` AS `payment_status`, `service_order`.`status` AS `status`, `service_order`.`id` AS `id` FROM (`room_cleaning_order` join `service_order` on(`room_cleaning_order`.`service_order_id` = `service_order`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `spa_booking_view`
--
DROP TABLE IF EXISTS `spa_booking_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `spa_booking_view`  AS SELECT CASE WHEN `spa_booking`.`spa_service_type_id` is not null THEN `spa_service_type`.`title` WHEN `spa_booking`.`spa_package_id` is not null THEN `spa_package`.`title` END AS `item_name`, `spa_booking`.`date` AS `date`, `spa_booking`.`time` AS `time`, `spa_booking`.`amount` AS `amount`, `spa_booking`.`special_request` AS `special_request`, `spa_booking`.`no_of_persons` AS `number_of_persons`, `spa_booking`.`duration` AS `duration`, `service_order`.`status` AS `status`, `service_order`.`booking_reference_number` AS `booking_reference_number`, `service_order`.`guest_id` AS `guest_id`, `service_order`.`service_id` AS `service_id`, `service_order`.`payment_status` AS `payment_status`, `service_order`.`total_amount` AS `total_amount`, `service_order`.`id` AS `id` FROM (((`spa_booking` left join `spa_service_type` on(`spa_booking`.`spa_service_type_id` = `spa_service_type`.`id`)) left join `spa_package` on(`spa_booking`.`spa_package_id` = `spa_package`.`id`)) left join `service_order` on(`spa_booking`.`service_order_id` = `service_order`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `spa_service_view`
--
DROP TABLE IF EXISTS `spa_service_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `spa_service_view`  AS SELECT `spa_package`.`id` AS `package_id`, `spa_package`.`title` AS `package_name`, group_concat(`spa_service_type`.`title` order by `spa_service_type`.`id` ASC separator ', ') AS `included_services`, `spa_package`.`price` AS `package_price`, `spa_package`.`image` AS `image`, sum(`spa_service_type`.`duration`) AS `total_duration` FROM ((`spa_package` join `spa_package_items` on(`spa_package`.`id` = `spa_package_items`.`spa_package_id`)) join `spa_service_type` on(`spa_package_items`.`spa_service_type_id` = `spa_service_type`.`id`)) GROUP BY `spa_package`.`id`, `spa_package`.`title`, `spa_package`.`price`, `spa_package`.`image` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bar_categories`
--
ALTER TABLE `bar_categories`
  ADD PRIMARY KEY (`bar_cat_id`);

--
-- Indexes for table `bar_items`
--
ALTER TABLE `bar_items`
  ADD PRIMARY KEY (`bar_item_id`),
  ADD KEY `bar_items_bar_cat_id_foreign` (`bar_cat_id`);

--
-- Indexes for table `cab_booking`
--
ALTER TABLE `cab_booking`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `FK_cab_booking_service_order` (`service_order_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_item_id_foreign` (`item_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `decorations`
--
ALTER TABLE `decorations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `decoration_bookings`
--
ALTER TABLE `decoration_bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `extended_stay_booking`
--
ALTER TABLE `extended_stay_booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_order_id` (`service_order_id`);

--
-- Indexes for table `extra_bed_order`
--
ALTER TABLE `extra_bed_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `extra_bed_order_service_order_id_foreign` (`service_order_id`),
  ADD KEY `extra_bed_order_rate_id_foreign` (`rate_id`);

--
-- Indexes for table `extra_bed_rate`
--
ALTER TABLE `extra_bed_rate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `floor`
--
ALTER TABLE `floor`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `guest_booking`
--
ALTER TABLE `guest_booking`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `FK_users_room` (`room_id`);

--
-- Indexes for table `guest_otps`
--
ALTER TABLE `guest_otps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_otps_user_id_foreign` (`user_id`);

--
-- Indexes for table `guides`
--
ALTER TABLE `guides`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guides_booking`
--
ALTER TABLE `guides_booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotel_table`
--
ALTER TABLE `hotel_table`
  ADD PRIMARY KEY (`hotel_id`) USING BTREE;

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_category_id_foreign` (`category_id`);

--
-- Indexes for table `laundry_order`
--
ALTER TABLE `laundry_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `laundry_order_laundry_type_id_foreign` (`laundry_type_id`),
  ADD KEY `laundry_order_service_order_id_foreign` (`service_order_id`);

--
-- Indexes for table `laundry_type`
--
ALTER TABLE `laundry_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `linen`
--
ALTER TABLE `linen`
  ADD PRIMARY KEY (`linen_id`);

--
-- Indexes for table `linen_cart`
--
ALTER TABLE `linen_cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `linen_cart_linen_id_foreign` (`linen_id`);

--
-- Indexes for table `linen_past`
--
ALTER TABLE `linen_past`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `past_orders`
--
ALTER TABLE `past_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `past_toi`
--
ALTER TABLE `past_toi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_room_room_type` (`room_type_id`),
  ADD KEY `FK_room_floor` (`floor_id`);

--
-- Indexes for table `room_cleaning_order`
--
ALTER TABLE `room_cleaning_order`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `FK_room_cleaning_order_service_order` (`service_order_id`);

--
-- Indexes for table `room_type`
--
ALTER TABLE `room_type`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `service_order`
--
ALTER TABLE `service_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_service_order_service` (`service_id`),
  ADD KEY `FK_service_order_order_status` (`status`),
  ADD KEY `FK_service_order_users` (`guest_id`),
  ADD KEY `FK_service_order_facilities` (`facility_id`);

--
-- Indexes for table `spa_booking`
--
ALTER TABLE `spa_booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `spa_booking_service_order_id_foreign` (`service_order_id`),
  ADD KEY `FK_spa_booking_spa_service_type` (`spa_service_type_id`),
  ADD KEY `FK_spa_booking_spa_package` (`spa_package_id`);

--
-- Indexes for table `spa_package`
--
ALTER TABLE `spa_package`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `spa_package_items`
--
ALTER TABLE `spa_package_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `spa_service_spa_package_id_foreign` (`spa_package_id`),
  ADD KEY `spa_service_spa_service_type_id_foreign` (`spa_service_type_id`);

--
-- Indexes for table `spa_service_type`
--
ALTER TABLE `spa_service_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `toiletries`
--
ALTER TABLE `toiletries`
  ADD PRIMARY KEY (`toiletries_id`);

--
-- Indexes for table `toiletries_cart`
--
ALTER TABLE `toiletries_cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `toiletries_cart_toiletries_id_foreign` (`toiletries_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bar_categories`
--
ALTER TABLE `bar_categories`
  MODIFY `bar_cat_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bar_items`
--
ALTER TABLE `bar_items`
  MODIFY `bar_item_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cab_booking`
--
ALTER TABLE `cab_booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `decorations`
--
ALTER TABLE `decorations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `decoration_bookings`
--
ALTER TABLE `decoration_bookings`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `extended_stay_booking`
--
ALTER TABLE `extended_stay_booking`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `extra_bed_order`
--
ALTER TABLE `extra_bed_order`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `extra_bed_rate`
--
ALTER TABLE `extra_bed_rate`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `floor`
--
ALTER TABLE `floor`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `guest_booking`
--
ALTER TABLE `guest_booking`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `guest_otps`
--
ALTER TABLE `guest_otps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=213;

--
-- AUTO_INCREMENT for table `guides`
--
ALTER TABLE `guides`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `guides_booking`
--
ALTER TABLE `guides_booking`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `hotel_table`
--
ALTER TABLE `hotel_table`
  MODIFY `hotel_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `laundry_order`
--
ALTER TABLE `laundry_order`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `laundry_type`
--
ALTER TABLE `laundry_type`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `linen`
--
ALTER TABLE `linen`
  MODIFY `linen_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `linen_cart`
--
ALTER TABLE `linen_cart`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `linen_past`
--
ALTER TABLE `linen_past`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `past_orders`
--
ALTER TABLE `past_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `past_toi`
--
ALTER TABLE `past_toi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `room_cleaning_order`
--
ALTER TABLE `room_cleaning_order`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `room_type`
--
ALTER TABLE `room_type`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `service_order`
--
ALTER TABLE `service_order`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=286;

--
-- AUTO_INCREMENT for table `spa_booking`
--
ALTER TABLE `spa_booking`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `spa_package`
--
ALTER TABLE `spa_package`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `spa_package_items`
--
ALTER TABLE `spa_package_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `spa_service_type`
--
ALTER TABLE `spa_service_type`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `toiletries`
--
ALTER TABLE `toiletries`
  MODIFY `toiletries_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `toiletries_cart`
--
ALTER TABLE `toiletries_cart`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bar_items`
--
ALTER TABLE `bar_items`
  ADD CONSTRAINT `bar_items_bar_cat_id_foreign` FOREIGN KEY (`bar_cat_id`) REFERENCES `bar_categories` (`bar_cat_id`) ON DELETE CASCADE;

--
-- Constraints for table `cab_booking`
--
ALTER TABLE `cab_booking`
  ADD CONSTRAINT `FK_cab_booking_service_order` FOREIGN KEY (`service_order_id`) REFERENCES `service_order` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`);

--
-- Constraints for table `extended_stay_booking`
--
ALTER TABLE `extended_stay_booking`
  ADD CONSTRAINT `FK_extended_stay_booking_service_order` FOREIGN KEY (`service_order_id`) REFERENCES `service_order` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `extra_bed_order`
--
ALTER TABLE `extra_bed_order`
  ADD CONSTRAINT `extra_bed_order_rate_id_foreign` FOREIGN KEY (`rate_id`) REFERENCES `extra_bed_rate` (`id`),
  ADD CONSTRAINT `extra_bed_order_service_order_id_foreign` FOREIGN KEY (`service_order_id`) REFERENCES `service_order` (`id`);

--
-- Constraints for table `guest_booking`
--
ALTER TABLE `guest_booking`
  ADD CONSTRAINT `FK_users_room` FOREIGN KEY (`room_id`) REFERENCES `room` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `guest_otps`
--
ALTER TABLE `guest_otps`
  ADD CONSTRAINT `user_otps_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `guest_booking` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `laundry_order`
--
ALTER TABLE `laundry_order`
  ADD CONSTRAINT `laundry_order_laundry_type_id_foreign` FOREIGN KEY (`laundry_type_id`) REFERENCES `laundry_type` (`id`),
  ADD CONSTRAINT `laundry_order_service_order_id_foreign` FOREIGN KEY (`service_order_id`) REFERENCES `service_order` (`id`);

--
-- Constraints for table `linen_cart`
--
ALTER TABLE `linen_cart`
  ADD CONSTRAINT `linen_cart_linen_id_foreign` FOREIGN KEY (`linen_id`) REFERENCES `linen` (`linen_id`) ON DELETE CASCADE;

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `FK_room_floor` FOREIGN KEY (`floor_id`) REFERENCES `floor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_room_room_type` FOREIGN KEY (`room_type_id`) REFERENCES `room_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `room_cleaning_order`
--
ALTER TABLE `room_cleaning_order`
  ADD CONSTRAINT `FK_room_cleaning_order_service_order` FOREIGN KEY (`service_order_id`) REFERENCES `service_order` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `service_order`
--
ALTER TABLE `service_order`
  ADD CONSTRAINT `FK_service_order_facilities` FOREIGN KEY (`facility_id`) REFERENCES `facilities` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_service_order_order_status` FOREIGN KEY (`status`) REFERENCES `order_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_service_order_service` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_service_order_users` FOREIGN KEY (`guest_id`) REFERENCES `guest_booking` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `spa_booking`
--
ALTER TABLE `spa_booking`
  ADD CONSTRAINT `FK_spa_booking_spa_package` FOREIGN KEY (`spa_package_id`) REFERENCES `spa_package` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_spa_booking_spa_service_type` FOREIGN KEY (`spa_service_type_id`) REFERENCES `spa_service_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `spa_booking_service_order_id_foreign` FOREIGN KEY (`service_order_id`) REFERENCES `service_order` (`id`);

--
-- Constraints for table `spa_package_items`
--
ALTER TABLE `spa_package_items`
  ADD CONSTRAINT `spa_service_spa_package_id_foreign` FOREIGN KEY (`spa_package_id`) REFERENCES `spa_package` (`id`),
  ADD CONSTRAINT `spa_service_spa_service_type_id_foreign` FOREIGN KEY (`spa_service_type_id`) REFERENCES `spa_service_type` (`id`);

--
-- Constraints for table `toiletries_cart`
--
ALTER TABLE `toiletries_cart`
  ADD CONSTRAINT `toiletries_cart_toiletries_id_foreign` FOREIGN KEY (`toiletries_id`) REFERENCES `toiletries` (`toiletries_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

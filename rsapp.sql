-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2024 at 08:19 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.12

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

--
-- Dumping data for table `cab_booking`
--

INSERT INTO `cab_booking` (`id`, `service_order_id`, `trip_type`, `pickup_location`, `pickup_date`, `pickup_time`, `drop_location`, `rental_hours`, `no_of_persons`, `special_request`, `created_at`, `updated_at`) VALUES
(64, 322, 'OneWay', 'Channi', '2023-03-28', '00:30:00', 'Manjalpur', NULL, 2, NULL, '2024-03-28 16:06:30', '2024-03-29 16:09:12'),
(65, 329, 'RoundTrip', 'Vintage Hotel', '2024-03-29', '00:15:00', 'Atladara', NULL, 1, NULL, '2024-03-29 06:08:25', '2024-03-29 06:08:25'),
(66, 330, 'OneWay', 'Alkapuri', '2024-03-29', '14:00:00', 'Manjalpur', NULL, 2, NULL, '2024-03-29 06:08:44', '2024-03-29 06:08:44'),
(67, 331, 'RoundTrip', 'Vintage Hotel', '2024-03-30', '00:45:00', 'Atladara', NULL, 2, NULL, '2024-03-29 06:09:14', '2024-03-29 06:09:14'),
(68, 340, 'OneWay', 'Atladara', '2024-03-30', '00:30:00', 'Manjalpur', NULL, 2, NULL, '2024-03-29 10:25:18', '2024-03-29 10:25:18'),
(69, 341, 'RoundTrip', 'Vintage Hotel', '2024-03-29', '17:30:00', 'Atladara', NULL, 3, NULL, '2024-03-29 10:25:46', '2024-03-29 10:25:46'),
(70, 352, 'RoundTrip', 'Vintage Hotel', '2024-03-30', '00:30:00', 'Manjalpur', NULL, 2, NULL, '2024-03-29 16:07:40', '2024-03-29 16:07:40'),
(71, 358, 'RoundTrip', 'Vintage Hotel', '2024-04-02', '00:15:00', 'Manjalpur', NULL, 2, NULL, '2024-04-01 03:59:34', '2024-04-01 03:59:34');

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
  `bar_item_id` bigint(20) UNSIGNED DEFAULT NULL,
  `item_type` varchar(255) NOT NULL DEFAULT 'food',
  `guest_id` bigint(20) UNSIGNED NOT NULL
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
  `service_order_id` bigint(20) UNSIGNED NOT NULL,
  `decoration_id` int(10) UNSIGNED NOT NULL,
  `decoration_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `booking_time_from` time NOT NULL,
  `booking_time_to` time NOT NULL,
  `booking_date` date NOT NULL,
  `action` varchar(50) DEFAULT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `decoration_bookings`
--

INSERT INTO `decoration_bookings` (`id`, `service_order_id`, `decoration_id`, `decoration_name`, `price`, `booking_time_from`, `booking_time_to`, `booking_date`, `action`, `description`, `created_at`, `updated_at`) VALUES
(73, 390, 1, 'Candle light dinner', 100.00, '20:00:00', '20:15:00', '2024-04-09', NULL, 'Location: Romantic rooftop\r\nDecoration: Soft candle lights, rose petals, and elegant table settings\r\nInclusions: Gourmet three-course meal, personalized service', '2024-04-09 05:54:37', '2024-04-09 05:54:37'),
(74, 391, 1, 'Candle light dinner', 100.00, '20:00:00', '20:15:00', '2024-04-09', NULL, 'Location: Romantic rooftop\r\nDecoration: Soft candle lights, rose petals, and elegant table settings\r\nInclusions: Gourmet three-course meal, personalized service', '2024-04-09 06:03:40', '2024-04-09 06:03:40'),
(75, 394, 2, 'Beach Bonfire Nights', 100.00, '07:00:00', '07:15:00', '2024-04-10', NULL, 'Host beachfront bonfire nights where guests can gather around a crackling fire, roast marshmallows, and enjoy live music or storytelling under the starlit sky. It\'s a cozy and romantic evening activity that brings people together.', '2024-04-10 07:18:46', '2024-04-10 07:18:46'),
(76, 395, 2, 'Beach Bonfire Nights', 100.00, '07:00:00', '07:15:00', '2024-04-11', NULL, 'Host beachfront bonfire nights where guests can gather around a crackling fire, roast marshmallows, and enjoy live music or storytelling under the starlit sky. It\'s a cozy and romantic evening activity that brings people together.', '2024-04-11 05:12:59', '2024-04-11 05:12:59');

-- --------------------------------------------------------

--
-- Stand-in structure for view `decoration_bookings_view`
-- (See below for the actual view)
--
CREATE TABLE `decoration_bookings_view` (
`service_order_id` bigint(20) unsigned
,`decoration_id` int(10) unsigned
,`decoration_name` varchar(255)
,`price` decimal(10,2)
,`booking_time_from` time
,`booking_time_to` time
,`booking_date` date
,`description` text
,`booking_reference_number` varchar(50)
,`service_id` bigint(20) unsigned
,`booking_date_time` datetime
,`guest_id` bigint(20) unsigned
,`total_amount` decimal(20,6)
,`payment_status` int(11)
,`status` int(11)
,`id` int(100)
);

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

--
-- Dumping data for table `extended_stay_booking`
--

INSERT INTO `extended_stay_booking` (`id`, `service_order_id`, `extend_till_date`, `special_request`, `created_at`, `updated_at`) VALUES
(10, 298, '2024-04-02', NULL, '2024-03-28 10:30:12', '2024-03-28 10:30:12'),
(11, 304, '2024-03-28', NULL, '2024-03-28 11:32:07', '2024-03-28 11:32:07'),
(12, 305, '2024-04-05', NULL, '2024-03-28 11:39:40', '2024-03-28 11:39:40'),
(13, 306, '2024-04-05', NULL, '2024-03-28 11:39:46', '2024-03-28 11:39:46'),
(14, 307, '2024-04-05', NULL, '2024-03-28 11:40:31', '2024-03-28 11:40:31'),
(15, 308, '2024-03-29', NULL, '2024-03-28 11:43:30', '2024-03-28 11:43:30'),
(16, 309, '2024-04-01', NULL, '2024-03-28 11:45:51', '2024-03-28 11:45:51'),
(17, 310, '2024-04-03', NULL, '2024-03-28 11:48:54', '2024-03-28 11:48:54'),
(18, 313, '2024-03-28', NULL, '2024-03-28 11:54:14', '2024-03-28 11:54:14'),
(19, 320, '2024-03-29', NULL, '2024-03-28 12:30:01', '2024-03-28 12:30:01'),
(20, 326, '2024-03-31', NULL, '2024-03-29 06:05:42', '2024-03-29 06:05:42'),
(21, 336, '2024-04-02', NULL, '2024-03-29 07:12:23', '2024-03-29 07:12:23'),
(22, 338, '2024-04-06', NULL, '2024-03-29 08:26:18', '2024-03-29 08:26:18'),
(23, 355, '2024-04-02', NULL, '2024-04-01 03:57:55', '2024-04-01 03:57:55');

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

--
-- Dumping data for table `extra_bed_order`
--

INSERT INTO `extra_bed_order` (`id`, `service_order_id`, `rate_id`, `rate`, `quantity`, `special_request`, `created_at`, `updated_at`) VALUES
(13, 293, 1, 600.000000, 2, NULL, '2024-03-28 09:43:00', '2024-03-28 09:43:00'),
(14, 294, 1, 600.000000, 3, NULL, '2024-03-28 09:53:10', '2024-03-28 09:53:10'),
(15, 295, 1, 600.000000, 6, NULL, '2024-03-28 09:53:36', '2024-03-28 09:53:36'),
(16, 296, 1, 600.000000, 2, NULL, '2024-03-28 10:01:08', '2024-03-28 10:01:08'),
(17, 297, 1, 600.000000, 4, NULL, '2024-03-28 10:06:55', '2024-03-28 10:06:55'),
(18, 302, 1, 600.000000, 1, NULL, '2024-03-28 11:12:52', '2024-03-28 11:12:52'),
(19, 315, 1, 600.000000, 2, NULL, '2024-03-28 11:58:54', '2024-03-28 11:58:54'),
(20, 319, 1, 600.000000, 2, NULL, '2024-03-28 12:29:48', '2024-03-28 12:29:48'),
(21, 325, 1, 600.000000, 2, NULL, '2024-03-29 06:05:20', '2024-03-29 06:05:20'),
(22, 335, 1, 600.000000, 2, NULL, '2024-03-29 06:56:37', '2024-03-29 06:56:37'),
(23, 354, 1, 600.000000, 1, NULL, '2024-04-01 03:57:37', '2024-04-01 03:57:37');

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
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `star_ratings` varchar(50) DEFAULT NULL,
  `comments` varchar(50) DEFAULT NULL,
  `guest_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `star_ratings`, `comments`, `guest_id`, `created_at`, `updated_at`) VALUES
(1, '4', 'Good liked it', 1, '2024-04-01 09:15:59', '2024-04-01 09:15:59'),
(2, '5', 'Great Service', 1, '2024-04-01 09:24:25', '2024-04-01 09:24:25');

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
(211, 1, 'pateldhruti803@gmail.com', '286893', '2024-03-28 06:56:56', '2024-03-28 06:54:56', '2024-03-28 06:54:56'),
(212, 1, 'pateldhruti803@gmail.com', '888228', '2024-03-28 09:49:51', '2024-03-28 09:47:51', '2024-03-28 09:47:51'),
(213, 1, 'pateldhruti803@gmail.com', '192495', '2024-03-28 16:03:23', '2024-03-28 16:01:23', '2024-03-28 16:01:23'),
(214, 4, 'dhrutipatel803@gmail.com', '747843', '2024-03-29 06:05:09', '2024-03-29 06:03:09', '2024-03-29 06:03:09'),
(215, 4, 'dhrutipatel803@gmail.com', '500191', '2024-03-29 06:49:20', '2024-03-29 06:47:20', '2024-03-29 06:47:20'),
(216, 5, 'dhrutipatel.200410107055@gmail.com', '632673', '2024-03-29 10:07:11', '2024-03-29 10:05:11', '2024-03-29 10:05:11'),
(217, 5, 'dhrutipatel.200410107055@gmail.com', '981941', '2024-03-29 10:19:37', '2024-03-29 10:17:37', '2024-03-29 10:17:37'),
(218, 5, 'dhrutipatel.200410107055@gmail.com', '430835', '2024-03-29 10:22:53', '2024-03-29 10:20:53', '2024-03-29 10:20:53'),
(219, 1, 'pateldhruti803@gmail.com', '952013', '2024-03-29 10:28:01', '2024-03-29 10:26:01', '2024-03-29 10:26:01'),
(220, 4, 'dhrutipatel803@gmail.com', '857439', '2024-03-29 10:30:05', '2024-03-29 10:28:05', '2024-03-29 10:28:05'),
(221, 1, 'pateldhruti803@gmail.com', '666259', '2024-03-29 15:30:23', '2024-03-29 15:28:23', '2024-03-29 15:28:23'),
(222, 1, 'pateldhruti803@gmail.com', '400287', '2024-03-29 16:22:44', '2024-03-29 16:20:44', '2024-03-29 16:20:44'),
(223, 1, 'pateldhruti803@gmail.com', '505025', '2024-04-01 03:58:19', '2024-04-01 03:56:19', '2024-04-01 03:56:19'),
(224, 1, 'pateldhruti803@gmail.com', '437071', '2024-04-01 04:25:13', '2024-04-01 04:23:13', '2024-04-01 04:23:13'),
(225, 1, 'pateldhruti803@gmail.com', '751395', '2024-04-01 04:58:57', '2024-04-01 04:56:57', '2024-04-01 04:56:57'),
(226, 1, 'pateldhruti803@gmail.com', '955500', '2024-04-01 09:04:13', '2024-04-01 09:02:13', '2024-04-01 09:02:13'),
(227, 2, 'uditsharma9058@gmail.com', '525933', '2024-04-05 04:19:20', '2024-04-05 04:17:20', '2024-04-05 04:17:20'),
(228, 1, 'pateldhruti803@gmail.com', '480991', '2024-04-05 05:36:49', '2024-04-05 05:34:49', '2024-04-05 05:34:49'),
(229, 2, 'uditsharma9058@gmail.com', '682036', '2024-04-05 05:53:12', '2024-04-05 05:51:12', '2024-04-05 05:51:12'),
(230, 1, 'pateldhruti803@gmail.com', '170982', '2024-04-05 09:36:59', '2024-04-05 09:34:59', '2024-04-05 09:34:59'),
(231, 2, 'uditsharma9058@gmail.com', '359324', '2024-04-06 04:41:31', '2024-04-06 04:39:31', '2024-04-06 04:39:31'),
(232, 2, 'uditsharma9058@gmail.com', '997713', '2024-04-08 04:34:33', '2024-04-08 04:32:33', '2024-04-08 04:32:33'),
(233, 2, 'uditsharma9058@gmail.com', '201185', '2024-04-09 04:37:40', '2024-04-09 04:35:40', '2024-04-09 04:35:40'),
(234, 2, 'uditsharma9058@gmail.com', '281739', '2024-04-09 10:22:37', '2024-04-09 10:20:37', '2024-04-09 10:20:37'),
(235, 2, 'uditsharma9058@gmail.com', '222533', '2024-04-10 05:27:38', '2024-04-10 05:25:38', '2024-04-10 05:25:38'),
(236, 2, 'uditsharma9058@gmail.com', '497108', '2024-04-10 14:54:33', '2024-04-10 14:52:33', '2024-04-10 14:52:33'),
(237, 2, 'uditsharma9058@gmail.com', '936041', '2024-04-11 04:20:10', '2024-04-11 04:18:10', '2024-04-11 04:18:10'),
(238, 2, 'uditsharma9058@gmail.com', '887091', '2024-04-11 05:52:52', '2024-04-11 05:50:52', '2024-04-11 05:50:52'),
(239, 2, 'uditsharma9058@gmail.com', '924913', '2024-04-11 05:54:13', '2024-04-11 05:52:13', '2024-04-11 05:52:13');

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
  `price` int(100) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guides`
--

INSERT INTO `guides` (`id`, `name`, `age`, `experience`, `created_at`, `updated_at`, `image`, `guide_id`, `price`, `description`) VALUES
(1, 'raj', 30, '5 years', '2024-03-14 09:48:59', '2024-03-14 09:48:59', 'raj.jpg', 'GD0001', 500, 'Meet Raj, your friendly and knowledgeable guide to explore the vibrant wonders of Goa. With over a decade of experience in guiding tourists, Raj is your go-to expert for an unforgettable journey through this coastal paradise. His deep understanding of Goa\'s rich history, culture, and traditions will enrich your experience as you traverse its sun-kissed beaches, ancient forts, and lush spice plantations. Raj\'s passion for adventure and exploration ensures that every moment of your trip is filled with excitement and discovery. From bustling markets to tranquil backwaters, Raj will unveil the hidden gems of Goa, leaving you captivated by its beauty and charm.'),
(2, 'maya', 28, '3 years', '2024-03-14 09:52:38', '2024-03-14 09:52:38', 'maya.jpg', 'GD0002', 800, 'Introducing Maya, your enthusiastic and compassionate guide ready to lead you on an enchanting exploration of Goa\'s treasures. With her warm smile and gentle demeanor, Maya creates a welcoming atmosphere for travelers of all ages. Her extensive knowledge of Goa\'s diverse landscapes, from its pristine beaches to its vibrant wildlife sanctuaries, makes her the perfect companion for an immersive journey. Whether you seek thrilling water sports or serene sunset cruises, Maya\'s attention to detail ensures that every aspect of your trip is tailored to your preferences. Let Maya be your guide to Goa\'s hidden coves, bustling markets, and ancient temples, where every moment is infused with wonder and adventure.\r\n\r\n\r\n\r\n\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `guides_booking`
--

CREATE TABLE `guides_booking` (
  `id` int(10) NOT NULL,
  `service_order_id` bigint(20) UNSIGNED NOT NULL,
  `guide_id` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `age` int(10) UNSIGNED NOT NULL,
  `experience` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `image` varchar(255) DEFAULT NULL,
  `price` int(100) NOT NULL,
  `description` text NOT NULL,
  `date` date DEFAULT NULL,
  `time` time(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guides_booking`
--

INSERT INTO `guides_booking` (`id`, `service_order_id`, `guide_id`, `name`, `age`, `experience`, `created_at`, `updated_at`, `image`, `price`, `description`, `date`, `time`) VALUES
(88, 392, 'GD0001', 'raj', 30, '5 years', '2024-04-09 06:03:53', '2024-04-09 06:03:53', 'raj.jpg', 500, 'Meet Raj, your friendly and knowledgeable guide to explore the vibrant wonders of Goa. With over a decade of experience in guiding tourists, Raj is your go-to expert for an unforgettable journey through this coastal paradise. His deep understanding of Goa\'s rich history, culture, and traditions will enrich your experience as you traverse its sun-kissed beaches, ancient forts, and lush spice plantations. Raj\'s passion for adventure and exploration ensures that every moment of your trip is filled with excitement and discovery. From bustling markets to tranquil backwaters, Raj will unveil the hidden gems of Goa, leaving you captivated by its beauty and charm.', '2024-04-09', '14:45:00.00'),
(89, 393, 'GD0002', 'maya', 28, '3 years', '2024-04-09 10:21:06', '2024-04-09 10:21:06', 'maya.jpg', 800, 'Introducing Maya, your enthusiastic and compassionate guide ready to lead you on an enchanting exploration of Goa\'s treasures. With her warm smile and gentle demeanor, Maya creates a welcoming atmosphere for travelers of all ages. Her extensive knowledge of Goa\'s diverse landscapes, from its pristine beaches to its vibrant wildlife sanctuaries, makes her the perfect companion for an immersive journey. Whether you seek thrilling water sports or serene sunset cruises, Maya\'s attention to detail ensures that every aspect of your trip is tailored to your preferences. Let Maya be your guide to Goa\'s hidden coves, bustling markets, and ancient temples, where every moment is infused with wonder and adventure.', '2024-04-09', '12:15:00.00'),
(90, 401, 'GD0001', 'raj', 30, '5 years', '2024-04-11 06:51:08', '2024-04-11 06:51:08', 'raj.jpg', 500, 'Meet Raj, your friendly and knowledgeable guide to explore the vibrant wonders of Goa. With over a decade of experience in guiding tourists, Raj is your go-to expert for an unforgettable journey through this coastal paradise. His deep understanding of Goa\'s rich history, culture, and traditions will enrich your experience as you traverse its sun-kissed beaches, ancient forts, and lush spice plantations. Raj\'s passion for adventure and exploration ensures that every moment of your trip is filled with excitement and discovery. From bustling markets to tranquil backwaters, Raj will unveil the hidden gems of Goa, leaving you captivated by its beauty and charm.', '2024-04-11', '17:00:00.00');

-- --------------------------------------------------------

--
-- Stand-in structure for view `guides_booking_view`
-- (See below for the actual view)
--
CREATE TABLE `guides_booking_view` (
`id` int(10)
,`service_order_id` bigint(20) unsigned
,`guide_id` varchar(20)
,`name` varchar(255)
,`age` int(10) unsigned
,`experience` varchar(255)
,`image` varchar(255)
,`price` int(100)
,`description` text
,`date` date
,`time` time(2)
,`booking_reference_number` varchar(50)
,`service_id` bigint(20) unsigned
,`booking_date_time` datetime
,`guest_id` bigint(20) unsigned
,`total_amount` decimal(20,6)
,`payment_status` int(11)
,`status` int(11)
);

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

--
-- Dumping data for table `laundry_order`
--

INSERT INTO `laundry_order` (`id`, `laundry_type_id`, `service_order_id`, `special_request`, `created_at`, `updated_at`) VALUES
(8, 2, 299, NULL, '2024-03-28 10:57:13', '2024-03-28 10:57:13'),
(9, 3, 300, NULL, '2024-03-28 10:57:59', '2024-03-28 10:57:59'),
(10, 4, 303, NULL, '2024-03-28 11:19:12', '2024-03-28 11:19:12'),
(11, 2, 311, NULL, '2024-03-28 11:51:03', '2024-03-28 11:51:03'),
(12, 3, 312, NULL, '2024-03-28 11:51:57', '2024-03-28 11:51:57'),
(13, 3, 314, NULL, '2024-03-28 11:54:31', '2024-03-28 11:54:31'),
(14, 2, 321, NULL, '2024-03-28 12:30:18', '2024-03-28 12:30:18'),
(15, 3, 327, NULL, '2024-03-29 06:05:58', '2024-03-29 06:05:58'),
(16, 1, 333, NULL, '2024-03-29 06:53:52', '2024-03-29 06:53:52'),
(17, 3, 334, NULL, '2024-03-29 06:54:10', '2024-03-29 06:54:10'),
(18, 4, 337, NULL, '2024-03-29 07:15:47', '2024-03-29 07:15:47'),
(19, 2, 339, NULL, '2024-03-29 08:27:23', '2024-03-29 08:27:23'),
(20, 4, 356, NULL, '2024-04-01 03:58:20', '2024-04-01 03:58:20');

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
  `updated_at` timestamp NULL DEFAULT NULL,
  `guest_id` bigint(20) UNSIGNED NOT NULL
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
  `order_id` varchar(255) NOT NULL,
  `guest_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `order_id` varchar(100) NOT NULL,
  `guest_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `updated_at` timestamp NULL DEFAULT NULL,
  `guest_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(55, 284, '2024-03-28', '15:26:00', NULL, '2024-03-28 09:16:27', '2024-03-28 09:16:27'),
(56, 285, '2024-03-28', '15:26:00', NULL, '2024-03-28 09:16:30', '2024-03-28 09:16:30'),
(57, 286, '2024-03-28', '15:26:00', NULL, '2024-03-28 09:17:31', '2024-03-28 09:17:31'),
(58, 287, '2024-03-30', '08:00:00', NULL, '2024-03-28 09:18:27', '2024-03-28 09:18:27'),
(59, 288, '2024-03-29', '09:00:00', NULL, '2024-03-28 09:20:39', '2024-03-28 09:20:39'),
(60, 289, '2024-04-01', '08:30:00', NULL, '2024-03-28 09:24:22', '2024-03-28 09:24:22'),
(61, 290, '2024-04-05', '09:00:00', NULL, '2024-03-28 09:26:59', '2024-03-28 09:26:59'),
(62, 291, '2024-03-29', '09:00:00', NULL, '2024-03-28 09:30:45', '2024-03-28 09:30:45'),
(63, 292, '2024-04-05', '09:00:00', NULL, '2024-03-28 09:32:34', '2024-03-28 09:32:34'),
(64, 301, '2024-03-28', '17:25:00', NULL, '2024-03-28 11:12:03', '2024-03-28 11:12:03'),
(65, 316, '2024-03-29', '09:00:00', NULL, '2024-03-28 12:12:13', '2024-03-28 12:12:13'),
(66, 317, '2024-03-28', '19:10:00', NULL, '2024-03-28 12:28:18', '2024-03-28 12:28:18'),
(67, 318, '2024-03-28', '19:10:00', NULL, '2024-03-28 12:29:13', '2024-03-28 12:29:13'),
(68, 324, '2024-03-30', '08:30:00', NULL, '2024-03-29 06:04:43', '2024-03-29 06:04:43'),
(69, 332, '2024-03-29', '13:10:00', NULL, '2024-03-29 06:49:58', '2024-03-29 06:49:58'),
(70, 342, '2024-03-30', '09:30:00', NULL, '2024-03-29 11:21:52', '2024-03-29 11:21:52'),
(71, 353, '2024-04-01', '10:10:00', NULL, '2024-04-01 03:57:04', '2024-04-01 03:57:04');

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
(3, 'Extend Stay', 'extend_stay.jpeg', NULL, NULL, NULL, '2024-03-15 10:23:32', '2024-03-28 07:14:08'),
(4, 'Laundry', 'laundry.jpeg', NULL, NULL, NULL, '2024-03-19 05:39:08', '2024-03-28 06:30:19'),
(5, 'Linen Order', 'linen.jpeg', NULL, NULL, NULL, '2024-03-28 06:14:20', '2024-03-28 06:30:20'),
(6, 'Toiletries Order', 'toletries.jpeg', NULL, NULL, NULL, '2024-03-28 06:15:36', '2024-03-28 07:06:46');

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
(284, 1, NULL, 'N000284', '2024-03-28 14:46:27', 1, NULL, NULL, 6, NULL, '2024-03-28 09:16:27', '2024-03-28 09:16:27'),
(285, 1, NULL, 'N000285', '2024-03-28 14:46:30', 1, NULL, NULL, 6, NULL, '2024-03-28 09:16:30', '2024-03-28 09:16:30'),
(286, 1, NULL, 'N000286', '2024-03-28 14:47:31', 1, NULL, NULL, 6, NULL, '2024-03-28 09:17:31', '2024-03-28 09:17:31'),
(287, 1, NULL, 'N000287', '2024-03-28 14:48:27', 1, NULL, NULL, 3, NULL, '2024-03-28 09:18:27', '2024-03-29 16:16:54'),
(288, 1, NULL, 'N000288', '2024-03-28 14:50:39', 1, NULL, NULL, 6, NULL, '2024-03-28 09:20:39', '2024-03-28 09:20:39'),
(289, 1, NULL, 'N000289', '2024-03-28 14:54:22', 1, NULL, NULL, 3, NULL, '2024-03-28 09:24:22', '2024-03-29 16:14:27'),
(290, 1, NULL, 'N000290', '2024-03-28 14:56:59', 1, NULL, NULL, 3, NULL, '2024-03-28 09:26:59', '2024-04-01 03:57:15'),
(291, 1, NULL, 'N000291', '2024-03-28 15:00:45', 1, NULL, NULL, 6, NULL, '2024-03-28 09:30:45', '2024-03-28 09:30:45'),
(292, 1, NULL, 'N000292', '2024-03-28 15:02:34', 1, NULL, NULL, 6, NULL, '2024-03-28 09:32:34', '2024-03-28 09:32:34'),
(293, 2, NULL, 'E000293', '2024-03-28 15:13:00', 1, 1200.000000, NULL, 6, NULL, '2024-03-28 09:43:00', '2024-03-28 09:43:00'),
(294, 2, NULL, 'E000294', '2024-03-28 15:23:10', 1, 1800.000000, NULL, 6, NULL, '2024-03-28 09:53:10', '2024-03-28 09:53:10'),
(295, 2, NULL, 'E000295', '2024-03-28 15:23:36', 1, 3600.000000, NULL, 6, NULL, '2024-03-28 09:53:36', '2024-03-28 09:53:36'),
(296, 2, NULL, 'E000296', '2024-03-28 15:31:08', 1, 1200.000000, NULL, 6, NULL, '2024-03-28 10:01:08', '2024-03-28 10:01:08'),
(297, 2, NULL, 'E000297', '2024-03-28 15:36:55', 1, 2400.000000, NULL, 6, NULL, '2024-03-28 10:06:55', '2024-03-28 10:06:55'),
(298, 3, NULL, 'ES000298', '2024-03-28 16:00:12', 1, NULL, NULL, 6, NULL, '2024-03-28 10:30:12', '2024-03-28 10:30:12'),
(299, 4, NULL, 'L000299', '2024-03-28 16:27:13', 1, NULL, NULL, NULL, NULL, '2024-03-28 10:57:13', '2024-03-28 10:57:13'),
(300, 4, NULL, 'L000300', '2024-03-28 16:27:59', 1, NULL, NULL, NULL, NULL, '2024-03-28 10:57:59', '2024-03-28 10:57:59'),
(301, 1, NULL, 'N000301', '2024-03-28 16:42:03', 1, NULL, NULL, 6, NULL, '2024-03-28 11:12:03', '2024-03-28 11:12:03'),
(302, 2, NULL, 'E000302', '2024-03-28 16:42:52', 1, 600.000000, NULL, 6, NULL, '2024-03-28 11:12:52', '2024-03-28 11:12:52'),
(303, 4, NULL, 'L000303', '2024-03-28 16:49:12', 1, NULL, NULL, NULL, NULL, '2024-03-28 11:19:12', '2024-03-28 11:19:12'),
(304, 3, NULL, 'ES000304', '2024-03-28 17:02:07', 1, NULL, NULL, 6, NULL, '2024-03-28 11:32:07', '2024-03-28 11:32:07'),
(305, 3, NULL, 'ES000305', '2024-03-28 17:09:40', 1, NULL, NULL, 6, NULL, '2024-03-28 11:39:40', '2024-03-28 11:39:40'),
(306, 3, NULL, 'ES000306', '2024-03-28 17:09:46', 1, NULL, NULL, 6, NULL, '2024-03-28 11:39:46', '2024-03-28 11:39:46'),
(307, 3, NULL, 'ES000307', '2024-03-28 17:10:31', 1, NULL, NULL, 6, NULL, '2024-03-28 11:40:31', '2024-03-28 11:40:31'),
(308, 3, NULL, 'ES000308', '2024-03-28 17:13:30', 1, NULL, NULL, 6, NULL, '2024-03-28 11:43:30', '2024-03-28 11:43:30'),
(309, 3, NULL, 'ES000309', '2024-03-28 17:15:51', 1, NULL, NULL, 3, NULL, '2024-03-28 11:45:51', '2024-04-01 03:58:02'),
(310, 3, NULL, 'ES000310', '2024-03-28 17:18:54', 1, NULL, NULL, 6, NULL, '2024-03-28 11:48:54', '2024-03-28 11:48:54'),
(311, 4, NULL, 'L000311', '2024-03-28 17:21:03', 1, NULL, NULL, NULL, NULL, '2024-03-28 11:51:03', '2024-03-28 11:51:03'),
(312, 4, NULL, 'L000312', '2024-03-28 17:21:57', 1, NULL, NULL, NULL, NULL, '2024-03-28 11:51:57', '2024-03-28 11:51:57'),
(313, 3, NULL, 'ES000313', '2024-03-28 17:24:14', 1, NULL, NULL, 3, NULL, '2024-03-28 11:54:14', '2024-03-29 16:18:50'),
(314, 4, NULL, 'L000314', '2024-03-28 17:24:31', 1, NULL, NULL, NULL, NULL, '2024-03-28 11:54:31', '2024-03-28 11:54:31'),
(315, 2, NULL, 'E000315', '2024-03-28 17:28:54', 1, 1200.000000, NULL, 6, NULL, '2024-03-28 11:58:54', '2024-03-28 11:58:54'),
(316, 1, NULL, 'N000316', '2024-03-28 17:42:13', 1, NULL, NULL, 6, NULL, '2024-03-28 12:12:13', '2024-03-28 12:12:13'),
(317, 1, NULL, 'N000317', '2024-03-28 17:58:18', 1, NULL, NULL, 6, NULL, '2024-03-28 12:28:18', '2024-03-28 12:28:18'),
(318, 1, NULL, 'N000318', '2024-03-28 17:59:13', 1, NULL, NULL, 6, NULL, '2024-03-28 12:29:13', '2024-03-28 12:29:13'),
(319, 2, NULL, 'E000319', '2024-03-28 17:59:48', 1, 1200.000000, NULL, 6, NULL, '2024-03-28 12:29:48', '2024-03-28 12:29:48'),
(320, 3, NULL, 'ES000320', '2024-03-28 18:00:01', 1, NULL, NULL, 6, NULL, '2024-03-28 12:30:01', '2024-03-28 12:30:01'),
(321, 4, NULL, 'L000321', '2024-03-28 18:00:18', 1, NULL, NULL, NULL, NULL, '2024-03-28 12:30:18', '2024-03-28 12:30:18'),
(322, NULL, 2, 'C000322', '2024-03-28 21:36:30', 1, NULL, NULL, 3, NULL, '2024-03-28 16:06:30', '2024-03-28 16:06:38'),
(323, NULL, 1, 'S000323', '2024-03-28 21:38:13', 1, 5300.000000, NULL, 1, NULL, '2024-03-28 16:08:13', '2024-03-28 16:08:14'),
(324, 1, NULL, 'N000324', '2024-03-29 11:34:43', 4, NULL, NULL, 3, NULL, '2024-03-29 06:04:43', '2024-03-29 08:45:06'),
(325, 2, NULL, 'E000325', '2024-03-29 11:35:20', 4, 1200.000000, NULL, 6, NULL, '2024-03-29 06:05:20', '2024-03-29 06:05:20'),
(326, 3, NULL, 'ES000326', '2024-03-29 11:35:42', 4, NULL, NULL, 3, NULL, '2024-03-29 06:05:42', '2024-03-29 08:24:43'),
(327, 4, NULL, 'L000327', '2024-03-29 11:35:58', 4, NULL, NULL, NULL, NULL, '2024-03-29 06:05:58', '2024-03-29 06:05:58'),
(328, NULL, 1, 'S000328', '2024-03-29 11:36:55', 4, 5200.000000, NULL, 3, NULL, '2024-03-29 06:06:55', '2024-03-29 06:07:01'),
(329, NULL, 2, 'C000329', '2024-03-29 11:38:24', 4, NULL, NULL, 1, NULL, '2024-03-29 06:08:24', '2024-03-29 06:08:24'),
(330, NULL, 2, 'C000330', '2024-03-29 11:38:44', 4, NULL, NULL, 3, NULL, '2024-03-29 06:08:44', '2024-03-29 06:08:53'),
(331, NULL, 2, 'C000331', '2024-03-29 11:39:14', 4, NULL, NULL, 3, NULL, '2024-03-29 06:09:14', '2024-03-29 10:32:20'),
(332, 1, NULL, 'N000332', '2024-03-29 12:19:58', 4, NULL, NULL, 3, NULL, '2024-03-29 06:49:58', '2024-03-29 09:59:49'),
(333, 4, NULL, 'L000333', '2024-03-29 12:23:52', 4, NULL, NULL, NULL, NULL, '2024-03-29 06:53:52', '2024-03-29 06:53:52'),
(334, 4, NULL, 'L000334', '2024-03-29 12:24:10', 4, NULL, NULL, NULL, NULL, '2024-03-29 06:54:10', '2024-03-29 06:54:10'),
(335, 2, NULL, 'E000335', '2024-03-29 12:26:37', 4, 1200.000000, NULL, 6, NULL, '2024-03-29 06:56:37', '2024-03-29 06:56:37'),
(336, 3, NULL, 'ES000336', '2024-03-29 12:42:23', 4, NULL, NULL, 1, NULL, '2024-03-29 07:12:23', '2024-03-29 08:26:47'),
(337, 4, NULL, 'L000337', '2024-03-29 12:45:47', 4, NULL, NULL, NULL, NULL, '2024-03-29 07:15:47', '2024-03-29 07:15:47'),
(338, 3, NULL, 'ES000338', '2024-03-29 13:56:18', 4, NULL, NULL, 1, NULL, '2024-03-29 08:26:18', '2024-03-29 08:26:44'),
(339, 4, NULL, 'L000339', '2024-03-29 13:57:23', 4, NULL, NULL, NULL, NULL, '2024-03-29 08:27:23', '2024-03-29 08:27:23'),
(340, NULL, 2, 'C000340', '2024-03-29 15:55:18', 5, NULL, NULL, 1, NULL, '2024-03-29 10:25:18', '2024-03-29 10:25:18'),
(341, NULL, 2, 'C000341', '2024-03-29 15:55:46', 5, NULL, NULL, 1, NULL, '2024-03-29 10:25:46', '2024-03-29 10:25:46'),
(342, 1, NULL, 'N000342', '2024-03-29 16:51:52', 4, NULL, NULL, 6, NULL, '2024-03-29 11:21:52', '2024-03-29 11:21:52'),
(343, NULL, 1, 'S000343', '2024-03-29 16:58:14', 4, 5000.000000, NULL, 3, NULL, '2024-03-29 11:28:14', '2024-03-29 11:34:23'),
(344, NULL, 1, 'S000344', '2024-03-29 20:59:10', 1, 200.000000, NULL, 1, NULL, '2024-03-29 15:29:10', '2024-03-29 15:29:10'),
(345, NULL, 1, 'S000345', '2024-03-29 21:00:10', 1, 200.000000, NULL, 1, NULL, '2024-03-29 15:30:10', '2024-03-29 15:30:10'),
(346, NULL, 1, 'S000346', '2024-03-29 21:17:19', 1, 10000.000000, NULL, 1, NULL, '2024-03-29 15:47:19', '2024-03-29 15:47:19'),
(347, NULL, 1, 'S000347', '2024-03-29 21:18:07', 1, 10000.000000, NULL, 1, NULL, '2024-03-29 15:48:07', '2024-03-29 15:48:07'),
(348, NULL, 1, 'S000348', '2024-03-29 21:18:52', 1, 10000.000000, NULL, 1, NULL, '2024-03-29 15:48:52', '2024-03-29 15:48:52'),
(349, NULL, 1, 'S000349', '2024-03-29 21:19:14', 1, 10000.000000, NULL, 1, NULL, '2024-03-29 15:49:14', '2024-03-29 15:49:14'),
(350, NULL, 1, 'S000350', '2024-03-29 21:19:39', 1, 6000.000000, NULL, 1, NULL, '2024-03-29 15:49:39', '2024-03-29 15:49:40'),
(351, NULL, 1, 'S000351', '2024-03-29 21:27:09', 1, 6700.000000, NULL, 1, NULL, '2024-03-29 15:57:09', '2024-03-29 15:57:09'),
(352, NULL, 2, 'C000352', '2024-03-29 21:37:40', 1, NULL, NULL, 3, NULL, '2024-03-29 16:07:40', '2024-03-29 16:11:09'),
(353, 1, NULL, 'N000353', '2024-04-01 09:27:03', 1, NULL, NULL, 6, NULL, '2024-04-01 03:57:03', '2024-04-01 03:57:04'),
(354, 2, NULL, 'E000354', '2024-04-01 09:27:37', 1, 600.000000, NULL, 6, NULL, '2024-04-01 03:57:37', '2024-04-01 03:57:37'),
(355, 3, NULL, 'ES000355', '2024-04-01 09:27:55', 1, NULL, NULL, 6, NULL, '2024-04-01 03:57:55', '2024-04-01 03:57:55'),
(356, 4, NULL, 'L000356', '2024-04-01 09:28:19', 1, NULL, NULL, NULL, NULL, '2024-04-01 03:58:19', '2024-04-01 03:58:19'),
(357, NULL, 1, 'S000357', '2024-04-01 09:28:51', 1, 6000.000000, NULL, 3, NULL, '2024-04-01 03:58:51', '2024-04-01 03:59:03'),
(358, NULL, 2, 'C000358', '2024-04-01 09:29:34', 1, NULL, NULL, 1, NULL, '2024-04-01 03:59:34', '2024-04-01 03:59:34'),
(359, NULL, 1, 'S000359', '2024-04-01 16:21:23', 1, 1000.000000, NULL, 1, NULL, '2024-04-01 10:51:23', '2024-04-01 10:51:23'),
(360, NULL, 4, 'D000360', '2024-04-05 10:13:50', 2, NULL, NULL, 1, NULL, '2024-04-05 04:43:50', '2024-04-05 04:43:50'),
(361, NULL, 4, 'D000361', '2024-04-05 10:13:52', 2, NULL, NULL, 1, NULL, '2024-04-05 04:43:52', '2024-04-05 04:43:52'),
(362, NULL, 4, 'D000362', '2024-04-05 10:14:03', 2, NULL, NULL, 1, NULL, '2024-04-05 04:44:03', '2024-04-05 04:44:03'),
(363, NULL, 4, 'D000363', '2024-04-05 10:14:22', 2, NULL, NULL, 1, NULL, '2024-04-05 04:44:22', '2024-04-05 04:44:22'),
(364, NULL, 4, 'D000364', '2024-04-05 10:18:17', 2, NULL, NULL, 1, NULL, '2024-04-05 04:48:17', '2024-04-05 04:48:17'),
(365, NULL, 4, 'D000365', '2024-04-05 10:37:17', 2, NULL, NULL, 1, NULL, '2024-04-05 05:07:17', '2024-04-05 05:07:17'),
(366, NULL, 4, 'D000366', '2024-04-05 10:59:11', 2, NULL, NULL, 1, NULL, '2024-04-05 05:29:11', '2024-04-05 05:29:11'),
(367, NULL, 4, 'D000367', '2024-04-05 11:05:38', 1, NULL, NULL, 1, NULL, '2024-04-05 05:35:38', '2024-04-05 05:35:38'),
(368, NULL, 4, 'D000368', '2024-04-05 11:07:46', 1, NULL, NULL, 1, NULL, '2024-04-05 05:37:46', '2024-04-05 05:37:46'),
(369, NULL, 4, 'D000369', '2024-04-05 11:20:47', 1, NULL, NULL, 1, NULL, '2024-04-05 05:50:47', '2024-04-05 05:50:47'),
(370, NULL, 4, 'D000370', '2024-04-05 13:54:59', 2, NULL, NULL, 3, NULL, '2024-04-05 08:24:59', '2024-04-05 09:16:07'),
(371, NULL, 4, 'D000371', '2024-04-05 13:55:00', 2, NULL, NULL, 1, NULL, '2024-04-05 08:25:00', '2024-04-05 08:25:00'),
(372, NULL, 4, 'D000372', '2024-04-05 13:55:44', 2, NULL, NULL, 1, NULL, '2024-04-05 08:25:44', '2024-04-05 08:25:44'),
(373, NULL, 4, 'D000373', '2024-04-05 13:55:51', 2, NULL, NULL, 1, NULL, '2024-04-05 08:25:51', '2024-04-05 08:25:51'),
(374, NULL, 4, 'D000374', '2024-04-05 14:46:35', 2, NULL, NULL, 1, NULL, '2024-04-05 09:16:35', '2024-04-05 09:16:35'),
(375, NULL, 4, 'D000375', '2024-04-05 14:46:43', 2, NULL, NULL, 1, NULL, '2024-04-05 09:16:43', '2024-04-05 09:16:43'),
(376, NULL, 4, 'D000376', '2024-04-05 14:47:07', 2, NULL, NULL, 1, NULL, '2024-04-05 09:17:07', '2024-04-05 09:17:07'),
(377, NULL, 4, 'D000377', '2024-04-05 14:52:16', 2, NULL, NULL, 3, NULL, '2024-04-05 09:22:16', '2024-04-05 09:22:51'),
(378, NULL, 4, 'D000378', '2024-04-05 14:57:52', 2, NULL, NULL, 3, NULL, '2024-04-05 09:27:52', '2024-04-05 09:27:58'),
(379, NULL, 4, 'D000379', '2024-04-05 15:04:36', 2, NULL, NULL, 3, NULL, '2024-04-05 09:34:36', '2024-04-05 09:34:43'),
(380, NULL, 4, 'D000380', '2024-04-05 15:06:04', 1, NULL, NULL, 1, NULL, '2024-04-05 09:36:04', '2024-04-05 09:36:04'),
(381, NULL, 3, 'G000381', '2024-04-08 14:49:57', 2, NULL, NULL, 1, NULL, '2024-04-08 09:19:57', '2024-04-08 09:19:57'),
(382, NULL, 3, 'G000382', '2024-04-08 14:52:57', 2, NULL, NULL, 1, NULL, '2024-04-08 09:22:57', '2024-04-08 09:22:57'),
(383, NULL, 3, 'G000383', '2024-04-08 15:16:59', 2, NULL, NULL, 1, NULL, '2024-04-08 09:46:59', '2024-04-08 09:46:59'),
(384, NULL, 3, 'G000384', '2024-04-08 16:08:04', 2, NULL, NULL, 1, NULL, '2024-04-08 10:38:04', '2024-04-08 10:38:04'),
(385, NULL, 3, 'G000385', '2024-04-09 10:24:44', 2, NULL, NULL, 1, NULL, '2024-04-09 04:54:44', '2024-04-09 04:54:44'),
(386, NULL, 3, 'G000386', '2024-04-09 10:59:28', 2, NULL, NULL, 1, NULL, '2024-04-09 05:29:28', '2024-04-09 05:29:28'),
(387, NULL, 3, 'G000387', '2024-04-09 11:01:45', 2, NULL, NULL, 1, NULL, '2024-04-09 05:31:45', '2024-04-09 05:31:45'),
(388, NULL, 3, 'G000388', '2024-04-09 11:03:35', 2, NULL, NULL, 1, NULL, '2024-04-09 05:33:35', '2024-04-09 05:33:35'),
(389, NULL, 3, 'G000389', '2024-04-09 11:22:50', 2, NULL, NULL, 1, NULL, '2024-04-09 05:52:50', '2024-04-09 05:52:50'),
(390, NULL, 4, 'D000390', '2024-04-09 11:24:37', 2, NULL, NULL, 1, NULL, '2024-04-09 05:54:37', '2024-04-09 05:54:37'),
(391, NULL, 4, 'D000391', '2024-04-09 11:33:40', 2, NULL, NULL, 1, NULL, '2024-04-09 06:03:40', '2024-04-09 06:03:40'),
(392, NULL, 3, 'G000392', '2024-04-09 11:33:53', 2, NULL, NULL, 3, NULL, '2024-04-09 06:03:53', '2024-04-11 06:40:40'),
(393, NULL, 3, 'G000393', '2024-04-09 15:51:06', 2, NULL, NULL, 3, NULL, '2024-04-09 10:21:06', '2024-04-11 06:40:45'),
(394, NULL, 4, 'D000394', '2024-04-10 12:48:46', 2, NULL, NULL, 1, NULL, '2024-04-10 07:18:46', '2024-04-10 07:18:46'),
(395, NULL, 4, 'D000395', '2024-04-11 10:42:59', 2, NULL, NULL, 3, NULL, '2024-04-11 05:12:59', '2024-04-11 05:14:53'),
(396, NULL, 3, 'G000396', '2024-04-11 12:15:07', 2, NULL, NULL, 1, NULL, '2024-04-11 06:45:07', '2024-04-11 06:45:07'),
(397, NULL, 3, 'G000397', '2024-04-11 12:16:43', 2, NULL, NULL, 1, NULL, '2024-04-11 06:46:43', '2024-04-11 06:46:43'),
(398, NULL, 3, 'G000398', '2024-04-11 12:18:47', 2, NULL, NULL, 1, NULL, '2024-04-11 06:48:47', '2024-04-11 06:48:47'),
(399, NULL, 3, 'G000399', '2024-04-11 12:18:48', 2, NULL, NULL, 1, NULL, '2024-04-11 06:48:48', '2024-04-11 06:48:48'),
(400, NULL, 3, 'G000400', '2024-04-11 12:19:56', 2, NULL, NULL, 1, NULL, '2024-04-11 06:49:56', '2024-04-11 06:49:56'),
(401, NULL, 3, 'G000401', '2024-04-11 12:21:08', 2, NULL, NULL, 3, NULL, '2024-04-11 06:51:08', '2024-04-11 06:51:14');

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
(125, 323, NULL, 1, '220', 5000.000000, '2024-03-29', '10:00:00', 1, NULL, '2024-03-28 16:08:14', '2024-03-28 16:08:14'),
(126, 323, 4, NULL, '45', 300.000000, '2024-03-29', '10:00:00', 1, NULL, '2024-03-28 16:08:14', '2024-03-28 16:08:14'),
(127, 328, NULL, 1, '220', 5000.000000, '2024-03-29', '13:00:00', 1, NULL, '2024-03-29 06:06:55', '2024-03-29 06:06:55'),
(128, 328, 2, NULL, '30', 200.000000, '2024-03-29', '13:00:00', 1, NULL, '2024-03-29 06:06:55', '2024-03-29 06:06:55'),
(129, 343, NULL, 1, '220', 5000.000000, '2024-04-01', '10:30:00', 1, NULL, '2024-03-29 11:28:14', '2024-03-29 11:28:14'),
(130, 344, 1, NULL, '30', 200.000000, '2024-04-06', '10:30:00', 1, NULL, '2024-03-29 15:29:10', '2024-03-29 15:29:10'),
(131, 345, 2, NULL, '30', 200.000000, '2024-04-04', '11:30:00', 1, NULL, '2024-03-29 15:30:10', '2024-03-29 15:30:10'),
(132, 346, NULL, 1, '220', 10000.000000, '2024-04-03', '10:30:00', 2, NULL, '2024-03-29 15:47:19', '2024-03-29 15:47:19'),
(133, 347, NULL, 1, '220', 10000.000000, '2024-04-03', '10:30:00', 2, NULL, '2024-03-29 15:48:07', '2024-03-29 15:48:07'),
(134, 348, NULL, 1, '220', 10000.000000, '2024-04-03', '10:30:00', 2, NULL, '2024-03-29 15:48:52', '2024-03-29 15:48:52'),
(135, 349, NULL, 1, '220', 10000.000000, '2024-04-03', '10:30:00', 2, NULL, '2024-03-29 15:49:14', '2024-03-29 15:49:14'),
(136, 350, NULL, 3, '70', 6000.000000, '2024-04-04', '11:00:00', 1, NULL, '2024-03-29 15:49:40', '2024-03-29 15:49:40'),
(137, 351, NULL, 3, '70', 6000.000000, '2024-04-01', '10:30:00', 1, NULL, '2024-03-29 15:57:09', '2024-03-29 15:57:09'),
(138, 351, 1, NULL, '30', 200.000000, '2024-04-01', '10:30:00', 1, NULL, '2024-03-29 15:57:09', '2024-03-29 15:57:09'),
(139, 351, 3, NULL, '120', 500.000000, '2024-04-01', '10:30:00', 1, NULL, '2024-03-29 15:57:09', '2024-03-29 15:57:09'),
(140, 357, NULL, 3, '70', 6000.000000, '2024-04-02', '10:30:00', 1, NULL, '2024-04-01 03:58:51', '2024-04-01 03:58:51'),
(141, 359, 3, NULL, '120', 1000.000000, '2024-04-01', '17:30:00', 2, NULL, '2024-04-01 10:51:23', '2024-04-01 10:51:23');

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
  `name` varchar(255) NOT NULL,
  `guest_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure for view `cab_booking_view`
--
DROP TABLE IF EXISTS `cab_booking_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `cab_booking_view`  AS SELECT `cab_booking`.`trip_type` AS `trip_type`, `cab_booking`.`pickup_location` AS `pickup_location`, `cab_booking`.`pickup_date` AS `pickup_date`, `cab_booking`.`pickup_time` AS `pickup_time`, `cab_booking`.`drop_location` AS `drop_location`, `cab_booking`.`rental_hours` AS `rental_hours`, `cab_booking`.`no_of_persons` AS `no_of_persons`, `cab_booking`.`special_request` AS `special_request`, `service_order`.`booking_reference_number` AS `booking_reference_number`, `service_order`.`service_id` AS `service_id`, `service_order`.`booking_date_time` AS `booking_date_time`, `service_order`.`guest_id` AS `guest_id`, `service_order`.`total_amount` AS `total_amount`, `service_order`.`payment_status` AS `payment_status`, `service_order`.`status` AS `status`, `service_order`.`id` AS `id` FROM (`cab_booking` join `service_order` on(`cab_booking`.`service_order_id` = `service_order`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `decoration_bookings_view`
--
DROP TABLE IF EXISTS `decoration_bookings_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `decoration_bookings_view`  AS SELECT `decoration_bookings`.`service_order_id` AS `service_order_id`, `decoration_bookings`.`decoration_id` AS `decoration_id`, `decoration_bookings`.`decoration_name` AS `decoration_name`, `decoration_bookings`.`price` AS `price`, `decoration_bookings`.`booking_time_from` AS `booking_time_from`, `decoration_bookings`.`booking_time_to` AS `booking_time_to`, `decoration_bookings`.`booking_date` AS `booking_date`, `decoration_bookings`.`description` AS `description`, `service_order`.`booking_reference_number` AS `booking_reference_number`, `service_order`.`service_id` AS `service_id`, `service_order`.`booking_date_time` AS `booking_date_time`, `service_order`.`guest_id` AS `guest_id`, `service_order`.`total_amount` AS `total_amount`, `service_order`.`payment_status` AS `payment_status`, `service_order`.`status` AS `status`, `decoration_bookings`.`id` AS `id` FROM (`decoration_bookings` join `service_order` on(`decoration_bookings`.`service_order_id` = `service_order`.`id`)) ;

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
-- Structure for view `guides_booking_view`
--
DROP TABLE IF EXISTS `guides_booking_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `guides_booking_view`  AS SELECT `guides_booking`.`id` AS `id`, `guides_booking`.`service_order_id` AS `service_order_id`, `guides_booking`.`guide_id` AS `guide_id`, `guides_booking`.`name` AS `name`, `guides_booking`.`age` AS `age`, `guides_booking`.`experience` AS `experience`, `guides_booking`.`image` AS `image`, `guides_booking`.`price` AS `price`, `guides_booking`.`description` AS `description`, `guides_booking`.`date` AS `date`, `guides_booking`.`time` AS `time`, `service_order`.`booking_reference_number` AS `booking_reference_number`, `service_order`.`service_id` AS `service_id`, `service_order`.`booking_date_time` AS `booking_date_time`, `service_order`.`guest_id` AS `guest_id`, `service_order`.`total_amount` AS `total_amount`, `service_order`.`payment_status` AS `payment_status`, `service_order`.`status` AS `status` FROM (`guides_booking` join `service_order` on(`guides_booking`.`service_order_id` = `service_order`.`id`)) ;

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
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `cart_item_id_foreign` (`item_id`) USING BTREE,
  ADD KEY `cart_bar_item_id_foreign` (`bar_item_id`) USING BTREE;

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `test` (`service_order_id`);

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
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
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
  ADD PRIMARY KEY (`id`),
  ADD KEY `test2` (`service_order_id`);

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
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `linen_cart_linen_id_foreign` (`linen_id`) USING BTREE,
  ADD KEY `guest_id` (`guest_id`) USING BTREE;

--
-- Indexes for table `linen_past`
--
ALTER TABLE `linen_past`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `guest_id` (`guest_id`) USING BTREE;

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `past_orders`
--
ALTER TABLE `past_orders`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `guest_id` (`guest_id`) USING BTREE;

--
-- Indexes for table `past_toi`
--
ALTER TABLE `past_toi`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `guest_id` (`guest_id`) USING BTREE;

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
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `toiletries_cart_toiletries_id_foreign` (`toiletries_id`) USING BTREE,
  ADD KEY `guest_id` (`guest_id`) USING BTREE;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

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
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `extended_stay_booking`
--
ALTER TABLE `extended_stay_booking`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `extra_bed_order`
--
ALTER TABLE `extra_bed_order`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

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
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

--
-- AUTO_INCREMENT for table `guides`
--
ALTER TABLE `guides`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `guides_booking`
--
ALTER TABLE `guides_booking`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `linen_past`
--
ALTER TABLE `linen_past`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `past_orders`
--
ALTER TABLE `past_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `past_toi`
--
ALTER TABLE `past_toi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `room_cleaning_order`
--
ALTER TABLE `room_cleaning_order`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=402;

--
-- AUTO_INCREMENT for table `spa_booking`
--
ALTER TABLE `spa_booking`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
  ADD CONSTRAINT `cart_bar_item_id_foreign` FOREIGN KEY (`bar_item_id`) REFERENCES `bar_items` (`bar_item_id`),
  ADD CONSTRAINT `cart_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`);

--
-- Constraints for table `decoration_bookings`
--
ALTER TABLE `decoration_bookings`
  ADD CONSTRAINT `test` FOREIGN KEY (`service_order_id`) REFERENCES `service_order` (`id`);

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
-- Constraints for table `guides_booking`
--
ALTER TABLE `guides_booking`
  ADD CONSTRAINT `test2` FOREIGN KEY (`service_order_id`) REFERENCES `service_order` (`id`);

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
  ADD CONSTRAINT `guest_id` FOREIGN KEY (`guest_id`) REFERENCES `guest_booking` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `linen_cart_linen_id_foreign` FOREIGN KEY (`linen_id`) REFERENCES `linen` (`linen_id`) ON DELETE CASCADE;

--
-- Constraints for table `linen_past`
--
ALTER TABLE `linen_past`
  ADD CONSTRAINT `FK_linen_past_guest_booking` FOREIGN KEY (`guest_id`) REFERENCES `guest_booking` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `past_orders`
--
ALTER TABLE `past_orders`
  ADD CONSTRAINT `FK_past_orders_guest_booking` FOREIGN KEY (`guest_id`) REFERENCES `guest_booking` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `past_toi`
--
ALTER TABLE `past_toi`
  ADD CONSTRAINT `past_toi_guest_booking` FOREIGN KEY (`guest_id`) REFERENCES `guest_booking` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `FK_toiletries_cart_guest_booking` FOREIGN KEY (`guest_id`) REFERENCES `guest_booking` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `toiletries_cart_toiletries_id_foreign` FOREIGN KEY (`toiletries_id`) REFERENCES `toiletries` (`toiletries_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 01, 2025 at 10:33 AM
-- Server version: 8.0.42-0ubuntu0.24.04.2
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `canteen_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `canteen`
--

CREATE TABLE `canteen` (
  `id` int NOT NULL,
  `canteen_name` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `college_id` int NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `special_hours` text COLLATE utf8mb4_general_ci,
  `phn_no` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `working_days` json DEFAULT NULL,
  `status` enum('active','maintenance','inactive','') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'active',
  `is_open` tinyint(1) DEFAULT '0',
  `open` time DEFAULT NULL,
  `close` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `canteen`
--

INSERT INTO `canteen` (`id`, `canteen_name`, `college_id`, `email`, `password`, `description`, `special_hours`, `phn_no`, `working_days`, `status`, `is_open`, `open`, `close`) VALUES
(16, 'canteen1', 11, 'canteen@gmail.com', '$2y$10$PS/OFS27BoYpuCZFQc8IBO7HDAx0.20PVI3kHY.mEa7CRJuLX5qre', 'Serving fresh and delicious meals to students and staff. We offer a variety of cuisines including Indian, Continental, japanese and Chinese dishes.', NULL, '+1 (555) 123-4567', '[\"monday\", \"tuesday\", \"wednesday\", \"thursday\", \"friday\"]', 'active', 0, '08:00:00', '20:00:00'),
(17, 'canteen2', 11, 'canteen2@gmail.com', '$2y$10$EnBLafflrT1yQWbOOBxVc.T3kVrRFgKGG63usZVUf0PLXPaI7jk3W', 'Serving fresh and delicious meals to students and staff. We offer a variety of cuisines including Indian, Continental, and Chinese dishes.', NULL, '+1 (555) 123-4567', '[\"monday\", \"tuesday\", \"wednesday\", \"thursday\"]', 'active', 0, '08:00:00', '20:00:00');

-- --------------------------------------------------------

--
-- Stand-in structure for view `canteen_orders_view`
-- (See below for the actual view)
--
CREATE TABLE `canteen_orders_view` (
`canteen_id` int
,`college_id` int
,`order_id` int
,`status` enum('pending','accepted','completed','rejected','ready')
,`time` datetime
,`total` decimal(10,2)
);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int NOT NULL,
  `item_id` int NOT NULL,
  `student_id` int NOT NULL,
  `count` int NOT NULL DEFAULT '1',
  `date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `canteen_id` int DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `canteen_id`, `name`) VALUES
(20, 16, 'bakery'),
(18, 16, 'beverages'),
(23, 16, 'breakfast'),
(21, 16, 'meals'),
(22, 16, 'snacks'),
(19, 16, 'sweets'),
(26, 17, 'bakery'),
(24, 17, 'beverages'),
(29, 17, 'breakfast'),
(27, 17, 'meals'),
(28, 17, 'snacks'),
(25, 17, 'sweets');

-- --------------------------------------------------------

--
-- Table structure for table `college`
--

CREATE TABLE `college` (
  `id` int NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `college_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `college`
--

INSERT INTO `college` (`id`, `email`, `college_name`, `password`) VALUES
(11, 'vaikomAdmin@gmail.com', 'Vaikom College', '$2y$10$/CErNrrefbOLOQ81PBRhfukFvckG/BzwXtABPvEhHoCDFW64VS./.');

-- --------------------------------------------------------

--
-- Stand-in structure for view `college_orders_view`
-- (See below for the actual view)
--
CREATE TABLE `college_orders_view` (
`canteen_email` varchar(50)
,`canteen_id` int
,`canteen_name` varchar(25)
,`college_email` varchar(100)
,`college_id` int
,`college_name` varchar(50)
,`order_id` int
,`status` enum('pending','accepted','completed','rejected','ready')
,`time` datetime
,`total` decimal(10,2)
);

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE `conversations` (
  `id` int NOT NULL,
  `student_id` int NOT NULL,
  `college_id` int NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('open','resolved') COLLATE utf8mb4_general_ci DEFAULT 'open',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_read_by_admin` tinyint(1) DEFAULT '0',
  `is_read_by_student` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `conversations`
--

INSERT INTO `conversations` (`id`, `student_id`, `college_id`, `subject`, `status`, `created_at`, `updated_at`, `is_read_by_admin`, `is_read_by_student`) VALUES
(14, 72, 11, 'order_issue', 'resolved', '2025-10-01 18:21:03', '2025-10-17 06:16:31', 1, 1),
(15, 72, 11, 'order_issue', 'open', '2025-10-01 18:24:17', '2025-10-17 06:16:31', 1, 1),
(16, 72, 11, 'order_issue', 'open', '2025-10-17 12:49:38', '2025-10-17 12:50:52', 1, 1),
(17, 72, 11, 'order_issue', 'open', '2025-10-17 12:54:27', '2025-10-17 13:02:24', 1, 1),
(18, 72, 11, 'order_issue', 'open', '2025-10-31 17:53:00', '2025-10-31 17:53:02', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `default_categories`
--

CREATE TABLE `default_categories` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `default_categories`
--

INSERT INTO `default_categories` (`id`, `name`) VALUES
(15, 'breakfast'),
(16, 'snacks'),
(17, 'meals'),
(18, 'bakery'),
(19, 'sweets'),
(20, 'beverages');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `price` decimal(5,0) NOT NULL,
  `canteen_id` int DEFAULT NULL,
  `image_location` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` enum('available','unavailable') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'available',
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `category_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `price`, `canteen_id`, `image_location`, `status`, `description`, `category_id`) VALUES
(93, 'chicken biriyani', 100, 16, NULL, 'available', 'a indian food', 21),
(95, 'samosa', 10, 16, NULL, 'unavailable', 'a indian snack', 22),
(96, 'puffs', 15, 16, NULL, 'available', 'a indian snack', 22),
(97, 'meals', 70, 16, NULL, 'available', 'a indian food', 21),
(98, 'chicken biriyani', 150, 17, NULL, 'available', 'a indian food', 29),
(99, 'meet roll', 15, 16, NULL, 'available', 'a indian snack', 22);

-- --------------------------------------------------------

--
-- Table structure for table `managers`
--

CREATE TABLE `managers` (
  `id` int NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` int NOT NULL,
  `phone` int NOT NULL,
  `address` text COLLATE utf8mb4_general_ci NOT NULL,
  `experience` float NOT NULL,
  `canteen_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int NOT NULL,
  `conversation_id` int NOT NULL,
  `sender_type` enum('student','admin') COLLATE utf8mb4_general_ci NOT NULL,
  `sender_id` int NOT NULL,
  `receiver_type` enum('student','admin') COLLATE utf8mb4_general_ci NOT NULL,
  `message_text` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `is_read_by_admin` tinyint(1) NOT NULL DEFAULT '0',
  `is_read_by_student` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `conversation_id`, `sender_type`, `sender_id`, `receiver_type`, `message_text`, `created_at`, `is_read_by_admin`, `is_read_by_student`) VALUES
(8, 14, 'student', 72, 'admin', '                                Hi Admin,\n                                I&#039;m having trouble with my recent order #ORD-2024-001. The order was placed yesterday but I haven&#039;t received any confirmation. Could you please help me check the status?\n                                Thank you!\n                            ', '2025-10-01 18:21:03', 0, 0),
(11, 15, 'student', 72, 'admin', 'afdsa', '2025-10-02 03:40:32', 0, 0),
(13, 15, 'student', 72, 'admin', 'asdf', '2025-10-02 04:04:33', 0, 0),
(14, 15, 'student', 72, 'admin', 'asdf', '2025-10-02 04:04:34', 0, 0),
(15, 15, 'student', 72, 'admin', 'fse', '2025-10-02 04:06:15', 0, 0),
(16, 15, 'admin', 11, 'student', 'Dear Emma,\n\nThank you for bringing this serious matter to our attention. We take food safety very seriously and are immediately investigating this incident.\n\nWe have:\n1. Temporarily suspended the chicken curry from our menu\n2. Initiated a thorough inspection of our food preparation and storage facilities\n3. Contacted other students who may have been affected\n4. Arranged for additional food safety training for our kitchen staff\n\nWe sincerely apologize for this incident and any inconvenience caused. Your health and safety are our top priority.\n\nWe will keep you updated on our investigation and the steps we&#039;re taking to prevent such incidents in the future.\n\nBest regards,\nCollege Administration', '2025-10-05 10:34:11', 0, 0),
(17, 15, 'admin', 11, 'student', 'Dear Emma,\n\nThank you for bringing this serious matter to our attention. We take food safety very seriously and are immediately investigating this incident.\n\nWe have:\n1. Temporarily suspended the chicken curry from our menu\n2. Initiated a thorough inspection of our food preparation and storage facilities\n3. Contacted other students who may have been affected\n4. Arranged for additional food safety training for our kitchen staff\n\nWe sincerely apologize for this incident and any inconvenience caused. Your health and safety are our top priority.\n\nWe will keep you updated on our investigation and the steps we&#039;re taking to prevent such incidents in the future.\n\nBest regards,\nCollege Administration', '2025-10-05 10:54:27', 0, 0),
(18, 15, 'admin', 11, 'student', '\nhello', '2025-10-05 16:18:15', 0, 0),
(19, 16, 'student', 72, 'admin', '                                Hi Admin,\n                                I&#039;m having trouble with my recent order #ORD-2024-001. The order was placed yesterday but I haven&#039;t received any confirmation. Could you please help me check the status?\n                                Thank you!\n                            ', '2025-10-17 12:49:38', 0, 0),
(20, 17, 'student', 72, 'admin', '                                Hi Admin,\n                                I&#039;m having trouble with my recent order #ORD-2024-001. The order was placed yesterday but I haven&#039;t received any confirmation. Could you please help me check the status?\n                                Thank you!\n                            ', '2025-10-17 12:54:27', 0, 0),
(21, 18, 'student', 72, 'admin', '                                Hi Admin,\n                                I&#039;m having trouble with my recent order #ORD-2024-001. The order was placed yesterday but I haven&#039;t received any confirmation. Could you please help me check the status?\n                                Thank you!\n                            ', '2025-10-31 17:53:00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `canteen_id` int NOT NULL,
  `student_id` int NOT NULL,
  `time` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` enum('pending','accepted','completed','rejected','ready') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pending',
  `total` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `canteen_id`, `student_id`, `time`, `status`, `total`) VALUES
(135, 16, 72, '2025-09-21 23:46:23', 'accepted', 170.00),
(136, 16, 72, '2025-09-28 23:53:10', 'accepted', 195.00),
(137, 16, 72, '2025-09-30 13:16:33', 'accepted', 195.00),
(138, 16, 72, '2025-09-30 13:21:14', 'accepted', 25.00),
(139, 17, 72, '2025-09-30 13:24:36', 'pending', 150.00),
(140, 16, 72, '2025-10-06 02:43:13', 'accepted', 100.00),
(141, 16, 72, '2025-10-17 18:51:31', 'completed', 340.00),
(142, 16, 72, '2025-10-17 18:51:40', 'completed', 170.00),
(143, 16, 72, '2025-10-30 21:17:23', 'completed', 100.00),
(144, 16, 72, '2025-11-01 10:40:38', 'pending', 170.00),
(145, 16, 72, '2025-11-01 10:40:55', 'pending', 170.00);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `item_id` int NOT NULL,
  `quantity` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `item_id`, `quantity`) VALUES
(38, 135, 97, 1),
(39, 135, 93, 1),
(40, 136, 96, 1),
(41, 136, 95, 1),
(42, 136, 97, 1),
(43, 136, 93, 1),
(44, 137, 96, 1),
(45, 137, 95, 1),
(46, 137, 93, 1),
(47, 137, 97, 1),
(48, 138, 95, 1),
(49, 138, 96, 1),
(50, 139, 98, 1),
(51, 140, 93, 1),
(52, 141, 97, 2),
(53, 141, 93, 2),
(54, 142, 97, 1),
(55, 142, 93, 1),
(56, 143, 93, 1),
(57, 144, 97, 1),
(58, 144, 93, 1),
(59, 145, 93, 1),
(60, 145, 97, 1);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int NOT NULL,
  `student_name` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `reg_no` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `college_id` int NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('pending','verified','rejected','suspended') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pending',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_name`, `reg_no`, `college_id`, `email`, `status`, `time`, `password`) VALUES
(72, 'jeon', '12345', 11, 'jeon@gmail.com', 'suspended', '2025-09-20 14:13:19', '$2y$10$gSker7cX7zn05tsoHrnikOVtztj9z9z0b8RpzMD7lQpnAVaogXnrC'),
(73, 'Student 1', '10001', 11, 'student1@demo.com', 'pending', '2025-09-20 14:19:42', '$2y$10$gSker7cX7zn05tsoHrnikOVtztj9z9z0b8RpzMD7lQpnAVaogXnrC'),
(74, 'Student 2', '10002', 11, 'student2@demo.com', 'pending', '2025-09-20 14:19:42', '$2y$10$gSker7cX7zn05tsoHrnikOVtztj9z9z0b8RpzMD7lQpnAVaogXnrC'),
(75, 'Student 3', '10003', 11, 'student3@demo.com', 'pending', '2025-09-20 14:19:42', '$2y$10$gSker7cX7zn05tsoHrnikOVtztj9z9z0b8RpzMD7lQpnAVaogXnrC'),
(76, 'Student 4', '10004', 11, 'student4@demo.com', 'pending', '2025-09-20 14:19:42', '$2y$10$gSker7cX7zn05tsoHrnikOVtztj9z9z0b8RpzMD7lQpnAVaogXnrC'),
(77, 'Student 5', '10005', 11, 'student5@demo.com', 'pending', '2025-09-20 14:19:42', '$2y$10$gSker7cX7zn05tsoHrnikOVtztj9z9z0b8RpzMD7lQpnAVaogXnrC'),
(78, 'Student 6', '10006', 11, 'student6@demo.com', 'pending', '2025-09-20 14:19:42', '$2y$10$gSker7cX7zn05tsoHrnikOVtztj9z9z0b8RpzMD7lQpnAVaogXnrC'),
(79, 'Student 7', '10007', 11, 'student7@demo.com', 'pending', '2025-09-20 14:19:42', '$2y$10$gSker7cX7zn05tsoHrnikOVtztj9z9z0b8RpzMD7lQpnAVaogXnrC'),
(80, 'Student 8', '10008', 11, 'student8@demo.com', 'pending', '2025-09-20 14:19:42', '$2y$10$gSker7cX7zn05tsoHrnikOVtztj9z9z0b8RpzMD7lQpnAVaogXnrC'),
(81, 'Student 9', '10009', 11, 'student9@demo.com', 'pending', '2025-09-20 14:19:42', '$2y$10$gSker7cX7zn05tsoHrnikOVtztj9z9z0b8RpzMD7lQpnAVaogXnrC'),
(82, 'Student 10', '10010', 11, 'student10@demo.com', 'pending', '2025-09-20 14:19:42', '$2y$10$gSker7cX7zn05tsoHrnikOVtztj9z9z0b8RpzMD7lQpnAVaogXnrC'),
(83, 'Student 11', '10011', 11, 'student11@demo.com', 'pending', '2025-09-20 14:19:42', '$2y$10$gSker7cX7zn05tsoHrnikOVtztj9z9z0b8RpzMD7lQpnAVaogXnrC'),
(84, 'Student 12', '10012', 11, 'student12@demo.com', 'pending', '2025-09-20 14:19:42', '$2y$10$gSker7cX7zn05tsoHrnikOVtztj9z9z0b8RpzMD7lQpnAVaogXnrC'),
(85, 'Student 13', '10013', 11, 'student13@demo.com', 'pending', '2025-09-20 14:19:42', '$2y$10$gSker7cX7zn05tsoHrnikOVtztj9z9z0b8RpzMD7lQpnAVaogXnrC'),
(86, 'Student 14', '10014', 11, 'student14@demo.com', 'pending', '2025-09-20 14:19:42', '$2y$10$gSker7cX7zn05tsoHrnikOVtztj9z9z0b8RpzMD7lQpnAVaogXnrC'),
(87, 'Student 15', '10015', 11, 'student15@demo.com', 'pending', '2025-09-20 14:19:42', '$2y$10$gSker7cX7zn05tsoHrnikOVtztj9z9z0b8RpzMD7lQpnAVaogXnrC'),
(88, 'Student 16', '10016', 11, 'student16@demo.com', 'pending', '2025-09-20 14:19:42', '$2y$10$gSker7cX7zn05tsoHrnikOVtztj9z9z0b8RpzMD7lQpnAVaogXnrC'),
(89, 'Student 17', '10017', 11, 'student17@demo.com', 'pending', '2025-09-20 14:19:42', '$2y$10$gSker7cX7zn05tsoHrnikOVtztj9z9z0b8RpzMD7lQpnAVaogXnrC'),
(90, 'Student 18', '10018', 11, 'student18@demo.com', 'pending', '2025-09-20 14:19:42', '$2y$10$gSker7cX7zn05tsoHrnikOVtztj9z9z0b8RpzMD7lQpnAVaogXnrC'),
(91, 'Student 19', '10019', 11, 'student19@demo.com', 'pending', '2025-09-20 14:19:42', '$2y$10$gSker7cX7zn05tsoHrnikOVtztj9z9z0b8RpzMD7lQpnAVaogXnrC'),
(92, 'Student 20', '10020', 11, 'student20@demo.com', 'pending', '2025-09-20 14:19:42', '$2y$10$gSker7cX7zn05tsoHrnikOVtztj9z9z0b8RpzMD7lQpnAVaogXnrC'),
(93, 'Student 21', '10021', 11, 'student21@demo.com', 'pending', '2025-09-20 14:19:42', '$2y$10$gSker7cX7zn05tsoHrnikOVtztj9z9z0b8RpzMD7lQpnAVaogXnrC'),
(94, 'Student 22', '10022', 11, 'student22@demo.com', 'pending', '2025-09-20 14:19:42', '$2y$10$gSker7cX7zn05tsoHrnikOVtztj9z9z0b8RpzMD7lQpnAVaogXnrC'),
(95, 'Student 23', '10023', 11, 'student23@demo.com', 'pending', '2025-09-20 14:19:42', '$2y$10$gSker7cX7zn05tsoHrnikOVtztj9z9z0b8RpzMD7lQpnAVaogXnrC'),
(96, 'Student 24', '10024', 11, 'student24@demo.com', 'pending', '2025-09-20 14:19:42', '$2y$10$gSker7cX7zn05tsoHrnikOVtztj9z9z0b8RpzMD7lQpnAVaogXnrC'),
(97, 'Student 25', '10025', 11, 'student25@demo.com', 'pending', '2025-09-20 14:19:42', '$2y$10$gSker7cX7zn05tsoHrnikOVtztj9z9z0b8RpzMD7lQpnAVaogXnrC'),
(98, 'Student 26', '10026', 11, 'student26@demo.com', 'pending', '2025-09-20 14:19:42', '$2y$10$gSker7cX7zn05tsoHrnikOVtztj9z9z0b8RpzMD7lQpnAVaogXnrC'),
(99, 'Student 27', '10027', 11, 'student27@demo.com', 'pending', '2025-09-20 14:19:42', '$2y$10$gSker7cX7zn05tsoHrnikOVtztj9z9z0b8RpzMD7lQpnAVaogXnrC'),
(100, 'Student 28', '10028', 11, 'student28@demo.com', 'pending', '2025-09-20 14:19:42', '$2y$10$gSker7cX7zn05tsoHrnikOVtztj9z9z0b8RpzMD7lQpnAVaogXnrC'),
(101, 'Student 29', '10029', 11, 'student29@demo.com', 'pending', '2025-09-20 14:19:42', '$2y$10$gSker7cX7zn05tsoHrnikOVtztj9z9z0b8RpzMD7lQpnAVaogXnrC'),
(102, 'Student 30', '10030', 11, 'student30@demo.com', 'pending', '2025-09-20 14:19:42', '$2y$10$gSker7cX7zn05tsoHrnikOVtztj9z9z0b8RpzMD7lQpnAVaogXnrC'),
(103, 'Student 31', '10031', 11, 'student31@demo.com', 'pending', '2025-09-20 14:19:42', '$2y$10$gSker7cX7zn05tsoHrnikOVtztj9z9z0b8RpzMD7lQpnAVaogXnrC'),
(104, 'Student 32', '10032', 11, 'student32@demo.com', 'pending', '2025-09-20 14:19:42', '$2y$10$gSker7cX7zn05tsoHrnikOVtztj9z9z0b8RpzMD7lQpnAVaogXnrC'),
(105, 'Student 33', '10033', 11, 'student33@demo.com', 'pending', '2025-09-20 14:19:42', '$2y$10$gSker7cX7zn05tsoHrnikOVtztj9z9z0b8RpzMD7lQpnAVaogXnrC'),
(106, 'Student 34', '10034', 11, 'student34@demo.com', 'pending', '2025-09-20 14:19:42', '$2y$10$gSker7cX7zn05tsoHrnikOVtztj9z9z0b8RpzMD7lQpnAVaogXnrC'),
(107, 'Student 35', '10035', 11, 'student35@demo.com', 'rejected', '2025-09-20 14:19:42', '$2y$10$gSker7cX7zn05tsoHrnikOVtztj9z9z0b8RpzMD7lQpnAVaogXnrC'),
(108, 'Student 36', '10036', 11, 'student36@demo.com', 'verified', '2025-09-20 14:19:42', '$2y$10$gSker7cX7zn05tsoHrnikOVtztj9z9z0b8RpzMD7lQpnAVaogXnrC'),
(109, 'Student 37', '10037', 11, 'student37@demo.com', 'rejected', '2025-09-20 14:19:42', '$2y$10$gSker7cX7zn05tsoHrnikOVtztj9z9z0b8RpzMD7lQpnAVaogXnrC'),
(110, 'Student 38', '10038', 11, 'student38@demo.com', 'rejected', '2025-09-20 14:19:42', '$2y$10$gSker7cX7zn05tsoHrnikOVtztj9z9z0b8RpzMD7lQpnAVaogXnrC'),
(111, 'Student 39', '10039', 11, 'student39@demo.com', 'verified', '2025-09-20 14:19:42', '$2y$10$gSker7cX7zn05tsoHrnikOVtztj9z9z0b8RpzMD7lQpnAVaogXnrC'),
(112, 'Student 40', '10040', 11, 'student40@demo.com', 'verified', '2025-09-20 14:19:42', '$2y$10$gSker7cX7zn05tsoHrnikOVtztj9z9z0b8RpzMD7lQpnAVaogXnrC'),
(113, 'Student 41', '10041', 11, 'student41@demo.com', 'rejected', '2025-09-20 14:19:42', '$2y$10$gSker7cX7zn05tsoHrnikOVtztj9z9z0b8RpzMD7lQpnAVaogXnrC'),
(114, 'Student 42', '10042', 11, 'student42@demo.com', 'rejected', '2025-09-20 14:19:42', '$2y$10$gSker7cX7zn05tsoHrnikOVtztj9z9z0b8RpzMD7lQpnAVaogXnrC'),
(115, 'Student 43', '10043', 11, 'student43@demo.com', 'verified', '2025-09-20 14:19:42', '$2y$10$gSker7cX7zn05tsoHrnikOVtztj9z9z0b8RpzMD7lQpnAVaogXnrC'),
(116, 'Student 44', '10044', 11, 'student44@demo.com', 'verified', '2025-09-20 14:19:42', '$2y$10$gSker7cX7zn05tsoHrnikOVtztj9z9z0b8RpzMD7lQpnAVaogXnrC'),
(117, 'Student 45', '10045', 11, 'student45@demo.com', 'verified', '2025-09-20 14:19:42', '$2y$10$gSker7cX7zn05tsoHrnikOVtztj9z9z0b8RpzMD7lQpnAVaogXnrC'),
(118, 'Student 46', '10046', 11, 'student46@demo.com', 'verified', '2025-09-20 14:19:42', '$2y$10$gSker7cX7zn05tsoHrnikOVtztj9z9z0b8RpzMD7lQpnAVaogXnrC'),
(119, 'Student 47', '10047', 11, 'student47@demo.com', 'verified', '2025-09-20 14:19:42', '$2y$10$gSker7cX7zn05tsoHrnikOVtztj9z9z0b8RpzMD7lQpnAVaogXnrC'),
(120, 'Student 48', '10048', 11, 'student48@demo.com', 'suspended', '2025-09-20 14:19:42', '$2y$10$gSker7cX7zn05tsoHrnikOVtztj9z9z0b8RpzMD7lQpnAVaogXnrC'),
(121, 'Student 49', '10049', 11, 'student49@demo.com', 'suspended', '2025-09-20 14:19:42', '$2y$10$gSker7cX7zn05tsoHrnikOVtztj9z9z0b8RpzMD7lQpnAVaogXnrC'),
(122, 'Student 50', '10050', 11, 'student50@demo.com', 'verified', '2025-09-20 14:19:42', '$2y$10$gSker7cX7zn05tsoHrnikOVtztj9z9z0b8RpzMD7lQpnAVaogXnrC');

-- --------------------------------------------------------

--
-- Structure for view `canteen_orders_view`
--
DROP TABLE IF EXISTS `canteen_orders_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `canteen_orders_view`  AS SELECT `canteen`.`id` AS `canteen_id`, `orders`.`id` AS `order_id`, `canteen`.`college_id` AS `college_id`, `orders`.`total` AS `total`, `orders`.`time` AS `time`, `orders`.`status` AS `status` FROM (`orders` join `canteen` on((`orders`.`canteen_id` = `canteen`.`id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `college_orders_view`
--
DROP TABLE IF EXISTS `college_orders_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `college_orders_view`  AS SELECT `college`.`id` AS `college_id`, `canteen`.`id` AS `canteen_id`, `orders`.`id` AS `order_id`, `college`.`college_name` AS `college_name`, `canteen`.`canteen_name` AS `canteen_name`, `college`.`email` AS `college_email`, `canteen`.`email` AS `canteen_email`, `orders`.`total` AS `total`, `orders`.`time` AS `time`, `orders`.`status` AS `status` FROM ((`orders` join `canteen` on((`orders`.`canteen_id` = `canteen`.`id`))) join `college` on((`canteen`.`college_id` = `college`.`id`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `canteen`
--
ALTER TABLE `canteen`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `college_id` (`college_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `canteen_id` (`canteen_id`,`name`);

--
-- Indexes for table `college`
--
ALTER TABLE `college`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_student` (`student_id`),
  ADD KEY `fk_college` (`college_id`);

--
-- Indexes for table `default_categories`
--
ALTER TABLE `default_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_items_canteen` (`canteen_id`),
  ADD KEY `fk_items_category` (`category_id`);

--
-- Indexes for table `managers`
--
ALTER TABLE `managers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_managers_canteen` (`canteen_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_conversation` (`conversation_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `canteen_id` (`canteen_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `college_id` (`college_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `canteen`
--
ALTER TABLE `canteen`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=473;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `college`
--
ALTER TABLE `college`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `default_categories`
--
ALTER TABLE `default_categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `managers`
--
ALTER TABLE `managers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `canteen`
--
ALTER TABLE `canteen`
  ADD CONSTRAINT `canteen_ibfk_1` FOREIGN KEY (`college_id`) REFERENCES `college` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`);

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`canteen_id`) REFERENCES `canteen` (`id`);

--
-- Constraints for table `conversations`
--
ALTER TABLE `conversations`
  ADD CONSTRAINT `fk_college` FOREIGN KEY (`college_id`) REFERENCES `college` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_student` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `fk_items_canteen` FOREIGN KEY (`canteen_id`) REFERENCES `canteen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_items_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `managers`
--
ALTER TABLE `managers`
  ADD CONSTRAINT `fk_managers_canteen` FOREIGN KEY (`canteen_id`) REFERENCES `canteen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `fk_conversation` FOREIGN KEY (`conversation_id`) REFERENCES `conversations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`canteen_id`) REFERENCES `canteen` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`college_id`) REFERENCES `college` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

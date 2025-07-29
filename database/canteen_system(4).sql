-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 29, 2025 at 08:59 PM
-- Server version: 8.0.42-0ubuntu0.24.04.1
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
  `college_id` int NOT NULL,
  `canteen_name` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `canteen`
--

INSERT INTO `canteen` (`id`, `college_id`, `canteen_name`, `email`, `password`) VALUES
(14, 1, 'canteen1', 'manglam@gmail.com', '$2y$10$j2ZtstvcDPF41fUSWoLFmuVbbTyll35qDLdXQFDZpXSmrbGkiIMJO'),
(15, 1, 'manglam2', 'manglam1@gmail.com', '$2y$10$U5cdjUxdhRgQ.6vAbmIrDOx8MT9QaCXRXJkzhDIfKkw6Jlv4OTstq');

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
(8, 14, 'bakery'),
(6, 14, 'beverages'),
(11, 14, 'breakfast'),
(9, 14, 'meals'),
(10, 14, 'snacks'),
(7, 14, 'sweets'),
(14, 15, 'bakery'),
(12, 15, 'beverages'),
(17, 15, 'breakfast'),
(15, 15, 'meals'),
(16, 15, 'snacks'),
(13, 15, 'sweets');

-- --------------------------------------------------------

--
-- Table structure for table `college`
--

CREATE TABLE `college` (
  `id` int NOT NULL,
  `college_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `college`
--

INSERT INTO `college` (`id`, `college_name`) VALUES
(1, 'Mangalam MC Varghese college arts and science'),
(2, 'Mangalam engineering college'),
(4, 'Rajagiri college kakanad'),
(5, 'MES college '),
(6, 'Thalayolaparamb College');

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
  `status` enum('out of stock','available','not ready') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'available',
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `category_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `price`, `canteen_id`, `image_location`, `status`, `description`, `category_id`) VALUES
(78, 'idli', 10, 14, '68691c83edbe19.70636923cola.jpg', 'available', 'idli', 11),
(79, 'dosa', 10, 14, '68691c9b234155.47746090dosa.jpg', 'available', 'dosa', 11),
(80, 'appam', 10, 14, '68691ca9ebb8c0.58010536dosa.jpg', 'available', 'appam', 11),
(81, 'biriyani', 150, 14, '68691cd0c8afa6.93457876Biriyani.jpg', 'available', 'biriyani', 11),
(82, 'meals', 100, 14, '68691ce4c74ca1.27503342chola_bhature.jpg', 'available', 'meals', 9),
(83, 'chapathi', 10, 14, '68691d05615f40.64411435Biriyani.jpg', 'available', 'chapathi', 9),
(84, 'samosa', 10, 14, '68691d17ca1966.76961021idili.jpg', 'available', 'samosa', 10),
(85, 'rolls', 20, 14, '68691d334597a1.06063803kabir-cheema-8T9AVksyt7s-unsplash.jpg', 'available', 'rolls', 10),
(86, 'puffs', 15, 14, '68691d48398ec1.62123386Biriyani.jpg', 'available', 'puffs', 10),
(87, 'cream bun', 10, 15, '6870b1a239a412.73338665cola.jpg', 'available', 'cream bun', 16),
(88, 'chicken biriyani123', 10, 14, NULL, 'available', 'a indian food', 11),
(92, 'chicken biriyani32', 10, 14, NULL, 'available', 'a indian food', 10);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `canteen_id` int NOT NULL,
  `student_id` int NOT NULL,
  `time` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` enum('pending','accepted','completed','rejected','ready') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pending',
  `total` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `canteen_id`, `student_id`, `time`, `status`, `total`) VALUES
(66, 15, 11, '2025-07-18 23:50:00', 'pending', 10.00),
(67, 14, 11, '2025-07-18 23:50:00', 'pending', 30.00),
(68, 14, 11, '2025-07-18 23:50:16', 'pending', 30.00),
(69, 14, 11, '2025-07-18 23:50:19', 'pending', 20.00),
(70, 14, 11, '2025-07-18 23:50:22', 'pending', 30.00),
(71, 14, 11, '2025-07-18 23:50:26', 'pending', 170.00),
(72, 14, 11, '2025-07-18 23:50:41', 'pending', 30.00),
(73, 14, 11, '2025-07-18 23:53:52', 'pending', 30.00),
(74, 14, 11, '2025-07-19 09:14:38', 'pending', 30.00),
(75, 14, 11, '2025-07-19 09:14:59', 'pending', 20.00),
(76, 14, 11, '2025-07-19 09:17:55', 'pending', 30.00),
(77, 14, 11, '2025-07-19 09:18:48', 'pending', 30.00),
(78, 14, 11, '2025-07-19 09:19:39', 'pending', 20.00),
(79, 14, 11, '2025-07-19 09:20:22', 'pending', 20.00),
(80, 14, 11, '2025-07-19 09:21:13', 'pending', 30.00),
(81, 14, 11, '2025-07-19 09:22:14', 'pending', 30.00),
(82, 14, 11, '2025-07-19 09:23:21', 'pending', 30.00),
(83, 14, 11, '2025-07-19 09:23:36', 'pending', 160.00),
(84, 14, 11, '2025-07-19 09:24:49', 'pending', 10.00),
(85, 14, 11, '2025-07-19 09:27:55', 'pending', 20.00),
(86, 14, 11, '2025-07-19 10:15:27', 'pending', 10.00),
(87, 14, 11, '2025-07-19 10:16:53', 'pending', 10.00),
(88, 14, 11, '2025-07-19 10:19:46', 'pending', 20.00),
(89, 14, 11, '2025-07-19 10:21:37', 'pending', 20.00),
(90, 14, 11, '2025-07-19 10:22:43', 'pending', 10.00),
(91, 14, 11, '2025-07-19 10:27:26', 'pending', 30.00),
(92, 14, 11, '2025-07-19 10:27:50', 'pending', 20.00),
(93, 14, 11, '2025-07-19 10:29:45', 'pending', 20.00),
(94, 14, 11, '2025-07-19 11:22:40', 'pending', 20.00),
(95, 14, 11, '2025-07-19 11:23:54', 'pending', 170.00),
(96, 14, 11, '2025-07-19 11:25:59', 'pending', 20.00),
(97, 14, 11, '2025-07-19 11:26:11', 'pending', 20.00),
(98, 14, 11, '2025-07-19 11:27:21', 'pending', 20.00),
(99, 14, 11, '2025-07-19 11:30:53', 'pending', 20.00),
(100, 14, 11, '2025-07-19 11:32:11', 'pending', 20.00),
(101, 14, 11, '2025-07-19 11:33:01', 'pending', 30.00),
(102, 14, 11, '2025-07-19 11:34:20', 'pending', 20.00),
(103, 14, 11, '2025-07-19 11:34:44', 'pending', 20.00),
(104, 14, 11, '2025-07-19 11:36:42', 'pending', 20.00),
(105, 14, 11, '2025-07-19 11:36:52', 'pending', 10.00),
(106, 14, 11, '2025-07-19 12:31:04', 'pending', 20.00),
(107, 14, 11, '2025-07-19 12:34:26', 'pending', 160.00),
(108, 14, 11, '2025-07-19 12:35:58', 'pending', 10.00),
(109, 14, 11, '2025-07-19 13:10:06', 'completed', 20.00),
(110, 14, 11, '2025-07-19 13:18:18', 'completed', 20.00),
(111, 14, 11, '2025-07-19 13:21:55', 'completed', 20.00),
(112, 14, 11, '2025-07-19 13:22:06', 'accepted', 10.00),
(113, 14, 11, '2025-07-21 00:22:20', 'rejected', 40.00),
(114, 14, 11, '2025-07-21 23:47:46', 'accepted', 20.00),
(115, 14, 12, '2025-07-26 15:40:41', 'ready', 20.00),
(116, 14, 11, '2025-07-27 21:32:21', 'rejected', 30.00);

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
(153, 66, 87, 1),
(154, 67, 80, 1),
(155, 67, 79, 1),
(156, 67, 78, 1),
(157, 68, 80, 1),
(158, 68, 79, 1),
(159, 68, 78, 1),
(160, 69, 80, 1),
(161, 69, 79, 1),
(162, 70, 80, 1),
(163, 70, 79, 1),
(164, 70, 78, 1),
(165, 71, 80, 1),
(166, 71, 79, 1),
(167, 71, 81, 1),
(168, 72, 80, 1),
(169, 72, 79, 1),
(170, 72, 78, 1),
(171, 73, 78, 1),
(172, 73, 80, 1),
(173, 73, 79, 1),
(174, 74, 80, 1),
(175, 74, 79, 1),
(176, 74, 78, 1),
(177, 75, 80, 1),
(178, 75, 79, 1),
(179, 76, 80, 1),
(180, 76, 79, 1),
(181, 76, 78, 1),
(182, 77, 80, 1),
(183, 77, 79, 1),
(184, 77, 78, 1),
(185, 78, 79, 1),
(186, 78, 78, 1),
(187, 79, 80, 1),
(188, 79, 79, 1),
(189, 80, 80, 1),
(190, 80, 79, 1),
(191, 80, 78, 1),
(192, 81, 80, 1),
(193, 81, 79, 1),
(194, 81, 78, 1),
(195, 82, 80, 1),
(196, 82, 79, 1),
(197, 82, 78, 1),
(198, 83, 79, 1),
(199, 83, 81, 1),
(200, 84, 78, 1),
(201, 85, 79, 1),
(202, 85, 78, 1),
(203, 86, 79, 1),
(204, 87, 78, 1),
(205, 88, 80, 1),
(206, 88, 79, 1),
(207, 89, 79, 1),
(208, 89, 78, 1),
(209, 90, 78, 1),
(210, 91, 80, 1),
(211, 91, 79, 1),
(212, 91, 78, 1),
(213, 92, 79, 1),
(214, 92, 78, 1),
(215, 93, 79, 1),
(216, 93, 78, 1),
(217, 94, 80, 1),
(218, 94, 79, 1),
(219, 95, 81, 1),
(220, 95, 80, 1),
(221, 95, 79, 1),
(222, 96, 79, 1),
(223, 96, 78, 1),
(224, 97, 80, 1),
(225, 97, 79, 1),
(226, 98, 79, 1),
(227, 98, 78, 1),
(228, 99, 79, 1),
(229, 99, 78, 1),
(230, 100, 79, 1),
(231, 100, 78, 1),
(232, 101, 80, 1),
(233, 101, 79, 1),
(234, 101, 78, 1),
(235, 102, 79, 1),
(236, 102, 78, 1),
(237, 103, 80, 1),
(238, 103, 79, 1),
(239, 104, 79, 1),
(240, 104, 78, 1),
(241, 105, 79, 1),
(242, 106, 79, 1),
(243, 106, 78, 1),
(244, 107, 79, 1),
(245, 107, 81, 1),
(246, 108, 79, 1),
(247, 109, 79, 1),
(248, 109, 78, 1),
(249, 110, 79, 1),
(250, 110, 78, 1),
(251, 111, 79, 1),
(252, 111, 78, 1),
(253, 112, 80, 1),
(254, 113, 78, 2),
(255, 113, 79, 2),
(256, 114, 79, 1),
(257, 114, 78, 1),
(258, 115, 79, 1),
(259, 115, 78, 1),
(260, 116, 88, 1),
(261, 116, 79, 1),
(262, 116, 78, 1);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int NOT NULL,
  `college_id` int NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `college_id`, `email`, `password`) VALUES
(11, 1, 'jeon@gmail.com', '$2y$10$O5g54F5iQDMFK4aPUEXS5uaKDFoSXz.WETOpC2vFTMFBsHV4VTyXe'),
(12, 1, 'jeon2@gmail.com', '$2y$10$wTc7aSZW42HBIqJ17kVhZeh3aAOeremMkjgMSLjNeabK36DTKhlxS');

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=401;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `college`
--
ALTER TABLE `college`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `default_categories`
--
ALTER TABLE `default_categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=263;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `fk_items_canteen` FOREIGN KEY (`canteen_id`) REFERENCES `canteen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_items_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

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

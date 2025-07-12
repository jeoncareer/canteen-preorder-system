-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 12, 2025 at 02:13 PM
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

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `item_id`, `student_id`, `count`, `date`) VALUES
(71, 78, 11, 1, '2025-07-12 19:41:56'),
(72, 79, 11, 1, '2025-07-12 19:41:57');

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
(87, 'cream bun', 10, 15, '6870b1a239a412.73338665cola.jpg', 'available', 'cream bun', 16);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `canteen_id` int NOT NULL,
  `student_id` int NOT NULL,
  `time` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` enum('processing','declined','accepted','ready') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'processing'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(11, 1, 'jeon@gmail.com', '$2y$10$O5g54F5iQDMFK4aPUEXS5uaKDFoSXz.WETOpC2vFTMFBsHV4VTyXe');

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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

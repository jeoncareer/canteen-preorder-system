-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2025 at 07:15 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
  `id` int(11) NOT NULL,
  `canteen_name` varchar(25) NOT NULL,
  `college_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `canteen`
--

INSERT INTO `canteen` (`id`, `canteen_name`, `college_id`, `email`, `password`) VALUES
(16, 'canteen1', 11, 'canteen@gmail.com', '$2y$10$PS/OFS27BoYpuCZFQc8IBO7HDAx0.20PVI3kHY.mEa7CRJuLX5qre'),
(17, 'canteen2', 11, 'canteen2@gmail.com', '$2y$10$EnBLafflrT1yQWbOOBxVc.T3kVrRFgKGG63usZVUf0PLXPaI7jk3W');

-- --------------------------------------------------------

--
-- Stand-in structure for view `canteen_orders_view`
-- (See below for the actual view)
--
CREATE TABLE `canteen_orders_view` (
`canteen_id` int(11)
,`order_id` int(11)
,`college_id` int(11)
,`total` decimal(10,2)
,`time` datetime
,`status` enum('pending','accepted','completed','rejected','ready')
);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `count` int(11) NOT NULL DEFAULT 1,
  `date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `canteen_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL
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
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `college_name` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
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
`college_id` int(11)
,`canteen_id` int(11)
,`order_id` int(11)
,`college_name` varchar(50)
,`canteen_name` varchar(25)
,`college_email` varchar(100)
,`canteen_email` varchar(50)
,`total` decimal(10,2)
,`time` datetime
,`status` enum('pending','accepted','completed','rejected','ready')
);

-- --------------------------------------------------------

--
-- Table structure for table `default_categories`
--

CREATE TABLE `default_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL
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
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `price` decimal(5,0) NOT NULL,
  `canteen_id` int(11) DEFAULT NULL,
  `image_location` varchar(255) DEFAULT NULL,
  `status` enum('available','unavailable') NOT NULL DEFAULT 'available',
  `description` text NOT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `price`, `canteen_id`, `image_location`, `status`, `description`, `category_id`) VALUES
(93, 'chicken biriyani', 10, 16, NULL, 'available', 'a indian food', 21),
(95, 'samosa', 10, 16, NULL, 'available', 'a indian snack', 22),
(96, 'puffs', 15, 16, NULL, 'available', 'a indian snack', 22),
(97, 'meals', 70, 16, NULL, 'available', 'a indian food', 21),
(98, 'chicken biriyani', 150, 17, NULL, 'available', 'a indian food', 29);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `canteen_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `time` datetime DEFAULT current_timestamp(),
  `status` enum('pending','accepted','completed','rejected','ready') NOT NULL DEFAULT 'pending',
  `total` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `canteen_id`, `student_id`, `time`, `status`, `total`) VALUES
(118, 16, 14, '2025-08-14 23:27:39', 'accepted', 10.00),
(119, 16, 14, '2025-08-15 15:16:40', 'pending', 90.00),
(120, 16, 14, '2025-08-15 15:16:46', 'pending', 25.00),
(121, 17, 14, '2025-08-15 22:21:14', 'pending', 300.00);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `item_id`, `quantity`) VALUES
(1, 118, 93, 1),
(2, 119, 97, 1),
(3, 119, 93, 2),
(4, 120, 96, 1),
(5, 120, 95, 1),
(6, 121, 98, 2);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `college_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `college_id`, `email`, `password`) VALUES
(13, 11, 'jeon@gmail.com', '$2y$10$kQVfHDFzRmO4NIDY0DxzIelHS2qenLAB7oA/yTah/Tkk8dw9iEkk.'),
(14, 11, 'canteen@gmail.com', '$2y$10$0IBdZZd0EPMHmXn758lb.O8zCDud4rGdQaK8rTcmS8scqnTK.UKma');

-- --------------------------------------------------------

--
-- Structure for view `canteen_orders_view`
--
DROP TABLE IF EXISTS `canteen_orders_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `canteen_orders_view`  AS SELECT `canteen`.`id` AS `canteen_id`, `orders`.`id` AS `order_id`, `canteen`.`college_id` AS `college_id`, `orders`.`total` AS `total`, `orders`.`time` AS `time`, `orders`.`status` AS `status` FROM (`orders` join `canteen` on(`orders`.`canteen_id` = `canteen`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `college_orders_view`
--
DROP TABLE IF EXISTS `college_orders_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `college_orders_view`  AS SELECT `college`.`id` AS `college_id`, `canteen`.`id` AS `canteen_id`, `orders`.`id` AS `order_id`, `college`.`college_name` AS `college_name`, `canteen`.`canteen_name` AS `canteen_name`, `college`.`email` AS `college_email`, `canteen`.`email` AS `canteen_email`, `orders`.`total` AS `total`, `orders`.`time` AS `time`, `orders`.`status` AS `status` FROM ((`orders` join `canteen` on(`orders`.`canteen_id` = `canteen`.`id`)) join `college` on(`canteen`.`college_id` = `college`.`id`)) ;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=409;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `college`
--
ALTER TABLE `college`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `default_categories`
--
ALTER TABLE `default_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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

-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 06, 2018 at 02:30 PM
-- Server version: 5.7.21-0ubuntu0.16.04.1
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app`
--

-- --------------------------------------------------------

--
-- Table structure for table `addons`
--

CREATE TABLE `addons` (
  `id` int(10) NOT NULL,
  `title` varchar(100) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `price` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `addons`
--

INSERT INTO `addons` (`id`, `title`, `image`, `price`) VALUES
(1, 'Extra Fruit', '', '0.49'),
(2, 'Chia Seed', '', '0.49'),
(3, 'Help Seed', '', '0.49'),
(4, 'Flax Seed', '', '0.49'),
(5, 'Whey Protein', '', '0.79'),
(6, 'Soy Protein', '', '0.79'),
(7, 'Plea Plant Protein', '', '0.79');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) NOT NULL,
  `title` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `image`) VALUES
(2, 'Smoothies', 'smoothies.jpg'),
(3, 'Demo Category', 'smoothies.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `category_addon`
--

CREATE TABLE `category_addon` (
  `id` int(10) NOT NULL,
  `category_id` int(10) NOT NULL,
  `addon_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category_addon`
--

INSERT INTO `category_addon` (`id`, `category_id`, `addon_id`) VALUES
(1, 2, 1),
(2, 2, 2),
(3, 2, 3),
(4, 2, 4),
(5, 3, 1),
(6, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `mobile_no` int(20) NOT NULL,
  `device_name` varchar(100) NOT NULL,
  `imei_no` varchar(25) NOT NULL,
  `reward_point` decimal(15,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `email`, `password`, `mobile_no`, `device_name`, `imei_no`, `reward_point`) VALUES
(35, 'mail@mail.com', '7c3607b8e61bcf1944e9e8503a660f21f4b6f3f1', 123456789, 'SAMSUNG', '123456789123456', '0.00'),
(42, 'demouser@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 123456789, 'SAMSUNG-GT-2900', '1234567890', '0.00'),
(49, 'user@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 123456789, 'SAMSUNG-GT-2900', '1234567890', '0.00'),
(60, 'user2@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 123456789, 'SAMSUNG-GT-2900', '1234567890', '0.00'),
(66, 'test1@gmail.com', '6eacb5e692b2be261bef71155d3608d6b40125ef', 123456789, 'SAMSUNG ', '987456', '0.00'),
(71, 'test2@gmail.com', '6eacb5e692b2be261bef71155d3608d6b40125ef', 123456789, 'SAMSUNG ', '987456', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(10) NOT NULL,
  `title` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `details` text NOT NULL,
  `category_id` int(10) NOT NULL,
  `sub_category_id` int(10) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `title`, `image`, `price`, `details`, `category_id`, `sub_category_id`) VALUES
(4, 'Ultimate Fruit', 'Veggie-Blends.jpg', '10.99', 'Item Details', 2, 1),
(5, 'Berry Banana', 'Banana.jpg', '5.99', 'Item Details', 2, 1),
(6, 'Tropical Sunshine', 'tropical-sunshine.jpg', '20.99', 'Item Details', 2, 1),
(7, 'BeeT IT', 'beets.jpg', '29.99', 'Item Details', 2, 2),
(8, 'Crazy For Carrots', 'carrots.jpg', '10.99', 'Item Details', 2, 2),
(9, 'Muddy Peanut Butter', 'peanut-butter.jpg', '13.99', 'Details', 2, 4),
(10, 'Mad Mango', 'mango.jpg', '15.39', 'Details', 2, 4),
(11, 'Sunny Delight', 'sunny-delight.jpg', '9.99', 'Details', 2, 3),
(12, 'Banana Split', 'Banana.jpg', '5.99', 'Details', 2, 3),
(13, 'Demo Item 1', 'Banana.jpg', '100.00', 'Demo details 1', 3, NULL),
(14, 'Demo Item 2', 'Banana.jpg', '120.00', 'Demo details 2', 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `item_recipe`
--

CREATE TABLE `item_recipe` (
  `id` int(10) NOT NULL,
  `item_id` int(10) NOT NULL,
  `recipe_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item_recipe`
--

INSERT INTO `item_recipe` (`id`, `item_id`, `recipe_id`) VALUES
(15, 4, 6),
(16, 4, 8),
(17, 4, 9),
(20, 5, 5),
(21, 5, 7),
(24, 6, 6),
(25, 6, 8),
(26, 6, 9),
(27, 6, 10),
(28, 6, 11),
(29, 7, 6),
(30, 7, 8),
(31, 7, 12),
(32, 7, 13),
(33, 7, 14),
(34, 7, 16),
(35, 8, 8),
(36, 8, 11),
(37, 8, 12),
(38, 8, 13),
(39, 8, 14),
(40, 8, 15),
(41, 9, 5),
(42, 9, 6),
(43, 9, 9),
(44, 9, 11),
(45, 9, 17),
(46, 10, 5),
(47, 10, 7),
(48, 10, 9),
(49, 10, 18),
(50, 11, 6),
(51, 11, 8),
(52, 11, 14),
(53, 11, 15),
(54, 12, 5),
(55, 12, 6),
(56, 12, 7),
(57, 12, 17),
(58, 12, 18),
(59, 13, 5),
(60, 13, 6),
(61, 14, 16),
(62, 14, 13);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `item_id` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `unit_price` decimal(15,2) NOT NULL,
  `total_price` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order_addon`
--

CREATE TABLE `order_addon` (
  `id` int(10) NOT NULL,
  `order_id` int(10) NOT NULL,
  `item_id` int(10) NOT NULL,
  `addon_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order_recipe`
--

CREATE TABLE `order_recipe` (
  `id` int(10) NOT NULL,
  `order_id` int(10) NOT NULL,
  `item_id` int(10) NOT NULL,
  `recipe_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `id` int(10) NOT NULL,
  `title` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`id`, `title`, `image`) VALUES
(5, 'milk', 'milk.jpg'),
(6, 'Banana', 'Banana.jpg'),
(7, 'Yogurt', 'yogurt.jpg'),
(8, 'Pineapple', 'pineapple.jpg'),
(9, 'Mango', 'mango.jpg'),
(10, 'Lime', 'limes.jpg'),
(11, 'Coconut Water', 'coconut-water.jpg'),
(12, 'Chia Seeds', 'chia-seeds.jpg'),
(13, 'Kale Spinach', 'kale-and-spinach.jpg'),
(14, 'Orange', 'orange.jpg'),
(15, 'Carrot', 'carrots.jpg'),
(16, 'Beets', 'beets.jpg'),
(17, 'Peanut Butter', 'peanut-butter.jpg'),
(18, 'Honey', 'Honey.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` int(10) NOT NULL,
  `title` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `category_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `title`, `image`, `category_id`) VALUES
(1, 'Classic Blends', 'smoothies.jpg', 2),
(2, 'Veggie Blends', 'dairy-free.jpg', 2),
(3, 'Kids', 'kids.jpg', 2),
(4, 'Refuel Blends', 'refuel-blends.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `enabled`) VALUES
(1, 'admin@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addons`
--
ALTER TABLE `addons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_addon`
--
ALTER TABLE `category_addon`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `addon_id` (`addon_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_sub_category_id` (`sub_category_id`),
  ADD KEY `sub_category_id` (`sub_category_id`),
  ADD KEY `FK_items_category_id` (`category_id`);

--
-- Indexes for table `item_recipe`
--
ALTER TABLE `item_recipe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_item_recipe_item_id` (`item_id`),
  ADD KEY `FK_item_recipe_recipe_id` (`recipe_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`,`item_id`),
  ADD KEY `FK_orders_customer_id` (`customer_id`),
  ADD KEY `FK_orders_item_id` (`item_id`);

--
-- Indexes for table `order_addon`
--
ALTER TABLE `order_addon`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `FK_order_addon_item_id` (`item_id`),
  ADD KEY `addon_id` (`addon_id`) USING BTREE;

--
-- Indexes for table `order_recipe`
--
ALTER TABLE `order_recipe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recipe_id` (`recipe_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `FK_order_recipe_item_id` (`item_id`);

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addons`
--
ALTER TABLE `addons`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `category_addon`
--
ALTER TABLE `category_addon`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `item_recipe`
--
ALTER TABLE `item_recipe`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT for table `order_addon`
--
ALTER TABLE `order_addon`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;
--
-- AUTO_INCREMENT for table `order_recipe`
--
ALTER TABLE `order_recipe`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;
--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `category_addon`
--
ALTER TABLE `category_addon`
  ADD CONSTRAINT `FK_category_addon_addon_id` FOREIGN KEY (`addon_id`) REFERENCES `addons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_category_addon_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `FK_items_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `fk_Sub_category_id` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item_recipe`
--
ALTER TABLE `item_recipe`
  ADD CONSTRAINT `fk_item_id` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_recipe_id` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_orders_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_orders_item_id` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_addon`
--
ALTER TABLE `order_addon`
  ADD CONSTRAINT `FK_order_addon_addon_id` FOREIGN KEY (`addon_id`) REFERENCES `addons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_order_addon_item_id` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_order_addon_order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_recipe`
--
ALTER TABLE `order_recipe`
  ADD CONSTRAINT `FK_order_recipe_item_id` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_order_recipe_order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_order_recipe_recipe_id` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `fk_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2025 at 02:48 PM
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
-- Database: `tawtaw_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `variation_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `variation_id`, `quantity`) VALUES
(8, 3, 3, 1),
(9, 3, 1, 1),
(10, 2, 1, 1),
(11, 2, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `favourates`
--

CREATE TABLE `favourates` (
  `fav_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `variation_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favourates`
--

INSERT INTO `favourates` (`fav_id`, `user_id`, `variation_id`) VALUES
(4, 3, 6),
(9, 3, 5),
(13, 3, 1),
(14, 3, 4),
(18, 3, 3),
(19, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `category` enum('Laptop','Desktop','Smartphone','SmartWatch') NOT NULL,
  `company` enum('Apple','Samsung','Dell','Asus') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `description`, `category`, `company`) VALUES
(1, 'Macbook Pro M3', 'Apple 2023 MacBook Pro with M3 chip (8-core CPU, 10-core GPU), 14.2\" Liquid Retina XDR Display, 16GB RAM, up to 22 hours of battery.', 'Laptop', 'Apple'),
(2, 'iPhone 15 Pro Max', 'Apple iPhone 15 Pro Max A17 Pro chip with 6‑core CPU and GPU: 6.7\" Super Retina XDR Display, 8GB RAM and up to 29 hours of battery.', 'Smartphone', 'Apple'),
(3, 'Apple Watch SE', 'Apple 2023 Watch SE 2nd-gen S8 SiP with 2‑core CPU: 1.7\" Retina Display, 32GB Storage and up to 18 hours of battery.', 'SmartWatch', 'Apple');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `image_id` int(10) UNSIGNED NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `variation_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`image_id`, `image_url`, `variation_id`) VALUES
(3, 'Images/Products/macbook.jpg', 3),
(4, 'Images/Products/macbookM3.png', 1),
(5, 'Images/Products/watch.jpg', 6),
(6, 'Images/Products/iphone.jpg', 5),
(7, 'Images/Products/macbook.jpg', 4),
(8, 'Images/Products/macbookM3.png', 2);

-- --------------------------------------------------------

--
-- Table structure for table `product_variation`
--

CREATE TABLE `product_variation` (
  `variation_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `color` enum('White','Black','Space Gray','Silver','Midnight Black','Aluminium','Naturel') NOT NULL,
  `storage` enum('64','128','256','512','1000','2000') NOT NULL,
  `memory` enum('2','4','6','8','16','32','64','128') NOT NULL,
  `price` decimal(10,3) NOT NULL,
  `quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_variation`
--

INSERT INTO `product_variation` (`variation_id`, `product_id`, `color`, `storage`, `memory`, `price`, `quantity`) VALUES
(1, 1, 'Space Gray', '512', '16', 6699.000, 10),
(2, 1, 'Space Gray', '1000', '16', 9619.000, 10),
(3, 1, 'Silver', '512', '16', 6699.000, 4),
(4, 1, 'Silver', '1000', '16', 9619.000, 10),
(5, 2, 'Naturel', '256', '8', 6799.000, 1),
(6, 3, 'Aluminium', '', '', 1489.000, 4),
(7, 2, 'Naturel', '512', '8', 7099.000, 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`) VALUES
(1, 'rayen.drira04@gmail.com', 'RayenDrira123*'),
(2, 'rayen.drira@gmail.com', 'DriraRayen123*'),
(3, 'admin@gmail.com', 'Admin123*');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_1` (`user_id`),
  ADD KEY `variation_1` (`variation_id`);

--
-- Indexes for table `favourates`
--
ALTER TABLE `favourates`
  ADD PRIMARY KEY (`fav_id`),
  ADD KEY `user_2` (`user_id`),
  ADD KEY `variation_2` (`variation_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `variation_3` (`variation_id`);

--
-- Indexes for table `product_variation`
--
ALTER TABLE `product_variation`
  ADD PRIMARY KEY (`variation_id`),
  ADD KEY `products_1` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `favourates`
--
ALTER TABLE `favourates`
  MODIFY `fav_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `image_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_variation`
--
ALTER TABLE `product_variation`
  MODIFY `variation_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `user_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `variation_1` FOREIGN KEY (`variation_id`) REFERENCES `product_variation` (`variation_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `favourates`
--
ALTER TABLE `favourates`
  ADD CONSTRAINT `user_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `variation_2` FOREIGN KEY (`variation_id`) REFERENCES `product_variation` (`variation_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `variation_3` FOREIGN KEY (`variation_id`) REFERENCES `product_variation` (`variation_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_variation`
--
ALTER TABLE `product_variation`
  ADD CONSTRAINT `products_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

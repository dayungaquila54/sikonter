-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 08, 2023 at 10:56 PM
-- Server version: 8.0.30
-- PHP Version: 8.0.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sikonter`
--

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `customer` int DEFAULT NULL,
  `date` date DEFAULT NULL,
  `purchase_id` bigint NOT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `type` enum('pulsa','data') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'pulsa',
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `type`, `price`) VALUES
(1, 'Telkomsel 5000', 'pulsa', 6250.00),
(2, 'Telkomsel 10000', 'pulsa', 11000.00),
(3, 'Telkomsel 20000', 'pulsa', 20500.00),
(4, 'Telkomsel 25000', 'pulsa', 27000.00),
(5, 'Telkomsel 50000', 'pulsa', 50000.00),
(6, 'Telkomsel 75000', 'pulsa', 74000.00),
(7, 'Telkomsel 100000', 'pulsa', 99500.00),
(8, 'Indosat 5000', 'pulsa', 6250.00),
(9, 'Indosat 10000', 'pulsa', 11000.00),
(10, 'Indosat 20000', 'pulsa', 20500.00),
(11, 'Indosat 25000', 'pulsa', 27000.00),
(12, 'Indosat 50000', 'pulsa', 50000.00),
(13, 'Indosat 75000', 'pulsa', 74000.00),
(14, 'Indosat 100000', 'pulsa', 99500.00),
(15, 'XL 5000', 'pulsa', 6250.00),
(16, 'XL 10000', 'pulsa', 11000.00),
(17, 'XL 20000', 'pulsa', 20500.00),
(18, 'XL 25000', 'pulsa', 27000.00),
(19, 'XL 50000', 'pulsa', 50000.00),
(20, 'XL 75000', 'pulsa', 74000.00),
(21, 'XL 100000', 'pulsa', 99500.00),
(22, 'Axis Bronet 5000', 'pulsa', 6250.00),
(23, 'Axis Bronet 10000', 'pulsa', 11000.00),
(24, 'Axis Bronet 20000', 'pulsa', 20500.00),
(25, 'Axis Bronet 25000', 'pulsa', 27000.00),
(26, 'Axis Bronet 50000', 'pulsa', 50000.00),
(27, 'Axis Bronet 75000', 'pulsa', 74000.00),
(28, 'Axis Bronet 100000', 'pulsa', 99500.00);

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` int NOT NULL,
  `users` int NOT NULL,
  `product` int DEFAULT NULL,
  `phone` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date` date DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `remember_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `surname` varchar(128) NOT NULL,
  `role` enum('admin','users') DEFAULT 'admin',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `remember_token`, `surname`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin@sikonter.com', '$2y$10$WOrbohYOOJLXio.Y9KG.zec1/kTP/Is8M6xpRj3ikMEIgvfpdro/W', '441f1ce107ec51992cad5778fb37884b0fafa6b9e5dd19dc4eaa0a162c30a358', 'System Administrator', 'admin', '2023-05-29 23:54:16', '2023-06-07 23:18:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product` (`product`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

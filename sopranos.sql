-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 9, 2021 at 11:12 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sopranos`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `phone` varchar(15) NOT NULL DEFAULT '',
  `admin` int(11) NOT NULL DEFAULT 0,
  `account_created` bigint(14) NOT NULL DEFAULT 0,
  `last_login` bigint(14) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `password`, `email`, `phone`, `admin`, `account_created`, `last_login`) VALUES
(1, 'junyi', '$2y$10$gzkmyuFldhJmEo4uQKjrMOzHNGuc3Xeb0O.LkLREvOc3Ux5JFHyaq', 'yunyi.xie@outlook.com', '0636560377', 1, 20210204111921, 20210204111921);

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

DROP TABLE IF EXISTS `branches`;
CREATE TABLE `branches` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `phone` varchar(15) NOT NULL DEFAULT '',
  `zipcode` varchar(255) NOT NULL DEFAULT '',
  `adres` varchar(255) NOT NULL DEFAULT '',
  `city` varchar(255) NOT NULL DEFAULT '',
  `country` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `name`, `email`, `phone`, `zipcode`, `adres`, `city`, `country`) VALUES
(1, 'Sopranos, The Hague', 'thehague@sopranos.nl', '', '', '', 'The Hague', 'The Netherlands'),
(2, 'Sopranos, Rotterdam', 'rotterdam@sopranos.nl', '', '', '', 'Rotterdam', 'The Netherlands'),
(3, 'Sopranos, Amsterdam', 'amsterdam@sopranos.nl', '', '', '', 'Amsterdam', 'The Netherlands'),
(4, 'Sopranos, Utrecht', 'utrecht@sopranos.nl', '', '', '', 'Utrecht', 'The Netherlands'),
(5, 'Sopranos, Gouda', 'gouda@sopranos.nl', '', '', '', 'Gouda', 'The Netherlands');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
CREATE TABLE `coupons` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL DEFAULT '',
  `discount` float(10,3) NOT NULL DEFAULT 0.000,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `valid` datetime NOT NULL,
  `expire` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `code`, `discount`, `quantity`, `valid`, `expire`) VALUES
(1, 'DISCOUNT10', 10.000, 111, '2021-02-09 00:00:00', '2021-02-28 00:00:00'),
(2, 't', 1.000, 2, '2021-02-09 12:02:50', '2021-02-15 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL DEFAULT '',
  `last_name` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `phone` varchar(15) NOT NULL DEFAULT '',
  `adres` varchar(255) NOT NULL DEFAULT '',
  `zipcode` varchar(255) NOT NULL DEFAULT '',
  `country` varchar(255) NOT NULL DEFAULT '',
  `city` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT 0,
  `coupon_id` int(11) DEFAULT 0,
  `order_number` bigint(16) NOT NULL DEFAULT 0,
  `check_in` bigint(14) NOT NULL DEFAULT 0,
  `check_out` bigint(14) NOT NULL DEFAULT 0,
  `order_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `coupon_id`, `order_number`, `check_in`, `check_out`, `order_status`) VALUES
(4, NULL, NULL, 1691298654104164, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders_pizza`
--

DROP TABLE IF EXISTS `orders_pizza`;
CREATE TABLE `orders_pizza` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT 0,
  `size_id` int(11) DEFAULT 0,
  `type_id` int(11) DEFAULT 0,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pizzas_size`
--

DROP TABLE IF EXISTS `pizzas_size`;
CREATE TABLE `pizzas_size` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `size` int(11) NOT NULL DEFAULT 0,
  `price` float(10,3) NOT NULL DEFAULT 0.000
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pizzas_size`
--

INSERT INTO `pizzas_size` (`id`, `name`, `size`, `price`) VALUES
(1, 'Small', 15, 2.500),
(2, 'Medium', 25, 4.000),
(3, 'Large', 35, 5.500),
(4, 'Calzone', 50, 8.000);

-- --------------------------------------------------------

--
-- Table structure for table `pizzas_topping`
--

DROP TABLE IF EXISTS `pizzas_topping`;
CREATE TABLE `pizzas_topping` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `quantity` int(11) NOT NULL DEFAULT 0,
  `price` float(10,3) NOT NULL DEFAULT 0.000
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pizzas_topping`
--

INSERT INTO `pizzas_topping` (`id`, `name`, `quantity`, `price`) VALUES
(1, 'Pepperoni', 150, 1.000),
(2, 'Mushrooms', 150, 0.500),
(3, 'Onions', 150, 0.500),
(4, 'Sausage', 150, 1.500),
(5, 'Bacon', 150, 1.500),
(6, 'Cheese', 150, 0.750),
(7, 'Black olives', 150, 0.500),
(8, 'Green peppers', 150, 0.500),
(9, 'Pineapple', 150, 1.000),
(10, 'Spinach', 150, 0.500);

-- --------------------------------------------------------

--
-- Table structure for table `pizzas_type`
--

DROP TABLE IF EXISTS `pizzas_type`;
CREATE TABLE `pizzas_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `quantity` int(11) NOT NULL DEFAULT 0,
  `price` float(10,3) NOT NULL DEFAULT 0.000
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pizzas_type`
--

INSERT INTO `pizzas_type` (`id`, `name`, `quantity`, `price`) VALUES
(1, 'Tonno', 100, 2.000),
(2, 'Vegetariano', 100, 2.000),
(3, 'Quattro Formaggio', 100, 3.000),
(4, 'Sopranos Deluxe', 100, 4.000);

-- --------------------------------------------------------

--
-- Table structure for table `toppings_combination`
--

DROP TABLE IF EXISTS `toppings_combination`;
CREATE TABLE `toppings_combination` (
  `id` int(11) NOT NULL,
  `pizza_id` int(11) DEFAULT 0,
  `topping_id` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coupon_id` (`coupon_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `orders_pizza`
--
ALTER TABLE `orders_pizza`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `size_id` (`size_id`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `pizzas_size`
--
ALTER TABLE `pizzas_size`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pizzas_topping`
--
ALTER TABLE `pizzas_topping`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pizzas_type`
--
ALTER TABLE `pizzas_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `toppings_combination`
--
ALTER TABLE `toppings_combination`
  ADD PRIMARY KEY (`id`),
  ADD KEY `topping_id` (`topping_id`),
  ADD KEY `pizza_id` (`pizza_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders_pizza`
--
ALTER TABLE `orders_pizza`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pizzas_size`
--
ALTER TABLE `pizzas_size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pizzas_topping`
--
ALTER TABLE `pizzas_topping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pizzas_type`
--
ALTER TABLE `pizzas_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `toppings_combination`
--
ALTER TABLE `toppings_combination`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `coupon_id` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`),
  ADD CONSTRAINT `customer_id` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Constraints for table `orders_pizza`
--
ALTER TABLE `orders_pizza`
  ADD CONSTRAINT `order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `size_id` FOREIGN KEY (`size_id`) REFERENCES `pizzas_size` (`id`),
  ADD CONSTRAINT `type_id` FOREIGN KEY (`type_id`) REFERENCES `pizzas_type` (`id`);

--
-- Constraints for table `toppings_combination`
--
ALTER TABLE `toppings_combination`
  ADD CONSTRAINT `pizza_id` FOREIGN KEY (`pizza_id`) REFERENCES `orders_pizza` (`id`),
  ADD CONSTRAINT `topping_id` FOREIGN KEY (`topping_id`) REFERENCES `pizzas_topping` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2021 at 06:40 PM
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
  `image_id` int(11) DEFAULT 0,
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

INSERT INTO `accounts` (`id`, `image_id`, `username`, `password`, `email`, `phone`, `admin`, `account_created`, `last_login`) VALUES
(1, NULL, 'junyi', '$2y$10$gzkmyuFldhJmEo4uQKjrMOzHNGuc3Xeb0O.LkLREvOc3Ux5JFHyaq', 'yunyi.xie@outlook.com', '0636560377', 1, 20210204111921, 20210204111921);

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
  `country` varchar(255) NOT NULL DEFAULT '',
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `name`, `email`, `phone`, `zipcode`, `adres`, `city`, `country`, `status`) VALUES
(1, 'Sopranos Pizzabar', 'denhaag@sopranos.nl', '', '', '', 'The Hague', 'The Netherlands', 1),
(2, 'Sopranos Pizzabar', 'rotterdam@sopranos.nl', '', '', '', 'Rotterdam', 'The Netherlands', 0),
(3, 'Sopranos Pizzabar', 'amsterdam@sopranos.nl', '', '', '', 'Amsterdam', 'The Netherlands', 0),
(4, 'Sopranos Pizzabar', 'utrecht@sopranos.nl', '', '', '', 'Utrecht', 'The Netherlands', 0),
(5, 'Sopranos Pizzabar', 'gouda@sopranos.nl', '', '', '', 'Gouda', 'The Netherlands', 0);

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
CREATE TABLE `coupons` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL DEFAULT '',
  `discount` int(11) NOT NULL DEFAULT 0,
  `type` int(11) NOT NULL DEFAULT 0,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `valid` bigint(14) NOT NULL DEFAULT 0,
  `expire` bigint(14) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `code`, `discount`, `type`, `quantity`, `valid`, `expire`) VALUES
(1, 'DISCOUNT10', 10, 1, 87, 20210209000000, 20210525000000),
(2, 'FREE30', 30, 1, 4, 20210209120250, 20210407000000);

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
  `address` varchar(255) NOT NULL DEFAULT '',
  `address_2` varchar(255) NOT NULL DEFAULT '',
  `zipcode` varchar(255) NOT NULL DEFAULT '',
  `country` varchar(255) NOT NULL DEFAULT '',
  `city` varchar(255) NOT NULL DEFAULT '',
  `province` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `link` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `link`) VALUES
(1, 'pizza-quattro-formaggio.png'),
(2, 'pizza-tonno.png'),
(3, 'pizza-vegetariano.png'),
(4, 'pizza-sopranos-deluxe.png'),
(5, 'pizza-pepperoni.png');

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
  `size` varchar(255) NOT NULL DEFAULT '',
  `price` float(10,3) NOT NULL DEFAULT 0.000
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pizzas_size`
--

INSERT INTO `pizzas_size` (`id`, `name`, `size`, `price`) VALUES
(1, 'Small', 'S', 1.250),
(2, 'Medium', 'M', 2.500),
(3, 'Large', 'L', 3.750),
(4, 'Calzone', 'XL', 5.000);

-- --------------------------------------------------------

--
-- Table structure for table `pizzas_topping`
--

DROP TABLE IF EXISTS `pizzas_topping`;
CREATE TABLE `pizzas_topping` (
  `id` int(11) NOT NULL,
  `image_id` int(11) DEFAULT 0,
  `name` varchar(255) NOT NULL DEFAULT '',
  `quantity` int(11) NOT NULL DEFAULT 0,
  `price` float(10,3) NOT NULL DEFAULT 0.000
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pizzas_topping`
--

INSERT INTO `pizzas_topping` (`id`, `image_id`, `name`, `quantity`, `price`) VALUES
(1, NULL, 'Pepperoni', 116, 1.000),
(2, NULL, 'Mushrooms', 120, 0.500),
(3, NULL, 'Onions', 138, 0.500),
(4, NULL, 'Sausage', 132, 1.500),
(5, NULL, 'Bacon', 132, 1.500),
(6, NULL, 'Cheese', 134, 0.750),
(7, NULL, 'Black olives', 136, 0.500),
(8, NULL, 'Green peppers', 136, 0.500),
(9, NULL, 'Pineapple', 130, 1.000),
(10, NULL, 'Spinach', 132, 0.500);

-- --------------------------------------------------------

--
-- Table structure for table `pizzas_type`
--

DROP TABLE IF EXISTS `pizzas_type`;
CREATE TABLE `pizzas_type` (
  `id` int(11) NOT NULL,
  `image_id` int(11) DEFAULT 0,
  `name` varchar(255) NOT NULL DEFAULT '',
  `quantity` int(11) NOT NULL DEFAULT 0,
  `price` float(10,3) NOT NULL DEFAULT 0.000
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pizzas_type`
--

INSERT INTO `pizzas_type` (`id`, `image_id`, `name`, `quantity`, `price`) VALUES
(1, 2, 'Tonno', 66, 2.150),
(2, 3, 'Vegetariano', 94, 3.450),
(3, 1, 'Quattro Formaggio', 100, 3.750),
(4, 4, 'Sopranos Deluxe', 90, 4.300),
(5, 5, 'Pepperoni', 34, 1.250);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `imagess_id` (`image_id`);

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
-- Indexes for table `images`
--
ALTER TABLE `images`
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
  ADD PRIMARY KEY (`id`),
  ADD KEY `images_id` (`image_id`);

--
-- Indexes for table `pizzas_type`
--
ALTER TABLE `pizzas_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `image_id` (`image_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `orders_pizza`
--
ALTER TABLE `orders_pizza`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `toppings_combination`
--
ALTER TABLE `toppings_combination`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `imagess_id` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`);

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
-- Constraints for table `pizzas_topping`
--
ALTER TABLE `pizzas_topping`
  ADD CONSTRAINT `images_id` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`);

--
-- Constraints for table `pizzas_type`
--
ALTER TABLE `pizzas_type`
  ADD CONSTRAINT `image_id` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`);

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

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2023 at 09:40 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brand_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand_id`, `name`) VALUES
(1, 'nvidia'),
(2, 'amd');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `product_id` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`, `status`) VALUES
(210, 12, 2658451, 3, 'y'),
(211, 12, 2154861, 4, 'y'),
(212, 12, 1584652, 3, 'y'),
(213, 12, 433321, 4, 'y'),
(214, 12, 3521486, 2, 'y');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `payment` varchar(50) NOT NULL COMMENT 'การจัดส่ง',
  `address` varchar(500) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `total_quantity` int(100) NOT NULL COMMENT 'จำนวนสินค้าทั้งหมด',
  `total_price` int(100) NOT NULL COMMENT 'จำนวนเงินทั้งหมด',
  `placed_on` varchar(50) NOT NULL COMMENT 'เวลาที่กดสั่งซื้อ',
  `payment_status` varchar(20) NOT NULL COMMENT 'สถานะออเดอร์',
  `shipment_date` varchar(50) NOT NULL COMMENT 'เวลาในการจัดส่ง',
  `received_date` varchar(50) NOT NULL COMMENT 'เวลารับสินค้า',
  `payment_date` varchar(50) NOT NULL COMMENT 'เวลาชำระเงิน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `payment`, `address`, `product_name`, `total_quantity`, `total_price`, `placed_on`, `payment_status`, `shipment_date`, `received_date`, `payment_date`) VALUES
(92, 12, 'user1', '0813996507', 'user1@gmail.com', 'athome', '123 m.5 utcc 10955 54545', '', 16, 193535, '05/01/2023 03:21:59', 'wadmin', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(50) NOT NULL,
  `brand_id` int(100) NOT NULL,
  `product_id` int(100) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `brand_id`, `product_id`, `product_name`, `price`, `quantity`, `image`) VALUES
(33, 2, 1584652, 'RX 5700 GAMING OC 8G', 12345, 2, '5f8d08beNfebdc893.jpg!q70.jpg'),
(34, 2, 2658451, 'AMD VGA RADEON PRO WX3100 4GB GDDR5', 3900, -117, '74899729_4f3090a5-31b2-4d24-b16c-4edfeb57280e_740_740.jpg'),
(37, 1, 2154861, '1660 TI GALAX 6GB GDDR6 1-CLICK OC', 4000, -179, '320017707_457022703249852_8933327337149200650_n (1).jpg'),
(39, 1, 3521486, 'RTX 3090\r\n', 50000, 1, 'ebfc2704-5a06-4b50-b674-b014ae7814e1.jpg'),
(42, 1, 433321, 'GIGABYTE RTX 3060 EAGLE 12GB', 7200, -3, '1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `number`, `email`, `password`, `address`, `user_type`) VALUES
(11, 'admin', '12345', 'admin@gmail.com', '202cb962ac59075b964b07152d234b70', '9555 m.2 saimai Bangkok 10220', 'admin'),
(12, 'user1', '0813996507', 'user1@gmail.com', '202cb962ac59075b964b07152d234b70', '123 m.5 utcc 10955 54545', 'user'),
(13, 'admin2', '231', 'admin2@gmail.com', '202cb962ac59075b964b07152d234b70', '34534 m.5 bangna 10545', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

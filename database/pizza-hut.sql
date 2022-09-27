-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2021 at 10:31 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pizza-hut`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(26, 'username', 'user', '202cb962ac59075b964b07152d234b70'),
(27, 'uday', 'akash', '827ccb0eea8a706c4c34a16891f84e7b'),
(30, '123', '123', '202cb962ac59075b964b07152d234b70'),
(32, 'administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(33, 'mahesh', 'mahesh', '49bb197bec17b7d20b2df6b1f3c3434a');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(9, 'Pizza', 'Food_Category_607.jpg', 'Yes', 'Yes'),
(10, 'Deserts', 'Food_Category_516.jpg', 'Yes', 'Yes'),
(13, 'Bevarages', 'Food_Category_885.jpg', 'No', 'Yes'),
(14, 'Ice Creams', 'Food_Category_863.jpg', 'Yes', 'Yes'),
(15, 'Burgers', 'Food_Category_538.jpg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

CREATE TABLE `tbl_food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(14, 'veggie pizza', 'super pizza with vegetables', '500.00', 'Food-Name-1699.jpg', 9, 'Yes', 'Yes'),
(15, 'Golden Chicken Pizza', 'Delicious Marinated Chicken Pieces', '450.00', 'Food-Name-877.jpg', 9, 'Yes', 'Yes'),
(16, 'Charcoal IceCream', 'Beautiful taste icecream', '60.00', 'Food-Name-251.jpg', 14, 'No', 'Yes'),
(17, 'Orea IceCream', 'oreo', '90.00', 'Food-Name-4162.jpg', 14, 'Yes', 'Yes'),
(18, 'Burger Single Patie', 'best sause patie', '80.00', 'Food-Name-1307.jpg', 15, 'No', 'Yes'),
(19, 'Burger Double Patie', 'Enjoy Double Double', '150.00', 'Food-Name-9960.jpg', 15, 'Yes', 'Yes'),
(20, 'Delux Viggee', 'Super vegetables', '350.00', 'Food-Name-630.jpg', 9, 'No', 'Yes'),
(25, 'Cheese Cake', 'Delicious Smooth Cheese Cake', '180.00', 'Food-Name-984.jpg', 10, 'Yes', 'Yes'),
(26, 'Chocolate Donut', 'Hot Donut with rich chocolate inside', '200.00', 'Food-Name-597.jpg', 10, 'Yes', 'Yes'),
(27, 'Cup Cake', 'Soft and creamy cake in a cup', '80.00', 'Food-Name-173.jpg', 10, 'Yes', 'Yes'),
(29, 'Strawberry Smoothe', 'smoothe delicious taste', '150.00', 'Food-Name-687.jpg', 13, 'Yes', 'Yes'),
(30, 'Coke ', 'Diet Coke', '100.00', 'Food-Name-973.jpg', 13, 'Yes', 'Yes'),
(31, 'Fruit Juice', 'Fresh Fruit juice ', '100.00', 'Food-Name-583.jpg', 13, 'Yes', 'Yes'),
(32, 'Chocolate Smoothe', 'Delicious Smoothe with swizz chocolate', '100.00', 'Food-Name-964.jpg', 13, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `food` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

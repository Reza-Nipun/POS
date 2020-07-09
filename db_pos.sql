-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2018 at 09:54 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_brand`
--

CREATE TABLE `tb_brand` (
  `id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `brand_description` varchar(255) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1=Active, 0=Inactive',
  `create_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `update_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_brand`
--

INSERT INTO `tb_brand` (`id`, `brand_name`, `brand_description`, `status`, `create_date`, `created_by`, `update_date`, `updated_by`) VALUES
(1, 'CK', 'CK', 1, '0000-00-00 00:00:00', 0, '2018-05-04 11:26:22', 1),
(2, 'G-Star', 'G-Star', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_category`
--

CREATE TABLE `tb_category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_description` varchar(255) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1=Active, 0=Inactive',
  `create_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `update_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_category`
--

INSERT INTO `tb_category` (`id`, `category_name`, `category_description`, `status`, `create_date`, `created_by`, `update_date`, `updated_by`) VALUES
(1, 'Men', 'Men', 1, '0000-00-00 00:00:00', 0, '2018-05-04 11:26:33', 1),
(2, 'Women', 'Women', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_item`
--

CREATE TABLE `tb_item` (
  `id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_description` varchar(255) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1=Active, 0=Inactive',
  `create_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `update_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_item`
--

INSERT INTO `tb_item` (`id`, `item_name`, `item_description`, `status`, `create_date`, `created_by`, `update_date`, `updated_by`) VALUES
(1, 'Shirt', 'Shirt', 1, '0000-00-00 00:00:00', 0, '2018-05-04 11:26:47', 1),
(2, 'Pant', 'Pant', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_product`
--

CREATE TABLE `tb_product` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `purchase_date` date NOT NULL,
  `purchase_price` double NOT NULL,
  `sale_price` double NOT NULL,
  `picture_url` varchar(255) NOT NULL,
  `is_sold_out` int(11) NOT NULL COMMENT '1=true, 0=false',
  `status` int(11) NOT NULL COMMENT '1=Active and 0=Inactive',
  `create_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `update_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `sale_date_time` datetime NOT NULL,
  `sold_by` int(11) NOT NULL,
  `sold_by_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_product`
--

INSERT INTO `tb_product` (`id`, `invoice_id`, `product_code`, `brand_id`, `category_id`, `item_id`, `size_id`, `purchase_date`, `purchase_price`, `sale_price`, `picture_url`, `is_sold_out`, `status`, `create_date`, `created_by`, `update_date`, `updated_by`, `sale_date_time`, `sold_by`, `sold_by_user_id`) VALUES
(1, 1, '000000001.', 1, 1, 1, 1, '2018-05-05', 500, 900, '', 0, 1, '2018-05-06 08:55:05', 1, '0000-00-00 00:00:00', 0, '2018-05-10 10:37:02', 0, 1),
(2, 0, '000000002.', 1, 1, 1, 1, '2018-05-05', 500, 900, '', 0, 1, '2018-05-06 08:55:05', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0),
(3, 0, '000000003.', 1, 1, 1, 1, '2018-05-05', 500, 900, '', 0, 1, '2018-05-06 08:55:05', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0),
(4, 2, '000000004.', 1, 1, 1, 1, '2018-05-05', 500, 900, '', 0, 1, '2018-05-06 08:55:05', 1, '0000-00-00 00:00:00', 0, '2018-05-10 10:37:38', 0, 1),
(5, 2, '000000005.', 1, 1, 1, 1, '2018-05-05', 500, 900, '', 0, 1, '2018-05-06 08:55:05', 1, '0000-00-00 00:00:00', 0, '2018-05-10 10:37:38', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_sale_detail`
--

CREATE TABLE `tb_sale_detail` (
  `id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_code` int(11) NOT NULL,
  `product_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_sale_product`
--

CREATE TABLE `tb_sale_product` (
  `id` int(11) NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `total_price` double NOT NULL,
  `discount_percentage` double NOT NULL,
  `net_price` double NOT NULL,
  `sale_date_time` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `sold_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_sale_product`
--

INSERT INTO `tb_sale_product` (`id`, `invoice_no`, `total_price`, `discount_percentage`, `net_price`, `sale_date_time`, `user_id`, `sold_by`) VALUES
(1, '201805101', 900, 0, 900, '2018-05-10 10:37:02', 1, 0),
(2, '201805102', 1800, 10, 1620, '2018-05-10 10:37:38', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_size`
--

CREATE TABLE `tb_size` (
  `id` int(11) NOT NULL,
  `size` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_size`
--

INSERT INTO `tb_size` (`id`, `size`) VALUES
(1, 'S'),
(2, 'M'),
(3, 'L'),
(4, 'XL'),
(5, 'XXL'),
(6, '28'),
(7, '29'),
(8, '30'),
(9, '31'),
(10, '32'),
(11, '33'),
(12, '34'),
(13, '35'),
(14, '36'),
(15, '37'),
(16, '38'),
(17, '39'),
(18, '40');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `access_level` int(11) NOT NULL COMMENT '1=super_admin, 2=users',
  `status` int(11) NOT NULL COMMENT '1=Active, 0=Inactive',
  `create_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `update_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `user_name`, `user_password`, `email`, `address`, `phone`, `mobile`, `access_level`, `status`, `create_date`, `created_by`, `update_date`, `updated_by`) VALUES
(1, 'super_admin', '123456', 'nipunsarker56@gmail.com', 'Dhaka', '029814083', '01727135231', 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(2, 'user_1', '123456', 'user_1@gmail.com', 'H#2, R#2, Sec#2, Uttara, Dhaka', '028111234', '01721111111', 2, 1, '0000-00-00 00:00:00', 0, '2018-05-04 11:22:35', 1),
(3, 'user_2', '1234567', 'user_2@gmail.com', 'Uttara dhaka', '', '01722222222', 2, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(4, 'user_3', '123456', 'user_3@gmail.com', 'H#1, R#1, Sec#1, Uttara, Dhaka', '029801234', '01727135231', 2, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(5, 'super_admin_2', '123456', 'nipunsarker56@gmail.com', 'Dhaka', '029814083', '01727135231', 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_brand`
--
ALTER TABLE `tb_brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_category`
--
ALTER TABLE `tb_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_item`
--
ALTER TABLE `tb_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_product`
--
ALTER TABLE `tb_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_sale_detail`
--
ALTER TABLE `tb_sale_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_sale_product`
--
ALTER TABLE `tb_sale_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_size`
--
ALTER TABLE `tb_size`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_brand`
--
ALTER TABLE `tb_brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_category`
--
ALTER TABLE `tb_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_item`
--
ALTER TABLE `tb_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_product`
--
ALTER TABLE `tb_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_sale_detail`
--
ALTER TABLE `tb_sale_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_sale_product`
--
ALTER TABLE `tb_sale_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_size`
--
ALTER TABLE `tb_size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

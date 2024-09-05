-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2022 at 04:16 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopzrwc_drgupta`
--

-- --------------------------------------------------------

--
-- Table structure for table `clinics`
--

CREATE TABLE `clinics` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `state` int(11) NOT NULL,
  `city` int(11) NOT NULL,
  `pincode` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `landmark` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `banner` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `contact` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `alternet_contact` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `active` int(11) NOT NULL,
  `is_deleted` enum('DELETED','NOT_DELETED','','') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'NOT_DELETED',
  `added` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clinic_timings`
--

CREATE TABLE `clinic_timings` (
  `id` int(11) NOT NULL,
  `open` time NOT NULL,
  `close` time NOT NULL,
  `day` varchar(5) COLLATE utf8_unicode_ci NOT NULL COMMENT 'sun,mon,tue,wed,thu,fri,sat,sun',
  `added` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `age` int(11) NOT NULL,
  `photo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `city` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `pincode` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `marital_status` int(11) NOT NULL COMMENT '1=married 2=unmarried',
  `active` int(11) NOT NULL,
  `is_deleted` enum('DELETED','NOT_DELETED','','') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'NOT_DELETED',
  `added` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products_category`
--

CREATE TABLE `products_category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `icon` varchar(200) DEFAULT 'default.png' COMMENT 'icon will be store using base 64',
  `order` int(11) NOT NULL,
  `is_parent` int(11) NOT NULL DEFAULT 0,
  `added` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL,
  `shop_category_id` int(11) NOT NULL DEFAULT 1,
  `tax_id` int(11) DEFAULT 0,
  `tax_value` decimal(10,2) DEFAULT 0.00,
  `active` int(11) NOT NULL DEFAULT 1,
  `is_deleted` enum('NOT_DELETED','DELETED') NOT NULL DEFAULT 'NOT_DELETED',
  `seq` int(11) NOT NULL DEFAULT 0,
  `thumbnail` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products_category`
--

INSERT INTO `products_category` (`id`, `name`, `description`, `icon`, `order`, `is_parent`, `added`, `updated`, `shop_category_id`, `tax_id`, `tax_value`, `active`, `is_deleted`, `seq`, `thumbnail`) VALUES
(1, 'test', 'test', 'default.png', 0, 0, '2022-12-13 16:21:36', NULL, 1, 0, '0.00', 1, 'NOT_DELETED', 0, 'thumbnail/374c731b7ba9df272b2c3c6927635ceb.jpg'),
(2, 'test 2', 'test 2', 'default.png', 0, 1, '2022-12-13 16:27:23', NULL, 1, 0, '0.00', 1, 'NOT_DELETED', 0, 'thumbnail/4a7551a497cbc8024d90bc53972e9c2e.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `products_photo`
--

CREATE TABLE `products_photo` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL COMMENT 'link with products_subcategory',
  `img` varchar(100) NOT NULL,
  `is_cover` int(11) NOT NULL DEFAULT 0 COMMENT '0 or 1',
  `added` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `seq` int(11) NOT NULL DEFAULT 0,
  `thumbnail` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products_subcategory`
--

CREATE TABLE `products_subcategory` (
  `id` int(11) NOT NULL,
  `product_code` varchar(11) DEFAULT NULL,
  `parent_cat_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `unit_type` varchar(30) NOT NULL COMMENT 'comes from unit master',
  `unit_type_id` int(11) NOT NULL,
  `unit_value` varchar(50) NOT NULL COMMENT '3 pieces or 2 kg',
  `description` longtext DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated` datetime DEFAULT NULL,
  `search_keywords` varchar(100) DEFAULT NULL,
  `rating` varchar(5) DEFAULT '4.2',
  `is_deleted` enum('NOT_DELETED','DELETED') NOT NULL DEFAULT 'NOT_DELETED',
  `is_cod` int(11) NOT NULL DEFAULT 1,
  `is_cancellation` int(11) NOT NULL DEFAULT 1,
  `is_featured` int(11) NOT NULL DEFAULT 0,
  `delivery_period` varchar(50) NOT NULL DEFAULT '3-7 Days',
  `cancellation_content` text DEFAULT NULL,
  `tax_id` int(11) DEFAULT NULL,
  `tax_value` decimal(10,2) NOT NULL DEFAULT 0.00,
  `application` varchar(100) DEFAULT NULL,
  `sku` varchar(10) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `sub_cat_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shops_inventory`
--

CREATE TABLE `shops_inventory` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL COMMENT 'linked from products subcategory',
  `qty` int(11) NOT NULL,
  `purchase_rate` decimal(10,2) NOT NULL DEFAULT 0.00,
  `is_igst` int(11) NOT NULL DEFAULT 0,
  `tax_value` varchar(5) DEFAULT NULL,
  `total_value` decimal(10,2) DEFAULT 0.00,
  `total_tax` decimal(10,2) DEFAULT 0.00,
  `vendor_id` int(11) DEFAULT NULL,
  `mrp` decimal(10,2) DEFAULT 0.00,
  `selling_rate` decimal(10,2) NOT NULL DEFAULT 0.00,
  `shop_id` int(11) NOT NULL COMMENT 'linked from shops',
  `status` int(11) NOT NULL DEFAULT 1,
  `is_deleted` enum('NOT_DELETED','DELETED') NOT NULL DEFAULT 'NOT_DELETED',
  `mfg_date` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `invoice_no` varchar(100) DEFAULT NULL,
  `invoice_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shop_inventory_logs`
--

CREATE TABLE `shop_inventory_logs` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `purchase_rate` decimal(10,2) DEFAULT 0.00,
  `is_igst` int(11) NOT NULL DEFAULT 0,
  `tax_value` varchar(5) DEFAULT NULL,
  `total_value` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_tax` decimal(10,2) NOT NULL DEFAULT 0.00,
  `vendor_id` int(11) DEFAULT NULL,
  `invoice_no` varchar(50) DEFAULT NULL,
  `selling_rate` decimal(10,2) DEFAULT 0.00,
  `mrp` decimal(10,2) NOT NULL DEFAULT 0.00,
  `shop_id` int(11) DEFAULT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `action` varchar(100) DEFAULT NULL,
  `shops_inventory_id` int(11) DEFAULT NULL,
  `invoice_date` date DEFAULT NULL,
  `mfg_date` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `photo` varchar(250) NOT NULL DEFAULT 'user.pug',
  `username` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `user_role` int(11) NOT NULL,
  `password` text DEFAULT NULL,
  `added` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id`, `name`, `email`, `photo`, `username`, `status`, `user_role`, `password`, `added`, `updated`) VALUES
(1, 'Admin', 'admin@gmail.com', 'user.pug', 'admin', 1, 1, '1234', '2020-10-15 08:36:59', '2020-10-15 08:36:59'),
(2, 'Ankit Verma', 'ankit@gmail.com', 'users/6549ecf166ad0c3b10ed15bb04d866f8.jpg', 'dev', 1, 2, '1234', '2020-11-01 07:00:31', '2020-11-01 07:00:31'),
(3, 'Test', 'test@gmai.com', 'user.pug', 'test', 1, 3, '1234', '2020-11-29 14:20:27', '2020-11-29 14:20:27'),
(4, 'Naveen pal', 'palnaveen890@gmail.com', 'user.pug', 'palnaveen', 1, 4, '123456', '2022-02-13 05:42:03', '2022-02-13 05:42:03'),
(5, 'dev', 'baghelmahesh789@gmail.com', 'user.pug', 'workstaystylish', 0, 1, '123456', '2022-02-13 05:48:20', '2022-02-13 05:48:20');

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin_menu`
--

CREATE TABLE `tb_admin_menu` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `url` varchar(255) NOT NULL,
  `icon_class` varchar(200) DEFAULT NULL,
  `parent` varchar(10) NOT NULL DEFAULT '0',
  `status` varchar(1) NOT NULL DEFAULT '1',
  `indexing` int(11) NOT NULL DEFAULT 0,
  `add_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `add_by` int(11) DEFAULT NULL,
  `update_on` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `update_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_admin_menu`
--

INSERT INTO `tb_admin_menu` (`id`, `title`, `url`, `icon_class`, `parent`, `status`, `indexing`, `add_on`, `add_by`, `update_on`, `update_by`) VALUES
(1, 'User Management', '', 'ft-user', '', '1', 5, '2020-06-12 20:49:15', NULL, '2021-06-18 10:58:24', NULL),
(2, 'Manage Admin Menu', 'users/admin_menu', 'ft-grid', '1', '1', 1, '2020-06-10 18:48:59', NULL, '2021-06-13 09:24:02', NULL),
(3, 'Users', 'users/user', 'ft-users', '1', '1', 2, '2020-06-12 20:49:34', NULL, '2022-02-11 06:44:23', NULL),
(4, 'Users Role', 'users/user_role', 'ft-user-check', '1', '1', 3, '2020-06-12 20:50:07', NULL, '2021-06-19 05:24:28', NULL),
(5, 'Company Profile', 'manage/manage_company_profile', 'ft-settings', '', '1', 6, '2020-06-25 18:58:33', NULL, '2021-06-13 09:23:47', NULL),
(7, 'Masters', 'masters', 'la la-life-saver', '', '1', 2, '2020-06-25 18:58:33', NULL, '2021-06-13 09:23:05', NULL),
(29, 'Plan Master', 'plan-master', '', '7', '1', 0, '2022-11-10 18:10:44', NULL, '2022-11-10 18:18:26', NULL),
(33, 'App Users', 'app-user', '', '', '1', 0, '2022-11-12 05:15:49', NULL, NULL, NULL),
(37, 'Category', 'category', '', '7', '1', 0, '2022-12-11 01:03:20', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_role_menus`
--

CREATE TABLE `tb_role_menus` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `add` int(11) NOT NULL DEFAULT 1 COMMENT 'permissions',
  `update` int(11) NOT NULL DEFAULT 1 COMMENT 'permissions',
  `delete` int(11) NOT NULL DEFAULT 1 COMMENT 'permissions'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_role_menus`
--

INSERT INTO `tb_role_menus` (`id`, `role_id`, `menu_id`, `add`, `update`, `delete`) VALUES
(34, 2, 2, 1, 0, 1),
(35, 2, 3, 1, 0, 1),
(36, 2, 6, 1, 0, 1),
(49, 2, 20, 1, 1, 1),
(59, 1, 20, 1, 1, 1),
(63, 1, 18, 1, 1, 1),
(64, 1, 1, 1, 1, 1),
(65, 1, 5, 1, 1, 1),
(66, 4, 6, 1, 1, 1),
(69, 4, 21, 1, 1, 1),
(70, 4, 22, 1, 1, 1),
(71, 4, 23, 1, 1, 1),
(72, 4, 25, 1, 1, 1),
(73, 5, 25, 1, 1, 1),
(74, 1, 25, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user_role`
--

CREATE TABLE `tb_user_role` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `added` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp(),
  `description` varchar(245) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_user_role`
--

INSERT INTO `tb_user_role` (`id`, `name`, `added`, `updated`, `description`, `status`) VALUES
(1, 'Super Admin', '2020-07-19 06:41:11', '2021-03-16 06:41:11', 'Administrator for admin panel', 1),
(2, 'developer', '2021-03-16 18:30:43', '2021-03-16 18:30:43', 'Only for developer', 1),
(4, 'Host', '2021-06-19 23:09:32', '2021-06-19 23:09:32', 'Host\r\n', 1),
(5, 'Manager', '2022-02-13 05:39:50', '2022-02-13 05:39:50', 'manager', 1),
(6, 'Care Taker', '2022-02-13 11:53:36', '2022-02-13 11:53:36', 'Care Taker', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clinics`
--
ALTER TABLE `clinics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clinic_timings`
--
ALTER TABLE `clinic_timings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_category`
--
ALTER TABLE `products_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_photo`
--
ALTER TABLE `products_photo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `p1` (`item_id`);

--
-- Indexes for table `products_subcategory`
--
ALTER TABLE `products_subcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shops_inventory`
--
ALTER TABLE `shops_inventory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `s4` (`shop_id`);

--
-- Indexes for table `shop_inventory_logs`
--
ALTER TABLE `shop_inventory_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_admin_menu`
--
ALTER TABLE `tb_admin_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_role_menus`
--
ALTER TABLE `tb_role_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user_role`
--
ALTER TABLE `tb_user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clinics`
--
ALTER TABLE `clinics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clinic_timings`
--
ALTER TABLE `clinic_timings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products_category`
--
ALTER TABLE `products_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products_photo`
--
ALTER TABLE `products_photo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products_subcategory`
--
ALTER TABLE `products_subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shops_inventory`
--
ALTER TABLE `shops_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shop_inventory_logs`
--
ALTER TABLE `shop_inventory_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_admin_menu`
--
ALTER TABLE `tb_admin_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tb_role_menus`
--
ALTER TABLE `tb_role_menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `tb_user_role`
--
ALTER TABLE `tb_user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products_photo`
--
ALTER TABLE `products_photo`
  ADD CONSTRAINT `p1` FOREIGN KEY (`item_id`) REFERENCES `products_subcategory` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

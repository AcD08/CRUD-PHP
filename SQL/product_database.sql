-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2021 at 08:59 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `product_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `master_product`
--

CREATE TABLE `master_product` (
  `id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `mapping_product_tag` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`mapping_product_tag`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_product`
--

INSERT INTO `master_product` (`id`, `product_name`, `unit_id`, `tag_id`, `photo`, `user_id`, `mapping_product_tag`) VALUES
(12, 'tes', 2, 1, '60f5179a0a1bf.jpg', 6, '[\"1\",\"2\"]'),
(13, 'as', 1, 1, '60f5217573c0e.jpg', 6, '[\"1\",\"2\"]');

-- --------------------------------------------------------

--
-- Table structure for table `master_product_tag`
--

CREATE TABLE `master_product_tag` (
  `tag_id` int(11) NOT NULL,
  `product_tag_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_product_tag`
--

INSERT INTO `master_product_tag` (`tag_id`, `product_tag_name`) VALUES
(1, 'Smartphone'),
(2, 'Laptop');

-- --------------------------------------------------------

--
-- Table structure for table `master_unit`
--

CREATE TABLE `master_unit` (
  `unit_id` int(11) NOT NULL,
  `unit_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_unit`
--

INSERT INTO `master_unit` (`unit_id`, `unit_name`) VALUES
(1, 'Asus'),
(2, 'Hewlett-Packard'),
(3, 'Xiaomi'),
(4, 'Acer'),
(5, 'Samsung');

-- --------------------------------------------------------

--
-- Table structure for table `master_users`
--

CREATE TABLE `master_users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_users`
--

INSERT INTO `master_users` (`user_id`, `username`, `password`) VALUES
(3, 'admin', '$2y$10$gbUu63hWtVMDpFHQThMvJuhuapFvh.b2aPQ0DR5sOKe'),
(4, 'axel', '$2y$10$FIgI4osAh.iApuTIe.5F8.yMrPGMvB8tkGFNJzhCas1'),
(5, 'admin2', '$2y$10$JAKNEtU2PXB0gZ67kuX1oOvCnrRUa4U7wPN/GNp6Cbn'),
(6, 'admin3', '$2y$10$FRcI8yC00I6yTGK.my6bNOgdt8rtcsR3UpEvy9v.xlOFbZtDBpj0y');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `master_product`
--
ALTER TABLE `master_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `unit_id` (`unit_id`),
  ADD KEY `tag_id` (`tag_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `master_product_tag`
--
ALTER TABLE `master_product_tag`
  ADD PRIMARY KEY (`tag_id`);

--
-- Indexes for table `master_unit`
--
ALTER TABLE `master_unit`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indexes for table `master_users`
--
ALTER TABLE `master_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `master_product`
--
ALTER TABLE `master_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `master_product_tag`
--
ALTER TABLE `master_product_tag`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `master_unit`
--
ALTER TABLE `master_unit`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `master_users`
--
ALTER TABLE `master_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `master_product`
--
ALTER TABLE `master_product`
  ADD CONSTRAINT `master_product_ibfk_1` FOREIGN KEY (`unit_id`) REFERENCES `master_unit` (`unit_id`),
  ADD CONSTRAINT `master_product_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `master_product_tag` (`tag_id`),
  ADD CONSTRAINT `master_product_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `master_users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

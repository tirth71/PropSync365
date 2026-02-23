-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2025 at 01:38 PM
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
-- Database: `newproperty365_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `payment_id` varchar(100) NOT NULL,
  `property_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_type` varchar(10) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `email`, `Password`) VALUES
(1, 'tirth@gmail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contact`
--

CREATE TABLE `tbl_contact` (
  `contact_id` int(11) NOT NULL,
  `contact_name` text NOT NULL,
  `contact_email` text NOT NULL,
  `contact_phone` int(11) NOT NULL,
  `contact_message` text NOT NULL,
  `contact_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_contact`
--

INSERT INTO `tbl_contact` (`contact_id`, `contact_name`, `contact_email`, `contact_phone`, `contact_message`, `contact_date`) VALUES
(3, 'harsh', 'h@gmail.com', 2147483647, 'give me property details', '2024-12-15');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE `tbl_payment` (
  `payment_id` int(11) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `amount` int(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_payment`
--

INSERT INTO `tbl_payment` (`payment_id`, `transaction_id`, `first_name`, `last_name`, `amount`, `user_id`, `property_id`, `created_at`) VALUES
(66, 'pay_QNGpKTp2jRN4Wd', 'Gd', 'Fh', 10000, 41, 144, '2025-04-25 13:15:50'),
(67, 'pay_QNGsVjnKfqqDOZ', 'Uy', 'J', 10000, 41, 147, '2025-04-25 13:18:50'),
(68, 'pay_QNGy22uWtMsId7', 'Yjfyj', 'Ig', 10000, 41, 147, '2025-04-25 13:24:03'),
(69, 'pay_QNGzGwxZ7ToNOu', 'Hjf', 'Kjgu', 13500, 41, 146, '2025-04-25 13:25:13');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_property`
--

CREATE TABLE `tbl_property` (
  `property_id` int(11) NOT NULL,
  `property_name` text NOT NULL,
  `property_type` text NOT NULL,
  `property_address` text NOT NULL,
  `property_sqfeet` text DEFAULT NULL,
  `property_price` int(100) NOT NULL,
  `property_image` text NOT NULL,
  `property_description` text DEFAULT NULL,
  `property_totalbeds` int(11) NOT NULL,
  `property_totalbaths` int(11) NOT NULL,
  `property_state` text DEFAULT NULL,
  `property_city` text DEFAULT NULL,
  `property_status` int(11) NOT NULL COMMENT '0=rent 1=sell',
  `deposite` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `live_status` int(10) NOT NULL COMMENT '0=pending,1=approved,2=sold,3=rent',
  `buyer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_property`
--

INSERT INTO `tbl_property` (`property_id`, `property_name`, `property_type`, `property_address`, `property_sqfeet`, `property_price`, `property_image`, `property_description`, `property_totalbeds`, `property_totalbaths`, `property_state`, `property_city`, `property_status`, `deposite`, `user_id`, `live_status`, `buyer_id`) VALUES
(146, '5bhk', 'Row-house', 'vapi', '200', 4000, '2025-04-23-03-46-53-0.jpg', 'good', 5, 1, 'Gujarat', 'Morbi', 0, 9500, 32, 1, 41),
(147, '1bhk', 'Flat', 'ahemdabad', '100', 3500, '2025-04-23-03-52-26-0.jpg', 'medium', 1, 0, 'Gujarat', 'Ahemdabad', 0, 6500, 40, 1, 41),
(148, 'vila', 'Bungalow', 'yogichowk', '300', 8000000, '2025-04-25-01-37-03-0.jpg', 'Excellent', 3, 2, 'Gujarat', 'Surat', 1, 12000, 40, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rent`
--

CREATE TABLE `tbl_rent` (
  `rent_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `starting_date` datetime NOT NULL,
  `ending_date` datetime NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_rent`
--

INSERT INTO `tbl_rent` (`rent_id`, `property_id`, `starting_date`, `ending_date`, `user_name`, `user_id`) VALUES
(33, 147, '2025-04-28 00:00:00', '2025-05-28 00:00:00', 'Yjfyj', 41),
(34, 146, '2025-06-10 00:00:00', '2025-07-17 00:00:00', 'Hjf', 41);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_review`
--

CREATE TABLE `tbl_review` (
  `review_id` int(10) NOT NULL,
  `property_id` int(10) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `review` text NOT NULL,
  `r_date` date NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_mobile` varchar(11) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `user_type` int(11) NOT NULL COMMENT '0=user 1=owner',
  `resettoken` varchar(100) DEFAULT NULL,
  `expireddate` date DEFAULT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_name`, `user_email`, `user_mobile`, `user_password`, `user_address`, `user_type`, `resettoken`, `expireddate`, `status`) VALUES
(32, 'tirth1', 'tirthsavaliya11@gmail.com', '9966332255', '$2y$10$1032D3pdwqlAe7l3W.5/5ellchd6aO4oLb8HLMcnO9FMrfY2FLiyS', 'surat', 1, '0', NULL, 'verified'),
(40, 'tirth savaliya', 'tirthsavaliya743@gmail.com', '9054075121', '$2y$10$ckLfCyzRCdZR0GmGpCddke0nvKMLIwitGkO8tyZW22d.MyNt7yHE2', 'surat', 1, '0', NULL, 'verified'),
(41, 'armi', 'armishiroya6@gmail.com', '9966331122', '$2y$10$MeFmGaIA7xb7csukHAvzzusAm2n0D0ZXxPqnBxfLN2xyXLmMl2khi', 'vapi', 0, '0', NULL, 'verified'),
(45, 'kishan', 'tirth.savaliya11@gmail.com', '9635287410', '$2y$10$lKYAElgiZKBH2HjALXq1sudym84Yq3ySd9N/q1Eypt55r4uRNR6SK', 'surat', 0, '0', NULL, 'verified');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_contact`
--
ALTER TABLE `tbl_contact`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_property`
--
ALTER TABLE `tbl_property`
  ADD PRIMARY KEY (`property_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_rent`
--
ALTER TABLE `tbl_rent`
  ADD PRIMARY KEY (`rent_id`),
  ADD KEY `property_id` (`property_id`),
  ADD KEY `tbl_rent_ibfk_2` (`user_id`);

--
-- Indexes for table `tbl_review`
--
ALTER TABLE `tbl_review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `property_id` (`property_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_contact`
--
ALTER TABLE `tbl_contact`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `tbl_property`
--
ALTER TABLE `tbl_property`
  MODIFY `property_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `tbl_rent`
--
ALTER TABLE `tbl_rent`
  MODIFY `rent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tbl_review`
--
ALTER TABLE `tbl_review`
  MODIFY `review_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD CONSTRAINT `tbl_payment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_property`
--
ALTER TABLE `tbl_property`
  ADD CONSTRAINT `tbl_property_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_rent`
--
ALTER TABLE `tbl_rent`
  ADD CONSTRAINT `tbl_rent_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `tbl_property` (`property_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_rent_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`);

--
-- Constraints for table `tbl_review`
--
ALTER TABLE `tbl_review`
  ADD CONSTRAINT `tbl_review_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `tbl_property` (`property_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_review_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

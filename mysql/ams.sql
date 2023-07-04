-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2023 at 05:05 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ams`
--

-- --------------------------------------------------------

--
-- Table structure for table `forums`
--

CREATE TABLE `forums` (
  `forum_id` int(11) NOT NULL,
  `forum_type` varchar(255) DEFAULT NULL,
  `Management_Forum_topic` varchar(255) DEFAULT NULL,
  `Management_Forum_message` varchar(255) DEFAULT NULL,
  `Resident_Forum_topic` varchar(255) DEFAULT NULL,
  `Resident_Forum_message` varchar(255) DEFAULT NULL,
  `resident_id` int(11) DEFAULT NULL,
  `posted_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `manager_reply` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `forums`
--

INSERT INTO `forums` (`forum_id`, `forum_type`, `Management_Forum_topic`, `Management_Forum_message`, `Resident_Forum_topic`, `Resident_Forum_message`, `resident_id`, `posted_on`, `manager_reply`) VALUES
(1, 'Management Forum', 'guadd', 'ddcfddfdfd', '', '', 1, '2023-07-03 17:37:00', 'pkpk'),
(2, 'Resident Forum', '', '', 'bgbb', 'bgbggbgb', 1, '2023-07-03 13:31:28', 'vbfhfhfh'),
(3, 'Management Forum', '', '', 'gbgbg', 'gbggbggb', 1, '2023-07-03 09:52:56', ''),
(4, 'Management Forum', 'jnjgjgj', 'njhjkhyk', '', '', 1, '2023-07-03 13:32:20', 'taanes\r\n'),
(5, 'Resident Forum', '', '', 'k hhbn', 'opop', 1, '2023-07-03 13:33:26', '');

-- --------------------------------------------------------

--
-- Table structure for table `guards`
--

CREATE TABLE `guards` (
  `guard_id` int(11) NOT NULL,
  `g_name` varchar(255) DEFAULT NULL,
  `g_username` varchar(255) DEFAULT NULL,
  `g_password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guards`
--

INSERT INTO `guards` (`guard_id`, `g_name`, `g_username`, `g_password`) VALUES
(0, 'syam', 'guard1', 'guard1');

-- --------------------------------------------------------

--
-- Table structure for table `managers`
--

CREATE TABLE `managers` (
  `manager_id` int(11) NOT NULL,
  `manager_username` varchar(255) DEFAULT NULL,
  `manager_password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `managers`
--

INSERT INTO `managers` (`manager_id`, `manager_username`, `manager_password`) VALUES
(1, 'ams', 'ams1234');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `resident_id` int(11) DEFAULT NULL,
  `payment_type` varchar(255) DEFAULT NULL,
  `monthly_maintenance_fees_receipt_image` varchar(255) DEFAULT NULL,
  `monthly_maintenance_fees_payment_status` varchar(255) DEFAULT NULL,
  `sinking_fund_receipt_image` varchar(255) DEFAULT NULL,
  `sinking_fund_payment_status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `resident_id`, `payment_type`, `monthly_maintenance_fees_receipt_image`, `monthly_maintenance_fees_payment_status`, `sinking_fund_receipt_image`, `sinking_fund_payment_status`) VALUES
(4, 1, NULL, 'C:/xampp/htdocs/ams/receipt/monthly_maintenance_fees_receipt_image/64a2cd21b40b8.png', 'payment_not_done', 'C:/xampp/htdocs/ams/receipt/sinking_fund_receipt_image/64a2cd21b40c0.png', 'payment_not_done');

-- --------------------------------------------------------

--
-- Table structure for table `residents`
--

CREATE TABLE `residents` (
  `resident_id` int(11) NOT NULL,
  `r_house_number` varchar(255) DEFAULT NULL,
  `r_address` varchar(255) DEFAULT NULL,
  `r_username` varchar(255) DEFAULT NULL,
  `r_password` varchar(255) DEFAULT NULL,
  `r_name` varchar(255) DEFAULT NULL,
  `r_vehicle_number` varchar(255) DEFAULT NULL,
  `r_email` varchar(255) DEFAULT NULL,
  `r_phone_number` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `residents`
--

INSERT INTO `residents` (`resident_id`, `r_house_number`, `r_address`, `r_username`, `r_password`, `r_name`, `r_vehicle_number`, `r_email`, `r_phone_number`) VALUES
(1, '02', 'C-30-02', '02', 'c3002', 'Taanes', 'JKR8242', 'tmselvadurai@gmail.com', '0187704304');

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `visitor_id` int(11) NOT NULL,
  `v_name` varchar(255) DEFAULT NULL,
  `v_car_plate_number` varchar(255) DEFAULT NULL,
  `v_reason_to_visit` varchar(255) DEFAULT NULL,
  `v_address_to_visit` varchar(255) DEFAULT NULL,
  `v_time_in` datetime DEFAULT NULL,
  `v_time_out` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`visitor_id`, `v_name`, `v_car_plate_number`, `v_reason_to_visit`, `v_address_to_visit`, `v_time_in`, `v_time_out`) VALUES
(1, 'taanes', 'ppa7511', 'just', 'C-30-02', NULL, '2023-07-03 00:18:30'),
(2, 'syam', 'ppa7512', 'htyh', 'C-30-03', '2023-07-02 17:06:34', '2023-07-03 00:13:07'),
(3, 'chaanthini', 'TMS8242', 'hh90oih', 'C-30-03', '2023-07-03 15:27:41', '2023-07-03 21:27:47'),
(4, 'syam', 'ppa7512', 'htyh', 'C-30-03', '2023-07-03 19:42:17', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `forums`
--
ALTER TABLE `forums`
  ADD PRIMARY KEY (`forum_id`),
  ADD KEY `resident_id` (`resident_id`);

--
-- Indexes for table `guards`
--
ALTER TABLE `guards`
  ADD PRIMARY KEY (`guard_id`);

--
-- Indexes for table `managers`
--
ALTER TABLE `managers`
  ADD PRIMARY KEY (`manager_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `resident_id` (`resident_id`);

--
-- Indexes for table `residents`
--
ALTER TABLE `residents`
  ADD PRIMARY KEY (`resident_id`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`visitor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `forums`
--
ALTER TABLE `forums`
  MODIFY `forum_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `visitor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `forums`
--
ALTER TABLE `forums`
  ADD CONSTRAINT `forums_ibfk_1` FOREIGN KEY (`resident_id`) REFERENCES `residents` (`resident_id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`resident_id`) REFERENCES `residents` (`resident_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

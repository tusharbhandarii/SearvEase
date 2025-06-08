-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2025 at 08:55 PM
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
-- Database: `majorproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`email`, `password`, `created_at`) VALUES
('tushar@gmail.com', 'tushar123', '2025-04-22 18:02:00');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(3, 'Rehreiw');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `category_id`, `name`) VALUES
(2, 3, 'Lol'),
(3, 3, 'Ses bhai');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('customer','technician') NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `zipcode` varchar(10) DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `phone`, `address`, `city`, `state`, `zipcode`, `latitude`, `longitude`, `created_at`) VALUES
(5, 'Ravi Sharma', 'ravi@example.com', 'password123', 'customer', '9876543210', '12 MG Road', 'Mumbai', 'Maharashtra', '400001', 19.07600000, 72.87770000, '2025-04-24 17:34:07'),
(6, 'Priya Mehra', 'priya@example.com', 'password123', 'customer', '7894561230', '5 Park Street', 'Delhi', 'Delhi', '110001', 28.61390000, 77.20900000, '2025-04-24 17:34:07'),
(7, 'Arun Verma', 'arun@example.com', 'password123', 'customer', '9123456780', '101 Brigade Road', 'Bengaluru', 'Karnataka', '560001', 12.97160000, 77.59460000, '2025-04-24 17:34:07'),
(8, 'Kavita Nair', 'kavita@example.com', 'password123', 'customer', '9988776655', 'Sector 15', 'Chandigarh', 'Chandigarh', '160015', 30.73330000, 76.77940000, '2025-04-24 17:34:07'),
(9, 'Amit Patel', 'amit@example.com', 'password123', 'customer', '7766554433', '1 Ellis Bridge', 'Ahmedabad', 'Gujarat', '380006', 23.02250000, 72.57140000, '2025-04-24 17:34:07'),
(10, 'Sneha Reddy', 'sneha@example.com', 'password123', 'customer', '9001122334', 'Banjara Hills', 'Hyderabad', 'Telangana', '500034', 17.38500000, 78.48670000, '2025-04-24 17:34:07'),
(11, 'Nikhil Sinha', 'nikhil@example.com', 'password123', 'customer', '9012345678', 'Salt Lake', 'Kolkata', 'West Bengal', '700064', 22.57260000, 88.36390000, '2025-04-24 17:34:07'),
(12, 'Anjali Dey', 'anjali@example.com', 'password123', 'customer', '9876501234', 'Civil Lines', 'Nagpur', 'Maharashtra', '440001', 21.14580000, 79.08820000, '2025-04-24 17:34:07'),
(13, 'Rahul Yadav', 'rahul@example.com', 'password123', 'customer', '8888777766', 'Laxmi Nagar', 'Delhi', 'Delhi', '110092', 28.61290000, 77.27730000, '2025-04-24 17:34:07'),
(14, 'Meena Kumari', 'meena@example.com', 'password123', 'customer', '9090901234', 'Gomti Nagar', 'Lucknow', 'Uttar Pradesh', '226010', 26.84670000, 80.94620000, '2025-04-24 17:34:07'),
(15, 'Sunil Kumar', 'sunil.tech@example.com', 'password123', 'technician', '9898989898', 'Bandra West', 'Mumbai', 'Maharashtra', '400050', 19.06000000, 72.83760000, '2025-04-24 17:34:07'),
(16, 'Geeta Rani', 'geeta.tech@example.com', 'password123', 'technician', '8080808080', 'Karol Bagh', 'Delhi', 'Delhi', '110005', 28.65170000, 77.19100000, '2025-04-24 17:34:07'),
(17, 'Mahesh Iyer', 'mahesh.tech@example.com', 'password123', 'technician', '9090909090', 'Indiranagar', 'Bengaluru', 'Karnataka', '560038', 12.97190000, 77.64120000, '2025-04-24 17:34:07'),
(18, 'Neha Joshi', 'neha.tech@example.com', 'password123', 'technician', '8585858585', 'Sector 20', 'Chandigarh', 'Chandigarh', '160020', 30.73500000, 76.78600000, '2025-04-24 17:34:07'),
(19, 'Rajesh Desai', 'rajesh.tech@example.com', 'password123', 'technician', '7878787878', 'Navrangpura', 'Ahmedabad', 'Gujarat', '380009', 23.03000000, 72.58000000, '2025-04-24 17:34:07'),
(20, 'Pooja Singh', 'pooja.tech@example.com', 'password123', 'technician', '8888888888', 'Jubilee Hills', 'Hyderabad', 'Telangana', '500033', 17.39730000, 78.48910000, '2025-04-24 17:34:07'),
(21, 'Vikram Chatterjee', 'vikram.tech@example.com', 'password123', 'technician', '8080707070', 'Behala', 'Kolkata', 'West Bengal', '700034', 22.50120000, 88.32550000, '2025-04-24 17:34:07'),
(22, 'Santosh Bhat', 'santosh.tech@example.com', 'password123', 'technician', '9191919191', 'Sitabuldi', 'Nagpur', 'Maharashtra', '440012', 21.14580000, 79.09000000, '2025-04-24 17:34:07'),
(23, 'Rani Singh', 'rani.tech@example.com', 'password123', 'technician', '8181818181', 'Alambagh', 'Lucknow', 'Uttar Pradesh', '226005', 26.85000000, 80.91000000, '2025-04-24 17:34:07'),
(24, 'Deepak Yadav', 'deepak.tech@example.com', 'password123', 'technician', '8989898989', 'Laxmi Nagar', 'Delhi', 'Delhi', '110092', 28.61290000, 77.27730000, '2025-04-24 17:34:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `subcategories_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

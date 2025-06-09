-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2025 at 12:00 PM
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
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `service_id` int(11) NOT NULL,
  `technician_id` varchar(255) NOT NULL,
  `booking_datetime` datetime NOT NULL,
  `status` enum('Pending','Confirmed','Cancelled','Complete') NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `customer_email`, `service_id`, `technician_id`, `booking_datetime`, `status`, `created_at`) VALUES
(1, 'anjali@example.com', 10, '32', '2025-05-12 17:44:00', 'Complete', '2025-05-11 09:11:40'),
(4, 'nikhil@example.com', 10, '32', '2025-05-14 19:28:00', 'Complete', '2025-05-13 09:07:06'),
(5, 'customer.kolkata@example.com', 10, 'Null', '2025-05-22 18:23:00', 'Pending', '2025-05-13 09:50:10'),
(6, 'nikhil@example.com', 10, 'Null', '2025-06-20 17:29:00', 'Pending', '2025-06-09 07:55:15');

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
(1, 'Cleaning'),
(2, 'Plumbing'),
(3, 'Electrician'),
(4, 'Pest Control'),
(5, 'Appliance Repair'),
(6, 'Carpentry'),
(7, 'Painting');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL CHECK (`rating` between 1 and 5),
  `comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `booking_id`, `customer_email`, `rating`, `comment`, `created_at`) VALUES
(1, 4, 'nikhil@example.com', 5, 'very good', '2025-06-09 07:55:31');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `servicename` varchar(255) NOT NULL,
  `category` int(11) NOT NULL,
  `subcategory` int(11) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `duration` varchar(50) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `servicename`, `category`, `subcategory`, `description`, `price`, `duration`, `image`) VALUES
(10, 'Home Deep Cleaning', 1, 1, 'Professional full-house cleaning service for a sparkling clean home.', 2200.00, '3.5 hours', 'deep_cleaning.jpg'),
(11, 'AC Repair Service', 5, 10, 'Servicing and repair of split and window ACs with gas refill.', 1500.00, '2 hours', 'ac_repair.jpg'),
(12, 'Ceiling Fan Installation', 3, 6, 'Expert installation of ceiling fans with safe wiring.', 450.00, '1 hour', 'fan_installation.jpg'),
(13, 'Cockroach Pest Control', 4, 9, 'Cockroach removal service with herbal and chemical options.', 1000.00, '1.5 hours', 'cockroach_control.jpg'),
(14, 'Tap Installation', 2, 5, 'Installation of new taps and water fixtures in kitchen or bathroom.', 350.00, '45 minutes', 'tap_installation.jpg'),
(15, 'Furniture Assembly', 6, 12, 'Assembly of beds, tables, wardrobes, and chairs at your home.', 700.00, '2 hours', 'furniture_assembly.jpg');

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
(1, 1, 'Home Deep Cleaning'),
(2, 1, 'Kitchen Cleaning'),
(3, 1, 'Bathroom Cleaning'),
(4, 2, 'Leak Fixing'),
(5, 2, 'Tap Installation'),
(6, 3, 'Fan Installation'),
(7, 3, 'Wiring Work'),
(8, 4, 'Termite Treatment'),
(9, 4, 'Cockroach Control'),
(10, 5, 'Washing Machine Repair'),
(11, 5, 'Refrigerator Repair'),
(12, 6, 'Furniture Assembly');

-- --------------------------------------------------------

--
-- Table structure for table `technicians`
--

CREATE TABLE `technicians` (
  `id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `subcategory` int(11) NOT NULL,
  `availability` enum('available','unavailable') NOT NULL DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `technicians`
--

INSERT INTO `technicians` (`id`, `category`, `subcategory`, `availability`) VALUES
(31, 1, 1, 'available'),
(32, 1, 1, 'available'),
(33, 1, 1, 'available'),
(34, 1, 1, 'available'),
(35, 1, 1, 'available');

-- --------------------------------------------------------

--
-- Table structure for table `technician_requests`
--

CREATE TABLE `technician_requests` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `technician_id` int(11) NOT NULL,
  `status` enum('pending','accepted','rejected') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `technician_requests`
--

INSERT INTO `technician_requests` (`id`, `booking_id`, `technician_id`, `status`, `created_at`) VALUES
(1, 4, 32, 'rejected', '2025-06-08 04:30:29'),
(2, 4, 32, 'accepted', '2025-06-08 04:30:47'),
(3, 1, 32, 'accepted', '2025-06-08 04:34:44'),
(4, 1, 32, 'accepted', '2025-06-08 04:37:38'),
(5, 4, 32, 'rejected', '2025-06-09 06:41:37'),
(6, 4, 32, 'rejected', '2025-06-09 07:05:45'),
(7, 4, 32, 'accepted', '2025-06-09 07:08:36'),
(8, 5, 32, 'pending', '2025-06-09 07:19:54');

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
(24, 'Deepak Yadav', 'deepak.tech@example.com', 'password123', 'technician', '8989898989', 'Laxmi Nagar', 'Delhi', 'Delhi', '110092', 28.61290000, 77.27730000, '2025-04-24 17:34:07'),
(25, 'Tushar Bhandari', 'bhandari15157@gmail.com', 'aWC71r', 'technician', '08768500507', 'Birbhum, vill-Muthaberia', 'durgapur', 'Assam', '73333', 15.46400000, 64.41400000, '2025-05-09 19:36:36'),
(28, 'Tushar Bhandari', 'bhandari1516456@gmail.com', '1QhjGO', 'technician', '08768500507', 'Birbhum, vill-Muthaberia', '', 'Assam', '73333', 15.46400000, 64.41400000, '2025-05-09 19:39:11'),
(30, 'Customer Kolkata', 'customer.kolkata@example.com', 'password123', 'customer', '9876543210', 'Salt Lake', 'Kolkata', 'West Bengal', '700064', 22.57260000, 88.36390000, '2025-05-13 09:43:25'),
(31, 'Technician 1', 'tech1@example.com', 'password123', 'technician', '9000000001', 'Behala', 'Kolkata', 'West Bengal', '700034', 22.50120000, 88.32550000, '2025-05-13 09:43:40'),
(32, 'Jahir Khan', 'tech2@example.com', 'password123', 'technician', '9000000002', 'Salt Lake', 'Kolkata', 'West Bengal', '700064', 22.57260000, 88.36390000, '2025-05-13 09:43:40'),
(33, 'Technician 3', 'tech3@example.com', 'password123', 'technician', '9000000003', 'New Town', 'Kolkata', 'West Bengal', '700156', 22.59580000, 88.47950000, '2025-05-13 09:43:40'),
(34, 'Technician 4', 'tech4@example.com', 'password123', 'technician', '9000000004', 'Park Street', 'Kolkata', 'West Bengal', '700016', 22.55350000, 88.35200000, '2025-05-13 09:43:40'),
(35, 'Technician 5', 'tech5@example.com', 'password123', 'technician', '9000000005', 'Howrah', 'Kolkata', 'West Bengal', '711101', 22.58970000, 88.31030000, '2025-05-13 09:43:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_email` (`customer_email`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_id` (`booking_id`),
  ADD KEY `customer_email` (`customer_email`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category`),
  ADD KEY `subcategory` (`subcategory`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subcategories_ibfk_1` (`category_id`);

--
-- Indexes for table `technicians`
--
ALTER TABLE `technicians`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category`),
  ADD KEY `subcategory` (`subcategory`);

--
-- Indexes for table `technician_requests`
--
ALTER TABLE `technician_requests`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `technician_requests`
--
ALTER TABLE `technician_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`customer_email`) REFERENCES `users` (`email`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`customer_email`) REFERENCES `users` (`email`) ON DELETE CASCADE;

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_ibfk_1` FOREIGN KEY (`category`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `services_ibfk_2` FOREIGN KEY (`subcategory`) REFERENCES `subcategories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `subcategories_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `technicians`
--
ALTER TABLE `technicians`
  ADD CONSTRAINT `technicians_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `technicians_ibfk_2` FOREIGN KEY (`category`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `technicians_ibfk_3` FOREIGN KEY (`subcategory`) REFERENCES `subcategories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2022 at 04:42 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `adminname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `adminname`, `password`) VALUES
(1, 'Pratheek', 'admin'),
(2, 'Deekshith', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `brands` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `brands`, `image`, `status`) VALUES
(2, 'Tata', '731570944_tata-logo.png', 1),
(3, 'Ford', '178070961_ford-logo.png', 1),
(4, 'Mahindra', '452769565_mahindra-logo.png', 1),
(5, 'Toyota', '385315389_toyota-logo.png', 1),
(6, 'Hyundai', '240891654_hyundai-logo.png', 1),
(10, 'Honda', '156300268_honda-logo.png', 1),
(11, 'Maruthi-Suzuki', '961713898_suzuki-logo.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `brand_id` varchar(255) NOT NULL,
  `car_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `type_id` varchar(255) NOT NULL,
  `car_nameplate` varchar(255) CHARACTER SET utf8 NOT NULL,
  `image` varchar(255) CHARACTER SET utf8 NOT NULL,
  `ac_price` float NOT NULL,
  `non_ac_price` float NOT NULL,
  `ac_price_per_day` float NOT NULL,
  `non_ac_price_per_day` float NOT NULL,
  `max_km` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `brand_id`, `car_name`, `type_id`, `car_nameplate`, `image`, `ac_price`, `non_ac_price`, `ac_price_per_day`, `non_ac_price_per_day`, `max_km`, `status`) VALUES
(1, 'Tata', 'Nano', 'Micro', 'KA19Z2983', '361067497_tata-nano.jpeg', 10, 8, 1000, 800, 22, '1'),
(2, 'Maruthi-Suzuki', 'Swift Dzire', 'Sedan', 'KA21AB2800', '670771471_suzuki-dzire.png', 15, 13, 1600, 1200, 66, '1'),
(3, 'Maruthi-Suzuki', 'Swift', 'Hatchback', 'KA21MB5998', '291655544_suzuki-swift.jpeg', 14, 13, 1600, 1500, 0, '1'),
(5, 'Ford', 'Figo', 'Hatchback', 'KA70B2253', '256698121_figo.png', 14, 12, 1400, 1300, 0, '1'),
(6, 'Mahindra', 'Scorpio', 'SUV', 'KA19GF5367', '681361900_mahindra-scorpio.jpeg', 16, 15, 1900, 1750, 0, '1'),
(7, 'Toyota', 'Innova Crysta', 'Minivan', 'KA21AB2276', '505740912_toyota-innova-crysta.jpeg', 19, 18, 2000, 1900, 0, '1'),
(9, 'Hyundai', 'i20 Active', 'Crossover', 'KA19MB3421', '719766898_hyundai-i20.jpeg', 15, 13, 1600, 1500, 0, '1'),
(11, 'Honda', 'City', 'Sedan', 'KA19SD2421', '478817476_honda-city.jpeg', 14, 13, 1400, 1200, 0, '1'),
(12, 'Maruthi-Suzuki', 'S-Presso', 'Hatchback', 'KA19HD2658', '623177163_suzuki-spresso.jpeg', 14, 13, 1350, 1250, 0, '1'),
(19, 'Maruthi-Suzuki', 'Alto', 'Hatchback', 'KA22HM2882', '188458131_suzuki-alto.jpeg', 12, 11, 1200, 1100, 250, '1'),
(20, 'Hyundai', 'Creta', 'Crossover', 'KA21HN4256', '576083374_hyundai-creta.jpeg', 14, 13, 1400, 1300, 300, '1'),
(21, 'Tata', 'Tigor', 'Sedan', 'KA19X3275', '175098245_tata-tigor.jpeg', 13, 12, 1300, 1200, 250, '1'),
(22, 'Honda', 'WR-V', 'Crossover', 'KA20BN2144', '423867891_Honda-WR-V.jpeg', 14, 13, 1480, 1360, 200, '0'),
(23, 'Hyundai', 'i10-nios', 'Hatchback', 'KA21HH2136', '721179801_hyundai-grand-i10-nios.jpeg', 12, 11, 1270, 1180, 170, '1');

-- --------------------------------------------------------

--
-- Table structure for table `car_type`
--

CREATE TABLE `car_type` (
  `id` int(11) NOT NULL,
  `car_type` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `car_type`
--

INSERT INTO `car_type` (`id`, `car_type`, `status`) VALUES
(1, 'Micro', 1),
(2, 'Sedan', 1),
(3, 'Hatchback', 1),
(4, 'Minivan', 1),
(5, 'Crossover', 1),
(6, 'SUV', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `added_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `message`, `added_on`) VALUES
(1, 'Pratheek', 'pratheek.noojipady@gmail.com', 'cafdsa', '2022-08-17');

-- --------------------------------------------------------

--
-- Table structure for table `rentedcars`
--

CREATE TABLE `rentedcars` (
  `order_id` int(100) NOT NULL,
  `customer_username` varchar(255) NOT NULL,
  `car_id` int(20) NOT NULL,
  `booking_date` date NOT NULL,
  `rent_start_date` date NOT NULL,
  `rent_end_date` date NOT NULL,
  `car_return_date` date DEFAULT NULL,
  `fare` double NOT NULL,
  `charge_type` varchar(255) NOT NULL,
  `distance` double DEFAULT NULL,
  `no_of_days` int(50) DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  `total_fine` int(11) NOT NULL,
  `return_status` varchar(255) NOT NULL,
  `return_request` int(255) NOT NULL,
  `pay_request` int(11) NOT NULL,
  `payment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rentedcars`
--

INSERT INTO `rentedcars` (`order_id`, `customer_username`, `car_id`, `booking_date`, `rent_start_date`, `rent_end_date`, `car_return_date`, `fare`, `charge_type`, `distance`, `no_of_days`, `total_amount`, `total_fine`, `return_status`, `return_request`, `pay_request`, `payment`) VALUES
(1, 'Pratheek', 1, '2021-09-09', '2021-09-09', '2021-09-22', '2021-09-09', 1000, 'day', NULL, 13, 13000, 0, 'R', 1, 1, 'paid'),
(2, 'Deekshith', 6, '2021-09-09', '2021-09-09', '2021-09-22', '2021-09-09', 16, 'km', 120, 13, 1920, 0, 'R', 1, 1, 'paid'),
(3, 'Pratheek', 7, '2021-09-11', '2021-09-15', '2021-09-30', '2021-09-11', 19, 'km', 533, 15, 10127, 0, 'R', 1, 1, 'paid'),
(7, 'Pratheek', 19, '2021-09-13', '2021-09-21', '2021-09-29', '2021-09-13', 1100, 'day', NULL, 8, 8800, 0, 'R', 1, 1, 'paid'),
(9, 'Pratheek', 22, '2021-09-13', '2021-09-15', '2021-09-29', '2021-09-13', 13, 'km', 766, 14, 9958, 0, 'R', 1, 1, 'paid'),
(11, 'Pratheek', 22, '2022-08-17', '2022-08-17', '2022-08-24', NULL, 1480, 'day', NULL, NULL, NULL, 0, 'NR', 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mblno` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dl_no` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `token` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `mblno`, `password`, `dl_no`, `image`, `date`, `token`, `status`) VALUES
(28, 'Pratheek', 'pratheek.noojipady@gmail.com', '9448167685', '72f7c3e3a452582f29cdfe17d8fb2b4f', 'KA70 20200007345', '302080382_314784.jpg', '2022-08-17 06:20:21', 'aaf39844e482b172a0ba0d62c35359', 'Active'),
(31, 'Deekshith', 'deekshith618@gmail.com', '8310562782', '202cb962ac59075b964b07152d234b70', 'KA21 20210000123', '997144901_1102010.jpg', '2021-09-11 05:50:00', '4c607371e67f9989bf2c77f756c903', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `car_type`
--
ALTER TABLE `car_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rentedcars`
--
ALTER TABLE `rentedcars`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `car_type`
--
ALTER TABLE `car_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rentedcars`
--
ALTER TABLE `rentedcars`
  MODIFY `order_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

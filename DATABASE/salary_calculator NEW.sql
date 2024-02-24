-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2024 at 02:24 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `salary_calculator`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(10) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', 'b7e576d5b5ec5f1e770ebc0e9ba51fd5');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_id` varchar(6) NOT NULL,
  `email` varchar(50) NOT NULL,
  `f_name` varchar(30) NOT NULL,
  `l_name` varchar(30) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `role` varchar(10) NOT NULL,
  `gross_sal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_id`, `email`, `f_name`, `l_name`, `phone`, `role`, `gross_sal`) VALUES
('MTE1', 'hashan99gmail.com', 'Shanuka', 'Perera', '0776653245', 'maintenanc', 252734),
('PRM1', 'wwww@gmail.com', 'Oshadhi', 'Anuradha', '0765562435', 'manager', 25099),
('PRM2', 'wwww@gmail.com', 'Hasthika', 'Anuradha', '0765562435', 'manager', 45000),
('SEW2', 'wwww@gmail.com', 'Shanuka', 'kwesedfef', '0765562435', 'sewing', 340000),
('SUP1', 'wwww@gmail.com', 'Gimmm', 'haaan', '0786535142', 'supervisor', 300000),
('SUP2', 'wwww@gmail.com', 'Hashan', 'Perera', '0776623615', 'supervisor', 70000),
('SUP3', 'wwww@gmail.com', 'Shanuka', 'Anuradha', '0765562435', 'supervisor', 25008);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `emp_id` varchar(6) NOT NULL,
  `gross_sal` decimal(10,2) NOT NULL,
  `deduc_tax` decimal(10,2) NOT NULL,
  `employer_con` decimal(10,2) NOT NULL,
  `employee_con` decimal(10,2) NOT NULL,
  `etf` decimal(10,2) NOT NULL,
  `year` int(4) NOT NULL,
  `month` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `emp_id`, `gross_sal`, `deduc_tax`, `employer_con`, `employee_con`, `etf`, `year`, `month`) VALUES
(1, 'MTE1', '250345.00', '1209.00', '23344.00', '3788.00', '200.00', 2016, 'may'),
(2, 'MTE1', '252734.00', '60656.16', '30328.08', '20218.72', '7582.02', 2024, 'July'),
(3, 'MTE1', '252734.00', '60656.16', '30328.08', '20218.72', '7582.02', 2024, 'August'),
(4, 'SEW2', '100000.00', '0.00', '12000.00', '8000.00', '3000.00', 2024, 'April'),
(5, 'MTE1', '252734.00', '60656.16', '30328.08', '20218.72', '7582.02', 2024, 'October');

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

CREATE TABLE `taxes` (
  `ID` int(4) NOT NULL,
  `lower_value` float(10,2) NOT NULL,
  `upper_value` float(10,2) NOT NULL,
  `tax_rate` float(6,3) NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `taxes`
--

INSERT INTO `taxes` (`ID`, `lower_value`, `upper_value`, `tax_rate`, `status`) VALUES
(2, 0.00, 100000.00, 0.000, 'A'),
(3, 100001.00, 141667.00, 6.000, 'A'),
(4, 141668.00, 183333.00, 12.000, 'A'),
(5, 183334.00, 225000.00, 18.000, 'A'),
(6, 225001.00, 266667.00, 24.000, 'A'),
(7, 266668.00, 308333.00, 30.000, 'A'),
(8, 308334.00, 1000000.00, 36.000, 'A');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`emp_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

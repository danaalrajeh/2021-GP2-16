-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2022 at 08:51 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clinic`
--

-- --------------------------------------------------------

--
-- Table structure for table `alarm`
--

CREATE TABLE `alarm` (
  `id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `symptom` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `alarm`
--

INSERT INTO `alarm` (`id`, `p_id`, `symptom`) VALUES
(5, 11, 'test'),
(9, 11, 'rrrr');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `a_date` varchar(255) NOT NULL,
  `a_time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `p_id`, `a_date`, `a_time`) VALUES
(1, 2, '2021-11-01', '06:56'),
(2, 2, '2021-10-15', '00:12'),
(9, 6, '2021-11-01', '08:56'),
(10, 0, '2021-11-15', '13:11'),
(11, 0, '2021-11-10', '22:13'),
(12, 0, '2021-11-10', '22:11'),
(13, 11, '2021-12-02', '10:38');

-- --------------------------------------------------------

--
-- Table structure for table `diet`
--

CREATE TABLE `diet` (
  `id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `diet_type` varchar(100) NOT NULL,
  `recommended_food` varchar(1000) NOT NULL,
  `prohibited_food` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `diet`
--

INSERT INTO `diet` (`id`, `p_id`, `diet_type`, `recommended_food`, `prohibited_food`) VALUES
(3, 2, 'normal', 'apple,banana,orange,eggs', 'meat'),
(6, 6, 'normal', 'this is my diet', '');

-- --------------------------------------------------------

--
-- Table structure for table `medication`
--

CREATE TABLE `medication` (
  `id` int(11) NOT NULL,
  `med_name` varchar(125) NOT NULL,
  `descrip` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `cond` varchar(500) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone` int(12) NOT NULL,
  `relative_name` varchar(255) NOT NULL,
  `relative_phone` int(12) NOT NULL,
  `physician_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `fname`, `birthday`, `cond`, `username`, `email`, `password`, `phone`, `relative_name`, `relative_phone`, `physician_id`) VALUES
(2, 'test test test', '2021-10-15', 'testttttt', '', '', '', 0, '', 0, 2),
(3, 'test1 test1 test1', '2021-07-14', 'test test', '', '', '', 0, '', 0, 2),
(5, 'rt', '2021-10-13', 'testttttt', '', '', '', 0, '', 0, 2),
(6, 'test test', '2021-10-13', 'ttttttttttttttttttttttt', '', '', '', 0, '', 0, 1),
(8, 'farah farah', '2021-11-16', 'asdsadas', '', '', '', 0, '', 0, 1),
(9, 'first patient', '2021-11-11', 'condition', '', '', '', 0, '', 0, 1),
(10, 'second patient', '2021-11-28', 'condition', '', 'sad@gmail.com', '', 0, '', 0, 1),
(11, '1th patient', '2021-11-16', 'condition', 'first.paitent', 't@gmail.com', '202cb962ac59075b964b07152d234b70', 1234, 'test', 123, 7);

-- --------------------------------------------------------

--
-- Table structure for table `physical_activity`
--

CREATE TABLE `physical_activity` (
  `id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `activity_type` varchar(100) NOT NULL,
  `duration` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `physical_activity`
--

INSERT INTO `physical_activity` (`id`, `p_id`, `activity_type`, `duration`, `description`) VALUES
(7, 7, 'physical', 'every day', 'jhjhfkglhlohl;j;j;oj;oj;oo;j;oj;jjjb');

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `medication` varchar(500) NOT NULL,
  `descrption` varchar(500) NOT NULL,
  `dose` varchar(500) NOT NULL,
  `time` varchar(200) NOT NULL,
  `precautions` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prescription`
--

INSERT INTO `prescription` (`id`, `p_id`, `medication`, `descrption`, `dose`, `time`, `precautions`) VALUES
(4, 5, 's', 'sdfsdf', 'sdfsdaf', '', ''),
(5, 6, 'med 1111', 'med1 med1fsdf', 'med1 sdfdfs', '', ''),
(6, 6, 'med 1111', 'asdasd', 'asdasd', '', ''),
(7, 6, 'asdasd', 'asdsad', 'asdasd', '', ''),
(8, 6, 'sadasdas', 'asdasda', 'asdsadas', '', ''),
(9, 6, 'sadasdas', 'asdasdas', 'sdasdsadas', '', ''),
(10, 6, 'asdasdda', 'asdasdsa', 'asdsadas', '', ''),
(11, 11, 'med 1', 'this is med 1', 'this is med 1', '3 times', 'test test test test test test');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `password`) VALUES
(7, 'farah', 'farah', 'farah@gmail.com', '202cb962ac59075b964b07152d234b70'),
(9, 'test', 'test', 'test@gmail.com', '2b8d8e7c417e7cfc58e74aa72cf8d2e3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alarm`
--
ALTER TABLE `alarm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diet`
--
ALTER TABLE `diet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medication`
--
ALTER TABLE `medication`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `physical_activity`
--
ALTER TABLE `physical_activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alarm`
--
ALTER TABLE `alarm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `diet`
--
ALTER TABLE `diet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `medication`
--
ALTER TABLE `medication`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `physical_activity`
--
ALTER TABLE `physical_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `prescription`
--
ALTER TABLE `prescription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

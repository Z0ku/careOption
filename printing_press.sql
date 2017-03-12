-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 12, 2017 at 03:34 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `printing_press`
--

-- --------------------------------------------------------

--
-- Table structure for table `printorders`
--

CREATE TABLE `printorders` (
  `orderId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `orderName` varchar(100) NOT NULL,
  `orderDate` date NOT NULL,
  `orderStatus` int(11) NOT NULL,
  `noOfCopies` int(11) NOT NULL,
  `orderDesc` text,
  `file` varchar(100) NOT NULL,
  `orderType` enum('Receipt','Document') NOT NULL,
  `specs` enum('None','A4','A3','A2') NOT NULL,
  `comments` text,
  `deliveryAddress` varchar(100) NOT NULL,
  `employeeId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `printorders`
--

INSERT INTO `printorders` (`orderId`, `userId`, `orderName`, `orderDate`, `orderStatus`, `noOfCopies`, `orderDesc`, `file`, `orderType`, `specs`, `comments`, `deliveryAddress`, `employeeId`) VALUES
(1, 3, 'Test', '2017-03-10', 3, 1, 'This is a test order.', 'COVER.docx', 'Document', 'A4', '', '2 Client Street, Cebu City', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(128) NOT NULL,
  `contactNo` varchar(20) NOT NULL,
  `address` varchar(150) NOT NULL,
  `employeeId` int(11) DEFAULT NULL,
  `ownerId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `name`, `email`, `password`, `contactNo`, `address`, `employeeId`, `ownerId`) VALUES
(2, 'Employee', 'employee@gmail.com', 'ada3197469dbc37df5789eda636a6c4c24f4cf368ec089f640c7981b2a450fe9be9a0d6896ec5714cb00a1e1b63571f34e9d63c5845b165211fcdab83651f2a5', '091234567', '16 Employee Street, Employee Town', 0, NULL),
(3, 'Client', 'client@gmail.com', '85d7741af27f18cbefc7fdc96d4465f63d4e8da2126a196f87c4f7e1f65298855a0e4a4a8986936eae95e2b899e837c48ae39d8048f907ebd0095c87c49fb0af', '091234567', '2 Client Street, Cebu City', NULL, NULL),
(121, 'Admin', 'admin@gmail.com', 'c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec', '091234567', '12 Admin St.', NULL, 0),
(233, '123', 't33est@gmail.com', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', '123', '123', NULL, NULL),
(12312, 'Yuchipashe', 'yuchipashe@gmail.com', '401b09eab3c013d4ca54922bb802bec8fd5318192b0a75f201d8b3727429080fb337591abd3e44453b954555b7a0812e1081c39b740293f765eae731f5a65ed1', '09333227884', '15 Paseo Luis, Maria Luisa', NULL, NULL),
(23333, 'asdf', 'asdf!@adsf', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', '123', '123', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `printorders`
--
ALTER TABLE `printorders`
  ADD PRIMARY KEY (`orderId`),
  ADD KEY `userId` (`userId`),
  ADD KEY `employeeId` (`employeeId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `userId_3` (`userId`),
  ADD UNIQUE KEY `employeeId` (`employeeId`),
  ADD KEY `userId` (`userId`),
  ADD KEY `userId_2` (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `printorders`
--
ALTER TABLE `printorders`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `printorders`
--
ALTER TABLE `printorders`
  ADD CONSTRAINT `fk_employeeId_users_printOrders` FOREIGN KEY (`employeeId`) REFERENCES `users` (`employeeId`),
  ADD CONSTRAINT `fk_userId_users_printOrders` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

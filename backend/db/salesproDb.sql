-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: May 12, 2024 at 06:37 AM
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
-- Database: `salesprodb`
--

-- --------------------------------------------------------

--
-- Table structure for table `cancellationhistory`
--

CREATE TABLE `cancellationhistory` (
  `CancellationID` int(11) NOT NULL,
  `OrderID` int(11) DEFAULT NULL,
  `CancellationTimestamp` datetime NOT NULL,
  `Reason` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deliverydetails`
--

CREATE TABLE `deliverydetails` (
  `phoneNumber` bigint(20) NOT NULL,
  `deliveryAddress` varchar(60) NOT NULL,
  `deliveryCity` varchar(30) NOT NULL,
  `deliveryInstructions` text DEFAULT NULL,
  `deliveryDetailsID` int(11) NOT NULL,
  `orderID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

CREATE TABLE `orderitems` (
  `OrderItemID` int(11) NOT NULL,
  `OrderID` int(11) DEFAULT NULL,
  `ProductID` int(11) DEFAULT NULL,
  `Quantity` int(11) NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  `Amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderID` int(11) NOT NULL,
  `CustomerID` int(11) NOT NULL,
  `AssignedDeliveryStaffID` int(11) DEFAULT NULL,
  `OrderDate` date NOT NULL,
  `VerificationStatus` varchar(50) DEFAULT 'Pending',
  `ProductionStatus` varchar(50) DEFAULT 'Not Started',
  `DeliveryStatus` varchar(50) DEFAULT 'Not Delivered',
  `DeliveryDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `productionlog`
--

CREATE TABLE `productionlog` (
  `ProductionLogID` int(11) NOT NULL,
  `ProductID` int(11) DEFAULT NULL,
  `ProductionDate` date NOT NULL,
  `QuantityProduced` int(11) NOT NULL,
  `ProductionStaffID` int(11) DEFAULT NULL,
  `OrderID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(255) NOT NULL,
  `Description` text DEFAULT NULL,
  `SKU` varchar(50) NOT NULL,
  `CostPrice` decimal(10,2) NOT NULL,
  `SellingPrice` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductID`, `ProductName`, `Description`, `SKU`, `CostPrice`, `SellingPrice`) VALUES
(1, 'Chicken Momo', 'Chopped onions, garlic, green chilies, aromatic spices such as cumin, coriander, and turmeric ', 'pieces', 5.00, 7.00),
(2, 'Mango Achar', ' Mango, sichuan pepper, mustard seed, gingelly oi. ', 'pieces', 250.00, 300.00),
(3, 'Demo', 'demo', 'pieces', 12.00, 13.00);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `SalesID` int(11) NOT NULL,
  `OrderID` int(11) DEFAULT NULL,
  `SalesStaffID` int(11) DEFAULT NULL,
  `SalesTimestamp` datetime NOT NULL,
  `MoneyReceived` varchar(50) DEFAULT 'No',
  `TotalAmount` decimal(10,2) DEFAULT NULL,
  `ProfitMade` decimal(10,2) DEFAULT NULL,
  `PaymentType` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `UserType` varchar(50) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `PasswordHash` varchar(255) NOT NULL,
  `PhoneNumber` varchar(20) DEFAULT NULL,
  `Address` text DEFAULT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `UserType`, `Email`, `PasswordHash`, `PhoneNumber`, `Address`, `FirstName`, `LastName`) VALUES
(1, 'Admin', 'Admin@gmail.com', '$2y$10$5VU1JXcVmli.w405uTM0yuXs0i9uVN/kcQwBF50TXfluiOcpl4ceO', '9865841230', 'lorem lorem', 'Admin', 'Admin'),
(2, 'ProductionStaff', 'production@gmail.com', '$2y$10$nQ0b7CFykaSxNX4Lk1AK9.KZZ1GQhpApXQjcAhOq7ENyZshFRREBm', '9812365470', 'lorem lorem', 'FirstName', 'LastName'),
(3, 'SalesStaff', 'sales@gmail.com', '$2y$10$0o9BUqP2PJsH5vwAYQdF.e.CVPyUJkVmMYoBVNI46S/fHeQcMcse6', '9812365407', 'lorem lorem', 'FirstName', 'LastName');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cancellationhistory`
--
ALTER TABLE `cancellationhistory`
  ADD PRIMARY KEY (`CancellationID`),
  ADD KEY `FK_CancellationHistory_Order` (`OrderID`);

--
-- Indexes for table `deliverydetails`
--
ALTER TABLE `deliverydetails`
  ADD PRIMARY KEY (`deliveryDetailsID`),
  ADD KEY `orderID` (`orderID`);

--
-- Indexes for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`OrderItemID`),
  ADD KEY `FK_OrderItems_Order` (`OrderID`),
  ADD KEY `FK_OrderItems_Product` (`ProductID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `FK_Orders_Customer` (`CustomerID`),
  ADD KEY `FK_Orders_AssignedDeliveryStaff` (`AssignedDeliveryStaffID`);

--
-- Indexes for table `productionlog`
--
ALTER TABLE `productionlog`
  ADD PRIMARY KEY (`ProductionLogID`),
  ADD KEY `FK_ProductionLog_Product` (`ProductID`),
  ADD KEY `FK_ProductionLog_ProductionStaff` (`ProductionStaffID`),
  ADD KEY `OrderID` (`OrderID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductID`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`SalesID`),
  ADD KEY `FK_Sales_Order` (`OrderID`),
  ADD KEY `FK_Sales_SalesStaff` (`SalesStaffID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cancellationhistory`
--
ALTER TABLE `cancellationhistory`
  MODIFY `CancellationID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deliverydetails`
--
ALTER TABLE `deliverydetails`
  MODIFY `deliveryDetailsID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orderitems`
--
ALTER TABLE `orderitems`
  MODIFY `OrderItemID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `productionlog`
--
ALTER TABLE `productionlog`
  MODIFY `ProductionLogID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `SalesID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `deliverydetails`
--
ALTER TABLE `deliverydetails`
  ADD CONSTRAINT `deliverydetails_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `orders` (`OrderID`);

--
-- Constraints for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD CONSTRAINT `FK_OrderItems_Order` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`OrderID`),
  ADD CONSTRAINT `FK_OrderItems_Product` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ProductID`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_Orders_AssignedDeliveryStaff` FOREIGN KEY (`AssignedDeliveryStaffID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `FK_Orders_Customer` FOREIGN KEY (`CustomerID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `productionlog`
--
ALTER TABLE `productionlog`
  ADD CONSTRAINT `FK_ProductionLog_Product` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ProductID`),
  ADD CONSTRAINT `FK_ProductionLog_ProductionStaff` FOREIGN KEY (`ProductionStaffID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `productionlog_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`OrderID`);

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `FK_Sales_Order` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`OrderID`),
  ADD CONSTRAINT `FK_Sales_SalesStaff` FOREIGN KEY (`SalesStaffID`) REFERENCES `users` (`UserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

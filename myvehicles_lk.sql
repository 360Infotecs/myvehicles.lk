-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2018 at 06:02 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myvehicles.lk`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `Id` int(11) NOT NULL,
  `Name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `classofvehicle`
--

CREATE TABLE `classofvehicle` (
  `Id` int(11) NOT NULL,
  `Name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `colour`
--

CREATE TABLE `colour` (
  `Id` int(11) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `ColourCode` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `Id` int(11) NOT NULL,
  `CompanyId` varchar(30) NOT NULL,
  `AgentId` int(11) NOT NULL,
  `CompanyName` varchar(100) NOT NULL,
  `AddressLine1` varchar(100) NOT NULL,
  `AddressLine2` varchar(100) DEFAULT NULL,
  `AddressLine3` varchar(100) DEFAULT NULL,
  `ContactPerson` varchar(100) DEFAULT NULL,
  `PhoneNo` varchar(15) DEFAULT NULL,
  `Mobile` varchar(15) DEFAULT NULL,
  `Email` varchar(60) DEFAULT NULL,
  `Latitude` double DEFAULT NULL,
  `Longitude` double DEFAULT NULL,
  `Status` int(11) NOT NULL,
  `StatusUpdatedBy` varchar(15) NOT NULL,
  `StatusUpdatedDate` datetime NOT NULL,
  `CreatedBy` varchar(15) NOT NULL,
  `CreatedDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`Id`, `CompanyId`, `AgentId`, `CompanyName`, `AddressLine1`, `AddressLine2`, `AddressLine3`, `ContactPerson`, `PhoneNo`, `Mobile`, `Email`, `Latitude`, `Longitude`, `Status`, `StatusUpdatedBy`, `StatusUpdatedDate`, `CreatedBy`, `CreatedDate`) VALUES
(1, 'MVC18112467898', 42, 'cng', 'add1', 'add2', 'add3', 'me', '123456', '45634675675', 'sdghsds@sgfhsf.fdg', 6.10544248, 11.52585966, 1, '1', '2018-11-24 16:29:35', '1', '2018-11-24 16:29:35');

-- --------------------------------------------------------

--
-- Table structure for table `companystatus`
--

CREATE TABLE `companystatus` (
  `Id` int(11) NOT NULL,
  `Name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `companystatus`
--

INSERT INTO `companystatus` (`Id`, `Name`) VALUES
(1, 'Active'),
(2, 'Inactive'),
(3, 'Deleted');

-- --------------------------------------------------------

--
-- Table structure for table `fualtype`
--

CREATE TABLE `fualtype` (
  `Id` int(11) NOT NULL,
  `Name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `Id` int(11) NOT NULL,
  `PostId` varchar(30) NOT NULL,
  `CompanyId` int(11) NOT NULL,
  `AgentId` int(11) NOT NULL,
  `SubAgentName` varchar(100) NOT NULL,
  `PostTitle` text NOT NULL,
  `VehicleDescription` text NOT NULL,
  `Keywords` text NOT NULL,
  `ClassOfVehicleId` int(11) NOT NULL,
  `BrandId` int(11) NOT NULL,
  `VehicleSpecificationId` int(11) NOT NULL,
  `ColourId` int(11) NOT NULL,
  `VehicleCondition` int(11) NOT NULL,
  `NoOfOwners` int(11) NOT NULL,
  `ModelYear` int(11) NOT NULL,
  `KMsDriven` int(11) NOT NULL,
  `FuelTypeId` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `StatusUpdatedBy` varchar(15) NOT NULL,
  `StatusUpdatedDate` datetime NOT NULL,
  `CreatedBy` varchar(15) NOT NULL,
  `CreatedDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `poststatus`
--

CREATE TABLE `poststatus` (
  `Id` int(11) NOT NULL,
  `Name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `poststatus`
--

INSERT INTO `poststatus` (`Id`, `Name`) VALUES
(1, 'Active'),
(2, 'Inactive'),
(3, 'Relisted'),
(4, 'Deleted'),
(5, 'Sold Out');

-- --------------------------------------------------------

--
-- Table structure for table `systemuser`
--

CREATE TABLE `systemuser` (
  `Id` int(11) NOT NULL,
  `UserId` varchar(30) NOT NULL,
  `UserLevel` int(11) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `PhoneNo` varchar(15) NOT NULL,
  `Status` int(11) NOT NULL,
  `StatusUpdatedBy` varchar(30) NOT NULL,
  `StatusUpdatedDate` datetime NOT NULL,
  `CreatedBy` varchar(30) NOT NULL,
  `CreatedDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `systemuser`
--

INSERT INTO `systemuser` (`Id`, `UserId`, `UserLevel`, `UserName`, `Password`, `PhoneNo`, `Status`, `StatusUpdatedBy`, `StatusUpdatedDate`, `CreatedBy`, `CreatedDate`) VALUES
(8, '18111091497', 1, 'feros1', '202cb962ac59075b964b07152d234b70', '0754802222', 1, 'Admin', '2018-11-10 17:51:35', 'Admin', '2018-11-10 17:51:35'),
(9, 'MVU18111059580', 1, 'ishan1', '202cb962ac59075b964b07152d234b70', '07548067887', 2, 'Admin', '2018-11-10 19:03:12', '18111091497', '2018-11-10 19:03:12'),
(41, 'MVSU18112349982', 2, 'feros2', '202cb962ac59075b964b07152d234b70', '12345678902', 1, 'Admin', '2018-11-23 18:31:39', '18111091497', '2018-11-23 18:31:39'),
(42, 'MVSU18112305071', 3, 'feros3', '202cb962ac59075b964b07152d234b70', '0756902267', 1, 'Admin', '2018-11-23 19:05:49', '	\r\nMVSU18112349982', '2018-11-23 19:05:49'),
(43, 'MVSY18112332458', 2, 'Rilwan', '202cb962ac59075b964b07152d234b70', '0767103641', 1, 'Admin', '2018-11-23 19:10:21', 'MVU18111059580', '2018-11-23 19:10:21'),
(44, 'MV118112595966', 4, 'feros4', '202cb962ac59075b964b07152d234b70', '123456', 1, 'MVSU18112305071', '2018-11-25 09:31:10', 'MVSU18112305071', '2018-11-25 09:31:10'),
(45, 'MV118112578984', 3, 'ishan3', '202cb962ac59075b964b07152d234b70', '86869', 1, '1', '2018-11-25 10:21:43', 'MVSU18112349982', '2018-11-25 10:21:43'),
(46, 'MV218112588491', 4, 'ishan4', '202cb962ac59075b964b07152d234b70', 'dfhjdghj', 1, '1', '2018-11-25 10:22:18', 'MV118112578984', '2018-11-25 10:22:18'),
(47, 'MVU18112566435', 5, 'feros5', '202cb962ac59075b964b07152d234b70', '231434', 1, '18111091497', '2018-11-25 10:41:06', 'MV118112595966', '2018-11-25 10:41:06'),
(57, 'MV118120298941', 3, 'dfghdfg', 'dc1b4092ca5ad2cd16d773a5b7c1e46c', '0756902268', 1, '18111091497', '2018-12-02 13:11:07', '18111091497', '2018-12-02 13:11:07'),
(58, 'MV118120216750', 3, 'test123', '94ead75bbb6774121ad107d6b6550a0d', '0754802086', 1, 'MVSU18112349982', '2018-12-02 19:34:37', 'MVSU18112349982', '2018-12-02 19:34:37'),
(59, 'MV118120299964', 3, 'feros', '38ed36709eac3eff8203face5c85c213', '07569022683', 1, 'MVSU18112349982', '2018-12-02 20:09:04', 'MVSU18112349982', '2018-12-02 20:09:04'),
(60, 'MV218120229306', 4, 'feros', 'f8b4367708e4ed4945af7fe86bf433fa', '0756902', 1, 'MVSU18112349982', '2018-12-02 20:11:46', 'MVSU18112349982', '2018-12-02 20:11:46'),
(61, 'MV118120383459', 3, 'sinthujan', '64024269e32ec9a6a348456776c5e8e6', '0777355075', 1, 'MVSU18112349982', '2018-12-03 10:51:29', 'MVSU18112349982', '2018-12-03 10:51:29'),
(71, 'MV218120386888', 4, 'feros45', 'f7d1c30efc6d801e490a8bac4dd99d14', '07569022682', 1, 'MVSU18112349982', '2018-12-03 18:32:32', 'MVSU18112349982', '2018-12-03 18:32:32'),
(73, 'MV118120309696', 3, 'feros45', 'bf93869437a514804d8aec87c636ed34', '075690226823', 1, 'MVSU18112349982', '2018-12-03 18:33:11', 'MVSU18112349982', '2018-12-03 18:33:11'),
(75, 'MVSY18120528116', 2, 'feros', '280913f5b61bb2867ae802b192db9b84', '07569022685', 1, '18111091497', '2018-12-05 18:51:18', '18111091497', '2018-12-05 18:51:18');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `Id` int(11) NOT NULL,
  `Name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transmissiontype`
--

CREATE TABLE `transmissiontype` (
  `Id` int(11) NOT NULL,
  `Name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `userlevel`
--

CREATE TABLE `userlevel` (
  `Id` int(11) NOT NULL,
  `Name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userlevel`
--

INSERT INTO `userlevel` (`Id`, `Name`) VALUES
(1, 'Super Admin'),
(2, 'System Admin'),
(3, 'Level1 User'),
(4, 'Level2 User'),
(5, 'Site User');

-- --------------------------------------------------------

--
-- Table structure for table `userstatus`
--

CREATE TABLE `userstatus` (
  `Id` int(11) NOT NULL,
  `Name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userstatus`
--

INSERT INTO `userstatus` (`Id`, `Name`) VALUES
(1, 'Active'),
(2, 'Inactive'),
(3, 'Deleted');

-- --------------------------------------------------------

--
-- Table structure for table `vehiclecondition`
--

CREATE TABLE `vehiclecondition` (
  `Id` int(11) NOT NULL,
  `Name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vehicleimages`
--

CREATE TABLE `vehicleimages` (
  `id` int(11) NOT NULL,
  `PostId` varchar(30) DEFAULT NULL,
  `Description` varchar(100) DEFAULT NULL,
  `data` mediumblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vehiclespecification`
--

CREATE TABLE `vehiclespecification` (
  `Id` int(11) NOT NULL,
  `BrandId` int(11) NOT NULL,
  `Model` varchar(150) NOT NULL,
  `EngineType` varchar(50) NOT NULL,
  `EngineDescription` double NOT NULL,
  `NoofCylinders` int(11) NOT NULL,
  `MileageCity` double NOT NULL,
  `MileageHighway` double NOT NULL,
  `FuelTankCapacity` int(11) NOT NULL,
  `SeatingCapacity` int(11) NOT NULL,
  `TransmissionTypeId` int(11) NOT NULL,
  `AirConditioner` tinyint(1) NOT NULL,
  `AntiLockBrakingSystem` tinyint(1) NOT NULL,
  `PowerSteering` tinyint(1) NOT NULL,
  `PowerWindows` tinyint(1) NOT NULL,
  `CDPlayer` tinyint(1) NOT NULL,
  `LeatherSeats` tinyint(1) NOT NULL,
  `CentralLocking` tinyint(1) NOT NULL,
  `PowerDoorLocks` tinyint(1) NOT NULL,
  `BrakeAssist` tinyint(1) NOT NULL,
  `DriverAirbag` tinyint(1) NOT NULL,
  `PassengerAirbag` tinyint(1) NOT NULL,
  `CrashSensor` tinyint(1) NOT NULL,
  `EngineCheckWarning` tinyint(1) NOT NULL,
  `AutomaticHeadlamps` tinyint(1) NOT NULL,
  `CreatedBy` varchar(15) NOT NULL,
  `CreatedDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `classofvehicle`
--
ALTER TABLE `classofvehicle`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `colour`
--
ALTER TABLE `colour`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Status` (`Status`),
  ADD KEY `AgentId` (`AgentId`);

--
-- Indexes for table `companystatus`
--
ALTER TABLE `companystatus`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `fualtype`
--
ALTER TABLE `fualtype`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `CompanyId` (`CompanyId`),
  ADD KEY `AgentId` (`AgentId`),
  ADD KEY `ClassOfVehicleId` (`ClassOfVehicleId`),
  ADD KEY `BrandId` (`BrandId`),
  ADD KEY `VehicleSpecificationId` (`VehicleSpecificationId`),
  ADD KEY `ColourId` (`ColourId`),
  ADD KEY `VehicleCondition` (`VehicleCondition`),
  ADD KEY `FuelTypeId` (`FuelTypeId`),
  ADD KEY `Status` (`Status`);

--
-- Indexes for table `poststatus`
--
ALTER TABLE `poststatus`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `systemuser`
--
ALTER TABLE `systemuser`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `UserLevel` (`UserLevel`),
  ADD KEY `Status` (`Status`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `transmissiontype`
--
ALTER TABLE `transmissiontype`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `userlevel`
--
ALTER TABLE `userlevel`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `userstatus`
--
ALTER TABLE `userstatus`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `vehiclecondition`
--
ALTER TABLE `vehiclecondition`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `vehicleimages`
--
ALTER TABLE `vehicleimages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `PostId` (`PostId`);

--
-- Indexes for table `vehiclespecification`
--
ALTER TABLE `vehiclespecification`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `BrandId` (`BrandId`),
  ADD KEY `TransmissionTypeId` (`TransmissionTypeId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `classofvehicle`
--
ALTER TABLE `classofvehicle`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `colour`
--
ALTER TABLE `colour`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `companystatus`
--
ALTER TABLE `companystatus`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `fualtype`
--
ALTER TABLE `fualtype`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `poststatus`
--
ALTER TABLE `poststatus`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `systemuser`
--
ALTER TABLE `systemuser`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transmissiontype`
--
ALTER TABLE `transmissiontype`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `userlevel`
--
ALTER TABLE `userlevel`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `userstatus`
--
ALTER TABLE `userstatus`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `vehiclecondition`
--
ALTER TABLE `vehiclecondition`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vehicleimages`
--
ALTER TABLE `vehicleimages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vehiclespecification`
--
ALTER TABLE `vehiclespecification`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `company`
--
ALTER TABLE `company`
  ADD CONSTRAINT `company_ibfk_1` FOREIGN KEY (`AgentId`) REFERENCES `systemuser` (`Id`),
  ADD CONSTRAINT `company_ibfk_5` FOREIGN KEY (`Status`) REFERENCES `companystatus` (`Id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`CompanyId`) REFERENCES `company` (`Id`),
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`ClassOfVehicleId`) REFERENCES `classofvehicle` (`Id`),
  ADD CONSTRAINT `posts_ibfk_3` FOREIGN KEY (`BrandId`) REFERENCES `brand` (`Id`),
  ADD CONSTRAINT `posts_ibfk_4` FOREIGN KEY (`VehicleSpecificationId`) REFERENCES `vehiclespecification` (`Id`),
  ADD CONSTRAINT `posts_ibfk_5` FOREIGN KEY (`VehicleCondition`) REFERENCES `vehiclecondition` (`Id`),
  ADD CONSTRAINT `posts_ibfk_6` FOREIGN KEY (`ColourId`) REFERENCES `colour` (`Id`),
  ADD CONSTRAINT `posts_ibfk_7` FOREIGN KEY (`FuelTypeId`) REFERENCES `fualtype` (`Id`),
  ADD CONSTRAINT `posts_ibfk_8` FOREIGN KEY (`Status`) REFERENCES `poststatus` (`Id`);

--
-- Constraints for table `systemuser`
--
ALTER TABLE `systemuser`
  ADD CONSTRAINT `systemuser_ibfk_1` FOREIGN KEY (`UserLevel`) REFERENCES `userlevel` (`Id`),
  ADD CONSTRAINT `systemuser_ibfk_5` FOREIGN KEY (`Status`) REFERENCES `userstatus` (`Id`);

--
-- Constraints for table `vehiclespecification`
--
ALTER TABLE `vehiclespecification`
  ADD CONSTRAINT `vehiclespecification_ibfk_1` FOREIGN KEY (`TransmissionTypeId`) REFERENCES `transmissiontype` (`Id`),
  ADD CONSTRAINT `vehiclespecification_ibfk_2` FOREIGN KEY (`BrandId`) REFERENCES `brand` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

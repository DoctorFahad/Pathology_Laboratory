-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 17, 2024 at 04:00 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pathologylab_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `AdminId` int NOT NULL AUTO_INCREMENT,
  `FullName` text NOT NULL,
  `UserName` text NOT NULL,
  `ContactNo` text NOT NULL,
  `Email` text NOT NULL,
  `Passwd` text NOT NULL,
  PRIMARY KEY (`AdminId`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminId`, `FullName`, `UserName`, `ContactNo`, `Email`, `Passwd`) VALUES
(13, 'Farhan Kalkal', 'klkl007', '1234500099', 'fahadpatel0607@gmail.com', 'klkl'),
(24, 'Mustakim Diwan', 'musti', '9876543210', 'mustakimdiwan89@gmail.com', '*I9#W'),
(25, 'Sultan Basheri', 'sultan', '9569569560', 'sullu08@gmail.com', '12345'),
(26, 'Nuzaid', 'Nvip', '6565897852', 'nuzaidpatel09537@gmail.com', 'Q@Jt@');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

DROP TABLE IF EXISTS `delivery`;
CREATE TABLE IF NOT EXISTS `delivery` (
  `DeliveryId` int NOT NULL AUTO_INCREMENT,
  `PickUpId` int NOT NULL,
  `DeliveryDate` date NOT NULL,
  `DBId` int NOT NULL,
  PRIMARY KEY (`DeliveryId`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`DeliveryId`, `PickUpId`, `DeliveryDate`, `DBId`) VALUES
(2, 2, '2024-01-10', 3),
(9, 7, '2024-02-22', 3),
(10, 10, '2024-02-27', 3),
(26, 20, '2024-03-11', 4),
(12, 11, '2024-02-27', 3),
(13, 12, '2024-02-27', 3),
(14, 7, '2024-03-07', 3),
(22, 16, '2024-03-07', 3),
(25, 19, '2024-03-11', 4),
(20, 15, '2024-03-07', 3),
(18, 13, '2024-03-07', 3),
(19, 14, '2024-03-07', 3),
(23, 17, '2024-03-08', 4),
(24, 18, '2024-03-11', 4),
(27, 26, '2024-03-11', 4),
(28, 21, '2024-03-11', 4),
(29, 22, '2024-03-11', 4),
(32, 25, '2024-03-27', 4),
(31, 24, '2024-03-11', 4),
(33, 27, '2024-03-28', 4),
(34, 32, '2024-04-01', 3),
(35, 33, '2024-04-01', 3),
(36, 34, '2024-04-01', 3),
(37, 34, '2024-04-01', 3),
(38, 34, '2024-04-01', 3),
(39, 34, '2024-04-01', 3),
(40, 35, '2024-04-02', 3),
(41, 36, '2024-04-08', 3);

-- --------------------------------------------------------

--
-- Table structure for table `deliveryboy`
--

DROP TABLE IF EXISTS `deliveryboy`;
CREATE TABLE IF NOT EXISTS `deliveryboy` (
  `DBId` int NOT NULL AUTO_INCREMENT,
  `FullName` text NOT NULL,
  `ContactNo` text NOT NULL,
  `LicenseNo` text NOT NULL,
  `ExpiryDate` date NOT NULL,
  `Email` text NOT NULL,
  `Passwd` text NOT NULL,
  `UserName` text NOT NULL,
  PRIMARY KEY (`DBId`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deliveryboy`
--

INSERT INTO `deliveryboy` (`DBId`, `FullName`, `ContactNo`, `LicenseNo`, `ExpiryDate`, `Email`, `Passwd`, `UserName`) VALUES
(3, 'Fahad Patel', '9897989898', 'SD1001234567678', '2024-03-28', 'fhd@gmail.com', '12345', 'sahil'),
(4, 'Farhan Klkl', '9765498765', 'GS2009123434567', '2030-03-28', 'farhan12@gmail.com', '000', 'klkl321'),
(12, 'Patel Adnan', '9876543210', 'AJ1234567891234', '2024-03-30', 'fahadpatel0607@gmail.com', 'R6Cvj', 'addy');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

DROP TABLE IF EXISTS `doctor`;
CREATE TABLE IF NOT EXISTS `doctor` (
  `DoctorId` int NOT NULL AUTO_INCREMENT,
  `HospitalId` int NOT NULL,
  `FullName` text NOT NULL,
  `Address` text NOT NULL,
  `ContactNo` text NOT NULL,
  `Alternate` text NOT NULL,
  `Email` text NOT NULL,
  `Commission` float NOT NULL,
  PRIMARY KEY (`DoctorId`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`DoctorId`, `HospitalId`, `FullName`, `Address`, `ContactNo`, `Alternate`, `Email`, `Commission`) VALUES
(9, 2, 'Dr. Akib patel', 'A-5, National Park Society, Bypass Road, Bharuch', '9131234567', '9454324332', 'akibptl@gmail.com', 5),
(2, 5, 'Dr. Fahad', 'B-10, Gokulnagar, kukarwada Road, Bharuch ', '9232325654', '9254545874', 'fahadpatel0607@gmail.com', 8),
(6, 6, 'Dr. Sahil', 'C-1, Vadi Street, Karmad, Bharuch', '9478523690', '9876543210', 'Sahil123@gmail.com', 7),
(11, 7, 'Dr. Lukman', 'C-10, Lakshminagar Society, Vapi, Surat', '9782301987', '9898214360', 'Lukman09@gmail.com', 3),
(12, 8, 'Dr. Kiran', 'D-07, Shella Society, Bharuch', '9463876908', '9723147650', 'kiranpatel@gmail.con', 6),
(13, 4, 'Dr. Ketan', 'Rahul Vila, Nandelav, Bharuch', '7876534908', '', 'ketan05@gmail.com', 4),
(14, 9, 'Dr. Rajiv', 'A-10, Neelam Society, Bharuch', '9806046210', '', 'drajiv12@gmail.com', 2);

-- --------------------------------------------------------

--
-- Table structure for table `doctorpay`
--

DROP TABLE IF EXISTS `doctorpay`;
CREATE TABLE IF NOT EXISTS `doctorpay` (
  `DocPayId` int NOT NULL AUTO_INCREMENT,
  `DoctorId` int NOT NULL,
  `Amount` float NOT NULL,
  `PaidDate` date NOT NULL,
  `PayMode` text NOT NULL,
  `RefNo` int NOT NULL,
  PRIMARY KEY (`DocPayId`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctorpay`
--

INSERT INTO `doctorpay` (`DocPayId`, `DoctorId`, `Amount`, `PaidDate`, `PayMode`, `RefNo`) VALUES
(10, 2, 100, '2024-03-11', 'Cash', 555),
(11, 9, 140, '2024-04-02', 'Cash', 123);

-- --------------------------------------------------------

--
-- Table structure for table `hosallocation`
--

DROP TABLE IF EXISTS `hosallocation`;
CREATE TABLE IF NOT EXISTS `hosallocation` (
  `AllocationId` int NOT NULL AUTO_INCREMENT,
  `HospitalId` int NOT NULL,
  `StaffId` int NOT NULL,
  `AllocationDate` date NOT NULL,
  PRIMARY KEY (`AllocationId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hosallocation`
--

INSERT INTO `hosallocation` (`AllocationId`, `HospitalId`, `StaffId`, `AllocationDate`) VALUES
(1, 2, 4, '2024-01-06'),
(2, 4, 3, '2024-01-08'),
(3, 5, 3, '2024-01-11');

-- --------------------------------------------------------

--
-- Table structure for table `hospital`
--

DROP TABLE IF EXISTS `hospital`;
CREATE TABLE IF NOT EXISTS `hospital` (
  `HospitalId` int NOT NULL AUTO_INCREMENT,
  `HospitalName` text NOT NULL,
  `Address` text NOT NULL,
  `ContactNo` text NOT NULL,
  `Alternate` text NOT NULL,
  `Email` text NOT NULL,
  PRIMARY KEY (`HospitalId`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hospital`
--

INSERT INTO `hospital` (`HospitalId`, `HospitalName`, `Address`, `ContactNo`, `Alternate`, `Email`) VALUES
(4, 'Apex Multispeciality Hospital', 'Railway Station Rd, Adarsh Market, Panchbatti, Bharuch', '9545454545', '9565898780', 'apexmulti@gmail.com'),
(2, 'City-Care Hospital', '1st floor, Neelam Investment Complex, Bypass, Bharuch', '9232325654', '9254545874', 'citycare210@gmail.com'),
(5, 'JB Modi', 'Shital Complex, Lal bazar, Bharuch', '9495454330', '9565898210', 'jbmodiI5568@gmail.com'),
(6, 'RVM ', '2nd Floor, Seth Complex, Muhammad Pura, Bharuch ', '9999882650', '9565898780', 'rvm999@gmail.com'),
(7, 'Baroda Heart', 'Capital Business Centre,Wing-B Panchbatti, Bharuch', '9234567809', '9231234567', 'barodaheart@gmail.com'),
(8, 'Civil Hospital', 'Moficer Jin compound, Bharuch ', '9293929394', '9087654321', 'civil@gmail.com'),
(9, 'Palmland Hospital', 'Railway Station Road', '7970767678', '7878787970', 'palmland2@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `patientmaster`
--

DROP TABLE IF EXISTS `patientmaster`;
CREATE TABLE IF NOT EXISTS `patientmaster` (
  `PatientId` int NOT NULL AUTO_INCREMENT,
  `FullName` text NOT NULL,
  `ContactNo` text NOT NULL,
  `DOB` date NOT NULL,
  `Age` int NOT NULL,
  `Gender` text NOT NULL,
  `AdharNo` text NOT NULL,
  `Email` text NOT NULL,
  PRIMARY KEY (`PatientId`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patientmaster`
--

INSERT INTO `patientmaster` (`PatientId`, `FullName`, `ContactNo`, `DOB`, `Age`, `Gender`, `AdharNo`, `Email`) VALUES
(2, 'Nuzaid', '1232655522', '1997-01-03', 27, 'Male', '123234351234', 'nvip007@gmail.com'),
(4, 'Fahad Patel', '9854785415', '2015-06-28', 10, 'Male', '123456781234', 'abc@gmail.com'),
(5, 'Kauser Panjabi', '9658745154', '2024-01-18', 26, 'Female', '965874521458', 'abc@gmail.com'),
(6, 'Farhan Kalkal', '1234597890', '2002-02-21', 20, 'Male', '123412341234', 'klkl@gmail.com'),
(7, 'Abrar Diwan', '9897919293', '2014-03-10', 19, 'Male', '200212345434', 'abu12@gmail.com'),
(8, 'Safvan Chetan', '9876598765', '2009-06-11', 20, 'Male', '123456781234', 'safvan@gmail.com'),
(9, 'Usama Patel', '9876546547', '2003-06-11', 20, 'Male', '123412341200', 'usama12@gmail.com'),
(10, 'Zaid Keri', '9876987609', '2014-01-11', 18, 'Male', '123456781234', 'nauman@gmail.com'),
(11, 'Ultimate Batek', '9874325678', '2004-03-11', 19, 'FeMale', '123234350000', 'batek@gmail.com'),
(12, 'Patel Mustakim', '9876543210', '2016-02-17', 8, 'Male', '123456781234', 'klkl@gmail.com'),
(13, 'Rahul Choudary', '7912983490', '2020-01-09', 4, 'Male', '126234350600', 'rahulchoudary@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `pickup`
--

DROP TABLE IF EXISTS `pickup`;
CREATE TABLE IF NOT EXISTS `pickup` (
  `PickUpId` int NOT NULL AUTO_INCREMENT,
  `ReceiptId` int NOT NULL,
  `PickUpDate` date NOT NULL,
  `DBId` int NOT NULL,
  PRIMARY KEY (`PickUpId`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pickup`
--

INSERT INTO `pickup` (`PickUpId`, `ReceiptId`, `PickUpDate`, `DBId`) VALUES
(15, 27, '2024-03-07', 3),
(9, 7, '2024-02-27', 1),
(10, 21, '2024-02-27', 1),
(11, 23, '2024-02-27', 1),
(12, 24, '2024-02-27', 1),
(13, 25, '2024-03-07', 3),
(14, 26, '2024-03-07', 3),
(16, 25, '2024-03-07', 3),
(17, 28, '2024-03-08', 4),
(18, 29, '2024-03-11', 4),
(19, 30, '2024-03-11', 4),
(20, 31, '2024-03-11', 4),
(21, 32, '2024-03-11', 4),
(22, 33, '2024-03-11', 4),
(27, 41, '2024-03-28', 4),
(24, 34, '2024-03-11', 4),
(25, 35, '2024-03-11', 4),
(26, 37, '2024-03-11', 4),
(35, 45, '2024-04-02', 3),
(34, 44, '2024-04-01', 3),
(33, 43, '2024-04-01', 3),
(32, 42, '2024-04-01', 3),
(36, 46, '2024-04-08', 3);

-- --------------------------------------------------------

--
-- Table structure for table `receiptdetail`
--

DROP TABLE IF EXISTS `receiptdetail`;
CREATE TABLE IF NOT EXISTS `receiptdetail` (
  `RecDetailId` int NOT NULL AUTO_INCREMENT,
  `TestId` int NOT NULL,
  `ReceiptId` int NOT NULL,
  `Cost` float NOT NULL,
  PRIMARY KEY (`RecDetailId`)
) ENGINE=MyISAM AUTO_INCREMENT=77 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `receiptdetail`
--

INSERT INTO `receiptdetail` (`RecDetailId`, `TestId`, `ReceiptId`, `Cost`) VALUES
(1, 32, 1, 410),
(2, 31, 1, 300),
(3, 32, 2, 410),
(4, 32, 3, 410),
(5, 31, 3, 300),
(6, 32, 3, 410),
(7, 31, 3, 300),
(8, 32, 4, 410),
(9, 31, 5, 300),
(10, 31, 5, 300),
(11, 31, 5, 300),
(12, 31, 5, 300),
(13, 31, 6, 300),
(14, 31, 6, 300),
(15, 32, 7, 410),
(16, 31, 8, 300),
(17, 31, 9, 300),
(18, 32, 10, 410),
(19, 31, 11, 300),
(20, 32, 12, 410),
(21, 32, 13, 410),
(22, 32, 14, 410),
(23, 32, 15, 410),
(24, 31, 16, 300),
(25, 32, 17, 410),
(26, 32, 18, 410),
(27, 39, 18, 230),
(28, 31, 18, 350),
(29, 39, 18, 230),
(30, 32, 20, 410),
(31, 31, 20, 350),
(32, 32, 21, 410),
(33, 31, 21, 350),
(34, 39, 21, 230),
(35, 32, 22, 410),
(36, 39, 22, 230),
(37, 31, 23, 350),
(38, 39, 23, 230),
(39, 31, 24, 350),
(40, 31, 25, 350),
(41, 31, 26, 350),
(42, 39, 26, 230),
(43, 32, 27, 410),
(44, 31, 28, 350),
(45, 32, 29, 410),
(46, 39, 29, 230),
(47, 31, 30, 350),
(48, 32, 31, 410),
(49, 31, 31, 350),
(50, 39, 31, 230),
(51, 31, 32, 350),
(52, 39, 33, 230),
(53, 39, 34, 230),
(54, 32, 35, 410),
(55, 32, 35, 410),
(56, 32, 36, 410),
(57, 31, 38, 350),
(58, 31, 39, 350),
(59, 39, 39, 230),
(60, 31, 40, 350),
(61, 31, 41, 350),
(62, 31, 42, 350),
(63, 31, 43, 350),
(64, 31, 44, 350),
(65, 39, 44, 230),
(66, 31, 45, 350),
(67, 39, 45, 230),
(68, 31, 46, 350),
(69, 41, 47, 290),
(70, 42, 47, 150),
(71, 32, 48, 350),
(72, 46, 48, 270),
(73, 49, 48, 400),
(74, 43, 49, 70),
(75, 44, 49, 110),
(76, 45, 49, 150);

-- --------------------------------------------------------

--
-- Table structure for table `receiptmaster`
--

DROP TABLE IF EXISTS `receiptmaster`;
CREATE TABLE IF NOT EXISTS `receiptmaster` (
  `ReceiptId` int NOT NULL AUTO_INCREMENT,
  `PatientId` int NOT NULL,
  `DoctorId` int NOT NULL,
  `HospitalId` int NOT NULL,
  `PaymentMode` text NOT NULL,
  `ReferenceNo` text NOT NULL,
  `Date` date NOT NULL,
  `Total` float NOT NULL,
  `Priority` text NOT NULL,
  `StaffId` int DEFAULT NULL,
  PRIMARY KEY (`ReceiptId`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `receiptmaster`
--

INSERT INTO `receiptmaster` (`ReceiptId`, `PatientId`, `DoctorId`, `HospitalId`, `PaymentMode`, `ReferenceNo`, `Date`, `Total`, `Priority`, `StaffId`) VALUES
(1, 4, 2, 2, 'Cash', '4125455', '2024-01-19', 710, 'Default', NULL),
(2, 2, 2, 2, 'Cash', '1123456', '2024-01-15', 410, 'High', NULL),
(25, 7, 6, 7, 'Cash', '1001', '2024-02-29', 350, 'Normal', 7),
(4, 2, 2, 2, 'Cash', '112345', '2024-01-16', 410, 'High', NULL),
(5, 2, 2, 2, 'Online', '112345', '2024-01-14', 300, 'Normel', NULL),
(6, 4, 2, 5, 'Online', '412545', '2024-01-14', 300, 'High', NULL),
(42, 6, 2, 7, 'Cash', '', '2024-04-01', 350, 'High', 8),
(8, 4, 2, 4, 'Cash', '412545', '2024-01-09', 300, 'Default', NULL),
(9, 2, 2, 2, 'Online', '412545', '2024-01-21', 300, 'Default', NULL),
(10, 2, 4, 5, 'Cash', '112345', '2024-01-21', 410, 'Default', NULL),
(11, 2, 2, 2, 'Cash', '112345', '2024-01-02', 300, 'Default', NULL),
(12, 4, 5, 2, 'Cash', '112345', '2024-01-29', 410, 'Default', NULL),
(13, 4, 6, 4, 'Cash', '112345', '2024-01-29', 410, 'Default', NULL),
(14, 2, 2, 2, 'Cash', '112345', '2024-01-29', 410, 'Default', NULL),
(15, 4, 5, 5, 'Cash', '112345', '2024-01-29', 410, 'Default', NULL),
(16, 5, 2, 2, 'Online', '1001', '2024-01-02', 300, 'Normal', NULL),
(17, 5, 2, 2, 'Cash', '123', '2024-01-11', 410, 'Normal', NULL),
(19, 2, 9, 5, 'Online', '545454', '2024-02-13', 580, 'Normal', 0),
(20, 2, 2, 2, 'Cash', 'gg', '2024-02-22', 760, 'High', 0),
(21, 4, 2, 2, 'Online', '544', '2024-02-18', 990, 'Normal', 7),
(22, 4, 6, 2, 'Online', '2001', '2024-02-26', 640, 'Normal', 0),
(23, 5, 2, 2, 'Cash', '2000', '2024-02-26', 580, 'Normal', 6),
(24, 5, 9, 2, 'Cash', '123', '2024-02-26', 350, 'High', 6),
(26, 5, 2, 2, 'Cash', '1000', '2024-02-26', 580, 'High', 7),
(27, 2, 6, 2, 'Cash', '1001', '2024-03-04', 410, 'High', 7),
(28, 4, 6, 4, 'Cash', '10001', '2024-03-07', 350, 'High', 7),
(29, 7, 2, 6, 'Cash', '1001', '2024-03-11', 640, 'High', 7),
(30, 8, 2, 2, 'Cash', '1001', '2024-03-11', 350, 'High', 7),
(31, 9, 6, 6, 'Cash', '2001', '2024-03-11', 990, 'High', 7),
(32, 9, 9, 4, 'Cash', '2001', '2024-03-10', 350, 'High', 7),
(33, 10, 6, 5, 'Cash', '2001', '2024-03-11', 230, 'High', 7),
(34, 8, 6, 5, 'Cash', '10001', '2024-03-03', 230, 'High', 7),
(35, 10, 6, 6, 'Online', '1001', '2024-03-10', 410, 'High', 7),
(37, 11, 2, 6, 'Cash', '1001', '2024-03-11', 410, 'High', 7),
(38, 4, 2, 5, 'Cash', '1001', '2024-03-27', 350, 'High', 0),
(39, 5, 2, 4, 'Online', '101', '2024-03-20', 580, 'High', 0),
(40, 4, 2, 2, 'Cash', '1001', '2024-03-27', 350, 'High', 0),
(41, 6, 6, 5, 'Cash', '1002', '2024-03-28', 350, 'High', 7),
(43, 10, 9, 4, 'Cash', '', '2024-04-01', 350, 'High', 8),
(44, 7, 9, 2, 'Cash', '', '2024-04-01', 580, 'High', 8),
(45, 8, 9, 5, 'Online', '101', '2024-04-02', 580, 'High', 8),
(46, 7, 6, 2, 'Online', '123', '2024-04-08', 350, 'High', 7),
(47, 13, 11, 7, 'Cash', '', '2024-04-12', 440, 'Normal', 0),
(48, 8, 14, 9, 'Cash', '', '2024-04-12', 1020, 'High', 0),
(49, 11, 13, 4, 'Online', '10098121', '2024-04-12', 330, 'High', 0);

-- --------------------------------------------------------

--
-- Table structure for table `reportresult`
--

DROP TABLE IF EXISTS `reportresult`;
CREATE TABLE IF NOT EXISTS `reportresult` (
  `ReportId` int NOT NULL AUTO_INCREMENT,
  `TestId` int NOT NULL,
  `Result` text NOT NULL,
  `ReceiptId` int NOT NULL,
  PRIMARY KEY (`ReportId`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reportresult`
--

INSERT INTO `reportresult` (`ReportId`, `TestId`, `Result`, `ReceiptId`) VALUES
(2, 32, '50', 1),
(3, 31, '99', 1),
(4, 32, '55', 4),
(5, 32, '50', 2),
(6, 31, '45', 45),
(7, 39, '11', 45);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
CREATE TABLE IF NOT EXISTS `staff` (
  `StaffId` int NOT NULL AUTO_INCREMENT,
  `FullName` text NOT NULL,
  `UserName` text NOT NULL,
  `Address` text NOT NULL,
  `ContactNo` text NOT NULL,
  `Gender` text NOT NULL,
  `DOB` date NOT NULL,
  `DOJ` date NOT NULL,
  `Email` text NOT NULL,
  `Passwd` text NOT NULL,
  PRIMARY KEY (`StaffId`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`StaffId`, `FullName`, `UserName`, `Address`, `ContactNo`, `Gender`, `DOB`, `DOJ`, `Email`, `Passwd`) VALUES
(7, 'fuzail bhai', 'fahad', 'sherpura', '4545452136', 'Male', '2024-02-07', '2024-02-04', 'nuzaidpatel09537@gmail.com', '12345'),
(6, 'Nuzaid', 'Nvip', 'Sherpura', '1254521254', 'Male', '2024-02-01', '2024-02-03', 'fahadpatel0607@gmail.com', 'D@Eb$'),
(8, 'Abrar Diwan', 'abu', 'Valan', '9876543210', 'Male', '2013-05-28', '2021-09-16', 'fahadpatel0607@gmail.com', 'kxFgc'),
(9, 'Farhan Kalkal', 'klkl', 'Dungri', '9876543210', 'Male', '2024-01-11', '2024-04-02', 'nuzaidpatel09537@gmail.com', 'Ho#8y');

-- --------------------------------------------------------

--
-- Table structure for table `testdetails`
--

DROP TABLE IF EXISTS `testdetails`;
CREATE TABLE IF NOT EXISTS `testdetails` (
  `TestId` int NOT NULL AUTO_INCREMENT,
  `TestName` text NOT NULL,
  `NormalRange` text NOT NULL,
  `Unit` text NOT NULL,
  `Cost` int NOT NULL,
  PRIMARY KEY (`TestId`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testdetails`
--

INSERT INTO `testdetails` (`TestId`, `TestName`, `NormalRange`, `Unit`, `Cost`) VALUES
(32, 'Serum Triglycerid', ' <150', 'mg/dl', 350),
(31, 'Diabetes', '     90-130', 'gm%', 350),
(39, 'Urine', ' 10-16', 'mg/l', 230),
(40, 'Fasting Sugar', ' 70-110', 'mg/dl', 50),
(41, 'HDL Cholestrol', ' 30-65', 'mg/dl', 290),
(42, 'VLDL Cholestrol', ' 5-40', 'mg/dl', 150),
(43, 'Free triiodothyronine', ' 1.7-4.2', 'pg/ml', 70),
(44, 'Free Thyroxine', ' 0.7-1.8', 'ng/ml', 110),
(45, 'Thyroid stimulating hormone', ' 0.3-5.5', 'uLU/ml', 150),
(46, 'serum phophorus', ' 2.1-5.6', 'mg/dl', 270),
(47, 'serum uric acid', ' 2.5-7.0', 'mg/dl', 340),
(48, 'serum creatinine', ' 0.6-1.2', 'mg%', 210),
(49, 'serum biarbonates', ' 21-32', 'mmol/L', 400);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

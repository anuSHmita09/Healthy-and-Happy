-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2025 at 07:02 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `handh`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminId` varchar(10) NOT NULL,
  `adminName` varchar(30) NOT NULL,
  `password` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminId`, `adminName`, `password`) VALUES
('123456', 'vivek', '123456'),
('7487', 'vinayak', '1234567');

-- --------------------------------------------------------

--
-- Table structure for table `bodyeval`
--

CREATE TABLE `bodyeval` (
  `Id` varchar(10) NOT NULL,
  `UNAME` varchar(30) DEFAULT NULL,
  `HEIGHT` varchar(3) DEFAULT NULL,
  `WEIGHT` varchar(6) DEFAULT NULL,
  `BODYFAT` varchar(6) DEFAULT NULL,
  `BMI` varchar(6) DEFAULT NULL,
  `VFA` varchar(5) DEFAULT NULL,
  `BODYAGE` varchar(3) DEFAULT NULL,
  `RM` varchar(6) DEFAULT NULL,
  `CHEST` varchar(3) DEFAULT NULL,
  `WAIST` varchar(3) DEFAULT NULL,
  `HIP` varchar(3) DEFAULT NULL,
  `Date` varchar(10) NOT NULL,
  `MEDICATION` varchar(100) DEFAULT NULL,
  `REMARKS` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bodyeval`
--

INSERT INTO `bodyeval` (`Id`, `UNAME`, `HEIGHT`, `WEIGHT`, `BODYFAT`, `BMI`, `VFA`, `BODYAGE`, `RM`, `CHEST`, `WAIST`, `HIP`, `Date`, `MEDICATION`, `REMARKS`) VALUES
('05RS/00001', 'Anushmita', '150', '45', '14', '28', '8', '19', '1345', '32', '32', '34', '2025-05-02', 'NA', 'NA'),
('05RS25/005', 'KESTO', '150', '78', '20', '80', '15', '14', '25', '15', '78', '56', '2025-05-06', 'LIST', 'REMARKS'),
('05RS25/012', 'viv', '169', '78', '56', '86', '45', '56', '45', '35', '34', '25', '2025-05-05', 'pppp', 'qqq'),
('05RS25/014', 'ving', '162', '74', '40', '45', '25', '14', '25', '35', '35', '25', '2025-07-06', 'pressure', 'moderate'),
('05RS25/025', 'vinayak', '162', '76', '52', '56', '15', '25', '12', '35', '34', '15', '2025-05-07', 'pressure', 'pop'),
('05RS25/048', 'ANUSHMITA', '156', '65', '30', '29.7', '20', '34', '1431', '32', '34', '32', '2025-04-17', 'NA', 'NA'),
('05RS25/050', 'SANCHITA', '150', '79', '50', '152', '25', '32', '25', '36', '32', '32', '2025-02-03', 'NONE', 'HEALTHY');

-- --------------------------------------------------------

--
-- Table structure for table `daily`
--

CREATE TABLE `daily` (
  `id` varchar(10) NOT NULL,
  `date` varchar(10) NOT NULL,
  `uname` varchar(30) NOT NULL,
  `weight` varchar(6) DEFAULT NULL,
  `TOTALAMOUNT` varchar(6) DEFAULT NULL,
  `amountpaid` varchar(6) DEFAULT NULL,
  `amountdue` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `daily`
--

INSERT INTO `daily` (`id`, `date`, `uname`, `weight`, `TOTALAMOUNT`, `amountpaid`, `amountdue`) VALUES
('05RS25/012', '2025-05-05', 'viv', '78', '₹800', '600', '₹200'),
('05RS25/014', '2025-07-06', 'ving', '74', '₹800', '800', '₹0'),
('05RS25/025', '2025-05-07', 'vinayak', '76', '₹800', '800', '₹0'),
('05RS25/025', '2025-05-07', 'vinayak', '70', '7400', '7400', '0'),
('05RS25/012', '2025-05-07', 'viv', '76', '₹800', '800', '₹0'),
('05RS25/014', '2025-05-08', 'ving', '72', '7400', '5000', '2400');

-- --------------------------------------------------------

--
-- Table structure for table `existbody`
--

CREATE TABLE `existbody` (
  `EID` varchar(10) DEFAULT NULL,
  `ENAME` varchar(30) DEFAULT NULL,
  `EHEIGHT` varchar(3) DEFAULT NULL,
  `EWEIGHT` varchar(6) DEFAULT NULL,
  `EBODYFAT` varchar(6) DEFAULT NULL,
  `EBMI` varchar(6) DEFAULT NULL,
  `EVFA` varchar(3) DEFAULT NULL,
  `EBODYAGE` varchar(3) DEFAULT NULL,
  `ERM` varchar(6) DEFAULT NULL,
  `ECHEST` varchar(3) DEFAULT NULL,
  `EWAIST` varchar(3) DEFAULT NULL,
  `EHIP` varchar(3) DEFAULT NULL,
  `EDATE` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `existpay`
--

CREATE TABLE `existpay` (
  `ETOTALAMOUNT` varchar(6) DEFAULT NULL,
  `EAMOUNTPAID` varchar(6) DEFAULT NULL,
  `EAMOUNTDUE` varchar(6) DEFAULT NULL,
  `EMODEOFPAY` varchar(8) DEFAULT NULL,
  `EDATE` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `existpersonal`
--

CREATE TABLE `existpersonal` (
  `EID` varchar(10) DEFAULT NULL,
  `ENAME` varchar(30) DEFAULT NULL,
  `EGENDER` varchar(6) DEFAULT NULL,
  `EDOB` varchar(10) DEFAULT NULL,
  `EAGE` varchar(3) DEFAULT NULL,
  `EPHONE` varchar(10) DEFAULT NULL,
  `EADDRESS` varchar(50) DEFAULT NULL,
  `ECOACH` varchar(30) DEFAULT NULL,
  `EDATE` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `TOTALAMOUNT` varchar(6) DEFAULT NULL,
  `AMOUNTPAID` varchar(6) DEFAULT NULL,
  `AMOUNTDUE` varchar(6) DEFAULT NULL,
  `MODEOFPAY` varchar(8) DEFAULT NULL,
  `DATE` varchar(10) DEFAULT NULL,
  `ID` varchar(10) DEFAULT NULL,
  `UNAME` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`TOTALAMOUNT`, `AMOUNTPAID`, `AMOUNTDUE`, `MODEOFPAY`, `DATE`, `ID`, `UNAME`) VALUES
('₹800', '600', '₹200', 'Cash', '2025-05-05', '05RS25/012', 'viv'),
('₹800', '800', '₹0', 'UPI', '2025-07-06', '05RS25/001', 'vinayak'),
('₹800', '800', '₹0', 'UPI', '2025-07-06', '05RS25/014', 'ving'),
('₹800', '800', '₹0', 'UPI', '2025-05-07', '05RS25/025', 'vinayak'),
('₹800', '200', '₹600', 'UPI', '2025-04-17', '05RS25/048', 'ANUSHMITA'),
('₹800', '800', '₹0', 'Cash', '2025-02-03', '05RS25/050', 'SANCHITA'),
('₹800', '0', '₹800', 'Cash', '2025-05-06', '05RS25/005', 'KESTO'),
('₹800', '120', '₹680', 'Cash', '2025-05-02', '05RS/00001', 'Anushmita');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `Id` varchar(10) NOT NULL,
  `uname` varchar(30) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `dob` varchar(10) NOT NULL,
  `age` varchar(3) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `uaddress` varchar(50) NOT NULL,
  `coach` varchar(30) NOT NULL,
  `trialDate` varchar(10) NOT NULL,
  `goldums` varchar(10) NOT NULL,
  `Status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`Id`, `uname`, `gender`, `dob`, `age`, `phone`, `uaddress`, `coach`, `trialDate`, `goldums`, `Status`) VALUES
('05RS/00001', 'Anushmita', 'Female', '2005-02-23', '20', '12345678', 'BLR', 'Rakibul', '2025-05-02', '2025-05-05', NULL),
('05RS25/001', 'vinayak', 'Male', '2010-10-27', '14', '9800082833', 'shivmandir', 'Sanchita', '2025-07-06', '2025-07-09', NULL),
('05RS25/005', 'KESTO', 'Male', '1980-12-12', '44', '9632547812', 'Shivmandir', 'ABHIJIT', '2025-05-06', '2025-05-09', NULL),
('05RS25/012', 'viv', 'Male', '1978-11-12', '46', '7718790210', 'shivmandir', 'sanchita', '2025-05-05', '2025-05-08', NULL),
('05RS25/014', 'ving', 'Male', '2010-10-27', '14', '9800082833', 'shivmandir', 'Sanchita', '2025-07-06', '2025-07-09', NULL),
('05RS25/025', 'vinayak', 'Male', '2010-10-27', '14', '9800082833', 'shivmandir', 'sanchita', '2025-05-07', '2025-05-10', NULL),
('05RS25/048', 'ANUSHMITA', 'Female', '2005-02-23', '20', '7894563210', 'SHIVMANDIR', 'ABHIJIT', '2025-04-17', '2025-04-20', NULL),
('05RS25/050', 'SANCHITA', 'Female', '1984-05-03', '41', '9002063664', 'JALPAIGURI', 'ABHIJIT PAL', '2025-02-03', '2025-02-06', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bodyeval`
--
ALTER TABLE `bodyeval`
  ADD PRIMARY KEY (`Id`,`Date`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`Id`);
COMMIT;

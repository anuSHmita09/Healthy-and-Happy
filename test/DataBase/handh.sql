-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2025 at 04:09 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `handh`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateexistPerson` ()  BEGIN
    DECLARE done BOOLEAN DEFAULT FALSE;
    DECLARE uid varchar(10);
    DECLARE uname varchar(30);
    DECLARE gender varchar(6);
    DECLARE dob varchar(10);
    DECLARE age varchar(3);
    DECLARE phone varchar(10);
    DECLARE uaddress varchar(50);
    DECLARE coach varchar(30);
    DECLARE udate varchar(10);

    -- Declare the cursor
    DECLARE UPDATE_cursor CURSOR FOR 
       SELECT DISTINCT(r.id), r.uname,r.gender,r.dob,r.age,r.phone,r.uaddress,r.coach,r.goldums FROM daily d, registration r WHERE r.id=d.id and r.Status='Trial' and d.id in(select d.id from daily d group by d.id, d.uname having count(d.id)=3);

    -- Declare a handler for the NOT FOUND condition
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

    -- Open the cursor
    OPEN UPDATE_cursor;

    -- Loop through the rows
    read_loop:LOOP
        FETCH UPDATE_cursor INTO uid, uname,gender,dob,age,phone,uaddress,coach,udate;
        -- EXIT WHEN UPDATE_cursor%NOTFound;
        IF done THEN
	DELETE FROM daily where id=uid;
          LEAVE read_loop;
       END IF;

       
INSERT IGNORE INTO EXISTPERSONAL (EID,ENAME,EGENDER,EDOB,EAGE,EPHONE,EADDRESS,ECOACH,EDATE,STATUS) VALUES(uid,uname,gender,dob,age,phone,uaddress,coach,udate,'ACTIVE');

    END LOOP;

    -- Close the cursor
    CLOSE UPDATE_cursor;
    -- commit the CHANGE
    -- COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UPDATE_bodyeval_cursor` ()  BEGIN
DECLARE done BOOLEAN DEFAULT FALSE;
    DECLARE eid varchar(10);
    DECLARE ename varchar(30);
    DECLARE eheight varchar(3);
    DECLARE eweight varchar(6);
    DECLARE ebodyfat varchar(3);
    DECLARE ebmi varchar(6);
    DECLARE evfa varchar(3);
    DECLARE ebodyage varchar(3);
    DECLARE erm varchar(6);
    DECLARE echest varchar(3);
    DECLARE ewaist varchar(3);
    DECLARE ehip varchar(3);
    DECLARE edate varchar(10);
    DECLARE emedication varchar(100);
    DECLARE eremarks varchar(50);

     

    -- Declare the cursor
    DECLARE UPDATE_bodyeval_cursor CURSOR FOR 
       SELECT DISTINCT(r.id), r.uname, b.HEIGHT, b.WEIGHT, b.BODYFAT, b.BMI, b.VFA, b.BODYAGE, b.RM, b.CHEST, b.WAIST, b.HIP,b.Date, b.MEDICATION, b.REMARKS FROM bodyeval b, registration r WHERE r.id=b.id;

    -- Declare a handler for the NOT FOUND condition
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

    -- Open the cursor
    OPEN UPDATE_bodyeval_cursor;

    -- Loop through the rows
    read_loop:LOOP
        FETCH UPDATE_bodyeval_cursor INTO eid, ename,eheight,eweight,ebodyfat,ebmi,evfa,ebodyage,erm,echest,ewaist,ehip,edate, emedication,eremarks;
        
        -- EXIT WHEN UPDATE_cursor%NOTFound;
        IF done THEN
	DELETE FROM bodyeval where id=eid;
          LEAVE read_loop;
       END IF;

       
INSERT IGNORE INTO existbody(EID,ENAME,EHEIGHT,EWEIGHT,EBODYFAT,EBMI,EVFA,EBODYAGE,ERM,ECHEST,EWAIST,EHIP,EDATE,EMEDICATION,EREMARKS) VALUES(eid, ename,eheight,eweight,ebodyfat,ebmi,evfa,ebodyage,erm,echest,ewaist,ehip,edate, emedication,eremarks);

    END LOOP;

    -- Close the cursor
    CLOSE UPDATE_bodyeval_cursor;
    -- commit the CHANGE
    -- COMMIT;
END$$

DELIMITER ;

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
('05RS/Slg', 'ANUSHMITA', '12345');

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
('05RS25/004', 'ANUSHMITA', '162', '65', '150', '80', '25', '56', '25', '36', '34', '33', '2025-05-01', 'NA', 'NA');

-- --------------------------------------------------------

--
-- Table structure for table `daily`
--

CREATE TABLE `daily` (
  `id` varchar(10) NOT NULL,
  `cur_date` varchar(10) NOT NULL,
  `uname` varchar(30) NOT NULL,
  `weight` varchar(6) DEFAULT NULL,
  `TOTALAMOUNT` varchar(6) DEFAULT NULL,
  `amountpaid` varchar(6) DEFAULT NULL,
  `amountdue` varchar(6) DEFAULT NULL,
  `STATUS` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `daily`
--

INSERT INTO `daily` (`id`, `cur_date`, `uname`, `weight`, `TOTALAMOUNT`, `amountpaid`, `amountdue`, `STATUS`) VALUES
('05RS25/004', '', 'ANUSHMITA', '65', '₹800', '600', '₹200', 'Trial'),
('05RS25/004', '2025-05-09', 'ANUSHMITA', '65', '₹800', '400', '-400', ''),
('05RS25/004', '2025-05-06', 'ANUSHMITA', '65', '₹800', '1200', '-1200', 'Active');

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
  `EDATE` varchar(10) DEFAULT NULL,
  `EMEDICATION` varchar(100) NOT NULL,
  `EREMARKS` varchar(50) NOT NULL
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
  `EID` varchar(10) NOT NULL,
  `ENAME` varchar(30) DEFAULT NULL,
  `EGENDER` varchar(6) DEFAULT NULL,
  `EDOB` varchar(10) DEFAULT NULL,
  `EAGE` varchar(3) DEFAULT NULL,
  `EPHONE` varchar(10) DEFAULT NULL,
  `EADDRESS` varchar(50) DEFAULT NULL,
  `ECOACH` varchar(30) DEFAULT NULL,
  `EDATE` varchar(10) DEFAULT NULL,
  `STATUS` varchar(10) DEFAULT NULL
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
  `UNAME` varchar(30) DEFAULT NULL,
  `STATUS` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`TOTALAMOUNT`, `AMOUNTPAID`, `AMOUNTDUE`, `MODEOFPAY`, `DATE`, `ID`, `UNAME`, `STATUS`) VALUES
('₹800', '600', '₹200', 'Cash', '2025-05-01', '05RS25/004', 'ANUSHMITA', 'Trial');

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
('05RS25/004', 'ANUSHMITA', 'Female', '2005-02-23', '20', '9632547812', 'Shivmandir', 'ABHIJIT PAL', '2025-05-01', '2025-05-04', 'Trial');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bodyeval`
--
ALTER TABLE `bodyeval`
  ADD PRIMARY KEY (`Id`,`Date`);

--
-- Indexes for table `existpersonal`
--
ALTER TABLE `existpersonal`
  ADD PRIMARY KEY (`EID`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

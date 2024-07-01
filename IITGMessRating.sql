-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 01, 2019 at 12:50 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `IITGMessRating`
--

-- --------------------------------------------------------

--
-- Table structure for table `Feedback`
--

CREATE TABLE `Feedback` (
  `ID` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `HostelSubscribed` varchar(30) NOT NULL,
  `Feedback` varchar(50000) NOT NULL,
  `YearMonth` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Feedback`
--

INSERT INTO `Feedback` (`ID`, `Username`, `HostelSubscribed`, `Feedback`, `YearMonth`) VALUES
(6, 'udbha170123055', 'Kapili', 'The food is delicious . The quality is excellent really. I am loving it.', '201904'),
(7, 'baran170102035', 'Lohit', 'The food is pathetic I hate it It is tasteless and filled with insects !!', '201904'),
(8, 'shiva170123047', 'Kapili', 'good verygood outstanding !!', '201905');

-- --------------------------------------------------------

--
-- Table structure for table `Hostels`
--

CREATE TABLE `Hostels` (
  `Name` varchar(30) NOT NULL,
  `MessManagerUsername` varchar(50) NOT NULL,
  `MessManagerPassword` varchar(50) NOT NULL,
  `MessManagerName` varchar(50) NOT NULL,
  `MessManagerContactNumber` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Hostels`
--

INSERT INTO `Hostels` (`Name`, `MessManagerUsername`, `MessManagerPassword`, `MessManagerName`, `MessManagerContactNumber`) VALUES
('Barak', 'barak', '551a70c29d91bc8b4c59bed50e38cd53', 'Barack Obama', '097430979430'),
('Brahmaputra', 'brahmaputra', '762985108cb9ba102b3631c0a63f3d21', 'Narendra Modi', '987493750'),
('Dhansiri', 'dhansiri', 'de6f334ef461e8919fa1516b8aa85821', 'Lionel Messi', '90943709579'),
('Dihing', 'dihing', 'e22dab888a999c1838220f2dc65a3484', 'Shahrukh Khan', '98273954937'),
('Kapili', 'kapili', '342a588bb029dc5d9faa4f2c88a672a1', 'Amitabh Bachhan', '8860695878'),
('Lohit', 'lohit', 'facb6460875b14ea8f8cdacdb38a90cf', 'Rohit Shetty', '8402028442'),
('Manas', 'manas', '5d45c58ea1ef37f17c2f885219215426', 'Michael Jackson', '8402028443'),
('Siang', 'siang', '22b90c7a49552cff20e161d8c0f3902e', 'Ranbir Kapoor', '97045670957'),
('Subansiri', 'subansiri', '16d8389173b7fc41df0ac40d0b692e7f', 'Python Jackson', '8402028442'),
('Umium', 'umium', '3491b02ac7019168d53304e07ccbd68e', 'Neil Nitin Mukesh', '09780837540');

-- --------------------------------------------------------

--
-- Table structure for table `Keywords`
--

CREATE TABLE `Keywords` (
  `KeyName` varchar(50) NOT NULL,
  `Value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Keywords`
--

INSERT INTO `Keywords` (`KeyName`, `Value`) VALUES
('acidic', -2),
('amazing', 4),
('appetizing', 4),
('awful', -3),
('bad', -3),
('bitter', -2),
('burnt', -4),
('delicious', 4),
('delightful', 4),
('enjoyable', 3),
('excellent', 5),
('good', 3),
('insects', -5),
('msierable', -4),
('okayish', 1),
('outstanding', 5),
('pathetic', -5),
('pitful', -2),
('plain', -2),
('pleasant', 2),
('poor', -2),
('tasteful', 2),
('tasteless', -3),
('tastly', 3),
('terrible', -4),
('useless', -1),
('verybad', -4),
('verygood', 4);

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `RollNumber` varchar(20) NOT NULL DEFAULT '-',
  `Name` varchar(100) NOT NULL,
  `HostelReside` varchar(30) NOT NULL DEFAULT '-',
  `HostelSubscribed` varchar(30) NOT NULL DEFAULT '-',
  `HostelNew` varchar(30) NOT NULL DEFAULT '-',
  `Program` varchar(10) NOT NULL DEFAULT '-',
  `Designation` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`Username`, `Password`, `RollNumber`, `Name`, `HostelReside`, `HostelSubscribed`, `HostelNew`, `Program`, `Designation`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', '-', 'Admin', '-', '-', '-', '-', 'admin'),
('annan170101007', '202cb962ac59075b964b07152d234b70', '170101007', 'Annanay Pratap', 'Lohit', 'Lohit', '-', 'B.Tech.', 'student'),
('baran170102035', '202cb962ac59075b964b07152d234b70', '170101084', 'Mayank Baranwal', 'Kapili', 'Lohit', '-', 'B.Tech.', 'student'),
('gulat170123030', '202cb962ac59075b964b07152d234b70', '170101082', 'Lavish Gulati', 'Kapili', 'Kapili', '-', 'B.Tech.', 'student'),
('gupta170101019', '202cb962ac59075b964b07152d234b70', '170101019', 'Chirag', 'Lohit', 'Kapili', '-', 'B.Tech.', 'student'),
('shiva170123047', '202cb962ac59075b964b07152d234b70', '170101086', 'Shivang Dalal', 'Lohit', 'Kapili', '-', 'B.Tech.', 'student'),
('tanya170123052', '202cb962ac59075b964b07152d234b70', '170123052', 'Tanya Chuahan', 'Subansiri', 'Lohit', '-', 'B.Tech.', 'student'),
('udbha170123055', '202cb962ac59075b964b07152d234b70', '170101081', 'Udbhav Chugh', 'Lohit', 'Kapili', '-', 'B.Tech.', 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Feedback`
--
ALTER TABLE `Feedback`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Hostels`
--
ALTER TABLE `Hostels`
  ADD PRIMARY KEY (`MessManagerUsername`);

--
-- Indexes for table `Keywords`
--
ALTER TABLE `Keywords`
  ADD PRIMARY KEY (`KeyName`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Feedback`
--
ALTER TABLE `Feedback`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

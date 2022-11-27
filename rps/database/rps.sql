-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2020 at 08:28 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rps`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `StudentId` int(50) NOT NULL,
  `DaysAttended` int(4) DEFAULT NULL,
  `TotalDays` int(4) DEFAULT NULL,
  `Year` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`StudentId`, `DaysAttended`, `TotalDays`, `Year`) VALUES
(29, 62, 75, 2020),
(30, 66, 75, 2020),
(31, 68, 75, 2020),
(32, 50, 75, 2020),
(33, 56, 75, 2020),
(35, 49, 75, 2020),
(36, 68, 75, 2020),
(37, 63, 75, 2020);

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `ClassName` varchar(80) DEFAULT NULL,
  `ClassNameNumeric` int(4) DEFAULT NULL,
  `Section` varchar(5) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `ClassName`, `ClassNameNumeric`, `Section`, `CreationDate`, `UpdationDate`) VALUES
(20, 'Grade Six', 6, 'C', '2020-11-11 08:21:44', NULL),
(21, 'Grade Seven', 7, 'B', '2020-11-11 08:21:59', NULL),
(22, 'Grade Eight', 8, 'C', '2020-11-11 08:22:22', NULL),
(23, 'Grade Nine', 9, 'A', '2020-11-11 08:22:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gradingsystem`
--

CREATE TABLE `gradingsystem` (
  `ClassId` int(11) NOT NULL,
  `Excellent` decimal(50,0) NOT NULL,
  `VeryGood` decimal(50,0) NOT NULL,
  `Good` decimal(50,0) NOT NULL,
  `Average` decimal(50,0) NOT NULL,
  `BelowAverage` decimal(50,0) NOT NULL,
  `TotalMark` decimal(50,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gradingsystem`
--

INSERT INTO `gradingsystem` (`ClassId`, `Excellent`, `VeryGood`, `Good`, `Average`, `BelowAverage`, `TotalMark`) VALUES
(20, '71', '70', '60', '45', '35', '100'),
(22, '76', '75', '60', '50', '40', '100'),
(23, '76', '75', '65', '55', '45', '100');

-- --------------------------------------------------------

--
-- Table structure for table `headteacher`
--

CREATE TABLE `headteacher` (
  `id` int(11) NOT NULL,
  `UserName` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `updationDate` timestamp NULL DEFAULT NULL,
  `Role` varchar(11) NOT NULL DEFAULT 'headteacher'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `headteacher`
--

INSERT INTO `headteacher` (`id`, `UserName`, `Password`, `updationDate`, `Role`) VALUES
(2, 'headteacher', '1a1dc91c907325c69271ddf0c944bc72', NULL, 'headteacher');

-- --------------------------------------------------------

--
-- Table structure for table `meritlist`
--

CREATE TABLE `meritlist` (
  `MeritId` int(11) NOT NULL,
  `StudentName` varchar(100) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) CHARACTER SET latin1 DEFAULT '1A1DC91C907325C69271DDF0C944BC72',
  `Total` varchar(10) NOT NULL,
  `CurrentStatus` varchar(100) NOT NULL,
  `ClassId` int(11) NOT NULL,
  `MarkObtained` decimal(10,0) NOT NULL,
  `ClassName` varchar(50) NOT NULL,
  `Status` int(1) NOT NULL,
  `StudentId` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `meritlist`
--

INSERT INTO `meritlist` (`MeritId`, `StudentName`, `UserName`, `Password`, `Total`, `CurrentStatus`, `ClassId`, `MarkObtained`, `ClassName`, `Status`, `StudentId`) VALUES
(55, 'Frank Tembo', '112', '1A1DC91C907325C69271DDF0C944BC72', '300', 'null', 22, '259', 'Grade Eight(C)', 1, '31'),
(56, 'Jack Chilo', '100', '1A1DC91C907325C69271DDF0C944BC72', '300', 'null', 22, '89', 'Grade Eight(C)', 1, '29'),
(57, 'Jane Chomba', '113', '1A1DC91C907325C69271DDF0C944BC72', '300', 'null', 22, '183', 'Grade Eight(C)', 1, '32'),
(61, 'Bill Chitambo', '456', '1A1DC91C907325C69271DDF0C944BC72', '300', 'null', 20, '221', 'Grade Six(C)', 1, '35'),
(62, 'Harry Banda', '459', '1A1DC91C907325C69271DDF0C944BC72', '300', 'null', 20, '159', 'Grade Six(C)', 1, '37'),
(63, 'Terry Mulenga', '457', '1A1DC91C907325C69271DDF0C944BC72', '300', 'null', 20, '89', 'Grade Six(C)', 1, '36'),
(64, 'Stephen Mwanza', '114', '1A1DC91C907325C69271DDF0C944BC72', '300', 'null', 22, '223', 'Grade Eight(C)', 1, '33'),
(66, 'John Phiri', '111', '1A1DC91C907325C69271DDF0C944BC72', '300', 'null', 22, '139', 'Grade Eight(C)', 1, '30');

-- --------------------------------------------------------

--
-- Table structure for table `midmeritlist`
--

CREATE TABLE `midmeritlist` (
  `MeritId` int(11) NOT NULL,
  `StudentName` varchar(100) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) CHARACTER SET latin1 DEFAULT '1A1DC91C907325C69271DDF0C944BC72',
  `Total` varchar(10) NOT NULL,
  `CurrentStatus` varchar(100) NOT NULL,
  `ClassId` int(11) NOT NULL,
  `MarkObtained` decimal(10,0) NOT NULL,
  `ClassName` varchar(50) NOT NULL,
  `Status` int(1) NOT NULL,
  `StudentId` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `midmeritlist`
--

INSERT INTO `midmeritlist` (`MeritId`, `StudentName`, `UserName`, `Password`, `Total`, `CurrentStatus`, `ClassId`, `MarkObtained`, `ClassName`, `Status`, `StudentId`) VALUES
(55, 'Frank Tembo', '112', '1A1DC91C907325C69271DDF0C944BC72', '300', 'Passed', 22, '224', 'Grade Eight(C)', 1, '31'),
(56, 'Jack Chilo', '100', '1A1DC91C907325C69271DDF0C944BC72', '300', 'null', 22, '164', 'Grade Eight(C)', 1, '29'),
(60, 'Jane Chomba', '113', '1A1DC91C907325C69271DDF0C944BC72', '300', 'Passed', 22, '159', 'Grade Eight(C)', 1, '32'),
(61, 'Stephen Mwanza', '114', '1A1DC91C907325C69271DDF0C944BC72', '300', 'Passed', 22, '266', 'Grade Eight(C)', 1, '33'),
(62, 'Bill Chitambo', '456', '1A1DC91C907325C69271DDF0C944BC72', '300', 'Passed', 20, '183', 'Grade Six(C)', 1, '35'),
(63, 'Harry Banda', '459', '1A1DC91C907325C69271DDF0C944BC72', '300', 'Passed', 20, '71', 'Grade Six(C)', 1, '37'),
(64, 'Terry Mulenga', '457', '1A1DC91C907325C69271DDF0C944BC72', '300', 'Passed', 20, '204', 'Grade Six(C)', 1, '36');

-- --------------------------------------------------------

--
-- Table structure for table `midresult`
--

CREATE TABLE `midresult` (
  `id` int(11) NOT NULL,
  `StudentId` int(11) DEFAULT NULL,
  `ClassId` int(11) DEFAULT NULL,
  `SubjectId` int(11) DEFAULT NULL,
  `marks` int(11) DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL,
  `passMark` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `midresult`
--

INSERT INTO `midresult` (`id`, `StudentId`, `ClassId`, `SubjectId`, `marks`, `PostingDate`, `UpdationDate`, `passMark`) VALUES
(143, 31, 22, 15, 89, '2020-11-12 07:13:39', NULL, NULL),
(144, 31, 22, 18, 60, '2020-11-12 07:13:39', NULL, NULL),
(145, 31, 22, 14, 75, '2020-11-12 07:13:39', NULL, NULL),
(146, 29, 22, 15, 48, '2020-11-12 07:16:41', NULL, NULL),
(147, 29, 22, 18, 60, '2020-11-12 07:16:41', NULL, NULL),
(148, 29, 22, 14, 56, '2020-11-12 07:16:41', NULL, NULL),
(158, 32, 22, 15, 56, '2020-11-12 08:14:59', NULL, NULL),
(159, 32, 22, 18, 43, '2020-11-12 08:14:59', NULL, NULL),
(160, 32, 22, 14, 60, '2020-11-12 08:14:59', NULL, NULL),
(161, 33, 22, 15, 85, '2020-11-12 08:15:48', NULL, NULL),
(162, 33, 22, 18, 87, '2020-11-12 08:15:48', NULL, NULL),
(163, 33, 22, 14, 94, '2020-11-12 08:15:48', NULL, NULL),
(164, 35, 20, 16, 78, '2020-11-12 08:18:15', NULL, NULL),
(165, 35, 20, 14, 61, '2020-11-12 08:18:17', NULL, NULL),
(166, 35, 20, 17, 44, '2020-11-12 08:18:17', NULL, NULL),
(167, 37, 20, 16, 25, '2020-11-12 08:19:09', NULL, NULL),
(168, 37, 20, 14, 12, '2020-11-12 08:19:09', NULL, NULL),
(169, 37, 20, 17, 34, '2020-11-12 08:19:09', NULL, NULL),
(170, 36, 20, 16, 57, '2020-11-12 08:19:35', NULL, NULL),
(171, 36, 20, 14, 67, '2020-11-12 08:19:35', NULL, NULL),
(172, 36, 20, 17, 80, '2020-11-12 08:19:35', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `id` int(11) NOT NULL,
  `StudentId` int(11) DEFAULT NULL,
  `ClassId` int(11) DEFAULT NULL,
  `SubjectId` int(11) DEFAULT NULL,
  `marks` int(11) DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL,
  `passMark` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`id`, `StudentId`, `ClassId`, `SubjectId`, `marks`, `PostingDate`, `UpdationDate`, `passMark`) VALUES
(143, 31, 22, 15, 94, '2020-11-11 18:48:02', NULL, NULL),
(144, 31, 22, 18, 75, '2020-11-11 18:48:02', NULL, NULL),
(145, 31, 22, 14, 90, '2020-11-11 18:48:02', NULL, NULL),
(146, 29, 22, 15, 45, '2020-11-11 18:50:46', NULL, NULL),
(147, 29, 22, 18, 25, '2020-11-11 18:50:46', NULL, NULL),
(148, 29, 22, 14, 19, '2020-11-11 18:50:46', NULL, NULL),
(149, 32, 22, 15, 78, '2020-11-11 18:51:14', NULL, NULL),
(150, 32, 22, 18, 56, '2020-11-11 18:51:15', NULL, NULL),
(151, 32, 22, 14, 49, '2020-11-11 18:51:15', NULL, NULL),
(161, 35, 20, 16, 78, '2020-11-11 19:47:12', NULL, NULL),
(162, 35, 20, 14, 98, '2020-11-11 19:47:13', NULL, NULL),
(163, 35, 20, 17, 45, '2020-11-11 19:47:13', NULL, NULL),
(164, 37, 20, 16, 60, '2020-11-11 19:47:45', NULL, NULL),
(165, 37, 20, 14, 45, '2020-11-11 19:47:46', NULL, NULL),
(166, 37, 20, 17, 54, '2020-11-11 19:47:46', NULL, NULL),
(167, 36, 20, 16, 12, '2020-11-11 19:48:13', NULL, NULL),
(168, 36, 20, 14, 34, '2020-11-11 19:48:13', NULL, NULL),
(169, 36, 20, 17, 43, '2020-11-11 19:48:14', NULL, NULL),
(170, 33, 22, 15, 67, '2020-11-12 08:16:27', NULL, NULL),
(171, 33, 22, 18, 83, '2020-11-12 08:16:27', NULL, NULL),
(172, 33, 22, 14, 73, '2020-11-12 08:16:27', NULL, NULL),
(176, 30, 22, 15, 55, '2020-12-02 11:06:32', NULL, NULL),
(177, 30, 22, 18, 45, '2020-12-02 11:06:32', NULL, NULL),
(178, 30, 22, 14, 39, '2020-12-02 11:06:32', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `StudentId` int(11) NOT NULL,
  `StudentName` varchar(100) DEFAULT NULL,
  `RollId` varchar(100) DEFAULT NULL,
  `StudentEmail` varchar(100) DEFAULT NULL,
  `Gender` varchar(10) DEFAULT NULL,
  `DOB` varchar(100) DEFAULT NULL,
  `ClassId` int(11) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL,
  `Status` int(1) DEFAULT NULL,
  `Role` varchar(11) NOT NULL DEFAULT 'student',
  `Password` varchar(100) NOT NULL DEFAULT '1A1DC91C907325C69271DDF0C944BC72'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`StudentId`, `StudentName`, `RollId`, `StudentEmail`, `Gender`, `DOB`, `ClassId`, `RegDate`, `UpdationDate`, `Status`, `Role`, `Password`) VALUES
(29, 'Jack Chilo', '100', 'jack@gmail.com', 'Male', '2005-11-02', 22, '2020-11-11 16:45:24', NULL, 1, 'student', '1A1DC91C907325C69271DDF0C944BC72'),
(30, 'John Phiri', '111', 'john@gmail.com', 'Male', '2004-07-04', 22, '2020-11-11 16:45:57', NULL, 1, 'student', '1A1DC91C907325C69271DDF0C944BC72'),
(31, 'Frank Tembo', '112', 'frank@gmail.com', 'Male', '2006-11-06', 22, '2020-11-11 16:46:36', NULL, 1, 'student', '1a1dc91c907325c69271ddf0c944bc72'),
(32, 'Jane Chomba', '113', 'jane@gmail.com', 'Female', '2005-05-09', 22, '2020-11-11 16:47:33', NULL, 1, 'student', '1A1DC91C907325C69271DDF0C944BC72'),
(33, 'Stephen Mwanza', '114', 'stephen@gmail.com', 'Female', '2003-11-06', 22, '2020-11-11 16:49:50', NULL, 1, 'student', '1A1DC91C907325C69271DDF0C944BC72'),
(35, 'Bill Chitambo', '456', 'bill@gmail.com', 'Male', '2003-12-03', 20, '2020-11-11 19:36:59', NULL, 1, 'student', '1A1DC91C907325C69271DDF0C944BC72'),
(36, 'Terry Mulenga', '457', 'terry@gmail.com', 'Male', '2004-08-03', 20, '2020-11-11 19:38:14', NULL, 1, 'student', '1A1DC91C907325C69271DDF0C944BC72'),
(37, 'Harry Banda', '459', 'harry@gmail.com', 'Male', '2006-04-01', 20, '2020-11-11 19:39:10', NULL, 1, 'student', '1A1DC91C907325C69271DDF0C944BC72');

-- --------------------------------------------------------

--
-- Table structure for table `subjectcombination`
--

CREATE TABLE `subjectcombination` (
  `id` int(11) NOT NULL,
  `ClassId` int(11) DEFAULT NULL,
  `SubjectId` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `Updationdate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjectcombination`
--

INSERT INTO `subjectcombination` (`id`, `ClassId`, `SubjectId`, `status`, `CreationDate`, `Updationdate`) VALUES
(43, 22, 14, 1, '2020-11-11 15:20:11', NULL),
(44, 22, 15, 1, '2020-11-11 15:20:21', NULL),
(46, 20, 14, 1, '2020-11-11 15:22:06', NULL),
(47, 22, 18, 1, '2020-11-11 15:23:09', NULL),
(48, 20, 16, 1, '2020-11-11 19:42:50', NULL),
(49, 20, 17, 1, '2020-11-11 19:43:16', NULL),
(50, 26, 20, 1, '2020-12-10 11:51:02', NULL),
(51, 26, 18, 1, '2020-12-10 11:51:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `SubjectName` varchar(100) NOT NULL,
  `SubjectCode` varchar(100) DEFAULT NULL,
  `Creationdate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `SubjectName`, `SubjectCode`, `Creationdate`, `UpdationDate`) VALUES
(14, 'Maths', 'MAT', '2020-11-11 14:11:35', NULL),
(15, 'English', 'ENG', '2020-11-11 14:11:47', NULL),
(16, 'Computer Studies', 'CS', '2020-11-11 14:12:12', NULL),
(17, 'Social Studies', 'SS', '2020-11-11 14:12:24', NULL),
(18, 'Geography', 'GPY', '2020-11-11 14:12:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `TeacherId` int(11) NOT NULL,
  `TeacherName` varchar(100) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) CHARACTER SET latin1 DEFAULT '1A1DC91C907325C69271DDF0C944BC72',
  `TeacherEmail` varchar(100) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `DOB` varchar(100) NOT NULL,
  `ClassId` int(11) NOT NULL,
  `RegDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `Status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`TeacherId`, `TeacherName`, `UserName`, `Password`, `TeacherEmail`, `Gender`, `DOB`, `ClassId`, `RegDate`, `UpdationDate`, `Status`) VALUES
(14, 'Cholwe Mwanza', 'cholwe', '1a1dc91c907325c69271ddf0c944bc72', 'cholwe@gmail.com', 'Male', '1990-11-10', 22, '2020-11-11 17:31:01', '2020-12-10 19:14:27', 1),
(15, 'Rarry Phiri', 'rarry', '1A1DC91C907325C69271DDF0C944BC72', 'rarry@gmail.com', 'Male', '1992-06-03', 21, '2020-11-11 17:31:42', NULL, 1),
(16, 'Albert Chisomo', 'albert', '1A1DC91C907325C69271DDF0C944BC72', 'albert@gmail.com', 'Male', '1994-01-01', 20, '2020-11-11 17:32:28', NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`StudentId`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gradingsystem`
--
ALTER TABLE `gradingsystem`
  ADD PRIMARY KEY (`ClassId`);

--
-- Indexes for table `headteacher`
--
ALTER TABLE `headteacher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meritlist`
--
ALTER TABLE `meritlist`
  ADD PRIMARY KEY (`MeritId`);

--
-- Indexes for table `midmeritlist`
--
ALTER TABLE `midmeritlist`
  ADD PRIMARY KEY (`MeritId`);

--
-- Indexes for table `midresult`
--
ALTER TABLE `midresult`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`StudentId`);

--
-- Indexes for table `subjectcombination`
--
ALTER TABLE `subjectcombination`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`TeacherId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `headteacher`
--
ALTER TABLE `headteacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `meritlist`
--
ALTER TABLE `meritlist`
  MODIFY `MeritId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `midmeritlist`
--
ALTER TABLE `midmeritlist`
  MODIFY `MeritId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `midresult`
--
ALTER TABLE `midresult`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=182;

--
-- AUTO_INCREMENT for table `result`
--
ALTER TABLE `result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `StudentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `subjectcombination`
--
ALTER TABLE `subjectcombination`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `TeacherId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

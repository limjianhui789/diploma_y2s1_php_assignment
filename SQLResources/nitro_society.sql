-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2023 at 10:53 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nitro_society`
--

-- --------------------------------------------------------

--
-- Table structure for table `nitro_booking`
--

CREATE TABLE `nitro_booking` (
  `bookingID` int(11) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `studentID` varchar(10) DEFAULT NULL,
  `bookingDate` date DEFAULT NULL,
  `bookingTime` time DEFAULT NULL,
  `eventID` int(11) DEFAULT NULL,
  `paymentID` int(11) DEFAULT NULL,
  `is_delete` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nitro_booking`
--

INSERT INTO `nitro_booking` (`bookingID`, `username`, `studentID`, `bookingDate`, `bookingTime`, `eventID`, `paymentID`, `is_delete`) VALUES
(18, 'user1', '21PMD09156', '2022-09-29', '19:09:11', 43, 22, b'0'),
(19, 'user2', '21PMD09155', '2022-09-29', '19:11:03', 43, 23, b'1'),
(20, 'user2', '21PMD09156', '2022-09-29', '19:12:48', 43, 24, b'0'),
(21, 'user2', '21PMD09156', '2022-09-29', '19:14:38', 45, 25, b'0'),
(22, 'user1', '21PMD09156', '2022-09-29', '20:39:00', 48, 26, b'0'),
(23, 'user1', '21PMD09156', '2022-09-29', '20:42:09', 46, 27, b'0'),
(24, 'user1', '21PMD09156', '2022-09-29', '21:15:57', 41, 28, b'0'),
(25, 'user1', '21PMD09156', '2022-09-29', '21:18:11', 41, 29, b'0'),
(26, 'user1', '21PMD09156', '2022-09-29', '21:18:52', 41, 30, b'0'),
(27, 'user1', '21PMD09156', '2022-09-29', '21:20:30', 41, 31, b'0'),
(28, 'user1', '21PMD09156', '2022-09-29', '21:21:48', 41, 32, b'0'),
(29, 'user1', '21PMD09156', '2022-09-29', '21:22:55', 41, 33, b'0'),
(30, 'user1', '21PMD09156', '2022-09-29', '21:22:59', 41, 34, b'0'),
(31, 'user1', '21PMD09156', '2022-10-01', '13:23:11', 41, 35, b'0'),
(32, 'user1', '21PMD09156', '2022-10-01', '13:59:24', 47, 36, b'0'),
(33, 'user1', '21PMD09156', '2022-10-01', '14:00:37', 46, 37, b'0');

-- --------------------------------------------------------

--
-- Table structure for table `nitro_category`
--

CREATE TABLE `nitro_category` (
  `categoryName` varchar(20) CHARACTER SET latin1 NOT NULL,
  `categoryIcon` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `is_delete` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nitro_category`
--

INSERT INTO `nitro_category` (`categoryName`, `categoryIcon`, `is_delete`) VALUES
('Competition', 'bi bi-trophy', b'0'),
('Other', 'bi bi-box', b'0'),
('Show', 'bi bi-speaker', b'0'),
('Talk', 'bi bi-chat-dots', b'0'),
('Unknown', 'bi bi-columns-gap', b'0');

-- --------------------------------------------------------

--
-- Table structure for table `nitro_event`
--

CREATE TABLE `nitro_event` (
  `eventID` int(11) NOT NULL,
  `eventName` varchar(50) DEFAULT NULL,
  `eventDesc` varchar(500) DEFAULT NULL,
  `eventStartDate` date DEFAULT NULL,
  `eventStartTime` time DEFAULT NULL,
  `eventEndDate` date DEFAULT NULL,
  `eventEndTime` time DEFAULT NULL,
  `eventSeats` int(11) DEFAULT NULL,
  `seatAvailable` int(11) DEFAULT NULL,
  `pricePerPax` double(7,2) DEFAULT NULL,
  `posterID` int(11) DEFAULT NULL,
  `categoryName` varchar(20) DEFAULT NULL,
  `venueName` varchar(30) DEFAULT NULL,
  `is_deleted` bit(1) DEFAULT NULL,
  `is_draft` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nitro_event`
--

INSERT INTO `nitro_event` (`eventID`, `eventName`, `eventDesc`, `eventStartDate`, `eventStartTime`, `eventEndDate`, `eventEndTime`, `eventSeats`, `seatAvailable`, `pricePerPax`, `posterID`, `categoryName`, `venueName`, `is_deleted`, `is_draft`) VALUES
(41, 'Metaverse', 'Metaverse Explore The New World Virtual', '2022-10-10', '12:00:00', '2022-10-16', '12:00:00', 50, 42, 0.00, 62, 'Talk', 'DK H', b'0', b'0'),
(42, 'Back To School', 'Open House ( Back To School ) Join Us Now !\r\nOfficial Website: www.reallygreatsite.com', '2022-10-10', '18:30:00', '2022-10-18', '18:30:00', 100, 100, 0.00, 63, 'Show', 'Foyer', b'0', b'0'),
(43, 'Young Design', 'Spelling Bee, Storytelling, Crossword, Skit Competition.\r\nThe total prize of $4000 for the winner.', '2022-10-11', '18:30:00', '2022-10-12', '18:30:00', 20, 14, 50.00, 64, 'Show', 'DK A', b'0', b'0'),
(44, 'Star Night', 'Star Night Party Included Free Parking and Free Beer!', '2022-11-11', '18:30:00', '2022-11-12', '03:30:00', 100, 100, 50.00, 65, 'Other', 'Club House', b'0', b'0'),
(45, 'Tech Info', 'Technology is best when it brings people together.\r\nIncluded Free Drink & Certificate', '2022-09-28', '15:30:00', '2022-09-28', '17:30:00', 100, 98, 10.00, 66, 'Talk', 'DK G', b'0', b'0'),
(46, 'Science Fair', 'Provided Free Lunch and Free Parking Slot! ', '2022-10-05', '15:30:00', '2022-10-05', '17:30:00', 50, 38, 30.00, 67, 'Talk', 'M Block', b'0', b'0'),
(47, 'Science Fair', 'Free entry with the science fair, Join us now!', '2022-12-05', '14:35:00', '2022-12-05', '20:30:00', 50, 48, 0.00, 68, 'Competition', 'Foyer', b'0', b'0'),
(48, 'Summer Camp', 'Back to nature, Summer Camp will only be got 50 limited slots!\r\nMeet at the Foyer and See you soon!', '2022-06-05', '14:35:00', '2022-09-05', '20:30:00', 50, 49, 0.00, 69, 'Other', 'Foyer', b'0', b'0'),
(49, 'The Festival', 'Back to nature, Summer Camp will only be got 50 limited slots!\r\nMeet at the Foyer and See you soon!', '2023-01-09', '20:35:00', '2023-03-09', '23:30:00', 200, 200, 0.00, 70, 'Show', 'Foyer', b'0', b'0'),
(50, 'Tech Program', 'Free Drink, Food and Certificates', '2023-01-09', '14:35:00', '2023-01-09', '16:30:00', 50, 50, 30.00, 71, 'Talk', 'DK G', b'0', b'0'),
(51, 'Robot-Building', 'Curiosity & Experiment, A robot-building competition & exhibition', '2022-12-12', '14:35:00', '2022-12-12', '20:30:00', 50, 50, 50.00, 72, 'Competition', 'Foyer', b'0', b'0'),
(52, 'Music Festival', 'Artist : Soo Jin Ae, Teddy Yu, Chidi Eze', '2022-02-12', '14:35:00', '2022-02-12', '20:30:00', 150, 150, 10.00, 73, 'Show', 'DK G', b'0', b'0'),
(53, 'Freshers Night', 'Guitar Guy, Mister DJ, Relative Sounder, Collective Dancer', '2022-08-12', '18:35:00', '2022-08-12', '23:30:00', 150, 150, 0.00, 74, 'Other', 'Foyer', b'0', b'0'),
(54, 'Stop Bullying Now', 'An open forum for parents on how we end bullying', '2022-09-11', '18:35:00', '2022-09-11', '20:30:00', 150, 150, 0.00, 75, 'Talk', 'Foyer', b'0', b'0'),
(55, 'Stem Day', 'International Stem Day For Science, Technology, Engineering, Mathematics', '2022-11-11', '17:35:00', '2022-11-11', '20:30:00', 200, 200, 0.00, 76, 'Talk', 'Foyer', b'0', b'0'),
(57, 'sadasda', 'asdasdas', '2022-12-11', '11:11:00', '2022-12-13', '11:11:00', 50, 50, 50.00, 78, 'Show2', 'Foyer', b'0', b'0');

-- --------------------------------------------------------

--
-- Table structure for table `nitro_payment`
--

CREATE TABLE `nitro_payment` (
  `paymentID` int(11) NOT NULL,
  `payDate` date DEFAULT NULL,
  `payTime` time DEFAULT NULL,
  `paymentAmount` double(7,2) DEFAULT NULL,
  `referCode` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nitro_payment`
--

INSERT INTO `nitro_payment` (`paymentID`, `payDate`, `payTime`, `paymentAmount`, `referCode`) VALUES
(22, '2022-09-29', '19:09:11', 150.00, '26E1522857767712T'),
(23, '2022-09-29', '19:11:03', 100.00, '6DD08391MU175812E'),
(24, '2022-09-29', '19:12:48', 50.00, '4G555345B05600446'),
(25, '2022-09-29', '19:14:38', 20.00, '12B52210AU781580L'),
(26, '2022-09-29', '20:39:00', 0.00, 'FREE'),
(27, '2022-09-29', '20:42:09', 300.00, '4P214682GT330735S'),
(28, '2022-09-29', '21:15:57', 0.00, 'FREE'),
(29, '2022-09-29', '21:18:11', 0.00, 'FREE'),
(30, '2022-09-29', '21:18:52', 0.00, 'FREE'),
(31, '2022-09-29', '21:20:30', 0.00, 'FREE'),
(32, '2022-09-29', '21:21:48', 0.00, 'FREE'),
(33, '2022-09-29', '21:22:55', 0.00, 'FREE'),
(34, '2022-09-29', '21:22:59', 0.00, 'FREE'),
(35, '2022-10-01', '13:23:11', 0.00, 'FREE'),
(36, '2022-10-01', '13:59:24', 0.00, 'FREE'),
(37, '2022-10-01', '14:00:37', 60.00, '0UG67866DS7680140');

-- --------------------------------------------------------

--
-- Table structure for table `nitro_poster`
--

CREATE TABLE `nitro_poster` (
  `posterID` int(11) NOT NULL,
  `posterURL` varchar(300) DEFAULT NULL,
  `posterUniq` varchar(50) DEFAULT NULL,
  `posterDesc` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nitro_poster`
--

INSERT INTO `nitro_poster` (`posterID`, `posterURL`, `posterUniq`, `posterDesc`) VALUES
(62, 'admin/uploads/2022/09/29/63357123039e8.jpg', '63357123039e8', '29-09-2022'),
(63, 'admin/uploads/2022/09/29/63357266b0108.jpg', '63357266b0108', '29-09-2022'),
(64, 'admin/uploads/2022/09/29/6335732a7237d.jpg', '6335732a7237d', '29-09-2022'),
(65, 'admin/uploads/2022/09/29/6335738b72333.jpg', '6335738b72333', '29-09-2022'),
(66, 'admin/uploads/2022/09/29/633573fc8769e.jpg', '633573fc8769e', '29-09-2022'),
(67, 'admin/uploads/2022/09/29/633574556e864.jpg', '633574556e864', '29-09-2022'),
(68, 'admin/uploads/2022/09/29/6335752240784.jpg', '6335752240784', '29-09-2022'),
(69, 'admin/uploads/2022/09/29/6335761d288c9.jpg', '6335761d288c9', '29-09-2022'),
(70, 'admin/uploads/2022/09/29/633576786cd1a.jpg', '633576786cd1a', '29-09-2022'),
(71, 'admin/uploads/2022/09/29/633576c63c5a6.jpg', '633576c63c5a6', '29-09-2022'),
(72, 'admin/uploads/2022/09/29/6335772694cf0.jpg', '6335772694cf0', '29-09-2022'),
(73, 'admin/uploads/2022/09/29/6335777a04bd4.jpg', '6335777a04bd4', '29-09-2022'),
(74, 'admin/uploads/2022/09/29/633577d5b0e47.jpg', '633577d5b0e47', '29-09-2022'),
(75, 'admin/uploads/2022/09/29/633578290a866.jpg', '633578290a866', '29-09-2022'),
(76, 'admin/uploads/2022/09/29/6335786b3ef21.jpg', '6335786b3ef21', '29-09-2022'),
(77, 'admin/uploads/2022/10/01/6337d3c441901.jpg', '6337d3c441901', '01-10-2022'),
(78, 'admin/uploads/2022/10/01/6337d89e977b8.jpg', '6337d89e977b8', '01-10-2022');

-- --------------------------------------------------------

--
-- Table structure for table `nitro_ticket`
--

CREATE TABLE `nitro_ticket` (
  `ticketID` int(11) NOT NULL,
  `bookingID` int(11) NOT NULL,
  `is_used` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nitro_ticket`
--

INSERT INTO `nitro_ticket` (`ticketID`, `bookingID`, `is_used`) VALUES
(15, 18, b'1'),
(16, 18, b'0'),
(17, 18, b'0'),
(18, 19, b'0'),
(19, 19, b'0'),
(20, 20, b'0'),
(21, 21, b'0'),
(22, 21, b'0'),
(23, 22, b'0'),
(24, 23, b'0'),
(25, 23, b'0'),
(26, 23, b'0'),
(27, 23, b'0'),
(28, 23, b'0'),
(29, 23, b'0'),
(30, 23, b'0'),
(31, 23, b'0'),
(32, 23, b'0'),
(33, 23, b'0'),
(34, 24, b'0'),
(35, 24, b'0'),
(36, 24, b'0'),
(37, 25, b'0'),
(38, 26, b'0'),
(39, 29, b'0'),
(40, 30, b'0'),
(41, 31, b'0'),
(42, 32, b'1'),
(43, 32, b'1'),
(44, 33, b'0'),
(45, 33, b'0');

-- --------------------------------------------------------

--
-- Table structure for table `nitro_user`
--

CREATE TABLE `nitro_user` (
  `username` varchar(20) NOT NULL,
  `password` varchar(20) DEFAULT NULL,
  `emailAddress` varchar(50) DEFAULT NULL,
  `contactNum` varchar(20) DEFAULT NULL,
  `first_name` varchar(20) DEFAULT NULL,
  `last_name` varchar(30) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `is_admin` bit(1) DEFAULT NULL,
  `is_banned` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nitro_user`
--

INSERT INTO `nitro_user` (`username`, `password`, `emailAddress`, `contactNum`, `first_name`, `last_name`, `gender`, `is_admin`, `is_banned`) VALUES
('admin', 'admin', 'limjh-pm21@student.tarc.edu.my', '019-4732881', 'Lim', 'Jian Hui', 'M', b'1', b'0'),
('pedo', '1234', 'p@gmail.com', '019-4732882', 'NO', 'THANKS', 'O', b'0', b'0'),
('user1', 'user1', 'limjianhui789@gmail.com', '019-4732881', 'Lim', 'Jian Hui', 'M', b'0', b'1'),
('user2', 'user2', 'limjianhui788@gmail.com', '019-4732881', 'Wong', 'Kai Keat', 'M', b'0', b'0'),
('user3', 'user3', 'limjianhui787@gmail.com', '019-4732881', 'Gan', 'Yong Chun', 'M', b'0', b'0'),
('user666', 'user666', 'blackpaper00001@gmail.com', '019-4732881', 'Lim', 'Jian Hui', 'M', b'0', b'0');

-- --------------------------------------------------------

--
-- Table structure for table `nitro_venue`
--

CREATE TABLE `nitro_venue` (
  `venueName` varchar(30) CHARACTER SET latin1 NOT NULL,
  `is_delete` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nitro_venue`
--

INSERT INTO `nitro_venue` (`venueName`, `is_delete`) VALUES
('Club House', b'0'),
('DK A', b'0'),
('DK B', b'0'),
('DK C', b'0'),
('DK G', b'0'),
('DK H', b'0'),
('Foyer', b'0'),
('M Block', b'0'),
('Unknown', b'0');

-- --------------------------------------------------------

--
-- Table structure for table `serverconfig`
--

CREATE TABLE `serverconfig` (
  `domain` varchar(50) NOT NULL,
  `port` int(5) NOT NULL,
  `defaultPath` varchar(50) NOT NULL,
  `ssl_enabled` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `serverconfig`
--

INSERT INTO `serverconfig` (`domain`, `port`, `defaultPath`, `ssl_enabled`) VALUES
('localhost', 80, '/PHP_Y2S1_ASS/', b'0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `nitro_booking`
--
ALTER TABLE `nitro_booking`
  ADD PRIMARY KEY (`bookingID`),
  ADD KEY `eventID` (`eventID`),
  ADD KEY `paymentID` (`paymentID`),
  ADD KEY `nitro_booking_ibfk_4` (`username`);

--
-- Indexes for table `nitro_category`
--
ALTER TABLE `nitro_category`
  ADD PRIMARY KEY (`categoryName`);

--
-- Indexes for table `nitro_event`
--
ALTER TABLE `nitro_event`
  ADD PRIMARY KEY (`eventID`),
  ADD KEY `posterID` (`posterID`),
  ADD KEY `categoryName` (`categoryName`),
  ADD KEY `venueName` (`venueName`);

--
-- Indexes for table `nitro_payment`
--
ALTER TABLE `nitro_payment`
  ADD PRIMARY KEY (`paymentID`);

--
-- Indexes for table `nitro_poster`
--
ALTER TABLE `nitro_poster`
  ADD PRIMARY KEY (`posterID`);

--
-- Indexes for table `nitro_ticket`
--
ALTER TABLE `nitro_ticket`
  ADD PRIMARY KEY (`ticketID`),
  ADD KEY `bookingID` (`bookingID`);

--
-- Indexes for table `nitro_user`
--
ALTER TABLE `nitro_user`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `nitro_venue`
--
ALTER TABLE `nitro_venue`
  ADD PRIMARY KEY (`venueName`);

--
-- Indexes for table `serverconfig`
--
ALTER TABLE `serverconfig`
  ADD PRIMARY KEY (`domain`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nitro_booking`
--
ALTER TABLE `nitro_booking`
  MODIFY `bookingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `nitro_event`
--
ALTER TABLE `nitro_event`
  MODIFY `eventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `nitro_payment`
--
ALTER TABLE `nitro_payment`
  MODIFY `paymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `nitro_poster`
--
ALTER TABLE `nitro_poster`
  MODIFY `posterID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `nitro_ticket`
--
ALTER TABLE `nitro_ticket`
  MODIFY `ticketID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `nitro_booking`
--
ALTER TABLE `nitro_booking`
  ADD CONSTRAINT `nitro_booking_ibfk_1` FOREIGN KEY (`eventID`) REFERENCES `nitro_event` (`eventID`),
  ADD CONSTRAINT `nitro_booking_ibfk_2` FOREIGN KEY (`paymentID`) REFERENCES `nitro_payment` (`paymentID`),
  ADD CONSTRAINT `nitro_booking_ibfk_4` FOREIGN KEY (`username`) REFERENCES `nitro_user` (`username`);

--
-- Constraints for table `nitro_event`
--
ALTER TABLE `nitro_event`
  ADD CONSTRAINT `nitro_event_ibfk_1` FOREIGN KEY (`posterID`) REFERENCES `nitro_poster` (`posterID`),
  ADD CONSTRAINT `nitro_event_ibfk_2` FOREIGN KEY (`categoryName`) REFERENCES `nitro_category` (`categoryName`),
  ADD CONSTRAINT `nitro_event_ibfk_3` FOREIGN KEY (`venueName`) REFERENCES `nitro_venue` (`venueName`);

--
-- Constraints for table `nitro_ticket`
--
ALTER TABLE `nitro_ticket`
  ADD CONSTRAINT `bookingID` FOREIGN KEY (`bookingID`) REFERENCES `nitro_booking` (`bookingID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

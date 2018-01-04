-- phpMyAdmin SQL Dump
-- version 4.7.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 04, 2018 at 10:07 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eca`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_master`
--

CREATE TABLE `activity_master` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` mediumtext NOT NULL,
  `site` varchar(1000) NOT NULL,
  `registertion` int(11) NOT NULL DEFAULT '1',
  `image` varchar(1000) NOT NULL,
  `date` date NOT NULL,
  `shortdisc` varchar(10000) NOT NULL,
  `club_id` int(11) NOT NULL,
  `verified` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activity_master`
--

INSERT INTO `activity_master` (`id`, `name`, `description`, `site`, `registertion`, `image`, `date`, `shortdisc`, `club_id`, `verified`) VALUES
(1, 'IOT Symposium', 'This is a text work shop created to test  the php script for upcoming activities. There is no such use of this activity.This is as important as a gaming joystick is in counter strike.', 'aasimkhan.com', 1, 'iot.jpg', '2018-01-31', 'This is a test activity', 1, 0),
(2, 'Pointer Workshop', 'This is another activity which is created to test the layout.This activity serves no other purpose rather than to lorem ipsum.Lorem ipsum, lorem ipsum.......', 'aasimk30.com', 1, 'pointer.jpg', '2018-02-05', 'This is another activity which is created to test the layout.', 1, 1),
(3, 'Web Development ', 'asadkfoffwffnlnkjk', 'fwfwnfewnjnfwf', 1, 'webdev.jpg', '2016-09-17', 'efejfliejffjejf', 2, 1),
(4, 'Entrepreneurship', 'wefjnewfjoewjfjweofwef', 'wejfnwejfwefnef', 1, 'nec.jpg', '2016-09-24', 'ewfjwefjwpeifjfw', 2, 1),
(5, 'TED X', 'fewfefjoewjf', 'efjwefjwfjw', 1, 'tedx.jpg', '2016-09-22', 'efkjeofjewpf', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `clubregister`
--

CREATE TABLE `clubregister` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  `verified` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clubregister`
--

INSERT INTO `clubregister` (`id`, `student_id`, `club_id`, `verified`) VALUES
(2, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `club_master`
--

CREATE TABLE `club_master` (
  `id` int(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `incharge` varchar(100) NOT NULL,
  `description` mediumtext NOT NULL,
  `shortdisc` varchar(10000) NOT NULL,
  `site` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `club_master`
--

INSERT INTO `club_master` (`id`, `name`, `incharge`, `description`, `shortdisc`, `site`, `image`, `username`, `password`) VALUES
(1, 'ITUS', 'Mr.Robot', 'The best club in the college', 'Hackers', 'aasimk.esy.es', 'itus.jpg\n', 'aasim', 'aasim'),
(2, 'GSI', 'Prof.XYZ', 'This club was created for enhancing one\'s literary skills', 'Literatur Club', 'spit.gsi.com', 'gsi.jpg\r\n', 'google', 'google');

-- --------------------------------------------------------

--
-- Table structure for table `register_master`
--

CREATE TABLE `register_master` (
  `id` int(10) NOT NULL,
  `student_id` int(50) NOT NULL,
  `activity_id` int(50) NOT NULL,
  `payment` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `register_master`
--

INSERT INTO `register_master` (`id`, `student_id`, `activity_id`, `payment`) VALUES
(1, 1, 3, 0),
(16, 1, 5, 0),
(17, 1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `student_master`
--

CREATE TABLE `student_master` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` bigint(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_master`
--

INSERT INTO `student_master` (`id`, `name`, `email`, `phone`, `username`, `password`) VALUES
(1, 'Aasim Khan', 'aasimkhan30@gmail.com', 9769130142, 'aasim', 'aasim');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_master`
--
ALTER TABLE `activity_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clubregister`
--
ALTER TABLE `clubregister`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `club_master`
--
ALTER TABLE `club_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register_master`
--
ALTER TABLE `register_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_master`
--
ALTER TABLE `student_master`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_master`
--
ALTER TABLE `activity_master`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `clubregister`
--
ALTER TABLE `clubregister`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `club_master`
--
ALTER TABLE `club_master`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `register_master`
--
ALTER TABLE `register_master`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `student_master`
--
ALTER TABLE `student_master`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

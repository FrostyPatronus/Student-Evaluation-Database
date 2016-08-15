-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2016 at 05:33 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `abcde`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `assignment_id` int(11) NOT NULL,
  `assignment_name` varchar(30) NOT NULL,
  `date_due` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`assignment_id`, `assignment_name`, `date_due`) VALUES
(69, 'Bernie', '0201-01-01'),
(70, 'Sanders', '0201-01-01'),
(71, 'Are you kidding me', '0201-01-01'),
(72, 'Hello There', '0201-01-01'),
(73, 'Jimmy Boy', '0201-01-01'),
(74, 'Crapton', '0201-01-01'),
(75, 'Hello Boy', '0201-12-01'),
(76, '3', '0201-03-03'),
(80, 'Assignment 4', '0201-01-01'),
(81, 'Assignment 5', '0201-01-01'),
(88, '123451234512345123451234512345', '0201-01-01'),
(90, '12345123', '2016-01-01'),
(92, 'Assignment 7', '2016-01-01'),
(93, '12345123451234512345', '2016-01-01'),
(98, 'Assignment 8', '0201-01-01'),
(99, 'Assignment 9', '0201-01-01'),
(100, 'Assignment 10', '0201-01-01'),
(101, 'Assignment 11', '2017-01-01'),
(102, 'Assignment 13', '2017-12-12'),
(103, 'Assignment 14', '2017-01-01'),
(104, 'Assignment 12', '2010-01-01'),
(105, '&Classes', '0201-01-01'),
(106, 'Jimmy', '2016-01-01'),
(107, 'Kimmel', '2016-05-23'),
(108, 'Universal', '2016-12-12'),
(109, '1', '2011-11-11'),
(110, '2', '2011-01-01'),
(112, '4', '2011-01-01'),
(113, '5', '2011-01-01'),
(119, '6', '2011-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `assignment_group`
--

CREATE TABLE `assignment_group` (
  `rel_id` int(11) NOT NULL,
  `class_name` varchar(30) NOT NULL,
  `assignment_name` varchar(30) NOT NULL,
  `class_id` int(11) NOT NULL,
  `assignment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assignment_group`
--

INSERT INTO `assignment_group` (`rel_id`, `class_name`, `assignment_name`, `class_id`, `assignment_id`) VALUES
(146, 'AP Chemistry', '1', 25, 109),
(147, 'AP Chemistry', '2', 25, 110),
(148, 'AP Chemistry', '3', 25, 76),
(149, 'AP Chemistry', '4', 25, 112),
(150, 'AP Chemistry', '5', 25, 113),
(151, 'AP English', '1', 24, 109),
(152, 'AP English', '2', 24, 110),
(153, 'AP English', '3', 24, 76),
(154, 'AP English', '4', 24, 112),
(155, 'AP English', '5', 24, 113),
(156, 'AP English', '6', 24, 119);

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `class_id` int(11) NOT NULL,
  `class_name` varchar(30) NOT NULL,
  `instructor` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`class_id`, `class_name`, `instructor`) VALUES
(24, 'AP English', 'Hitch'),
(25, 'AP Chemistry', 'Hiker');

-- --------------------------------------------------------

--
-- Table structure for table `rubric_1`
--

CREATE TABLE `rubric_1` (
  `eval_id` int(11) NOT NULL,
  `class_name` varchar(30) NOT NULL,
  `student_name` varchar(50) NOT NULL,
  `assignment_name` varchar(30) NOT NULL,
  `citation` int(11) NOT NULL,
  `analysis` int(11) NOT NULL,
  `thesis` int(11) NOT NULL,
  `topic` int(11) NOT NULL,
  `written` int(11) NOT NULL,
  `assignment_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rubric_1`
--

INSERT INTO `rubric_1` (`eval_id`, `class_name`, `student_name`, `assignment_name`, `citation`, `analysis`, `thesis`, `topic`, `written`, `assignment_id`, `student_id`) VALUES
(216, 'AP Chemistry', 'Bay,', '1', 6, 6, 6, 6, 6, 146, 75),
(219, 'AP Chemistry', 'qwedcsad', '1', 6, 6, 6, 6, 6, 146, 78);

-- --------------------------------------------------------

--
-- Table structure for table `rubric_2`
--

CREATE TABLE `rubric_2` (
  `eval_id` int(11) NOT NULL,
  `class_name` varchar(30) NOT NULL,
  `student_name` varchar(30) NOT NULL,
  `assignment_name` varchar(30) NOT NULL,
  `agreements` tinyint(1) NOT NULL,
  `commas` tinyint(1) NOT NULL,
  `fragments` tinyint(1) NOT NULL,
  `misplaced` tinyint(1) NOT NULL,
  `apostrophes` tinyint(1) NOT NULL,
  `duplicate` tinyint(1) NOT NULL,
  `hypotheticals` tinyint(1) NOT NULL,
  `run_on` tinyint(1) NOT NULL,
  `capitalization` tinyint(1) NOT NULL,
  `formatting` tinyint(1) NOT NULL,
  `pronouns` tinyint(1) NOT NULL,
  `verb` tinyint(1) NOT NULL,
  `spelling` tinyint(1) NOT NULL,
  `assignment_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rubric_2`
--

INSERT INTO `rubric_2` (`eval_id`, `class_name`, `student_name`, `assignment_name`, `agreements`, `commas`, `fragments`, `misplaced`, `apostrophes`, `duplicate`, `hypotheticals`, `run_on`, `capitalization`, `formatting`, `pronouns`, `verb`, `spelling`, `assignment_id`, `student_id`) VALUES
(57, 'AP Chemistry', 'Bay,', '1', 0, 0, 0, 1, 1, 0, 0, 0, 0, 1, 1, 0, 0, 146, 75),
(60, 'AP Chemistry', 'qwedcsad', '1', 0, 0, 0, 1, 0, 0, 1, 0, 0, 0, 0, 1, 1, 146, 78);

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `semester_id` int(11) NOT NULL DEFAULT '1',
  `semester` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`semester_id`, `semester`) VALUES
(1, 'Brother Sister');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `student_name` varchar(50) NOT NULL,
  `class_name` varchar(30) NOT NULL,
  `class_index` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `student_name`, `class_name`, `class_index`) VALUES
(74, 'Boy,', 'AP Chemistry', 25),
(75, 'Bay,', 'AP Chemistry', 25),
(76, 'D,', 'AP Chemistry', 25),
(77, 'rqwefmrwe', 'AP Chemistry', 25),
(78, 'qwedcsad', 'AP Chemistry', 25),
(79, 'qw qwe', 'AP Chemistry', 25),
(80, 'frcwe qe', 'AP Chemistry', 25),
(81, 'vqcre', 'AP Chemistry', 25),
(82, 'qf', 'AP Chemistry', 25),
(83, 'qwer', 'AP English', 24),
(84, 'ceq', 'AP English', 24),
(85, 'w', 'AP English', 24),
(86, 'cqwe', 'AP English', 24),
(87, 'd', 'AP English', 24),
(88, 'wq', 'AP English', 24),
(89, 'dc', 'AP English', 24),
(90, 'q', 'AP English', 24);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`assignment_id`),
  ADD UNIQUE KEY `assignment_name` (`assignment_name`);

--
-- Indexes for table `assignment_group`
--
ALTER TABLE `assignment_group`
  ADD PRIMARY KEY (`rel_id`),
  ADD UNIQUE KEY `class_name` (`class_name`,`assignment_name`,`class_id`,`assignment_id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `assignment_id` (`assignment_id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_id`),
  ADD UNIQUE KEY `class_name` (`class_name`);

--
-- Indexes for table `rubric_1`
--
ALTER TABLE `rubric_1`
  ADD PRIMARY KEY (`eval_id`,`class_name`,`student_name`,`assignment_name`),
  ADD KEY `assignment_id` (`assignment_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `rubric_2`
--
ALTER TABLE `rubric_2`
  ADD PRIMARY KEY (`eval_id`,`class_name`,`student_name`,`assignment_name`),
  ADD KEY `assignment_id` (`assignment_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`semester_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `student_name` (`student_name`,`class_name`),
  ADD KEY `class_index` (`class_index`);

--
-- Constraints for table `assignment_group`
--
ALTER TABLE `assignment_group`
  ADD CONSTRAINT `assign_group_fk` FOREIGN KEY (`assignment_id`) REFERENCES `assignments` (`assignment_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `class_group_fk` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rubric_1`
--
ALTER TABLE `rubric_1`
  ADD CONSTRAINT `assignment_rel_eval_fk` FOREIGN KEY (`assignment_id`) REFERENCES `assignment_group` (`rel_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_eval_fk` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rubric_2`
--
ALTER TABLE `rubric_2`
  ADD CONSTRAINT `assignment_rel_eval2_fk` FOREIGN KEY (`assignment_id`) REFERENCES `assignment_group` (`rel_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_eval2_fk` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `classes_students_fk` FOREIGN KEY (`class_index`) REFERENCES `classes` (`class_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

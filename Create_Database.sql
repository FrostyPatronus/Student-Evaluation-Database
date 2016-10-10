--  phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2016 at 07:49 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fuckkkk`
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
(1, 'Assignment 1', '2016-01-01'),
(2, 'Assignment 2', '2016-02-03'),
(3, 'Assignment 3', '2016-03-04'),
(4, 'Assignment 4', '2016-04-05');

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
(1, 'Timothy', 'Assignment 1', 1, 1),
(2, 'Timothy', 'Assignment 2', 1, 2),
(3, 'Timothy', 'Assignment 3', 1, 3),
(4, 'Timothy', 'Assignment 4', 1, 4);

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
(1, 'Timothy', 'Harvard');

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
(1, 'Timothy', 'Fuck,', 'Assignment 3', 6, 6, 6, 6, 6, 3, 1),
(2, 'Timothy', 'Johnny,', 'Assignment 3', 6, 6, 6, 6, 6, 3, 3);

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
(1, 'Timothy', 'Fuck,', 'Assignment 3', 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 1, 1, 3, 1),
(2, 'Timothy', 'Johnny,', 'Assignment 3', 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 1, 3, 3);

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
(1, 'Fall 2016');

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
(1, 'Fuck,', 'Timothy', 1),
(2, 'You,', 'Timothy', 1),
(3, 'Johnny,', 'Timothy', 1);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `assignment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `assignment_group`
--
ALTER TABLE `assignment_group`
  MODIFY `rel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `rubric_1`
--
ALTER TABLE `rubric_1`
  MODIFY `eval_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `rubric_2`
--
ALTER TABLE `rubric_2`
  MODIFY `eval_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

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

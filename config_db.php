<?php
require_once('mysqli_connector.php');
//Creates DB when it doesnt exist
$add_database = 'CREATE DATABASE IF NOT EXISTS ' . DB_NAME;
echo mysqli_query($dbc, $add_database)? 'Database Created!<br/>': 'Database Creation Failed :(<br/>';

mysqli_select_db($dbc, DB_NAME);

////////////////////////////////////////////////////
//// CREATE ASSIGNMENTS TABLE //////////////////////
////////////////////////////////////////////////////

//Add assignments table if it doesnt exist
$add_assignments_table = /*'
CREATE TABLE IF NOT EXISTS assignments
(assignment_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
assignment_name VARCHAR(30) NOT NULL,
date_due DATE NOT NULL,
UNIQUE (assignment_name, date_due));'*/

'CREATE TABLE IF NOT EXISTS `assignments` (
 `assignment_id` int(11) NOT NULL AUTO_INCREMENT,
 `assignment_name` varchar(30) NOT NULL,
 `date_due` date NOT NULL,
 PRIMARY KEY (`assignment_id`),
 UNIQUE KEY `assignment_name` (`assignment_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1';

echo mysqli_query($dbc, $add_assignments_table)? 'Assignments table created!<br/>' : 'Assignments table creation failed :(<br/>';

//////////////////////////////////////////////////////////
//// CREATE ASSIGNMENTS GROUP TABLE //////////////////////
//////////////////////////////////////////////////////////

$add_assignments_group = 'CREATE TABLE IF NOT EXISTS `assignment_group` (
 `rel_id` int(11) NOT NULL AUTO_INCREMENT,
 `class_name` varchar(30) NOT NULL,
 `assignment_name` varchar(30) NOT NULL,
 `class_id` int(11) NOT NULL,
 `assignment_id` int(11) NOT NULL,
 PRIMARY KEY (`rel_id`),
 UNIQUE KEY `class_name` (`class_name`,`assignment_name`,`class_id`,`assignment_id`),
 KEY `class_id` (`class_id`),
 KEY `assignment_id` (`assignment_id`),
 CONSTRAINT `assign_group_fk` FOREIGN KEY (`assignment_id`) REFERENCES `assignments` (`assignment_id`) ON DELETE CASCADE ON UPDATE CASCADE,
 CONSTRAINT `class_group_fk` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1';

echo mysqli_query($dbc, $add_assignments_group)? 'Assignments group table created!<br/>' : 'Assignments group table creation failed :(<br/>';

////////////////////////////////////////////////////
//// CREATE CLASSES TABLE //////////////////////////
////////////////////////////////////////////////////

//Add Classes table
$add_classes = /*'
CREATE TABLE IF NOT EXISTS IF NOT EXISTS classes
(class_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
class_name VARCHAR(30) NOT NULL,
UNIQUE (class_name));';*/

'CREATE TABLE IF NOT EXISTS `classes` (
 `class_id` int(11) NOT NULL AUTO_INCREMENT,
 `class_name` varchar(30) NOT NULL,
 `instructor` varchar(30) NOT NULL,
 PRIMARY KEY (`class_id`),
 UNIQUE KEY `class_name` (`class_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1';

echo mysqli_query($dbc, $add_classes)? 'classes table created!<br/>' : 'classes table creation failed :(<br/>';

////////////////////////////////////////////////////
//// CREATE STUDENTS TABLE /////////////////////////
////////////////////////////////////////////////////

//Adds student table
$add_students = /*'CREATE TABLE IF NOT EXISTS IF NOT EXISTS students
(student_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
student_name VARCHAR(50) NOT NULL,
class_name VARCHAR(30) NOT NULL);';*/

'CREATE TABLE IF NOT EXISTS `students` (
 `student_id` int(11) NOT NULL AUTO_INCREMENT,
 `student_name` varchar(50) NOT NULL,
 `class_name` varchar(30) NOT NULL,
 `class_index` int(11) NOT NULL,
 PRIMARY KEY (`student_id`),
 UNIQUE KEY `student_name` (`student_name`,`class_name`),
 KEY `class_index` (`class_index`),
 CONSTRAINT `classes_students_fk` FOREIGN KEY (`class_index`) REFERENCES `classes` (`class_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1';

echo mysqli_query($dbc, $add_students)? 'students table created!<br/>' : 'students table creation failed :(<br/>';

////////////////////////////////////////////////////
//// CREATE RUBRIC 1 TABLE /////////////////////////
////////////////////////////////////////////////////

$add_rubric_1 = /*"CREATE TABLE IF NOT EXISTS IF NOT EXISTS rubric_1
( eval_id INT NOT NULL AUTO_INCREMENT ,
class_name VARCHAR(30) NOT NULL ,
student_name VARCHAR(50) NOT NULL ,
assignment_name VARCHAR(30) NOT NULL ,
citation INT NOT NULL ,
analysis INT NOT NULL ,
thesis INT NOT NULL ,
topic INT NOT NULL ,
PRIMARY KEY (eval_id, class_name, student_name, assignment_name),
UNIQUE (class_name,student_name,assignment_name));";*/

'CREATE TABLE IF NOT EXISTS `rubric_1` (
 `eval_id` int(11) NOT NULL AUTO_INCREMENT,
 `class_name` varchar(30) NOT NULL,
 `student_name` varchar(50) NOT NULL,
 `assignment_name` varchar(30) NOT NULL,
 `citation` int(11) NOT NULL,
 `analysis` int(11) NOT NULL,
 `thesis` int(11) NOT NULL,
 `topic` int(11) NOT NULL,
 `written` int(11) NOT NULL,
 `assignment_id` int(11) NOT NULL,
 `student_id` int(11) NOT NULL,
 PRIMARY KEY (`eval_id`,`class_name`,`student_name`,`assignment_name`),
 KEY `assignment_id` (`assignment_id`),
 KEY `student_id` (`student_id`),
 CONSTRAINT `assignment_rel_eval_fk` FOREIGN KEY (`assignment_id`) REFERENCES `assignment_group` (`rel_id`) ON DELETE CASCADE ON UPDATE CASCADE,
 CONSTRAINT `student_eval_fk` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1';

echo mysqli_query($dbc, $add_rubric_1)? 'rubric_1 table created!<br/>' : 'rubric_1 creation failed :(<br/>';

////////////////////////////////////////////////////
//// CREATE RUBRIC 2 TABLE /////////////////////////
////////////////////////////////////////////////////

$add_rubric_2 = /*"CREATE TABLE IF NOT EXISTS IF NOT EXISTS rubric_2 (
 eval_id int(11) NOT NULL AUTO_INCREMENT,
 class_name varchar(30) NOT NULL,
 student_name varchar(30) NOT NULL,
 assignment_name varchar(30) NOT NULL,
 agreements tinyint(1) NOT NULL,
 commas tinyint(1) NOT NULL,
 fragments tinyint(1) NOT NULL,
 misplaced tinyint(1) NOT NULL,
 apostrophes tinyint(1) NOT NULL,
 duplicate tinyint(1) NOT NULL,
 hypotheticals tinyint(1) NOT NULL,
 run_on tinyint(1) NOT NULL,
 capitalization tinyint(1) NOT NULL,
 formatting tinyint(1) NOT NULL,
 pronouns tinyint(1) NOT NULL,
 verb tinyint(1) NOT NULL,
 spelling tinyint(1) NOT NULL,
 PRIMARY KEY (eval_id,class_name,student_name,assignment_name),
 UNIQUE (class_name,student_name,assignment_name));";*/

'CREATE TABLE IF NOT EXISTS `rubric_2` (
 `eval_id` int(11) NOT NULL AUTO_INCREMENT,
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
 `student_id` int(11) NOT NULL,
 PRIMARY KEY (`eval_id`,`class_name`,`student_name`,`assignment_name`),
 KEY `assignment_id` (`assignment_id`),
 KEY `student_id` (`student_id`),
 CONSTRAINT `assignment_rel_eval2_fk` FOREIGN KEY (`assignment_id`) REFERENCES `assignment_group` (`rel_id`) ON DELETE CASCADE ON UPDATE CASCADE,
 CONSTRAINT `student_eval2_fk` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1';

echo mysqli_query($dbc, $add_rubric_2)? 'rubric_2 table created!<br/>' : 'rubric_2 creation failed :(<br/>';

////////////////////////////////////////////////////
//// CREATE SEMESTER TABLE /////////////////////////
////////////////////////////////////////////////////

//Add assignments table if it doesnt exist
$add_semester_table = /*'
CREATE TABLE IF NOT EXISTS IF NOT EXISTS assignments
(assignment_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
assignment_name VARCHAR(30) NOT NULL,
date_due DATE NOT NULL,
UNIQUE (assignment_name, date_due));'*/

'CREATE TABLE IF NOT EXISTS `semester` (
 `semester_id` int(11) NOT NULL DEFAULT \'1\',
 `semester` varchar(30) NOT NULL,
 PRIMARY KEY (`semester_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1';

echo mysqli_query($dbc, $add_semester_table)? 'Semester created!<br/>' : 'Semester creation failed :(<br/>';

$add_sem_initial_value = "INSERT INTO `semester`(`semester_id`, `semester`) VALUES (1,'Fall 2016')";
echo mysqli_query($dbc, $add_sem_initial_value)? 'Semester initial value created!!<br/>' : 'Semester creation failed :(<br/>';



?>
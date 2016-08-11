<?php
#Connects to mysql database
require_once("../../mysqli_connector.php");

#Makes all the variables for the data
//$assignment_name = trim($_POST['assignmentName']);
//$date_due = '20' . $_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day'];
$student_name = trim($_POST['student_name']);
$class = trim($_POST['class']);
$assignment = trim($_POST['assignment']);

$citation = $_POST['citation'];
$analysis = $_POST['analysis'];
$thesis = $_POST['thesis'];
$topic = $_POST['top'];
$written = $_POST['write'];

$agreements = $_POST['agreements'];
$commas = $_POST['commas'];
$fragments = $_POST['fragments'];
$misplaced = $_POST['misplaced'];
$apostrophes = $_POST['apostrophes'];
$duplicate = $_POST['duplicate'];
$hypotheticals = $_POST['hypotheticals'];
$run_on = $_POST['run_on'];
$capitalization = $_POST['capitalization'];
$formatting = $_POST['formatting'];
$pronouns = $_POST['pronouns'];
$verb = $_POST['verb'];
$spelling = $_POST['spelling'];

#Pushes data into the mysql server

$query = 'INSERT INTO rubric_1 VALUES (NULL ,?,?,?,?,?,?,?,?, 
(SELECT rel_id FROM assignment_group WHERE assignment_name=? AND class_name=? ),
(SELECT student_id from students WHERE student_name=? AND class_name=?))';

$stmt = mysqli_prepare($dbc, $query);
mysqli_stmt_bind_param($stmt, 'sssiiiiissss',
    $class, $student_name, $assignment,
    $citation, $analysis, $thesis, $topic, $written, $assignment, $class, $student_name, $class);


mysqli_stmt_execute($stmt);

//echo mysqli_stmt_error($stmt);

#Pushes data into the mysql server
$query2 = 'INSERT INTO rubric_2 
 VALUES (NULL ,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?, 
(SELECT rel_id FROM assignment_group WHERE assignment_name=? AND class_name=? ),
(SELECT student_id from students WHERE student_name=? AND class_name=?))';
$stmt2 = mysqli_prepare($dbc, $query2);
mysqli_stmt_bind_param($stmt2, 'sssiiiiiiiiiiiiissss',
    $class, $student_name, $assignment, $agreements, $commas, $fragments,
    $misplaced, $apostrophes, $duplicate, $hypotheticals,
    $run_on, $capitalization, $formatting, $pronouns,
    $verb, $spelling, $assignment, $class, $student_name, $class);
mysqli_stmt_execute($stmt2);

?>
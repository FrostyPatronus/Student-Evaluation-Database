<?php
require_once('../../mysqli_connector.php');

$class = $_POST['class_name'];
$student = $_POST['student'];
$assignment = $_POST['assignment'];

/*$query = "DELETE FROM rubric_1 WHERE assignment_name = '$assignment' AND student_name = '$student' AND class_name = '$class'";
mysqli_query($dbc, $query);*/

$query = "DELETE FROM rubric_1 WHERE assignment_name =? AND student_name =? AND class_name =?";
$stmt = mysqli_prepare($dbc, $query);
mysqli_stmt_bind_param($stmt, 'sss', $assignment, $student, $class);
mysqli_stmt_execute($stmt);

/*$query = "DELETE FROM rubric_2 WHERE assignment_name = '$assignment' AND student_name = '$student' AND class_name = '$class'";
mysqli_query($dbc, $query);*/

$query = "DELETE FROM rubric_2 WHERE assignment_name =? AND student_name =? AND class_name =?";
$stmt = mysqli_prepare($dbc, $query);
mysqli_stmt_bind_param($stmt, 'sss', $assignment, $student, $class);
mysqli_stmt_execute($stmt);

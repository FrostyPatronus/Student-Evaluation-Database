<?php
#Connects to mysql database
require_once("../../mysqli_connector.php");

#Makes all the variables for the data
$class_name = trim($_POST['class']);
$student_name = trim($_POST['student_name']);

#Pushes data into the mysql server
$query = "INSERT INTO students VALUE
    (Null, ?, ?, (SELECT class_id from classes WHERE class_name=?) );";
//'INSERT INTO students VALUES (NULL ,?, ?)';

$stmt = mysqli_prepare($dbc, $query);
mysqli_stmt_bind_param($stmt, 'sss', $student_name, $class_name, $class_name);
mysqli_stmt_execute($stmt);
?>


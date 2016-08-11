<?php
#Connects to mysql database
require_once("../../mysqli_connector.php");

#Makes all the variables for the data
$class_name = trim($_POST['class_name']);
$instructor = trim($_POST['instructor']);

#Pushes data into the mysql server
$query = 'INSERT INTO classes VALUES (NULL ,?, ?)';
$stmt = mysqli_prepare($dbc, $query);
mysqli_stmt_bind_param($stmt, 'ss', $class_name, $instructor);
mysqli_stmt_execute($stmt);

?>
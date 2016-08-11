<?php
#Connects to mysql database
require_once("../../mysqli_connector.php");

#Makes all the variables for the data
echo $semester = trim($_POST['semester']);

#Pushes data into the mysql server
$query = 'UPDATE `semester` SET `semester`=? WHERE `semester`.`semester_id` = 1; ';
$stmt = mysqli_prepare($dbc, $query);
mysqli_stmt_bind_param($stmt, 's', $semester);
mysqli_stmt_execute($stmt);
?>
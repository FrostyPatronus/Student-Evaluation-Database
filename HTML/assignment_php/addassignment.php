<?php
#Connects to mysql database
require_once("../../mysqli_connector.php");

#Makes all the variables for the data
$assignment_name = trim($_POST['assignmentName']);
$date_due = '20' . $_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day'];
$classes = explode(",", $_POST['classes']);

#Pushes data into the mysql server
$query = 'INSERT INTO assignments VALUES (NULL ,?,?)';
$stmt = mysqli_prepare($dbc, $query);
mysqli_stmt_bind_param($stmt, 'ss', $assignment_name, $date_due);
mysqli_stmt_execute($stmt);

//////////////////////////////////////////////////////////////////
//////// INSERT INTO ASSIGNMENT_GROUP ////////////////////////////
//////////////////////////////////////////////////////////////////

$query_2 = "INSERT INTO `assignment_group`(`rel_id`, `class_name`, `assignment_name`, `class_id`, `assignment_id`) VALUES 
            (NULL,?,?,
            (SELECT class_id from classes WHERE class_name=?),
            (SELECT `assignment_id` FROM `assignments` WHERE `assignment_name`=?));";
//'INSERT INTO students VALUES (NULL ,?, ?)';

foreach ($classes as $class){
    $stmt_2 = mysqli_prepare($dbc, $query_2);
    $class = trim($class);
    mysqli_stmt_bind_param($stmt_2, 'ssss', $class, $assignment_name, $class, $assignment_name);
    mysqli_stmt_execute($stmt_2);
}

?>


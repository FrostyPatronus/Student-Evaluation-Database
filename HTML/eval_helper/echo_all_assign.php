<?php
require_once('../../mysqli_connector.php'); //Queries the data from the MySQL DB

$class = $_REQUEST['class'];

$sql_2 = "SELECT DISTINCT assignment_name FROM assignment_group WHERE class_name=?";
$stmt = mysqli_prepare($dbc, $sql_2);
mysqli_stmt_bind_param($stmt, 's', $class);
mysqli_stmt_execute($stmt);
$response = mysqli_stmt_get_result($stmt);

#If there is data and shit
if($response){
    #Queries all the data and puts it in the row
    $table = '&*&*';
    while($row = mysqli_fetch_array($response)){
        $table .= $row["assignment_name"] . '&*&*';
    }
    echo $table;
}
# HI MR HSU I DIDN'T KNOW YOU LOOKED AT SOURCE CODE :)
?>


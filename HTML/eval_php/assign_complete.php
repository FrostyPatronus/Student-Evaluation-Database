<?php
require_once('../../mysqli_connector.php');

$student = $_REQUEST['student'];
$class = $_REQUEST['class'];

//$sql = "SELECT assignment_name FROM rubric_1 WHERE student_name='$student' AND class_name='$class'";
//$response = @mysqli_query($dbc, $sql);

$sql_2 = "SELECT assignment_name FROM rubric_1 WHERE student_name=? AND class_name=?";
$stmt = mysqli_prepare($dbc, $sql_2);
mysqli_stmt_bind_param($stmt, 'ss', $student, $class);
mysqli_stmt_execute($stmt);
$response = mysqli_stmt_get_result($stmt);

#If there is data and shit
if ($response) {
    #Queries all the data and puts it in the row
    $table = '&*&*';
    while ($row = mysqli_fetch_array($response)) {
        $assignment_name = $row["assignment_name"];

        $table .= "$assignment_name&*&*";
    }
    echo $table;
}
?>
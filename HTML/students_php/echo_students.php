<?php
require_once('../../mysqli_connector.php');

$sql = "SELECT `student_name`, `class_name` FROM `students`";
$response = @mysqli_query($dbc, $sql);

#If there is data and shit
if ($response) {
    #Queries all the data and puts it in the row
    $table = '';
    while ($row = mysqli_fetch_array($response)) {
        $student_name = $row["student_name"];
        $class_name = $row["class_name"];

        $table .= "($student_name : $class_name),";
    }
    echo $table;
}
?>
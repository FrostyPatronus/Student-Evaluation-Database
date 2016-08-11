<?php
require_once('../../mysqli_connector.php');

$suh = $_REQUEST['class'];
/*$sql = "SELECT * FROM students WHERE class_name = '$suh';";
$response = @mysqli_query($dbc, $sql);*/

$sql_2 = "SELECT * FROM students WHERE class_name =?;";
$stmt = mysqli_prepare($dbc, $sql_2);
mysqli_stmt_bind_param($stmt, 's', $suh);
mysqli_stmt_execute($stmt);

$response = mysqli_stmt_get_result($stmt);

if ($response) {
    #Queries all the data and puts it in the row
    $jim = '';
    while ($row = mysqli_fetch_array($response)) {
        $jim .= $row['student_name'] . "&*&*";
    }
    echo $jim;
}
?>
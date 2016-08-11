<?php
require_once('../../mysqli_connector.php');

$sql = "SELECT `semester` FROM `semester` WHERE `semester_id`='1' ";
$response = @mysqli_query($dbc, $sql);

#If there is data and shit
if ($response) {
    #Queries all the data and puts it in the row
    $table = '';
    while ($row = mysqli_fetch_array($response)) {
        $sem = $row["semester"];

        $table .= "$sem";
    }
    echo $table;
}
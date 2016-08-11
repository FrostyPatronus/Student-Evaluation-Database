<?php
require_once('../../mysqli_connector.php');

$sql = "SELECT * FROM classes ORDER BY class_id DESC";
$response = @mysqli_query($dbc, $sql);
#If there is data and shit
if ($response) {
    #Queries all the data and puts it in the row
    $table = '';

    while ($row = mysqli_fetch_array($response)) {
        $table .= $row["class_name"] . "</br>";
    }
    echo $table;
}
?>
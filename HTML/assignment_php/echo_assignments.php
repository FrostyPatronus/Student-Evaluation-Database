<?php
//SHOWS ALL THE ASSIGNMENTS
//Connects to the database
require_once('../../mysqli_connector.php'); //Queries the data from the MySQL DB
$query = 'SELECT assignment_name FROM assignments ORDER BY date_due DESC ';
$response = @mysqli_query($dbc, $query);

#If there is data and shit
if ($response) {
    #Queries all the data and puts it in the row
    $table = '';

    while ($row = mysqli_fetch_array($response)) {
        $table .= $row["assignment_name"] . ',';
    }
    echo $table;
}
?>
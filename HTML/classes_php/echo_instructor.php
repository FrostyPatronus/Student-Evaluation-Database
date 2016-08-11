<?php
function instructor($class)
{
    require_once('../../mysqli_connector.php');
    global $dbc;


    //$sql = "SELECT instructor FROM `classes` WHERE class_name='$class'";
    //$response = @mysqli_query($dbc, $sql);

    $query = "SELECT instructor FROM `classes` WHERE class_name=?";
    $stmt = mysqli_prepare($dbc, $query);
    mysqli_stmt_bind_param($stmt, 's', $class);
    mysqli_stmt_execute($stmt);
    $response = mysqli_stmt_get_result($stmt);

    #If there is data and shit
    if ($response) {
        #Queries all the data and puts it in the row
        $table = '';

        while ($row = mysqli_fetch_array($response)) {
            $table .= $row["instructor"];
        }
        return $table;
    }
    return "ERROR";
}

?>
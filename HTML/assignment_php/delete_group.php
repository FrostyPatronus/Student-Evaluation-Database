<?php
require_once ('../../mysqli_connector.php');

$function = $_REQUEST['function'];
$group = $_REQUEST['class_id'];

if($function === "classes"){
    //$query = "DELETE FROM assignment_group WHERE class_name = '$group'";
    //mysqli_query($dbc, $query);
    $query = "DELETE FROM assignment_group WHERE class_name = ?";
    $stmt = mysqli_prepare($dbc, $query);
    mysqli_stmt_bind_param($stmt, 's', $group);
    mysqli_stmt_execute($stmt);
}

else if ($function === "instance"){
    //$query = "DELETE FROM assignments WHERE assignment_name = '$group'";
    //mysqli_query($dbc, $query);
    $query = "DELETE FROM assignments WHERE assignment_name = ?";
    $stmt = mysqli_prepare($dbc, $query);
    mysqli_stmt_bind_param($stmt, 's', $group);
    mysqli_stmt_execute($stmt);
    
}

?>
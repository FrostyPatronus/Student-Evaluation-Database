<?php
require_once('../../mysqli_connector.php');
$group = $_REQUEST['class_name'];
$query = "DELETE FROM students WHERE class_name = '$group'";
echo mysqli_query($dbc, $query);

?>
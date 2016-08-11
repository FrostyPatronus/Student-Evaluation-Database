<?php
require_once('../../mysqli_connector.php');
$group = $_REQUEST['class_name'];
$query = "DELETE FROM students
ORDER BY student_id DESC
LIMIT 1 ";
echo mysqli_query($dbc, $query);
?>
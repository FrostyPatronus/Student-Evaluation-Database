<?php
require_once ('../../mysqli_connector.php');
$query = 'DELETE FROM students WHERE 1;';
mysqli_query($dbc, $query);
?>
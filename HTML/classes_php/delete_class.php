<?php
$q = $_REQUEST['row'];
require_once('../../mysqli_connector.php');
mysqli_query($dbc, 'DELETE FROM classes WHERE class_id=' . $q);
?>



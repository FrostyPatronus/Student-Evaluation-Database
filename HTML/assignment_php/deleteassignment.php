<?php
$q = $_REQUEST['q'];
$p = $_REQUEST['p'];

require_once('../../mysqli_connector.php');
mysqli_query($dbc, "DELETE FROM assignment_group WHERE assignment_id='$q' AND class_id='$p'");
mysqli_close($dbc);
?>



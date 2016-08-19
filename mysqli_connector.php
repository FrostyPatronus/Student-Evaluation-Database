<?php
DEFINE('DB_USER', 'root');
DEFINE('DB_PASSWORD', 'password');
DEFINE('DB_HOST', 'localhost');
DEFINE('DB_NAME', 'database');
//Makes a link w/ mysql
$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD) OR die('Couldnt connect to MySQL' . mysqli_connect_error());
mysqli_select_db($dbc, DB_NAME) /*OR require_once('config_db.php')*/;
?>


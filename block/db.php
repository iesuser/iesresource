<?php
include ("globalVariables.php");
global $db;
$db = mysqli_connect($dbHost,$dbUsername,$dbUsernamePass);

mysqli_select_db($db, $dbInventari);

mysqli_query($db, "SET NAMES 'utf8'");
mysqli_query($db, "SET CHARACTER SET 'utf8'");
mb_internal_encoding( 'UTF-8' );

mysqli_query($db, "SET character_set_client = 'utf8';");
mysqli_query($db, "SET character_set_results = 'utf8';");
mysqli_query($db, "SET character_set_connection = 'utf8';");
//session_start();


?>

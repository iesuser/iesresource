<?php
include ("globalVariables.php");
global $db;
$db = mysql_connect($dbHost,$dbUsername,$dbUsernamePass);

mysql_select_db($dbInventari,$db);

mysql_query("SET NAMES 'utf8'",$db);
mysql_query("SET CHARACTER SET 'utf8'",$db);
mb_internal_encoding( 'UTF-8' );

mysql_query("SET character_set_client = 'utf8';",$db);
mysql_query("SET character_set_results = 'utf8';",$db);
mysql_query("SET character_set_connection = 'utf8';",$db);
//session_start();


?>
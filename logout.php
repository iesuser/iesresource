<?php
include("block/globalVariables.php");
include("block/db.php");
session_start(); // This starts the session which is like a cookie, but it isn't saved on your hdd and is much more secure.
mysql_connect("$dbHost","$dbUsername","$dbUsernamePass"); // Connect to the MySQL server
mysql_select_db("$dbStaff"); // Select your Database
if(isset($_SESSION['loggedin']))
    session_start();
    $_SESSION = array();
    session_destroy();
   header('Location: login.php');

?>
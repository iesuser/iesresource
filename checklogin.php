<?php
session_start(); // NEVER forget this!
if(!isset($_SESSION['loggedin']))
{
	  header('Location: ../login.php');
    die("To access this page, you need to <a href='../login.php'>LOGIN</a>"); // Make sure they are logged in!
} // What the !isset() code does, is check to see if the variable $_SESSION['loggedin'] is there, and if it isn't it kills the script telling the user to log in!
if(isset($_SESSION['loggedin']) && isset($_SESSION['departmentName']))
{   	
    die("მხოლოდ ადმინისტრატორებს შეუძლიათ ამ გვერდის ნახვა"); // Make sure they are logged in!
} // What the !isset() code does, is check to see if the variable $_SESSION['loggedin'] is there, and if it isn't it kills the script telling the user to log in!


?>
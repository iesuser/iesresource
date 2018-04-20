<?php
include("../block/globalVariables.php");
include("../block/db.php");
include("../block/functions.php");
session_start();
if($_SESSION['name'] != $siteMaintenanceUsername) die("Error 333");
mysqli_select_db($db, $dbStaff);
if(isset($_POST['id'])) $id = $_POST['id']; else die("id not issets");
if(isset($_POST['department_id'])) $department_id = $_POST['department_id']; else die("id not issets");
if(isset($_POST['name'])) $name = $_POST['name']; else die("name not issets");


if($id == "")
{
	$query = "INSERT INTO  `ies_staff`.`group_laboratories` (`name`,`department_id`) VALUES ('$name','$department_id');";
	mysqli_query($db, $query) or die($query);
	header('Location: departments.php');
}else
{

	$query = "UPDATE  `ies_staff`.`group_laboratories` SET  `name` =  '$name', `department_id` =  '$department_id' WHERE  `group_laboratories`.`id`=$id;";
	mysqli_query($db, $query) or die($query);
	header('Location: departments.php');
}
?>

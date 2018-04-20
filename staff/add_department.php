<?php
include("../block/globalVariables.php");
include("../block/db.php");
include("../block/functions.php");
include("../checklogin.php");// amocmebs tu aris avtorizacia gavlili
session_start();
if($_SESSION['name'] != $siteMaintenanceUsername) die("Error 333");
mysqli_select_db($db, $dbStaff);
if(isset($_POST['id'])) $id = $_POST['id']; else die("id not issets");
if(isset($_POST['name'])) $name = $_POST['name']; else die("name not issets");


$name=str_replace("'", "''", $name);


if($id == "")
{
	$query = "INSERT INTO  `ies_staff`.`departments` (`name`) VALUES ('$name');";
	mysqli_query($db, $query) or die($query);
	header('Location: departments.php');
}else
{

	$query = "UPDATE  `ies_staff`.`departments` SET  `name` =  '$name' WHERE  `departments`.`id` =$id;";
	mysqli_query($db, $query) or die($query);
	header('Location: departments.php');
}
?>

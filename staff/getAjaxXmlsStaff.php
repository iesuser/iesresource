<?php
echo "<?xml version='1.0' encoding='UTF-8'?>";
include("../block/globalVariables.php");
include("../block/db.php");
include("../checklogin.php");// amocmebs tu aris avtorizacia gavlili

mysql_select_db($dbStaff,$db);

if(isset($_POST['dep_id']))
{
	$dep_id = $_POST['dep_id'];
	echo "\n<CATALOG>";
	$query = "SELECT id, name FROM group_laboratories WHERE department_id='$dep_id'";
	$result = mysql_query($query);
	
	while($row = mysql_fetch_array($result))
	{
		echo "\n\t<groupLaboratories>";
		echo "\n\t\t<id>$row[id]</id>";
		echo "\n\t\t<name>$row[name]</name>";
		echo "\n\t</groupLaboratories>";
	}
	echo "\n</CATALOG>";
}


?>
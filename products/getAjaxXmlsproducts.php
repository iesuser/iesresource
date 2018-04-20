<?php
echo "<?xml version='1.0' encoding='UTF-8'?>";
include("../block/globalVariables.php");
include("../block/db.php");
include("../checklogin1.php");// amocmebs tu aris avtorizacia gavlili

mysqli_select_db($db, $dbStaff);

if(isset($_POST['ganyofileba']))
{
	$ganyofileba = $_POST['ganyofileba'];
	if($ganyofileba == "") die();
	$query = "SELECT id FROM departments WHERE name='$ganyofileba'";

	$department = mysqli_fetch_array(mysqli_query($db, $query));
	$dep_id = $department["id"];

	echo "\n<CATALOG>";
	echo "\n\t<groupLaboratories>";
	$query = "SELECT id, name FROM group_laboratories WHERE department_id='$dep_id'";
	$result = mysqli_query($db, $query);
	while($row = mysqli_fetch_array($result))
	{
		echo "\n\t\t<groupLaboratory>";
		echo "\n\t\t\t<name>$row[name]</name>";
		echo "\n\t\t</groupLaboratory>";
	}

	echo "\n\t</groupLaboratories>";

	echo "\n\t<staff>";

	$query="SELECT * FROM  `staff` WHERE dep_id='$dep_id' AND gr_lb_id='0'";
	$result = mysqli_query($db, $query);

	while($row = mysqli_fetch_array($result))
	{
		echo "\n\t\t<employee>";
		echo "\n\t\t\t<firstName>$row[first_name]</firstName>";
		echo "\n\t\t\t<lastName>$row[last_name]</lastName>";
		echo "\n\t\t</employee>";
	}
	echo "\n\t</staff>";
	echo "\n</CATALOG>";
}elseif(isset($_POST['jgufiLaboratoria']))
{
	$jgufiLaboratoria = $_POST['jgufiLaboratoria'];
	if($jgufiLaboratoria == "") die();
	$query = "SELECT id FROM group_laboratories WHERE name='$jgufiLaboratoria'";

	$jgufiLaboratoriebi = mysqli_fetch_array(mysqli_query($db, $query));
	$gr_lb_id = $jgufiLaboratoriebi["id"];

	echo "\n<CATALOG>";
	$query="SELECT * FROM  `staff` WHERE gr_lb_id='$gr_lb_id'";
	$result = mysqli_query($db, $query);

	while($row = mysqli_fetch_array($result))
	{
		echo "\n\t<employee>";
		echo "\n\t\t<firstName>$row[first_name]</firstName>";
		echo "\n\t\t<lastName>$row[last_name]</lastName>";
		echo "\n\t</employee>";
	}
	echo "\n</CATALOG>";

}

?>

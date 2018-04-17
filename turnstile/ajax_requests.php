<?php 
include("../block/globalVariables.php");
include("../block/db.php");

mysql_select_db($dbStaff, $db);
// $staff_data = array();

# ავსებს Select-ებს.


if(isset($_POST['department'])){
	$department = $_POST['department'];
	$staff_data = array();

	
	$lab_result = mysql_query("SELECT * FROM `group_laboratories` WHERE `department_id` = $department ORDER BY `name` ASC",$db);
	$staff_result = mysql_query("SELECT * FROM `staff` WHERE `dep_id` = $department",$db);
	
	
	while($lab_row = mysql_fetch_assoc($lab_result)){
		$staff_data['laboratory'][] = $lab_row;
	}
	while($staff_row = mysql_fetch_assoc($staff_result)){
		$staff_data['staff'][] = $staff_row;
	}
	echo json_encode($staff_data);
}
if(isset($_POST['laboratory']) and !empty($_POST['laboratory'])){
	$laboratory = $_POST['laboratory'];
	// $where = " `gr_lb_id` = '$laboratory' ";
	$staff_data = array();
	$staff_result = mysql_query("SELECT * FROM `staff` WHERE `gr_lb_id` = $laboratory ORDER BY `first_name` ASC",$db);

	while($staff_row = mysql_fetch_assoc($staff_result)){
		$staff_data['staff'][] = $staff_row;
	}
	echo json_encode($staff_data);
}











 ?>
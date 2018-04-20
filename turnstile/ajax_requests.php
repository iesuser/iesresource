<?php
include("../block/globalVariables.php");
include("../block/db.php");

mysqli_select_db($db, $dbStaff);
// $staff_data = array();

# ავსებს Select-ებს.


if(isset($_POST['department'])){
	$department = $_POST['department'];
	$staff_data = array();


	$lab_result = mysqli_query($db, "SELECT * FROM `group_laboratories` WHERE `department_id` = $department ORDER BY `name` ASC");
	$staff_result = mysqli_query($db ,"SELECT * FROM `staff` WHERE `dep_id` = $department");


	while($lab_row = mysqli_fetch_assoc($lab_result)){
		$staff_data['laboratory'][] = $lab_row;
	}
	while($staff_row = mysqli_fetch_assoc($staff_result)){
		$staff_data['staff'][] = $staff_row;
	}
	echo json_encode($staff_data);
}
if(isset($_POST['laboratory']) and !empty($_POST['laboratory'])){
	$laboratory = $_POST['laboratory'];
	// $where = " `gr_lb_id` = '$laboratory' ";
	$staff_data = array();
	$staff_result = mysqli_query($db, "SELECT * FROM `staff` WHERE `gr_lb_id` = $laboratory ORDER BY `first_name` ASC");

	while($staff_row = mysqli_fetch_assoc($staff_result)){
		$staff_data['staff'][] = $staff_row;
	}
	echo json_encode($staff_data);
}











 ?>

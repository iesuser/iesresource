<?php
include("../block/globalVariables.php");
include("../block/db.php");
//if(!HaveAccess("seismicData")){echo CreatePageData($_POST," ../login.php"); exit();}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>დეპარტამენტი</title>
<link href="../block/style.css" rel="stylesheet" type="text/css"/>
<script type='text/javascript' src='departmetns.js'></script>
</head><?php include("../block/mainmenu.php");?>
<?php include("../block/formenu/formenu.php");?>
<body>
<?php
if(isset($_GET['id'])) //რედაქტირება
{
	$tableLabel = "დეპარტამენტის რედაქტირება";
	$btnLabel  = "რედაქტირება";
	$id = $_GET['id'];
	mysqli_select_db($db, $dbStaff);

	$query = "SELECT * FROM departments WHERE id=$id";
	$departments = mysqli_query($db, $query) or die($query);
	$department = mysqli_fetch_array($departments);
	$name = $department['name'];
}else //დამატება
{
	$tableLabel = "დეპარტამენტის დამატება";
	$btnLabel  = "დამატება";
	$id = "";
	$name = "";
}
?>


<!-- Create Menu Settings: (Menu ID, Is Vertical, Show Timer, Hide Timer, On Click, Right to Left, Horizontal Subs, Flush Left) -->
<script type="text/javascript">qm_create(0,false,0,250,false,false,false,false);</script>


<?php
include("../block/globalVariables.php");
include("../block/db.php");
mysqli_select_db($db, $dbStaff);
////////////////////////////////
if ($isAdmin)
                {
////////////////////////////////
$currentDay = new DateTime(date("Y-m-d"));
$currentDay->modify('-15 day');
$minus15Day = $currentDay->format('Y-m-d');
$currentDay->modify('-15 day');
$minus30Day = $currentDay->format('Y-m-d');
$query1 = "SELECT DATEDIFF(contract_end_date, NOW()) AS datedf, contract_end_date, id, first_name, last_name FROM staff WHERE DATEDIFF(contract_end_date, NOW()) < $firstWarningForContractEndDate AND DATEDIFF(contract_end_date, NOW()) >= $secondWarningForContractEndDate";
$query2 = "SELECT DATEDIFF(contract_end_date, NOW()) AS datedf, contract_end_date, id, first_name, last_name FROM staff WHERE DATEDIFF(contract_end_date, NOW()) < $secondWarningForContractEndDate AND  DATEDIFF(contract_end_date, NOW()) > 0";
$query3 = "SELECT DATEDIFF(contract_end_date, NOW()) AS datedf, contract_end_date, id, first_name, last_name FROM staff WHERE DATEDIFF(contract_end_date, NOW()) <= 0 AND DATEDIFF(contract_end_date, NOW()) > -$expDayForSalaryCardEndDate";
$query4 = "SELECT DATEDIFF(salary_card_end_date, NOW()) AS datedf, salary_card_end_date, id, first_name, last_name FROM staff WHERE DATEDIFF(salary_card_end_date, NOW()) < $firstWarningForSalaryCardEndDate AND DATEDIFF(salary_card_end_date, NOW()) >= $secondWarningForSalaryCardEndDate";
$query5 = "SELECT DATEDIFF(salary_card_end_date, NOW()) AS datedf, salary_card_end_date, id, first_name, last_name FROM staff WHERE DATEDIFF(salary_card_end_date, NOW()) < $secondWarningForSalaryCardEndDate AND  DATEDIFF(salary_card_end_date, NOW()) > 0";
$query6 = "SELECT DATEDIFF(salary_card_end_date, NOW()) AS datedf, salary_card_end_date, id, first_name, last_name FROM staff WHERE DATEDIFF(salary_card_end_date, NOW()) <= 0 AND DATEDIFF(salary_card_end_date, NOW()) > -$expDayForSalaryCardEndDate";

$table1 = mysqli_query($db, $query1);
$table2 = mysqli_query($db, $query2);
$table3 = mysqli_query($db, $query3);
$table4 = mysqli_query($db, $query4);
$table5 = mysqli_query($db, $query5);
$table6 = mysqli_query($db, $query6);


if(mysqli_num_rows($table1) > 0 or mysqli_num_rows($table2) > 0 or mysqli_num_rows($table3) > 0 or mysqli_num_rows($table4) > 0 or mysqli_num_rows($table5) > 0 or mysqli_num_rows($table6) > 0):
?>

<?php

while($row = mysqli_fetch_array($table1))
{
	$id=$row["id"];
	$contract_end_date = $row["contract_end_date"];
	$first_name=$row["first_name"];
	$last_name=$row["last_name"];
	$datedf = $row["datedf"];
 ?>
<div class="warningMinus30Day">
 <?php echo "\"<a href='../staff/newEdit_staff.php?id=$id' class='linToUser'>".$first_name ." ".$last_name."</a>\"-ს ხელშეკრულების ვადა გადის ".$datedf." დღეში (".$contract_end_date." -ში)"; ?>
</div>
<?php
}

while($row = mysqli_fetch_array($table2))
{
	$id=$row["id"];
	$contract_end_date = $row["contract_end_date"];
	$first_name=$row["first_name"];
	$last_name=$row["last_name"];
	$datedf = $row["datedf"];
 ?>
<div class="warningMinus15Day">
 <?php echo "\"<a href='../staff/newEdit_staff.php?id=$id' class='linToUser'>".$first_name ." ".$last_name."</a>\"-ს ხელშეკრულების ვადა გადის ".$datedf." დღეში (".$contract_end_date." -ში)"; ?>
</div>
<?php
}

while($row = mysqli_fetch_array($table3))
{
	$id=$row["id"];
	$contract_end_date = $row["contract_end_date"];
	$first_name=$row["first_name"];
	$last_name=$row["last_name"];
	$datedf = $row["datedf"];
 ?>
<div class="warningExpDay">
 <?php echo "\"<a href='../staff/newEdit_staff.php?id=$id' class='linToUser'>".$first_name ." ".$last_name."</a>\"-ს ხელშეკრულებას ვადა გაუვიდა ".$contract_end_date." -ში"; ?>
</div>
<?php
}

while($row = mysqli_fetch_array($table4))
{
	$id=$row["id"];
	$salary_card_end_date = $row["salary_card_end_date"];
	$first_name=$row["first_name"];
	$last_name=$row["last_name"];
	$datedf = $row["datedf"];
 ?>
<div class="warningMinus30Day">
 <?php echo "\"<a href='../staff/newEdit_staff.php?id=$id' class='linToUser'>".$first_name ." ".$last_name."</a>\"-ს სახელფასო ბარათის ვადა გადის".$datedf." დღეში (".$salary_card_end_date." -ში)"; ?>
</div>
<?php
}

while($row = mysqli_fetch_array($table5))
{
	$id=$row["id"];
	$salary_card_end_date = $row["salary_card_end_date"];
	$first_name=$row["first_name"];
	$last_name=$row["last_name"];
	$datedf = $row["datedf"];
 ?>
<div class="warningMinus15Day">
 <?php echo "\"<a href='../staff/newEdit_staff.php?id=$id' class='linToUser'>".$first_name ." ".$last_name."</a>\"-ს სახელფასო ბარათის ვადა გადის ".$datedf." დღეში (".$salary_card_end_date." -ში)"; ?>
</div>
<?php
}

while($row = mysqli_fetch_array($table6))
{
	$id=$row["id"];
	$salary_card_end_date = $row["salary_card_end_date"];
	$first_name=$row["first_name"];
	$last_name=$row["last_name"];
	$datedf = $row["datedf"];
 ?>
<div class="warningExpDay">
 <?php echo "\"<a href='../staff/newEdit_staff.php?id=$id' class='linToUser'>".$first_name ." ".$last_name."</a>\"-ს სახელფასო ბარათს ვადა გაუვიდა ".$salary_card_end_date." -ში"; ?>
</div>
<?php
}
?>
</div>
<?php
endif;
mysqli_select_db($db, $dbInventari);
				}
?>






</body>
</html>

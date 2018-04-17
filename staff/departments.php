<?php
include("../block/globalVariables.php");
include("../block/db.php");
//if(!HaveAccess("seismicData")){echo CreatePageData($_POST," ../login.php"); exit();}
?>
<?php include("../block/mainmenu.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>დეპარტამენტები</title>
<link href="../block/style.css" rel="stylesheet" type="text/css"/>
<?php include("../block/formenu/formenu.php");?>
</head>
<body>
<?php
mysqli_select_db($db, $dbStaff);
if(isset($_GET['dep_id']) and ($_GET['dep_id'] != '') or isset($_GET['gr_lb_id']) and $_GET['gr_lb_id'] != ''):
?>

<table border="0" class="tableStyle" style="margin-left:15px; margin-top:15px;text-align:center;margin-right:15px;">
  <tr class="tableHeader">
    <td>სახელი</td>
    <td>გვარი</td>
    <td>დაბადების თარიღი</td>
    <td>მისამართი</td>
    <td>პირადი №</td>
    <td>თანამდებობა</td>
    <td>ხელშეკრულების<br/>დაწყების<br/>თარიღი</td>
    <td>ხელშეკრულების<br/>დასრულების<br/>თარიღი</td>
    <td>ხელშეკრულების №</td>
    <td>სახელფასო ბარათის<br/>ვადის დასაწყისი</td>
    <td>სახელფასო ბარათის<br/>ვადის დასასრული</td>
    <td>ტელეფონი (სახლი)</td>
    <td>მობილური</td>
    <td>ელ-ფოსტა</td>
    <td>&nbsp;</td>
  </tr>
  <?php
  if(isset($_GET['gr_lb_id']))
  {
	 $WHERE =  "gr_lb_id=".$_GET['gr_lb_id'];
  }else
  {
	  $WHERE = "dep_id=".$_GET['dep_id'];
	  $query = "SELECT id FROM group_laboratories WHERE department_id=".$_GET['dep_id'];
	  $result = mysqli_query($db, $query) or die($query);
	  while($row = mysqli_fetch_array($result))
	  {
		  $WHERE .= " OR gr_lb_id='".$row['id']."'";
	  }
  }
  // AND contract_end_date > Now()
  $query = "SELECT * FROM  `staff` WHERE ".$WHERE." ORDER BY head_of_department DESC";
  $staff = mysqli_query($db, $query) or die($query);
  if(mysqli_num_rows($staff) == 0)
  {
  ?>
  <tr>
    <td colspan="15" style="text-align:center;color:#F03;font-weight:bold;height:25px;">ჩანაწერები არ მოიძებნა</td>
  </tr>
  <?php
  }
  else
  while($stf = mysqli_fetch_array($staff)):
  	  $staff_id = $stf['id'];
	  $first_name = $stf['first_name'];
	  $last_name = $stf['last_name'];
	  $date_of_birth = ($stf['date_of_birth'] =="0000-00-00")?  "" : $stf['date_of_birth'];
	  $address = $stf['address'];
	  $personal_number = $stf['personal_number'];
	  $position = $stf['position'];
	  $contract_start_date = ($stf['contract_start_date'] =="0000-00-00")?  "" : $stf['contract_start_date'];
	  $contract_end_date = ($stf['contract_end_date'] =="0000-00-00")?  "" : $stf['contract_end_date'];
	  $contract_number = $stf['contract_number'];
	  $salary_card_start_date = ($stf['salary_card_start_date'] =="0000-00-00")?  "" : $stf['salary_card_start_date'];
	  $salary_card_end_date = ($stf['salary_card_end_date'] =="0000-00-00")?  "" : $stf['salary_card_end_date'];
	  $home_number = $stf['home_number'];
	  $mobile_phone = $stf['mobile_phone'];
	  $email = $stf['email'];
  ?>
  <tr onclick="javascript:window.location='newEdit_staff.php?id=<?php echo $staff_id;?>'">
    <td><?php echo $first_name; $test = 5;?></td>
    <td><?php echo $last_name;?></td>
    <td><?php echo $date_of_birth;?></td>
    <td><?php echo $address;?></td>
    <td><?php echo $personal_number;?></td>
    <td><?php echo $position;?></td>
    <td><?php echo $contract_start_date;?></td>
    <td><?php echo $contract_end_date;?></td>
    <td><?php echo $contract_number;?></td>
    <td><?php echo $salary_card_start_date;?></td>
    <td><?php echo $salary_card_end_date;?></td>
    <td><?php echo $home_number;?></td>
    <td><?php echo $mobile_phone;?></td>
    <td><?php echo $email;?></td>
    <td style="width:16px;">
	<?php if ($_SESSION['name'] == $siteMaintenanceUsername): ?>
		<img src="../images/edit.png" style="cursor:pointer;" />
	<?php endif?>
	</td>
  </tr>
  </tr>
  <?php
  endwhile;
  ?>
</table>
<?php
endif;
?>

<?php if ($_SESSION['name'] == $siteMaintenanceUsername): ?>
<div class="Btns" style="margin-left:15px;margin-top:15px;">
    <div id ="rewrite" class="Btn" onclick="javascript:window.location='newEdit_staff.php'" style="width:200px;"><img src="../images/submit.png" width="16" height="16" align="absmiddle"> თანამშრომლის დამატება</div>
    <div class="splitDiv"></div>
    <div id="editbutton" class="Btn" style="width:230px;" onclick="javascript:window.location='newEdit_group_laboratory.php'"><img src="../images/submit.png" width="16" height="16" align="absmiddle"> ლაბორატორიის/ჯგუფის დამატება</div>
    <div class="splitDiv"></div>
    <div id ="rewrite" class="Btn" onclick="javascript:window.location='newEdit_departament.php'" style="width:200px;"><img src="../images/submit.png" width="16" height="16" align="absmiddle"> დეპარტამენტის დამატება</div>
</div>
<?php endif?>
<table  border="0" class="tableStyle" style="margin-left:15px; margin-top:15px;min-width:800px">
<?php
$query = "SELECT * FROM departments ORDER by id ASC";
$departaments =  mysqli_query($db, $query) or die($query);
while($departament = mysqli_fetch_array($departaments)):
$department_id = $departament['id'];
$departament_name = $departament['name'];
?>
  <tr class="departamentTableRow" >
    <td colspan="2" onclick="javascript:window.location='departments.php?dep_id=<?php echo $department_id;?>'"><?php echo $departament_name;?></td>
    <td style="width:15px;">
    	<?php if ($_SESSION['name'] == $siteMaintenanceUsername): ?>
    	<img src="../images/edit.png" style="cursor:pointer;" onclick="javascript:window.location='newEdit_departament.php?id=<?php echo $department_id;?>'"/>
        <?php endif;?>
    </td>
  </tr>
<?php
$query = "SELECT * FROM group_laboratories WHERE department_id = $department_id";
$group_laboratories =  mysqli_query($db, $query) or die($query);
while($group_laboratorie = mysqli_fetch_array($group_laboratories)):
$group_laboratorie_id = $group_laboratorie['id'];
$group_laboratorie_name = $group_laboratorie['name'];
?>
  <tr class="groupLaboratoryTableRow" >
    <td style="width:50px;" onclick="javascript:window.location='departments.php?gr_lb_id=<?php echo $group_laboratorie_id;?>'">&nbsp;</td>
    <td onclick="javascript:window.location='departments.php?gr_lb_id=<?php echo $group_laboratorie_id;?>'"><?php echo $group_laboratorie_name;?></td>
    <td style="width:15px;">
    	<?php if ($_SESSION['name'] == $siteMaintenanceUsername): ?>
    	<img src="../images/edit.png" style="cursor:pointer;" onclick="javascript:window.location='newEdit_group_laboratory.php?id=<?php echo $group_laboratorie_id;?>'"/>
        <?php endif;?>
    </td>
  </tr>
<?php
endwhile;
endwhile;
?>
</table>

</body>
</html>

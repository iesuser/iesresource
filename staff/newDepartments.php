<?php
include("../block/globalVariables.php");
include("../block/db.php");
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>დეპარტამენტები</title>
<link rel="stylesheet" href="../block/bootstrap-4.1.1-dist/css/bootstrap.min.css">
<link href="../block/custom-bs4-styles.css" rel="stylesheet" type="text/css"/>
<link href="../block/fontawesome-free-5.1.0-web/css/all.css" rel="stylesheet">
</head>
<body>
<?php include("../block/mainmenu_bs.php");?>
<?php
mysqli_select_db($db, $dbStaff);
if(isset($_GET['dep_id']) and ($_GET['dep_id'] != '') or isset($_GET['gr_lb_id']) and $_GET['gr_lb_id'] != ''):
?>
<table class="table table-hover table-sm">
  <thead class="thead-light">
    <tr>
      <th scope="col">სახელი</th>
      <th scope="col">გვარი</th>
      <th scope="col">დაბადების თარიღი</th>
      <th scope="col">მისამართი</th>
      <th scope="col">პირადი №</th>
      <th scope="col">თანამდებობა</th>
      <th scope="col">ხელშეკრულების დაწყების თარიღი</th>
      <th scope="col">ხელშეკრულების დასრულების თარიღი</th>
      <th scope="col">ხელშეკრულების №</td>
      <th scope="col">სახელფასო ბარათის ვადის დასაწყისი</th>
      <th scope="col">სახელფასო ბარათის ვადის დასასრული</th>
      <th scope="col">ტელეფონი (სახლი)</th>
      <th scope="col">მობილური</th>
      <th scope="col">ელ-ფოსტა</th>
      <th scope="col">&nbsp;</th>
    </tr>
  </thead>
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
    <td colspan="15" style="text-align:center; font-size: 25px; font-weight: bold;" class="text-danger">ჩანაწერები არ მოიძებნა</td>
  </tr>
  <?php
  }
  else
  //counting rows
  $counter = 1;
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
  <tbody>
    <tr onclick="javascript:window.location='newEdit_staff.php?id=<?php echo $staff_id;?>'">
      <th scope="row"><?php echo $counter ?></th>
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
      <td>
        <i class="far fa-edit" style="cursor:pointer;"></i>
      </td>
    </tr>
  </tbody>
  <?php
  $counter ++;
  endwhile;
  ?>
</table>
<?php
endif;
?>
<div class="container-fluid">
  <div class="row mt-2">
    <div class="col-md-8 offset-md-2 d-xl-flex justify-content-between">
      <a href="newEdit_staff.php" class="btn btn-secondary">თანამშრომლის დამატება</a>
      <a href="newEdit_group_laboratory.php" class="btn btn-secondary">ლაბორატორიის/ჯგუფის დამატება</a>
      <a href="newEdit_departament.php" class="btn btn-secondary">დეპარტამენტის დამატება</a>
    </div>
  </div>
  <div class="row mt-2">
    <div class="col-md-8 offset-md-2">
      <div class="list-group">
        <?php
        $query = "SELECT * FROM departments ORDER by id ASC";
        $departaments =  mysqli_query($db, $query) or die($query);
        while($departament = mysqli_fetch_array($departaments)):
        $department_id = $departament['id'];
        $departament_name = $departament['name'];
        ?>
        <div class="list-group-item list-group-item-action list-group-item-primary" onclick="location.href='newDepartments.php?dep_id=<?php echo $department_id;?>';" style="cursor: pointer;">
          <?php echo $departament_name; ?>
          <!-- icon link -->
          <a href="newEdit_departament.php?id=<?php echo $department_id;?>">
          	<?php if ($_SESSION['name'] == $siteMaintenanceUsername): ?>
              <i class="far fa-edit" style="cursor:pointer; float:right"></i>
              <?php endif;?>
          </a>
        </div>
        <?php
        $query = "SELECT * FROM group_laboratories WHERE department_id = $department_id";
        $group_laboratories =  mysqli_query($db, $query) or die($query);
        while($group_laboratorie = mysqli_fetch_array($group_laboratories)):
        $group_laboratorie_id = $group_laboratorie['id'];
        $group_laboratorie_name = $group_laboratorie['name'];
        ?>
        <div class="list-group-item list-group-item-action list-group-item-light" onclick="location.href='newDepartments.php?gr_lb_id=<?php echo $group_laboratorie_id;?>';" style="cursor: pointer;">
          <span href=''style="padding-left: 50px;"><?php echo $group_laboratorie_name; ?></span>
          <!-- icon2 link -->
          <a href="newEdit_group_laboratory.php?id=<?php echo $group_laboratorie_id;?>">
            <?php if ($_SESSION['name'] == $siteMaintenanceUsername): ?>
              <i class="far fa-edit" style="cursor:pointer; float:right;"></i>
            <?php endif;?>
          </a>
        </div>
        <?php
        endwhile;
        endwhile;
        ?>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="../block/bootstrap-4.1.1-dist/js/jquery-3.3.1.min.js"></script>
<script type='text/javascript' src="../block/bootstrap-4.1.1-dist/js/popper.min.js"></script>
<script type='text/javascript' src="../block/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
</body>
</html>

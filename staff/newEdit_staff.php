<?php
include("../block/globalVariables.php");
include("../block/db.php");
include("../block/mainmenu_bs.php");
include("../checklogin1.php");
if($_SESSION['name'] != $siteMaintenanceUsername) die("Error 333");
//if(!HaveAccess("seismicData")){echo CreatePageData($_POST," ../login.php"); exit();}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>დეპარტამენტი</title>
		<link rel="stylesheet" href="../block/bootstrap-4.1.1-dist/css/bootstrap.min.css">
	  <link href="../block/custom-bs4-styles.css" rel="stylesheet" type="text/css"/>
	  <link href="../block/fontawesome-free-5.1.0-web/css/all.css" rel="stylesheet">
	</head>
	<body>
<?php
mysqli_select_db($db, $dbStaff);
if(isset($_GET['id'])) //რედაქტირება
{
	$tableLabel = "თანამშრომლების რედაქტირება";
	$btnLabel  = "რედაქტირება";
	$id = $_GET['id'];
	$query = "SELECT * FROM staff WHERE id=$id";
	$staffs = mysqli_query($db, $query) or die($query);
	$staff = mysqli_fetch_array($staffs);
	$dep_id = $staff['dep_id'];
	$gr_lb_id = $staff['gr_lb_id'];
	$first_name = $staff['first_name'];
	$last_name = $staff['last_name'];
	$date_of_birth = $staff['date_of_birth'];
	$address = $staff['address'];
	$personal_number = $staff['personal_number'];
  $card_number = $staff['card_number'];
	$position = $staff['position'];
	$contract_start_date = $staff['contract_start_date'];
	$contract_end_date = $staff['contract_end_date'];
	$contract_number = $staff['contract_number'];
	$salary_card_start_date = $staff['salary_card_start_date'];
	$salary_card_end_date = $staff['salary_card_end_date'];
	$home_number = $staff['home_number'];
	$mobile_phone = $staff['mobile_phone'];
	$email = $staff['email'];
	$komentari = $staff['komentari'];
	$password = $staff['password'];
	$head_of_department=$staff['head_of_department'];
  $head_of_department=$staff['head_of_department'];



}else //დამატება
{

  $id =-1;
	$tableLabel = "თანამშრომლების დამატება";
	$btnLabel  = "დამატება";
	$dep_id = "";
	$gr_lb_id = "";
	$first_name = "";
	$last_name = "";
	$date_of_birth = "";
	$address = "";
	$personal_number = "";
  $card_number = "";
	$position = "";
	$contract_start_date = "";
	$contract_end_date = "";
	$contract_number = "";
	$salary_card_start_date = "";
	$salary_card_end_date = "";
	$home_number = "";
	$mobile_phone = "";
	$email = "";
	$komentari = "";
	$password="";
	$head_of_department="";
}
?>
<form action="add_staff.php"method="post" name="formStaff" id="formStaff">
	<div class="w-75 ies-container mb-5 border" style="margin: auto;">
		<h4 id="formtitle" class="text-center"><?php echo $tableLabel; ?></h4>
		<p class="text-center mb-4">(შეავსეთ <span class="required-star">*</span>-იანი ველები აუცილებლად)</p>
		<input type="hidden" id="id" name="id" value="<?php echo $id?>">
		<div class="form-group">
			<label for="dep_id">დეპარტამენტი <span class="required-star">*</span></label>
			<select class="custom-select" name="dep_id" id= "dep_id"  onchange="javascript:onDepartamentSelect();">
				<option value=""></option>
				<?php
				$query = "SELECT * FROM departments ORDER by id ASC";
				$departmnets = mysqli_query($db, $query) or die($query);
				while($departmnet = mysqli_fetch_array($departmnets))
				{
					$db_department_id = $departmnet["id"];
					$db_department_name = $departmnet["name"];
				?>
					<option value="<?php echo $db_department_id;?>" <?php if($db_department_id == $dep_id) echo "selected='selected'";?>><?php echo $db_department_name;?></option>
				<?php
				}
				?>
			</select>
		</div>
		<div class="form-group">
			<label for="gr_lb_id">ლაბორატორია/ჯგუფი</label>
			<select class="custom-select" name="gr_lb_id" id="gr_lb_id">
				<option value=""></option>
				<?php
        $query = "SELECT * FROM group_laboratories WHERE department_id='$dep_id' ORDER by id ASC";
        $group_laboratories = mysqli_query($db, $query) or die($query);
        while($group_laboratory = mysqli_fetch_array($group_laboratories)) {
					$db_group_laboratories_id = $group_laboratory["id"];
          $db_group_laboratories_name = $group_laboratory["name"];
        ?>
        <option value="<?php echo $db_group_laboratories_id;?>" <?php if($db_group_laboratories_id == $gr_lb_id) echo "selected='selected'";?>><?php echo $db_group_laboratories_name;?></option>
        <?php
        }
        ?>
			</select>
		</div>
		<div class="form-group">
			<label for="first_name">სახელი <span class="required-star">*</span></label>
			<input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo $first_name?>">
		</div>
		<div class="form-group">
			<label for="last_name">გვარი <span class="required-star">*</span></label>
			<input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo $last_name?>">
		</div>
		<div class="form-group">
			<label for="date_of_birth">დაბადების თარიღი</label>
			<div class="input-group">
				<div class="input-group-prepend">
					<button class="btn btn-outline-secondary" type="button" id="button_date_of_birth"><i class="far fa-calendar-alt"></i></button>
				</div>
				<input type="text" id="date_of_birth" name="date_of_birth" class="form-control datepicker" value="<?php $date_of_birth = ($date_of_birth =="0000-00-00")?  "" : $date_of_birth; echo $date_of_birth;?>"></div>
		</div>
		<div class="form-group">
			<label for="address">მისამართი</label>
			<input type="text" class="form-control" name="address" id="address" value="<?php echo $address?>">
		</div>
		<div class="form-group">
			<label for="personal_number">პირადი №</label>
			<input type="text" class="form-control" name="personal_number" id="personal_number" value="<?php echo $personal_number?>">
		</div>
		<div class="form-group">
			<label for="card_number">სამსახუროებრივი ბარათის №</label>
			<input type="text" class="form-control" name="card_number" id="card_number" value="<?php echo $card_number?>">
		</div>
		<div class="form-group">
			<label for="position">თანამდებობა</label>
			<input type="text" class="form-control" name="position" id="position" value="<?php echo $position?>">
		</div>
		<div class="form-group">
	    <div class="form-check">
	      <input class="form-check-input" type="checkbox" name="head_of_department" id="head_of_department" onchange="javascript:showHideRows()" <?php if($head_of_department == "კი") echo "checked='checked'"; ?>>
	      <label class="form-check-label" for="head_of_department">
	        დეპარტამენტის უფროსი
	      </label>
	    </div>
  	</div>
		<div class="form-group" id="password1">
			<label for="password">პაროლი</label>
			<input type="text" class="form-control" name="password" id="password"  value="<?php echo $password?>">
		</div>
		<div class="form-group">
			<label for="contract_start_date">ხელშეკრულების დაწყების თარიღი</label>
			<div class="input-group">
				<div class="input-group-prepend">
					<button class="btn btn-outline-secondary" type="button" id="button_contract_start_date"><i class="far fa-calendar-alt"></i></button>
				</div>
				<input type="text" id="contract_start_date" name="contract_start_date" class="form-control datepicker" value="<?php $contract_start_date = ($contract_start_date =="0000-00-00")?  "" : $contract_start_date; echo $contract_start_date;?>"></div>
		</div>
		<div class="form-group">
			<label for="contract_end_date">ხელშეკრულების დასრულების თარიღი</label>
			<div class="input-group">
				<div class="input-group-prepend">
					<button class="btn btn-outline-secondary" type="button" id="button_contract_end_date"><i class="far fa-calendar-alt"></i></button>
				</div>
				<input type="text" id="contract_end_date" name="contract_end_date" class="form-control datepicker" value="<?php $contract_end_date = ($contract_end_date =="0000-00-00")?  "" : $contract_end_date; echo $contract_end_date;?>"></div>
		</div>
		<div class="form-group">
			<label for="contract_number">ხელშეკრულების №</label>
			<input type="text" class="form-control" name="contract_number" id="contract_number" value="<?php echo $contract_number?>">
		</div>
		<div class="form-group">
			<label for="salary_card_start_date">სახელფასო ბარათის ვადის დასაწყისი</label>
			<div class="input-group">
				<div class="input-group-prepend">
					<button class="btn btn-outline-secondary" type="button" id="button_salary_card_start_date"><i class="far fa-calendar-alt"></i></button>
				</div>
				<input type="text" id="salary_card_start_date" name="salary_card_start_date" class="form-control datepicker" value="<?php $salary_card_start_date = ($salary_card_start_date =="0000-00-00")?  "" : $salary_card_start_date; echo $salary_card_start_date;?>"></div>
		</div>
		<div class="form-group">
			<label for="salary_card_end_date">სახელფასო ბარათის ვადის დასასრული</label>
			<div class="input-group">
				<div class="input-group-prepend">
					<button class="btn btn-outline-secondary" type="button" id="button_salary_card_end_date"><i class="far fa-calendar-alt"></i></button>
				</div>
				<input type="text" id="salary_card_end_date" name="salary_card_end_date" class="form-control datepicker" value="<?php $salary_card_end_date = ($salary_card_end_date =="0000-00-00")?  "" : $salary_card_end_date; echo $salary_card_end_date;?>"></div>
		</div>
		<div class="form-group">
			<label for="home_number">ტელეფონი(სახლი)</label>
			<input type="text" class="form-control" name="home_number" id="home_number" value="<?php echo $home_number?>">
		</div>
		<div class="form-group">
			<label for="mobile_phone">მობილური</label>
			<input type="text" class="form-control" name="mobile_phone" id="mobile_phone" value="<?php echo $mobile_phone?>">
		</div>
		<div class="form-group">
			<label for="email">ელ-ფოსტა</label>
			<input type="email" class="form-control" name="email" id="email" value="<?php echo $email?>">
		</div>
		<div class="form-group">
			<label for="komentari" >დამატებითი ინფორმაცია</label>
			<textarea id="komentari" name="komentari" class="form-control"><?php echo mysqli_real_escape_string($db, $komentari);?></textarea>
		</div>
		<button class="btn btn-unique" onclick="javascript:goToDepartametnsPage()" type="button">უკან</button>
		<button class="btn btn-primary" onclick="javascript:checkStaffFormSubmit()" type="button" style="float:right;"><?php echo $btnLabel;?></button>
	</div>
</form>
<script type="text/javascript" src="../block/bootstrap-4.1.1-dist/js/jquery-3.3.1.min.js"></script>
<script type='text/javascript' src="../block/bootstrap-4.1.1-dist/js/popper.min.js"></script>
<script type='text/javascript' src="../block/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
<script type='text/javascript' src="../block/jQuery-Mask-Plugin-master/dist/jquery.mask.min.js"></script>
<script type='text/javascript' src="../block/mask.js"></script>
<script type='text/javascript' src='departmetns.js'></script>
</body>
<link rel="stylesheet" type="text/css" href="../block/jqplugins/datetimepicker/jquery.datetimepicker.min.css"/ >
<script src="../block/jqplugins/datetimepicker/jquery.datetimepicker.full.min.js"></script>
</html>

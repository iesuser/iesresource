<?php
include("../block/globalVariables.php");
include("../block/db.php");
include("../block/mainmenu_bs.php");
if($_SESSION['name'] != $siteMaintenanceUsername) die("Error 333");
//if(!HaveAccess("seismicData")){echo CreatePageData($_POST," ../login.php"); exit();}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ლაბორატორია</title>
<link rel="stylesheet" href="../block/bootstrap-4.1.1-dist/css/bootstrap.min.css">
<link href="../block/custom-bs4-styles.css" rel="stylesheet" type="text/css"/>
<link href="../block/fontawesome-free-5.1.0-web/css/all.css" rel="stylesheet">
</head>
<body>
<?php
mysqli_select_db($db, $dbStaff);
if(isset($_GET['id'])) //რედაქტირება
{
	$tableLabel = "ლაბორატორიის/ჯგუფის რედაქტირება";
	$btnLabel  = "რედაქტირება";
	$id = $_GET['id'];

	$query = "SELECT * FROM group_laboratories WHERE id=$id";
	$group_laboratories = mysqli_query($db, $query) or die($query);
	$group_laboratory = mysqli_fetch_array($group_laboratories);
	$department_id = $group_laboratory['department_id'];
	$name = $group_laboratory['name'];
}else //დამატება
{
	$tableLabel = "ლაბორატორიის/ჯგუფის დამატება";
	$btnLabel  = "დამატება";
	$id = "";
	$department_id = "";
	$name = "";
}
?>
<form action="add_group_laboratory.php"method="post" name="formGroupLaboratory" id="formGroupLaboratory">
	<div class="w-75 ies-container mb-5 border m-auto">
		<h4 id="formtitle" class="text-center"><?php echo $tableLabel; ?></h4>
		<p class="text-center mb-4">(შეავსეთ <span class="required-star">*</span>-იანი ველები აუცილებლად)</p>
		<div class="form-group">
			<div class="input-group">
				<div class="input-group-prepend">
					<label class="input-group-text" for="department_id" style="min-width: 196px;">დეპარტამენტი</label>
				</div>
				<select class="custom-select" name="department_id" id= "department_id">
					<option value=""></option>
					<?php
					$query = "SELECT * FROM departments ORDER by id ASC";
					$departmnets = mysqli_query($db, $query) or die($query);
					while($departmnet = mysqli_fetch_array($departmnets)) {
						$db_department_id = $departmnet["id"];
						$db_department_name = $departmnet["name"];
						?>
						<option value="<?php echo $db_department_id;?>" <?php if($db_department_id == $department_id) echo "selected='selected'";?>><?php echo $db_department_name;?></option>
						<?php
					}
					?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<div class="input-group">
				<div class="input-group-prepend">
					<label class="input-group-text" for="name">ჯგუფი/ლაბორატორია</label>
				</div>
				<input type="text" class="form-control" name="name" id="name" value="<?php echo $name?>">
			</div>
		</div>
		<button class="btn btn-unique" onclick="javascript:goToDepartametnsPage()" type="button">უკან</button>
		<button class="btn btn-primary" onclick="javascript:checkGroupLaboratoryFormSubmit()" type="button" style="float:right;"><?php echo $btnLabel;?></button>
	</div>
</form>
<script type="text/javascript" src="../block/bootstrap-4.1.1-dist/js/jquery-3.3.1.min.js"></script>
<script type='text/javascript' src="../block/bootstrap-4.1.1-dist/js/popper.min.js"></script>
<script type='text/javascript' src="../block/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
<script type='text/javascript' src='departmetns.js'></script>
</body>
</html>

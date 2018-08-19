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
<title>დეპარტამენტი</title>
<link rel="stylesheet" href="../block/bootstrap-4.1.1-dist/css/bootstrap.min.css">
<link href="../block/custom-bs4-styles.css" rel="stylesheet" type="text/css"/>
<link href="../block/fontawesome-free-5.1.0-web/css/all.css" rel="stylesheet">
</head>
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
<form action="add_department.php"method="post" name="formDepartment" id="formDepartment">
	<div class="w-75 ies-container mb-5 border m-auto">
		<h4 id="formtitle" class="text-center"><?php echo $tableLabel; ?></h4>
		<p class="text-center mb-4">(შეავსეთ <span class="required-star">*</span>-იანი ველები აუცილებლად)</p>
		<div class="form-group">
			<div class="input-group">
				<div class="input-group-prepend">
					<label class="input-group-text" for="name">სახელწოდება</label>
				</div>
				<input type="text" class="form-control" name="name" id="name" value="<?php echo $name?>">
			</div>
		</div>
		<button class="btn btn-unique" onclick="javascript:goToDepartametnsPage()" type="button">უკან</button>
		<button class="btn btn-primary" onclick="javascript:checkDepartamentFormSubmit()" type="button" style="float:right;"><?php echo $btnLabel;?></button>
	</div>
</form>
<script type="text/javascript" src="../block/bootstrap-4.1.1-dist/js/jquery-3.3.1.min.js"></script>
<script type='text/javascript' src="../block/bootstrap-4.1.1-dist/js/popper.min.js"></script>
<script type='text/javascript' src="../block/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
<script type='text/javascript' src='departmetns.js'></script>
</body>
</html>

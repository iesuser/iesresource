<?php
include("../block/globalVariables.php");
include("../block/db.php");
include("../block/mainmenu.php");
if($_SESSION['name'] != $siteMaintenanceUsername) die("Error 333");
//if(!HaveAccess("seismicData")){echo CreatePageData($_POST," ../login.php"); exit();}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>დეპარტამენტი</title>
<link href="../block/style.css" rel="stylesheet" type="text/css"/>
<script type='text/javascript' src='departmetns.js'></script>
<?php include("../block/formenu/formenu.php");?>
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
<div align="center">
      <table width="800px" border="0" class="formstyle" style="border-spacing:0px;padding:0px;margin:15px;">
      <tr>
        <td colspan="2" id="formtitle" class="formtitle"><?php echo $tableLabel;?> (შეავსეთ <span style="color:#F00;">*</span>-იანი ველები აუცილებლად)
        <input type="hidden" id="id" name="id" value="<?php echo $id?>"/>
        </td>
      </tr>
      <tr>
        <td class="tablecolm1" width="12%" style="height:50px;">სახელწოდება</td>
        <td><input type="text" name="name" id="name" value="<?php echo $name?>" style="width:665px;margin-left:5px;" /><span style="color:#F00;">*</span></td>
      </tr>
      <tr>
        <td colspan="2" align="center" style="border-top:1px dotted #CCC;height:45px;">
          <div class="Btns">
            <div id="editbutton" class="Btn" onclick="javascript:checkDepartamentFormSubmit()"><?php echo $btnLabel;?></div>

            <div class="splitDiv"></div>
            <div class="Btn" onclick="javascript:goToDepartametnsPage()">უკან</div>
          </div>
        </td>
      </tr>
      </table>
  </div>
</form>

</body>
</html>

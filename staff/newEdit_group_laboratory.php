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
<title>ლაბორატორია</title>
<link href="../block/style.css" rel="stylesheet" type="text/css"/>
<script type='text/javascript' src='departmetns.js'></script>
<?php include("../block/formenu/formenu.php");?>
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
  <div align="center">
      <table width="800px" border="0" class="formstyle" style="border-spacing:0px;padding:0px;margin:15px;">
      <tr>
        <td colspan="2" id="formtitle" class="formtitle"><?php echo $tableLabel;?> (შეავსეთ <span style="color:#F00;">*</span>-იანი ველები აუცილებლად)
        <input type="hidden" id="id" name="id" value="<?php echo $id?>"/>
        </td>
      </tr>
      <tr>
        <td class="tablecolm1" width="12%" style="height:50px;">სახელწოდება</td>
        <td>
           <select name="department_id" id= "department_id" style="width:665px;margin-left:5px;">
            <option value=""></option>
            <?php
			$query = "SELECT * FROM departments ORDER by id ASC";
            $departmnets = mysqli_query($db, $query) or die($query);
            while($departmnet = mysqli_fetch_array($departmnets))
            {
				$db_department_id = $departmnet["id"];
				$db_department_name = $departmnet["name"];

                ?>
            <option value="<?php echo $db_department_id;?>" <?php if($db_department_id == $department_id) echo "selected='selected'";?>><?php echo $db_department_name;?></option>
            <?php
            }
            ?>
          </select><span style="color:#F00;">*</span></td>
      </tr>
      <tr>
        <td class="tablecolm1" width="12%" style="height:50px;">სახელწოდება</td>
        <td><input type="text" name="name" id="name" value="<?php echo $name?>" style="width:665px;margin-left:5px;" /><span style="color:#F00;">*</span></td>
      </tr>
      <tr>
        <td colspan="2" align="center" style="border-top:1px dotted #CCC;height:45px;">
          <div class="Btns">
            <div id="editbutton" class="Btn" onclick="javascript:checkGroupLaboratoryFormSubmit()"><?php echo $btnLabel;?></div>

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

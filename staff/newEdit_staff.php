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
<script type='text/javascript' src="../js/mask.js"></script>
<script type='text/javascript' src='../block/datetimepicker/datetimepicker_css_ge.js'></script>
<script type='text/javascript' src="../js/jquery-1.7.2.min.js"></script>
<?php include("../block/formenu/formenu.php");?>
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

<div align="center">
      <table width="800px" border="0" class="formstyle" style="border-spacing:0px;padding:0px;margin:15px;">
      <tr>
        <td colspan="2" id="formtitle" class="formtitle"><?php echo $tableLabel;?> (შეავსეთ <span style="color:#F00;">*</span>-იანი ველები აუცილებლად)
        <input type="hidden" id="id" name="id" value="<?php echo $id?>"/>
        </td>
      </tr>
      <tr>
        <td class="tablecolm1" width="45%" style="height:50px;">დეპარტამენტი</td>
        <td>
          <select name="dep_id" id= "dep_id" style="width:365px;margin-left:5px;" onchange="javascript:onDepartamentSelect();">
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
          </select><span style="color:#F00;">*</span></td>
      </tr>
      <tr>
        <td class="tablecolm1"  style="height:50px;">ლაბორატორია/ჯგუფი</td>
        <td><select name="gr_lb_id" id= "gr_lb_id" style="width:365px;margin-left:5px;">
                <option value=""></option>
				<?php
                $query = "SELECT * FROM group_laboratories WHERE department_id='$dep_id' ORDER by id ASC";
                $group_laboratories = mysqli_query($db, $query) or die($query);
                while($group_laboratory = mysqli_fetch_array($group_laboratories))
                {
                    $db_group_laboratories_id = $group_laboratory["id"];
                    $db_group_laboratories_name = $group_laboratory["name"];
                    ?>
                <option value="<?php echo $db_group_laboratories_id;?>" <?php if($db_group_laboratories_id == $gr_lb_id) echo "selected='selected'";?>><?php echo $db_group_laboratories_name;?></option>
                <?php
                }
                ?>
        	</select>
        </td>
      </tr>
      <tr>
        <td class="tablecolm1"  style="height:50px;">სახელი</td>
        <td><input type="text" name="first_name" id="first_name" value="<?php echo $first_name?>" style="width:150px;margin-left:5px;" /><span style="color:#F00;">*</span></td>
      </tr>
      <tr>
        <td class="tablecolm1"  style="height:50px;">გვარი</td>
        <td><input type="text" name="last_name" id="last_name" value="<?php echo $last_name?>" style="width:150px;margin-left:5px;" /><span style="color:#F00;">*</span></td>
      </tr>
      <tr>
        <td class="tablecolm1"  style="height:50px;">დაბადების თარიღი</td>
        <td><input type="text" name="date_of_birth" id="date_of_birth" onkeyup= "return maskdate(event,this);" value="<?php $date_of_birth = ($date_of_birth =="0000-00-00")?  "" : $date_of_birth; echo $date_of_birth;?>"
         style="width:150px;margin-left:5px;" maxlength="10"/>
            <a href="javascript:NewCssCal('date_of_birth','yyyymmdd','arrow',false,24,false,true)">
            <img border="0" src="../block/datetimepicker/images/cal.gif" width="16" height="16" alt="Pick a date"></a>
        </td>
      </tr>
       <tr>
        <td class="tablecolm1"  style="height:50px;">მისამართი</td>
        <td><input type="text" name="address" id="address" value="<?php echo $address?>" style="width:150px;margin-left:5px;" maxlength="255"/>
      </td>
      </tr>
	  <tr>
        <td class="tablecolm1"  style="height:50px;">პირადი №</td>
        <td><input type="text" name="personal_number" id="personal_number" onkeyup="javascript:maskInt(this);" value="<?php echo $personal_number?>" style="width:150px;margin-left:5px;" maxlength="11" /></td>
      </tr>
    <tr>
        <td class="tablecolm1"  style="height:50px;">სამსახუროებრივი ბარათის №</td>
        <td><input type="text" name="card_number" id="card_number" onkeyup="javascript:maskInt(this);" value="<?php echo $card_number?>" style="width:150px;margin-left:5px;" maxlength="11" /></td>
      </tr>
      <tr>
        <td class="tablecolm1"  style="height:50px;">თანამდებობა</td>
        <td><input type="text" name="position" id="position" value="<?php echo $position?>" style="width:150px;margin-left:5px;" /></td>
      </tr>
            <tr>
        <td class="tablecolm1"  style="height:50px;">დეპარტამენტის უფროსი</td>
        <td><input type="checkbox" name="head_of_department" id="head_of_department"  onchange="javascript:showHideRows()" <?php if($head_of_department == "კი") echo "checked='checked'"; ?> /></td>
      </tr>

	  <tr id="password1" style="display:none">
        <td class="tablecolm1"   style="height:50px;">პაროლი</td>
        <td><input type="text" name="password" id="password"  value=""<?php echo $password?>" style="width:150px;margin-left:5px;" maxlength="11" /></td>
      </tr>

      <tr>
        <td class="tablecolm1"  style="height:50px;">ხელშეკრულების დაწყების თარიღი</td>
        <td><input type="text" name="contract_start_date" id="contract_start_date" onkeyup= "return maskdate(event,this);" value="<?php $contract_start_date = ($contract_start_date =="0000-00-00")?  "" : $contract_start_date; echo $contract_start_date;?>" style="width:150px;margin-left:5px;"
="10"/>
            <a href="javascript:NewCssCal('contract_start_date','yyyymmdd','arrow',false,24,false,true)">
            <img border="0" src="../block/datetimepicker/images/cal.gif" width="16" height="16" alt="Pick a date"></a>
        </td>
      </tr>
            <tr>
        <td class="tablecolm1"  style="height:50px;">ხელშეკრულების დასრულების თარიღი</td>
        <td><input type="text" name="contract_end_date" id="contract_end_date" onkeyup= "return maskdate(event,this);" value="<?php $contract_end_date = ($contract_end_date =="0000-00-00")?  "" : $contract_end_date; echo $contract_end_date;?>" style="width:150px;margin-left:5px;" maxlength="10"/>
            <a href="javascript:NewCssCal('contract_end_date','yyyymmdd','arrow',false,24,false,true)">
            <img border="0" src="../block/datetimepicker/images/cal.gif" width="16" height="16" alt="Pick a date"></a>
        </td>
      </tr>
      <tr>
        <td class="tablecolm1"  style="height:50px;">ხელშეკრულების №</td>
        <td><input type="text" name="contract_number" id="contract_number" value="<?php echo $contract_number?>" style="width:150px;margin-left:5px;" onkeyup="javascript:maskInt(this);"/></td>
      </tr>
      <tr>
        <td class="tablecolm1"  style="height:50px;">სახელფასო ბარათის ვადის დასაწყისი</td>
        <td><input type="text" name="salary_card_start_date" id="salary_card_start_date" onkeyup= "return maskdate(event,this);" value="<?php $salary_card_start_date = ($salary_card_start_date =="0000-00-00")?  "" : $salary_card_start_date; echo $salary_card_start_date;?>" style="width:150px;margin-left:5px;" maxlength="10"/>
            <a href="javascript:NewCssCal('salary_card_start_date','yyyymmdd','arrow',false,24,false,true)">
            <img border="0" src="../block/datetimepicker/images/cal.gif" width="16" height="16" alt="Pick a date"></a>
        </td>
      </tr>
      <tr>
        <td class="tablecolm1"  style="height:50px;">სახელფასო ბარათის ვადის დასასრული</td>
        <td><input type="text" name="salary_card_end_date" id="salary_card_end_date" onkeyup= "return maskdate(event,this);" value="<?php $salary_card_end_date = ($salary_card_end_date =="0000-00-00")?  "" : $salary_card_end_date; echo $salary_card_end_date;?>" style="width:150px;margin-left:5px;" maxlength="10"/>
            <a href="javascript:NewCssCal('salary_card_end_date','yyyymmdd','arrow',false,24,false,true)">
            <img border="0" src="../block/datetimepicker/images/cal.gif" width="16" height="16" alt="Pick a date"></a>
        </td>
      </tr>

                  <tr>
        <td class="tablecolm1"  style="height:50px;">ტელეფონი(სახლი)</td>
        <td><input type="text" name="home_number" id="home_number" value="<?php echo $home_number?>" style="width:150px;margin-left:5px;" /></td>
      </tr>
      <tr>
        <td class="tablecolm1"  style="height:50px;">მობილური</td>
        <td><input type="text" name="mobile_phone" id="mobile_phone" value="<?php echo $mobile_phone?>" style="width:150px;margin-left:5px;" /></td>
      </tr>
      <tr>
        <td class="tablecolm1"  style="height:50px;">ელ-ფოსტა</td>
        <td><input type="text" name="email" id="email" value="<?php echo $email?>" style="width:150px;margin-left:5px;" /></td>
      </tr>
      <tr>
        <td class="tablecolm1">დამატებითი ინფორმაცია</td>
        <td><textarea style="resize: none;" cols="35" rows="6" name="komentari" id="komentari"><?php echo $komentari;?></textarea></td>
      </tr>
      <tr>
        <td colspan="2" align="center" style="border-top:1px dotted #CCC;height:45px;">
          <div class="Btns">
            <div id="editbutton" class="Btn" onclick="javascript:checkStaffFormSubmit()"><?php echo $btnLabel;?></div>

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

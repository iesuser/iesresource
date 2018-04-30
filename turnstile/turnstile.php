<?php
include("../block/globalVariables.php");
include("../block/db.php");
//if(!HaveAccess("seismicData")){echo CreatePageData($_POST," ../login.php"); exit();}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <script src="../block/jquery3.2.1/jquery-3.2.1.min.js"></script>
  <?php include("mainmenu.php");?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- bootstrap -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

<title>ტურნიკეტი</title>
<link rel="stylesheet" href="../block/bootstrap3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="../block/bootstrap3.3.7/css/bootstrap-theme.min.css">
<script src="../block/bootstrap3.3.7/js/bootstrap.min.js"></script>
<link href="../block/style.css" rel="stylesheet" type="text/css"/>
<link href="animate.css" rel="stylesheet" type="text/css"/>
<?php include("../block/formenu/formenu.php");?>
</head>
<body>


<script type='text/javascript' src="../js/mask.js"></script>
<!-- <script type='text/javascript' src="../products/products.js"></script> -->

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
    <div class="form-group">
      <form action="products.php" method="post" name="formsearch" id="formsearch"  style="width:100%;" class="turnstile-form">
    		<script type='text/javascript' src='../block/datetimepicker/datetimepicker_css_ge.js'></script>


          <table class="table" id="filter_table" style="max-width:750px; border:#CCC solid 1px;" border="0" cellspacing="0">
              <tr>
                <td style="background-color: #bbccff;" colspan="7"></td>
              </tr>

              <tr >
                <td class="filterFormLabel" style="color:#7E9EFF; ">დეპარტამენტი:</td>
                <td class="rightDottedBorder">
    				    <?php mysqli_select_db($db, $dbStaff);	//მონაცემთა ბაზის გადართვა?>
                 	<select name="ganyofileba" id="ganyofileba" style="width:156px; height: 25px; padding: 0" class="form-control " onchange="select_department()">
                   		<option value=""></option>
    				   <?php
                  $table = mysqli_query($db, "SELECT id,name FROM departments ORDER by id ASC");
                  while($row = mysqli_fetch_array($table))
                  {
                      $name = $row["name"];
                      $dep_id = $row["id"];
                      ?>

                   <option value="<?php echo $dep_id;?>"><?php echo $name;?></option>

                     <?php
                  }
                ?>
                 	</select>
             </td>
                <td class="filterFormLabel" style="color:#7E9EFF;">თარიღი:</td>
                <td>
    				<input type="text" name="tarigi_dan" id="tarigi_dan" onkeyup= "return maskdate(event,this);"  value="2017-08-10" maxlength="10"
            class="form-control" style="height: 25px; width: 100px; padding: 0"/></td>
                <td>
             		<a href="javascript:NewCssCal('tarigi_dan','yyyymmdd','arrow',false,24,false,true)" style="text-decoration: none; color:#7E9EFF;" >
    	            <img border="0" src="../block/datetimepicker/images/cal.gif" width="16" height="16" alt="Pick a date" style=""/>- დან</a>
                  <td>
    				<input type="text" name="tarigi_mde" id="tarigi_mde" onkeyup= "return maskdate(event,this);"  value="2017-08-11" maxlength="10"  class="form-control" style="height: 25px; width: 100px; padding: 0"/>
            </td>
            <td>
             		<a href="javascript:NewCssCal('tarigi_mde','yyyymmdd','arrow',false,24,false,true)" style="text-decoration: none; color:#7E9EFF;">
              <img border="0" src="../block/datetimepicker/images/cal.gif" width="16" height="16" alt="Pick a date" />- მდე</a>
              </td>
                </td>
              </tr>
              <tr>
                <td class="filterFormLabel" style="color:#7E9EFF;">ჯგუფი/ლაბორატორია:</td>
                <td class="rightDottedBorder">
                	<select name="jgufi_laboratoria" id="jgufi_laboratoria" style="width:156px; height: 25px; padding: 0" class="form-control" onchange="javascript:select_laboratory();">
                 	  <option value=""></option>
               		</select>
           		</td>
           		<td class="filterFormLabel" style="color:#7E9EFF;">დალაგება: </td>
                <td  colspan="4">

                  <label class="radio-inline" style="color:#7E9EFF;"><input type="radio" id='day' name="optradio" value="day" checked="checked">დღე</label>
                  <label class="radio-inline" style="color:#7E9EFF;"><input type="radio" id='week' name="optradio" value="week">კვირა</label>
                  <label class="radio-inline" style="color:#7E9EFF;"><input type="radio" id='month' name="optradio" value="month">თვე</label>

                </td>

              </tr>
              <tr>
                <td class="filterFormLabel" style="color:#7E9EFF;">თანამშრომელი:</td>
                <td class="rightDottedBorder">
                	<select name="staff" id="staff" style="width:156px; height: 25px; padding: 0" class="form-control">
                  <option value=""></option>
                  <?php
                    $staff_result = mysqli_query($db, "SELECT `id`, `first_name`, `last_name` FROM `staff` ORDER BY `first_name` ASC",$db);
                    while($staff_row = mysqli_fetch_assoc($staff_result)):
                  ?>
                     	<option value="<?php echo $staff_row['id'] ?>"><?php echo $staff_row['first_name']. ' ' . $staff_row['last_name'] ?></option>
                   <?php endwhile; ?>
                    </select>
                    </td>
                    <td colspan="2">
                      <label for="row_count" style="color:#7E9EFF;"> ჩანაწერის რაოდენობა: </label>
                    </td>

                <td class="filterFormLabel" colspan="3">
                    <select name="row_count" id="row_count" style="width:156px; height: 25px; padding: 0" class="form-control" onchange="">
                      <option value="10">10</option>
                      <option value="20">20</option>
                      <option value="50">50</option>
                      <option value="100" selected>100</option>
                      <option value="200">200</option>
                      <option value="500">500</option>
                      <option value="1000">1000</option>
                    </select>
                </td>

            </tr>
            <tr>
              <td colspan="6" align="center">
                <div class="Btns">
                  <div class="Btn" onclick="javascript:date_filter()"><img src="../images/filter2.png" alt="" width="16" height="15" align="absmiddle" />ძიება</div>
                  <div class="splitDiv"></div>
                  <div class="Btn" onclick="javascript:clear_text()"><img src="../images/clear.png" alt="" width="16" height="16" align="absmiddle" /> გასუფთავება</div>
                </div>
              </td>
              <td></td>
            </tr>
          </table>
          </div>
      </form>
    </div>
  </div>
</div>
  <script type='text/javascript' src="turnstile.js"></script>


<div id="table_content">
<?php

  include('ajax_table.php');

?>
</div>

    </div>
  </div>
</div>

</body>
</html>

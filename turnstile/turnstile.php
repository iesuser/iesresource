<?php
include("../block/globalVariables.php");
include("../block/db.php");
//if(!HaveAccess("seismicData")){echo CreatePageData($_POST," ../login.php"); exit();}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ტურნიკეტი</title>
  <link rel="stylesheet" href="../block/bootstrap-4.1.1-dist/css/bootstrap.min.css">
  <link href="../block/custom-bs4-styles.css" rel="stylesheet" type="text/css"/>
  <link href="../block/fontawesome-free-5.1.0-web/css/all.css" rel="stylesheet">
  <!-- <link href="../block/style.css" rel="stylesheet" type="text/css"/> -->
  <link href="animate.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<?php include("../block/mainmenu_bs.php");?>
<div class="container-fluid">
  <div class="row border-bottom">
    <div class="col-xs-12 col-lg-3 border-right p-3" style="background-color: redx">
      <div class="card turnstile-search-form">
          <div class="card-header text-center">
            <h6 class="mb-0">ძიება</h6>
          </div>
        <div class="card-body">
          <div class="form-group">
            <label for="ganyofileba" >დეპარტამენტი / დირექცია</label>
            <?php mysqli_select_db($db, $dbStaff);  //მონაცემთა ბაზის გადართვა?>
            <select name="ganyofileba" id="ganyofileba" class="form-control form-control-sm" onchange="select_department()">
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
          </div>
          <div class="form-group">
            <label for="jgufi_laboratoria" >ჯგუფი / ლაბორატორია</label>
            <?php mysqli_select_db($db, $dbStaff);  //მონაცემთა ბაზის გადართვა?>
            <select name="jgufi_laboratoria" id="jgufi_laboratoria" class="form-control form-control-sm" onchange="javascript:select_laboratory();">
              <option value=""></option>
            </select>
          </div>
          <div class="form-group">
            <label for="staff" >თანამშრომელი</label>
            <?php mysqli_select_db($db, $dbStaff);  //მონაცემთა ბაზის გადართვა?>
            <select name="staff" id="staff" class="form-control form-control-sm">
              <option value=""></option>
              <?php
                $staff_result = mysqli_query($db, "SELECT `id`, `first_name`, `last_name` FROM `staff` ORDER BY `first_name` ASC");
                while($staff_row = mysqli_fetch_assoc($staff_result)):
              ?>
              <option value="<?php echo $staff_row['id'] ?>"><?php echo $staff_row['first_name']. ' ' . $staff_row['last_name'] ?></option>
              <?php endwhile; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="tarigi_dan" >თარიღი (დან)  </label>
            <div class="input-group input-group-sm">
              <div class="input-group-prepend">
                <button class="btn btn-outline-secondary" type="button" id="button-tarigi-dan"><i class="far fa-calendar-alt"></i></button>
              </div>
              <input type="text" id="tarigi_dan" name="tarigi_dan" class="form-control datepicker" value=""></div>
          </div>
          <div class="form-group">
            <label for="tarigi_mde" >თარიღი (მდე)  </label>
            <div class="input-group input-group-sm">
              <div class="input-group-prepend">
                <button class="btn btn-outline-secondary" type="button" id="button-tarigi-mde"><i class="far fa-calendar-alt"></i></button>
              </div>
              <input type="text" id="tarigi_mde" name="tarigi_mde" class="form-control datepicker" value=""></div>
          </div>
          <div class="form-group">
            <label for="row_count" >ჩანაწერის რაოდენობა</label>
            <?php mysqli_select_db($db, $dbStaff);  //მონაცემთა ბაზის გადართვა?>
            <select name="row_count" id="row_count" class="form-control form-control-sm" onchange="">
              <option value="10">10</option>
              <option value="20">20</option>
              <option value="50" selected>50</option>
              <option value="100">100</option>
            </select>
          </div>
          <div class="form-group">
            <legend class="col-form-label pt-0">დაჯგუფება</legend>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="day" value="day" name="optradio" class="custom-control-input" checked>
              <label class="custom-control-label" for="day">დღე</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="week" value="week" name="optradio" class="custom-control-input">
              <label class="custom-control-label" for="week">კვირა</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="month" value="month" name="optradio" class="custom-control-input">
              <label class="custom-control-label" for="month">თვე</label>
            </div>
          </div>
          <button class="btn btn-sm btn-unique btn-block" type="button" onclick="clear_text()"><i class="fas fa-eraser" style="color: #888484;"></i>&nbsp გასუფთავება</button>
          <button class="btn btn-sm btn-primary btn-block" type="submit" id="editbutton" onclick="date_filter(1)"><i class="fas fa-search"></i>&nbsp ძიება</button>

        </div>
      </div>
    </div>
    <div class="col-xs-12 col-lg-9 p-3">
      <div id="table_content"></div>
    </div>
  </div>
</div>


<br><br><br><br><br><br><br><br>


<script type="text/javascript" src="../block/bootstrap-4.1.1-dist/js/jquery-3.3.1.min.js"></script>
<script type='text/javascript' src="../block/bootstrap-4.1.1-dist/js/popper.min.js"></script>
<script type='text/javascript' src="../block/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
<script type='text/javascript' src="../block/jQuery-Mask-Plugin-master/dist/jquery.mask.min.js"></script>
<script type="text/javascript" src="../block/mask.js"></script>
<script src="../block/esimakin-twbs-pagination/jquery.twbsPagination.min.js"></script>
<script type='text/javascript' src="turnstile.js"></script>

</body>
<link rel="stylesheet" type="text/css" href="../block/jqplugins/datetimepicker/jquery.datetimepicker.min.css"/ >
<script src="../block/jqplugins/datetimepicker/jquery.datetimepicker.full.min.js"></script>
</html>

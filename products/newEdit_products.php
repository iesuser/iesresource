<?php
include("../block/globalVariables.php");
include("../block/db.php");
include("../block/functions.php");
include("../checklogin1.php");// amocmebs tu aris avtorizacia gavlili


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if($_SESSION['name'] != $siteMaintenanceUsername) die("Error 333");

?>
<?php
$mtvleli=0;
if (isset($_GET['id'])) {$id = $_GET['id'];
 $mtvleli=$id;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>პროდუქტები</title>
	<link rel="stylesheet" href="../block/bootstrap-4.1.1-dist/css/bootstrap.min.css">
  <link href="../block/custom-bs4-styles.css" rel="stylesheet" type="text/css"/>
  <link href="../block/fontawesome-free-5.1.0-web/css/all.css" rel="stylesheet">


	</head>
<body>
  <?php include("../block/mainmenu_bs.php");?>
<?php
if ($mtvleli<1)
{
	$inventaris_nomeri = "";
	$inventaris_shida_nomeri = "";
	$shida_gadaceris_aqtis_nomeri = "";
	$seriuli_nomeri = "";
	$shesyidvis_tarigi = "";
	$chamoceris_tarigi="";
	$CPV="";
	$invetaris_dasaxeleba = "";
	$inventaris_modeli = "";
	$zomis_erteuli = "";
	$Tanxa = "";
	$raodenoba = "";
	$saboloo_girebuleba = "";
	$narcheni_girebuleba = "";
	$pasuxismgebeli = "";
	$otaxis_nomeri = "";
	$ganyofileba = "";
	$jgufi_laboratoria = "";
	$gadacemis_tarigi = "";
	$gadacera_chamoceris_tarigi  = "";
	$cvlileba  = "";
	$mdgomareoba = "";
	$naecheni_girebulebis_angarishi = "";
	$komentari = "";
	$tableLabel = "პროდუქტის დამატება";
	$btnLabel="დამატება";
}
else
{
	$result = mysqli_query($db, "SELECT * FROM inventari WHERE id=$mtvleli");
	$myrow = mysqli_fetch_array($result);
	//echo $myrow."weeeeeeee";
	$inventaris_nomeri = $myrow["inventaris_nomeri"];
	$inventaris_shida_nomeri = $myrow["inventaris_shida_nomeri"];
	$shesyidvis_tarigi = $myrow["shesyidvis_tarigi"];
	$shida_gadaceris_aqtis_nomeri = $myrow["shida_gadaceris_aqtis_nomeri"];
	$seriuli_nomeri = $myrow["seriuli_nomeri"];
	$chamoceris_tarigi = $myrow["chamoceris_tarigi"];
	$CPV = $myrow["CPV"];
	$invetaris_dasaxeleba = $myrow["invetaris_dasaxeleba"];
	$inventaris_modeli = $myrow["inventaris_modeli"];
	$zomis_erteuli = $myrow["zomis_erteuli"];
	$Tanxa = $myrow["Tanxa"];
	$raodenoba = $myrow["raodenoba"];
	$saboloo_girebuleba = $myrow["saboloo_girebuleba"];
	$narcheni_girebuleba = $myrow["narcheni_girebuleba"];
	$pasuxismgebeli = $myrow["pasuxismgebeli"];
	$otaxis_nomeri = $myrow["otaxis_nomeri"];
	$ganyofileba = $myrow["ganyofileba"];
	$jgufi_laboratoria = $myrow["jgufi_laboratoria"];
	$gadacemis_tarigi = $myrow["gadacemis_tarigi"];
	$gadacera_chamoceris_tarigi  = $myrow["gadacera_chamoceris_tarigi"];
	$cvlileba  = $myrow["cvlileba"];
	$mdgomareoba = $myrow["mdgomareoba"];
	$naecheni_girebulebis_angarishi = $myrow["naecheni_girebulebis_angarishi"];
	$komentari = $myrow["komentari"];
	$tableLabel = "ინვენტარის რედაქტირება";
	$btnLabel="რედაქტირება";
}
?>
<form action="add_products.php" method="post" name="form-product" id="form-product">
    <input type="hidden" id="mtvleli" name="mtvleli" value="<?php echo $mtvleli?>">
    <input type="hidden" id="dasaxuriProduqti" name="dasaxuriProduqti" value="0">
    <div class="w-75 ies-container mb-5 border" style="margin: auto;">
      <h4 id="formtitle" class="text-center"><?php echo $tableLabel; ?></h4>
      <p class="text-center mb-4">(შეავსეთ <span class="required-star">*</span>-იანი ველები აუცილებლად)</p>
      <div class="form-group">
        <label for="inventaris_shida_nomeri">ინვენტარის შიდა ნომერი (ინსტიტუტი) <span class="required-star">*</span></label>
        <input type="text" id="inventaris_shida_nomeri" name="inventaris_shida_nomeri" class="form-control" value="<?php echo $inventaris_shida_nomeri; ?>" >
        <div class="invalid-feedback">შეავსეთ ინვენტარის შიდა ნომერი. ზუსტად 9 სიმბოლო</div>
      </div>
      <div class="form-group">
        <label for="inventaris_nomeri">ინვენტარის ნომერი (უნივერსიტეტი)</label>
        <input type="text" id="inventaris_nomeri" name="inventaris_nomeri" class="form-control" value="<?php echo $inventaris_nomeri; ?>">
        <div class="invalid-feedback">შეიყვანეთ ზუსტად 9 სიმბოლო</div>
      </div>
      <div class="form-group">
        <label for="shida_gadaceris_aqtis_nomeri" >შიდა გადაწერის აქტის ნომერი	</label>
        <input type="text" id="shida_gadaceris_aqtis_nomeri" name="shida_gadaceris_aqtis_nomeri" class="form-control" value="<?php echo $shida_gadaceris_aqtis_nomeri; ?>">
      </div>
      <div class="form-group">
        <label for="shesyidvis_tarigi" >შესყიდვის თარიღი	</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <button class="btn btn-outline-secondary" type="button" id="button-shesyidvis-tarigi"><i class="far fa-calendar-alt"></i></button>
          </div>
          <input type="text" id="shesyidvis_tarigi" name="shesyidvis_tarigi" class="form-control datepicker" value="<?php if($shesyidvis_tarigi=="0000-00-00") $shesyidvis_tarigi=''; echo $shesyidvis_tarigi ?>">        </div>
      </div>
      <div class="form-group">
        <label for="chamoceris_tarigi" >ჩამოწერის თარიღი</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <button class="btn btn-outline-secondary" type="button" id="button-chamoceris-tarigi"><i class="far fa-calendar-alt"></i></button>
          </div>
          <input type="text" id="chamoceris_tarigi" name="chamoceris_tarigi" class="form-control datepicker" value="<?php if($chamoceris_tarigi=="0000-00-00") $chamoceris_tarigi=''; echo $chamoceris_tarigi ?>">        </div>
      </div>
      <div class="form-group">
        <label for="CPV" >CPV</label>
        <input type="text" id="CPV" name="CPV" class="form-control" value="<?php echo mysqli_real_escape_string($db, $CPV) ?>">
      </div>
      <div class="form-group">
        <label for="invetaris_dasaxeleba" >ინვენტარის დასახელება <span class="required-star">*</span></label>
        <input type="text" id="invetaris_dasaxeleba" name="invetaris_dasaxeleba" class="form-control" value="<?php echo mysqli_real_escape_string($db, $invetaris_dasaxeleba) ?>">
        <div class="invalid-feedback">შეავსეთ ინვენტარის დასახელება</div>
      </div>
      <div class="form-group">
        <label for="inventaris_modeli" >ინვენტარის მწარმოებელი/მოდელი</label>
        <input type="text" id="inventaris_modeli" name="inventaris_modeli" class="form-control" value="<?php echo mysqli_real_escape_string($db, $inventaris_modeli) ?>">
      </div>
      <div class="form-group">
        <label for="seriuli_nomeri" >სერიული ნომერი <span class="required-star">*</span></label>
        <input type="text" id="seriuli_nomeri" name="seriuli_nomeri" class="form-control" value="<?php echo mysqli_real_escape_string($db, $seriuli_nomeri) ?>">
        <div class="invalid-feedback">შეავსეთ სერიული ნომერი</div>
      </div>
      <div class="form-group">
        <label for="zomis_erteuli" >ზომის ერთეული <span class="required-star">*</span></label>
        <select class="custom-select" name="zomis_erteuli" id="zomis_erteuli">
          <option value=""></option>
          <?php
            $table = mysqli_query($db, "SELECT name FROM zomis_erteuli");
            while($row = mysqli_fetch_array($table))
            {
              $name = $row["name"];

              //echo "<option value=\"$name\">$name</option>\n ";
            ?>
          <option value="<?php echo $name;?>" <?php if($zomis_erteuli == $name) echo "selected='selected'"; ?>><?php echo $name;?></option>
          <?php
            }
            ?>
        </select>
        <div class="invalid-feedback">მონიშნეთ ზომის ერთეული</div>
      </div>
      <div class="form-group">
        <label for="Tanxa" >ღირებულება</label>
        <input type="text" onkeyup="calculate_price()" id="Tanxa" name="Tanxa" class="form-control" value="<?php echo $Tanxa ?>">
      </div>
      <div class="form-group">
        <label for="raodenoba" class="grey-text my-design">რაოდენობა</label>
        <input type="text" onkeyup="calculate_price()" id="raodenoba" name="raodenoba" class="form-control" value="<?php echo $raodenoba ?>">
      </div>
      <div class="form-group">
        <label for="saboloo_girebuleba" >ღირებულება (ჯამში)</label>
        <input type="text"  id="saboloo_girebuleba" name="saboloo_girebuleba" class="form-control" value="<?php echo $saboloo_girebuleba?>">
      </div>
      <div class="form-group">
        <label for="narcheni_girebuleba" >ნარჩენი ღირებულება</label>
        <input type="text" id="narcheni_girebuleba" name="narcheni_girebuleba" class="form-control" value="<?php echo $narcheni_girebuleba?>">
      </div>
      <div class="form-group">
        <label for="ganyofileba" >დეპარტამენტი/დირექცია <span class="required-star">*</span></label>
        <select class="custom-select" name="ganyofileba" id="ganyofileba" onchange="javascript:on_department_select();">

          <?php
        mysqli_select_db($db, $dbStaff);	//მონაცემთა ბაზის გადართვა
          ?>
              <option value=""></option>
              <?php
      $table = mysqli_query($db, "SELECT id,name FROM departments ORDER by id ASC");
      while($row = mysqli_fetch_array($table))
      {
        $name = $row["name"];
        ?>
              <option value="<?php echo $name;?>" <?php if($ganyofileba == $name) {echo "selected='selected'"; $dep_id = $row["id"];}?>><?php echo $name;?></option>
              <?php
      }
          ?>
        </select>
      </div>
      <div class="form-group">
      <label for="jgufi_laboratoria" >ჯგუფი/ლაბორატორია</label>
      <select class="custom-select" name="jgufi_laboratoria" id="jgufi_laboratoria" onchange="javascript:on_groupLaboratory_select()">
        <option value=""></option>
        <?php
        if(isset($dep_id))
        {
        $table = mysqli_query($db, "SELECT id,name FROM group_laboratories WHERE department_id='$dep_id'");
        while($row = mysqli_fetch_array($table))
        {
          $name = $row["name"];

          //echo "<option value=\"$name\">$name</option>\n ";
          ?>
      <option value="<?php echo $name;?>" <?php if($jgufi_laboratoria == $name) {echo "selected='selected'"; $gr_lb_id = $row["id"];}?>><?php echo $name;?></option>
      <?php
        }
        }
      ?>
      </select>
      </div>
      <div class="form-group">
        <label for="pasuxismgebeli" >პასუხისმგებელი პირი</label>
        <select class="custom-select" name="pasuxismgebeli" id="pasuxismgebeli">
          <option value=""></option>
          <?php
    if(isset($dep_id))
    {
      $query = "SELECT * FROM  `staff` WHERE dep_id='$dep_id'";
      if(isset($gr_lb_id)) $query .= " AND gr_lb_id='$gr_lb_id'";
      else $query .= " AND gr_lb_id='0'";
      $table1 = mysqli_query($db, $query);
      while($row1 = mysqli_fetch_array($table1))
      {
      $first_name = $row1["first_name"];
      $last_name = $row1["last_name"];
      $fullname = $first_name." ".$last_name;
        ?>
      <option value="<?php echo $fullname;?>" <?php if($pasuxismgebeli == $fullname) echo "selected='selected'";?>><?php echo $fullname;?></option>
      <?php
      }
    }
          ?>
        </select>
      </div>
      <div class="form-group">
        <label for="otaxis_nomeri" >ოთახის ნომერი</label>
        <input type="text" id="otaxis_nomeri" name="otaxis_nomeri" class="form-control" value="<?php echo $otaxis_nomeri ?>">
      </div>
      <div class="form-group">
        <label for="gadacemis_tarigi" >გადაცემის თარიღი</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <button class="btn btn-outline-secondary" type="button" id="button-gadacemis-tarigi"><i class="far fa-calendar-alt"></i></button>
          </div>
          <input type="text" id="gadacemis_tarigi" name="gadacemis_tarigi" class="form-control datepicker" value="<?php if($gadacemis_tarigi=="0000-00-00") $gadacemis_tarigi=''; echo $gadacemis_tarigi?>">
        </div>
      </div>
      <div class="form-group">
        <label for="gadacera_chamoceris_tarigi" >გადაწერა/ჩამოწერის თარიღი</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <button class="btn btn-outline-secondary" type="button" id="button-gadacera-chamoceris-tarigi"><i class="far fa-calendar-alt"></i></button>
          </div>
          <input type="text" id="gadacera_chamoceris_tarigi" name="gadacera_chamoceris_tarigi" class="form-control datepicker" value="<?php if($gadacera_chamoceris_tarigi==0000-00-00) $gadacera_chamoceris_tarigi=''; echo $gadacera_chamoceris_tarigi?>">
        </div>
      </div>
      <div class="form-group">
        <label for="cvlileba" >ცვლილება</label>
        <input type="text" id="cvlileba" name="cvlileba" class="form-control" value="<?php echo mysqli_real_escape_string($db, $cvlileba) ?>">
      </div>
      <div class="form-group">
        <label for="mdgomareoba" >მდგომარეობა <span class="required-star">*</span></label>
        <select class="custom-select" name="mdgomareoba" id="mdgomareoba">
          <option value=""></option>
          <option value="მუშა"  <?php if($mdgomareoba == "მუშა" || $mdgomareoba == "") echo "selected='selected'";?>>მუშა</option>
          <option value="დაზიანებული" <?php if($mdgomareoba == "დაზიანებული") echo "selected='selected'";?>>დაზიანებული</option>
          <option value="ჩამოსაწერი"<?php if($mdgomareoba == "ჩამოსაწერი") echo "selected='selected'";?>>ჩამოსაწერი</option>
          <option value="დაკარგული"<?php if($mdgomareoba == "დაკარგული") echo "selected='selected'";?>>დაკარგული</option>
        </select>
        <div class="invalid-feedback">მონიშნეთ მდგომარეობა</div>
      </div>
      <div class="form-group">
        <label for="naecheni_girebulebis_angarishi" >ნარჩენი ღირებულების ანგარიში</label>
        <input type="text" id="naecheni_girebulebis_angarishi" name="naecheni_girebulebis_angarishi" class="form-control" value="<?php echo $naecheni_girebulebis_angarishi?>">
      </div>
      <div class="form-group">
        <label for="komentari" >დამატებითი ინფორმაცია</label>
        <textarea id="komentari" name="komentari" class="form-control"><?php echo mysqli_real_escape_string($db, $komentari);?></textarea>
      </div>
      <div class="row justify-content-between mt-4">
        <div class="col-xs-12 col-md-2 pb-1">
            <button class="btn btn-unique btn-block-up-to-md" type="button" onclick="goToProductsPage()">უკან</button>
        </div>
        <div class="col-xs-12 ofsset-md-2 col-md-7" id="g" align="right">
          <button class="btn btn-primary btn-block-up-to-md mb-1" type="submit" id="editbutton"><?php echo $btnLabel;?></button>
          <?php
          if ($mtvleli > 0){
          ?>
          <button id="rewrite_btn" class="btn btn-secondary btn-block-up-to-md mb-1" type="button" onclick="rewrite()">გადაწერა</button>
          <?php
          }
          ?>
        </div>
      </div>
    </div>
</form>
<script type="text/javascript" src="../block/bootstrap-4.1.1-dist/js/jquery-3.3.1.min.js"></script>
<script type='text/javascript' src="../block/bootstrap-4.1.1-dist/js/popper.min.js"></script>
<script type='text/javascript' src="../block/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
<script type='text/javascript' src="../block/jQuery-Mask-Plugin-master/dist/jquery.mask.min.js"></script>
<script type='text/javascript' src="../block/mask.js"></script>
<script type='text/javascript' src="newEdit_products.js"></script>
</body>
<link rel="stylesheet" type="text/css" href="../block/jqplugins/datetimepicker/jquery.datetimepicker.min.css"/ >
<script src="../block/jqplugins/datetimepicker/jquery.datetimepicker.full.min.js"></script>
</html>

<?php
include("../block/globalVariables.php");
include("../block/db.php");
include("../block/functions.php");
include("../checklogin1.php");// amocmebs tu aris avtorizacia gavlili
session_start();
if($_SESSION['name'] != $siteMaintenanceUsername) die("Error 333");

?>
<?php
$mtvleli=0;
if (isset($_GET['id'])) {$id = $_GET['id'];
 $mtvleli=$id;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>პროდუქტები</title>
<link href="../block/style.css" rel="stylesheet" type="text/css"/>
<?php include("../block/formenu/formenu.php");?>
<script type='text/javascript' src="../js/mask.js"></script>
<script type='text/javascript' src="products.js"></script> 
<script type='text/javascript' src="../js/jquery-1.7.2.min.js"></script>
<script type='text/javascript' src='../block/datetimepicker/datetimepicker_css_ge.js'></script>
</head><?php include("../block/mainmenu.php");?>
<body>
<div align="center">
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
</div>
<form action="add_products.php"method="post" name="formProduct" id="formProduct">
  
  <div align="center">
    <input type="hidden" id="mtvleli" name="mtvleli" value="<?php echo $mtvleli?>"/>
    <input type="hidden" id="dasaxuriProduqti" name="dasaxuriProduqti" value="0"/>
    
    <table width="800px" border="0" class="formstyle" style="border-spacing:0px;padding:0px;margin:15px;">
      <tr>
        <td colspan="2" id="formtitle" class="formtitle"><?php echo $tableLabel;?> (შეავსეთ <span style="color:#F00;">*</span>-იანი ველები აუცილებლად)</td>
      </tr>
      <tr style="padding-top:5px;">
        <td width="50%" class="tablecolm1" style="padding-top:10px;">ინვენტარის შიდა ნომერი (ინსტიტუტი)</td>
        <td width="50%" style="padding-top:10px;"><input type="text" name="inventaris_shida_nomeri" id="inventaris_shida_nomeri"  value="<?php echo $inventaris_shida_nomeri;?>" maxlength="9"/><span style="color:#F00;">*</span></td>
      </tr>
      <tr style="padding-top:5px;">
        <td width="50%" class="tablecolm1" style="padding-top:10px;">ინვენტარის ნომერი (უნივერსიტეტი)</td>
        <td width="50%" style="padding-top:10px;"><input type="text" name="inventaris_nomeri" id="inventaris_nomeri"  value="<?php echo $inventaris_nomeri;?>" maxlength="9"/></td>
      </tr>
      <tr style="padding-top:5px;">
        <td width="50%" class="tablecolm1" style="padding-top:10px;">შიდა გადაწერის აქტის ნომერი</td>
        <td width="50%" style="padding-top:10px;"><input type="text" name="shida_gadaceris_aqtis_nomeri" id="shida_gadaceris_aqtis_nomeri"  onkeyup="maskInt(this);" value="<?php echo $shida_gadaceris_aqtis_nomeri;?>" maxlength="20"/></td>
      </tr>
      <tr>
        <td class="tablecolm1">შესყიდვის თარიღი</td>
        <td><input type="text" name="shesyidvis_tarigi" id="shesyidvis_tarigi" onkeyup= "return maskdate(event,this);" 
        value="<?php if($shesyidvis_tarigi=="0000-00-00") $shesyidvis_tarigi=''; echo $shesyidvis_tarigi?>" />
           <a href="javascript:NewCssCal('shesyidvis_tarigi','yyyymmdd','arrow',false,24,false,true)">
           <img border="0" src="../block/datetimepicker/images/cal.gif" width="16" height="16" alt="Pick a date"></a>      
        </td>       
      </tr>
       <td class="tablecolm1">ჩამოწერის თარიღი</td>
        <td><input type="text" name="chamoceris_tarigi" id="chamoceris_tarigi" onkeyup= "return maskdate(event,this);" 
        value=" <?php if($chamoceris_tarigi=="0000-00-00") $chamoceris_tarigi=''; echo $chamoceris_tarigi?>" />
           <a href="javascript:NewCssCal('chamoceris_tarigi','yyyymmdd','arrow',false,24,false,true)">
 <img border="0" src="../block/datetimepicker/images/cal.gif" width="16" height="16" alt="Pick a date"></a>                       
        </td>       
      </tr>
         <tr>
        <td class="tablecolm1">CPV</td>
        <td> 
	  <input type="text" name="CPV" id="CPV" value="<?php echo $CPV?>" maxlength="8" />
        </td>       
      </tr>
      <tr>
        <td class="tablecolm1">ინვენტარის დასახელება</td>
        <td><input type="text" name="invetaris_dasaxeleba" id="invetaris_dasaxeleba" value="<?php echo $invetaris_dasaxeleba?>" /><span style="color:#F00;">*</span></td>
      </tr>
      <tr>
        <td class="tablecolm1">ინვენტარის მწარმოებელი/მოდელი</td>
        <td><input type="text" name="inventaris_modeli" id="inventaris_modeli" value="<?php echo $inventaris_modeli?>" /></td>
      </tr>
      <tr>
        <td class="tablecolm1">სერიული ნომერი</td>
        <td><input type="text" name="seriuli_nomeri" id="seriuli_nomeri" value="<?php echo $seriuli_nomeri?>" /></td>
      </tr>
      <tr>
        <td class="tablecolm1">ზომის ერთეული</td>
        <td>
          <select name="zomis_erteuli" id="zomis_erteuli" style="width:156px" >
            <?php
		$table = mysqli_query($db, "SELECT name FROM zomis_erteuli");
		while($row = mysqli_fetch_array($table))
		{
			$name = $row["name"];
			
			//echo "<option value=\"$name\">$name</option>\n ";
			?>
            <option value="<?php echo $name;?>" <?php if($zomis_erteuli == $name) echo "selected='selected'";?>><?php echo $name;?></option>
            <?php
		}
        ?>
          </select>
        <span style="color:#F00;">*</span></td>
      </tr>
      <tr>
        <td class="tablecolm1">ღირებულება</td>
        <td><input type="text" name="Tanxa" id="Tanxa" value="<?php echo $Tanxa?>" onkeyup="maskFloat(Tanxa),saboloofasi();"/></td>
      </tr>
      <tr>
        <td class="tablecolm1">რაოდენობა</td>
        <td><input type="text" name="raodenoba" id="raodenoba" value="<?php echo $raodenoba?>" onkeyup="maskFloat(raodenoba),saboloofasi();"/></td>
      </tr>
      <tr>
        <td class="tablecolm1">ღირებულება (ჯამში)</td>
        <td><input type="text" name="saboloo_girebuleba" id="saboloo_girebuleba" value="<?php echo $saboloo_girebuleba?>"onkeyup="maskFloat(saboloo_girebuleba)"/></td>
      </tr>
      <tr>
        <td class="tablecolm1">ნარჩენი ღირებულება</td>
        <td><input type="text" name="narcheni_girebuleba" id="narcheni_girebuleba" value="<?php echo $narcheni_girebuleba?>" onkeyup="maskFloat(narcheni_girebuleba)"/></td>
      </tr>                  
            <tr>
        <td class="tablecolm1">დეპარტამენტი/დირექცია</td>
        <td><?php
			mysqli_select_db($db, $dbStaff);	//მონაცემთა ბაზის გადართვა
        ?>
          <select name="ganyofileba" id="ganyofileba" style="width:156px" onchange="javascript:onDepartmentSelect();">
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
          </select> <span style="color:#F00;">*</span>
          </td>
      </tr>
      <tr>
        <td class="tablecolm1">ჯგუფი/ლაბორატორია</td>
        <td><select name="jgufi_laboratoria" id="jgufi_laboratoria" style="width:156px" onchange="javascript:onGroupLaboratorySelect()">
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
      </select>        </tr>
      <tr>
        <td class="tablecolm1">პასუხისმგებელი პირი</td>
        <td>
          <select name="pasuxismgebeli" id="pasuxismgebeli" style="width:156px">
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
          </select></td>
      </tr>
      <tr>
        <td class="tablecolm1">ოთახის ნომერი</td>
        <td><input type="text" name="otaxis_nomeri" id="otaxis_nomeri" value="<?php echo $otaxis_nomeri ?>"/></td>
      </tr>
      <tr>
        <td class="tablecolm1">გადაცემის თარიღი</td>
        <td><input type="text" name="gadacemis_tarigi" id="gadacemis_tarigi" onkeyup= "return maskdate(event,this);" value="<?php if($gadacemis_tarigi=="0000-00-00") $gadacemis_tarigi=''; echo $gadacemis_tarigi?>"/> 
          <a href="javascript:NewCssCal('gadacemis_tarigi','yyyymmdd','arrow',false,24,false,true)">
            <img border="0" src="../block/datetimepicker/images/cal.gif" width="16" height="16" alt="Pick a date"></a>
        </td>
      </tr>
      <tr>
        <td class="tablecolm1">გადაწერა/ჩამოწერის თარიღი</td>
        <td>
          <input type="text" name="gadacera_chamoceris_tarigi" id="gadacera_chamoceris_tarigi" maxlength="10" onkeyup= "return maskdate(event,this);" value="<?php if($gadacera_chamoceris_tarigi==0000-00-00) $gadacera_chamoceris_tarigi=''; echo $gadacera_chamoceris_tarigi?>" /> 
          <a href="javascript:NewCssCal('gadacera_chamoceris_tarigi','yyyymmdd','arrow',false,24,false,true)">
            <img border="0" src="../block/datetimepicker/images/cal.gif" width="16" height="16" alt="Pick a date"></a></td>
      </tr>
      <tr>
        <td class="tablecolm1">ცვლილება</td>
        <td><input type="text" name="cvlileba" id="cvlileba"value="<?php echo $cvlileba?>" /></td>
      </tr>
      <tr>
        <td class="tablecolm1">მდგომარეობა</td>
	<td>
          <select name="mdgomareoba" id="mdgomareoba" style="width:156px" onchange="javascript:onDepartmentSelect();">
            <option value="მუშა"  <?php if($mdgomareoba == "მუშა" || $mdgomareoba == "") echo "selected='selected'";?>>მუშა</option>
            <option value="დაზიანებული" <?php if($mdgomareoba == "დაზიანებული") echo "selected='selected'";?>>დაზიანებული</option>
            <option value="ჩამოსაწერი"<?php if($mdgomareoba == "ჩამოსაწერი") echo "selected='selected'";?>>ჩამოსაწერი</option>
            <option value="დაკარგული"<?php if($mdgomareoba == "დაკარგული") echo "selected='selected'";?>>დაკარგული</option>
          </select> 
          </td>
      </tr>
      <tr>
        <td class="tablecolm1">ნარჩენი ღირებულების ანგარიში</td>
        <td><input type="text" name="naecheni_girebulebis_angarishi" id="naecheni_girebulebis_angarishi" value="<?php echo $naecheni_girebulebis_angarishi?>" onkeyup="maskFloat(naecheni_girebulebis_angarishi)"/></td>
      </tr>
      <tr>
        <td class="tablecolm1">დამატებითი ინფორმაცია</td>
        <td><textarea style="resize: none;" cols="35" rows="6" name="komentari" id="komentari"><?php echo $komentari;?></textarea></td>
      </tr>
      <tr>
        <td colspan="2" align="center" style="border-top:1px dotted #CCC;height:50px;">
          <div class="Btns">
<?php  
			if ($mtvleli > 0){
?>
            <div id ="rewrite" class="Btn" onclick="javascript:rewrite()">გადაწერა</div>
            <div class="splitDiv"></div>
            <?php
			}
			?>
            <div id="editbutton" class="Btn" onclick="javascript:checkUserFormSubmit()"><?php echo $btnLabel;?></div>
            <div class="splitDiv"></div>
            <div class="Btn" onclick="javascript:goToProductsPage()">უკან</div>
          </div>
        </td>
      </tr>
    </table>
  </div>
</form>
</body>
</html>

<?php
ob_start();
include("../block/globalVariables.php");
include("../block/db.php");
require_once('Common.php');
require_once('mysqlajaxtableeditor/php/lang/LangVars-ge.php');
require_once('mysqlajaxtableeditor/php/AjaxTableEditor.php');

class Example1 extends Common
{
	var $Editor;
	
	function displayHtml()
	{
		global $db;
		global $dbInventari;
		global $dbStaff;
		global $siteMaintenanceUsername;
		include("../block/mainmenu.php");
		
		echo "";
	
		if (isset($_POST['inventaris_nomeri'])) $inventaris_nomeri=$_POST['inventaris_nomeri'];
		else if(isset($_COOKIE["inventaris_nomeri"])) $inventaris_nomeri = $_COOKIE["inventaris_nomeri"];
		else $inventaris_nomeri="";
		
		setcookie("inventaris_nomeri", $inventaris_nomeri, time()+864000);

		if (isset($_POST['CPV'])) $CPV=$_POST['CPV'];
		else if(isset($_COOKIE["CPV"])) $CPV = $_COOKIE["CPV"];
		else $CPV="";
		setcookie("CPV", $CPV, time()+864000);
		
		if (isset($_POST['ganyofileba'])) $ganyofileba=$_POST['ganyofileba'];
		else if(isset($_COOKIE["ganyofileba"])) $ganyofileba = $_COOKIE["ganyofileba"];
		else $ganyofileba="";
		setcookie("ganyofileba_encoded", rawurlencode($ganyofileba), time()+864000);
		setcookie("ganyofileba", $ganyofileba, time()+864000);

		if (isset($_POST['jgufi_laboratoria'])) $jgufi_laboratoria=$_POST['jgufi_laboratoria'];
		else if(isset($_COOKIE["jgufi_laboratoria"])) $jgufi_laboratoria = $_COOKIE["jgufi_laboratoria"];
		else $jgufi_laboratoria="";
		setcookie("jgufi_laboratoria_encoded", rawurlencode($jgufi_laboratoria), time()+864000);
		setcookie("jgufi_laboratoria", $jgufi_laboratoria, time()+864000);
		
		if (isset($_POST['pasuxismgebeli'])) $pasuxismgebeli=$_POST['pasuxismgebeli'];
		else if(isset($_COOKIE["pasuxismgebeli"])) $pasuxismgebeli = $_COOKIE["pasuxismgebeli"];
		else $pasuxismgebeli="";
		setcookie("pasuxismgebeli_encoded", rawurlencode($pasuxismgebeli), time()+864000);
		setcookie("pasuxismgebeli", $pasuxismgebeli, time()+864000);
		
		if (isset($_POST['otaxis_nomeri'])) $otaxis_nomeri=$_POST['otaxis_nomeri'];
		else if(isset($_COOKIE["otaxis_nomeri"])) $otaxis_nomeri = urlencode($_COOKIE["otaxis_nomeri"]);
		else $otaxis_nomeri="";
		setcookie("otaxis_nomeri", $otaxis_nomeri, time()+864000);
		
		if (isset($_POST['zomis_erteuli'])) $zomis_erteuli=$_POST['zomis_erteuli'];
		else if(isset($_COOKIE["zomis_erteuli"])) $zomis_erteuli = $_COOKIE["zomis_erteuli"];
		else $zomis_erteuli="";
		setcookie("zomis_erteuli", $zomis_erteuli, time()+864000);
				
		if(isset($_POST['inventaris_nomeri']))
		{
			if (isset($_POST['chamocerili_inventari'])) $chamocerili_inventari = "yes";
			else $chamocerili_inventari = "";
			
			if (isset($_POST['gadacerili_inventari'])) $gadacerili_inventari = "yes";
			else $gadacerili_inventari = "";
		}else{
			if(isset($_COOKIE["chamocerili_inventari"])) $chamocerili_inventari = $_COOKIE["chamocerili_inventari"];
			else $chamocerili_inventari = "";
			
			if(isset($_COOKIE["gadacerili_inventari"])) $gadacerili_inventari = $_COOKIE["gadacerili_inventari"];
			else $gadacerili_inventari = "";
		}
		
		setcookie("chamocerili_inventari", $chamocerili_inventari, time()+864000);
		setcookie("gadacerili_inventari", $gadacerili_inventari, time()+864000);
		
		
		if (isset($_POST['tarigi_dan'])) $tarigi_dan=$_POST['tarigi_dan'];
		else if(isset($_COOKIE["tarigi_dan"])) $tarigi_dan = $_COOKIE["tarigi_dan"];
		else $tarigi_dan="";
		setcookie("tarigi_dan", $tarigi_dan, time()+864000);
		
		if (isset($_POST['tarigi_mde'])) $tarigi_mde=$_POST['tarigi_mde'];
		else if(isset($_COOKIE["tarigi_mde"])) $tarigi_mde = $_COOKIE["tarigi_mde"];
		else $tarigi_mde="";
		setcookie("tarigi_mde", $tarigi_mde, time()+864000);
		
		if (isset($_POST['shesyidvis_tarigi_dan'])) $shesyidvis_tarigi_dan=$_POST['shesyidvis_tarigi_dan'];
		else if(isset($_COOKIE["shesyidvis_tarigi_dan"])) $shesyidvis_tarigi_dan = $_COOKIE["shesyidvis_tarigi_dan"];
		else $shesyidvis_tarigi_dan="";
		setcookie("shesyidvis_tarigi_dan", $shesyidvis_tarigi_dan, time()+864000);
		
		if (isset($_POST['shesyidvis_tarigi_mde'])) $shesyidvis_tarigi_mde=$_POST['shesyidvis_tarigi_mde'];
		else if(isset($_COOKIE["shesyidvis_tarigi_mde"])) $shesyidvis_tarigi_mde = $_COOKIE["shesyidvis_tarigi_mde"];
		else $shesyidvis_tarigi_mde="";
		setcookie("shesyidvis_tarigi_mde", $shesyidvis_tarigi_mde, time()+864000);
		
		if (isset($_POST['chamoceris_tarigi_dan'])) $chamoceris_tarigi_dan=$_POST['chamoceris_tarigi_dan'];
		else if(isset($_COOKIE["chamoceris_tarigi_dan"])) $chamoceris_tarigi_dan = $_COOKIE["chamoceris_tarigi_dan"];
		else $chamoceris_tarigi_dan="";
		setcookie("chamoceris_tarigi_dan", $chamoceris_tarigi_dan, time()+864000);
		
		if (isset($_POST['chamoceris_tarigi_mde'])) $chamoceris_tarigi_mde=$_POST['chamoceris_tarigi_mde'];
		else if(isset($_COOKIE["chamoceris_tarigi_mde"])) $chamoceris_tarigi_mde = $_COOKIE["chamoceris_tarigi_mde"];
		else $chamoceris_tarigi_mde="";
		setcookie("chamoceris_tarigi_mde", $chamoceris_tarigi_mde, time()+864000);
		
		if (isset($_POST['gadacemis_tarigi_dan'])) $gadacemis_tarigi_dan=$_POST['gadacemis_tarigi_dan'];
		else if(isset($_COOKIE["gadacemis_tarigi_dan"])) $gadacemis_tarigi_dan = $_COOKIE["gadacemis_tarigi_dan"];
		else $gadacemis_tarigi_dan="";
		setcookie("gadacemis_tarigi_dan", $gadacemis_tarigi_dan, time()+864000);
		
		if (isset($_POST['gadacemis_tarigi_mde'])) $gadacemis_tarigi_mde=$_POST['gadacemis_tarigi_mde'];
		else if(isset($_COOKIE["gadacemis_tarigi_mde"])) $gadacemis_tarigi_mde = $_COOKIE["gadacemis_tarigi_mde"];
		else $gadacemis_tarigi_mde="";
		setcookie("gadacemis_tarigi_mde", $gadacemis_tarigi_mde, time()+864000);
		
		if (isset($_POST['girebuleba_dan'])) $girebuleba_dan=$_POST['girebuleba_dan'];
		else if(isset($_COOKIE["girebuleba_dan"])) $girebuleba_dan = $_COOKIE["girebuleba_dan"];
		else $girebuleba_dan="";
		setcookie("girebuleba_dan", $girebuleba_dan, time()+864000);
		
		if (isset($_POST['girebuleba_mde'])) $girebuleba_mde=$_POST['girebuleba_mde'];
		else if(isset($_COOKIE["girebuleba_mde"])) $girebuleba_mde = $_COOKIE["girebuleba_mde"];
		else $girebuleba_mde="";
		setcookie("girebuleba_mde", $girebuleba_mde, time()+864000);
		
		if (isset($_POST['narch_girebuleba_dan'])) $narch_girebuleba_dan=$_POST['narch_girebuleba_dan'];
		else if(isset($_COOKIE["narch_girebuleba_dan"])) $narch_girebuleba_dan = $_COOKIE["narch_girebuleba_dan"];
		else $narch_girebuleba_dan="";
		setcookie("narch_girebuleba_dan", $narch_girebuleba_dan, time()+864000);
		
		if (isset($_POST['narch_girebuleba_mde'])) $narch_girebuleba_mde=$_POST['narch_girebuleba_mde'];
		else if(isset($_COOKIE["narch_girebuleba_mde"])) $narch_girebuleba_mde = $_COOKIE["narch_girebuleba_mde"];
		else $narch_girebuleba_mde="";
		setcookie("narch_girebuleba_mde", $narch_girebuleba_mde, time()+864000);
				
		if (isset($_POST['saboloo_girebuleba_dan'])) $saboloo_girebuleba_dan=$_POST['saboloo_girebuleba_dan'];
		else if(isset($_COOKIE["saboloo_girebuleba_dan"])) $saboloo_girebuleba_dan = $_COOKIE["saboloo_girebuleba_dan"];
		else $saboloo_girebuleba_dan="";
		setcookie("saboloo_girebuleba_dan", $saboloo_girebuleba_dan, time()+864000);
		
		if (isset($_POST['saboloo_girebuleba_mde'])) $saboloo_girebuleba_mde=$_POST['saboloo_girebuleba_mde'];
		else if(isset($_COOKIE["saboloo_girebuleba_mde"])) $saboloo_girebuleba_mde = $_COOKIE["saboloo_girebuleba_mde"];
		else $saboloo_girebuleba_mde="";
		setcookie("saboloo_girebuleba_mde", $saboloo_girebuleba_mde, time()+864000);
		
		if (isset($_POST['raodenoba_dan'])) $raodenoba_dan=$_POST['raodenoba_dan'];
		else if(isset($_COOKIE["raodenoba_dan"])) $raodenoba_dan = $_COOKIE["raodenoba_dan"];
		else $raodenoba_dan="";
		setcookie("raodenoba_dan", $raodenoba_dan, time()+864000);
		
		if (isset($_POST['raodenoba_mde'])) $raodenoba_mde=$_POST['raodenoba_mde'];
		else if(isset($_COOKIE["raodenoba_mde"])) $raodenoba_mde = $_COOKIE["raodenoba_mde"];
		else $raodenoba_mde="";
		setcookie("raodenoba_mde", $raodenoba_mde, time()+864000);

		?>
        <!--========================================dziebis forma========================================================-->

<script type='text/javascript' src="../js/mask.js"></script>
	  <form action="products.php" method="post" name="formsearch" id="formsearch"  style="width:100%;">        
<script type='text/javascript' src='../block/datetimepicker/datetimepicker_css_ge.js'></script>
  <tr>
    <td width="500px" >
      <div class="filterTitle" style="margin-top:15px;margin-left:15px;"></div>
      <table class="filterForm" style="margin-left:15px;" border="0" cellspacing="0">
          <tr>
            <td class="filterFormLabel" style="width:160px;">ინვენტარის ნომერი:</td>
            <td class = "rightDottedBorder"><input type="text" name="inventaris_nomeri" id="inventaris_nomeri"  onkeyup="maskFloat(inventaris_nomeri)"value="<?php echo $inventaris_nomeri;?>"/></td>
            <td class="filterFormLabel" style="width:160px;">თარიღი:</td>
            <td>
				<input type="text" name="tarigi_dan" id="tarigi_dan" onkeyup="return maskdate(event,this);" value="<?php echo $tarigi_dan;?>" maxlength="10" />
	      		<a href="javascript:NewCssCal('tarigi_dan','yyyymmdd','arrow',false,24,false,true)">
                	<img border="0" src="../block/datetimepicker/images/cal.gif" width="16" height="16" alt="Pick a date"></a> - დან
				<input type="text" name="tarigi_mde" id="tarigi_mde" onkeyup="return maskdate(event,this);" value="<?php echo $tarigi_mde?>" maxlength="10" />
	      		<a href="javascript:NewCssCal('tarigi_mde','yyyymmdd','arrow',false,24,false,true)">
                	<img border="0" src="../block/datetimepicker/images/cal.gif" width="16" height="16" alt="Pick a date"></a> - მდე
            </td>
          </tr>
          <tr>
            <td class="filterFormLabel">CPV:</td>
            <td class="rightDottedBorder">
		<input type="text" name="CPV" id="CPV" value="<?php echo $CPV?>" maxlength="8" />
            </td>
            <td class="filterFormLabel">შესყიდვის თარიღი:</td>
            <td>
				<input type="text" name="shesyidvis_tarigi_dan" id="shesyidvis_tarigi_dan" onkeyup= "return maskdate(event,this);"  value="<?php echo $shesyidvis_tarigi_dan?>" maxlength="10" />
         		<a href="javascript:NewCssCal('shesyidvis_tarigi_dan','yyyymmdd','arrow',false,24,false,true)">
	            <img border="0" src="../block/datetimepicker/images/cal.gif" width="16" height="16" alt="Pick a date" /></a> - დან
				<input type="text" name="shesyidvis_tarigi_mde" id="shesyidvis_tarigi_mde" onkeyup= "return maskdate(event,this);"  value="<?php echo $shesyidvis_tarigi_mde?>" maxlength="10" />
         		<a href="javascript:NewCssCal('shesyidvis_tarigi_mde','yyyymmdd','arrow',false,24,false,true)">
	            <img border="0" src="../block/datetimepicker/images/cal.gif" width="16" height="16" alt="Pick a date" /></a> - მდე
            </td>
          </tr>
          <tr>
            <td class="filterFormLabel">დეპარტამენტი:</td>
            <td class="rightDottedBorder">
				<?php 
                 mysqli_select_db($db, $dbStaff);	//მონაცემთა ბაზის გადართვა
                ?>
             	<select name="ganyofileba" id="ganyofileba" style="width:156px" onchange="javascript:onDepartmentSelected();">
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
         </td>
            <td class="filterFormLabel">ჩამოწერის თარიღი:</td>
            <td>
				<input type="text" name="chamoceris_tarigi_dan" id="chamoceris_tarigi_dan" onkeyup= "return maskdate(event,this);"  value="<?php echo $chamoceris_tarigi_dan?>" maxlength="10"/>
         		<a href="javascript:NewCssCal('chamoceris_tarigi_dan','yyyymmdd','arrow',false,24,false,true)">
	            <img border="0" src="../block/datetimepicker/images/cal.gif" width="16" height="16" alt="Pick a date" /></a> - დან
				<input type="text" name="chamoceris_tarigi_mde" id="chamoceris_tarigi_mde" onkeyup= "return maskdate(event,this);"  value="<?php echo $chamoceris_tarigi_mde?>" maxlength="10" />
         		<a href="javascript:NewCssCal('chamoceris_tarigi_mde','yyyymmdd','arrow',false,24,false,true)">
	            <img border="0" src="../block/datetimepicker/images/cal.gif" width="16" height="16" alt="Pick a date" /></a> - მდე
            </td>
          </tr>
          <tr>
            <td class="filterFormLabel">ჯგუფი/ლაბორატორია:</td>
            <td class="rightDottedBorder">
            	<select name="jgufi_laboratoria" id="jgufi_laboratoria" style="width:156px" onchange="javascript:ongrouplaboratorySelected();">
             	  <option value=""></option>
             	  <option value="<?php echo $jgufi_laboratoria;?>" <?php {echo "selected='selected'";}?>><?php echo $jgufi_laboratoria;?></option>
           		</select>
       		</td>
            <td class="filterFormLabel">გადაცემის თარიღი:</td>
            <td>
				<input type="text" name="gadacemis_tarigi_dan" id="gadacemis_tarigi_dan" onkeyup= "return maskdate(event,this);"  value="<?php echo $gadacemis_tarigi_dan?>" maxlength="10" />
         		<a href="javascript:NewCssCal('gadacemis_tarigi_dan','yyyymmdd','arrow',false,24,false,true)">
	            <img border="0" src="../block/datetimepicker/images/cal.gif" width="16" height="16" alt="Pick a date" /></a> - დან
				<input type="text" name="gadacemis_tarigi_mde" id="gadacemis_tarigi_mde" onkeyup= "return maskdate(event,this);"  value="<?php echo $gadacemis_tarigi_mde?>" maxlength="10" />
         		<a href="javascript:NewCssCal('gadacemis_tarigi_mde','yyyymmdd','arrow',false,24,false,true)">
	            <img border="0" src="../block/datetimepicker/images/cal.gif" width="16" height="16" alt="Pick a date" /></a> - მდე
            </td>
          </tr>
          <tr>
            <td class="filterFormLabel">პასუხისმგებელი პირი:</td>
            <td class="rightDottedBorder">
            	<select name="pasuxismgebeli" id="pasuxismgebeli" style="width:156px">
                 <option value=""></option>
                 <option value= <?php {echo "selected='selected'";}?>><?php echo $pasuxismgebeli;?></option>
                </select>
       		</td>
            <td class="filterFormLabel">ღირებულება:</td>
            <td>
            	<input type="text" name="girebuleba_dan" id="girebuleba_dan" onkeyup="maskFloat(tanxa)" value="<?php echo $girebuleba_dan ?>"/> - დან
                <input type="text" name="girebuleba_mde" id="girebuleba_mde" onkeyup="maskFloat(tanxa)" value="<?php echo $girebuleba_mde ?>"/> - მდე
            </td>
          </tr>
          <tr>
            <td class="filterFormLabel">ოთახის ნომერი:</td>
            <td class="rightDottedBorder"><input type="text" name="otaxis_nomeri" id="otaxis_nomeri"  value="<?php echo $otaxis_nomeri ?>"/></td>
            <td class="filterFormLabel">ნარჩ. ღირებულება:</td>
            <td>
            	<input type="text" name="narch_girebuleba_dan" id="narch_girebuleba_dan" onkeyup="maskFloat(tanxa)" value="<?php echo $narch_girebuleba_dan ?>"/> - დან
                <input type="text" name="narch_girebuleba_mde" id="narch_girebuleba_mde" onkeyup="maskFloat(tanxa)" value="<?php echo $narch_girebuleba_mde ?>"/> - მდე
            </td>
          </tr>
          <tr>
            <td class="filterFormLabel">ზომის ერთეული:</td>
            <td class="rightDottedBorder">
				<?php 
                 mysqli_select_db($db, $dbInventari);	//მონაცემთა ბაზის გადართვა
                ?>
                <select name="zomis_erteuli" id="zomis_erteuli" style="width:156px" >
                	<option value=""></option>
                    <?php
					$table = mysqli_query($db, "SELECT name FROM zomis_erteuli");
					while($row = mysqli_fetch_array($table))
					{
						$name = $row["name"];
					?>
					  <option value="<?php echo $name; ?>" <?php if($zomis_erteuli == $name) echo "selected='selected'";?>><?php echo $name;?></option>
					<?php
					}
					?>
                </select>
            </td>
            <td class="filterFormLabel">ღირებულება (ჯამში):</td>
            <td>
            	<input type="text" name="saboloo_girebuleba_dan" id="saboloo_girebuleba_dan" onkeyup="maskFloat(tanxa)" value="<?php echo $saboloo_girebuleba_dan ?>"/> - დან
                <input type="text" name="saboloo_girebuleba_mde" id="saboloo_girebuleba_mde" onkeyup="maskFloat(tanxa)" value="<?php echo $saboloo_girebuleba_mde ?>"/> - მდე
            </td>
          </tr>
          <tr>
            <td class="filterFormLabel">ჩამოწერილი ინვენტარი:</td>
            <td style="text-align:left" class="rightDottedBorder">
            	<input type="checkbox" name="chamocerili_inventari" id="chamocerili_inventari" <?php if($chamocerili_inventari == "yes") echo "checked='checked'"; ?> />
                </td>
            <td class="filterFormLabel">რაოდენობა:</td>
            <td>
            	<input type="text" name="raodenoba_dan" id="raodenoba_dan" onkeyup="maskFloat(tanxa)" value="<?php echo $raodenoba_dan ?>"/> - დან
                <input type="text" name="raodenoba_mde" id="raodenoba_mde" onkeyup="maskFloat(tanxa)" value="<?php echo $raodenoba_mde ?>"/> - მდე
            </td>
          </tr>
          <tr>
            <td class="filterFormLabel">გადაწერილი ინვენტარი:</td>
            <td  class="rightDottedBorder"><input type="checkbox" name="gadacerili_inventari" id="gadacerili_inventari" <?php if($gadacerili_inventari == "yes") echo "checked='checked'"; ?> /></td>
            <td class="filterFormLabel">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="4" align="center">
              <div class="Btns">
                <div class="Btn" onclick="javascript:searchproduct()"><img src="../images/filter2.png" alt="" width="16" height="15" align="absmiddle" />ძიება</div>
                <div class="splitDiv"></div>
                <div class="Btn" onclick="javascript:cleartext()"><img src="../images/clear.png" alt="" width="16" height="16" align="absmiddle" /> გასუფთავება</div>
              </div>
            </td>
          </tr>
        </table>
    </form>

<?php 
 mysqli_select_db($db ,$dbInventari);	//მონაცემთა ბაზის გადართვა

?>

      <p align="left">
        <script type='text/javascript' src="products.js"></script> 
      </p>
      <div style="margin-left:15px;margin-top:<?php if ($_SESSION['name'] != $siteMaintenanceUsername) echo "-";?>15px;">

       <?php if ($_SESSION['name'] == $siteMaintenanceUsername)   
					{ 
					?>
    <div class="Btn" onclick="javascript:addproducts()">
      <div align="center"><img src="../images/submit.png" width="16" height="16" align="absmiddle" /> დამატება</div>
    </div>

<div align="left" style="position: relative;"><div id="ajaxLoader1"><img src="mysqlajaxtableeditor/images/ajax_loader.gif" alt="Loading..." /></div></div>
 <?php  
		}
	  ?>

            <br />
			<div id="historyButtonsLayer" align="left">
			</div>
	
			<div id="historyContainer">
				<div id="information">
				</div>
		
				<div id="titleLayer" style="display:none; padding: 2px; font-weight: bold; font-size: 18px; text-align: left;">
                
				</div>
		
				<div id="tableLayer" align="left">
				</div>
				
				<div id="recordLayer" align="left">
				</div>		
				
				<div id="searchButtonsLayer" align="left">
				</div>
			</div>
</div>
			<script type="text/javascript">
				trackHistory = false;
				var ajaxUrl = '<?php echo $_SERVER['PHP_SELF']; ?>';
				toAjaxTableEditor('update_html','');
			</script>
		<?php
	}

	function initiateEditor()
	{
		global $siteMaintenanceUsername;
		$tableColumns['id'] = array('display_text' => 'ID', 'perms' => 'TVQSXO');
		$tableColumns['inventaris_shida_nomeri'] = array('display_text' => 'შიდა ნომერი', 'perms' => 'EVCTAXQSHO');
		$tableColumns['inventaris_nomeri'] = array('display_text' => 'ნომერი', 'perms' => 'EVCTAXQSHO');
		$tableColumns['shida_gadaceris_aqtis_nomeri'] = array('display_text' => 'აქტის ნომერი', 'perms' => 'EVCTAXQSHO');
		
		$tableColumns['CPV'] = array('display_text' => 'CPV', 'perms' => 'EVCTAXQSHO');
		$tableColumns['invetaris_dasaxeleba'] = array('display_text' => 'ინვენტ.დასახელება', 'perms' => 'EVCTAXQSHO');
		$tableColumns['inventaris_modeli'] = array('display_text' => 'ინვენტ.მწარმოებელი.მოდელი', 'perms' => 'EVCTAXQSHO');
		$tableColumns['seriuli_nomeri'] = array('display_text' => 'სერიული ნომერი', 'perms' => 'EVCTAXQSHO');
		$tableColumns['raodenoba'] = array('display_text' => 'რაოდენობა', 'perms' => 'EVCTAXQSHO');
		$tableColumns['zomis_erteuli'] = array('display_text' => 'ზომის ერთეული', 'perms' => 'EVCTAXQSHO');
		$tableColumns['saboloo_girebuleba'] = array('display_text' => 'ღირებულება (ჯამში)', 'perms' => 'EVCTAXQSHO');//VTQSHOX  EVCTAXQSHO
		$tableColumns['tanxa'] = array('display_text' => 'ღირებულება', 'perms' => 'EVCTAXQSHO');
		$tableColumns['narcheni_girebuleba'] = array('display_text' => 'ნარჩ.ღირებულება', 'perms' => 'EVCTAXQSHO');
		$tableColumns['naecheni_girebulebis_angarishi'] = array('display_text' => 'ნ.ღ.ა.', 'perms' => 'EVCTAXQSHO');	
		
		$tableColumns['ganyofileba'] = array('display_text' => 'განყოფილება', 'perms' => 'EVCTAXQSHO');
		$tableColumns['jgufi_laboratoria'] = array('display_text' => 'ჯგუფი/ლაბორატორია', 'perms' => 'EVCTAXQSHO');
		$tableColumns['pasuxismgebeli'] = array('display_text' => 'პას.პირი', 'perms' => 'EVCTAXQSHO');
		$tableColumns['otaxis_nomeri'] = array('display_text' => 'ოთახის N', 'perms' => 'EVCTAXQSHO');
		
		$tableColumns['cvlileba'] = array('display_text' => 'ცვლილება', 'perms' => 'EVCTAXQSHO');
		$tableColumns['mdgomareoba'] = array('display_text' => 'მდგომარეობა', 'perms' => 'EVCTAXQSHO');
		
		$tableColumns['shesyidvis_tarigi'] = array('display_text' => 'შესყიდვის თარიღი', 'perms' => 'EVCTAXQSHO');
		$tableColumns['chamoceris_tarigi'] = array('display_text' => 'ჩამოწერის თარიღი', 'perms' => 'EVCTAXQSHO');
		$tableColumns['gadacemis_tarigi'] = array('display_text' => 'გადაცემის თარიღი', 'perms' => 'EVCTAXQSHO');
		$tableColumns['gadacera_chamoceris_tarigi'] = array('display_text' => 'გ/ჩ თარიღი', 'perms' => 'EVCTAXQSHO');
		
		$tableColumns['komentari'] = array('display_text' => 'დამატებითი ინფორმაცია', 'perms' => 'EVCTAXQSHO');
			
				
		
		$tableName = 'inventari';
		$primaryCol = 'id';
		$errorFun = array(&$this,'logError');
		//$permissions = 'EAVIDQCSXHO';
		$permissions = 'HOUX';
		
		$this->Editor = new AjaxTableEditor($tableName,$primaryCol,$errorFun,$permissions,$tableColumns);
		$this->Editor->setConfig('tableInfo','cellpadding="1" width="1000" class="mateTable"');
		//$this->Editor->setConfig('orderByColumn','first_name');
		$this->Editor->setConfig('addRowTitle','Add Employee');
		$this->Editor->setConfig('editRowTitle','Edit Employee');
		
		
//////-----------------ფილტრის კოდი--------------------------------------------------------------------------------------------------------------

		$sqlfilterstr="1=1";
		if(isset($_COOKIE["inventaris_nomeri"])) $sqlfilterstr .= " AND inventari.inventaris_nomeri = '".$_COOKIE["inventaris_nomeri"]."'";
		if (isset($_COOKIE["CPV"])) $sqlfilterstr .= " AND inventari.CPV = '".$_COOKIE["CPV"]."'";
		if (isset($_COOKIE["ganyofileba"])) $sqlfilterstr .= " AND inventari.ganyofileba = '".$_COOKIE["ganyofileba"]."'";
		if (isset($_COOKIE["jgufi_laboratoria"])) $sqlfilterstr .= " AND inventari.jgufi_laboratoria = '".$_COOKIE["jgufi_laboratoria"]."'";
		if (isset($_COOKIE["pasuxismgebeli"])) $sqlfilterstr .= " AND inventari.pasuxismgebeli = '".$_COOKIE["pasuxismgebeli"]."'";
		if (isset($_COOKIE["otaxis_nomeri"])) $sqlfilterstr .= " AND inventari.otaxis_nomeri = '".$_COOKIE["otaxis_nomeri"]."'";
		if (isset($_COOKIE["zomis_erteuli"])) $sqlfilterstr .= " AND inventari.zomis_erteuli = '".$_COOKIE["zomis_erteuli"]."'";
		
		if(!isset($_COOKIE["chamocerili_inventari"])) $sqlfilterstr .= " AND inventari.chamoceris_tarigi = '0000-00-00'";
		if(!isset($_COOKIE["gadacerili_inventari"])) $sqlfilterstr .= " AND inventari.gadacera_chamoceris_tarigi = '0000-00-00'";
		
		
		if(!isset($_COOKIE["tarigi_dan"])) $tmp_start_date = '0000-00-00';
		else $tmp_start_date = $_COOKIE["tarigi_dan"];
				
		if(!isset($_COOKIE["tarigi_mde"])) $tmp_end_date = '9999-12-31';
		else $tmp_end_date = $_COOKIE["tarigi_mde"];
		
		if($tmp_start_date != '0000-00-00' or $tmp_end_date != '9999-12-31')
$sqlfilterstr .= " AND !((inventari.shesyidvis_tarigi!='0000-00-00' AND '$tmp_start_date' <= inventari.shesyidvis_tarigi AND '$tmp_end_date' <= inventari.shesyidvis_tarigi) OR 
				  (inventari.chamoceris_tarigi!='0000-00-00' AND '$tmp_start_date' >= inventari.chamoceris_tarigi AND '$tmp_end_date' >= inventari.chamoceris_tarigi) OR
				  (inventari.shesyidvis_tarigi='0000-00-00' AND inventari.chamoceris_tarigi!='0000-00-00' AND '$tmp_end_date' <= inventari.chamoceris_tarigi) OR
				  (inventari.shesyidvis_tarigi!='0000-00-00' AND inventari.chamoceris_tarigi='0000-00-00' AND '$tmp_end_date' <= inventari.shesyidvis_tarigi) OR
				  ('$tmp_end_date' <= '$tmp_start_date')
				  )";		
		
		if(isset($_COOKIE['shesyidvis_tarigi_dan'])) $sqlfilterstr .= " AND inventari.shesyidvis_tarigi >= '".$_COOKIE["shesyidvis_tarigi_dan"]."'";
		if(isset($_COOKIE['shesyidvis_tarigi_mde'])) $sqlfilterstr .= " AND inventari.shesyidvis_tarigi <= '".$_COOKIE["shesyidvis_tarigi_mde"]."' AND inventari.shesyidvis_tarigi != '0000-00-00'";
		
		if(isset($_COOKIE['chamoceris_tarigi_dan'])) $sqlfilterstr .= " AND inventari.chamoceris_tarigi >= '".$_COOKIE["chamoceris_tarigi_dan"]."'";
		if(isset($_COOKIE['chamoceris_tarigi_mde'])) $sqlfilterstr .= " AND inventari.chamoceris_tarigi <= '".$_COOKIE["chamoceris_tarigi_mde"]."' AND inventari.chamoceris_tarigi != '0000-00-00'";
		
		if(isset($_COOKIE['gadacemis_tarigi_dan'])) $sqlfilterstr .= " AND inventari.gadacemis_tarigi >= '".$_COOKIE["gadacemis_tarigi_dan"]."'";
		if(isset($_COOKIE['gadacemis_tarigi_mde'])) $sqlfilterstr .= " AND inventari.gadacemis_tarigi <= '".$_COOKIE["gadacemis_tarigi_mde"]."' AND inventari.gadacemis_tarigi != '0000-00-00'";
			
		if(isset($_COOKIE['girebuleba_dan'])) $sqlfilterstr .= " AND inventari.tanxa >= ".$_COOKIE["girebuleba_dan"];
		if(isset($_COOKIE['girebuleba_mde'])) $sqlfilterstr .= " AND inventari.tanxa <= ".$_COOKIE["girebuleba_mde"]. " AND inventari.tanxa !=''";
		
		if(isset($_COOKIE['narch_girebuleba_dan'])) $sqlfilterstr .= " AND inventari.narcheni_girebuleba >= ".$_COOKIE["narch_girebuleba_dan"];
		if(isset($_COOKIE['narch_girebuleba_mde'])) $sqlfilterstr .= " AND inventari.narcheni_girebuleba <= ".$_COOKIE["narch_girebuleba_mde"]." AND inventari.narcheni_girebuleba !=''";

		if(isset($_COOKIE['saboloo_girebuleba_dan'])) $sqlfilterstr .= " AND inventari.saboloo_girebuleba	 >= ".$_COOKIE["saboloo_girebuleba_dan"];
		if(isset($_COOKIE['saboloo_girebuleba_mde'])) $sqlfilterstr .= " AND inventari.saboloo_girebuleba	 <= ".$_COOKIE["saboloo_girebuleba_mde"]." AND inventari.saboloo_girebuleba !=''";
		
		if(isset($_COOKIE['raodenoba_dan'])) $sqlfilterstr .= " AND inventari.raodenoba	 >= ".$_COOKIE["raodenoba_dan"];
		if(isset($_COOKIE['raodenoba_mde'])) $sqlfilterstr .= " AND inventari.raodenoba	 <= ".$_COOKIE["raodenoba_mde"]." AND inventari.saboloo_girebuleba !=''";
		
				  
	$this->Editor->setConfig('sqlFilters',$sqlfilterstr);	
	
	//$this->Editor->setConfig('viewQuery',true);
	if($_SESSION['name'] == $siteMaintenanceUsername)
    	$this->Editor->setConfig('extraRowInfo','onclick="showRowDetails(\'#primaryColValue#\',\'#rowNum#\');" style="cursor: pointer;"');
		

		//$this->Editor->setConfig('iconTitle','Edit Employee');
	}
	
	
	function Example1($db,$dbUsername,$dbInventari,$dbHost,$dbUsernamePass)
	{
		$this->db_local = $db;
		$this->mysqlUser = $dbUsername;
		$this->mysqlDb = $dbInventari;
		$this->mysqlHost = $dbHost;
		$this->mysqlDbPass = $dbUsernamePass;
		
		if(isset($_POST['json']))
		{
			session_start();
			// Initiating lang vars here is only necessary for the logError, and mysqlConnect functions in Common.php. 
			// If you are not using Common.php or you are using your own functions you can remove the following line of code.
			$this->langVars = new LangVars();
			$this->mysqlConnect();
			if(ini_get('magic_quotes_gpc'))
			{
				$_POST['json'] = stripslashes($_POST['json']);
			}
			if(function_exists('json_decode'))
			{
				$data = json_decode($_POST['json']);
			}
			else
			{
				require_once('mysqlajaxtableeditor/php/JSON.php');
				$js = new Services_JSON();
				$data = $js->decode($_POST['json']);
			}
			if(empty($data->info) && strlen(trim($data->info)) == 0)
			{
				$data->info = '';
			}
			$this->initiateEditor();
			$this->Editor->main($data->action,$data->info);
			if(function_exists('json_encode'))
			{
				echo json_encode($this->Editor->retArr);
			}
			else
			{
				echo $js->encode($this->Editor->retArr);
			}
		}
		else if(isset($_GET['export']))
		{
            session_start();
            ob_start();
            $this->mysqlConnect();
            $this->initiateEditor();
			echo $this->Editor->exportInfo();

           // echo mb_convert_encoding($this->Editor->exportInfo(),"Windows-1252","UTF-8");
            header("Cache-Control: no-cache, must-revalidate");
            header("Pragma: no-cache");
            header("Content-type: application/x-msexcel");
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="'.$this->Editor->tableName.'.csv"');
            exit();
        }
		else
		{
			$this->displayHeaderHtml();
			$this->displayHtml();
			$this->displayFooterHtml();
		}
	}
}
$lte = new Example1($db,$dbUsername,$dbInventari,$dbHost,$dbUsernamePass);
ob_flush();
?>

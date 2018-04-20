<?php
include("../block/globalVariables.php");
include("../block/db.php");
include("../block/functions.php");
include("../checklogin.php");// amocmebs tu aris avtorizacia gavlili
if($_SESSION['name'] != $siteMaintenanceUsername) die("Error 333");
if(isset($_POST['mtvleli'])) {$mtvleli=$_POST['mtvleli'];} else echo "mtvleli no";
if(isset($_POST['inventaris_nomeri'])) {$inventaris_nomeri=$_POST['inventaris_nomeri'];} else echo "1";
if(isset($_POST['inventaris_shida_nomeri'])) {$inventaris_shida_nomeri=$_POST['inventaris_shida_nomeri'];} else echo "1";
if(isset($_POST['shida_gadaceris_aqtis_nomeri'])) {$shida_gadaceris_aqtis_nomeri=$_POST['shida_gadaceris_aqtis_nomeri'];} else echo "1";
if(isset($_POST['shesyidvis_tarigi'])) {$shesyidvis_tarigi=$_POST['shesyidvis_tarigi'];}  else echo "2";
if(isset($_POST['chamoceris_tarigi'])) {$chamoceris_tarigi=$_POST['chamoceris_tarigi'];}  else echo "2";
if(isset($_POST['CPV'])) {$CPV=$_POST['CPV'];}  else echo "21";
if(isset($_POST['invetaris_dasaxeleba'])) {$invetaris_dasaxeleba=$_POST['invetaris_dasaxeleba'];}  else echo "3";
if(isset($_POST['inventaris_modeli'])) {$inventaris_modeli=$_POST['inventaris_modeli'];}  else echo "3-1";
if(isset($_POST['seriuli_nomeri'])) {$seriuli_nomeri=$_POST['seriuli_nomeri'];}  else echo "3";
if(isset($_POST['zomis_erteuli'])) {$zomis_erteuli=$_POST['zomis_erteuli'];}  else echo "4";
if(isset($_POST['Tanxa'])) {$Tanxa=$_POST['Tanxa'];}  else echo "5";
if(isset($_POST['raodenoba'])) {$raodenoba=$_POST['raodenoba'];}  else echo "6";
if(isset($_POST['saboloo_girebuleba'])) {$saboloo_girebuleba=$_POST['saboloo_girebuleba'];}  else echo "7";
if(isset($_POST['narcheni_girebuleba'])) {$narcheni_girebuleba=$_POST['narcheni_girebuleba'];}  else echo "8";
if(isset($_POST['pasuxismgebeli'])) {$pasuxismgebeli=$_POST['pasuxismgebeli'];}  else echo "9";
if(isset($_POST['otaxis_nomeri'])) {$otaxis_nomeri=$_POST['otaxis_nomeri'];}  else echo "10";

if(isset($_POST['jgufi_laboratoria'])) {$jgufi_laboratoria=$_POST['jgufi_laboratoria'];}  else echo "7";

if(isset($_POST['ganyofileba'])) {$ganyofileba=$_POST['ganyofileba'];}  else echo "7";
if(isset($_POST['gadacemis_tarigi'])) {$gadacemis_tarigi=$_POST['gadacemis_tarigi'];}  else echo "11";
if(isset($_POST['gadacera_chamoceris_tarigi'])) {$gadacera_chamoceris_tarigi=$_POST['gadacera_chamoceris_tarigi'];}  else echo "12";
if(isset($_POST['cvlileba'])) {$cvlileba=$_POST['cvlileba'];}  else echo "13";
if(isset($_POST['mdgomareoba'])) {$mdgomareoba=$_POST['mdgomareoba'];}  else echo "14";
if(isset($_POST['naecheni_girebulebis_angarishi'])) {$naecheni_girebulebis_angarishi=$_POST['naecheni_girebulebis_angarishi'];}  else echo "15";
if(isset($_POST['komentari'])) {$komentari=$_POST['komentari'];}  else echo "12226";

/////////////mushaobs ////////////////////

if(isset($_POST['dasaxuriProduqti']) and $_POST['dasaxuriProduqti'] > 0)
{
	$dasaxuriProduqti = $_POST['dasaxuriProduqti'];
	if(isset($gadacemis_tarigi))
	{
		$query = "UPDATE inventari SET gadacera_chamoceris_tarigi='$gadacemis_tarigi' WHERE id='$dasaxuriProduqti'";
		mysqli_query($db, $query) or die($query);
	}
}

if ($mtvleli>0)
{
	if(isset($inventaris_nomeri) && isset($inventaris_shida_nomeri) && isset($shida_gadaceris_aqtis_nomeri) && isset($shesyidvis_tarigi)&& isset($invetaris_dasaxeleba)&& isset($inventaris_modeli)&& isset($zomis_erteuli)&& isset($Tanxa)&& isset($raodenoba) && isset($saboloo_girebuleba)&&isset($narcheni_girebuleba)&&isset($pasuxismgebeli)&&isset($otaxis_nomeri)&&isset($ganyofileba)&&isset($gadacemis_tarigi)&&isset($gadacera_chamoceris_tarigi)&&isset($cvlileba) &&isset($mdgomareoba) &&isset($naecheni_girebulebis_angarishi)&&isset($komentari))
		{
		 $sql = "UPDATE inventari SET inventaris_nomeri='$inventaris_nomeri',
		 		inventaris_shida_nomeri='$inventaris_shida_nomeri',
				shida_gadaceris_aqtis_nomeri='$shida_gadaceris_aqtis_nomeri',
				shesyidvis_tarigi='$shesyidvis_tarigi',
				chamoceris_tarigi='$chamoceris_tarigi',
				CPV='$CPV',
				invetaris_dasaxeleba='$invetaris_dasaxeleba',
				inventaris_modeli='$inventaris_modeli',
				seriuli_nomeri='$seriuli_nomeri',
				zomis_erteuli='$zomis_erteuli',
				Tanxa='$Tanxa',
				raodenoba='$raodenoba',
				saboloo_girebuleba='$saboloo_girebuleba',
				narcheni_girebuleba='$narcheni_girebuleba',
				pasuxismgebeli='$pasuxismgebeli',
				otaxis_nomeri='$otaxis_nomeri',
				ganyofileba='$ganyofileba',
				jgufi_laboratoria='$jgufi_laboratoria',
				gadacemis_tarigi='$gadacemis_tarigi',
				gadacera_chamoceris_tarigi='$gadacera_chamoceris_tarigi',
				cvlileba='$cvlileba',
				mdgomareoba='$mdgomareoba',
				naecheni_girebulebis_angarishi='$naecheni_girebulebis_angarishi',
				komentari='$komentari' WHERE id='$mtvleli'";
 		$result=mysqli_query($db, $sql);
		}


}

else

{
	if(isset($inventaris_nomeri) && isset($inventaris_shida_nomeri) && isset($shesyidvis_tarigi)&& isset($invetaris_dasaxeleba)&& isset($inventaris_modeli)&& isset($zomis_erteuli)&& isset($Tanxa)&& isset($raodenoba) && isset($saboloo_girebuleba)&&isset($narcheni_girebuleba)&&isset($pasuxismgebeli)&&isset($otaxis_nomeri)&&isset($ganyofileba)&&isset($gadacemis_tarigi)&&isset($gadacera_chamoceris_tarigi)&&isset($cvlileba) &&isset($mdgomareoba) &&isset($naecheni_girebulebis_angarishi)&&isset($komentari))
		{
			$sql = "INSERT INTO inventari(inventaris_nomeri,inventaris_shida_nomeri,shida_gadaceris_aqtis_nomeri,shesyidvis_tarigi,chamoceris_tarigi,CPV,invetaris_dasaxeleba,inventaris_modeli,seriuli_nomeri,zomis_erteuli,jgufi_laboratoria,Tanxa,raodenoba,saboloo_girebuleba,narcheni_girebuleba,pasuxismgebeli,otaxis_nomeri,ganyofileba,gadacemis_tarigi,gadacera_chamoceris_tarigi,cvlileba,mdgomareoba,naecheni_girebulebis_angarishi,komentari)
VALUES('$inventaris_nomeri','$inventaris_shida_nomeri','$shida_gadaceris_aqtis_nomeri','$shesyidvis_tarigi','$chamoceris_tarigi','$CPV','$invetaris_dasaxeleba','$inventaris_modeli','$seriuli_nomeri','$zomis_erteuli','$jgufi_laboratoria','$Tanxa','$raodenoba','$saboloo_girebuleba','$narcheni_girebuleba','$pasuxismgebeli','$otaxis_nomeri','$ganyofileba','$gadacemis_tarigi','$gadacera_chamoceris_tarigi','$cvlileba','$mdgomareoba','$naecheni_girebulebis_angarishi','$komentari')";
$result=mysqli_query($db, $sql);


			if($result == true) {echo"<p> წარმატებით დაემატა<?p>";}
			else{echo"<p> ჩანაწერი არ ჩაემატა 11</p>";}
		}
		else
		{

		echo "<p>ბაზა არ დაემატა 22</p>.";
		}

}
?>
<?php
header('Location: products.php');

?>

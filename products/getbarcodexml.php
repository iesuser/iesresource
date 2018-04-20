<?php
include("../block/globalVariables.php");
include("../block/db.php");

header("Content-type: text/xml");
echo "<?xml version='1.0' encoding='UTF-8'?>";

if(isset($_GET['barcode'])) {
	echo "\n<record>\n";
	$barcode=$_GET['barcode'];
	//$barcode=str_pad($barcode, 9, "0", STR_PAD_LEFT);
	$table = mysqli_query($db, "SELECT * FROM inventari WHERE inventaris_nomeri=$barcode ORDER BY gadacemis_tarigi DESC LIMIT 1");
	while($row = mysqli_fetch_array($table)) {
                $inventaris_nomeri = $row["inventaris_nomeri"];
                $inventaris_shida_nomeri = $row["inventaris_shida_nomeri"];
                $shesyidvis_tarigi = $row["shesyidvis_tarigi"];
                $shida_gadaceris_aqtis_nomeri = $row["shida_gadaceris_aqtis_nomeri"];
                $seriuli_nomeri = $row["seriuli_nomeri"];
                $chamoceris_tarigi = $row["chamoceris_tarigi"];
                $CPV = $row["CPV"];
                $invetaris_dasaxeleba = $row["invetaris_dasaxeleba"];
                $inventaris_modeli = $row["inventaris_modeli"];
                $zomis_erteuli = $row["zomis_erteuli"];
                $Tanxa = $row["Tanxa"];
                $raodenoba = $row["raodenoba"];
                $saboloo_girebuleba = $row["saboloo_girebuleba"];
                $narcheni_girebuleba = $row["narcheni_girebuleba"];
                $pasuxismgebeli = $row["pasuxismgebeli"];
                $otaxis_nomeri = $row["otaxis_nomeri"];
                $ganyofileba = $row["ganyofileba"];
                $jgufi_laboratoria = $row["jgufi_laboratoria"];
                $gadacemis_tarigi = $row["gadacemis_tarigi"];
                $gadacera_chamoceris_tarigi  = $row["gadacera_chamoceris_tarigi"];
                $cvlileba  = $row["cvlileba"];
                $mdgomareoba = $row["mdgomareoba"];
                $naecheni_girebulebis_angarishi = $row["naecheni_girebulebis_angarishi"];
                $invetaris_dasaxeleba = $row["invetaris_dasaxeleba"];
                echo "   <id>\n";
                echo "      <name>$invetaris_dasaxeleba</name>\n";
                echo "      <modeli>$inventaris_modeli</modeli>\n";
                echo "      <mdgomareoba>$mdgomareoba</mdgomareoba>\n";
                echo "      <otaxi>$otaxis_nomeri</otaxi>\n";
                echo "      <visia>$pasuxismgebeli</visia>\n";
                echo "      <gany>$ganyofileba</gany>\n";
		echo "   </id>\n";
        }
	if (mysqli_num_rows($table)==0) {
                echo "      <result>empty</result>\n";
        }
	echo "</record>";
}

?>

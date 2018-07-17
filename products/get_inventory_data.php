
<?php
header("Content-type: application/x-javascript");
include("../block/globalVariables.php");
include("../block/db.php");


// sleep(2);

$where = " 1=1 ";
if (!empty($_POST["inventaris_nomeri"])) $where .= " AND (inventaris_nomeri = '".$_POST["inventaris_nomeri"]."' OR inventaris_shida_nomeri = '".$_POST["inventaris_nomeri"]."')";
if (!empty($_POST["CPV"])) $where .= " AND CPV = '".$_POST["CPV"]."'";
if (!empty($_POST["ganyofileba"])) $where .= " AND ganyofileba = '".$_POST["ganyofileba"]."'";
if (!empty($_POST["jgufi_laboratoria"])) $where .= " AND jgufi_laboratoria = '".$_POST["jgufi_laboratoria"]."'";
if (!empty($_POST["pasuxismgebeli"])) $where .= " AND pasuxismgebeli = '".$_POST["pasuxismgebeli"]."'";
if (!empty($_POST["otaxis_nomeri"])) $where .= " AND otaxis_nomeri = '".$_POST["otaxis_nomeri"]."'";
if (!empty($_POST["zomis_erteuli"])) $where .= " AND zomis_erteuli = '".$_POST["zomis_erteuli"]."'";

if($_POST["chamocerili_inventari"] == 'false') {
    $where .= " AND chamoceris_tarigi = '0000-00-00'";
}
if($_POST["gadacerili_inventari"] == 'false') $where .= " AND gadacera_chamoceris_tarigi = '0000-00-00'";


if(empty($_POST["tarigi_dan"])) $tmp_start_date = '0000-00-00';
else $tmp_start_date = $_POST["tarigi_dan"];

if(empty($_POST["tarigi_mde"])) $tmp_end_date = '9999-12-31';
else $tmp_end_date = $_POST["tarigi_mde"];

if($tmp_start_date != '0000-00-00' or $tmp_end_date != '9999-12-31')
$where .= " AND !((shesyidvis_tarigi!='0000-00-00' AND '$tmp_start_date' <= shesyidvis_tarigi AND '$tmp_end_date' <= shesyidvis_tarigi) OR
          (chamoceris_tarigi!='0000-00-00' AND '$tmp_start_date' >= chamoceris_tarigi AND '$tmp_end_date' >= chamoceris_tarigi) OR
          (shesyidvis_tarigi='0000-00-00' AND chamoceris_tarigi!='0000-00-00' AND '$tmp_end_date' <= chamoceris_tarigi) OR
          (shesyidvis_tarigi!='0000-00-00' AND chamoceris_tarigi='0000-00-00' AND '$tmp_end_date' <= shesyidvis_tarigi) OR
          ('$tmp_end_date' <= '$tmp_start_date')
          )";

if(!empty($_POST['shesyidvis_tarigi_dan'])) $where .= " AND shesyidvis_tarigi >= '".$_POST["shesyidvis_tarigi_dan"]."'";
if(!empty($_POST['shesyidvis_tarigi_mde'])) $where .= " AND shesyidvis_tarigi <= '".$_POST["shesyidvis_tarigi_mde"]."' AND shesyidvis_tarigi != '0000-00-00'";

if(!empty($_POST['chamoceris_tarigi_dan'])) $where .= " AND chamoceris_tarigi >= '".$_POST["chamoceris_tarigi_dan"]."'";
if(!empty($_POST['chamoceris_tarigi_mde'])) $where .= " AND chamoceris_tarigi <= '".$_POST["chamoceris_tarigi_mde"]."' AND chamoceris_tarigi != '0000-00-00'";

if(!empty($_POST['gadacemis_tarigi_dan'])) $where .= " AND gadacemis_tarigi >= '".$_POST["gadacemis_tarigi_dan"]."'";
if(!empty($_POST['gadacemis_tarigi_mde'])) $where .= " AND gadacemis_tarigi <= '".$_POST["gadacemis_tarigi_mde"]."' AND gadacemis_tarigi != '0000-00-00'";

if(!empty($_POST['girebuleba_dan'])) $where .= " AND tanxa >= ".$_POST["girebuleba_dan"];
if(!empty($_POST['girebuleba_mde'])) $where .= " AND tanxa <= ".$_POST["girebuleba_mde"]. " AND tanxa !=''";

if(!empty($_POST['narch_girebuleba_dan'])) $where .= " AND narcheni_girebuleba >= ".$_POST["narch_girebuleba_dan"];
if(!empty($_POST['narch_girebuleba_mde'])) $where .= " AND narcheni_girebuleba <= ".$_POST["narch_girebuleba_mde"]." AND narcheni_girebuleba !=''";

if(!empty($_POST['saboloo_girebuleba_dan'])) $where .= " AND saboloo_girebuleba    >= ".$_POST["saboloo_girebuleba_dan"];
if(!empty($_POST['saboloo_girebuleba_mde'])) $where .= " AND saboloo_girebuleba    <= ".$_POST["saboloo_girebuleba_mde"]." AND saboloo_girebuleba !=''";

if(!empty($_POST['raodenoba_dan'])) $where .= " AND raodenoba  >= ".$_POST["raodenoba_dan"];
if(!empty($_POST['raodenoba_mde'])) $where .= " AND raodenoba  <= ".$_POST["raodenoba_mde"]." AND saboloo_girebuleba !=''";



echo "dataSet = [";
$table = mysqli_query($db, "SELECT  id,
                                    inventaris_shida_nomeri,
                                    inventaris_nomeri, 
                                    shida_gadaceris_aqtis_nomeri, 
                                    shesyidvis_tarigi, 
                                    chamoceris_tarigi, 
                                    CPV,  
                                    invetaris_dasaxeleba, 
                                    inventaris_modeli, 
                                    seriuli_nomeri,
                                    zomis_erteuli, 
                                    Tanxa, 
                                    raodenoba, 
                                    saboloo_girebuleba,  
                                    narcheni_girebuleba, 
                                    ganyofileba, 
                                    jgufi_laboratoria, 
                                    pasuxismgebeli, 
                                    otaxis_nomeri, 
                                    gadacemis_tarigi, 
                                    gadacera_chamoceris_tarigi, 
                                    cvlileba, 
                                    mdgomareoba, 
                                    naecheni_girebulebis_angarishi, 
                                    komentari
                            FROM inventari WHERE ".$where); 

while($row = mysqli_fetch_array($table, MYSQLI_ASSOC)){
    $row['CPV'] = mysqli_real_escape_string($db, $row['CPV']);
    $row['invetaris_dasaxeleba'] = mysqli_real_escape_string($db, $row['invetaris_dasaxeleba']);
    $row['inventaris_modeli'] = mysqli_real_escape_string($db, $row['inventaris_modeli']);
    $row['seriuli_nomeri'] = mysqli_real_escape_string($db, $row['seriuli_nomeri']);
    $row['cvlileba'] = mysqli_real_escape_string($db, $row['cvlileba']);
    $row['komentari'] = mysqli_real_escape_string($db, $row['komentari']);
    echo '["'.implode('", "', $row).'"], ';
}
echo "];";



// echo "/* SELECT  id,
//                                     inventaris_shida_nomeri,
//                                     inventaris_nomeri, 
//                                     shida_gadaceris_aqtis_nomeri, 
//                                     shesyidvis_tarigi, 
//                                     chamoceris_tarigi, 
//                                     CPV,  
//                                     invetaris_dasaxeleba, 
//                                     inventaris_modeli, 
//                                     seriuli_nomeri,
//                                     zomis_erteuli, 
//                                     Tanxa, 
//                                     raodenoba, 
//                                     saboloo_girebuleba,  
//                                     narcheni_girebuleba, 
//                                     ganyofileba, 
//                                     jgufi_laboratoria, 
//                                     pasuxismgebeli, 
//                                     otaxis_nomeri, 
//                                     gadacemis_tarigi, 
//                                     gadacera_chamoceris_tarigi, 
//                                     cvlileba, 
//                                     mdgomareoba, 
//                                     naecheni_girebulebis_angarishi, 
//                                     komentari
//                             FROM inventari WHERE ".$where."  */";

// echo "console.log(".mysqli_error($db).")";

?>



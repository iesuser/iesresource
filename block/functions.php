<?php



function HaveAccess( $permition )

{

	setcookie("currenturl" ,$_SERVER['REQUEST_URI'], time() + 3600,"/");

	if(isset($_SESSION["password"]))

	{

		if (isset($_COOKIE['password']))

		{

			setcookie("nickname",$_COOKIE['nickname'], time() + 36000, "/");

			setcookie("password",$_COOKIE['password'], time() + 36000, "/");

		}

		$nickname = $_SESSION['nickname'];

		if($table_user = mysqli_query($db, "SELECT * FROM operators WHERE nickname='".$nickname."'"))

		$count = mysqli_num_rows($table_user);

		else return false;

		if (($count==1) && ($operator = mysqli_fetch_array($table_user)))

		{

			if ($permition == "index") return true;

			elseif ($operator[$permition]) return true;

			else setcookie("currenturl","", time() - 3600,"/");

		}

	}

	return false;

}





function CreatePageData($array,$page)

{

$str1=

"<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">

<html xmlns=\"http://www.w3.org/1999/xhtml\">

<head>

<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />

<title>Untitled Document</title>

</head>

<body>

<form name='postform' action='$page' method='post'>";

$str2=

"</form>

<script>

        document.postform.submit();

</script>

</body>

</html>";

$strpost = "";

$str="";

foreach ($_POST as $k => $v) $strpost.= "<input type='hidden' name='$k' value='$v' /> <br/>";

$str .= $str1;

$str .= $strpost;

$str .= $str2;

return $str;

}

//============eartquake functions============

function PrimaryValuesToId($networkCode,$code,$locationCode)

{

	$num = 1;

	$errorText = '';

	if(strlen($networkCode) < 2 || strlen($networkCode) > 3)

	{

		$errorText += $num + '. ქსელის კოდი უნდა შედგებოდეს 2 ან 3 სიმბოლოსგან! <br/>';

		$num++;

	}



	if(strlen($code) < 3 || strlen($code) > 4)

	{

		$errorText += $num + '. სადგურის კოდი უნდა შედგებოდეს 3 ან 4 სიმბოლოსგან! <br/>';

		$num++;

	}



	if(strlen($locationCode) != 2)

	{

		$errorText += $num + '. ქსელის კოდი უნდა შედგებოდეს 2 სიმბოლოსგან! <br/>';

	}



	if ($errorText == '')

	{

		if(strlen($code) == 3 ) $code .= '_';

		if(strlen($networkCode) == 2 ) $networkCode .= '_';

		return $networkCode.$code.$locationCode;

	}

	else

	{

		echo $errorText;

		return false;

	}

}



/*function UpdateEqStationRecordCount($eqId,$change)

{

	$eqTable = mysql_query("UPDATE earthquakes SET station_record_count=station_record_count+($change) WHERE id='$eqId'");

	if(!$eqTable) exit("error: UpdateEqStationRecordCount, insertUpdate_eq.php");

}*/



/*function UpdateEqPhasesCount($eqId)

{

	$primaries = mysql_query("SELECT id FROM primaries WHERE eq_id='$eqId'");

	$count = 0;

	while($primary = mysql_fetch_array($primaries))

	{

		$id = $primary['id'];

		$count += mysql_num_rows($primaryWaves = mysql_query("SELECT primary_id FROM primary_waves WHERE primary_id='$id'"));

	}

	$eqTable = mysql_query("UPDATE earthquakes SET phases_count='$count' WHERE id='$eqId'");

	if(!$eqTable) exit("error: UpdateEqPhasesCount, insertUpdate_eq.php");

}*/





/*function InsertPrimaryWave($primary_id, $type, $timeAndMsec, $weight, $sign)

{

	if($timeAndMsec!="")

	{

		$time = substr($timeAndMsec, 0, 19);

		$msec = substr($timeAndMsec, 20, strlen($timeAndMsec) - 20);

		$insertWave = mysql_query("INSERT INTO primary_waves(primary_id, type, time, msec, weight, sign)

									VALUES('$primary_id', '$type', '$time', '$msec', '$weight', '$sign')");

		if(!$insertWave) exit("error: insert Primary ".$type." Wave, insertUpdate_eq.php");

	}

}



function InsertUpdateDeletePrimaryWave($primary_id, $type, $timeAndMsec, $weight, $sign)

{

	if($timeAndMsec!="")

	{



		if(mysql_num_rows(mysql_query("SELECT primary_id FROM primary_waves WHERE primary_id='$primary_id' AND type='$type'"))>0)

		{

			$updatePnWave = mysql_query("UPDATE primary_waves SET time='$time', msec='$msec', weight='$weight', sign='$sign' WHERE primary_id='$primary_id' AND type='$type'");

			if(!$updatePnWave) exit("error: update Primary " + $type + " Wave, insertUpdate_eq.php");

		}else

		{

			$insertWave = mysql_query("INSERT INTO primary_waves(primary_id, type, time, msec, weight, sign)

										 VALUES('$primary_id', '$type', '$time', '$msec', '$weight', '$sign')");

			if(!$insertWave) die("error: insert Primary " + $type + " Wave, insertUpdate_eq.php");

		}

	}

	else

	{

		if(!$deletePnWave = mysql_query("DELETE FROM primary_waves WHERE primary_id='$primary_id' AND type='$type'"))

			exit("error: delete Primary " + $type + " Wave, insertUpdate_eq.php");

	}

}*/





//ფუნქცია ბაზაში ამოწმებს არის თუ არა ტალღა შენახული და შესაბამისად ამატეს ან განაახლებს

function insertUpdatePrimaryWave($primaryId, $type, $timeAndMsec, $quality, $weight, $onsetType, $eqCalculated)

{

	$time = substr($timeAndMsec, 0, 19);

	$msec = substr($timeAndMsec, 20, strlen($timeAndMsec) - 20);

	if(mysqli_num_rows(mysqli_query($db, "SELECT primary_id FROM primary_waves WHERE primary_id='$primaryId' AND type='$type'")) == 0)

	{

		if(!mysqli_query($db, "INSERT INTO primary_waves (primary_id, type, time, msec, quality, weight, onsetType, eqCalculated)

									   	     VALUES('$primaryId', '$type', '$time', '$msec', '$quality', $weight, '$onsetType', '$eqCalculated')"))

		return false;

	}else

	{

		if(!mysqli_query($db, "UPDATE primary_waves SET time='$time', msec='$msec', quality=$quality, weight=$weight,

							    onsetType='$onsetType', eqCalculated='$eqCalculated'

						 WHERE primary_id=$primaryId AND type='$type'"))

		return false;

	}

	return true;

}



//ფუნქცია ბაზაში ამოწმებს არის თუ არა მაგნიტუდა შენახული და შესაბამისად ამატეს ან განაახლებს

function insertUpdatePrimaryMagnitude($primaryId, $type, $value, $rezidual)

{

	if(mysqli_num_rows(mysqli_query($db, "SELECT primary_id FROM primary_magnitudes WHERE primary_id='$primaryId' AND type='$type'")) == 0)

	{

		if(!mysqli_query($db, "INSERT INTO primary_magnitudes (primary_id, type, value, rezidual)

									   	     VALUES('$primaryId', '$type', $value, $rezidual)"))

		return false;

	}else

	{

		if(!mysqli_query($db, "UPDATE primary_magnitudes SET value=$value, rezidual=$rezidual

						 WHERE primary_id=$primaryId AND type='$type'"))

		return false;

	}

	return true;

}



//ფუნქცია ბაზაში ამოწმებს არის თუ არა ამპლიტუდა შენახული და შესაბამისად ამატეს ან განაახლებს

function insertUpdatePrimaryAmplitude($primaryId, $waveType, $axis, $value, $dominantPeriod, $time, $velocity, $program)

{

	if(mysqli_num_rows(mysqli_query($db, "SELECT primary_id FROM primary_amplitudes WHERE primary_id='$primaryId' AND waveType='$waveType' AND axis='$axis'")) == 0)

	{

		if(!mysqli_query($db, "INSERT INTO primary_amplitudes (primary_id, waveType, axis, value, dominantPeriod, time, velocity, program)

									   	     VALUES('$primaryId', '$waveType', '$axis', $value, $dominantPeriod, $time, $velocity, '$program')"))

		return false;

	}else

	{

		if(!mysqli_query($db, "UPDATE primary_amplitudes SET value=$value, dominantPeriod=$dominantPeriod, time=$time, velocity=$velocity, program='$program'

						 WHERE primary_id='$primaryId' AND type='$waveType' AND axis='$axis'"))

		return false;

	}

	return true;

}



//ფუნქია შლის პირველადს მიბმულ ყველა ტალღას, მაგნიტუდას და ამპლიტუდას

function DeletePrimaryWavesMagnitudesAndAmplitudes($primaryId)

{

	if(!mysqli_query($db, "DELETE FROM primary_waves WHERE primary_id='$primaryId'")) return false;

	if(!mysqli_query($db, "DELETE FROM primary_magnitudes WHERE primary_id='$primaryId'")) return false;

	if(!mysqli_query($db, "DELETE FROM primary_amplitudes WHERE primary_id='$primaryId'")) return false;

	return true;

}



//ფუნქცია ამბრუნებს სადგურის id-ის. ქსელის კოდის , სადგურის კოდის და ლოკალური კოდის მიხედვით

function getStationId($networkCode, $stationCode, $locationCode)

{

	if(mysqli_num_rows($stations = mysqli_query($db, "SELECT station_id FROM stations_details

				WHERE network_code='$networkCode' AND alternative_code='$stationCode' AND location_code='$locationCode'"))>0)

	{

		$station = mysqli_fetch_array($stations);

		return $station['station_id'];

	}elseif(mysqli_num_rows($stations = mysqli_query($db, "SELECT station_id

													FROM stations

													INNER JOIN stations_details on stations.id=stations_details.station_id

													WHERE network_code='$networkCode' AND stations.code='$stationCode' AND location_code='$locationCode'"))>0)

	{

		$station = mysqli_fetch_array($stations);

		return $station['station_id'];

	}else return -1;

}



//ფუნქცია ბაზაში ამოწმებს არის თუ არა მიწისძვრის მაგნიტუდა შენახული და შესაბამისად ამატეს ან განაახლებს

function insertUpdateEqMagnitude($eqId, $type, $value, $minValue, $maxValue, $uncertainty, $stationCount)

{

	if(mysqli_num_rows(mysqli_query($db, "SELECT eqId FROM magnitudes WHERE eqId='$eqId' AND `type`='$type'")) == 0)

	{

		if(!mysqli_query($db, "INSERT INTO magnitudes (eqId, `type`, value, `minValue`, `maxValue`, uncertainty, stationCount)

									   	     VALUES($eqId, '$type', $value, $minValue, $maxValue, $uncertainty, $stationCount)"))

		return false;

	}else

	{
		if(!mysqli_query($db, "UPDATE magnitudes SET value=$value, `minValue`=$minValue, `maxValue`=$maxValue, uncertainty=$uncertainty, stationCount=$stationCount WHERE eqId='$eqId' AND `type`='$type'"))

		return false;

	}

	return true;

}



function getPrimaryCount($eqId)

{

	return mysqli_num_rows(mysqli_query($db, "SELECT id FROM primaries WHERE eq_id='$eqId'"));

}



function getPrimaryUsedCount($eqId)

{

	return mysqli_num_rows(mysqli_query($db, "SELECT id FROM primaries WHERE eq_id='$eqId' AND eqCalculated='Yes'"));

}



function getPrimaryPhasesCount($eqId)

{

	$primaries = mysqli_query($db, "SELECT id FROM primaries WHERE eq_id='$eqId'");

	$phasesCount = 0;

	while($primary = mysqli_fetch_array($primaries))

	{

		$primaryId = $primary['id'];

		$phasesCount += mysqli_num_rows(mysqli_query($db, "SELECT primary_id FROM primary_waves WHERE primary_id=$primaryId"));

	}

	return $phasesCount;

}



function getPrimaryUsedPhasesCount($eqId)

{

	$primaries = mysqli_query($db, "SELECT id FROM primaries WHERE eq_id='$eqId'");

	$phasesUsedCount = 0;

	while($primary = mysqli_fetch_array($primaries))

	{

		$primaryId = $primary['id'];

		$phasesUsedCount += mysqli_num_rows(mysqli_query($db, "SELECT primary_id FROM primary_waves WHERE primary_id=$primaryId AND eqCalculated='Yes'"));

	}

	return $phasesUsedCount;

}



function updateEqStationCounts($eqId)

{

	$stationRecordCount = getPrimaryCount($eqId);

	$stationUsedCount = getPrimaryUsedCount($eqId);

	$stationPhasesCount = getPrimaryPhasesCount($eqId);

	$stationUsedPhasesCount = getPrimaryUsedPhasesCount($eqId);

	$sql = "UPDATE earthquakes SET station_record_count='$stationRecordCount', station_used_count='$stationUsedCount', phases_count='$stationPhasesCount', phases_used_count='$stationUsedPhasesCount'

		    WHERE id='$eqId'";

	if(!mysqli_query($db, $sql))

		return false;

	return true;

}





/*function DeletePrimaryAndWaves($eqId, $primary_id,$printOrNotPrint)

{

	$deletePrimaryWaves = mysql_query("DELETE FROM primary_waves WHERE primary_id='$primary_id'");

	if(!$deletePrimaryWaves) exit("error: delete Primary waves, insertUpdate_eq.php");



	$deletePrimary = mysql_query("DELETE FROM primaries WHERE id='$primary_id'");

	if(!$deletePrimary) exit("error: delete Primary, insertUpdate_eq.php");

	UpdateEqPhasesCount($eqId);

	if($printOrNotPrint == 'print') exit('primaryDeleted');

}



function nextAutoID($tbl)

{

	$cqres = mysql_query("SHOW TABLE STATUS LIKE '$tbl'") or die(mysql_error());

	$cqr = mysql_fetch_assoc($cqres);

	$nid = $cqr['Auto_increment'];

	return $nid;

}*/



function millisecsBetween($dateOne, $dateTwo, $abs = true)

{

    $func = $abs ? 'abs' : 'intval';

    return $func(strtotime($dateOne) - strtotime($dateTwo)) * 1000;

}





//============end============================



//funqcia shlis mititebuli direqtoriis shigtavs

function delete_directory_content($dir)

{

	$handle=opendir($dir);

	while (($file = readdir($handle))!==false)

	{

		@unlink($dir.'/'.$file);

	}

	closedir($handle);

}



function drop_folder($dir)

{

	delete_directory_content($dir);

	rmdir($dir);

}



function printImage($imgsPath, $value,$link)

{

	if ($link != '') $onClick = "onclick=\"window.location='".$link."'\"";

	else $onClick = '';



	switch($value)

	{

		case 0: echo "<img src='".$imgsPath."white.png"."' ".$onClick."/>"; break;

		case 1: echo "<img src='".$imgsPath."green.png"."' ".$onClick."/>"; break;

		case 2: echo "<img src='".$imgsPath."yellow.png"."' ".$onClick."/>"; break;

		case 3: echo "<img src='".$imgsPath."red.png"."' ".$onClick."/>"; break;

	}

}



function printChecked($value,$compare)

{

	if($value == $compare) echo "checked";

}





function getFirstFileNameFromFolder($path)

{

	if(!is_dir($path)) return false;

	$d = dir($path) or die("Wrong path: $path");



	while (false !== ($fileName = $d->read()))

	{

		if($fileName != '.' && $fileName != '..' && !is_dir($fileName))

			return  $fileName;

	}

	return false;

}





function checkEqOriginTimeWidthOperatorType($operatorType, $origineTime, $startTime, $endTime)

{

	$origineTime =  substr($origineTime, 0, 19);

	$different = millisecsBetween(date("Y-m-d H:i:s"), $origineTime, false);

	if($different < 0)

		//header("Location: eq_list.php");

		echo "დრო კერაში მეტია მიმდინარე დროზე.\n";



	//echo '<br/>'.$operatorType;

	//echo '<br/>'.(string)(2 * 24*60*60*1000);

	if($operatorType == 3) //ყველა უფლებების მქონე ოპერატორი

		return true;

	else if(($operatorType == 1) && ($different > 2 * 24*60*60*1000)) //მიმდინარე ოპერატორი

		 {

			  header("Location: eq_list.php?error=tqven ar gaqvt am miwisdzvris redaqtirebis ufleba");

		  	 //echo("უფლება არ გაქვთთ დაამატოთ/დაარედაქტიროთ ორ დღეზე უფრო ადრინდელი მიწისძვრა.");

		 }

		 else if($operatorType == 2)

 			  {

				  if(($startTime == '0000-00-00 00:00:00') && (($endTime == '0000-00-00 00:00:00')))

				  	  //echo ". ოპერატორის საწყისი და საბოლოო დრო არ შეიძლება ორივე ერთდროულად იყოს 0000-00-00 00:00:00\n";

				  $origineTime = strtotime($origineTime);

				  $startTimeString = $startTime;

				  $endTimeString = $endTime;

				  $startTime = strtotime($startTime);

				  $endTime = strtotime($endTime);

				  if(($startTimeString != '0000-00-00 00:00:00') && (($startTimeString != '0000-00-00 00:00:00')))

				  {

					  if(($origineTime < $startTime)||($origineTime > $endTime))

						  header("Location: eq_list.php?error=tqven ar gaqvt am miwisdzvris redaqtirebis ufleba");

						  //echo ". მიწისძვრის დამატების/რედაქტირების უფლება არ გაქვთ.1111";

				  }

				  else if($startTimeString == '0000-00-00 00:00:00')

				  {

					  if($origineTime > $endTime)

					  {

						  	header("Location: eq_list.php?error=tqven ar gaqvt am miwisdzvris redaqtirebis ufleba");

						   //echo ". მიწისძვრის დამატების/რედაქტირების უფლება არ გაქვთ.222";

					  }

				  }else

				  {

					  if($origineTime < $startTime)

					  {

						   header("Location: eq_list.php?error=tqven ar gaqvt am miwisdzvris redaqtirebis ufleba");

						   //echo ". მიწისძვრის დამატების/რედაქტირების უფლება არ გაქვთ.333";

					  }

				  }

			  }

	return true;

}



function SHMtimeToPhpPlusMsec($shmTime) //7-SEP-2009_22:41:38.3 to 2009-09-07 22:41:38.3

{

	if(strlen($shmTime) < 21) return "";



	list($day, $month, $yearAndTime) = split('[-]', $shmTime);

	list($year, $time) = split('[_]', $yearAndTime);



	$day = str_pad($day, 2 , "0", STR_PAD_LEFT);

	switch($month)

	{

		case "JAN": $month = '01'; break;

		case "FEB": $month = '02'; break;

		case "MAR": $month = '03'; break;

		case "APR": $month = '04'; break;

		case "MAY": $month = '05'; break;

		case "JUN": $month = '06'; break;

		case "JUL": $month = '07'; break;

		case "AUG": $month = '08'; break;

		case "SEP": $month = '09'; break;

		case "OCT": $month = '10'; break;

		case "NOV": $month = '11'; break;

		case "DEC": $month = '12'; break;

	}



	return $year."-".$month."-".$day." ".$time;

}

?>

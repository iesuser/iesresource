<?php
# გამოაქვს ეკრანზე შეცდომები, სერვერზე გაშვებისას უნდა გავთიშოთ.
include("../block/db.php");
include("../block/globalVariables.php");
$selected_db = mysqli_select_db($db, $dbInventari);
$starttime = microtime(true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>ტურნიკეტი</title>
</head>
<body>
<pre>
	<?php
	# აბრუნებს ბოლო ჩანაწერის თარიღს, იმისთვის, რომ turnstile_record-დან წაოიღოს მხოლოდ ახალი ჩანაწერები.

		$result = mysqli_query($db, "SELECT MAX(`date_time`) FROM `turnstile_records`");
		 if (mysqli_num_rows($result) == 0) {
        	die("turnstile_records ცხრილში არ არის არცერთი ჩანაწერი");
        }
        $row =	mysqli_fetch_row($result);
        $end_date = substr($row[0], 0,10);

        $sql = "SELECT MAX(`date_time`) AS max_date FROM `turnstile_records_arranged` HAVING max_date IS NOT NULL";
		$max_date_array = mysqli_query($db, $sql) or die($sql);

		$test = mysqli_fetch_assoc($max_date_array);

		if (mysqli_num_rows($max_date_array) == 0) {
        	echo "No rows found.";
        	$max_date = '2001-01-01';
        	// print($max_date. '  ----  '. $end_date);
        }else{
	        $max_date_row = mysqli_fetch_row($max_date_array);
	        $max_date = date('Y-m-d', strtotime($max_date_row[0] . ' +1 day'));
	    }

		print($max_date. '  ----  '. $end_date);
        ?>




	<?php
		$sql =  "SELECT * FROM `turnstile_records` WHERE `date_time` > '$max_date' AND `date_time` < '$end_date'";
		$result = mysqli_query($db, $sql);

		$row = mysqli_fetch_array($result, MYSQL_ASSOC);


		// $result = mysql_query("SELECT * FROM `turnstile_records` ");
		 if (mysqli_num_rows($result) == 0) {
        	die("არსებული მონაცემები უკვე დამუშავებულია (turnstile_records_arranged) ან არ არის ახალი ჩანაწერები turnstile_records-ში");
        	// exit;
    	}
# ფუნქცია ალაგებს ჩანაწერს In/Out -ებად. ყოველ In-ს მოსდევს Out. მხოლოდ იმ In-ებს იღებს რომელსაც შემდეგი ჩანაწერი Out აქვს. (3)
    	// დასამატებელია მორიგეების ჩანაწერები, მორიგის ჩანაწერი უნდა ამოიღოს იმ შემთხვევაშიც, როც In-ის შემდეგ Out არ მოდის.
    	// ბაზაში არ არის დამატებული ველი card_number (ერთადერთ საიდენტიფიკაციო ველი ტურნიკეტის ჩანაწერიდან)
    	// ასევე პრობლემა შეიძლება შეიქმნას იმ შემთხვევაშიც თუ თანამშრომელი სამსახურიდან გავა 00:00 შემდეგ.

########################################################################################################
#    	mysql_select_db($dbStaff,$db);
#    	$staff_result = mysql_query("SELECT * FROM `staff` WHERE `position`='ღამის მორიგე'", $db);
#    	if (mysql_num_rows($staff_result) == 0) {
#        	echo "No rows found. No new records";
#        	// exit;
#    	}
########################################################################################################


function process($info){
	# წერს დალაგებულ მასივს $informacia-ში
	$informacia = array();
	foreach ($info as $key => $value){
		// $value = array_reverse($value);
		$sum = count($value);
		for ($i=0; $i < $sum; $i++) {
			$j = $i+1;
			if($j!=$sum ){
				if($value[$i]['in_out_state'] == '0' &&
				   $value[$j]['in_out_state'] == '1'){

					$informacia[$key][] = $value[$i];
					$informacia[$key][] = $value[$j];
				}
			}
		}
	}
	return $informacia;
}

# ბაზიდან იღებს მონაცემებს და წერს მასივში $myrow. (1)
$personal = array();
while ($myrow = mysqli_fetch_assoc($result)){
	if($myrow['card_number'] != '' && $myrow['card_number'] != '5457624'){
		$name = $myrow['card_number'];
		// print_r($myrow);
# ქმნის ახალ მასივს, სადაც ერთი თანამშრომლის მონაცემებს ერთ Key-ს აკუთვნებს. Name => personal	(2)
		if($name != '' && $name != ' '){
				if(!array_key_exists($name, $personal)){
					$personal[$name] = array();
				}
			$personal[$name][] = $myrow;
		}
	}
}

// print_r($personal);





# მორიგეების ჩანაწერს ყოფს შუაზე და წერს როგორც ორი დღის ჩანაწერს, I დღე - 18:00 - 23:59, II დღე - 00:01-10:00. (4)

$informacia = process($personal);

// print_r($informacia);
			foreach ($informacia as $key => $value){
				$length = count($value);
				for ($i=1; $i < $length ; $i++) {
					$j = $i+1;
					if($j != $length){
						$in = $informacia[$key][$i];  # პირველი ჩანაწერი
						$out = $informacia[$key][$j]; # შემდეგი
						// print_r($out);
						// exit;
						if($informacia[$key][$i]['in_out_state'] == '0' &&
							$informacia[$key][$j]['in_out_state'] == '1'){
							if(substr($informacia[$key][$i]['date_time'],0,10) != substr($informacia[$key][$j]['date_time'],0,10)){
							# ქმნის მასივის კლონს, რომ ჩაამატოს მორიგის გაწყვეტილ ჩანაწერში ორი ახალი მასივი.
								$out_clone = (array)clone(object)$out;
								$in_clone = (array)clone(object)$in;
								$date_out = substr($informacia[$key][$i]['date_time'],0,10).' 23:59:00';
								$date_in = substr($informacia[$key][$j]['date_time'],0,10).' 00:01:00';
								$out_clone = str_replace($out_clone['date_time'], $date_out, $out_clone);
								$in_clone = str_replace($in_clone['date_time'], $date_in, $in_clone);
								$out_clone = array($out_clone);
								$in_clone = array($in_clone);
								array_splice($informacia[$key], $j, 0, $out_clone);
								array_splice($informacia[$key], $j+1, 0, $in_clone);
							# უმატებს length-ს 2-ს, რადგან ყოველი ჩამატების შემდეგ მასივის სიგრძე იმატებს ორით და ციკლს ბოლომდე არ გადის.
								$length +=2;
							}
						}
					}
				}
			}

		#ეს ფუნქცია ქმნის მასივს, სადაც ყოველ თანამშრომელს აქვს მნიშვნელობად თარიღი და თარიღს აქვს მნიშვნელობად წასვლა-მოსვლის საათები (იმ დღის) Name => 21/07/2017 => 10:00, 13:00, 14:00, 18:00. (6)
		function create_time_array($array){
			$time_array = array();
			foreach ($array as $key => $value){
				$length = count($value);
				for ($i=0; $i < $length ; $i++){
					$j = $i+1;
					if($j != $length){
						$date = substr($value[$i]['date_time'], 0,10);
						$next_date = substr($value[$j]['date_time'], 0,10);
						if($date == $next_date
							&& $value[$i]['in_out_state'] == '0'
							&& $value[$j]['in_out_state'] == '1'){
							if(!array_key_exists($key, $time_array)){
								$time_array[$key] = array();
							}
							if(!array_key_exists($date, $time_array[$key])){
								$time_array[$key][$date] = array();
							}
								$time_array[$key][$date][] = $value[$i]['date_time'];
								$time_array[$key][$date][] = $value[$j]['date_time'];
							# ასწორებს ინდექსის ნომრებს
							 $time_array[$key][$date] = array_values($time_array[$key][$date]);
						}
					}
				}
			}
			return $time_array;
		}


$date_time = create_time_array($informacia);
	# ფუნქცია ითვლის წასვლისა და მოსვლის დროებს შორის სხვაობებს. (7)
		function time_calc($time_array){
			global $db;
			$sql_query_header = "INSERT INTO `turnstile_records_arranged` (`date_time`, `card_number`, `on_duty`, `off_duty`,`in_time`,`out_time`) VALUES ";
			$sql_query_values = "";
			$values_count = 0;
			foreach ($time_array as $key => $value){
				$length = count($value);
				$card_number = $key;
				foreach ($value as $date => $n){
					$count_n = count($n);

					# დღის განმავლობაში პირველი შემოსვლისა და ბოლო გასვლის საათები.
					$in_time = $n[0];
					$out_time = $n[$count_n - 1];
					# სხვაობა პირველ შემოსვლასა და ბოლო გასვლას შორის (სამსახურში გატარებული დრო, შესვენების გარეშე)
					$total_time = date_diff(date_create($out_time), date_create($in_time));
					$total_time_str = $total_time->format("%H:%I:%S");
					# სამსახურში გატარებული დროის რაოდენობა შესვენებთან ერთად.
					$sum_time = new DateTime('00:00:00');
					$e = clone $sum_time;
					for ($i=0; $i < count($n)-1; $i++) {
						$j = $i+1;
						if($i%2==0){
							$diff_time = date_diff(date_create($n[$j]), date_create($n[$i]));
							$sum_time->add($diff_time);
						}
					}
					$work_time = $e->diff($sum_time);
					$work_time_str = $work_time->format("%H:%I:%S");
					# სამსახურში ყოფნის პერიოდი შესვენაზე გასვლის გათვალისწინებით.
					$sql_in_time = substr($in_time, 11);
					$sql_out_time = substr($out_time, 11);
					$on_duty = $work_time->format("%H:%I:%S");
					$off_duty = date_diff(date_create($total_time_str), date_create($work_time_str))->format('%H:%I:%S');
					# წერს მონაცეებს ბაზაში

					if($sql_query_values != ''){
						$sql_query_values .= ", ";
					}
					$sql_query_values .= "( '" . $date . "', '" . $card_number . "', '" . $on_duty . "', '" . $off_duty . "', '" . $sql_in_time . "', '" . $sql_out_time. "')";
					$values_count += 1;

					if($values_count > 5000){
						$sql_query = $sql_query_header . $sql_query_values;
						mysqli_query($db, $sql_query);
						echo $sql_query;
						$sql_query_values = "";
						$values_count = 0;
					}
				}

			}

			if ($values_count > 0){
				$sql_query = $sql_query_header . $sql_query_values;
				mysqli_query($db, $sql_query);
			}
		}




time_calc($date_time);
$endtime = microtime(true);
$duration = $endtime - $starttime;
print("<br>".$duration);
exit;
?>
</pre>
</body>
</html>

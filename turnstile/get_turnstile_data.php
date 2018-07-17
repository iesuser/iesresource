<?php
# ბაზაში staff ცხრილში card_number-ს აქვს ბოლოში ახალხაზზე გადასვლა ჩამატებული

include 'ChromePhp.php';
include("../block/globalVariables.php");
include("../block/db.php");

mysqli_select_db ($db, $dbStaff);

# შევამოწმოთ POST -ით გადმოცემულია თუ არა პარამეტრები რის მიხედვითად უნდა დავაბრუნოთ მონაცემები
if (!isset($_POST["start_date"]) or !isset($_POST["end_date"]) or !isset($_POST["row_count"]) or
    !isset($_POST["employee"]) or !isset($_POST["laboratory"]) or !isset($_POST["department"]) or
    !isset($_POST["filter_date_frequency"]) or !isset($_POST["page"])){
    die("Error: missing post data");
}

$start_date = $_POST["start_date"];
$end_date = $_POST["end_date"];
$row_count = $_POST["row_count"];
$employee = $_POST["employee"];
$laboratory = $_POST["laboratory"];
$department = $_POST["department"];
$filter_date_frequency = $_POST["filter_date_frequency"];
$page = $_POST["page"];

# საწყისი თარიღი თუ არ არის მითითებული ავიღოთ ბაზიდან პირველი ჩანაწერი
if($start_date == "") {
    $result = mysqli_query($db, 'SELECT * FROM turnstile_records_arranged ORDER BY id ASC LIMIT 1');
    $start_date = mysqli_fetch_assoc($result)['date_time'];
}

# დასასრული თარიღი თუ არ არის მითითებული ავიღოთ ბაზიდან ბოლო ჩანაწერი
if($end_date == "") {
    $result = mysqli_query($db, 'SELECT * FROM turnstile_records_arranged ORDER BY id DESC LIMIT 1');
    $end_date =  mysqli_fetch_assoc($result)['date_time'];
}


if ($filter_date_frequency != 'day'){
    change_start_and_end_date($filter_date_frequency, $start_date, $end_date);
}

function change_start_and_end_date($filter_date_frequency, &$start_date, &$end_date){
    $start_date = new DateTime($start_date);
    $end_date = new DateTime($end_date);

    if($filter_date_frequency == "week"){
        $start_date_week_day = $start_date->format('N');
        if($start_date_week_day != 1){
            $start_date->modify('-'.(string)($start_date_week_day - 1).' day');
        }
        $start_date = $start_date->format('Y-m-d');

        $end_date_week_day = $end_date->format('N');
        if($end_date_week_day != 7){
            $end_date->modify('+'.(string)(7 - $end_date_week_day).' day');
        }
        $end_date = $end_date->format('Y-m-d');
    }elseif($filter_date_frequency == "month"){
        $start_date = $start_date->format('Y-m-01');

        $days_in_month = cal_days_in_month(CAL_GREGORIAN, (int) $end_date->format('m'), (int) $end_date->format('Y'));
        $end_date = $end_date->format('Y-m-').$days_in_month;
    }
}


# ფუნქცია აბრუნებს $start_date დან დაწყებული მერემდენე კვირაში/თვეში ხვდება $current_date
function get_index_of_week_or_month($week_or_month, $start_date, $current_date){
    $start_date = new DateTime($start_date);
    $current_date = new DateTime($current_date);

    if($week_or_month == "week"){
        # განსხვავება დღეებში $start_date სა და $current_date-ს შორის
        $diff = $start_date->diff($current_date)->days + 1;
        #კვირის რომელი დღეა $start_date-ი
        $day_of_week = $start_date->format('N');
        $first_week_days_count = 8 - $day_of_week;

        # თუ start_date არის ორშაბათი
        if ($day_of_week == 1){
            return ceil($diff / 7);
        }else{
            return ceil(($diff - $first_week_days_count) / 7) + 1;
        }
    }else{
        $start_date_year = (int) $start_date->format('Y');
        $start_date_month = (int) $start_date->format('m');

        $current_date_year = (int) $current_date->format('Y');
        $current_date_month = (int) $current_date->format('m');

        return (($current_date_year - $start_date_year) * 12) + ($current_date_month - $start_date_month) + 1;
    }
}


$staff_query_where = "";
if ($department != '') $staff_query_where .= " AND dep_id = '$department' ";
if ($laboratory != '') $staff_query_where .= " AND gr_lb_id = '$laboratory' ";
if ($employee != '')   $staff_query_where .= " AND staff.id = '$employee' ";


$result = mysqli_query($db, "SELECT turnstile_records_arranged.*
                             FROM turnstile_records_arranged
                             LEFT JOIN staff ON turnstile_records_arranged.card_number = staff.card_number
                             WHERE date_time >= '$start_date' AND date_time < '$end_date' ".$staff_query_where."
                             ORDER BY date_time ASC");




$employees = array();
$staff = mysqli_query($db, "SELECT first_name, last_name, card_number FROM staff WHERE card_number != '' ".$staff_query_where);

while($employee = mysqli_fetch_assoc($staff)){
    $employees[$employee['card_number']] = $employee['last_name']." ".$employee['first_name'];
}


function get_staff_fullname($card_number){
    global $employees;
    if(isset($employees[$card_number])){
        return $employees[$card_number];
    }else
        return $card_number;
}


$calculated_data = array();
$date_start = new DateTime($start_date);
$date_end = new DateTime($end_date);
$date_interval = DateInterval::createFromDateString('1 day');
$date_period = new DatePeriod($date_start, $date_interval, $date_end);
$data = array();

if  ($filter_date_frequency != 'day'){
    # წავიკითხოთ ბაზიდან მონაცემები და შევავსოთ $data მასივი ორგანიზებულად
    while ($row = mysqli_fetch_assoc($result)){
        $card_number = trim($row['card_number']);
        $date_time   = trim($row['date_time']);
        if ($card_number == "") continue;
        if ($date_time   == "") continue;
        $week_or_month_index = get_index_of_week_or_month($filter_date_frequency, $start_date, $row['date_time']);
        if (!array_key_exists ((string) $week_or_month_index , $data)){
            $data[$week_or_month_index] = array();
        }

        if (!array_key_exists ($card_number, $data[$week_or_month_index])){
            $data[$week_or_month_index][$card_number] = array();
        }

        if (!array_key_exists ($date_time, $data[$week_or_month_index][$card_number])){
            $data[$week_or_month_index][$card_number][$date_time] = array();
        }

        $data[$week_or_month_index][$card_number][$date_time]['on_duty']  = $row['on_duty'];
        $data[$week_or_month_index][$card_number][$date_time]['off_duty'] = $row['off_duty'];
        $data[$week_or_month_index][$card_number][$date_time]['in_time']  = $row['in_time'];
        $data[$week_or_month_index][$card_number][$date_time]['out_time'] = $row['out_time'];
    }



    $result = mysqli_query($db, "SELECT card_number
                                 FROM staff
                                 WHERE card_number != '' ".$staff_query_where."
                                 ORDER BY dep_id ASC");


    while ($row = mysqli_fetch_assoc($result)){
        $card_number = trim($row['card_number']);

        $previews_week_or_month_index = -1;
        #$dt ღებულონს მნიშვნელობებს $start_date -დან დაწყებული $end_date-მდე თითოეული დღის თარიღს
        foreach ($date_period as $dt){
            $dt_str = $dt->format("Y-m-d");
            $current_week_or_month_index = get_index_of_week_or_month($filter_date_frequency, $start_date, $dt_str);
            if ($current_week_or_month_index != $previews_week_or_month_index){

                $calculated_row = array();
                if(isset($data[$current_week_or_month_index][$card_number])){
                    $on_duties = array();
                    $off_duties = array();
                    $in_times = array();
                    $out_times = array();
                    foreach ($data[$current_week_or_month_index][$card_number] as $date => $values){
                        $on_duties[] = '1970-01-01 '.$data[$current_week_or_month_index][$card_number][$date]['on_duty'];
                        $off_duties[] = '1970-01-01 '.$data[$current_week_or_month_index][$card_number][$date]['off_duty'];
                        $in_times[] = '1970-01-01 '.$data[$current_week_or_month_index][$card_number][$date]['in_time'];
                        $out_times[] = '1970-01-01 '.$data[$current_week_or_month_index][$card_number][$date]['out_time'];
                    }

                    if($filter_date_frequency == "week"){
                        $work_days_count = 5;
                    }else if($filter_date_frequency == "month"){
                        $work_days_count = get_work_days_count_in_month((int)$dt->format("Y"), (int)$dt->format("m"), array(0, 6));
                    }

                    $calculated_row["card_number"] = get_staff_fullname($card_number);
                    $calculated_row["on_duty"] = date('H:i:s', array_sum(array_map('strtotime', $on_duties)) / $work_days_count);
                    
                    // print_r($on_duties);

                    // print "<br>".strtotime('1970-01-01 16:15:08');
                    // print "<br>".date('Y-m-d H:i:s', strtotime('16:15:08'));
                    // print "<br>".date('H:i:s', array_sum(array_map('strtotime', $on_duties)));
                    // print "<br>".$work_days_count;
                    // print "<br>".$calculated_row["on_duty"];
                    // die("stop");
                    $calculated_row["off_duty"] = date('H:i:s', array_sum(array_map('strtotime', $off_duties)) / $work_days_count);
                    $calculated_row["in_time"] = date('H:i:s', array_sum(array_map('strtotime', $in_times)) / count($in_times));
                    $calculated_row["out_time"] = date('H:i:s', array_sum(array_map('strtotime', $out_times)) / count($out_times));
                    $calculated_row["date"] = $dt_str;
                    $calculated_data[] = $calculated_row;


                }else{
                    $calculated_row["card_number"] = get_staff_fullname($card_number);
                    $calculated_row["date"] = $dt_str;
                    $calculated_row["on_duty"] = "00:00:00";
                    $calculated_row["off_duty"] = "00:00:00";
                    $calculated_row["in_time"] = "00:00:00";
                    $calculated_row["out_time"] = "00:00:00";
                    $calculated_data[] = $calculated_row;
                }
            }

            $previews_week_or_month_index = $current_week_or_month_index;
        }

    }
}else{
    #მონაცემების დღიურად წაკითვა

    while ($row = mysqli_fetch_assoc($result)){
        $card_number = trim($row['card_number']);
        $date_time   = trim($row['date_time']);
        if ($card_number == "") continue;
        if ($date_time   == "") continue;

        if (!isset($data[$card_number])){
            $data[$card_number] = array();
        }

        if(!isset($data[$card_number][$date_time])){
            $data[$card_number][$date_time] = array();
        }

        $data[$card_number][$date_time]['on_duty']  = $row['on_duty'];
        $data[$card_number][$date_time]['off_duty'] = $row['off_duty'];
        $data[$card_number][$date_time]['in_time']  = $row['in_time'];
        $data[$card_number][$date_time]['out_time'] = $row['out_time'];
    }

    $result = mysqli_query($db, "SELECT card_number
                                 FROM staff
                                 WHERE card_number != '' ".$staff_query_where."
                                 ORDER BY dep_id ASC");

    while ($row = mysqli_fetch_assoc($result)){
        $card_number = trim($row['card_number']);

        foreach ($date_period as $dt){
            $dt_str = $dt->format("Y-m-d");
            $calculated_row = array();
            if(isset($data[$card_number][$dt_str])){
                $calculated_row["card_number"] = get_staff_fullname($card_number);
                $calculated_row["date"] = $dt_str;
                $calculated_row["on_duty"]  = $data[$card_number][$dt_str]["on_duty"];
                $calculated_row["off_duty"] = $data[$card_number][$dt_str]["off_duty"];
                $calculated_row["in_time"]  = $data[$card_number][$dt_str]["in_time"];
                $calculated_row["out_time"] = $data[$card_number][$dt_str]["out_time"];
                $calculated_data[] = $calculated_row;
            }else{
                $calculated_row["card_number"] = get_staff_fullname($card_number);
                $calculated_row["date"] = $dt_str;
                $calculated_row["on_duty"] = "00:00:00";
                $calculated_row["off_duty"] = "00:00:00";
                $calculated_row["in_time"] = "00:00:00";
                $calculated_row["out_time"] = "00:00:00";
                $calculated_data[] = $calculated_row;
            }
        }
    }
}



function get_work_days_count_in_month($year, $month, $ignore) {
    $count = 0;
    $counter = mktime(0, 0, 0, $month, 1, $year);
    while (date("n", $counter) == $month) {
        if (in_array(date("w", $counter), $ignore) == false) {
            $count++;
        }
        $counter = strtotime("+1 day", $counter);
    }
    return $count;
}

// echo "=======================================================================================";
// print "<pre>";
// print_r($data);
// print "</pre>";


// innitialize html text in variables
$yofnis_dro = "სამსახურში ყოფნის დრო";
$shesvenebaze_dro = "შესვენებაზე ყოფნის დრო";
$mosvlis_dro = "მოსვლის დრო";
$wasvlis_dro = "გასვლის დრო";
// davwerot sashualo tu kvira an tve aris archeuli
if(isset($_POST['filter_date_frequency'])) {
  if ($filter_date_frequency == "week" || $filter_date_frequency == "month") {
      $yofnis_dro = $yofnis_dro." (საშუალო)";
      $shesvenebaze_dro = $shesvenebaze_dro." (საშუალო)";
      $mosvlis_dro = $mosvlis_dro." (საშუალო)";
      $wasvlis_dro = $wasvlis_dro." (საშუალო)";
    }
  }
?>
<!-- <ul id="sync-pagination" class="pagination"></ul> -->
<table id="turnstile-result-table" class="table table-sm table-bordered table-striped table-hover text-center align-middle">
  <thead>
  <tr>
    <th>#</th>
    <th>თანამშრომელი</th>
    <?php echo "<th style='min-width:110px'>თარიღი</th>"; ?>
    <th><?php echo $yofnis_dro; ?></th>
    <th><?php echo $shesvenebaze_dro; ?></th>
    <th><?php echo $mosvlis_dro; ?></th>
    <th><?php echo $wasvlis_dro; ?></th>
  </tr>
  </thead>
  <tbody>
  <?php
    $page_st_index = ($page - 1) * $row_count;
    $page_end_index = $page * $row_count;

    $count_calculated_data = count($calculated_data);
    if($page_end_index > $count_calculated_data){
      $page_end_index = $count_calculated_data;
    }

    
    for ($i = $page_st_index; $i < $page_end_index ; $i++) {
      echo "<tr>";
      echo "<td>".($i + 1)."</td>";
      echo "<td>".$calculated_data[$i]['card_number']."</td>";
      echo "<td>".$calculated_data[$i]['date']."</td>";
      echo "<td>".$calculated_data[$i]['on_duty']."</td>";
      echo "<td>".$calculated_data[$i]['off_duty']."</td>";
      echo "<td>".$calculated_data[$i]['in_time']."</td>";
      echo "<td>".$calculated_data[$i]['out_time']."</td>";
      echo "</tr>";
    }
    $pages = ceil(sizeof($calculated_data) / $row_count);
   ?>
  </tbody>
</table>

<ul id="sync-pagination" class="pagination justify-content-center"></ul>

<script type="text/javascript">
$('.pagination').twbsPagination({
      totalPages: <?php echo $pages;?>,
      visiblePages: 7,
      startPage: <?php echo $page;?>,
      initiateStartPageClick: false,
      onPageClick: function (event, page) {
          // $('#page-content').text('Page ' + page);
          console.log('onPageClick')
          date_filter(page)
      }
    });
</script>


<br><br><br><br><br>

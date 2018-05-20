<?php
include 'ChromePhp.php';
include("../block/globalVariables.php");
include("../block/db.php");


if(isset($_POST['start_date']) and isset($_POST['end_date'])){ //არის თუ არა მითითებული საწყისი და საბოლოო თარიღი
  $start_date = $_POST['start_date'];
  $end_date = $_POST['end_date'];
}
if (isset($_POST['row_count'])){ // არის თუ არა მითითებული ჩანაწერების რაოდენობა
  $row_count = $_POST['row_count'];
}else{
  $row_count = 100;
}

// PAGE TEST
if (isset($_POST['page'])){
    //ChromePhp::log("this is the current page".$_POST['page']);
    $page = $_POST['page'];
  } else {
  
    $page = 1; 
  }


// საწყისი და საბოლოო თარიღის სხვადასხვა ვარიანტები
  if(!empty($start_date) and !empty($end_date)){
    $where = " `date_time` >= '$start_date' and `date_time` <= '$end_date' ";
    $date_1 = strtotime($start_date);
    $date_2 = strtotime($end_date);
    $dw = date("w", $date_1);
    $mo = date("m", $date_1);
    //ChromePhp::log($dw);
    //ChromePhp::log($mo);
  }
  elseif (!empty($start_date) and empty($end_date)) {
    $where = " `date_time` >= '$start_date' ";
  }
  elseif(empty($start_date) and !empty($end_date)){
    $where = " `date_time` <= '$end_date' ";

  }
  else{
     $where = " 1 ";
  }

  // DAMATEBULI
  if(isset($_POST['employee']))
  {
    $employee = intval($_POST['employee']);
  }

  if(isset($_POST['laboratory']))
  {
    $laboratory = intval($_POST['laboratory']);
  }

  if(isset($_POST['department']))
  {
    $department = intval($_POST['department']);
  }



  $yofnis_dro = "სამსახურში ყოფნის დრო";
  $shesvenebaze_dro = "შესვენებაზე ყოფნის დრო";
  $mosvlis_dro = "მოსვლის დრო";
  $wasvlis_dro = "წასვლის დრო";
  $edit_tarigi_html = "<th>თარიღი</th>";
  $month_week = 0;

  // დღეების კვირების და თვეების მიხედვით ფილტრი
  if(isset($_POST['filter_date_frequency'])) {
     $filter_date_frequency = $_POST['filter_date_frequency'];
    if ($filter_date_frequency == "week" || $filter_date_frequency == "month") {
        if ($filter_date_frequency == "week")
            $edit_tarigi_html = '<th>კვირა</th>';
        else if ($filter_date_frequency == "month")
            $edit_tarigi_html = '<th>თვე</th>';
        $yofnis_dro = $yofnis_dro."(საშუალო)";
        $shesvenebaze_dro = $shesvenebaze_dro."(საშუალო)";
        $mosvlis_dro = $mosvlis_dro."(საშუალო)";
        $wasvlis_dro = $wasvlis_dro."(საშუალო)";
        if ($filter_date_frequency == "week")
        {
          $month_week = 7;
        } else {
          $month_week = 30;
        }

    } else {
      $edit_tarigi_html = '<th>თარიღი</th>';
    }
  }

   //Calculating the weeks/months from given dates
   $week_month_main_array = array();
  if(isset($_POST['filter_date_frequency']))
  {
      
      if ($filter_date_frequency == "week")
      { 
        
      
        if(isset($_POST['start_date']) and isset($_POST['end_date']))
        {
          $from = new DateTime($start_date);
          $to   = new DateTime($end_date);
          $dif = $from->diff($to)->days;
          //ChromePhp::log("the difference is " . $dif);
          $next_days = new DateTime($start_date);
          $weeks = array();
          $one_week = array();
          $add_week = false;

////////////// STAGE 1
          if ($from->format('w') == 0)
          {
            date_add($next_days,date_interval_create_from_date_string("1 day"));
          } else if ($from->format('w') == 2)
          { 
            if ($dif >= 6)
            {
              array_push($one_week, date_format($next_days, 'Y-m-d'));
              array_push($one_week, date_format(date_add($next_days,date_interval_create_from_date_string("1 day")), 'Y-m-d')); 
              array_push($one_week, date_format(date_add($next_days,date_interval_create_from_date_string("1 day")), 'Y-m-d'));
              array_push($one_week, date_format(date_add($next_days,date_interval_create_from_date_string("1 day")), 'Y-m-d'));
              date_add($next_days,date_interval_create_from_date_string("3 days"));
              array_push($weeks, $one_week);
              $one_week = array();
              $add_week = true;
            } else {
              for ($m = 0; $m <= $dif; $m++)
              {
                if ($next_days->format('w') == 6)
                {
                  $add_week = true;
                  break;
                } else {
                  array_push($one_week, date_format($next_days, 'Y-m-d'));
                  date_add($next_days,date_interval_create_from_date_string("1 day"));
                }
              }
              array_push($weeks, $one_week);
              $one_week = array();
            }
          } else if ($from->format('w') == 3)
          {
              if ($dif >= 5)
              {
                array_push($one_week, date_format($next_days, 'Y-m-d'));
                array_push($one_week, date_format(date_add($next_days,date_interval_create_from_date_string("1 day")), 'Y-m-d')); 
                array_push($one_week, date_format(date_add($next_days,date_interval_create_from_date_string("1 day")), 'Y-m-d'));
                date_add($next_days,date_interval_create_from_date_string("3 days"));
                array_push($weeks, $one_week);
                $one_week = array();
                $add_week = true;
              } else {
              for ($m = 0; $m <= $dif; $m++)
              {
                if ($next_days->format('w') == 6)
                {
                  //date_sub($next_days,date_interval_create_from_date_string("1 day"));
                  $add_week = true;
                  break;
                } else {
                  array_push($one_week, date_format($next_days, 'Y-m-d'));
                  date_add($next_days,date_interval_create_from_date_string("1 day"));
                }
              }
              array_push($weeks, $one_week);
              $one_week = array();
            }
          } else if ($from->format('w') == 4)
          {
            if ($dif >= 4)
              {
                array_push($one_week, date_format($next_days, 'Y-m-d'));
                array_push($one_week, date_format(date_add($next_days,date_interval_create_from_date_string("1 day")), 'Y-m-d')); 
                date_add($next_days,date_interval_create_from_date_string("3 days"));
                array_push($weeks, $one_week);
                $one_week = array();
                $add_week = true;
              }  else {
              for ($m = 0; $m <= $dif; $m++)
              {
                if ($next_days->format('w') == 6)
                {
                 // date_sub($next_days,date_interval_create_from_date_string("1 day"));
                  $add_week = true;
                  break;
                } else {
                  array_push($one_week, date_format($next_days, 'Y-m-d'));
                  date_add($next_days,date_interval_create_from_date_string("1 day"));
                }
              }
              array_push($weeks, $one_week);
              $one_week = array();
            }
          } else if ($from->format('w') == 5)
            {  
              if ($dif >= 3)
                {
                array_push($one_week, date_format($next_days, 'Y-m-d'));
                date_add($next_days,date_interval_create_from_date_string("3 days"));
                array_push($weeks, $one_week);
                $one_week = array();
                $add_week = true;
              }  else {
              for ($m = 0; $m <= $dif; $m++)
              {
                if ($next_days->format('w') == 6)
                {
                  //date_sub($next_days,date_interval_create_from_date_string("1 day"));
                  $add_week = true;
                  break;
                } else {
                  array_push($one_week, date_format($next_days, 'Y-m-d'));
                  date_add($next_days,date_interval_create_from_date_string("1 day"));
                }
              }
              array_push($weeks, $one_week);
              $one_week = array();
            }
          } else if ($from->format('w') == 6 && $dif >= 2)
          {
            date_add($next_days,date_interval_create_from_date_string("2 days")); 
            $add_week = true;
          } else if ($from->format('w') == 1 || $dif < 7)
              $add_week = true;



///////////////////////////////////////////////////

//////////////////// STAGE 2

          if ($next_days->diff($to)->days >= 6)
          {
              //ChromePhp::log($next_days->diff($to)->days);
            if ($next_days->diff($to)->days == 6)
            {
              array_push($one_week, date_format($next_days, 'Y-m-d'));
              array_push($one_week, date_format(date_add($next_days,date_interval_create_from_date_string("1 day")), 'Y-m-d')); 
              array_push($one_week, date_format(date_add($next_days,date_interval_create_from_date_string("1 day")), 'Y-m-d'));
              array_push($one_week, date_format(date_add($next_days,date_interval_create_from_date_string("1 day")), 'Y-m-d'));
              array_push($one_week, date_format(date_add($next_days,date_interval_create_from_date_string("1 day")), 'Y-m-d'));
              array_push($weeks, $one_week);
              $one_week = array();
            } else if($next_days->diff($to)->days > 6){
               //ChromePhp::log(date_format($next_days, 'Y-m-d'));
              $rng = $next_days->diff($to)->days / 7;
              $rng2 = $next_days->diff($to)->days % 7;
              for ($i = 0; $i < floor($rng); $i++)
              {
                 array_push($one_week, date_format($next_days, 'Y-m-d'));
                 array_push($one_week, date_format(date_add($next_days,date_interval_create_from_date_string("1 day")), 'Y-m-d')); 
                 array_push($one_week, date_format(date_add($next_days,date_interval_create_from_date_string("1 day")), 'Y-m-d'));
                 array_push($one_week, date_format(date_add($next_days,date_interval_create_from_date_string("1 day")), 'Y-m-d'));
                 array_push($one_week, date_format(date_add($next_days,date_interval_create_from_date_string("1 day")), 'Y-m-d'));
                 date_add($next_days,date_interval_create_from_date_string("3 days"));
                 //ChromePhp::log(date_format($next_days, 'Y-m-d'));
                 array_push($weeks, $one_week);
                 $one_week = array();
              }
              //date_add($next_days,date_interval_create_from_date_string("3 days"));
              //ChromePhp::log(date_format($next_days, 'Y-m-d'));
              //ChromePhp::log("yes");
              if($next_days->diff($to)->days >= 0)
              {
                //ChromePhp::log("gela");
                  for ($k = 0; $k <= $rng2; $k++)
                  {
                    if ($next_days->format('w') == 6 || $next_days->format('w') == 0)
                    {
                      break;
                    } else {
                      array_push($one_week, date_format($next_days, 'Y-m-d'));
                      date_add($next_days,date_interval_create_from_date_string("1 day"));
                    }
                  }
                  if (!empty($one_week))
                  array_push($weeks, $one_week);
              }

            }
          } else {
            //ChromePhp::log($next_days->diff($to)->days);
              if ($add_week)
              {
                   $rng3 = $next_days->diff($to)->days;
                   //ChromePhp::log($next_days);
                   for ($k = 0; $k <= $rng3; $k++)
                   {
                    if ($next_days->format('w') == 6 || $next_days->format('w') == 0)
                    {
                      break;
                    } else {
                      array_push($one_week, date_format($next_days, 'Y-m-d'));
                      date_add($next_days,date_interval_create_from_date_string("1 day"));
                    }
                   }
                   if (!empty($one_week))
                      array_push($weeks, $one_week);
              }
               //ChromePhp::log($next_days);
          }
          /*
          while ($next_days->diff($to)->days <= $dif)
          {
            
            $dif_2 = $next_days->diff($to)->days;
            
            if ($next_days->format('w') != 0 && $next_days->format('w') != 6)
            {
              $add_week = true;
              ChromePhp::log("dif 1: " . $dif . ", dif 2: " . $dif_2);
              ChromePhp::log("this is a working day! " . date_format($next_days, 'Y-m-d'));
            }
            if ($add_week)
              array_push($one_week, date_format($next_days, 'Y-m-d'));
            if ($next_days->format('w') == 5 && $add_week)
            {
              array_push($weeks, $one_week);
              $add_week = false;
              $one_week = array();
            }
            ChromePhp::log($one_week);
            date_add($next_days,date_interval_create_from_date_string("1 day"));
            ChromePhp::log("this is dif 2: " . $dif_2);
            if ($dif_2 == 0)
            {
              array_push($weeks, $one_week);
              break;
            }
          } */
          //ChromePhp::log($weeks);
          //var_dump($weeks);
          $week_month_main_array = $weeks;
          $pages = ceil(sizeof($week_month_main_array) / $row_count); 
        }
      }
  }



?>


<style>
  .affix {
      top: 0;
      width: 100%;
      z-index: 9999 !important;
  }

  .affix + .container-fluid {
      padding-top: 70px;
  }
</style>

<!-- სახელების ძიება ცხრილში (HTML - input) -->
<input type="text" id="search" onkeyup="table_search()" placeholder="ძიება ცხრილში" title="Type in a name" class="form-control" style="margin-left:14px; width:156px; height: 25px; padding: 0">
 <div class="row">
    <div class="col-md-12">
      <!-- ცხრილი -->
      <table style="margin-top: 100px;" class="table table-bordered" id="result_table">


        <tr style="background: #bbccff;" id="theader">
          <th>თანამშრომელი</th>
          <?php echo $edit_tarigi_html; ?>
         <!-- <th>თარიღი</th> -->
          <th>ბარათის ნომერი</th>
          <th><?php echo $yofnis_dro; ?></th>
          <th><?php echo $shesvenebaze_dro; ?></th>
          <th><?php echo $mosvlis_dro; ?></th>
          <th><?php echo $wasvlis_dro; ?></th>
        </tr>

    <?php 

    # mysql ორი ცხრილის გაერთიანება.

    if (!empty($employee)){
      $result = mysqli_query($db, "SELECT ies_staff.staff.first_name, ies_staff.staff.last_name, ies_inventari.turnstile_records_arranged.*
                            FROM ies_staff.staff LEFT JOIN ies_inventari.turnstile_records_arranged
                            ON ies_staff.staff.card_number = ies_inventari.turnstile_records_arranged.card_number WHERE ies_staff.staff.id = $employee AND $where ORDER BY `date_time` DESC");
      if ($filter_date_frequency == "week" || $filter_date_frequency == "month"){
      $query = mysqli_query($db, "SELECT ies_staff.staff.first_name, ies_staff.staff.last_name, ies_staff.staff.card_number FROM ies_staff.staff WHERE ies_staff.staff.id = $employee");
      } 
    } else if (!empty($laboratory)){
      $result = mysqli_query($db, "SELECT ies_staff.staff.first_name, ies_staff.staff.last_name, ies_inventari.turnstile_records_arranged.*
                            FROM ies_staff.staff LEFT JOIN ies_inventari.turnstile_records_arranged
                            ON ies_staff.staff.card_number = ies_inventari.turnstile_records_arranged.card_number WHERE ies_staff.staff.gr_lb_id = $laboratory AND $where ORDER BY `date_time` DESC");
      if ($filter_date_frequency == "week" || $filter_date_frequency == "month"){
      $query = mysqli_query($db, "SELECT ies_staff.staff.first_name, ies_staff.staff.last_name, ies_staff.staff.card_number FROM ies_staff.staff WHERE ies_staff.staff.gr_lb_id = $laboratory");
      } 
    } else if (!empty($department)){
      $result = mysqli_query($db, "SELECT ies_staff.staff.first_name, ies_staff.staff.last_name, ies_inventari.turnstile_records_arranged.*
                            FROM ies_staff.staff LEFT JOIN ies_inventari.turnstile_records_arranged
                            ON ies_staff.staff.card_number = ies_inventari.turnstile_records_arranged.card_number WHERE ies_staff.staff.dep_id = $department AND $where ORDER BY `date_time` DESC");
       if ($filter_date_frequency == "week" || $filter_date_frequency == "month"){
      $query = mysqli_query($db, "SELECT ies_staff.staff.first_name, ies_staff.staff.last_name, ies_staff.staff.card_number FROM ies_staff.staff WHERE ies_staff.staff.dep_id = $department");
      } 
    } else
    {
      $result = mysqli_query($db, "SELECT ies_staff.staff.first_name, ies_staff.staff.last_name, ies_inventari.turnstile_records_arranged.*
                            FROM ies_staff.staff LEFT JOIN ies_inventari.turnstile_records_arranged
                            ON ies_staff.staff.card_number = ies_inventari.turnstile_records_arranged.card_number WHERE $where ORDER BY `date_time` DESC");
       if ($filter_date_frequency == "week" || $filter_date_frequency == "month"){
       $query = mysqli_query($db, "SELECT ies_staff.staff.first_name, ies_staff.staff.last_name, ies_staff.staff.card_number FROM ies_staff.staff");
      } 
    }

    if (mysqli_num_rows($result) == 0) {
      echo "ჩანაწერი არ მოიძებნა. ";
      exit;
    }

///////////////// TEST  ///////////////////////
    $all_cards = array(); // array where all card numbers are stored
    function add_zero(&$str)
    {
        if(strlen($str) == 1)
        {
          $str = "0".$str;
        }
    }
    


    // preparing array
    if(isset($_POST['filter_date_frequency']))
    {
        if ($filter_date_frequency == "week" || $filter_date_frequency == "month")
        {
            $week_month_main_array_temp = $week_month_main_array;
            for ($i = 0; $i < sizeof($week_month_main_array_temp); $i++)
            {
              for ($k = 0; $k < sizeof($week_month_main_array_temp[$i]); $k++)
              {
                $week_month_main_array_temp[$i][$k] = "00:00:00";
              }
            }
            //ChromePhp::log($week_month_main_array_temp);
        }
    }


    $arr = array(); // all data is stored in this array
    if(isset($_POST['filter_date_frequency']))
    {
      if ($filter_date_frequency == "week" || $filter_date_frequency == "month")
       {
          // storing array with every chosen employee
          while ($row = mysqli_fetch_assoc($query)){
                if ($row['card_number'] != "")
                {
                          $arr[$row['card_number']]['first_name'] = $row['first_name'];
                          $arr[$row['card_number']]['last_name'] = $row['last_name'];
                          
                    
                          $tm_arr_1 = $week_month_main_array_temp;
                          $tm_arr_2 = $week_month_main_array_temp;
                          $tm_arr_3 = $week_month_main_array_temp;
                          $tm_arr_4 = $week_month_main_array_temp;
                
                        
                          $arr[$row['card_number']]['on_duty_arr'] = $tm_arr_1;
                          $arr[$row['card_number']]['off_duty_arr'] = $tm_arr_2;
                          $arr[$row['card_number']]['in_time_arr'] = $tm_arr_3;
                          $arr[$row['card_number']]['out_time_arr'] = $tm_arr_4;
                     
                
                          array_push($all_cards, $row['card_number']);
                }
          }


            // updating existing 
            while ($row2 = mysqli_fetch_assoc($result)){               
                          for ($i = 0; $i < sizeof($week_month_main_array); $i++)
                          {
                              for ($k = 0; $k < sizeof($week_month_main_array[$i]); $k++)
                              {
                                if ($row2['date_time'] == $week_month_main_array[$i][$k])
                                {
                                  $arr[$row2['card_number']]['on_duty_arr'][$i][$k] = $row2['on_duty'];
                                  $arr[$row2['card_number']]['off_duty_arr'][$i][$k] = $row2['off_duty'];
                                  $arr[$row2['card_number']]['in_time_arr'][$i][$k] = $row2['in_time'];
                                  $arr[$row2['card_number']]['out_time_arr'][$i][$k] = $row2['out_time'];
                                }
                              }
                          } 
              
            }
          }
        }
    //var_dump($arr);
    //ChromePhp::log($arr);
    echo '<br>';

//this function substracts time string
function subs_time($str, $len, $which)
{
  $final = explode(":", $str);
  $arr1 = explode(":", $str);
  for ($i = 0; $i < 3; $i++)
            {
                $subtracted;
                $int = intval($arr1[$i]);
                if ($which == "floor")
                  $subtracted = floor($int / $len);
                else if ($which == "ceil")
                  $subtracted = ceil($int / $len);
                else if ($which == "round")
                  $subtracted = round($int / $len);
                $subtracted = strval($subtracted);
                add_zero($subtracted);
                $final[$i] = $subtracted; 
            }
  return join(":",$final);
}

// this functions adds two time strings together    
function add_time($str1, $str2)
{
  $final = explode(":", $str1);
  $arr1 = explode(":", $str1);
  $arr2 = explode(":", $str2);
  for ($i = 0; $i < 3; $i++)
            {
                $int_1 = intval($arr1[$i]);
                $int_2 = intval($arr2[$i]);
                $final[$i] = strval($int_1 + $int_2); 
            }
  foreach ($final as &$itm)
              {
                add_zero($itm);
              }
  return join(":",$final);
}

$final_arr = array();

// calculating the averages of weeks/months
  if(isset($_POST['filter_date_frequency']) && sizeof($arr) > 1)
  {
    //ChromePhp::log(sizeof($arr) . "this is the size");
    //ChromePhp::log($all_cards);
    //ChromePhp::log($department);
    if (($filter_date_frequency == "week" || $filter_date_frequency == "month") && sizeof($arr) > 1)

    {
        for ($i = 0; $i < sizeof($all_cards); $i++)
        {
          // storing each week/month averages
      

          for($k = 0; $k < sizeof($arr[$all_cards[$i]]['on_duty_arr']); $k++)
          {
              $dro_sum_1 = "00:00:00";
              $dro_sum_2 = "00:00:00";
              $dro_sum_3 = "00:00:00";
              $dro_sum_4 = "00:00:00";

    
              for ($z = 0; $z < sizeof($arr[$all_cards[$i]]['on_duty_arr'][$k]); $z++)
              {
                    $dro_sum_1 = add_time($arr[$all_cards[$i]]['on_duty_arr'][$k][$z], $dro_sum_1);
                    $dro_sum_2 = add_time($arr[$all_cards[$i]]['off_duty_arr'][$k][$z], $dro_sum_2);
                    $dro_sum_3 = add_time($arr[$all_cards[$i]]['in_time_arr'][$k][$z], $dro_sum_3);
                    $dro_sum_4 = add_time($arr[$all_cards[$i]]['out_time_arr'][$k][$z], $dro_sum_4);
                    if ($z == sizeof($arr[$all_cards[$i]]['on_duty_arr'][$k]) - 1)
                    {
                     
                      $dro_sum_1 = subs_time($dro_sum_1, sizeof($arr[$all_cards[$i]]['on_duty_arr'][$k]), "round");
                      $dro_sum_2 = subs_time($dro_sum_2, sizeof($arr[$all_cards[$i]]['on_duty_arr'][$k]), "round");
                      $dro_sum_3 = subs_time($dro_sum_3, sizeof($arr[$all_cards[$i]]['on_duty_arr'][$k]), "round");
                      $dro_sum_4 = subs_time($dro_sum_4, sizeof($arr[$all_cards[$i]]['on_duty_arr'][$k]), "round");
                      $emp_arr = array();
                      $emp_arr['card_number'] = $all_cards[$i];
                      $emp_arr['first_name'] = $arr[$all_cards[$i]]['first_name'];
                      $emp_arr['last_name'] = $arr[$all_cards[$i]]['last_name'];
                      $wk = $k + 1;
                      $emp_arr['week_month'] = 'კვირა '. $wk;
                      $emp_arr['week_month_count'] = $wk;
                      $emp_arr['on_duty'] = $dro_sum_1;
                      $emp_arr['off_duty'] = $dro_sum_2;
                      $emp_arr['in_time'] = $dro_sum_3;
                      $emp_arr['out_time'] = $dro_sum_4;
                      array_push($final_arr, $emp_arr);
                    }
              }


          } 
   

        }
        //ChromePhp::log($arr);
      }
  }
//ChromePhp::log($arr);
//ChromePhp::log($final_arr);


/////////////////////////////////////////////
     $i = 0;
    if(isset($_POST['filter_date_frequency']))
    {
    if ($filter_date_frequency == "week" || $filter_date_frequency == "month")
      {
        if (sizeof($arr) > 0)
        {
            for ($k = 0; $k < sizeof($final_arr); $k++)
            {
                if ($final_arr[$k]['week_month_count'] > (($page * $row_count) - $row_count) && $final_arr[$k]['week_month_count'] <= ($page * $row_count))
                {
                    echo '<tr><td>'.$final_arr[$k]['first_name']." ".$final_arr[$k]['last_name'].'</td> <td>' . $final_arr[$k]['week_month'] . '</td>
                    <td>'.$final_arr[$k]['card_number'].'</td> <td>' .$final_arr[$k]['on_duty'].'</td> <td>' . $final_arr[$k]['off_duty'].'</td> <td>' . $final_arr[$k]['in_time'].'</td> <td>' . $final_arr[$k]['out_time'].'</td> </tr>';
                    $i++;
                }
            }
        }
      } else {
 
          while ($myrow = mysqli_fetch_assoc($result)){
            echo '<tr><td>'.$myrow['first_name']." ".$myrow['last_name'].'</td> <td>' . $myrow['date_time'] . '</td> <td>' . $myrow['card_number'] . '</td> <td>' . $myrow['on_duty'] . '</td> <td>' . $myrow['off_duty']. '</td> <td>' . $myrow['in_time'] . '</td> <td>' . $myrow['out_time'] . '</td>';
            $i++;
          }
        }
    } else {
 
          while ($myrow = mysqli_fetch_assoc($result)){
           echo '<tr><td>'.$myrow['first_name']." ".$myrow['last_name'].'</td> <td>' . $myrow['date_time'] . '</td> <td>' . $myrow['card_number'] . '</td> <td>' . $myrow['on_duty'] . '</td> <td>' . $myrow['off_duty']. '</td> <td>' . $myrow['in_time'] . '</td> <td>' . $myrow['out_time'] . '</td>';
            $i++;
          }
        }
     
 ?>

 </table>

 <p>
   სულ: <?php echo $i. ' ჩანაწერი' ;?>
 </p>

<select style="position:absolute; left:44%;" name="page" id="page" onchange="javascript:date_filter()">
  <?php
    for($i = 1; $i <= $pages; $i++)
    {
      if ($i == $page)
        echo '<option value="'.$i.'" selected>'.$i.'</option>"';
      else
        echo '<option value="'.$i.'">'.$i.'</option>"';
    }
  ?>
 
</select>
<br><br><br><br><br>

 <script>
  // javascript - ცხრილში სახელების ძიება. input-ში ტექსტის ჩაწერისას სათითაოდ td-ებში ამოწმებს არის თუ არა მსგავსი ტექსტი, რაც არ დაემთხვევა იმას მალავს.

  function table_search() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("search");
  filter = input.value;
  table = document.getElementById("result_table");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

  // ეს ფუნქცია მოსახერხებელს ხდის ცხრილის სქროლვას, დიდი რაოდენობი ჩანაწერების შემთხვევაში ცხრილის ჰედერი მიყვება ეკრანს სქროლვის პროცესში
  // !!! ცხრილის ჰედერი პატარავდება და არ ემთხვევა ველებს, ხელით ფიქსირებული ზომების მიწერა შეიძლება (მაგრამ სხვადასხვა ზომის ეკრაზე სხვადასხვანაირად ჩანს)


// var element_position = $('#theader').offset();

// $(window).scroll(function(){
//         if($(window).scrollTop() > element_position.top){
//               $('#theader').css('position','fixed').css('top','0');
//               $('#result_table tr td').eq(0).css('width','265px');
//               $('#theader th').eq(0).css('width', '265px');
//               $('#theader th').eq(1).css('width', '230px');
//               $('#theader th').eq(2).css('width', '186px');
//               $('#theader th').eq(3).css('width', '186px');
//               $('#theader th').eq(4).css('width', '186px');
//               $('#theader th').eq(5).css('width', '187px');
//               $('#theader th').eq(6).css('width', '187px');
//         } else {
//             $('#theader').css('position','static');

//         }
//   })

 </script>

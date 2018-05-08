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
        $edit_tarigi_html = '';
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
          ChromePhp::log("the difference is " . $dif);
          $next_days = new DateTime($start_date);
          $weeks = array();
          $one_week = array();
          $add_week = false;
          while ($next_days->diff($to)->days <= $dif)
          {
            
            $dif_2 = $next_days->diff($to)->days;
            
            if ($next_days->format('w') == 1 && $dif_2 <= $dif)
            {
              $add_week = true;
              ChromePhp::log("dif 1: " . $dif . ", dif 2: " . $dif_2);
              ChromePhp::log("this day is monday! " . date_format($next_days, 'Y-m-d'));
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
              break;
          }
          ChromePhp::log($weeks);
          var_dump($weeks);
          $week_month_main_array = $weeks;
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

    <?php # mysql ორი ცხრილის გაერთიანება.
    if (!empty($employee)){
      $result = mysqli_query($db, "SELECT ies_staff.staff.first_name, ies_staff.staff.last_name, ies_inventari.turnstile_records_arranged.*
                            FROM ies_staff.staff LEFT JOIN ies_inventari.turnstile_records_arranged
                            ON ies_staff.staff.card_number = ies_inventari.turnstile_records_arranged.card_number WHERE ies_staff.staff.id = $employee AND $where ORDER BY `date_time` DESC LIMIT $row_count");
    } else if (!empty($laboratory)){
      $result = mysqli_query($db, "SELECT ies_staff.staff.first_name, ies_staff.staff.last_name, ies_inventari.turnstile_records_arranged.*
                            FROM ies_staff.staff LEFT JOIN ies_inventari.turnstile_records_arranged
                            ON ies_staff.staff.card_number = ies_inventari.turnstile_records_arranged.card_number WHERE ies_staff.staff.gr_lb_id = $laboratory AND $where ORDER BY `date_time` DESC LIMIT $row_count");
    } else if (!empty($department)){
      $result = mysqli_query($db, "SELECT ies_staff.staff.first_name, ies_staff.staff.last_name, ies_inventari.turnstile_records_arranged.*
                            FROM ies_staff.staff LEFT JOIN ies_inventari.turnstile_records_arranged
                            ON ies_staff.staff.card_number = ies_inventari.turnstile_records_arranged.card_number WHERE ies_staff.staff.dep_id = $department AND $where ORDER BY `date_time` DESC LIMIT $row_count");
    } else
    {
      $result = mysqli_query($db, "SELECT ies_staff.staff.first_name, ies_staff.staff.last_name, ies_inventari.turnstile_records_arranged.*
                            FROM ies_staff.staff LEFT JOIN ies_inventari.turnstile_records_arranged
                            ON ies_staff.staff.card_number = ies_inventari.turnstile_records_arranged.card_number WHERE $where ORDER BY `date_time` DESC LIMIT $row_count");
    }

    if (mysqli_num_rows($result) == 0) {
      echo "ჩანაწერი არ მოიძებნა. ";
      exit;
    }

///////////////// TEST  ///////////////////////
    $all_cards = array(); // array where all card numbers are stored, so it's easier to retrieve each item
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
            ChromePhp::log($week_month_main_array_temp);
        }
    }


    $arr = array(); // all data is stored in this array
    if(isset($_POST['filter_date_frequency']))
    {
      if ($filter_date_frequency == "week" || $filter_date_frequency == "month")
       {
            
            while ($row = mysqli_fetch_assoc($result)){
              if (!array_key_exists($row['card_number'], $arr) && sizeof($week_month_main_array_temp) > 0)
              {
               
              
                          $arr[$row['card_number']]['first_name'] = $row['first_name'];
                          $arr[$row['card_number']]['last_name'] = $row['last_name'];
                          $arr[$row['card_number']]['date_time'] = $row['date_time'];
                          $arr[$row['card_number']]['on_duty'] = $row['on_duty'];
                          $arr[$row['card_number']]['off_duty'] = $row['off_duty'];
                          $arr[$row['card_number']]['in_time'] = $row['in_time'];
                          $arr[$row['card_number']]['out_time'] = $row['out_time'];
                          $tm_arr_1 = $week_month_main_array_temp;
                          $tm_arr_2 = $week_month_main_array_temp;
                          $tm_arr_3 = $week_month_main_array_temp;
                          $tm_arr_4 = $week_month_main_array_temp;
                
                          for ($i = 0; $i < sizeof($week_month_main_array); $i++)
                          {
                            for ($k = 0; $k < sizeof($week_month_main_array[$i]); $k++)
                            {
                              if ($row['date_time'] == $week_month_main_array[$i][$k])
                              {
                                $tm_arr_1[$i][$k] = $row['on_duty'];
                                $tm_arr_2[$i][$k] = $row['off_duty'];
                                $tm_arr_3[$i][$k] =  $row['in_time'];
                                $tm_arr_4[$i][$k] = $row['out_time'];
                              }
                            }
                          }
                          $arr[$row['card_number']]['on_duty_arr'] = $tm_arr_1;
                          $arr[$row['card_number']]['off_duty_arr'] = $tm_arr_2;
                          $arr[$row['card_number']]['in_time_arr'] = $tm_arr_3;
                          $arr[$row['card_number']]['out_time_arr'] = $tm_arr_4;
                     
                
                array_push($all_cards, $row['card_number']);
              } else {
                  if(isset($_POST['filter_date_frequency']))
                  {
                      if ($filter_date_frequency == "week" || $filter_date_frequency == "month")
                      {
                           for ($i = 0; $i < sizeof($week_month_main_array); $i++)
                          {
                              for ($k = 0; $k < sizeof($week_month_main_array[$i]); $k++)
                              {
                                if ($row['date_time'] == $week_month_main_array[$i][$k])
                                {
                                  $arr[$row['card_number']]['on_duty_arr'][$i][$k] = $row['on_duty'];
                                  $arr[$row['card_number']]['off_duty_arr'][$i][$k] = $row['off_duty'];
                                  $arr[$row['card_number']]['in_time_arr'][$i][$k] = $row['in_time'];
                                  $arr[$row['card_number']]['out_time_arr'][$i][$k] = $row['out_time'];
                                }
                              }
                          }
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


// calculating the averages of weeks/months
  if(isset($_POST['filter_date_frequency']) && sizeof($arr) > 1)
  {
    ChromePhp::log(sizeof($arr) . "this is the size");
    if (($filter_date_frequency == "week" || $filter_date_frequency == "month") && sizeof($arr) > 1)

    {
        for ($i = 0; $i < sizeof($all_cards); $i++)
        {
          // storing each week/month averages
          $dro_sum_1_arr_dan = array();
          $dro_sum_2_arr_dan = array();
          $dro_sum_3_arr_dan = array();
          $dro_sum_4_arr_dan = array();

          $dro_sum_1_arr_mde = array();
          $dro_sum_2_arr_mde = array();
          $dro_sum_3_arr_mde = array();
          $dro_sum_4_arr_mde = array();

          for($k = 0; $k < sizeof($arr[$all_cards[$i]]['on_duty_arr']); $k++)
          {
              $dro_sum_1 = "00:00:00";
              $dro_sum_2 = "00:00:00";
              $dro_sum_3 = "00:00:00";
              $dro_sum_4 = "00:00:00";

              $dro_sum_1_dan = "00:00:00";
              $dro_sum_2_dan = "00:00:00";
              $dro_sum_3_dan = "00:00:00";
              $dro_sum_4_dan = "00:00:00";

              $dro_sum_1_mde = "00:00:00";
              $dro_sum_2_mde = "00:00:00";
              $dro_sum_3_mde = "00:00:00";
              $dro_sum_4_mde = "00:00:00";
              for ($z = 0; $z < sizeof($arr[$all_cards[$i]]['on_duty_arr'][$k]); $z++)
              {
                    $dro_sum_1 = add_time($arr[$all_cards[$i]]['on_duty_arr'][$k][$z], $dro_sum_1);
                    $dro_sum_2 = add_time($arr[$all_cards[$i]]['off_duty_arr'][$k][$z], $dro_sum_2);
                    $dro_sum_3 = add_time($arr[$all_cards[$i]]['in_time_arr'][$k][$z], $dro_sum_3);
                    $dro_sum_4 = add_time($arr[$all_cards[$i]]['out_time_arr'][$k][$z], $dro_sum_4);
                    if ($z == 4)
                    {
                      $dro_sum_1_dan = subs_time($dro_sum_1, sizeof($arr[$all_cards[$i]]['on_duty_arr'][$k]), "floor");
                      $dro_sum_2_dan = subs_time($dro_sum_2, sizeof($arr[$all_cards[$i]]['on_duty_arr'][$k]), "floor");
                      $dro_sum_3_dan = subs_time($dro_sum_3, sizeof($arr[$all_cards[$i]]['on_duty_arr'][$k]), "floor");
                      $dro_sum_4_dan = subs_time($dro_sum_4, sizeof($arr[$all_cards[$i]]['on_duty_arr'][$k]), "floor");
                      $dro_sum_1_mde = subs_time($dro_sum_1, sizeof($arr[$all_cards[$i]]['on_duty_arr'][$k]), "ceil");
                      $dro_sum_2_mde = subs_time($dro_sum_2, sizeof($arr[$all_cards[$i]]['on_duty_arr'][$k]), "ceil");
                      $dro_sum_3_mde = subs_time($dro_sum_3, sizeof($arr[$all_cards[$i]]['on_duty_arr'][$k]), "ceil");
                      $dro_sum_4_mde = subs_time($dro_sum_4, sizeof($arr[$all_cards[$i]]['on_duty_arr'][$k]), "ceil");

                    }
              }


              array_push($dro_sum_1_arr_dan, $dro_sum_1_dan);
              array_push($dro_sum_2_arr_dan, $dro_sum_2_dan);
              array_push($dro_sum_3_arr_dan, $dro_sum_3_dan);
              array_push($dro_sum_4_arr_dan, $dro_sum_4_dan);

              array_push($dro_sum_1_arr_mde, $dro_sum_1_mde);
              array_push($dro_sum_2_arr_mde, $dro_sum_2_mde);
              array_push($dro_sum_3_arr_mde, $dro_sum_3_mde);
              array_push($dro_sum_4_arr_mde, $dro_sum_4_mde);
          } 
          //calculating the main average
          $dro_sum_1_dan_main = "00:00:00";
          $dro_sum_2_dan_main = "00:00:00";
          $dro_sum_3_dan_main = "00:00:00";
          $dro_sum_4_dan_main = "00:00:00";

          $dro_sum_1_mde_main = "00:00:00";
          $dro_sum_2_mde_main = "00:00:00";
          $dro_sum_3_mde_main = "00:00:00";
          $dro_sum_4_mde_main = "00:00:00";
          for ($m = 0; $m < sizeof($dro_sum_1_arr_dan); $m++)
          {
              $dro_sum_1_dan_main = add_time($dro_sum_1_dan_main, $dro_sum_1_arr_dan[$m]);
              $dro_sum_2_dan_main = add_time($dro_sum_2_dan_main, $dro_sum_2_arr_dan[$m]);
              $dro_sum_3_dan_main = add_time($dro_sum_3_dan_main, $dro_sum_3_arr_dan[$m]);
              $dro_sum_4_dan_main = add_time($dro_sum_4_dan_main, $dro_sum_4_arr_dan[$m]);

              $dro_sum_1_mde_main = add_time($dro_sum_1_mde_main, $dro_sum_1_arr_mde[$m]);
              $dro_sum_2_mde_main = add_time($dro_sum_2_mde_main, $dro_sum_2_arr_mde[$m]);
              $dro_sum_3_mde_main = add_time($dro_sum_3_mde_main, $dro_sum_3_arr_mde[$m]);
              $dro_sum_4_mde_main = add_time($dro_sum_4_mde_main, $dro_sum_4_arr_mde[$m]);
          }
          $arr[$all_cards[$i]]['on_duty_arr_dan'] = subs_time($dro_sum_1_dan_main, sizeof($dro_sum_1_arr_dan), "floor");
          $arr[$all_cards[$i]]['off_duty_arr_dan'] = subs_time($dro_sum_2_dan_main, sizeof($dro_sum_2_arr_dan), "floor");
          $arr[$all_cards[$i]]['in_time_arr_dan'] = subs_time($dro_sum_3_dan_main, sizeof($dro_sum_3_arr_dan), "floor");
          $arr[$all_cards[$i]]['out_time_arr_dan'] = subs_time($dro_sum_4_dan_main, sizeof($dro_sum_4_arr_dan), "floor");

          $arr[$all_cards[$i]]['on_duty_arr_mde'] = subs_time($dro_sum_1_mde_main, sizeof($dro_sum_1_arr_mde), "ceil");
          $arr[$all_cards[$i]]['off_duty_arr_mde'] = subs_time($dro_sum_2_mde_main, sizeof($dro_sum_2_arr_mde), "ceil");
          $arr[$all_cards[$i]]['in_time_arr_mde'] = subs_time($dro_sum_3_mde_main, sizeof($dro_sum_3_arr_mde), "ceil");
          $arr[$all_cards[$i]]['out_time_arr_mde'] = subs_time($dro_sum_4_mde_main, sizeof($dro_sum_4_arr_mde), "ceil");

        }
        ChromePhp::log($arr);
      }
  }
ChromePhp::log($arr);

/////////////////////////////////////////////
     $i = 0;
    if(isset($_POST['filter_date_frequency']))
    {
    if ($filter_date_frequency == "week" || $filter_date_frequency == "month")
      {
        if (sizeof($arr) > 1)
        {
            for ($k = 0; $k < sizeof($all_cards); $k++)
            {
                echo '<tr><td>'.$arr[$all_cards[$k]]['first_name']." ".$arr[$all_cards[$k]]['last_name'].'</td> <td>' . $all_cards[$k] . '</td>
                <td>' . $arr[$all_cards[$k]]['on_duty_arr_dan'] . "-დან ". $arr[$all_cards[$k]]['on_duty_arr_mde']."-მდე".'</td> <td>' . $arr[$all_cards[$k]]['off_duty_arr_dan']. "-დან " .$arr[$all_cards[$k]]['off_duty_arr_mde'] . "-მდე" .'</td> <td>' . $arr[$all_cards[$k]]['in_time_arr_dan'] . "-დან " . $arr[$all_cards[$k]]['in_time_arr_mde'] ."-მდე".'</td> <td>' . $arr[$all_cards[$k]]['out_time_arr_dan']."-დან ".$arr[$all_cards[$k]]['out_time_arr_mde']."-მდე </td>";
                $i++;
            }
        }
      } else {
 
          while ($myrow = mysqli_fetch_assoc($result)){
            echo '<tr><td>'.$myrow['first_name']." ".$myrow['last_name'].'</td> <td>' . $myrow['date_time'] . '<td>' . $myrow['card_number'] . '<td>' . $myrow['on_duty'] . '<td>' . $myrow['off_duty']. '<td>' . $myrow['in_time'] . '<td>' . $myrow['out_time'];
            $i++;
          }
        }
    } else {
 
          while ($myrow = mysqli_fetch_assoc($result)){
            echo '<tr><td>'.$myrow['first_name']." ".$myrow['last_name'].'</td> <td>' . $myrow['date_time'] . '<td>' . $myrow['card_number'] . '<td>' . $myrow['on_duty'] . '<td>' . $myrow['off_duty']. '<td>' . $myrow['in_time'] . '<td>' . $myrow['out_time'];
            $i++;
          }
        }
 ?>

 </table>

 <p>
   სულ: <?php echo $i. ' ჩანაწერი' ;?>
 </p>


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

<?php
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



  // დღეების კვირების და თვეების მიხედვით ფილტრი
  if(isset($_POST['filter_date_frequency'])) {
     $filter_date_frequency = $_POST['filter_date_frequency'];
    if ($filter_date_frequency == "week" || $filter_date_frequency == "month") {
        $yofnis_dro = $yofnis_dro."(საშუალო)";
        $shesvenebaze_dro = $shesvenebaze_dro."(საშუალო)";
        $mosvlis_dro = $mosvlis_dro."(საშუალო)";
        $wasvlis_dro = $wasvlis_dro."(საშუალო)";

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
          <th>თარიღი</th>
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

  /* TEST
    $arr = array();
    while ($row = mysqli_fetch_assoc($result)){
      if (!array_key_exists($row['card_number'], $arr))
      {
        $arr[$row['card_number']]['first_name'] = $row['first_name'];
      }
    }
    var_dump($arr);
*/
    $i = 0;
      while ($myrow = mysqli_fetch_assoc($result)){
        echo '<tr><td>'.$myrow['first_name']." ".$myrow['last_name'].'</td> <td>' . $myrow['date_time'] . '<td>' . $myrow['card_number'] . '<td>' . $myrow['on_duty'] . '<td>' . $myrow['off_duty']. '<td>' . $myrow['in_time'] . '<td>' . $myrow['out_time'];
        $i++;
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

<?php
include("../block/globalVariables.php");
include("../block/db.php");
include("../block/functions.php");
include("../checklogin.php");// amocmebs tu aris avtorizacia gavlili
session_start();
if($_SESSION['name'] != $siteMaintenanceUsername) die("Error 333");
mysqli_select_db($db, $dbStaff);
if(isset($_POST['id'])) $id = $_POST['id']; else die("id not issets");
if(isset($_POST['dep_id'])) $dep_id = $_POST['dep_id']; else die("dep_id not issets");
if(isset($_POST['gr_lb_id'])) $gr_lb_id = $_POST['gr_lb_id']; else die("gr_lb_id not issets");
if(isset($_POST['first_name'])) $first_name = $_POST['first_name']; else die("first_name not issets");
if(isset($_POST['last_name'])) $last_name = $_POST['last_name']; else die("last_name not issets");
if(isset($_POST['date_of_birth'])) $date_of_birth = $_POST['date_of_birth']; else die("date_of_birth not issets");
if(isset($_POST['address'])) $address = $_POST['address']; else die("address not issets");
if(isset($_POST['personal_number'])) $personal_number = $_POST['personal_number']; else die("personal_number not issets");
if(isset($_POST['card_number'])) $card_number = $_POST['card_number']; else die("card_number not issets");
if(isset($_POST['position'])) $position = $_POST['position']; else die("position not issets");
if(isset($_POST['contract_start_date'])) $contract_start_date = $_POST['contract_start_date']; else die("contract_start_date not issets");
if(isset($_POST['contract_end_date'])) $contract_end_date = $_POST['contract_end_date']; else die("contract_end_date not issets");
if(isset($_POST['contract_number'])) $contract_number = $_POST['contract_number']; else die("contract_number not issets");
if(isset($_POST['salary_card_start_date'])) $salary_card_start_date = $_POST['salary_card_start_date']; else die("salary_card_start_date not issets");
if(isset($_POST['salary_card_end_date'])) $salary_card_end_date = $_POST['salary_card_end_date']; else die("salary_card_end_date not issets");
if(isset($_POST['home_number'])) $home_number = $_POST['home_number']; else die("home_number not issets");
if(isset($_POST['mobile_phone'])) $mobile_phone = $_POST['mobile_phone']; else die("mobile_phone not issets");
if(isset($_POST['email'])) $email = $_POST['email']; else die("email not issets");
if(isset($_POST['komentari'])) $komentari = $_POST['komentari']; else die("komentari not issets");
if(isset($_POST['password'])) $password = $_POST['password']; else die("password not issets");
if(isset($_POST['head_of_department'])) $head_of_department = "კი"; else $head_of_department = "არა";

if ($head_of_department == "კი")
{
	$sql = "UPDATE `ies_staff`.`staff` SET  head_of_department='არა' WHERE dep_id='$dep_id'";
    $result = mysqli_query($db, $sql) or die($sql);
}
if($id > 0 )
{
		if(isset($id) && isset($dep_id)&& isset($gr_lb_id)&& isset($first_name)&& isset($last_name)
		&& isset($date_of_birth) && isset($personal_number)&& isset($card_number)&&isset($position)&&isset($contract_start_date)
		&&isset($contract_end_date)&&isset($contract_number)&&isset($salary_card_start_date)&&isset($salary_card_end_date)
		&&isset($home_number) &&isset($mobile_phone) &&isset($email) &&isset($password))
	    {

		 $sql = "UPDATE `ies_staff`.`staff` SET  dep_id='$dep_id',
		 gr_lb_id='$gr_lb_id',
		 first_name='$first_name',
		 last_name='$last_name',
		 date_of_birth='$date_of_birth',
		 address='$address',
		 personal_number='$personal_number',
		 card_number='$card_number',
		 head_of_department='$head_of_department',
		 position='$position',
		 contract_start_date='$contract_start_date',
		 contract_end_date='$contract_end_date',
		 contract_number='$contract_number',
		 salary_card_start_date='$salary_card_start_date',
		 salary_card_end_date='$salary_card_end_date',
		 salary_card_start_date='$salary_card_start_date',
		 home_number='$home_number',
		 mobile_phone='$mobile_phone',
		 email='$email',
		 komentari='$komentari'";
		 $password = md5($_POST['password']);
		 $wew=d41d8cd98f00b204e9800998ecf8427e;
		 if($password == $wew)
		 {
             $sql .= " WHERE id='$id';";
		 }

		  else
		  {

			  $sql .= " ,";
		      $sql .= " password ='$password'";
			  $sql .= " WHERE id='$id';";
		  }
		 $result = mysqli_query($db, $sql) or die($sql);
		 header('Location: departments.php');
		}else die("No post data");
}
else
{
	if(isset($id) && isset($dep_id)&& isset($gr_lb_id)&& isset($first_name)&& isset($last_name)&& isset($date_of_birth)
	  && isset($personal_number)&& isset($card_number)&&isset($position)&&isset($contract_start_date)&&isset($contract_end_date)
	  &&isset($contract_number))
	{
		 $sql = "INSERT INTO `ies_staff`.`staff` SET  dep_id='$dep_id',
		 gr_lb_id='$gr_lb_id',
		 first_name='$first_name',
		 last_name='$last_name',
		 date_of_birth='$date_of_birth',
		 address='$address',
		 personal_number='$personal_number',
		 card_number='$card_number',
		 head_of_department='$head_of_department',
		 position='$position',
		 contract_start_date='$contract_start_date',
		 contract_end_date='$contract_end_date',
		 contract_number='$contract_number',
		 salary_card_start_date='$salary_card_start_date',
		 salary_card_end_date='$salary_card_end_date',
		 home_number='$home_number',
		 mobile_phone='$mobile_phone',
		 email='$email',
		 komentari='$komentari',
		 password='$password'";
		 $result = mysqli_query($sql) or die($sql);
		 header('Location: departments.php');
		}else die("No post data");
}
?>

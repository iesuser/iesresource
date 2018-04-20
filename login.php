<?php
include("block/globalVariables.php");
include("block/db.php");
session_start(); // This starts the session which is like a cookie, but it isn't saved on your hdd and is much more secure.
mysqli_connect("$dbHost","$dbUsername","$dbUsernamePass"); // Connect to the MySQL server
mysqli_select_db($db, "$dbStaff"); // Select your Database
if(isset($_SESSION['loggedin']))
{
	 header('Location: products/products.php');
    die("You are already logged in!");
} // That bit of code checks if you are logged in or not, and if you are, you can't log in again!


if(isset($_POST['submit']))
{
   if($_POST['username'] == $siteMaintenanceUsername and $_POST['password'] == $siteMaintenancePass)
   {
	   $_SESSION['name'] = $siteMaintenanceUsername; // Make it so the username can be called by $_SESSION['name']
	   $_SESSION['first_name'] = $siteMaintenanceFirstname;
	   $_SESSION['last_name'] = $siteMaintenanceLastname;
   }else if($_POST['username'] == $siteGuesteUsername and $_POST['password'] == $siteGuestPass)
   {
	   $_SESSION['name'] = $siteGuestUsername; // Make it so the username can be called by $_SESSION['name']
	   $_SESSION['first_name'] = $siteGuestFirstname;
	   $_SESSION['last_name'] = $siteGuestLastname;
   }
   else
   {
	   $name = mysqli_real_escape_string($_POST['username']); // The function mysql_real_escape_string() stops hackers!
	   $pass = mysqli_real_escape_string($_POST['password']); // We won't use MD5 encryption here because it is the simple tutorial, if you don't know what MD5 is, dont worry!
	   $pass = md5($pass);
	   $staffs = mysqli_query($db, "SELECT * FROM staff WHERE email = '$name' AND password = '$pass'"); // This code uses MySQL to get all of the users in the database with that username and password.
	   $we=mysqli_num_rows($staffs);
	   $staff = mysqli_fetch_array($staffs);
	   $first_name = $staff['first_name'];
	   $last_name = $staff['last_name'];
	   $dep_id = $staff['dep_id'];

	   if($we < 1)
	   {
		 header('Location: login.php?wronguserpass=1');
		 die("Password was probably incorrect!");
	   } // That snippet checked to see if the number of rows the MySQL query was less than 1, so if it couldn't find a row, the password is incorrect or the user doesn't exist!
	   $_SESSION['name'] = $name; // Make it so the username can be called by $_SESSION['name']
	   $_SESSION['first_name'] = $first_name;
	   $_SESSION['last_name'] = $last_name;

	   $query = "SELECT name FROM departments WHERE id = '$dep_id'";
	  // die($query);
	   $departments = mysqli_query($db, $query);
	   $departament = mysqli_fetch_array($departments);
	   $_SESSION['departmentName'] = $departament['name'];
   }
   $_SESSION['loggedin'] = "YES"; // Set it so the user is logged in!
   header('Location: products/products.php');
} // That bit of code logs you in! The "$_POST['submit']" bit is the submission of the form down below VV
?>
<style type="text/css">
table.login{
	font-size:12px;
	border:1px solid #CCC;
	background-color: #F8F8F8;
}

table.login td{
	font-weight:bold;
	color:#7E9EFF;
	height: 25px;
}
img.language{
	border: 1px solid #CCC;
}
.
div.language{
	width:300px;
}

span.warning
{
	color:#FF3333;
	font-size:10px;
}
</style>
<form action="login.php" method="post" name="form_login" >
  <p><br><br>
    <br><br>
  </p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <div align="center">
    <table width="274" border="0" class='login'>
    <tr>
    <td colspan="2"><div align="center">ადმინისტრაციის ბლოკი</div></td>

      <tr>
        <td width="79"><div align="right">ელ-ფოსტა </div></td>
        <td width="183"><input type='text' name='username' /></td>
      </tr>
      <tr>
        <td><div align="right">პაროლი</div></td>
        <td><input type='password' name='password' class="" /></td>
      </tr>
      <tr>
        <td colspan="2"><div align="center">
          <input type='submit' name='submit' value='ავტორიზაცია' />
        </div></td>
        <?php if(isset($_GET['wronguserpass']))
		{
        ?>
        <p style="color:#F03;font-size:12px;margin-bottom:5px">* სახელი ან პაროლი არასწორია</p>
        <?php
		}
		?>
      </tr>
    </table>
  </div>
  <p>&nbsp;</p>
</form>

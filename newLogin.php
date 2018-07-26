<?php

//remember me doesn't work!!!


include("block/globalVariables.php");
include("block/db.php");
session_start(); // This starts the session which is like a cookie, but it isn't saved on your hdd and is much more secure.
mysqli_connect("$dbHost","$dbUsername","$dbUsernamePass"); // Connect to the MySQL server
mysqli_select_db($db, "$dbStaff"); // Select your Database
if(isset($_SESSION['loggedin']))
{
	 header('Location: products/newProduct.php');
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
		 header('Location: newLogin.php?wronguserpass=1');
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
   header('Location: products/newProduct.php');
} // That bit of code logs you in! The "$_POST['submit']" bit is the submission of the form down below VV
?>

<style media="screen">
	html,
	body {
	height: 100%;
	}

	body {
		display: -ms-flexbox;
		display: flex;
		-ms-flex-align: center;
		align-items: center;
		padding-top: 40px;
		padding-bottom: 40px;
		background-color: #f5f5f5;
		}

		.form-signin {
		width: 100%;
		max-width: 330px;
		padding: 15px;
		margin: auto;
		}
		.form-signin .checkbox {
		font-weight: 400;
		}
		.form-signin .form-control {
		position: relative;
		box-sizing: border-box;
		height: auto;
		padding: 10px;
		font-size: 16px;
		}
		.form-signin .form-control:focus {
		z-index: 2;
		}
		.form-signin input[type="email"] {
		margin-bottom: -1px;
		border-bottom-right-radius: 0;
		border-bottom-left-radius: 0;
		}
		.form-signin input[type="password"] {
		margin-bottom: 10px;
		border-top-left-radius: 0;
		border-top-right-radius: 0;
		}
</style>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login</title>
    <link rel="stylesheet" href="block/bootstrap-4.1.1-dist/css/bootstrap.min.css">
  </head>

  <body class="text-center">
    <form class="form-signin" action="newLogin.php" method="post" name="form_login">
      <img class="mb-4" src="images/iliauni_logo_red.png" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">ადმინისტრაციის ბლოკი</h1>
      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="text" name='username' id="inputEmail" class="form-control" placeholder="ელ-ფოსტა" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" name='password' id="inputPassword" class="form-control" placeholder="პაროლი" required>
			<?php if(isset($_GET['wronguserpass']))
			{
			?>
				<p class="text-danger font-weight-bold">სახელი ან პაროლი არასწორია</p>
			<?php
			}
			?>
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> დამახსოვრება
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit" name='submit'>ავტორიზაცია</button>

      <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
    </form>
		<script type="text/javascript" src="../block/bootstrap-4.1.1-dist/js/jquery-3.3.1.min.js"></script>
		<script type='text/javascript' src="../block/bootstrap-4.1.1-dist/js/popper.min.js"></script>
		<script type='text/javascript' src="../block/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
  </body>
</html>

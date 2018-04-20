<?php
	$currentFile = $_SERVER["SCRIPT_NAME"];
  $parts = Explode('/', $currentFile);
  $currentFile = $parts[count($parts) - 1];
  session_start(); // NEVER forget this!
  if(!isset($_SESSION['loggedin'])){
    header('Location: ../login.php');
    die("To access this page, you need to <a href='../login.php'>LOGIN</a>"); // Make sure they are logged in!
  } // What the !isset() code does, is check to see if the variable $_SESSION['loggedin'] is there, and if it isn't it kills the script telling the user to log in!



  if($currentFile!="products.php" and isset($_SESSION['loggedin']) and isset($_SESSION['departmentName']))
    die("მხოლოდ ადმინისტრატორებს შეუძლიათ ამ გვერდის ნახვა"); // Make sure they are logged in!

  if(isset($_SESSION['loggedin']) and !isset($_SESSION['departmentName']))
    $isAdmin = true;
  else
    $isAdmin = false;
?>

<style>

  body{
    background: #fff;
  }
  .navbar{
    background: #f3f3f3;
    border-radius: 0;
    border-top: none;
    border-left: none;
    border-bottom: #CCC 1px solid;
    border-right: #CCC 1px solid;
  }
  .nav>li>a{
    /*padding: 10px 6px;*/
  }

  .navbar-inverse .navbar-nav>li>a{
    color: #555555;
    font-size: 12px;
  }
  .navbar-inverse .navbar-nav>li>a:hover{
    color: #555555;

  }
  .active{
    /*color: #555555;*/
    /*background: transparent;*/
  }

.navbar-inverse .navbar-nav>li>a:focus {
    color: #555555;
    background-color: transparent;
}
.navbar-inverse .navbar-nav>li>a{
  text-shadow: none;
}

.navbar-toggle{
  background: #333;
}
.dropdown-menu>li>a{
  font-size: 12px;
  color: #555555;
}
.dropdown-menu>li :hover{
  background-color: #fff;
}
.dropdown-menu{
  /*width: 50px;*/
  margin-left: 18px;
  border-radius: 0;
}
</style>





<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li ><a href="../products/products.php">ინვენტარი</a>
          <?php if ($isAdmin){ ?>
        </li>
        <li class="dropdown">
          <a class="dropdown" data-toggle="dropdown" href="../staff/departments.php">სტრუქტურა/თანამშრომლები
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="turnstile.php">დასწრება</a></li>

            <li><a href="#">ექსპედიცია/შვებულება</a></li>

          </ul>
      </li>
      <?php if ($_SESSION['name'] == $siteMaintenanceUsername) { ?>
      <li><a href="../staff/baratebi.php">შეტყობინებები</a></li>
      <?php }?>
      <?php }?>

      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a ><span class="glyphicon glyphicon-user"></span> <?php  echo $_SESSION['first_name']." ".$_SESSION['last_name'] ?> </a></li>
        <li><a href="../logout.php"><span class="glyphicon glyphicon-log-in"></span> გასვლა </a></li>
      </ul>
    </div>
  </div>
</nav>









  <script>
    $('ul.nav li.dropdown').hover(function() {
      $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeIn(200);
    }, function() {
      $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeOut(200);
    });
  </script>

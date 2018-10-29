<!-- // DAMATEBULI -->
<span style="float:right; font-size:10px; color:#999; margin-right:15px;">
  <?php
$currentFile = $_SERVER["SCRIPT_NAME"];
  $parts = Explode('/', $currentFile);
  $currentFile = $parts[count($parts) - 1];
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
if(!isset($_SESSION['loggedin']))
{
header('Location: ../newLogin.php');
  die("To access this page, you need to <a href='../newLogin.php'>LOGIN</a>"); // Make sure they are logged in!
} // What the !isset() code does, is check to see if the variable $_SESSION['loggedin'] is there, and if it isn't it kills the script telling the user to log in!
?>


<style type="text/css">
<!--
.colortext {
color:	#999;
font-size:12px;

}

</style>
  </span>
<!-- //////////////////////// -->
<nav class="navbar navbar-expand-sm navbar-dark bg-dark" style="padding: .4rem 1rem;">
  <a class="navbar-brand" href="#">
    <img src="../images/iliauni_logo.png" class="d-inline-block align-top" alt="IESRESOURCE">
  </a>
  <button class="navbar-toggler" data-toggle="collapse" data-target="#main-manu">
      <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="main-manu">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="../products/newProduct.php">ინვენტარი</a>
      </li>
      <li class="dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown">
          სტრუქტურა/თანამშრომლები
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="../staff/newDepartments.php">სტრუქტურა/თანამშრომლები</a>
            <a class="dropdown-item" href="../turnstile/turnstile.php">დასწრება</a>
            <a class="dropdown-item" href="">ექსპედიცია/შვებულება</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../staff/baratebiNEW.php">შეტყობინებები</a>
      </li>
    </ul>
  </div>
  <nav class="navbar navbar-expand-sm navbar-dark bg-dark" style="padding: .4rem 1rem;">
    <ul class="navbar-nav">
      <li class="nav-item" style="float:right">
        <span class="nav-link user" style="pointer-events:none;"><?php  echo $_SESSION['first_name']." ".$_SESSION['last_name']."&nbsp &nbsp |"; ?></span>
      </li>
      <li class="nav-item">
        <a href="../logout.php" class="nav-link">გასვლა</a>
      </li>
    </ul>
  </nav>
</nav>

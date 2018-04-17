<div style="height:50px;background-color:#F3F3F3;padding-left:20px; border-bottom:#CCC 1px solid;border-right:#CCC 1px solid;">
	<span style="float:right; font-size:10px; color:#999; margin-right:15px;">
    <?php
	$currentFile = $_SERVER["SCRIPT_NAME"];
    $parts = Explode('/', $currentFile);
    $currentFile = $parts[count($parts) - 1];
session_start(); // NEVER forget this!
if(!isset($_SESSION['loggedin']))
{
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


  <style type="text/css">
<!--
.colortext {
	color:	#999;
	font-size:12px;

}
-->
</style>



<table width="200" border="0"><br />
  <tr>


    <td style="padding:4px; color:#999; font-size:12px;"> <?php  echo $_SESSION['first_name']." ".$_SESSION['last_name']." |"; ?> <a href="../logout.php" class="colortext">გასვლა</a></td>
  </tr>
</table>



    <a style="font-size:10px; color:#999;" href="../login.php?expire=1"><?php //echo $tMenuLogOut;?></a>
    </span>
    <div style="width:800px; padding-top:15px; height:30px;">
			<ul id="qm0" class="qmmc">
                <li><a href="../products/products.php">ინვენტარი</a>

                    <?php if ($isAdmin)

                    ?>

                </li>
				<?php if ($isAdmin)
                {
                ?>
                <li><span class="qmdivider qmdividery" ></span></li>
                <li><a href="../staff/departments.php">სტრუქტურა/თანამშრომლები</a>
                    <ul>
                      <li><a href="../turnstile/turnstile.php">დასწრება</a></li>
                      <li><a href="javascript:void(0)">ექსპედიცია/შვებულება</a></li>
                    </ul>
                </li>

                <?php if ($_SESSION['name'] == $siteMaintenanceUsername) { ?>
               		<li><span class="qmdivider qmdividery" ></span></li>
                  <li><a href="../staff/baratebi.php">შეტყობინებები</a></li>
               <?php }?>

				 <?php
                 }
                 ?>
            </ul>
	</div>
</div>

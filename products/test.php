<?php
include("../block/globalVariables.php");
include("../block/db.php");
//if(!HaveAccess("seismicData")){echo CreatePageData($_POST," ../login.php"); exit();}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>პროდუქტები</title>
<link href="../block/style.css" rel="stylesheet" type="text/css"/>
<script type='text/javascript' src='../block/datetimepicker/datetimepicker_css_ge.js'></script>
<?php include("../block/formenu/formenu.php");?>
</head><?php include("../block/mainmenu.php");?>
<body>
<br><br><br><br><br><br><br><br><br><br><br>
<input type="text" name="fltr_open_date" id="fltr_open_date" size="18" onkeyup="return maskdate(event,this);" maxlength="10" style="width:80px;" value="">
                <a href="javascript:NewCssCal('fltr_open_date','yyyymmdd','arrow',false,24,false,true)">
  				<img border="0" src="../block/datetimepicker/images/cal.gif" width="16" height="16" alt="Pick a date"></a>
</body>
</html>
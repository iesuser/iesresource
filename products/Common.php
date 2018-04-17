

<?php
/*
 * Mysql Ajax Table Editor
 *
 * Copyright (c) 2008 Chris Kitchen <info@mysqlajaxtableeditor.com>
 * All rights reserved.
 *
 * See COPYING file for license information.
 *
 * Download the latest version from
 * http://www.mysqlajaxtableeditor.com
 */
class Common
{		
	// Mysql Variables
	var $mysqlUser = 'ajax';
	var $mysqlDb = 'ajax';
	var $mysqlHost = 'localhost';
	var $mysqlDbPass = 'ajax';
	
	
	var $langVars;
	var $dbc;
	
	function mysqlConnect()
	{
		if($this->dbc = mysqli_connect($this->mysqlHost, $this->mysqlUser, $this->mysqlDbPass)) 
		{	
			if(!mysqli_select_db ($this->dbc ,$this->mysqlDb))
			{
				$this->logError(sprintf($this->langVars->errNoSelect,$this->mysqlDb),__FILE__, __LINE__);
			}
		}
		else
		{
			$this->logError($this->langVars->errNoConnect,__FILE__, __LINE__);
		}
	}
	
	function logError($message, $file, $line)
	{
		$message = sprintf($this->langVars->errInScript,$file,$line,$message);
		var_dump($message);
		die;
	}


	function displayHeaderHtml()
	{
		?>
		<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
		"http://www.w3.org/TR/html4/loose.dtd">
		<html>
		<head>
		<title>მთავარი გვერდი</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<link href="mysqlajaxtableeditor/css/table_styles.css" rel="stylesheet" type="text/css" />
			<link href="mysqlajaxtableeditor/css/icon_styles.css" rel="stylesheet" type="text/css" />
			<?php 
				include("../block/formenu/formenu.php");   
			?>
			<script type="text/javascript" src="mysqlajaxtableeditor/js/prototype.js"></script>
			<script type="text/javascript" src="mysqlajaxtableeditor/js/scriptaculous-js/scriptaculous.js"></script>
			<script type="text/javascript" src="mysqlajaxtableeditor/js/lang/lang_vars-en.js"></script>
			<script type="text/javascript" src="mysqlajaxtableeditor/js/ajax_table_editor.js"></script>
            <script type='text/javascript' src="products.js"></script> 
			
			<!-- calendar files -->
			<link rel="stylesheet" type="text/css" media="all" href="mysqlajaxtableeditor/js/jscalendar/skins/aqua/theme.css" title="win2k-cold-1" /> 
            <link href="../block/style.css" rel="stylesheet" type="text/css" />
			<script type="text/javascript" src="mysqlajaxtableeditor/js/jscalendar/calendar.js"></script>
			<script type="text/javascript" src="mysqlajaxtableeditor/js/jscalendar/lang/calendar-en.js"></script>
			<script type="text/javascript" src="mysqlajaxtableeditor/js/jscalendar/calendar-setup.js"></script>
           
<script type="text/javascript">		

				var iesDataUrl = "<?php global $iesDataUrl;	echo $iesDataUrl;?>";	
                    function showRowDetails(id,rowNum)
                    {
						window.location = 'newEdit_products.php?id='+id;
      //window.open('newEdit_eq.php?id='+id);
//window.open('RowDetails.php?id='+id,'detail_popup','toolbar=0,scrollbars=1,location=0,statusbar=1,menubar=0,resizable=1,width=800,height=600,left=100,top=100');

                    }
            </script>

		</head>	
		<body onLoad="javascript:onPageLoad()">
		<?php
	}	
	
	function displayFooterHtml()
	{
		?>
		</body>
		</html>
		<?php
	}	

}
?>

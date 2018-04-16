<?php 
include("../block/globalVariables.php");
include("../block/db.php");
//if(!HaveAccess("seismicData")){echo CreatePageData($_POST," ../login.php"); exit();}

?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>პროდუქტები</title>


<?php include("../block/formenu/formenu.php");?>
<?php include("../block/mainmenu.php");?>
<!--example 1 -->
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
require_once('Common.php');
require_once('php/lang/LangVars-en.php');
require_once('php/AjaxTableEditor.php');
class Example1 extends Common
{
	var $Editor;
	
	function displayHtml()
	{
		?>
			<br />
	
			<div align="left" style="position: relative;"><div id="ajaxLoader1"><img src="images/ajax_loader.gif" alt="Loading..." /></div></div>
			
			<br />
			
			<div id="historyButtonsLayer" align="left">
			</div>
	
			<div id="historyContainer">
				<div id="information">
				</div>
		
				<div id="titleLayer" style="padding: 2px; font-weight: bold; font-size: 18px; text-align: center;">
				</div>
		
				<div id="tableLayer" align="center">
				</div>
				
				<div id="recordLayer" align="center">
				</div>		
				
				<div id="searchButtonsLayer" align="center">
				</div>
			</div>
			
			<script type="text/javascript">
				trackHistory = false;
				var ajaxUrl = '<?php echo $_SERVER['PHP_SELF']; ?>';
				toAjaxTableEditor('update_html','');
			</script>
		<?php
	}

	function initiateEditor()
	{
		$tableColumns['id'] = array('display_text' => 'ID', 'perms' => 'TVQSXO');
		//$tableColumns['first_name'] = array('display_text' => 'First Name', 'perms' => 'EVCTAXQSHO');
			$tableColumns['inventaris_nomeri'] = array('display_text' => 'ინვენტარის ნომერი', 'perms' => 'TVQSXO');
					
		$tableColumns['expluatacia'] = array('display_text' => 'expluatacia', 'perms' => 'EVCTAXQSHO', 'display_mask' => 'date_format(expluatacia,"%d %M %Y")', 'calendar' => '%d %B %Y','col_header_info' => 'style="width: 200px;"');
		
		$tableColumns['invdasaxeleba'] = array('display_text' => 'dasaxeleba', 'perms' => 'EVCTAXQSHO');

		$tableColumns['zoma'] = array('display_text' => 'zoma', 'perms' => 'EVCTAXQSHO');
				$tableColumns['tanxa'] = array('display_text' => 'tanxa', 'perms' => 'EVCTAXQSHO');

 	    
				$tableColumns['raodenoba'] = array('display_text' => 'raodenoba', 'perms' => 'EVCTAXQSHO');
				$tableColumns['saboloo_girebuleba'] = array('display_text' => 'sab girebuleba', 'perms' => 'EVCTAXQSHO');
				$tableColumns['narcheni_girebuleba'] = array('display_text' => 'narcheni girebuleba', 'perms' => 'EVCTAXQSHO');

				$tableColumns['pasuxismgebeli'] = array('display_text' => 'pasuxismgebeli', 'perms' => 'EVCTAXQSHO');

				$tableColumns['otaxis_nomeri'] = array('display_text' => 'otaxis nomeri', 'perms' => 'EVCTAXQSHO');
				$tableColumns['ganyofileba'] = array('display_text' => 'ganyofileba', 'perms' => 'EVCTAXQSHO');
		        $tableColumns['gadacemis_tarigi'] = array('display_text' => 'gadacemis tarigi', 'perms' => 'EVCTAXQSHO', 'display_mask' => 'date_format(expluatacia,"%d %M %Y")', 'calendar' => '%d %B %Y','col_header_info' => 'style="width: 200px;"');
				
				$tableColumns['gadacera_chamoceris_tarigi'] = array('display_text' => 'g/ch tarigi', 'perms' => 'EVCTAXQSHO', 'display_mask' => 'date_format(expluatacia,"%d %M %Y")', 'calendar' => '%d %B %Y','col_header_info' => 'style="width: 200px;"');

				$tableColumns['cvlileba'] = array('display_text' => 'cvlileba', 'perms' => 'EVCTAXQSHO');

				$tableColumns['mdgomareoba'] = array('display_text' => 'mdgomareoba', 'perms' => 'EVCTAXQSHO');
				
				$tableColumns['naecheni_girebulebis_angarishi'] = array('display_text' => 'naecheni girebulebis angarishi', 'perms' => 'EVCTAXQSHO');
				
				$tableColumns['komentari'] = array('display_text' => 'komentari', 'perms' => 'EVCTAXQSHO');
			
				
		
		$tableName = 'inventari';
		$primaryCol = 'id';
		$errorFun = array(&$this,'logError');
		$permissions = 'EAVIDQCSXHO';
		
		$this->Editor = new AjaxTableEditor($tableName,$primaryCol,$errorFun,$permissions,$tableColumns);
		$this->Editor->setConfig('tableInfo','cellpadding="1" width="1000" class="mateTable"');
		//$this->Editor->setConfig('orderByColumn','first_name');
		$this->Editor->setConfig('addRowTitle','Add Employee');
		$this->Editor->setConfig('editRowTitle','Edit Employee');
		//$this->Editor->setConfig('iconTitle','Edit Employee');
	}
	
	
	function Example1()
	{
		if(isset($_POST['json']))
		{
			session_start();
			// Initiating lang vars here is only necessary for the logError, and mysqlConnect functions in Common.php. 
			// If you are not using Common.php or you are using your own functions you can remove the following line of code.
			$this->langVars = new LangVars();
			$this->mysqlConnect();
			if(ini_get('magic_quotes_gpc'))
			{
				$_POST['json'] = stripslashes($_POST['json']);
			}
			if(function_exists('json_decode'))
			{
				$data = json_decode($_POST['json']);
			}
			else
			{
				require_once('php/JSON.php');
				$js = new Services_JSON();
				$data = $js->decode($_POST['json']);
			}
			if(empty($data->info) && strlen(trim($data->info)) == 0)
			{
				$data->info = '';
			}
			$this->initiateEditor();
			$this->Editor->main($data->action,$data->info);
			if(function_exists('json_encode'))
			{
				echo json_encode($this->Editor->retArr);
			}
			else
			{
				echo $js->encode($this->Editor->retArr);
			}
		}
		else if(isset($_GET['export']))
		{
            session_start();
            ob_start();
            $this->mysqlConnect();
            $this->initiateEditor();
            echo $this->Editor->exportInfo();
            header("Cache-Control: no-cache, must-revalidate");
            header("Pragma: no-cache");
            header("Content-type: application/x-msexcel");
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="'.$this->Editor->tableName.'.csv"');
            exit();
        }
		else
		{
			$this->displayHeaderHtml();
			$this->displayHtml();
			$this->displayFooterHtml();
		}
	}
}
$lte = new Example1();
?>
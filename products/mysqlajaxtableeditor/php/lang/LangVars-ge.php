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
// LANGUAGE variables
class LangVars
{
	//Class Common
	var $errNoSelect   = 'Error connecting to mysql: Could not select the %s database';
	var $errNoConnect  = 'Error connecting to mysql: Could not connect';
	var $errInScript   = 'An error occurred in script %s on line %s: %s';
	
	//Class AjaxTableEditor
	//function setDefaults
	var $optLike       = 'შეიცავს';
	var $optNotLike    = 'არ შეიცავს';
	var $optEq         = 'ზუსტად ემთხვევა';
	var $optNotEq      = 'ზუსტად არ ემთხვევა';
	var $optGreat      = 'მეტია ვიდრე';
	var $optLess       = 'ნაკლებია ვიდრე';
	var $optGreatEq    = 'მეტია ან ტოლი ვიდრე';
	var $optLessEq     = 'ნაკლებია ან ტოლი ვიდრე';
	
	var $ttlAddRow     = 'ჩანაწერის დამატება';
	var $ttlEditRow    = 'ჩანაწერის რედაქტირება';
	var $ttlEditMult   = 'ჩანაწერების რედაქტირება';
	var $ttlViewRow    = 'ჩანაწერის ნახვა';
	var $ttlShowHide   = 'ველების დამატება/გამოკლება';
	var $ttlOrderCols  = 'ველების მიმდევრობა';
	//function doDefault
	var $errNoAction   = 'Error in program %s action not found.';
	//function doQuery
	var $errQuery      = 'There was an error executing the following query:';
	var $errMysql      = 'mysql said:';
	// function editMultRows
	var $edit1Row      = 'You can only edit 1 row at a time.';
	// function updateRow
	var $errVal        = 'Please correct the fields in red';
	// function formatIcons
	var $ttlInfo       = 'ნახვა';
	var $ttlEdit       = 'რედაქტირება';
	var $ttlCopy       = 'კოპირება';
	var $ttlDelete     = 'წაშლა';
	// function getAdvancedSearchHtml
	var $lblSelect     = 'მონიშნეთ';
	// All Buttons
	var $btnBack       = 'უკან';
	var $btnCancel     = 'უარყოფა';
	var $btnEdit       = 'რედაქტირება';
	var $btnAdd        = 'დამატება';
	var $btnUpdate     = 'განახლება';
	var $btnView       = 'დათვალიერება';
	var $btnCopy       = 'კოპირება';
	var $btnDelete     = 'წაშლა';
	var $btnExport     = 'ექსპორტი';
	var $btnSearch     = 'ძიება';
	var $btnCSearch    = 'მოძებნილის გასუფთავება';
	var $btnASearch    = 'დეტალური ძიება';
	var $btnQSearch    = 'მარტივი ძიება';
	var $btnReset      = 'საწყისი მდგომარეობა';
	var $btnAddCrit    = 'პირობის დამატება';
	var $btnShowHide   = 'ველების დამატება/გამოკლება';
	var $btnOrderCols  = 'ველების მიმდევრობა';
	var $btnCFilters   = 'ფილტრის გასუფთავება';
	var $btnFilters    = 'გაფილტვრა';
	// function displayTableHtml
	var $ttlDispRecs   = 'გამოტანილია %s - %s, სულ %s ჩანაწერი';
	var $ttlDispNoRecs = 'მოიძებნა 0 ჩანაწერი';
	var $ttlRecords    = 'ჩანაწერები';
	var $ttlNoRecord   = '';//ჩანაწერები არ მოიძებნა
	var $lblSearch     = 'ძიება';
	var $lblPage       = 'გვერდი #:';
	var $lblDisplay    = 'გამოტანილია #:';
	var $lblMatch      = 'ჭეშმარიტია:';
	var $lblAllCrit    = 'ყველა პირობა';
	var $lblAnyCrit    = 'ერთი პირობა მაინც';
	// function showHideColumns
	var $ttlColumn     = 'ველი';
	var $ttlCheckBox   = 'გამოტანა';
	// function handleFileUpload
	var $errFileSize   = 'The %s was too big';
	var $errFileReq   = '%s is a required field';
}
?>

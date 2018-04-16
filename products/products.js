function onPageLoad()
{
	if(document.getElementById("ganyofileba").value != "")
	{		
		onDepartmentSelected();	
		document.getElementById("jgufi_laboratoria").value = decodeURIComponent(getCookie('jgufi_laboratoria_encoded'));
	}

	if(document.getElementById("jgufi_laboratoria").value != "")
	{
		ongrouplaboratorySelected()
		document.getElementById("pasuxismgebeli").value = decodeURIComponent(getCookie('pasuxismgebeli_encoded'));	
	}

}


function getCookie(c_name,value,exdays)
{
	var exdate=new Date();
	exdate.setDate(exdate.getDate() + exdays);
	var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
	document.cookie=c_name + "=" + c_value;
}

function getCookie(c_name)
{
	var i,x,y,ARRcookies=document.cookie.split(";");
	for (i=0;i<ARRcookies.length;i++)
	{
	  x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
	  y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
	  x=x.replace(/^\s+|\s+$/g,"");
	  if (x==c_name)
	  {
	      return unescape(y);
	  }
	}
}

function checkUserFormSubmit()
{
	var message = '';
	var index = 1;
///////////////////////////////////////////pirobebi//////////////////////////////////////////////////////
	var sigrdze = document.getElementById("inventaris_nomeri").value.length;
    
	
	if(sigrdze != "" && (sigrdze) !=9)
	{
		message += index.toString() + ".ინვენტარის ნომერი უნდა იყოს 9 ნიშნა.\n";
		index++;
	}
	
	var sigrdze = document.getElementById("inventaris_shida_nomeri").value.length;
	if((sigrdze)==0)
	{
		message += index.toString() + ".შეიყვანეთ ინვენტარის შიდა ნომერი.\n";
		index++;
	}
	
/////////////////////////////////////////////////////////////////////////
	
//	var shesyidvis_tarigi = document.getElementById("shesyidvis_tarigi").value;
	
//	if(shesyidvis_tarigi == '')
//	{
//		message += index.toString() + ". შეავსეთ შესყიდვის თარიღი.\n";
//		index++;
//	}
	
/////////////////////////////////////////////////////////////////////////

	var invetaris_dasaxeleba = document.getElementById("invetaris_dasaxeleba").value;

    if(invetaris_dasaxeleba == '')

	{
		message += index.toString() + ". შეიყვანეთ ინვენტარის დასახელება.\n";
		index++;
	}	
	
/////////////////////////////////////////////////////////////////////////
	var zomis_erteuli = document.getElementById("zomis_erteuli").value;

    if(zomis_erteuli == '')

	{
		message += index.toString() + ". მონიშნეთ ზომის ერთეული\n";
		index++;
	}
	
/////////////////////////////////////////////////////////////////////////

	var ganyofileba = document.getElementById("ganyofileba").value;

    if(ganyofileba == '')

	{
		message += index.toString() + ". მონიშნეთ განყოფილება\n";
		index++;
	}

/////////////////////////////////////////////////////////////////////////

	var mdgomareoba = document.getElementById("mdgomareoba").value;

    if(mdgomareoba == '')

	{
		message += index.toString() + ". მონიშნეთ მდგომარეობა\n";
		index++;
	}

	var naecheni_girebulebis_angarishi = document.getElementById("naecheni_girebulebis_angarishi").value;
	
/////////////////////////////////////////////////////////////////////////


//    if(naecheni_girebulebis_angarishi == '')

//	{
//		message += index.toString() + ". მიუთითეთ ნარჩენი ღირებულების ანგარიში.\n";
//		index++;
//	}
	
	if(document.getElementById('dasaxuriProduqti').value != 0 && document.getElementById('gadacemis_tarigi').value == '')
	{
		message += index.toString() + ". გადაწერის შემთხვევაში მიუთითეთ გადაცემის თარიღი.\n";
		index++;
	}


//////////////////////===============================================================//////////////////////////

	if (message != '')
		alert(message);
	else
		document.formProduct.submit();
}


/////////////////////////////////////////////////////////////////////////


function rewrite()
{
	
	$("#ganyofileba").val("");
	$("#jgufi_laboratoria").html("");
	$("#jgufi_laboratoria").append(new Option("" ,""));
	$("#pasuxismgebeli").html("");
	$("#pasuxismgebeli").append(new Option("" ,""));

	document.getElementById('editbutton').innerHTML = 'დამატება';
	document.getElementById('formtitle').innerHTML = 'ინვენტარის დამატება (შეავსეთ <span style="color:#F00;">*</span>-იანი ველები აუცილებლად)';
	document.getElementById('dasaxuriProduqti').value = document.getElementById('mtvleli').value;
	document.getElementById('gadacemis_tarigi').value = '';
	document.getElementById('gadacera_chamoceris_tarigi').value = '';
	document.getElementById('mtvleli').value = 0;
	
	
	
	document.getElementById('rewrite').style.display='none';
}



function addproducts()
{
	window.location = "newEdit_products.php?";
}

function goToProductsPage()
{
	window.location = "products.php";
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
function saboloofasi()
{
	if (document.getElementById("raodenoba").value == '') var raodenoba=0; else raodenoba =document.getElementById("raodenoba").value;
	if (document.getElementById("Tanxa").value == '') var tanxa=0; else tanxa =document.getElementById("Tanxa").value;

	
	document.getElementById("saboloo_girebuleba").value=parseFloat(tanxa) * parseFloat(raodenoba);
	
}

function searchproduct()
{
	var message = '';
	var index = 1;
	
//-----------------------------------------------------------------------------------------------------
	
	var sigrdze = document.getElementById("inventaris_nomeri").value.length;
	if (sigrdze != '0' && sigrdze != '9')		
	{
		message += index.toString() + ".ინვენტარის ნომერი უნდა იყოს 9 ნიშნა.\n";
		index++;
	}	

//-----------------------------------------------------------------------------------------------------

	
	var sigrdze = document.getElementById("tarigi_dan").value.length;
	if (sigrdze >0 && sigrdze != '10')
	{
		message += index.toString() + ".შესყიდვის თარიღი (დან) უნდა იყოს 10 სიმბოლიანი.\n";
		index++;
	}

	var sigrdze = document.getElementById("tarigi_mde").value.length;
	if (sigrdze >0 && sigrdze != '10')
	{
		message += index.toString() + ".შესყიდვის თარიღი (მდე) უნდა იყოს 10 სიმბოლიანი.\n";
		index++;
	}
	
//-----------------------------------------------------------------------------------------------------

	
	var sigrdze = document.getElementById("shesyidvis_tarigi_dan").value.length;
	if (sigrdze >0 && sigrdze != '10')
	{
		message += index.toString() + ".შესყიდვის თარიღი (დან) უნდა იყოს 10 სიმბოლიანი.\n";
		index++;
	}

	var sigrdze = document.getElementById("shesyidvis_tarigi_mde").value.length;
	if (sigrdze >0 && sigrdze != '10')
	{
		message += index.toString() + ".შესყიდვის თარიღი (მდე) უნდა იყოს 10 სიმბოლიანი.\n";
		index++;
	}

//-----------------------------------------------------------------------------------------------------

	var sigrdze = document.getElementById("chamoceris_tarigi_dan").value.length;
	if (sigrdze >0 && sigrdze != '10')
	{
		message += index.toString() + ".შესყიდვის თარიღი (დან) უნდა იყოს 10 სიმბოლიანი.\n";
		index++;
	}

	var sigrdze = document.getElementById("chamoceris_tarigi_mde").value.length;
	if (sigrdze >0 && sigrdze != '10')
	{
		message += index.toString() + ".შესყიდვის თარიღი (მდე) უნდა იყოს 10 სიმბოლიანი.\n";
		index++;
	}
	
//-----------------------------------------------------------------------------------------------------

	var sigrdze = document.getElementById("gadacemis_tarigi_dan").value.length;
	if (sigrdze >0 && sigrdze != '10')
	{
		message += index.toString() + ".შესყიდვის თარიღი (დან) უნდა იყოს 10 სიმბოლიანი.\n";
		index++;
	}

	var sigrdze = document.getElementById("gadacemis_tarigi_mde").value.length;
	if (sigrdze >0 && sigrdze != '10')
	{
		message += index.toString() + ".შესყიდვის თარიღი (მდე) უნდა იყოს 10 სიმბოლიანი.\n";
		index++;
	}
//-----------------------------------------------------------------------------------------------------
	
	if (message != '')
	 alert(message);
	 else 
	 document.formsearch.submit();
}


function cleartext()
{
	document.getElementById('inventaris_nomeri').value = '';
	document.getElementById('CPV').value = '';
	document.getElementById('ganyofileba').value = '';
	document.getElementById('jgufi_laboratoria').value = '';
	document.getElementById('pasuxismgebeli').value = '';
	document.getElementById('otaxis_nomeri').value = '';
	document.getElementById('zomis_erteuli').value = '';
	document.getElementById('chamocerili_inventari').checked = false;
	document.getElementById('gadacerili_inventari').checked = false;
	document.getElementById('tarigi_dan').value = '';
	document.getElementById('tarigi_mde').value = '';
	document.getElementById('shesyidvis_tarigi_dan').value = '';
	document.getElementById('shesyidvis_tarigi_mde').value = '';
	document.getElementById('chamoceris_tarigi_dan').value = '';
	document.getElementById('chamoceris_tarigi_mde').value = '';
	document.getElementById('gadacemis_tarigi_dan').value = '';
	document.getElementById('gadacemis_tarigi_mde').value = '';
	document.getElementById('girebuleba_dan').value = '';
	document.getElementById('girebuleba_mde').value = '';
	document.getElementById('narch_girebuleba_dan').value = '';
	document.getElementById('narch_girebuleba_mde').value = '';
	document.getElementById('saboloo_girebuleba_dan').value = '';
	document.getElementById('saboloo_girebuleba_mde').value = '';
	document.getElementById('raodenoba_dan').value = '';
	document.getElementById('raodenoba_mde').value = '';

	searchproduct();
}

////////////////////////////////////////////////////// აჯაქსი ///////////////////////////////

function onDepartmentSelect()
{	
	$.ajax({
	  type: "POST",
	  url: 'getAjaxXmlsproducts.php',
	  dataType: "xml",
	  data: { ganyofileba: document.getElementById('ganyofileba').value},
	  async: false,
	  success: 
	  		function(xml) 
			{
				$("#jgufi_laboratoria").html("");
				$("#jgufi_laboratoria").append(new Option("" ,""));
				$("#pasuxismgebeli").html("");
				$("#pasuxismgebeli").append(new Option("" ,""));
				$(xml).find("groupLaboratory").each(function(){
					//alert($(this).find("id").text() + "-" + $(this).find("name").text());
					$("#jgufi_laboratoria").append(new Option($(this).find("name").text() ,$(this).find("name").text()));
					});
				
				$("#pasuxismgebeli").html("");
				$("#pasuxismgebeli").append(new Option($(this).find("firstName").text() ,$(this).find("LastName").text()));
				
				
				$(xml).find("employee").each(function(){
					//alert($(this).find("firstName").text() + "-" + $(this).find("lastName").text());
					var value = $(this).find("firstName").text() + " " + $(this).find("lastName").text()
					$("#pasuxismgebeli").append(new Option(value, value));
					});
  		    }
	});
}


/////////////////////////////////////////////////


function onGroupLaboratorySelect()
{	
	$.ajax({
	  type: "POST",
	  url: 'getAjaxXmlsproducts.php',
	  dataType: "xml",
	  data: {jgufiLaboratoria: document.getElementById('jgufi_laboratoria').value},
	  async: false,
	  success: 
	  		function(xml) 
			{				
				$("#pasuxismgebeli").html("");
				$("#pasuxismgebeli").append(new Option("" ,""));
					$(xml).find("employee").each(function(){
					//alert($(this).find("firstName").text() + "-" + $(this).find("lastName").text());
					var value = $(this).find("firstName").text() + " " + $(this).find("lastName").text()
					$("#pasuxismgebeli").append(new Option(value, value));
					});
  		    }
	});
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//ქმნის ობიექტს ajax მოთხოვნის გასაგზავნად
function getHTTPObject()
{
if (window.ActiveXObject) 
       return new ActiveXObject("Microsoft.XMLHTTP");
   else if (window.XMLHttpRequest) 
       return new XMLHttpRequest();
   else {
      alert("Your browser does not support AJAX.");
      return null;
   }
}
//.................................................................................................................

//ajax მოთხოვნის გასაგზავნი ფუნქცია
function AjaxRequest(url,paramStr,async,cfunc)
{ 
 xmlhttp = getHTTPObject();
 if (this.xmlhttp == null) return false;
 if(async) xmlhttp.onreadystatechange=cfunc;
 xmlhttp.open("POST",url,async);
 xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 
 if (xmlhttp.overrideMimeType) xmlhttp.overrideMimeType('text/xml');
 xmlhttp.send(encodeURI(paramStr));
 if(!async) cfunc();
}
//................................................................................................................

function onDepartmentSelected()
{
 var parameters = "ganyofileba="+document.getElementById('ganyofileba').value;
 AjaxRequest("getAjaxXmlsproducts.php", parameters,false,function()
 {
  if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
   //alert(xmlhttp.responseText);
   document.getElementById('jgufi_laboratoria').innerHTML = "<option value=''></option>";
   document.getElementById('pasuxismgebeli').innerHTML = "<option value=''></option>";
   xmlDoc = xmlhttp.responseXML;
   
   groupLaboratories = xmlDoc.getElementsByTagName("groupLaboratories")[0].getElementsByTagName("groupLaboratory");
   
			   for (i=0;i<groupLaboratories.length;i++)// masivis sigrdze
			   {
				   groupLaboratory = groupLaboratories[i].getElementsByTagName("name")[0].firstChild.nodeValue;
				   
				   var jgufi_laboratoria = document.getElementById('jgufi_laboratoria');
				   jgufi_laboratoria.options[jgufi_laboratoria.options.length] = new Option(groupLaboratory, groupLaboratory);
			   }
    
				        employee=xmlDoc.getElementsByTagName("employee");
			   
						   for (i=0;i<employee.length;i++)
						   {
							   employeefirstName = employee[i].getElementsByTagName("firstName")[0].firstChild.nodeValue;
							   employeelastName = employee[i].getElementsByTagName("lastName")[0].firstChild.nodeValue;
							  // alert("wwewewe1");
							   var pasuxismgebeli = document.getElementById('pasuxismgebeli');
							   var fullname= employeefirstName + " " + employeelastName;
							   pasuxismgebeli.options[pasuxismgebeli.options.length] = new Option(fullname, fullname);
						   }
					
	
    }
});
 
 }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


function ongrouplaboratorySelected()
{
 var parameters = "jgufiLaboratoria="+document.getElementById('jgufi_laboratoria').value;
 AjaxRequest("getAjaxXmlsproducts.php", parameters,false,function()
 {
  if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
  // alert(xmlhttp.responseText);
   document.getElementById('pasuxismgebeli').innerHTML = "<option value=''></option>";
   xmlDoc = xmlhttp.responseXML;   
   employee = xmlDoc.getElementsByTagName("employee");
   
			   for (i=0;i<employee.length;i++)
			   {
				   employeefirstName = employee[i].getElementsByTagName("firstName")[0].firstChild.nodeValue;
				   employeelastName = employee[i].getElementsByTagName("lastName")[0].firstChild.nodeValue;
				  // alert("wwewewe1");
				   var pasuxismgebeli = document.getElementById('pasuxismgebeli');
				   var fullname= employeefirstName + " " + employeelastName;
				   pasuxismgebeli.options[pasuxismgebeli.options.length] = new Option(fullname, fullname);
			   }
    
    }
});
 
 }

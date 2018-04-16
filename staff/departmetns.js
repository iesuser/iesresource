// JavaScript Document
function checkDepartamentFormSubmit()
{
	var message = '';
	var index = 1;
///////////////////////////////////////////pirobebi//////////////////////////////////////////////////////

	var name = document.getElementById("name").value;

    if(name == '')

	{
		message += index.toString() + ". შეიყვანეთ დეპარტამენტის დასახელება.\n";
		index++;
	}	
	
	if (message != '')
		alert(message);
	else
		document.formDepartment.submit();
}


function goToDepartametnsPage()
{
	window.location = "departments.php";
}


function checkGroupLaboratoryFormSubmit()
{
	var message = '';
	var index = 1;

	var department_id = document.getElementById("department_id").value;

    if(department_id == '')

	{
		message += index.toString() + ". მონიშნეთ დეპარტამენტი.\n";
		index++;
	}


	var name = document.getElementById("name").value;

    if(name == '')

	{
		message += index.toString() + ". შეიყვანეთ ლაბორატორიის/ჯგუფის სახელწოდება.\n";
		index++;
	}	
	
	if (message != '')
		alert(message);
	else
		document.formGroupLaboratory.submit();
}


function checkStaffFormSubmit()
{
	var message = '';
	var index = 1;
///////////////////////////////////////////pirobebi//////////////////////////////////////////////////////

	var dep_id = document.getElementById("dep_id").value;
    if(dep_id == '')
	{
		message += index.toString() + ". მონიშნეთ დეპარტამენტის სახელწოდება.\n";
		index++;
	}
		
	var first_name = document.getElementById("first_name").value;
    if(first_name == '')
	{
		message += index.toString() + ". მიუთითეთ თანამშრომლის სახელი.\n";
		index++;
	}
	
	var last_name = document.getElementById("last_name").value;
    if(last_name == '')
	{
		message += index.toString() + ".  მიუთითეთ თანამშრომლის გვარი.\n";
		index++;
	}

	if (message != '')
		alert(message);
	else
		document.formStaff.submit();
}


function onDepartamentSelect()
{	
	$.ajax({
	  type: "POST",
	  url: 'getAjaxXmlsStaff.php',
	  dataType: "xml",
	  data: { dep_id: document.getElementById('dep_id').value},
	  async: false,
	  success: 
	  		function(xml) 
			{
				$("#gr_lb_id").html("");
				$("#gr_lb_id").append(new Option($(this).find("name").text() ,$(this).find("id").text()));
				$(xml).find("groupLaboratories").each(function(){
					//alert($(this).find("id").text() + "-" + $(this).find("name").text());
					$("#gr_lb_id").append(new Option($(this).find("name").text() ,$(this).find("id").text()));
					});
  		    }
	});
}



function showHideRows()
{
 if( document.getElementById("head_of_department").checked==true)
 {
	 document.getElementById("password1").style.display = 'table-row';
 }
  
else
{
	 document.getElementById("password1").style.display = 'none';
}
  
}
var inventory_result_table = null

$(document).ready(function() {
  $.datetimepicker.setLocale('ka');

  $('.datepicker').datetimepicker({
	  datepicker:true,
	  timepicker:false,
	  format:'Y-m-d',
	});
  
  set_calendar_properties("button-tarigi-dan", "tarigi_dan");
	set_calendar_properties("button-tarigi-mde", "tarigi_mde");


  set_calendar_properties("button-shesyidvis-tarigi-dan", 'shesyidvis_tarigi_dan');
  set_calendar_properties("button-shesyidvis-tarigi-mde", 'shesyidvis_tarigi_mde');

  set_calendar_properties("button-chamoceris-tarigi-dan", 'chamoceris_tarigi_dan');
  set_calendar_properties("button-chamoceris-tarigi-mde", 'chamoceris_tarigi_mde');

  set_calendar_properties("button-gadacemis-tarigi-dan", 'gadacemis_tarigi_dan');
  set_calendar_properties("button-gadacemis-tarigi-mde", 'gadacemis_tarigi_mde');


	$('#inventaris_nomeri').mask('AAAAAAAAA');
	$('#otaxis_nomeri').mask('000')

  mask_date_input('tarigi_dan');
  mask_date_input('tarigi_mde');

	mask_date_input('shesyidvis_tarigi_dan');
	mask_date_input('shesyidvis_tarigi_mde');

	mask_date_input('chamoceris_tarigi_dan');
	mask_date_input('chamoceris_tarigi_mde');

	mask_date_input('gadacemis_tarigi_dan');
	mask_date_input('gadacemis_tarigi_mde');

	mask_float_input('girebuleba_dan');
	mask_float_input('girebuleba_mde');

	mask_float_input('narch_girebuleba_dan');
	mask_float_input('narch_girebuleba_mde');

	mask_float_input('saboloo_girebuleba_dan');
	mask_float_input('saboloo_girebuleba_mde');

	mask_int_input('raodenoba_dan');
	mask_int_input('raodenoba_mde');


	$('div.inventory-search-form input, div.inventory-search-form select').change(function(){
		Cookies.set(this.name, this.value, { expires: 7, path: '' });
  });

  $('div.inventory-search-form input, div.inventory-search-form select').each(function(index, elem){
  	$(elem).val(Cookies.get(this.name));
  })

  load_data()

 
});


function load_data(){
	$.ajax({
		method: "POST",
		url: "get_inventory_data.php",
		// url: "deleteme.js",
		dataType: "script",
		data: { 
						inventaris_nomeri: $('#inventaris_nomeri').val(),
						CPV: $('#CPV').val(),
						ganyofileba: $('#ganyofileba').val() ,
						jgufi_laboratoria: $('#jgufi_laboratoria').val(),
						pasuxismgebeli: $('#pasuxismgebeli').val(),
						otaxis_nomeri: $('#otaxis_nomeri').val(),
						zomis_erteuli: $('#zomis_erteuli').val(),
						tarigi_dan: $('#tarigi_dan').val(),
						tarigi_dan: $('#tarigi_dan').val(),
						tarigi_dan: $('#tarigi_dan').val(),
						tarigi_dan: $('#tarigi_dan').val(),
						tarigi_dan: $('#tarigi_dan').val(),
						tarigi_dan: $('#tarigi_dan').val(),
						tarigi_mde: $('#tarigi_mde').val() ,
						shesyidvis_tarigi_dan: $('#shesyidvis_tarigi_dan').val(),
						shesyidvis_tarigi_mde: $('#shesyidvis_tarigi_mde').val(),
						chamoceris_tarigi_dan: $('#chamoceris_tarigi_dan').val(),
						chamoceris_tarigi_mde: $('#chamoceris_tarigi_mde').val(),
						gadacemis_tarigi_dan: $('#gadacemis_tarigi_dan').val(),
						gadacemis_tarigi_mde: $('#gadacemis_tarigi_mde').val(),
						girebuleba_dan: $('#girebuleba_dan').val(),
						girebuleba_mde: $('#girebuleba_mde').val(),
						narch_girebuleba_dan: $('#narch_girebuleba_dan').val(),
						narch_girebuleba_mde: $('#narch_girebuleba_mde').val(),
						saboloo_girebuleba_dan: $('#saboloo_girebuleba_dan').val(),
						saboloo_girebuleba_mde: $('#saboloo_girebuleba_mde').val(),
						raodenoba_dan: $('#raodenoba_dan').val(),
						raodenoba_mde: $('#raodenoba_mde').val(),
						chamocerili_inventari: $('#chamocerili_inventari').is(":checked"),
						gadacerili_inventari: $('#gadacerili_inventari').is(":checked")

					},
		beforeSend: function(xhr){
			console.log("beforeSend")
			$("#loader").show()
			$("#container-inventory-result-table").html('<table id="inventory-result-table" style="width:100%" class="display table table-sm table-bordered table-striped table-hover text-center align-middle" ></table>')
			window.scrollTo(0, 0);
			if (inventory_result_table !== null){
				// inventory_result_table.clear()
				// inventory_result_table.destroy()
			}
		},
		success: function(html){
			console.log(html)
			$("#loader").hide()
			inventory_result_table = $('#inventory-result-table').DataTable({
        data: dataSet,
        "stateSave": true,
        columns: [
            { title: "#" },
            { title: "შიდა ნომერი" },
            { title: "ნომერი" },
            { title: "აქტის ნომერი" },
            { title: "შესყიდვის თარიღი" },
            { title: "ჩამოწერის თარიღი" },
            { title: "CPV" },
            { title: "სახელწოდება" },
            { title: "მოდელი" },
            { title: "სეროული #" },
            { title: "ზომის ერთეული" },
            { title: "ღირებულება" },
            { title: "რაოდენობა" },
            { title: "ღირებულება (ჯამში)" },
            { title: "ნარჩ. ღირებულება" },
            { title: "განყოფილება" },
            { title: "ჯგუფი /  ლაბორატორია" },
            { title: "პას. პირი" },
            { title: "ოთახის #" },
            { title: "გადაცემის თარიღი" },
            { title: "ჩამოწერის თარიღი" },
            { title: "ცვლილება" },
            { title: "მდგომარეობა" },
            { title: "ნ.ღ.ა." },
            { title: "დამატებითი ინფორმაცია" },

        ],
				columnDefs: [
            { targets: 2, visible: false},
            { targets: 3, visible: false},
            { targets: 5, visible: false},
            { targets: 6, visible: false},
            { targets: 9, visible: false},
            { targets: 10, visible: false},
            { targets: 11, visible: false},
            { targets: 14, visible: false},
            { targets: 16, visible: false},
            { targets: 19, visible: false},
            { targets: 20, visible: false},
            { targets: 21, visible: false},
            { targets: 22, visible: false},
            { targets: 23, visible: false},
            { targets: 24, visible: false},
        ],
				// dom: 'lfrtip',
				 // "dom": '<"top"Bl>rt<"bottom"iflp><"clear">',
				dom: "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        // buttons: [ 'colvis' ],
				buttons: [
          {
              extend: 'colvis',
              columns: ':not(.noVis)'
          },
        ],
        language: {
            buttons: {
                colvis: 'სვეტების გამოჩენა / დამალვა'
            },
            "sEmptyTable":     "ცხრილში არ არის მონაცემები",
				    "sInfo":           "ნაჩვენებია ჩანაწერები _START_–დან _END_–მდე, _TOTAL_ ჩანაწერიდან",
				    "sInfoEmpty":      "ნაჩვენებია ჩანაწერები 0–დან 0–მდე, 0 ჩანაწერიდან",
				    "sInfoFiltered":   "(გაფილტრული შედეგი _MAX_ ჩანაწერიდან)",
				    "sInfoPostFix":    "",
				    "sInfoThousands":  ".",
				    "sLengthMenu":     "აჩვენე _MENU_ ჩანაწერი",
				    "sLoadingRecords": "იტვირთება...",
				    "sProcessing":     "მუშავდება...",
				    "sSearch":         "ძიება:",
				    "sZeroRecords":    "არაფერი მოიძებნა",
				    "oPaginate": {
				        "sFirst":    "პირველი",
				        "sLast":     "ბოლო",
				        "sNext":     "შემდეგი",
				        "sPrevious": "წინა"
				    },
				    "oAria": {
				        "sSortAscending":  ": სვეტის დალაგება ზრდის მიხედვით",
				        "sSortDescending": ": სვეტის დალაგება კლების მიხედვით"
				    }
        },
        "iDisplayLength": 25,
    	});


			$('#inventory-result-table').on('click', 'tbody tr', function() {
				data = inventory_result_table.row(this).data()
				if (typeof data != "undefined"){
					window.location = 'newEdit_products.php?id=' + data[0]
				} 
			})
			
		}
	});



}




function set_calendar_properties(button_id, input_id){
  $('#' + button_id).click(function(){
    $('#' + input_id).datetimepicker('show');
  });
  $('#' + input_id).unbind( "mousewheel");
}

// function onPageLoad()
// {
// 	console.log("hhhhhh+++++++++++++++++++++++++++++++++++++++++++++++++++")
// 	if(document.getElementById("ganyofileba").value != "")
// 	{
// 		onDepartmentSelected();
// 		document.getElementById("jgufi_laboratoria").value = decodeURIComponent(getCookie('jgufi_laboratoria_encoded'));
// 	}

// 	if(document.getElementById("jgufi_laboratoria").value != "")
// 	{
// 		ongrouplaboratorySelected()
// 		document.getElementById("pasuxismgebeli").value = decodeURIComponent(getCookie('pasuxismgebeli_encoded'));
// 	}
// }


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


function clean_inventory_search_form(){
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

function on_department_selected(){
	ganyofileba = $('#ganyofileba').val()	
	$("#jgufi_laboratoria").html("<option value=''></option>")
	$("#pasuxismgebeli").html("<option value=''></option>")

	if (ganyofileba == "") return

	$.ajax({
		method: "POST",
		url: "getAjaxXmlsproducts.php",
		data: {
			ganyofileba: ganyofileba
		},
		dataType: "xml",
		success: function(xml){
			$(xml).find('groupLaboratory').each(function (index, el){
				laboratory = $(el).find('name:first').html()
				$('#jgufi_laboratoria').append($('<option>', {value: laboratory, text: laboratory}));					
			})

			$(xml).find('employee').each(function (index, el){
				 fullname = $(el).find("firstName:first").html() + ' ' + $(el).find("lastName:first").html()
				 $('#pasuxismgebeli').append($('<option>', {value: fullname, text: fullname}));
			})			
		}
	});
}


function on_laboratory_selected(){
	$("#pasuxismgebeli").html("<option value=''></option>")
	jgufi_laboratoria = $('#jgufi_laboratoria').val()
	if (jgufi_laboratoria == "") return
		
	$.ajax({
		method: "POST",
		url: "getAjaxXmlsproducts.php",
		data: {
			jgufiLaboratoria: jgufi_laboratoria
		},
		dataType: "xml",
		success: function(xml){

			$(xml).find('employee').each(function (index, el){
				 fullname = $(el).find("firstName:first").html() + ' ' + $(el).find("lastName:first").html()
				 $('#pasuxismgebeli').append($('<option>', {value: fullname, text: fullname}));
			})			
		}
	});
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
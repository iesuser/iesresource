$( document ).ready(function() {
 	$.datetimepicker.setLocale('ka');

	$('.datepicker').datetimepicker({
	  datepicker:true,
	  timepicker:false,
	  format:'Y-m-d',
	});

  set_calendar_properties("button-shesyidvis-tarigi", "shesyidvis_tarigi");
  set_calendar_properties("button-chamoceris-tarigi", "chamoceris_tarigi");
  set_calendar_properties("button-gadacemis-tarigi", "gadacemis_tarigi");
  set_calendar_properties("button-gadacera-chamoceris-tarigi", "gadacera_chamoceris_tarigi");



	$("#form-product").submit(function( event ) {

		if(!form_product_validation()){
			console.log("stoop")
		    event.preventDefault();
		}
	});

	$('#inventaris_shida_nomeri').mask('AAAAAAAAA');
	$('#inventaris_nomeri').mask('AAAAAAAAA');
	mask_date_input('shesyidvis_tarigi');
	mask_date_input('chamoceris_tarigi');
	mask_date_input('gadacemis_tarigi');
	mask_date_input('gadacera_chamoceris_tarigi');
	mask_float_input('Tanxa');
	mask_int_input('raodenoba');
	mask_float_input('saboloo_girebuleba');
	mask_float_input('narcheni_girebuleba');
	mask_float_input('naecheni_girebulebis_angarishi');
	$('#otaxis_nomeri').mask('000')

});


function calculate_price(){
	raodenoba = $('#raodenoba').val();
	raodenoba = (raodenoba != '') ? parseFloat(raodenoba) : 0;

	tanxa = $('#Tanxa').val();
	tanxa = (tanxa != '') ? parseFloat(tanxa) : 0;

	$('#saboloo_girebuleba').val(raodenoba * tanxa)

}


function form_element_is_empty(element_id){
	var el = $('#' + element_id);
  if (el.val() == "" ){
		el.removeClass('is-valid');
    el.addClass('is-invalid');
    return true
  }
	return false
}


function form_product_validation(){
  var rtn = true;

	$("#form-product :input:not(:button)").each(function() {
		if($(this).is('input')){
			$(this).val($.trim($(this).val()))
		}
		$(this).addClass("is-valid");
	});

  var inventaris_shida_nomeri = $('#inventaris_shida_nomeri');
  inventaris_shida_nomeri.val($.trim(inventaris_shida_nomeri.val()))
  if (inventaris_shida_nomeri.val().length != 9 ){
		inventaris_shida_nomeri.removeClass('is-valid');
    inventaris_shida_nomeri.addClass('is-invalid');
    rtn = false;
		console.log(1)
  }

	var inventaris_nomeri = $('#inventaris_nomeri');
	inventaris_nomeri.val($.trim(inventaris_nomeri.val()))
	if (inventaris_nomeri.val().length != 0 && inventaris_nomeri.val().length != 9){
		inventaris_nomeri.removeClass('is-valid');
		inventaris_nomeri.addClass('is-invalid');
		rtn = false;
		console.log(2)
	}

	if (form_element_is_empty("invetaris_dasaxeleba")) {rtn = false;console.log(3)}
	if (form_element_is_empty("seriuli_nomeri")) {rtn = false;console.log(4)}
	if (form_element_is_empty("zomis_erteuli")) {rtn = false;console.log(5)}
	if (form_element_is_empty("ganyofileba")) {rtn = false;console.log(6)}
	if (form_element_is_empty("mdgomareoba")) {rtn = false;console.log(7)}

  return rtn;
}

function set_calendar_properties(button_id, input_id){
  $('#' + button_id).click(function(){
    $('#' + input_id).datetimepicker('show');
  });
  $('#' + input_id).unbind( "mousewheel");
}


function on_department_select(){
	if ($('#ganyofileba').val() != ""){
		$.ajax({
		  type: "POST",
		  url: 'getAjaxXmlsproducts.php',
		  dataType: "xml",
		  data: { ganyofileba: document.getElementById('ganyofileba').value},
		  async: false,
		  success:
		  		function(xml){
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
	}else{
		$('#jgufi_laboratoria').val("")
		$('#pasuxismgebeli').val("")
	}
}


function on_groupLaboratory_select(){
	if($('#jgufi_laboratoria').val() != ""){
		$.ajax({
		  type: "POST",
		  url: 'getAjaxXmlsproducts.php',
		  dataType: "xml",
		  data: {jgufiLaboratoria: document.getElementById('jgufi_laboratoria').value},
		  async: false,
		  success:
		  		function(xml){
	  				$("#pasuxismgebeli").html("");
	  				$("#pasuxismgebeli").append(new Option("" ,""));
	  				$(xml).find("employee").each(function(){
	  					var value = $(this).find("firstName").text() + " " + $(this).find("lastName").text()
	  					$("#pasuxismgebeli").append(new Option(value, value));
	  				});
	  		  }
		});
	}else{
		$('#pasuxismgebeli').val("")
	}
}

function goToProductsPage(){
	window.location = "products.php";
}

function rewrite()
{

	$("#ganyofileba").val("");
	$("#jgufi_laboratoria").html("");
	$("#jgufi_laboratoria").append(new Option("" ,""));
	$("#pasuxismgebeli").html("");
	$("#pasuxismgebeli").append(new Option("" ,""));
	$("#editbutton").html("დამატება");
	$("#formtitle").html('ინვენტარის დამატება');
	$("#dasaxuriProduqti").val($("#mtvleli").val());
	$("#gadacemis_tarigi").val("");
	$("#gadacera_chamoceris_tarigi").val("");
	$("#mtvleli").val("0");
	$("#rewrite_btn").attr("style","display: none");
	// document.getElementById('rewrite').style.display='none';
}

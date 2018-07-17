$( document ).ready(function() {
    date_filter(1)
 	$.datetimepicker.setLocale('ka');

	$('.datepicker').datetimepicker({
	  datepicker:true,
	  timepicker:false,
	  format:'Y-m-d',
	});

	set_calendar_properties("button-tarigi-dan", "tarigi_dan");
	set_calendar_properties("button-tarigi-mde", "tarigi_mde");

	mask_date_input('tarigi_dan');
  mask_date_input('tarigi_mde');
});


function set_calendar_properties(button_id, input_id){
  $('#' + button_id).click(function(){
    $('#' + input_id).datetimepicker('show');
  });
  $('#' + input_id).unbind( "mousewheel");
}


// ასუფთავებს ფილტრის input-ებს
function clear_text(){
	$('select#ganyofileba').val('');
	$('select#jgufi_laboratoria').val('');
	$('select#staff').val('');

	$('input[type="text"]').val('');

		// წაშლის ანიმაცია
	$("#filter_table").addClass('animated shake');
	setTimeout(function(){
  		$('#filter_table').removeClass('animated shake');
	}, 1000);
	return;
}


// ajax requestebis გაგზვნა-მიღება

function date_filter(currnet_page){
	$.ajax({
		type: "POST",
		url: "get_turnstile_data.php",
		data: {
		  	start_date: $("#tarigi_dan").val(),
		  	end_date: $("#tarigi_mde").val(),
		  	row_count: $("#row_count option:selected").val(),
		  	employee: $("#staff option:selected").val(),
		  	laboratory: $("#jgufi_laboratoria option:selected").val(),
		  	department: $("#ganyofileba option:selected").val(),
			filter_date_frequency: $('input[name=optradio]:checked').val(),
      page: currnet_page
		},
		success: function(responce){
			$("#table_content").html(responce);
		},
		error: function (xhr, textStatus, errorThrown) {
        console.log(xhr.responseText);
    	}
	});
}


// function change_department



function select_department(){
	$.ajax({
		type: "POST",
		url: "ajax_requests.php",
		dataType: "json",
		data: {
		  	department: $("#ganyofileba option:selected").val(),
		},
		success: function(responce){
			// console.log(JSON.parse(responce));
			//console.log(responce);

			$('#jgufi_laboratoria').html($('<option>',));
			for (i in responce['laboratory']){
				$('#jgufi_laboratoria').append($('<option>', {value: responce['laboratory'][i].id, text: responce['laboratory'][i].name}));
			}
			$('#staff').html($('<option>',));
			for (i in responce['staff']){
				$('#staff').append($('<option>', {value: responce['staff'][i].id, text: responce['staff'][i].first_name + ' ' + responce['staff'][i].last_name}));
			}

		},
		error: function (xhr, textStatus, errorThrown) {
        	console.log(xhr.responseText);
    	}
	});
}

function select_laboratory(){
	$.ajax({
		type: "POST",
		url: "ajax_requests.php",
		dataType: "json",
		data: {
		  	laboratory: $("#jgufi_laboratoria option:selected").val()
		},
		success: function(responce){
			//console.log(responce);
			$('#staff').html($('<option>',));
			$('#staff').html($('<option>',));
			for (i in responce['staff']){
				$('#staff').append($('<option>', {value: responce['staff'][i].id, text: responce['staff'][i].first_name + ' ' + responce['staff'][i].last_name}));
			}
		},
		error: function (xhr, textStatus, errorThrown) {
        	console.log(xhr.responseText);
    	}
	});
}

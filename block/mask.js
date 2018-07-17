function  mask_date_input(element_id){
	$('#' + element_id).mask('A000-B0-C0', {'translation': {
			A: {pattern: /[1-2]/},
			B: {pattern: /[0-1]/},
			C: {pattern: /[0-3]/}
		  }
		});
}

function  mask_float_input(element_id){
	$('#' + element_id).mask('AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', {'translation': {
			A: {pattern: /[0-9.]/},
			}
		});
}

function  mask_int_input(element_id){
	$('#' + element_id).mask('0000000000000000000000000000000');
}

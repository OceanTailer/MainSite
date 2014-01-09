$(document).ready(function () {

	$('#pushover_extra').hide();
	
	if ($('#pushover_enabled').val() == 1) {
		$('#pushover_extra').show();
	}
	
	$('#pushover_enabled').change(function() {
		if ($(this).val() == 1) {
			$('#pushover_extra').show();
		}
		else {
			$('#pushover_extra').hide();
		}
	});

	//Delete existing line item
	$('body').on('click', '#delete_existing_pushover_user', function(e){
		e.preventDefault();
			
		var pushover_user_id = $(this).closest('div').attr("id");
		var pushover_user_id_exploded = pushover_user_id.split('-');
		pushover_user_id = pushover_user_id_exploded[1];
				
		$.ajax({
			type: "POST",
			url:  sts_base_url + "/settings/deletepushoveruser/" + pushover_user_id,
			data: "delete=true",
			success: function(html){
				
			}
		 });
		 
		 $(this).parent('p').remove(); 

		
    });
	
		
});
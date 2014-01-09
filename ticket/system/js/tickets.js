$(document).ready(function () {

	//toggle all button
    $('.toggle_all_tickets').click(function () {
		 $('.selection_checkbox').each(function () {
			if ($(this).prop('checked') == true) {
				//already checked, going to remove
				$(this).removeAttr('checked');
			}
			else {
				$(this).prop('checked','checked');
			}
		 });
    });
	
	
	$('#action').change(function (e) {
		if ($('#action').val() == 'delete') {
			$('#submit').addClass("red");
		}
		else {
			$('#submit').removeClass("red");
		}
	});
	
	//check bulk delete action
	$('#submit').click(function (e) {
		if ($('#action').val() == 'delete') {
			if (confirm("Are you sure you wish to delete these tickets?")) {
				
			}
			else {
				e.preventDefault();
			}
		}
	});
});
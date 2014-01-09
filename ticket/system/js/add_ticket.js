$(document).ready(function () {


	$('#extra_settings').hide();
	

	
	$('#show_extra_settings').click(function() {
	  $('#extra_settings').show();
	  $(this).parent('p').remove();
	});



});
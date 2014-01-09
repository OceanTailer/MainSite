function populate_users(department_id, selected_user_id) {

	//quicker to replace the entire html select
	$('#user_id').replaceWith('<select name="user_id" id="user_id"><option value="">loading...</option></select>');

	$.ajax({
		type: "GET",
		cache: false,
		dataType: "json",
		url:  sts_base_url + "/data/users/?department_id=" + department_id,
		success: function(data){			
			html = '<option value=""></option>';

			if (data !== null) {
				$.each(
					data,
					function (index, value) {
						if (selected_user_id == value.id) {
							html += '<option value="'+ value.id + '" selected="selected">' + value.name  + '</option>';
						}
						else {
							html += '<option value="'+ value.id + '">' + value.name  + '</option>';						
						}
					}
				);
			}
									
			$('#user_id').html(html);
		}
	});
}

function populate_assigned_users(department_id, selected_user_id) {

	//quicker to replace the entire html select
	$('#assigned_user_id').replaceWith('<select name="assigned_user_id" id="assigned_user_id"><option value="">loading...</option></select>');
		
	$.ajax({
		type: "GET",
		cache: false,
		dataType: "json",
		url:  sts_base_url + "/data/users/?assigned_users=true&department_id=" + department_id,
		success: function(data){
			html = '<option value=""></option>';

			if (data !== null) {
				$.each(
					data,
					function (index, value) {
						if (selected_user_id == value.id) {
							html += '<option value="'+ value.id + '" selected="selected">' + value.name  + '</option>';
						}
						else {
							html += '<option value="'+ value.id + '">' + value.name  + '</option>';												
						}
					}
				);
			}
									
			$('#assigned_user_id').html(html);
		}
	});
}

$(document).ready(function () {

	if ($('#assigned_user_id').length > 0) {
		if ($('#assigned_user_id').val().length > 0) {
			if ($('#update_department_id').length > 0 && $('#update_department_id').val().length > 0) {
				populate_assigned_users($('#update_department_id').val(), $('#assigned_user_id').val());
			}
			else {
				populate_assigned_users(0, $('#assigned_user_id').val());
			}
		}
		else {			
			if ($('#update_department_id').length > 0 && $('#update_department_id').val().length > 0) {
				populate_assigned_users($('#update_department_id').val(), 0);
			}
			else {
				populate_assigned_users(0, 0);
			}			
		}
	}

	if ($('#user_id').length > 0) {
		if ($('#user_id').val().length > 0) {
			if ($('#update_department_id').length > 0 && $('#update_department_id').val().length > 0) {
				populate_users($('#update_department_id').val(), $('#user_id').val());
			}
			else {
				populate_users(0, $('#user_id').val());
			}
		}
		else {
			if ($('#update_department_id').length > 0 && $('#update_department_id').val().length > 0) {
				populate_users($('#update_department_id').val(), 0);
			}
			else {
				populate_users(0, 0);
			}
		}
	}

    $('#update_department_id').change(function () {
		populate_users($(this).val());
		populate_assigned_users($(this).val());
	});
	
});
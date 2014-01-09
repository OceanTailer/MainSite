$(document).ready(function () {

    var departments_item_count = 0; // Global unique counter

	//Add new line item
    $("#add_department_item").click(function () {
		departments_item_count++; // Increment counter

		var clonedRow = $('.department_field').clone();
		$(clonedRow).addClass('new_department_field').removeClass('department_field');
		$(clonedRow).find('input').val('').end().find('p').append(' <a href="#custom" id="delete_department_item" class="button">Delete</a>').end().appendTo('.extra_department_field');

	});
	
	//Delete line item
	$("#delete_department_item").live('click', function(){
		$(this).parent('p').remove(); 
			  
    });
	
	//Delete existing line item
	$("#delete_existing_department_item").live('click', function(e){
		e.preventDefault();

		if (confirm("Are you sure you wish to permanently delete this department?")){
			
			var department_id = $(this).closest('div').attr("id");
			var department_exploded = department_id.split('-');
			department_id = department_exploded[1];
					
			$.ajax({
				type: "POST",
				url:  sts_base_url + "/settings/deletedepartment/" + department_id,
				data: "delete=true",
				success: function(html){
					
				}
			 });
			 
			 $(this).parent('p').remove(); 
		}
		else{
				return false;
		}
		
    });
		
});
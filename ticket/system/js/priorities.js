$(document).ready(function () {

    var priorities_item_count = 0; // Global unique counter

	//Add new line item
    $("#add_priorities_item").click(function () {
		priorities_item_count++; // Increment counter

		var clonedRow = $('.priority_field').clone();
		$(clonedRow).addClass('new_priority_field').removeClass('priority_field');
		$(clonedRow).find('input').val('').end().find('p').append(' <a href="#custom" id="delete_priority_item" class="button">Delete</a>').end().appendTo('.extra_priority_field');

	});
	
	//Delete line item
	$("#delete_priority_item").live('click', function(){
		$(this).parent('p').remove(); 
			  
    });
	
	//Delete existing line item
	$("#delete_existing_priority_item").live('click', function(e){
		e.preventDefault();

		if (confirm("Are you sure you wish to permanently delete this priority?")){
			
			var priority_id = $(this).closest('div').attr("id");
			var priority_exploded = priority_id.split('-');
			priority_id = priority_exploded[1];
					
			$.ajax({
				type: "POST",
				url:  sts_base_url + "/settings/deletepriority/" + priority_id,
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
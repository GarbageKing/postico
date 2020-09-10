jQuery(document).ready(function() {
    jQuery('#posts_table').DataTable();

    jQuery('#postico_form').submit(function(e){
    	e.preventDefault();
    	var form = jQuery(this);
    	
    	jQuery.ajax({
           type: "POST",
           url: "options.php",
           data: form.serialize(),
           success: function(data)
           {
               alert('Successfully Updated');
           }
         });
    });

    jQuery('.use-icon').click(function(e){
    	var post_id = jQuery(this).data('id');
    	var y_n = 0;
    	if(jQuery(this).prop("checked")){
    		y_n = 1;
    	}

    	jQuery.ajax({
           type: "POST",
           url: "admin-ajax.php",
           data: {action: 'postico_use_icon', post_id: post_id, y_n: y_n},
           success: function(data)
           {
               alert('Successfully Updated');
           }
        });
    });
});
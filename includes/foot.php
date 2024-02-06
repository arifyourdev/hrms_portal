<script src="js/vendor/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/vendor/bootstrap.min.js"></script>
<script src="js/plugins.js"></script>
<script src="js/active.js"></script>
<script src="js/custom.js"></script> 
 
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

 <script>
 $("#search").autocomplete({
       
              source: function(request, response){
                  $.ajax({
                     url : 'ajax/search',
                     type: 'post',
                      dataType: 'json',
                      data: {
                         sea: request.term
                     },
                     success:function(data){
                          response(data);
                     }
                  });
              },
              
      select: function(event, ui) {
	 // Set selection
	$("#search").val(ui.item.label); // display the selected text
	
		var name = ui.item.label;
  		var product_url = ui.item.pro;
         window.location.replace("book-details/" + product_url);

			return false;
		},
		focus: function(event, ui) {
			$("#search").val(ui.item.label);
			return false;
		},
   });
   
    
   
</script>
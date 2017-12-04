 <script src="<?php echo $jsurl; ?>/jquery/datepicker-fr.js"></script>
 
  <script>
  $("#datepicker").datepicker({ dateFormat: "yy-mm-dd" }).val()
  $(function(datepicker) {
  
	 $( "#calendar" ).datepicker({	changeMonth: true,	changeYear: true ,	yearRange : 'c-40:c+60', defaultDate: '01/01/1984', dateFormat: "dd/mm/yy"  	});
	 $( "#calendar_naissance" ).datepicker({	changeMonth: true,	changeYear: true ,	yearRange : 'c-40:c+60'  });
	 
	 $( "#calendar_dbf" ).datepicker({	changeMonth: true,	changeYear: true ,	yearRange : 'c-40:c+60' ,dateFormat: "dd/mm/yy",
   
      onClose: function( selectedDate ) {
        $( "#calendar_ff" ).datepicker( "option", "minDate", selectedDate );} });
   	 $( "#calendar_ff" ).datepicker({	changeMonth: true,	changeYear: true ,	yearRange : 'c-40:c+60',dateFormat: "dd/mm/yy",

      onClose: function( selectedDate ) {
        $( "#calendar_dbf" ).datepicker( "option", "maxDate", selectedDate );
      } });
	
	 $( "#calendar_dbf" ).datepicker({	changeMonth: true,	changeYear: true ,	yearRange : 'c-40:c+60' ,dateFormat: "dd/mm/yy",
      onClose: function( selectedDate ) {
        $( "#calendar_ff" ).datepicker( "option", "minDate", selectedDate );} });
		
   	 $( "#calendar_ff" ).datepicker({	changeMonth: true,	changeYear: true ,	yearRange : 'c-40:c+60',dateFormat: "dd/mm/yy",
      onClose: function( selectedDate ) {
        $( "#calendar_dbf" ).datepicker( "option", "maxDate", selectedDate );
      } });
	
	
		 
	 $( "#calendar_dbex" ).datepicker({	changeMonth: true,	changeYear: true ,	yearRange : 'c-40:c+60' ,dateFormat: "dd/mm/yy",
      onClose: function( selectedDate ) {
        $( "#calendar_fex" ).datepicker( "option", "minDate", selectedDate );} });
		
   	 $( "#calendar_fex" ).datepicker({	changeMonth: true,	changeYear: true ,	yearRange : 'c-40:c+60',dateFormat: "dd/mm/yy",
      onClose: function( selectedDate ) {
        $( "#calendar_dbex" ).datepicker( "option", "maxDate", selectedDate );
      } });
	 
  });
  </script> 
   
 
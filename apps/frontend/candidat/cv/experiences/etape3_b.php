<script type="text/javascript"> 
	CKEDITOR.replace( 'editor2',				{	width : "600px"		});CKEDITOR.replace( 'editor3',				{	width : "600px"		});
	CKEDITOR.replace( 'editor4',				{	width : "600px"		});CKEDITOR.replace( 'editor5',				{	width : "600px"		});
	CKEDITOR.replace( 'editor6',				{	width : "600px"		});CKEDITOR.replace( 'editor7',				{	width : "600px"		});
	CKEDITOR.replace( 'editor8',				{	width : "600px"		});CKEDITOR.replace( 'editor9',				{	width : "600px"		});
	CKEDITOR.replace( 'editor10',				{	width : "600px"		});CKEDITOR.replace( 'editor11',			{	width : "600px"		});
</script>
			 

<link rel="stylesheet" href="<?php echo $jsurl; ?>/jquery/jquery-ui.min.css"> 
  <script src="<?php echo $jsurl; ?>/jquery/jquery-1.11.2.min.js"></script>
  <script src="<?php echo $jsurl; ?>/jquery/jquery-ui.min.js"></script>
  <script src="<?php echo $jsurl; ?>/jquery/datepicker-fr.js"></script>
 
  <script>
  $("#datepicker").datepicker({ dateFormat: "yy-mm-dd" }).val()
  $(function(datepicker) {
    
	 
		 
	 $( "#calendar_dbex" ).datepicker({	changeMonth: true,	changeYear: true ,	yearRange : 'c-40:c+60' ,dateFormat: "dd/mm/yy",
      onClose: function( selectedDate ) {
        $( "#calendar_fex" ).datepicker( "option", "minDate", selectedDate );} });
		
   	 $( "#calendar_fex" ).datepicker({	changeMonth: true,	changeYear: true ,	yearRange : 'c-40:c+60',dateFormat: "dd/mm/yy",
      onClose: function( selectedDate ) {
        $( "#calendar_dbex" ).datepicker( "option", "maxDate", selectedDate );
      } });
	 
	 
  });
   
  </script>
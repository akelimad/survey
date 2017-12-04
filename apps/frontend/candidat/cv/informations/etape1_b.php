<link rel="stylesheet" href="<?php echo $jsurl; ?>/jquery/jquery-ui.min.css"> 
  <script src="<?php echo $jsurl; ?>/jquery/jquery-1.11.2.min.js"></script>
  <script src="<?php echo $jsurl; ?>/jquery/jquery-ui.min.js"></script>
  <script src="<?php echo $jsurl; ?>/jquery/datepicker-fr.js"></script>
   <script>
  $("#datepicker").datepicker({ dateFormat: "yy-mm-dd" }).val()
  $(function(datepicker) {
  
     $( "#calendar" ).datepicker({  changeMonth: true,  changeYear: true ,  yearRange : 'c-40:c+60', defaultDate: '01/01/1984', dateFormat: "dd/mm/yy"      });
     $( "#calendar_naissance" ).datepicker({    changeMonth: true,  changeYear: true ,  yearRange : 'c-40:c+60' ,dateFormat: "dd/mm/yy", });
     
    
     
  });
  </script>  
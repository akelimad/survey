 <script type="text/javascript">
	CKEDITOR.replace( 'description_formation',	{	width : "600px"		});CKEDITOR.replace( 'description_formation1',	{	width : "600px"		});
	CKEDITOR.replace( 'description_formation2',	{	width : "600px"		});CKEDITOR.replace( 'description_formation3',	{	width : "600px"		});
	CKEDITOR.replace( 'description_formation4',	{	width : "600px"		}); 
</script>



 <link rel="stylesheet" href="<?php echo $jsurl; ?>/jquery/jquery-ui.min.css"> 
  <script src="<?php echo $jsurl; ?>/jquery/jquery-1.11.2.min.js"></script>
  <script src="<?php echo $jsurl; ?>/jquery/jquery-ui.min.js"></script>
  <script src="<?php echo $jsurl; ?>/jquery/datepicker-fr.js"></script>
 
  <script>
  
/* $(function()
{
  $("#calendar_dbf,#calendar_ff").datepicker({
    dateFormat:'dd/mm/yy',
  });
  $("#calendar_dbf").datepicker('option','onSelect',function() {
    $("#calendar_ff").datepicker('option','minDate',
      new Date($(this).datepicker('getDate').getTime()+86400000)
    );
  });
  $("#calendar_ff").datepicker('option','onSelect',function() {
    $("#calendar_dbf").datepicker('option','maxDate',
      new Date($(this).datepicker('getDate').getTime()-86400000)
    );
  });
});*/
$(document).ready(function(){
 
    $("#calendar_dbf").datepicker({ 
        dateFormat: 'mm/yy',
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
 yearRange : 'c-40:c+60' ,
        onClose: function(dateText, inst) {  
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val(); 
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val(); 
            $(this).val($.datepicker.formatDate('mm/yy', new Date(year, month, 1)));
        }
    });
 
    $("#calendar_dbf").focus(function () {
        $(".ui-datepicker-calendar").hide();
        $("#ui-datepicker-div").position({
            my: "center top",
            at: "center bottom",
            of: $(this)
        });    
    });
    
});
 $(document).ready(function(){
 
    $("#calendar_ff").datepicker({ 
        dateFormat: 'mm/yy',
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
 yearRange : 'c-40:c+60' ,
        onClose: function(dateText, inst) {  
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val(); 
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val(); 
            $(this).val($.datepicker.formatDate('mm/yy', new Date(year, month, 1)));
        }
    });
 
    $("#calendar_ff").focus(function () {
        $(".ui-datepicker-calendar").hide();
        $("#ui-datepicker-div").position({
            my: "center top",
            at: "center bottom",
            of: $(this)
        });    
    });
    
}); 

  /*$("#datepicker").datepicker({ dateFormat: "yy-mm-dd" }).val()
  $(function(datepicker) {
    
	
	 $( "#calendar_dbf" ).datepicker({	changeMonth: true,	changeYear: true ,	yearRange : 'c-40:c+60' ,dateFormat: "dd/mm/yy",
      onClose: function( selectedDate ) {
        $( "#calendar_ff" ).datepicker( "option", "minDate", selectedDate );} });
		
   	 $( "#calendar_ff" ).datepicker({	changeMonth: true,	changeYear: true ,	yearRange : 'c-40:c+60',dateFormat: "dd/mm/yy",
      onClose: function( selectedDate ) {
        $( "#calendar_dbf" ).datepicker( "option", "maxDate", selectedDate );
      } });

	 
  });
 */
  </script>
  

<script type="text/javascript">//<![CDATA[ 
$(window).load(function(){  
$('#etablissement').on('change',function(){
    if( $(this).val()=="290" ){    $("#div_etablissement").show()    }
    else{    $("#nom_etablissement").val('');   $("#div_etablissement").hide()    }
});
$('#etablissement1').on('change',function(){
    if( $(this).val()=="290" ){    $("#div_etablissement1").show()    }
    else{    $("#nom_etablissement1").val('');  $("#div_etablissement1").hide()    }
});
$('#etablissement2').on('change',function(){
    if( $(this).val()=="290" ){    $("#div_etablissement2").show()    }
    else{    $("#nom_etablissement2").val('');  $("#div_etablissement2").hide()    }
});
$('#etablissement3').on('change',function(){
    if( $(this).val()=="290" ){    $("#div_etablissement3").show()    }
    else{    $("#nom_etablissement3").val('');  $("#div_etablissement3").hide()    }
});
$('#etablissement4').on('change',function(){
    if( $(this).val()=="290" ){    $("#div_etablissement4").show()    }
    else{    $("#nom_etablissement4").val('');  $("#div_etablissement4").hide()    }
});
});//]]>  

</script>

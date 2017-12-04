

<script type="text/javascript">
	CKEDITOR.replace( 'description_formation',	{	width : "600px"		});	CKEDITOR.replace( 'description_poste',	{	width : "600px"		});

</script>









  
	
	
<script type="text/javascript">//<![CDATA[ 
$(window).load(function(){	
$('#etablissement').on('change',function(){
    if( $(this).val()=="290" ){    $("#div_etablissement").show()    }
    else{    $("#nom_etablissement").val('');	$("#div_etablissement").hide()    }
});
$('#etablissement1').on('change',function(){
    if( $(this).val()=="290" ){    $("#div_etablissement1").show()    }
    else{    $("#nom_etablissement1").val('');	$("#div_etablissement1").hide()    }
});
$('#etablissement2').on('change',function(){
    if( $(this).val()=="290" ){    $("#div_etablissement2").show()    }
    else{    $("#nom_etablissement2").val('');	$("#div_etablissement2").hide()    }
});
$('#etablissement3').on('change',function(){
    if( $(this).val()=="290" ){    $("#div_etablissement3").show()    }
    else{    $("#nom_etablissement3").val('');	$("#div_etablissement3").hide()    }
});
$('#etablissement4').on('change',function(){
    if( $(this).val()=="290" ){    $("#div_etablissement4").show()    }
    else{    $("#nom_etablissement4").val('');	$("#div_etablissement4").hide()    }
});
});//]]>  

</script> 
<style type="text/css">
  input   {width: 200px;}
  select  {width: 205px;}
</style> 
 

<style type="text/css"> 
 #autres :hover{background-color:red;}
a.tooltip em {    display:none;}
a.tooltip:hover {    border: 0;    position: relative;    z-index: 500;    text-decoration:none;}
a.tooltip:hover em {    display: block;    position: absolute;    top: 20px;    left: -10px;    padding: 5px;	"font-size:10px;	color:#1666AA;    border: 1px solid #bbb;    background: #ffc;    width:250px;}
a.tooltip:hover em span {    position: absolute;    top: -7px;    left: 15px;    height: 7px;    width: 11px;      margin:0;    padding: 0;    border: 0;}
.cvlettre{width : 70px;}
</style>
<script type="text/javascript" >
count=6;
function create_champ(i) {


if(i<count)
{
var i2 = i + 1;    	

document.getElementById('leschamps_'+i).innerHTML = '<input  type="file" name="upload[]" size="30" class="cvs"/></span>';
document.getElementById('leschamps_'+i).innerHTML += (i <= 10) ? '<br /><span  id="leschamps_'+i2+'"><a class="lettre" href="javascript:create_champ('+i2+')">Ajouter une lettre</a></span>' : '';
}

}
</script>
<script type="text/javascript" >
countcv=6;
function create_champcv(i) {


if(i<countcv)
{
var i2 = i + 1;    	

document.getElementById('leschampscv_'+i).innerHTML = '<input  type="file" name="upload1[]" size="30" class="cvs"/></span>';
document.getElementById('leschampscv_'+i).innerHTML += (i <= 10) ? '<br /><span  id="leschampscv_'+i2+'"><a class="cvchamp" href="javascript:create_champcv('+i2+')">Ajouter un cv</a></span>' : '';
}

}
</script>
  
	<script type="text/javascript" src="<?php echo $jsurl ?>/customScripts.js"></script>   
<!-- 	-->
<?php if(isset($_POST['nom'])){?>
<style>
#content_d :invalid {    border: 1px solid red;     }
#content_d :valid   { /* border: 1px solid green;*/ }
</style>
<?php } ?>


<link rel="stylesheet" href="<?php echo $jsurl; ?>/jquery/jquery-ui.min.css"> 
  <script src="<?php echo $jsurl; ?>/jquery/jquery-1.11.2.min.js"></script>
  <script src="<?php echo $jsurl; ?>/jquery/jquery-ui.min.js"></script>
  <script src="<?php echo $jsurl; ?>/jquery/datepicker-fr.js"></script>
 
  <script>
  $("#datepicker").datepicker({ dateFormat: "yy-mm-dd" }).val()
  $(function(datepicker) {
  
	 $( "#calendar" ).datepicker({	changeMonth: true,	changeYear: true ,	yearRange : 'c-40:c+60', defaultDate: '01/01/1984', dateFormat: "dd/mm/yy"  	});
	 $( "#calendar_naissance" ).datepicker({	changeMonth: true,	changeYear: true ,	yearRange : 'c-40:c+60'  });
	 /*
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
	*/
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
		 
	 $( "#calendar_dbex" ).datepicker({	changeMonth: true,	changeYear: true ,	yearRange : 'c-40:c+60' ,dateFormat: "dd/mm/yy",
      onClose: function( selectedDate ) {
        $( "#calendar_fex" ).datepicker( "option", "minDate", selectedDate );} });
		
   	 $( "#calendar_fex" ).datepicker({	changeMonth: true,	changeYear: true ,	yearRange : 'c-40:c+60',dateFormat: "dd/mm/yy",
      onClose: function( selectedDate ) {
        $( "#calendar_dbex" ).datepicker( "option", "maxDate", selectedDate );
      } });
	 
  });
  </script> 
   
  



   <script type="text/javascript" src="<?php echo $jsurl ?>/traitement_profil_lettre.js"></script>
   <script type="text/javascript" src="<?php echo $jsurl ?>/traitement_profil.js"></script>
   

<script type="text/javascript">
$(document).ready(function() {
  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
});		
</script>  				

			
<?php	 

	if(isset($_GET['succed']))
{



echo '<script type="text/javascript" >
window.opener.location.reload();
window.opener.location.href="inscription.php";
self.close(); 
</script>';

}
?> 

 
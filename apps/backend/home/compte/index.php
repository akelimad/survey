<?php	include("./index__t.php"); ?>
<!DOCTYPE html> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include ( dirname(__FILE__) . $tempurl2 . "/header_tmp_admin.php"); ?>
<link href="<?php echo $cssurl; ?>/style_datepicker.php" rel="stylesheet" type="text/css"/>
  <script type="text/javascript"> 
    </script>
  <script type="text/javascript" src="<?php echo $jsurl ?>/ckeditor/ckeditor.js"></script>

  
    
            <script type="text/javascript"> 
                function OuvrirPopup(page,nom,largeur,hauteur)  
                {   var winl = (screen.width - largeur) / 2;
                    var wint = (screen.height - hauteur) / 2; 
                    winprops = 'height='+hauteur+',width='+largeur+',top='+wint+',left='+winl+',menubar=no,scrollbars=yes' 
                    win = window.open(page, nom, winprops) 
                } 
            </script> 

			
     <script type="text/javascript" src="<?php echo $jsurl; ?>/jquery/jquery-1.11.2.min.js"></script>
     <script type="text/javascript" src="<?php echo $jsurl; ?>/jquery/jquery-ui.min.js"></script>

    <link href="<?php echo $jsurl; ?>/jquery/datepicker.css" rel="stylesheet" type="text/css"/>   
    <link href="<?php echo $jsurl; ?>/jquery/normalize_c.css" rel="stylesheet" type="text/css"/>

    <script type="text/javascript">
    //*
        $(function(){
            $('#datepicker').datepicker({
                inline: true,
                nextText: '&rarr;',
                prevText: '&larr;',
                showOtherMonths: true,
                dateFormat: 'yy-mm-dd',
                dayNamesMin: ['Dim.', 'Lun.', 'Mar.', 'Mer.', 'Jeu.', 'Ven.', 'Sam.'],
                showOn: "button",
                buttonImage: "<?php echo $jsurl; ?>/jquery/images/calendar-blue.png",
                buttonImageOnly: true,
                
                altField : '#hiddenFieldID',
                onSelect : function(){
                    $('#myFormID').submit();   
                }
                
            });
        });
        //*/
    </script> 
</head>
<body> 

<div id='container'> 
<?php     include ( dirname(__FILE__) . $tempurl2 . "/header_admin.php");  	 ?>
<div id='content_d' style="width: 100%;margin-left: 0px !important;"> 


<?php include ("./index__m.php"); ?>

</div>
</div>
<?php include ( dirname(__FILE__) . $tempurl2 . "/footer_admin.php"); ?>

    <?php 		
        include("../../home/popup/status_accueil/trai_pop_e_c_note.php");   
        include("../../home/popup/detail_accueil/trai_pop.php");

    ?>	
		
<?php include_once ( "./index__b.php");?>

</body>
</html>  


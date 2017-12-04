<?php  	  	include("./traitement_candidatures_en_cours_t.php"); ?>
<!DOCTYPE html >
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<?php include ( dirname(__FILE__) . $tempurl2 . "/header_tmp_admin.php"); ?>
<script type="text/javascript" src="<?php echo $jsurl ?>/ckeditor/ckeditor.js"></script> 
 

 <style>select{width:190px ;}</style>
</head>
<body>
<div id="container">

<?php     include ( dirname(__FILE__) . $tempurl2 . "/header_admin.php");

               ?>

<div id='gauche' >
<?php include ( dirname(__FILE__) . $menuurl2 . "/menu_g_a_candidature.php"); ?>
</div>	
<div id='content_d' style="width:720px;">   
<?php include ("./traitement_candidatures_en_cours_m.php"); ?>
</div> 
</div>
<?php include ( dirname(__FILE__) . $tempurl2 . "/footer_admin.php"); ?>
<?php       include ( "./traitement_candidatures_en_cours_b.php");

include("../../home/popup/status_candidature_details/trai_pop_e_c_note.php");
include("../../home/popup/details_status/trai_popDetai.php");  
include("../../home/popup/piece_joint/trai_postit.php");
include("../../home/popup/piece_joint/trai_pj.php");
        

?>

<?php include ( dirname(__FILE__) . $tempurl2 . "/footer_tmp_admin.php"); ?>
</body>
</html> 


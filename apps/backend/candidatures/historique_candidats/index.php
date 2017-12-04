<?php include("./canadidats_historique_t.php");    ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include ( dirname(__FILE__) . $tempurl2 . "/header_tmp_admin.php"); ?>
<script type="text/javascript" src="<?php echo $jsurl ?>/ckeditor/ckeditor.js"></script>
 
 

 <style>select{width:190px ;}</style>
</head>
<body>

<!-- START CONTAINER -->
<div id="container">

<?php     include ( dirname(__FILE__) . $tempurl2 . "/header_admin.php");       ?>

<div id='gauche' >
<?php include ( dirname(__FILE__) . $menuurl2 . "/menu_g_a_candidature.php"); ?>
</div>
<div id='content_d' style="width:720px;">   
<?php include ("./canadidats_historique_m.php"); ?>
</div> 
</div>
<?php include ( dirname(__FILE__) . $tempurl2 . "/footer_admin.php"); ?>
<?php       include ( "./canadidats_historique_b.php");       ?>

<?php include ( dirname(__FILE__) . $tempurl2 . "/footer_tmp_admin.php"); ?>
</body>
</html> 
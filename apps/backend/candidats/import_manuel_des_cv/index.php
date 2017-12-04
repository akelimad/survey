<?php	include("./import_manuel_des_cv_t.php"); 		?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include ( dirname(__FILE__) . $tempurl2 . "/header_tmp_admin.php"); ?>
<script type="text/javascript" src="<?php echo $jsurl ?>/ckeditor/ckeditor.js"></script>


<script type="text/javascript" src="<?php echo $jsurl; ?>/jquery/jquery-1.11.2.min.js"></script>  

</head>
<body>
<div id="container">

<?php     include ( dirname(__FILE__) . $tempurl2 . "/header_admin.php");       ?>

<div id='gauche' >
<?php include ( dirname(__FILE__) . $menuurl2 . "/menu_g_a_candidats.php"); ?>
</div>
<div id='content_d' style="width:720px;">   
<?php include ("./import_manuel_des_cv_m.php"); ?>
</div> 
</div>
<?php include ( dirname(__FILE__) . $tempurl2 . "/footer_admin.php"); ?>
<?php       include ( "./import_manuel_des_cv_b.php");?>
</body>
</html> 

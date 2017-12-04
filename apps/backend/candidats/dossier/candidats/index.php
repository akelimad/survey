<?php		include("./lister_cv_t.php");		     ?>
    <!DOCTYPE html >

    <html xmlns="http://www.w3.org/1999/xhtml">

<head>
<?php include ( dirname(__FILE__) . $tempurl3 . "/header_tmp_admin.php"); ?>
<script type="text/javascript" src="<?php echo $jsurl ?>/ckeditor/ckeditor.js"></script>

 <style>select{width:190px ;}</style>
</head>
<body>
<?php
include("./pop_email.php");
?>
<div id='container'>

<?php     include ( dirname(__FILE__) . $tempurl3 . "/header_admin.php");       ?>

<div id='gauche' >
<?php include ( dirname(__FILE__) . $menuurl3 . "/menu_g_a_candidats.php"); ?>
</div>
<div id='content_d' style="width:720px;">   
<?php include ("./lister_cv_m.php"); ?>
</div> 
</div>
<?php include ( dirname(__FILE__) . $tempurl3 . "/footer_admin.php"); ?>
<?php       include ( "./lister_cv_b.php");      ?>
<?php include ( dirname(__FILE__) . $tempurl3 . "/footer_tmp_admin.php"); ?>
</body>
</html> 
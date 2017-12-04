<?php   include("./parametrage_t.php");    ?>




<!DOCTYPE html>



<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include ( dirname(__FILE__) . $tempurl2 . "/header_tmp_admin.php"); ?>
<script type="text/javascript" src="<?php echo $jsurl; ?>/jscolor/jscolor.js"></script>
<style type="text/css">td{padding:2px 0;}</style> 
</head>
<body> 
<div id="container">
<?php
    include ( dirname(__FILE__) . $tempurl2 . "/header_admin.php");
?>
<div id='gauche' >
<?php include ( dirname(__FILE__) . $menuurl2 . "/menu_g_a_admin.php"); ?>
</div>
 <div id='content_d' style="width:720px;">   
<?php include ("./parametrage_m.php"); ?>
</div> 
</div>
<?php include ( dirname(__FILE__) . $tempurl2 . "/footer_admin.php"); ?>
<?php       include ( "./parametrage_b.php");

?>
</body>
</html> 

<?php	include ( "./index_t.php");	 ?>
<!DOCTYPE html >
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include ( dirname(__FILE__) . $tempurl . "/header_tmp.php"); ?>
</head>
<body>

 <!-- START CONTAINER -->
<div id='container'>
                <!-- START ENTETE -->
<?php 
include ( dirname(__FILE__) . $tempurl . "/header.php");   ?>
<div id='gauche'>
    <div id='content_g'>
        <div id="menu-fo">
        </div>	
    </div>		
    <div id='content_d'>
        <?php include ("./index_m.php"); ?>
    </div>
</div><!-- fin content gauche -->
<div id='droite'>
</div>
<?php include ( dirname(__FILE__) . $tempurl . "/footer_admin.php"); ?>
<?php       include ( "./index_b.php");      ?>
</body>
</html> 
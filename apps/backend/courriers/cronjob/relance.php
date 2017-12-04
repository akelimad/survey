<?php   include("./relance_t.php");     ?>

    <!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>        
<?php include ( dirname(__FILE__) . $tempurl . "/header_tmp_admin.php"); ?>
  <style>select{width:190px ;}</style>
  </head>
<body>
	
 <div id="container">
<?php
    include ( dirname(__FILE__) . $tempurl . "/header_admin.php");
?>
<div id='gauche' >
<?php include ( dirname(__FILE__) . $menuurl . "/menu_g_a_courriers.php"); ?>
</div>   
 <div id='content_d' style="width:720px;">   
<?php include ("./relance_m.php"); ?>
</div> 
</div>
<?php include ( dirname(__FILE__) . $tempurl . "/footer_admin.php"); ?>

</body>
</html> 

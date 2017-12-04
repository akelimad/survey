<?php	include("./traitement_candidature_stage_t.php");    ?>

    <!DOCTYPE html >

    <html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include ( dirname(__FILE__) . $tempurl2 . "/header_tmp_admin.php"); ?>
<script type="text/javascript" src="<?php echo $jsurl ?>/ckeditor/ckeditor.js"></script> 
 
<style>select{width:190px ;}</style>
</head>
<body> 
<div id="container">

<?php
    include ( dirname(__FILE__) . $tempurl2 . "/header_admin.php");
?>
<div style="float:right;">
<?php
 if (isset($_SESSION['abb_admin_stage'])) 
 {  echo 'Connect&eacute; en tant que: <b>' . $_SESSION['abb_admin_stage'] . '</b>| <a href="' . $urladmin . '/stages/">D&eacute;connexion</a>'; 
 }
?>
</div>
<div id='gauche' >
<div id="menu-fo1">
<ul id="menu_site_carriere" style="padding: 1px;">
<li id="ctl00_liAlerte" class="menufo-active">
<a id="menufo-active" href="./" >Candidatures pour stage</a>
</li>
</ul></div>
</div>
<div id='content_d' style="width:720px;">   
<?php include ("./traitement_candidature_stage_m.php"); ?>
</div> 
</div>
<?php include ( dirname(__FILE__) . $tempurl2 . "/footer_admin.php"); ?>
<?php include ( dirname(__FILE__) . $tempurl2 . "/footer_tmp_admin.php"); ?>
<?php       include ( "./traitement_candidature_stage_b.php");?> 
</body>
</html> 

<?php include("./canadidature_historique_resuta_t.php");    ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include ( dirname(__FILE__) . $tempurl3 . "/header_tmp_admin.php"); ?>
<script type="text/javascript" src="<?php echo $jsurl ?>/ckeditor/ckeditor.js"></script>
 
 <style> /* table.tablesorter thead tr th,  table.tablesorter tbody tr td  {  border: 1px solid #000; } */ </style>

 <style>select{width:190px ;}</style>
</head>
<body>

<!-- START CONTAINER -->
<div id="container">

<?php     include ( dirname(__FILE__) . $tempurl3 . "/header_admin.php");       ?>

<div id='gauche' >
<?php include ( dirname(__FILE__) . $menuurl3 . "/menu_g_a_candidature.php"); ?>
</div>
<div id='content_d' style="width:720px;">   
<?php include ("./canadidature_historique_resuta_m.php"); ?>
</div> 
</div>
<?php include ( dirname(__FILE__) . $tempurl3 . "/footer_admin.php"); ?>
<?php       include ( "./canadidature_historique_resuta_b.php");     ?>

<?php include ( dirname(__FILE__) . $tempurl3 . "/footer_tmp_admin.php"); ?>
</body>
</html> 
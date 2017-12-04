<?php   include("./postuler_t.php");     ?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<?php include ( dirname(__FILE__) . $tempurl . "/header_tmp_admin.php"); ?>

<script type="text/javascript" src="<?php echo $jsurl ?>/ckeditor/ckeditor.js"></script> 

</head>

<body>

<!-- START CONTAINER -->

<div id='container'>           

     	 

<?php     include ( dirname(__FILE__) . $tempurl . "/header_admin.php");       ?>



  <!-- END ENTETE -->

  <!-- START GAUCHE -->

  <div id='gauche' style="width:100%">

<?php include ( dirname(__FILE__) . $menuurl . "/menu_g_a_candidature.php"); ?>

    <div id='content_d' style="width:700px">

	<?php   include("./postuler_m.php");     ?>

    </div>

	

	

  </div>

  <!-- fin content gauche -->

  <!-- début div droit -->

</div>

<!-- BEGIN PUB FORMAT 5 -->

 

 







<!-- FIN PUB FORMAT 6 -->

<?php include ( dirname(__FILE__) . $tempurl . "/footer_admin.php"); ?>

<?php   include("./postuler_b.php");     ?>

</body>

</html>


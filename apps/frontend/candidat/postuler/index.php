<?php include ( "./postuler_t.php"); 		 ?>

<!DOCTYPE html >

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<?php include ( dirname(__FILE__) . $tempurl2 . "/header_tmp.php"); ?>

<style type="text/css">td{padding:5px 0;}</style>



<script type="text/javascript" src="<?php echo $jsurl ?>/ckeditor/ckeditor.js"></script>  

</head>

<body>

<!-- START CONTAINER -->

<div id='container'>

  <?php include ( dirname(__FILE__) . $tempurl2 . "/header.php"); ?><br/>

  <!-- END ENTETE -->

  <!-- START GAUCHE -->

  <div id='gauche' style="width:100%">

				

				       <!-- début menu gauche -->

					   <div id="content_g">

                        <table width="210"  cellpadding="0" cellspacing="0" style="border-collapse:collapse;" >

                            <tr>

                                <td >

	<?php include (  dirname(__FILE__) . $menuurl2 . "/menu_gauche_t.php"); ?>

	<?php include (  dirname(__FILE__) . $menuurl2 . "/menu_gauche.php"); ?>

	

									

									</td>

                            </tr>

                        </table>

                    </div>

                       <!-- fin menu gauche -->  

    <div id='content_d' style="width:700px">

 

    <?php 

		include ( "./postuler_m.php"); 		

	?>

 

    </div>

 <!-- fin content gauche -->

  <!-- début div droit -->

</div>

<!-- BEGIN PUB FORMAT 5 -->





  

</div>

 

</div>







<?php 

include ( dirname(__FILE__) . $tempurl2 . "/footer.php"); 

?>

<?php include ( dirname(__FILE__) . $tempurl2 . "/footer_tmp.php"); ?>

</body>

</html>  
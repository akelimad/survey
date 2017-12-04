<?php  include ( "./index_t.php");  ?>
<!DOCTYPE html >
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<?php include ( dirname(__FILE__) . $tempurl . "/header_tmp.php"); ?>

</head>

<body>

<div id='container'>       

  <?php include ( dirname(__FILE__) . $tempurl . "/header.php"); ?>

  <!-- debut ENTETE -->

  <div id='gauche'>

			

				       <!-- début menu gauche -->

					   <div id="content_g">

                        <table width="210"  cellpadding="0" cellspacing="0" style="border-collapse:collapse;" >

                            <tr>

                                <td >

						<?php include (  dirname(__FILE__) . $menuurl . "/menu_gauche_t.php"); ?>

						<?php include (  dirname(__FILE__) . $menuurl . "/menu_gauche.php"); ?>

	

									

									</td>

                            </tr>

                        </table>

						</div>

                       <!-- fin menu gauche -->  



					   

    <div id="content_d">

      <?php

      include ( "./index_m.php"); 

      ?>

    </div>

    <!-- fin contenu milieu -->

  </div>

  <!-- fin content gauche -->

</div>

<!-- fin entete -->

<?php 

include ( dirname(__FILE__) . $tempurl . "/footer.php"); 

?>

<?php include ( dirname(__FILE__) . $tempurl . "/footer_tmp.php"); ?>


<?php

include ( "./index_b.php"); 

?> 
</body>

</html> 
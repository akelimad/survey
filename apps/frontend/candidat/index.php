<?php  include ( "./index_t.php");  	  ?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

<head> 


<?php include ( dirname(__FILE__) . $tempurl . "/header_tmp.php"); ?>



</head>

<body>

<!-- START CONTAINER -->

	<div id='container'>

		<?php include ( dirname(__FILE__) . $tempurl . "/header.php"); ?>

		

<!-- END ENTETE -->



<!-- START GAUCHE -->	





<div id='gauche' >


			
				       <!-- début menu gauche -->
					   <div id="content_g">
                        <table width="210"  cellpadding="0" cellspacing="0" style="border-collapse:collapse;" >
                            <tr>
                                <td >
	
	<?php include (  dirname(__FILE__) . $menuurl . "/menu_gauche.php"); ?>
	
									
									</td>
                            </tr>
                        </table>
                    </div>
                       <!-- fin menu gauche -->  


<div id='content_d'>

      <?php
      include ( "./index_m.php"); 
      ?>
</div></div><!-- fin content gauche -->





</div>



<!-- BEGIN PUB FORMAT 5 -->







<!-- FIN PUB FORMAT 6 -->



<?php include ( dirname(__FILE__) . $tempurl . "/footer.php"); ?>

      <?php       include ( "./index_b.php");      ?>
	  


</body>

</html> 
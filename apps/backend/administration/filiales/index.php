<?php   include ( "./filiale_t.php");  ?>



<!DOCTYPE html>



<html xmlns="http://www.w3.org/1999/xhtml">



    <head>

		<?php include ( dirname(__FILE__) . $tempurl2 . "/header_tmp_admin.php"); ?>

    </head>



    <body>



        <!-- START CONTAINER -->



        <div id='container'>




            <!-- START ENTETE -->

<?php     include ( dirname(__FILE__) . $tempurl2 . "/header_admin.php");       ?>

            <!-- END ENTETE -->

            <!-- START GAUCHE -->	

            <div id='gauche' style="width:100%">

						
<?php include ( dirname(__FILE__) . $menuurl2 . "/menu_g_a_admin.php"); ?>
                
                <div id='content_d' style="width:720px;margin: 0 0 0 10px;">
<?php

  include ( "./filiale_m.php"); 
  
?>
 
                </div>
				
			</div>


        </div>

<?php include ( dirname(__FILE__) . $tempurl2 . "/footer_admin.php"); ?>

<?php  include ( "./filiale_b.php");  ?>		   

		   
    </body>



</html>
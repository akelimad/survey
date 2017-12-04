<?php





 

    require_once dirname(__FILE__) . "/../../../../config/fo_conn.php";



	

    

	

$ariane=" Accueil ";		

    ?>

    <!DOCTYPE html >

    <html xmlns="http://www.w3.org/1999/xhtml">

        <head>



<?php include ( dirname(__FILE__) . $tempurl2 . "/header_tmp.php"); ?>

		

        </head>

        <body>



		

<?php

if($compte_desactive)

{

?>

    <div id="repertoire">

                <div id="fils">

                  <div id="fade"></div>

                  <div class="popup_block"  style="width: 400px; z-index: 999; top: 30%; left: 32%;" >

               <form name= "F1" action="" method="post" id="formpopup">        

			   <div class="titleBar">

                      <div class="title">Réactivation de votre dossier</div>

               

	<input class="close" style="cursor: pointer;height: 16px;" name="fermer" value="fermer" type="submit" />

					  </div>

                    <div id="content" class="content">

                   

				

                        <table border="0" cellspacing="0" cellpadding="2">

                          <tr>

                          <td>

                          <p>Votre compte candidat est mis en veuille. Souhaitez vous le réactiver?</p>

                          </td>

                          </tr>

       <tr>

             

        <td><input name="oui" value="Oui" type="submit" />&nbsp;&nbsp; <input name="non" value="Non, je veux créer un nouveau" type="submit" />



                          

</td>

                          </tr>



                        </table>



                     



                    </div>

 </form>

                  </div>



                </div>



              </div>

			 

 <?php

 }

 ?>



           

            <!-- End of StatCounter Code -->

            <!-- START CONTAINER -->

            <div id='container'>

            

                <?php include ( dirname(__FILE__) . $tempurl2 . "/header.php"); ?>

                <!-- END ENTETE -->

                <!-- START GAUCHE -->

                <div id='gauche'>

				       <!-- début menu gauche -->

					   <div id="content_g">

                        <table width="210"  cellpadding="0" cellspacing="0" style="border-collapse:collapse;" >

                            <tr>

                                <td >

								

								

	<?php 	// include (  dirname(__FILE__) . $menuurl . "/menu_gauche_t.php");  	?>

	<?php include (  dirname(__FILE__) . $menuurl2 . "/menu_gauche.php"); ?>

	

									

									</td>

                            </tr>

                        </table>

                    </div>

                       <!-- fin menu gauche -->  

					<div id="content_d"> 

  

							

					<div id="moteur">

				 

				<br><br><center> <strong> <h1>Erreur 404</h1>

 <div>Oups, ceci est une erreur dite 404 ! En termes simples, la page ne peut être trouvée... Je vous invite dès à présent à utiliser les outils de recherche et / ou de navigation pour parvenir au contenu souhaité.</div></strong> </center>

					</div>

 

                    </div>

                    <!-- fin contenu milieu -->

                </div>

                <!-- fin content gauche -->

              

            </div>

			

            </div>

            <!-- END CONTAINER -->

            <!-- BEGIN PUB FORMAT 5 -->

            <!-- FIN PUB FORMAT 6 -->



			

    <?php 



	include ( dirname(__FILE__) . $tempurl2 . "/footer.php"); 

	?>



                <?php include ( dirname(__FILE__) . $tempurl2 . "/footer_tmp.php"); ?>

        </body>

    </html>

 
<?php





 

    require_once dirname(__FILE__) . "/../../../config/fo_conn.php";



	

    

	

$ariane=" Accueil ";		

    ?>

    <!DOCTYPE html >

    <html xmlns="http://www.w3.org/1999/xhtml">

        <head>



<?php include ( dirname(__FILE__) . $tempurl . "/header_tmp.php"); ?>

		

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

            

                <?php include ( dirname(__FILE__) . $tempurl . "/header.php"); ?>

                <!-- END ENTETE -->

                <!-- START GAUCHE -->

                <div id='gauche'>

				       <!-- début menu gauche -->

					   <div id="content_g">

                        <table width="210"  cellpadding="0" cellspacing="0" style="border-collapse:collapse;" >

                            <tr>

                                <td >

								

								

	<?php 	// include (  dirname(__FILE__) . $menuurl . "/menu_gauche_t.php");  	?>

	<?php include (  dirname(__FILE__) . $menuurl . "/menu_gauche.php"); ?>

	

									

									</td>

                            </tr>

                        </table>

                    </div>

                       <!-- fin menu gauche -->  

					<div id="content_d">

					

					

				<?php  

				$id_agenda=(isset($_GET['id_agenda'])) ? $_GET['id_agenda'] : "" ;

				?>

							

					<div id="moteur">

				<?php 

					if($id_agenda != ''){

					

					$sql_10="select * from agenda where id_agend = '$id_agenda'";

					//echo "<br>".$sql_1."<br>";

					if($select10  = mysql_query($sql_10)){			

							$reponse10 = mysql_fetch_array($select10);

							$action = $reponse10['action'];

							}

					$sql_2=" UPDATE agenda SET  confirmation_statu='1' WHERE id_agend='$id_agenda' ";	 				

					 		mysql_query($sql_2);

					//echo "<br>".$sql_2."<br>";

					if( $action!='' )	{

						$msg="<strong><h2 style='color: darkgreen;'>Merci pour la confirmation de <b>' $action '</b></h2></strong> ";

						}	else	{

						$msg="<strong><h2 style='color: red;'>Désolé la confirmation à échoué, veuillez réessayer ultérieurement</h2></strong> ";

						}

					}



				?>	

				<br><br><center><?php echo $msg ; ?></center>

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



	include ( dirname(__FILE__) . $tempurl . "/footer.php"); 

	?>



                <?php include ( dirname(__FILE__) . $tempurl . "/footer_tmp.php"); ?>

        </body>

    </html>

 
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

                                

                                

    <?php   // include (  dirname(__FILE__) . $menuurl . "/menu_gauche_t.php");     ?>

    <?php include (  dirname(__FILE__) . $menuurl2 . "/menu_gauche.php"); ?>

    

                                    

                                    </td>

                            </tr>

                        </table>

                    </div>

                       <!-- fin menu gauche -->  

                    <div id="content_d" style="width:68%">

                    

                    

                <?php   

                

                $i=(isset($_GET['i'])) ? $_GET['i'] : "" ;

                $is=(isset($_GET['is'])) ? $_GET['is'] : "" ;

                

                $p=(isset($_GET['p'])) ? $_GET['p'] : "" ;

                $r=(isset($_GET['r'])) ? $_GET['r'] : "" ;

				

                $msg ='vide'.$r ;

				

                    $sql_10_c="select * from candidats where candidats_id = '$i' and mdp = '$p' limit 0,1 ";

                    $sql_10_c_stage="select * from candidats where candidats_id = '$is' and mdp = '$p' limit 0,1 ";

					

					

					

					

                ?>

                <?php 

				 /*=================================================================================================================================*/

                    if($is != '' and $p == '' and $r == ''  ){

                    

                    $sql_10="SELECT * from agenda_stage where id_agenda = '$is'";

                    //echo "<br>".$sql_1."<br>";

                    if($select10  = mysql_query($sql_10)){          

                            $reponse10 = mysql_fetch_array($select10);

                            $action = $reponse10['action'];

                            }

                    $sql_2=" UPDATE agenda_stage SET  confirmation_statu='1' WHERE id_agenda='$is' ";                   

                            mysql_query($sql_2);

                    //echo "<br>".$sql_2."<br>";

                    if( $action!='' )   {

                        $msg="<div class=\"alert alert-success\"><ul><li style='color:#468847'> Merci pour la confirmation </li>

                        <li style='color:#468847'>Status : <b>' $action ' </b></li>

                        <li style='color:#468847'>Vous allez être redirigé dans quelques secondes 

                        <a href=\"../ \" >Ne pas attendre</a></li></ul></div>";

                        $msg.='  <meta http-equiv="refresh" content="1; ../" />   ';    

                        }   else    {

                        $msg="<div class=\"alert alert-error\"><ul><li style='color:#FF0000'>

                        Désolé la confirmation à échoué, veuillez réessayer ultérieurement</li>

                        <li style='color:#FF0000'>Vous allez être redirigé dans quelques secondes

                        <a href=\"../ \" >Ne pas attendre</a></li></ul></div> ";

                        $msg.='  <meta http-equiv="refresh" content="1; ../" />   ';    

                        }

                    }



                    if($i != '' and $p == '' and $r == ''  ){

                    

                    $sql_10="select * from agenda where id_agend = '$i'";

                    //echo "<br>".$sql_1."<br>";

                    if($select10  = mysql_query($sql_10)){          

                            $reponse10 = mysql_fetch_array($select10);

                            $action = $reponse10['action'];

                            }

                    $sql_2=" UPDATE agenda SET  confirmation_statu='1' WHERE id_agend='$i' ";                   

                            mysql_query($sql_2);

                    //echo "<br>".$sql_2."<br>";

                    if( $action!='' )   {

                        $msg="<div class=\"alert alert-success\"><ul><li style='color:#468847'> Merci pour la confirmation </li>

                        <li style='color:#468847'>Status : <b>' $action ' </b></li>

                        <li style='color:#468847'>Vous allez être redirigé dans quelques secondes 

                        <a href=\"../ \" >Ne pas attendre</a></li></ul></div>";

                        $msg.='  <meta http-equiv="refresh" content="1; ../" />   ';    

                        }   else    {

                        $msg="<div class=\"alert alert-error\"><ul><li style='color:#FF0000'>

                        Désolé la confirmation à échoué, veuillez réessayer ultérieurement</li>

                        <li style='color:#FF0000'>Vous allez être redirigé dans quelques secondes

                        <a href=\"../ \" >Ne pas attendre</a></li></ul></div> ";

                        $msg.='  <meta http-equiv="refresh" content="1; ../" />   ';    

                        }

                    }

                    /*=================================================================================================================================*/

                    if($p != '' and $i != '' and $r == ''  ){

                     

                    //echo "<br>".$sql_1."<br>";

                    if($select10_c  = mysql_query($sql_10_c)){          

                            $reponse10_c = mysql_fetch_array($select10_c);

                            $candidats_id = $reponse10_c['candidats_id'];

                            }

                    //echo "<br>".$sql_2_c."<br>";

                        $status_t = $reponse10_c['status'];

                         

                    if( ($candidats_id!='') and ($status_t=='2') )  {

                    

                                $email1 = $reponse10_c['email']; 

                                $candidats_id = $reponse10_c['candidats_id']; 

                                $prenom = ucfirst($reponse10_c['prenom']); 

                                $nom = strtoupper($reponse10_c['nom']);   

                                    /*//*/

                                    $_SESSION['abb_login_candidat']=$email1; 

                                    $_SESSION['abb_nom']=$nom." ".$prenom; 

                                    $_SESSION['abb_id_candidat']=$candidats_id; 

                                    

                            

                        $msg="<div class=\"alert alert-success\"><ul><li style='color:#468847'>

                        Nous vous remercions pour la confirmation de votre inscription  </li>

                        <li style='color:#468847'>Vous allez être redirigé dans quelques secondes

                        <a href=\"../candidat/compte \" >Ne pas attendre</a></li></ul></div> ";

                        /*.'/'.$email1.'/'.$nom.'/'.$prenom.'/'.$candidats_id;*/

                        $msg.='  <meta http-equiv="refresh" content="2; ../candidat/compte" />   '; 

                        

                        include("./index_email_1.php");   

                        

                    $sql_2_c=" UPDATE candidats SET   status='1' WHERE candidats_id='$i' ";                    

                            mysql_query($sql_2_c);

                            

                        }   else    {

                        

                    if(  ($status_t=='1') ) {

                        $msg="<div class=\"alert alert-error\"><ul><li style='color:#FF0000'>

                        Désolé la confirmation à échoué, Ce compte a été déjà activé</li>

                        <li style='color:#FF0000'>Vous allez être redirigé dans quelques secondes

                        <a href=\"../ \" >Ne pas attendre</a></li></ul></div> ";

                        }   else  {

                        $msg="<div class=\"alert alert-error\"><ul><li style='color:#FF0000'>

                        Désolé la confirmation à échoué, veuillez réessayer ultérieurement</li>

                        <li style='color:#FF0000'>Vous allez être redirigé dans quelques secondes

                        <a href=\"../ \" >Ne pas attendre</a></li>

                        </ul></div> ";                  

                        }

                        $msg.='  <meta http-equiv="refresh" content="1; ../" />   ';    

                        }

                    }

                    /*=================================================================================================================================*/

					

					 

                    if($p != '' and $i != '' and $r != '' ){

                     

							$candidats_id = $status_t = $civilite =  $prename  =  $name     =  $i_d      =  $mdp1     = '' ;

							

                    if($select10_c  = mysql_query($sql_10_c)){          

                            $reponse10_c = mysql_fetch_array($select10_c);

                            $candidats_id = $reponse10_c['candidats_id'];

							

                        $status_t = $reponse10_c['status'];

						

							$civilite = $reponse10_c['id_civi'] ;

							$prename  = $reponse10_c['prenom'] ;		

							$name     = $reponse10_c['nom'] ;  

							$mp       = $reponse10_c['mdp'] ;

							$email1   = $reponse10_c['email'] ;

                            } 

                         

                    if( ($candidats_id!='') and ($status_t=='2') )  {  

						

                            

                        include("./index_email_0.php");   

						

                        $msg="<div class=\"alert alert-success\"><ul><li style='color:#468847'>

                        Pour l'activer votre compte, suivez le lien d'activation envoyé à votre adresse e-mail.</li>

                        <li style='color:#468847'>Vous allez être redirigé dans quelques secondes

                        <a href=\"../ \" >Ne pas attendre</a></li></ul></div> ";

                        }   else  {

                        $msg="<div class=\"alert alert-error\"><ul><li style='color:#FF0000'>

                        Désolé la confirmation à échoué, veuillez réessayer ultérieurement</li>

                        <li style='color:#FF0000'>Vous allez être redirigé dans quelques secondes

                        <a href=\"../ \" >Ne pas attendre</a></li>

                        </ul></div> ";                  

                        }

						

									$_SESSION['compte_non_confirm'] = '';	

									$_SESSION['id_compte_non_confirm'] = '';

									

                        $msg.='  <meta http-equiv="refresh" content="3; ../" />   ';  

                            

                        }

						

                    

                    /*=================================================================================================================================*/



                ?>  

                <br><?php echo $msg ; ?>

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

 
<tr>



            <td colspan="2" class="subscription" style="width:55%"><h1>Mes informations</h1></td>



            <td class="subscription" ><h1>Mes Statistiques</h1></td>



          </tr>



          <tr>



            <td>



            <?php $req = mysql_query("SELECT * from  candidats 

              where candidats_id = '".safe($reponse['candidats_id'])."'");

            $rep = mysql_fetch_array($req);

            $photo_cand = (!empty($reponse['photo']) OR $reponse['photo']!="")      ? $reponse['photo']      : "";   

            echo '<img src="'.$url_photo_candidat.$photo_cand.'" alt="Image not found" 

      onError="this.onerror=null;this.src=\''.$url_photo_candidat.'default/photo.gif\';"   width="80" height="100"  />' ?></td>

      <?php

            $requet12=mysql_query("select * from prm_civilite where id_civi= ".$reponse['id_civi']." "); 

            if($requet12){ 

            $result12=mysql_fetch_assoc($requet12) ;

            }?>



            <td><i class="fa fa-user"></i>  <span class="Style2">Nom complet </span>: 

            <b><?php echo $result12['civilite'].'&nbsp;'.$reponse['prenom'] . '&nbsp;' . $reponse['nom']; ?></b><br />



              <i class="fa fa-plus"></i>

              <span class="Style2">Titre du CV</span> : 

              <b><?php echo $reponse['titre']; ?></b><br />



              <i class="fa fa-envelope"></i>

              <span class="Style2">E-mail</span> : 

             <b><?php echo $reponse['email']; ?></b><br />

             <i class="fa fa-plus"></i>

              <span class="Style2">Situation actuelle</span> :

              <b>

              <?php      $requet0=mysql_query("SELECT * from prm_situation where id_situ= ".safe($reponse['id_situ'])." "); 

                                if($requet0){ 

                                    $resutl0=mysql_fetch_assoc($requet0) ;   echo $resutl0['situation'];

                                            }                                        ?>

              </b>

            </td>



            <td style=" padding: 0 5px 0 10px; ">

            			

<?php  



	if($_SESSION['r_prm_moncpt_cv_sttsq']==0){

		 

		

?>



	 <?php 

            /**/

            if(date("d.m.Y", strtotime($rep['last_connexion']))!=date("d.m.Y", strtotime("01-01-1970")))

            {

            $vues = $rep['vues'];

            if($vues=="")

            $vues=0;

            echo '<i class="fa fa-plus"></i> Mon CV a été consulté ' . $vues . ' fois.<br />'; 

            

            }

            

            

            ?>

			

<?php  

 

		}

		

?>

           

            

            



             <?php if((date("Y.m.d", strtotime($rep['last_connexion']))!=date("d-m-Y", strtotime("1970-01-01"))) && (date("d.m.Y", strtotime($rep['last_connexion']))!=date("Y.m.d", strtotime("1969-12-31"))) )

                    echo '<i class="fa fa-plus"></i> Mon CV a été mis à jour la dernière fois le <b>' . date("d.m.Y", strtotime($rep['last_connexion'])).'</b>';

                    else

                    echo '<span style=" padding-left: 10px; ">Vous n\'avez pas encore déposer votre CV </span>';

                  

              ?> 

              <br />





              



            </td>



          </tr>
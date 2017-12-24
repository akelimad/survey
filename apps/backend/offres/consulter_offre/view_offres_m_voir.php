  

        <!--    ############################################################    -->

 

 <div>

 <?php



 

           $sql = mysql_query("select * from offre where id_offre = '$id_offre' ");



            $offre_exist = mysql_num_rows($sql);

            if($offre_exist){   

                $offre = mysql_fetch_array($sql);

            }

    ?>       

 <br/>         

<div class='texte' >  

                          





        <div style=" float: right; padding: 4px 5px 0px 0px;">

          <a href="<?php echo $_SESSION['page_courant ']; ?>" style=" border-bottom: none; ">

          <img src="<?php echo $imgurl; ?>/arrow_ltr.png" title="Retour"><strong style="color:#fff">Retour</strong>

          </a>  

        </div>

        

        <div class="subscription" style="margin: 10px 0pt;">

                     <h1> VOIR L'OFFRE  </h1> 

                </div>  

<h1> <?php echo $offre['Name']; ?></h1>



<?php // gibraltar 

if($offre['Photo_offre'] !=""){?>

<img src="<?php echo $url_photo_offres.$offre['Photo_offre']; ?>" width="100%">

<?php }  else{ ?>

			

      

      <table width="100%" border="0">



    <tr>



    <td colspan="2"><div class="subscription" style="margin: 10px 0pt;">



          <h1>informations g&eacute;n&eacute;rales  </h1>



     </div></td>



    </tr>







  <tr>



  <td style="font-size: 12px;padding-left: 10px;line-height: 19px;"><b>Type de poste</b></td>



  <td style="font-size: 12px;padding-left: 10px;line-height: 19px;">



  <?php



    $qry = mysql_query("select designation from prm_type_poste where id_tpost = '".$offre['id_tpost']."'");



    $type = mysql_fetch_array($qry);



    echo ': '.$type['designation'];



    ?>



  </td>



  </tr>

 <tr>

<td style="font-size: 12px;padding-left: 10px;line-height: 19px;"><b>Niveau d'expérience</b></td>

<td style="font-size: 12px;padding-left: 10px;line-height: 19px;">

<?php

$req = mysql_query("SELECT * FROM prm_experience where id_expe = '".$offre['id_expe']."'");

$niv = mysql_fetch_array($req);

echo ': '.$niv['intitule'];

  ?>        

  </td>

  </tr>

   <tr>

<td style="font-size: 12px;padding-left: 10px;line-height: 19px;"><b>Niveau de formation</b></td>

<td style="font-size: 12px;padding-left: 10px;line-height: 19px;">

<?php

$req = mysql_query("SELECT * FROM prm_niv_formation where id_nfor = '".$offre['id_nfor']."'");

$niv = mysql_fetch_array($req);

echo ': '.$niv['formation'];

  ?>        

  </td>

  </tr>

  <!--

 <tr>



  <td><b>Secteur d'activité</b></td>



  <td>



  <?php 



   $select_sec = mysql_query("select FR from prm_sectors where id_sect = '".$offre['id_sect']."'");



   $secteur = mysql_fetch_array($select_sec);



   echo ': '.$secteur['FR'];



  ?>



  </td>



  </tr>

  -->

  <tr>



  <td style="font-size: 12px;padding-left: 10px;line-height: 19px;"><b>Fonction</b></td>



  <td style="font-size: 12px;padding-left: 10px;line-height: 19px;">



  <?php 



   $select_sec = mysql_query("SELECT * FROM prm_fonctions where id_fonc = '".$offre['id_fonc']."'");



   $secteur = mysql_fetch_array($select_sec);



   echo ': '.$secteur['fonction'];



  ?>



  </td>



  </tr>



  <tr>



  <td style="font-size: 12px;padding-left: 10px;line-height: 19px;">

  <b><?php if($_SESSION['r_prm_region_off']==0){ ?> 

    Région de travail

    <?php }else{ ?>

    Lieu de travail

    <?php } ?></b></td>



  <td style="font-size: 12px;padding-left: 10px;line-height: 19px;">



  <?php if($_SESSION['r_prm_region_off']==0){ 

                  $select_lieu = mysql_query("SELECT * from prm_region where id_region = '".safe($offre['id_localisation'])."' ");

                    $lieu = mysql_fetch_array($select_lieu);

                    echo ": ".$lieu['nom_region']."";

   }else{ 

                    $select_lieu = mysql_query("SELECT ville from prm_villes where id_vill = '".safe($offre['id_localisation'])."' ");

                    $lieu = mysql_fetch_array($select_lieu);

                    echo ": ".$lieu['ville']."";

   } ?>        



  </td>



  </tr>



 



  <tr>



  <td style="font-size: 12px;padding-left: 10px;line-height: 19px;"><b>Date de publication</b></td>



  <td style="font-size: 12px;padding-left: 10px;line-height: 19px;">



  <?php



    echo ': '.date("d.m.Y",strtotime($offre['date_insertion']));



  ?>        



  </td>



  </tr>

  <tr>

  <td style="font-size: 12px;padding-left: 10px;line-height: 19px;"><b>Date d’expiration</b></td>

  <td style="font-size: 12px;padding-left: 10px;line-height: 19px;">

  <?php

    echo ': '.date("d.m.Y",strtotime($offre['date_expiration']));

  ?>        

  </td>

  </tr>

  <tr>

  <td style="font-size: 12px;padding-left: 10px;line-height: 19px;"><b>Vues</b></td>

  <td style="font-size: 12px;padding-left: 10px;line-height: 19px;">

  <?php if(empty($offre['vue'])) {echo ": 0";}else {echo ": ".$offre['vue'];} ?>       

  </td>

  </tr>

   



  <?php 



  ?>



  <tr>



    <td colspan="2"><div class="subscription" style="margin: 10px 0pt;">



          <h1>Description du poste</h1>



     </div></td>



  </tr>



  <tr>



    <td colspan="2" style="font-size: 12px;padding-left: 10px;line-height: 19px;">

    <?php echo stripslashes($offre['Details']); ?></td>



    </tr>



  <tr>



    <td colspan="2"><div class="subscription" style="margin: 10px 0pt;">



          <h1>Profils recherchés </h1>



     </div></td>



  </tr>



  <tr>



    <td colspan="2" style="font-size: 12px;padding-left: 10px;line-height: 19px;">

    <?php echo stripslashes($offre['Profil']); ?></td>



    </tr>

<?php  if($_SESSION['r_prm_note']==0){ ?>

<?php //include ("./view_offre_m_note.php"); ?>

<?php  } ?>



  <tr>



    <td colspan="2">

<?php if(isset($offre['avis_concours']) && $offre['avis_concours'] != '') : ?>
  <div class="subscription" style="margin: 10px 0pt;"><h1>Avis de concours</h1></div>
  <a href="<?= site_url('apps/upload/frontend/offre/avis_concours/'.$offre['avis_concours']) ;?>"><i class="fa fa-download"> Télécharger</i></a>
<?php endif; ?>

<?php if(isset($offre['decisions_recrutement']) && $offre['decisions_recrutement'] != '') : ?>
  <div class="subscription" style="margin: 10px 0pt;"><h1>Décisions de recrutement</h1></div>
  <a href="<?= site_url('apps/upload/frontend/offre/decisions_recrutement/'.$offre['decisions_recrutement']) ;?>"><i class="fa fa-download"> Télécharger</i></a>
<?php endif; ?>

<?php if(isset($offre['candidats_convoques']) && $offre['candidats_convoques'] != '') : ?>
  <div class="subscription" style="margin: 10px 0pt;"><h1>Liste des candidats convoqués</h1></div>
  <a href="<?= site_url('apps/upload/frontend/offre/candidats_convoques/'.$offre['candidats_convoques']) ;?>"><i class="fa fa-download"> Télécharger</i></a>
<?php endif; ?>

<?php if(isset($offre['resultats_concours']) && $offre['resultats_concours'] != '') : ?>
  <div class="subscription" style="margin: 10px 0pt;"><h1>Résultats des concours</h1></div>
  <a href="<?= site_url('apps/upload/frontend/offre/resultats_concours/'.$offre['resultats_concours']) ;?>"><i class="fa fa-download"> Télécharger</i></a>
<?php endif; ?>
<br><br>
    </td>



    </tr>



</table>

<?php }  /*fin else*/?>

      </div>



        <!--    ############################################################    -->


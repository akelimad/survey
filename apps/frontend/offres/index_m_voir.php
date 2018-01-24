

<div id="fb-root">



<form action="<?php echo $urlcandidat ?>/postuler/" method="get">



<div class="a2a_kit a2a_default_style" style="float:right;">

<a class="a2a_dd" href="https://www.addtoany.com/share">Partager</a>

<span class="a2a_divider"></span>



<a class="a2a_button_facebook"></a>

<a class="a2a_button_twitter"></a>

<a class="a2a_button_linkedin"></a>

<a class="a2a_button_viadeo"></a>

<a class="a2a_button_google_plus"></a>

</div>

<script type="text/javascript" src="<?php echo $jsurl; ?>/sharepage.js"></script>





 <?php /*

 <div style="float:right;"> 

  <div style="float:left;padding: 0 1px 3px 0px;background-color: rgb(251, 251, 251);

   border-width: 1px;border-color: rgb(191, 191, 191);border-style: solid;margin: 2px 2px 0 0;">

    <div class="fb-share-button" data-href="<?php echo $urloffre; ?>/?id=<?php echo $_GET['id'];  ?>"></div>

  </div>

  <script src="//platform.linkedin.com/in.js" type="text/javascript">

        lang: fr_FR

  </script>

<div style="float:right">

  <script type="IN/Share"

      data-url="<?php echo $urloffre; ?>/?id=<?php echo $_GET['id'];  ?>">

  </script>

*/ ?>  

</div>

</div>

<div id="imprime">

<h1><?php echo $offre['Name']; ?></h1>

<?php // gibraltar 

if($offre['Photo_offre'] !=""){?>

<img src="<?php echo $url_photo_offres.$offre['Photo_offre']; ?>" width="100%">

<?php }  else{ ?>



<table width="100%" border="0" >

<thead>

  <tr>

    <th width="20%"></th>

    <th width="80%"></th>



  </tr>

</thead>

<tbody>

<tr>

<td colspan="2">

<div class="subscription" style="margin: 10px 0pt">

<h1>informations g&eacute;n&eacute;rales </h1> 

</div>

</td>

</tr>

<tr width="60%">



  <td style="font-size: 12px;padding-left: 10px;line-height: 19px;">Type de poste</td>



  <td style="font-size: 12px;padding-left: 10px;line-height: 19px;">



  <?php



    $qry = mysql_query("select designation from prm_type_poste where id_tpost = '".safe($offre['id_tpost'])."'");



    $type = mysql_fetch_array($qry);



    echo ': <b>'.$type['designation'].'</b>';



    ?>



  </td>



  </tr>

 <tr>

<td style="font-size: 12px;padding-left: 10px;line-height: 19px;">Niveau d'expérience</td>

<td style="font-size: 12px;padding-left: 10px;line-height: 19px;">

<?php

$req = mysql_query("SELECT * FROM prm_experience where id_expe = '".safe($offre['id_expe'])."'");

$niv = mysql_fetch_array($req);

echo ': <b>'.$niv['intitule'].'</b>';

  ?>        

  </td>

  </tr>

   <tr>

<td style="font-size: 12px;padding-left: 10px;line-height: 19px;">Niveau de formation</td>

<td style="font-size: 12px;padding-left: 10px;line-height: 19px;">

<?php

$req = mysql_query("SELECT * FROM prm_niv_formation where id_nfor = '".safe($offre['id_nfor'])."'");

$niv = mysql_fetch_array($req);

echo ': <b>'.$niv['formation'].'</b>';

  ?>        

  </td>

  </tr>

  <tr>



  <td style="font-size: 12px;padding-left: 10px;line-height: 19px;">Fonction</td>



  <td style="font-size: 12px;padding-left: 10px;line-height: 19px;">



  <?php 



   $select_fonc = mysql_query("SELECT * FROM prm_fonctions where id_fonc = '".safe($offre['id_fonc'])."'");



   $fonction = mysql_fetch_array($select_fonc );



   echo ': <b>'.$fonction['fonction'].'</b>';



  ?>



  </td>



  </tr>



  <tr>



  <td style="font-size: 12px;padding-left: 10px;line-height: 19px;">

    <?php if($_SESSION['r_prm_region_off']==0){ ?> 

    Région de travail

    <?php }else{ ?>

    Lieu de travail

    <?php } ?>

  </td>



  <td style="font-size: 12px;padding-left: 10px;line-height: 19px;">

  <?php if($_SESSION['r_prm_region_off']==0){ 

                  $select_lieu = mysql_query("SELECT * from prm_region where id_region = '".safe($offre['id_localisation'])."' ");

                    $lieu = mysql_fetch_array($select_lieu);

                    echo ": <b>".$lieu['nom_region']."</b>";

   }else{ 

                    $select_lieu = mysql_query("SELECT ville from prm_villes where id_vill = '".safe($offre['id_localisation'])."' ");

                    $lieu = mysql_fetch_array($select_lieu);

                    echo ": <b>".$lieu['ville']."</b>";

   } ?>        

  </td>



  </tr>



 



  <tr>



  <td style="font-size: 12px;padding-left: 10px;line-height: 19px;">Date d’expiration</td>



  <td style="font-size: 12px;padding-left: 10px;line-height: 19px;">



  <?php



    echo ': <b>'.date("d.m.Y",strtotime($offre['date_expiration'])).'</b>';



  ?>        



  </td>



</tr></tbody></table>



	<style>



	.tbl_ulol>ul,.tbl_ulol>ol {

		padding : 0 0 0 50px;

	} 



	</style>

	

<table width="100%" border="0">

 <tr> <td colspan="2" >

<div class="subscription" style="margin: 10px 0pt;"> <h1>Description du

poste</h1> </div></td> </tr> <tr> 

<td colspan="2" style="font-size: 12px;padding-left: 10px;line-height: 19px;" class="tbl_ulol"><?php echo ''.stripslashes($offre['Details']).''; ?></td>



</tr> <tr> <td colspan="2" >

<div class="subscription" style="margin: 10px 0pt;"> <h1>Profils

recherchés </h1> </div></td> </tr> <tr> 

<td colspan="2" style="font-size: 12px;padding-left: 10px;line-height: 19px;" class="tbl_ulol"><?php echo stripslashes($offre['Profil']); ?></td>



</tr> <tr> <td colspan="2"> </td> </tr> </table> 



<?php  }/*fin if */?>

</div> 


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

<?php if(strtotime($offre['date_expiration']) > strtotime(date('Y-m-d', time()))) : ?>
<table>

<div class="ligneBleu"></div>
<input name="id_offre" type="hidden"    value="<?php echo $id_offre; ?>" />

<input class="espace_candidat" name="envoi" value="Répondre à cette offre" type="button"

    onclick="submit(this.form)" />

<input class="espace_candidat" type="button" value="Envoyer cette offre &agrave; un ami"

    onclick="document.location='mailto:?subject=Je vous recommande cette offre d\'emploi sur <?php echo $nom_site;  ?>&body=Bonjour,%0a%0aJe crois que cette offre pourrait vous interesser. Pour la consulter, clique ci-dessous :%0a%0a<?php echo 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>%0a%0aCordialement.%0a%0a'" />

<input class="espace_candidat" type="button" value="Imprimer l'offre"

    onclick="PrintElem('#imprime')" />

<input class="espace_candidat" name="Button" type="button" value="Toutes les offres d'emploi" onclick="window.location.href='./'" />

</form>

</div>

</table>
<?php endif; ?>

<script>

        (function(d, s, id) {

          var js, fjs = d.getElementsByTagName(s)[0];

          if (d.getElementById(id)) return;

          js = d.createElement(s); js.id = id;

          js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&appId=292961827555065&version=v2.0";

          fjs.parentNode.insertBefore(js, fjs);

        }(document, 'script', 'facebook-jssdk'));

</script>


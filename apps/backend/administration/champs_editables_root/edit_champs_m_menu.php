<?php



$valid_ds2 =strpos($_SERVER['REQUEST_URI'],'statut_candidature/');

$lien_1_1 =($valid_ds2>0)  ? ' background: '.$color_bg.' ' : '';

$lien_1_2 =($valid_ds2>0)  ? ' color:#fff ' : '';



$valid_ds3 =strpos($_SERVER['REQUEST_URI'],'experience/');

$lien_2_1 =($valid_ds3>0)  ? ' background: '.$color_bg.' ' : '';

$lien_2_2 =($valid_ds3>0)  ? ' color:#fff ' : '';



$valid_ds4 =strpos($_SERVER['REQUEST_URI'],'secteur/');

$lien_3_1 =($valid_ds4>0)  ? ' background: '.$color_bg.' ' : '';

$lien_3_2 =($valid_ds4>0)  ? ' color:#fff ' : '';



$valid_ds5 =strpos($_SERVER['REQUEST_URI'],'pays/');

$lien_4_1 =($valid_ds5>0)  ? ' background: '.$color_bg.' ' : '';

$lien_4_2 =($valid_ds5>0)  ? ' color:#fff ' : '';



$valid_ds6 =strpos($_SERVER['REQUEST_URI'],'type_partenaire/');

$lien_5_1 =($valid_ds6>0)  ? ' background: '.$color_bg.' ' : '';

$lien_5_2 =($valid_ds6>0)  ? ' color:#fff ' : '';



$valid_ds7 =strpos($_SERVER['REQUEST_URI'],'type_formation/');

$lien_6_1 =($valid_ds7>0)  ? ' background: '.$color_bg.' ' : '';

$lien_6_2 =($valid_ds7>0)  ? ' color:#fff ' : '';



$valid_ds8 =strpos($_SERVER['REQUEST_URI'],'niveau_formation/');

$lien_7_1 =($valid_ds8>0)  ? ' background: '.$color_bg.' ' : '';

$lien_7_2 =($valid_ds8>0)  ? ' color:#fff ' : '';



$valid_ds9 =strpos($_SERVER['REQUEST_URI'],'salaires/');

$lien_8_1 =($valid_ds9>0)  ? ' background: '.$color_bg.' ' : '';

$lien_8_2 =($valid_ds9>0)  ? ' color:#fff ' : '';



$valid_ds10 =strpos($_SERVER['REQUEST_URI'],'situation/');

$lien_9_1 =($valid_ds10>0)  ? ' background: '.$color_bg.' ' : '';

$lien_9_2 =($valid_ds10>0)  ? ' color:#fff ' : '';



$valid_ds11 =strpos($_SERVER['REQUEST_URI'],'disponibilite/');

$lien_10_1 =($valid_ds11>0)  ? ' background: '.$color_bg.' ' : '';

$lien_10_2 =($valid_ds11>0)  ? ' color:#fff ' : '';



$valid_ds11 =strpos($_SERVER['REQUEST_URI'],'filiere/');

$lien_11_1 =($valid_ds11>0)  ? ' background: '.$color_bg.' ' : '';

$lien_11_2 =($valid_ds11>0)  ? ' color:#fff ' : '';



$valid_ds12 =strpos($_SERVER['REQUEST_URI'],'fonction/');

$lien_12_1 =($valid_ds12>0)  ? ' background: '.$color_bg.' ' : '';

$lien_12_2 =($valid_ds12>0)  ? ' color:#fff ' : '';



$valid_ds13 =strpos($_SERVER['REQUEST_URI'],'ecoles/');

$lien_13_1 =($valid_ds13>0)  ? ' background: '.$color_bg.' ' : '';

$lien_13_2 =($valid_ds13>0)  ? ' color:#fff ' : '';



$valid_ds14 =strpos($_SERVER['REQUEST_URI'],'supprimer_compte/');

$lien_14_1 =($valid_ds14>0)  ? ' background: '.$color_bg.' ' : '';

$lien_14_2 =($valid_ds14>0)  ? ' color:#fff ' : '';



$valid_ds15 =strpos($_SERVER['REQUEST_URI'],'direction_stage/');

$lien_15_1 =($valid_ds15>0)  ? ' background: '.$color_bg.' ' : '';

$lien_15_2 =($valid_ds15>0)  ? ' color:#fff ' : '';



$valid_ds16 =strpos($_SERVER['REQUEST_URI'],'duree_stage/');

$lien_16_1 =($valid_ds16>0)  ? ' background: '.$color_bg.' ' : '';

$lien_16_2 =($valid_ds16>0)  ? ' color:#fff ' : '';



$valid_ds17 =strpos($_SERVER['REQUEST_URI'],'type_stage/');

$lien_17_1 =($valid_ds17>0)  ? ' background: '.$color_bg.' ' : '';

$lien_17_2 =($valid_ds17>0)  ? ' color:#fff ' : '';



$valid_ds18 =strpos($_SERVER['REQUEST_URI'],'pertinence/');

$lien_18_1 =($valid_ds18>0)  ? ' background: '.$color_bg.' ' : '';

$lien_18_2 =($valid_ds18>0)  ? ' color:#fff ' : '';



$valid_ds19 =strpos($_SERVER['REQUEST_URI'],'region/');

$lien_19_1 =($valid_ds19>0)  ? ' background: '.$color_bg.' ' : '';

$lien_19_2 =($valid_ds19>0)  ? ' color:#fff ' : '';



$valid_ds20 =strpos($_SERVER['REQUEST_URI'],'region_ville/');

$lien_20_1 =($valid_ds20>0)  ? ' background: '.$color_bg.' ' : '';

$lien_20_2 =($valid_ds20>0)  ? ' color:#fff ' : '';

?>

<table width="100%">                

<tr>

<?php ///////////////////////////////////////////////////////////////////////////////////  -d head ligne 1 ?>   

<td width="25%">

         <div  class="champs_editable" style="<?php echo $lien_2_1; ?>">

            <a id="myHeader1" class="menufo-active" href="<?php echo $urlad_admi;?>/champs_editables_root/experience/" >

            <b style="<?php echo $lien_2_2; ?>">Expérience</b></a>

         </div>

</td>

<td width="25%">

         <div  class="champs_editable" style="<?php echo $lien_3_1; ?>">

            <a id="myHeader2" href="<?php echo $urlad_admi;?>/champs_editables_root/secteur/" >

            <b style="<?php echo $lien_3_2; ?>">Secteur</b></a>

         </div>

</td>

<td width="25%">

         <div  class="champs_editable" style="<?php echo $lien_4_1; ?>">

            <a id="myHeader3" href="<?php echo $urlad_admi;?>/champs_editables_root/pays/" >

            <b style="<?php echo $lien_4_2; ?>">Pays</b></a>

         </div>

</td>

<td width="25%">

         <div  class="champs_editable" style="<?php echo $lien_5_1; ?>">

            <a id="myHeader4" href="<?php echo $urlad_admi;?>/champs_editables_root/type_partenaire/" >

            <b style="<?php echo $lien_5_2; ?>">Type partenaire</b></a>

         </div>

</td>

<?php ///////////////////////////////////////////////////////////////////////////////////  -f head ?>   

</tr>       

<tr>

<?php ///////////////////////////////////////////////////////////////////////////////////  -d head ligne 2 ?>   

<td>

         <div  class="champs_editable" style="<?php echo $lien_6_1; ?>">

            <a id="myHeader5" href="<?php echo $urlad_admi;?>/champs_editables_root/type_formation/" >

            <b style="<?php echo $lien_6_2; ?>">Type formation</b></a>

         </div>

</td>

<td>

         <div  class="champs_editable" style="<?php echo $lien_7_1; ?>">

            <a id="myHeader6" href="<?php echo $urlad_admi;?>/champs_editables_root/niveau_formation/" >

            <b style="<?php echo $lien_7_2; ?>">Niveau formation</b></a>

         </div>

</td>

<td>

         <div  class="champs_editable" style="<?php echo $lien_8_1; ?>">

            <a id="myHeader7" href="<?php echo $urlad_admi;?>/champs_editables_root/salaires/" >

            <b style="<?php echo $lien_8_2; ?>">Salaires</b></a>

         </div>

</td>

<td>

         <div class="champs_editable" style="<?php echo $lien_9_1; ?>">

            <a id="myHeader8" href="<?php echo $urlad_admi;?>/champs_editables_root/situation/" >

            <b style="<?php echo $lien_9_2; ?>">Situation</b></a>

         </div>

</td><tr>

<?php ///////////////////////////////////////////////////////////////////////////////////  -d head ligne 2 ?>   

<td>

         <div class="champs_editable" style="<?php echo $lien_10_1; ?>">

            <a id="myHeader9" href="<?php echo $urlad_admi;?>/champs_editables_root/disponibilite/" >

            <b style="<?php echo $lien_10_2; ?>">Disponibilite</b></a>

         </div>

</td>

<td>

         <div  class="champs_editable" style="<?php echo $lien_11_1; ?>">

            <a id="myHeader10" href="<?php echo $urlad_admi;?>/champs_editables_root/filiere/" >

            <b style="<?php echo $lien_11_2; ?>">Filière</b></a>

         </div>

</td>

<td>

         <div  class="champs_editable" style="<?php echo $lien_12_1; ?>">

            <a id="myHeader11" href="<?php echo $urlad_admi;?>/champs_editables_root/fonction/" >

            <b style="<?php echo $lien_12_2; ?>">Fonction</b></a>

         </div>

</td>

<td>

         <div  class="champs_editable" style="<?php echo $lien_13_1; ?>">

            <a id="myHeader12" href="<?php echo $urlad_admi;?>/champs_editables_root/ecoles/" >

            <b style="<?php echo $lien_13_2; ?>">Ecoles</b></a>

         </div>

</td>

</tr>

<tr>

   <td>

      <div  class="champs_editable" style="<?php echo $lien_14_1; ?>">

         <a id="myHeader12" 

         href="<?php echo $urlad_admi;?>/champs_editables_root/supprimer_compte/" >

         <b style="<?php echo $lien_14_2; ?>">Supprimer compte</b>

         </a>

      </div>

   </td>

   <td>

      <?php /**/ ?>

      <div  class="champs_editable" style="<?php echo $lien_1_1; ?>">

      <a id="myHeader12" 

         href="<?php echo $urlad_admi;?>/champs_editables_root/statut_candidature/" >

         <b style="<?php echo $lien_1_2; ?>">Statut Candidature</b>

      </a>

      </div>

      

   </td>

   <td>

      <div  class="champs_editable" style="<?php echo $lien_15_1; ?>">

      <a id="myHeader12" 

         href="<?php echo $urlad_admi;?>/champs_editables_root/direction_stage/" >

         <b style="<?php echo $lien_15_2; ?>">Direction Stage</b>

      </a>

      </div>

   </td>

   <td>

      <div  class="champs_editable" style="<?php echo $lien_16_1; ?>">

      <a id="myHeader12" 

         href="<?php echo $urlad_admi;?>/champs_editables_root/duree_stage/" >

         <b style="<?php echo $lien_16_2; ?>">Duree Stage</b>

      </a>

      </div>

   </td>

</tr>

<tr>

   <td>

      <div  class="champs_editable" style="<?php echo $lien_17_1; ?>">

         <a id="myHeader12" 

         href="<?php echo $urlad_admi;?>/champs_editables_root/type_stage/" >

         <b style="<?php echo $lien_17_2; ?>">Type Stage</b>

         </a>

      </div>

   </td>

   <td>

      <div  class="champs_editable" style="<?php echo $lien_18_1; ?>">

         <a id="myHeader12" 

         href="<?php echo $urlad_admi;?>/champs_editables_root/pertinence/" >

         <b style="<?php echo $lien_18_2; ?>">Pertinence</b>

         </a>

      </div>

   </td>

   <td>

      <div  class="champs_editable" style="<?php echo $lien_19_1; ?>">

         <a id="myHeader12" 

         href="<?php echo $urlad_admi;?>/champs_editables_root/region/" >

         <b style="<?php echo $lien_19_2; ?>">Région</b>

         </a>

      </div>

   </td>

   <td>

      <div  class="champs_editable" style="<?php echo $lien_20_1; ?>">

         <a id="myHeader12" 

         href="<?php echo $urlad_admi;?>/champs_editables_root/region_ville/" >

         <b style="<?php echo $lien_20_2; ?>">Ville</b>

         </a>

      </div>

   </td>

</tr>
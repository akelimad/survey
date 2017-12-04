<?php

$valid_ds2 =strpos($_SERVER['REQUEST_URI'],'filiere/');

$lien_1_1 =($valid_ds2>0)  ? ' background: '.$color_bg.' ' : '';

$lien_1_2 =($valid_ds2>0)  ? ' color:#fff ' : '';



$valid_ds3 =strpos($_SERVER['REQUEST_URI'],'ecoles/');

$lien_2_1 =($valid_ds3>0)  ? ' background: '.$color_bg.' ' : '';

$lien_2_2 =($valid_ds3>0)  ? ' color:#fff ' : '';



$valid_ds4 =strpos($_SERVER['REQUEST_URI'],'experience/');

$lien_3_1 =($valid_ds4>0)  ? ' background: '.$color_bg.' ' : '';

$lien_3_2 =($valid_ds4>0)  ? ' color:#fff ' : '';



$valid_ds5 =strpos($_SERVER['REQUEST_URI'],'niveau_formation/');

$lien_4_1 =($valid_ds5>0)  ? ' background: '.$color_bg.' ' : '';

$lien_4_2 =($valid_ds5>0)  ? ' color:#fff ' : '';



$valid_ds6 =strpos($_SERVER['REQUEST_URI'],'fonction/');

$lien_5_1 =($valid_ds6>0)  ? ' background: '.$color_bg.' ' : '';

$lien_5_2 =($valid_ds6>0)  ? ' color:#fff ' : '';



$valid_ds19 =strpos($_SERVER['REQUEST_URI'],'region/');

$lien_19_1 =($valid_ds19>0)  ? ' background: '.$color_bg.' ' : '';

$lien_19_2 =($valid_ds19>0)  ? ' color:#fff ' : '';



$valid_ds20 =strpos($_SERVER['REQUEST_URI'],'region_ville/');

$lien_20_1 =($valid_ds20>0)  ? ' background: '.$color_bg.' ' : '';

$lien_20_2 =($valid_ds20>0)  ? ' color:#fff ' : '';

?>

<table width="100%"> 

<?php if($_SESSION['r_prm_champs_edit']==0){ ?>               

<tr>

   <td width="33%">

   <div  class="champs_editable" style="<?php echo $lien_1_1; ?>">

      <a id="myHeader10" href="<?php echo $urlad_admi;?>/champs_editables/filiere/" >

      <b style="<?php echo $lien_1_2; ?>">Filière</b></a>

   </div>

   </td>

   <td width="33%">

   <div  class="champs_editable" style="<?php echo $lien_2_1; ?>">

      <a id="myHeader12" href="<?php echo $urlad_admi;?>/champs_editables/ecoles/" >

      <b style="<?php echo $lien_2_2; ?>">Ecoles</b></a>

   </div>

   </td>

   <td width="33%">

   <div  class="champs_editable" style="<?php echo $lien_3_1; ?>">

      <a id="myHeader1" class="menufo-active" href="<?php echo $urlad_admi;?>/champs_editables/experience/" >

      <b style="<?php echo $lien_3_2; ?>">Expérience</b></a>

   </div>

   </td>

</tr>

<tr>

   <td width="33%">

   <div  class="champs_editable" style="<?php echo $lien_4_1; ?>">

      <a id="myHeader6" href="<?php echo $urlad_admi;?>/champs_editables/niveau_formation/" >

      <b style="<?php echo $lien_4_2; ?>">Niveau formation</b></a>

   </div>

   </td>

   <td width="33%" colspan="2">

   <div  class="champs_editable" style="<?php echo $lien_5_1; ?>">

      <a id="myHeader11" href="<?php echo $urlad_admi;?>/champs_editables/fonction/" >

      <b style="<?php echo $lien_5_2; ?>">Fonction</b></a>

   </div>

   </td>

</tr>

<?php } ?>

<?php if($_SESSION['r_prm_region_off']==0){ ?>

<tr>

   <td width="33%"

      <div  class="champs_editable" style="<?php echo $lien_19_1; ?>">

         <a id="myHeader12" 

         href="<?php echo $urlad_admi;?>/champs_editables/region/" >

         <b style="<?php echo $lien_19_2; ?>">Région</b>

         </a>

      </div>

   </td>

   <td width="33%" colspan="2">

      <div  class="champs_editable" style="<?php echo $lien_20_1; ?>">

         <a id="myHeader12" 

         href="<?php echo $urlad_admi;?>/champs_editables/region_ville/" >

         <b style="<?php echo $lien_20_2; ?>">Ville</b>

         </a>

      </div>

   </td>

</tr>

<?php } ?>
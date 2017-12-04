<?php

$valid_ds1 =strpos($_SERVER['REQUEST_URI'],'requeteur/');

$valid_ds2 =strpos($_SERVER['REQUEST_URI'],'rapport_situation/');

$valid_ds3 =strpos($_SERVER['REQUEST_URI'],'rapport_entretien/');

$valid_ds4 =strpos($_SERVER['REQUEST_URI'],'rapport_avancement/');

$valid_ds5 =strpos($_SERVER['REQUEST_URI'],'rapport_offre/');



$lien_1 =($valid_ds1>0)  ? " style='background-color: ".$color_bg.";' " : "";

$lien_2 =($valid_ds2>0)  ? " style='background-color: ".$color_bg.";' " : "";

$lien_3 =($valid_ds3>0)  ? " style='background-color: ".$color_bg.";' " : "";

$lien_4 =($valid_ds4>0)  ? " style='background-color: ".$color_bg.";' " : "";

$lien_5 =($valid_ds5>0)  ? " style='background-color: ".$color_bg.";' " : "";



$lien_1_1 =($valid_ds1>0)  ? " style='color:#fff' " : "";

$lien_2_1 =($valid_ds2>0)  ? " style='color:#fff' " : "";

$lien_3_1 =($valid_ds3>0)  ? " style='color:#fff' " : "";

$lien_4_1 =($valid_ds4>0)  ? " style='color:#fff' " : "";

$lien_5_1 =($valid_ds5>0)  ? " style='color:#fff' " : "";



if($lien_2 != '' and $lien_1 !=''){$lien_1='';}

if($lien_3 != '' and $lien_1 !=''){$lien_1='';}

if($lien_4 != '' and $lien_1 !=''){$lien_1='';}

if($lien_5 != '' and $lien_1 !=''){$lien_1='';}

if($lien_2_1 != '' and $lien_1_1 !=''){$lien_1_1='';}

if($lien_3_1 != '' and $lien_1_1 !=''){$lien_1_1='';}

if($lien_4_1 != '' and $lien_1_1 !=''){$lien_1_1='';}

if($lien_5_1 != '' and $lien_1_1 !=''){$lien_1_1='';}



?>

<div class="subscription" style="width:100%; margin: 10px 0pt;">

   <h1>Choix :</h1>

</div>

<table width="100%">                

<tr>

<td width="25%">

         <div  class="champs_editable" <?php echo $lien_1; ?>>

            <a id="myHeader10" href="<?php  echo $urlad_repor  ?>/requeteur/" >

            <center><b <?php echo $lien_1_1; ?>>Requéteur</b></center></a>

         </div>

</td>

<td width="25%">

         <div  class="champs_editable" <?php echo $lien_2; ?>>

            <a id="myHeader10" href="<?php  echo $urlad_repor  ?>/requeteur/rapport_situation/" ><center><b <?php echo $lien_2_1; ?>>Rapport situation</b></center></a>

         </div>

</td>



<td width="25%">

         <div  class="champs_editable" <?php echo $lien_3; ?>>

            <a id="myHeader12" href="<?php  echo $urlad_repor  ?>/requeteur/rapport_entretien/"  ><center><b <?php echo $lien_3_1; ?>>Rapport entretien</b></center></a>

         </div>

</td>

</tr>

<tr>

<td width="25%">

         <div  class="champs_editable" <?php echo $lien_4; ?>>

            <a id="myHeader12" href="<?php  echo $urlad_repor  ?>/requeteur/rapport_avancement/"  ><center><b <?php echo $lien_4_1; ?>>Rapport avancement</b></center></a>

         </div>

</td>

<td colspan="2" width="25%">

         <div  class="champs_editable" <?php echo $lien_5; ?>>

            <a id="myHeader12" href="<?php  echo $urlad_repor  ?>/requeteur/rapport_offre/"  ><center><b <?php echo $lien_5_1; ?>>Rapport offre</b></center></a>

         </div>

</td>

</tr>

</table>



<div class="ligneBleu"></div>
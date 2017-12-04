<?php 
$valid_ds1 =strpos($_SERVER['REQUEST_URI'],'matching_offre/');
$valid_ds2 =strpos($_SERVER['REQUEST_URI'],'offre_matching_statique/'); 

$lien_1 =($valid_ds1>0)  ? " style='background-color: ".$color_bg.";' " : "";
$lien_2 =($valid_ds2>0)  ? " style='background-color: ".$color_bg.";' " : ""; 

$lien_1_1 =($valid_ds1>0)  ? " style='color:#fff' " : "";
$lien_2_1 =($valid_ds2>0)  ? " style='color:#fff' " : ""; 

if($lien_2 != '' and $lien_1 !=''){$lien_1='';}  

?>
<div class="subscription" style="width:100%; margin: 10px 0pt;">
   <h1>Choix :</h1>
</div>
<table width="100%">                
 
<tr>
<td width="25%">
         <div  class="champs_editable" <?php echo $lien_1; ?>>
            <a id="myHeader12" href="<?php  echo $urlad_offr  ?>/matching_offre/"  >
            <center><b <?php echo $lien_1_1; ?>>Dynamique matching</b></center></a>
         </div>
</td>
<td width="25%">
         <div  class="champs_editable" <?php echo $lien_2; ?>>
            <a id="myHeader12" href="<?php  echo $urlad_offr  ?>/matching_offre/offre_matching_statique/"  >
            <center><b <?php echo $lien_2_1; ?>>Statique matching</b></center></a>
         </div>
</td>
</tr>

</table>

<div class="ligneBleu"></div>
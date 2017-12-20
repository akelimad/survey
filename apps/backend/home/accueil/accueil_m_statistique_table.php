<table width="100%" border="0">

<tr>

<td colspan="2"><div class="subscription" style="width:100%; margin: 10px 0pt;">

 <h1>Offres d'emploi</h1>

</div></td>

</tr>

<!--////////////////// Offres en cours///////////////////////-->

<tr>

<td width="80%"><b>Offres en cours :</b></td>

<td  style="float: right;" >

    <?php 

$encours =  $nbr_encours ;

if ($encours)

echo '<a href="'.$urlad_offr.'/liste_offre/?r=c" title="Consulter">

<span class="badge badge-success">'.$encours.'</span></a>';

else echo  '<span class="badge badge-error">'.$encours.'</span>' ;?> 

</td>

</tr>

<!--//////////////////Offres archiv&eacute;es ///////////////////////-->

<tr>

<td><b>Offres archiv&eacute;es :</b></td>

<td style="float: right;">



<?php 

$archive =  $nbr_archiv ;

if ($archive)

echo '<a href="'.$urlad_offr.'/liste_offre/?r=a" title="Consulter">

<span class="badge badge-success">'.$archive.'</span> </a>';

else

echo '<span class="badge badge-error">'.$archive.'</span>';?>

</span>

</td>

</tr> 

<!--////////////////// Offres arrivant à &///////////////////////-->

<tr>

<td><b>Offres arrivant à &eacute;ch&eacute;ance dans moins de 7 jours :</b></td>

<td style="float: right;">

<?php 

$accept =  $nbr_echeance ;

if ($accept)

echo '<a href="'.$urlad_offr.'/liste_offre/?r=e" title="Consulter"> 

<span class="badge badge-success">'.$accept.'</span></a>';

else

echo '<span class="badge badge-error"> '.$accept.'</span> ';?>

</td>

</tr>

 <!--////////////////// ///////////////////////-->

 <!--////////////////// Campagne de recrutement &///////////////////////-->

<tr>

<td><b>Campagne de recrutement :</b></td>

<td style="float: right;">

<?php 

$accept =  $nbr_c_r_offre ;

if ($accept)

echo '<a href="'.$urlad_offr.'/campagne_recrutement/" title="Consulter"> 

<span class="badge badge-success">'.$accept.'</span></a>';

else

echo '<span class="badge badge-error">'.$accept.'</span> ';?>

</td>

</tr>

 <!--////////////////// Offres arrivant à &///////////////////////-->

</table>

 <!--////////////////// ///////////////////////-->

<table width="100%" border="0">

<tr colspan="2"><div class="subscription" style="width:100%; margin: 10px 0pt;">

<h1>Candidatures reçues</h1>

</div></tr>

<!--//////////////////  &///////////////////////-->

<tr>  

<td width="80%"><b>Nouvelles candidatures :</b></td>

<td   style="float: right;">
<a href="<?= site_url('backend/module/candidatures/candidature/list/0'); ?>" title="Consulter">

<span class="badge badge-success"><?= \Modules\Candidatures\Models\Candidatures::countByStatus(0); ?></span>

</td>

</tr>

<!--//////////////////  &///////////////////////-->

<!--//////////////////  &///////////////////////-->

<tr>

<td><b>Candidatures en cours :</b></td>

<td style="float: right;"><?php 

$accept =   $count_cours;

if ($accept)

echo '<a href="'. site_url('backend/module/candidatures/candidature') .'" title="Consulter">

<span class="badge badge-success">'. $accept.'</span></a>';

else

echo ' <span class="badge badge-error">'.$accept.' </span>';?>

</td>

</tr>  

<!--//////////////////  &///////////////////////-->

<!--//////////////////  &///////////////////////-->

<tr>

<td><b>Candidatures retenues :</b></td>

<td style="float: right;"><?php

$accept =  $count_retenu ;

if ($accept)

echo '<a href="'.$urlad_candatur.'/candidature_retenu/" title="Consulter">

<span class="badge badge-success">'.$accept.'</span></a>';

else

echo '<span class="badge badge-error">'.$accept.'</span>';?>

</td>

</tr>  

<!--//////////////////  &///////////////////////-->

<!--//////////////////  &///////////////////////-->

<tr>

<td><b>Candidatures recruté :</b></td>

<td style="float: right;"><?php 

$accept =   $count_recruter ;

if ($accept)

echo '<a href="'.$urlad_candatur.'/candidature_recruter/" title="Consulter">

<span class="badge badge-success">'.$accept.'</span></a>';

else

echo '<span class="badge badge-error">'.$accept.'</span>';?>

</td>

</tr> 

<!--//////////////////  &///////////////////////-->

<!--//////////////////  &///////////////////////-->

<tr>

<td><b>Candidatures non retenues :</b></td>

<td style="float: right;"><?php

$accept =  $count_non_retenu ;

if ($accept)

echo '<a href="'.$urlad_candatur.'/candidature_non_retenu/" title="Consulter">

<span class="badge badge-success">'. $accept .'</span></a>';

else

echo '<span class="badge badge-error">'.$accept.'</span>';?>

</td>

</tr>  

<!--//////////////////  &///////////////////////-->

<!--//////////////////  &///////////////////////-->

<tr>

<td><b>Candidatures spontanées :</b></td>

<td style="float: right;"><?php 

$accept = $cand_spontanee;

if ($accept)

echo '<a href="'.$urlad_candatur.'/candidature_spontannee/" title="Consulter">

<span class="badge badge-success">'.$accept.'</span></a>';

else

echo '<span class="badge badge-error"> '.$accept.'</span> ';?>

</td>

</tr>

<!--//////////////////  &///////////////////////-->

<!--////////////////// Candidatures pour stage &///////////////////////-->

<tr>

<td><b>Candidatures pour stage :</b></td>

<td style="float: right;"><?php 

$accept =  $cand_stage;

if ($accept)

echo '<a href="'.$urlad_candatur.'/candidature_stage/" title="Consulter">

<span class="badge badge-success">'.$accept.'</span></a>';

else

echo '<span class="badge badge-error">'.$accept.'</span>';?>

</td>

</tr>

<!--////////////////// Candidatures pour stage &///////////////////////-->

</table>  



<table width="100%" border="0">

<tr colspan="2"><div class="subscription" style="width:100%; margin: 10px 0pt;">

<h1>Candidats</h1>

</div>

</tr>

<!--////////////////// Nombre de candidats dans la Cv thèque &///////////////////////-->

<tr >

<td width="80%"><b>Nombre de candidats dans la Cv thèque :</b></td>

<td   style="float: right;" >

<?php 

$encours = $nbr_cv_cand;

if ($encours)

echo '<a href="'.$urlad_cand.'/cvtheque/" title="Consulter">

<span class="badge badge-success">'.$encours.'</span></a>';

else echo '<span class="badge badge-error">'.$encours.' </span>';?> 

</td>

</tr>

<!--////////////////// Nombre de candidats dans la Cv thèque &///////////////////////-->

<!--////////////////// Nombre de dossiers créés &///////////////////////-->

<tr>

<td><b>Nombre de dossiers créés :</b></td>

<td style="float: right;"><?php 

$archive = $nbr_doss_cand;

 if ($archive)

 echo '<a href="'.$urlad_cand.'/dossier/" title="Consulter">

<span class="badge badge-success">'.$archive.'</span></a>';

 else

echo ' <span class="badge badge-error">'.$archive.' </span>';?>

</td>

</tr> 

 <!--////////////////// Nombre de dossiers créés &///////////////////////-->

</table>
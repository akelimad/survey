<table width="100%" border="0">



<tr colspan="2">

<div class="subscription" style="width:100%; margin: 10px 0pt;">

<h1>Candidatures reçues</h1>

</div>

</tr>



<?php   if(isset( $_SESSION['menu1_c']) and  ($_SESSION['menu1_c'] == 1)) {  ?>

<tr>  

<td width="80%"><p><b>Nouvelles candidatures :</b></p></td>

<td   style="float: right;"><?php 

if ($new)

echo '<a href="'.$urlad_candatur.'/nouvelle_candidature/" title="Consulter">

<span class="badge badge-success">

 ' . $new . ' </span></a>';

else

echo ' <span class="badge badge-error">

'.$new.' </span>'; ?>

</td>

</tr>

<?php } ?>

<?php   if(isset( $_SESSION['menu2_c']) and  ($_SESSION['menu2_c'] == 1)) {  ?>

<!--//////////////////  &///////////////////////-->

<!--//////////////////  &///////////////////////-->

<tr>

<td><p><b>Candidatures en cours :</b></p></td>

<td style="float: right;"><?php 

$accept =   $count_cours;

if ($accept)

echo '<a href="'.$urlad_candatur.'/candidature_en_cours/" title="Consulter">

<span class="badge badge-success"> ' . $accept . ' </span></a>';

else

echo ' <span class="badge badge-error">'.$accept.' </span>';?>

</td>

</tr>

<?php } ?>

<?php   if(isset( $_SESSION['menu3_c']) and  ($_SESSION['menu3_c'] == 1)) {  ?>

<!--//////////////////  &///////////////////////-->

<!--//////////////////  &///////////////////////-->

<tr>

<td><p><b>Candidatures retenues :</b></p></td>

<td style="float: right;"><?php

$accept =  $count_retenu ;

if ($accept)

echo '<a href="'.$urlad_candatur.'/candidature_retenu/" title="Consulter">

<span class="badge badge-success">' . $accept . '</span></a>';

else

echo '<span class="badge badge-error">'.$accept.'</span>';?>

</td>

</tr>  

<!--//////////////////  &///////////////////////-->

<!--//////////////////  &///////////////////////-->

<?php } ?>

<?php   if(isset( $_SESSION['menu4_c']) and  ($_SESSION['menu4_c'] == 1)) {  ?>

<tr>

<td><p><b>Candidatures recruté :</b></p></td>

<td style="float: right;"><?php 

$accept =   $count_recruter ;

if ($accept)

echo '<a href="'.$urlad_candatur.'/candidature_recruter/" title="Consulter">

<span class="badge badge-success">' . $accept . '</span></a>';

else

echo '<span class="badge badge-error">'.$accept.'</span>';?>

</td>

</tr> 

<!--//////////////////  &///////////////////////-->

<!--//////////////////  &///////////////////////-->

<?php } ?>

<?php   if(isset( $_SESSION['menu5_c']) and  ($_SESSION['menu5_c'] == 1)) {  ?>

<tr>

<td><p><b>Candidatures non retenues :</b></p></td>

<td style="float: right;"><?php

$accept =  $count_non_retenu ;

if ($accept)

echo '<a href="'.$urlad_candatur.'/candidature_non_retenu/" title="Consulter">

<span class="badge badge-success">' . $accept . '</span></a>';

else

echo '<span class="badge badge-error">'.$accept.'</span>';?>

</td>

</tr>  

<!--//////////////////  &///////////////////////-->

<!--//////////////////  &///////////////////////-->

<?php } ?>

<?php   if(isset( $_SESSION['menu6_c']) and  ($_SESSION['menu6_c'] == 1)) {  ?>

<tr>

<td><p><b>Candidatures spontanées :</b></p></td>

<td style="float: right;"><?php 

$accept = $cand_spontanee;

if ($accept)

echo '<a href="'.$urlad_candatur.'/candidature_spontannee/" title="Consulter">

<span class="badge badge-success"> ' . $accept . ' </span></a>';

else

echo '<span class="badge badge-error"> '.$accept.'</span> ';?>

</td>

</tr>

<!--//////////////////  &///////////////////////-->

<!--////////////////// Candidatures pour stage &///////////////////////-->

<?php } ?>

<?php   if(isset( $_SESSION['menu7_c']) and  ($_SESSION['menu7_c'] == 1)) {  ?>

<tr>

<td><p><b>Candidatures pour stage :</b></p></td>

<td style="float: right;"><?php 

$accept =  $cand_stage;

if ($accept)

echo '<a href="'.$urlad_candatur.'/candidature_stage/" title="Consulter">

<span class="badge badge-success"> ' . $accept . ' </span></a>';

else

echo '<span class="badge badge-error"> '.$accept.' </span>';?>

</td>

</tr>

<?php } ?>

</table>
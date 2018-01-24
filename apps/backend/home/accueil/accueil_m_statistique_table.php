<?php use Modules\Candidatures\Models\Candidatures; ?>

<?php if(isAdmin()) : ?>
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
<?php endif; ?>

 <!--////////////////// ///////////////////////-->

<table width="100%" border="0">

<tr colspan="2"><div class="subscription" style="width:100%; margin: 10px 0pt;">

<h1>Candidatures reçues</h1>

</div></tr>


<?php
	foreach (Candidatures::getStatus() as $key => $status) : 
	$count = Candidatures::countByStatus($status->id_prm_statut_c);
	if(($count == 0 && !isAdmin()) || ($status->id_prm_statut_c == 53 && !isAdmin())) continue;
	?>
	<tr>  
		<td>
			<a href="<?= site_url('backend/module/candidatures/candidature/list/'. $status->id_prm_statut_c); ?>"><?= $status->statut; ?><span class="badge pull-right"><?= $count; ?></span></a>
		</td>
	</tr>
<?php endforeach; ?>

</table>  


<?php if(isAdmin()) : ?>
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
<?php endif; ?>
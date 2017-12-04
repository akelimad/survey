<div class='texte'>

                        <br/>

                        <h1>STATISTIQUES</h1>

                        Cette section vous permet d'avoir les statistiques de votre site <?php echo $nom_site; ?>. Vous pouvez choisir les statistiques sur :

                        <br><br>

                

                

<ul><!--

<li style="">

<h2><b><a href="<?php  echo $urlad_repor  ?>/?a=3&b=30" > Statistiques</a></b></h2>

</li>-->

<li style="">

<?php $req1="SELECT * FROM offre ORDER BY date_insertion DESC ";

$reponse1 = mysql_query($req1);

$donnee1=mysql_num_rows($reponse1);?>

<h2><b><a href="<?php  echo $urlad_repor  ?>/statistiques_offres/?a=3&b=31" >

Offres <?php //echo '( <b>'.$donnee1.'</b> )';?></a></b></h2>

<ul>

<li ><a href="<?php  echo $urlad_repor  ?>/statistiques_offres/nombre_offre/" >Nombre des offres sur le site</a></li>

<li ><a href="<?php  echo $urlad_repor  ?>/statistiques_offres/offres_details/" >Statistiques pour chaque offre</a></li>

<li ><a href="<?php  echo $urlad_repor  ?>/statistiques_offres/nombre_candidature/" >Nombre des candidatures par offre</a></li>

<li ><a href="<?php  echo $urlad_repor  ?>/statistiques_offres/nombre_candidature_spontannee/" >Nombre des candidatures spontanées</a></li>

<li ><a href="<?php  echo $urlad_repor  ?>/statistiques_offres/nombre_candidature_stage/" >Nombre des candidatures pour un stage</a></li>

</ul>   

</li>

<li style="">

<?php 

$req2="Select candidats_id  from candidats";

$select_nbr = mysql_query($req2);

$count_nbr = mysql_num_rows($select_nbr);

?>

<h2><b><a href="<?php  echo $urlad_repor  ?>/statistiques_candidats/?a=3&b=32" > 

Candidats <?php //echo '( <b>'.$count_nbr.'</b> )';?></a></b></h2>

<ul>

<li ><a href="<?php  echo $urlad_repor  ?>/statistiques_candidats/candidats_inscrits/">

Nombre des candidats inscrits</a></li>

<li ><a href="<?php  echo $urlad_repor  ?>/statistiques_candidats/comptes_mettre_en_veille/">

Nombre des comptes mettre en veille </a></li>

<li ><a href="<?php  echo $urlad_repor  ?>/statistiques_candidats/comptes_desactives/">

Nombre des comptes supprimées</a></li>

<li ><a href="<?php  echo $urlad_repor  ?>/statistiques_candidats/repartition_candidats/">Répartition des candidats</a></li>

<li ><a href="<?php  echo $urlad_repor  ?>/statistiques_candidats/cv_theque/">Nombre des CVs dans la CV-Thèque</a></li>

<li ><a href="<?php  echo $urlad_repor  ?>/statistiques_candidats/cv_importees/" >Nombre des CVs importes</a></li>

</ul>   

</li> 



<?php

		if (!empty($conf_pass) AND !empty($conf_login)){

?>

<li style="">

<h2><b><a href="<?php  echo $urlad_repor  ?>/statistiques_visiteurs/?a=3&b=33" > Visiteurs</a></b></h2>

<ul>

<li ><a href="<?php  echo $urlad_repor  ?>/statistiques_visiteurs/visiteurs_uniques/">Nombre des visiteurs uniques</a></li>

<li ><a href="<?php  echo $urlad_repor  ?>/statistiques_visiteurs/pages_vues/">Nombre des pages vues</a></li>

<li ><a href="<?php  echo $urlad_repor  ?>/statistiques_visiteurs/temps_sur_site/">Temps moyen passé sur le site </a></li>

<li ><a href="<?php  echo $urlad_repor  ?>/statistiques_visiteurs/taux_rebond/">Taux de rebond</a></li>

</ul>    

</li>

 <?php

		}

 ?>

<li style="">

<h2><b><a href="<?php  echo $urlad_repor  ?>/statistiques_visiteurs/?a=3&b=33" > Requêteur</a></b></h2>

<ul>

<li><a href="<?php  echo $urlad_repor  ?>/requeteur/rapport_situation/">Rapport situation</a></li>

<li><a href="<?php  echo $urlad_repor  ?>/requeteur/rapport_entretien/">Rapport entretien</a></li>

<li><a href="<?php  echo $urlad_repor  ?>/requeteur/rapport_avancement/">Rapport avancement</a></li>

<li><a href="<?php  echo $urlad_repor  ?>/requeteur//">Requêteur</a></li>

</ul>   

</li>

</ul>                        

 </div>
<?php
$urlad_offr = site_url('backend/offres');
$urlad_cand = site_url('backend/candidats');
$urlad_candatur = site_url('backend/candidatures');
$urlad_repor = site_url('backend/reporting');
$urlad_coresp = site_url('backend/courriers');
$urlad_admi = site_url('backend/administration');

$_SESSION['link']=isset($_GET['a'])	 ? $_GET['a']      : $_SESSION['link_bak_a'];
 

if ($_SESSION['link']==0)

	{$cls0='active';$cls1='';$cls2='';$cls3='';$cls4='';$cls5='';$cls6='';}

if ($_SESSION['link']==1)

	{$cls0='';$cls1='active';$cls2='';$cls3='';$cls4='';$cls5='';$cls6='';}

if ($_SESSION['link']==2)

	{$cls0='';$cls1='';$cls2='active';$cls3='';$cls4='';$cls5='';$cls6='';}

if ($_SESSION['link']==3)

	{$cls0='';$cls1='';$cls2='';$cls3='active';$cls4='';$cls5='';$cls6='';}

if ($_SESSION['link']==4)

	{$cls0='';$cls1='';$cls2='';$cls3='';$cls4='active';$cls5='';$cls6='';}

if ($_SESSION['link']==5)

	{$cls0='';$cls1='';$cls2='';$cls3='';$cls4='';$cls5='active';$cls6='';}

if ($_SESSION['link']==6)

	{$cls0='';$cls1='';$cls2='';$cls3='';$cls4='';$cls5='';$cls6='active';}

?>

<div>

<ul id="menu">
<?php	

if ($_SESSION['menu1'] == 1) 

 { 

?> 
	<li class="<?php echo $cls0; ?>">
	<a onclick="highlight_link(this);" href="<?= site_url('backend/accueil/'); ?>">
	

	Accueil</a></li>
<?php	
}

if ($_SESSION['menu2'] == 1) 

 { 

?> 
	<li  class="<?php echo $cls1; ?>">
		<a href="<?php  echo $urlad_offr  ?>/">Offres</a>

		<ul class="secondLevel">

			<li>
			
				<a  href="<?php  echo $urlad_offr  ?>/" >Etat des offres</a>
				
			</li>
		
			<li>

				<a href="<?php  echo $urlad_offr  ?>/creer_offre/">Créer une offre</a>			

			</li>

			<li>

				<a href="<?php  echo $urlad_offr  ?>/liste_offre/">Liste des offres </a>

			</li>

			<li>

				<a href="<?php  echo $urlad_offr  ?>/partager_offre/">Partager des offres </a>

			</li>
	  
              <?php
 

	if($_SESSION['r_prm_pertinenc_match']==0){
	 
              ?>
              
			<li>

				<a href="<?php  echo $urlad_offr  ?>/matching_offre/">Matching des offres </a>

			</li>
			  
             
              <?php
	}
	 
              ?>
        

			<li>

				<a href="<?php  echo $urlad_offr  ?>/campagne_recrutement/">Campagne de recrutement </a>			

			</li>

			<li>

				<a href="<?php  echo $urlad_offr  ?>/rechercher_offre/">Rechercher des offres</a>			

			</li>

		</ul>

	</li>
<?php	
}

if ($_SESSION['menu3'] == 1) 

 { 

?> 
	<li class="<?php echo $cls2; ?>">

		<a href="<?php  echo $urlad_cand  ?>/">Candidats</a>

		<ul class="secondLevel">


			<li>
			
				<a  href="<?php  echo $urlad_cand  ?>/" >Etat des candidats</a>
				
			</li>
			
			<li>

				<a href="<?php  echo $urlad_cand  ?>/cvtheque/">CV thèque</a>

			</li>

			<li>

				<a href="<?php  echo $urlad_cand  ?>/import_manuel_des_cv/">Import manuel des CVs</a>

			</li>

			<li>

				<a href="<?php  echo $urlad_cand  ?>/dossier/">Dossier</a>
			</li> 

		</ul>		

	</li>
<?php	
}

if ($_SESSION['menu4'] == 1) 

 { 

?> 

	<?php get_view('partials/candidature_menu', ['cls4' => $cls4]); ?>
	
	
<?php	
}

if ($_SESSION['menu5'] == 1) 

 { 

?> 
	
	<li class="<?php echo $cls3; ?>">

		<a href="<?php  echo $urlad_repor  ?>/">Reporting</a>	

		<ul class="secondLevel">

			<li>

				<a href="<?php  echo $urlad_repor  ?>/">Statistiques</a>					

			</li>

			<li>

				<a href="<?php  echo $urlad_repor  ?>/statistiques_offres/">Offres</a>					
				<ul class="secondLevel">
					<li><a style="white-space: initial;" href="<?php  echo $urlad_repor  ?>/statistiques_offres/nombre_offre/">
					Nombre des offres</a></li>
					<li><a style="white-space: initial;" href="<?php  echo $urlad_repor  ?>/statistiques_offres/offres_details/">
					Statistiques pour chaque offre</a></li>
					<li><a style="white-space: initial;" href="<?php  echo $urlad_repor  ?>/statistiques_offres/rapport_avancement/">
					Nombre des candidatures par offre</a></li>
					<li><a style="white-space: initial;" href="<?php  echo $urlad_repor  ?>/statistiques_offres/nombre_candidature/">
					Nombre des candidatures par offre</a></li>
					<li><a style="white-space: initial;" href="<?php  echo $urlad_repor  ?>/statistiques_offres/nombre_candidature_spontannee/">
					Nombre des candidatures spontanées</a></li>
					<li><a style="white-space: initial;" href="<?php  echo $urlad_repor  ?>/statistiques_offres/nombre_candidature_stage/">
					Nombre des candidatures pour stage</a></li>
				</ul>
			</li>

			<li>

				<a href="<?php  echo $urlad_repor  ?>/statistiques_candidats/" >Candidats</a>					
				<ul class="secondLevel">
					<li><a style="white-space: initial;" href="<?php  echo $urlad_repor  ?>/statistiques_candidats/candidats_inscrits/">
					Nombre des candidats inscrits</a></li>
					<li><a style="white-space: initial;" href="<?php  echo $urlad_repor  ?>/statistiques_candidats/comptes_desactives/">
					Nombre des comptes désactivés</a></li>
					<li><a style="white-space: initial;" href="<?php  echo $urlad_repor  ?>/statistiques_candidats/repartition_candidats/">
					Répartition des candidats</a></li>
					<li><a style="white-space: initial;" href="<?php  echo $urlad_repor  ?>/statistiques_candidats/cv_theque/">
					Nombre des CVs dans la CV-Thèque</a></li>
					<li><a style="white-space: initial;" href="<?php  echo $urlad_repor  ?>/statistiques_candidats/cv_importees/">
					Nombre des CVs importées</a></li>
				</ul>
			</li>

 <?php
		if (!empty($conf_pass) AND !empty($conf_login)){
 ?>
			<li>

				<a href="<?php  echo $urlad_repor  ?>/statistiques_visiteurs/" >Visiteurs</a>					
				<ul class="secondLevel">
					<li><a href="<?php  echo $urlad_repor  ?>/statistiques_visiteurs/visiteurs_uniques/">
					Nombre de visiteurs uniques</a></li>
					<li><a href="<?php  echo $urlad_repor  ?>/statistiques_visiteurs/pages_vues/">
					Nombre des pages vues</a></li>
					<li><a href="<?php  echo $urlad_repor  ?>/statistiques_visiteurs/temps_sur_site/">
					Temps moyen passé sur le site</a></li>
					<li><a href="<?php  echo $urlad_repor  ?>/statistiques_visiteurs/taux_rebond/">
					Taux de rebond</a></li>
				</ul>
			</li>
 <?php
		}  
 ?>
			<li >
				<a href="<?php  echo $urlad_repor  ?>/requeteur/" >Requêteur</a>
				<ul class="secondLevel">
					<li><a href="<?php  echo $urlad_repor  ?>/requeteur/">Requêteur </a>
						<ul class="secondLevel">
							<li ><a href="<?php  echo $urlad_repor  ?>/requeteur/?c=1">Notation manuelle </a></li>
							<li ><a href="<?php  echo $urlad_repor  ?>/requeteur/?c=2">Notation commission</a></li>
							<li ><a href="<?php  echo $urlad_repor  ?>/requeteur/?c=3">Entretien téléphonique </a></li>
							<li ><a href="<?php  echo $urlad_repor  ?>/requeteur/?c=4">Convocation entretien</a></li>
							<li ><a href="<?php  echo $urlad_repor  ?>/requeteur/?c=5">Entretien physique</a></li>
							<li ><a href="<?php  echo $urlad_repor  ?>/requeteur/?c=6">Retenu</a></li>
							<li ><a href="<?php  echo $urlad_repor  ?>/requeteur/?c=7">Recruter</a></li>
							<li ><a href="<?php  echo $urlad_repor  ?>/requeteur/?c=8">Non retenu</a></li>
						</ul>
					</li>
					<li><a href="<?php  echo $urlad_repor  ?>/requeteur/rapport_situation/">Rapport situation</a></li>
					<li><a href="<?php  echo $urlad_repor  ?>/requeteur/rapport_entretien/">Rapport entretien</a></li>
					<li><a href="<?php  echo $urlad_repor  ?>/requeteur/rapport_avancement/">Rapport avancement</a></li>
					<li><a href="<?php  echo $urlad_repor  ?>/requeteur/rapport_offre/">Rapport offre</a></li>
				</ul>
			</li>

		</ul>

	</li>


	
<?php	
}

if ($_SESSION['menu6'] == 1) 

 { 

?> 

			            

	<li class="<?php echo $cls5; ?>">

		<a href="<?php  echo $urlad_coresp  ?>/">Courriers</a>	

		<ul class="secondLevel"> 

			<li>

				<a href="<?php  echo $urlad_coresp  ?>/correspondances/">Historique des correspondances</a>					

			</li>
			<li>

				<a href="<?php  echo $urlad_coresp  ?>/courriers_type/">Courriers type</a>

			</li>
			
			<li>

				<a href="<?php  echo $urlad_coresp  ?>/mailing/">E-Mailing</a>					

			</li> 
		</ul>		

	</li>

	

<?php

 }

if ($_SESSION['menu7'] == 1) 

 { 

?> 


			<?php
			if( $_SESSION['abb_admin'] == 'root') {
			?>
			            

	<li class="<?php echo $cls6; ?>">

		<a href="<?php  echo $urlad_admi  ?>/profils/">Root</a>	

		<ul class="secondLevel">
			<li>

				<a href="<?php  echo $urlad_admi  ?>/profils/">Gestion des profils</a>					

			</li>
			<li>

				<a href="<?php  echo $urlad_admi  ?>/filiales/">Gestion des filiales</a>			

			</li> 
			<li>

				<a href="<?php  echo $urlad_admi  ?>/permissions/">Gestion des permissions</a>			

			</li> 
			<li>

				<a href="<?php  echo $urlad_admi  ?>/profils_stage/">Gestion des profils de stage</a>					

			</li>
			<li>

				<a href="<?php  echo $urlad_admi  ?>/courriers_automatique/">Courriers automatique</a>			

			</li> 
			
			<li>

				<a href="<?php  echo $urlad_admi  ?>/personnalisation_champs/">Personnalisation des champs</a>

			</li>
			

			<li>

				<a href="<?php  echo $urlad_admi  ?>/champs_editables_root/">Champs éditables</a>

			</li>
			
			<li>

				<a href="<?php  echo $urlad_admi  ?>/problemes_signales/">Gestion des problèmes signalés</a>

			</li> 


			<?php if(isModuleEnabled('workflows')) : ?>
				<li>
					<a href="<?= site_url('backend/module/workflows/workflow'); ?>">Gestion des workflows</a>		
				</li>
			<?php endif; ?>

			<?php if(isModuleEnabled('fiches')) : ?>
				<li>
					<a href="<?= site_url('backend/module/fiches/fiche'); ?>">Fiches de présélection / evaluation</a>		
				</li>
			<?php endif; ?>

			
			<li>

				<a href="<?php  echo $urlad_admi  ?>/historique_connexion/">Historique de connexion</a>

			</li> 
			<li>

				<a href="<?php  echo $urlad_admi  ?>/parametrage/">Paramètrage</a>

			</li>
			<li>

				<a href="<?php  echo $urlad_admi  ?>/config/">Config</a>

			</li> 
		</ul>		

	</li>

	
			<?php
			}	else {
			?>
	
				            

	<li class="<?php echo $cls6; ?>">

		<a href="<?php  echo $urlad_admi  ?>/profils/">Admin</a>	

		<ul class="secondLevel">
			<li>

				<a href="<?php  echo $urlad_admi  ?>/profils/">Gestion des profils</a>					

			</li>
			<li>

				<a href="<?php  echo $urlad_admi  ?>/filiales/">Gestion des filiales</a>			

			</li> 
			<li>

				<a href="<?php  echo $urlad_admi  ?>/permissions/">Gestion des permissions</a>			

			</li> 
			 
			<li>

				<a href="<?php  echo $urlad_admi  ?>/champs_editables/">Champs éditables</a>

			</li>
		
			
		</ul>		

	</li>
 
			<?php
			}
			?>
	

<?php
 }	 
 ?>	

</ul>

</div>
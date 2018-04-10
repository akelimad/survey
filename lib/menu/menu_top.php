<!--MENU PRINCIPAL -->
<?php

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
	<a onclick="highlight_link(this);" href="<?php  echo $urladmin  ?>/">
	

	Accueil</a></li>
<?php	
}

if ($_SESSION['menu2'] == 1) 

 { 

?> 
	<li  class="<?php echo $cls1; ?>">
		<a href="<?php  echo $urlad_offr  ?>/"><?php trans_e("Offres"); ?></a>

		<ul class="secondLevel">

			<li>
			
				<a  href="<?php  echo $urlad_offr  ?>/" ><?php trans_e("Etat des offres"); ?></a>
				
			</li>
		
			<li>

				<a href="<?php  echo $urlad_offr  ?>/creer_offre/"><?php trans_e("Créer une offre"); ?></a>			

			</li>

			<li>

				<a href="<?php  echo $urlad_offr  ?>/liste_offre/"><?php trans_e("Liste des offres"); ?> </a>

			</li>

			<li>

				<a href="<?php  echo $urlad_offr  ?>/partager_offre/"><?php trans_e("Partager des offres"); ?> </a>

			</li>
	  
              <?php
 

	if($_SESSION['r_prm_pertinenc_match']==0){
	 
              ?>
              
			<li>

				<a href="<?php  echo $urlad_offr  ?>/matching_offre/"><?php trans_e("Matching des offres"); ?> </a>

			</li>
			  
             
              <?php
	}
	 
              ?>
        

			<li>

				<a href="<?php  echo $urlad_offr  ?>/campagne_recrutement/"><?php trans_e("Campagne de recrutement"); ?> </a>			

			</li>

			<li>

				<a href="<?php  echo $urlad_offr  ?>/rechercher_offre/"><?php trans_e("Rechercher des offres"); ?></a>			

			</li>

		</ul>

	</li>
<?php	
}

if ($_SESSION['menu3'] == 1) 

 { 

?> 
	<li class="<?php echo $cls2; ?>">

		<a href="<?php  echo $urlad_cand  ?>/"><?php trans_e("Candidats"); ?></a>

		<ul class="secondLevel">


			<li>
			
				<a  href="<?php  echo $urlad_cand  ?>/" ><?php trans_e("Etat des candidats"); ?></a>
				
			</li>
			
			<li>

				<a href="<?php  echo $urlad_cand  ?>/cvtheque/"><?php trans_e("CV thèque"); ?></a>

			</li>
			<li>

				<a href="<?php  echo $urlad_cand  ?>/cvimporter/"><?php trans_e("CV Importer"); ?></a>

			</li>

			<li>

				<a href="<?php  echo $urlad_cand  ?>/import_manuel_des_cv/"><?php trans_e("Import manuel des CVs"); ?></a>

			</li>

			<li>

				<a href="<?php  echo $urlad_cand  ?>/dossier/"><?php trans_e("Dossier"); ?></a>
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

		<a href="<?php  echo $urlad_repor  ?>/"><?php trans_e("Reporting"); ?></a>	

		<ul class="secondLevel">

			<li>

				<a href="<?php  echo $urlad_repor  ?>/"><?php trans_e("Statistiques"); ?></a>					

			</li>

			<li>

				<a href="<?php  echo $urlad_repor  ?>/statistiques_offres/"><?php trans_e("Offres"); ?></a>					
				<ul class="secondLevel">
					<li><a style="white-space: initial;" href="<?php  echo $urlad_repor  ?>/statistiques_offres/nombre_offre/">
					<?php trans_e("Nombre des offres"); ?></a></li>
					<li><a style="white-space: initial;" href="<?php  echo $urlad_repor  ?>/statistiques_offres/offres_details/">
					<?php trans_e("Statistiques pour chaque offre"); ?></a></li>
					<li><a style="white-space: initial;" href="<?php  echo $urlad_repor  ?>/statistiques_offres/rapport_avancement/">
					<?php trans_e("Nombre des candidatures par offre"); ?></a></li>
					<li><a style="white-space: initial;" href="<?php  echo $urlad_repor  ?>/statistiques_offres/nombre_candidature/">
					<?php trans_e("Nombre des candidatures par offre"); ?></a></li>
					<li><a style="white-space: initial;" href="<?php  echo $urlad_repor  ?>/statistiques_offres/nombre_candidature_spontannee/">
					<?php trans_e("Nombre des candidatures spontanées"); ?></a></li>
					<li><a style="white-space: initial;" href="<?php  echo $urlad_repor  ?>/statistiques_offres/nombre_candidature_stage/">
					<?php trans_e("Nombre des candidatures pour stage"); ?></a></li>
				</ul>
			</li>

			<li>

				<a href="<?php  echo $urlad_repor  ?>/statistiques_candidats/" ><?php trans_e("Candidats"); ?></a>					
				<ul class="secondLevel">
					<li><a style="white-space: initial;" href="<?php  echo $urlad_repor  ?>/statistiques_candidats/candidats_inscrits/">
					<?php trans_e("Nombre des candidats inscrits"); ?></a></li>
					<li><a style="white-space: initial;" href="<?php  echo $urlad_repor  ?>/statistiques_candidats/comptes_desactives/">
					<?php trans_e("Nombre des comptes désactivés"); ?></a></li>
					<li><a style="white-space: initial;" href="<?php  echo $urlad_repor  ?>/statistiques_candidats/repartition_candidats/">
					<?php trans_e("Répartition des candidats"); ?></a></li>
					<li><a style="white-space: initial;" href="<?php  echo $urlad_repor  ?>/statistiques_candidats/cv_theque/">
					<?php trans_e("Nombre des CVs dans la CV-Thèque"); ?></a></li>
					<li><a style="white-space: initial;" href="<?php  echo $urlad_repor  ?>/statistiques_candidats/cv_importees/">
					<?php trans_e("Nombre des CVs importées"); ?></a></li>
				</ul>
			</li>

 <?php
		if (!empty($conf_pass) AND !empty($conf_login)){
 ?>
			<li>

				<a href="<?php  echo $urlad_repor  ?>/statistiques_visiteurs/" ><?php trans_e("Visiteurs"); ?></a>					
				<ul class="secondLevel">
					<li><a href="<?php  echo $urlad_repor  ?>/statistiques_visiteurs/visiteurs_uniques/">
					<?php trans_e("Nombre de visiteurs uniques"); ?></a></li>
					<li><a href="<?php  echo $urlad_repor  ?>/statistiques_visiteurs/pages_vues/">
					<?php trans_e("Nombre des pages vues"); ?></a></li>
					<li><a href="<?php  echo $urlad_repor  ?>/statistiques_visiteurs/temps_sur_site/">
					<?php trans_e("Temps moyen passé sur le site"); ?></a></li>
					<li><a href="<?php  echo $urlad_repor  ?>/statistiques_visiteurs/taux_rebond/">
					<?php trans_e("Taux de rebond"); ?></a></li>
				</ul>
			</li>
 <?php
		}  
 ?>
			<li >
				<a href="<?php  echo $urlad_repor  ?>/requeteur/" ><?php trans_e("Requêteur"); ?></a>
				<ul class="secondLevel">
					<li><a href="<?php  echo $urlad_repor  ?>/requeteur/"><?php trans_e("Requêteur"); ?> </a>
						<ul class="secondLevel">
							<li ><a href="<?php  echo $urlad_repor  ?>/requeteur/?c=1"><?php trans_e("Notation manuelle"); ?> </a></li>
							<li ><a href="<?php  echo $urlad_repor  ?>/requeteur/?c=2"><?php trans_e("Notation commission"); ?></a></li>
							<li ><a href="<?php  echo $urlad_repor  ?>/requeteur/?c=3"><?php trans_e("Entretien téléphonique"); ?> </a></li>
							<li ><a href="<?php  echo $urlad_repor  ?>/requeteur/?c=4"><?php trans_e("Convocation entretien"); ?></a></li>
							<li ><a href="<?php  echo $urlad_repor  ?>/requeteur/?c=5"><?php trans_e("Entretien physique"); ?></a></li>
							<li ><a href="<?php  echo $urlad_repor  ?>/requeteur/?c=6"><?php trans_e("Retenu"); ?></a></li>
							<li ><a href="<?php  echo $urlad_repor  ?>/requeteur/?c=7"><?php trans_e("Recruter"); ?></a></li>
							<li ><a href="<?php  echo $urlad_repor  ?>/requeteur/?c=8"><?php trans_e("Non retenu"); ?></a></li>
						</ul>
					</li>
					<li><a href="<?php  echo $urlad_repor  ?>/requeteur/rapport_situation/"><?php trans_e("Rapport situation"); ?></a></li>
					<li><a href="<?php  echo $urlad_repor  ?>/requeteur/rapport_entretien/"><?php trans_e("Rapport entretien"); ?></a></li>
					<li><a href="<?php  echo $urlad_repor  ?>/requeteur/rapport_avancement/"><?php trans_e("Rapport avancement"); ?></a></li>
					<li><a href="<?php  echo $urlad_repor  ?>/requeteur/rapport_offre/"><?php trans_e(Rapport offre""); ?></a></li>
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

		<a href="<?php  echo $urlad_coresp  ?>/"><?php trans_e("Courriers"); ?></a>	

		<ul class="secondLevel"> 

			<li>

				<a href="<?php  echo $urlad_coresp  ?>/correspondances/"><?php trans_e("Historique des correspondances"); ?></a>					

			</li>
			<li>

				<a href="<?php  echo $urlad_coresp  ?>/courriers_type/"><?php trans_e("Courriers type"); ?></a>

			</li>
			
			<li>

				<a href="<?php  echo $urlad_coresp  ?>/mailing/"><?php trans_e("E-Mailing"); ?></a>					

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

		<a href="<?php  echo $urlad_admi  ?>/profils/"><?php trans_e("Root"); ?></a>	

		<ul class="secondLevel">
			<li>

				<a href="<?php  echo $urlad_admi  ?>/profils/"><?php trans_e("Gestion des profils"); ?></a>					

			</li>
			<li>

				<a href="<?php  echo $urlad_admi  ?>/filiales/"><?php trans_e("Gestion des filiales"); ?></a>			

			</li> 
			<li>

				<a href="<?php  echo $urlad_admi  ?>/permissions/"><?php trans_e("Gestion des permissions"); ?></a>			

			</li> 
			<li>

				<a href="<?php  echo $urlad_admi  ?>/profils_stage/"><?php trans_e("Gestion des profils de stage"); ?></a>					

			</li>
			<li>

				<a href="<?php  echo $urlad_admi  ?>/courriers_automatique/"><?php trans_e("Courriers automatique"); ?></a>			

			</li> 
			
			<li>

				<a href="<?php  echo $urlad_admi  ?>/personnalisation_champs/"><?php trans_e("Personnalisation des champs"); ?></a>

			</li>
			

			<li>

				<a href="<?php  echo $urlad_admi  ?>/champs_editables_root/"><?php trans_e("Champs éditables"); ?></a>

			</li>
			
			<li>

				<a href="<?php  echo $urlad_admi  ?>/problemes_signales/"><?php trans_e("Gestion des problèmes signalés"); ?></a>

			</li> 

			<?php if(isModuleEnabled('workflows')) : ?>
				<li>
					<a href="<?= site_url('backend/module/workflows/workflow'); ?>"><?php trans_e("Gestion des workflows"); ?></a>		
				</li>
			<?php endif; ?>

			<?php if(isModuleEnabled('fiches')) : ?>
				<li>
					<a href="<?= site_url('backend/module/fiches/fiche'); ?>"><?php trans_e("Fiches de présélection / evaluation"); ?></a>		
				</li>
			<?php endif; ?>
			
			<li>

				<a href="<?php  echo $urlad_admi  ?>/historique_connexion/"><?php trans_e("Historique de connexion"); ?></a>

			</li> 
			<li>

				<a href="<?php  echo $urlad_admi  ?>/parametrage/"><?php trans_e("Paramètrage"); ?></a>

			</li>
			<li>

				<a href="<?php  echo $urlad_admi  ?>/config/"><?php trans_e("Config"); ?></a>

			</li> 
		</ul>		

	</li>

	
			<?php
			}	else {
			?>
	
				            

	<li class="<?php echo $cls6; ?>">

		<a href="<?php  echo $urlad_admi  ?>/profils/"><?php trans_e("Admin"); ?></a>	

		<ul class="secondLevel">
			<li>

				<a href="<?php  echo $urlad_admi  ?>/profils/"><?php trans_e("Gestion des profils"); ?></a>					

			</li>
			<li>

				<a href="<?php  echo $urlad_admi  ?>/filiales/"><?php trans_e("Gestion des filiales"); ?></a>			

			</li> 
			<li>

				<a href="<?php  echo $urlad_admi  ?>/permissions/"><?php trans_e("Gestion des permissions"); ?></a>			

			</li> 
			 
			<li>

				<a href="<?php  echo $urlad_admi  ?>/champs_editables/"><?php trans_e("Champs éditables"); ?></a>

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
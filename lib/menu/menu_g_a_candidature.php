<div id="menu-fo1">

						

	<ul id="menu_site_carriere" style="padding: 1px;">

<?php	

$_SESSION['s_link']=isset($_GET['b'])	 ? $_GET['b']      : $_SESSION['link_bak_b'];


if ($_SESSION['link']==4)

	{

	$s_cls0='ctl00_liSpontanee';$s_cls1='ctl00_liSpontanee';$s_cls2='ctl00_liSpontanee';
	$s_cls3='ctl00_liSpontanee';$s_cls4='ctl00_liSpontanee';$s_cls5='borderbas';
	$s_cls6='ctl00_liSpontanee';$s_cls7='ctl00_liSpontanee';$s_cls8='ctl00_liSpontanee';
	$s_cls9='ctl00_liSpontanee';

	

	if ($_SESSION['s_link']==40)

		{$s_cls0='menufo-active';$s_cls1='ctl00_liSpontanee';$s_cls2='ctl00_liSpontanee';$s_cls3='ctl00_liSpontanee';$s_cls4='ctl00_liSpontanee';$s_cls5='borderbas';$s_cls6='ctl00_liSpontanee';$s_cls7='ctl00_liSpontanee';$s_cls8='ctl00_liSpontanee';$s_cls9='ctl00_liSpontanee';}

	if ($_SESSION['s_link']==41)

		{$s_cls0='ctl00_liSpontanee';$s_cls1='menufo-active';$s_cls2='ctl00_liSpontanee';$s_cls3='ctl00_liSpontanee';$s_cls4='ctl00_liSpontanee';$s_cls5='borderbas';$s_cls6='ctl00_liSpontanee';$s_cls7='ctl00_liSpontanee';$s_cls8='ctl00_liSpontanee';$s_cls9='ctl00_liSpontanee';}

	if ($_SESSION['s_link']==42)

		{$s_cls0='ctl00_liSpontanee';$s_cls1='ctl00_liSpontanee';$s_cls2='menufo-active';$s_cls3='ctl00_liSpontanee';$s_cls4='ctl00_liSpontanee';$s_cls5='borderbas';$s_cls6='ctl00_liSpontanee';$s_cls7='ctl00_liSpontanee';$s_cls8='ctl00_liSpontanee';$s_cls9='ctl00_liSpontanee';}

	if ($_SESSION['s_link']==43)

		{$s_cls0='ctl00_liSpontanee';$s_cls1='ctl00_liSpontanee';$s_cls2='ctl00_liSpontanee';$s_cls3='menufo-active';$s_cls4='ctl00_liSpontanee';$s_cls5='borderbas';$s_cls6='ctl00_liSpontanee';$s_cls7='ctl00_liSpontanee';$s_cls8='ctl00_liSpontanee';$s_cls9='ctl00_liSpontanee';}

	if ($_SESSION['s_link']==44)

		{$s_cls0='ctl00_liSpontanee';$s_cls1='ctl00_liSpontanee';$s_cls2='ctl00_liSpontanee';$s_cls3='ctl00_liSpontanee';$s_cls4='menufo-active';$s_cls5='borderbas';$s_cls6='ctl00_liSpontanee';$s_cls7='ctl00_liSpontanee';$s_cls8='ctl00_liSpontanee';$s_cls9='ctl00_liSpontanee';}

	if ($_SESSION['s_link']==45)

		{$s_cls0='ctl00_liSpontanee';$s_cls1='ctl00_liSpontanee';$s_cls2='ctl00_liSpontanee';$s_cls3='ctl00_liSpontanee';$s_cls4='ctl00_liSpontanee';$s_cls5='menufo-active';$s_cls6='ctl00_liSpontanee';$s_cls7='ctl00_liSpontanee';$s_cls8='ctl00_liSpontanee';$s_cls9='ctl00_liSpontanee';}

	if ($_SESSION['s_link']==46)

		{$s_cls0='ctl00_liSpontanee';$s_cls1='ctl00_liSpontanee';$s_cls2='ctl00_liSpontanee';$s_cls3='ctl00_liSpontanee';$s_cls4='ctl00_liSpontanee';$s_cls5='borderbas';$s_cls6='menufo-active';$s_cls7='ctl00_liSpontanee';$s_cls8='ctl00_liSpontanee';$s_cls9='ctl00_liSpontanee';}

	if ($_SESSION['s_link']==47)

		{$s_cls0='ctl00_liSpontanee';$s_cls1='ctl00_liSpontanee';$s_cls2='ctl00_liSpontanee';$s_cls3='ctl00_liSpontanee';$s_cls4='ctl00_liSpontanee';$s_cls5='borderbas';$s_cls6='ctl00_liSpontanee';$s_cls7='menufo-active';$s_cls8='ctl00_liSpontanee';$s_cls9='ctl00_liSpontanee';}

	if ($_SESSION['s_link']==48)

		{$s_cls0='ctl00_liSpontanee';$s_cls1='ctl00_liSpontanee';$s_cls2='ctl00_liSpontanee';$s_cls3='ctl00_liSpontanee';$s_cls4='ctl00_liSpontanee';$s_cls5='borderbas';$s_cls6='ctl00_liSpontanee';$s_cls7='ctl00_liSpontanee';$s_cls8='menufo-active';$s_cls9='ctl00_liSpontanee';}

	if ($_SESSION['s_link']==49)

		{$s_cls0='ctl00_liSpontanee';$s_cls1='ctl00_liSpontanee';$s_cls2='ctl00_liSpontanee';$s_cls3='ctl00_liSpontanee';$s_cls4='ctl00_liSpontanee';$s_cls5='borderbas';$s_cls6='ctl00_liSpontanee';$s_cls7='ctl00_liSpontanee';$s_cls8='ctl00_liSpontanee';$s_cls9='menufo-active';}

	

	}

?>

<div>

<?php if(!(isset( $_SESSION['compte_v']) and  $_SESSION['compte_v'] > 0)) {  ?>	
 
<?php 	} ?>

		<li id="ctl00_liAlerte" class="<?php echo $s_cls6; ?>">

			<a id="ctl00_lnkAlerte" href="<?php  echo $urlad_candatur  ?>/" >
			<i class="fa fa-pie-chart " ></i> <?php trans_e("état des candidatures"); ?></a>

		</li>


<?php 	if(isset( $_SESSION['menu1_c']) and  ($_SESSION['menu1_c'] == 1)) {  ?>

		<li id="ctl00_liAlerte" class="<?php echo $s_cls0; ?>">

			<a id="ctl00_lnkAlerte" href="<?php  echo $urlad_candatur  ?>/nouvelle_candidature/" >
			<i class="fa fa-spinner " ></i> <?php trans_e("Nouvelles candidatures"); ?></a>

		</li>

<?php 	} ?>
<?php 	if(isset( $_SESSION['menu2_c']) and  ($_SESSION['menu2_c'] == 1)) {  ?>

		<li id="ctl00_liAlerte" class="<?php echo $s_cls1; ?>">

			<a  id="ctl00_lnkSpontanee" href="<?php  echo $urlad_candatur  ?>/candidature_en_cours/" >
			<i class="fa fa-list-ol " ></i> <?php trans_e("Candidatures en cours"); ?></a>

		</li>
 	
<?php 	} ?>
<?php 	if(isset( $_SESSION['menu3_c']) and  ($_SESSION['menu3_c'] == 1)) {  ?>

		<li id="ctl00_liAlerte" class="<?php echo $s_cls2; ?>">

			<a id="ctl00_lnkAlerte" href="<?php  echo $urlad_candatur  ?>/candidature_retenu/" >
			<i class="fa fa-list-ol " ></i> <?php trans_e("Candidatures retenues"); ?></a>

		</li>

<?php 	} ?>
<?php 	if(isset( $_SESSION['menu4_c']) and  ($_SESSION['menu4_c'] == 1)) {  ?>

		<li id="ctl00_liAlerte" class="<?php echo $s_cls7; ?>">

			<a id="ctl00_lnkAlerte" href="<?php  echo $urlad_candatur  ?>/candidature_recruter/" >
			<i class="fa fa-list-ol " ></i> <?php trans_e("Candidatures recruté"); ?></a>

		</li>
 
<?php 	} ?>
<?php 	if(isset( $_SESSION['menu5_c']) and  ($_SESSION['menu5_c'] == 1)) {  ?>
		
		<li id="ctl00_liAlerte" class="<?php echo $s_cls9; ?>">

			<a id="ctl00_lnkAlerte" href="<?php  echo $urlad_candatur  ?>/candidature_non_retenu/" >
			<i class="fa fa-list-ol " ></i> <?php trans_e("Candidatures non retenu"); ?></a>

		</li>
		
<?php 	} ?> 
			
<?php  

	if($_SESSION['r_prm_note']==0){
		 
		
?>

<?php if(!(isset( $_SESSION['compte_v']) and  $_SESSION['compte_v'] > 0)) {  ?>	
		<li id="ctl00_liAlerte" class="<?php echo $s_cls8; ?>">

			<a id="ctl00_lnkAlerte" href="<?php  echo $urlad_candatur  ?>/historique_note/" >
			<i class="fa fa-tasks " ></i> <?php trans_e("Historique des notes"); ?></a>

		</li>

<?php 	} ?>
	
<?php  
 
		}
		
?>

<?php 	if(isset( $_SESSION['menu6_c']) and  ($_SESSION['menu6_c'] == 1)) {  ?>

		<li id="ctl00_liAlerte" class="<?php echo $s_cls3; ?>">

			<a id="ctl00_lnkAlerte" href="<?php  echo $urlad_candatur  ?>/candidature_spontannee/" >
			<i class="fa fa-book " ></i> <?php trans_e("Candidatures spontanées"); ?></a>

		</li>

<?php 	} ?>
<?php 	if(isset( $_SESSION['menu7_c']) and  ($_SESSION['menu7_c'] == 1)) {  ?>

		<li id="ctl00_liAlerte" class="<?php echo $s_cls4; ?>">

			<a id="ctl00_lnkAlerte" href="<?php  echo $urlad_candatur  ?>/candidature_stage/" >
			<i class="fa fa-book " ></i> <?php trans_e("Candidatures pour stage"); ?></a>

		</li>
		
		<?php }  ?>
		
		 <!--
		<?php if (isset($_SESSION['ref_filiale_role']) and $_SESSION['ref_filiale_role']=='0'){  ?> 
		<li id="ctl00_liAlerte" class="<?php echo $s_cls5; ?>">

			<a id="ctl00_lnkAlerte" href="<?php  echo $urlad_candatur  ?>/historique_candidats/" >
			<i class="fa fa-users " ></i> Historique des candidats</a>

		</li>
		<?php }  ?>
		-->
		 


	</ul>

</div>	
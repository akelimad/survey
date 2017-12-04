<div id="menu-fo1" style="  width: 200px;">
						
	<ul id="menu_site_carriere"  style="padding: 0px;">
<?php	

$_SESSION['s_link']=isset($_GET['b'])	 ? $_GET['b']      : $_SESSION['link_bak_b'];


if ($_SESSION['link']==1)
	{
	$s_cls0='ctl00_liSpontanee';$s_cls1='ctl00_liSpontanee';$s_cls2='ctl00_liSpontanee';$s_cls3='ctl00_liSpontanee';$s_cls4='borderbas'; 
	
	if ($_SESSION['s_link']==10)
		{$s_cls5='ctl00_liSpontanee';$s_cls0='menufo-active';$s_cls1='ctl00_liSpontanee';$s_cls2='ctl00_liSpontanee';$s_cls3='ctl00_liSpontanee';$s_cls4='borderbas';  $s_cls6='ctl00_liSpontanee';}
	if ($_SESSION['s_link']==11)
		{$s_cls5='ctl00_liSpontanee';$s_cls0='ctl00_liSpontanee';$s_cls1='menufo-active';$s_cls2='ctl00_liSpontanee';$s_cls3='ctl00_liSpontanee';$s_cls4='borderbas';  $s_cls6='ctl00_liSpontanee';}
	if ($_SESSION['s_link']==12)
		{$s_cls5='ctl00_liSpontanee';$s_cls0='ctl00_liSpontanee';$s_cls1='ctl00_liSpontanee';$s_cls2='menufo-active';$s_cls3='ctl00_liSpontanee';$s_cls4='borderbas';  $s_cls6='ctl00_liSpontanee';}
	if ($_SESSION['s_link']==13)
		{$s_cls5='ctl00_liSpontanee';$s_cls0='ctl00_liSpontanee';$s_cls1='ctl00_liSpontanee';$s_cls2='ctl00_liSpontanee';$s_cls3='menufo-active';$s_cls4='borderbas';  $s_cls6='ctl00_liSpontanee';}
	if ($_SESSION['s_link']==14)
		{$s_cls5='ctl00_liSpontanee';$s_cls0='ctl00_liSpontanee';$s_cls1='ctl00_liSpontanee';$s_cls2='ctl00_liSpontanee';$s_cls3='ctl00_liSpontanee';$s_cls4='menufo-active';  $s_cls6='ctl00_liSpontanee';}
	if ($_SESSION['s_link']==15)
		{$s_cls5='menufo-active';$s_cls0='ctl00_liSpontanee';$s_cls1='ctl00_liSpontanee';$s_cls2='ctl00_liSpontanee';$s_cls3='ctl00_liSpontanee';$s_cls4='borderbas'; $s_cls6='ctl00_liSpontanee';}
	if ($_SESSION['s_link']==16)
		{$s_cls5='ctl00_liSpontanee';$s_cls0='ctl00_liSpontanee';$s_cls1='ctl00_liSpontanee';$s_cls2='ctl00_liSpontanee';$s_cls3='ctl00_liSpontanee';$s_cls4='borderbas'; $s_cls6='menufo-active';}
	
	}
?>
		<li id="ctl00_liAlerte" class="<?php echo $s_cls5; ?>">
			<a id="ctl00_lnkAlerte"  href="<?php  echo $urlad_offr  ?>/" >
			<i class="fa fa-pie-chart " ></i> ETAT DES OFFRES</a>
		</li>
		<li id="ctl00_liAlerte" class="<?php echo $s_cls0; ?>">
			<a id="ctl00_lnkAlerte" href="<?php  echo $urlad_offr  ?>/creer_offre/" >
			<i class="fa fa-plus " ></i> CREER UNE OFFRE</a>
		</li>
		<li id="ctl00_liAlerte" class="<?php echo $s_cls1; ?>">
			<a  id="ctl00_lnkSpontanee" href="<?php  echo $urlad_offr  ?>/liste_offre/" >
			<i class="fa fa-list  " ></i> LISTE DES OFFRES</a>
		</li>
		<li id="ctl00_liAlerte" class="<?php echo $s_cls2; ?>">
			<a  id="ctl00_lnkSpontanee" href="<?php  echo $urlad_offr  ?>/partager_offre/" >
			<i class="fa fa-exchange " ></i> PARTAGER DES OFFRES</a>
		</li>	  
              <?php
 

	if($_SESSION['r_prm_pertinenc_match']==0){
	 
              ?>
              
        
		<li id="ctl00_liAlerte" class="<?php echo $s_cls3; ?>">
			<a  id="ctl00_lnkSpontanee" href="<?php  echo $urlad_offr  ?>/matching_offre/" >
			<i class="fa fa-user " ></i> MATCHING DES OFFRES</a>
		</li>
			  
             
              <?php
	}
	 
              ?>
		<li id="ctl00_liAlerte" class="<?php echo $s_cls6; ?>">
			<a  id="ctl00_lnkSpontanee" href="<?php  echo $urlad_offr  ?>/campagne_recrutement/" >
			<i class="fa fa-file " ></i> CAMPAGNE DE RECRUTEMENT</a>
		</li>
		<li id="ctl00_liAlerte" class="<?php echo $s_cls4; ?>">
			<a id="ctl00_lnkAlerte" href="<?php  echo $urlad_offr  ?>/rechercher_offre/" >
			<i class="fa fa-search " ></i> RECHERCHER DES OFFRES</a>
		</li>
	</ul>
</div>	
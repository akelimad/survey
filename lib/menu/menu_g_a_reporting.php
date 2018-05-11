<div id="menu-fo1">

						

	<ul id="menu_site_carriere" style="padding: 1px;">

<?php	
$s_cls0 = $s_cls1 = $s_cls2 = $s_cls3 = $s_cls4 = $s_cls5 = $s_cls6 = $s_cls7 = $s_cls8 = $s_cls9 =  $s_cls10 = '';


$_SESSION['s_link']=isset($_GET['b'])	 ? $_GET['b']      : $_SESSION['link_bak_b'];





if (isset($_SESSION['link']) && $_SESSION['link']==3)

	{

	//$s_cls0='ctl00_liSpontanee';$s_cls1='ctl00_liSpontanee';$s_cls2='borderbas';

	$s_cls0='ctl00_liSpontanee';$s_cls1='ctl00_liSpontanee';$s_cls2='ctl00_liSpontanee';$s_cls3='ctl00_liSpontanee';$s_cls4='borderbas';

	

	if ($_SESSION['s_link']==30)

		{$s_cls0='menufo-active';$s_cls1='ctl00_liSpontanee';$s_cls2='ctl00_liSpontanee';$s_cls3='ctl00_liSpontanee';$s_cls4='borderbas'; }

	if ($_SESSION['s_link']==31)

		{$s_cls0='ctl00_liSpontanee';$s_cls1='menufo-active';$s_cls2='ctl00_liSpontanee';$s_cls3='ctl00_liSpontanee';$s_cls4='borderbas'; }

	if ($_SESSION['s_link']==32)

		{$s_cls0='ctl00_liSpontanee';$s_cls1='ctl00_liSpontanee';$s_cls2='menufo-active';$s_cls3='ctl00_liSpontanee';$s_cls4='borderbas'; }

	if ($_SESSION['s_link']==33)

		{$s_cls0='ctl00_liSpontanee';$s_cls1='ctl00_liSpontanee';$s_cls2='ctl00_liSpontanee';$s_cls3='menufo-active';$s_cls4='borderbas'; }

	if ($_SESSION['s_link']==34)

		{$s_cls0='ctl00_liSpontanee';$s_cls1='ctl00_liSpontanee';$s_cls2='ctl00_liSpontanee';$s_cls3='ctl00_liSpontanee';$s_cls4='menufo-active'; }	

	}

?>

		<li id="ctl00_liAlerte" class="<?php echo $s_cls0; ?>">

			<a href="<?php  echo $urlad_repor  ?>/" id="ctl00_lnkAlerte">

			<i class="fa fa-pie-chart " ></i> <?php trans_e("Statistiques"); ?></a>

		</li>

		<li id="ctl00_liSpontanee" class="<?php echo $s_cls1; ?>">

			<a href="<?php  echo $urlad_repor  ?>/statistiques_offres/"  id="ctl00_lnkAlerte">

			<i class="fa fa-pie-chart " ></i> <?php trans_e("Offres"); ?></a>

		</li>

		<li id="ctl00_liSpontanee" class="<?php echo $s_cls2; ?>">

			<a href="<?php  echo $urlad_repor  ?>/statistiques_candidats/"  id="ctl00_lnkAlerte">

			<i class="fa fa-pie-chart " ></i> <?php trans_e("Candidats"); ?></a>

		</li>

		

 <?php

		if (!empty($conf_pass) AND !empty($conf_login)){

 ?>

		<li id="ctl00_liSpontanee" class="<?php echo $s_cls3; ?>">

			<a href="<?php  echo $urlad_repor  ?>/statistiques_visiteurs/"  id="ctl00_lnkAlerte">

			<i class="fa fa-pie-chart " ></i> <?php trans_e("Visiteurs"); ?></a>

		</li>

 <?php

		}

 ?>

		<li id="ctl00_liSpontanee" class="<?php echo $s_cls4; ?>">

			<a href="<?php  echo $urlad_repor  ?>/requeteur/"  id="ctl00_lnkAlerte">

			<i class="fa fa-pie-chart " ></i> <?php trans_e("Requêteur"); ?></a>

		</li>

	</ul>

</div>	
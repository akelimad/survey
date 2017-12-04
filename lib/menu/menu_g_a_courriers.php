<div id="menu-fo" style="width: 250px;">

						

	<ul id="menu_site_carriere" style="padding: 1px;">

<?php	


$_SESSION['s_link']=isset($_GET['b'])	 ? $_GET['b']      : $_SESSION['link_bak_b'];




if ($_SESSION['link']==5)

	{

	$s_cls0='ctl00_liSpontanee';$s_cls1='ctl00_liSpontanee';$s_cls2='ctl00_liSpontanee';$s_cls3='ctl00_liSpontanee';$s_cls4='borderbas'; 

	

	if ($_SESSION['s_link']==50)

		{$s_cls6='ctl00_liSpontanee';$s_cls7='ctl00_liSpontanee';$s_cls0='menufo-active';$s_cls1='ctl00_liSpontanee';$s_cls2='ctl00_liSpontanee';$s_cls3='ctl00_liSpontanee';$s_cls4='borderbas'; $s_cls5='borderbas';  }

	if ($_SESSION['s_link']==51)

		{$s_cls6='ctl00_liSpontanee';$s_cls7='ctl00_liSpontanee';$s_cls0='ctl00_liSpontanee';$s_cls1='menufo-active';$s_cls2='ctl00_liSpontanee';$s_cls3='ctl00_liSpontanee';$s_cls4='borderbas'; $s_cls5='borderbas';  }

	if ($_SESSION['s_link']==52)

		{$s_cls6='ctl00_liSpontanee';$s_cls7='ctl00_liSpontanee';$s_cls0='ctl00_liSpontanee';$s_cls1='ctl00_liSpontanee';$s_cls2='menufo-active';$s_cls3='ctl00_liSpontanee';$s_cls4='borderbas'; $s_cls5='borderbas';  }

	if ($_SESSION['s_link']==53)

		{$s_cls6='ctl00_liSpontanee';$s_cls7='ctl00_liSpontanee';$s_cls0='ctl00_liSpontanee';$s_cls1='ctl00_liSpontanee';$s_cls2='ctl00_liSpontanee';$s_cls3='menufo-active';$s_cls4='borderbas'; $s_cls5='borderbas'; }

	if ($_SESSION['s_link']==54)

		{$s_cls6='ctl00_liSpontanee';$s_cls7='ctl00_liSpontanee';$s_cls0='ctl00_liSpontanee';$s_cls1='ctl00_liSpontanee';$s_cls2='ctl00_liSpontanee';$s_cls3='ctl00_liSpontanee';$s_cls4='menufo-active'; $s_cls5='borderbas'; }

	if ($_SESSION['s_link']==55)

		{$s_cls6='ctl00_liSpontanee';$s_cls7='ctl00_liSpontanee';$s_cls0='ctl00_liSpontanee';$s_cls1='ctl00_liSpontanee';$s_cls2='ctl00_liSpontanee';$s_cls3='ctl00_liSpontanee';$s_cls4='ctl00_liSpontanee'; $s_cls5='menufo-active'; }

	if ($_SESSION['s_link']==56)

		{$s_cls6='menufo-active';$s_cls7='ctl00_liSpontanee';$s_cls0='ctl00_liSpontanee';$s_cls1='ctl00_liSpontanee';$s_cls2='ctl00_liSpontanee';$s_cls3='ctl00_liSpontanee';$s_cls4='ctl00_liSpontanee'; $s_cls5='borderbas'; }

	if ($_SESSION['s_link']==57)

		{$s_cls6='ctl00_liSpontanee';$s_cls7='menufo-active';$s_cls0='ctl00_liSpontanee';$s_cls1='ctl00_liSpontanee';$s_cls2='ctl00_liSpontanee';$s_cls3='ctl00_liSpontanee';$s_cls4='ctl00_liSpontanee'; $s_cls5='borderbas'; }

		

	}

?>

			<li id="ctl00_liAlerte" class="<?php echo $s_cls6; ?>">
				<a id="ctl00_lnkAlerte" href="<?php  echo $urlad_coresp  ?>/correspondances/" >
				<i class="fa fa-bolt " ></i> Historique des correspondances</a>
			</li>

			<li id="ctl00_liAlerte" class="<?php echo $s_cls7; ?>">
				<a href="<?php  echo $urlad_coresp  ?>/courriers_type/">
				<i class="fa fa-at " ></i> Courriers type</a>
			</li>
			<li id="ctl00_liAlerte" class="<?php echo $s_cls5; ?>">

				<a href="<?php  echo $urlad_coresp  ?>/mailing/">
				<i class="fa fa-envelope-o " ></i> E-Mailing</a>					

			</li>
	

<!--		
			<li id="ctl00_liAlerte" class="<?php echo $s_cls1; ?>">

				<a href="<?php  echo $urlad_admi  ?>/g_role.php?a=5&b=51">Gestion des permissions</a>			

			</li>
			<li id="ctl00_liAlerte" class="<?php echo $s_cls1; ?>">

				<a href="<?php  echo $urlad_admi  ?>/historique_login.php?a=5&b=51">Historiques des Logins</a>			

			</li>

			<li id="ctl00_liAlerte" class="<?php echo $s_cls2; ?>">

				<a href="<?php  echo $urlad_admi  ?>/historique_cv.php?a=5&b=52">Historiques des importations de CV</a>			

			</li>
			<li id="ctl00_liAlerte" class="<?php echo $s_cls3; ?>">

				<a href="<?php  echo $urlad_admi  ?>/configuration.php?a=5&b=53">Personnalisation des champs</a>

			</li>

			<li id="ctl00_liAlerte" class="<?php echo $s_cls4; ?>">

				<a href="<?php  echo $urlad_admi  ?>/edit_champs.php?a=5&b=54">Champs editables</a>

			</li>

			<li id="ctl00_liAlerte" class="<?php echo $s_cls5; ?>">

				<a href="<?php  echo $urlad_admi  ?>/message_page.php?a=5&b=55">Message de page</a>

			</li>

-->
		

		

	</ul>

</div>	
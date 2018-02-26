                      <!-- début menu gauche -->

 

					<?php 

$rep_path = PHYSICAL_URI;
$c_index=strpos($_SERVER['REQUEST_URI'],$rep_path.'offres/');

$c_index_p=strpos($_SERVER['REQUEST_URI'],'infos/politique_rh/');

$c_index1=strpos($_SERVER['REQUEST_URI'],$rep_path.'candidat/');

$c_index0=strpos($_SERVER['REQUEST_URI'],$rep_path);

$c_spontannee=strpos($_SERVER['REQUEST_URI'],'offres/candidature_spontannee/');

$c_stage=strpos($_SERVER['REQUEST_URI'],'offres/candidature_stage/');



$menu__1='ctl00_liSpontanee';	$menu__2='ctl00_liSpontanee'; $menu__3='ctl00_liSpontanee';

 $menu__4='borderbas' ;$menu_5='borderbas' ;



// get current route
$route = \App\Route::getRoute();



if($c_index>0){  $menu__1='ctl00_liSpontanee';	$menu__2='ctl00_liSpontanee';

 $menu__3='ctl00_liSpontanee'; $menu__4='menufo-active' ; $menu__5='ctl00_liSpontanee' ;  }

elseif($c_index_p>0){  $menu__1='ctl00_liSpontanee';	$menu__2='ctl00_liSpontanee';

 $menu__3='ctl00_liSpontanee'; $menu__4='borderbas' ;$menu__5='menufo-active' ;  }

elseif($c_index1>0){  $menu__1='ctl00_liSpontanee';	$menu__2='ctl00_liSpontanee';

 $menu__3='ctl00_liSpontanee'; $menu__4='borderbas' ;$menu__5='ctl00_liSpontanee' ;   }

elseif($c_index0>0){  $menu__1='menufo-active';	$menu__2='ctl00_liSpontanee';

 $menu__3='ctl00_liSpontanee'; $menu__4='borderbas' ;$menu__5='ctl00_liSpontanee' ;  }



if($c_spontannee>0){  $menu__1='ctl00_liSpontanee';	$menu__2='menufo-active'; $menu__3='ctl00_liSpontanee';$menu__5='ctl00_liSpontanee' ; $menu__4='borderbas' ;  }

if($c_stage>0){  $menu__1='ctl00_liSpontanee';	$menu__2='ctl00_liSpontanee'; $menu__3='menufo-active';$menu__5='ctl00_liSpontanee' ; $menu__4='borderbas' ;  }

                   



 ?>

 	 		

 <div id="menu-fo">

						

	<ul id="menu_site_carriere"> 

		<li id="ctl00_liAlerte" class="<?php echo $menu__1; ?>"> 

		<a id="ctl00_lnkAlerte" class="<?php echo $menu__1; ?>" href="<?php echo $site ?>" >

		<i class="fa fa-home fa-fw fa-lg"></i> Accueil </a> 

		</li>

		<?php if(get_setting('menu_offres_candidature_spontannee') == 1) : ?>
		<li id="ctl00_liAlerte" class="<?php echo $menu__2; ?>"> 

		<a  id="ctl00_lnkSpontanee" class="<?php echo $menu__1; ?>" href="<?php echo $urloffre ?>/candidature_spontannee/" >

		<i class="fa fa-book fa-fw fa-lg"></i> Déposer une candidature spontanée </a> 

		</li>		
		<?php endif; ?>																																	
		<?php if(get_setting('menu_offres_candidature_stage') == 1) : ?>
		<li id="ctl00_liSpontanee" class="<?php echo $menu__3; ?>">

			<a id="ctl00_lnkSpontanee" class="<?php echo $menu__1; ?>" href="<?php echo $urloffre ?>/candidature_stage/" >

			<i class="fa fa-book fa-fw fa-lg"></i> Déposer une candidature pour un stage

			</a>			

		</li>
		<?php endif; ?>

		<li id="ctl00_liAlerte">

			<a id="ctl00_lnkAlerte" <?= ($route=='offres') ? 'class="active"' : '' ?> href="<?php echo $urloffre ?>/" >

			<i class="fa fa-list fa-fw fa-lg"></i> Offres d'emploi

			</a>

		</li>

		<li id="ctl00_liAlerte">

			<a id="ctl00_lnkAlerte" <?= ($route=='offres/stage') ? 'class="active"' : '' ?> href="<?php echo $urloffre ?>/stage/" >

			<i class="fa fa-list fa-fw fa-lg"></i> Offres de stage

			</a>

		</li>

	</ul>

</div>							

                                             

							

									

		 

                    <!-- fin menu gauche -->                   

					
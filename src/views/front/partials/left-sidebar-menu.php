<?php $route = \App\Route::getRoute();
$secondaryMenu = array(
	[
		"label" => "Accueil",
		"route" => "/",
		"icon" => "fa fa-home"
	],
	[
		"label" => "Déposer une candidature spontanée",
		"route" => "offres/candidature_spontannee",
		"icon" => "fa fa-briefcase",
		"isVisible" => (get_setting('menu_offres_candidature_spontannee') == 1)
	],
	[
		"label" => "Déposer une candidature pour un stage",
		"route" => "offres/candidature_stage",
		"icon" => "fa fa-book",
		"isVisible" => (get_setting('menu_offres_candidature_stage') == 1)
	],
	[
		"label" => "Offres d'emploi",
		"route" => "offres",
		"icon" => "fa fa-list"
	],
	[
		"label" => "Offres de stage",
		"route" => "offres/stage",
		"icon" => "fa fa-list"
	],
);
?>
<ul class="nav nav-pills nav-stacked mb-15">
<?php foreach ($secondaryMenu as $key => $menu) : ?>
	<?php if(isset($menu['isVisible']) && $menu['isVisible'] === false) continue; ?>
	<li<?= ($route == $menu['route']) ? ' class="active"' : '' ?>>
		<a href="<?= site_url($menu['route']) ?>"><i class="<?= $menu['icon']; ?>"></i>&nbsp;<?= $menu['label']; ?></a>
	</li>
<?php endforeach; ?>
</ul>
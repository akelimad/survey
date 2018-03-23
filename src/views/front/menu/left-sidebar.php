<ul class="nav nav-pills nav-stacked mb-15" id="left-sidebar-menu">
<?php echo \App\Models\Menu::draw([
	[
		"label" => "Accueil",
		"route" => "/",
		"icon" => "fa fa-home"
	],
	[
		"label" => "Déposer une candidature spontanée",
		"route" => "",
		"icon" => "fa fa-handshake-o",
		"isVisible" => (get_setting('front_menu_offres_candidature_spontannee') == 1),
		"attributes" => [
			"onclick" => "return chmCandidature.spontanee()"
		]
	],
	[
		"label" => "Déposer une candidature pour un stage",
		"route" => "",
		"icon" => "fa fa-graduation-cap",
		"isVisible" => (get_setting('front_menu_offres_candidature_stage') == 1),
		"attributes" => [
			"onclick" => "return chmCandidature.stage()"
		]
	],
	[
		"label" => "Offres d'emploi",
		"route" => "offres",
		"icon" => "fa fa-briefcase"
	],
	[
		"label" => "Offres de stage",
		"route" => "offres/stage",
		"icon" => "fa fa-list"
	],
]); ?>
</ul>
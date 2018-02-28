<div class="panel panel-default" id="candidat-account-menu">
	<div class="panel-heading pb-0">
		<h4 class="panel-title">Espace candidat</h4>
	</div>
	<div class="panel-body pt-5">
		<div style="font-size: 12px;">Bienvenue&nbsp;:&nbsp;<strong><?= App\Models\Candidat::getDisplayName(null, false) ?></strong></div>
		<h3><i class="fa fa-lock"></i>&nbsp;Vous êtes connecté à votre espace</h3>
		
		<ul class="account-nav">
		<?php $canUpdateAccount = \Modules\Candidat\Models\Candidat::canUpdateAccount(); ?>
		<?php echo \App\Models\Menu::draw([
			[
				"label" => "Mon compte",
				"route" => "candidat/compte",
				"icon" => "fa fa-user"
			],
			[
				"label" => "Mes identifiants",
				"route" => "candidat/identifiants",
				"icon" => "fa fa-key"
			],
			[
				"label" => "Mon CV",
				"route" => "candidat/cv",
				"icon" => "fa fa-file-text-o",
				"childrens" => [
					[
						"label" => "Informations personnelles",
						"route" => "candidat/cv/informations",
						"icon" => "fa fa-id-card-o",
						"isActive" => $canUpdateAccount
					],
					[
						"label" => "Formations",
						"route" => "candidat/cv/formations",
						"icon" => "fa fa-graduation-cap",
						"isActive" => $canUpdateAccount
					],
					[
						"label" => "Expériences",
						"route" => "candidat/cv/experiences",
						"icon" => "fa fa-briefcase",
						"isActive" => $canUpdateAccount
					],
					[
						"label" => "Langues et pièces jointes",
						"route" => "candidat/cv/langues_pj",
						"icon" => "fa fa-language",
						"isActive" => $canUpdateAccount
					],
				]
			],
			[
				"label" => "Désactiver mon compte",
				"route" => "candidat/compte/desactiver",
				"icon" => "fa fa-ban",
				"isActive" => $canUpdateAccount
			],
			[
				"label" => "Déconnexion",
				"route" => "candidat/logout",
				"icon" => "fa fa-sign-out"
			]
		]); ?>
		</ul>
	</div>
</div>
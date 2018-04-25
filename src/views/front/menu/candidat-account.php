<div class="panel panel-default" id="candidat-account-menu">
	<div class="panel-heading pb-0">
		<h4 class="panel-title"><?php trans_e("Espace candidat"); ?></h4>
	</div>
	<div class="panel-body pt-5">
		<div style="font-size: 12px;"><?php trans_e("Bienvenue"); ?>&nbsp;:&nbsp;<strong><?= App\Models\Candidat::getDisplayName(null, true) ?></strong></div>
		<h3><i class="fa fa-lock"></i>&nbsp;<?php trans_e("Vous êtes connectés à votre espace"); ?></h3>
		
		<ul class="account-nav">
		<?php $canUpdateAccount = \Modules\Candidat\Models\Candidat::canUpdateAccount(); ?>
		<?php echo \App\Models\Menu::draw([
			[
				"label" => trans("Mon compte"),
				"route" => "candidat/compte",
				"icon" => "fa fa-user"
			],
			[
				"label" => trans("Mes identifiants"),
				"route" => "candidat/identifiants",
				"icon" => "fa fa-key"
			],
			[
				"label" => trans("Synchroniser votre compte linkedin"),
				"route" => "synchronize/compte/linkedin",
				"icon" => "fa fa-retweet"
			],
			[
				"label" => trans("Mon CV"),
				"route" => "candidat/cv",
				"icon" => "fa fa-file-text-o",
				"childrens" => [
					[
						"label" => trans("Informations personnelles"),
						"route" => "candidat/cv/informations",
						"icon" => "fa fa-id-card-o",
						"isActive" => $canUpdateAccount
					],
					[
						"label" => trans("Formations"),
						"route" => "candidat/cv/formations",
						"icon" => "fa fa-graduation-cap",
						"isActive" => $canUpdateAccount
					],
					[
						"label" => trans("Expériences"),
						"route" => "candidat/cv/experiences",
						"icon" => "fa fa-briefcase",
						"isActive" => $canUpdateAccount
					],
					[
						"label" => trans("Langues et pièces jointes"),
						"route" => "candidat/cv/langues_pj",
						"icon" => "fa fa-language",
						"isActive" => $canUpdateAccount
					],
				]
			],
			[
				"label" => trans("Désactiver mon compte"),
				"route" => "candidat/compte/desactiver",
				"icon" => "fa fa-ban",
				"isActive" => $canUpdateAccount
			],
			[
				"label" => trans("Déconnexion"),
				"route" => "candidat/logout",
				"icon" => "fa fa-sign-out"
			]
		]); ?>
		</ul>
	</div>
</div>
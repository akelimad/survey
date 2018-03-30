<?php
$isSuperAdmin = (read_session('id_type_role') == 1);
$status = getDB()->prepare("SELECT id_prm_statut_c as id, statut as label FROM prm_statut_candidature ORDER BY order_statut DESC");
$candidaturesStatus = [
	[
		"label" => "État des candidatures",
		"route" => "backend/module/candidatures/candidature/status"
	],
	[
		"label" => "Nouvelles candidatures",
		"route" => "backend/module/candidatures/candidature/list/0"
	],
	[
		"label" => "Candidatures en cours",
		"route" => "backend/module/candidatures/candidature"
	]
];
foreach ($status as $key => $value) {
	$candidaturesStatus[] = ["route" => "backend/module/candidatures/candidature/list/". $value->id, "label" => $value->label];
}

return array(
	[
		"label" => "Accueil",
		"route" => "backend/",
		"isVisible" => (read_session('menu1', 0) == 1)
	],
	[
		"label" => "Offres",
		"route" => "backend/offres/",
		"isVisible" => (read_session('menu2', 0) == 1),
		"childrens" => [
			[
				"label" => "Etat des offres",
				"route" => "backend/offres/"
			],
			[
				"label" => "Créer une offre",
				"route" => "backend/offres/creer_offre/"
			],
			[
				"label" => "Liste des offres",
				"route" => "backend/offres/liste_offre/"
			],
			[
				"label" => "Partager des offres",
				"route" => "backend/offres/partager_offre/"
			],
			[
				"label" => "Matching des offres",
				"route" => "backend/offres/matching_offre/"
			],
			[
				"label" => "Campagne de recrutement",
				"route" => "backend/offres/campagne_recrutement/"
			],
			[
				"label" => "Rechercher des offres",
				"route" => "backend/offres/rechercher_offre/"
			]
		]
	],
	[
		"label" => "Candidats",
		"route" => "backend/candidats/",
		"isVisible" => (read_session('menu3', 0) == 1),
		"childrens" => [
			[
				"label" => "Etat des candidats",
				"route" => "backend/candidats/"
			],
			[
				"label" => "CV thèque",
				"route" => "backend/candidats/cvtheque/"
			],
			[
				"label" => "CV Importer",
				"route" => "backend/candidats/cvimporter/"
			],
			[
				"label" => "Import manuel des CVs",
				"route" => "backend/candidats/import_manuel_des_cv/"
			],
			[
				"label" => "Dossier",
				"route" => "backend/candidats/dossier/"
			]
		]
	],
	[
		"label" => "Candidatures",
		"route" => "backend/module/candidatures/candidature/status",
		"isVisible" => (read_session('menu4', 0) == 1),
		"childrens" => $candidaturesStatus
	],
	[
		"label" => "Reporting",
		"route" => "backend/reporting/",
		"isVisible" => (read_session('menu5', 0) == 1),
		"childrens" => [
			[
				"label" => "Statistiques",
				"route" => "backend/reporting/"
			],
			[
				"label" => "Offres",
				"route" => "backend/reporting/statistiques_offres/"
			],
			[
				"label" => "Candidats",
				"route" => "backend/reporting/statistiques_candidats/"
			],
			[
				"label" => "Requêteur",
				"route" => "backend/reporting/requeteur/"
			]
		]
	],
	[
		"label" => "Courriers",
		"route" => "backend/courriers/",
		"isVisible" => (read_session('menu6', 0) == 1),
		"childrens" => [
			[
				"label" => "Historique des correspondances",
				"route" => "backend/courriers/correspondances/"
			],
			[
				"label" => "Courriers type",
				"route" => "backend/courriers/courriers_type/"
			],
			[
				"label" => "E-Mailing",
				"route" => "backend/courriers/mailing/"
			]
		]
	],
	[
		"label" => "Admin",
		"route" => "#",
		"isVisible" => (read_session('menu7', 0) == 1),
		"childrens" => [
			[
				"label" => "Gestion des workflows",
				"route" => "backend/module/workflows/workflow",
				"icon" => "fa fa-code-fork",
				"isVisible" => (isModuleEnabled('workflows') && $isSuperAdmin)
			],
			[
				"label" => "Gestion des profils",
				"route" => "backend/administration/profils/",
				"icon" => "fa fa-users",
				"isVisible" => $isSuperAdmin
			],
			[
				"label" => "Gestion des filiales",
				"route" => "backend/administration/filiales/",
				"icon" => "fa fa-asterisk",
				"isVisible" => $isSuperAdmin
			],
			[
				"label" => "Gestion des permissions",
				"route" => "backend/administration/permissions/",
				"icon" => "fa fa-user-secret",
				"isVisible" => $isSuperAdmin
			],
			[
				"label" => "Gestion des profils de stage",
				"route" => "backend/administration/profils_stage/",
				"icon" => "fa fa-users",
				"isVisible" => $isSuperAdmin
			],
			[
				"label" => "Courriers automatique",
				"route" => "backend/administration/courriers_automatique/",
				"icon" => "fa fa-at",
				"isVisible" => $isSuperAdmin
			],
			[
				"label" => "Personnalisation des champs",
				"route" => "backend/administration/personnalisation_champs/",
				"icon" => "fa fa-cog",
			],
			[
				"label" => "Champs éditables",
				"route" => "backend/administration/champs_editables_root/",
				"icon" => "fa fa-cog",
				"isVisible" => isLogged('admin')
			],
			[
				"label" => "Gestion des problèmes signalés",
				"route" => "backend/administration/problemes_signales/",
				"icon" => "fa fa-bug",
				"isVisible" => (isLogged('admin') && $isSuperAdmin)
			],
			[
				"label" => "Fiches de présélection / evaluation",
				"route" => "backend/module/fiches/fiche",
				"icon" => "fa fa-file-text-o",
				"isVisible" => (isModuleEnabled('fiches') && $isSuperAdmin)
			],
			[
				"label" => "Historique de connexion",
				"route" => "backend/administration/historique_connexion/",
				"icon" => "fa fa-history",
				"isVisible" => (isLogged('admin') && $isSuperAdmin)
			],
			[
				"label" => "Paramètrage",
				"route" => "backend/administration/parametrage/",
				"icon" => "fa fa-cogs",
				"isVisible" => (isLogged('admin') && $isSuperAdmin)
			],
			[
				"label" => "Config",
				"route" => "backend/administration/config/",
				"icon" => "fa fa-cogs"
			]
		]
	]
);
<?php
return array(
	[
		"name" => "Accueil",
		"uri" => "backend/"
	],
	[
		"name" => "Offres",
		"uri" => "backend/offres/",
		"show" => isAdmin(),
		"sub_menu" => [
			[
				"name" => "Etat des offres",
				"uri" => "backend/offres/"
			],
			[
				"name" => "Créer une offre",
				"uri" => "backend/offres/creer_offre/"
			],
			[
				"name" => "Liste des offres",
				"uri" => "backend/offres/liste_offre/"
			],
			[
				"name" => "Partager des offres",
				"uri" => "backend/offres/partager_offre/"
			],
			[
				"name" => "Matching des offres",
				"uri" => "backend/offres/matching_offre/"
			],
			[
				"name" => "Campagne de recrutement",
				"uri" => "backend/offres/campagne_recrutement/"
			],
			[
				"name" => "Rechercher des offres",
				"uri" => "backend/offres/rechercher_offre/"
			]
		]
	],
	[
		"name" => "Candidats",
		"uri" => "backend/candidats/",
		"show" => isAdmin(),
		"sub_menu" => [
			[
				"name" => "Etat des candidats",
				"uri" => "backend/candidats/"
			],
			[
				"name" => "CV thèque",
				"uri" => "backend/candidats/cvtheque/"
			],
			[
				"name" => "CV Importer",
				"uri" => "backend/candidats/cvimporter/"
			],
			[
				"name" => "Import manuel des CVs",
				"uri" => "backend/candidats/import_manuel_des_cv/"
			],
			[
				"name" => "Dossier",
				"uri" => "backend/candidats/dossier/"
			]
		]
	],
	[
		"name" => "Candidatures",
		"uri" => "backend/module/candidatures/candidature/status",
		"show" => (isModuleEnabled('candidatures') && isAdmin()),
		"sub_menu" => [
			[
				"name" => "État des candidatures",
				"uri" => "backend/module/candidatures/candidature/status"
			],
			[
				"name" => "Nouvelles candidatures",
				"uri" => "backend/module/candidatures/candidature/list/0"
			],
			[
				"name" => "Candidatures en cours",
				"uri" => "backend/module/candidatures/candidature"
			],
			[
				"name" => "Préselectionnés",
				"uri" => "backend/module/candidatures/candidature/list/17"
			],
			[
				"name" => "Non préselectionnés",
				"uri" => "backend/module/candidatures/candidature/list/31"
			],
			[
				"name" => "Convoquées à l'écrit",
				"uri" => "backend/module/candidatures/candidature/list/32"
			],
			[
				"name" => "Confirmées l'écrit",
				"uri" => "backend/module/candidatures/candidature/list/33"
			],
			[
				"name" => "Non confirmées l'écrit",
				"uri" => "backend/module/candidatures/candidature/list/34"
			],
			[
				"name" => "Présentes à l'écrit",
				"uri" => "backend/module/candidatures/candidature/list/35"
			],
			[
				"name" => "Absentes à l'écrit",
				"uri" => "backend/module/candidatures/candidature/list/36"
			],
			[
				"name" => "Admissibles",
				"uri" => "backend/module/candidatures/candidature/list/38"
			],
			[
				"name" => "Non admissibles",
				"uri" => "backend/module/candidatures/candidature/list/37"
			],
			[
				"name" => "Convoquées à l'oral",
				"uri" => "backend/module/candidatures/candidature/list/39"
			],
			[
				"name" => "Confirmées l'oral",
				"uri" => "backend/module/candidatures/candidature/list/40"
			],
			[
				"name" => "Non confirmées l'oral",
				"uri" => "backend/module/candidatures/candidature/list/41"
			],
			[
				"name" => "Admises",
				"uri" => "backend/module/candidatures/candidature/list/44"
			],
			[
				"name" => "Non admises",
				"uri" => "backend/module/candidatures/candidature/list/42"
			],
			[
				"name" => "Retenu",
				"uri" => "backend/module/candidatures/candidature/list/49"
			],
			[
				"name" => "Non retenu",
				"uri" => "backend/module/candidatures/candidature/list/50"
			],
			[
				"name" => "Liste d'attente",
				"uri" => "backend/module/candidatures/candidature/list/43"
			],
			[
				"name" => "Desistement",
				"uri" => "backend/module/candidatures/candidature/list/51"
			],
			[
				"name" => "Présentes à l'oral",
				"uri" => "backend/module/candidatures/candidature/list/45"
			],
			[
				"name" => "Absentes à l'oral",
				"uri" => "backend/module/candidatures/candidature/list/46"
			],
			[
				"name" => "Complétude du dossier",
				"uri" => "backend/module/candidatures/candidature/list/47"
			],
			[
				"name" => "Non complétude",
				"uri" => "backend/module/candidatures/candidature/list/48"
			]
		]
	],
	[
		"name" => "Reporting",
		"uri" => "backend/reporting/",
		"show" => isAdmin(),
		"sub_menu" => [
			[
				"name" => "Statistiques",
				"uri" => "backend/reporting/"
			],
			[
				"name" => "Offres",
				"uri" => "backend/reporting/statistiques_offres/"
			],
			[
				"name" => "Candidats",
				"uri" => "backend/reporting/statistiques_candidats/"
			],
			[
				"name" => "Requêteur",
				"uri" => "backend/reporting/requeteur/"
			]
		]
	],
	[
		"name" => "Courriers",
		"uri" => "backend/courriers/",
		"show" => isAdmin(),
		"sub_menu" => [
			[
				"name" => "Historique des correspondances",
				"uri" => "backend/courriers/correspondances/"
			],
			[
				"name" => "Courriers type",
				"uri" => "backend/courriers/courriers_type/"
			],
			[
				"name" => "E-Mailing",
				"uri" => "backend/courriers/mailing/"
			]
		]
	],
	[
		"name" => "Root",
		"uri" => "backend/administration/profils/",
		"show" => isAdmin(),
		"sub_menu" => [
			[
				"name" => "Gestion des workflows",
				"uri" => "backend/module/workflows/workflow",
				"show" => isModuleEnabled('workflows')
			],
			[
				"name" => "Gestion des profils",
				"uri" => "backend/administration/profils/"
			],
			[
				"name" => "Gestion des filiales",
				"uri" => "backend/administration/filiales/"
			],
			[
				"name" => "Gestion des permissions",
				"uri" => "backend/administration/permissions/"
			],
			[
				"name" => "Gestion des profils de stage",
				"uri" => "backend/administration/profils_stage/"
			],
			[
				"name" => "Courriers automatique",
				"uri" => "backend/administration/courriers_automatique/"
			],
			[
				"name" => "Personnalisation des champs",
				"uri" => "backend/administration/personnalisation_champs/"
			],
			[
				"name" => "Champs éditables",
				"uri" => "backend/administration/champs_editables_root/"
			],
			[
				"name" => "Gestion des problèmes signalés",
				"uri" => "backend/administration/problemes_signales/"
			],
			[
				"name" => "Fiches de présélection / evaluation",
				"uri" => "backend/module/fiches/fiche",
				"show" => isModuleEnabled('fiches')
			],
			[
				"name" => "Historique de connexion",
				"uri" => "backend/administration/historique_connexion/"
			],
			[
				"name" => "Paramètrage",
				"uri" => "backend/administration/parametrage/"
			],
			[
				"name" => "Config",
				"uri" => "backend/administration/config/"
			]
		]
	]
);
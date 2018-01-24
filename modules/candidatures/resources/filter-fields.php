<?php
$params = json_decode($_POST['params']);
$offreStatus = (isset($params->id) && $params->id == 53) ? 'Archivée' : 'En cours';

return array(
	[
		'name' => 'motcle',
		'type' => 'text',
		'value' => '',
		'label' => 'Rechercher par mot clé',
		'sortOrder' => 10,
	],
	[
		'name' => 'tfor',
		'type' => 'select',
		'value' => '',
		'label' => 'Par type de formation',
		'sortOrder' => 20,
		'options' => getDB()->prepare("SELECT id_tfor AS value, formation AS text FROM prm_type_formation")
	],
	[
		'name' => 'fraicheur',
		'type' => 'select',
		'value' => '',
		'label' => 'Par fraicheur du CV',
		'sortOrder' => 30,
		'options' => array(
			30  => '1 mois',
			90  => '3 mois',
			180 => '6 mois',
			360 => '12 mois'
		)
	],
	[
		'name' => 'sect',
		'type' => 'select',
		'value' => '',
		'label' => 'Par secteur d\'activité',
		'sortOrder' => 40,
		'options' => getDB()->prepare("SELECT id_sect AS value, FR AS text FROM prm_sectors")
	],
	[
		'name' => 'id_salr',
    'type' => 'select',
    'value' => '',
    'label' => 'Salaire souhaité',
    'sortOrder' => 42,
    'options' => getDB()->prepare("SELECT id_salr AS value, salaire AS text FROM prm_salaires")
	],
	[
		'name' => 'fonc',
		'type' => 'select',
		'value' => '',
		'label' => 'Fonction',
		'sortOrder' => 45,
		'options' => getDB()->prepare("SELECT id_fonc AS value, fonction AS text FROM prm_fonctions")
	],
	[
		'name' => 'ref_offre',
		'type' => 'select',
		'value' => '',
		'label' => 'Par ref de l\'offre',
		'sortOrder' => 60,
		'options' => getDB()->prepare("SELECT id_offre AS value, CONCAT(id_offre, ' | ', Name) AS text FROM offre WHERE status='". $offreStatus ."' ORDER BY id_offre DESC")
	],	
	[
		'name' => 'exp',
		'type' => 'select',
		'value' => '',
		'label' => 'Par année d\'expérience',
		'sortOrder' => 70,
		'options' => getDB()->prepare("SELECT id_expe AS value, intitule AS text FROM prm_experience")
	],
	[
		'name' => 'ecole',
		'type' => 'select',
		'value' => '',
		'label' => 'Par école ou établissement',
		'sortOrder' => 80,
		'options' => getDB()->prepare("SELECT id_ecole AS value, nom_ecole AS text FROM prm_ecoles")
	],
	[
		'name' => 'pays',
		'type' => 'select',
		'value' => '',
		'label' => 'Par pays de résidence',
		'sortOrder' => 85,
		'options' => getDB()->prepare("SELECT id_pays AS value, pays AS text FROM prm_pays")
	],
	[
		'name' => 'ville',
		'type' => 'select',
		'value' => '',
		'label' => 'Par ville',
		'sortOrder' => 90,
		'options' => getDB()->prepare("SELECT ville AS value, ville AS text FROM prm_villes")
	],
	[
		'name' => 'nfor',
		'type' => 'select',
		'value' => '',
		'label' => 'Par niveau d\'étude',
		'sortOrder' => 100,
		'options' => getDB()->prepare("SELECT id_nfor AS value, formation AS text FROM prm_niv_formation")
	],
	[
		'name' => 'situ',
		'type' => 'select',
		'value' => '',
		'label' => 'Par situation actuelle',
		'sortOrder' => 110,
		'options' => getDB()->prepare("SELECT id_situ AS value, situation AS text FROM prm_situation")
	],
	/*[
		'name' => 'campagne',
		'type' => 'select',
		'value' => '',
		'label' => 'Par campagne de recrutement',
		'sortOrder' => 120,
		'options' => getDB()->prepare("SELECT id_compagne AS value, titre_compagne AS text FROM compagne_recrutement")
	],*/
	[
		'name' => 'pertinence',
		'type' => 'select',
		'value' => '',
		'label' => 'Par pertinence',
		'sortOrder' => 130,
		'options' => [
			100 => 'Bonne',
			60 => 'Moyenne',
			30 => 'Faible',
		]
	]
);
<?php
$params = json_decode($_POST['params']);
$offreStatus = (isset($params->id) && $params->id == 53) ? 'Archivée' : 'En cours';
$url = $_SERVER['HTTP_REFERER'];

return array(
	[
		'name' => 'motcle',
		'type' => 'text',
		'value' => '',
		'label' => trans("Rechercher par mot clé"),
		'sortOrder' => 10,
	],
	[
		'name' => 'ref_offre',
		'type' => 'select',
		'value' => '',
		'label' => trans("Par ref de l'offre"),
		'sortOrder' => 20,
		'options' => getDB()->prepare("SELECT id_offre AS value, CONCAT(id_offre, ' | ', Name) AS text FROM offre WHERE status='". $offreStatus ."' ORDER BY id_offre DESC")
	],
	[
		'name' => 'fraicheur',
		'type' => 'select',
		'value' => '',
		'label' => trans("Par fraicheur du CV"),
		'sortOrder' => 30,
		'options' => array(
			30  => trans("1 mois"),
			90  => trans("3 mois"),
			180 => trans("6 mois"),
			360 => trans("12 mois")
		)
	],
	[
		'name' => 'pays',
		'type' => 'select',
		'value' => '',
		'label' => trans("Par pays de résidence"),
		'sortOrder' => 40,
		'options' => getDB()->prepare("SELECT id_pays AS value, pays AS text FROM prm_pays")
	],
	[
		'name' => 'ville',
		'type' => 'select',
		'value' => '',
		'label' => trans("Par ville"),
		'sortOrder' => 50,
		'options' => getDB()->prepare("SELECT ville AS value, ville AS text FROM prm_villes")
	],
	[
		'name' => 'ecole',
		'type' => 'select',
		'value' => '',
		'label' => trans("Par école ou établissement"),
		'sortOrder' => 60,
		'options' => getDB()->prepare("SELECT id_ecole AS value, nom_ecole AS text FROM prm_ecoles")
	],
	[
		'name' => 'nfor',
		'type' => 'select',
		'value' => '',
		'label' => trans("Nombre d’année de formation"),
		'sortOrder' => 70,
		'options' => getDB()->prepare("SELECT id_nfor AS value, formation AS text FROM prm_niv_formation")
	],
	[
		'name' => 'tfor',
		'type' => 'select',
		'value' => '',
		'label' => trans("Par type de formation"),
		'sortOrder' => 80,
		'options' => getDB()->prepare("SELECT id_tfor AS value, formation AS text FROM prm_type_formation")
	],
	[
		'name' => 'dfor',
		'type' => 'select',
		'value' => '',
		'label' => trans("Domaine de formation"),
		'sortOrder' => 90,
		'options' => getDB()->prepare("SELECT domaine_id AS value, name AS text FROM prm_domaines_formation")
	],
	[
		'name' => 'dip',
		'type' => 'select',
		'value' => '',
		'label' => trans("Diplôme"),
		'sortOrder' => 100,
		'options' => App\Models\Filiere::findAll(false)
	],
	[
		'name' => 'sect',
		'type' => 'select',
		'value' => '',
		'label' => trans("Par secteur d'activité"),
		'sortOrder' => 110,
		'options' => getDB()->prepare("SELECT id_sect AS value, FR AS text FROM prm_sectors")
	],
	[
		'name' => 'fonc',
		'type' => 'select',
		'value' => '',
		'label' => trans("Fonction"),
		'sortOrder' => 120,
		'options' => getDB()->prepare("SELECT id_fonc AS value, fonction AS text FROM prm_fonctions")
	],
	[
		'name' => 'exp',
		'type' => 'select',
		'value' => '',
		'label' => trans("Par année d'expérience"),
		'sortOrder' => 130,
		'options' => getDB()->prepare("SELECT id_expe AS value, intitule AS text FROM prm_experience")
	],
	[
		'name' => 'id_salr',
    'type' => 'select',
    'value' => '',
    'label' => trans("Salaire souhaité"),
    'sortOrder' => 140,
    'options' => getDB()->prepare("SELECT id_salr AS value, salaire AS text FROM prm_salaires")
	],
	[
		'name' => 'situ',
		'type' => 'select',
		'value' => '',
		'label' => trans("Par situation actuelle"),
		'sortOrder' => 150,
		'options' => getDB()->prepare("SELECT id_situ AS value, situation AS text FROM prm_situation")
	],
	[
		'name' => 'pertinence',
		'type' => 'select',
		'value' => '',
		'label' => trans("Par pertinence"),
		'sortOrder' => 160,
		'options' => [
			100 => trans("Bonne"),
			60 => trans("Moyenne"),
			30 => trans("Faible"),
		]
	],
	[
		'name' => 'age',
		'sortOrder' => 170,
		'template' => '<label for="filter_age">'. trans("Par age") .'</label><div class="input-group">
		  <span class="input-group-addon" style="padding: 4px 5px;">'. trans("Entre") .'</span>
		  <input type="number" name="age_min" min="0" step="1" value="'. get_url_params('age_min', $url) .'" class="form-control">
		  <span class="input-group-addon" style="padding: 4px 5px;border-left: 0; border-right: 0;">'. trans("Et") .'</span>
		  <input type="number" name="age_max" min="0" step="1" value="'. get_url_params('age_max', $url) .'" class="form-control">
		</div>'
	],
	[
		'name' => 'age_date',
		'type' => 'date',
		'value' => '',
		'label' => trans("À la date"),
		'sortOrder' => 180,
	],
	/*[
		'name' => 'campagne',
		'type' => 'select',
		'value' => '',
		'label' => trans("Par campagne de recrutement"),
		'sortOrder' => 120,
		'options' => getDB()->prepare("SELECT id_compagne AS value, titre_compagne AS text FROM compagne_recrutement")
	],*/
);
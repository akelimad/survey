<?php
/*
pl int null
cost_center_jde int null
poste_budgetisee tinyint 0
num_demande varchar
recruteur_manager varchar
recruteur_rh varchar
postes_nbr int
date_debut date
type_recrutement int
comments text
entite int


*/
return [
  'fields' => [
    // Informations Financières
    [
      'name' => 'offer[pl]',
      'label' => trans("P&L"),
      'type' => 'select',
      'options' => [
        '',
        'CVD',
        'CVD',
        'MBC',
        'MBC',
        'SFC',
        'SFC',
      ],
      'group_name' => 'financial_infos',
      'columns' => 4,
      'show' => function($column) {
        return true; // Demandeur ou RH recruteur
      }
    ],
    [
      'name' => 'offer[section]',
      'label' => trans("Section"),
      'type' => 'select',
      'options' => [],
      'group_name' => 'financial_infos',
      'columns' => 4,
      'show' => function($column) {
        return true; // Demandeur ou RH recruteur
      }
    ],
    [
      'name' => 'offer[poste_budgetisee]',
      'label' => trans("Poste budgétisée"),
      'type' => 'radio',
      'options' => [
        trans("Non"),
        trans("Oui")
      ],
      'group_name' => 'financial_infos',
      'columns' => 3,
      'show' => function($column) {
        return true; // Demandeur ou RH recruteur
      }
    ],
    // Informations sur la demande
    [
      'name' => 'offer[num_demande]',
      'label' => trans("Demande N°"),
      'type' => 'text',
      'value' => function ($column) {
        // dump($column['value']);
        if (is_null($column['value'])) {
          $lastId = getDB()->max('offre', 'id_offre') + 1;
          return date('Y') .'/'. $lastId;
        }
        return $column['value'];
      },
      'group_name' => 'request_infos',
      'columns' => 2,
      'required' => true
    ],
    [
      'name' => 'offer[date_insertion]',
      'label' => trans("Date de création"),
      'type' => 'date',
      'value' => function ($column) {
        if (is_null($column['value'])) {
          return date('Y-m-d');
        }
        return eta_date($column['value'], 'Y-m-d');
      },
      'group_name' => 'request_infos',
      'columns' => 3,
      'required' => true,
      'attributes' => [
        'max' => date('Y-m-d')
      ]
    ],
    [
      'name' => 'offer[recruteur_manager][]',
      'label' => trans("Manager recruteur"),
      'type' => 'select',
      'options' => function($column) {
        return getDB()->prepare("SELECT id_role as value, nom as text FROM root_roles");;
      },
      'group_name' => 'request_infos',
      'columns' => 4,
      'show' => function($column) {
        return true; // Demandeur ou RH recruteur
      },
      'attributes' => [
        'multiple'
      ]
    ],
    [
      'name' => 'offer[recruteur_rh][]',
      'label' => trans("Recruteur RH"),
      'type' => 'select',
      'options' => function($column) {
        return getDB()->prepare("SELECT id_role as value, nom as text FROM root_roles");;
      },
      'group_name' => 'request_infos',
      'columns' => 3,
      'show' => function($column) {
        return true; // Demandeur ou RH recruteur ou DRH
      },
      'attributes' => [
        'multiple'
      ]
    ],
    [
      'name' => 'offer[postes_nbr]',
      'label' => trans("Nombre de postes"),
      'type' => 'number',
      'value' => 1,
      'group_name' => 'request_infos',
      'columns' => 2,
      'required' => true,
      'show' => function($column) {
        return true; // Demandeur ou RH recruteur
      },
      'attributes' => [
        'min' => 1,
        'step' => 1
      ]
    ],
    [
      'name' => 'offer[date_debut]',
      'label' => trans("Date de début souhaitée"),
      'type' => 'date',
      'value' => function ($column) {
        if (!is_null($column['value'])) {
          return eta_date($column['value'], 'Y-m-d');
        }
      },
      'group_name' => 'request_infos',
      'columns' => 3,
      'show' => function($column) {
        return true; // Demandeur
      },
      'attributes' => [
        'min' => date('Y-m-d')
      ]
    ],
    [
      'name' => 'offer[motif_recrutement]',
      'label' => trans("Motif de recrutement"),
      'type' => 'select',
      'options' => [
        '' => '',
        trans("Renfort"), 
        trans("Accroissement de l'activité"), 
        trans("Remplacement"), 
        trans("Titularisation"), 
        trans("Création"),
        '_other' => trans("Autres (à péciser)")
      ],
      'group_name' => 'request_infos',
      'columns' => 3,
      'show' => function($column) {
        return true; // Demandeur ou RH recruteur
      }
    ],
    [
      'name' => 'offer[id_tpost]',
      'label' => trans("Type de contrat"),
      'type' => 'select',
      'options' => 'App\Models\TypePoste@findAll',
      'group_name' => 'request_infos',
      'columns' => 2,
      'required' => true,
      'show' => function($column) {
        return true; // Demandeur ou RH recruteur
      },
    ],
    [
      'name' => 'offer[type_recrutement]',
      'label' => trans("Type de recrutement"),
      'type' => 'select',
      'options' => [
        '' => '',
        trans("Interne"),
        trans("Externe"),
        trans("Interne & Externe")
      ],
      'group_name' => 'request_infos',
      'columns' => 2,
      'show' => function($column) {
        return true; // Demandeur ou RH recruteur
      }
    ],
    [
      'name' => 'offer[comments]',
      'label' => trans("Commentaires"),
      'type' => 'textarea',
      'group_name' => 'request_infos',
      'columns' => 12,
      'show' => function($column) {
        return true; // Demandeur ou RH recruteur
      },
      'attributes' => [
        'class' => 'ckeditor'
      ]
    ],
    // Informations sur le poste
    [
      'name' => 'offer[Name]',
      'label' => trans("Intitulé du poste"),
      'type' => 'text',
      'group_name' => 'job_infos',
      'columns' => 6,
      'required' => true,
      'show' => function($column) {
        return true; // Demandeur ou RH recruteur
      },
    ],
    [
      'name' => 'offer[id_fonc]',
      'label' => trans("Fonction / Département"),
      'type' => 'select',
      'options' => 'App\Models\Fonction@findAll',
      'group_name' => 'job_infos',
      'columns' => 3,
      'show' => function($column) {
        return true; // Demandeur ou RH recruteur
      },
    ],
    [
      'name' => 'offer[entite]',
      'label' => trans("Entité"),
      'type' => 'select',
      'options' => [],
      'group_name' => 'job_infos',
      'columns' => 3,
      'show' => function($column) {
        return true; // Demandeur ou RH recruteur
      }
    ],
    [
      'name' => 'offer[Details]',
      'label' => trans("Missions du poste"), // Mission et responsabilité 
      'type' => 'textarea',
      'group_name' => 'job_infos',
      'columns' => 12,
      'required' => true,
      'show' => function($column) {
        return true; // Demandeur ou RH recruteur
      },
      'attributes' => [
        'class' => 'ckeditor'
      ]
    ],
    [
      'name' => 'offer[Profil]',
      'label' => trans("Compétences et connaissances requises"), // Profil recherché
      'type' => 'textarea',
      'group_name' => 'job_infos',
      'columns' => 12,
      'required' => true,
      'show' => function($column) {
        return true; // Demandeur ou RH recruteur
      },
      'attributes' => [
        'class' => 'ckeditor'
      ]
    ],
    [
      'name' => 'offer[type_profil]',
      'label' => trans("Type de profil"),
      'type' => 'select',
      'options' => [
        '',
        'Profils technicien expérimenté',
        'Profils ingénieur / spécialiste / manager expérimentés'
      ],
      'group_name' => 'job_infos',
      'columns' => 3,
      'show' => function($column) {
        return true; //  RH recruteur
      }
    ],
    [
      'name' => 'offer[id_nfor]',
      'label' => trans("Niveau de formation requis"),
      'type' => 'select',
      'options' => 'App\Models\FormationLevel@findAll',
      'group_name' => 'job_infos',
      'columns' => 3,
      'required' => true,
      'show' => function($column) {
        return true; // Demandeur ou RH recruteur
      },
    ],
    [
      'name' => 'offer[id_nfor]',
      'label' => trans("Niveau d'expérience exigé"),
      'type' => 'select',
      'options' => 'App\Models\Experience@findAll',
      'group_name' => 'job_infos',
      'columns' => 3,
      'required' => true,
      'show' => function($column) {
        return true; // Demandeur ou RH recruteur
      },
    ],
    [
      'name' => 'offer[id_localisation]',
      'label' => trans("Lieu de travail"),
      'type' => 'select',
      'options' => 'App\Models\Localisation@findAll',
      'group_name' => 'job_infos',
      'columns' => 3,
      'required' => true,
      'show' => function($column) {
        return true; // Demandeur ou RH recruteur
      },
    ],




  ],
  'groups' => [
    'financial_infos' => trans("Informations Financières"),
    'request_infos' => trans("Informations sur la demande"),
    'job_infos' => trans("Informations sur le poste"),
  ]
];
<?php
// TODO - add closure support to show and required
return [
  // Informations sur le poste
  [
    'name' => 'offer[Name]',
    'label' => trans("Intitulé du poste"),
    'type' => 'text',
    'group_name' => 'Informations sur le poste',
    'columns' => 4,
    'show' => true // Demandeur ou RH recruteur
  ],
  [
    'name' => 'offer[id_fonc]',
    'label' => trans("Site ou fonction"),
    'type' => 'text',
    'value' => function ($column) {
      return \App\Models\Fonction::getNameById($column);
    },
    'group_name' => 'Informations sur le poste',
    'columns' => 4,
    'required' => false,
    'show' => true // Demandeur ou RH recruteur
  ],



  /*
  [
    'name'     => 'offer[details]',
    'label'    => trans("Mission et responsabilité"),
    'type'    => 'textarea',
    'value' => null,
    'help' => trans("Excepteur sint occaecat cupidatat non proident."),
    'required' => false,
    'show' => true,
    'group_name' => 'Avis de concours',
    'columns' => 12,
    'offset' => 0,
    'attributes' => [
      'class' => 'ckeditor'
    ]
  ],
  [
    'name'     => 'offer[id_fonc]',
    'label'    => trans("Fonction / Département"),
    'type'    => 'select',
    'value' => null,
    'options' => \App\Models\Fonction::findAll(),
    'help' => trans("Excepteur sint occaecat cupidatat non proident."),
    'required' => true,
    'show' => true,
    'group_name' => 'Description du poste',
    'columns' => 3,
    'offset' => 0,
    'attributes' => []
  ],*/
];
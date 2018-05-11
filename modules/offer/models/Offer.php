<?php
/**
 * Offer
 * 
 * @author mchanchaf
 *
 * @package app.offer.models
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Offer\Models;

use App\Models\Model;
use App\Helpers\FormBuilder;
use Modules\Candidatures\Models\Candidature;

class Offer extends Model
{

  const PUBLISHED_STATUS = 'En cours';
  const ARCHIVED_STATUS  = 'Archivée';

  public static $table = 'offre';
  public static $primaryKey = 'id_offre';
  public static $NameField = 'Name';
  

  public static function getSharedOffersUrls()
  {
    return [
      'backend/module/offer/partner/offers',
      'backend/module/offer/partner/offer-entries/[0-9]+',
      'backend/module/offer/partner/entry',
      'backend/module/offer/partner/entry/[0-9]+',
      'backend/module/offer/partner/store-entry',
      'backend/module/offer/partner/store-entry/[0-9]+',
      'backend/module/offer/partner/delete-entry-attachement'
    ];
  }


  public function getForm($id = null)
  {
    // Get model data
    $model = (!is_null($id)) ? Offer::getByID($id) : [];

    // Instanciate new Form Builder
    $form = new FormBuilder('offer', [
      'action' => 'backend/offer/store'
    ], $model);

    $form->setAttributes([
      'chm-form'
    ]);

    // Set form sections
    $form->setFieldsets([
      [
        'name' => 'Nomenclature',
        'label' => trans("Nomenclature d'un emploi"),
        'order' => 1,
      ],
      [
        'name' => 'InfosFinancieres',
        'label' => trans("Informations Financières"),
        'order' => 2,
      ],
      [
        'name' => 'InfosSurDemande',
        'label' => trans("Informations sur la demande"),
        'order' => 3,
      ],
      [
        'name' => 'InfosSurPoste',
        'label' => trans("Informations sur le poste"),
        'order' => 4,
      ],
      [
        'name' => 'PiecesObligatoires',
        'label' => trans("Pièces obligatoires lors de la postulation"),
        'order' => 5,
      ],
      [
        'name' => 'PiecesJoints',
        'label' => trans("Pièces Joints"),
        'order' => 6,
      ]
    ]);

    // Nomenclature d'un emploi
    $form->add('nomenclature', 'select', [
      'options' => 'App\Models\Offer@findAll',
      'columns' => 12,
      'fieldset' => 'Nomenclature',
      'displayed' => function($params) {
        return true; //(!empty($params));
      }
    ]);

    // Informations Financières
    $form->add('offer[pl]', 'select', [
      'label' => trans("P&L"),
      'options' => ['', 'CVD', 'MBC', 'SFC'],
      'keys_as_values' => true,
      'fieldset' => 'InfosFinancieres',
      'columns' => 2,
      'displayed' => function($params) {
        $role_name = get_admin('role_name');
        return (in_array($role_name, ['admin', 'applicant', 'rh_recruiter']));
      }
    ]);
    $form->add('section', 'select', [
      'label' => trans("Section"),
      'options' => function () {
        return \App\Models\CostCenterJde::findBy([
          'level' => 0
        ]);
      },
      'fieldset' => 'InfosFinancieres',
      'columns' => 2,
      'displayed' => function($params) {
        $role_name = get_admin('role_name');
        return (in_array($role_name, ['admin', 'applicant', 'rh_recruiter']));
      }
    ]);
    $form->add('sub_section', 'select', [
      'label' => trans("Sous Section"),
      'options' => function ($params) {
        if (isset($params['model']['cost_center_jde']) && !empty($params['model']['cost_center_jde'])) {
          $cost = \App\Models\CostCenterJde::findBy([
            'id' => $params['model']['cost_center_jde'],
            'level' => 2
          ], false);
          if (isset($cost[0]->parent_id)) {
            $costs = \App\Models\CostCenterJde::findBy([
              'parent_id' => $cost[0]->parent_id,
              'level' => 2
            ], false);
            if (isset($costs[0]->parent_id)) {
              $sub_sections = \App\Models\CostCenterJde::findBy([
                'id' => $costs[0]->parent_id,
                'level' => 1
              ], true);
              // Set default value for section and sub section
              if (!empty($sub_sections)) {
                $params['form']->setFieldOptions('section', 'value', $sub_sections[1]->parent_id);
                $params['form']->setFieldOptions('sub_section', 'value', $costs[0]->parent_id);
              }
              return $sub_sections;
            }
          }
        }
        return [];
      },
      'fieldset' => 'InfosFinancieres',
      'columns' => 2,
      'displayed' => function($params) {
        $role_name = get_admin('role_name');
        return (in_array($role_name, ['admin', 'applicant', 'rh_recruiter']));
      }
    ]);
    $form->add('offer[cost_center_jde]', 'select', [
      'label' => trans("Cost Center JDE"),
      'options' => function ($params) {
        if (isset($params['model']['cost_center_jde']) && !empty($params['model']['cost_center_jde'])) {
          $cost = \App\Models\CostCenterJde::findBy([
            'id' => $params['model']['cost_center_jde'],
            'level' => 2
          ], false);

          if (isset($cost[0]->parent_id)) {
            return \App\Models\CostCenterJde::findBy([
              'parent_id' => $cost[0]->parent_id,
              'level' => 2
            ], true);
          }
        }
        return [];
      },
      'fieldset' => 'InfosFinancieres',
      'columns' => 2,
      'displayed' => function($params) {
        $role_name = get_admin('role_name');
        return (in_array($role_name, ['admin', 'applicant', 'rh_recruiter']));
      }
    ]);
    $form->add('offer[poste_budgetisee]', 'radio', [
      'label' => trans("Poste budgétisée"),
      'value' => 0,
      'options' => [trans("Non"), trans("Oui")],
      'fieldset' => 'InfosFinancieres',
      'columns' => 3,
      'inline' => true,
      'displayed' => function($params) {
        $role_name = get_admin('role_name');
        return (in_array($role_name, ['admin', 'applicant', 'rh_recruiter']));
      }
    ]);
    // Informations sur la demande
    $form->add('offer[reference]', 'text', [
      'label' => trans("Demande N°"),
      'fieldset' => 'InfosSurDemande',
      'columns' => 3,
      'required' => true,
      'value' => function($params) {
        if (empty($params['value'])) {
          $lastId = getDB()->max('offre', 'id_offre') + 1;
          return date('Y') .'/'. $lastId;
        }
        return $params['value'];
      }
    ]);
    $form->add('offer[date_insertion]', 'text', [
      'label' => trans("Date de création"),
      'fieldset' => 'InfosSurDemande',
      'columns' => 2,
      'required' => true,
      'value' => function($params) {
        if (empty($params['value'])) {
          return date('d/m/Y');
        }
        return eta_date($params['value'], 'd/m/Y');
      },
      'attributes' => [
        'chm-date' => htmlentities('{"dateFormat": "dd/mm/yy", "maxDate": "-0day", "minDate": "-0day"}')
      ]
    ]);
    $form->add('offer[date_expiration]', 'text', [
      'label' => trans("Date d’expiration"),
      'fieldset' => 'InfosSurDemande',
      'columns' => 2,
      'required' => true,
      'value' => function($params) {
        if (empty($params['value'])) {
          return date('d/m/Y');
        }
        return eta_date($params['value'], 'd/m/Y');
      },
      'attributes' => [
        'chm-date' => htmlentities('{"dateFormat": "dd/mm/yy", "maxDate": "-2Y", "minDate": "-0day"}')
      ]
    ]);
    $form->add('offer[date_debut]', 'text', [
      'label' => trans("Date de début souhaitée"),
      'fieldset' => 'InfosSurDemande',
      'columns' => 3,
      'required' => true,
      'value' => function($params) {
        if (empty($params['value'])) {
          return date('d/m/Y');
        }
        return eta_date($params['value'], 'd/m/Y');
      },
      'attributes' => [
        'chm-date' => htmlentities('{"dateFormat": "dd/mm/yy", "maxDate": "-0day", "minDate": "-0day"}')
      ],
      'displayed' => function($params) {
        $role_name = get_admin('role_name');
        return (in_array($role_name, ['admin', 'applicant']));
      }
    ]);
    $form->add('offer[postes_nbr]', 'number', [
      'label' => trans("Nombre de postes"),
      'fieldset' => 'InfosSurDemande',
      'columns' => 2,
      'required' => true,
      'value' => 1,
      'attributes' => [
        'min' => 1,
        'step' => 1
      ],
      'displayed' => function($params) {
        $role_name = get_admin('role_name');
        return (in_array($role_name, ['admin', 'applicant', 'rh_recruiter']));
      }
    ]);
    $form->add('offer[recruteurs_manager]', 'select', [
      'label' => trans("Manager recruteur"),
      'options' => function($params) {
        return \App\Models\Role::findByRole('manager_recruiter');
      },
      'fieldset' => 'InfosSurDemande',
      'columns' => 3,
      'displayed' => function($params) {
        $role_name = get_admin('role_name');
        return (in_array($role_name, ['admin', 'applicant', 'rh_recruiter']));
      },
      'attributes' => [
        'multiple'
      ]
    ]);
    $form->add('offer[recruteurs_rh]', 'select', [
      'label' => trans("Recruteur RH"),
      'options' => function($params) {
        return \App\Models\Role::findByRole('rh_recruiter');
      },
      'fieldset' => 'InfosSurDemande',
      'columns' => 3,
      'displayed' => function($params) {
        $role_name = get_admin('role_name');
        return (in_array($role_name, ['admin', 'applicant', 'rh_recruiter']));
      },
      'attributes' => [
        'multiple'
      ]
    ]);
    $form->add('offer[motif_recrutement]', 'select', [
      'label' => trans("Motif de recrutement"),
      'options' => [
        '' => '',
        trans("Renfort"), 
        trans("Accroissement de l'activité"), 
        trans("Remplacement"), 
        trans("Titularisation"), 
        trans("Création")
      ],
      'keys_as_values' => true,
      'with_other' => true,
      'fieldset' => 'InfosSurDemande',
      'columns' => 2,
      'displayed' => function($params) {
        $role_name = get_admin('role_name');
        return (in_array($role_name, ['admin', 'applicant', 'rh_recruiter']));
      },
    ]);
    $form->add('offer[id_tpost]', 'select', [
      'label' => trans("Type de contrat"),
      'options' => 'App\Models\TypePoste@findAll',
      'fieldset' => 'InfosSurDemande',
      'columns' => 2,
      'required' => true,
      'displayed' => function($params) {
        $role_name = get_admin('role_name');
        return (in_array($role_name, ['admin', 'applicant', 'rh_recruiter']));
      },
    ]);
    $form->add('offer[type_recrutement]', 'select', [
      'label' => trans("Type de recrutement"),
      'options' => ['', trans("Interne"), trans("Externe"), trans("Interne & Externe")],
      'keys_as_values' => true,
      'fieldset' => 'InfosSurDemande',
      'columns' => 2,
      'required' => true,
      'displayed' => function($params) {
        $role_name = get_admin('role_name');
        return (in_array($role_name, ['admin', 'applicant', 'rh_recruiter']));
      },
    ]);
    $form->add('offer[comments]', 'textarea', [
      'label' => trans("Commentaires"),
      'fieldset' => 'InfosSurDemande',
      'columns' => 12,
      'displayed' => function($params) {
        $role_name = get_admin('role_name');
        return (in_array($role_name, ['admin', 'applicant', 'rh_recruiter']));
      },
      'attributes' => [
        'class' => 'summernote'
      ]
    ]);
    // Informations sur le poste
    $form->add('offer[Name]', 'text', [
      'label' => trans("Titre du poste"),
      'columns' => 3,
      'fieldset' => 'InfosSurPoste',
    ]);
    $form->add('offer[id_fonc]', 'select', [
      'label' => trans("Intitulé du poste"),
      'options' => 'App\Models\Fonction@findAll',
      'with_other' => true,
      'fieldset' => 'InfosSurPoste',
      'columns' => 3,
      'required' => true,
      'displayed' => function($params) {
        $role_name = get_admin('role_name');
        return (in_array($role_name, ['admin', 'applicant', 'rh_recruiter']));
      },
      'attributes' => [
        'title' => 'Fonction / Département'
      ]
    ]);
    $form->add('offer[site_fonction]', 'text', [
      'label' => trans("Site ou fonction"),
      'fieldset' => 'InfosSurPoste',
      'columns' => 3,
      'displayed' => function($params) {
        $role_name = get_admin('role_name');
        return (in_array($role_name, ['admin', 'applicant', 'rh_recruiter']));
      },
    ]);
    $form->add('offer[entite]', 'select', [
      'label' => trans("Entité"),
      'options' => [],
      'fieldset' => 'InfosSurPoste',
      'columns' => 3,
      'displayed' => function($params) {
        $role_name = get_admin('role_name');
        return (in_array($role_name, ['admin', 'applicant', 'rh_recruiter']));
      },
    ]);
    $form->add('offer[Details]', 'textarea', [
      'label' => trans("Missions du poste (Mission et responsabilité)"),
      'fieldset' => 'InfosSurPoste',
      'columns' => 12,
      'required' => true,
      'displayed' => function($params) {
        $role_name = get_admin('role_name');
        return (in_array($role_name, ['admin', 'applicant', 'rh_recruiter']));
      },
      'attributes' => [
        'class' => 'summernote'
      ]
    ]);
    $form->add('offer[Profil]', 'textarea', [
      'label' => trans("Compétences et connaissances requises (Profil recherché)"),
      'fieldset' => 'InfosSurPoste',
      'columns' => 12,
      'required' => true,
      'displayed' => function($params) {
        $role_name = get_admin('role_name');
        return (in_array($role_name, ['admin', 'applicant', 'rh_recruiter']));
      },
      'attributes' => [
        'class' => 'summernote'
      ]
    ]);
    $form->add('offer[type_profil]', 'select', [
      'label' => trans("Type de profil"),
      'options' => [
        '' => '',
        1 => 'Profils technicien expérimenté',
        2 => 'Profils ingénieur / spécialiste / manager expérimentés'
      ],
      'fieldset' => 'InfosSurPoste',
      'columns' => 4,
      'required' => false,
      'displayed' => function($params) {
        $role_name = get_admin('role_name');
        return (in_array($role_name, ['admin', 'rh_recruiter']));
      },
    ]);
    $form->add('offer[id_nfor]', 'select', [
      'label' => trans("Niveau de formation requis"),
      'options' => 'App\Models\FormationLevel@findAll',
      'fieldset' => 'InfosSurPoste',
      'columns' => 3,
      'required' => true,
      'displayed' => function($params) {
        $role_name = get_admin('role_name');
        return (in_array($role_name, ['admin', 'applicant', 'rh_recruiter']));
      },
    ]);
    $form->add('offer[id_expe]', 'select', [
      'label' => trans("Niveau d'expérience exigé"),
      'options' => 'App\Models\Experience@findAll',
      'fieldset' => 'InfosSurPoste',
      'columns' => 3,
      'required' => true,
      'displayed' => function($params) {
        $role_name = get_admin('role_name');
        return (in_array($role_name, ['admin', 'applicant', 'rh_recruiter']));
      },
    ]);
    $form->add('offer[id_localisation]', 'select', [
      'label' => trans("Lieu de travail"),
      'options' => 'App\Models\Localisation@findAll',
      'fieldset' => 'InfosSurPoste',
      'columns' => 2,
      'displayed' => function($params) {
        $role_name = get_admin('role_name');
        return (in_array($role_name, ['admin', 'applicant', 'rh_recruiter']));
      },
    ]);
    // Mobilité géographique
    $form->add('offer[mobilite]', 'radio', [
      'label' => trans("Mobilité géographique"),
      'value' => 'non',
      'options' => ['oui' => trans("Oui"), 'non' => trans("Non")],
      'fieldset' => 'InfosSurPoste',
      'columns' => 3,
      'inline' => true,
    ]);
    $form->add('offer[niveau_mobilite]', 'radio', [
      'label' => trans("Au niveau"),
      'options' => function ($params) {
        return \App\Models\MobiliteLevel::findAll(false);
      },
      'fieldset' => 'InfosSurPoste',
      'columns' => 4,
      'inline' => true,
    ]);
    $form->add('offer[taux_mobilite]', 'radio', [
      'label' => trans("Taux de mobilité"),
      'options' => function ($params) {
        return \App\Models\MobiliteRate::findAll(false);
      },
      'fieldset' => 'InfosSurPoste',
      'columns' => 4,
      'inline' => true,
    ]);    
    // Pièces obligatoires lors de la postulation
    $form->add('offer[required_files][]', 'checkbox', [
      'options' => function ($params) {
        $files = [];
        foreach (Candidature::$candidatureFiles as $name => $file) {
          $files[] = (object) ['value' => $name, 'text' => $file['title']];
        }
        return $files;
      },
      'value' => function ($params) {
        return json_decode($params['model']['required_files'], true) ?: [];
      },
      'fieldset' => 'PiecesObligatoires',
      'columns' => 12,
      'inline' => true
    ]);
    // Pièces Joints
    $form->add('offer[avis_concours]', 'file', [
      'label' => trans("Avis de concours"),
      'fieldset' => 'PiecesJoints',
      'columns' => 3,
      'delete_callback' => 'Offer.deleteAvisConcours',
      'delete_args' => '{"oid":"$id_offre$", "file":"$avis_concours$"}',
      'extensions' => []
    ]);
    $form->add('offer[decisions_recrutement]', 'file', [
      'label' => trans("Décisions de recrutement"),
      'fieldset' => 'PiecesJoints',
      'columns' => 3,
      'extensions' => []
    ]);
    $form->add('offer[candidats_convoques]', 'file', [
      'label' => trans("Liste des candidats convoqués"),
      'fieldset' => 'PiecesJoints',
      'columns' => 3,
      'extensions' => []
    ]);
    $form->add('offer[resultats_concours]', 'file', [
      'label' => trans("Résultat du concour"),
      'fieldset' => 'PiecesJoints',
      'columns' => 3,
      'extensions' => []
    ]);
    $form->add('offer[avis_modification]', 'file', [
      'label' => trans("Avis de modification"),
      'fieldset' => 'PiecesJoints',
      'columns' => 3,
      'extensions' => []
    ]);
    $form->add('offer[avis_report]', 'file', [
      'label' => trans("Avis de report"),
      'fieldset' => 'PiecesJoints',
      'columns' => 3,
      'extensions' => []
    ]);

    $form->add('offer[attachements]', 'file', [
      'label' => trans("Pièces joints (visible seulement pour administrateurs)"),
      'fieldset' => 'PiecesJoints',
      'columns' => 6,
      'extensions' => [],
      'attributes' => [
        'multiple'
      ]
    ]);

    $form->add('button', 'submit', [
      'label' => trans("Enregistrer")
    ]);

    $form->add('button', 'button', [
      'label' => trans("Fermer"),
      'attributes' => [
        'class' => 'btn btn-danger pull-left',
        'onclick' => "window.location.href='". site_url('backend/offers') ."'"
      ]
    ]);

    return $form;
  }



} // END Class
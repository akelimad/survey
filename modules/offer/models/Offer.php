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
    $form = new FormBuilder('offer', [], $model);

    // Set form sections
    $form->setFieldsets([
      [
        'name' => 'if',
        'label' => trans("Informations Financières"),
        'order' => 1,
      ],
      [
        'name' => 'id',
        'label' => trans("Informations sur la demande"),
        'order' => 2,
      ],
      [
        'name' => 'ip',
        'label' => trans("Informations sur le poste"),
        'order' => 3,
      ]
    ]);

    // Informations Financières
    $form->add('offer[pl]', 'select', [
      'label' => trans("P&L"),
      'options' => ['', 'CVD', 'MBC', 'SFC'],
      'fieldset' => 'if',
      'columns' => 3,
      'displayed' => function($params) {
        $role_name = get_admin('role_name');
        return (in_array($role_name, ['admin', 'applicant', 'rh_recruiter']));
      }
    ]);
    $form->add('offer[section]', 'select', [
      'label' => trans("Section"),
      'options' => [],
      'fieldset' => 'if',
      'columns' => 3,
      'displayed' => function($params) {
        $role_name = get_admin('role_name');
        return (in_array($role_name, ['admin', 'applicant', 'rh_recruiter']));
      }
    ]);
    $form->add('offer[poste_budgetisee]', 'radio', [
      'label' => trans("Poste budgétisée"),
      'value' => 0,
      'options' => [trans("Non"), trans("Oui")],
      'fieldset' => 'if',
      'columns' => 3,
      'inline' => true,
      'displayed' => function($params) {
        $role_name = get_admin('role_name');
        return (in_array($role_name, ['admin', 'applicant', 'rh_recruiter']));
      }
    ]);
    // Informations sur la demande
    $form->add('offer[num_demande]', 'text', [
      'label' => trans("Demande N°"),
      'fieldset' => 'id',
      'columns' => 2,
      'required' => true,
      'value' => function($value) {
        if (empty($value)) {
          $lastId = getDB()->max('offre', 'id_offre') + 1;
          return date('Y') .'/'. $lastId;
        }
        return $value;
      }
    ]);
    $form->add('offer[date_insertion]', 'text', [
      'label' => trans("Date de création"),
      'fieldset' => 'id',
      'columns' => 2,
      'required' => true,
      'value' => function($value) {
        if (empty($value)) {
          return date('d/m/Y');
        }
        return eta_date($value, 'd/m/Y');
      },
      'attributes' => [
        'chm-date' => htmlentities('{"dateFormat": "dd/mm/yy", "maxDate": "-0day", "minDate": "-0day"}')
      ]
    ]);
    $form->add('offer[recruteur_manager]', 'select', [
      'label' => trans("Manager recruteur"),
      'options' => function($params) {
        return \App\Models\Role::findByRole('manager_recruiter');
      },
      'fieldset' => 'id',
      'columns' => 3,
      'displayed' => function($params) {
        $role_name = get_admin('role_name');
        return (in_array($role_name, ['admin', 'applicant', 'rh_recruiter']));
      },
      'attributes' => [
        'multiple'
      ]
    ]);
    $form->add('offer[recruteur_rh]', 'select', [
      'label' => trans("Recruteur RH"),
      'options' => function($params) {
        return \App\Models\Role::findByRole('rh_recruiter');
      },
      'fieldset' => 'id',
      'columns' => 3,
      'displayed' => function($params) {
        $role_name = get_admin('role_name');
        return (in_array($role_name, ['admin', 'applicant', 'rh_recruiter']));
      },
      'attributes' => [
        'multiple'
      ]
    ]);
    $form->add('offer[postes_nbr]', 'number', [
      'label' => trans("Nombre de postes"),
      'fieldset' => 'id',
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
    $form->add('offer[date_debut]', 'text', [
      'label' => trans("Date de début souhaitée"),
      'fieldset' => 'id',
      'columns' => 3,
      'required' => true,
      'value' => function($value) {
        if (empty($value)) {
          return date('d/m/Y');
        }
        return eta_date($value, 'd/m/Y');
      },
      'attributes' => [
        'chm-date' => htmlentities('{"dateFormat": "dd/mm/yy", "maxDate": "-0day", "minDate": "-0day"}')
      ],
      'displayed' => function($params) {
        $role_name = get_admin('role_name');
        return (in_array($role_name, ['admin', 'applicant']));
      }
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
      'value' => '',
      'with_other' => true,
      'fieldset' => 'id',
      'columns' => 3,
      'displayed' => function($params) {
        $role_name = get_admin('role_name');
        return (in_array($role_name, ['admin', 'applicant', 'rh_recruiter']));
      },
    ]);


    /*



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
    ],*/

    return $form;
  }


} // END Class
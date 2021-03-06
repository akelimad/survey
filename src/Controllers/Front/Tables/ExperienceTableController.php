<?php
/**
 * ExperienceTableController
 *
 * @author mchanchaf
 *
 * @package app.controllers.front.tables
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Controllers\Front\Tables;

use App\Controllers\Controller;
use App\Models\Formation;

class ExperienceTableController extends Controller
{


	public function getTable()
	{
    $query = "SELECT * FROM `experience_pro` WHERE `candidats_id`=". get_candidat_id();
    $table = new \App\Helpers\Table($query, 'id_exp', [
      'bulk_actions' => false,
      'show_footer' => true,
      'show_increment' => true
    ]);
    $table->setTableClass(['chmTable', 'table', 'table-striped', 'table-hover']);
    $table->setTableId('experiencesTable');
    $table->setOrderby('date_fin');
    $table->setOrder('DESC');
    $table->setPage($_GET['page']);

    $table->addColumn('poste', trans("Intitulé du Poste"), function($row) {
      return $row->poste;
    });

    $table->addColumn('entreprise', trans("Entreprise"), function($row) {
      return $row->entreprise;
    });

    $table->addColumn('date_debut', trans("Date de début"), function($row) {
      if (strlen($row->date_debut) == 7) $row->date_debut = '01/'. $row->date_debut;
      return \french_to_english_date($row->date_debut, 'd.m.Y');
    }, ['attributes' => ['width' => '100']]);

    $table->addColumn('date_fin', trans("Date de fin"), function($row) {
      if ($row->date_fin == '') return trans("Aujourd'hui");
      
      if (strlen($row->date_fin) == 7) $row->date_fin = '01/'. $row->date_fin;
      return \french_to_english_date($row->date_fin, 'd.m.Y');
    }, ['attributes' => ['width' => '100']]);

    $table->setAction('copie_attestation',  [
      'label' => trans("Copie de l’attestation"),
      'patern' =>  get_copie_attestation_url('{copie_attestation}'),
      'icon' => 'fa fa-file-text-o',
      'bulk_action' => false,
      'attributes' => [
        'class' => 'btn btn-default btn-xs',
        'target' => '_blank'
      ],
      'permission' => function ($row) {
        return ($row->copie_attestation != '');
      }
    ]);

    $table->setAction('bulletin_paie',  [
      'label' => trans("Bulletin de paie"),
      'patern' =>  get_bulletin_paie_url('{bulletin_paie}'),
      'icon' => 'fa fa-file-text-o',
      'bulk_action' => false,
      'attributes' => [
        'class' => 'btn btn-info btn-xs',
        'target' => '_blank'
      ],
      'permission' => function ($row) {
        return ($row->bulletin_paie != '');
      },
      'attributes' => [
        'style' => 'margin-left:3px;'
      ]
    ]);

    $table->setAction('edit', [
      'patern' => '#',
      'attributes' => [
        'onclick' => "return chmExperience.getForm({id_exp})",
      ]
    ]);

    $table->setAction('delete', [
      'patern' => '#',
      'attributes' => [
        'onclick' => "return chmModal.confirm('', '', '". trans("Êtes-vous sûr de vouloir supprimer cette experience ?") ."', 'chmExperience.delete', &#123;'id': {id_exp}&#125;, {width: 386})",
      ]
    ]);

    // Run table and get results
    $table->_run();

    return json_encode(['status' => 'success', 'content' => $table->render(false)]);
	}


	
} // END Class
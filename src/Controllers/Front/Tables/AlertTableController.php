<?php
/**
 * AlertTableController
 *
 * @author mchanchaf
 *
 * @package app.controllers.front.tables
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Controllers\Front\Tables;

use App\Controllers\Controller;

class AlertTableController extends Controller
{


	public function getTable()
	{
    $query = "SELECT * FROM alert WHERE candidats_id=". get_candidat_id();
    $table = new \App\Helpers\Table($query, 'id_alert');
    $table->setTableClass(['accountTable', 'table']);
    $table->setTableId('alertsTable');
    $table->setOrderby('id_alert');
    $table->setOrder('DESC');
    $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
    $table->setPage($page);

    $table->addColumn('date', 'Date', function($row) {
      return eta_date($row->date, get_setting('date_format'));
    }, ['attributes' => ['width' => 70]]);

    $table->addColumn('titre', trans("Description de l'alerte"), function($row) {
      return $row->titre;
    });

    $table->setAction('activate',  [
      'label' => trans("Activer l'alerte"),
      'patern' => '#',
      'icon' => 'fa fa-power-off',
      'bulk_action' => false,
      'attributes' => [
        'class' => 'btn btn-success btn-xs',
        'onclick' => 'return chmJobAlerts.activate({id_alert}, {activate})'
      ],
      'permission' => function ($row) {
        return ($row->activate == 'false');
      }
    ]);

    $table->setAction('deactivate',  [
      'label' => trans("Désactiver l'alerte"),
      'patern' => '#',
      'icon' => 'fa fa-times',
      'bulk_action' => false,
      'attributes' => [
        'class' => 'btn btn-warning btn-xs',
        'onclick' => 'return chmJobAlerts.activate({id_alert}, {activate})'
      ],
      'permission' => function ($row) {
        return ($row->activate == 'true');
      }
    ]);

    $table->setAction('search',  [
      'label' => trans("Executer la recherche"),
      'patern' => site_url('offres?s={titre}'),
      'icon' => 'fa fa-search',
      'bulk_action' => false,
      'attributes' => [
        'class' => 'btn btn-default btn-xs',
        'target' => '_blank'
      ]
    ]);

    $table->setAction('edit', [
      'patern' => '#',
      'label' => trans("Editer cette alerte"),
      'attributes' => [
        'class' => 'btn btn-primary btn-xs mb-0',
        'onclick' => "return chmJobAlerts.form({id_alert})",
      ]
    ]);

    $table->setAction('delete', [
      'patern' => '#',
      'label' => trans("Supprimer cette alerte"),
      'attributes' => [
        'class' => 'btn btn-danger btn-xs mb-0',
        'onclick' => "return chmModal.confirm('', '', '". trans("Êtes-vous sûr de vouloir supprimer cette alerte ?") ."', 'chmJobAlerts.delete', &#123;'id': {id_alert}&#125;, {width: 335})",
      ]
    ]);

    // Run table and get results
    $table->_run();

    return json_encode(['status' => 'success', 'content' => $table->render(false)]);
	}


	
} // END Class
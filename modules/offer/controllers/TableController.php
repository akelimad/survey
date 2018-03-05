<?php
/**
 * TableController
 *
 * @author mchanchaf
 *
 * @package modules.offer.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Offer\Controllers;

use App\Controllers\Controller;
use Modules\Offer\Models\Offer;

class TableController extends Controller
{


  /**
	 * Get Entries table object
	 *
	 * @return object $table
	 *
	 * @author Mhamed Chanchaf
	 */
	public function getEntriesTable()
	{
		$id_role = read_session('id_role');
		$id_role_offre = (isset($_GET['id'])) ? $_GET['id'] : null;
		$query = "SELECT * FROM role_offre_entry rfe JOIN role_offre rf ON rf.id_role_offre=rfe.id_role_offre WHERE rf.id_role={$id_role} AND rf.id_role_offre={$id_role_offre}";
		$table = new \App\Helpers\Table($query, 'id_entry');
		$table->setTableClass(['table', 'table-striped', 'table-hover']);
		$table->setTableId('offerEntryTable');
		$table->setOrderby('created_at');
		$table->setOrder('DESC');

		// Add table columns
		$table->addColumn('id_entry', '#', function($row) {
			return $row->object->getIncrement();
		});

		$table->addColumn('last_name', 'Nom', function($row) {
			return ($row->last_name != '') ? $row->last_name : '---';
		});

		$table->addColumn('first_name', 'Prénom', function($row) {
			return ($row->first_name != '') ? $row->first_name : '---';
		});

		$table->addColumn('cin', 'CIN', function($row) {
			return($row->cin != '') ? $row->cin : '---';
		});

		$table->addColumn('mobile', 'Téléphone', function($row) {
			return ($row->mobile != '') ? $row->mobile : '---';
		});

		$table->addColumn('created_at', 'Date de création', function($row) {
			return ($row->created_at != '') ? date('d.m.Y H:i', strtotime($row->created_at)) : '---';
		});
		
		$table->addColumn('updated_at', 'Date de modification', function($row) {
			return ($row->updated_at != '') ? date('d.m.Y H:i', strtotime($row->updated_at)) : '---';
		});

		$table->removeActions(['delete']);
		$table->setAction('edit', [
			'patern' => '#',
			'attributes' => [
				'onclick' => "return window.chmOffer.form({id_role_offre}, {id_entry})",
			]
		]);

		// Run table and get results
		$table->_run();

		return $table;
	}
	

	/**
	 * Get offers table object
	 *
	 * @return object $table
	 *
	 * @author Mhamed Chanchaf
	 */
	public function getOffersTable()
	{
		$id_role = read_session('id_role');
		$query = "SELECT * FROM role_offre rf JOIN offre o ON o.id_offre=rf.id_offre WHERE rf.id_role={$id_role}";

		$table = new \App\Helpers\Table($query, 'id_role_offre');
		$table->setTableClass(['table', 'table-striped', 'table-hover']);
		$table->setTableId('partnerOffersTable');
		$table->setOrderby('date_expiration');
		$table->setOrder('DESC');

		// Add table columns
		$table->addColumn('id_role_offre', '#', function($row) {
			return $row->object->getIncrement();
		});

		$table->addColumn('reference', 'Référence', function($row) {
			return $row->reference;
		});

		$table->addColumn('name', 'Titre offre', function($row) {
			return $row->Name;
		});

		$table->addColumn('status', 'Statut', function($row) {
			$expired = ($row->status == 'En cours' && strtotime($row->date_expiration) < strtotime(date('Y-m-d', time())));
			$status = ($expired) ? 'Expiré' :  $row->status;
			$bgColor = 'FF0000';
			if($row->status == 'En cours') {
				$bgColor = ($expired) ? 'FFA500' : '009900';
			}
			return '<span class="label label-default" style="background-color: #'. $bgColor .';color: #fff;font-size: 10px;vertical-align: sub;">'. $status .'</span>';
		});

		$table->addColumn('date_insertion', 'Date de création', function($row) {
			return ($row->date_insertion != '') ? date('d.m.Y', strtotime($row->date_insertion)) : '---';
		});

		$table->addColumn('date_expiration', 'Date d\'expiration', function($row) {
			return ($row->date_expiration != '') ? date('d.m.Y', strtotime($row->date_expiration)) : '---';
		});

		$table->removeActions(['delete', 'edit']);
		$table->setAction('show_entries', [
			'label' => 'Afficher les éléments',
			'patern' => site_url('backend/module/offer/partner/offer-entries/{id_role_offre}'),
      'icon' => 'fa fa-eye',
			'attributes' => array(
				'class' => 'btn btn-primary btn-xs'
			)
		]);

		// Run table and get results
		$table->_run();

		return $table;
	}

  
} // END Class